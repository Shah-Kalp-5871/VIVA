<?php
require_once 'admin/includes/config.php';
require_once 'admin/includes/db.php';
require_once 'admin/includes/functions.php';

echo "--- DATA RE-SYNC START ---\n";

foreach ($product_categories as $slug => $cat) {
    echo "Processing Category: {$cat['name']} ($slug)...\n";
    
    // Check if category exists
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE slug = ? OR name = ?");
    $stmt->execute([$slug, $cat['name']]);
    $cat_data = $stmt->fetch();
    
    if (!$cat_data) {
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug, image, description, status, featured) VALUES (?, ?, ?, ?, 'active', 1)");
        $stmt->execute([$cat['name'], $slug, $cat['image'], $cat['description']]);
        $cat_id = $pdo->lastInsertId();
        echo "  [NEW] Created category ID: $cat_id\n";
    } else {
        $cat_id = $cat_data['id'];
        $stmt = $pdo->prepare("UPDATE categories SET name = ?, image = ?, description = ?, status = 'active' WHERE id = ?");
        $stmt->execute([$cat['name'], $cat['image'], $cat['description'], $cat_id]);
        echo "  [UPDATE] Updated category ID: $cat_id\n";
    }
    
    // Check sub_categories/products
    if (!empty($cat['sub_categories'])) {
        foreach ($cat['sub_categories'] as $p_slug => $p) {
            $stmt = $pdo->prepare("SELECT id FROM products WHERE slug = ? OR name = ?");
            $stmt->execute([$p_slug, $p['name']]);
            $p_data = $stmt->fetch();
            
            if (!$p_data) {
                $stmt = $pdo->prepare("INSERT INTO products (category_id, name, slug, image, description, specifications, status, featured) VALUES (?, ?, ?, ?, ?, ?, 'active', 0)");
                $stmt->execute([
                    $cat_id, 
                    $p['name'], 
                    $p_slug, 
                    $p['image'], 
                    $p['description'], 
                    json_encode($p['specs'] ?? [])
                ]);
                echo "    [NEW] Created product: {$p['name']}\n";
            } else {
                $p_id = $p_data['id'];
                $stmt = $pdo->prepare("UPDATE products SET category_id = ?, name = ?, image = ?, description = ?, specifications = ?, status = 'active' WHERE id = ?");
                $stmt->execute([
                    $cat_id, 
                    $p['name'], 
                    $p['image'], 
                    $p['description'], 
                    json_encode($p['specs'] ?? []),
                    $p_id
                ]);
                echo "    [UPDATE] Updated product: {$p['name']}\n";
            }
        }
    }
}

echo "--- SYNC COMPLETE ---\n";
