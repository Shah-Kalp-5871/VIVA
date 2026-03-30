<?php
$product_categories = [
    'slitting-rewinding' => [
        'name' => 'Slitting Rewinding Applications',
        'image' => 'assets/images/categories/slitting-rewinding.jpg',
        'description' => 'High-performance slitting and rewinding applications engineered for precision and durability in industrial manufacturing.',
        'features' => [
            'Advanced automatic tension control systems for uniform rewinding.',
            'High-speed operation equipped with precision slitting blades.',
            'Precision web guiding for perfect edge alignment.',
            'Heavy-duty Mild Steel (MS) frame for vibration-free processing.',
            'User-friendly PLC control interface with HMI touch screen.'
        ],
        'specs' => [
            'Production Speed' => 'Up to 200 m/min',
            'Max. Working Width' => 'Up to 1500 mm',
            'Power Consumption' => '7 HP to 15 HP',
            'Material Handling' => 'BOPP, PET, CPP, LDPE, Paper, Foil',
            'Unwind Diameter' => 'Max 1000 mm',
            'Rewind Diameter' => 'Max 600 mm'
        ],
        'applications' => [
            'Flexible packaging manufacturing.',
            'Paper, film, and foil converting industries.',
            'Non-woven fabric processing.',
            'Industrial adhesive tape production.'
        ],
        'benefits' => [
            'Maximizes production efficiency with minimal downtime.',
            'Reduces material waste through high-precision cutting.',
            'Customizable configurations to suit specific industrial needs.',
            'Lower operational costs due to energy-efficient motor drives.'
        ],
        'sub_categories' => [
            'paper-slitting' => [
                'name' => 'Paper slitting Rewinding machine',
                'image' => 'assets/images/products/paper-slitting-machine/paper-slitting-machine-1.png',
                'description' => 'Dedicated paper slitting rewinding machinery for various paper roll types.',
                'specs' => [
                    'Speed' => '200 m/min',
                    'Material' => 'Kraft Paper, Chromo Paper, Laminated Paper',
                    'Power' => '7.5 HP'
                ],
                'variants' => []
            ],
            'plastic-slitting' => [
                'name' => 'Plastic Slitting Rewinding machine',
                'image' => 'assets/images/products/plastic-slitting-machine/plastic-slitting-machine-1.png',
                'description' => 'Specialized plastic and film slitting machinery.',
                'specs' => [
                    'Speed' => '150-200 m/min',
                    'Material' => 'BOPP, PET, PVC, LDPE, HDPE',
                    'Power' => '5 HP to 10 HP'
                ],
                'variants' => []
            ],
            'non-woven-slitting' => [
                'name' => 'Non-woven Slitting Rewinding machine',
                'image' => 'assets/images/products/non-vowen-slitting-machine/non-vowen-slitting-machine-1.jpg',
                'description' => 'Dedicated slitter for non-woven fabrics and textiles.',
                'specs' => [
                    'Speed' => '100 m/min',
                    'Material' => 'Non-woven Fabric, Technical Textiles',
                    'Power' => '3 HP to 5 HP'
                ],
                'variants' => []
            ]
        ]
    ],

    'center-shaft-slitting' => [
        'name' => 'Center Shaft Slitting Rewinding Machines',
        'image' => 'assets/images/categories/center-shaft-slitting.png',
        'description' => 'Engineered for ultimate stability, providing center-supported rewinding for excellent core support and precise handling of fragile or heavy substrates.',
        'features' => [
            'Sturdy center-supported rewinding mechanism for heavy rolls.',
            'High-torque drives for consistent pulling power.',
            'Precision alignment sensors for edge tracking.',
            'Quick-release pneumatic air shafts for rapid roll changeover.',
            'Dual motor drive system for independent tension control.'
        ],
        'specs' => [
            'Speed' => '150 m/min',
            'Max. Roll Weight' => 'Up to 500 kg',
            'Web Width' => '1000 mm / 1300 mm',
            'Power' => '10 HP'
        ],
        'applications' => [
            'Delicate paper slitting and converting.',
            'Heavy-duty plastic and composite material processing.',
            'Industrial printing and packaging material preparation.',
            'Specialty film processing.'
        ],
        'benefits' => [
            'Prevents material deformation during high-speed rewinding.',
            'Enhances operator safety with ergonomic roll handling.',
            'Low maintenance requirements for 24/7 industrial production.',
            'Eliminates core slippage during high-torque rewinding.'
        ],
        'sub_categories' => [
            'paper-center-shaft' => [
                'name' => 'Paper Center Shaft Slitting Rewinding machine',
                'image' => 'assets/images/products/paper-slitting-machine/paper-slitting-machine-1.png',
                'description' => 'Center supported winder for high precision paper processing.',
                'specs' => [
                    'Application' => 'Paper, Cardboard, Specialty Tissues',
                    'Capacity' => '150 MPM'
                ],
                'variants' => []
            ],
            'plastic-center-shaft' => [
                'name' => 'Plastic Center Shaft Slitting Rewinding machine',
                'image' => 'assets/images/products/plastic-slitting-machine/plastic-slitting-machine-1.png',
                'description' => 'Ideal for tension-sensitive plastic film webs.',
                'specs' => [
                    'Application' => 'LDPE, HDPE, PVC, PET Films',
                    'Capacity' => '120-150 MPM'
                ],
                'variants' => []
            ]
        ]
    ],

    'roll-to-roll' => [
        'name' => 'Roll to Roll Processing Machines',
        'image' => 'assets/images/products/non-vowen-slitting-machine/non-vowen-slitting-machine-1.jpg',
        'description' => 'Optimize your production line with our versatile Roll to Roll Processing Machines, designed to seamlessly transport, inspect, and rewind materials.',
        'features' => [
            'Variable speed AC frequency drive for adaptable processing.',
            'Integrated doctoring for batch coding and quality control.',
            'Heavy-duty cast iron frames for vibration-free operations.',
            'Automated web alignment sensors.',
            'Cantilever design for easy roll loading and unloading.'
        ],
        'specs' => [
            'Max Speed' => '150 m/min',
            'Processing Width' => '500 mm / 1000 mm',
            'Motor' => '3 HP to 5 HP',
            'Voltage' => '380V - 420V'
        ],
        'applications' => [
            'Packaging verification and continuous batch coding.',
            'Defect doctoring and removal.',
            'Specialized notebook and HM paper rewinding operations.',
            'Inkjet printer roll mounting.'
        ],
        'benefits' => [
            'Detects and removes defects before final processing.',
            'Streamlines batch coding operations continuously.',
            'Handles a wide variety of web widths and weights seamlessly.',
            'Highly compact footprint for smaller manufacturing spaces.'
        ],
        'sub_categories' => [
            'winding-rewinding' => [
                'name' => 'Winding Rewinding machine',
                'image' => 'assets/images/products/non-vowen-slitting-machine/non-vowen-slitting-machine-1.jpg',
                'description' => 'General purpose winding block for diverse web inputs.',
                'variants' => []
            ],
            'doctoring-rewinding' => [
                'name' => 'Doctoring Rewinding machine for batch Coding',
                'image' => 'assets/images/categories/slitting-rewinding.jpg',
                'description' => 'Inline inspection and precise batch coding integration capabilities.',
                'variants' => []
            ],
            'paper-rewinding' => [
                'name' => 'Paper Rewinding machine',
                'image' => 'assets/images/products/paper-slitting-machine/paper-slitting-machine-1.png',
                'description' => 'High throughput standard paper rewinding mechanism limit.',
                'variants' => []
            ],
            'hm-notebook-rewinding' => [
                'name' => 'HM Paper Rewinding machine / Notebook Paper Rewinding machine',
                'image' => 'assets/images/products/non-vowen-slitting-machine/non-vowen-slitting-machine-1.jpg',
                'description' => 'Custom tension profiles specifically designed for fast notebook and HM production.',
                'variants' => []
            ]
        ]
    ],

    'aluminium-foil' => [
        'name' => 'Aluminium Foil Processing Machines',
        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRS3BUu6k9XVV8bTkQd0-ahDQ0hHw9Si-tbxg&s',
        'description' => 'Handling delicate materials requires utmost precision. Our Aluminium Foil Processing Machines ensure zero structural compromise of metallic webs.',
        'features' => [
            'Ultra-sensitive tension feedback loops specifically for thin-gauge foil.',
            'Specialized micro-gap slitting knives to prevent edge tearing and burrs.',
            'Dust-free and scratch-resistant ultra-smooth roller surfaces.',
            'Automated jumbo roll loading systems with hydraulic lift.',
            'Static eliminator bars for high-speed metallic web processing.'
        ],
        'specs' => [
            'Max Speed' => '100 - 150 m/min',
            'Foil Thickness' => '9 micron to 150 micron',
            'Core ID' => '76 mm / 150 mm',
            'Power' => '5 HP to 7.5 HP'
        ],
        'applications' => [
            'Food-grade aluminium foil rewinding for household use.',
            'Pharmaceutical blister pack foil slitting and preparation.',
            'Industrial insulation and construction foil processing.',
            'Candy and chocolate metallic wrap converting.'
        ],
        'benefits' => [
            'Eliminates foil wrinkling and edge cracking during high-speed processing.',
            'Dramatically increases throughput for high-volume medicinal orders.',
            'Ensures pristine hygienic processing suitable for FDA/Pharma standards.',
            'Minimizes scrap waste of expensive metallic substrates.'
        ],
        'sub_categories' => [
            'foil-rewinding' => [
                'name' => 'Aluminium Foil Rewinding machine',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRS3BUu6k9XVV8bTkQd0-ahDQ0hHw9Si-tbxg&s',
                'description' => 'Specialized foil tension management rewinding.',
                'variants' => []
            ],
            'foil-jumbo-slitting' => [
                'name' => 'Aluminium Jumbo Roll Slitting Machine',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRS3BUu6k9XVV8bTkQd0-ahDQ0hHw9Si-tbxg&s',
                'description' => 'Heavy duty jumbo aluminium spool converter.',
                'variants' => []
            ]
        ]
    ],

    'printing-converting' => [
        'name' => 'Printing Converting & Processing Machines',
        'image' => 'https://www.ndccn.com/uploads/NTH2600-1.jpg',
        'description' => 'Bring your packaging to life with robust rotogravure and flexographic solutions that combine high performance color graphics with structural precision.',
        'features' => [
            'Multi-color continuous printing capabilities with pinpoint registration.',
            'Advanced drying systems (IR or Hot Air) for rapid ink curing.',
            'Integrated web guiding for perfect color-to-color alignment.',
            'Modular design allowing for easy expansion of color stations.',
            'Quick-change cylinder system for minimized job changeover time.'
        ],
        'specs' => [
            'Printing Speed' => '100 - 250 m/min',
            'Max Web Width' => '1000 mm / 1200 mm',
            'Registration Accuracy' => '±0.1 mm',
            'Drying Source' => 'Electric / Gas / Thermic Oil'
        ],
        'applications' => [
            'High-quality flexible packaging and pouch printing.',
            'Label and shrink sleeve manufacturing for FMCG.',
            'Commercial paper, board, and decorative laminate printing.',
            'Industrial warning tape and protective film branding.'
        ],
        'benefits' => [
            'Delivers photo-quality prints consistently across massive production runs.',
            'Reduces ink waste and energy consumption through optimized drying logic.',
            'Versatile enough to handle plastic, paper, and composite metallic webs.',
            'Low maintenance doctor blade systems for long-run consistency.'
        ],
        'sub_categories' => [
            'rotogravure' => [
                'name' => 'Rotogravure Printing Machine',
                'image' => 'https://www.ndccn.com/uploads/NTH2600-1.jpg',
                'description' => 'Premium high-speed rotogravure continuous printing.',
                'variants' => []
            ],
            'flexographic' => [
                'name' => 'Flexographic Printing machine',
                'image' => 'https://www.ndccn.com/uploads/NTH2600-1.jpg',
                'description' => 'Adaptable multi-material flexographic printing line.',
                'variants' => []
            ]
        ]
    ],

    'adhesive-tape' => [
        'name' => 'Adhesive Tape Processing machines',
        'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/300-mm-bopp-tape-cutting-machi-e/main-1.png',
        'description' => 'Our complete range covers everything from BOPP to Masking and PVC tapes with high performance and automated turret mechanisms.',
        'features' => [
            'Automated turret rewinding for uninterrupted continuous 24/7 production.',
            'Precision cardboard and plastic core cutting and loading mechanisms.',
            'Specialized log slicing modules for manual or fully automatic operation.',
            'Non-stick plasma coated rollers for aggressive adhesive handling.',
            'Pneumatic knife engagement for uniform tape edge quality.'
        ],
        'specs' => [
            'Operating Speed' => '150 - 250 m/min',
            'Max Log Width' => '1350 mm',
            'Max Roll Diameter' => '150 mm (Standard)',
            'Power' => '5 HP to 10 HP'
        ],
        'applications' => [
            'High-volume BOPP industrial packing tape manufacturing.',
            'Automotive and industrial Grade-A masking tape production.',
            'Electrical grade PVC tape and insulation material converting.',
            'Specialty double-sided adhesive and foam tape processing.'
        ],
        'benefits' => [
            'Exponentially scales tape production speeds for high market demand.',
            'Ensures perfect, clean tape edges without adhesive bleeding or overlap.',
            'Offers scalable solutions from entry-level (Baby Type) to industrial (Turret).',
            'Drastically lowers per-unit cost through automated high-speed cycles.'
        ],
        'sub_categories' => [
            'bopp-tape-slitting' => [
                'name' => 'BOPP Tape Slitting & Rewinding Machine',
                'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/1350-mm-bopp-tape-cutting-machine/img-1945.png',
                'description' => 'Complete manufacturing lines for BOPP packaging tapes.',
                'variants' => [
                    '300mm-baby' => [
                        'name' => '300 MM Baby Type Slitting Rewinding machine',
                        'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/1350-mm-bopp-tape-cutting-machine/img-1945.png',
                        'price' => 'Enquire Now',
                        'featured' => true
                    ],
                    '1350mm-turret' => [
                        'name' => '1350 MM turret type Slitting Rewinding Machine',
                        'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/300-mm-bopp-tape-cutting-machi-e/main-1.png',
                        'price' => 'Enquire Now',
                        'featured' => true
                    ],
                    'core-cutting-bopp' => [
                        'name' => 'Core Cutting Machine for BOPP Tapes',
                        'image' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/manual-pvc-tape-cutting-machine/main-1.png',
                        'price' => 'Enquire Now',
                        'featured' => false
                    ]
                ]
            ],
            'masking-tape' => [
                'name' => 'Masking Tape Rewinding machine',
                'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/300-mm-bopp-tape-cutting-machi-e/main-1.png',
                'description' => 'Rewinder engineered exclusively for masking tapes.',
                'variants' => []
            ],
            'slicer-cutting' => [
                'name' => 'Slicer Cutting Machine',
                'image' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/manual-pvc-tape-cutting-machine/main-1.png',
                'description' => 'Precision log roll slicing systems across different configurations.',
                'variants' => [
                    'masking-slicer' => [
                        'name' => 'Masking tape Slicer Cutting Machine',
                        'image' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/manual-pvc-tape-cutting-machine/main-1.png',
                        'price' => 'Enquire Now',
                        'featured' => false
                    ],
                    'manual-slicer' => [
                        'name' => 'Manual Model Slicer Cutting machine',
                        'image' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/manual-pvc-tape-cutting-machine/main-1.png',
                        'price' => 'Enquire Now',
                        'featured' => false
                    ],
                    'semiauto-slicer' => [
                        'name' => 'Semiauto Model Slicer Cutting Machine',
                        'image' => 'assets/images/products/slicer-cutting-machine/pvc-tape-cutting-machine/manual-pvc-tape-cutting-machine/main-1.png',
                        'price' => 'Enquire Now',
                        'featured' => true
                    ]
                ]
            ],
            'pvc-tape-cutting' => [
                'name' => 'PVC Tape Cutting Machine',
                'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/300-mm-bopp-tape-cutting-machi-e/main-1.png',
                'description' => 'Double shaft systems for efficient electrical PVC tape cutting.',
                'variants' => [
                    'manual-pvc' => [
                        'name' => 'Manual PVC Tape Cutting Machine',
                        'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/300-mm-bopp-tape-cutting-machi-e/main-1.png',
                        'price' => 'Enquire Now',
                        'featured' => false
                    ],
                    'auto-double-pvc' => [
                        'name' => 'Fully Auto Double Shaft PVC Tape Cutting machine',
                        'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/300-mm-bopp-tape-cutting-machi-e/main-1.png',
                        'price' => 'Enquire Now',
                        'featured' => true
                    ]
                ]
            ]
        ]
    ],

    'coating-processing' => [
        'name' => 'Coating Processing machines',
        'image' => 'assets/images/products/coating-processing-machines/coating-line-1.png',
        'description' => 'Apply flawless, uniform layers utilizing advanced application technology to deliver unparalleled precision.',
        'features' => [
            'Micro-meter accurate coating head application systems (Comma/Knife/Gravure).',
            'Multi-zone thermal and curing continuous ovens with PID temperature control.',
            'Capable of handling both water-based and solvent-based compounds safely.',
            'Automated viscosity and thickness monitoring for consistent coat weight.',
            'Explosion-proof and flameproof electrical systems for solvent-based lines.'
        ],
        'specs' => [
            'Max Speed' => '50 - 150 m/min',
            'Coating Width' => 'Up to 1350 mm',
            'Heating Source' => 'Electric / Gas / Thermic Oil / Steam',
            'Oven Length' => 'Up to 30 Meters (Modular)'
        ],
        'applications' => [
            'BOPP, Foam, and specialty adhesive tape coating.',
            'Label stock and release liner production.',
            'Specialized industrial paper and metallic film coating.',
            'Medical grade and conductive coating applications.'
        ],
        'benefits' => [
            'Guarantees a perfectly uniform coat weight, saving expensive chemical costs.',
            'Adaptable to a massive range of substrates (Paper, Film, Foil, Fabric).',
            'High thermal efficiency lowers overall operational carbon footprint.',
            'Drastically reduces downtime with quick-clean coating head designs.'
        ],
        'sub_categories' => [
            'bopp-coating' => [
                'name' => 'BOPP Tape Coating Machine',
                'image' => 'assets/images/products/coating-processing-machines/coating-line-1.png',
                'description' => 'Dedicated unit for BOPP adhesive application.',
                'variants' => []
            ],
            'water-based-coating' => [
                'name' => 'Water Base Coating machine',
                'image' => 'assets/images/products/coating-processing-machines/coating-line-1.png',
                'description' => 'Optimized for aqueous fluid coatings and fast drying.',
                'variants' => []
            ],
            'paper-coating' => [
                'name' => 'Paper coating machine',
                'image' => 'assets/images/products/coating-processing-machines/coating-line-1.png',
                'description' => 'High speed continuous paper surface finishing line.',
                'variants' => []
            ],
            'foam-coating' => [
                'name' => 'Foam tape coating machine',
                'image' => 'assets/images/products/coating-processing-machines/coating-line-1.png',
                'description' => 'Gentle handler for thick foam structural integrity coating.',
                'variants' => []
            ]
        ]
    ],

    'plastic-film-embossing' => [
        'name' => 'Plastic Film Embossing machine',
        'image' => 'assets/images/products/plastic-film-embossing/embossing-machine-1.png',
        'description' => 'Transform ordinary films into highly textured, value-added products with customized pattern precision.',
        'features' => [
            'Laser-engraved, high-durability embossing rollers with custom patterns.',
            'Precision hydraulic pressure controls for deep and uniform texturing.',
            'Integrated cooling cylinders to instantly set the embossed pattern.',
            'Adjustable speed and tension parameters for various film thicknesses.',
            'Chrome-plated heating rollers for superior temperature distribution.'
        ],
        'specs' => [
            'Operating Speed' => '30 - 100 m/min',
            'Max Material Width' => 'Up to 1200 mm',
            'Heating Capacity' => '12 kW to 18 kW',
            'Cooling System' => 'Water-chilled high-speed rollers'
        ],
        'applications' => [
            'Decorative film and premium packaging material production.',
            'Hygiene and medical film texturing for breathability.',
            'Industrial protective sheeting and non-slip surface processing.',
            'Automotive interior trim and upholstery film embossing.'
        ],
        'benefits' => [
            'Adds significant aesthetic and functional value to base plastic films.',
            'Operates continuously with minimal pattern degradation over time.',
            'Highly versatile, accommodating diverse polymer compositions (PE, PP, PVC).',
            'Uniform pressure ensures zero edge curling or material stretching.'
        ],
        'sub_categories' => [
            'embossing-machine' => [
                'name' => 'Plastic Film Embossing machine',
                'image' => 'assets/images/products/plastic-film-embossing/embossing-machine-1.png',
                'description' => 'Standalone embossing line for plastics and thin films.',
                'variants' => []
            ]
        ]
    ],

    'auxiliary-equipment' => [
        'name' => 'Extra Converting machine & Equipment',
        'image' => 'assets/images/products/extra-converting/auxiliary-1.png',
        'description' => 'Enhance and safeguard your core production lines with our robust auxiliary parts, bringing an extra layer of stability to any existing machinery.',
        'features' => [
            'Ultra-responsive web guide systems for edge and center line tracking.',
            'High-load, quick-locking pneumatic air shafts with multi-bladder tech.',
            'Heavy-duty safety chucks for secure, vibration-free roll handling.',
            'Automated core cutting and roll wrapping mechanisms for final prep.',
            'Precision magnetic particle brakes and clutches for tension control.'
        ],
        'specs' => [
            'Accuracy (Web Guide)' => '±0.1 mm',
            'Load Capacity (Chucks)' => '1000 kg to 3000 kg',
            'Air Shaft Length' => 'Custom (up to 2000 mm)',
            'Wrapping Speed' => '10 - 20 rolls/hour'
        ],
        'applications' => [
            'Upgrading and retrofitting existing converting and printing lines.',
            'Safe handling and preparation of heavy jumbo master rolls.',
            'Final product packaging and professional dispatch preparation.',
            'Precision cardboard core sizing for slitting operations.'
        ],
        'benefits' => [
            'Radically improves workplace safety during heavy roll changeovers.',
            'Reduces web drifting, minimizing expensive edge trim waste.',
            'Speeds up the final packaging phase for immediate international shipping.',
            'Ensures perfect core alignment, preventing telescoping in rewinding.'
        ],
        'sub_categories' => [
            'web-guide-system' => [
                'name' => 'Web Guide system',
                'image' => 'assets/images/products/extra-converting/auxiliary-1.png',
                'description' => 'Automated edge tracking mechanisms to keep material aligned.',
                'variants' => []
            ],
            'air-shafts' => [
                'name' => 'Air Shafts',
                'image' => 'assets/images/products/extra-converting/auxiliary-1.png',
                'description' => 'Pneumatic expanding quick release shafts.',
                'variants' => []
            ],
            'safety-chucks' => [
                'name' => 'Safety Chucks',
                'image' => 'assets/images/products/extra-converting/auxiliary-1.png',
                'description' => 'Heavy secure roll lock chucks for safety.',
                'variants' => []
            ],
            'wrapping-machine' => [
                'name' => 'wrapping Machine',
                'image' => 'assets/images/products/adhesive-tape-processing-machines/bopp-tape-slitting---rewinding-machine/1350-mm-bopp-tape-cutting-machine/img-1945.png',
                'description' => 'Jumbo roll final film wrap application logic.',
                'variants' => []
            ],
            'core-cutting-aux' => [
                'name' => 'Core Cutting Machine',
                'image' => 'assets/images/products/extra-converting/auxiliary-1.png',
                'description' => 'Automated cardboard and plastic core sizing system.',
                'variants' => []
            ]
        ]
    ]

];
?>
