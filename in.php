<?php
$servername = "localhost";
$username   = "root";
$password   = "root";   // যদি password না থাকে, "" দিন
$db_name    = "voting_system";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>