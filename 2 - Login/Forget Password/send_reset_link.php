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
    $sql = "SELECT * FROM users_registration WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id']; // Assuming you have an ID column

        $resetLink = "http://localhost/bit-102/2%20-%20Login/Forget%20Password/update_password.php?email=" . urlencode($email);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'helpuniversitystudentcenter@gmail.com';
        $mail->Password = 'qdcy typj qcbl kzgq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('helpuniversitystudentcenter@gmail.com', 'Help University Student Center');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = "Click <a href='$resetLink'>here</a> to reset your password.";

        if ($mail->send()) {
            echo "<script>
            alert('Reset link sent successfully to $email, please check your email');
            document.location.href = '../index.html';
            </script>";
        } else {
            echo "<script>
            alert('Error sending email.');
            document.location.href = '../index.html';
            </script>";
        }
    } else {
        echo "<script>
        alert('Email does not exist.');
        document.location.href = '../index.html';
        </script>";
    }

    $stmt->close();
}

$conn->close();
?>
