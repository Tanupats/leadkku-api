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


    $filename = $_FILES['file'];

    // ใช้ pathinfo เพื่อดึงข้อมูลเกี่ยวกับไฟล์


    $ext = strtolower(pathinfo(basename($filename['name']),PATHINFO_EXTENSION));
    

    $newfileName = uniqid();
    $target_dir = "uploads/".$newfileName.'.'.$ext;
   
    
    $target_path  = $target_dir;

    move_uploaded_file($_FILES["file"]["tmp_name"],"../".$target_path );

    echo json_encode(array(
        'path' =>  $target_path,
        'messages' => 'file uploaded'
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
