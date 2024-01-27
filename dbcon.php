<?php

$servername = "localhost";
$username = "alllaedk_leadkku";
$password = "0983460756";
$dbname = "alllaedk_leadkku";

//$conn = new mysqli($servername, $username, $password, $dbname);
 $conn = new mysqli("localhost", "root", "", "leadkku");
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   
}


?>