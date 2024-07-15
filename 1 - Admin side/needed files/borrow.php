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
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    $borrow_date = date('Y-m-d');
    $return_date = date('Y-m-d', strtotime('+2 weeks'));

    // Check if the book is already borrowed
    $check_sql = "SELECT isBorrowed FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->bind_result($isBorrowed);
    $stmt->fetch();
    $stmt->close();

    if ($isBorrowed) {
        echo "The book is already borrowed.";
    } else {
        // Update book status to borrowed
        $update_sql = "UPDATE books SET isBorrowed = 1 WHERE book_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();

        // Insert borrowing record
        $insert_sql = "INSERT INTO borrows (book_id, student_id, borrowDate, returnDate) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("isss", $book_id, $student_id, $borrowDate, $returnDate);
        if ($stmt->execute()) {
            echo "Book borrowed successfully!<br>";
            echo "Student ID: $student_id<br>";
            echo "Book ID: $book_id<br>";
            echo "Borrow Date: $borrowDate<br>";
            echo "Return Date: $returnDate<br>";
            echo "Please return the book by the return date.";
        } else {
            echo "Error borrowing the book: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
