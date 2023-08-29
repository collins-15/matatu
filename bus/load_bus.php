<?php
include('../db_connect.php');

$qry = $conn->query("SELECT * FROM bus where status = 1 order by bus_number asc");
$data = array();
while ($row = $qry->fetch_assoc()) {
    $data[] = $row;
}
$prettyJson = json_encode($data, JSON_PRETTY_PRINT); 

echo $prettyJson;
