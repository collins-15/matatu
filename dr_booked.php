<?php
include('db_connect.php');
session_start(); // Start the session

// Check if the user is logged in and has a driver user type
if (isset($_SESSION['login_id']) && $_SESSION['login_user_type'] === "Driver") {
    $driver_id = $_SESSION['login_id'];

    // Use prepared statements to prevent SQL injection
    $query = $conn->prepare("SELECT b.*, (s.price * b.seats) as amount, bs.bus_number as bus_no
                            FROM booked b
                            INNER JOIN schedule_list s ON s.id = b.schedule_id
                            INNER JOIN bus bs ON s.bus_id = bs.id
                            WHERE bs.driver_id = ?
                            ORDER BY b.date_updated DESC");
    
    // Bind the parameter and execute the query
    $query->bind_param("i", $driver_id);
    $query->execute();
    $result = $query->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}
?>
