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
                <h2>Terms & Conditions</h2>
                <ul>
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
            <img
                src="<?= ROOT_URL ?>public/frontend/images/terms/hurt.jpg"
                alt="images not founds"
                class="img-fluid" />
        </div>
        <div class="km_reasons mt-30">
            <h2 class="fs-42 mb-30">
                Reasons for Using Website Terms and Conditions
            </h2>
            <p class="mb-30">
                There are many variations of passages of Lorem Ipsum available, but
                the majority have suffered alteration in some form, by injected
                humour, or randomised words which don't look even slightly
                believable. If you are going to use a passage of Lorem Ipsum, you
                need to be sure there isn't anything embarrassing hidden in middle
                of text. All the Lorem Ipsum generators on the Internet tend to
                repeat predefined chunks as necessary, making this the first true
                generator on the Internet.
            </p>
            <p class="m-0">
                It uses a dictionary of over 200 Latin words, combined with a
                handful of model sentence structures, to generate Lorem Ipsum which
                looks reasonable. The generated Lorem Ipsum is therefore always free
                from repetition, injected humour, or non-characteristic words etc.
            </p>
        </div>
        <div class="km_agreement mt-30">
            <h4 class="mb-30">1 - Agreement Of User</h4>
            <p class="mb-30">
                Contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC,
                making it over 2000 years old. Richard McClintock, a Latin professor
                at Hampden-Sydney College in Virginia,
            </p>
            <p class="mb-30">
                looked up one of the more obscure Latin words, consectetur, from a
                Lorem Ipsum passage, and going through the cites of the word in
                classical literature, discovered the undoubtable source.
            </p>
            <p class="m-0">
                Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus
                Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero,
                written in 45 BC. This book is a treatise on the theory of ethics,
                very popular during the Renaissance. The first line of Lorem Ipsum,
                "Lorem ipsum dolor sit amet..", comes from a line in section
                1.10.32.
            </p>
        </div>
        <div class="mt-30 km_essential">
            <h4 class="mb-30">2 - Essential Rules</h4>
            <p class="mb-30">
                Contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC,
                making it over 2000 years old. Richard McClintock, a Latin professor
                at Hampden-Sydney College in Virginia,
            </p>
            <ul class="km_pc_list">
                <li>
                    <span>
                        <i class="fa-regular fa-square-check"></i>
                    </span>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </li>
                <li>
                    <span>
                        <i class="fa-regular fa-square-check"></i>
                    </span>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </li>
                <li>
                    <span>
                        <i class="fa-regular fa-square-check"></i>
                    </span>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </li>
                <li>
                    <span>
                        <i class="fa-regular fa-square-check"></i>
                    </span>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </li>
            </ul>
        </div>
        <div class="mt-30 km_understanding">
            <h4 class="mb-30">3 - Understanding</h4>
            <p class="mb-30">
                Contrary to popular belief, Lorem Ipsum is not simply random text.
                It has roots in a piece of classical Latin literature from 45 BC,
                making it over 2000 years old. Richard McClintock, a Latin professor
                at Hampden-Sydney College in Virginia,
            </p>
            <p class="m-0">
                looked up one of the more obscure Latin words, consectetur, from a
                Lorem Ipsum passage, and going through the cites of the word in
                classical literature, discovered the undoubtable source.
            </p>
        </div>
        <div class="mt-30 km_dealing">
            <h4 class="mb-30">4 - Dealing System</h4>
            <p class="mb-30">
                But I must explain to you how all this mistaken idea of denouncing
                pleasure and praising pain was born and I will give you a complete
                account of the system, and expound the actual teachings of the great
                explorer of the truth, the master-builder of human happiness. No one
                rejects, dislikes, or avoids pleasure itself, because it is
                pleasure, but because those who do not know how to pursue pleasure
                rationally encounter consequences that are extremely painful.
            </p>
            <p class="m-0">
                Nor again is there anyone who loves or pursues or desires to obtain
                pain of itself, because it is pain, but because occasionally
                circumstances occur in which toil and pain can procure him some
                great anpleasure. To take a trivial example, which of us ever
                undertakes laborious physical exercise, except to obtain some
                advantage from But who has any right to find fault with
            </p>
        </div>
        <div class="mt-30">
            <h4 class="mb-30">5 - Contact</h4>
            <p class="mb-30">
                But I must explain to you how all this mistaken idea of denouncing
                pleasure and praising pain was born and I will give you a complete
                account of the system, and expound the actual teachings of the great
                explorer of the truth, the master-builder of human happiness. No one
                rejects, dislikes, or avoids pleasure itself, because it is
                pleasure, but because those who do not know how to pursue pleasure
                rationally encounter consequences that are extremely painful.
            </p>
            <p class="m-0">
                Nor again is there anyone who loves or pursues or desires to obtain
                pain of itself, because it is pain, but because occasionally
                circumstances occur in which toil and pain can procure him some
                great pleasure. To take a trivial example, which of us ever
                undertakes laborious physical exercise, except to obtain some
                advantage from But who has any right to find fault with a man
            </p>
        </div>
        <div class="km_fr-images mt-30">
            <div class="row g-4 text-center">
                <div class="col-md-6">
                    <img
                        src="<?= ROOT_URL ?>public/frontend/images/terms/t1.jpg"
                        alt="images not founds"
                        class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <img
                        src="<?= ROOT_URL ?>public/frontend/images/terms/t2.jpg"
                        alt="images not founds"
                        class="img-fluid" />
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