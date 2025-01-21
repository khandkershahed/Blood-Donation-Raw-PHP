<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Set mailer to use SMTP
    $mail->isSMTP();

    // SMTP server configuration
    $mail->Host = 'mail.digixsolve.com';  // Your SMTP server address (change this as needed)
    $mail->SMTPAuth = true;
    $mail->Username = 'support@digixsolve.com';  // SMTP username (your email address)
    $mail->Password = 'Shahed@420';  // App password (or regular password if not using two-factor auth)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable STARTTLS encryption
    $mail->Port = 587;  // Port 587 for TLS

    // Set the "From" address and name
    $mail->setFrom('support@digixsolve.com', 'Blood Donation System');  // The sending email address and name
    $mail->addReplyTo('support@digixsolve.com', 'Blood Donation System');  // Set Reply-To address

    // Add recipient email address
    $mail->addAddress('khandkershahed23@gmail.com', 'Recipient Name');  // Replace with the recipient's email

    // Set email subject and body
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent from PHPMailer using custom SMTP server (digixsolve.com).';

    // Enable verbose debug output (set level to 3 for maximum debug info)
    $mail->SMTPDebug = 3;  // Level 3 for more detailed SMTP output (show conversation between client and server)

    // Send the email
    if ($mail->send()) {
        echo 'Message sent successfully.';
    } else {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    // Catch and display errors
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
