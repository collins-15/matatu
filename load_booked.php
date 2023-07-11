<?php
include 'db_connect.php';

$query = $conn->query("SELECT b.*, (s.price * b.seats) as amount FROM booked b INNER JOIN schedule_list s ON s.id = b.schedule_id ORDER BY DATE(b.date_updated) DESC ");
$data = array();

while ($row = $query->fetch_assoc()) {
    // Decrement the value of bus_seats in the bus table
    $schedule_id = $row['schedule_id'];
    $seats = $row['seats'];
    
    $conn->query("UPDATE schedule_list SET space_left = bus_seats - $seats WHERE id = $schedule_id");

    // Multiply bus_seats with price and assign it to the amount column
    $row['amount'] = $row['seats'] * $row['price'];

    $data[] = $row;
}

echo json_encode($data);

// include 'db_connect.php';
// $query = $conn->query("SELECT b.*,(s.price * b.seats) as amount from booked b inner join schedule_list s on s.id = b.schedule_id order by date(b.date_updated) desc ");
// $data = array();
// while ($row = $query->fetch_assoc()) {
// 	$data[] = $row;
// }
// echo json_encode($data);
// var_dump($data);