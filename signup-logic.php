<?php
session_start();
require 'config/database.php';


if (isset($_POST['submit'])) {

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    // echo $firstname, $lastname, $username, $email, $createpassword, $confirmpassword;


    if (!$firstname) {
        $_SESSION['signup'] = "Please enter your First Name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please enter your Last Name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter your Username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please enter a valid email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please add avatar";
    } else {
        // check if passwords don't match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {

            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or Email already exist";
            } else {
                // Generate a unique filename using current timestamp
                $time = time();
                $avatar_name = $time . '_' . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // Define allowed file types
                $allowed_files = ['png', 'jpg', 'jpeg' , 'PNG', 'JPG', 'JPEG'];

                // Extract file extension
                $extention = explode('.', $avatar_name);
                $extention = end($extention);

                // Check if the file type is allowed
                if (in_array($extention, $allowed_files)) {

                    // Check if the file size is within the limit (1MB)
                    if ($avatar['size'] < 5000000) {

                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = "File size too big. Should be less than 1Mb.";
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg, or jpeg.";
                }
            }
        }
    }

    // Redirect back to signup page if there was any problem
    if (isset($_SESSION['signup'])) {

        // Pass form data back to signup page (you'll need to implement this)
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // Insert new user into users table
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', 0)";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            // Redirect to login page with success message
            $_SESSION['signup-success'] = "Registration successful. Please log in.";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
    // if button wasn't clicked, bounce back to signup page
    header('Location: ' . ROOT_URL . 'signup.php');
    die();
}
