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

$date = $_GET['date'];
$room = $_GET['room']; // You may need to pass room as a query parameter

$sql = "SELECT time, duration FROM library_bookings WHERE date = ? AND room = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $date, $room);
$stmt->execute();
$result = $stmt->get_result();

$unavailableTimes = [];
while ($row = $result->fetch_assoc()) {
    $start = new DateTime($row['time']);
    $end = clone $start;
    $end->add(new DateInterval('PT' . $row['duration'] . 'H'));
    while ($start < $end) {
        $unavailableTimes[] = $start->format('H:i');
        $start->add(new DateInterval('PT1H'));
    }
}

// Generate all possible times for the day
$availableTimes = [];
$startTime = new DateTime('00:00');
$endTime = new DateTime('23:00');
while ($startTime <= $endTime) {
    $timeStr = $startTime->format('H:i');
    if (!in_array($timeStr, $unavailableTimes)) {
        $availableTimes[] = $timeStr;
    }
    $startTime->add(new DateInterval('PT1H'));
}

$response = [
    'availableTimes' => $availableTimes,
    'unavailableTimes' => $unavailableTimes
];

echo json_encode($response);

$conn->close();
?>
