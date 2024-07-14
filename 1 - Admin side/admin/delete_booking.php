<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching JSON data from POST request
$json = file_get_contents('php://input');
$data = json_decode($json);

$id = $data->id;

// SQL to delete data from bookings table
$sql = "DELETE FROM bookings WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("message" => "Booking deleted successfully"));
} else {
    echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
}

$conn->close();
?>
