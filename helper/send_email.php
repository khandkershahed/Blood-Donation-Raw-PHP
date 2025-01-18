<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // Include the Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';
// Function to send email to the donor using Gmail SMTP
function sendEmailToDonor($recipientEmail, $recipientName, $requesterName, $requesterPhone, $bloodType, $message, $location, $urgency)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rashed.artificial@gmail.com';  // Your Gmail address
        $mail->Password = 'xscjlicjonditazt';  // App password generated from Google
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('rashed.artificial@gmail.com', 'Blood Donation System');
        $mail->addAddress($recipientEmail, $recipientName);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Blood Donation Request";
        $mail->Body    = "
            <html>
            <head>
                <title>New Blood Request</title>
            </head>
            <body>
                <h3>Hello, $recipientName</h3>
                <p>You have received a new blood donation request:</p>
                <p><strong>Requester:</strong> $requesterName</p>
                <p><strong>Phone:</strong> $requesterPhone</p>
                <p><strong>Blood Type:</strong> $bloodType</p>
                <p><strong>Urgency:</strong> $urgency</p>
                <p><strong>Location:</strong> $location</p>
                <p><strong>Message:</strong> $message</p>
            </body>
            </html>
        ";

        // Send email
        if ($mail->send()) {
            echo "Message sent successfully.";
        } else {
            echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


