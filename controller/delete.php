<?php
include("../config/sql_connection.php");
$conn = dbConnect();
$q = $_REQUEST["q"];

if ($q) {
    $prevuser = $conn->query("SELECT * FROM user WHERE userId = $q");
    $prev_user_data = "";
    $img="";
    if ($prevuser === false) {
        echo "Error: " . $conn->error;
    } else {
        $userData = $prevuser->fetch_assoc();
        $img=$userData["userImage"];
        if ($userData) {
            $prev_user_data = json_encode($userData);
            echo $prev_user_data;
        } else {
            echo "No user found with userId = $q";
        }
    }


    $sql = "DELETE FROM `user` WHERE `user`.`userId` = " . $q;
    if ($conn->query($sql) == true) {
        echo "User Deleted with id " . $q. "<br>";
        $curr_values = null;
        $json_curr_values = json_encode($curr_values);
        $currTime = time();
        $infotext = "User Deleted with ID " . $q ;

        // Escape special characters for SQL
        $infotext = $conn->real_escape_string($infotext);
        echo $infotext;

        $historySql = "INSERT INTO `history` (`updatedAt`, `prev_values`,`curr_values`, `infotext`) 
                       VALUES (CURRENT_TIMESTAMP, '$prev_user_data', '$json_curr_values', '$infotext')";

        if ($conn->query($historySql) === true) {
            $conn->close();
            if (file_exists($img)) {
                // Try to delete the file
                if (unlink($img)) {
                    echo "The file has been deleted successfully.";
                    
                } else {
                    echo "There was an error deleting the file.";
                }
            } else {
                echo "The file does not exist.";
            }
            echo "Data Saved Successfully";
        } else {
            // Rollback 
            $conn->query("DELETE FROM users WHERE userId = '$userId'");
            $error = $conn->error;
            $conn->close();
            echo "Error updating history: " . $error;
        }
    }
    echo $sql;

} else {
    echo "No data";
}
?>