<?php
require_once 'includes/functions.php';

$source_dir = 'D:/PHOTO/VIVA/';
$target_dir = '../uploads/media/';

if (!is_dir($source_dir)) {
    die("Source directory $source_dir does not exist.\n");
}

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$files = scandir($source_dir);
$count = 0;
$skipped = 0;

foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;
    
    $source_path = $source_dir . $file;
    if (is_dir($source_path)) continue;

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $allowed_exts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    
    if (!in_array($ext, $allowed_exts)) {
        echo "Skipping non-image file: $file\n";
        $skipped++;
        continue;
    }

    $new_filename = 'viva_import_' . time() . '_' . uniqid() . '.' . $ext;
    $target_path = $target_dir . $new_filename;
    $db_path = 'uploads/media/' . $new_filename;

    if (copy($source_path, $target_path)) {
        $file_type = 'image/' . ($ext === 'jpg' ? 'jpeg' : $ext);
        $file_size = filesize($target_path);
        
        $stmt = $pdo->prepare("INSERT INTO media (file_name, file_path, file_type, file_size) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$file, $db_path, $file_type, $file_size])) {
            echo "Imported: $file -> $db_path\n";
            $count++;
        }
    } else {
        echo "Failed to copy: $file\n";
    }
}

echo "\nImport completed. Total imported: $count. Total skipped: $skipped.\n";
?>
