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

//get data all programlerning
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $result = $conn->query("SELECT * FROM $tbName");
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    if ($users) {
        echo json_encode($users);
    }
}

//create PLOs , CLOs, YLOs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $answer = $data['answer'];
    $document = $data['document'];

    $result = $conn->query("INSERT INTO $tbName (`name`, `answer`,`document`) VALUES ('$name','$answer','$document')");
   
    if ($result) {
        $last_id = $conn->insert_id;
        echo json_encode(array('id' => $last_id));
    }
}


//update position for nodes
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $x = $data['x'];
    $y = $data['y'];
    $id = $_GET['id'];

    $result = $conn->query("UPDATE  $tbName SET x='$x',y='$y' WHERE programlerningId='$id'");

    if ($result) {
        echo json_encode(array('messages' =>  $tbName . 'update successfully'));
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $result = $conn->query("DELETE  FROM $tbName WHERE programlerningId='$id'");
    if ($result) {
        echo json_encode(array('messages' => $tbName . "delete successfully"));
    }
}


// Close the database connection
$conn->close();
