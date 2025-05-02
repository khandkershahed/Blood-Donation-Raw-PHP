<?php
// Ensure session is started before any database interaction
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/constants.php';  // Include the constants for DB connection

// Database connection using PDO
try {
    $host = DB_HOST;        // Database host
    $dbname = DB_NAME;      // Database name
    $username = DB_USER;    // Database username
    $password = DB_PASS;    // Database password
    $dbport = DB_PORT;      // Database port (8889 for MAMP or 3306 for others)
    $charset = 'utf8mb4';   // Charset for MySQL connection
    date_default_timezone_set('Asia/Dhaka');

    // Create PDO instance
    $pdo = new PDO("mysql:host=$host;port=$dbport;dbname=$dbname;charset=$charset", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If the connection fails, show an error message
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
