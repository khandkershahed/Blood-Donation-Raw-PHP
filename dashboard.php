<?php
require 'config/database.php';
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
  // Redirect the user to the login page if they are not logged in
  header('Location: login.php');
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
                  <p class="mb-0 text-dark fs-15">Total Donor</p>
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
                  <p class="mb-0 text-dark fs-15">Total Receiver</p>
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
                  <h3 class="mb-0 fs-22 text-dark me-3">2,254</h3>
                  <div class="text-center">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Total User Widget -->
        <div class="col-md-6 col-lg-6 col-xl">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-warning border-opacity-10 bg-warning-subtle rounded-2 me-2">
                    <div class="bg-warning rounded-circle widget-size text-center">
                      <!-- SVG Icon -->
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Total User</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <h3 class="mb-0 fs-22 text-dark me-3">$4,578</h3>
                  <div class="text-muted">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Today Blood Donate Widget -->
        <div class="col-md-12 col-lg-6 col-xl">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-success border-opacity-10 bg-success-subtle rounded-2 me-2">
                    <div class="bg-success rounded-circle widget-size text-center">
                      <!-- SVG Icon -->
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Today Blood Donate</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <h3 class="mb-0 fs-22 text-dark me-3">14.57%</h3>
                  <div class="text-muted">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Main Widgets -->

      <!-- Start Row for Donation Overview and Receiver Overview -->
      <div class="row">
        <div class="col-md-12 col-xl-8">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">
                <h5 class="card-title mb-0">Donation Overview</h5>
              </div>
            </div>
            <div class="card-body">
              <div id="sales-overview" class="apex-charts"></div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-xl-4">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">
                <h5 class="card-title mb-0">Receiver Overview</h5>
              </div>
            </div>
            <div class="card-body">
              <div id="top-session" class="apex-charts"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Row for Donation Overview -->

      <!-- Start Table for Blood Request -->
      <div class="row">
        <div class="col-xl-9">
          <div class="card overflow-hidden">
            <div class="card-header">
              <div class="d-flex align-items-center">
                <h5 class="card-title mb-0">Blood Request Report</h5>
              </div>
            </div>
            <div class="card-body mt-0">
              <div class="table-responsive table-card mt-0">
                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                  <thead class="text-muted table-light">
                    <tr>
                      <th scope="col">Requester</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone No</th>
                      <th scope="col">Area</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Table Rows (dynamic data) -->
                    <tr>
                      <td>John Hamilton</td>
                      <td>johnehamilton@gmail.com</td>
                      <td>+48, 65610085</td>
                      <td>Agargaon</td>
                      <td><span class="badge bg-primary-subtle text-primary fw-semibold">New Request</span></td>
                      <td>
                        <a class="btn btn-icon btn-sm bg-primary-subtle" href="#"><i class="mdi mdi-pencil-outline fs-14 text-primary"></i></a>
                        <a class="btn btn-icon btn-sm bg-danger-subtle" href="#"><i class="mdi mdi-delete-outline fs-14 text-danger"></i></a>
                      </td>
                    </tr>
                    <!-- More rows as needed -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Table for Blood Request -->
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