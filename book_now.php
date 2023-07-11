<?php


include 'db_connect.php';
extract($_POST);
// Ensure $seats is not more than 4
$seats = min($seats, 4);

if ($seats > 4) {
	echo json_encode(array('status' => 0, 'message' => 'Quantity should not exceed 4.'));
	exit;
}

$data = ' schedule_id = ' . $sid . ' ';
$data .= ', name = "' . $name . '" ';
$data .= ', seats = "' . $seats . '" ';

if (!empty($bid)) {
	$data .= ', status ="' . $status . '" ';
	$update = $conn->query("UPDATE booked set " . $data . " where id =" . $bid);
	$update = $conn->query("UPDATE schedule_list SET availability = availability - $seats WHERE id =". $bid);
	if ($update) {
		echo json_encode(array('status' => 1));
	}
	exit;
}
$i = 1;
$ref = '';
while ($i == 1) {
	$ref = date('Ymd') . mt_rand(1, 9999);
	$data .= ', ref_no = "' . $ref . '" ';
	$chk = $conn->query("SELECT * FROM booked where ref_no=" . $ref)->num_rows;
	if ($chk <= 0)
		$i = 0;
}

// echo "INSERT INTO booked set ".$data;
$insert = $conn->query("INSERT INTO booked SET " . $data);

// var_dump($insert);

if ($insert) {
	echo json_encode(array('status' => 1, 'ref' => $ref));

	// Decrement the 'availability' column in the 'schedule_list' table
	$update = $conn->query("UPDATE schedule_list SET availability = availability - $seats WHERE id = $sid");

	if ($update) {
		echo "Booking successful.";
	} else {
		echo "Failed to update availability.";
	}
} else {
	echo "Failed to insert booked seats.";
}