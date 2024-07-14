<?php
include('includes/session_check.php');
include('includes/dbcon.php');

// Get form data
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$studentID = $_POST['student_id'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

// Static role assignment
$role = 'user';

// Check if the student ID or email already exists
$checkSql = "SELECT * FROM users_registration WHERE student_id = '$studentID' OR email = '$email'";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
    // Check if it's the student ID or email that already exists
    $existingUser = $result->fetch_assoc();
    if ($existingUser['student_id'] == $studentID) {
        echo "<script>alert('User has already been registered with this student ID.'); window.location.href='register.php';</script>";
    } else if ($existingUser['email'] == $email) {
        echo "<script>alert('User has already been registered with this email.'); window.location.href='register.php';</script>";
    }
} else {
    // Insert data into the database
    $sql = "INSERT INTO users_registration (first_name, last_name, student_id, email, password, role) 
            VALUES ('$firstName', '$lastName', '$studentID', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href='register.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
