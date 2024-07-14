<?php
// session_check.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../2 - Login/index.html");
    exit();
}
?>