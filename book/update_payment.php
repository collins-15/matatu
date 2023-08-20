<?php
// Include the file with database connection settings
include('../db_connect.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input (in this case, we're assuming the reference number and payment status are sent as POST parameters)
    $refNumber = $_POST['refNumber'];
    $paymentStatus = $_POST['paymentStatus'];

    // Perform server-side validation and ensure the payment status is 1 for a successful payment
    if (!empty($refNumber) && is_numeric($paymentStatus) && $paymentStatus == 1) {
        // Update the status in the database
        $sql = "UPDATE booked SET status = 1 WHERE ref_no = '$refNumber'";

        // Make sure to establish the database connection before executing the query
        if ($conn->query($sql) === TRUE) {
            // Return a success response to the AJAX call (optional, for handling on the client-side)
            $response = array('status' => 'success', 'message' => 'Status updated successfully');
            echo json_encode($response);
        } else {
            // Return an error response to the AJAX call (optional, for handling on the client-side)
            $response = array('status' => 'error', 'message' => 'Error updating status: ' . $conn->error);
            echo json_encode($response);
        }
    } else {
        // Return an error response to the AJAX call (optional, for handling on the client-side)
        $response = array('status' => 'error', 'message' => 'Invalid data or payment status');
        echo json_encode($response);
    }
}
?>
