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

// Fetch bookings with related room and therapist information
$sql = "SELECT b.id AS booking_id, b.student_id, b.date, b.time, b.gender, r.room_name, t.therapist_name 
        FROM bookings b 
        LEFT JOIN booking_assignments ba ON b.id = ba.booking_id 
        LEFT JOIN rooms r ON ba.room_id = r.id 
        LEFT JOIN therapists t ON ba.therapist_id = t.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Student ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Therapist Gender</th>
                    <th>Room</th>
                    <th>Therapist</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["booking_id"] . "</td>
                <td>" . $row["student_id"] . "</td>
                <td>" . $row["date"] . "</td>
                <td>" . $row["time"] . "</td>
                <td>" . $row["gender"] . "</td>
                <td>" . $row["room_name"] . "</td>
                <td>" . $row["therapist_name"] . "</td>
                <td>
                    <button class='edit-booking' data-id='" . $row["booking_id"] . "' data-student='" . $row["student_id"] . "' data-date='" . $row["date"] . "' data-time='" . $row["time"] . "' data-gender='" . $row["gender"] . "' data-room='" . $row["room_name"] . "' data-therapist='" . $row["therapist_name"] . "'>Edit</button>
                    <form class='delete-form' method='POST'>
                        <input type='hidden' name='booking_id' value='" . $row["booking_id"] . "'>
                        <button type='submit' class='delete-booking'>Delete</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No bookings found.";
}

$conn->close();
?>

