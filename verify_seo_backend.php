<?php
require 'admin/includes/db.php';

echo "--- PRODUCT SEO CHECK (Example) ---\n";
$stmt = $pdo->query("SELECT name, seo_title, seo_description, meta_keywords FROM products LIMIT 1");
$prod = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($prod);

echo "\n--- CATEGORY SEO CHECK (Example) ---\n";
$stmt = $pdo->query("SELECT name, seo_title, seo_description, meta_keywords FROM categories WHERE parent_id IS NULL LIMIT 1");
$cat = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($cat);

echo "\n--- FRONTEND RENDERING CHECK ---\n";
// We can't easily run a full request, but we can check if the variables are being used in a simulated include
$page_title = "Test Title";
$meta_description = "Test Desc";
$meta_keywords = "Test Key";
ob_start();
include 'includes/header.php';
$output = ob_get_clean();

if (strpos($output, '<title>Test Title |') !== false && 
    strpos($output, 'name="description" content="Test Desc"') !== false &&
    strpos($output, 'name="keywords" content="Test Key"') !== false) {
    echo "SUCCESS: Header correctly renders dynamic SEO tags.\n";
} else {
    echo "FAILURE: Header does not render dynamic SEO tags correctly.\n";
    // Echo first 500 chars of output for debugging if failed
    // echo substr($output, 0, 500);
}
?>
