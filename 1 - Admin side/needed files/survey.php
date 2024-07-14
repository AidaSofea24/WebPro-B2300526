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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['fullName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sad = $_POST['sad'];
    $anxious = $_POST['anxious'];
    $hopeless = $_POST['hopeless'];
    $enjoying = $_POST['enjoying'];
    $irritable = $_POST['irritable'];
    $sleep = $_POST['sleep'];
    $tired = $_POST['tired'];
    $concentrating = $_POST['concentrating'];
    $symptoms = $_POST['symptoms'];
    $appetite = $_POST['appetite'];
    $withdrawn = $_POST['withdrawn'];
    $conflicts = $_POST['conflicts'];
    $substances = $_POST['substances'];
    $overwhelmed = $_POST['overwhelmed'];
    $confident = $_POST['confident'];
    $additional = $_POST['additional'];
    $treatment = $_POST['treatment'];
    $treatment_details = $_POST['treatmentDetails'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO mh_survey (student_id, age, gender, email, phone, sad, anxious, hopeless, enjoying, irritable, sleep, tired, concentrating, symptoms, appetite, withdrawn, conflicts, substances, overwhelmed, confident, additional, treatment, treatment_details, rating) VALUES ('$student_id', '$age', '$gender', '$email', '$phone', '$sad', '$anxious', '$hopeless', '$enjoying', '$irritable', '$sleep', '$tired', '$concentrating', '$symptoms', '$appetite', '$withdrawn', '$conflicts', '$substances', '$overwhelmed', '$confident', '$additional', '$treatment', '$treatment_details', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
