<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php';

function sendEmailToDonor($recipientEmail, $recipientName, $requesterName, $requesterPhone, $bloodType, $message, $location, $urgency)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        // $mail->Host = 'smtp-relay.brevo.com'; // Gmail SMTP server
        // $mail->SMTPAuth = true;
        // $mail->Username = '83f8c2001@smtp-brevo.com'; // Your Gmail address
        // $mail->Password = 'sHvMPqD9jWtAxa2g'; // App password generated from Google
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
        // $mail->Port = 587; // Port for TLS encryption (587)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = 'dev1.ngenit@gmail.com'; // Your Gmail address
        $mail->Password = 'nhpptnbuwvcuyrtf'; // App password generated from Google
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
        // $mail->Port = 465; // Port for TLS encryption (587)

        // Sender and recipient information
        $mail->setFrom('blooddonation@gmail.com', 'Blood Donation System');
        $mail->addAddress($recipientEmail, $recipientName); // Recipient's email

        // Email content (HTML)
        $mail->isHTML(true);
        $mail->Subject = "New Blood Donation Request"; // Subject of the email
        $mail->Body = "
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

        // Enable debugging to catch any SMTP issues
        $mail->SMTPDebug = 2; // Set to 2 for detailed debug output (can change to 0 for no debug output)
        $mail->Debugoutput = function ($str, $level) {
            $_SESSION['email_error'] = $str; // Save debug output to session
        };

        // Attempt to send the email
        if (!$mail->send()) {
            $_SESSION['email_error'] = "Mailer Error: " . $mail->ErrorInfo;  // Store PHPMailer error in session
        } else {
            $_SESSION['email_success'] = "Email has been sent successfully.";  // Successful email
        }
    } catch (Exception $e) {
        $_SESSION['email_error'] = "Message could not be sent. Error: " . $mail->ErrorInfo;  // Catch and store exception
    }
}
