<?php
// Include your database connection function
include("../config/sql_connection.php");

$q = $_REQUEST['q'];

// Check if the parameter is set and not empty
if ($q) {
    $conn = dbConnect();

    $instance = $conn->prepare('SELECT `userId`,`name`, `email`, `address`, `contact`, `userImage` FROM user WHERE userId = ?');
    $instance->bind_param('i', $q); 
    $instance->execute();
    $result = $instance->get_result();

    if ($result) {
       
        $user = $result->fetch_assoc();
        $response = [
            "status" => "success",
            "message" => "Got the user",
            "data" => $user,
        ];
    } else {
        $response = [
            "status" => "failed",
            "message" => "Failed to load user or no user found",
        ];
    }

    // Set content type to JSON
    header('Content-Type: application/json');
    
    // Output the JSON encoded response
    echo json_encode($response);

    // Close the statement and connection
    $instance->close();
    $conn->close();
} else {
    // Handle the case where 'q' is not set or is empty
    $response = [
        "status" => "failed",
        "message" => "No query parameter provided",
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
