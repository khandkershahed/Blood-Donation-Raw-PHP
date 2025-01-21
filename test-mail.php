<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Use SMTP
    $mail->isSMTP();

    // Gmail SMTP server
    $mail->Host = 'mail.digixsolve.com';
    // $mail->Host = 'smtp.gmail.com';

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // Use your Gmail address and App password (generated from Google account)
    // $mail->Username = 'dev1.ngenit@gmail.com'; // Your Gmail address
    $mail->Username = 'support@digixsolve.com'; // Your Gmail address
    $mail->Password = 'Shahed@420'; // App password (not regular Gmail password)
    // $mail->Password = 'nhpptnbuwvcuyrtf'; // App password (not regular Gmail password)

    // Enable TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // SMTP Port
    $mail->Port = 587;  // Use 587 for TLS

    // Sender info
    $mail->setFrom('dev1.ngenit@gmail.com', 'Blood Donation System');
    $mail->addAddress('khandkershahed23@gmail.com', 'Recipient Name');  // Replace with the recipient's address

    // Email subject and body
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email sent from PHPMailer using Gmail SMTP.';

    // Debugging output (optional)
    $mail->SMTPDebug = 2;  // Show debug output

    // Send the email
    if ($mail->send()) {
        echo 'Message sent successfully.';
    } else {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}
