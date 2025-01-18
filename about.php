<?php
require 'config/database.php';

// fetch current user from database
if (isset($_SESSION['user-id'])) {
  $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT avatar FROM users WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $avatar = mysqli_fetch_assoc($result);
}

?>


<?php
include 'views/partials/head.php';
include 'views/partials/header.php';
?>


<!-- breadcrumb start -->
<div class="breadcrumb_section overflow-hidden ptb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12 text-center">
                <h2>About Us</h2>
                <ul>
                    <li><a href="<?= ROOT_URL ?>">Home</a></li>
                    <li class="active">About Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- wellcome section start -->
<section class="km__Who__section ptb-120 py-5">
    <div class="container">
        <div class="row align-items-center g-0 g-xxl-5 g-xl-5 g-lg-5">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="km__who__content">
                    <h2 class="mb-30">Who We Are</h2>
                    <h5 class="mb-30">
                        Dedicated to Saving Lives, One Donation at a Time
                    </h5>
                    <p class="mb-30">
                        We are a passionate group of individuals committed to connecting
                        blood donors with those in need. Our mission is simple: save
                        lives by facilitating life-saving blood donations and spreading
                        awareness about the importance of donating blood.
                    </p>
                    <a href="<?= ROOT_URL ?>contact.php" class="primary__btn">Contact Us</a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="km__who__imgbx img">
                    <img
                        src="public/frontend/images/about/doctor.jpg"
                        alt="images not found"
                        class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- wellcome section ends -->

<!-- counter start -->
<div class="km__counterup___section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div
                class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
                <ul class="km__counterup___box text-center">
                    <li class="h1 counter mb-30"><span class="count">25</span></li>
                    <li class="counter__content">Years of Saving Lives</li>
                </ul>
            </div>
            <div
                class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
                <ul class="km__counterup___box text-center">
                    <li class="h1 counter mb-30"><span class="count">430</span></li>
                    <li class="counter__content">Blood Donations Made</li>
                </ul>
            </div>
            <div
                class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
                <ul class="km__counterup___box text-center">
                    <li class="h1 counter mb-30"><span class="count">90</span></li>
                    <li class="counter__content">Awards for Service</li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                <ul class="km__counterup___box text-center">
                    <li class="h1 counter mb-30"><span class="count">35</span></li>
                    <li class="counter__content">04 Donation Partnerships</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- counter end -->

<!-- help the people start -->
<section class="help_people bg-light ptb-115 py-5">
    <div class="container">
        <div class="row align-items-center g-lg-5 g-xl-5 g-xxl-5">
            <div
                class="col-xl-6 col-lg-6 col-md-6 col-12 mb-5 mb-xl-0 mb-lg-0 mb-md-0">
                <div class="help_wrap position-relative">
                    <img src="public/frontend/images/a2.png" class="help_3" alt="" />
                    <img src="public/frontend/images/a2.jpg" class="help_4" alt="" />
                    <img src="public/frontend/images/help2.png" alt="" class="help_over" />
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                <div class="help_content">
                    <p class="red_color">Help The People in Need</p>
                    <h2>Welcome to Blood Donors Organization</h2>
                    <p>
                        Join us in making a difference! We are dedicated to providing
                        life-saving blood donations to those in need. Our mission is to
                        connect generous donors with people in urgent need of blood.
                        Every donation counts and can save a life.
                    </p>
                    <div class="d-flex justify-content-between">
                        <ul>
                            <li>
                                <i class="fa-solid fa-angles-right"></i> Life-Saving Service
                            </li>
                            <li>
                                <i class="fa-solid fa-angles-right"></i> Helping People in
                                Emergency
                            </li>
                            <li>
                                <i class="fa-solid fa-angles-right"></i> Advanced Donation
                                Tools
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <i class="fa-solid fa-angles-right"></i> 24/7 Blood Donation
                                Assistance
                            </li>
                            <li>
                                <i class="fa-solid fa-angles-right"></i> Health Screening
                                for Donors
                            </li>
                            <li>
                                <i class="fa-solid fa-angles-right"></i> Well-Stocked Blood
                                Bank
                            </li>
                        </ul>
                    </div>
                    <a href="about.html" class="explore_now red_btn">Explore Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- help the people end -->

<!-- Testimonials section start -->
<section class="km__testimonials__section ptb-115 pt-5 pb-4">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <div class="common_title text-center">
                    <p>Testimonials</p>
                    <h2>What Our Clients Say</h2>
                </div>
            </div>
        </div>

        <div class="testimonials__slider">
            <div class="slide__items">
                <div class="km_testimonials__bx text-center">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-7 col-sm-8 col-10">
                            <div class="km__testimonial__content">
                                <span> " </span>
                                <h4 class="text-white mb-30">
                                    Professional services all the way
                                </h4>
                                <p class="text-white mb-30">
                                    These cases are perfectly simple and easy to distinguish.
                                    In a free hour, when our power of choice is untrammelled
                                    and when nothing prevents our being able to do what we
                                    like best, every pleasure is to be welcomed and every pain
                                    avoided.
                                </p>
                            </div>
                            <div class="user mt-30">
                                <img
                                    src="public/frontend/images/about/user.png"
                                    alt="images not found" />
                                <h6 class="mt-30 text-white">
                                    Jhon Alexis <span>Marketing Staff</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide__items">
                <div class="km_testimonials__bx text-center">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-7 col-sm-8 col-10">
                            <div class="km__testimonial__content">
                                <span> " </span>
                                <h4 class="text-white mb-30">
                                    Professional services all the way
                                </h4>
                                <p class="text-white mb-30">
                                    These cases are perfectly simple and easy to distinguish.
                                    In a free hour, when our power of choice is untrammelled
                                    and when nothing prevents our being able to do what we
                                    like best, every pleasure is to be welcomed and every pain
                                    avoided.
                                </p>
                            </div>
                            <div class="user mt-30">
                                <img
                                    src="public/frontend/images/about/user.png"
                                    alt="images not found" />
                                <h6 class="mt-30 text-white">
                                    Jhon Alexis <span>Marketing Staff</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials section ends -->

<!-- what do start -->
<section class="whatdo ptb-115 py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <div class="common_title text-center">
                    <p>what we do</p>
                    <h2>Donation Process</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="what_progress">
                    <ul>
                        <img
                            src="public/frontend/images/p_line.png"
                            class="progress_line"
                            alt="" />
                        <li>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-7 col-sm-9 col-12">
                                    <div
                                        class="progress_content d-flex align-items-center gap-xl-5 gap-lg-5 gap-md-4 gap-sm-3 gap-3">
                                        <div class="p_content_left">
                                            <h5>Sign Up or Log In</h5>
                                            <p>
                                                <strong>Join as a Donor:</strong> Sign up to donate
                                                blood and save lives.
                                            </p>
                                            <p>
                                                <strong>Join as a Receiver:</strong> Register to
                                                request blood donations.
                                            </p>
                                        </div>
                                        <span class="progress_number">01</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-lg-6 col-md-7 col-sm-9 col-12">
                                    <div
                                        class="progress_content d-flex align-items-center gap-xl-5 gap-lg-5 gap-md-4 gap-sm-3 gap-3">
                                        <span class="progress_number">02</span>
                                        <div class="p_content_left p_content_right">
                                            <h5>Dashboard</h5>
                                            <p>
                                                <strong>Donor:</strong> Manage your profile,
                                                availability, and view req.
                                            </p>
                                            <p>
                                                <strong>Receiver:</strong> Manage your profile,
                                                search for donors, and statistics.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-7 col-sm-9 col-12">
                                    <div
                                        class="progress_content d-flex align-items-center gap-xl-5 gap-lg-5 gap-md-4 gap-sm-3 gap-3">
                                        <div class="p_content_left">
                                            <h5>Search and Filtering</h5>
                                            <p>
                                                Search for donors with filters for blood group,
                                                location, and availability.
                                            </p>
                                        </div>
                                        <span class="progress_number">03</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-lg-6 col-md-7 col-sm-9 col-12">
                                    <div
                                        class="progress_content d-flex align-items-center gap-xl-5 gap-lg-5 gap-md-4 gap-sm-3 gap-3">
                                        <span class="progress_number">04</span>
                                        <div class="p_content_left p_content_right">
                                            <h5>Request Management</h5>
                                            <p>
                                                Receivers can send requests to donors, and donors
                                                can accept or decline the requests.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- what do end -->

<!-- lets change start -->
<section class="change red_bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-9 col-lg-9 col-12">
                <div class="change_content">
                    <h2>Let's change the world, Join us now!</h2>
                    <p>
                        Nor again is there anyone who loves or pursues or desires to
                        obtain pain of itself, because it is pain, but occasionally
                        circumstances occur in which toil and pain can procure reat
                        pleasure.
                    </p>
                </div>
            </div>
            <div
                class="col-xl-3 col-lg-3 col-12 text-xl-end text-lg-end text-center">
                <a href="<?= ROOT_URL ?>contact.php">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<!-- lets change end -->



<?php
include 'views/partials/footer.php';
include 'views/partials/script.php';
?>