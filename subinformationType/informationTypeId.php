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



// Handle POST request for creating a new user
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM `subinformation` WHERE InformationTypeId ='$id'");
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
