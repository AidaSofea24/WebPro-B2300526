<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail-> Host = "smtp.gmail.com";
    $mail-> Username = "bernyleo.janthonius@gmail.com";
    $mail-> Password = "ssxp jjaj sbrt rxwb";

    $mail-> SMTPSecure = "tls";
    $mail-> Port = 587;

    $mail-> setFrom("",$name);
    $mail-> addAddress($email);

    $mail-> isHTML(true);
    $mail-> Subject = "Email verification for New Student Register from HELP Student Service Center";

    $email_template = "
    <h2>You have r</h2>
    <h5>Verify your email address to Login with the below given link</h5>
    <br/><br/>
    <a href='http://localhost/asaimen/verify-email.php?token=$verify_token'> Click Me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}


if(isset($_POST['register_btn']))
{
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    sendemail_verify("$name", "$email", "$verify_token");
    echo "sent or not? ";

    // //Email exists or not
    // $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    // $check_email_query_run = mysqli_query($con, $check_email_query);

    // if(mysqli_num_rows($check_email_query_run)>0)
    // {
    //     $_SESSION['status'] = "Email has already exists";
    //     header("Location: register.php");
    // }
    // else
    // {
    //     //Register new user
    //     $query = "INSERT INTO users (name, student_id, email, password, verify_token) VALUES ('$name','$student_id','$email','$password','$verify_token')";
    //     $query_run = mysqli_query($con, $query);

    //     if($query_run)
    //     {
    //         sendemail_verify("$name", "$email", "$verify_token");
    //         $_SESSION['status'] = "Registration Successful! Please verify your Email Address";
    //         header("location: register.php");
    //     }
    //     else
    //     {
    //         $_SESSION['status'] = "Registration Failed";
    //         header("location: register.php");
    //     }
    // }
}

?>