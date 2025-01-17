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
    if (isset($_POST['booking_id'])) {
        $booking_id = $_POST['booking_id'];

        // Prepare the SQL delete statement
        $sql = "DELETE FROM bookings WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $booking_id);

        if ($stmt->execute()) {
            echo "Booking deleted successfully.";
        } else {
            echo "Error deleting booking: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "No booking ID provided.";
    }
}

$conn->close();
?>
