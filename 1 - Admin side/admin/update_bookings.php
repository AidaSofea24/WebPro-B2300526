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
$gender = $data->gender;
$room = $data->room;
$date = $data->date;
$time = $data->time;

// SQL to update data in bookings table
$sql = "UPDATE bookings SET gender='$gender', room='$room', date='$date', time='$time' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("message" => "Booking updated successfully"));
} else {
    echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
}

$conn->close();
?>
