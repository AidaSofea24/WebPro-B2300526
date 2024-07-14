<?php
session_start();

// Check if the logout action is confirmed
if (isset($_GET['log_out']) && $_GET['log_out'] == 'true') {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}
?>