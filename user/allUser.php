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

// Handle deletion
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $user_id = $_GET['delete_id'];

    // Start a transaction to ensure both deletions happen together
    try {
        // Start the transaction
        $pdo->beginTransaction();

        // Delete dependent records from the requests table first
        $deleteRequestsSql = "DELETE FROM requests WHERE requester_id = :id";
        $stmt = $pdo->prepare($deleteRequestsSql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $deleteDonorRequestsSql = "DELETE FROM requests WHERE donor_id = :id";
        $stmt = $pdo->prepare($deleteDonorRequestsSql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Now delete the user from the users table
        $deleteUserSql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($deleteUserSql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Commit the transaction
        $pdo->commit();

        // Redirect back with success message
        header('Location: /user/allUser.php?message=User deleted successfully');
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of any error
        $pdo->rollBack();

        // Redirect back with error message
        header('Location: /user/allUser.php?message=Error deleting user: ' . $e->getMessage());
        exit();
    }
}

// Fetch donors (users whose registration_type is 'donor' or 'both')
$sql = "SELECT * FROM users ORDER BY id DESC";
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
                    <h4 class="fs-18 fw-semibold m-0">All Users Lists</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">All Users Lists</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
        <div class="row">
            <div class="col-lg-12">
                <!-- All donors -->
                <div class="card">
                    <div class="card-body">
                        <!-- Display success/error messages -->
                        <?php if (isset($_GET['message'])): ?>
                            <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
                        <?php endif; ?>
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
                                class="table table-striped table-bordered dt-responsive nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Blood Group</th>
                                        <th>Status</th>
                                        <th>Weight</th>
                                        <th>Join date</th>
                                        <th>Last Donate</th>
                                        <th>Contact</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Action</th> <!-- Add Action column -->
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
                                                <td><a href="tel:<?php echo htmlspecialchars($row['contact_number']); ?>"><?php echo htmlspecialchars($row['contact_number']); ?></a></td>
                                                <td><?php echo htmlspecialchars($row['city'] . ' - ' . $row['area']); ?></td> <!-- Location could be combined -->
                                                <td><?php echo ucfirst(htmlspecialchars($row['registration_type'])); ?></td>
                                                <td class="text-center">
                                                    <a href="allUser.php?delete_id=<?php echo $row['id']; ?>" class="text-center" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash-alt text-danger"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="10" class="text-center">No users found.</td></tr>';
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

<!-- Include footer and scripts -->
<?php include '../views/admin_partials/footer.php'; ?>
<?php include '../views/admin_partials/script.php'; ?>