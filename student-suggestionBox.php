<?php

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO suggestionBox (name, email, message) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute statement
    if ($stmt->execute()) {
        echo "<script>
                alert('Thank you " . $name . ", we have received your feedback about " . $message . " !');
                window.location.href = 'student-feedbackMainPage.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
} else {
    if (!headers_sent()) {
        header("Location: ../student-feedbackMainPage.php");
        exit();
    }
}

// Fetching suggestions
$sql = "SELECT * FROM suggestionBox";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
}

$conn->close();
?>