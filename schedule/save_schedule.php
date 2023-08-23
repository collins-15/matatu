<?php
include('../db_connect.php');

extract($_POST);

// Set the "status" to 1 when inserting a new record
$data = "bus_id = '$bus_id' ";
$data .= ", from_location = '$from_location' ";
$data .= ", to_location = '$to_location' ";
$data .= ", departure_time = '$departure_time' ";
$data .= ", eta = '$eta' ";
$data .= ", price = '$price' ";
$data .= ", status = 1"; // Set "status" to 1

// Calculate the "space_left" using the difference between "bus_seats" and the sum of booked seats
// $space_left = $bus_seats - $seats_booked;
// $data .= ", space_left = '$space_left' ";

if (empty($id)) {
    $insert = $conn->query("INSERT INTO schedule_list SET " . $data);
    if ($insert) {
        echo 1;
    } else {
        echo "Error inserting record: " . $conn->error;
    }
} else {
    $update = $conn->query("UPDATE schedule_list SET " . $data . " WHERE id = " . $id);
    if ($update) {
        echo 1;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
