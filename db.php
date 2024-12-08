<?php 
$hostname = "localhost";
$username = "root";
$password = "devola3465";
$database = "db_prak";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>