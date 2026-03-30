<?php
$html = file_get_contents("http://localhost/VIVA/products.php");
if ($html === false) {
    echo "FAILED TO FETCH";
} else {
    echo "LENGTH: " . strlen($html) . "\n";
    if (strpos($html, "No Products Found") !== false) {
        echo "FOUND: 'No Products Found'\n";
    } else {
        echo "NOT FOUND: 'No Products Found'\n";
    }
    // Print a bit of the grid area
    $start = strpos($html, 'id="products-grid"');
    if ($start) {
        echo "GRID START FOUND\n";
        echo substr($html, $start, 500);
    } else {
        echo "GRID NOT FOUND";
    }
}
