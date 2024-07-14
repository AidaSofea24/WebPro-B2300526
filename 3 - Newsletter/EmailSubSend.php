<?php
use PHPmailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "BIT102"; 

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);
    
    $mail -> isSMTP();
    $mail -> Host = 'smtp.gmail.com'; 
    $mail -> SMTPAuth = true;
    $mail -> Username = 'helpuniversitystudentcenter@gmail.com';
    $mail -> Password = 'qdcy typj qcbl kzgq';
    $mail -> SMTPSecure = 'ssl';
    $mail -> Port = 465;

    $mail->setFrom('helpuniversitystudentcenter@gmail.com', 'Help University Student Center');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];

    $mail->send();

    echo "<script>
    alert('Sent Successfully');
    document.location.href = 'emailSub.php';
    </script>
    ";
}
?> 