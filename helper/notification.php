<?php

// Function to save a notification for a user (donor) to the database
function saveNotification($user_id, $message) {
    global $pdo; // Use the existing PDO connection
    
    // SQL query to insert the notification
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message, status) VALUES (:user_id, :message, 'unread')");
    
    // Bind parameters to the query
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    
    // Execute the query and return the result (true/false)
    return $stmt->execute();
}
?>
