<?php
// Include your database connection function
include("../config/sql_connection.php");

$q = $_REQUEST['q'];

// Check if the parameter is set and not empty
if ($q) {
    $conn = dbConnect();

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare('SELECT * FROM history WHERE historyId = ?');
    $stmt->bind_param('i', $q); // 'i' indicates the type is integer

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        // Fetch the result as an associative array
        $log = $result->fetch_assoc();
        // echo $log;
        // Create the response array
        $response = [
            "status" => "success",
            "message" => "Got the logs",
            "data" => $log,
        ];
    } else {
        $response = [
            "status" => "failed",
            "message" => "Failed to load logs or no logs found",
        ];
    }

    // Set content type to JSON
    header('Content-Type: application/json');
    
    // Output the JSON encoded response
    echo json_encode($response);

    // Close the statement and connection
    $stmt->close();
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
