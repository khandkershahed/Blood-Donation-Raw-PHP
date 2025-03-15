<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
  <div class="h-100" data-simplebar>
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <div class="logo-box">
        <a href="<?= ROOT_URL ?>" class="logo logo-light">
          <span class="logo-sm">
            <img src="<?= ROOT_URL ?>public/images/main-logo.png" alt="" height="22" />
          </span>
          <span class="logo-lg">
            <img src="<?= ROOT_URL ?>public/images/main-logo.png" alt="" height="50" />
          </span>
        </a>
        <a href="<?= ROOT_URL ?>" class="logo logo-dark">
          <span class="logo-sm">
            <img src="<?= ROOT_URL ?>public/images/main-logo.png" alt="" height="22" />
          </span>
          <span class="logo-lg">
            <img src="<?= ROOT_URL ?>public/images/main-logo.png" alt="" height="50" />
          </span>
        </a>
      </div>

      <ul id="side-menu" class="mt-3">
        <li>
          <a href="<?= ROOT_URL ?>dashboard.php" class="tp-link">
            <i data-feather="home"></i>
            <span> Dashboard </span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>user/allDonor.php" class="tp-link">
            <i data-feather="users"></i>
            <span> All Donor </span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>user/myprofile.php" class="tp-link">
            <i data-feather="user-check"></i>
            <span>My Profile</span>
          </a>
        </li>
        <!-- <li>
          <a href="<?= ROOT_URL ?>user/allReceiver.php" class="tp-link">
            <i data-feather="users"></i>
            <span> All Receiver </span>
          </a>
        </li> -->

        <?php
        // Assuming the user's data is already set in session, including registration_type
        $registration_type = $_SESSION['registration_type'] ?? ''; // This will fetch 'donor', 'receiver', or 'both'
        if ($user_logged_in):
        ?>
          <?php if ($registration_type === 'receiver' || $registration_type === 'both'): ?>
            <li>
              <a href="<?= ROOT_URL ?>user/findDonor.php" class="tp-link">
                <i data-feather="search"></i>
                <span> Find Donor</span>
              </a>
            </li>
            <li>
              <a href="<?= ROOT_URL ?>user/givenRequest.php" class="tp-link">
                <i data-feather="droplet"></i>
                <span>Given Requests</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if ($registration_type === 'donor' || $registration_type === 'both'): ?>
            <li>
              <a href="<?= ROOT_URL ?>user/receivedRequest.php" class="tp-link">
                <i data-feather="droplet"></i>
                <span>Received Requests</span>
              </a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
  </div>
</div>
<!-- Left Sidebar End -->