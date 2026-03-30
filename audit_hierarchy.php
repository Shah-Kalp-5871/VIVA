<?php
require 'admin/includes/db.php';

function listChildren($pdo, $parentId = null, $indent = 0) {
    if ($parentId === null) {
        $stmt = $pdo->query("SELECT id, name, slug FROM categories WHERE parent_id IS NULL ORDER BY id ASC");
    } else {
        $stmt = $pdo->prepare("SELECT id, name, slug FROM categories WHERE parent_id = ? ORDER BY name ASC");
        $stmt->execute([$parentId]);
    }
    
    while ($cat = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo str_repeat("  ", $indent) . "C: " . $cat['name'] . " (" . $cat['slug'] . ")\n";
        
        // List subcategories
        listChildren($pdo, $cat['id'], $indent + 1);
        
        // List products in this category
        $stmtP = $pdo->prepare("SELECT id, name, slug FROM products WHERE category_id = ? ORDER BY name ASC");
        $stmtP->execute([$cat['id']]);
        while ($prod = $stmtP->fetch(PDO::FETCH_ASSOC)) {
            echo str_repeat("  ", $indent + 1) . "P: " . $prod['name'] . " (" . $prod['slug'] . ")\n";
        }
    }
}

echo "--- VIVA PRODUCT HIERARCHY AUDIT ---\n";
listChildren($pdo);
?>
