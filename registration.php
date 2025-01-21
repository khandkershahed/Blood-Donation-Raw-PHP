<?php
require 'config/database.php';
require_once __DIR__ . '/helper/send_email.php'; 
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] = true) {
    header("Location: dashboard.php");
    exit();
}

// CSRF Token Generation for security
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$blood_type = '';
$first_name = '';
$last_name = '';
$date_of_birth = '';
$password = '';
$contact_number = '';
$email = '';
$street_address_1 = '';
$street_address_2 = '';
$city = '';
$area = '';
$last_donated_date = '';
$weight = '';
$donated_before = '';
$registration_type = '';
$availability = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF Validation
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token mismatch!");
    }

    // Collect and sanitize user input
    $blood_type        = $_POST['blood_type'] ?? '';
    $first_name        = htmlspecialchars($_POST['first_name'] ?? '');
    $last_name         = htmlspecialchars($_POST['last_name'] ?? '');
    $date_of_birth     = $_POST['date_of_birth'] ?? '';
    $password          = $_POST['password'] ?? '';
    $contact_number    = $_POST['contact_number'] ?? '';
    $email             = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $street_address_1  = htmlspecialchars($_POST['street_address_1'] ?? '');
    $street_address_2  = htmlspecialchars($_POST['street_address_2'] ?? '');
    $city              = htmlspecialchars($_POST['city'] ?? '');
    $area              = htmlspecialchars($_POST['area'] ?? '');
    $last_donated_date = $_POST['last_donated_date'] ?? '';
    $weight            = $_POST['weight'] ?? '';
    $donated_before    = $_POST['donated_before'] ?? '';
    $availability      = $_POST['availability'] ?? '';
    $registration_type = isset($_POST['registration_type']) ? implode(', ', $_POST['registration_type']) : '';

    // Basic form validation
    $missing_fields = [];

    // Check if each field is empty and add the missing field to the array
    if (empty($first_name)) {
        $missing_fields[] = 'First Name';
    }
    if (empty($last_name)) {
        $missing_fields[] = 'Last Name';
    }
    if (empty($date_of_birth)) {
        $missing_fields[] = 'Date of Birth';
    }
    if (empty($password)) {
        $missing_fields[] = 'Password';
    }
    if (empty($contact_number)) {
        $missing_fields[] = 'Contact Number';
    }
    if (empty($email)) {
        $missing_fields[] = 'Email';
    }
    if (empty($street_address_1)) {
        $missing_fields[] = 'Street Address 1';
    }
    if (empty($city)) {
        $missing_fields[] = 'City';
    }
    if (empty($area)) {
        $missing_fields[] = 'Area';
    }
    if (empty($registration_type)) {
        $missing_fields[] = 'Registration Type';
    }
    if (empty($availability)) {
        $missing_fields[] = 'availability';
    }

    // If there are missing fields, show an error message with the list of missing fields
    if (!empty($missing_fields)) {
        $missing_fields_list = implode(', ', $missing_fields);
        $_SESSION['error'] = "Please fill in the following fields: $missing_fields_list.";
        header('Location: registration.php');
        exit();
    }

    // Password validation: ensure it's at least 8 characters
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
        $_SESSION['error'] = "Password must be at least 8 characters long, contain one uppercase letter, one number, and one special character.";
        header('Location: registration.php');
        exit();
    }

    // Validate contact number (e.g., Bangladesh format)
    if (!preg_match('/^01[3-9][0-9]{8}$/', $contact_number)) {
        $_SESSION['error'] = "Invalid contact number format.";
        header('Location: registration.php');
        exit();
    }

    // Check if the email is already registered
    $sql_check_email = "SELECT * FROM users WHERE email = :email";
    $stmt_check = $pdo->prepare($sql_check_email);
    $stmt_check->execute([':email' => $email]);

    if ($stmt_check->rowCount() > 0) {
        $_SESSION['error'] = "Email is already registered.";
        header('Location: registration.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    // Insert data into the database, include :availability in the SQL query
    $sql = "INSERT INTO users (blood_type, first_name, last_name, date_of_birth, password, contact_number, email, street_address_1, street_address_2, city, area, last_donated_date, weight, donated_before, registration_type, availability)
VALUES (:blood_type, :first_name, :last_name, :date_of_birth, :password, :contact_number, :email, :street_address_1, :street_address_2, :city, :area, :last_donated_date, :weight, :donated_before, :registration_type, :availability)";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Execute with all parameters, including :availability
    $stmt->execute([
        ':blood_type'        => $blood_type,
        ':first_name'        => $first_name,
        ':last_name'         => $last_name,
        ':date_of_birth'     => $date_of_birth,
        ':password'          => $hashed_password,
        ':contact_number'    => $contact_number,
        ':email'             => $email,
        ':street_address_1'  => $street_address_1,
        ':street_address_2'  => $street_address_2,
        ':city'              => $city,
        ':area'              => $area,
        ':last_donated_date' => $last_donated_date,
        ':weight'            => $weight,
        ':donated_before'    => $donated_before,
        ':registration_type' => $registration_type,
        ':availability'      => $availability // Make sure to include this parameter here
    ]);
    $recipientEmail = $email;
    $recipientName = $first_name . ' ' . $last_name;
    sendWelcomeEmail($recipientEmail, $recipientName);
    // Redirect to dashboard.php after successful registration
    $_SESSION['success'] = "Registration successful. Please log in.!";
    header("Location: /login.php");
    exit();
}
?>

<?php include 'views/partials/head.php'; ?>

<!-- header start -->
<?php include 'views/partials/header.php'; ?>

<!-- breadcrumb start -->
<div class="overflow-hidden" style="background-image: url('public/frontend/images/register-blood.png'); height: 440px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-8 col-sm-10 col-12 text-center">
                <!-- <h2 class="text-white">Blood Donation Registration</h2> -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<section class="">
    <div class="container p-5 shadow-sm my-5">
        <!-- Error or Success Message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
        <?php elseif (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success'];
                                                unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST" action="registration.php">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <!-- Blood Type Section -->
            <div class="row mb-4">

                <div class="col-lg-12">
                    <label for="blood_type" class="mb-2">What is your Blood type? <span class="text-danger">*</span></label><br>
                    <div class="row">
                        <!-- First Row: Blood Types (O, A, B, AB) -->
                        <div class="col-md-12 d-flex">
                            <!-- Custom radio button for O (+ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="O_positive" type="radio" name="blood_type" value="O+" <?= (isset($blood_type) && $blood_type == 'O+') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="O_positive">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>O (+ve)</span>
                                </label>
                            </div>

                            <!-- Custom radio button for A (+ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="A_positive" type="radio" name="blood_type" value="A+" <?= (isset($blood_type) && $blood_type == 'A+') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="A_positive">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>A (+ve)</span>
                                </label>
                            </div>

                            <!-- Custom radio button for B (+ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="B_positive" type="radio" name="blood_type" value="B+" <?= (isset($blood_type) && $blood_type == 'B+') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="B_positive">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>B (+ve)</span>
                                </label>
                            </div>

                            <!-- Custom radio button for AB (+ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="AB_positive" type="radio" name="blood_type" value="AB+" <?= (isset($blood_type) && $blood_type == 'AB+') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="AB_positive">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>AB (+ve)</span>
                                </label>
                            </div>

                            <!-- Custom radio button for O (-ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="O_negative" type="radio" name="blood_type" value="O-" <?= (isset($blood_type) && $blood_type == 'O-') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="O_negative">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>O (-ve)</span>
                                </label>
                            </div>

                            <!-- Custom radio button for A (-ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="A_negative" type="radio" name="blood_type" value="A-" <?= (isset($blood_type) && $blood_type == 'A-') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="A_negative">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>A (-ve)</span>
                                </label>
                            </div>

                            <!-- Custom radio button for B (-ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="B_negative" type="radio" name="blood_type" value="B-" <?= (isset($blood_type) && $blood_type == 'B-') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="B_negative">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>B (-ve)</span>
                                </label>
                            </div>

                            <!-- Custom radio button for AB (-ve) -->
                            <div class="register-checkbox me-3">
                                <input class="inp-cbx" id="AB_negative" type="radio" name="blood_type" value="AB-" <?= (isset($blood_type) && $blood_type == 'AB-') ? 'checked' : ''; ?> required>
                                <label class="cbx" for="AB_negative">
                                    <span>
                                        <svg width="12px" height="10px" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span>AB (-ve)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Information Section -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="first_name" class="mb-2">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control rounded-0" placeholder="First Name" value="<?= htmlspecialchars($first_name); ?>" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="last_name" class="mb-2">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control rounded-0" placeholder="Last Name" value="<?= htmlspecialchars($last_name); ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="email" class="mb-2">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control rounded-0" placeholder="blooddoors@gmail.com" value="<?= $email; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="password" class="mb-2">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control rounded-0" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="contact_number" class="mb-2">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" name="contact_number" class="form-control rounded-0" placeholder="01***********" value="<?= $contact_number; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="street_address_1" class="mb-2">Street Address <span class="text-danger">*</span></label>
                        <input type="text" name="street_address_1" class="form-control rounded-0" placeholder="Street Address" value="<?= $street_address_1; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="city" class="mb-2">City <span class="text-danger">*</span></label>
                        <input type="text" name="city" class="form-control rounded-0" placeholder="City" value="<?= $city; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="area" class="mb-2">Area <span class="text-danger">*</span></label>
                        <input type="text" name="area" class="form-control rounded-0" placeholder="Eg:Mohammadpur " value="<?= $area; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="date_of_birth" class="mb-2">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" name="date_of_birth" class="form-control rounded-0" value="<?= $date_of_birth; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="last_donated_date" class="mb-2">Last Donated Date <span class="text-danger">*</span></label>
                        <input type="date" name="last_donated_date" class="form-control rounded-0" value="<?= $last_donated_date; ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="weight" class="mb-2">Weight (kg) <span class="text-danger">*</span></label>
                        <input type="number" name="weight" class="form-control rounded-0" placeholder="Enter Your Weight" value="<?= $weight; ?>" required>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label for="registration_type" class="my-2">Registration Type <span class="text-danger">*</span></label><br>
                    <div class="register-checkbox">
                        <input class="inp-cbx" id="donor" type="radio" name="registration_type[]" value="donor" <?= (strpos($registration_type, 'donor') !== false) ? 'checked' : ''; ?>>
                        <label class="cbx" for="donor">
                            <span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                            <span>Donor</span>
                        </label>
                    </div>
                    <div class="register-checkbox">
                        <input class="inp-cbx" id="receiver" type="radio" name="registration_type[]" value="receiver" <?= (strpos($registration_type, 'receiver') !== false) ? 'checked' : ''; ?>>
                        <label class="cbx" for="receiver">
                            <span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                            <span>Receiver</span>
                        </label>
                    </div>
                    <div class="register-checkbox">
                        <input class="inp-cbx" id="both" type="radio" name="registration_type[]" value="both" <?= (strpos($registration_type, 'both') !== false) ? 'checked' : ''; ?>>
                        <label class="cbx" for="both">
                            <span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                            <span>Both Donor & Receiver</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label for="donated_before" class="mb-2">Have you donated before? <span class="text-danger">*</span></label><br>
                    <div class="register-checkbox">
                        <input class="inp-cbx" id="donated_before_yes" type="radio" name="donated_before" value="yes" <?= ($donated_before == 'yes') ? 'checked' : ''; ?> required>
                        <label class="cbx" for="donated_before_yes">
                            <span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                            <span>Yes</span>
                        </label>
                    </div>
                    <div class="register-checkbox">
                        <input class="inp-cbx" id="donated_before_no" type="radio" name="donated_before" value="no" <?= ($donated_before == 'no') ? 'checked' : ''; ?> required>
                        <label class="cbx" for="donated_before_no">
                            <span>
                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                </svg>
                            </span>
                            <span>No</span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="availability" class="mb-2">Availability <span class="text-danger">*</span></label><br>
                        <div class="register-checkbox">
                            <input class="inp-cbx" id="availability_available" type="radio" name="availability" value="available" <?= (strpos($availability, 'available') !== false) ? 'checked' : ''; ?>>
                            <label class="cbx" for="availability_available">
                                <span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg>
                                </span>
                                <span>Available</span>
                            </label>
                        </div>
                        <div class="register-checkbox">
                            <input class="inp-cbx" id="availability_unavailable" type="radio" name="availability" value="unavailable" <?= (strpos($availability, 'unavailable') !== false) ? 'checked' : ''; ?>>
                            <label class="cbx" for="availability_unavailable">
                                <span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg>
                                </span>
                                <span>Unavailable</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-danger rounded-0 w-100 py-2">Register Now</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include 'views/partials/footer.php'; ?>
<?php include 'views/partials/script.php'; ?>