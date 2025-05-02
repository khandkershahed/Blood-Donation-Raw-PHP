 <header>
     <div class="header_top d-none d-lg-block d-xl-block d-xxl-block">
         <div class="container">
             <div class="row">
                 <div class="col-xl-3 col-lg-3">
                     <div class="header_top_content">
                         <span><i class="fa-solid fa-phone"></i></span>
                         <a href="tel:01977259912">+880 1705 5555 555</a>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-3">
                     <div class="header_top_content">
                         <span><i class="fa-solid fa-envelope"></i></span>
                         <a href="mailto:donate.recive@gmail.com">bloodbonds@gmail.com</a>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-3">
                     <div class="header_top_content">
                         <span><i class="fa-solid fa-location-dot"></i></span>
                         <a href="#">Dhaka, Bangladesh</a>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-3">
                     <div class="header_top_social">
                         <p>Follow Us</p>
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
                 </div>
             </div>
         </div>
     </div>
     <div class="header_bottom">
         <div class="container">
             <div class="row align-items-center position-relative">
                 <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                     <div class="header_logo">
                         <a href="<?= ROOT_URL ?>">
                             <div>
                                 <img src="public/images/main-logo.png" alt="">
                             </div>
                         </a>
                     </div>
                 </div>
                 <div class="col-xl-8 col-lg-8 d-none d-xxl-block d-xl-block">
                     <ul class="main_menu">
                         <li><a href="<?= ROOT_URL ?>">Home</a></li>
                         <!-- <li><a href="<?= ROOT_URL ?>volunteer.php">Volunteer</a></li> -->
                         <li><a href="<?= ROOT_URL ?>user/findDonor.php">Find Donor</a></li>
                         <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                         <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                     </ul>
                 </div>
                 <div class="col-xl-2 col-lg-2 d-none d-xxl-block d-xl-block">
                     <div class="header_search_menu d-flex">
                         <ul class="main_menu login-menu">
                             <li class="position-relative">
                                 <a href="javascript:void(0)"><i class="fa-regular fa-circle-user fs-2 text-danger"></i></a>
                                 <ul class="submenu_wrapper">
                                     <?php
                                        if (session_status() == PHP_SESSION_NONE) {
                                            session_start();
                                        }

                                        if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true):
                                            // User is logged in, display Dashboard and Profile
                                        ?>
                                         <li>
                                             <a href="<?= ROOT_URL ?>dashboard.php">
                                                 Dashboard
                                             </a>
                                         </li>
                                         <li>
                                             <a href="<?= ROOT_URL ?>user/myprofile.php">
                                                 Profile
                                             </a>
                                         </li>
                                         <li>
                                             <a href="<?= ROOT_URL ?>logout.php">
                                                 Logout
                                             </a>
                                         </li>
                                     <?php else: ?>
                                         <!-- User is not logged in, show Login and Register links -->
                                         <li>
                                             <a href="<?= ROOT_URL ?>login.php">
                                                 <svg
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     version="1.1"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     width="30"
                                                     height="30"
                                                     x="0"
                                                     y="0"
                                                     viewBox="0 0 377 377"
                                                     style="enable-background: new 0 0 512 512"
                                                     xml:space="preserve"
                                                     class="">
                                                     <g>
                                                         <linearGradient
                                                             id="a"
                                                             x1="71.1"
                                                             x2="67.962"
                                                             y1="329.164"
                                                             y2="95.368"
                                                             gradientUnits="userSpaceOnUse">
                                                             <stop offset="0" stop-color="#f38572"></stop>
                                                             <stop offset=".413" stop-color="#e2605f"></stop>
                                                             <stop offset=".782" stop-color="#d64551"></stop>
                                                             <stop offset="1" stop-color="#d23b4c"></stop>
                                                         </linearGradient>
                                                         <path
                                                             fill="#d64c52"
                                                             d="M121.799 333.598H90.84c-13.063 0-23.691-10.628-23.691-23.691V188.46h4.479v121.446c0 10.593 8.619 19.211 19.212 19.211h30.959z"
                                                             opacity="1"
                                                             data-original="#d64c52"></path>
                                                         <path
                                                             fill="#b8b1bb"
                                                             d="M50.042 185.222h10.723v15.133H50.042zM77.664 185.222h10.723v15.133H77.664z"
                                                             opacity="1"
                                                             data-original="#b8b1bb"></path>
                                                         <path
                                                             fill="#e5dcdf"
                                                             d="m113.798 49.865-12.917-8.827a56.317 56.317 0 0 0-63.408 0l-13.094 8.827c-4.552 3.099-7.404 8.25-7.404 13.757v77.305c0 9.232 2.932 18.638 8.149 26.254L37.89 186h62.649l12.526-18.819c5.218-7.617 7.911-17.022 7.911-26.254V63.622c-.001-5.507-2.626-10.658-7.178-13.757zM87.014 52h-35.61c-2.789 0-3.903-3.775-1.599-5.348l.272-.271c5.665-3.857 12.282-5.947 19.136-5.947a33.86 33.86 0 0 1 19.135 5.887l.265.341C90.917 48.234 89.804 52 87.014 52z"
                                                             opacity="1"
                                                             data-original="#e5dcdf"></path>
                                                         <path
                                                             fill="#f4d7c3"
                                                             d="M314.004 319.159h46.021v56.965h-46.021zM90.901 319.159h46.021v56.965H90.901z"
                                                             opacity="1"
                                                             data-original="#f4d7c3"
                                                             class=""></path>
                                                         <path
                                                             fill="#b8b1bb"
                                                             d="M136.475 206c-26 3-46.5 24.753-46.5 51.612V322h46v55h178v-55h46v-64.388c0-26.859-20.5-48.612-45.5-51.612z"
                                                             opacity="1"
                                                             data-original="#b8b1bb"></path>
                                                         <path
                                                             fill="#fcf5f0"
                                                             d="M313.738 339.531h33.157v17.023h-33.157z"
                                                             opacity="1"
                                                             data-original="#fcf5f0"></path>
                                                         <path
                                                             fill="#d64c52"
                                                             d="m195.532 311.36 30.755-58.501 30.755 58.501c12.163 23.137-4.616 50.913-30.754 50.913-26.14 0-42.919-27.777-30.756-50.913z"
                                                             opacity="1"
                                                             data-original="#d64c52"></path>
                                                         <path
                                                             fill="#fcf5f0"
                                                             d="M244.975 317h-12v-12h-15v12h-11v15h11v11h15v-11h12z"
                                                             opacity="1"
                                                             data-original="#fcf5f0"></path>
                                                         <path
                                                             fill="#f4bba2"
                                                             d="M163.05 118.559c8.337 0 15.158-6.821 15.158-15.158V88.784c0-8.337-6.821-15.158-15.158-15.158s-15.158 6.821-15.158 15.158V103.4c0 8.338 6.821 15.159 15.158 15.159zM288.699 118.559c-8.337 0-15.158-6.821-15.158-15.158V88.784c0-8.337 6.821-15.158 15.158-15.158s15.158 6.821 15.158 15.158V103.4c.001 8.338-6.82 15.159-15.158 15.159z"
                                                             opacity="1"
                                                             data-original="#f4bba2"
                                                             class=""></path>
                                                         <path
                                                             fill="#f4d7c3"
                                                             d="M236.454 235.905H216.12c-11.703 0-21.19-9.487-21.19-21.19V109.516h62.715v105.198c-.001 11.704-9.488 21.191-21.191 21.191z"
                                                             opacity="1"
                                                             data-original="#f4d7c3"
                                                             class=""></path>
                                                         <path
                                                             fill="#f4bba2"
                                                             d="M256.975 214.198V119h-63v63.834z"
                                                             opacity="1"
                                                             data-original="#f4bba2"
                                                             class=""></path>
                                                         <path
                                                             fill="#f4d7c3"
                                                             d="M226.287 180.804c-35.233 0-64.06-28.827-64.06-64.06V56.865c0-31.212 25.537-56.749 56.749-56.749h14.622c31.212 0 56.749 25.537 56.749 56.749v59.879c0 35.233-28.827 64.06-64.06 64.06z"
                                                             opacity="1"
                                                             data-original="#f4d7c3"
                                                             class=""></path>
                                                         <path
                                                             fill="#f4bba2"
                                                             d="M226.287 131.336c-4.79 0-8.709-3.919-8.709-8.709v-13.043c0-4.79 3.919-8.709 8.709-8.709 4.79 0 8.709 3.919 8.709 8.709v13.043c-.001 4.79-3.919 8.709-8.709 8.709z"
                                                             opacity="1"
                                                             data-original="#f4bba2"
                                                             class=""></path>
                                                         <g fill="#3a2f32">
                                                             <path
                                                                 d="M226.287 153.477c-6.294 0-12.193-2.435-16.613-6.854l1.414-1.414c4.042 4.043 9.44 6.269 15.199 6.269s11.157-2.226 15.199-6.269l1.414 1.414c-4.42 4.419-10.319 6.854-16.613 6.854zM197.113 96.092a4.524 4.524 0 0 1-4.511-4.511v-4.38a4.524 4.524 0 0 1 4.511-4.511 4.524 4.524 0 0 1 4.511 4.511v4.38a4.524 4.524 0 0 1-4.511 4.511zM255.461 96.092a4.524 4.524 0 0 0 4.511-4.511v-4.38a4.524 4.524 0 0 0-4.511-4.511 4.524 4.524 0 0 0-4.511 4.511v4.38a4.524 4.524 0 0 0 4.511 4.511z"
                                                                 fill="#3a2f32"
                                                                 opacity="1"
                                                                 data-original="#3a2f32"></path>
                                                         </g>
                                                         <path
                                                             fill="#7c5952"
                                                             d="M233.598 0h-14.622c-31.212 0-57.001 24.653-57.001 55.865v16.726c88-1.533 88.755-42.753 88.755-42.753s1.245 36.041 39.245 42.75V55.865C289.975 24.653 264.81 0 233.598 0z"
                                                             opacity="1"
                                                             data-original="#7c5952"
                                                             class=""></path>
                                                         <path
                                                             fill="#d64c52"
                                                             d="M112.252 67.605v68.491a52.637 52.637 0 0 1-9.177 29.695l-7.198 10.534H42.551l-7.198-10.534a52.63 52.63 0 0 1-9.177-29.695V67.605c0-.875.585-1.642 1.429-1.873l15.579-4.269a98.498 98.498 0 0 1 52.052-.002l15.588 4.27a1.944 1.944 0 0 1 1.428 1.874z"
                                                             opacity="1"
                                                             data-original="#d64c52"></path>
                                                         <path
                                                             fill="#ffffff"
                                                             d="M38.389 83.548h61.651v59.185H38.389z"
                                                             opacity="1"
                                                             data-original="#ffffff"
                                                             class=""></path>
                                                         <path
                                                             fill="#3a2f32"
                                                             d="M45.975 90h46v2h-46zM45.975 136h46v2h-46z"
                                                             opacity="1"
                                                             data-original="#3a2f32"></path>
                                                         <path
                                                             fill="url(#a)"
                                                             d="M65.405 176.324h7.618v24.621h-7.618z"
                                                             opacity="1"
                                                             data-original="url(#a)"></path>
                                                     </g>
                                                 </svg>
                                                 Login
                                             </a>
                                         </li>
                                         <li>
                                             <a href="<?= ROOT_URL ?>registration.php">
                                                 <svg
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     version="1.1"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     width="30"
                                                     height="30"
                                                     x="0"
                                                     y="0"
                                                     viewBox="0 0 510 510"
                                                     style="enable-background: new 0 0 512 512"
                                                     xml:space="preserve"
                                                     fill-rule="evenodd"
                                                     class="">
                                                     <g>
                                                         <path
                                                             fill="#efc7a4"
                                                             d="m411.374 146.484-.082-16.967c0-7.689 6.29-13.978 13.965-13.992 7.689 0 13.978 6.29 13.978 13.965v11.33l.08 86.466-.08-86.466c0-7.689 6.29-13.979 13.965-13.979 7.689 0 13.979 6.276 13.979 13.965v114.681-46.702s1.536-11.62 13.842-11.644c7.689-.015 13.979 6.276 13.979 13.965l-.557 64.975c0 19.459-7.998 37.05-20.887 49.663v167.748h-96.693V326.225c-13.176-12.645-21.376-30.436-21.376-50.144l-.068-114.885c0-7.675 6.276-13.964 13.965-13.978 7.675 0 14.02 6.299 14.02 13.988l-.055 66.025.054-66.025-.054-14.708c0-7.675 6.289-13.965 13.964-13.979 7.689 0 13.979 6.276 13.979 13.965v80.747"
                                                             opacity="1"
                                                             data-original="#efc7a4"></path>
                                                         <g fill="#d5a889">
                                                             <path
                                                                 d="M411.292 217.231c0 3.863-3.137 7-7 7s-7-3.137-7-7v-84.712h.021c7.689 0 13.979 6.276 13.979 13.965zM439.209 205.237c0 3.863-3.136 7-7 7-3.863 0-7-3.137-7-7v-89.712h.022c7.689 0 13.978 6.276 13.978 13.965zM467.153 246.554c0 3.863-3.137 7-7 7-3.864 0-7-3.137-7-7V126.842h.021c7.689 0 13.979 6.276 13.979 13.965zM383.349 159.97v62.587c0 3.863-3.137 7-7 7-3.864 0-7-3.137-7-7v-75.339h.035c7.259 0 13.329 5.635 13.965 12.752z"
                                                                 fill="#d5a889"
                                                                 opacity="1"
                                                                 data-original="#d5a889"></path>
                                                         </g>
                                                         <path
                                                             fill="#efc7a4"
                                                             d="M383.349 227.231v-95.733m83.83 9.308v114.681M439.235 129.49l.08 97.796m-28.023-97.769v97.714"
                                                             opacity="1"
                                                             data-original="#efc7a4"></path>
                                                         <path
                                                             fill="#eb5463"
                                                             d="M116.343 302.761c0-3.864 3.136-7 7-7 3.863 0 7 3.136 7 7 0 20.136-3.741 68.206 5.822 94.43 12.72 34.884 24.799 63.044 66.382 74.842 28.925 8.207 68.424 7.919 106.118 4.422 16.32-1.514 36.224-2.533 54.471-6.832 16.768-3.95 32.204-10.563 41.127-23.881 7.054-10.528 10.513-26.767 12.372-42.39 2.919-24.536 1.586-37.764 1.586-37.764-.222-3.857 2.729-7.169 6.586-7.391s7.169 2.73 7.391 6.587c0 0 1.408 14.424-1.661 40.222-2.134 17.934-6.546 36.443-14.643 48.529-8.763 13.079-22.377 21.313-38.059 26.497-21.72 7.181-47.476 8.47-67.877 10.363-39.515 3.666-80.91 3.71-111.232-4.893-46.857-13.295-61.381-44.207-75.714-83.515-10.052-27.565-6.669-78.059-6.669-99.226z"
                                                             opacity="1"
                                                             data-original="#eb5463"
                                                             class=""></path>
                                                         <path
                                                             fill="#f76c82"
                                                             d="M107.113 284.535h32.19v39.947h-32.19z"
                                                             opacity="1"
                                                             data-original="#f76c82"
                                                             class=""></path>
                                                         <path
                                                             fill="#e4e8eb"
                                                             d="M92.211 269.821H27.526A12.526 12.526 0 0 1 15 257.294V66.614a50.106 50.106 0 0 1 50.105-50.106H181.31a50.103 50.103 0 0 1 50.106 50.106v190.68a12.53 12.53 0 0 1-12.527 12.527h-64.685v26.88H92.211z"
                                                             opacity="1"
                                                             data-original="#e4e8eb"
                                                             class=""></path>
                                                         <path
                                                             fill="#f76c82"
                                                             d="M163.278 54.298c17.958 0 32.516 14.558 32.516 32.517v114.343c0 17.959-14.558 32.517-32.516 32.517h-80.14c-17.959 0-32.517-14.558-32.517-32.517V86.815c0-17.959 14.558-32.517 32.517-32.517z"
                                                             opacity="1"
                                                             data-original="#f76c82"
                                                             class=""></path>
                                                         <path
                                                             fill="#eb5463"
                                                             d="M50.64 202.265a33.864 33.864 0 0 1-.019-1.107v-12.893h32.19c3.863 0 7 3.137 7 7 0 3.864-3.137 7-7 7zM50.621 168.079v-14h32.19c3.863 0 7 3.137 7 7 0 3.864-3.137 7-7 7zM50.621 133.894v-14h32.19c3.863 0 7 3.136 7 7 0 3.863-3.137 7-7 7zM50.621 99.708V86.815c0-.371.007-.74.019-1.107h32.171c3.863 0 7 3.136 7 7 0 3.863-3.137 7-7 7z"
                                                             opacity="1"
                                                             data-original="#eb5463"
                                                             class=""></path>
                                                         <path
                                                             fill="#e4e8eb"
                                                             d="M445.211 349.233a5.636 5.636 0 0 1 5.636 5.636v16.984a5.636 5.636 0 0 1-5.636 5.636h-39.377a5.636 5.636 0 0 1-5.636-5.636v-16.984a5.636 5.636 0 0 1 5.636-5.636z"
                                                             opacity="1"
                                                             data-original="#e4e8eb"
                                                             class=""></path>
                                                     </g>
                                                 </svg>
                                                 Register
                                             </a>
                                         </li>
                                     <?php endif; ?>
                                 </ul>
                             </li>
                         </ul>


                     </div>
                 </div>

                 <!-- mobile menu bar -->
                 <div class="col-lg-10 col-md-8 col-6 d-block d-xxl-none d-xl-none">
                     <div class="d-flex align-items-center gap-2 justify-content-end">
                         <div class="dropdown dropdown_search">
                             <button
                                 class="search-btn"
                                 data-bs-toggle="dropdown"
                                 aria-expanded="true">
                                 <i class="fa-solid fa-magnifying-glass"></i>
                             </button>
                             <div
                                 class="dropdown-menu dropdown-menu-end"
                                 data-popper-placement="bottom-end">
                                 <form class="search-form d-flex align-items-center gap-2">
                                     <input
                                         type="text"
                                         placeholder="Search..."
                                         class="theme-input bg-transparent" />
                                     <button type="submit" class="submit-btn">Go</button>
                                 </form>
                             </div>
                         </div>
                         <div class="mobile_menu">
                             <button
                                 class="header_toggle_btn bg-transparent border-0"
                                 type="button"
                                 data-bs-toggle="offcanvas"
                                 data-bs-target="#offcanvas-mobile">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </header>