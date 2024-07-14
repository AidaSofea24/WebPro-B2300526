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

// Fetching JSON data from POST request
$json = file_get_contents('php://input');
$data = json_decode($json);

$student_id = $data->student_id;
$gender = $data->gender;
$qualification = $data->qualification;
$date = $data->date;
$time = $data->time;
$status = $data->status;

// SQL to insert data into bookings table
$sql = "INSERT INTO bookings (student_id, gender, qualification, date, time, status)
VALUES ('$student_id', '$gender', '$qualification', '$date', '$time', '$status')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("message" => "Booking successful"));
} else {
    echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
}

$conn->close();
?>

