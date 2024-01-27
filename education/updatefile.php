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

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $document = $data['path'];
    $id = $_GET['id'];

    $result = $conn->query("UPDATE $tbName SET document='$document' WHERE educationId='$id'");

    if ($result) {
        echo json_encode(array('messages' => 'education updateFile successfully'));
    }
}


$conn->close();
?>