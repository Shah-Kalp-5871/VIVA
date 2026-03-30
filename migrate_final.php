<?php
require_once 'admin/includes/functions.php';

$columns_to_add = [
    "tagline" => "VARCHAR(255) DEFAULT NULL AFTER name",
    "tag" => "VARCHAR(255) DEFAULT NULL AFTER slug",
    "availability" => "VARCHAR(100) DEFAULT 'In Stock' AFTER status",
    "lead_time" => "VARCHAR(100) DEFAULT '4-6 Weeks' AFTER availability",
    "features" => "TEXT DEFAULT NULL AFTER description",
    "applications" => "TEXT DEFAULT NULL AFTER features",
    "benefits" => "TEXT DEFAULT NULL AFTER applications",
    "gallery" => "TEXT DEFAULT NULL AFTER image",
    "meta_keywords" => "TEXT DEFAULT NULL AFTER seo_description"
];

foreach ($columns_to_add as $col => $definition) {
    try {
        $pdo->exec("ALTER TABLE products ADD COLUMN $col $definition");
        echo "Added column: $col\n";
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
            echo "Column $col already exists.\n";
        } else {
            echo "Error adding $col: " . $e->getMessage() . "\n";
        }
    }
}

echo "\n--- Current Schema ---\n";
$stmt = $pdo->query("DESCRIBE products");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . "\n";
}
?>
