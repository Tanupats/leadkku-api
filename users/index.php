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

// Handle GET request for fetching all users
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM users");
    
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    
    echo json_encode($users);
}


// Handle POST request for creating a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = $data['name'];
    $email = $data['email'];
    $profile = $data['profile'];
    $password = md5($data['password']); 

    $role = $data['role'];
    $systemName = $data['systemName'];

    $sql = "INSERT INTO users (`name`, `email`, `profile`, `password`, `role`, `systemName`)
                        VALUES ('$name', '$email','$profile','$password','$role','$systemName')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'User created successfully'));
    } else {
        echo json_encode(array('error' => $conn->error));
    }
}
// Close the database connection
$conn->close();
?>
