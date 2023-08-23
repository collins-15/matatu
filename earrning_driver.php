<?php
include('db_connect.php');
session_start(); // Start the session

// Check if the user is logged in and has a driver user type
if (isset($_SESSION['login_id']) && $_SESSION['login_user_type'] === "Driver") {
    $driver_id = $_SESSION['login_id'];

    // Use prepared statements to prevent SQL injection
    $query = $conn->prepare("SELECT SUM(t.payment_amount) as total_earnings
                            FROM transaction t
                            INNER JOIN booked b ON t.booked_id = b.id
                            INNER JOIN schedule_list s ON b.schedule_id = s.id
                            INNER JOIN bus bs ON s.bus_id = bs.id
                            WHERE bs.driver_id = ?");
    // var_dump($query);
    if ($query) { // Check if the query was prepared successfully
        // Bind the parameter and execute the query
        $query->bind_param("i", $driver_id);
        $query->execute();
        
        // Get the query result
        $result = $query->get_result();
        
        if ($result) { // Check if the query execution was successful
            $row = $result->fetch_assoc();
            
            // JSON response with driver's total earnings
            $response = array(
                'driver_id' => $driver_id,
                'total_earnings' => $row['total_earnings']
            );
            
            // Set content type to JSON
            header('Content-Type: application/json');
            
            // Output JSON response
            echo json_encode($response);
        } else {
            // Handle error if query execution fails
            echo json_encode(array('error' => 'Query execution failed.'));
        }
    } else {
        // Handle error if query preparation fails
        echo json_encode(array('error' => 'Query preparation failed.'));
    }
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}
?>
