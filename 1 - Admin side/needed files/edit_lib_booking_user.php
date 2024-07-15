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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['lib_id'];
    $campus = $_POST['campus'];
    $room = $_POST['room'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $duration = $_POST['duration'];

    $sql = "UPDATE library_bookings SET campus = ?, room = ?, date = ?, time = ?, duration = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $campus, $room, $date, $time, $duration, $lib_id);

    if ($stmt->execute()) {
        echo "Booking updated successfully.";
    } else {
        echo "Error updating booking: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
