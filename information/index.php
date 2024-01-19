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


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM informations");

    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode($users);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $subname = $data['subname'];
    $sources = $data['sources'];
    $detail = $data['detail'];
    $informationName = $data['informationName'];
    $fileType = $data['fileType'];
    $poster = $data['poster'];
    $groupName = $data['groupName'];


    $sql = "INSERT INTO informations (`subname`, `sources`, `detail`, `informationName`, `fileType`,`poster`,`groupName`)
                              VALUES ('$subname', '$sources','$detail','$informationName','$fileType','$poster','$groupName')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'created informations'));
    } else {
        echo json_encode(array('error' => $conn->error));
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $data = json_decode(file_get_contents('php://input'), true);
    $id = $_GET['id'];
    $detail = $data['detail'];
    $informationName = $data['informationName'];


    $sql = "UPDATE informations SET `detail`='$detail',`informationName`='$informationName' WHERE informationId='$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'update informations'));
    } else {
        echo json_encode(array('error' => $conn->error));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $id = $_GET['id'];
    $sql = "DELETE FROM informations  WHERE informationId='$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'delete informations success'));
    } else {
        echo json_encode(array('error' => $conn->error));
    }
}

// Close the database connection
$conn->close();
