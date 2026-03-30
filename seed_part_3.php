<?php
/**
 * VIVA Engineering - Product Content Migration (Part 3/4)
 * Adhesive Tapes, PVC Cutters, Slicers, Coating
 */
require_once 'admin/includes/functions.php';

$products = [
    // --- 6. Adhesive Tape Processing machines (BOPP & Slicer) ---
    'masking-tape-rewinding-machine' => [
        'tagline' => 'High-Speed Masking Tape Slitting & Rewinding',
        'seo_title' => 'Masking Tape Rewinding Machine | VIVA Engineering',
        'seo_description' => 'Precision Masking Tape Rewinding Machine for crepe paper tapes. High-speed slitting, dedicated tension management. VIVA India.',
        'meta_keywords' => 'masking tape rewinder, crepe paper tape machine, tape slitting rewinding, adhesive tape machine, VIVA',
        'description' => 'The VIVA Masking Tape Rewinding Machine is exclusively engineered to process crepe paper based masking tapes and double-sided tissue tapes. Masking tape requires delicate tension management to prevent the crepe paper from losing its stretchable properties during rewinding. Our machine utilizes a multi-point tension control system, specialized non-stick (Teflon-coated) nip rollers, and razor slitting technology to maintain the exact physical characteristics of the original jumbo roll down to the finished consumer roll.',
        'features' => "Teflon-coated web path rollers to prevent adhesive build-up\nPrecise razor-in-groove slitting mechanism\nNoise reduction cabin for high-speed unwinding of adhesive tapes\nAutomatic length counting with two-stage slowdown\nPneumatic lay-on rollers for tight, bubble-free finished rolls\nTurret style or dual-shaft rewinding options\nBow roller spreading to prevent tape overlapping",
        'applications' => "Crepe paper masking tapes\nDouble-sided tissue and foam tapes\nPainter's grade masking tapes\nAutomotive high-temperature masking tapes\nSurgical and medical adhesive tapes",
        'benefits' => "Preserves the vital stretch (elongation) properties of crepe paper\nEnsures clean, bleed-free edges on finished tape rolls\nMinimal adhesive transfer to machine components\nHigh production output with rapid roll changes\nReduces operator noise exposure significantly",
        'specifications' => json_encode([
            "Tape Materials" => "Crepe Paper, Tissue, Foam",
            "Web Width" => "Max 1350mm",
            "Unwind Diameter" => "Max 800mm",
            "Rewind Diameter" => "Max 300mm",
            "Speed" => "Up to 150 m/min",
            "Slitting Width" => "Min 12mm",
            "Tension Control" => "Magnetic Powder Clutch",
            "Rollers" => "Plasma/Teflon Coated"
        ])
    ],
    '300-mm-baby-type-slitting-rewinding-machine' => [
        'tagline' => 'Compact & Efficient BOPP Tape Slitter',
        'seo_title' => '300 MM Baby Type Slitting Rewinding Machine | VIVA',
        'seo_description' => 'Compact 300mm Baby Type Slitting Rewinding Machine for short-run BOPP tape production. Ideal for startups and specialized tapes. India.',
        'meta_keywords' => '300mm tape slitter, baby slitting rewinding machine, compact tape machine, BOPP tape slitter, VIVA',
        'description' => 'The 300mm Baby Type Slitting Rewinding Machine is a compact, highly efficient unit designed for short-run production of BOPP packing tapes, stationery tapes, and specialized industrial adhesives. Often used by packaging companies starting their in-house tape manufacturing or larger converter plants needing a dedicated short-run machine, it requires minimal floor space while delivering the same precise razor slitting quality as our industrial-scale models.',
        'features' => "Compact tabletop or small-footprint floor standing design\nPrecision razor-blade slitting assembly with 1mm spacers\nInterchangeable rewinding shafts (1 inch and 3 inch core sizes)\nVariable speed AC drive with digital control\nAdjustable lay-on rollers for varying tape densities\nMechanical core locking mechanism\nEasy-thread web path for rapid job setups",
        'applications' => "Stationery and desktop dispenser tapes (12mm-24mm)\nShort-run customized printed packing tapes\nColor-coded industrial marking tapes\nSample roll production and testing\nKapton and polyimide specialty tapes",
        'benefits' => "Ideal entry-level machine with low capital investment\nExtremely fast changeover times for short custom runs\nOperates on standard single-phase power supply\nRequires minimal operator training\nSmall footprint saves valuable factory floor space",
        'specifications' => json_encode([
            "Max Web Width" => "300mm",
            "Unwind Diameter" => "Max 400mm",
            "Rewind Diameter" => "Max 150mm",
            "Slit Width" => "12mm to 300mm",
            "Production Speed" => "Up to 100 m/min",
            "Core Sizes" => "25mm (1 inch) / 76mm (3 inch)",
            "Power Requirement" => "220V, 1 Phase, 2kW",
            "Weight" => "Approx 200 kg"
        ])
    ],
    '1350-mm-turret-type-slitting-rewinding-machine' => [
        'tagline' => 'High-Volume Continuous BOPP Tape Production',
        'seo_title' => '1350 MM Turret Type Slitting Rewinding Machine | VIVA',
        'seo_description' => 'Fully automatic 1350mm Turret Type Slitting Rewinding Machine for high-volume BOPP tape manufacturing. Non-stop production. VIVA Engineering.',
        'meta_keywords' => 'turret type slitting machine, BOPP tape slitting rewinding, high speed tape slitter, tape manufacturing machine, VIVA',
        'description' => 'Representing the pinnacle of high-volume tape manufacturing, the 1350mm Turret Type Slitting Rewinding Machine provides fully automatic, continuous conversion of BOPP adhesive tapes. The four-shaft turret mechanism allows the operator to load new paper cores and unload finished tape rolls while the machine continues slitting and rewinding on the active shafts at full production speed. This zero-downtime architecture maximizes OEE (Overall Equipment Effectiveness) for large-scale tape manufacturers.',
        'features' => "Four-position automatic rotating turret rewinding system\nSound-proofed unwinding cabin to reduce 90dB adhesive stripping noise\nAutomatic length counting, rapid deceleration, and turret indexing\nPneumatic tape end tabbing and cutting mechanism\nTeflon-coated expanding bow roller for bubble-free rewinding\nServo-driven precise tension synchronization\nOptional auto-core loader and finished roll unloader integration",
        'applications' => "Transparent and brown BOPP carton sealing tapes\nPrinted branded packaging tapes\nDouble-sided tissue tapes\nAluminium foil tapes\nDuct tapes and cloth tapes",
        'benefits' => "Unmatched production capacity with zero stoppage for roll changes\nDramatically reduces operator fatigue via automated indexing\nSignificantly lowers factory noise pollution\nConsistently tight, perfectly aligned retail-ready retail rolls\nLowers per-unit manufacturing cost at scale",
        'specifications' => json_encode([
            "Max Web Width" => "1300mm / 1350mm",
            "Turret Type" => "Four-Shaft Automatic Rotation",
            "Unwind Diameter" => "Max 800mm",
            "Rewind Diameter" => "Max 150mm (Standard)",
            "Operating Speed" => "Up to 180 m/min",
            "Slit Width" => "Min 12mm",
            "Motor System" => "AC Servo + Vector Control",
            "Noise Level" => "Under 75dB (with cabin)"
        ])
    ],
    'core-cutting-machine-for-bopp-tapes' => [
        'tagline' => 'Precision Paper Tube Cutting for Tape Cores',
        'seo_title' => 'Core Cutting Machine for BOPP Tapes | VIVA',
        'seo_description' => 'High-speed Paper Core Cutting Machine for 1-inch and 3-inch BOPP tape cores. Dust-free slicing, multi-blade options. India.',
        'meta_keywords' => 'core cutting machine, paper tube cutter, BOPP tape core machine, tape core cutter, VIVA',
        'description' => 'To feed high-speed tape slitting machines, tape manufacturers require perfectly cut, dust-free paper cores at massive volumes. VIVA Engineering offers specialized Core Cutting Machines tailored for the adhesive tape sector. Utilizing circular hardened-steel blades cutting against a steel or nylon mandrel, this machine provides burr-free cuts on 1-inch and 3-inch paper tubes without generating contaminating paper dust that could ruin the adhesive tape.',
        'features' => "Pneumatically operated cutting knife advancement\nMulti-knife mounting options for simultaneous multiple cuts\nQuick-change mandrels for different inner core diameters\nDust-free slicing/crush cut methodology\nAdjustable length stopper for high-precision sizing\nSafety guard over cutting zone with auto-stop\nHeavy-duty motor for thick-walled cardboard tubes",
        'applications' => "BOPP carton sealing tape cores (76mm/3-inch)\nStationery tape cores (25.4mm/1-inch)\nStretch film and cling wrap cores\nLabel printing cores\nThermal paper ticket cores",
        'benefits' => "Eliminates paper dust contamination on finished adhesive tapes\nPerfectly square edges prevent tape telescoping\nMatches the core output requirements of turret slitting machines\nExtremely low maintenance and tooling costs\nSafe and simple operation for semi-skilled labor",
        'specifications' => json_encode([
            "Tube Inner Diameter" => "25.4mm to 76mm (Customizable)",
            "Tube Wall Thickness" => "2mm to 10mm",
            "Cutting Length" => "12mm to 1000mm",
            "Cutting Method" => "Circular Slicing Blade",
            "Operation Type" => "Pneumatic / Semi-Auto",
            "Production Speed" => "Up to 30 cuts/min",
            "Power Requirement" => "380V, 3 Phase, 1.5kW"
        ])
    ],

    // --- 7. Slicer & PVC Cutters ---
    'masking-tape-slicer-cutting-machine' => [
        'tagline' => 'Log Rewinding & Slicing for Specialty Tapes',
        'seo_title' => 'Masking Tape Slicer Cutting Machine | VIVA',
        'seo_description' => 'Precision Log Roll Slicer Cutting Machine for masking tapes and foam tapes. Single shaft slicing with programmable widths. India.',
        'meta_keywords' => 'tape slicer cutting machine, log roll slicer, masking tape cutter, foam tape slitting, VIVA',
        'description' => 'Unlike traditional slitting—where a web is unwound, slit, and rewound—the Slicer Cutting Machine utilizes the "Log Winding" and "Slicing" method. The masking tape jumbo roll is first rewound onto a single long core (a Log). This log is then mounted onto the Slicer, which operates like a lathe, plunging a spinning circular blade into the spinning log, slicing off consumer rolls one by one. This method is critical for thick foam tapes, VHB tapes, and delicate masking tapes where traditional slitting would cause adhesive oozing or stretching.',
        'features' => "Heavy-duty steel lathe bed construction\nSiemens/Delta PLC with customizable slicing width programs\nServo-motor driven blade carriage for micrometer-level accuracy\nAutomatic blade silicone spraying/cooling system\nVariable speed chucks for the log and the cutting blade\nAuto-sharpening mechanism for the circular cutting blade\nSafety light curtains and fully enclosed lexan guards",
        'applications' => "Crepe paper masking tapes\nDouble-sided foam tapes and VHB\nCloth tapes and duct tapes\nAluminum and copper foil tapes\nMedical and surgical adhesive tapes",
        'benefits' => "Prevents adhesive oozing on the edges of thick foam tapes\nMaintains original log tension across all sliced rolls\nDrastically reduces setup time compared to traditional slitting\nAllows rapid production of mixed-width orders (e.g., 24mm, 36mm, 48mm)\nSilicone blade cooling prevents adhesive melting during cuts",
        'specifications' => json_encode([
            "Log Outside Diameter" => "Max 300mm",
            "Log Length" => "Max 1300mm",
            "Blade Diameter" => "350mm / 400mm",
            "Slicing Width Accuracy" => "+/- 0.1 mm",
            "Blade Cooling" => "Automatic Silicone Pump",
            "Control System" => "PLC with Touch Panel",
            "Carriage Drive" => "AC Servo Motor",
            "Blade Auto-Sharpening" => "Diamond Grinding Stones"
        ])
    ]
];

echo "Seeding Part 3 (Tapes & Slicers)...\n";
$stmt = $pdo->prepare("UPDATE products SET tagline=?, seo_title=?, seo_description=?, meta_keywords=?, description=?, features=?, applications=?, benefits=?, specifications=? WHERE slug=?");

foreach ($products as $slug => $data) {
    $stmt->execute([
        $data['tagline'], $data['seo_title'], $data['seo_description'], $data['meta_keywords'], 
        $data['description'], $data['features'], $data['applications'], $data['benefits'], 
        $data['specifications'], $slug
    ]);
    if ($stmt->rowCount() > 0) {
        echo "  Updated: $slug\n";
    }
}
echo "Part 3 complete.\n";
