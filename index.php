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
?>



<!-- header start -->
<?php
include 'views/partials/header.php';
?>

<!-- header end -->

<!-- hero section start -->
<section class="hm1_hero_slider hm2_hero_slider">
  <div class="hm1_hero hm2_hero hm21 hm_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-9 col-md-11 col-12">
          <div class="hm2_content text-center">
            <h4>Become a Lifesaver, Donate Blood</h4>
            <h2>
              Your Blood Can Save Lives and Bring Hope to Those in Need
            </h2>
            <a href="donor-login.html" class="explore_now red_btn">Donate Now</a>
            <a href="<?= ROOT_URL ?>contact.php" class="explore_now black_btn">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="hm1_hero hm2_hero hm22 hm_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-9 col-md-11 col-12">
          <div class="hm2_content text-center">
            <h4>Request Blood, Get Help</h4>
            <h2>If You Are in Need, We Are Here to Help You Find Donors</h2>
            <a href="receiver-login.html" class="explore_now red_btn">Find a Donor</a>
            <a href="<?= ROOT_URL ?>contact.php" class="explore_now black_btn">Get in Touch</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="hm1_hero hm2_hero hm23 hm_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-9 col-md-11 col-12">
          <div class="hm2_content text-center">
            <h4>Join the Blood Donation Community</h4>
            <h2>Your Generosity Can Make a Life-Changing Difference</h2>
            <a href="donor-login.html" class="explore_now red_btn">Become a Donor</a>
            <a href="<?= ROOT_URL ?>contact.php" class="explore_now black_btn">Reach Out to Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- hero section end -->

<!-- register & donate start -->
<section class="register_donate pt-115">
  <div class="container">
    <div class="row g-0 register_top">
      <div class="col-xl-6 col-lg-6 col-12">
        <a href="receiver-login.html">
          <div class="register red_bg">
            <div class="register_content">
              <h4>Recive Blood</h4>
              <p>
                Nor again is there anyone who loves or pursues or desires to
                obtain pain of itself, because it is pain,
              </p>
            </div>
            <div class="register_icon black_hover">
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </div>
          </div>
        </a>
      </div>
      <div class="col-xl-6 col-lg-6 col-12">
        <a href="donor-login.html">
          <div class="register black_bg">
            <div class="register_content">
              <h4>Donate Now</h4>
              <p>
                Nor again is there anyone who loves or pursues or desires to
                obtain pain of itself, because it is pain,
              </p>
            </div>
            <div class="register_icon red_hover">
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
<!-- register & donate end -->

<!-- help the people start -->
<section class="help_people pb-115">
  <div class="container">
    <div class="row align-items-center g-lg-5 g-xl-5 g-xxl-5">
      <div
        class="col-xl-6 col-lg-6 col-md-6 col-12 mb-5 mb-xl-0 mb-lg-0 mb-md-0">
        <div class="help_wrap position-relative">
          <img src="assets/images/a2.png" class="help_3" alt="" />
          <img src="assets/images/a2.jpg" class="help_4" alt="" />
          <img src="assets/images/help2.png" alt="" class="help_over" />
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-12">
        <div class="help_content">
          <p class="red_color">Help The People in Need</p>
          <h2>Welcome to Blood Donors Organization</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
            suspendisse the gravida. Risus commodo viverra maecenas
          </p>
          <div class="d-flex justify-content-between">
            <ul>
              <li><i class="fa-solid fa-angles-right"></i> Good Service</li>
              <li><i class="fa-solid fa-angles-right"></i> Help People</li>
              <li><i class="fa-solid fa-angles-right"></i> Hugine Tools</li>
            </ul>
            <ul>
              <li><i class="fa-solid fa-angles-right"></i> 24h Service</li>
              <li><i class="fa-solid fa-angles-right"></i> Health Check</li>
              <li><i class="fa-solid fa-angles-right"></i> Blood Bank</li>
            </ul>
          </div>
          <a href="about.html" class="explore_now red_btn">Explore Now</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- help the people end -->

<!-- counter start -->
<div class="km__counterup___section">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <div
        class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
        <ul class="km__counterup___box text-center">
          <li class="h1 counter mb-30"><span class="count">25</span></li>
          <li class="counter__content">Years of Experience</li>
        </ul>
      </div>
      <div
        class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
        <ul class="km__counterup___box text-center">
          <li class="h1 counter mb-30"><span class="count">430</span></li>
          <li class="counter__content">Blood Donations</li>
        </ul>
      </div>
      <div
        class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-4 mb-xl-0 mb-lg-0 mb-md-0">
        <ul class="km__counterup___box text-center">
          <li class="h1 counter mb-30"><span class="count">90</span></li>
          <li class="counter__content">Total Awards</li>
        </ul>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
        <ul class="km__counterup___box text-center">
          <li class="h1 counter mb-30"><span class="count">35</span></li>
          <li class="counter__content">Blood Cooperations</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- counter end -->

<!-- service start -->
<section class="register_donate gray_bg ptb-115 py-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <div class="common_title text-center">
          <p>services</p>
          <h2>Process</h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
        <div class="register_donate_item">
          <div class="donate_item_top">
            <div class="donate_img">
              <img src="assets/images/r1.jpg" alt="" />
            </div>
            <div class="donate_content text-center">
              <span><img src="assets/images/icon/d1.png" alt="" /></span>
              <a href="service-details.html">
                <h5>Donate Blood, Save Lives</h5>
              </a>
              <p>
                Join us in making a difference by donating blood. Your
                generous act can help save lives and bring hope to those in
                need. Be a hero today!
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
        <div class="register_donate_item">
          <div class="donate_item_top">
            <div class="donate_img">
              <img src="assets/images/r2.jpg" alt="" />
            </div>
            <div class="donate_content text-center">
              <span><img src="assets/images/icon/d2.png" alt="" /></span>
              <a href="service-details.html">
                <h5>Find Blood Near You</h5>
              </a>
              <p>
                Looking for a blood donor? Use our service to quickly locate
                donors in your area. Together, we can ensure help reaches
                those in critical need.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="register_donate_item">
          <div class="donate_item_top">
            <div class="donate_img">
              <img src="assets/images/r3.jpg" alt="" />
            </div>
            <div class="donate_content text-center">
              <span><img src="assets/images/icon/d3.png" alt="" /></span>
              <a href="service-details.html">
                <h5>Receive Blood When Needed</h5>
              </a>
              <p>
                In urgent need of blood? Our network connects you with
                donors to ensure timely assistance. Every drop matters—get
                the help you deserve.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- service end -->

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
              src="assets/images/p_line.png"
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

<!-- call now start -->
<section class="hm1_counter call_now">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="call_content text-center">
          <span class="call_over"><i class="fa-solid fa-phone"></i></span>
          <p>START DONATING</p>
          <a href="tell:015 766 *****">
            <h2>Call Now: <span>015 766 *****</span></h2>
          </a>
          <ul class="d-flex gap-4 justify-content-center flex-wrap">
            <li>
              <span><i class="fa-solid fa-location-dot"></i></span>
              <span>Dhaka - 1075 Firs Avenue</span>
            </li>
            <li>
              <span><i class="fa-solid fa-envelope"></i></span>
              <a href="mailto:donate.recive@gmail.com">donate.recive@gmail.com</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- call now end -->

<!-- Testimonials section start -->
<section class="km__testimonials__section ptb-115 py-5">
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
                  Life-saving blood donation made easy
                </h4>
                <p class="text-white mb-30">
                  Donating blood is a simple yet powerful way to save lives.
                  Every drop counts, and your contribution can make a
                  significant difference to someone in need. When we donate,
                  we embrace the opportunity to help others in life’s most
                  critical moments.
                </p>
              </div>
              <div class="user mt-30">
                <img
                  src="assets/images/about/user.png"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  John Alexis <span>Blood Donor</span>
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
                  Receiving blood has saved my life
                </h4>
                <p class="text-white mb-30">
                  As a receiver, I am grateful for the generosity of blood
                  donors. Without their help, I wouldn't be here today.
                  Blood donation brings hope and life, and I encourage
                  others to contribute to this noble cause.
                </p>
              </div>
              <div class="user mt-30">
                <img
                  src="assets/images/about/user.png"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  Sarah Lee <span>Blood Receiver</span>
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
                  A simple act that means everything
                </h4>
                <p class="text-white mb-30">
                  Donating blood may seem like a small act, but it can make
                  a world of difference. Knowing that your donation could
                  help save a life brings great satisfaction and pride.
                </p>
              </div>
              <div class="user mt-30">
                <img
                  src="assets/images/about/user.png"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  Michael Roberts <span>Blood Donor</span>
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
                <h4 class="text-white mb-30">I got the blood I needed</h4>
                <p class="text-white mb-30">
                  When I was in critical condition, I was able to get the
                  blood I needed thanks to the generosity of blood donors.
                  Their support gave me another chance at life.
                </p>
              </div>
              <div class="user mt-30">
                <img
                  src="assets/images/about/user.png"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  Emily Davis <span>Blood Receiver</span>
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

<!-- gallery start -->
<section class="gallery ptb-115 pt-0 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-5">
        <div class="common_title text-center">
          <p>Gallary</p>
          <h2>Our Best Campaign Gallery</h2>
        </div>
      </div>

      <div class="gallary_slider slider-spacing custom_dots">
        <div class="gallary_item">
          <img src="assets/images/h2_g1.jpg" alt="" />
          <a href="assets/images/h2_g1.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="gallary_item">
          <img src="assets/images/h2_g2.jpg" alt="" />
          <a href="assets/images/h2_g2.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="gallary_item">
          <img src="assets/images/h2_g3.jpg" alt="" />
          <a href="assets/images/h2_g3.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="gallary_item">
          <img src="assets/images/h2_g1.jpg" alt="" />
          <a href="assets/images/h2_g1.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- gallery end -->

<!-- blood doner start -->
<section class="blood ptb-115">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="common_title1 text-center">
          <p>blood owner</p>
          <h2>We Are Blood Donor Group</h2>
          <div class="blood_play position-relative">
            <a
              href="https://youtu.be/kOISEM6L4xk?si=zORepQ4JBnmvLS9v"
              data-fancybox=""
              class="red_bg d-inline-flex align-items-center justify-content-center"><i class="fa-solid fa-play"></i></a>
            <img src="assets/images/b1.png" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- blood doner end -->

<!-- lets change start -->
<section class="change red_bg">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-9 col-lg-9 col-12">
        <div class="change_content">
          <h2>Let's change the world, Join us now!</h2>
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

<!-- footer section start -->

<?php
include 'views/partials/footer.php';
?>

<?php
include 'views/partials/script.php';
?>

