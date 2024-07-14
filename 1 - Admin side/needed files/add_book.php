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
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $image = $_FILES["image"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    // Check if uploads directory exists, if not create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Upload image
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO books (title, genre, image) VALUES ('$title', '$genre', '$image')";

        if ($conn->query($sql) === TRUE) {
            echo "New book added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
