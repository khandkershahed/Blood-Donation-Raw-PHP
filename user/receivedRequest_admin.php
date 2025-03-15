<?php
// Include constants and database connection files
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helper/send_email.php';  // Email sending helper
require_once __DIR__ . '/../helper/notification.php';  // Notification helper
// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page if not logged in
    header('Location: /admin_login.php');
    exit();
}
// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Get the user ID from the session
$admin_id = $_SESSION['admin_id'];

// Handle form submission to update status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF Token Validation
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        // Sanitize input fields
        $request_id = filter_var($_POST['request_id'], FILTER_VALIDATE_INT);
        $new_status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

        // Basic validation for request_id and status
        if ($request_id && in_array($new_status, ['pending', 'accepted', 'rejected'])) {
            try {
                // Fetch request details before updating
                $requestQuery = "SELECT * FROM requests";
                $stmt = $pdo->prepare($requestQuery);
                $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
                $stmt->execute();
                $request = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($request) {
                    // Update the request status in the database
                    $updateQuery = "UPDATE requests SET status = :status WHERE id = :request_id AND donor_id = :user_id";
                    $stmt = $pdo->prepare($updateQuery);
                    $stmt->bindParam(':status', $new_status, PDO::PARAM_STR);
                    $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    // Execute the update query
                    if ($stmt->execute()) {
                        // Fetch the requester's information
                        $requester_id = $request['requester_id'];
                        $requesterQuery = "SELECT * FROM users WHERE id = :requester_id";
                        $stmt = $pdo->prepare($requesterQuery);
                        $stmt->bindParam(':requester_id', $requester_id, PDO::PARAM_INT);
                        $stmt->execute();
                        $requester = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($requester) {
                            // Get request details
                            $requester_name = $requester['first_name'] . ' ' . $requester['last_name'];
                            $requester_email = $requester['email'];
                            $requester_phone = $request['requester_phone'];
                            $blood_type = $request['blood_type'];
                            $message = $request['message'];
                            $location = $request['location'];
                            $urgency = $request['urgency'];
                            $donor_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; // The donor's name
                            $donor_phone = $_SESSION['contact_number']; // The donor's phone

                            // Send email to requester
                            sendEmailToRequester($requester_email, $requester_name, $donor_name, $donor_phone, $blood_type, $message, $location, $urgency, $new_status);

                            // Create dashboard notification for the requester
                            $notification_message = "Your blood donation request for blood type $blood_type has been $new_status by the donor.";
                            saveNotification($requester_id, $notification_message);

                            // Set success message and redirect
                            $_SESSION['message'] = "Status updated successfully!";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                            exit();
                        } else {
                            // Handle case where requester doesn't exist
                            $_SESSION['error'] = "Requester not found.";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                            exit();
                        }
                    } else {
                        $_SESSION['error'] = "Failed to update the status.";
                    }
                } else {
                    $_SESSION['error'] = "Request not found.";
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = "Error: " . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = "Invalid request or status.";
        }
    } else {
        $_SESSION['error'] = "Invalid CSRF token.";
    }
}


// Fetch all requests sent by the logged-in user
try {
    $query = "SELECT * FROM requests WHERE donor_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $no_requests = count($requests) == 0;
} catch (PDOException $e) {
    $_SESSION['error'] = "Error fetching requests: " . $e->getMessage();
    $requests = [];
    $no_requests = true;
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
                    <h4 class="fs-18 fw-semibold m-0">Received Requests</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Received Requests</li>
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
                        <h3 class="text-center">My All Received Requests Lists</h3>
                        <?php if (isset($message)): ?>
                            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
                        <?php endif; ?>
                        <?php if ($no_requests): ?>
                            <p>No requests found.</p>
                        <?php else: ?>
                            <table class="table table-striped table-bordered dt-responsive nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 3%;">Sl ID</th>
                                        <th class="text-center" style="width: 7%;">Requester Name</th>
                                        <th class="text-center" style="width: 7%;">Blood Type</th>
                                        <th class="text-center" style="width: 20%;">Message</th>
                                        <th class="text-center" style="width: 15%;">Location</th>
                                        <th class="text-center" style="width: 7%;">Urgency</th>
                                        <th class="text-center" style="width: 9%;">Contact</th>
                                        <th class="text-center" style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 10%;">Created At</th>
                                        <th class="text-center" style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody style="vertical-align: middle;">
                                    <?php
                                    $serialNumber = 1; // Initialize serial number before the loop
                                    foreach ($requests as $request):
                                        $requester_name = htmlspecialchars($request['requester_name']); // Requester's name
                                        $contact_number = isset($request['requester_phone']) ? htmlspecialchars($request['requester_phone']) : 'Not Provided';
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $serialNumber++; ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($request['requester_name']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($request['blood_type']); ?></td>
                                            <td><?php echo htmlspecialchars($request['message']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($request['location']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($request['urgency']); ?></td>
                                            <td class="text-center"><?php echo $contact_number; ?></td>
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
                                            <td>
                                                <?php
                                                $createdAt = new DateTime($request['created_at']); // Parse the date
                                                $date = $createdAt->format('d F Y'); // Format as "20 January 2025"
                                                $time = $createdAt->format('h:i:s A'); // Format as "01:27:58 PM" in 12-hour format with AM/PM
                                                ?>
                                                <span><?php echo $date; ?></span><br>
                                                <span><?php echo $time; ?></span>
                                            </td>
                                            <td>
                                                <!-- Update Status Form -->
                                                <form class="d-flex flex-column justify-content-center" action="" method="POST" style="display:inline;">
                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                                    <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">

                                                    <!-- Status Dropdown -->
                                                    <select class="form-select" name="status" required>
                                                        <option value="pending" <?php echo ($request['status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="accepted" <?php echo ($request['status'] === 'accepted') ? 'selected' : ''; ?>>Accepted</option>
                                                        <option value="rejected" <?php echo ($request['status'] === 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                                                    </select>

                                                    <!-- Submit Button -->
                                                    <button type="submit" class="btn btn-sm btn-primary mt-2"><i class="fa-solid fa-check"></i> Update Status</button>
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