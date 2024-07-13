<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$servername = "localhost"; // replace with your database host
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "bit102db"; // replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST["send"])) {
    $email = $_POST["email"];
    $email = mysqli_real_escape_string($conn, $email);

    // Check if email exists
    $sql = "SELECT * FROM users_registration WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id']; // Assuming you have an ID column

        $resetLink = "http://localhost/2%20-%20Login/Forget%20Password/update_password.php?email=$email";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bernyleo.janthonius@gmail.com';
        $mail->Password = 'ssxp jjaj sbrt rxwb';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('bernyleo.janthonius@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = "Click <a href='$resetLink'>here</a> to reset your password.";

        $mail->send();

        echo "<script>
        alert('Reset link sent successfully to $email');
        document.location.href = '../index.html';
        </script>";
    } else {
        echo "<script>
        alert('Email does not exist.');
        document.location.href = '../index.html';
        </script>";
    }
}
?>
