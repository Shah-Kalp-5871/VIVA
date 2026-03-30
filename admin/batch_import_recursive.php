<?php
/**
 * Recursive Image Importer for VIVA Engineering
 * Maps D:\PHOTO\VIVA to assets/images/products and assets/images/categories
 */

$sourceBase = 'D:\\PHOTO\\VIVA';
$destBase = __DIR__ . '/../assets/images/products';
$catBase = __DIR__ . '/../assets/images/categories';

// Ensure destination directories exist
if (!is_dir($destBase)) mkdir($destBase, 0755, true);
if (!is_dir($catBase)) mkdir($catBase, 0755, true);

// Mapping Category Folders to Data Keys
$categoryMapping = [
    'Adhesive Tape Processing machines' => 'adhesive-tape',
    'Aluminium Foil Processing Machines' => 'aluminium-foil',
    'Center shaft rewinding machine' => 'center-shaft-slitting',
    'Flexographic Printing machine' => 'flexographic-printing',
    'Masking Tape Rewinding machine' => 'masking-tape',
    'Printing Converting & Processing Machines' => 'printing-converting',
    'Roll to ROLL processing machines' => 'roll-to-roll',
    'Slicer Cutting Machine' => 'slicer-cutting',
    'Slitting Rewinding Machine' => 'slitting-rewinding'
];

$importLog = [];

function cleanFileName($name) {
    return strtolower(preg_replace('/[^a-zA-Z0-9.-]/', '-', $name));
}

foreach ($categoryMapping as $srcFolder => $destKey) {
    $srcPath = $sourceBase . DIRECTORY_SEPARATOR . $srcFolder;
    
    if (is_dir($srcPath)) {
        echo "Processing Category: $srcFolder -> $destKey\n";
        
        // Find subfolders or images
        $items = scandir($srcPath);
        $catHasMainImage = false;
        
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            
            $itemPath = $srcPath . DIRECTORY_SEPARATOR . $item;
            
            if (is_dir($itemPath)) {
                // Subcategory folder
                $subDestDir = $destBase . DIRECTORY_SEPARATOR . cleanFileName($item);
                if (!is_dir($subDestDir)) mkdir($subDestDir, 0755, true);
                
                $images = scandir($itemPath);
                $imgCount = 0;
                foreach ($images as $img) {
                    if (preg_match('/\.(jpg|jpeg|png)$/i', $img)) {
                        $imgSrc = $itemPath . DIRECTORY_SEPARATOR . $img;
                        $imgExt = pathinfo($img, PATHINFO_EXTENSION);
                        $imgName = cleanFileName($item) . '-' . (++$imgCount) . '.' . $imgExt;
                        $imgDest = $subDestDir . DIRECTORY_SEPARATOR . $imgName;
                        
                        if (copy($imgSrc, $imgDest)) {
                            $importLog[$destKey]['sub_categories'][cleanFileName($item)][] = 'assets/images/products/' . cleanFileName($item) . '/' . $imgName;
                            
                            // Use first subcategory image as category image if not set
                            if (!$catHasMainImage) {
                                $catImgDest = $catBase . DIRECTORY_SEPARATOR . $destKey . '.' . $imgExt;
                                copy($imgSrc, $catImgDest);
                                $importLog[$destKey]['main_image'] = 'assets/images/categories/' . $destKey . '.' . $imgExt;
                                $catHasMainImage = true;
                            }
                        }
                    }
                }
            } else if (preg_match('/\.(jpg|jpeg|png)$/i', $item)) {
                // Direct image in category folder
                $imgExt = pathinfo($item, PATHINFO_EXTENSION);
                $imgDest = $catBase . DIRECTORY_SEPARATOR . $destKey . '.' . $imgExt;
                if (copy($itemPath, $imgDest)) {
                    $importLog[$destKey]['main_image'] = 'assets/images/categories/' . $destKey . '.' . $imgExt;
                    $catHasMainImage = true;
                }
            }
        }
    } else {
        echo "Warning: Source folder not found: $srcPath\n";
    }
}

// Save log for data update
file_put_contents(__DIR__ . '/import_mapping.json', json_encode($importLog, JSON_PRETTY_PRINT));
echo "\nImport complete. Mapping saved to import_mapping.json\n";
?>
