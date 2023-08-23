<?php
// Include necessary files and set up database connection
include('db_connect.php');
session_start(); // Start the session

// Check if the user is logged in and their role is a driver
if ($_SESSION['login_user_type'] === 'Driver') {
    // Assuming you have a session variable 'driver_id' that holds the driver's ID
    $driver_id = $_SESSION['login_id'];

    // Fetch the bus details for the logged-in driver
    $bus_query = "SELECT * FROM bus WHERE driver_id = $driver_id";
    $bus_result = mysqli_query($conn, $bus_query);
    $row = mysqli_fetch_assoc($bus_result);

    // If bus details are fetched successfully
    if ($row) {
        $bus_id = $row['id'];
        $schedule_query = "SELECT sl.*, b.bus_seats, sum(bk.seats) AS booked_seat_count,SUM(CASE WHEN bk.status = 1 THEN bk.seats ELSE 0 END) AS paid_seat_count,
                            loc_from.city AS from_location, loc_to.city AS to_location
        FROM schedule_list sl
        LEFT JOIN bus b ON sl.bus_id = b.id
        LEFT JOIN booked bk ON sl.id = bk.schedule_id
        LEFT JOIN transaction tr ON bk.id = tr.booked_id
        LEFT JOIN location loc_from ON sl.from_location = loc_from.id
        LEFT JOIN location loc_to ON sl.to_location = loc_to.id
        WHERE sl.bus_id = $bus_id AND sl.status = 1
        GROUP BY sl.id";
        $schedule_result = mysqli_query($conn, $schedule_query);

        $data = array(); // Initialize an empty array to store the data

        while ($schedule_row = mysqli_fetch_assoc($schedule_result)) {
            $entry = array(
                'from_location' => $schedule_row['from_location'],
                'to_location' => $schedule_row['to_location'],
                'departure_time' => $schedule_row['departure_time'],
                'eta' => $schedule_row['eta'],
                'price' => $schedule_row['price'],
                'status' => ($schedule_row['status'] ? 'Active' : 'Upcoming'),
                'booked_seat_count' => $schedule_row['booked_seat_count'],
                'bus_seats' => $schedule_row['bus_seats'],
                'paid_seat_count' => $schedule_row['paid_seat_count'],
                'total_earnings' => ($schedule_row['booked_seat_count'] * $schedule_row['price']),
                'available_space' => ($schedule_row['bus_seats'] - $schedule_row['booked_seat_count'])
            );
            $data[] = $entry;
        }

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Output the JSON data
        header('Content-Type: application/json');
        echo $json_data;
    } else {
        // Handle case where no bus details are found for the driver
        echo json_encode(array('error' => 'No bus details found for the logged-in driver.'));
    }
} else {
    // Handle case where the logged-in user is not a driver
    echo json_encode(array('error' => 'You are not logged in as a driver.'));
}
?>
