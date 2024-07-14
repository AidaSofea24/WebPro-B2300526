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
$studentId = $data['studentId'];
$borrowDate = $data['borrowDate'];

// Fetch current status
$sql = "SELECT isBorrowed FROM books WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if ($book) {
    $isBorrowed = !$book['isBorrowed'];
    $sql = "UPDATE books SET isBorrowed = ?, studentId = ?, borrowDate = ? WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $isBorrowed, $studentId, $borrowDate, $bookId);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'isBorrowed' => $isBorrowed]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Book not found']);
}

$conn->close();
?>
