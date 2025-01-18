<?php
// Include constants and database connection files
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header('Location: /login.php');
    exit();
}
// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT * FROM users WHERE id = :user_id LIMIT 1";
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Populate session variables with user data if they exist
if ($user) {
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['contact_number'] = $user['contact_number'];
    $_SESSION['blood_type'] = $user['blood_type'];
    $_SESSION['street_address_1'] = $user['street_address_1'];
    $_SESSION['street_address_2'] = $user['street_address_2'];
    $_SESSION['city'] = $user['city'];
    $_SESSION['area'] = $user['area'];
    $_SESSION['last_donated_date'] = $user['last_donated_date'];
    $_SESSION['weight'] = $user['weight'];
    $_SESSION['donated_before'] = $user['donated_before'];
    $_SESSION['availability'] = $user['availability'];
    $_SESSION['registration_type'] = $user['registration_type'];
}

// Update user data if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated data from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $blood_type = $_POST['blood_type'];
    $street_address_1 = $_POST['street_address_1'];
    $street_address_2 = $_POST['street_address_2'];
    $city = $_POST['city'];
    $area = $_POST['area'];
    $weight = $_POST['weight'];
    $donated_before = $_POST['donated_before'];
    $availability = $_POST['availability'];
    $registration_type = $_POST['registration_type'];

    // Update user data in the database
    $update_query = "UPDATE users SET
        first_name = :first_name,
        last_name = :last_name,
        email = :email,
        contact_number = :contact_number,
        blood_type = :blood_type,
        street_address_1 = :street_address_1,
        street_address_2 = :street_address_2,
        city = :city,
        area = :area,
        weight = :weight,
        donated_before = :donated_before,
        availability = :availability,
        registration_type = :registration_type
        WHERE id = :user_id";

    $update_stmt = $pdo->prepare($update_query);
    $update_stmt->execute([
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'contact_number' => $contact_number,
        'blood_type' => $blood_type,
        'street_address_1' => $street_address_1,
        'street_address_2' => $street_address_2,
        'city' => $city,
        'area' => $area,
        'weight' => $weight,
        'donated_before' => $donated_before,
        'availability' => $availability,
        'registration_type' => $registration_type,
        'user_id' => $user_id
    ]);

    // Update session with new data
    $_SESSION['first_name']        = $first_name;
    $_SESSION['last_name']         = $last_name;
    $_SESSION['email']             = $email;
    $_SESSION['contact_number']    = $contact_number;
    $_SESSION['blood_type']        = $blood_type;
    $_SESSION['street_address_1']  = $street_address_1;
    $_SESSION['street_address_2']  = $street_address_2;
    $_SESSION['city']              = $city;
    $_SESSION['area']              = $area;
    $_SESSION['weight']            = $weight;
    $_SESSION['donated_before']    = $donated_before;
    $_SESSION['availability']      = $availability;
    $_SESSION['registration_type'] = $registration_type;

    // Redirect to a confirmation page or reload the current page
    $_SESSION['success'] = "Data Updated Successfully!";
    header('Location: myprofile.php');
    exit();
}
?>

<?php
// Include header and sidebar
include '../views/admin_partials/head.php';
include '../views/admin_partials/header.php';
include '../views/admin_partials/sidebar.php';
?>

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
        <?php elseif (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success'];
                                                unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="align-items-center justify-content-center">
                                <div class="hando-main-sections justify-content-center">
                                    <div class="overflow-hidden ms-md-4 ms-0">
                                        <h4 class="m-0 text-dark fs-20 mt-2 mt-md-0">
                                            <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                                        </h4>
                                        <p class="my-1 text-muted fs-16">
                                            <strong>Email: </strong><?php echo $_SESSION['email']; ?>
                                        </p>
                                        <p class="fs-15">
                                            <i class="mdi mdi-message me-2 align-middle"></i>
                                            Address: <span> <?php echo $_SESSION['street_address_1']; ?> <br>
                                                <?php echo $_SESSION['city'] . ' , ' . $_SESSION['area']; ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Update Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="myprofile.php">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $_SESSION['first_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $_SESSION['last_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="blood_type" class="mb-2">What is your Blood type?</label><br>
                                            <input class="ms-3 mt-2" type="radio" id="O_positive" name="blood_type" value="A+" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'A+') ? 'checked' : ''; ?> required> A+
                                            <input class="ms-3 mt-2" type="radio" id="A_positive" name="blood_type" value="A-" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'A-') ? 'checked' : ''; ?> required> A-
                                            <input class="ms-3 mt-2" type="radio" id="B_positive" name="blood_type" value="B+" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'B+') ? 'checked' : ''; ?> required> B+
                                            <input class="ms-3 mt-2" type="radio" id="AB_positive" name="blood_type" value="B-" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'B-') ? 'checked' : ''; ?> required> B- <br>
                                            <input class="ms-3 mt-2" type="radio" id="O_negative" name="blood_type" value="AB+" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'AB+') ? 'checked' : ''; ?> required> AB+
                                            <input class="ms-3 mt-2" type="radio" id="A_negative" name="blood_type" value="AB-" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'AB-') ? 'checked' : ''; ?> required> AB-
                                            <input class="ms-3 mt-2" type="radio" id="B_negative" name="blood_type" value="O+" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'O+') ? 'checked' : ''; ?> required> O+
                                            <input class="ms-3 mt-2" type="radio" id="AB_negative" name="blood_type" value="O-" <?= (isset($_SESSION['blood_type']) && $_SESSION['blood_type'] == 'O-') ? 'checked' : ''; ?> required> O-
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $_SESSION['contact_number']; ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="street_address_1">Street Address 1</label>
                                        <input type="text" class="form-control" id="street_address_1" name="street_address_1" value="<?php echo $_SESSION['street_address_1']; ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="street_address_2">Street Address 2</label>
                                        <input type="text" class="form-control" id="street_address_2" name="street_address_2" value="<?php echo $_SESSION['street_address_2']; ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $_SESSION['city']; ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="area">Area</label>
                                        <input type="text" class="form-control" id="area" name="area" value="<?php echo $_SESSION['area']; ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="weight">Weight</label>
                                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $_SESSION['weight']; ?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="availability">Availability</label>
                                        <select class="form-control" id="availability" name="availability">
                                            <option value="available" <?php echo ($_SESSION['availability'] === 'available') ? 'selected' : ''; ?>>Available</option>
                                            <option value="unavailable" <?php echo ($_SESSION['availability'] === 'unavailable') ? 'selected' : ''; ?>>Unavailable</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="donated_before">Donated Before?</label>
                                        <select class="form-control" id="donated_before" name="donated_before">
                                            <option value="yes" <?php echo ($_SESSION['donated_before'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                                            <option value="no" <?php echo ($_SESSION['donated_before'] === 'no') ? 'selected' : ''; ?>>No</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="registration_type">Registration Type</label>
                                        <select class="form-control" id="registration_type" name="registration_type">
                                            <option value="donor" <?php echo ($_SESSION['registration_type'] === 'donor') ? 'selected' : ''; ?>>Donor</option>
                                            <option value="receiver" <?php echo ($_SESSION['registration_type'] === 'receiver') ? 'selected' : ''; ?>>Receiver</option>
                                            <option value="both" <?php echo ($_SESSION['registration_type'] === 'both') ? 'selected' : ''; ?>>Both</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer and scripts
include '../views/admin_partials/footer.php';
include '../views/admin_partials/script.php';
?>