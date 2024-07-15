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

$sql = "SELECT * FROM library_bookings";
$result = $conn->query($sql);

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'lib_id' => $row['lib_id'],
        'title' => "Room " . $row['room'],
        'start' => $row['date'] . "T" . $row['time'],
        'end' => date("Y-m-d\TH:i:s", strtotime($row['date'] . " " . $row['time'] . " + " . $row['duration'] . " hours")),
        'extendedProps' => [
            'campus' => $row['campus'],
            'duration' => $row['duration']
        ]
    ];
}

echo json_encode($events);

$conn->close();
?>
