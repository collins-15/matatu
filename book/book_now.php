<?php
// Include the file that contains the database connection code
include('../db_connect.php');

// Extract data from the POST request variables
extract($_POST);

// Initialize the data string with the schedule ID
$data = 'schedule_id = ' . $sid;

// Append other data to the $data string
$data .= ', name = "' . $name . '"';
$data .= ', seats ="' . $seats . '"';

// Check if booking ID ($bid) is provided, indicating an update
if (!empty($bid)) {
    // Append status data to $data if provided
    $data .= ', status ="' . $status . '"';

    // Create an SQL UPDATE query to update the existing booking with new data
    $update = $conn->query("UPDATE booked SET " . $data . " WHERE id =" . $bid);

    // Check if the update was successful
    if ($update) {
        // Return a JSON response indicating success status
        echo json_encode(array('status' => 1));
    }

    // Exit the script after updating the booking
    exit;
}

// If $bid is empty, it means a new booking is being created
$i = 1;
$ref = '';

// Generate a unique reference number for the new booking
while ($i == 1) {
    // Generate a reference number based on the current date and a random number
    $ref = date('Ymd') . mt_rand(1, 9999);

    // Append the reference number to the $data string
    $data .= ', ref_no = "' . $ref . '"';

    // Check if the generated reference number already exists in the 'booked' table
    $chk = $conn->query("SELECT * FROM booked WHERE ref_no = '" . $ref . "'")->num_rows;

    // If the reference number is unique (not found in the table), exit the loop
    if ($chk <= 0)
        $i = 0;
}

// Insert the new booking data into the 'booked' table
$insert = $conn->query("INSERT INTO booked SET " . $data);

// Check if the insertion was successful
if ($insert) {
    // Return a JSON response indicating success status and the generated reference number
    echo json_encode(array('status' => 1, 'ref' => $ref));
}
?>
