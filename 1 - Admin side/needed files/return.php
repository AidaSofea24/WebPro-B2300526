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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id_return'];

    // Update book status to not borrowed
    $update_sql = "UPDATE books SET isBorrowed = 0 WHERE book_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $book_id);
    if ($stmt->execute()) {
        echo "Book returned successfully!";
    } else {
        echo "Error returning the book: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
