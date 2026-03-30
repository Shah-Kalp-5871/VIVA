<?php
/**
 * VIVA Engineering - Product Content Migration (Part 1/3)
 * Slitting, Rewinding, Roll-to-Roll, Aluminium Foil
 */
require_once 'admin/includes/functions.php';

$products = [
    // --- 1. Slitting Rewinding Applications ---
    'paper-slitting-rewinding-machine' => [
        'tagline' => 'High-Speed Precision Slitting for Paper Industries',
        'seo_title' => 'Paper Slitting Rewinding Machine | VIVA Engineering',
        'seo_description' => 'Industrial Paper Slitting Rewinding Machine for kraft, board, and specialty papers. High-speed, precision tension control. Manufacturer India.',
        'meta_keywords' => 'paper slitting machine, paper rewinding machine, paper slitter rewinder, kraft paper slitter, VIVA Engineering',
        'description' => 'The VIVA Engineering Paper Slitting Rewinding Machine is a heavy-duty, high-performance solution designed specifically for the paper converting industry. Engineered to handle a wide range of materials from lightweight specialty papers to heavy kraft and board, this machine delivers perfectly wound rolls with clean, dust-free edges. It features a robust vibration-free frame, advanced PLC-based tension control, and precision circular knife slitting. The automated systems minimize operator intervention leading to reduced downtime and increased daily output.',
        'features' => "Heavy-duty cast iron frame for vibration-free operation\nAdvanced PLC with touch screen HMI for easy parameter setting\nAutomatic web tension control via load cells\nPneumatic core braking and electromagnetic clutch rewinding\nDigital edge and line guiding system (EPC/LPC)\nShaftless unwinding stand for heavy jumbo rolls\nSlit width starting from 25mm to maximum machine width",
        'applications' => "Kraft Paper & Duplex Board\nThermal and ATM Rolls\nSelf-Adhesive Paper Labels\nSilicone Release Paper\nSpecialty and Coated Papers\nNewsprint & Printing Paper",
        'benefits' => "Superior roll density and perfect edge alignment\nReduced paper dust generation during slitting\nHigh operating speeds up to 300 m/min\nFast changeover times between different jobs\nMinimal material wastage during acceleration/deceleration",
        'specifications' => json_encode([
            "Web Width" => "1000mm to 2500mm",
            "Unwind Diameter" => "Up to 1500mm",
            "Rewind Diameter" => "Up to 1000mm",
            "Operating Speed" => "Up to 300 m/min",
            "Slitting Mechanism" => "Circular Rotary Knives",
            "Power Supply" => "380/415V, 3 Phase, 50/60Hz",
            "Control System" => "PLC with Touch Screen HMI",
            "Tension Control" => "Automatic Closed Loop System"
        ])
    ],
    'plastic-slitting-rewinding-machine' => [
        'tagline' => 'Advanced Slitting Solutions for Flexible Films',
        'seo_title' => 'Plastic Film Slitting Rewinding Machine | VIVA',
        'seo_description' => 'Precision Plastic Film Slitting Rewinding Machine for PE, PP, BOPP & PET films. Razor and shear slitting, accurate tension control. India.',
        'meta_keywords' => 'plastic slitting machine, film slitter rewinder, BOPP slitter, PET film slitter, VIVA Engineering',
        'description' => 'Our Plastic Slitting Rewinding Machine is expertly engineered for processing highly sensitive and extensible flexible packaging materials including PE, PP, BOPP, PVC, and PET films. Understanding the critical nature of film tension, this machine incorporates individual friction ring rewinding shafts or duplex differential rewinders to compensate for gauge variations in the parent roll. The servo-driven system paired with razor-in-air or shear rotary slitting ensures pristine cuts without edge stretching or distortion, even at extreme speeds.',
        'features' => "Duplex differential rewinding shafts (Friction shafts)\nRazor-in-air and circular shear rotary slitting options\nLaser core positioning system for quick setup\nStatic elimination system on unwind and rewind\nHydraulic/Pneumatic lifting of jumbo rolls\nTrim extraction via powerful blower system\nMicroprocessor-based diameter calculation",
        'applications' => "BOPP, PET, PVC, LDPE, HDPE, and CPP films\nLaminated flexible packaging structures\nStretch films and shrink sleeves\nMetallized and holographic films\nAdhesive-coated plastic substrates",
        'benefits' => "Eliminates telescoping and wrinkling of finished rolls\nHandles extreme gauge variations with frictionless slip\nProduces tightly wound, market-ready rolls\nSignificantly reduces setup scrap\nHigh structural integrity for 24/7 continuous operation",
        'specifications' => json_encode([
            "Web Width" => "800mm to 1600mm",
            "Unwind Diameter" => "Up to 1000mm",
            "Rewind Diameter" => "Up to 600mm",
            "Operating Speed" => "Up to 400 m/min",
            "Slitting Mechanism" => "Razor Blade / Shear Cut",
            "Rewind Shafts" => "3-inch Differential Friction Shafts",
            "Core Loading" => "Laser Assisted Alignment",
            "Automation" => "Servo Driven, Fully Automatic"
        ])
    ],
    'non-woven-slitting-rewinding-machine' => [
        'tagline' => 'Specialized Slitting for Non-Woven & Textiles',
        'seo_title' => 'Non-Woven Slitting Machine | VIVA Engineering',
        'seo_description' => 'High-efficiency Non-Woven Slitting Rewinding Machine for spunbond, meltblown and medical fabrics. Thermal cutting options. Manufacturer India.',
        'meta_keywords' => 'non-woven slitting machine, fabric slitter rewinder, thermal slitting, spunbond slitter, VIVA Engineering',
        'description' => 'Designed specifically for the expanding non-woven sector, the VIVA Non-Woven Slitting Rewinding Machine offers tailored processing for spunbond, meltblown, SMS, and other engineered fabrics. Because non-woven materials have unique stretch and tensile properties, this machine utilizes specialized low-tension drive profiles and wide-surface spreader rollers to prevent web narrowing or wrinkle formation. Equipped with options for cold shear slitting or heated thermal sealing knives, it produces perfect edges that will not fray, meeting the strict standards of the medical, hygiene, and geotextile industries.',
        'features' => "Low-tension synchronization across all drive zones\nOptional thermal/heated slitting knives to seal edges\nLarge diameter bowed/spreader rollers to prevent wrinkling\nCantilevered rewind shafts for rapid roll unloading\nMeter counting with auto-stop and deceleration\nPneumatic pressure regulation for nip rollers\nEnclosed safety guards with interlock switches",
        'applications' => "Medical grade PPE and surgical drapes\nHygiene products (diapers, sanitary pads)\nSpunbond and Meltblown fabrics (SMS/SMMS)\nGeotextiles and agricultural covers\nAutomotive interior fabrics\nFiltration media",
        'benefits' => "Prevents edge fraying and material degradation\nMaintains fabric loft and structural properties\nExceptionally clean operating environment\nRapid unloading increases machine uptime\nConsistent tension prevents web necking/narrowing",
        'specifications' => json_encode([
            "Web Width" => "1600mm to 3200mm",
            "Unwind Diameter" => "Up to 1200mm",
            "Rewind Diameter" => "Up to 1000mm",
            "Operating Speed" => "Up to 250 m/min",
            "Slitting Types" => "Crush Cut / Shear Cut / Thermal Knife",
            "Material Weight" => "10 GSM to 250 GSM",
            "Spreader" => "Variable Bow Roller",
            "Power Supply" => "380V, 3 Phase"
        ])
    ],

    // --- 2. Center Shaft Slitting Rewinding Machines ---
    'paper-center-shaft-slitting-rewinding-machine' => [
        'tagline' => 'Robust Center-Driven Slitting for Paper',
        'seo_title' => 'Paper Center Shaft Slitting Machine | VIVA',
        'seo_description' => 'Paper Center Shaft Slitting Rewinding Machine for precise roll hardness and tension. Ideal for ticket rolls, label stock & paper. VIVA India.',
        'meta_keywords' => 'center shaft slitting machine, center slitter rewinder, paper ticket slitter, label slitting machine, VIVA Engineering',
        'description' => 'The Paper Center Shaft Slitting Rewinding Machine is engineered utilizing the center winding principle, where the rewinding drive is applied directly to the core shaft rather than the roll surface. This architecture is exceptionally beneficial for delicate papers, pressure-sensitive label stock, and materials that cannot withstand surface pressure. The machine delivers precise, independent tension control, resulting in finished rolls with perfect edge profiles and uniform hardness from the core to the outer diameter.',
        'features' => "Cantilevered single or dual center rewinding shafts\nIndependent servo motors for unwind and rewind zones\nTaper tension control software to prevent telescoping\nHeavy-duty rotary shear slitting mechanism\nUltrasonic edge guiding for opaque and transparent webs\nQuick-lock pneumatic expansion shafts\nIntegrated splice table with pneumatic clamping",
        'applications' => "Self-adhesive label stock\nLottery and ticket rolls\nPOS and thermal receipt rolls\nBaking and parchment paper\nSilicone coated release liners",
        'benefits' => "Zero surface damage to pressure-sensitive materials\nExtremely precise control over roll density profile\nPerfectly aligned edges without dishing or telescoping\nCompact footprint combined with high output\nEase of operation for quick job changeovers",
        'specifications' => json_encode([
            "Web Width" => "800mm to 1300mm",
            "Rewind Principle" => "Center Shaft Driven",
            "Unwind Diameter" => "Up to 1000mm",
            "Rewind Diameter" => "Up to 600mm",
            "Operating Speed" => "Up to 250 m/min",
            "Min Slit Width" => "20mm",
            "Tension Profile" => "Programmable Taper Tension",
            "Guiding System" => "Ultrasonic EPC"
        ])
    ],
    'plastic-center-shaft-slitting-rewinding-machine' => [
        'tagline' => 'Precision Center-Winding for Specialty Films',
        'seo_title' => 'Plastic Center Shaft Slitting Machine | VIVA',
        'seo_description' => 'Plastic Center Shaft Slitting Machine for sensitive films and laminates. Taper tension, zero surface damage, perfect edge profile. Manufacturer India.',
        'meta_keywords' => 'plastic center slitting, film center rewinder, laminate slitting machine, specialty film slitter, VIVA Engineering',
        'description' => 'Engineered for high-value and surface-sensitive flexible materials, the Plastic Center Shaft Slitting Rewinding Machine guarantees pristine roll quality without surface pressure. By avoiding contact drums on the rewinding side, this machine completely eliminates the risk of scratching metallized layers, activating cold-seal adhesives, or permanently stretching thin gauge films. It is equipped with advanced web path geometry and high-precision differential shafts to accommodate the extreme tension requirements of modern composite packaging structures.',
        'features' => "Contact-free center rewinding geometry\nHigh-precision ball-type differential friction shafts\nRazor and rotary shear interchangeable slitting cassettes\nDigital closed-loop tension control with ultrasonic sensors\nLay-on rollers with precision pneumatic pressure balance\nAnti-static active bars across the entire web path\nAutomated fault detection and machine stop",
        'applications' => "Cold seal packaging films\nHigh-barrier metallized films (VMPET, VMCPP)\nLow gauge stretch and cling films\nOptical grade display films\nBattery separator films",
        'benefits' => "Preserves delicate coatings and metallized layers\nCompensates perfectly for varying web thicknesses\nPrevents air entrapment during high-speed winding\nEnsures perfectly flush roll edges\nReduces rejection rates on expensive specialty films",
        'specifications' => json_encode([
            "Web Width" => "1000mm to 1600mm",
            "Rewind Type" => "Center winding with Lay-on rolls",
            "Shaft Type" => "Dual Differential Friction Shafts",
            "Operating Speed" => "Up to 300 m/min",
            "Slitting Mechanism" => "Interchangeable Razor/Shear",
            "Tension Range" => "0.5 kg to 25 kg",
            "Static Elimination" => "Included (Unwind/Rewind)",
            "Safety Standards" => "CE Compliant"
        ])
    ],

    // --- 3. Roll to Roll Processing Machines ---
    'winding-rewinding-machine' => [
        'tagline' => 'Versatile Roll Inspection and Correction',
        'seo_title' => 'Winding Rewinding Machine | VIVA Engineering',
        'seo_description' => 'Industrial Winding Rewinding Machine for inspection, salvage, and roll correction. Reversible operation, precision tension, EPC. India.',
        'meta_keywords' => 'winding rewinding machine, unwinder rewinder, roll salvage machine, roll inspection machine, VIVA',
        'description' => 'The VIVA Winding Rewinding Machine (also known as a salvage or doctoring machine) is an indispensable tool for quality control and material correction. It allows operators to unwind a defective or poorly wound roll, inspect it, remove defects, and rewind it into a perfect, uniform roll. Designed with bi-directional (reversible) operation, stroboscopic inspection lights, and precision edge guiding, this machine recovers valuable materials that would otherwise be scrapped, offering an immediate return on investment.',
        'features' => "Fully reversible bi-directional web drive\nIntegrated inspection table with stroboscopic lighting\nHigh-precision Edge Position Control (EPC) for straight edges\nAdjustable tension control for varying material types\nPre-set digital meter counter with automatic slowdown/stop\nPneumatic air shafts for rapid loading/unloading\nCompact monoblock heavy-duty chassis",
        'applications' => "Roll salvage and defect removal\nEdge alignment correction (telescoped rolls)\nPrint quality inspection\nMaster roll splitting into smaller lengths\nTension correction for loose/tight rolls",
        'benefits' => "Recovers expensive rejected material\nEnsures 100% quality assurance before shipment\nCorrects telescoped or badly wound rolls\nReduces waste and improves sustainability\nEasy operation requires minimal training",
        'specifications' => json_encode([
            "Web Width" => "500mm to 1500mm",
            "Max Roll Diameter" => "800mm (Unwind/Rewind)",
            "Drive System" => "Reversible AC Vector Drive",
            "Operating Speed" => "Up to 150 m/min",
            "Edge Guiding" => "Photoelectric EPC",
            "Core Size" => "3 inch / 6 inch options",
            "Inspection Area" => "Backlit / Strobe options",
            "Frame" => "Mild Steel Monoblock"
        ])
    ],
    'doctroring-rewinding-machine-for-batch-coding' => [
        'tagline' => 'High-Speed Variable Data Printing & Inspection',
        'seo_title' => 'Doctoring Rewinding Machine for Batch Coding | VIVA',
        'seo_description' => 'Doctoring Rewinding Machine specifically designed for Thermal Inkjet (TIJ) batch coding, MRP printing, and inspection. VIVA Engineering India.',
        'meta_keywords' => 'doctoring rewinding machine, batch coding machine, inkjet printing rewinder, MRP printing machine, VIVA',
        'description' => 'Specifically engineered for the packaging and pharmaceutical sectors, the VIVA Doctoring Rewinding Machine integrates seamlessly with Thermal Inkjet (TIJ) and Continuous Inkjet (CIJ) printers. It facilitates high-speed, roll-to-roll variable data printing, allowing manufacturers to print MRP, batch numbers, manufacturing dates, and barcodes directly onto packaging films and labels before they hit the form-fill-seal lines. The machine ensures consistent speed and zero-vibration over the printing platen, guaranteeing crisp, scannable prints.',
        'features' => "Vibration-free printing platen for CIJ/TIJ integration\nEncoder synchronisation for variable speed printing\nMissing print/barcode verification camera (optional)\nReversible drive for re-inspection of printed codes\nPrecise web tension to prevent print distortion\nCantilevered design for quick single-operator roll changes\nSmall footprint for cleanroom environments",
        'applications' => "Pharmaceutical blister foils\nFMCG flexible packaging (chips, biscuits)\nSelf-adhesive printed labels\nShrink sleeve labels\nLaminate pouches and sachets",
        'benefits' => "Eliminates offline marking bottlenecks on packaging lines\nEnsures 100% readable, scannable barcodes and batch codes\nFrees up primary packaging equipment logic\nPrevents packaging material waste\nHighly flexible for short and long print runs",
        'specifications' => json_encode([
            "Web Width" => "300mm to 800mm",
            "Max Roll Dia" => "500mm",
            "Operating Speed" => "Up to 100 m/min (Print Dependant)",
            "Printer Compatibility" => "TIJ, CIJ, Laser coders",
            "Encoder" => "Included for print sync",
            "Edge Guiding" => "Standard EPC",
            "Tension Control" => "Powder Clutch/Brake",
            "Power" => "220V Single Phase"
        ])
    ]
];

// Insert data
echo "Seeding Part 1 (Slitting & Roll-to-Roll)...\n";
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
echo "Part 1 complete.\n";
