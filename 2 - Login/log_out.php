<?php
session_start();

// Check if the logout action is confirmed
if (isset($_GET['log_out']) && $_GET['log_out'] == 'true') {
    
    // if the logout action is confirmed session is destroyed and user will log out
    session_unset();
    session_destroy();
    header("Location: index.html"); //user will be redirected back to the login page
    exit();
}
?>