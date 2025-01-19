<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// define('ROOT_URL', 'http://localhost:8080/');
// define('DB_HOST', '127.0.0.1');
// define('DB_USER', 'root');
// define('DB_PASS', 'root');
// define('DB_PORT', '8889');
// define('DB_NAME', 'blood');

// define('ROOT_URL', 'http://localhost:7000/');
// define('DB_HOST', '127.0.0.1');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_PORT', '3306');
// define('DB_NAME', 'blood');

define('ROOT_URL', 'https://demo.digixsolve.com/');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'digixsolve_shahed');
define('DB_PASS', 'Shahed@123');
define('DB_PORT', '3306');
define('DB_NAME', 'digixsolve_demo');