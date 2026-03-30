<?php
require_once 'includes/functions.php';

try {
    $sql = "ALTER TABLE `categories` ADD COLUMN `image` VARCHAR(255) DEFAULT NULL AFTER `slug`;";
    $pdo->exec($sql);
    echo "Added 'image' column to categories table.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "Column 'image' already exists in categories table.\n";
    } else {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
?>
