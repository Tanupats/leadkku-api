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



if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $data = json_decode(file_get_contents('php://input'), true);
    $id = $_GET['id'];
    $sources = $data['sources'];
    
    $sql = "UPDATE informations SET `sources`='$sources' WHERE informationId='$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'updateFile informations'));
    } else {
        echo json_encode(array('error' => $conn->error));
    }
}


// Close the database connection
$conn->close();


?>