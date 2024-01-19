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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    echo json_encode(array(
        'path' =>  "uploads/" . basename($_FILES["file"]["name"]),
        'messages' => 'has been uploaded'
    ));
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $path = $_GET['filename'];

    if ($path) {
        $result = unlink('../'.$path);
        if ($result) {
            echo json_encode(array('message' => 'removed file success'));
        }
    }
}
