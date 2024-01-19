<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Handle GET request for fetching all users
if ($_SERVER['REQUEST_METHOD'] === 'GET') {


    echo json_encode(array('message' => 'Leadkku-service ver 0.1'));
}
