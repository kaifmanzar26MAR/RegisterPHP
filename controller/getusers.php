<?php
include("../config/sql_connection.php");

// Connect to the database
$conn = dbConnect();

// Corrected SQL query
$sql = 'SELECT `userId`, `name`, `email`, `address`, `contact`, `createdAt`, `userImage`  FROM `user`';

// Execute the query
$result = $conn->query($sql);

if ($result) {
    // Initialize an array to hold the user data
    $users = [];
    

    // Fetch data from the result set
    while ($row = $result->fetch_assoc()) {
// print_r($row); 
        $users[] = $row;
    }

    // Prepare the success response
    $response = [
        "status" => "success",
        "message" => "Got the users",
        "data" => $users,
    ];
} else {
    // Prepare the failure response
    $response = [
        "status" => "failed",
        "message" => "Failed to load users",
    ];
}

// Output the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
