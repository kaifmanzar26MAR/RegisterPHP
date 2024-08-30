<?php
    
include("../config/sql_connection.php");

$conn = dbConnect();
$sql = 'SELECT `historyId`, `updatedAt`, `prev_values`, `curr_values`, `infotext` FROM `history` ORDER BY `updatedAt` DESC';

$result = $conn->query($sql);

if ($result) {
    $logs = [];
    
    while ($row = $result->fetch_assoc()) {
        $logs[] = $row;
    }
    $response = [
        "status" => "success",
        "message" => "Got the logs",
        "data" => $logs,
    ];
} else {
    $response = [
        "status" => "failed",
        "message" => "Failed to load logs",
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>