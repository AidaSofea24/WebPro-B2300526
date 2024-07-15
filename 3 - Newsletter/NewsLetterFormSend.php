<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'dbcon.php';  // Include the database connection file

if (isset($_POST["send"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
        alert('Invalid Email Address');
        document.location.href = 'NewsletterForm.html';
        </script>";
        exit();
    }

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT email FROM users_registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "<script>
        alert('Email does not exist in the database');
        document.location.href = 'NewsletterForm.html';
        </script>";
        exit();
    }

    $stmt->close();

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
        document.location.href = 'NewsletterForm.html';
        </script>";
    } catch (Exception $e) {
        echo "<script>
        alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
        document.location.href = 'NewsletterForm.html';
        </script>";
    }
}
?>