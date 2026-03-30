<?php
require_once __DIR__ . '/../admin/includes/config.php';
require_once __DIR__ . '/../data/site-settings.php';
require_once __DIR__ . '/../data/products-data.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo get_setting('meta_keywords'); ?>">

    
    <!-- SEO Meta Tags -->
    <title><?php 
    if(isset($page_title)) {
        echo $page_title . ' | ' . get_setting('site_name');
    } else {
        if($current_page == 'index.php') echo get_setting('site_title');
        else echo ucwords(str_replace('.php', '', $current_page)) . ' | ' . get_setting('site_name');
    }
    ?></title>
    
    <meta name="description" content="<?php echo isset($meta_description) ? h($meta_description) : get_setting('meta_description'); ?>">
    <meta name="keywords" content="<?php echo isset($meta_keywords) ? h($meta_keywords) : get_setting('meta_keywords'); ?>">
    <meta name="author" content="<?php echo get_setting('site_name'); ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Roboto+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Styles -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        black: '#000000',
                        white: '#ffffff',
                        orange: {
                            600: '#FF5722',
                            700: '#E64A19',
                            800: '#D84315',
                        },
                        gray: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                        body: ['Roboto Slab', 'serif'],
                    },
                    animation: {
                        'spin-slow': 'spin 8s linear infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce': 'bounce 1s infinite',
                        'fade-up': 'fade-up 0.8s ease-out forwards',
                        'shimmer': 'shimmer 2s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        'fade-up': {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-1000px 0' },
                            '100%': { backgroundPosition: '1000px 0' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo get_setting('favicon_path'); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_setting('favicon_path'); ?>">
    <link rel="apple-touch-icon" type="image/png" href="<?php echo get_setting('favicon_path'); ?>">
</head>
<body class="bg-black text-white font-body">

    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="loading-ring"></div>
        <p class="text-gradient-orange font-heading font-bold animate-pulse">VIVA ENGINEERING</p>
    </div>
    
    <!-- Navigation -->
    <nav class="sticky top-0 w-full bg-black/95 backdrop-blur-sm z-50 border-b border-gray-800 shadow-lg">
        <div class="container mx-auto px-4 lg:px-8 relative">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="index.php" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-black-600 to-black-700 rounded-lg flex items-center justify-center  transition-transform duration-700">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <!-- Using settings logo -->
                                <img src="<?php echo get_setting('logo_path'); ?>" alt="<?php echo get_setting('site_name'); ?> Logo" class="w-8 h-8 object-contain">
                            </div>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl font-heading font-bold tracking-tight text-white"><?php 
                            $name = get_setting('site_name');
                            $parts = explode(' ', $name, 2);
                            echo $parts[0] . '<span class="text-orange-600"> ' . ($parts[1] ?? '') . '</span>';
                        ?></h1>
                        <p class="text-xs text-gray-400 tracking-widest">Think Big We Do</p>
                    </div>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-10">
                    <a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?> text-gray-300 hover:text-orange-600 transition-colors duration-300">Home</a>
                    
                    <!-- Products Mega Menu -->
                    <div class="group/mega static">
                        <a href="products.php" class="nav-link <?php echo $current_page == 'products.php' ? 'active' : ''; ?> text-gray-300 hover:text-orange-600 flex items-center transition-colors duration-300">
                            Products
                            <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-300 group-hover/mega:rotate-180"></i>
                        </a>
                        
                        <!-- Mega Menu Container -->
                        <div class="absolute inset-x-0 top-full bg-black/95 backdrop-blur-xl border-x border-b border-gray-800 hidden group-hover/mega:block z-[100] py-12 shadow-2xl overflow-y-auto max-h-[80vh] animate-slide-down">
                            <div class="container mx-auto px-4 lg:px-8">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
                                    <?php 
                                    // Fetch all 9 top-level groups from DB
                                    $stmt_cat = $pdo->query("SELECT * FROM categories WHERE parent_id IS NULL AND status = 'active' ORDER BY id ASC");
                                    while($category = $stmt_cat->fetch()): 
                                    ?>
                                    <div class="mega-column group/col">
                                        <!-- Category Header with Image -->
                                        <div class="relative w-full h-32 mb-4 overflow-hidden rounded-lg border border-gray-800 group-hover/col:border-orange-600 transition-all duration-500 shadow-lg">
                                            <img src="<?php echo h($category['image']); ?>" alt="<?php echo h($category['name']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover/col:scale-110">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                                            <div class="absolute bottom-3 left-3 right-3">
                                                <h3 class="text-white font-heading font-bold text-[10px] uppercase tracking-wider group-hover/col:text-orange-500 transition-colors duration-300 leading-tight">
                                                    <a href="products.php?category=<?php echo h($category['slug']); ?>">
                                                        <?php echo h($category['name']); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                        
                                        <!-- Sub-items List (Categories or Products) -->
                                        <ul class="space-y-2 px-1">
                                            <?php 
                                            // 1. First look for sub-categories
                                            $stmt_sc = $pdo->prepare("SELECT * FROM categories WHERE parent_id = ? AND status = 'active' ORDER BY name ASC LIMIT 6");
                                            $stmt_sc->execute([$category['id']]);
                                            $sub_cats = $stmt_sc->fetchAll();

                                            if (!empty($sub_cats)): 
                                                foreach ($sub_cats as $sc): 
                                            ?>
                                                <li>
                                                    <a href="products.php?category=<?php echo h($sc['slug']); ?>" class="text-gray-400 hover:text-white text-[11px] transition-all duration-300 flex items-center group/item">
                                                        <span class="w-1 h-1 bg-orange-600 rounded-full mr-2 group-hover/item:scale-125 transition-transform"></span>
                                                        <?php echo h($sc['name']); ?>
                                                    </a>
                                                </li>
                                            <?php 
                                                endforeach;
                                            else:
                                                // 2. If no sub-categories, look for products directly
                                                $stmt_p = $pdo->prepare("SELECT * FROM products WHERE category_id = ? AND status = 'active' ORDER BY name ASC LIMIT 6");
                                                $stmt_p->execute([$category['id']]);
                                                $prods = $stmt_p->fetchAll();
                                                
                                                foreach ($prods as $p):
                                            ?>
                                                <li>
                                                    <a href="product-detail.php?product=<?php echo h($p['slug']); ?>" class="text-gray-400 hover:text-white text-[11px] transition-all duration-300 flex items-center group/item">
                                                        <span class="w-1 h-1 bg-orange-600 rounded-full mr-2 group-hover/item:scale-125 transition-transform"></span>
                                                        <?php echo h($p['name']); ?>
                                                    </a>
                                                </li>
                                            <?php 
                                                endforeach;
                                            endif; 
                                            ?>
                                            <li>
                                                <a href="products.php?category=<?php echo h($category['slug']); ?>" class="text-orange-600/70 hover:text-orange-600 text-[10px] font-bold uppercase tracking-widest mt-2 block">
                                                    View Group <i class="fas fa-chevron-right text-[8px] ml-1"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                                
                                <!-- Promo Bottom Bar -->
                                <div class="mt-12 pt-8 border-t border-gray-800 flex justify-between items-center">
                                    <p class="text-gray-500 text-xs tracking-widest uppercase">Precision Machinery Solutions for Global Industries</p>
                                    <a href="products.php" class="text-orange-600 hover:text-white text-xs font-bold uppercase tracking-widest flex items-center group/all">
                                        View All Categories
                                        <i class="fas fa-arrow-right ml-2 group-hover/all:translate-x-2 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="about.php" class="nav-link <?php echo $current_page == 'about.php' ? 'active' : ''; ?> text-gray-300 hover:text-orange-600 transition-colors duration-300">About</a>
                    <a href="gallery.php" class="nav-link <?php echo $current_page == 'gallery.php' ? 'active' : ''; ?> text-gray-300 hover:text-orange-600 transition-colors duration-300">Gallery</a>
                    <a href="contact.php" class="nav-link <?php echo $current_page == 'contact.php' ? 'active' : ''; ?> text-gray-300 hover:text-orange-600 transition-colors duration-300">Contact</a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden relative z-[200] w-12 h-12 flex flex-col justify-center items-center group focus:outline-none">
                    <span class="w-8 h-0.5 bg-white mb-2 transition-all duration-300 transform origin-center" id="bar1"></span>
                    <span class="w-8 h-0.5 bg-white transition-all duration-300 transform origin-center" id="bar2"></span>
                  
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden fixed top-0 left-0 w-full h-screen bg-black transform -translate-x-full transition-transform duration-500 flex flex-col justify-center px-8 z-[150]">
                <div class="space-y-6">
                    <a href="index.php" class="mobile-nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?> text-gray-300">
                        <span class="text-xl font-medium">Home</span>
                        <i class="fas fa-chevron-right text-gray-400 text-lg"></i>
                    </a>
                    <a href="products.php" class="mobile-nav-link <?php echo $current_page == 'products.php' ? 'active' : ''; ?> text-gray-300">
                        <span class="text-xl font-medium">Products</span>
                        <i class="fas fa-chevron-right text-gray-400 text-lg"></i>
                    </a>
                    <a href="about.php" class="mobile-nav-link <?php echo $current_page == 'about.php' ? 'active' : ''; ?> text-gray-300">
                        <span class="text-xl font-medium">About</span>
                        <i class="fas fa-chevron-right text-gray-400 text-lg"></i>
                    </a>
                    <a href="gallery.php" class="mobile-nav-link <?php echo $current_page == 'gallery.php' ? 'active' : ''; ?> text-gray-300">
                        <span class="text-xl font-medium">Gallery</span>
                        <i class="fas fa-chevron-right text-gray-400 text-lg"></i>
                    </a>
                    <a href="contact.php" class="mobile-nav-link <?php echo $current_page == 'contact.php' ? 'active' : ''; ?> text-gray-300">
                        <span class="text-xl font-medium">Contact</span>
                        <i class="fas fa-chevron-right text-gray-400 text-lg"></i>
                    </a>
                </div>
                
                
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="pt-0">

    <!-- Mobile Menu Toggle Handled in custom.js -->