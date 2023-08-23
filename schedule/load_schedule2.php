<?php
include('../db_connect.php');
extract($_POST);
$where = '';
$params = array();

if (!empty($_POST['from_location']) && !empty($_POST['to_location'])) {
	$where .= "WHERE s.from_location LIKE ? AND s.to_location LIKE ? ";
	$params[] = '%' . $_POST['from_location'] . '%';
	$params[] = '%' . $_POST['to_location'] . '%';
} elseif (!empty($_POST['from_location'])) {
	$where .= "WHERE s.from_location LIKE ? ";
	$params[] = '%' . $_POST['from_location'] . '%';
} elseif (!empty($_POST['to_location'])) {
	$where .= "WHERE s.to_location LIKE ? ";
	$params[] = '%' . $_POST['to_location'] . '%';
}

if (!empty($_POST['departure_time'])) {
	$departure_time = str_replace('/', '-', $_POST['departure_time']);
	$where .= "AND DATE(s.departure_time) = ? ";
	$params[] = $departure_time;
}

function calculateSpaceLeft($bus_seats, $schedule_id, $conn)
{
	// Query to get the total number of booked seats for the given schedule
	$query = "SELECT SUM(seats) AS total_booked_seats FROM booked WHERE schedule_id = $schedule_id";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$total_booked_seats = $row['total_booked_seats'];
	} else {
		// No bookings found, so all seats are available
		$total_booked_seats = 0;
	}

	// Calculate space_left
	$space_left = $bus_seats - $total_booked_seats;

	return $space_left;
}

// Using prepared statements for the main query
$stmt = $conn->prepare("SELECT s.*, b.bus_seats, CONCAT(b.bus_number, ' | ', b.name) AS bus
                       FROM schedule_list s
                       INNER JOIN bus b ON b.id = s.bus_id
                       $where
                       AND s.status = 1
                       ORDER BY DATE(s.departure_time) ASC");
// Bind the parameters to the prepared statement
if (!empty($params)) {
	$types = str_repeat('s', count($params)); // Assuming all parameters are strings
	$stmt->bind_param($types, ...$params);
}

$stmt->execute();

$data = array();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
	$from_location = $conn->query("SELECT id,city as location FROM location where id = " . $row['from_location'])->fetch_array()['location'];
	$to_location = $conn->query("SELECT id,city as location FROM location where id = " . $row['to_location'])->fetch_array()['location'];

	$row['from_location'] = $from_location;
	$row['to_location'] = $to_location;

	// Convert the departure_time to a UNIX timestamp
	$departure_time = strtotime($row['departure_time']);

	// Check if the departure date is in the future or today
	if ($departure_time >= strtotime('today')) {
		// Format the date and time in the desired format
		$row['date'] = date('M d, Y', $departure_time);
		$row['time'] = date('h:i A', $departure_time);

		// Convert the eta to a UNIX timestamp
		$eta_time = strtotime($row['eta']);

		// Check if the ETA date is the same as the departure date
		if (date('Y-m-d', $departure_time) == date('Y-m-d', $eta_time)) {
			// If ETA is on the same day, format the time only
			$row['eta'] = date('h:i A', $eta_time);
		} else {
			// If ETA is on a different day, format the date and time
			$row['eta'] = date('M d, Y h:i A', $eta_time);
		}

		// Calculate the space_left for the current schedule
		$bus_seats = $row['bus_seats'];
		$schedule_id = $row['id'];
		$space_left = calculateSpaceLeft($bus_seats, $schedule_id, $conn);

		// Add the space_left value to the row
		$row['space_left'] = $space_left;

		$data[] = $row;
	}
}
echo json_encode($data);