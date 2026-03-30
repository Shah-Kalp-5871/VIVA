<?php
require_once 'admin/includes/db.php';

echo "--- CATEGORIES ---\n";
$stmt = $pdo->query("SELECT id, name, parent_id, slug, status FROM categories");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Status: {$row['status']} | Parent: {$row['parent_id']} | Slug: {$row['slug']}\n";
}

echo "\n--- PRODUCTS ---\n";
$stmt = $pdo->query("SELECT id, name, category_id, slug, status FROM products");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Status: {$row['status']} | Cat: {$row['category_id']} | Slug: {$row['slug']}\n";
}
