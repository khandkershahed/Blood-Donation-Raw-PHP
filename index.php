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
            <a href="<?= ROOT_URL ?>registration.php" class="explore_now red_btn">Donate Now</a>
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
            <a href="<?= ROOT_URL ?>contact.php" class="explore_now red_btn">Find a Donor</a>
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
        <a href="<?= ROOT_URL ?>login.php">
          <div class="register red_bg">
            <div class="register_content">
              <h4>Recive Blood</h4>
              <p>
                Nor again is there anyone who loves or pursues or desires to
                obtain pain of itself, because it is pain,
              </p>
            </div>
            <div class="register_icon black_hover">
              <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                  <path d="M484 185.6c0-33.5-13.1-65-36.7-88.7L358.6 8.1l-88.7 88.7c-5.9 5.9-11 12.2-15.5 18.9L208 69.3 80.6 196.6c-70.2 70.2-70.2 184.4 0 254.6 35.1 35.1 81.2 52.6 127.3 52.6s92.2-17.5 127.3-52.6c34-34 52.7-79.2 52.7-127.3 0-5.4-.3-10.9-.7-16.2 22.7-5.3 43.3-16.7 60-33.4 23.8-23.7 36.8-55.2 36.8-88.7zm-99.6 102.2c-6.9-34.3-23.8-65.9-49.1-91.2L288 149.4l-14.1 14.1 47.2 47.2C351.3 241 368 281.2 368 323.9s-16.6 82.9-46.9 113.2c-62.4 62.4-163.9 62.4-226.3 0s-62.4-163.9 0-226.3L207.9 97.6l36.3 36.3c-20.8 46.2-12.3 102.5 25.6 140.4 19.5 19.5 44.3 31.8 71.6 35.6l2.7-19.8c-22.9-3.1-43.7-13.5-60.2-29.9-41.1-41.1-41.1-108 0-149.2l74.6-74.6 74.6 74.6c19.9 19.9 30.9 46.4 30.9 74.6s-11 54.7-30.9 74.6c-13.7 13.6-30.3 23.1-48.7 27.6z" fill="#ffffff" opacity="1" data-original="#000000"></path>
                  <path d="m390.9 242.5 9.9 17.4c6.6-3.8 12.7-8.4 18.1-13.9l-14.1-14.1c-4.1 4.1-8.8 7.7-13.9 10.6zM419 125.1l-14.1 14.1c12.4 12.4 19.2 28.8 19.2 46.3 0 11.4-3 22.6-8.5 32.4l17.4 9.9c7.3-12.8 11.2-27.4 11.2-42.3-.2-22.8-9.1-44.2-25.2-60.4zM69.5 303.1c-4.4 29.2.4 58.5 13.8 84.6l17.8-9.1c-23.8-46.6-15-102.7 22-139.6L109 224.9c-21.4 21.3-35 48.4-39.5 78.2zM95 406.7c4.2 5.7 8.9 11.2 13.9 16.2l14.1-14.1c-4.3-4.3-8.3-9-11.9-13.9z" fill="#ffffff" opacity="1" data-original="#000000"></path>
                </g>
              </svg>
            </div>
          </div>
        </a>
      </div>
      <div class="col-xl-6 col-lg-6 col-12">
        <a href="<?= ROOT_URL ?>login.php">
          <div class="register black_bg">
            <div class="register_content">
              <h4>Donate Now</h4>
              <p>
                Nor again is there anyone who loves or pursues or desires to
                obtain pain of itself, because it is pain,
              </p>
            </div>
            <div class="register_icon red_hover">
              <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80" x="0" y="0" viewBox="0 0 99.005 99.005" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                  <path d="M1.99 95.782c-1.836.066-2.771-2.558-1.174-3.62 12.113-8.644 13.216-8.417 14.473-8.405L57.498 90.5c3.335.454 8.302-.498 11.467-1.677l23.05-8.817c4.58-1.482 3.193-6.625.399-8.375-1.36-.829-3.176-.977-5.106-.42-9.822 2.84-22.412 6.738-22.538 6.777a2 2 0 1 1-1.184-3.82c.126-.039 12.751-3.949 22.61-6.799 10.706-3.851 18.715 12.117 7.095 16.428l-22.913 8.768c-3.537 1.318-9.25 2.468-13.467 1.891l-41.905-6.694c-1.558.552-7.245 4.313-11.845 7.641a1.993 1.993 0 0 1-1.171.379z" fill="#fafafa" opacity="1" data-original="#000000" class=""></path>
                  <path d="M57.626 82.926c1.146.561-25.854-4.427-25.927-4.38a2.001 2.001 0 0 1 .695-3.94l23.8 4.198c3.36.537 4.407-.611 5.005-2.637 1.023-3.469-.277-5.759-4.093-7.201-1.155-.342-16.776-4.94-24.585-6.287-3.347-.569-20.105 4.52-29.886 7.867-2.421.879-3.778-2.982-1.295-3.785 4.385-1.501 26.533-8.945 31.86-8.023 8.463 1.476 24.377 6.187 25.241 6.457 9.403 2.475 9.781 17.294-.815 17.731zM69.513 62.648c-12.136 0-22.008-10.531-22.008-23.475 0-12.488 19.687-34.396 20.525-35.322.758-.838 2.209-.838 2.967 0 .838.927 20.525 22.834 20.525 35.322 0 12.944-9.873 23.475-22.009 23.475zm0-54.432c-6.135 7.114-18.009 22.605-18.009 30.957 0 10.739 8.079 19.475 18.009 19.475s18.009-8.736 18.009-19.475c0-8.358-11.873-23.845-18.009-30.957z" fill="#fafafa" opacity="1" data-original="#000000" class=""></path>
                  <path d="M79.522 43.88h-7.374a2 2 0 0 1 0-4h5.374v-1.277h-5.374a2 2 0 0 1 0-4h7.374a2 2 0 0 1 2 2v5.277a2 2 0 0 1-2 2zM66.878 43.88h-7.373a2 2 0 0 1-2-2v-5.277a2 2 0 0 1 2-2h7.373a2 2 0 0 1 0 4h-5.373v1.277h5.373a2 2 0 0 1 0 4z" fill="#fafafa" opacity="1" data-original="#000000" class=""></path>
                  <path d="M72.148 38.603a2 2 0 0 1-2-2v-5.366h-1.27v5.366a2 2 0 0 1-4 0v-7.366a2 2 0 0 1 2-2h5.27a2 2 0 0 1 2 2v7.366a2 2 0 0 1-2 2zM72.148 51.254h-5.27a2 2 0 0 1-2-2V41.88a2 2 0 0 1 4 0v5.374h1.27V41.88a2 2 0 0 1 4 0v7.374a2 2 0 0 1-2 2z" fill="#fafafa" opacity="1" data-original="#000000" class=""></path>
                </g>
              </svg>
              </svg>
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
          <img src="<?= ROOT_URL ?>public/frontend/images/a2.png" class="help_3" alt="" />
          <img src="<?= ROOT_URL ?>public/frontend/images/a2.jpg" class="help_4" alt="" />
          <img src="<?= ROOT_URL ?>public/frontend/images/help2.png" alt="" class="help_over" />
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-12">
        <div class="help_content">
          <p class="red_color">Help The People in Need</p>
          <h2>Welcome to Blood Donors Organization</h2>
          <p>
          The Blood Donors Organization is committed to ensuring that blood is available for those in need, especially in emergency situations. We work tirelessly to increase awareness about the importance of blood donation and encourage individuals to donate regularly. With your help, we can save countless lives. Join us in our mission to make a positive impact and provide hope to those who rely on life-saving blood donations.
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
          <a href="<?= ROOT_URL ?>about.php" class="explore_now red_btn">Explore Now</a>
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
              <img src="<?= ROOT_URL ?>public/frontend/images/r1.jpg" alt="" />
            </div>
            <div class="donate_content text-center">
              <span><img src="<?= ROOT_URL ?>public/frontend/images/icon/d1.png" alt="" /></span>
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
              <img src="<?= ROOT_URL ?>public/frontend/images/r2.jpg" alt="" />
            </div>
            <div class="donate_content text-center">
              <span><img src="<?= ROOT_URL ?>public/frontend/images/icon/d2.png" alt="" /></span>
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
              <img src="<?= ROOT_URL ?>public/frontend/images/r3.jpg" alt="" />
            </div>
            <div class="donate_content text-center">
              <span><img src="<?= ROOT_URL ?>public/frontend/images/icon/d3.png" alt="" /></span>
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
              src="<?= ROOT_URL ?>public/frontend/images/p_line.png"
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
          <a href="tell:+8801705555555">
            <h2>Call Now: <span>+880 1705 555 555</span></h2>
          </a>
          <ul class="d-flex gap-4 justify-content-center flex-wrap">
            <li>
              <span><i class="fa-solid fa-location-dot"></i></span>
              <span>Dhaka - 1075 Firs Avenue</span>
            </li>
            <li>
              <span><i class="fa-solid fa-envelope"></i></span>
              <a href="mailto:bloodbonds@gmail.com">bloodbonds@gmail.com</a>
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
                  class="profile-card"
                  src="<?= ROOT_URL ?>public/frontend/images/about/user.png"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  Russel Jahan <span>Blood Donor</span>
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
                  class="profile-card"
                  src="<?= ROOT_URL ?>public/frontend/images/about/user-3.jpg"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  Minhajul Karim <span>Blood Receiver</span>
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
                  class="profile-card"
                  src="<?= ROOT_URL ?>public/frontend/images/about/user-4.jpg"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  Faisal Iqbal <span>Blood Donor</span>
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
                  class="profile-card"
                  src="<?= ROOT_URL ?>public/frontend/images/about/user-5.jpeg"
                  alt="images not found" />
                <h6 class="mt-30 text-white">
                  Abdullah Seikh <span>Blood Receiver</span>
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
          <img src="<?= ROOT_URL ?>public/frontend/images/h2_g1.jpg" alt="" />
          <a href="<?= ROOT_URL ?>public/frontend/images/h2_g1.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="gallary_item">
          <img src="<?= ROOT_URL ?>public/frontend/images/h2_g2.jpg" alt="" />
          <a href="<?= ROOT_URL ?>public/frontend/images/h2_g2.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="gallary_item">
          <img src="<?= ROOT_URL ?>public/frontend/images/h2_g3.jpg" alt="" />
          <a href="<?= ROOT_URL ?>public/frontend/images/h2_g3.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="gallary_item">
          <img src="<?= ROOT_URL ?>public/frontend/images/h2_g1.jpg" alt="" />
          <a href="<?= ROOT_URL ?>public/frontend/images/h2_g1.jpg" data-fancybox="gallery"><i class="fa-solid fa-plus"></i></a>
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
            <img src="<?= ROOT_URL ?>public/frontend/images/b1.png" alt="" />
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