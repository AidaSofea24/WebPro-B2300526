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
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $topic = htmlspecialchars($_POST["topic"]);
    $description = htmlspecialchars($_POST["description"]);
    $option1 = htmlspecialchars($_POST["option1"]);
    $option2 = htmlspecialchars($_POST["option2"]);
    $option3 = htmlspecialchars($_POST["option3"]);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO poll (firstName, lastName, topic, description, option1, option2, option3) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssssss", $firstName, $lastName, $topic, $description, $option1, $option2, $option3);

    // Execute statement
    if ($stmt->execute()) {
        echo "Thank you " . $firstName . " " . $lastName . ", you have started a poll with topic " . $topic . "";
        echo "<script>
                alert('Thank you " . $firstName . " " . $lastName . ", you have started a poll with topic " . $topic . "');
                window.location.href = 'student-feedbackMainPage.php';
            </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
} else {
    header("Location: ../student-feedbackMainPage.php");
}

$conn->close();
?>
