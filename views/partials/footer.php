<footer>
    <div class="footer_top footer_top2">
        <div class="container">
            <div class="row footer_middle align-items-center">
                <div class="col-xl-6 col-lg-6 col-12 mb-5">
                    <div class="footer_subscrive">
                        <h5>About Us</h5>
                        <p class="pt-3">
                            Every drop counts! By donating blood, you can help save lives and make a difference in someone's life. Join us in our mission to spread hope and support those in need.
                        </p>
                        <ul class="pt-3">
                            <li><span>Phone:</span> 015 766 *****</li>
                            <li><span>Email:</span> donor.reciver@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-12">
                    <div class="footer_social">
                        <ul
                            class="social_icon d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-center gap-2">
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
                        <ul
                            class="page_link d-flex justify-content-xxl-end justify-content-xl-end justify-content-lg-end justify-content-center gap-2 flex-wrap">
                            <li><a href="<?= ROOT_URL ?>privacy.php">Privacy Policy</a></li>
                            <li><a href="#">/</a></li>
                            <li><a href="<?= ROOT_URL ?>terms.php">Terms & Condition</a></li>
                            <li><a href="#">/</a></li>
                            <li><a href="<?= ROOT_URL ?>faq.php">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p>Copyright &copy; 2025 BloodProject. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->

<!-- mobile menu offcanvas -->
<div class="offcanvas offcanvas-start" id="offcanvas-mobile">
    <div class="offcanvas-body">
        <div class="mobile-menu">
            <a href="<?= ROOT_URL ?>" class="py-3">
                <h3 class="text-danger">Blood Boonds</h3>
            </a>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"></button>

            <ul
                class="accordion accordion-flush mobile_dropdown"
                id="accordionFlushExample">
                <li class="accordion-item">
                    <h2>
                        <button
                            class="accordion-button collapsed p-3"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false">
                            Home
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="<?= ROOT_URL ?>">Home</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="accordion-item">
                    <h2><a href="<?= ROOT_URL ?>about.php">About</a></h2>
                </li>
                
                
                <li class="accordion-item">
                    <h2><a href="<?= ROOT_URL ?>contact.php">Contact</a></h2>
                </li>
            </ul>
        </div>
    </div>
</div>