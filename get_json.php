<?php
include('db_connect.php');
    // Route JSON
    $rtSql = "Select * from schedule_list";
    $resultrtSql = mysqli_query($conn, $rtSql);
    $arr = array();
    if(mysqli_num_rows($resultrtSql))
        while($row = mysqli_fetch_assoc($resultrtSql))
            $arr[] = $row;
        $routeJson = json_encode($arr);
    
    // Customer JSON
    $ctSql = "Select * from booked";
    $resultctSql = mysqli_query($conn, $ctSql);
    $arr = array();
    if(mysqli_num_rows($resultctSql))
        while($row = mysqli_fetch_assoc($resultctSql))
            $arr[] = $row;
    $customerJson = json_encode($arr);
    
    // Seats JSON
    $stSql = "Select bus_seats from bus  ";
    $resultstSql = mysqli_query($conn, $stSql);
    $arr = array();
    if(mysqli_num_rows($resultstSql))
        while($row = mysqli_fetch_assoc($resultstSql))
            $arr[] = $row;
    $seatJson = json_encode($arr);
    // Schedules JSON
    $sSql = "Select * from schedule_list  ";
    $resultstSql = mysqli_query($conn, $sSql);
    $arr = array();
    if(mysqli_num_rows($resultstSql))
        while($row = mysqli_fetch_assoc($resultstSql))
            $arr[] = $row;
    $schedulesJson = json_encode($arr);

    // Bus JSON
    $busSql = "Select * from bus";
    $resultBusSql = mysqli_query($conn, $busSql);
    $arr = array();
    while($row = mysqli_fetch_assoc($resultBusSql))
        $arr[] = $row;
    $busJson = json_encode($arr);

    // Booking JSON
    $bookingSql = "Select * from booked";
    $resultBookingSql = mysqli_query($conn, $bookingSql);
    $arr = array();
    while($row = mysqli_fetch_assoc($resultBookingSql))
        $arr[] = $row;
    $bookingJson = json_encode($arr);
        
    // Admin JSON
    $adminSql = "SELECT * from users";
    $resultAdminSql = mysqli_query($conn, $adminSql);
    $arr = array();
    while($row = mysqli_fetch_assoc($resultAdminSql))
        $arr[] = $row;
    $adminJson = json_encode($arr);

    

?>