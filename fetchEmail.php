<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'C:\\xampp\\phpMyAdmin\\vendor\\autoload.php'; // Adjust the path if needed


$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vipin2slce390@gmail.com'; // Your Gmail address
    $mail->Password = '123456789@vipin'; // Your app password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('vipin2slce390@gmail.com', 'Your Name'); // Your name
    $mail->addAddress('dudewayanad320@example.com'); // Recipient's email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body    = 'This is a test email for password reset.';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
