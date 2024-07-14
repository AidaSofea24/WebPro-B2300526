<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bookId = $_GET['bookId'];

$sql = "SELECT borrowDate FROM books WHERE id = $bookId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$borrowDate = new DateTime($row['borrowDate']);
$currentDate = new DateTime();
$interval = $borrowDate->diff($currentDate);
$daysBorrowed = $interval->days;

$penalty = max(0, ($daysBorrowed - 14) * 1); // Assuming 14 days borrowing period and $1 penalty per day

$conn->close();

echo json_encode(['penalty' => $penalty]);
?>
