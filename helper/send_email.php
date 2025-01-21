<!-- 

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
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ]; -->
// $mail->Host = 'smtp-relay.brevo.com'; // Gmail SMTP server
// $mail->SMTPAuth = true;
// $mail->Username = '83f8c2001@smtp-brevo.com';
// $mail->Password = 'sHvMPqD9jWtAxa2g';
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
// $mail->Port = 587; // Port for TLS encryption (587)

// $mail->Password = '#Ih0YM7eTIUT';
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
// $mail->Port = 465; // Port for TLS encryption (587)
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
// $mail->Host = 'smtp.gmail.com';
// $mail->Port = 587;
// $mail->SMTPAuth = true;
// $mail->Username = 'dev1.ngenit@gmail.com';
// $mail->Password = 'nhpptnbuwvcuyrtf';
// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
// $mail->Port = 465; // Port for TLS encryption (587)

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

        // Set timeout to 60 seconds
        $mail->Timeout = 180;

        // Enable debugging to catch any SMTP issues
        $mail->SMTPDebug = 2;  // Set to 2 for detailed debug output (can change to 0 for no debug output)
        $mail->Debugoutput = function ($str, $level) {
            echo "Debug output: $str\n";  // Print debug output directly
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
