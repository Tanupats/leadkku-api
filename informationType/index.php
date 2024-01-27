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

    $result = $conn->query("SELECT * FROM `informationtype`");
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
    $name = $data['typeName'];

    $result = $conn->query("INSERT INTO `informationtype`(`typeName`) VALUES ('$name')");

    if ($result) {
        echo json_encode(array('messages' => 'informationtype created successfully'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['typeName'];
    $id = $_GET['id'];
    
    $result = $conn->query("UPDATE `informationtype` SET `typeName`='$name' WHERE InformationTypeId='$id'");

    if ($result) {
        echo json_encode(array('messages' => 'informationtype update successfully'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $result = $conn->query("DELETE FROM `informationtype` WHERE InformationTypeId='$id'");
    if ($result) {
        echo json_encode(array('messages' => 'informationtype delete successfully'));
    }
}

// Close the database connection
$conn->close();
