<?php
// Include the database connection file
// Set the content type to JSON
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: http://localhost:5173/');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header("HTTP/1.1 200 OK");
die();
}

include '../dbcon.php';



// Handle POST request for creating a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $data = json_decode(file_get_contents('php://input'), true);
    $systemName = $data['systemName'];
    $email = $data['email'];
    $password = md5($data['password']);
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password' AND systemName='$systemName'");

    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    if ($result) {
        echo json_encode($users);
    } else {
        echo json_encode($users);
    }
}
// Close the database connection
$conn->close();
