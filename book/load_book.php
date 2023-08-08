<?php
// Include the database connection file (assuming it's named 'db_connect.php')
include('../db_connect.php');

// Check if the required POST data is present (i.e., the reference number)
if (isset($_POST['refNumber'])) {
    // Get the reference number from the AJAX request
    $refNumber = $_POST['refNumber'];

    // Query to fetch booking details based on the reference number
    $query = "SELECT concat(b.bus_number, ' | ', b.name) AS bus_booked, bd.name, bd.seats,bd.status, sl.price, sl.from_location, sl.to_location
              FROM booked bd
              INNER JOIN schedule_list sl ON bd.schedule_id = sl.id
              INNER JOIN bus b ON sl.bus_id = b.id
              WHERE bd.ref_no = ?";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $refNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data and convert it to an associative array
        $bookingDetails = $result->fetch_assoc();
        // Debug: Check the status value before sending the response
        // echo "Status from Database: " . $bookingDetails['status'] . "\n";
        // Function to get the location name based on its ID

        function getLocationName($location_id, $conn)
        {
            $query = "SELECT city AS location FROM location WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $location_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['location'];
            } else {
                return '';
            }
        }
        $totalPrice = $bookingDetails['seats'] * $bookingDetails['price'];

        // Get the "From" and "To" locations using the getLocationName function
        $from_location = getLocationName($bookingDetails['from_location'], $conn);
        $to_location = getLocationName($bookingDetails['to_location'], $conn);
        $bookingDetails['total_price'] = $totalPrice;
        // Add the "From" and "To" locations to the booking details array
        $bookingDetails['from_location'] = $from_location;
        $bookingDetails['to_location'] = $to_location;
        // Debug: Check the location IDs before calling getLocationName
        // echo "From Location ID: " . $from_location . "\n";
        // echo "To Location ID: " . $to_location . "\n";
        // Convert the array to JSON format and echo the response
        echo json_encode($bookingDetails);
    } else {
        // If the booking is not found, return an empty JSON object
        echo json_encode([]);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Return an empty JSON object if the reference number is not provided
    echo json_encode([]);
}

// Close the database connection
$conn->close();