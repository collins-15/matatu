<!DOCTYPE html>
<html lang="en">
<head>
<?php Include('header.php');
include ('db_connect.php');
// var_dump($_SESSION);

// session_start(); // Start the session

// Check if the user is logged in and has a driver user type
if (isset($_SESSION['login_id']) && $_SESSION['login_user_type'] === "Driver") {
    $driver_id = $_SESSION['login_id'];
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}?>
</head>
<body>

<div class="container mt-5">
    <h1>Driver Dashboard</h1>
    <!-- Display Bus Information -->
    <?php
    // Assuming the driver's user ID is available in a variable called $driver_id
    $query = "SELECT * FROM bus WHERE driver_id = $driver_id";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo '<h2>Your Bus Information:</h2>';
        echo '<div class="card">';
        echo '    <div class="card-body">';
        echo '        <h5 class="card-title">Bus Name: ' . $row['name'] . '</h5>';
        echo '        <p class="card-text">Bus Number: ' . $row['bus_number'] . '</p>';
        echo '        <p class="card-text">Bus Registration Number: ' . $row['registration_number'] . '</p>';
        echo '        <p class="card-text">Bus Seats: ' . $row['bus_seats'] . '</p>';
        echo '        <p class="card-text">Driver Name: ' . $row['driver_name'] . '</p>';
        echo '        <p class="card-text">Driver Number: ' . $row['driver_number'] . '</p>';
        echo '        <p class="card-text">Conductor Name: ' . $row['conductor_name'] . '</p>';
        echo '        <p class="card-text">Conductor Number: ' . $row['conductor_number'] . '</p>';
        // ... Display other bus-related information
        echo '    </div>';
        echo '</div>';
    }
    ?>
    
    </div>
    <div class="container mt-5">
    <h1>Driver  Schedule</h1>
    <div id="scheduleData"></div>
</div>



<!-- Include Bootstrap JS scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // AJAX request to fetch schedule data
    $.ajax({
        url: 'driver_schedule.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var scheduleData = '<h2>Schedule and Booked Seats:</h2>' +
                '<table class="table">' +
                '   <thead>' +
                '       <tr>' +
                '           <th>From Location</th>' +
                '           <th>To Location</th>' +
                '           <th>Departure Time</th>' +
                '           <th>Estimated Arrival</th>' +
                '           <th>Price</th>' +
                '           <th>Schedule Status</th>' +
                '           <th>Booked Seats</th>' +
                '           <th>Bus Seats</th>' +
                '           <th>Paid Seats</th>' +
                '           <th>Total Earnings</th>' +
                '           <th>Available Space</th>' +
                '       </tr>' +
                '   </thead>' +
                '   <tbody>';

            // Loop through the data and add rows to the table
            $.each(data, function(index, entry) {
                scheduleData += '<tr>' +
                    '<td>' + entry.from_location + '</td>' +
                    '<td>' + entry.to_location + '</td>' +
                    '<td>' + entry.departure_time + '</td>' +
                    '<td>' + entry.eta + '</td>' +
                    '<td>ksh' + entry.price + '</td>' +
                    '<td>' + entry.status + '</td>' +
                    '<td>' + entry.booked_seat_count + '</td>' +
                    '<td>' + entry.bus_seats + '</td>' +
                    '<td>' + entry.paid_seat_count + '</td>' +
                    '<td>ksh' + entry.total_earnings + '</td>' +
                    '<td>' + entry.available_space + '</td>' +
                    '</tr>';
            });

            scheduleData += '   </tbody>' +
                '</table>';

            // Insert the generated HTML into the scheduleData div
            $('#scheduleData').html(scheduleData);
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
});
</script>
</body>
</html>
