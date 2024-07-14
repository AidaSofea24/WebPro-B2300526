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

// Retrieve form data
$data = json_decode(file_get_contents('php://input'), true);
$bookId = $data['bookId'];

// Delete book from database
$sql = "DELETE FROM books WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
