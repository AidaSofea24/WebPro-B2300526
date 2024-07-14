<?php
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "assignment2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
