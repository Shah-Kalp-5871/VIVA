<?php
/**
 * VIVA ENGINEERING - Media Synchronizer
 * Indexes physical files into the media table
 */
require_once 'includes/config.php';

// 1. Ensure Table Exists
require_once 'setup_media.php';

ob_start();

echo "\n--- STARTING MEDIA SYNC ---\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n";

function syncFolder($folderRelative, $pdo) {
    if (empty($folderRelative)) return;
    
    $fullPath = __DIR__ . '/../' . $folderRelative;
    if (!is_dir($fullPath)) {
        echo "Skipping missing folder: $folderRelative\n";
        return;
    }

    echo "Scanning $folderRelative...\n";
    $files = scandir($fullPath);
    $added = 0;

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        
        $filePath = $folderRelative . $file;
        $realPath = $fullPath . $file;
        
        if (is_dir($realPath)) continue;

        // Check if already in DB
        $stmt = $pdo->prepare("SELECT id FROM media WHERE file_path = ?");
        $stmt->execute([$filePath]);
        if (!$stmt->fetch()) {
            $type = mime_content_type($realPath);
            $size = filesize($realPath);
            
            $stmt = $pdo->prepare("INSERT INTO media (file_name, file_path, file_type, file_size) VALUES (?, ?, ?, ?)");
            $stmt->execute([$file, $filePath, $type, $size]);
            $added++;
        }
    }
    echo "Added $added new files from $folderRelative\n";
}

// 2. Sync physical folders
syncFolder('uploads/media/', $pdo);
syncFolder('uploads/gallery/', $pdo);
syncFolder('assets/images/products/', $pdo);
syncFolder('assets/images/categories/', $pdo);

// 3. Cross-Sync: Ensure all items in 'gallery' table are also in 'media' table
echo "Cross-syncing Gallery table to Media table...\n";
$stmt = $pdo->query("SELECT * FROM gallery");
$galleryItems = $stmt->fetchAll();
$crossAdded = 0;

foreach ($galleryItems as $item) {
    if (empty($item['image'])) continue;
    
    // Check if path exists in media
    $stmt2 = $pdo->prepare("SELECT id FROM media WHERE file_path = ?");
    $stmt2->execute([$item['image']]);
    if (!$stmt2->fetch()) {
        $fullPath = __DIR__ . '/../' . $item['image'];
        if (file_exists($fullPath)) {
            $type = mime_content_type($fullPath);
            $size = filesize($fullPath);
            $name = basename($item['image']);
            
            $stmt3 = $pdo->prepare("INSERT INTO media (file_name, file_path, file_type, file_size) VALUES (?, ?, ?, ?)");
            $stmt3->execute([$name, $item['image'], $type, $size]);
            $crossAdded++;
        }
    }
}
echo "Cross-synced $crossAdded items from Gallery table.\n";

echo "\n--- SYNC COMPLETE ---\n";

$output = ob_get_clean();
echo $output;
file_put_contents(__DIR__ . '/sync_log.txt', $output);
?>
