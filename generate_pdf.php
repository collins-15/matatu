<?php
// Include the Composer autoloader
require 'vendor/autoload.php';

// Use the dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// Include your database connection code here (e.g., include('./db_connect.php');)
include('./db_connect.php');
// Your SQL query to fetch booking details
$sql = "SELECT
  b.ref_no AS Booking_Reference,
  CONCAT(b.first_name, ' ', b.last_name) AS Passenger_Name,
  l.city AS Departure_Location,
  l2.city AS Destination_Location,
  s.departure_time AS Departure_Time,
  s.eta AS Estimated_Arrival,
  s.price AS Ticket_Price,
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



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    $totalPaymentAmount = 0; // Initialize a variable to store the total payment amount

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $totalPaymentAmount += $row['Payment_Amount']; // Add payment amount to the total
    }

    // HTML content for the PDF
    $html = '
    <html>
    <head>
        <style>
           
            body { font-family: Arial, sans-serif; }
            table { border-collapse: collapse; width: 100%; }
            table, th, td { border: 1px solid #ddd; padding: 8px; }
            th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2>Generated Report on booked customers</h2>
        <table>
            <tr>
                <th>Reference Number</th>
                <th>Passenger Name</th>
                <th>Departure Location</th>
                <th>Destination Location</th>
                <th>Departure Time</th>
                <th>Estimated Arrival</th>
                <th>Price paid</th>
                <th>Booked seats</th>
            </tr>';

    // Loop through your data and generate table rows dynamically
    foreach ($data as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['Booking_Reference']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Passenger_Name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Departure_Location']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Destination_Location']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Departure_Time']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Estimated_Arrival']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['Ticket_Price']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['booked_seats']) . '</td>';
        $html .= '</tr>';
    }

    $html .= '
        </table>
        <p>Total Payment Amount: ' . $totalPaymentAmount . '</p>
    </body>
    </html>';

    // Load HTML content
    $dompdf->loadHtml($html);

    // Set paper size and orientation (optional)
    $dompdf->setPaper('A4', 'landscape');

    // Render PDF (default output is a file)
    $dompdf->render();

    // Output the generated PDF to the browser
    $dompdf->stream("generated_report.pdf", array("Attachment" => false));
} else {
    // Handle case where no data is found
    echo 'No data found.';
}

// Close the database connection
$conn->close();
?>
