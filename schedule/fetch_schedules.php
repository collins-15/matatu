<?php
// Include the database connection file
include('../db_connect.php');

// Query to retrieve schedules from the database (modify as needed)
$qry = $conn->query("SELECT s.*, b.bus_seats, concat(b.bus_number, ' | ', b.name) as bus
                     FROM schedule_list s
                     INNER JOIN bus b ON b.id = s.bus_id
                     ORDER BY DATE(s.departure_time) ASC");

$data = array(); // Initialize an empty array to store the schedule data

while ($row = $qry->fetch_assoc()) {
    // Fetch and format schedule details as needed
     // Fetch the "from_location" details from the "location" table using its ID
     $from_location = $conn->query("SELECT id, city AS location FROM location where id = " . $row['from_location'])->fetch_array()['location'];

     // Fetch the "to_location" details from the "location" table using its ID
     $to_location = $conn->query("SELECT id, city AS location FROM location where id = " . $row['to_location'])->fetch_array()['location'];
 
     // Replace the original "from_location" and "to_location" values with their respective names
     $row['from_location'] = $from_location;
     $row['to_location'] = $to_location;
 
     // Convert the departure_time to a UNIX timestamp
     $departure_time = strtotime($row['departure_time']);
 
     // Check if the departure date is not the future or today
     if ($departure_time != strtotime('today')) {
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
 
         // Calculate the total number of booked seats for the given schedule
         $query = "SELECT SUM(seats) AS total_booked_seats FROM booked WHERE schedule_id = " . $row['id'];
         $result = $conn->query($query);
 
         if ($result->num_rows > 0) {
             $booked_data = $result->fetch_assoc();
             $total_booked_seats = $booked_data['total_booked_seats'];
         } else {
             $total_booked_seats = 0;
         }
 
         // Calculate available space
         $bus_seats = $row['bus_seats'];
         $available_space = $bus_seats - $total_booked_seats;
 
         // Add the calculated available space to the row
         $row['available_space'] = $available_space;
    
    // Add the row to the data array
    $data[] = $row;
}
}
// Convert the data array to JSON and echo it
echo json_encode($data,JSON_PRETTY_PRINT);
?>
