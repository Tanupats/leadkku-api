<?php
// Include the database connection file
include '../dbcon.php';
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

    $result = $conn->query("SELECT * FROM `subinformation`");
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    if ($users) {
        echo json_encode($users);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $subname = $data['subname'];
    $informationTypeId = $data['informationTypeId'];

    $result = $conn->query("INSERT INTO `subinformation`(`informationTypeId`,`subname`) VALUES ('$informationTypeId','$subname')");

    if ($result) {
        echo json_encode(array('messages' => 'subinformation created successfully'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $subname = $data['subname'];
    $id = $_GET['id'];
    
    $result = $conn->query("UPDATE `subinformation` SET `subname`='$subname' WHERE subinformationId='$id'");

    if ($result) {
        echo json_encode(array('messages' => 'subinformation update successfully'));
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $result = $conn->query("DELETE FROM `subinformation` WHERE subinformationId='$id'");
    if ($result) {
        echo json_encode(array('messages' => 'subinformation delete successfully'));
    }
}

// Close the database connection
$conn->close();
