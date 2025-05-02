<?php
// require_once __DIR__ . '/../config/constants.php'; // Constants file
// require_once __DIR__ . '/../config/database.php';  // Database connection
// require_once __DIR__ . '/../helper/send_email.php';  // Email sending helper
// require_once __DIR__ . '/../helper/notification.php';  // Notification helper

// // Ensure CSRF token is valid
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

//     // Sanitize POST data
//     $request_id      = isset($_POST['request_id']) ? $_POST['request_id']: null;
//     $donor_id        = $_POST['donor_id'];
//     $requester_name  = htmlspecialchars($_POST['name']);
//     $requester_phone = htmlspecialchars($_POST['phone']);
//     $requester_email = htmlspecialchars($_POST['email']);
//     $blood_type      = htmlspecialchars($_POST['blood_type']);
//     $message         = htmlspecialchars($_POST['message']);
//     $location        = htmlspecialchars($_POST['location']);
//     $urgency         = htmlspecialchars($_POST['urgency']);

//     // Fetch the requester_id from session (user's logged in ID)
//     $requester_id = $_SESSION['user_id'];

//     // Check if the requester exists in the users table
//     try {
//         $stmt = $pdo->prepare("SELECT id FROM users WHERE id = :id");
//         $stmt->bindValue(':id', $requester_id, PDO::PARAM_INT);
//         $stmt->execute();

//         // If the requester doesn't exist, display error and redirect
//         if ($stmt->rowCount() === 0) {
//             $_SESSION['error'] = "Requester not found. Please log in again.";
//             header('Location: /login.php');
//             exit();
//         }

//         if ($request_id) {
//             // Update existing request
//             $query = "UPDATE requests SET 
//                       donor_id          = :donor_id,
//                       requester_name    = :requester_name, 
//                       requester_phone   = :requester_phone, 
//                       blood_type        = :blood_type, 
//                       message           = :message, 
//                       location          = :location, 
//                       urgency           = :urgency 
//                       WHERE id          = :request_id AND requester_id = :requester_id";

//             $stmt = $pdo->prepare($query);
//             $stmt->bindValue(':request_id', $request_id, PDO::PARAM_INT);
//         } else {
//             // Insert new request
//             $query = "INSERT INTO requests (donor_id, requester_id, requester_name, requester_phone, blood_type, message, location, urgency) 
//                       VALUES (:donor_id, :requester_id, :requester_name, :requester_phone, :blood_type, :message, :location, :urgency)";

//             $stmt = $pdo->prepare($query);
//         }

//         // Bind values to the query
//         $stmt->bindValue(':donor_id', $donor_id, PDO::PARAM_INT);
//         $stmt->bindValue(':requester_id', $requester_id, PDO::PARAM_INT);
//         $stmt->bindValue(':requester_name', $requester_name, PDO::PARAM_STR);
//         $stmt->bindValue(':requester_phone', $requester_phone, PDO::PARAM_STR);
//         $stmt->bindValue(':blood_type', $blood_type, PDO::PARAM_STR);
//         $stmt->bindValue(':message', $message, PDO::PARAM_STR);
//         $stmt->bindValue(':location', $location, PDO::PARAM_STR);
//         $stmt->bindValue(':urgency', $urgency, PDO::PARAM_STR);

//         // Execute the query (either insert or update)
//         $stmt->execute();

//         // Fetch donor information to send email and notification
//         $donor_query = "SELECT email, first_name, last_name FROM users WHERE id = :donor_id";
//         $donor_stmt = $pdo->prepare($donor_query);
//         $donor_stmt->bindValue(':donor_id', $donor_id, PDO::PARAM_INT);
//         $donor_stmt->execute();
//         $donor = $donor_stmt->fetch(PDO::FETCH_ASSOC);

//         // Check if the donor exists
//         if ($donor) {
//             $donor_email = $donor['email'];
//             $donor_name = $donor['first_name'] . ' ' . $donor['last_name'];

//             // Send email notification to the donor
//             sendEmailToDonor($donor_email, $donor_name, $requester_name, $requester_phone, $blood_type, $message, $location, $urgency);

//             // Create a dashboard notification for the donor
//             $notification_message = "You have received a blood request from $requester_name for blood type $blood_type.";
//             saveNotification($donor_id, $notification_message);

//             // Redirect back with a success message
//             $_SESSION['message'] = "Your request has been successfully processed.";
//             header('Location: ' . $_SERVER['HTTP_REFERER']);
//             exit();
//         } else {
//             // Handle case where donor doesn't exist
//             $_SESSION['error'] = "Donor not found.";
//             header('Location: ' . $_SERVER['HTTP_REFERER']);
//             exit();
//         }

//     } catch (PDOException $e) {
//         // Handle database errors
//         $_SESSION['error'] = "Error: " . $e->getMessage();
//         header('Location: ' . $_SERVER['HTTP_REFERER']);
//         exit();
//     }
// } else {
//     // CSRF token mismatch or invalid request method
//     $_SESSION['error'] = "Invalid request.";
//     header('Location: ' . $_SERVER['HTTP_REFERER']);
//     exit();


require_once __DIR__ . '/../config/constants.php';      // Constants (e.g., ROOT_URL)
require_once __DIR__ . '/../config/database.php';       // Database connection
require_once __DIR__ . '/../helper/send_email.php';     // PHPMailer email functions
require_once __DIR__ . '/../helper/notification.php';   // Dashboard notification helper

session_start();

// Validate CSRF token and request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['error'] = "Invalid request or session expired.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Sanitize inputs
$request_id      = !empty($_POST['request_id']) ? (int) $_POST['request_id'] : null;
$donor_id        = (int) $_POST['donor_id'];
$requester_name  = htmlspecialchars(trim($_POST['requester_name']));
$requester_phone = htmlspecialchars(trim($_POST['requester_phone']));
$requester_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$blood_type      = htmlspecialchars(trim($_POST['blood_type']));
$message         = htmlspecialchars(trim($_POST['message']));
$location        = htmlspecialchars(trim($_POST['location']));
$urgency         = htmlspecialchars(trim($_POST['urgency']));
$status         = htmlspecialchars(trim($_POST['status']));
$requester_id    = $_SESSION['user_id'] ?? null;

if (!$requester_id) {
    $_SESSION['error'] = "Unauthorized. Please log in.";
    header('Location: /login.php');
    exit();
}

try {
    // Ensure requester exists
    $check = $pdo->prepare("SELECT id FROM users WHERE id = :id");
    $check->execute([':id' => $requester_id]);

    if ($check->rowCount() === 0) {
        $_SESSION['error'] = "Requester not found.";
        header('Location: /login.php');
        exit();
    }

    if ($request_id) {
        // Update existing request
        $sql = "UPDATE requests SET 
                    donor_id        = :donor_id,
                    requester_name  = :requester_name,
                    requester_phone = :requester_phone,
                    blood_type      = :blood_type,
                    message         = :message,
                    location        = :location,
                    urgency         = :urgency,
                    status          = :status
                WHERE id = :request_id AND requester_id = :requester_id";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':donor_id', $donor_id, PDO::PARAM_INT);
        $stmt->bindValue(':requester_name', $requester_name);
        $stmt->bindValue(':requester_phone', $requester_phone);
        $stmt->bindValue(':blood_type', $blood_type);
        $stmt->bindValue(':message', $message);
        $stmt->bindValue(':location', $location);
        $stmt->bindValue(':urgency', $urgency);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':request_id', $request_id, PDO::PARAM_INT);
        $stmt->bindValue(':requester_id', $requester_id, PDO::PARAM_INT);
    
        $stmt->execute();
    
        $_SESSION['message'] = "Request updated successfully.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }else {
        // Insert new request
        $sql = "INSERT INTO requests 
                    (donor_id, requester_id, requester_name, requester_phone, blood_type, message, location, urgency) 
                VALUES 
                    (:donor_id, :requester_id, :requester_name, :requester_phone, :blood_type, :message, :location, :urgency)";
        $stmt = $pdo->prepare($sql);

        // Bind common parameters
        $stmt->bindValue(':donor_id', $donor_id, PDO::PARAM_INT);
        $stmt->bindValue(':requester_id', $requester_id, PDO::PARAM_INT);
        $stmt->bindValue(':requester_name', $requester_name);
        $stmt->bindValue(':requester_phone', $requester_phone);
        $stmt->bindValue(':blood_type', $blood_type);
        $stmt->bindValue(':message', $message);
        $stmt->bindValue(':location', $location);
        $stmt->bindValue(':urgency', $urgency);

        $stmt->execute();

        // Fetch donor info
        $donor_stmt = $pdo->prepare("SELECT email, first_name, last_name FROM users WHERE id = :donor_id");
        $donor_stmt->execute([':donor_id' => $donor_id]);
        $donor = $donor_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$donor) {
            $_SESSION['error'] = "Donor not found.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Send email & notification
        $donor_email = $donor['email'];
        $donor_name = $donor['first_name'] . ' ' . $donor['last_name'];

        sendEmailToDonor($donor_email, $donor_name, $requester_name, $requester_phone, $blood_type, $message, $location, $urgency);

        $notif = "You have received a blood request from $requester_name for blood type $blood_type.";
        saveNotification($donor_id, $notif);

        $_SESSION['message'] = "Your request is successfully submitted.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Database error: " . $e->getMessage();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = "Unexpected error: " . $e->getMessage();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
