<?php
require_once 'admin/includes/db.php';

echo "--- DB DIAGNOSTIC ---\n";

// Count Active Parent Categories
$cat_count = $pdo->query("SELECT COUNT(*) FROM categories WHERE parent_id IS NULL AND status = 'active'")->fetchColumn();
echo "Active Parent Categories: $cat_count\n";

// List them
$cats = $pdo->query("SELECT id, name, slug, status FROM categories WHERE parent_id IS NULL")->fetchAll(PDO::FETCH_ASSOC);
foreach ($cats as $c) {
    echo "  - [{$c['status']}] {$c['name']} ({$c['slug']})\n";
}

// Count Active Products
$prod_count = $pdo->query("SELECT COUNT(*) FROM products WHERE status = 'active'")->fetchColumn();
echo "Active Products: $prod_count\n";

// Sample Products
$prods = $pdo->query("SELECT name, status FROM products LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
foreach ($prods as $p) {
    echo "  - [{$p['status']}] {$p['name']}\n";
}

echo "--- END DIAGNOSTIC ---\n";
