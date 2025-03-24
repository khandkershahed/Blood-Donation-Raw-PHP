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
          <a href="<?= ROOT_URL ?>admin_dashboard.php" class="tp-link">
            <i data-feather="home"></i>
            <span> Dashboard </span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>user/allUser.php" class="tp-link">
            <i data-feather="users"></i>
            <span> All Users </span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>user/allDonor_admin.php" class="tp-link">
            <i data-feather="users"></i>
            <span> All Donor </span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>user/allReceiver_admin.php" class="tp-link">
            <i data-feather="users"></i>
            <span> All Receiver </span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>user/allRequest_admin.php" class="tp-link">
            <i data-feather="droplet"></i>
            <span>All Requests</span>
          </a>
        </li>
        <li>
          <a href="<?= ROOT_URL ?>user/myprofile_admin.php" class="tp-link">
            <i data-feather="user-check"></i>
            <span>My Profile</span>
          </a>
        </li>



        <!-- <li>
          <a href="<?= ROOT_URL ?>user/findDonor_admin.php" class="tp-link">
            <i data-feather="search"></i>
            <span> Find Donor</span>
          </a>
        </li> -->


      </ul>
    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
  </div>
</div>
<!-- Left Sidebar End -->