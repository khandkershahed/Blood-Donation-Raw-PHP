<?php
// Start session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'config/constants.php';
// Unset all session variables to log the user out
session_unset();

// Destroy the session to remove session data from the server
session_destroy();

// Redirect to the login page or home page after logout
header("Location: /admin_login.php");
exit();
