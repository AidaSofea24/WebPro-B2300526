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

// Fetch survey responses
$sql = "SELECT * FROM mh_survey";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Sad</th>
                    <th>Anxious</th>
                    <th>Hopeless</th>
                    <th>Enjoying</th>
                    <th>Irritable</th>
                    <th>Sleep</th>
                    <th>Tired</th>
                    <th>Concentrating</th>
                    <th>Symptoms</th>
                    <th>Appetite</th>
                    <th>Withdrawn</th>
                    <th>Conflicts</th>
                    <th>Substances</th>
                    <th>Overwhelmed</th>
                    <th>Confident</th>
                    <th>Additional</th>
                    <th>Treatment</th>
                    <th>Treatment Details</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['student_id']}</td>
                <td>{$row['age']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['sad']}</td>
                <td>{$row['anxious']}</td>
                <td>{$row['hopeless']}</td>
                <td>{$row['enjoying']}</td>
                <td>{$row['irritable']}</td>
                <td>{$row['sleep']}</td>
                <td>{$row['tired']}</td>
                <td>{$row['concentrating']}</td>
                <td>{$row['symptoms']}</td>
                <td>{$row['appetite']}</td>
                <td>{$row['withdrawn']}</td>
                <td>{$row['conflicts']}</td>
                <td>{$row['substances']}</td>
                <td>{$row['overwhelmed']}</td>
                <td>{$row['confident']}</td>
                <td>{$row['additional']}</td>
                <td>{$row['treatment']}</td>
                <td>{$row['treatment_details']}</td>
                <td>{$row['rating']}</td>
                <td><form method='POST' action='delete_survey.php'>
                        <input type='hidden' name='survey_id' value='{$row['survey_id']}'>
                        <button type='submit'>Delete</button>
                    </form></td>
              </tr>";
    }
    echo '</tbody>
          </table>';
} else {
    echo "No survey responses found.";
}

$conn->close();
?>
