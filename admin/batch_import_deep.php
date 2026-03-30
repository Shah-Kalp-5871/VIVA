<?php
/**
 * Deep Recursive Image Importer for VIVA Engineering
 */

$sourceBase = 'D:\\PHOTO\\VIVA';
$destBase = __DIR__ . '/../assets/images/products';

function cleanProjectName($name) {
    return strtolower(preg_replace('/[^a-zA-Z0-9.-]/', '-', $name));
}

function recursiveImport($src, $dest) {
    if (!is_dir($src)) return;
    
    $items = scandir($src);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $srcPath = $src . DIRECTORY_SEPARATOR . $item;
        if (is_dir($srcPath)) {
            $newDest = $dest . DIRECTORY_SEPARATOR . cleanProjectName($item);
            if (!is_dir($newDest)) mkdir($newDest, 0755, true);
            recursiveImport($srcPath, $newDest);
        } else if (preg_match('/\.(jpg|jpeg|png)$/i', $item)) {
            $ext = pathinfo($item, PATHINFO_EXTENSION);
            $newName = cleanProjectName(pathinfo($item, PATHINFO_FILENAME)) . '.' . $ext;
            copy($srcPath, $dest . DIRECTORY_SEPARATOR . $newName);
        }
    }
}

recursiveImport($sourceBase, $destBase);
echo "Deep recursive import complete.\n";
?>
