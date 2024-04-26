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
    $sector = $_POST['sector'];
    $services = $_POST['services'];
    $current_timestamp = time();

    $formatted_date_time = date('d-m-Y H:i:s', $current_timestamp);
    $sub="New Contact Form Submission " . $formatted_date_time;
    try {
        // Set SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'web@tisecon.com'; // Your Gmail SMTP username
        $mail->Password = 'vica scri vtlx kvgd'; // Your Gmail SMTP password
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl'; // Enable SSL encryption

        // Set email details
        $mail->setFrom('web@tisecon.com', 'TISE Consultant Management'); // Sender's email and name
        $mail->addAddress('info@tisecon.com', 'Info'); // Recipient's email and name
        $mail->Subject = $sub;
        $message = "<p>Dear Admin,</p>";
        $message .= "<p>A new contact form submission has been received through our website. Here are the details provided by the user:</p>";
        
        $message .= "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
        $message .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        $message .= "<p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>";
        $message .= "<p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>";
        $message .= "<p><strong>Sector:</strong> " . htmlspecialchars($sector) . "</p>";
        $message .= "<p><strong>Service:</strong> " . htmlspecialchars($services) . "</p>";
        $message .= "<p>Please take appropriate action and respond to the user's inquiry or message as soon as possible.<br><br>Best regards,<br><b>TISE Consultant Management</b></p>";

        $mail->isHTML(true);
        $mail->Body = $message;
        // $mail->Body = $msg;

        // Send email
        if($mail->send()) {
            // echo 'Message has been sent';
            header("Location: index.html?mail-status-successfully");
        } else {
            // echo 'Message could not be sent. Error: ' . $mail->ErrorInfo;
            header("Location: index.html?mail-status-failed");
        }
    } catch (Exception $e) {
        // echo 'Message could not be sent. Error: ' . $mail->ErrorInfo;
        header("Location: index.html?mail-status-failed");
      }
}
?>
