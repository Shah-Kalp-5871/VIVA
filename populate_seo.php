<?php
require 'admin/includes/db.php';

// Function to generate keywords from a name
function generateKeywords($name) {
    $words = explode(' ', strtolower($name));
    $keywords = array_unique(array_merge($words, ['viva engineering', 'industrial machinery', 'manufacturer', 'india', 'exporter']));
    return implode(', ', array_slice($keywords, 0, 10));
}

// 1. Update Categories
$categories = $pdo->query("SELECT id, name, description FROM categories")->fetchAll();
foreach ($categories as $cat) {
    $title = $cat['name'] . " | Industrial Machinery Manufacturer | VIVA Engineering";
    $desc = !empty($cat['description']) ? mb_strimwidth(strip_tags($cat['description']), 0, 160, "...") : "Explore high-quality industrial " . $cat['name'] . " solutions by VIVA Engineering. Leading manufacturer and exporter of performance-driven machinery.";
    $key = generateKeywords($cat['name']);
    
    $stmt = $pdo->prepare("UPDATE categories SET seo_title = ?, seo_description = ?, meta_keywords = ? WHERE id = ?");
    $stmt->execute([$title, $desc, $key, $cat['id']]);
}

// 2. Update Products
$products = $pdo->query("SELECT id, name, description FROM products")->fetchAll();
foreach ($products as $prod) {
    $title = $prod['name'] . " - High Performance Machinery | VIVA Engineering";
    $desc = !empty($prod['description']) ? mb_strimwidth(strip_tags($prod['description']), 0, 160, "...") : "Get the technical specifications and features of the " . $prod['name'] . " by VIVA Engineering. Built for durability and precision.";
    $key = generateKeywords($prod['name']);
    
    $stmt = $pdo->prepare("UPDATE products SET seo_title = ?, seo_description = ?, meta_keywords = ? WHERE id = ?");
    $stmt->execute([$title, $desc, $key, $prod['id']]);
}

echo "SEO fields successfully populated for " . count($categories) . " categories and " . count($products) . " products.";
?>
