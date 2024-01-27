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

$tbName = 'education';

// Handle POST request for creating a new user
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $groupName = $data['groupName'];
    $document = $data['document'];

    $result = $conn->query("INSERT INTO $tbName (`name`,`groupName`,`document`) VALUES 
                                                ('$name','$groupName','$document')");


    if ($result) {
        $last_id = $conn->insert_id;
        echo json_encode(
            array(
                'messages' => 'education created successfully',
                'id' => $last_id
            )
        );
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $groupName = $data['groupName'];
    $id = $_GET['id'];

    $result = $conn->query("UPDATE $tbName SET groupName='$groupName',`name`='$name' WHERE educationId='$id'");

    if ($result) {
        echo json_encode(array('messages' => 'education update successfully'));
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $result = $conn->query("DELETE FROM $tbName WHERE educationId='$id'");
    if ($result) {
        echo json_encode(array('messages' => 'education delete successfully'));
    }
}

// Close the database connection
$conn->close();
