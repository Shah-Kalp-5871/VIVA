<?php
require_once 'admin/includes/db.php';

echo "--- CATEGORY NULL PARENT DIAGNOSTIC ---\n";
$stmt = $pdo->query("SELECT id, name, parent_id, status FROM categories WHERE parent_id IS NULL");
$cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($cats)) {
    echo "NO CATEGORIES WITH NULL PARENT FOUND!\n";
    // Check if they have 0 instead
    $stmt2 = $pdo->query("SELECT id, name, parent_id FROM categories WHERE parent_id = 0");
    $cats2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    echo "Count with parent_id = 0: " . count($cats2) . "\n";
} else {
    echo "Found " . count($cats) . " categories with NULL parent.\n";
    foreach ($cats as $c) {
        echo "  - {$c['name']} | Status: [{$c['status']}] | Image: [{$c['image']}]\n";
    }
}

echo "--- END ---";
