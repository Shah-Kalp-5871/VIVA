<?php
require_once 'admin/includes/functions.php';

$name = "BOPP Tape Cutting Machine";
$slug = "bopp-tape-cutting-machine";
$tagline = "Precision Cutting for High-Performance Tape Production";
$description = "The BOPP Tape Cutting Machine is engineered for high-speed, precision cutting operations in adhesive tape manufacturing. Designed with advanced automation and robust construction, this machine ensures clean, accurate cuts with minimal wastage, making it ideal for large-scale industrial production.\n\nBuilt for efficiency and reliability, it delivers consistent performance across various tape materials including BOPP, masking, and specialty adhesive tapes.\n\n🧾 Product Overview\n\nThis machine is equipped with high-precision blades, automated feeding systems, and digital controls, enabling smooth and accurate cutting operations. It is designed to handle continuous production while maintaining superior cutting quality and operational stability.";

$features = json_encode([
    "Automatic feeding system for continuous operation",
    "High-precision cutting blades for clean edges",
    "Digital length control for accurate measurements",
    "Adjustable cutting speed for different materials",
    "User-friendly touchscreen interface",
    "Batch counter for production tracking"
]);

$specifications = json_encode([
    "Model" => "VIVA-TC-800",
    "Max Cutting Width" => "800 mm",
    "Cutting Speed" => "150 cuts/min",
    "Cutting Length Range" => "10 – 9999 mm",
    "Cutting Accuracy" => "±0.5 mm",
    "Power Requirement" => "3 KW",
    "Machine Dimensions" => "2000 × 1200 × 1400 mm",
    "Weight" => "450 kg"
]);

$applications = json_encode([
    "BOPP Tape Production",
    "Adhesive Tape Manufacturing",
    "Masking Tape Cutting",
    "Double-Sided Tape Processing"
]);

$benefits = json_encode([
    "High production efficiency",
    "Reduced material wastage",
    "Consistent cutting quality",
    "Low maintenance requirements",
    "Suitable for continuous industrial use"
]);

$seo_title = "BOPP Tape Cutting Machine Manufacturer | High Precision Tape Cutting Machine India";
$seo_description = "Buy high-performance BOPP Tape Cutting Machine with precision cutting, high speed, and durable design. Ideal for adhesive tape manufacturing industries in India.";
$meta_keywords = "BOPP Tape Cutting Machine, Tape Cutting Machine Manufacturer India, Adhesive Tape Cutter";

// Check if category 6 exists or use 1 as fallback
$cat_id = 6;
$stmt = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
$stmt->execute([$cat_id]);
if (!$stmt->fetch()) {
    $cat_id = 1; 
}

// Check if product exists
$stmt = $pdo->prepare("SELECT id FROM products WHERE slug = ?");
$stmt->execute([$slug]);
$existing = $stmt->fetch();

$tag = "Cutting Systems";
$price = "Contact for Price";
$availability = "In Stock";
$lead_time = "4-6 Weeks";

try {
    if ($existing) {
        echo "Updating existing product...\n";
        $stmt = $pdo->prepare("UPDATE products SET category_id = ?, name = ?, slug = ?, tagline = ?, tag = ?, price = ?, availability = ?, lead_time = ?, description = ?, features = ?, specifications = ?, applications = ?, benefits = ?, seo_title = ?, seo_description = ?, meta_keywords = ?, status = 'active' WHERE id = ?");
        $stmt->execute([$cat_id, $name, $slug, $tagline, $tag, $price, $availability, $lead_time, $description, $features, $specifications, $applications, $benefits, $seo_title, $seo_description, $meta_keywords, $existing['id']]);
        echo "Product Updated Successfully!";
    } else {
        echo "Inserting new product...\n";
        $stmt = $pdo->prepare("INSERT INTO products (category_id, name, slug, tagline, tag, price, availability, lead_time, description, features, specifications, applications, benefits, seo_title, seo_description, meta_keywords, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active')");
        $stmt->execute([$cat_id, $name, $slug, $tagline, $tag, $price, $availability, $lead_time, $description, $features, $specifications, $applications, $benefits, $seo_title, $seo_description, $meta_keywords]);
        echo "Product Inserted Successfully!";
    }
} catch (Exception $e) {
    echo "DATABASE ERROR: " . $e->getMessage() . "\n";
}
?>
