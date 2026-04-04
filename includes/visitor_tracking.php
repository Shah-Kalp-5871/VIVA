<?php
/**
 * Visitor Tracking System
 * Logs unique IP addresses once per day.
 */

// Ensure database connection is available
if (!isset($pdo)) {
    require_once __DIR__ . '/../admin/includes/db.php';
}

$ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$today = date('Y-m-d');

try {
    // Check if this IP has already visited today
    $stmt = $pdo->prepare("SELECT id FROM visitors WHERE ip_address = ? AND visit_date = ? LIMIT 1");
    $stmt->execute([$ip, $today]);
    $exists = $stmt->fetch();

    if (!$exists) {
        // First visit of the day for this IP, log it
        $insert = $pdo->prepare("INSERT INTO visitors (ip_address, visit_date) VALUES (?, ?)");
        $insert->execute([$ip, $today]);
    }
} catch (PDOException $e) {
    // Fail silently in production to avoid breaking the page
    error_log("Visitor tracking error: " . $e->getMessage());
}
?>
