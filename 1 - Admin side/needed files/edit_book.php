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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST["book_id"];
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $image = $_FILES["image"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    $sql = "UPDATE books SET title='$title', genre='$genre'";

    if (!empty($image)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql .= ", image='$image'";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    $sql .= " WHERE book_id=$book_id";

    if ($conn->query($sql) === TRUE) {
        echo "Book updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
