<?php
require 'config/database.php';
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
  // Redirect the user to the login page if they are not logged in
  header('Location: /login.php');
  exit();
}



// Include header, sidebar, etc.
include 'views/admin_partials/head.php';
include 'views/admin_partials/header.php';
include 'views/admin_partials/sidebar.php';
?>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
  <div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
      <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
          <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
        </div>
      </div>

      <!-- Start Main Widgets -->
      <div class="row">
        <!-- Total Donor Widget -->
        <div class="col-md-6 col-lg-4 col-xl">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-2 me-2">
                    <div class="bg-primary rounded-circle widget-size text-center">
                      <!-- SVG Icon -->
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Total Given Requests</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <h3 class="mb-0 fs-22 text-dark me-3">3,456</h3>
                  <div class="text-center">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Receiver Widget -->
        <div class="col-md-6 col-lg-4 col-xl">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-secondary border-opacity-10 bg-secondary-subtle rounded-2 me-2">
                    <div class="bg-secondary rounded-circle widget-size text-center">
                      <!-- SVG Icon -->
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Total Get Requests</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <h3 class="mb-0 fs-22 text-dark me-3">2,839</h3>
                  <div class="text-center">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Donation Complete Widget -->
        <div class="col-md-6 col-lg-4 col-xl">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-danger border-opacity-10 bg-danger-subtle rounded-2 me-2">
                    <div class="bg-danger rounded-circle widget-size text-center">
                      <!-- SVG Icon -->
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Total Donation Complete</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <h3 class="mb-0 fs-22 text-dark me-3">0</h3>
                  <div class="text-center">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

       
      </div>

    </div>
  </div>
</div>

<!-- ============================================================== -->
<!-- End Page Content here -->
<!-- ============================================================== -->

<?php
// Include footer and closing scripts
include 'views/admin_partials/script.php';
?>