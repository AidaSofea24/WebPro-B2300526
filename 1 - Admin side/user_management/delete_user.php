<?php
include('../includes/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch the student ID before deletion
    $fetchSql = "SELECT student_id FROM users_registration WHERE ID = $id";
    $result = $conn->query($fetchSql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentID = $row['student_id'];
        
        // Delete the user
        $deleteSql = "DELETE FROM users_registration WHERE ID = $id";
        if ($conn->query($deleteSql) === TRUE) {
            echo "<script>alert('User with ID of $studentID has been deleted successfully'); window.location.href='../list_user.php';</script>";
        } else {
            echo "Error: " . $deleteSql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('User not found'); window.location.href='../list_user.php';</script>";
    }
}

$conn->close();
?>
