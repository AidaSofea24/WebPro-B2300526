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

// Select all books from the database
$sql = "SELECT book_id, title, genre, image, isBorrowed, studentId, borrowDate FROM books";
$result = $conn->query($sql);

$books = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['image'] = base64_encode($row['image']); // Encode image to base64
        $books[] = $row;
    }
    echo json_encode(['success' => true, 'books' => $books]);
} else {
    echo json_encode(['success' => false, 'error' => 'No books found']);
}

$conn->close();
?>
