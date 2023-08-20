<?php
include('../db_connect.php');


// Check if the 'City' key exists in the POST request
if (isset($_POST['City'])) {
    // Extract data from the POST request variables
    extract($_POST);

    // Check if the 'id' is empty. If empty, it means a new location is being added.
    if (empty($id)) {
        // Perform an SQL INSERT query to add the new location using prepared statements
        $stmt = $conn->prepare("INSERT INTO location (city, status, date_updated) VALUES (?, ?, NOW())");
        $stmt->bind_param("si", $City, $status);
        $status = 1; // Assuming status is set to 1 for a new location
        if ($stmt->execute()) {
            // Return 1 to indicate success
            echo 1;
        } else {
            // Return an error message if there is an issue with the SQL query
            echo "Error: " . $stmt->error;
        }
    } else {
        // If 'id' is not empty, it means an existing location is being updated.
        // Perform an SQL UPDATE query to update the location with new data using prepared statements
        $stmt = $conn->prepare("UPDATE location SET city = ?, date_updated = NOW() WHERE id = ?");
        $stmt->bind_param("si", $City, $id);
        if ($stmt->execute()) {
            // Return 1 to indicate success
            echo 1;
        } else {
            // Return an error message if there is an issue with the SQL query
            echo "Error: " . $stmt->error;
        }
    }
} else {
    // Return an error message if the 'City' key is not present in the POST request
    echo "Error: City not provided.";
}

