<?php
/**
 * VIVA Admin Configuration
 */

// Define absolute path to admin folder
if (!defined('ADMIN_PATH')) {
    define('ADMIN_PATH', realpath(__DIR__ . '/../'));
}

// Define absolute path to project root
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(ADMIN_PATH . '/../'));
}

// Define Base URL for Admin (relative to project root)
// Assuming the project is at http://localhost/VIVA/
if (!defined('ADMIN_URL')) {
    define('ADMIN_URL', '/VIVA/admin');
}

// Include the main product data
require_once ROOT_PATH . '/data/products-data.php';

// Include the site settings data
require_once ROOT_PATH . '/data/site-settings.php';

// Include the database connection
require_once __DIR__ . '/db.php';

// Include core helper functions
require_once __DIR__ . '/functions.php';

// Session management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Simple Auth Check (Optional - can be expanded later)
function check_admin_login() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: ' . ADMIN_URL . '/login.php');
        exit();
    }
}

?>
