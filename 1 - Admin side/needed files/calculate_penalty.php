<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

$bookId = $_GET['bookId'];

// Fetch borrow date
$sql = "SELECT borrowDate FROM books WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $borrowDate = new DateTime($row['borrowDate']);
    $currentDate = new DateTime();
    $interval = $borrowDate->diff($currentDate);
    $daysBorrowed = $interval->days;

    $penalty = max(0, ($daysBorrowed - 14) * 1); // Assuming 14 days borrowing period and $1 penalty per day
    echo json_encode(['penalty' => $penalty]);
} else {
    echo json_encode(['success' => false, 'error' => 'Book not found']);
}

$stmt->close();
$conn->close();
?>
