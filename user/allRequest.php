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

try {
    // Start building the query
    $query = "SELECT * FROM users WHERE 1=1";  // Default condition to fetch all records

    // Add conditions based on filters

    $query .= " AND registration_type = both";
    $query .= " AND registration_type = receiver";



    // Prepare the statement
    $stmt = $pdo->prepare($query);

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
<?php include '../views/user_partials/head.php'; ?>
<?php include '../views/user_partials/header.php'; ?>
<?php include '../views/user_partials/sidebar.php'; ?>


<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div
                class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
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
                <!-- All Donors -->
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
                                        <th>Image</th>
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
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <img
                                                src="assets/images/users/user-22.jpg"
                                                class="avatar avatar-sm rounded-circle me-3" />
                                        </td>
                                        <td>Emma Young</td>
                                        <td>A (+ve)</td>
                                        <td>
                                            <span class="badge bg-success">Available</span>
                                        </td>
                                        <td>86 kg</td>
                                        <td>2022-11-30</td>
                                        <td>2022-11-30</td>
                                        <td>Mirpur</td>
                                    </tr>
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