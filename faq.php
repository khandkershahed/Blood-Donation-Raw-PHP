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
            <h2>FAQ’S</h2>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li class="active">FAQ’S</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- breadcrumb end -->

    <!-- faq section start -->
    <section class="km__faq__section ptb-120 pt-5">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <div class="common_title text-center">
              <p>FAQ'S</p>
              <h2>Frequently Asked Question</h2>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="accordion km_accordion" id="km_accordion">
              <!-- Accordion Item 1 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                  >
                    What is Blood Donation?
                  </button>
                </h2>
                <div
                  id="collapseOne"
                  class="accordion-collapse collapse show"
                  data-bs-parent="#km_accordion"
                >
                  <div class="accordion-body">
                    <p>
                      Blood donation is a voluntary procedure in which a person
                      donates their blood for use in medical treatment or
                      procedures. Donated blood is used in emergencies,
                      surgeries, and to treat patients with blood-related
                      conditions.
                    </p>
                    <p>
                      Regular blood donations are vital to maintain a safe and
                      reliable blood supply for hospitals and clinics.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Accordion Item 2 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo"
                  >
                    Why is Blood Donation Important?
                  </button>
                </h2>
                <div
                  id="collapseTwo"
                  class="accordion-collapse collapse"
                  data-bs-parent="#km_accordion"
                >
                  <div class="accordion-body">
                    <p>
                      Blood donation saves lives by ensuring hospitals have a
                      steady supply of blood. Every donation can help up to
                      three people, providing life-saving blood transfusions for
                      accident victims, cancer patients, and those undergoing
                      surgery.
                    </p>
                    <p>
                      Without regular donations, many hospitals would face
                      shortages, endangering patients' lives.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Accordion Item 3 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseThree"
                  >
                    Who Can Donate Blood?
                  </button>
                </h2>
                <div
                  id="collapseThree"
                  class="accordion-collapse collapse"
                  data-bs-parent="#km_accordion"
                >
                  <div class="accordion-body">
                    <p>
                      In general, healthy individuals aged 18-65 and weighing at
                      least 110 lbs (50 kg) are eligible to donate blood. It is
                      important to ensure that you meet the necessary health
                      criteria before donating.
                    </p>
                    <p>
                      Consult with a blood donation center to confirm
                      eligibility based on specific medical and lifestyle
                      factors.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Accordion Item 4 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#four"
                  >
                    How Can I Become a Blood Donor?
                  </button>
                </h2>
                <div
                  id="four"
                  class="accordion-collapse collapse"
                  data-bs-parent="#km_accordion"
                >
                  <div class="accordion-body">
                    <p>
                      To become a blood donor, you need to visit a certified
                      blood donation center. There, you'll fill out a
                      questionnaire, undergo a brief health screening, and then
                      donate blood in a safe and comfortable environment.
                    </p>
                    <p>
                      Blood donations are typically collected via a needle in
                      the arm, which takes about 10-15 minutes. You can donate
                      whole blood, plasma, or platelets.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Accordion Item 5 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#five"
                  >
                    How Can I Receive Blood?
                  </button>
                </h2>
                <div
                  id="five"
                  class="accordion-collapse collapse"
                  data-bs-parent="#km_accordion"
                >
                  <div class="accordion-body">
                    <p>
                      If you need blood, your doctor or healthcare provider will
                      arrange for a blood transfusion. Blood is typically
                      donated through hospitals or blood banks, and it is
                      carefully matched to ensure compatibility with the
                      recipient.
                    </p>
                    <p>
                      Blood transfusions are essential for treating severe blood
                      loss, anemia, or other medical conditions.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Accordion Item 6 -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#six"
                  >
                    What Are the Benefits of Blood Donation?
                  </button>
                </h2>
                <div
                  id="six"
                  class="accordion-collapse collapse"
                  data-bs-parent="#km_accordion"
                >
                  <div class="accordion-body">
                    <p>
                      Donating blood offers benefits to both the recipient and
                      the donor. For donors, it can help reduce the risk of
                      certain health conditions like heart disease, improve the
                      balance of iron in the body, and provide a sense of
                      fulfillment from helping others.
                    </p>
                    <p>
                      Regular blood donations also encourage a healthy lifestyle
                      by promoting the body's regeneration of blood cells.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- faq section start -->

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
                  <a href="mailto:donate.recive@gmail.com"
                    >donate.recive@gmail.com</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- call now end -->

    <?php
include 'views/partials/footer.php';
include 'views/partials/script.php';
?>