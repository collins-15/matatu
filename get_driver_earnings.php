<?php
include('db_connect.php'); // Include your database connection

$query = "SELECT
    concat(b.bus_number, ' | ', b.name) AS driver_id,
    sl.id AS schedule_id,
    loc_from.city AS from_location,
    loc_to.city AS to_location,
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
LEFT JOIN
    location loc_from ON sl.from_location = loc_from.id
LEFT JOIN
    location loc_to ON sl.to_location = loc_to.id
WHERE
    bk.status = 1
GROUP BY
    driver_id, driver_name, schedule_id, from_location, to_location
ORDER BY
    schedule_id;"; 


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
    
    echo json_encode($response, JSON_PRETTY_PRINT);
}
