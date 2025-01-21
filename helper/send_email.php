<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require_once __DIR__ . '/../vendor/autoload.php';

function sendEmailToDonor($recipientEmail, $recipientName, $requesterName, $requesterPhone, $bloodType, $message, $location, $urgency)
{
    $mail = new PHPMailer(true);

    try {
        $requestLink = "<?= ROOT_URL ?>user/receivedRequest.php";
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
                            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f9f9f9;'>
                                <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
                                    <h3 style='color: #d9534f; font-size: 24px; margin-bottom: 20px; text-align: center;'>Hello, $recipientName</h3>
                                    <p style='font-size: 16px; margin-bottom: 15px; text-align: center; font-weight: 600;'>You have received a new blood donation request:</p>
                                    <div style='font-size: 16px; margin-bottom: 10px; display: flex; justify-content: space-between; margin-right: 8rem; margin-left: 8rem;'>
                                        <strong style='color: #333;'>Requester:</strong> $requesterName
                                    </div>
                                    <div style='font-size: 16px; margin-bottom: 10px; display: flex; justify-content: space-between; margin-right: 8rem; margin-left: 8rem;'>
                                        <strong style='color: #333;'>Phone:</strong> $requesterPhone
                                    </div>
                                    <div style='font-size: 16px; margin-bottom: 10px; display: flex; justify-content: space-between; margin-right: 8rem; margin-left: 8rem;'>
                                        <strong style='color: #333;'>Blood Type:</strong> $bloodType
                                    </div>
                                    <div style='font-size: 16px; margin-bottom: 10px; display: flex; justify-content: space-between; margin-right: 8rem; margin-left: 8rem;'>
                                        <strong style='color: #333;'>Urgency:</strong> $urgency
                                    </div>
                                    <div style='font-size: 16px; margin-bottom: 10px; display: flex; justify-content: space-between; margin-right: 8rem; margin-left: 8rem;'>
                                        <strong style='color: #333;'>Location:</strong> $location
                                    </div>
                                    <div style='font-size: 16px; margin-bottom: 10px; display: flex; justify-content: space-between; margin-right: 8rem; margin-left: 8rem;'>
                                        <strong style='color: #333;'>Message:</strong> $message
                                    </div>
                                <div style='text-align: center; margin-top: 20px;'>
                                        <a href='$requestLink' style='display: inline-block; background-color: #d9534f; color: #ffffff; text-decoration: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; width: 60%'>View Request</a>
                                    </div>
                                    <p style='font-size: 14px; color: #666; margin-bottom: 0px;margin-top: 50px; text-align: center;'>Thank you for your support!</p>
                                    <p style='font-size: 14px; color: #999; text-align: center;margin:0;'>Sended by <strong style='color: #d9534f;'>BloodBond</strong></p>
                                </div>
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


function sendEmailToRequester($email, $requesterName, $donor_name, $donor_phone, $bloodType, $message, $location, $urgency, $status)
{
    // PHPMailer setup
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'mail.digixsolve.com';  // Specify the SMTP server
        $mail->SMTPAuth = true;               // Enable SMTP authentication
        $mail->Username = 'support@digixsolve.com'; // SMTP username
        $mail->Password = 'Shahed@420'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        $mail->setFrom('support@digixsolve.com', 'Blood Donation System'); // Sender's email
        $mail->addAddress($email, $requesterName); // Add recipient's email

        // Set the subject based on status
        if ($status === 'accepted') {
            $mail->Subject = "Blood Request Accepted";
            $mail->isHTML(true); // Set email format to HTML
            $mail->Body = "
                <html>
                    <head>
                        <title>Blood Request Accepted</title>
                    </head>
                    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f9f9f9;'>
                        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
                            <h3 style='color: #5cb85c; font-size: 24px; margin-bottom: 20px; text-align: center;'>Request Accepted</h3>
                            <p style='font-size: 16px; margin-bottom: 15px; text-align: center;'>Hello, $requesterName</p>
                            <p style='font-size: 16px; margin-bottom: 15px; text-align: center;'>Your blood donation request has been accepted by $donor_name. They will contact you shortly.</p>
                            <div style='font-size: 16px; margin-bottom: 10px; text-align: center; padding: 10px; background-color: #f5f5f5; border-radius: 5px;'>
                                <p><strong>Donor Name:</strong> $donor_name</p>
                                <p><strong>Donor Phone:</strong> $donor_phone</p>
                            </div>
                            <p style='font-size: 14px; color: #666; margin-top: 30px; text-align: center;'>Thank you for using <strong style='color: #5cb85c;'>BloodBond</strong>.</p>
                        </div>
                    </body>
                </html>
            ";
        } elseif ($status === 'rejected') {
            $mail->Subject = "Blood Request Rejected";
            $mail->isHTML(true); // Set email format to HTML
            $mail->Body = "
                <html>
                    <head>
                        <title>Blood Request Rejected</title>
                    </head>
                    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f9f9f9;'>
                        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
                            <h3 style='color: #d9534f; font-size: 24px; margin-bottom: 20px; text-align: center;'>Request Rejected</h3>
                            <p style='font-size: 16px; margin-bottom: 15px; text-align: center;'>Hello, $requesterName</p>
                            <p style='font-size: 16px; margin-bottom: 15px; text-align: center;'>We regret to inform you that your blood donation request has been declined by $donor_name.</p>
                            <p style='font-size: 16px; margin-bottom: 15px; text-align: center;'>You can create a new request or search for other donors on <strong style='color: #d9534f;'>BloodBond</strong>.</p>
                            <p style='font-size: 14px; color: #666; margin-top: 30px; text-align: center;'>Thank you for using <strong style='color: #d9534f;'>BloodBond</strong>.</p>
                        </div>
                    </body>
                </html>
            ";
        }

        // Send the email
        $mail->send();
    } catch (Exception $e) {
        // Handle error if email fails to send
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendWelcomeEmail($recipientEmail, $recipientName)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'mail.digixsolve.com';  // SMTP server address (adjust as necessary)
        $mail->SMTPAuth = true;
        $mail->Username = 'support@digixsolve.com';  // SMTP username
        $mail->Password = 'Shahed@420';  // SMTP password (consider using environment variables)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set sender and recipient details
        $mail->setFrom('support@digixsolve.com', 'Blood Donation System');
        $mail->addReplyTo('support@digixsolve.com', 'Blood Donation System');
        $mail->addAddress($recipientEmail, $recipientName);

        // Set email content (HTML)
        $mail->isHTML(true);
        $mail->Subject = "Welcome to BloodBond!";

        $mail->Body = "
        <html>
            <head>
                <title>Welcome to BloodBond</title>
            </head>
            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f9f9f9;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #ddd; padding: 20px; border-radius: 8px;'>
                    <h3 style='color: #5cb85c; font-size: 24px; margin-bottom: 20px; text-align: center;'>Welcome, $recipientName!</h3>
                    <p style='font-size: 16px; margin-bottom: 15px; text-align: center;'>Thank you for joining <strong style='color: #5cb85c;'>BloodBond</strong>, the platform that connects blood donors and recipients to save lives. We're thrilled to have you as part of our community.</p>

                    <p style='font-size: 16px; margin-bottom: 20px; text-align: center;'>As a registered member, you can now:</p>
                    <ul style='font-size: 16px; margin-bottom: 20px; color: #555;'>
                        <li><strong>Request Blood</strong> when in need of urgent blood donations.</li>
                        <li><strong>Donate Blood</strong> to help those in need.</li>
                        <li><strong>Stay Updated</strong> on blood donation events in your area.</li>
                    </ul>

                    <p style='font-size: 16px; margin-bottom: 15px; text-align: center;'>Your registration was successful, and your account is now ready to use.</p>

                    <div style='text-align: center; margin-top: 30px;'>
                        <a href='http://yourdomain.com/login' style='display: inline-block; background-color: #5cb85c; color: #ffffff; text-decoration: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; width: 60%'>Login to your account</a>
                    </div>

                    <p style='font-size: 14px; color: #666; margin-top: 30px; text-align: center;'>If you have any questions or need assistance, feel free to <a href='mailto:support@digixsolve.com' style='color: #5cb85c;'>contact us</a>.</p>
                    <p style='font-size: 14px; color: #999; text-align: center;margin: 0;'>Sent by <strong style='color: #5cb85c;'>BloodBond</strong></p>
                </div>
            </body>
        </html>
        ";

        // Send the email
        if (!$mail->send()) {
            $_SESSION['email_error'] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $_SESSION['email_success'] = "Welcome email has been sent successfully.";
        }
    } catch (Exception $e) {
        // Handle error if email fails to send
        $_SESSION['email_error'] = "Message could not be sent. Error: " . $mail->ErrorInfo;
    }
}
