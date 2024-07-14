<?php
session_start();
include('../1 - Admin side/Includes/dbcon.php');


$userID = strtoupper($_POST['userID']);  
$password = $_POST['password'];  

// Validate the length of the userID
if (strlen($userID) > 8) {
    echo "<script>
    alert('Login failed. User ID cannot exceed 8 characters.');
    window.location.href = 'index.html';
    </script>";
    exit();
}

// to prevent from mysqli injection  
$userID = stripcslashes($userID);  
$password = stripcslashes($password);  
$userID = mysqli_real_escape_string($conn, $userID);  
$password = mysqli_real_escape_string($conn, $password);  

$sql = "SELECT * FROM users_registration WHERE student_id = '$userID'";  
$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$count = mysqli_num_rows($result);  

if($count == 1 && password_verify($password, $row['password'])){  
    $_SESSION['user_id'] = $row['ID'];
    $_SESSION['student_id'] = $row['student_id']; //updated?
    
    if($row['role'] == 'admin') {
        echo "<script>
        alert('Login successful. Admin side');
        window.location.href = '../1 - Admin side/index.php';
        </script>";
    } else {
        echo "<script>
        alert('Login successful. User side');
        window.location.href = 'index.html';
        </script>";
    }
    exit();
} else {
    echo "<script>
    alert('Login failed. Invalid username or password.');
    window.location.href = 'index.html';
    </script>";
}     
?>  
