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
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Set default filter values (no filter)
$blood_type = isset($_POST['blood_type']) ? $_POST['blood_type'] : '';
$availability = isset($_POST['availability']) ? $_POST['availability'] : '';
$area = isset($_POST['area']) ? $_POST['area'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';

// Fetch users from the database based on the filter
try {
    // Start building the query
    $query = "SELECT * FROM users WHERE registration_type IN ('donor', 'both')";
 // Default condition to fetch all records

    // Add conditions based on filters
    if ($blood_type) {
        $query .= " AND blood_type = :blood_type";
    }

    if ($availability) {
        $query .= " AND availability = :availability";
    }

    if ($area) {
        $query .= " AND area LIKE :area";  // Use LIKE for partial matching
    }

    if ($city) {
        $query .= " AND city LIKE :city";  // Use LIKE for partial matching
    }

    // Prepare the statement
    $stmt = $pdo->prepare($query);

    // Bind parameters using bindValue instead of bindParam
    if ($blood_type) {
        $stmt->bindValue(':blood_type', $blood_type, PDO::PARAM_STR);
    }
    if ($availability) {
        $stmt->bindValue(':availability', $availability, PDO::PARAM_STR);
    }
    if ($area) {
        $stmt->bindValue(':area', "%$area%", PDO::PARAM_STR);  // Wildcard search
    }
    if ($city) {
        $stmt->bindValue(':city', "%$city%", PDO::PARAM_STR);  // Wildcard search
    }

    // Execute the query
    $stmt->execute();

    // Fetch the filtered users
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if no users are found
    $no_users = count($users) == 0;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>


<!-- Include header and sidebar -->
<?php include '../views/admin_partials/head.php'; ?>
<?php include '../views/admin_partials/header.php'; ?>
<?php include '../views/admin_partials/sidebar.php'; ?>

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
        <?php elseif (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['message'];
                                                unset($_SESSION['message']); ?></div>
        <?php endif; ?>
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <form class="app-search d-none d-md-block me-auto" method="POST">
                        <div class="row">
                            <!-- Area Filter -->
                            <div class="col-lg-2">
                                <div class="position-relative topbar-search">
                                    <input type="text" class="form-control ps-4" name="area" placeholder="Search Area..." />
                                    <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                </div>
                            </div>

                            <!-- Blood Type Filter -->
                            <div class="col-lg-2">
                                <select class="form-select" name="blood_type" aria-label="Select Blood Group">
                                    <option selected disabled>Select blood group</option>
                                    <option value="A+" <?php echo $blood_type == "A+" ? 'selected' : ''; ?>>A+</option>
                                    <option value="A-" <?php echo $blood_type == "A-" ? 'selected' : ''; ?>>A-</option>
                                    <option value="B+" <?php echo $blood_type == "B+" ? 'selected' : ''; ?>>B+</option>
                                    <option value="B-" <?php echo $blood_type == "B-" ? 'selected' : ''; ?>>B-</option>
                                    <option value="AB+" <?php echo $blood_type == "AB+" ? 'selected' : ''; ?>>AB+</option>
                                    <option value="AB-" <?php echo $blood_type == "AB-" ? 'selected' : ''; ?>>AB-</option>
                                    <option value="O+" <?php echo $blood_type == "O+" ? 'selected' : ''; ?>>O+</option>
                                    <option value="O-" <?php echo $blood_type == "O-" ? 'selected' : ''; ?>>O-</option>
                                </select>
                            </div>

                            <!-- Availability Filter -->
                            <div class="col-lg-2">
                                <select class="form-select" name="availability" aria-label="Select Availability">
                                    <option selected disabled>Select Available Or Not</option>
                                    <option value="yes" <?php echo $availability == "yes" ? 'selected' : ''; ?>>Available</option>
                                    <option value="no" <?php echo $availability == "no" ? 'selected' : ''; ?>>Not Available</option>
                                </select>
                            </div>

                            <!-- City Filter -->
                            <div class="col-lg-2">
                                <div class="position-relative topbar-search">
                                    <input type="text" class="form-control ps-4" name="city" placeholder="Search City..." />
                                    <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12">
                    <div class="row">
                        <?php if ($no_users): ?>
                            <div class="col-12">
                                <div class="alert alert-warning" role="alert">
                                    No donors available based on the selected filters.
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <div class="col-lg-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div class="mt-2 mb-3">
                                                    <span class="badge <?php echo $user['availability'] == 'yes' ? 'bg-success' : 'bg-danger'; ?> rounded-2 text-white mb-2 fw-normal">
                                                        <?php echo $user['availability'] == 'yes' ? 'Available' : 'Not Available'; ?>
                                                    </span>
                                                    <h4 class="m-0 fw-medium text-dark fs-16 text-center">Blood Group : <span class="badge bg-secondary rounded-2 text-white mb-2 fw-normal">
                                                            <?php echo $user['blood_type']; ?>
                                                        </span>
                                                    </h4>
                                                    <h5 class="m-0 fw-medium text-dark fs-16"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h5>
                                                    <p class="mt-1 mb-0">
                                                        <a class="text-muted" href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
                                                    </p>
                                                    <p class="mt-1 mb-0">
                                                        <a class="text-muted" href="tel:<?php echo $user['contact_number']; ?>"><?php echo $user['contact_number']; ?></a>
                                                    </p>
                                                    <p class="mt-1 mb-0"><?php echo $user['street_address_1']; ?></p>
                                                </div>
                                                <div class="">
                                                    <button type="button" class="btn btn-sm btn-light me-2" data-bs-toggle="modal" data-bs-target="#request-blood-<?php echo $user['id']; ?>">
                                                        Request
                                                    </button>
                                                    <a href="tel:<?php echo $user['contact_number']; ?>" class="btn btn-sm btn-primary">Call Now</a>
                                                </div>

                                                <div class="modal fade" id="request-blood-<?php echo $user['id']; ?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">Send Request To Donors</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?= ROOT_URL ?>user/request-logic.php" method="POST">
                                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                                                    <input type="hidden" name="donor_id" value="<?php echo $_SESSION['user_id']; ?>">
                                                                    <input type="hidden" name="requester_id" value="<?php echo $user['id']; ?>">

                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" name="name" placeholder="Your Name" required />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <input type="tel" class="form-control" name="phone" placeholder="Your Phone Number" required />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <select class="form-select" name="blood_type" required>
                                                                            <option selected disabled>Select Blood Group</option>
                                                                            <option value="A+" <?php echo ($user['blood_type'] === 'A+') ? 'selected' : ''; ?>>A+</option>
                                                                            <option value="A-" <?php echo ($user['blood_type'] === 'A-') ? 'selected' : ''; ?>>A-</option>
                                                                            <option value="B+" <?php echo ($user['blood_type'] === 'B+') ? 'selected' : ''; ?>>B+</option>
                                                                            <option value="B-" <?php echo ($user['blood_type'] === 'B-') ? 'selected' : ''; ?>>B-</option>
                                                                            <option value="AB+" <?php echo ($user['blood_type'] === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                                                            <option value="AB-" <?php echo ($user['blood_type'] === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                                                            <option value="O+" <?php echo ($user['blood_type'] === 'O+') ? 'selected' : ''; ?>>O+</option>
                                                                            <option value="O-" <?php echo ($user['blood_type'] === 'O-') ? 'selected' : ''; ?>>O-</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <textarea class="form-control" name="message" placeholder="Additional details (e.g., hospital name, urgency level)" rows="4" required></textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control" name="location" placeholder="Hospital/Location" required />
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <select class="form-select" name="urgency" required>
                                                                            <option selected disabled>Urgency</option>
                                                                            <option value="immediate">Immediate</option>
                                                                            <option value="today">Today</option>
                                                                            <option value="within_3_days">Within 3 Days</option>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Send Request</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Blood Request Modal -->


<?php
// Include footer and scripts
include '../views/admin_partials/footer.php';
include '../views/admin_partials/script.php';
?>