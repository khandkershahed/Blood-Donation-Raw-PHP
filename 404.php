<?php
// Optionally, you can log the error or track the missing pages
$requested_url = $_SERVER['REQUEST_URI'];
// You could log this to a file or database for debugging

header("HTTP/1.1 404 Not Found"); // Ensure correct HTTP response code
?>
<?php
include 'views/partials/head.php';
include 'views/partials/header.php';
?>

<!-- breadcrumb start -->
<div class="breadcrumb_section overflow-hidden ptb-150 error_bread">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12 text-center">
                <h2>Error 404</h2>
                <ul>
                    <li><a href="<?= ROOT_URL ?>">Home</a></li>
                    <li class="active">404</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- 404 start -->
<section class="error ptb-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9 col-sm-10 col-12">
                <div class="error_detail text-center">
                    <span class="mb-1 mb-xl-4 mb-lg-4 mb-md-3 mb-sm-2">404</span>
                    <h1 class="mb-4 mb-xl-5">Page Not Found</h1>
                    <p class="mb-4 mb-xl-5">
                        The page you are looking for might have been removed had its
                        name changed or is temporarily unavailable
                    </p>
                    <a href="<?= ROOT_URL ?>" class="red_btn explore_now">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 404 end -->


<?php
include 'views/partials/footer.php';
include 'views/partials/script.php';
?>