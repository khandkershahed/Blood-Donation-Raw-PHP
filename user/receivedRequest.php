<?php
// Include constants and database connection files
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

try {
    // Fetch all requests sent by the logged-in user (where requester_id matches user_id)
    $query = "SELECT * FROM requests WHERE donor_id = :user_id";
    
    // Prepare the statement
    $stmt = $pdo->prepare($query);
    
    // Bind the user_id parameter to prevent SQL injection
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

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
                    <h4 class="fs-18 fw-semibold m-0">Given Requests</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Given Requests</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
        <div class="row">
            <div class="col-lg-12">
                <!-- All Requests -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">My All Requests Lists</h5>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
                        <?php if ($no_requests): ?>
                            <p>No requests found.</p>
                        <?php else: ?>
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Blood Type</th>
                                        <th>Message</th>
                                        <th>Location</th>
                                        <th>Urgency</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requests as $request): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($request['id']); ?></td>
                                            <td><?php echo htmlspecialchars($request['blood_type']); ?></td>
                                            <td><?php echo htmlspecialchars($request['message']); ?></td>
                                            <td><?php echo htmlspecialchars($request['location']); ?></td>
                                            <td><?php echo htmlspecialchars($request['urgency']); ?></td>
                                            <td>
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
                                            <td><?php echo htmlspecialchars($request['created_at']); ?></td>
                                            <td>
                                                <!-- Update Status Form -->
                                                <form action="<?= ROOT_URL ?>user/request-logic.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                                    <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                                    
                                                    <!-- Status Dropdown -->
                                                    <select class="form-select" name="status" required>
                                                        <option value="pending" <?php echo ($request['status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="accepted" <?php echo ($request['status'] === 'accepted') ? 'selected' : ''; ?>>Accepted</option>
                                                        <option value="rejected" <?php echo ($request['status'] === 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                                                    </select>
                                                    
                                                    <!-- Submit Button -->
                                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Update Status</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
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
