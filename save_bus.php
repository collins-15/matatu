<?php
include('db_connect.php');

extract($_POST);
$data = " name = '$name' ";
$data .= ", bus_number = '$bus_number' ";
$data .= ", bus_seats = '$bus_seats' ";
if (empty($id)) {

	$insert = $conn->query("INSERT INTO bus set " . $data);
	if ($insert)
		echo 1;
} else {
	$update = $conn->query("UPDATE bus set " . $data . " where id =" . $id);
	if ($update)
		echo 1;
}