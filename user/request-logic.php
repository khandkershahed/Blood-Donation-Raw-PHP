<?php

// // use PDO;
// require_once __DIR__ . '/../config/constants.php'; // Constants file
// require_once __DIR__ . '/../config/database.php';  // Database connection
// require_once __DIR__ . '/../helper/send_email.php';  // Email sending helper
// require_once __DIR__ . '/../helper/notification.php';  // Email sending helper

// // Ensure the CSRF token is valid
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

//     // Sanitize POST data
//     $donor_id = $_POST['donor_id'];
//     $requester_name = htmlspecialchars($_POST['name']);
//     $requester_phone = htmlspecialchars($_POST['phone']);
//     $blood_type = htmlspecialchars($_POST['blood_type']);
//     $message = htmlspecialchars($_POST['message']);
//     $location = htmlspecialchars($_POST['location']);
//     $urgency = htmlspecialchars($_POST['urgency']);

//     // Prepare and execute the SQL query to insert the blood request
//     try {
//         $query = "INSERT INTO requests (donor_id, requester_name, requester_phone, blood_type, message, location, urgency) 
//                   VALUES (:donor_id, :requester_name, :requester_phone, :blood_type, :message, :location, :urgency)";
//         $stmt = $pdo->prepare($query);

//         // Bind the parameters to the SQL query
//         $stmt->bindValue(':donor_id', $donor_id, PDO::PARAM_INT);
//         $stmt->bindValue(':requester_name', $requester_name, PDO::PARAM_STR);
//         $stmt->bindValue(':requester_phone', $requester_phone, PDO::PARAM_STR);
//         $stmt->bindValue(':blood_type', $blood_type, PDO::PARAM_STR);
//         $stmt->bindValue(':message', $message, PDO::PARAM_STR);
//         $stmt->bindValue(':location', $location, PDO::PARAM_STR);
//         $stmt->bindValue(':urgency', $urgency, PDO::PARAM_STR);

//         // Execute the query to insert the request
//         $stmt->execute();

//         // Get the donor's information for the email and notification
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
//             $_SESSION['message'] = "Your request has been sent successfully.";
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
// }


require_once __DIR__ . '/../config/constants.php'; // Constants file
require_once __DIR__ . '/../config/database.php';  // Database connection
require_once __DIR__ . '/../helper/send_email.php';  // Email sending helper
require_once __DIR__ . '/../helper/notification.php';  // Notification helper

// Ensure CSRF token is valid
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Sanitize POST data
    $request_id = isset($_POST['request_id']) ? $_POST['request_id'] : null;
    $donor_id = $_POST['donor_id'];
    $requester_name = htmlspecialchars($_POST['name']);
    $requester_phone = htmlspecialchars($_POST['phone']);
    $requester_email = htmlspecialchars($_POST['email']);
    $blood_type = htmlspecialchars($_POST['blood_type']);
    $message = htmlspecialchars($_POST['message']);
    $location = htmlspecialchars($_POST['location']);
    $urgency = htmlspecialchars($_POST['urgency']);

    // Fetch the requester_id from session (user's logged in ID)
    $requester_id = $_SESSION['user_id'];

    // Check if the requester exists in the users table
    try {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE id = :id");
        $stmt->bindValue(':id', $requester_id, PDO::PARAM_INT);
        $stmt->execute();

        // If the requester doesn't exist, display error and redirect
        if ($stmt->rowCount() === 0) {
            $_SESSION['error'] = "Requester not found. Please log in again.";
            header('Location: /login.php');
            exit();
        }

        if ($request_id) {
            // Update existing request
            $query = "UPDATE requests SET 
                      requester_name = :requester_name, 
                      requester_phone = :requester_phone, 
                      blood_type = :blood_type, 
                      message = :message, 
                      location = :location, 
                      urgency = :urgency 
                      WHERE id = :request_id AND requester_id = :requester_id";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':request_id', $request_id, PDO::PARAM_INT);
        } else {
            // Insert new request
            $query = "INSERT INTO requests (donor_id, requester_id, requester_name, requester_phone, blood_type, message, location, urgency) 
                      VALUES (:donor_id, :requester_id, :requester_name, :requester_phone, :blood_type, :message, :location, :urgency)";

            $stmt = $pdo->prepare($query);
        }

        // Bind values to the query
        $stmt->bindValue(':donor_id', $donor_id, PDO::PARAM_INT);
        $stmt->bindValue(':requester_id', $requester_id, PDO::PARAM_INT);
        $stmt->bindValue(':requester_name', $requester_name, PDO::PARAM_STR);
        $stmt->bindValue(':requester_phone', $requester_phone, PDO::PARAM_STR);
        $stmt->bindValue(':blood_type', $blood_type, PDO::PARAM_STR);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->bindValue(':location', $location, PDO::PARAM_STR);
        $stmt->bindValue(':urgency', $urgency, PDO::PARAM_STR);

        // Execute the query (either insert or update)
        $stmt->execute();

        // Fetch donor information to send email and notification
        $donor_query = "SELECT email, first_name, last_name FROM users WHERE id = :donor_id";
        $donor_stmt = $pdo->prepare($donor_query);
        $donor_stmt->bindValue(':donor_id', $donor_id, PDO::PARAM_INT);
        $donor_stmt->execute();
        $donor = $donor_stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the donor exists
        if ($donor) {
            $donor_email = $donor['email'];
            $donor_name = $donor['first_name'] . ' ' . $donor['last_name'];

            // Send email notification to the donor
            sendEmailToDonor($requester_email, $donor_name, $requester_name, $requester_phone, $blood_type, $message, $location, $urgency);

            // Create a dashboard notification for the donor
            $notification_message = "You have received a blood request from $requester_name for blood type $blood_type.";
            saveNotification($donor_id, $notification_message);

            // Redirect back with a success message
            $_SESSION['message'] = "Your request has been successfully processed.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Handle case where donor doesn't exist
            $_SESSION['error'] = "Donor not found.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

    } catch (PDOException $e) {
        // Handle database errors
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // CSRF token mismatch or invalid request method
    $_SESSION['error'] = "Invalid request.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
