<?php
// session_start();
// require 'config/database.php';

// if (isset($_POST['submit'])) {

//     // Get form data
//     $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//     $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//     // Check if input fields are empty
//     if (!$username_email) {
//         $_SESSION['signin'] = "Username or Email required";
//     } elseif (!$password) {
//         $_SESSION['signin'] = "Password Required";
//     } else {
//         // Fetch user from the database
//         $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
//         $fetch_user_result = mysqli_query($connection, $fetch_user_query);

//         if (mysqli_num_rows($fetch_user_result) == 1) {
//             // Convert the record into an associative array
//             $user_record = mysqli_fetch_assoc($fetch_user_result);
//             $db_password = $user_record['password'];

//             // Compare form password with database password
//             if (password_verify($password, $db_password)) {
//                 // Set session data

//                 $_SESSION['user_logged_in']    = true;
//                 $_SESSION['user_id']           = $user_record['id'];  // User's ID
//                 $_SESSION['first_name']        = $user_record['first_name'];
//                 $_SESSION['last_name']         = $user_record['last_name'];
//                 $_SESSION['email']             = $user_record['email'];
//                 $_SESSION['contact_number']    = $user_record['contact_number'];
//                 $_SESSION['blood_type']        = $user_record['blood_type'];
//                 $_SESSION['street_address_1']  = $user_record['street_address_1'];
//                 $_SESSION['street_address_2']  = $user_record['street_address_2'];
//                 $_SESSION['city']              = $user_record['city'];
//                 $_SESSION['area']              = $user_record['area'];
//                 $_SESSION['last_donated_date'] = $user_record['last_donated_date'];
//                 $_SESSION['weight']            = $user_record['weight'];
//                 $_SESSION['donated_before']    = $user_record['donated_before'];
//                 $_SESSION['registration_type'] = $user_record['registration_type'];
//                 // var_dump($_SESSION); // Debugging line to check session content

//                 // Redirect to dashboard
//                 header('location: ' . ROOT_URL . 'dashboard.php');
//                 die();
//             } else {
//                 $_SESSION['signin'] = "Incorrect username/email or password.";
//             }
//         } else {
//             $_SESSION['signin'] = "User not found";
//         }
//     }

//     // If there is an error, save input data and redirect back to login page
//     if (isset($_SESSION['signin'])) {
//         $_SESSION['signin-data'] = $_POST;
//         header('location: ' . ROOT_URL . 'login.php');
//         die();
//     }
// } else {
//     header('location: ' . ROOT_URL . 'login.php');
//     die();
// }
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
        $_SESSION['signin'] = "Username or Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required";
    } else {
        try {
            // Fetch user from the database using prepared statement
            $fetch_user_query = "SELECT * FROM users WHERE username=:username_email OR email=:username_email";
            $stmt = $pdo->prepare($fetch_user_query);
            $stmt->bindParam(':username_email', $username_email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                // Fetch the user record
                $user_record = $stmt->fetch(PDO::FETCH_ASSOC);
                $db_password = $user_record['password'];

                // Compare form password with database password
                if (password_verify($password, $db_password)) {
                    // Set session data
                    $_SESSION['user_logged_in']    = true;
                    $_SESSION['user_id']           = $user_record['id'];  // User's ID
                    $_SESSION['first_name']        = $user_record['first_name'];
                    $_SESSION['last_name']         = $user_record['last_name'];
                    $_SESSION['email']             = $user_record['email'];
                    $_SESSION['contact_number']    = $user_record['contact_number'];
                    $_SESSION['blood_type']        = $user_record['blood_type'];
                    $_SESSION['street_address_1']  = $user_record['street_address_1'];
                    $_SESSION['street_address_2']  = $user_record['street_address_2'];
                    $_SESSION['city']              = $user_record['city'];
                    $_SESSION['area']              = $user_record['area'];
                    $_SESSION['last_donated_date'] = $user_record['last_donated_date'];
                    $_SESSION['weight']            = $user_record['weight'];
                    $_SESSION['donated_before']    = $user_record['donated_before'];
                    $_SESSION['registration_type'] = $user_record['registration_type'];

                    // Redirect to dashboard
                    header('location: ' . ROOT_URL . 'dashboard.php');
                    die();
                } else {
                    $_SESSION['signin'] = "Incorrect username/email or password.";
                }
            } else {
                $_SESSION['signin'] = "User not found";
            }
        } catch (PDOException $e) {
            // Catch and display any database errors
            $_SESSION['signin'] = "Error: " . $e->getMessage();
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
