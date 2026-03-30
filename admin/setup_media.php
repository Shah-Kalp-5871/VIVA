<?php
require_once 'includes/functions.php';

try {
    // 1. Create Media Table
    $sql = "CREATE TABLE IF NOT EXISTS `media` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `file_name` varchar(255) NOT NULL,
        `file_path` varchar(255) NOT NULL,
        `file_type` varchar(100) DEFAULT NULL,
        `file_size` int(11) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
    echo "Media table created successfully.\n";

    // 2. Create Upload Directory
    $upload_dir = '../uploads/media/';
    if (!file_exists($upload_dir)) {
        if (mkdir($upload_dir, 0755, true)) {
            echo "Upload directory created: $upload_dir\n";
        } else {
            echo "Failed to create upload directory.\n";
        }
    } else {
        echo "Upload directory already exists.\n";
    }

} catch (PDOException $e) {
    echo "Error setting up media library: " . $e->getMessage() . "\n";
}
?>
