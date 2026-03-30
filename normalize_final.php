<?php
require_once 'admin/includes/functions.php';

echo "STARTING DEFINITIVE NORMALIZATION...\n";

// 1. Rename full_description if it exists
try {
    $pdo->exec("ALTER TABLE products CHANGE full_description description LONGTEXT");
    echo "Renamed full_description to description.\n";
} catch (Exception $e) {
    echo "description column already correct or full_description missing.\n";
}

// 2. Ensure ALL core columns exist
$cols = [
    "tagline" => "VARCHAR(255) DEFAULT NULL AFTER name",
    "tag" => "VARCHAR(255) DEFAULT NULL AFTER slug",
    "price" => "VARCHAR(100) DEFAULT NULL AFTER tag",
    "availability" => "VARCHAR(100) DEFAULT 'In Stock' AFTER status",
    "lead_time" => "VARCHAR(100) DEFAULT '4-6 Weeks' AFTER availability",
    "features" => "TEXT DEFAULT NULL AFTER description",
    "applications" => "TEXT DEFAULT NULL AFTER features",
    "benefits" => "TEXT DEFAULT NULL AFTER applications",
    "gallery" => "TEXT DEFAULT NULL AFTER image",
    "seo_title" => "VARCHAR(255) DEFAULT NULL AFTER gallery",
    "seo_description" => "TEXT DEFAULT NULL AFTER seo_title",
    "meta_keywords" => "TEXT DEFAULT NULL AFTER seo_description"
];

foreach ($cols as $col => $def) {
    try {
        $pdo->exec("ALTER TABLE products ADD COLUMN $col $def");
        echo "Added column: $col\n";
    } catch (Exception $e) {
        echo "Column $col already exists.\n";
    }
}

// 3. Last check
echo "\nFINAL SCHEMA:\n";
$stmt = $pdo->query("DESCRIBE products");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . "\n";
}
?>
