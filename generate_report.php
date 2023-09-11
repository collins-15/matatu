<?php
// Include your database connection logic
include './db_connect.php';

// Initialize an empty array to store the report data
$reportData = [];

// Replace this with your actual SQL query to fetch data from the database
$sql = "SELECT
  b.ref_no AS Booking_Reference,
  CONCAT(b.first_name, ' ', b.last_name) AS Passenger_Name,
  l.city AS Departure_Location,
  l2.city AS Destination_Location,
  s.departure_time AS Departure_Time,
  s.eta AS Estimated_Arrival,
  s.price  AS Ticket_Price,
  b.booked_seat AS booked_seats,
  concat(bus.bus_number, ' | ', bus.name) AS Bus_Name,
  bus.registration_number AS Bus_Registration_Number,
  t.payment_amount AS Payment_Amount,
  t.payment_date AS Payment_Date
FROM booked AS b
INNER JOIN schedule_list AS s ON b.schedule_id = s.id
INNER JOIN location AS l ON s.from_location = l.id
INNER JOIN location AS l2 ON s.to_location = l2.id
INNER JOIN bus ON s.bus_id = bus.id
INNER JOIN transaction AS t ON b.id = t.booked_id
WHERE b.status = 1;
";


$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch data from the result set and add it to the reportData array
    while ($row = mysqli_fetch_assoc($result)) {
        $reportData[] = $row;
    }

    // Close the database connection
    mysqli_close($conn);
}

// Return the report data as JSON
header('Content-Type: application/json');
echo json_encode($reportData);
?>
