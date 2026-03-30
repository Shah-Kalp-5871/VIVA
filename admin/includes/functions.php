<?php
/**
 * VIVA Core Admin Functions
 */

function h($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Include DB for tree functions if needed, although usually passed as param
require_once __DIR__ . '/db.php';

/**
 * Generate a URL-friendly slug from a string
 */
function slugGenerate($text) {
    // Replace non alnum characters with -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim
    $text = trim($text, '-');
    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // Lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

/**
 * Sanitize User Input
 */
function sanitizeInput($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = sanitizeInput($value);
        }
    } else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    return $data;
}

/**
 * Get Categories in a Recursive Tree Structure
 */
function getCategoryTree($parent_id = null, $spacing = '', $tree = []) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE parent_id " . ($parent_id === null ? "IS NULL" : "= ?") . " ORDER BY name ASC");
    if ($parent_id !== null) {
        $stmt->execute([$parent_id]);
    } else {
        $stmt->execute();
    }
    
    $categories = $stmt->fetchAll();
    
    foreach ($categories as $category) {
        $category['display_name'] = $spacing . $category['name'];
        $tree[] = $category;
        $tree = getCategoryTree($category['id'], $spacing . '— ', $tree);
    }
    
    return $tree;
}

/**
 * Get Only Leaf Categories (Categories that have no children)
 */
function getLeafCategories() {
    global $pdo;
    // Categories that are not parents of any other category
    $sql = "SELECT c.* FROM categories c 
            LEFT JOIN categories sub ON c.id = sub.parent_id 
            WHERE sub.id IS NULL AND c.status = 'active'
            ORDER BY c.name ASC";
    return $pdo->query($sql)->fetchAll();
}

/**
 * Secure Image Upload
 */
function uploadImage($file, $target_dir = "../../") {
    // Ensure target directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB

    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'No file uploaded or upload error.'];
    }

    if (!in_array($file['type'], $allowed_types)) {
        return ['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, and WEBP allowed.'];
    }

    if ($file['size'] > $max_size) {
        return ['success' => false, 'message' => 'File size exceeds 5MB limit.'];
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = 'viva_prod_' . time() . '_' . uniqid() . '.' . $ext;
    $target_file = $target_dir . $new_filename;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $new_filename;
    }

    return false;
}

/**
 * Parse JSON or comma-separated fields
 */
function parseField($data) {
    if (empty($data)) return [];
    $decoded = json_decode($data, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        return $decoded;
    }
    return array_filter(array_map('trim', preg_split('/[\n\r,]+/', $data)));
}

/**
 * Parse specifications into key-value pairs
 */
function parseSpecs($data) {
    if (empty($data)) return [];
    $decoded = json_decode($data, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        return $decoded;
    }
    $lines = preg_split('/[\n\r,]+/', $data);
    $parsed = [];
    foreach ($lines as $l) {
        $parts = explode(':', $l, 2);
        if (count($parts) == 2) {
            $parsed[trim($parts[0])] = trim($parts[1]);
        }
    }
    return $parsed;
}

/**
 * Check if a slug already exists in a table
 */
function slugExists($table, $slug, $exclude_id = null) {
    global $pdo;
    $sql = "SELECT id FROM $table WHERE slug = ?";
    if ($exclude_id) {
        $sql .= " AND id != ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$slug, $exclude_id]);
    } else {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$slug]);
    }
    return $stmt->fetch() ? true : false;
}
?>
