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

$tbName = 'programdetail';

//get data all details
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $result = $conn->query("SELECT programdetailId as id,source,target  FROM $tbName");
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    if ($users) {
        echo json_encode($users);
    }
}

//for node link from topic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $source = $data['source'];
    $target = $data['target'];


    $result = $conn->query("INSERT INTO $tbName (`source`, `target`) VALUES ('$source','$target')");

    if ($result) {
        echo json_encode(array($result));
    }
}



//delete programDetail by source
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $result = $conn->query("DELETE FROM  $tbName WHERE source ='$id");
    if ($result) {
        echo json_encode(array('messages' => $tbName . "delete successfully"));
    }
}


// Close the database connection
$conn->close();
