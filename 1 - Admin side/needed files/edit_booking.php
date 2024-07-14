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
        $student_id = $_POST['student_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $gender = $_POST['gender'];
        $room = $_POST['room'];
        $therapist = $_POST['therapist'];

        // Prepare the SQL update statement
        $sql = "UPDATE bookings SET student_id = ?, date = ?, time = ?, gender = ?, room_name = ?, therapist_name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssi", $student_id, $date, $time, $gender, $room, $therapist, $booking_id);

        if ($stmt->execute()) {
            echo "Booking updated successfully.";
        } else {
            echo "Error updating booking: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "No booking ID provided.";
    }
}

$conn->close();
?>
