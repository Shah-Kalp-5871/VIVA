<?php
require_once 'admin/includes/db.php';

echo "--- DEEP DB DIAGNOSTIC ---\n";

// Categories
echo "CATEGORIES TABLE:\n";
$cats = $pdo->query("SELECT id, name, parent_id, status, length(status) as s_len FROM categories")->fetchAll(PDO::FETCH_ASSOC);
foreach ($cats as $c) {
    echo "  ID: {$c['id']} | Name: {$c['name']} | Parent: " . ($c['parent_id'] ?? 'NULL') . " | Status: [{$c['status']}] (Len: {$c['s_len']})\n";
}

// Products
echo "\nPRODUCTS TABLE:\n";
$prods = $pdo->query("SELECT id, name, status, length(status) as s_len FROM products LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
foreach ($prods as $p) {
    echo "  ID: {$p['id']} | Name: {$p['name']} | Status: [{$p['status']}] (Len: {$p['s_len']})\n";
}

echo "--- END DIAGNOSTIC ---\n";
