<?php
require_once __DIR__ . '/../../config/database.php';  // Path to the database config file

// Ensure user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: /admin_login.php");
    exit();
}

$admin_id = $_SESSION['admin_id']; // User ID from session

// Fetch unread notifications count
// $stmt = $pdo->prepare("SELECT * FROM notifications ORDER BY created_at DESC");
// $stmt->execute();

// // Fetch all notifications as an associative array
// $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE status = 'unread'");
// $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$unread_count = $stmt->fetchColumn();

// Function to format "time ago"
function time_ago($timestamp)
{
    // Create a DateTime object for the timestamp in Asia/Dhaka timezone
    $timezone = new DateTimeZone('Asia/Dhaka');
    $time_ago = new DateTime($timestamp, $timezone);

    // Get current time in Asia/Dhaka timezone
    $current_time = new DateTime("now", $timezone);

    // Calculate the time difference between now and the timestamp
    $interval = $current_time->diff($time_ago);

    // Check if the timestamp is in the future by comparing both DateTime objects directly
    if ($current_time < $time_ago) {
        return "In the future";
    }

    // Check for time difference and return the appropriate human-readable format
    if ($interval->y > 0) {
        return $interval->y == 1 ? "one year ago" : "{$interval->y} years ago";
    } elseif ($interval->m > 0) {
        return $interval->m == 1 ? "one month ago" : "{$interval->m} months ago";
    } elseif ($interval->d > 0) {
        return $interval->d == 1 ? "yesterday" : "{$interval->d} days ago";
    } elseif ($interval->h > 0) {
        return $interval->h == 1 ? "an hour ago" : "{$interval->h} hours ago";
    } elseif ($interval->i > 0) {
        return $interval->i == 1 ? "one minute ago" : "{$interval->i} minutes ago";
    } else {
        return "Just Now";
    }
}




// Mark notification as read
if (isset($_GET['notification_id'])) {
    $notification_id = $_GET['notification_id'];
    $stmt = $pdo->prepare("UPDATE notifications SET status = 'read' WHERE id = :notification_id");
    $stmt->bindParam(':notification_id', $notification_id, PDO::PARAM_INT);
    $stmt->execute();
    // Redirect back to the current page to prevent resubmission
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Clear all notifications
if (isset($_GET['clear_notifications'])) {
    $stmt = $pdo->prepare("DELETE FROM notifications");
    $stmt->execute();
    // Redirect after clearing notifications
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<!-- Topbar Start -->
<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    <h5 class="mb-0">Hello, <?php echo htmlspecialchars($admin_name); ?> </h5>
                </li>
            </ul>
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" id="light-dark-mode">
                        <i data-feather="moon" class="align-middle dark-mode"></i>
                        <i data-feather="sun" class="align-middle light-mode"></i>
                    </button>
                </li>
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i data-feather="bell" class="noti-icon"></i>
                        <span class="badge bg-danger rounded-circle noti-icon-badge">
                            <?= $unread_count > 0 ? $unread_count : '0'; ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class=""></span>Notifications
                            </h5>
                        </div>

                        <div class="noti-scroll" data-simplebar>
                            <?php
                            // Fetch both read and unread notifications
                            $stmt = $pdo->prepare("SELECT * FROM notifications ORDER BY created_at DESC");
                            // $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                            $stmt->execute();
                            $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($notifications) > 0):
                                foreach ($notifications as $notification):
                                    $createdAt = new DateTime($notification['created_at']);
                                    $date = $createdAt->format('d F Y');
                                    $time = $createdAt->format('h:i A');
                                    // Determine background color based on notification status
                                    $bg_class = $notification['status'] == 'unread' ? 'bg-light' : 'bg-white';
                                    $font_class = $notification['status'] == 'unread' ? 'text-white' : '';
                            ?>
                                    <a href="<?= ROOT_URL ?>user/allRequest_admin.php?notification_id=<?= $notification['id']; ?>" class="dropdown-item notify-item <?= $bg_class; ?> text-muted link-primary active">
                                        <!-- <a href="<?= ROOT_URL ?>user/allRequest_admin.php?notification_id=<?= $notification['id']; ?>" class="dropdown-item notify-item <?= $bg_class; ?> text-muted link-primary active"> -->

                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="notify-details <?= $bg_class; ?>"><?= htmlspecialchars($notification['message']); ?></p>
                                            <small class="text-muted <?= $bg_class; ?>"><?= $time; ?></small>
                                        </div>
                                        <p class="mb-0 user-msg">
                                            <small class="fs-14 <?= $bg_class; ?>"><?= htmlspecialchars($notification['message']); ?></small>
                                        </p>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-muted">No new notifications</p>
                            <?php endif; ?>
                        </div>

                        <!-- <a href="notifications.php" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all <i class="fe-arrow-right"></i>
                        </a> -->
                    </div>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <?php
                    $adminName = $_SESSION['admin_name'];
                    $nameParts = explode(' ', $adminName);
                    $initials = strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '');
                    ?>

                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <?php if (isset($nameParts[0]) && isset($nameParts[1])): ?>
                            <span class="rounded-circle p-1 bg-light" style="border: 1px dashed;">
                                <?php echo $initials; ?>
                            </span>
                        <?php else: ?>
                            <!-- Default image or text if needed -->
                            <img src="<?= ROOT_URL ?>public/admin/images/users/default.jpg" alt="user-image" class="rounded-circle" />
                        <?php endif; ?>
                        <span class="pro-user-name ms-1"><?php echo htmlspecialchars($adminName); ?><i class="mdi mdi-chevron-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">

                        <a href="<?= ROOT_URL ?>user/myprofile_admin.php" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                            <span>My Account</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= ROOT_URL ?>admin_logout.php" class="dropdown-item notify-item">
                            <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end Topbar -->