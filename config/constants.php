<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_URL', 'http://localhost:8080/');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_PORT', '8889');
define('DB_NAME', 'blood');
