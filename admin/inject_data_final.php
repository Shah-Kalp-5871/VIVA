<?php
/**
 * Data Injector Final for VIVA Engineering
 */

$dataFile = __DIR__ . '/../data/products-data.php';
$content = file_get_contents($dataFile);

$replacements = [
    // Categories
    'https://www.slitterchina.com/uploads/41362/automatic-high-speed-slitting-rewinding202407291240119304f.jpg' => 'assets/images/categories/slitting-rewinding.jpg',
    'https://www.uvprintingmachine.com/uploads/202024473/stack-type-flexo-printing-machine36058097063.jpg' => 'assets/images/categories/flexographic-printing.png',
    
    // Sub-Categories
    'https://www.paperlabeltech.com/wp-content/uploads/2023/08/IMG_20211103_1521021-1.png' => 'assets/images/products/paper-slitting-machine/paper-slitting-machine-1.png',
    'https://www.ketegroup.com/wp-content/uploads/2024/09/film-slitting-machine.jpg' => 'assets/images/products/plastic-slitting-machine/plastic-slitting-machine-1.png',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlXut8EdfTW0032uTckUpMwHwLxChjmXWHug&s' => 'assets/images/products/non-vowen-slitting-machine/non-vowen-slitting-machine-1.jpg',
    'https://img.youtube.com/vi/E_fXWizjQv0/hqdefault.jpg' => 'assets/images/products/rotogravure-printing-machine/rotogravure-printing-machine-1.png',
    'https://5.imimg.com/data5/SELLER/Default/2023/3/WN/PQ/EY/12470650/aluminium-foil-rewinding-machine.jpg' => 'assets/images/products/aluminium-foil-rewinding-machine/aluminium-foil-rewinding-machine-1.png',
    
    // BOPP / Adhesive
    'https://images.jdmagicbox.com/quickquotes/images_main/fully-automatic-bopp-tape-making-machine-801580281-wkpg68ce.jpg' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/1350-mm-bopp-tape-cutting-machine/img-1945.png',
    'https://m.media-amazon.com/images/I/61GKLHA1wLL._AC_SL1500_.jpg' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/300-mm-bopp-tape-cutting-machi-e/main-1.png',
    
    // Slicer / Cutting
    'https://www.jotamachinery.com/wp-content/uploads/2021/12/BOPP-slitter-1.jpg' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/manual-pvc-tape-cutting-machine/main-1.png',
    'https://5.imimg.com/data5/SELLER/Default/2023/5/304910385/WS/YF/TC/21798363/pvc-tape-cutting-machine.png' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/manual-pvc-tape-cutting-machine/main-1.png',
    'https://5.imimg.com/data5/SELLER/Default/2023/2/XJ/RY/PF/21798363/fully-automatic-double-shaft-pvc-tape-cutting-machine-1000x1000.png' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/fully-auto-double-shaft-pvc-tape-cutting-machine/main.png'
];

foreach ($replacements as $remote => $local) {
    if (file_exists(__DIR__ . '/../' . $local)) {
        $content = str_replace($remote, $local, $content);
    } else {
         echo "Warning: Local asset not found: $local\n";
         // Still replace it if it's a known mapped path even if file_exists is weird with paths
         $content = str_replace($remote, $local, $content);
    }
}

file_put_contents($dataFile, $content);
echo "Final data synchronization complete.\n";
?>
