<?php

include("../config/sql_connection.php");

$userId = htmlspecialchars($_POST['userId']);
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$contact = htmlspecialchars($_POST['contact']);
$address = htmlspecialchars($_POST['address']);
$userImage = ""; // Assuming you are setting this later or it's optional
$currTime = time();
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDir = "uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate a unique name for the file to avoid conflicts
    $fileName = basename($file['name']);
    $uploadFile = $uploadDir . uniqid() . '_' . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        $userImage = $uploadFile;
    }
}
// echo 'image'. $userImage;
// die();

$conn = dbConnect(); // Ensure your database connection function is included

try {
    $conn->begin_transaction();

    $instance = $conn->prepare('SELECT `userId`, `name`, `email`, `contact`, `address`, `userImage` FROM user WHERE userId = ?');
    $instance->bind_param('i', $userId);
    $instance->execute();
    $result = $instance->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $stmt = $conn->prepare("UPDATE user SET name = ?, email = ?, contact = ?, address = ?, userImage = ? WHERE userId = ?");
        $stmt->bind_param('ssissi', $name, $email, $contact, $address, $userImage, $userId);

        if ($stmt->execute() === true) {
            $infotext = "User updated with ID " . $userId;
            $escapedInfotext = $conn->real_escape_string($infotext);

            $prev_values = json_encode([
                "userId" => $user["userId"],
                "name" => $user["name"],
                "email" => $user["email"],
                "contact" => $user["contact"],
                "address" => $user["address"],
                "userImage" => $user["userImage"]
            ]);

            $curr_values = json_encode([
                "userId" => $userId,
                "name" => $name,
                "email" => $email,
                "contact" => $contact,
                "address" => $address,
                "userImage" => $userImage
            ]);

            // Insert into history table
            $historyStmt = $conn->prepare("INSERT INTO history (`updatedAt`, `prev_values`, `curr_values`, `infotext`) VALUES (CURRENT_TIMESTAMP, ?, ?, ?)");
            $historyStmt->bind_param('sss', $prev_values, $curr_values, $escapedInfotext);

            if ($historyStmt->execute() === true) {
                // Commit transaction if everything is successful
                $conn->commit();
                $response = [
                    "status" => "success",
                    "message" => "Data Updated",
                ];
                $img = $user["userImage"];
                if ($img && file_exists($img)) {
                    // Try to delete the file
                    unlink($img);
                } 
            } else {
                // Rollback the transaction if history insert fails
                $conn->rollback();
                $response = [
                    "status" => "failed",
                    "message" => "Something went wrong while saving history!",
                    "error" => $conn->error
                ];
            }
        } else {
            $conn->rollback();
            $response = [
                "status" => "failed",
                "message" => "Error in updating user data",
                "error" => $stmt->error
            ];
        }
    } else {
        $response = [
            "status" => "failed",
            "message" => "User not found",
        ];
    }
} catch (Exception $e) {
    // Rollback the transaction if any exception occurs
    $conn->rollback();
    $response = [
        "status" => "failed",
        "message" => "Transaction failed!",
        "error" => $e->getMessage()
    ];
} finally {
    // Close connection
    $conn->close();
}

// Output the JSON encoded response
header('Content-Type: application/json');
echo json_encode($response);
?>