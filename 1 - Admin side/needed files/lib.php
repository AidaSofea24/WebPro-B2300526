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

$sql = "SELECT book_id, title, genre, image, isBorrowed FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="book-item">';
        if ($row['image']) {
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" alt="'.$row['title'].'">';
        }
        echo '<p>'.$row['title'].' ('.$row['genre'].')</p>';
        if ($row['isBorrowed']) {
            echo '<button onclick="setReturnForm('.$row['book_id'].', \''.$row['title'].'\')">Return</button>';
        } else {
            echo '<button onclick="setBorrowForm('.$row['book_id'].', \''.$row['title'].'\')">Borrow</button>';
        }
        echo '</div>';
    }
} else {
    echo "0 results";
}
$conn->close();
?>
