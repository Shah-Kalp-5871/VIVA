<?php
/**
 * VIVA Engineering - Product Content Migration (Part 2/3)
 * Roll-to-Roll (continued), Foil, Printing, Adhesive Tapes, PVC Cutters
 */
require_once 'admin/includes/functions.php';

$products = [
    // --- 3. Roll to Roll Processing Machines (continued) ---
    'paper-rewinding-machine' => [
        'tagline' => 'High-Speed Paper Core Transfer & Rewinding',
        'seo_title' => 'Paper Rewinding Machine | VIVA Engineering',
        'seo_description' => 'Industrial Paper Rewinding Machine for fast core transfer and edge alignment. VIVA Engineering India.',
        'meta_keywords' => 'paper rewinding machine, paper converting rewinder, core transfer machine, VIVA',
        'description' => 'The VIVA Paper Rewinding Machine is an essential utility for paper converters handling large master rolls. It is designed to quickly transfer paper webs from large damaged cores onto fresh cores, split massive jumbo rolls into manageable sizes, and ensure tight, uniform winding density before the sheeting or printing process. With robust pneumatic braking and an intuitive tension control interface, this rewinder dramatically improves downstream processing efficiency.',
        'features' => "Pneumatic braking system for consistent unwind tension\nCantilevered shaft design for rapid roll changes\nHeavy-duty steel side plates and vibration-dampening base\nAutomatic edge alignment via infrared sensors\nProgrammable digital length counter with auto-stop\nSafety interlocked enclosure for operator protection\nQuick-release mechanical chucks",
        'applications' => "Board and Kraft paper transfer\nCore salvaging and replacement\nJumbo roll splitting into smaller diameters\nPre-press roll tension optimization\nCoated and specialty paper handling",
        'benefits' => "Saves damaged or loosely wound master rolls\nPrevents web breaks in high-speed printing presses\nReduces operator fatigue with pneumatic handling\nSpace-saving compact design\nSimple to operate with minimal maintenance required",
        'specifications' => json_encode([
            "Web Width" => "800mm to 2000mm",
            "Unwind Diameter" => "Max 1500mm",
            "Rewind Diameter" => "Max 1200mm",
            "Speed" => "Up to 300 m/min",
            "Tension System" => "Pneumatic Brake & Clutch",
            "Core Chucks" => "3 inch to 12 inch options",
            "Guiding" => "Infrared Edge Guide",
            "Counter" => "Digital Meter Counter"
        ])
    ],
    'hm-paper-rewinding-machine-notebook-paper-rewinding-machine' => [
        'tagline' => 'Optimized for Notebook & Ruled Paper Production',
        'seo_title' => 'Notebook Paper Rewinding Machine | VIVA',
        'seo_description' => 'HM Paper Rewinding Machine optimized for notebook paper and ruled paper production. Precision web guiding, zero tension variation. India.',
        'meta_keywords' => 'notebook paper rewinder, HM paper rewinding machine, exercise book paper rewinder, VIVA',
        'description' => 'Engineered specifically for the exercise notebook manufacturing industry, the HM Paper Rewinding Machine efficiently processes lightweight papers (40-80 GSM) without wrinkling or tearing. This machine ensures that ruled and printed paper webs are perfectly aligned before they enter automatic notebook making machines or sheeters. It utilizes a precision dancer-roller tension system to absorb any sudden pulls from the unwind reel, maintaining a perfectly flat web profile.',
        'features' => "Dancer-roller closed loop tension control\nSpecially coated traction rollers to prevent ink smudging\nPrecise web guiding system for lined paper alignment\nHigh-speed operation tuned for lightweight paper\nAutomatic tension tapering for perfect roll density\nPneumatic lift for massive jumbo paper rolls\nSplice detection capability",
        'applications' => "Exercise notebook manufacturing\nRuled paper production\nExam sheets and stationary continuous forms\nLightweight craft and greaseproof paper\nCarbonless copy paper (NCR)",
        'benefits' => "Guarantees perfect alignment of ruled lines during conversion\nZero web breakage on thin paper stocks\nPrevents ink transfer or smudging on pre-printed webs\nMaximizes output of downstream notebook making machines\nHighly energy efficient drive system",
        'specifications' => json_encode([
            "Material Thickness" => "40 GSM to 120 GSM",
            "Web Width" => "Max 1200mm",
            "Speed" => "Up to 250 m/min",
            "Tension Control" => "Dancer Arm + Load Cell",
            "Unwind Load" => "Pneumatic/Hydraulic Lift",
            "Guiding System" => "High-Speed Ultrasonic",
            "Motor" => "AC Vector Drive"
        ])
    ],

    // --- 4. Aluminium Foil Processing Machines ---
    'aluminium-foil-rewinding-machine' => [
        'tagline' => 'Wrinkle-Free Foil Rewinding for Packaging',
        'seo_title' => 'Aluminium Foil Rewinding Machine | VIVA',
        'seo_description' => 'Precision Aluminium Foil Rewinding Machine for consumer rolls, pharma foil, and food packaging. Wrinkle-free processing. India manufacturer.',
        'meta_keywords' => 'aluminium foil rewinder, house foil rewinding machine, pharma foil machine, blister foil rewinder, VIVA',
        'description' => 'The Aluminium Foil Rewinding Machine converts large industrial jumbo rolls into consumer-sized household rolls or catering rolls used in kitchens, restaurants, and pharmaceutical blister packaging. Because aluminium foil has zero elasticity and is prone to creasing, this machine is equipped with ultra-precision machined rollers, specialized spreader bows, and a zero-friction web path. The fully automatic turret mechanism provides continuous operation by automatically cutting and gluing the foil onto fresh cores without stopping the machine.',
        'features' => "Fully automatic turret rewinding (continuous operation)\nHot-melt glue application for core adherence and tail sealing\nPrecision knife cutting system for clean foil edges\nAutomatic core loading from an integrated hopper\nMicro-computer length control for exact roll sizing\nAnti-static active bars and dust enclosure\nTension isolation zones to prevent web snapping",
        'applications' => "Household aluminium foil rolls\nCatering and food service foil\nPharmaceutical blister foil (bare and printed)\nHookah foil conversion\nHairdressing foil rolls",
        'benefits' => "100% wrinkle-free finished rolls\nDrastically reduces labor with automatic core loading and sealing\nZero machine stoppage between roll changes\nExact length measurement saves expensive foil material\nFood-grade compliant contact surfaces",
        'specifications' => json_encode([
            "Foil Thickness" => "9 to 25 Microns",
            "Mother Roll Width" => "Max 450mm",
            "Mother Roll Dia" => "Max 600mm",
            "Rewind Roll Dia" => "Max 150mm",
            "Production Speed" => "Up to 400 m/min",
            "Operation" => "Fully Automatic Turret",
            "Core Transfer" => "Auto-Glue and Cut"
        ])
    ],
    'aluminium-jumbo-roll-slitting-machine' => [
        'tagline' => 'High-Speed Slitting for Heavy Foil Webs',
        'seo_title' => 'Aluminium Jumbo Roll Slitting Machine | VIVA',
        'seo_description' => 'Heavy-duty Aluminium Jumbo Roll Slitting Machine. Shear edge cutting, dual friction rewinding, high-speed foil conversion. VIVA Engineering.',
        'meta_keywords' => 'aluminium jumbo slitter, foil slitting machine, thick foil slitter, blister foil slitting, VIVA',
        'description' => 'Designed for severe industrial environments, the Aluminium Jumbo Roll Slitting Machine processes massive coils of plain or printed aluminium foil. This heavy-duty machine utilizes circular shear slitting knives constructed from tungsten carbide to effortlessly cut through thick gauges of aluminium and composite laminates. It features a robust cantilevered duplex friction rewinding setup to handle multiple slit reels simultaneously, ensuring perfectly flush edges and uniform roll hardness despite the rigid nature of metallic webs.',
        'features' => "Tungsten carbide circular shear slitting knives\nDual cantilevered friction ring rewinding shafts\nHeavy-duty shaftless unwind with hydraulic floor pickup\nUltrasonic edge guiding suited for reflective metallic surfaces\nDigital, closed-loop taper tension control\nOil-free vacuum trim extraction system\nRigid cast iron side frames for supreme stability",
        'applications' => "Pharmaceutical cold-form blister foils\nDairy and yogurt lidding foils\nAutomotive heat shield materials\nInsulation and HVAC foil tapes\nBattery foil components",
        'benefits' => "Handles immense parent roll weights effortlessly\nClean, burr-free slitting extends tool life\nTungsten knives require infrequent sharpening\nIndependent slip rings prevent web breaks across multiple slits\nExceptional edge straightness for downstream packaging machines",
        'specifications' => json_encode([
            "Foil Thickness" => "12 to 150 Microns",
            "Web Width" => "Max 1200mm",
            "Unwind Dia" => "Max 1000mm",
            "Rewind Dia" => "Max 600mm",
            "Slitting Width" => "Min 25mm",
            "Slitting Type" => "Circular Shear Cut",
            "Unwind Lift" => "Hydraulic Floor Pickup",
            "Edge Guiding" => "Ultrasonic Sensor"
        ])
    ],

    // --- 5. Printing Converting & Processing Machines ---
    'rotogravure-printing-machine' => [
        'tagline' => 'Photographic Quality Printing on Flexible Films',
        'seo_title' => 'Rotogravure Printing Machine | VIVA Engineering',
        'seo_description' => 'High-speed Rotogravure Printing Machine (1 to 10 colors) for flexible packaging. ARC, hot air drying, precise registration. VIVA.',
        'meta_keywords' => 'rotogravure printing machine, gravure press, packaging printing machine, multi-color rotogravure, VIVA',
        'description' => 'The VIVA Rotogravure Printing Machine delivers photographic quality, multi-color printing on a massive array of flexible packaging substrates including BOPP, PET, LDPE, Nylon, and Paper. Engineered for both short and long runs, this high-speed press features electronic line shaft (ELS) or mechanical drive options, offering impeccable color-to-color registration accuracy. Each printing station is equipped with high-efficiency hot air drying hoods, pneumatic heavy-duty doctor blades, and motorized ink circulation pumps to ensure flawless ink transfer at speeds up to 250 m/min.',
        'features' => "Automatic Register Control (ARC) system with camera inspection\nElectronic Line Shaft (ELS) or Mechanical Transmission\nPneumatic doctor blade system with 3-axis adjustment\nHigh-efficiency twin-nozzle hot air drying tunnels\nMotorized ink circulation pumps and viscosity controllers\nShaftless printing cylinder mounting for rapid changeovers\nWeb video inspection system for real-time monitoring",
        'applications' => "Snack food and confectionery packaging\nPharmaceutical blister and strip foils\nShrink sleeves and wrap-around labels\nBeverage labels and stand-up pouches\nDecorative laminates and wallpapers",
        'benefits' => "Superb print quality with deep, rich colors and fine details\nPinpoint +/- 0.1mm color registration accuracy\nRapid job changeovers minimize press downtime\nEnergy-efficient drying systems reduce operating costs\nMassive reduction in waste material during startup",
        'specifications' => json_encode([
            "Colors Options" => "1 to 10 Colors",
            "Web Width" => "600mm to 1300mm",
            "Print Speed" => "150 to 250 m/min",
            "Cylinder Circumference" => "350mm to 800mm",
            "Registration" => "Fully Automatic ARC",
            "Drying System" => "Electric/Thermic Fluid Hot Air",
            "Drive" => "Continuous AC Vector / ELS",
            "Inspection" => "Web Video Camera"
        ])
    ],
    'flexographic-printing-machine' => [
        'tagline' => 'Versatile, Eco-Friendly Flexo Printing Press',
        'seo_title' => 'Flexographic Printing Machine | VIVA Engineering',
        'seo_description' => 'Industrial Flexographic Printing Machine (Stack / CI type) for paper, board, and woven sacks. Eco-friendly water-based ink compatible. India.',
        'meta_keywords' => 'flexographic printing machine, flexo press, woven sack printing, paper bag printing, VIVA',
        'description' => 'Designed for sustainability and versatility, the VIVA Flexographic Printing Machine is the premier choice for printing on paper bags, corrugated boards, woven sacks, and breathable films. Utilizing photopolymer plates and laser-engraved ceramic anilox rollers, this machine provides precise ink metering for both solvent-based and eco-friendly water-based inks. Available in both Stack and Central Impression (CI) configurations, it is highly favored by businesses looking to transition away from gravure cylinders to more cost-effective flexo prepress processes.',
        'features' => "Laser-engraved ceramic anilox rollers with enclosed chamber doctor blades\nStack type or Central Impression (CI) drum architecture\nHydraulic plate cylinder throw-off during machine stop\n360-degree motorized planetary registration adjustment\nIR and powerful hot air combination drying systems\nCompatible with water-based & solvent-based inks\nInline slitting or die-cutting options available",
        'applications' => "Paper shopping bags and sacks\nHDPE/PP woven sacks and cement bags\nCorrugated box liners\nBreathable hygiene films\nAdhesive paper labels",
        'benefits' => "Significantly lower prepress and plate costs compared to gravure\nEnvironmentally friendly due to water-based ink compatibility\nExcellent performance on rough substrates like woven sacks\nQuick and easy anilox and plate sleeve changes\nDurable, low-maintenance mechanical design",
        'specifications' => json_encode([
            "Configuration" => "Stack Type / CI Drum",
            "Colors Available" => "2 to 8 Colors",
            "Web Width" => "600mm to 1500mm",
            "Print Speed" => "100 to 200 m/min",
            "Anilox" => "Ceramic coated (LPI configurable)",
            "Ink System" => "Enclosed Chamber Doctor Blade",
            "Drying" => "Infrared (IR) + Hot Air Blower",
            "Plate Thickness" => "1.14mm to 2.84mm"
        ])
    ]
];

echo "Seeding Part 2 (Foil & Printing)...\n";
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
echo "Part 2 complete.\n";
