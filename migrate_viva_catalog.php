<?php
require_once 'admin/includes/config.php';
require_once 'admin/includes/db.php';
require_once 'admin/includes/functions.php';

function createSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

$catalog = [
    [
        'name' => 'Slitting Rewinding Applications',
        'image' => 'assets/images/categories/slitting-rewinding.jpg',
        'items' => [
            ['name' => 'Paper slitting Rewinding machine'],
            ['name' => 'Plastic Slitting Rewinding machine'],
            ['name' => 'Non-woven Slitting Rewinding machine']
        ]
    ],
    [
        'name' => 'Center Shaft Slitting Rewinding Machines',
        'image' => 'assets/images/categories/center-shaft-slitting.png',
        'items' => [
            ['name' => 'Paper Center Shaft Slitting Rewinding machine'],
            ['name' => 'Plastic Center Shaft Slitting Rewinding machine']
        ]
    ],
    [
        'name' => 'Roll to Roll Processing Machines',
        'image' => 'assets/images/categories/roll-to-roll.png',
        'items' => [
            ['name' => 'Winding Rewinding machine'],
            ['name' => 'Doctroring Rewinding machine for batch Coding'],
            ['name' => 'Paper Rewinding machine'],
            ['name' => 'HM Paper Rewinding machine / Notebook Paper Rewinding machine']
        ]
    ],
    [
        'name' => 'Aluminium Foil Processing Machines',
        'image' => 'assets/images/categories/aluminium-foil.png',
        'items' => [
            ['name' => 'Aluminium Foil Rewinding machine'],
            ['name' => 'Aluminium Jumbo Roll Slitting Machine']
        ]
    ],
    [
        'name' => 'Printing Converting & Processing Machines',
        'image' => 'assets/images/categories/printing-converting.png',
        'items' => [
            ['name' => 'Rotogravure Printing Machine'],
            ['name' => 'Flexographic Printing machine']
        ]
    ],
    [
        'name' => 'Adhesive Tape Processing machines',
        'image' => 'assets/images/categories/masking-tape.png',
        'sub_cats' => [
            [
                'name' => 'BOPP Tape Slitting & Rewinding Machine',
                'items' => [
                    ['name' => '300 MM Baby Type Slitting Rewinding machine'],
                    ['name' => '1350 MM turret type Slitting Rewinding Machine'],
                    ['name' => 'Core Cutting Machine for BOPP Tapes']
                ]
            ],
            [
                'name' => 'Masking Tape Rewinding machine',
                'is_direct_product' => true
            ],
            [
                'name' => 'Slicer Cutting Machine',
                'items' => [
                    ['name' => 'Masking tape Slicer Cutting Machine'],
                    ['name' => 'Manual Model Slicer Cutting machine'],
                    ['name' => 'Semiauto Model Slicer Cutting Machine']
                ]
            ],
            [
                'name' => 'PVC Tape Cutting Machine',
                'items' => [
                    ['name' => 'Manual PVC Tape Cutting Machine'],
                    ['name' => 'Fully Auto Double Shaft PVC Tape Cutting machine']
                ]
            ]
        ]
    ],
    [
        'name' => 'Coating Processing machines',
        'image' => 'assets/images/placeholder-machinery.jpg',
        'items' => [
            ['name' => 'BOPP Tape Coating Machine'],
            ['name' => 'Water Base Coating machine'],
            ['name' => 'Paper coating machine'],
            ['name' => 'Foam tape coating machine']
        ]
    ],
    [
        'name' => 'Plastic Film Embossing machine',
        'image' => 'assets/images/placeholder-machinery.jpg',
        'items' => [
            ['name' => 'Plastic Film Embossing machine']
        ]
    ],
    [
        'name' => 'Extra Converting machine & Equipment',
        'image' => 'assets/images/placeholder-machinery.jpg',
        'items' => [
            ['name' => 'Web Guide system'],
            ['name' => 'Air Shafts'],
            ['name' => 'Safety Chucks'],
            ['name' => 'wrapping Machine'],
            ['name' => 'Core Cutting Machine']
        ]
    ]
];

try {
    $pdo->beginTransaction();

    // Clear existing tables
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE products");
    $pdo->exec("TRUNCATE TABLE categories");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    foreach ($catalog as $group) {
        $group_slug = createSlug($group['name']);
        $group_img = $group['image'] ?? 'assets/images/placeholder-machinery.jpg';
        
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug, image, description, parent_id, status) VALUES (?, ?, ?, ?, NULL, 'active')");
        $stmt->execute([$group['name'], $group_slug, $group_img, "High-performance solutions for " . $group['name']]);
        $group_id = $pdo->lastInsertId();
        
        // Handle Direct Items under Group
        if (isset($group['items'])) {
            foreach ($group['items'] as $item) {
                $item_slug = createSlug($item['name']);
                $stmt_p = $pdo->prepare("INSERT INTO products (category_id, name, slug, image, description, status) VALUES (?, ?, ?, ?, ?, 'active')");
                $stmt_p->execute([$group_id, $item['name'], $item_slug, $group_img, "Professional " . $item['name']]);
            }
        }
        
        // Handle Sub-Categories under Group
        if (isset($group['sub_cats'])) {
            foreach ($group['sub_cats'] as $sub) {
                $sub_slug = createSlug($sub['name']);
                $sub_img = $group_img;
                
                if (isset($sub['is_direct_product']) && $sub['is_direct_product']) {
                    $stmt_p = $pdo->prepare("INSERT INTO products (category_id, name, slug, image, description, status) VALUES (?, ?, ?, ?, ?, 'active')");
                    $stmt_p->execute([$group_id, $sub['name'], $sub_slug, $sub_img, "Professional " . $sub['name']]);
                } else {
                    $stmt_s = $pdo->prepare("INSERT INTO categories (name, slug, image, description, parent_id, status) VALUES (?, ?, ?, ?, ?, 'active')");
                    $stmt_s->execute([$sub['name'], $sub_slug, $sub_img, "Specialized " . $sub['name'], $group_id]);
                    $sub_id = $pdo->lastInsertId();
                    
                    if (isset($sub['items'])) {
                        foreach ($sub['items'] as $item) {
                            $item_slug = createSlug($item['name']);
                            $stmt_p = $pdo->prepare("INSERT INTO products (category_id, name, slug, image, description, status) VALUES (?, ?, ?, ?, ?, 'active')");
                            $stmt_p->execute([$sub_id, $item['name'], $item_slug, $sub_img, "High-grade " . $item['name']]);
                        }
                    }
                }
            }
        }
    }

    $pdo->commit();
    echo "SUCCESS: Product hierarchy rebuilt according to specifications.\n";

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "ERROR: " . $e->getMessage() . "\n";
}
