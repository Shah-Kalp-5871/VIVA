<?php
require 'admin/includes/functions.php';

echo "=== CATEGORIES TABLE COLUMNS ===" . PHP_EOL;
try {
    $cols = $pdo->query("SHOW COLUMNS FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    foreach($cols as $c) echo "  " . $c['Field'] . " (" . $c['Type'] . ")" . PHP_EOL;
} catch(Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "=== PRODUCTS TABLE COLUMNS ===" . PHP_EOL;
try {
    $cols = $pdo->query("SHOW COLUMNS FROM products")->fetchAll(PDO::FETCH_ASSOC);
    foreach($cols as $c) echo "  " . $c['Field'] . " (" . $c['Type'] . ")" . PHP_EOL;
} catch(Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "=== ALL CATEGORIES ===" . PHP_EOL;
try {
    $cats = $pdo->query("SELECT id, name, slug, parent_id, status FROM categories ORDER BY COALESCE(parent_id, 0), id")->fetchAll(PDO::FETCH_ASSOC);
    echo "Total: " . count($cats) . PHP_EOL;
    foreach($cats as $c) {
        echo sprintf("  [%d] %s (slug: %s, parent: %s, status: %s)" . PHP_EOL, 
            $c['id'], $c['name'], $c['slug'] ?: 'MISSING', $c['parent_id'] ?: 'ROOT', $c['status']);
    }
} catch(Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "=== ALL PRODUCTS ===" . PHP_EOL;
try {
    $prods = $pdo->query("SELECT p.id, p.name, p.slug, p.category_id, c.name as cat_name, p.description, p.features, p.specifications, p.status FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.category_id, p.id")->fetchAll(PDO::FETCH_ASSOC);
    echo "Total: " . count($prods) . PHP_EOL;
    foreach($prods as $p) {
        echo sprintf("  [%d] %s | Cat: %s | slug: %s | desc: %s | specs: %s | feat: %s" . PHP_EOL, 
            $p['id'], $p['name'], $p['cat_name'] ?: 'NONE', $p['slug'] ?: 'MISSING',
            !empty($p['description']) ? 'YES' : 'NO',
            !empty($p['specifications']) ? 'YES' : 'NO',
            !empty($p['features']) ? 'YES' : 'NO');
    }
} catch(Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}
