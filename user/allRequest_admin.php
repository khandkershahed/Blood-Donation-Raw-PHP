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

// Handle request deletion
if (isset($_GET['delete_request_id']) && is_numeric($_GET['delete_request_id'])) {
    $request_id = $_GET['delete_request_id'];

    // Start a transaction to ensure that the deletion is safe
    try {
        // Start the transaction
        $pdo->beginTransaction();

        // Delete the request from the 'requests' table
        $deleteRequestSql = "DELETE FROM requests WHERE id = :id";
        $stmt = $pdo->prepare($deleteRequestSql);
        $stmt->bindParam(':id', $request_id, PDO::PARAM_INT);
        $stmt->execute();

        // Commit the transaction
        $pdo->commit();

        // Set success message and redirect
        $_SESSION['message'] = "Request deleted successfully.";
        header('Location: /user/allRequest_admin.php');
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $pdo->rollBack();
        $_SESSION['error'] = "Error deleting request: " . $e->getMessage();
        header('Location: /user/allRequest_admin.php');
        exit();
    }
}

try {
    // Fetch all requests
    $query = "SELECT * FROM requests";

    // Prepare the statement
    $stmt = $pdo->prepare($query);

    // Execute the query
    $stmt->execute();

    // Fetch the filtered requests
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if no requests are found
    $no_requests = count($requests) == 0;
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
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Requests</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">All Requests</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
        <div class="row">
            <div class="col-lg-12">
                <!-- All Requests -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error'];
                                                    unset($_SESSION['error']); ?></div>
                <?php elseif (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['message'];
                                                        unset($_SESSION['message']); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-body">
                        <?php if ($no_requests): ?>
                            <p>No requests found.</p>
                        <?php else: ?>
                            <div class="d-flex align-items-center mobile-tb-message">
                                <p class="mb-0">Swipe Right To Show More
                                <div>
                                    <img width="35px" src="<?= ROOT_URL ?>public/frontend/images/swap.svg" alt="">
                                </div>
                                </p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">Sl ID</th>
                                            <th class="text-center" style="width: 10%;">Requester Name</th>
                                            <th class="text-center" style="width: 10%;">Blood Type</th>
                                            <th class="text-center" style="width: 25%;">Message</th>
                                            <th class="text-center" style="width: 15%;">Location</th>
                                            <th class="text-center" style="width: 10%;">Urgency</th>
                                            <th class="text-center" style="width: 10%;">Status</th>
                                            <th class="text-center" style="width: 10%;">Created At</th>
                                            <th class="text-center" style="width: 10%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody style="vertical-align: middle;">
                                        <?php
                                        $serialNumber = 1; // Initialize serial number before the loop
                                        foreach ($requests as $request): ?>
                                            <tr>
                                                <td class="text-center"><?php echo $serialNumber++; ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($request['requester_name']); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($request['blood_type']); ?></td>
                                                <td><?php echo htmlspecialchars($request['message']); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($request['location']); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($request['urgency']); ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    // Display the status of the request
                                                    if ($request['status'] === 'pending') {
                                                        echo '<span class="badge bg-warning">Pending</span>';
                                                    } elseif ($request['status'] === 'accepted') {
                                                        echo '<span class="badge bg-success">Accepted</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger">Rejected</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $createdAt = new DateTime($request['created_at']); // Parse the date
                                                    $date = $createdAt->format('d F Y'); // Format as "20 January 2025"
                                                    $time = $createdAt->format('h:i:s A'); // Format as "01:27:58 PM" in 12-hour format with AM/PM
                                                    ?>
                                                    <span><?php echo $date; ?></span><br>
                                                    <span><?php echo $time; ?></span>
                                                </td>
                                                <td>
                                                    <!-- Delete button -->
                                                    <div class="d-flex justify-content-center">
                                                        <a href="allRequest_admin.php?delete_request_id=<?php echo $request['id']; ?>" class="text-center" onclick="return confirm('Are you sure you want to delete this request?')">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
</div>

<!-- Include footer and scripts -->
<?php
// Include footer and scripts
include '../views/admin_partials/footer.php';
include '../views/admin_partials/script.php';
?>