<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/../data/products-data.php';

echo "<h2>VIVA Engineering - Professional Industrial Documentation Sync</h2>";
echo "<pre>";

function generateProfessionalOverview($name, $cat_name) {
    $intro = "The $name by VIVA Engineering is a high-performance industrial solution specifically engineered for the demanding requirements of $cat_name. ";
    
    $middle = "Built on a heavy-duty, vibration-dampened frame, this machine incorporates advanced $cat_name technology to ensure maximum throughput with uncompromising precision. Our engineering team has focused on optimizing web tension management and operational safety, making it a reliable workhorse for 24/7 manufacturing environments. ";
    
    $outro = "With its user-friendly interface and modular design, the $name allows for seamless integration into existing production lines, providing a strategic advantage in flexible packaging, converting, and specialized industrial sectors.";
    
    return $intro . $middle . $outro;
}

$count = 0;
foreach ($product_categories as $cat_slug => $category) {
    // 1. SYNC CATEGORY IMAGE
    $stmt_cat = $pdo->prepare("UPDATE categories SET image = ? WHERE slug = ?");
    $stmt_cat->execute([$category['image'], $cat_slug]);
    echo "Updated Category Image: $cat_slug\n";

    if (isset($category['sub_categories'])) {
        foreach ($category['sub_categories'] as $prod_slug => $product) {
            
            // Check if product exists by slug OR name
            $stmt = $pdo->prepare("SELECT id, slug, name FROM products WHERE slug = ? OR name = ?");
            $stmt->execute([$prod_slug, $product['name']]);
            $db_prod = $stmt->fetch();

            if ($db_prod) {
                $features = isset($product['features']) ? implode("\n", $product['features']) : '';
                if (empty($features) && isset($category['features'])) {
                    $features = implode("\n", $category['features']);
                }

                $specs_arr = isset($product['specs']) ? $product['specs'] : (isset($category['specs']) ? $category['specs'] : []);
                $specs_str = "";
                foreach ($specs_arr as $k => $v) {
                    $specs_str .= "$k: $v\n";
                }

                $apps = isset($product['applications']) ? implode("\n", $product['applications']) : (isset($category['applications']) ? implode("\n", $category['applications']) : '');
                $benefits = isset($product['benefits']) ? implode("\n", $product['benefits']) : (isset($category['benefits']) ? implode("\n", $category['benefits']) : '');
                
                $tagline = $product['description'] ?? $category['description'] ?? 'Precision Industrial Engineering';
                
                // CRAFT PROFESSIONAL OVERVIEW
                $description = generateProfessionalOverview($db_prod['name'], $category['name']);

                // Update (INCLUDING IMAGE)
                $update_sql = "UPDATE products SET 
                    image = ?,
                    features = ?, 
                    specifications = ?, 
                    applications = ?, 
                    benefits = ?, 
                    tagline = ?,
                    description = ?
                    WHERE id = ?";
                $pdo->prepare($update_sql)->execute([$product['image'], $features, $specs_str, $apps, $benefits, $tagline, $description, $db_prod['id']]);
                echo "Enriched Documentation & Image: " . ($db_prod['slug']) . "\n";
                
                // Handle Variants if any
                if (isset($product['variants'])) {
                    foreach ($product['variants'] as $var_slug => $variant) {
                        $stmt_v = $pdo->prepare("SELECT id, name FROM products WHERE slug = ?");
                        $stmt_v->execute([$var_slug]);
                        $db_var = $stmt_v->fetch();
                        
                        if ($db_var) {
                            $var_desc = generateProfessionalOverview($db_var['name'], $category['name']);
                            $pdo->prepare("UPDATE products SET image = ?, features = ?, specifications = ?, applications = ?, benefits = ?, tagline = ?, description = ? WHERE id = ?")
                                ->execute([$variant['image'], $features, $specs_str, $apps, $benefits, $tagline, $var_desc, $db_var['id']]);
                            echo "  -> Enriched Variant Documentation & Image: $var_slug\n";
                        }
                    }
                }
                $count++;
            }
        }
    }
}

echo "\nTotal Industrial Documentation Files Enriched: $count\n";
echo "</pre>";
?>
