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

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Get the user ID from the session
$admin_id = $_SESSION['admin_id'];

try {
    // Fetch all requests sent by the logged-in user (where requester_id matches user_id)
    $query = "SELECT * FROM requests ";

    // Prepare the statement
    $stmt = $pdo->prepare($query);

    // Bind the user_id parameter to prevent SQL injection
    // $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

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
                    <!-- end card header -->
                    <div class="card-body">
                        <h3 class="mb-3 text-center">My All Requests Lists</h3>
                        <?php if ($no_requests): ?>
                            <p>No requests found.</p>
                        <?php else: ?>
                            <table class="table table-striped table-bordered dt-responsive nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">Sl ID</th>
                                        <th class="text-center" style="width: 10%;">Requester ID</th>
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
                                                <!-- Update and Delete buttons -->
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#request-blood-<?php echo $request['id']; ?>">
                                                        <i class="mdi mdi-pen align-middle"></i>
                                                    </button>
                                                    <form action="<?= ROOT_URL ?>user/request-logic.php" method="POST" style="display:inline;">
                                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                                        <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="action" value="delete" onclick="return confirm('Are you sure you want to delete this request?')"><i class="mdi mdi-delete align-middle"></i></button>
                                                    </form>
                                                </div>
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