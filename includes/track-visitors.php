<?php
/**
 * VIVA Unique Daily Visitor Tracker
 * Adaption of Laravel Visitor logic for Vanilla PHP
 */

// Helper to get real IP Address
function get_visitor_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ip_address = get_visitor_ip();
$visit_date = date('Y-m-d');

// Include global DB connection from header context
// Note: This script assumes $pdo is already available as a global from includes/header.php context
if (isset($pdo)) {
    try {
        // Unique Daily Check (Handled by DB constraint, but we check here to avoid DB exceptions)
        $query = "SELECT id FROM visitors WHERE ip_address = :ip AND visit_date = :vdate LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['ip' => $ip_address, 'vdate' => $visit_date]);
        
        if (!$stmt->fetch()) {
            // New record if not already visited today
            $insert_query = "INSERT INTO visitors (ip_address, visit_date) VALUES (:ip, :vdate)";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->execute(['ip' => $ip_address, 'vdate' => $visit_date]);
        }
    } catch (PDOException $e) {
        // Silently fail to avoid breaking the frontend
        error_log("Visitor Tracking Error: " . $e->getMessage());
    }
}
?>
