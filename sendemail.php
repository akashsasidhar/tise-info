<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance of PHPMailer; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Check if the form is submitted
if(isset($_POST['username'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];

    try {
        // Set SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'infoclubgnc2020@gmail.com'; // Your Gmail SMTP username
        $mail->Password = 'tfsr oqlp ykzc gjvi'; // Your Gmail SMTP password
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl'; // Enable SSL encryption

        // Set email details
        $mail->setFrom($email, $name); // Sender's email and name
        $mail->addAddress('charmingakash36@gmail.com', 'Admin'); // Recipient's email and name
        $mail->Subject = $subject;
        $mail->Body = $msg;

        // Send email
        if($mail->send()) {
            echo 'Message has been sent';
        } else {
            echo 'Message could not be sent. Error: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo 'Message could not be sent. Error: ' . $mail->ErrorInfo;
    }
}
?>
