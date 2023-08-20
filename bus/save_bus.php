<?php
include('../db_connect.php');


// Extract data from the POST request variables
extract($_POST);

// Set the default status to 1 for new data
$status = 1;

// Prepare the data for the SQL query
$data = " name = '$name' ";
$data .= ", bus_number = '$bus_number' ";
$data .= ", bus_seats = '$bus_seats' ";
$data .= ", status = '$status' "; // Add the status field to the data

// Check if the 'id' is empty. If empty, it means new data is being added.
if (empty($id)) {
    // Perform an SQL INSERT query to add the new data
    $insert = $conn->query("INSERT INTO bus SET " . $data);
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
    $update = $conn->query("UPDATE bus SET " . $data . " WHERE id =" . $id);
    if ($update) {
        // Return 1 to indicate success
        echo 1;
    } else {
        // Return an error message if there is an issue with the SQL query
        echo "Error: " . $conn->error;
    }
}
?>
