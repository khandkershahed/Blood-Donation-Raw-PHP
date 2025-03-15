<?php
require 'config/database.php';
// var_dump($_SESSION);
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  // Redirect the admin to the login page if they are not logged in
  header('Location: /admin_login.php');
  exit();
}

$admin_id = $_SESSION['admin_id'];

try {
    // Fetch all requests sent by the logged-in admin (where requester_id matches admin_id)
    $query = "SELECT * FROM requests WHERE requester_id = :admin_id";
    $query2 = "SELECT * FROM requests WHERE donor_id = :admin_id";

    // Prepare the statement
    $stmt = $pdo->prepare($query);
    $stmt2 = $pdo->prepare($query2);

    // Bind the admin_id parameter to prevent SQL injection
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt2->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();
    $stmt2->execute();

    // Fetch the filtered requests
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $requests2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $count = count($requests);
    $count2 = count($requests2);
    // Check if no requests are found
    $no_requests = $count == 0;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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
          <a href="<?= ROOT_URL ?>user/givenRequest_admin.php">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-2 me-2">
                    <div class="widget-size text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                          <rect width="446" height="305.613" fill="#e57e25" rx="25.31" opacity="1" data-original="#e57e25"></rect>
                          <path fill="#f29c1f" d="M435.739 300.212A26.13 26.13 0 0 0 446 279.434V26.179A26.179 26.179 0 0 0 419.821 0H166.508L435.2 300.014z" opacity="1" data-original="#f29c1f" class=""></path>
                          <path fill="#f29c1f" d="M279.492 0H26.179A26.179 26.179 0 0 0 0 26.179v253.255a26.124 26.124 0 0 0 9.7 20.334l1.1.246z" opacity="1" data-original="#f29c1f" class=""></path>
                          <path fill="#f0c419" d="M419.821 0H26.179A26.179 26.179 0 0 0 0 26.179v10.063l188.916 130.177a60.068 60.068 0 0 0 68.168 0L446 36.242V26.179A26.179 26.179 0 0 0 419.821 0z" opacity="1" data-original="#f0c419" class=""></path>
                          <path fill="#ff5364" d="M116.126 512a8 8 0 0 1-5.157-14.119l110.588-91.916a8 8 0 1 1 10.306 12.235l-110.587 91.919a7.97 7.97 0 0 1-5.15 1.881z" opacity="1" data-original="#ff5364"></path>
                          <path fill="#35acef" d="M209.927 494.588a8 8 0 0 1-5.275-14.018l27.222-24.87a8 8 0 1 1 10.543 12.035l-27.217 24.87a7.967 7.967 0 0 1-5.273 1.983z" opacity="1" data-original="#35acef"></path>
                          <path fill="#285680" d="m239.598 336.348 50.471 120.895 92.207-138.322 129.63-123.515z" opacity="1" data-original="#285680"></path>
                          <path fill="#7ed0fc" d="m511.906 194.516-266.03 155.177-78.277-20.307z" opacity="1" data-original="#7ed0fc"></path>
                          <path fill="#35acef" d="M418.218 297.138 290.069 457.243l15.123-91.701z" opacity="1" data-original="#35acef"></path>
                          <path fill="#7ed0fc" d="M511.906 195.406c.073-.227.169-.4 0-.232L305.192 365.542 433.246 400.4z" opacity="1" data-original="#7ed0fc"></path>
                        </g>
                      </svg>
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Total Given Requests</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <!-- Amount -->
                  <h3 class="mb-0 fs-22 text-dark me-3"><?php echo "$count" ?></h3>
                  <div class="text-center">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>

        <!-- Total Receiver Widget -->
        <div class="col-md-6 col-lg-4 col-xl">
        <a href="<?= ROOT_URL ?>user/receivedRequest_admin.php">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-secondary border-opacity-10 bg-secondary-subtle rounded-2 me-2">
                    <div class="widget-size text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0" viewBox="0 0 419.005 419.005" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                          <path d="M338.025 58.515H80.98c-17.767.24-32.345 14.135-33.437 31.869v299.363c0 17.241 16.196 29.257 33.437 29.257h257.045c17.241 0 33.437-12.016 33.437-29.257V90.385c-1.092-17.735-15.67-31.63-33.437-31.87z" style="" fill="#d4e1f4" data-original="#d4e1f4" class=""></path>
                          <path d="M121.209 281.601a9.403 9.403 0 0 1-7.314-3.135l-21.42-21.943a10.971 10.971 0 0 1 0-15.151c4.204-3.841 10.709-3.609 14.629.522l14.106 14.629 33.437-31.869c4.204-3.841 10.709-3.609 14.629.522a10.971 10.971 0 0 1 0 15.151l-40.751 38.139a10.455 10.455 0 0 1-7.316 3.135z" style="" fill="#00bb64" data-original="#00bb64" class=""></path>
                          <path d="M319.217 268.54H199.054c-5.771 0-10.449-4.678-10.449-10.449s4.678-10.449 10.449-10.449h120.163c5.771 0 10.449 4.678 10.449 10.449s-4.678 10.449-10.449 10.449z" style="" fill="#083863" data-original="#083863" class=""></path>
                          <path d="M121.209 198.009a9.403 9.403 0 0 1-7.314-3.135l-21.42-21.943a10.971 10.971 0 0 1 0-15.151c4.204-3.841 10.709-3.609 14.629.522l14.106 14.629 33.437-31.869c4.204-3.841 10.709-3.609 14.629.522a10.971 10.971 0 0 1 0 15.151l-40.751 38.139a10.455 10.455 0 0 1-7.316 3.135z" style="" fill="#00bb64" data-original="#00bb64" class=""></path>
                          <path d="M319.217 184.948H199.054c-5.771 0-10.449-4.678-10.449-10.449s4.678-10.449 10.449-10.449h120.163c5.771 0 10.449 4.678 10.449 10.449s-4.678 10.449-10.449 10.449z" style="" fill="#083863" data-original="#083863" class=""></path>
                          <path d="M121.209 365.193a9.403 9.403 0 0 1-7.314-3.135l-21.42-21.943a10.971 10.971 0 0 1 0-15.151c4.204-3.841 10.709-3.609 14.629.522l14.106 14.629 33.437-31.869c4.204-3.841 10.709-3.609 14.629.522a10.971 10.971 0 0 1 0 15.151l-40.751 38.139a10.459 10.459 0 0 1-7.316 3.135z" style="" fill="#00bb64" data-original="#00bb64" class=""></path>
                          <path d="M319.217 352.132H199.054c-5.771 0-10.449-4.678-10.449-10.449s4.678-10.449 10.449-10.449h120.163c5.771 0 10.449 4.678 10.449 10.449 0 5.77-4.678 10.449-10.449 10.449z" style="" fill="#083863" data-original="#083863" class=""></path>
                          <path d="M286.303 60.083v36.571H132.18V31.348h38.139C174.245 13.116 190.331.074 208.98.001c18.721-.129 34.917 13.004 38.661 31.347h38.661v28.735z" style="" fill="#00ceb4" data-original="#00ceb4" class=""></path>
                        </g>
                      </svg>
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Total Get Requests</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <!-- Amount -->
                  <h3 class="mb-0 fs-22 text-dark me-3"><?php echo "$count2" ?></h3>
                  <div class="text-center">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>

        <!-- Total Donation Complete Widget -->
        <div class="col-md-6 col-lg-4 col-xl">
        <a href="<?= ROOT_URL ?>index.php">
          <div class="card">
            <div class="card-body">
              <div class="widget-first">
                <div class="d-flex align-items-center mb-2">
                  <div class="p-2 border border-danger border-opacity-10 bg-danger-subtle rounded-2 me-2">
                    <div class="widget-size text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                          <linearGradient id="a">
                            <stop offset="0" stop-color="#dd464e"></stop>
                            <stop offset="1" stop-color="#c82e37"></stop>
                          </linearGradient>
                          <linearGradient xlink:href="#a" id="d" x1="110.17" x2="122.504" y1="140.038" y2="187.372" gradientUnits="userSpaceOnUse"></linearGradient>
                          <linearGradient id="b">
                            <stop offset="0" stop-color="#f0f1f1"></stop>
                            <stop offset="1" stop-color="#e5e6e7"></stop>
                          </linearGradient>
                          <linearGradient xlink:href="#b" id="e" x1="-22.455" x2="-14.179" y1="21.671" y2="29.102" gradientUnits="userSpaceOnUse"></linearGradient>
                          <linearGradient xlink:href="#a" id="f" x1="58.277" x2="70.61" y1="153.56" y2="200.893" gradientUnits="userSpaceOnUse"></linearGradient>
                          <linearGradient xlink:href="#b" id="g" x1="89.856" x2="84.719" y1="80.324" y2="79.698" gradientUnits="userSpaceOnUse"></linearGradient>
                          <linearGradient id="c">
                            <stop offset="0" stop-color="#d0d3d3"></stop>
                            <stop offset="1" stop-color="#aaaeb1"></stop>
                          </linearGradient>
                          <linearGradient xlink:href="#c" id="h" x1="38.078" x2="37.828" y1="3.692" y2="39.939" gradientUnits="userSpaceOnUse"></linearGradient>
                          <linearGradient xlink:href="#c" id="i" x1="24.12" x2="23.87" y1="1.596" y2="37.843" gradientUnits="userSpaceOnUse"></linearGradient>
                          <linearGradient xlink:href="#c" id="j" x1="52.119" x2="51.869" y1="1.789" y2="38.036" gradientUnits="userSpaceOnUse"></linearGradient>
                          <path fill="url(#a)" d="M124 35a6 6 0 0 0-6 6v68c0 7.18-5.82 13-13 13s-13-5.82-13-13V21c0-10.493-8.507-19-19-19H48c-6.627 0-12 5.373-12 12v6.893c0 .996.681 1.92 1.664 2.08A2.001 2.001 0 0 0 40 21v-7a8 8 0 0 1 8-8h25c8.284 0 15 6.716 15 15v88c0 9.389 7.611 17 17 17s17-7.611 17-17V41a2 2 0 0 1 2-2h2v-4z" opacity="1" data-original="url(#a)" class=""></path>
                          <path fill="url(#b)" d="M49 26H27C13.193 26 2 37.193 2 51v56c0 4.595 3.983 10.044 9 12 5.414 2.111 11.595 3.225 18 4 0 1.105 0 3 3 3h12c2 0 3-1 3-3 6.45-.659 12.638-1.562 18-4 4.604-2.093 9-7.383 9-12V51c0-13.807-11.193-25-25-25zm-8 96h-6a2 2 0 1 1 0-4h6a2 2 0 1 1 0 4z" opacity="1" data-original="url(#b)"></path>
                          <path fill="url(#a)" d="M55 31.02V19h-6v11.02a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V17h-6v13.02a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V19h-6v11.02c0 1.626-1.183 3.568-2.631 4.308C12.235 37.465 8 43.667 8 51.02V101c0 4.595 1.775 8.697 7 10 16 3.99 30 3.99 46 0 4.907-1.224 7-5.383 7-10V51.02c0-7.711-4.43-14.037-11.031-17.014C55.895 33.522 55 32.198 55 31.02z" opacity="1" data-original="url(#a)" class=""></path>
                          <path fill="url(#b)" d="M61.021 97H14.979A1.979 1.979 0 0 1 13 95.021V52.979c0-1.093.886-1.979 1.979-1.979h46.042c1.093 0 1.979.886 1.979 1.979v42.042A1.979 1.979 0 0 1 61.021 97z" opacity="1" data-original="url(#b)"></path>
                          <path fill="url(#c)" d="M41 18h-6a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2z" opacity="1" data-original="url(#c)" class=""></path>
                          <path fill="url(#c)" d="M27 22h-6a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2z" opacity="1" data-original="url(#c)" class=""></path>
                          <path fill="url(#c)" d="M55 22h-6a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2z" opacity="1" data-original="url(#c)" class=""></path>
                          <g fill="#3a322b">
                            <path d="M41 117h-6c-1.654 0-3 1.346-3 3s1.346 3 3 3h6c1.654 0 3-1.346 3-3s-1.346-3-3-3zm0 4h-6a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2zM12 52.979v42.042A2.983 2.983 0 0 0 14.979 98H61.02A2.983 2.983 0 0 0 64 95.021V52.979A2.983 2.983 0 0 0 61.021 50H14.979A2.983 2.983 0 0 0 12 52.979zm50 0v42.042a.98.98 0 0 1-.979.979H14.979a.98.98 0 0 1-.979-.979V52.979a.98.98 0 0 1 .979-.979H61.02a.98.98 0 0 1 .98.979z" fill="#3a322b" opacity="1" data-original="#3a322b" class=""></path>
                            <path d="M19 60h38.024a1 1 0 1 0 0-2H19a1 1 0 1 0 0 2zM19 66h38.024a1 1 0 1 0 0-2H19a1 1 0 1 0 0 2zM19 72h38.024a1 1 0 1 0 0-2H19a1 1 0 1 0 0 2zM19 78h38.024a1 1 0 1 0 0-2H19a1 1 0 1 0 0 2zM19 84h38.024a1 1 0 1 0 0-2H19a1 1 0 1 0 0 2zM19 90h38.024a1 1 0 1 0 0-2H19a1 1 0 1 0 0 2z" fill="#3a322b" opacity="1" data-original="#3a322b" class=""></path>
                            <path d="M126 34h-2c-3.859 0-7 3.14-7 7v68c0 6.617-5.383 12-12 12s-12-5.383-12-12V21C93 9.972 84.028 1 73 1H48a12.94 12.94 0 0 0-12.628 10H35c-1.654 0-3 1.346-3 3v2c0 1.302.839 2.402 2 2.816V25h-6v-2.184A2.996 2.996 0 0 0 30 20v-2c0-1.654-1.346-3-3-3h-6c-1.654 0-3 1.346-3 3v2c0 1.302.839 2.402 2 2.816v3.165A25.92 25.92 0 0 0 1 51v56c0 5.059 4.323 10.86 9.637 12.932 4.598 1.793 9.992 3.021 17.405 3.958.15 1.275.835 3.11 3.958 3.11h12c2.222 0 3.615-1.114 3.932-3.092 6.846-.729 12.474-1.72 17.482-3.998C70.024 117.813 75 112.281 75 107V51a25.92 25.92 0 0 0-19-25.019v-3.165A2.996 2.996 0 0 0 58 20v-2c0-1.654-1.346-3-3-3h-6c-1.654 0-3 1.346-3 3v2c0 1.302.839 2.402 2 2.816V25h-6v-6.184A2.996 2.996 0 0 0 44 16v-2a3.003 3.003 0 0 0-2.347-2.924A6.988 6.988 0 0 1 48 7h25c7.72 0 14 6.28 14 14v88c0 9.925 8.075 18 18 18s18-8.075 18-18V41c0-.551.448-1 1-1h2a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1zm-83-.98h4c1.654 0 3-1.346 3-3V23h4v8.02c0 1.564 1.1 3.24 2.558 3.898C62.999 37.823 67 43.993 67 51.02V101c0 2.247-.608 7.625-6.242 9.029-15.738 3.926-29.777 3.926-45.516 0C11.1 108.997 9 105.959 9 101V51.02c0-6.648 3.765-12.703 9.824-15.801C20.605 34.308 22 32.025 22 30.02V23h4v7.02c0 1.654 1.346 3 3 3h4c1.654 0 3-1.346 3-3V19h4v11.02c0 1.654 1.346 3 3 3zM34 27v3.02c0 .551-.448 1-1 1h-4c-.552 0-1-.449-1-1V27zm-14-9c0-.551.448-1 1-1h6c.552 0 1 .449 1 1v2c0 .551-.448 1-1 1h-6c-.552 0-1-.449-1-1zm53 33v56c0 4.345-4.351 9.241-8.414 11.09-4.962 2.257-10.659 3.197-17.688 3.915A1 1 0 0 0 46 123c0 1.439-.561 2-2 2H32c-2 0-2-.839-2-2a1 1 0 0 0-.88-.993c-7.674-.928-13.15-2.143-17.757-3.938C6.83 116.301 3 111.232 3 107V51a23.922 23.922 0 0 1 17-22.937v1.957c0 1.253-.975 2.85-2.086 3.418C11.182 36.88 7 43.617 7 51.02V101c0 5.827 2.755 9.723 7.758 10.971 8.037 2.004 15.64 3.006 23.242 3.006s15.205-1.002 23.242-3.006C66.1 110.759 69 106.658 69 101V51.02c0-7.824-4.452-14.692-11.62-17.925-.735-.332-1.38-1.302-1.38-2.075v-2.957A23.922 23.922 0 0 1 73 51zM48 18c0-.551.448-1 1-1h6c.552 0 1 .449 1 1v2c0 .551-.448 1-1 1h-6c-.552 0-1-.449-1-1zm0 9v3.02c0 .551-.448 1-1 1h-4c-.552 0-1-.449-1-1V27zm-6-13v2c0 .551-.448 1-1 1h-6c-.552 0-1-.449-1-1v-2c0-.551.448-1 1-1h6c.552 0 1 .449 1 1zm83 24h-1c-1.654 0-3 1.346-3 3v68c0 8.822-7.178 16-16 16s-16-7.178-16-16V21c0-8.822-7.178-16-16-16H48a8.993 8.993 0 0 0-8.478 6h-2.089C38.753 6.302 43.019 3 48 3h25c9.925 0 18 8.075 18 18v88c0 7.72 6.28 14 14 14s14-6.28 14-14V41c0-2.757 2.243-5 5-5h1z" fill="#3a322b" opacity="1" data-original="#3a322b" class=""></path>
                          </g>
                        </g>
                      </svg>
                    </div>
                  </div>
                  <p class="mb-0 text-dark fs-15">Total Donation Complete</p>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2">
                  <!-- Amount -->
                  <h3 class="mb-0 fs-22 text-dark me-3">0</h3>
                  <div class="text-center">
                    <p class="text-dark fs-13 mb-0">Last 30 days</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </a>
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