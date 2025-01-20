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
                <h2 class="mt-5">Terms & Conditions</h2>
                <ul class="pt-3">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Terms & Conditions</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->
<!-- terms and conditions start -->
<section class="km__terms__conditions__Section ptb-120">
    <div class="container">
        <div class="imgbx">
            <img src="<?= ROOT_URL ?>public/frontend/images/terms/hurt.jpg" alt="images not founds" class="img-fluid" />
        </div>
        <div class="km_reasons mt-30">
            <p class="pt-3">Welcome to our blood donation platform! These Terms and Conditions outline the rules and regulations governing your use of this platform, including the donation and/or receipt of blood. By accessing or using any part of this platform, you agree to be bound by these Terms and Conditions.</p>
        </div>
        <div class="km_agreement mt-30">
            <h4>1 - Agreement Of User</h4>
            <p class="pt-3">This platform is intended for use by individuals who are at least 18 years old and legally competent to enter into a binding agreement. By accessing or using this platform, you represent and warrant that you meet these requirements.</p>
        </div>
        <div class="mt-30 km_essential">
            <h4>2 - Eligibility for Blood Donation</h4>
            <p class="pt-3">To donate blood through this platform, you must meet the following eligibility criteria:</p>
            <ul class="km_pc_list">
                <li>
                    <span><i class="fa-regular fa-square-check"></i></span>
                    Be at least 18 years old and generally in good health.
                </li>
                <li>
                    <span><i class="fa-regular fa-square-check"></i></span>
                    Weigh at least 50 kilograms (approximately 110 pounds).
                </li>
                <li>
                    <span><i class="fa-regular fa-square-check"></i></span>
                    Have not donated blood within the past 56 days (for whole blood).
                </li>
                <li>
                    <span><i class="fa-regular fa-square-check"></i></span>
                    Meet specific medical eligibility criteria, which may vary depending on your medical history and current health status.
                </li>
            </ul>
            <p class="pt-3">You are responsible for ensuring that you meet these eligibility criteria before donating blood. </p>
        </div>
        <div class="mt-30 km_understanding">
            <h4>3 - Data Privacy and Security</h4>
            <p class="pt-3">We are committed to protecting your personal information. Please refer to our separate **Privacy Policy** for details on how we collect, use, and protect your personal information. By using this platform, you consent to the collection, use, and disclosure of your personal information as described in the Privacy Policy.</p>
        </div>
        <div class="mt-30 km_dealing">
            <h4>4 - Disclaimer of Warranties</h4>
            <p class="pt-3">This platform is provided "as is" without any warranties, express or implied, including but not limited to warranties of merchantability, fitness for a particular purpose, and non-infringement. We do not warrant that the platform will be uninterrupted or error-free, that defects will be corrected, or that the platform or the server that makes it available are free of viruses or other harmful components. You assume the entire risk as to the quality and performance of the platform.</p>
        </div>
        <div class="mt-30 km_dealing">
            <h4>5 - Limitation of Liability</h4>
            <p class="pt-3">In no event shall we be liable for any damages whatsoever, including but not limited to direct, indirect, incidental, consequential, special, exemplary, or punitive damages, arising out of or in any way connected with the use of this platform, whether based on contract, tort, strict liability, or otherwise, even if we have been advised of the possibility of such damages.</p>
        </div>
        <div class="mt-30 km_dealing">
            <h4>6 - Indemnification</h4>
            <p class="pt-3">You agree to indemnify and hold us harmless from any and all claims, liabilities, damages, and expenses (including attorneys' fees) arising out of your use of this platform, including but not limited to any violation of these Terms and Conditions.</p>
        </div>
        <div class="mt-30">
            <h4>7 - Governing Law</h4>
            <p class="pt-3">These Terms and Conditions shall be governed by and construed in accordance with the laws of [Your Jurisdiction].</p>
        </div>
        <div class="mt-30">
            <h4>8 - Changes to Terms and Conditions</h4>
            <p class="pt-3">We may update these Terms and Conditions from time to time. We will notify you of any changes by posting the revised Terms and Conditions on this platform. Your continued use of the platform following the posting of any changes constitutes acceptance of those changes.</p>
        </div>
        <div class="mt-30">
            <h4>9 - Contact</h4>
            <p class="pt-3">If you have any questions or concerns about these Terms and Conditions, please contact us at [email protected]</p>
        </div>
        <div class="km_fr-images mt-30">
            <div class="row g-4 text-center">
                <div class="col-md-6">
                    <img src="<?= ROOT_URL ?>public/frontend/images/terms/t1.jpg" alt="images not founds" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <img src="<?= ROOT_URL ?>public/frontend/images/terms/t2.jpg" alt="images not founds" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- terms and conditions ends -->


<?php
include 'views/partials/footer.php';
include 'views/partials/script.php';
?>