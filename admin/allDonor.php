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

// Fetch donors (users whose registration_type is 'donor' or 'both')
$sql = "SELECT * FROM users WHERE registration_type IN ('donor', 'both')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch all results into an associative array
$donors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!-- Include header and sidebar -->
<?php include '../views/admin_partials/head.php'; ?>
<?php include '../views/admin_partials/header.php'; ?>
<?php include '../views/admin_partials/sidebar.php'; ?>


<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All donors Lists</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">All donors Lists</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
        <div class="row">
            <div class="col-lg-12">
                <!-- All donors -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All donors Lists</h5>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
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
                                if (count($donors) > 0) {
                                    $sl = 1;
                                    foreach ($donors as $row) {
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
                                    echo '<tr><td colspan="9" class="text-center">No donors found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
</div>


<?php
// Include footer and scripts
include '../views/admin_partials/footer.php';
include '../views/admin_partials/script.php';
?>
