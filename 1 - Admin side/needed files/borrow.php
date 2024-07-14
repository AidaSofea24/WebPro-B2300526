<?php
include 'db.connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $book_title = $_POST['book_title'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO borrows (student_id, book_title, borrow_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $student_id, $book_title);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Book borrowed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
