<?php
require_once 'admin/includes/functions.php';

$columns = ["seo_title" => "VARCHAR(255) DEFAULT NULL", "seo_description" => "TEXT DEFAULT NULL"];

foreach ($columns as $col => $def) {
    try {
        $pdo->exec("ALTER TABLE products ADD COLUMN $col $def");
        echo "Added $col\n";
    } catch(Exception $e) {
        echo "$col already exists or error\n";
    }
}
?>
