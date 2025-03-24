<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Blood Bonds</title>

    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="<?= ROOT_URL ?>public/images/fab.png" />

    <!-- CSS Files with Cache Busting -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>public/frontend/css/animate.css?v=<?= filemtime('public/frontend/css/animate.css') ?>" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>public/frontend/css/bootstrap.min.css?v=<?= filemtime('public/frontend/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>public/frontend/css/all.css?v=<?= filemtime('public/frontend/css/all.css') ?>" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>public/frontend/css/slick.css?v=<?= filemtime('public/frontend/css/slick.css') ?>" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>public/frontend/css/fancybox.css?v=<?= filemtime('public/frontend/css/fancybox.css') ?>" />
    <link rel="stylesheet" href="<?= ROOT_URL ?>public/frontend/css/style.css?v=<?= filemtime('public/frontend/css/style.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>



<body>
    <!--preloader start-->
    <div class="preloader">
        <div>
            <img class="img-fluid" width="300px" src="public/images/main-logo.png" alt="">
        </div>
        <div class="preload-progress">
            <span></span>
        </div>
    </div>
    <!--preloader end-->

    <!-- scroll to top -->
    <div class="progress-wrap cursor-pointer active-progress">
        <svg
            class="progress-circle svg-content"
            width="100%"
            height="100%"
            viewBox="-1 -1 102 102">
            <path
                d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="
            transition: stroke-dashoffset 10ms linear 0s;
            stroke-dasharray: 307.919, 307.919;
            stroke-dashoffset: 221.377;
          "></path>
        </svg>
    </div>
    <!-- scroll to top -->