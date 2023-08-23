<?php
include('../db_connect.php');

extract($_POST);

// Set the default status to 1 for new data
$status = 1;

$data = " name = '$name' ";
$data .= ", username = '$username' ";
$data .= ", user_type = '$user_type' ";

// Check if a password is provided
if (!empty($password)) {
    // Hash the password using the PHP password_hash() function
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $data .= ", password = '$hashed_password' ";
}

$data .= ", status = '$status' "; // Add the status field to the data with value 1

if (empty($id)) {
    // Perform an SQL INSERT query to add the new data
    $insert = $conn->query("INSERT INTO users SET " . $data);
    if ($insert) {
        // Return 1 to indicate success
        echo 1;
    } else {
        // Return an error message if there is an issue with the SQL query
        echo "Error: " . $conn->error;
    }
} else {
    // If 'id' is not empty, it means existing data is being updated.
    // Perform an SQL UPDATE query to update the data with new values
    $update = $conn->query("UPDATE users SET " . $data . " WHERE id =" . $id);
    if ($update) {
        // Return 1 to indicate success
        echo 1;
    } else {
        // Return an error message if there is an issue with the SQL query
        echo "Error: " . $conn->error;
    }
}
?>
