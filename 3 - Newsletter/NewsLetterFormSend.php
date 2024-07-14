<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
        alert('Invalid Email Address');
        document.location.href = 'emailSend.html';
        </script>";
        exit();
    }

    $subject = "Congratulations on Subscribing!";
    $message = "Hey there! Thanks for subscribing to our Newsletter! This is a great milestone for us!";

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpuniversitystudentcenter@gmail.com';
    $mail->Password = 'qdcy typj qcbl kzgq';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('helpuniversitystudentcenter@gmail.com', 'Help University Student Center');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        $mail->send();
        echo "<script>
        alert('Sent Successfully');
        document.location.href = 'NewsLetterForm.html';
        </script>";
    } catch (Exception $e) {
        echo "<script>
        alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
        document.location.href = 'NewsLetterForm.html';
        </script>";
    }
}
?>