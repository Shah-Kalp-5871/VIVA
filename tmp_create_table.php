<?php
require_once 'admin/includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS `lead_submissions` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) DEFAULT NULL,
        `phone` varchar(20) DEFAULT NULL,
        `status` enum('new','read','contacted') DEFAULT 'new',
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
    echo "Table 'lead_submissions' created successfully.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage() . "\n");
}
?>
