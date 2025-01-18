<?php
session_start();
require 'config/database.php';

if (isset($_POST['submit'])) {

    // Get form data
    $adminname_email = filter_var($_POST['adminname_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Check if input fields are empty
    if (!$adminname_email) {
        $_SESSION['signin'] = "adminname or Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required";
    } else {
        // Fetch admin from the database
        $fetch_admin_query = "SELECT * FROM admins WHERE adminname='$adminname_email' OR email='$adminname_email'";
        $fetch_admin_result = mysqli_query($connection, $fetch_admin_query);

        if (mysqli_num_rows($fetch_admin_result) == 1) {
            // Convert the record into an associative array
            $admin_record = mysqli_fetch_assoc($fetch_admin_result);
            $db_password = $admin_record['password'];

            // Compare form password with database password
            if (password_verify($password, $db_password)) {
                // Set session data

                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id']        = $admin_record['id'];  // admin's ID
                $_SESSION['name']            = $admin_record['name'];
                $_SESSION['email']           = $admin_record['email'];
                $_SESSION['phone']           = $admin_record['phone'];
                $_SESSION['status']          = $admin_record['status'];
                // var_dump($_SESSION); // Debugging line to check session content

                // Redirect to dashboard
                header('location: ' . ROOT_URL . 'dashboard.php');
                die();
            } else {
                $_SESSION['signin'] = "Incorrect email or password.";
            }
        } else {
            $_SESSION['signin'] = "admin not found";
        }
    }

    // If there is an error, save input data and redirect back to login page
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'login.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'login.php');
    die();
}
