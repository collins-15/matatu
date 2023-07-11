<?php
include 'db_connect.php';

$qry = $conn->query("SELECT s.*, b.bus_seats, concat(b.bus_number, ' | ', b.name) as bus
                     FROM schedule_list s
                     INNER JOIN bus b ON b.id = s.bus_id
                     WHERE s.status = 1
                     ORDER BY DATE(s.departure_time) ASC");

$data = array();
while ($row = $qry->fetch_assoc()) {
	$from_location = $conn->query("SELECT id, city AS location FROM location where id = " . $row['from_location'])->fetch_array()['location'];
	$to_location = $conn->query("SELECT id, city AS location FROM location where id = " . $row['to_location'])->fetch_array()['location'];
	// $space_left = $conn->query("SELECT bus_seats AS bus_seats FROM bus");
	$row['from_location'] = $from_location;
	$row['to_location'] = $to_location;
	$row['date'] = date('M d, Y', strtotime($row['departure_time']));
	$row['time'] = date('h:i A', strtotime($row['departure_time']));
	if (date('F d, Y', strtotime($row['departure_time'])) == date('F d, Y', strtotime($row['eta']))) {
		$row['eta'] = date('h:i A', strtotime($row['eta']));
	} else {
		$row['eta'] = date('M d,Y h:i A', strtotime($row['eta']));
	}
	$data[] = $row;
}
echo json_encode($data);



// $data = array();
// while ($row = $qry->fetch_assoc()) {
//     $from_location = $conn->query("SELECT id, city AS location FROM location WHERE id = " . $row['from_location'])->fetch_array()['location'];
//     $to_location = $conn->query("SELECT id, city AS location FROM location WHERE id = " . $row['to_location'])->fetch_array()['location'];
//     $bus_seats = $row['bus_seats']; // Add this line to retrieve the bus_seats value
//     $row['from_location'] = $from_location;
//     $row['to_location'] = $to_location;
//     $row['date'] = date('M d, Y', strtotime($row['departure_time']));
//     $row['time'] = date('h:i A', strtotime($row['departure_time']));
//     if (date('F d, Y', strtotime($row['departure_time'])) == date('F d, Y', strtotime($row['eta']))) {
//         $row['eta'] = date('h:i A', strtotime($row['eta']));
//     } else {
//         $row['eta'] = date('M d,Y h:i A', strtotime($row['eta']));
//     }
//     $row['bus_seats'] = $bus_seats; // Add this line to include the bus_seats value in the row
//     $data[] = $row;
// }
