<?php
if (isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assignment2024";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute deletion query
    $query = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $booking_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Booking deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete booking.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
