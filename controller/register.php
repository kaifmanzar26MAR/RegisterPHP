<?php
include("../config/sql_connection.php");


$conn = dbConnect();

$response = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $userId = htmlspecialchars($_POST['userId']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = $_POST['contact'];
    $address = htmlspecialchars($_POST['address']);
    $userImage = "";
    $currTime = time();
    // echo $contact;
    // die();
    if(isset($_FILES['file'])){
        $file = $_FILES['file']; 
        $uploadDir="uploads/";
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        // Generate a unique name for the file to avoid conflicts
        $fileName = basename($file['name']);
        $uploadFile = $uploadDir . uniqid() . '_' . $fileName;
    
        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $uploadFile)){
            $userImage= $uploadFile;
        }
    }

    $isExist = $conn->query("SELECT COUNT(*) AS userExists FROM user WHERE userId = '$userId'");
    $row = $isExist->fetch_assoc();

    if ($row['userExists'] > 0) {
        $response = [
            "status" => "faild",
            "message" => "User already exist with id",
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

    $sql = "INSERT INTO user (`userId`, `name`, `email`, `contact`, `address`, `userImage`, `createdAt`) 
        VALUES ('$userId', '$name', '$email', '$contact', '$address', '$userImage', CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === true) {
        $infotext = "New user created with ID " . $userId;
        $escapedInfotext = $conn->real_escape_string($infotext);
        $prev_values = null;
        $json_prev_values = json_encode($prev_values);
        $curr_values = [
            "userId" => $userId,
            "name" => $name,
            "email" => $email,
            "contact" => $contact,
            "address" => $address,
            "userImage" => $userImage
        ];

        $json_curr_values = json_encode($curr_values);
        $historySql = "INSERT INTO `history` (`updatedAt`, `prev_values`,`curr_values`, `infotext`) 
                       VALUES (CURRENT_TIMESTAMP, '$json_prev_values', '$json_curr_values', '$escapedInfotext')";

        if ($conn->query($historySql) === true) {
            $conn->close();
            // echo "Data Saved Successfully";
            $response = [
                "status" => "success",
                "message" => "Data saved",
            ];
        } else {
            // Rollback 
            $conn->query("DELETE FROM users WHERE userId = '$userId'");
            $error = $conn->error;
            $conn->close();
            $response = [
                "status" => "faild",
                "message" => "Something went wrong!!",
            ];
        }
    } else {
        $error = $conn->error;
        $conn->close();
        $response = [
            "status" => "faild",
            "message" => "Error in Adding data",
        ];
    }

} else {
    $error = $conn->error;
    $conn->close();
    $response = [
        "status" => "faild",
        "message" => "From not submited properly",
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
// $conn->close();

?>