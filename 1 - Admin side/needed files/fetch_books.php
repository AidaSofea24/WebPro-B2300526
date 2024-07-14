<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("success" => false, "error" => "Connection failed: " . $conn->connect_error)));
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $books = array();
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    $response = array("success" => true, "books" => $books);
} else {
    $response = array("success" => false, "error" => "No books found");
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
