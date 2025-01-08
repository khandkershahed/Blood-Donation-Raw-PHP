<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

//delete session
unset($_SESSION['signin-data']);

?>

<?php
include 'views/partials/head.php';
?>

<!-- header start -->
<?php
include 'views/partials/header.php';
?>

<!-- breadcrumb start -->
<div class="breadcrumb_section overflow-hidden ptb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-8 col-sm-10 col-12 text-center">
                <h2>Login</h2>
                <ul>
                    <li><a href="<?= ROOT_URL ?>">Home</a></li>
                    <li class="active">Login Now</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- Login box section start -->
<section>
    <div class="container account-page py-5">
        <?php if (isset($_SESSION['signup-success'])) : ?>
            <div class="alert_message success">
                <p>
                    <?= $_SESSION['signup-success']; ?>
                    <?php unset($_SESSION['signup-success']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['signin'])) : ?>
            <div class="alert_message error">
                <p>
                    <?= $_SESSION['signin']; ?>
                    <?php unset($_SESSION['signin']); ?>
                </p>
            </div>
        <?php endif; ?>
        <div class="row gx-0">
            <div class="col-lg-5">
                <div>
                    <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                        <div class="card border-0 rounded-0 shadow-sm">
                            <div class="card-body p-5">
                                <div class="mb-4">
                                    <h2>L<span class="text-danger">ogi</span>n!</h2>
                                </div>
                                <div>
                                    <h4 class="mb-4">
                                        Welcome back! Please Sign in to continue.
                                    </h4>
                                    <p>
                                        <small>Sign up today to unlock exclusive content, enjoy special
                                            offers, and be the first to hear about exciting updates
                                            and announcements.</small>
                                    </p>
                                </div>
                                <div class="my-4">
                                    <label for=""><small>Email</small></label>
                                    <input
                                        type="email"
                                        class="form-control cst-input mb-3"
                                        id="StreetAddress" name="username_email" value="<?= $username_email  ?>"
                                        aria-describedby="user email"
                                        placeholder="user email" required/>
                                </div>
                                <div class="my-4 mt-3">
                                    <label for=""><small>Password</small></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button
                                                class="btn btn-danger lock-icons"
                                                type="button">
                                                <i class="fa-solid fa-lock"></i>
                                            </button>
                                        </div>
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="*******"
                                            aria-label="" name="password" value="<?= $password  ?>"
                                            aria-describedby="basic-addon1" required/>
                                    </div>
                                </div>
                                <div
                                    class="d-flex justify-content-between align-items-center pb-4">
                                    <div class="register-checkbox">
                                        <input
                                            class="inp-cbx"
                                            id="cbx-301"
                                            type="checkbox"
                                            name="blood-type" />
                                        <label class="cbx" for="cbx-301">
                                            <span>
                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </svg>
                                            </span>
                                            <span><small>Remember me on this device!</small></span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <button class="explore_now red_btn border-0 w-100" type="submit" name="submit">Login Now</button>
                                </div>
                                <div class="py-4 text-center">
                                    <p><small>Don't have an account? <a href="<?= ROOT_URL ?>registration.php" class="text-muted fw-bold">Register Now.</a></small></p>
                                    <p><small>Forgot Password? <a href="" class="text-muted fw-bold">Get New.</a></small></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="account-page-bg shadow-sm"></div>
            </div>
        </div>
    </div>
</section>
<!-- Login box section start -->

<?php
include 'views/partials/footer.php';
?>

<?php
include 'views/partials/script.php';
?>