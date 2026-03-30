<?php
require_once __DIR__ . '/includes/functions.php';

echo "<h2>VIVA Engineering - Professional Media Library Image Sync</h2>";
echo "<pre>";

// 1. Fetch all media
$stmt = $pdo->query("SELECT * FROM media");
$media_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 2. Fetch all categories and products
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$products = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);

function findBestMatch($name, $media_items) {
    $name = strtolower($name);
    $best_match = null;
    $highest_score = 0;
    
    // Core structural keywords to avoid generic matches
    $keywords = explode(' ', str_replace(['-', '/'], ' ', $name));
    
    foreach ($media_items as $item) {
        $filename = strtolower($item['file_name']);
        $score = 0;
        
        foreach ($keywords as $kw) {
            if (strlen($kw) > 2 && strpos($filename, $kw) !== false) {
                $score++;
            }
        }
        
        if ($score > $highest_score) {
            $highest_score = $score;
            $best_match = $item['file_path'];
        }
    }
    
    return $best_match;
}

// 3. Update Categories
foreach ($categories as $cat) {
    $match = findBestMatch($cat['name'], $media_items);
    if ($match) {
        $stmt = $pdo->prepare("UPDATE categories SET image = ? WHERE id = ?");
        $stmt->execute([$match, $cat['id']]);
        echo "Updating Category [{$cat['name']}] -> $match\n";
    }
}

// 4. Update Products
foreach ($products as $prod) {
    $match = findBestMatch($prod['name'], $media_items);
    
    // Fallback to Category match if product match is weak
    if (!$match) {
        $stmt_cat = $pdo->prepare("SELECT name FROM categories WHERE id = ?");
        $stmt_cat->execute([$prod['category_id']]);
        $cat_res = $stmt_cat->fetch();
        if ($cat_res) {
            $match = findBestMatch($cat_res['name'], $media_items);
        }
    }
    
    if ($match) {
        $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE id = ?");
        $stmt->execute([$match, $prod['id']]);
        echo "Updating Product [{$prod['name']}] -> $match\n";
    }
}

echo "\nSynchronization Complete. All images linked to professional Media Library assets.";
echo "</pre>";
?>
