<?php
// Include the database connection file
include '../dbcon.php';
// Set the content type to JSON
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$tbName = 'programlerning';

//get data all programlerning filter by name is PLO CLO YLO 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];
    $result = $conn->query( "SELECT * FROM `programlerning` WHERE name='$name'");
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    if ($users) {
        echo json_encode($users);
    }else{
        echo json_encode($users);
    }
}

// Close the database connection
$conn->close();
