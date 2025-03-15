<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config/database.php';  // Ensure this file is included and the $pdo object is available

if (isset($_POST['submit'])) {

    // Get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Check if input fields are empty
    if (!$username_email) {
        $_SESSION['admin_signin'] = "Username or Email required";
    } elseif (!$password) {
        $_SESSION['admin_signin'] = "Password Required";
    } else {
        try {
            // Fetch user from the database using prepared statement
            $fetch_user_query = "SELECT * FROM admins WHERE username=:username_email OR email=:username_email";
            $stmt = $pdo->prepare($fetch_user_query);
            $stmt->bindParam(':username_email', $username_email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                // Fetch the user record
                $user_record = $stmt->fetch(PDO::FETCH_ASSOC);
                $db_password = $user_record['password'];

                // Compare form password with database password
                if (password_verify($password, $db_password)) {
                    // Set session data (but avoid storing the password in the session)
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id']        = $user_record['id'];  // Admin's ID
                    $_SESSION['admin_name']            = $user_record['name'];
                    $_SESSION['admin_username']        = $user_record['username'];
                    $_SESSION['admin_phone']           = $user_record['phone'];
                    $_SESSION['admin_email']           = $user_record['email'];
                    $_SESSION['admin_status']          = $user_record['status'];

                    // Redirect to dashboard
                    header('location: ' . ROOT_URL . 'admin_dashboard.php');
                    die();
                } else {
                    $_SESSION['admin_signin'] = "Incorrect username/email or password.";
                }
            } else {
                $_SESSION['admin_signin'] = "Admin not found";
            }
        } catch (PDOException $e) {
            // Catch and display any database errors
            // You can log the error message for internal debugging but avoid exposing it to users
            error_log($e->getMessage());
            $_SESSION['admin_signin'] = "Error: Unable to process your request.";
        }
    }

    // If there is an error, save input data and redirect back to login page
    if (isset($_SESSION['admin_signin'])) {
        $_SESSION['admin_signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin_login.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'admin_login.php');
    die();
}
