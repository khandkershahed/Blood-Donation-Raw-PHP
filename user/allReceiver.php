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

// Fetch receivers (users whose registration_type is 'receiver' or 'both')
$sql = "SELECT * FROM users WHERE registration_type IN ('receiver', 'both')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch all results into an associative array
$receivers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!-- Include header and sidebar -->
<?php include '../views/user_partials/head.php'; ?>
<?php include '../views/user_partials/header.php'; ?>
<?php include '../views/user_partials/sidebar.php'; ?>


<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Receivers Lists</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">All Receivers Lists</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
        <div class="row">
            <div class="col-lg-12">
                <!-- All Receivers -->
                <div class="card">
                    <!-- end card header -->
                    <div class="card-body">
                        <div class="d-flex align-items-center mobile-tb-message">
                            <p class="mb-0">Swipe Right To Show More
                            <div>
                                <img width="35px" src="<?= ROOT_URL ?>public/frontend/images/swap.svg" alt="">
                            </div>
                            </p>
                        </div>
                        <div class="table-responsive">
                            <table
                                id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Blood Group</th>
                                        <th>Status</th>
                                        <th>Weight</th>
                                        <th>Join date</th>
                                        <th>Last Donate</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if there are any results
                                    if (count($receivers) > 0) {
                                        $sl = 1;
                                        foreach ($receivers as $row) {
                                            $first_name = htmlspecialchars($row['first_name']);
                                            $last_name = htmlspecialchars($row['last_name']);
                                            $full_name = $first_name . ' ' . $last_name; // Concatenate first and last name

                                    ?>
                                            <tr>
                                                <td><?php echo $sl++; ?></td>
                                                <td><?php echo $full_name; ?></td> <!-- Use full name here -->
                                                <td><?php echo htmlspecialchars($row['blood_type']); ?></td> <!-- Using blood_type instead of blood_group -->
                                                <td>
                                                    <?php if ($row['availability'] === 'available'): ?>
                                                        <span class="badge bg-success">Available</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Unavailable</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($row['weight']); ?></td>
                                                <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td> <!-- Join date could be different depending on your table's structure -->
                                                <td><?php echo htmlspecialchars($row['last_donated_date']); ?></td>
                                                <td><?php echo htmlspecialchars($row['city'] . ' - ' . $row['area']); ?></td> <!-- Location could be combined -->
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="9" class="text-center">No receivers found.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
</div>


<?php
// Include footer and scripts
include '../views/user_partials/footer.php';
include '../views/user_partials/script.php';
?>