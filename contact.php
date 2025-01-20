<?php
// Ensure session is started before any database interaction
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection
require_once 'config/database.php'; // Ensure this file is in the correct path

// Initialize error messages and success message
$errors = [];
$successMessage = "";

// Form submission logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validation
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required.";
    }
    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    if (empty($subject)) {
        $errors['subject'] = "Subject is required.";
    }
    if (empty($message)) {
        $errors['message'] = "Message is required.";
    }

    // If no errors, insert into the database
    if (empty($errors)) {
        try {
            // Using the correct PDO variable
            $stmt = $pdo->prepare("INSERT INTO contact_messages (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $first_name);
            $stmt->bindParam(2, $last_name);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $subject);
            $stmt->bindParam(5, $message);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Your message has been sent successfully!";
                // Redirect to prevent resubmission on page refresh
                header("Location: contact.php"); // Redirect to the same page to avoid resubmission
                exit; // Ensure the script ends here after redirection
            } else {
                $errors['general'] = "There was an error submitting your form. Please try again.";
            }
        } catch (PDOException $e) {
            $errors['general'] = "Error: " . $e->getMessage();
        }
    }
}

// Check if a success message is stored in session
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Unset success message after showing it
}

include 'views/partials/head.php';
include 'views/partials/header.php';
?>



<div class="breadcrumb_section overflow-hidden ptb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12 text-center">
                <h2>Contact Us</h2>
                <ul>
                    <li><a href="<?= ROOT_URL ?>">Home</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="km__message__box ptb-120">
    <div class="container">
        <div class="km__contact__form">
            <div class="row g-5">
                <div class="col-xl-7">
                    <div class="km__box__form">
                        <h4 class="mb-40">Get In Touch</h4>

                        <?php if ($successMessage): ?>
                            <div class="alert alert-success" id="successMessage"><?= $successMessage ?></div>
                        <?php endif; ?>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger" id="errorMessages">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="contact.php" method="POST" class="km__main__form">
                            <div class="row">
                                <div class="col-sm">
                                    <input type="text" name="first_name" placeholder="First Name" value="<?= isset($first_name) ? $first_name : '' ?>">
                                </div>
                                <div class="col-sm">
                                    <input type="text" name="last_name" placeholder="Last Name" value="<?= isset($last_name) ? $last_name : '' ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <input type="email" name="email" placeholder="Email" value="<?= isset($email) ? $email : '' ?>">
                                </div>
                                <div class="col">
                                    <input type="text" name="subject" placeholder="Subject" value="<?= isset($subject) ? $subject : '' ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <textarea name="message" placeholder="Message" rows="3"><?= isset($message) ? $message : '' ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="contact__btn">Submit Message <i class="fa-solid fa-angles-right"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="km__form__content">
                        <span class="sub__title">Blood Excellence!</span>
                        <h4 class="km__form__title">Expanded Blood Donate Services Here</h4>
                        <p class="form_des">
                            On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and
                            demoralized by the charms.
                        </p>
                        <ul class="km__address">
                            <li>
                                <i class="fa fa-phone-alt"></i>
                                <span>Emergency Line: (002) 012612457</span>
                            </li>
                            <li>
                                <i class="fas fa-location-dot"></i>
                                <span>Location: Street 68, Mahattan, Dhaka</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span>Mon - Fri: 8:00 am - 7:00 pm</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'views/partials/footer.php';
include 'views/partials/script.php';
?>
