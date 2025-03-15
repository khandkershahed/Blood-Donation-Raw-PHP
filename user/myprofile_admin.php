<?php
// Include constants and database connection files
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header('Location: /admin_login.php');
    exit();
}
// Get the user ID from the session
$admin_id = $_SESSION['admin_id'];

// Fetch user data from the database
$query = "SELECT * FROM admins WHERE id = :admin_id LIMIT 1";
$stmt = $pdo->prepare($query);
$stmt->execute(['admin_id' => $admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Populate session variables with admin data if they exist
if ($admin) {
    $_SESSION['admin_name']      = $admin['name'];
    $_SESSION['admin_username'] = $admin['username'];
    $_SESSION['admin_password']     = $admin['password'];
    $_SESSION['admin_phone']     = $admin['phone'];
    $_SESSION['admin_email']    = $admin['email'];
    $_SESSION['admin_status']    = $admin['status'];
}

// Update user data if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated data from the form
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];
    $status   = $_POST['status'];

    // Update user data in the database
    $update_query = "UPDATE users SET
        name     = :name,
        username = :username,
        password = :password,
        phone    = :phone,
        email    = :email,
        status   = :status,
        WHERE id = :user_id";

    $update_stmt = $pdo->prepare($update_query);
    $update_stmt->execute([
        'name'     => $name,
        'username' => $username,
        'password' => $password,
        'phone'    => $phone,
        'email'    => $email,
        'status'   => $status,
        'user_id'  => $admin_id
    ]);

    // Update session with new data
    $_SESSION['admin_name']     = $name;
    $_SESSION['admin_username'] = $username;
    $_SESSION['admin_password'] = $password;
    $_SESSION['admin_phone']    = $phone;
    $_SESSION['admin_email']    = $email;
    $_SESSION['admin_status']   = $status;

    // Redirect to a confirmation page or reload the current page
    $_SESSION['success'] = "Data Updated Successfully!";
    header('Location: myprofile_admin.php');
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
                <div class="col-3 mx-auto">
                    <div>
                        <div class="status-badge">
                            <span>Available</span>
                        </div>
                        <div class="card profile-bg">
                            <div class="card-body">
                                <div class="align-items-center">
                                    <div class="hando-main-sections flex-column text-center my-5">
                                        <div class="profile-image">
                                            <?php
                                            if (empty($image_src)) {
                                                // Extract the initials from the first and last name
                                                $initials = strtoupper(substr($_SESSION['admin_name'], 0, 1));
                                                echo '<div class="fallback-image">' . $initials . '</div>';
                                            } else {
                                                echo '<img src="' . $image_src . '" alt="Profile Image">';
                                            }
                                            ?>
                                        </div>
                                        <div class="pt-5">
                                            <h4 class="m-0 text-muted fw-bold fs-20 my-2 mt-md-0">
                                                <?php echo $_SESSION['admin_name']; ?>
                                            </h4>
                                            <p class="my-0 text-muted fs-16">
                                                <i class="mdi mdi-phone me-1 align-middle"></i>
                                                <span class="text-success">Phone: </span><?php echo $_SESSION['admin_phone']; ?>
                                            </p>
                                            <p class="my-0 text-muted fs-16">
                                                <i class="mdi mdi-email-edit-outline me-1 align-middle"></i>
                                                <span class="text-success">Email: </span><?php echo $_SESSION['admin_email']; ?>
                                            </p>
                                            <p class="fs-15">
                                                <i class="mdi mdi-map-marker me-1 align-middle"></i>
                                                <span class="text-success">Username:</span> <span> <?php echo $_SESSION['admin_username']; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile Update Form -->
                <div class="col-9">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="myprofile.php">
                                <div class="row">
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['admin_name']; ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $_SESSION['last_name']; ?>">
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['admin_email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for="phone">Contact Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $_SESSION['admin_phone']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="active" <?php echo ($_SESSION['admin_status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                                <option value="inactive" <?php echo ($_SESSION['admin_status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    

                                    
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-check"></i> Update Profile</button>
                                </div>
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