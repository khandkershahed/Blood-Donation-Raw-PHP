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
                <h2>Privacy Policy</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Privacy Policy</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->
<!-- text details section start -->
<section class="km__text__details ptb-120">
    <div class="container">
        <div class="km_policy">
            <h2 class="mb-5">Privacy Policy for Blood Donation App</h2>
            <p>This privacy policy outlines how our blood donation app ("Blood Bonds") collects, uses, and discloses your personal information. We are committed to protecting your privacy and ensuring the responsible handling of your data.</p>
        </div>
        <div class="km_Consent" class="mb-5">
            <h4 class="mt-5">Consent</h4>
            <p>By using our App, you consent to the collection, use, and disclosure of your personal information as described in this policy.</p>
        </div>
        <div class="km_Information">
            <h4 class="mt-5">Information Collection</h4>
            <p class="pt-3">We collect the following types of information from you:</p>
            <ul>
                <li><b>Personal Information:</b> Name, date of birth, contact information (phone number, email address), address, blood type, and any relevant medical history.</li>
                <li><b>Device Information:</b> Type of device, operating system, and unique device identifiers.</li>
                <li><b>Usage Data:</b> Information about how you use the App, such as the features you access and the actions you take.</li>
            </ul>
            <p>We may also collect information from third-party sources, such as public databases and social media platforms, to enhance our services.</p>
        </div>
        <div class="km_How">
            <h4 class="mt-5">How We Use Your Information</h4>
            <p class="pt-3">We use your information for the following purposes:</p>
            <ul class="py-3">
                <li><b>Matching Donors and Recipients:</b> Connecting blood donors with individuals or medical facilities in need of blood.</li>
                <li><b>Managing Donations:</b> Scheduling appointments, tracking donations, and ensuring the safety and quality of blood supplies.</li>
                <li><b>Improving Our App:</b> Analyzing usage data to identify areas for improvement and enhance the user experience.</li>
                <li><b>Communicating with You:</b> Sending notifications, reminders, and updates related to blood donation.</li>
                <li><b>Complying with Legal Obligations:</b> Meeting legal and regulatory requirements.</li>
            </ul>
        </div>
        <ul class="km_pc_list">
            <li>
                <span><i class="fa-regular fa-square-check"></i></span>
                We will never sell or rent your personal information to third parties for marketing purposes.
            </li>
            <li>
                <span><i class="fa-regular fa-square-check"></i></span>
                We will only share your information with third parties when necessary to fulfill the purposes outlined in this policy or as required by law.
            </li>
            <li>
                <span><i class="fa-regular fa-square-check"></i></span>
                We implement appropriate security measures to protect your information from unauthorized access, use, or disclosure.
            </li>
        </ul>
        <div class="km_logs">
            <h4 class="mt-5">Our App Logs</h4>
            <p class="pt-3">We may collect information about your use of the App, such as the pages you visit, the features you use, and the actions you take. This information helps us understand how our App is being used and identify areas for improvement.</p>
        </div>
        <div class="km_Partners">
            <h4 class="mt-5">Sharing Information with Third Parties</h4>
            <p class="pt-3">We may share your information with the following third parties:</p>
            <ul>
                <li><b>Blood Banks and Hospitals:</b> To facilitate blood donations and ensure the safe and effective distribution of blood products.</li>
                <li><b>Service Providers:</b> To assist with data processing, customer support, and other essential services.</li>
                <li><b>Legal and Regulatory Authorities:</b> To comply with legal and regulatory obligations, such as court orders or subpoenas.</li>
            </ul>
        </div>
        <div class="km_ccpa">
            <h4 class="mt-5">Your Rights</h4>
            <p class="pt-3">You have the right to:</p>
            <ul>
                <li><b>Access</b> your personal information.</li>
                <li><b>Update</b> or correct any inaccuracies in your information.</li>
                <li><b>Request</b> the deletion of your information.</li>
                <li><b>Opt-out</b> of receiving marketing communications from us.</li>
            </ul>
            <p>To exercise these rights, please contact us at [email protected]</p>
        </div>
        <div class="km_Blood">
            <h4 class="mt-5">Blood Donation and Requests</h4>
            <p class="pt-3">Our App facilitates blood donation by connecting donors with recipients in need. You can use the App to register as a donor, search for blood requests, and schedule donation appointments.</p>
        </div>
    </div>
</section>
<!-- text details section ends -->


<?php
include 'views/partials/footer.php';
include 'views/partials/script.php';
?>