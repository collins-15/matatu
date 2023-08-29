<?php
include('db_connect.php'); // Include your database connection

$query = "SELECT
b.driver_id AS driver_id,
sl.id AS schedule_id,
sl.from_location AS from_location,
sl.to_location AS to_location,
b.driver_name AS driver_name,
SUM(t.payment_amount) AS total_earnings
FROM
bus b
LEFT JOIN
schedule_list sl ON b.id = sl.bus_id
LEFT JOIN
booked bk ON sl.id = bk.schedule_id
LEFT JOIN
transaction t ON bk.id = t.booked_id
GROUP BY
b.driver_id, b.driver_name, sl.id, sl.from_location, sl.to_location;

";

$result = mysqli_query($conn, $query);

if ($result === false) {
    // Handle query execution error
    echo json_encode(array('error' => 'Query execution failed: ' . mysqli_error($conn)));
} else {
    $data = array();
    $overall_total = 0; // Initialize the overall total
    
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
        $overall_total += $row['total_earnings']; // Add to overall total
    }

    // Convert the data array to JSON
    $response = array(
        'data' => $data,
        'overall_total' => $overall_total
    );
    
    echo json_encode($response,JSON_PRETTY_PRINT);
}
?>
