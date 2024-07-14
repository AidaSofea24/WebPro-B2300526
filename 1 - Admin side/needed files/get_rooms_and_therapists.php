<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rooms = [];
$therapists = [];

$roomSql = "SELECT id, room_name AS name FROM rooms";
$therapistSql = "SELECT id, therapist_name AS name FROM therapists";

$roomResult = $conn->query($roomSql);
$therapistResult = $conn->query($therapistSql);

if ($roomResult->num_rows > 0) {
    while($row = $roomResult->fetch_assoc()) {
        $rooms[] = $row;
    }
}

if ($therapistResult->num_rows > 0) {
    while($row = $therapistResult->fetch_assoc()) {
        $therapists[] = $row;
    }
}

$response = [
    'rooms' => $rooms,
    'therapists' => $therapists
];

echo json_encode($response);

$conn->close();
?>
