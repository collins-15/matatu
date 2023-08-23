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
        // Start a database transaction to ensure both updates happen atomically
        $conn->begin_transaction();



        try {
            // Update the status in the booked table
            $updateBookedSql = "UPDATE booked SET status = 1 WHERE ref_no = '$refNumber'";
            if ($conn->query($updateBookedSql) !== TRUE) {
                throw new Exception("Error updating status in booked table: " . $conn->error);
            }

            // Retrieve the booked_id, schedule_id, and seats from the booked table
            $fetchIdsAndSeatsSql = "SELECT id, schedule_id, seats FROM booked WHERE ref_no = '$refNumber'";
            $result = $conn->query($fetchIdsAndSeatsSql);

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $bookedId = $row['id'];
                $scheduleId = $row['schedule_id'];
                $seats = $row['seats'];

                // Retrieve bus_id and price from the schedule_list table
                $fetchBusIdAndPriceSql = "SELECT bus_id, price FROM schedule_list WHERE id = $scheduleId";
                $busIdAndPriceResult = $conn->query($fetchBusIdAndPriceSql);

                if ($busIdAndPriceResult->num_rows === 1) {
                    $busIdAndPriceRow = $busIdAndPriceResult->fetch_assoc();
                    $busId = $busIdAndPriceRow['bus_id'];
                    $price = $busIdAndPriceRow['price'];

                    // Calculate payment_amount
                    $paymentAmount = $seats * $price;

                    // Insert a record into the transaction table
                    $insertTransactionSql = "INSERT INTO transaction (booked_id, bus_id, schedule_id, payment_amount, payment_date) VALUES (?, ?, ?, ?, NOW())";
                    $stmt = $conn->prepare($insertTransactionSql);

                    // Bind parameters and execute the statement
                    $stmt->bind_param("iiid", $bookedId, $busId, $scheduleId, $paymentAmount);
                    if (!$stmt->execute()) {
                        throw new Exception("Error inserting transaction record: " . $stmt->error);
                    }

                    // Commit the transaction if everything was successful
                    $conn->commit();

                    // Return a success response to the AJAX call (optional, for handling on the client-side)
                    $response = array('status' => 'success', 'message' => 'Status updated and transaction recorded successfully');
                    echo json_encode($response);
                } else {
                    throw new Exception("Error fetching bus_id and price from schedule_list table");
                }
            } else {
                throw new Exception("Error fetching IDs and seats from booked table");
            }
        } catch (Exception $e) {
            // Rollback the transaction in case of any errors
            $conn->rollback();

            // Return an error response to the AJAX call (optional, for handling on the client-side)
            $response = array('status' => 'error', 'message' => $e->getMessage());
            echo json_encode($response);
        }

    }
}