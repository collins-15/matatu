<?php
require __DIR__ . "/../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

header('Content-Type: application/pdf');
include('../db_connect.php');

// Check if the required POST data is present (i.e., the reference number)
if (isset($_GET['ref_no'])) {
    $refNumber = $_GET['ref_no'];

    // Query to fetch booking details based on the reference number
    $query = "SELECT 
    concat(b.bus_number, ' | ', b.name) AS bus_booked, 
    bd.first_name, bd.last_name, bd.ID_number,bd.ref_no,    
    bd.location, bd.phone_number, bd.email, bd.age, bd.seats, bd.status, 
    sl.price, sl.from_location, sl.to_location,
    b.driver_name, b.driver_number,b.registration_number, b.conductor_name,b.conductor_number
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


        // Load your HTML template
        $html = file_get_contents(__DIR__ . "/template.php");

        // Replace placeholders in the HTML template with actual values from the booking
        foreach ($bookingDetails as $key => $value) {
            $html = str_replace("{{ " . $key . " }}", $value, $html);
        }

        // Create a new Dompdf instance
        $options = new Options();
        $options->setIsRemoteEnabled(true); // You may or may not need this based on your template
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper("A4", "landscape");

        // Render the PDF
        $dompdf->render();

        // Output the PDF to the browser
        $pdfContent = $dompdf->output();

        // Set headers for PDF download
        header("Content-Disposition: inline; filename=bus_booking_$refNumber.pdf");
        header('Content-Type: application/pdf');

        echo $pdfContent;
    } else {
        // Handle case where booking is not found
        echo 'Booking not found.';
    }
} else {
    // Handle case where ref_no is not provided
    echo 'Invalid request';
}

// Close the database connection
$conn->close();
?>
 