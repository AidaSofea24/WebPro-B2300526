<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'Includes/dbcon.php';

if(isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'helpuniversitystudentcenter@gmail.com';
        $mail->Password = 'qdcy typj qcbl kzgq';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('helpuniversitystudentcenter@gmail.com', 'Help University Student Center');
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["message"];

        // Attach file if any
        if (!empty($_FILES['attachment']['tmp_name'])) {
            $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
        }

        // Determine recipients
        $recipients = $_POST['recipients'];
        if ($recipients == 'all') {
            $sql = "SELECT email FROM users_registration";
        } else {
            $user_emails = implode("','", array_map('mysqli_real_escape_string', $_POST['user_ids']));
            $sql = "SELECT email FROM users_registration WHERE email IN ('$user_emails')";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $mail->addAddress($row['email']);
            }
        }

        $mail->send();
        echo "<script>
        alert('Sent Successfully');
        document.location.href = 'adminNewsletterForm.php';
        </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
