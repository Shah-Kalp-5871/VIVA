<?php
/**
 * Data Injector v2 for VIVA Engineering
 * Programmatically updates products-data.php with real imagery
 */

$mapping = json_decode(file_get_contents(__DIR__ . '/import_mapping.json'), true);
$dataFile = __DIR__ . '/../data/products-data.php';
$content = file_get_contents($dataFile);

// Subcategory Map [Key in products-data.php => Folder in import_mapping.json]
$subMap = [
    'paper-slitting' => 'paper-slitting-machine',
    'plastic-slitting' => 'plastic-slitting-machine',
    'non-woven-slitting' => 'non-vowen-slitting-machine',
    'paper-center-shaft' => 'paper-center-shaft-slitting-machine',
    'plastic-center-shaft' => 'plastic-center-shaft-slitting-machine',
    'winding-rewinding' => 'wining-rewinding-machine',
    'doctoring-rewinding' => 'doctroring-rewinding-machine-for-batch-coding',
    'hm-paper-rewinding' => 'hm-paper-rewinding-machine--notebook-paper-rewinding-machine',
    'aluminium-foil-rewinding' => 'aluminium-foil-rewinding-machine',
    'aluminium-jumbo-roll' => 'aluminium-jumbo-roll-slitting-machine',
    'rotogravure-printing' => 'rotogravure-printing-machine'
];

// 1. Update Category Main Images
foreach ($mapping as $catKey => $data) {
    if (isset($data['main_image'])) {
        // Regex to find the category block and then the first 'image' => '...'
        // Pattern: 'cat-key' => [ ... 'image' => 'HERE'
        // Using a simpler approach: multiple str_replace for specific placeholders known to be in those categories
        
        // This is safer if we know which placeholders belong to which categories
    }
}

// 2. Perform global string replacements for all unique placeholders found earlier
$placeholderMap = [
    // Slitting Rewinding
    'https://www.slitterchina.com/uploads/41362/automatic-high-speed-slitting-rewinding202407291240119304f.jpg' => 'assets/images/categories/slitting-rewinding.jpg',
    'https://www.paperlabeltech.com/wp-content/uploads/2023/08/IMG_20211103_1521021-1.png' => 'assets/images/products/paper-slitting-machine/paper-slitting-machine-1.png',
    'https://www.ketegroup.com/wp-content/uploads/2024/09/film-slitting-machine.jpg' => 'assets/images/products/plastic-slitting-machine/plastic-slitting-machine-1.png',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlXut8EdfTW0032uTckUpMwHwLxChjmXWHug&s' => 'assets/images/products/non-vowen-slitting-machine/non-vowen-slitting-machine-1.jpg',
    
    // Printing
    'https://img.youtube.com/vi/E_fXWizjQv0/hqdefault.jpg' => 'assets/images/products/rotogravure-printing-machine/rotogravure-printing-machine-1.png',
    'https://www.uvprintingmachine.com/uploads/202024473/stack-type-flexo-printing-machine36058097063.jpg' => 'assets/images/categories/flexographic-printing.png',
    
    // Aluminium
    'https://5.imimg.com/data5/SELLER/Default/2023/3/WN/PQ/EY/12470650/aluminium-foil-rewinding-machine.jpg' => 'assets/images/products/aluminium-foil-rewinding-machine/aluminium-foil-rewinding-machine-1.png',
    
    // Roll to Roll
    'https://m.media-amazon.com/images/I/71z+6P+Lq+L._AC_UF1000,1000_QL80_.jpg' => 'assets/images/products/hm-paper-rewinding-machine--notebook-paper-rewinding-machine/hm-paper-rewinding-machine--notebook-paper-rewinding-machine-1.png'
];

foreach ($placeholderMap as $remote => $local) {
    $content = str_replace($remote, $local, $content);
}

// Special case for category images that might use shared placeholders
// We'll update the 'centre-shaft-slitting' category image specifically
$content = preg_replace(
    "/'center-shaft-slitting' => \[\s+'name' => 'Center Shaft Slitting Rewinding Machines',\s+'image' => 'assets\/images\/categories\/slitting-rewinding.jpg'/",
    "'center-shaft-slitting' => [\n        'name' => 'Center Shaft Slitting Rewinding Machines',\n        'image' => 'assets/images/categories/center-shaft-slitting.png'",
    $content
);

file_put_contents($dataFile, $content);
echo "Final data injection complete.\n";
?>
