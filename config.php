<?php
// Start session on every page that includes config
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'language_platform');
define('DB_USER', 'root'); 
define('DB_PASS', '');    

// Optional: define base URL if needed later
// define('BASE_URL', 'http://localhost/PolyGlotter/');
?>
