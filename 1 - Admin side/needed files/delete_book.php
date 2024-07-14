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

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);

    $sql = "DELETE FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);

    if ($stmt->execute()) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false, "error" => $stmt->error);
    }

    $stmt->close();
} else {
    $response = array("success" => false, "error" => "Invalid ID");
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
