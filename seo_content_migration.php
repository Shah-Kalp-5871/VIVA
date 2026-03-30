<?php
/**
 * VIVA Engineering - Complete SEO Content Migration
 * Populates ALL categories and products with professional, SEO-optimized content
 * 
 * Run once: php seo_content_migration.php
 */
require_once 'admin/includes/functions.php';

echo "<h2>VIVA Engineering - SEO Content Migration</h2><pre>";

// ===================================================
// PHASE 1: SCHEMA UPGRADES - Add missing SEO columns to categories
// ===================================================
echo "PHASE 1: Schema Upgrades...\n";

$schema_updates = [
    "ALTER TABLE categories ADD COLUMN IF NOT EXISTS seo_title VARCHAR(255) DEFAULT NULL",
    "ALTER TABLE categories ADD COLUMN IF NOT EXISTS seo_description TEXT DEFAULT NULL",
    "ALTER TABLE categories ADD COLUMN IF NOT EXISTS meta_keywords VARCHAR(255) DEFAULT NULL",
];

foreach ($schema_updates as $sql) {
    try {
        $pdo->exec($sql);
        echo "  OK: " . substr($sql, 0, 60) . "...\n";
    } catch (PDOException $e) {
        // Column might already exist
        if (strpos($e->getMessage(), 'Duplicate column') !== false) {
            echo "  SKIP (exists): " . substr($sql, 0, 60) . "...\n";
        } else {
            echo "  ERROR: " . $e->getMessage() . "\n";
        }
    }
}

// ===================================================
// PHASE 2: CATEGORY CONTENT
// ===================================================
echo "\nPHASE 2: Category Content...\n";

$categories = [
    'slitting-rewinding-applications' => [
        'description' => 'VIVA Engineering manufactures a comprehensive range of Slitting Rewinding Machines engineered for precision cutting and rewinding of paper, plastic films, non-woven fabrics, and flexible packaging materials. Our machines feature advanced web tension control systems, servo-driven precision, and heavy-duty construction for 24/7 industrial operation. Each unit is designed for minimal material wastage, high-speed processing, and operator safety, making them the preferred choice for converting industries worldwide.',
        'seo_title' => 'Slitting Rewinding Machines | VIVA Engineering',
        'seo_description' => 'High-precision Slitting Rewinding Machines for paper, plastic & non-woven materials. Advanced tension control, heavy-duty build. Manufacturer India.',
        'meta_keywords' => 'slitting rewinding machine, slitter rewinder, film slitting machine, paper slitting machine, VIVA Engineering',
    ],
    'center-shaft-slitting-rewinding-machines' => [
        'description' => 'Our Center Shaft Slitting Rewinding Machines provide superior roll quality through center-driven shaft technology. Ideal for materials requiring consistent core tension and precise edge alignment, these machines deliver uniform winding density across the full web width. Built with precision-ground shafts, pneumatic locking systems, and digital speed controllers, they are the industry standard for converting operations demanding tight tolerances and high repeatability.',
        'seo_title' => 'Center Shaft Slitting Machines | VIVA Engineering',
        'seo_description' => 'Center Shaft Slitting Rewinding Machines for uniform winding & precise edge alignment. Pneumatic locking, digital speed control. Made in India.',
        'meta_keywords' => 'center shaft slitting machine, center winding slitter, shaft rewinder, precision slitting, VIVA Engineering',
    ],
    'roll-to-roll-processing-machines' => [
        'description' => 'VIVA Engineering Roll to Roll Processing Machines enable continuous material handling for winding, rewinding, doctoring, and batch coding applications. Engineered for versatility, these machines handle paper, polyester films, laminates, and specialty substrates with precision tension management. Features include EPC (Edge Position Control), automatic splice detection, and modular design for easy integration into existing production lines.',
        'seo_title' => 'Roll to Roll Processing Machines | VIVA Engineering',
        'seo_description' => 'Roll to Roll Winding & Rewinding Machines for paper, film & laminates. EPC control, batch coding, modular design. Industrial manufacturer India.',
        'meta_keywords' => 'roll to roll machine, winding rewinding machine, paper rewinder, doctoring machine, VIVA Engineering',
    ],
    'aluminium-foil-processing-machines' => [
        'description' => 'Specialized Aluminium Foil Processing Machines designed for rewinding, slitting, and converting aluminium foil rolls of various gauges. Our machines feature anti-static systems, precision tension controllers, and dust-free enclosures to maintain foil integrity during processing. Suitable for food packaging, pharmaceutical blister packs, and industrial insulation applications, these machines deliver wrinkle-free, consistent output at production speeds.',
        'seo_title' => 'Aluminium Foil Processing Machines | VIVA Engineering',
        'seo_description' => 'Aluminium Foil Rewinding & Slitting Machines for food packaging and pharma. Anti-static, wrinkle-free output. Manufacturer India.',
        'meta_keywords' => 'aluminium foil machine, foil rewinding machine, foil slitting machine, aluminium processing, VIVA Engineering',
    ],
    'printing-converting-processing-machines' => [
        'description' => 'Our Printing, Converting & Processing Machines line includes high-performance Rotogravure and Flexographic printing systems for flexible packaging, labels, and decorative printing applications. These machines deliver photographic-quality print reproduction with registration accuracy of +/-0.1mm, multi-color capability, and integrated drying systems. Built for high-speed production with minimal setup time and maximum uptime.',
        'seo_title' => 'Printing Machines - Rotogravure & Flexo | VIVA',
        'seo_description' => 'Rotogravure & Flexographic Printing Machines for packaging, labels & decorative printing. Multi-color, precision registration. India manufacturer.',
        'meta_keywords' => 'rotogravure printing machine, flexographic printer, packaging printing machine, converting machine, VIVA Engineering',
    ],
    'adhesive-tape-processing-machines' => [
        'description' => 'Complete range of Adhesive Tape Processing Machines for BOPP tape slitting, slicer cutting, PVC tape cutting, and masking tape rewinding. VIVA Engineering delivers end-to-end tape manufacturing solutions with automated operation, high-speed output, and precision cutting accuracy. Our machines support various tape widths from 12mm to 1000mm and handle adhesive materials including acrylic, hot-melt, and rubber-based adhesives.',
        'seo_title' => 'Adhesive Tape Processing Machines | VIVA',
        'seo_description' => 'BOPP Tape Slitting, Slicer Cutting & PVC Tape Cutting Machines. Automated, high-speed, precision tape manufacturing equipment. India.',
        'meta_keywords' => 'adhesive tape machine, BOPP tape slitting, tape cutting machine, PVC tape machine, VIVA Engineering',
    ],
    'bopp-tape-slitting-rewinding-machine' => [
        'description' => 'BOPP Tape Slitting & Rewinding Machines designed for high-speed conversion of jumbo rolls into finished tape rolls. Available in baby type (300mm) and turret type (1350mm) configurations, these machines feature automatic tension control, pneumatic core locking, and servo-driven slitting heads for clean, burr-free cuts on adhesive-coated BOPP films.',
        'seo_title' => 'BOPP Tape Slitting Rewinding Machine | VIVA',
        'seo_description' => 'BOPP Tape Slitting & Rewinding Machines - baby type to turret type. Auto tension, servo slitting, pneumatic locking. Manufacturer India.',
        'meta_keywords' => 'BOPP tape slitting machine, tape rewinding machine, adhesive tape slitter, turret slitter, VIVA Engineering',
    ],
    'slicer-cutting-machine' => [
        'description' => 'Precision Slicer Cutting Machines for masking tape, duct tape, and specialty adhesive tapes. Available in manual, semi-automatic, and fully automatic configurations to suit every production scale. Features include adjustable blade assemblies, digital width counters, and quick-change mandrels for rapid product changeover.',
        'seo_title' => 'Slicer Cutting Machine | VIVA Engineering',
        'seo_description' => 'Tape Slicer Cutting Machines - manual to fully automatic. Precision cutting for masking, duct & specialty tapes. Manufacturer India.',
        'meta_keywords' => 'slicer cutting machine, tape cutting machine, masking tape slicer, automatic tape cutter, VIVA Engineering',
    ],
    'pvc-tape-cutting-machine' => [
        'description' => 'PVC Tape Cutting Machines engineered for clean, precise cutting of PVC electrical tapes and insulation tapes. Available in manual single-shaft and fully automatic double-shaft configurations. Features include hardened steel blades, adjustable cutting width, and anti-vibration mounts for consistent cut quality at high production speeds.',
        'seo_title' => 'PVC Tape Cutting Machine | VIVA Engineering',
        'seo_description' => 'PVC Tape Cutting Machines - manual to fully auto double shaft. Hardened blades, precision cutting for electrical tapes. Manufacturer India.',
        'meta_keywords' => 'PVC tape cutting machine, electrical tape cutter, PVC insulation tape, double shaft cutter, VIVA Engineering',
    ],
    'coating-processing-machines' => [
        'description' => 'Advanced Coating Processing Machines for applying adhesive coatings, protective films, and surface treatments to substrates including BOPP films, paper, foam, and specialty materials. Our coating lines feature precision metering systems, multi-zone drying tunnels, and automatic viscosity control for uniform coat weights. Suitable for pressure-sensitive adhesive (PSA), water-based, and hot-melt coating applications.',
        'seo_title' => 'Coating Machines - BOPP, Paper & Foam | VIVA',
        'seo_description' => 'Industrial Coating Machines for BOPP tape, paper, foam & specialty substrates. Precision metering, multi-zone drying. Manufacturer India.',
        'meta_keywords' => 'coating machine, BOPP tape coating, paper coating machine, adhesive coating line, VIVA Engineering',
    ],
    'plastic-film-embossing-machine' => [
        'description' => 'High-performance Plastic Film Embossing Machines for creating textured patterns, anti-slip surfaces, and decorative finishes on polyethylene, polypropylene, and PVC films. These machines feature precision-engraved embossing rollers, temperature-controlled heating systems, and variable speed drives for consistent pattern reproduction across various film thicknesses and material compositions.',
        'seo_title' => 'Plastic Film Embossing Machine | VIVA',
        'seo_description' => 'Plastic Film Embossing Machines for PE, PP & PVC films. Textured patterns, anti-slip surfaces, decorative finishes. Manufacturer India.',
        'meta_keywords' => 'embossing machine, plastic film embosser, PE film embossing, PVC embossing machine, VIVA Engineering',
    ],
    'extra-converting-machine-equipment' => [
        'description' => 'Essential Converting Equipment and accessories including Web Guide Systems, Air Shafts, Safety Chucks, Wrapping Machines, and Core Cutting Machines. These precision-engineered components are critical for maintaining web alignment, enabling quick roll changes, and ensuring operator safety in any converting operation. Compatible with all VIVA machinery and most third-party converting equipment.',
        'seo_title' => 'Converting Equipment & Accessories | VIVA',
        'seo_description' => 'Web Guide Systems, Air Shafts, Safety Chucks, Core Cutters & Wrapping Machines. Essential converting equipment & accessories. India.',
        'meta_keywords' => 'web guide system, air shaft, safety chuck, core cutting machine, converting equipment, VIVA Engineering',
    ],
];

$cat_stmt = $pdo->prepare("UPDATE categories SET description = ?, seo_title = ?, seo_description = ?, meta_keywords = ? WHERE slug = ?");
$cat_count = 0;
foreach ($categories as $slug => $data) {
    $cat_stmt->execute([$data['description'], $data['seo_title'], $data['seo_description'], $data['meta_keywords'], $slug]);
    if ($cat_stmt->rowCount() > 0) {
        echo "  Updated: $slug\n";
        $cat_count++;
    } else {
        echo "  SKIP (not found): $slug\n";
    }
}
echo "  Categories updated: $cat_count\n";

echo "\nPhase 2 complete. Run seo_content_products.php for Phase 3.\n";
echo "</pre>";
