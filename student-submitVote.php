<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BIT102";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$studentID = $_POST['studentID'];
$pollID = $_POST['pollID'];
$voteOption = $_POST['voteOption'];

// Debug output
var_dump($_POST); // 检查接收到的数据

if (empty($voteOption)) {
    echo "<script>
    alert('Vote option is empty.');
    </script>";
    exit();
}

// Insert vote result
$sql = "INSERT INTO voteResult (studentID, pollID, voteOption, voteTime) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $studentID, $pollID, $voteOption);

if ($stmt->execute()) {
    echo "<script>
        alert('Vote submitted successfully.');
        window.location.href = 'student-feedbackMainPage.php';
    </script>";
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
