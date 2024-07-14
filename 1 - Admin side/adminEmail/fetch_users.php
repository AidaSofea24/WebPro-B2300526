<?php
require 'Includes/dbcon.php';

$sql = "SELECT ID, email FROM users_registration";
$result = mysqli_query($conn, $sql);
$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

header('Content-Type: application/json');
echo json_encode(['users' => $users]);
?>