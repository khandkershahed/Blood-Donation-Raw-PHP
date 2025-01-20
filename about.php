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

<!-- what do start -->
<section class="team ptb-115 gray_bg">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <div class="common_title text-center">
              <p>Team members</p>
              <h2>Meet Volunteers</h2>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
            <div class="team_details">
              <div class="team_img">
                <img src="assets/images/t1.jpg" alt="" class="w-100">
                <ul class="d-flex">
                  <li>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                  </li>
                  
                </ul>
              </div>
              <div class="team_content text-center">
                <a href="#">
                  <h5>Nora Khaypeia</h5>
                </a>
                <p>Co-Founder</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
            <div class="team_details">
              <div class="team_img">
                <img src="assets/images/t2.jpg" alt="" class="w-100">
                <ul class="d-flex">
                  <li>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                  </li>
                  
                </ul>
              </div>
              <div class="team_content text-center">
                <a href="#">
                  <h5>SirJoshan Deo</h5>
                </a>
                <p>Co-Founder</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4">
            <div class="team_details">
              <div class="team_img">
                <img src="assets/images/t3.jpg" alt="" class="w-100">
                <ul class="d-flex">
                  <li>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                  </li>
                  
                </ul>
              </div>
              <div class="team_content text-center">
                <a href="#">
                  <h5>Joshan Khaypeia</h5>
                </a>
                <p>Co-Founder</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
            <div class="team_details">
              <div class="team_img">
                <img src="assets/images/t1.jpg" alt="" class="w-100">
                <ul class="d-flex">
                  <li>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                  </li>
                  
                </ul>
              </div>
              <div class="team_content text-center">
                <a href="#">
                  <h5>Nora Khaypeia</h5>
                </a>
                <p>Co-Founder</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
            <div class="team_details">
              <div class="team_img">
                <img src="assets/images/t2.jpg" alt="" class="w-100">
                <ul class="d-flex">
                  <li>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                  </li>
                  
                </ul>
              </div>
              <div class="team_content text-center">
                <a href="#">
                  <h5>SirJoshan Deo</h5>
                </a>
                <p>Co-Founder</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 col-12">
            <div class="team_details">
              <div class="team_img">
                <img src="assets/images/t3.jpg" alt="" class="w-100">
                <ul class="d-flex">
                  <li>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                  </li>
                  
                </ul>
              </div>
              <div class="team_content text-center">
                <a href="#">
                  <h5>Joshan Khaypeia</h5>
                </a>
                <p>Co-Founder</p>
              </div>
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