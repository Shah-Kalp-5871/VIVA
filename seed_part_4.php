<?php
/**
 * VIVA Engineering - Product Content Migration (Part 4/4)
 * Slicers, PVC, Coating, Embossing, Extra Equipment
 */
require_once 'admin/includes/functions.php';

$products = [
    // --- 7. Slicer & PVC Cutters (remaining) ---
    'manual-model-slicer-cutting-machine' => [
        'tagline' => 'Entry-Level Precision Tape Log Slicing',
        'seo_title' => 'Manual Model Slicer Cutting Machine | VIVA',
        'seo_description' => 'Manual Slicer Cutting Machine for masking, foam, and specialty tapes. Cost-effective log roll slicing for startups. Manufacturer India.',
        'meta_keywords' => 'manual slicer machine, tape log slicer, manual foam tape cutter, masking tape slicer, VIVA Engineering',
        'description' => 'The Manual Model Slicer Cutting Machine provides a cost-effective entry point for businesses looking to convert masking tapes, double-sided tapes, and foam tapes from master logs into consumer rolls. While the blade carriage movement and sizing are manipulated manually by the operator via precision hand-wheels and a digital counter, the core spindle and the rotary cutting blade are fully motorized. This ensures accurate, clean slices without the high capital investment of a fully automated servo-controlled system.',
        'features' => "Heavy-duty cast bed to eliminate slicing vibrations\nDigital LCD display for precise slicing width measurement\nMotorized log spindle with variable AC drive speed\nMotorized high-speed circular cutting blade\nManual hand-wheel carriage traverse\nIntegrated blade silicone lubrication system\nProtective acrylic safety shield over the cutting zone",
        'applications' => "Short-run custom tape slicing\nMasking tape and double-sided tissue tapes\nFoam and VHB tapes\nAthletic and medical adhesive tapes\nCloth and duct tapes",
        'benefits' => "Very low initial capital investment\nExtreme flexibility for producing single custom-width rolls\nMinimal maintenance compared to servo/PLC driven machines\nQuick log loading and unloading\nPerfect for low-volume, high-mix production environments",
        'specifications' => json_encode([
            "Log Outside Diameter" => "Max 300mm",
            "Log Length" => "Max 1300mm",
            "Slicing Width" => "Manual (Digital Display)",
            "Blade Traverse" => "Manual Hand-wheel",
            "Log Drive" => "AC Motor, Inverter Control",
            "Blade Drive" => "AC Motor",
            "Lubrication" => "Manual Drip/Spray System",
            "Power" => "220V/380V options"
        ])
    ],
    'semiauto-model-slicer-cutting-machine' => [
        'tagline' => 'Semi-Automatic Log Slicing for Mid-Volume Production',
        'seo_title' => 'Semi-Auto Slicer Cutting Machine | VIVA',
        'seo_description' => 'Semi-Automatic Slicer Cutting Machine. Programmable cutting sequence, auto blade advance. Ideal for medium volume tape slicing. India.',
        'meta_keywords' => 'semi automatic slicer, tape slicing machine, log roll cutter, auto tape slicer, VIVA Engineering',
        'description' => 'The Semi-Auto Model Slicer Cutting Machine bridges the gap between manual labor and full automation. The operator manually indexes the carriage to the desired width using a digital position display, but the actual plunge-cutting sequence—where the blade enters the log, slices the tape, and retracts—is completely automated via pneumatics. This semi-automatic approach ensures a consistent plunge speed and pressure, resulting in perfectly uniform, burr-free cuts on thick foam tapes and sensitive masking tapes, removing human error from the cutting stroke.',
        'features' => "Pneumatic/Hydraulic automated blade plunge and retraction\nAdjustable plunge speed for hard vs soft materials\nManual carriage indexing with digital position readout\nIndependent AC variable speed drives for log and blade\nAutomatic silicone blade cooling spray during cut cycle\nQuick-action pneumatic chuck for rapid log exchange\nRobust linear guideways for smooth carriage movement",
        'applications' => "Double-sided foam and VHB tapes\nMasking and paper tapes\nIndustrial duct tapes\nTeflon and Kapton specialty tapes\nRubber and silicone splices",
        'benefits' => "Consistent, repeatable cutting pressure eliminates edge distortion\nReduces operator fatigue compared to fully manual models\nFaster cycle times than manual machines\nExcellent performance on difficult-to-cut thick foams\nHigh ROI for medium-scale manufacturers",
        'specifications' => json_encode([
            "Log OD" => "Max 300mm",
            "Log Length" => "Max 1300mm",
            "Carriage Indexing" => "Manual Hand-wheel + Digital",
            "Plunge Cutting" => "Hydraulic/Pneumatic Auto",
            "Blade Speed" => "Adjustable via Inverter",
            "Blade Cooling" => "Auto Spray System",
            "Chucking" => "Pneumatic Expansion",
            "Weight" => "Approx 800 kg"
        ])
    ],
    'manual-pvc-tape-cutting-machine' => [
        'tagline' => 'Single Shaft Cutting for PVC Insulation Tapes',
        'seo_title' => 'Manual PVC Tape Cutting Machine | VIVA',
        'seo_description' => 'Manual PVC Tape Cutting Machine for electrical insulation tapes. Hardened steel blades, precision slicing. Manufacturer VIVA India.',
        'meta_keywords' => 'PVC tape cutting machine, electrical tape slicer, manual insulation tape cutter, PVC tape machine, VIVA',
        'description' => 'PVC electrical insulation tapes require a very specific cutting dynamic to prevent the vinyl backing from stretching, melting, or "telescoping" during the slice. The VIVA Manual PVC Tape Cutting Machine is specially designed with a high-torque, low-vibration spindle and employs hardened high-speed steel (HSS) blades rather than standard circular knives. The operator mounts a PVC log onto the shaft and uses a mechanical lever system to precisely plunge the blade into the PVC, creating smooth, flat-edged rolls of insulation tape.',
        'features' => "High-torque spindle optimized for dense PVC/Vinyl\nLever-operated manual plunge mechanism\nAdjustable mechanical stoppers for exact width sizing\nHSS (High Speed Steel) cutting blades designed for plastics\nHeavy cast iron machine bed for zero vibration\nBlade cooling/lubrication system\nSafety guard over the spinning log",
        'applications' => "PVC electrical insulation tapes\nVinyl hazard warning tapes\nPipe wrapping tapes\nWire harnessing tapes\nColor coding tapes",
        'benefits' => "Produces perfectly flat, non-telescoped PVC rolls\nExtremely durable construction for decades of use\nLow tooling cost with easily re-sharpenable HSS blades\nSimple, intuitive operation\nRequires very little floor space in the factory",
        'specifications' => json_encode([
            "Material" => "PVC / Vinyl Tapes",
            "Log OD" => "Max 150mm",
            "Log Length" => "Max 1300mm",
            "Slicing Width" => "Adjustable via Mechanical Stops",
            "Operation" => "Manual Lever Plunge",
            "Blade Type" => "Fixed HSS Knife",
            "Log Drive" => "AC Motor",
            "Lubrication" => "Manual Drip"
        ])
    ],
    'fully-auto-double-shaft-pvc-tape-cutting-machine' => [
        'tagline' => 'High-Volume Double Shaft Automated PVC Cutting',
        'seo_title' => 'Fully Auto Double Shaft PVC Tape Cutting Machine | VIVA',
        'seo_description' => 'Fully Auto Double Shaft PVC Tape Cutting Machine. Servo driven, dual log cutting for massive electrical tape production volume. India.',
        'meta_keywords' => 'double shaft PVC tape cutting, automatic PVC slitter, electrical tape manufacturing machine, PVC tape slicer, VIVA',
        'description' => 'To meet massive market demand for electrical insulation tapes, the Fully Auto Double Shaft PVC Tape Cutting Machine doubles production output by slicing two PVC logs simultaneously. Controlled entirely by a central PLC and a touchscreen HMI, the machine utilizes servo motors to automatically index the blade carriage to predefined widths and hydraulically plunge the specialized HSS cutting knives into both logs at once. This system ensures 100% uniformity across millions of rolls, with zero operator intervention during the cutting cycle.',
        'features' => "Dual-shaft configuration slices two logs simultaneously\nSiemens/Delta PLC with full Touch Screen HMI\nAC Servo motors for precise micrometer wide indexing\nHydraulic automated plunge cutting with speed profiling\nAutomatic pneumatic chucking and log ejection system\nAutomatic silicone/oil spray lubrication cycle\nHeavy-duty enclosed safety cabinet with interlocks",
        'applications' => "High-volume PVC electrical insulation tapes\nAutomotive wire harness tapes\nUnderground pipe wrapping protection tapes\nVinyl line marking and hazard tapes\nThick gauge agricultural tapes",
        'benefits' => "Doubles output capacity versus single-shaft machines\nZero operator input required during the slicing program\nPerfect consistency from the first to the thousandth cut\nBlade speed profiling prevents PVC melting at the core\nSignificantly reduces labor cost per roll produced",
        'specifications' => json_encode([
            "Machine Type" => "Dual Shaft Automatic Lathe",
            "Log OD" => "Max 150mm x 2 Logs",
            "Log Length" => "Max 1350mm",
            "Indexing Accuracy" => "+/- 0.1 mm (Servo Driven)",
            "Plunge Cutting" => "Hydraulic, Variable Speed",
            "Control Interface" => "10-inch Touch Screen HMI",
            "Lubrication" => "Fully Automatic Pump",
            "Ejection" => "Automatic Pneumatic Unloading"
        ])
    ],

    // --- 10. Coating Processing machines ---
    'bopp-tape-coating-machine' => [
        'tagline' => 'Industrial BOPP Adhesive Coating Lines',
        'seo_title' => 'BOPP Tape Coating Machine | VIVA Engineering',
        'seo_description' => 'Industrial BOPP Tape Coating Machine. High precision Mayer bar / Comma coating, multi-zone hot air drying. Complete tape manufacturing line. India.',
        'meta_keywords' => 'BOPP tape coating machine, adhesive coating line, tape manufacturing plant, water based acrylic coating, VIVA',
        'description' => 'The VIVA BOPP Tape Coating Machine is a complete, industrial-scale manufacturing line that transforms raw BOPP film and liquid adhesive into finished jumbo rolls of packing tape. Typically running water-based acrylic adhesives, the line features a high-precision Mayer Bar or Comma coating head to apply a perfectly uniform adhesive layer. The coated film then travels through a massive, multi-zone thermic fluid or hot-air drying tunnel before being rewound into a master jumbo roll on a continuous turret rewinder.',
        'features' => "High-precision Mayer Bar or Comma roller coating head\nMulti-zone (10m to 30m) arched drying tunnel for high-speed curing\nThermic fluid, gas, or electrical hot air heat exchangers\nFully automatic EPC (Edge Position Control) web guiding\nUnwind and Rewind with automatic, continuous-flying-splice turrets\nIn-line corona treatment system for enhanced adhesive anchorage\nDigital coat-weight measurement and control integration",
        'applications' => "Brown and Clear BOPP Carton Sealing Tapes\nPrinted packing tapes (when coupled with inline printers)\nWater-based acrylic adhesive tapes\nSolvent-based adhesive tapes (with explosion-proof options)\nStationery and desktop dispenser tapes",
        'benefits' => "Produces complete, market-ready jumbo tape rolls in-house\nDrastic reduction in raw material costs vs buying pre-coated jumbos\nAbsolute control over adhesive coat weights and stickiness (tack)\nContinuous non-stop operation via flying splice turrets\nHighly energy efficient drying tunnels built with premium insulation",
        'specifications' => json_encode([
            "Coating Width" => "500mm / 1000mm / 1300mm / 1600mm",
            "Coating Method" => "Mayer Bar / Comma Roller",
            "Adhesive Type" => "Water-based / Solvent-based (Optional)",
            "Drying Tunnel" => "10m to 30m (Multi-Zone Arched)",
            "Heating Medium" => "Thermic Fluid / Gas / Steam",
            "Production Speed" => "100 to 250 m/min",
            "Turrets" => "Automatic Flying Splice (Unwind/Rewind)",
            "Corona Treater" => "Included Inline"
        ])
    ],
    'water-base-coating-machine' => [
        'tagline' => 'Eco-Friendly Multipurpose Coating Lines',
        'seo_title' => 'Water Base Coating Machine | VIVA Engineering',
        'seo_description' => 'Eco-friendly Water Base Coating Machine for applying adhesives, primers, and barrier coatings to paper and film. High-efficiency drying. India.',
        'meta_keywords' => 'water base coating machine, eco friendly coating, aqueous coating line, primer coating machine, VIVA Engineering',
        'description' => 'As the packaging industry shifts toward sustainable processes, the VIVA Water Base Coating Machine provides a robust platform for applying completely solvent-free, eco-friendly aqueous coatings. Whether applying water-based adhesives, moisture barrier coatings, or print-receptive primers, this machine excels in uniformly distributing liquid chemistry across paper, board, and plastic films. Due to the high latent heat of vaporisation of water, this machine is equipped with exceptionally powerful, high-velocity air impingement drying nozzles.',
        'features' => "Gravure, Reverse Roll, or Mayer Bar coating head configurations\nHigh-velocity air impingement drying nozzles specifically designed for aqueous evaporation\nClosed-loop adhesive pumping and filtration system\nStainless steel contact parts to prevent rusting/contamination\nContinuous web tension control via load cells and PLC\nAutomated inline web guiding systems\nHeat recovery systems to minimize energy consumption",
        'applications' => "Water-based adhesive tapes and labels\nPrint-receptive primer coating for digital/flexo printing\nMoisture and grease barrier coatings for food packaging\nSilicone release liner production\nHeat sealable coatings on paper and foil",
        'benefits' => "Environmentally friendly operation with zero VOC emissions\nNo explosion-proofing required, lowering factory insurance costs\nHighly efficient drying removes water without scorching the substrate\nExtremely versatile for processing both paper and plastic webs\nProduces food-safe, FDA compliant coated packaging materials",
        'specifications' => json_encode([
            "Coating Head" => "Interchangeable (Gravure / Reverse Roll)",
            "Chemistry" => "Aqueous (Water-Based) Only",
            "Drying System" => "High-Velocity Air Impingement",
            "Web Width" => "up to 1600mm",
            "Operating Speed" => "50 to 150 m/min (Chemistry Dependant)",
            "Tension Control" => "Fully Automatic Load Cell",
            "Material Contact" => "SS 304 / SS 316L",
            "Environmental" => "Zero VOC emissions"
        ])
    ],
    'paper-coating-machine' => [
        'tagline' => 'Specialized Coating for Release Liners & Labels',
        'seo_title' => 'Paper Coating Machine | VIVA Engineering',
        'seo_description' => 'Industrial Paper Coating Machine for silicone release liners, self-adhesive labels, and specialty papers. VIVA Engineering India.',
        'meta_keywords' => 'paper coating machine, release liner coating, self adhesive label coating, specialty paper coating, VIVA',
        'description' => 'The VIVA Paper Coating Machine is engineered to handle the unique behavioral properties of paper webs, managing the severe hygroscopic expansion and contraction that occurs when applying wet chemistry and heat. This machine is widely used to manufacture silicone release liners (for the label masking industry) and to coat self-adhesive label stock. It features a specialized web path that prevents curling, advanced moisture re-humidification options at the rewinder, and high-precision comma coating heads for an absolutely flat, uniform coat profile.',
        'features' => "Pre-conditioning heating rollers to stabilize the paper web\nHigh-precision Comma Roll or Reverse Gravure coating heads\nCurl-prevention web path geometry\nMoisture re-introduction/humidification misting box prior to rewinding\nExtra-long arched drying oven with individual temperature zones\nEdge Position Control to handle expanding/contracting paper widths\nHeavy-duty shaftless parent roll unwinding stands",
        'applications' => "Silicone release paper liners for stickers/labels\nHot-melt and acrylic self-adhesive paper label stock\nThermal paper chemical coating\nPhotographic and inkjet receptive specialty papers\nGreaseproof barrier papers for fast food",
        'benefits' => "Eliminates edge-curling and wrinkling on coated papers\nMaintains paper structural integrity despite high oven temperatures\nRe-humidification system ensures perfectly flat finished rolls\nExtremely accurate coat weights save expensive silicone/adhesives\nHandles immense paper jumbo rolls to minimize splicing downtime",
        'specifications' => json_encode([
            "Substrate" => "Kraft, Glassine, Woodfree Paper (30 to 200 GSM)",
            "Web Width" => "1000mm to 1600mm",
            "Coating Options" => "Comma Roll / Reverse Gravure",
            "Drying" => "Multi-Zone Arched Hot Air",
            "Post-Treatment" => "Steam Re-humidification Unit",
            "Speed" => "Up to 200 m/min",
            "Tension" => "Automatic Taper Tension",
            "Heating" => "Thermic Fluid / Custom"
        ])
    ],
    'foam-tape-coating-machine' => [
        'tagline' => 'Heavy-Duty Hot Melt Coating for Scrim & Foam',
        'seo_title' => 'Foam Tape Coating Machine | VIVA Engineering',
        'seo_description' => 'Heavy-duty Foam Tape Coating Machine for applying hot-melt pressure sensitive adhesives (HMPSA) to PE, EVA foam, and scrim. India.',
        'meta_keywords' => 'foam tape coating machine, hot melt coating, HMPSA coating, double sided foam tape machine, VIVA Engineering',
        'description' => 'Manufacturing double-sided foam tapes and heavy-duty VHB tapes requires applying highly viscous Hot-Melt Pressure Sensitive Adhesives (HMPSA) to thick, compressible substrates like PE and EVA foam. The VIVA Foam Tape Coating Machine utilizes a specialized hot-melt slot die or heated roll coating mechanism capable of applying very thick adhesive layers (up to 150 microns+) in a single pass. Because hot-melt requires cooling rather than drying, the machine replaces long ovens with powerful chilled-water cooling and laminating nip drums.',
        'features' => "High-precision heated Slot Die or Heated Roll coating head\nIntegrated integration with HMPSA melter/pumping units\nMulti-layer lamination nip to combine foam, adhesive, and a release liner\nLarge diameter chilled-water cooling drums to rapidly cure the adhesive\nLow-tension driving zones to prevent stretching of soft EVA/PE foams\nAutomatic tension control for the release liner unwinding\nNon-stick plasma coated idle rollers",
        'applications' => "Double-sided PE/EVA foam tapes for mirror mounting\nAutomotive VHB (Very High Bond) acrylic foam tapes\nWeather stripping and acoustic insulation foam tapes\nFlexographic plate mounting tapes\nMedical grade skin-contact foam adhesives",
        'benefits' => "Applies perfect, streak-free heavy coat weights of hot-melt adhesive\nNo drying ovens required, saving massive amounts of factory floor space\nZero VOC emissions from hot melt materials\nPrevents stretching or crushing of delicate foam structures during lamination\nContinuous inline lamination produces a ready-to-slice foam log",
        'specifications' => json_encode([
            "Substrates" => "PE, PU, EVA Foam, Scrim, Tissue",
            "Coating Head" => "Heated Slot Die / Roll Coater",
            "Adhesive Type" => "Hot Melt PSA (HMPSA)",
            "Coat Weight" => "20 to 200 GSM",
            "Cooling System" => "Chilled Water Circulation Drums",
            "Lamination" => "Inline Multi-Substrate Nip",
            "Line Speed" => "30 to 100 m/min",
            "Tension" => "Ultra-Low Tension Drive"
        ])
    ],

    // --- 11. Plastic Film Embossing machine ---
    'plastic-film-embossing-machine' => [
        'tagline' => 'Decorative & Functional Film Texturing',
        'seo_title' => 'Plastic Film Embossing Machine | VIVA',
        'seo_description' => 'High-performance Plastic Film Embossing Machine for PE, PP, PVC. Engraved steel rollers, thermal fluid heating, custom texture patterns. India.',
        'meta_keywords' => 'plastic film embossing machine, film texturing machine, PVC embossing, PE embosser, VIVA Engineering',
        'description' => 'The Plastic Film Embossing Machine imparts physical, three-dimensional textures, patterns, and matte finishes onto otherwise flat plastic films (PE, PP, PVC, and BOPP). This process is crucial for creating anti-slip surfaces, decorative packaging, breathable hygiene films, and faux-leather finishes. The web passes between a laser-engraved steel master roller and a resilient rubber backing roller under immense hydraulic pressure and controlled heat, permanently "pressing" the continuous pattern into the film matrix.',
        'features' => "Laser-engraved hardened steel embossing master roller\nHigh-temperature resilient rubber or paper bowl backing roller\nThermic fluid rotary joints for precise roller temperature control\nHeavy-duty hydraulic pressure application system (up to 50 Tons)\nPre-heating drums to soften thick substrates before the nip\nChilled cooling drums to rapidly set the embossed pattern\nQuick-change roller mechanism for fast pattern changeovers",
        'applications' => "Anti-slip PE films for courier bags and heavy duty sacks\nDecorative matte and hologram-base finishes on packaging film\nDiaper back-sheet and hygiene breathable films\nFaux leather (PU/PVC) and wallpaper texturing\nStationery folders and book coverings",
        'benefits' => "Permanently alters film surface characteristics without chemicals or inks\nMassive hydraulic pressure handles both thin gauge and thick rigid films\nSuperior temperature control prevents film melting or web breaks\nDeep, crisp, and permanent pattern recreation\nContinuous high-speed inline processing",
        'specifications' => json_encode([
            "Web Width" => "1000mm to 2000mm",
            "Film Thickness" => "15 to 300 Microns",
            "Embossing Roller" => "Laser Engraved Steel",
            "Backing Roller" => "Heat-Resistant Silicone / Polyamide",
            "Heating Medium" => "Oil / Thermic Fluid",
            "Nip Pressure" => "Hydraulic (Adjustable 10-50 Tons)",
            "Cooling" => "Chilled Water Drums",
            "Speed" => "Up to 150 m/min"
        ])
    ],

    // --- 12. Extra Converting Equipments ---
    'web-guide-system' => [
        'tagline' => 'Precision Web Alignment Control',
        'seo_title' => 'Web Guide System | EPC/LPC | VIVA',
        'seo_description' => 'High-precision Web Guide Systems (EPC, LPC, CPC) for converting machinery. Ultrasonic and optical sensors, motorized actuators. India.',
        'meta_keywords' => 'web guide system, EPC system, edge position control, line guiding, web alignment, VIVA',
        'description' => 'VIVA Web Guide Systems (Edge Position Control - EPC / Line Position Control - LPC) are critical electronic integrations that prevent material drift during unwinding, rewinding, or processing. Utilizing advanced ultrasonic or optical photoelectric sensors, the system identifies the exact edge or printed line of the moving web. A microprocessor then signals a fast-acting motorized linear actuator, which physically swings a pivot frame to instantly correct the web path, ensuring perfectly flush roll edges and accurate print registration.',
        'features' => "Ultrasonic sensors for transparent films and optical sensors for opaque/printed webs\nMicroprocessor-based PID control for zero-hunting smooth correction\nHeavy-duty linear actuators with zero-backlash ball screws\nPivoting steering frame or shifting unwind/rewind stand configurations\nEasy-to-use digital operator interface module",
        'applications' => "Retrofit for existing slitting, coating, and printing machines\nUnwind edge alignment\nRewind edge alignment\nInline routing/steering",
        'benefits' => "Eliminates telescoped rolls and material scrap\nCrucial for maintaining tight tolerances in high-speed slitting\nEasy to retrofit onto old or third-party machinery",
        'specifications' => json_encode([
            "Correction Stroke" => "+/- 50mm to +/- 100mm",
            "Sensors" => "Ultrasonic / Infrared / Optical",
            "Actuator Type" => "AC Servo / DC Stepper Motor",
            "Response Time" => "< 20 milliseconds",
            "Control" => "Digital PID Auto-Tuning"
        ])
    ],
    'air-shafts' => [
        'tagline' => 'Quick-Lock Pneumatic Expansion Shafts',
        'seo_title' => 'Pneumatic Air Shafts | VIVA Engineering',
        'seo_description' => 'Lug type and leaf type Pneumatic Air Shafts for unwinding and rewinding. Quick-lock core expansion, durable aluminium & steel. India.',
        'meta_keywords' => 'air shaft, pneumatic expanding shaft, lug type air shaft, leaf type air shaft, VIVA Engineering',
        'description' => 'Air Shafts are the industry standard for rapidly and securely mounting paper or plastic cores onto unwinding and rewinding stations. By injecting compressed air into a centralized bladder, exterior lugs or leaves expand outward, biting into the inside of the core to provide a slipless torque grip. When deflated, the lugs retract instantly, allowing the heavy roll to be slid off the shaft effortlessly, reducing operator fatigue and slashing roll changeover times.',
        'features' => "Lug type (for heavy torque) and Leaf type (for delicate thin cores) available\nMachined from high-tensile aluminium alloy or heavy-duty steel tube\nDurable, leak-proof internal polyurethane/rubber bladders\nStandard air valves compatible with any factory air gun\nCustom machined journals to fit any machine chuck geometry",
        'applications' => "Slitter rewinders, coating lines, and printing presses\nPaper, plastic film, and foil converting\nStandard 3-inch, 6-inch, and custom core diameters",
        'benefits' => "Slashes roll loading and unloading times from minutes to seconds\nPrevents core slippage and internal core damage\nLightweight aluminium options reduce operator strain",
        'specifications' => json_encode([
            "Lengths Available" => "500mm to 3000mm",
            "Diameter" => "3 inch, 4 inch, 6 inch, 12 inch",
            "Types" => "Lug (Strip) Type / Leaf Type",
            "Material" => "Extruded Aluminium / Seamless Steel",
            "Air Pressure" => "5 to 6 Bar"
        ])
    ],
    'safety-chucks' => [
        'tagline' => 'Secure Support for Rotating Shafts',
        'seo_title' => 'Safety Chucks | VIVA Engineering',
        'seo_description' => 'Flange mounted and foot mounted Safety Chucks for secure air shaft support in converting machines. Auto-locking under rotation. India.',
        'meta_keywords' => 'safety chuck, flange mounted safety chuck, foot mounted chuck, shaft holder, VIVA Engineering',
        'description' => 'Safety Chucks provide rapid, secure mounting and power transmission for air shafts in unwind and rewind stations. Designed so that they only open when in the upright (top) position, they automatically lock the shaft firmly into place the moment the machine begins rotating. This failsafe mechanical geometry guarantees that a massive, spinning jumbo roll cannot accidentally jump out of the machine socket, providing absolute safety for the operator while allowing for instant drop-in roll loading.',
        'features' => "Flange mounted or Foot-mounted structural blocks\nAutomatic locking hand-wheels engaged by rotational torque\nReplaceable hardened steel square or V-shape jaw inserts\nDesigned to handle immense radial and axial loads\nIntegrated shaft extension for direct brake/clutch mounting",
        'applications' => "Unwinding stations for heavy jumbo rolls\nRewinding stations on coating and printing machines\nUpgrades for old mechanical cone-chuck systems",
        'benefits' => "Absolute failsafe operator protection; cannot open while spinning\nFacilitates extremely rapid 'drop-in' air shaft loading via crane/hoist\nEliminates vibration at high speeds",
        'specifications' => json_encode([
            "Mounting Styles" => "Flange / Foot Base",
            "Socket Types" => "Square / V-Shape (VT)",
            "Load Capacity" => "Up to 3000 kg per pair",
            "Material" => "Cast Iron Frame, Hardened Steel Jaws",
            "Locking" => "Hand-Wheel Failsafe"
        ])
    ],
    'wrapping-machine' => [
        'tagline' => 'Stretch Wrapping for Pallets and Roll Logs',
        'seo_title' => 'Stretch Wrapping Machine | VIVA Engineering',
        'seo_description' => 'Industrial Stretch Wrapping Machines for pallets, jumbo rolls, and carton protection. Motorized turntable, pre-stretch carriage. India.',
        'meta_keywords' => 'wrapping machine, stretch wrapper, pallet wrapping machine, roll wrapping, VIVA Engineering',
        'description' => 'The VIVA Stretch Wrapping Machine automates the application of LLDPE stretch film around finished pallets and tall jumbo rolls before shipment. Utilizing a motorized turntable floor plate and a multi-axis motorized film carriage, the machine spirals stretch film tightly around the cargo to protect it from dust, moisture, and transit damage. The advanced power pre-stretch carriage stretches the film up to 250% prior to application, maximizing film yield and creating a rigid, secure shipping unit.',
        'features' => "Heavy-duty low-profile motorized turntable with ramp access\nMotorized vertical film carriage carriage with photo-eye height detection\nPower pre-stretch mechanism stretching film up to 250%\nProgrammable wrap sequences (top wraps, bottom wraps, speeds)\nSafety anti-crush sensors beneath the descending film carriage",
        'applications' => "Palletizing finished boxes of adhesive tapes\nWrapping massive paper and film jumbo rolls horizontally\nSecuring machinery components for transport\nWarehouse dispatch and logistics",
        'benefits' => "Saves up to 50% on stretch film costs via the pre-stretch gear system\nSecures heavy pallets vastly better than manual wrapping\nDrastically reduces warehouse labor\nProfessional, uniformly wrapped pallets for end clients",
        'specifications' => json_encode([
            "Turntable Dia" => "1500mm (Standard)",
            "Max Wrap Height" => "2000mm",
            "Load Capacity" => "Up to 2000 kg",
            "Stretch System" => "Motorized Pre-Stretch (250%)",
            "Control" => "PLC with wrap sequence programs",
            "Operation" => "Semi-Automatic"
        ])
    ],
    'core-cutting-machine' => [
        'tagline' => 'Versatile Core Cutter for Convertors',
        'seo_title' => 'Core Cutting Machine | Extra Equipment | VIVA',
        'seo_description' => 'Versatile Core Cutting Machine for general converting operations. Cuts 3-inch and 6-inch paper and PVC tubes dust-free. India.',
        'meta_keywords' => 'core cutting machine, paper core cutter, 3 inch core cutter, tube cutting machine, VIVA',
        'description' => 'Our versatile Core Cutting Machine is the workhorse of any general converting facility. Unlike specialized tape core cutters, this machine is designed to be highly adaptable, featuring quickly interchangeable nylon mandrels to accommodate a vast array of core sizes, from standard 76mm (3-inch) up to 152mm (6-inch) industrial tubes. Utilizing a single rotary blade mechanism, it easily slices through thick cardboard and PVC cores without generating dust, providing perfect, square edges for rewinding.',
        'features' => "Heavy-duty single circular slicing blade\nInterchangeable nylon mandrels for various core diameters\nAdjustable length measurement bar\nManual or pneumatic plunge mechanism options\nEnclosed blade guard for operator safety\nMinimal maintenance direct-drive motor",
        'applications' => "Printing presses (cutting cores to match job width)\nGeneral slitting and rewinding facilities\nCutting PVC cores for wet environments",
        'benefits' => "Highly versatile—handles any core diameter with a simple mandrel swap\nClean, dust-free cuts protect cleanroom printing environments\nExtremely durable, low-cost maintenance\nCompact footprint",
        'specifications' => json_encode([
            "Core Dia Supported" => "25mm to 152mm (1 inch to 6 inch)",
            "Wall Thickness" => "Up to 15mm Cardboard/PVC",
            "Min Cut Length" => "10mm",
            "Blade Type" => "Circular Bevel Rotary Knife",
            "Operation" => "Pneumatic or Manual Lever",
            "Power" => "380V, 3 Phase"
        ])
    ]
];

echo "Seeding Part 4 (PVC, Slicer, Coating, Extra)...\n";
$stmt = $pdo->prepare("UPDATE products SET tagline=?, seo_title=?, seo_description=?, meta_keywords=?, description=?, features=?, applications=?, benefits=?, specifications=? WHERE slug=?");

foreach ($products as $slug => $data) {
    if (!$data) continue;
    $stmt->execute([
        $data['tagline'] ?? '', 
        $data['seo_title'] ?? '', 
        $data['seo_description'] ?? '', 
        $data['meta_keywords'] ?? '', 
        $data['description'] ?? '', 
        $data['features'] ?? '', 
        $data['applications'] ?? '', 
        $data['benefits'] ?? '', 
        $data['specifications'] ?? '', 
        $slug
    ]);
    if ($stmt->rowCount() > 0) {
        echo "  Updated: $slug\n";
    }
}
echo "Part 4 complete.\n";
