<?php include('header.php'); ?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
        <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <?php
    include './assets/css/dashboard.php';
    include './assets/css/admin.php';
    $page = "dashboard";
    ?>
</head>
<body>
    <!-- Requiring the admin header files -->
    <?php
    require 'get_json.php';
    $routeData = json_decode($routeJson);
    $customerData = json_decode($customerJson);
    $seatData = json_decode($seatJson);
    $busData = json_decode($busJson);
    $adminData = json_decode($adminJson);
    $bookingData = json_decode($bookingJson);
    $scheduleData = json_decode($schedulesJson);
    // $earningData = json_decode($earningJson);
    
    // echo "<pre>";
    // var_export(get_object_vars($adminData[0])["user_fullname"]);
    // var_export($adminData);
    // var_export($_SESSION);
    // echo "</pre>";
    
    ?>
    <style>/* CSS for dashboard layout using CSS Grid */
#status {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Adjust column width as needed */
    gap: 20px; /* Adjust the gap between items */
}
</style>
<main>
            <section id="dashboard">
                
                <div id="status" class="grid-container">
                    <div id="Booking" class="info-box status-item">
                        <div class="heading">
                            <h5>Bookings</h5>
                            <div class="info">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <p>Total Bookings</p>
                            <p class="num" data-target="<?php
                            echo count($bookingData);
                            ?>">
                                999
                            </p>
                        </div>
                        <a href="./index.php?page=book/booked">View More <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div id="Bus" class="info-box status-item">
                        <div class="heading">
                            <h5>Buses</h5>
                            <div class="info">
                                <i class="fas fa-bus"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <p>Total Buses</p>
                            <p class="num" data-target="<?php
                            echo count($busData);
                            ?>">
                                999
                            </p>
                        </div>
                        <a href="./index.php?page=bus/bus">View More <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div id="Route" class="info-box status-item">
                        <div class="heading">
                            <h5>Routes</h5>
                            <div class="info">
                                <i class="fas fa-road"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <p>Total Routes</p>
                            <p class="num" data-target="<?php
                            echo count($routeData);
                            ?>">
                                999
                            </p>
                        </div>
                        <a href="./index.php?page=location/location">View More <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div id="Booking" class="info-box status-item">
                        <div class="heading">
                            <h5> schedules</h5>
                            <div class="info">
                                <i class="fas fa-road"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <p>Total schedules</p>
                            <p class="num" data-target="<?php
                            echo count($scheduleData);
                            ?>">
                                999
                            </p>
                        </div>
                        <a href="./index.php?page=schedule/view_schedule">View More <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <!-- <div id="Seat" class="info-box status-item">
                        <div class="heading">
                            <h5>Seats</h5>
                            <div class="info">
                                <i class="fas fa-th"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <p>Total Seats</p>
                            <p class="num" data-target="<?php
                            echo count($busData);
                            ?>">
                                999
                            </p>
                        </div>
                        <a href="./index.php?page=schedule/view_schedule">View More <i class="fas fa-arrow-right"></i></a>
                    
                </div> -->
                </div>
                <!-- <h3>User</h3> -->
                <div id="user">
                    <div id="Customer" class="info-box user-item">
                        <div class="heading">
                            <h5>Customers</h5>
                            <div class="info">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <p>Total Customers</p>
                            <p class="num" data-target="<?php
                            echo count($customerData);
                            ?>">
                                999
                            </p>
                        </div>
                        <a href="./index.php?page=book/booked">View More <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div id="Admin" class="info-box user-item">
                        <div class="heading">
                            <h5>Admins</h5>
                            <div class="info">
                                <i class="fas fa-user-lock"></i>
                            </div>
                        </div>
                        <div class="info-content">
                            <p>Total Admins</p>
                            <p class="num" data-target="<?php
                            echo count($adminData);
                            ?>">
                                999
                            </p>
                        </div>
                        <a href="./index.php?page=user/user">View More <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div id="Earning" class="info-box user-item">
                        <div class="heading">
                            <h5>Earnings</h5>
                            <div class="info">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="info-content">
    <p>Total Earnings</p>
    <p class="num" data-target="<?php
        $result = mysqli_query($conn, "
        SELECT
        concat(b.bus_number, ' | ', b.name) AS driver_id,
        sl.id AS schedule_id,
        SUM(t.payment_amount) AS total_earnings
        FROM
        bus b
        LEFT JOIN
        schedule_list sl ON b.id = sl.bus_id
        LEFT JOIN
        booked bk ON sl.id = bk.schedule_id
        LEFT JOIN
        transaction t ON bk.id = t.booked_id
        WHERE
        bk.status = 1");
        $row = mysqli_fetch_assoc($result);
        $sum = $row['total_earnings'];
        echo $sum;
    ?>">
        999
    </p>
</div>

                        <a href="./index.php?page=Total_earnings">View More <i class="fas fa-arrow-right"></i></a>
                    </div>

                </div>
                
        </div>
    </main>
    <script >
        // Select all elements with the class "num" and store them in the 'counters' array
const counters = document.querySelectorAll(".num");

// Iterate through each element with the class "num"
counters.forEach(counter => {
    // Get the target number from the 'data-target' attribute and convert it to a number
    let target = +counter.dataset.target;

    // Define the step value for counting
    let step = 100;

    // Calculate the decrement value to reach the target value
    let dec = parseInt((999 - target) / step);

    // Initialize a counter variable
    let i = 0;

    // Define a function to update the count
    function updateCount() {
        console.log(i++);

        // Check if the counter has reached 1000 iterations and return if it has
        if (i === 1000) return;

        // Get the current value displayed in the counter element
        const curr = +counter.innerText;

        // Compare the current value with the target value
        console.log(curr, target);
        if (curr > target) {
            // If the current value is greater than the target, decrement it by the 'dec' value
            counter.innerText = curr - dec;
            setTimeout(updateCount, 5); // Schedule the next update after a delay
        } else {
            // If the current value is less than or equal to the target, set it to the target
            counter.innerText = target;
        }
    }

    // Start the counting animation after a delay of 900 
    setTimeout(updateCount, 900);
});

    </script>
</body>
</html>