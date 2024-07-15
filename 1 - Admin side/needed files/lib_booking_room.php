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

$campus = $_POST['campus'];
$room = $_POST['room'];
$date = $_POST['date'];
$time = $_POST['time'];
$duration = $_POST['duration'];

// Insert booking into database
$sql = "INSERT INTO library_bookings (campus, room, date, time, duration) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $campus, $room, $date, $time, $duration);
if ($stmt->execute()) {
    echo "Booking successful";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
