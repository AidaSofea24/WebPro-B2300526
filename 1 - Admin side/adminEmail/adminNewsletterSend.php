<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'dbcon.php';

if (isset($_POST["send_newsletter"])) {
    $send_to = $_POST["send_to"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $attachment = $_FILES["attachment"]["tmp_name"];
    $attachment_name = $_FILES["attachment"]["name"];

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'helpuniversitystudentcenter@gmail.com';
    $mail->Password = 'qdcy typj qcbl kzgq';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('helpuniversitystudentcenter@gmail.com', 'Help University Student Center');
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($attachment) {
        $mail->addAttachment($attachment, $attachment_name);
    }

    $recipients = [];
    if ($send_to === "all") {
        $result = $conn->query("SELECT email FROM users_registration");
        while ($row = $result->fetch_assoc()) {
            $recipients[] = $row['email'];
        }
    } else {
        $specific_email = filter_var($_POST["specific_email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($specific_email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
            alert('Invalid Email Address');
            document.location.href = 'NewsletterForm.html';
            </script>";
            exit();
        }
        $result = $conn->query("SELECT email FROM users_registration WHERE email='$specific_email'");
        if ($result->num_rows > 0) {
            $recipients[] = $specific_email;
        } else {
            echo "<script>
            alert('Student email does not exist');
            document.location.href = 'adminNewsletterForm.html';
            </script>";
            exit();
        }
    }

    foreach ($recipients as $recipient) {
        $mail->addAddress($recipient);
    }

    try {
        $mail->send();
        echo "<script>
        alert('Newsletter Sent Successfully');
        document.location.href = 'adminNewsletterForm.html';
        </script>";
    } catch (Exception $e) {
        echo "<script>
        alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
        document.location.href = 'adminNewsletterForm.html';
        </script>";
    }
}
?>
