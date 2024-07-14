<?php
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "assignment2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings
$sql = "SELECT * FROM bookings"; // Adjust the table name as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Duration</th>
                    <th>Therapist Gender</th>
                    <th>Room</th>
                    <th>Actions</th>
                    <th>Date</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['date']}</td>
                <td>{$row['time']}</td>
                <td>{$row['duration']}</td>
                <td>{$row['therapist_gender']}</td>
                <td>{$row['room']}</td>
                <td>
                    <form method='POST' action='delete_booking.php' style='display:inline-block;'>
                        <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                        <button type='submit'>Delete</button>
                    </form>
                    <form method='GET' action='edit_booking.php' style='display:inline-block;'>
                        <input type='hidden' name='booking_id' value='{$row['booking_id']}'>
                        <button type='submit'>Edit</button>
                    </form>
                </td>
              </tr>";
    }
    echo '</tbody>
          </table>';
} else {
    echo "No bookings found.";
}

$conn->close();
?>
