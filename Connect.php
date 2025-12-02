<?php
$host = "localhost"; 
$user = "root";      
$pass = "";          
$db = "van_go"; 


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);

} else {

    echo " connection Successful"; 
}


?>
