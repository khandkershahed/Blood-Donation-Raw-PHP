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
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" x="0" y="0" viewBox="0 0 419.005 419.005" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M338.025 58.515H80.98c-17.767.24-32.345 14.135-33.437 31.869v299.363c0 17.241 16.196 29.257 33.437 29.257h257.045c17.241 0 33.437-12.016 33.437-29.257V90.385c-1.092-17.735-15.67-31.63-33.437-31.87z" style="" fill="#d4e1f4" data-original="#d4e1f4" class=""></path><path d="M121.209 281.601a9.403 9.403 0 0 1-7.314-3.135l-21.42-21.943a10.971 10.971 0 0 1 0-15.151c4.204-3.841 10.709-3.609 14.629.522l14.106 14.629 33.437-31.869c4.204-3.841 10.709-3.609 14.629.522a10.971 10.971 0 0 1 0 15.151l-40.751 38.139a10.455 10.455 0 0 1-7.316 3.135z" style="" fill="#00bb64" data-original="#00bb64" class=""></path><path d="M319.217 268.54H199.054c-5.771 0-10.449-4.678-10.449-10.449s4.678-10.449 10.449-10.449h120.163c5.771 0 10.449 4.678 10.449 10.449s-4.678 10.449-10.449 10.449z" style="" fill="#083863" data-original="#083863" class=""></path><path d="M121.209 198.009a9.403 9.403 0 0 1-7.314-3.135l-21.42-21.943a10.971 10.971 0 0 1 0-15.151c4.204-3.841 10.709-3.609 14.629.522l14.106 14.629 33.437-31.869c4.204-3.841 10.709-3.609 14.629.522a10.971 10.971 0 0 1 0 15.151l-40.751 38.139a10.455 10.455 0 0 1-7.316 3.135z" style="" fill="#00bb64" data-original="#00bb64" class=""></path><path d="M319.217 184.948H199.054c-5.771 0-10.449-4.678-10.449-10.449s4.678-10.449 10.449-10.449h120.163c5.771 0 10.449 4.678 10.449 10.449s-4.678 10.449-10.449 10.449z" style="" fill="#083863" data-original="#083863" class=""></path><path d="M121.209 365.193a9.403 9.403 0 0 1-7.314-3.135l-21.42-21.943a10.971 10.971 0 0 1 0-15.151c4.204-3.841 10.709-3.609 14.629.522l14.106 14.629 33.437-31.869c4.204-3.841 10.709-3.609 14.629.522a10.971 10.971 0 0 1 0 15.151l-40.751 38.139a10.459 10.459 0 0 1-7.316 3.135z" style="" fill="#00bb64" data-original="#00bb64" class=""></path><path d="M319.217 352.132H199.054c-5.771 0-10.449-4.678-10.449-10.449s4.678-10.449 10.449-10.449h120.163c5.771 0 10.449 4.678 10.449 10.449 0 5.77-4.678 10.449-10.449 10.449z" style="" fill="#083863" data-original="#083863" class=""></path><path d="M286.303 60.083v36.571H132.18V31.348h38.139C174.245 13.116 190.331.074 208.98.001c18.721-.129 34.917 13.004 38.661 31.347h38.661v28.735z" style="" fill="#00ceb4" data-original="#00ceb4" class=""></path></g></svg>
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