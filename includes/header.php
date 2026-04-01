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
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo resolve_url(get_setting('favicon_path')); ?>">

    
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
    <link rel="icon" type="image/png" href="<?php echo resolve_url(get_setting('favicon_path')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo resolve_url(get_setting('favicon_path')); ?>">
    <link rel="apple-touch-icon" type="image/png" href="<?php echo resolve_url(get_setting('favicon_path')); ?>">
</head>
<body class="bg-black text-white font-body">

    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 bg-black z-[9999] flex flex-col items-center justify-center transition-all duration-700">
        <div class="relative mb-8">
            <!-- Animated rings -->
            <div class="absolute inset-0 w-32 h-32 border-2 border-orange-600/30 rounded-full animate-ping"></div>
            <div class="absolute inset-0 w-32 h-32 border-2 border-orange-600/20 rounded-full animate-pulse delay-700"></div>
            
            <!-- Logo Container -->
            <div class="relative w-32 h-32 bg-white rounded-2xl flex items-center justify-center shadow-2xl shadow-orange-600/20 overflow-hidden p-4 group">
                <img src="<?php echo resolve_url(get_setting('preloader_logo_path') ?: get_setting('logo_path')); ?>" alt="VIVA" class="w-full h-full object-contain animate-float">
                
                <!-- Inner glow -->
                <div class="absolute inset-0 bg-gradient-to-tr from-orange-600/10 to-transparent"></div>
            </div>
        </div>
        
        <div class="flex flex-col items-center">
            <h2 class="text-gradient-orange font-heading font-bold text-2xl tracking-[0.2em] mb-3 animate-pulse uppercase"><?php echo get_setting('site_name'); ?></h2>
            <div class="w-48 h-1 bg-gray-900 rounded-full overflow-hidden">
                <div class="h-full bg-orange-600 w-full origin-left animate-shimmer"></div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-black/95 backdrop-blur-sm z-50 border-b border-gray-800 shadow-lg">
        <div class="container mx-auto px-4 lg:px-8 relative">
            <div id="navbar-inner" class="flex justify-between items-center py-4 transition-all duration-300">
                <!-- Logo -->
                <a href="index.php" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-black-600 to-black-700 rounded-lg flex items-center justify-center  transition-transform duration-700">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <!-- Using settings logo -->
                                <img src="<?php echo resolve_url(get_setting('logo_path')); ?>" alt="<?php echo get_setting('site_name'); ?> Logo" class="w-8 h-8 object-contain">
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
                    <div class="group static">
                        <a href="products.php" class="nav-link <?php echo $current_page == 'products.php' ? 'active' : ''; ?> text-gray-300 hover:text-orange-600 flex items-center transition-colors duration-300">
                            Products
                            <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                        
                        <!-- Mega Menu Container -->
                        <div class="absolute inset-x-0 top-full bg-black/95 backdrop-blur-xl border-x border-b border-gray-800 hidden group-hover:block z-[100] py-12 shadow-2xl overflow-y-auto max-h-[80vh] animate-slide-down">
                            <div class="container mx-auto px-4 lg:px-8">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 xl:grid-cols-5 gap-x-6 gap-y-10">
                                    <?php 
                                    // Fetch all 9 top-level groups from DB
                                    $stmt_cat = $pdo->query("SELECT * FROM categories WHERE parent_id IS NULL AND status = 'active' ORDER BY id ASC");
                                    while($category = $stmt_cat->fetch()): 
                                    ?>
                                    <div class="mega-column group/col">
                                        <!-- Category Header Text Only -->
                                        <div class="mb-5 pb-3 border-b border-gray-800 group-hover/col:border-orange-600 transition-colors duration-300">
                                            <h3 class="font-heading font-bold text-[11px] uppercase tracking-widest text-white group-hover/col:text-orange-500 transition-colors duration-300">
                                                <a href="products.php?category=<?php echo h($category['slug']); ?>" class="block w-full">
                                                    <?php echo h($category['name']); ?>
                                                </a>
                                            </h3>
                                        </div>
                                        
                                        <!-- Sub-items List (Categories or Products) -->
                                        <ul class="space-y-2 px-1">
                                            <?php 
                                            // 1. Fetch sub-categories
                                            $stmt_sc = $pdo->prepare("SELECT * FROM categories WHERE parent_id = ? AND status = 'active' ORDER BY name ASC");
                                            $stmt_sc->execute([$category['id']]);
                                            $sub_cats = $stmt_sc->fetchAll();
                                            foreach ($sub_cats as $sc): 
                                            ?>
                                                <li>
                                                    <a href="products.php?category=<?php echo h($sc['slug']); ?>" class="text-gray-400 hover:text-white text-[11px] transition-all duration-300 flex items-start group/item leading-tight">
                                                        <span class="w-1.5 h-1.5 bg-orange-600 rounded-full mr-2 mt-1.5 group-hover/item:scale-125 transition-transform flex-shrink-0"></span>
                                                        <span class="flex-1 font-bold"><?php echo h($sc['name']); ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>

                                            <?php 
                                            // 2. Fetch direct products
                                            $stmt_p = $pdo->prepare("SELECT * FROM products WHERE category_id = ? AND status = 'active' ORDER BY name ASC");
                                            $stmt_p->execute([$category['id']]);
                                            $prods = $stmt_p->fetchAll();
                                            foreach ($prods as $p):
                                            ?>
                                                <li>
                                                    <a href="product-detail.php?product=<?php echo h($p['slug']); ?>" class="text-gray-400 hover:text-white text-[11px] transition-all duration-300 flex items-start group/item leading-tight">
                                                        <span class="w-1.5 h-1.5 bg-orange-600/50 rounded-full mr-2 mt-1.5 group-hover/item:scale-125 transition-transform flex-shrink-0"></span>
                                                        <span class="flex-1 italic"><?php echo h($p['name']); ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
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
                    <span class="w-8 h-0.5 bg-white mb-2 transition-all duration-300 transform origin-center" id="bar2"></span>
                    <span class="w-8 h-0.5 bg-white transition-all duration-300 transform origin-center" id="bar3"></span>
                </button>
            </div>
            
            <!-- Mobile Menu Backdrop -->
            <div id="mobile-menu-backdrop" class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[140] hidden opacity-0 transition-opacity duration-500"></div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden fixed top-0 left-0 w-[85%] sm:w-[75%] h-screen bg-black border-r border-gray-800 transform -translate-x-full transition-transform duration-500 flex flex-col z-[150] shadow-2xl">
                <!-- Menu Header: Logo -->
                <div class="p-8 border-b border-gray-900">
                    <a href="index.php" class="flex items-center space-x-3">
                        <img src="<?php echo resolve_url(get_setting('logo_path')); ?>" alt="VIVA Logo" class="w-10 h-10 bg-white rounded p-1">
                        <div>
                            <h2 class="text-sm font-heading font-bold text-white leading-none">VIVA<span class="text-orange-600"> ENGINEERING</span></h2>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">Management</p>
                        </div>
                    </a>
                </div>

                <!-- Menu Body: Navigation -->
                <div class="flex-1 overflow-y-auto py-8 px-6 space-y-2">
                    <a href="index.php" class="mobile-nav-link group flex items-center justify-between p-4 rounded-xl transition-all <?php echo $current_page == 'index.php' ? 'bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-gray-400 hover:bg-gray-900 hover:text-white'; ?>">
                        <span class="text-lg font-semibold">Home</span>
                        <div class="w-6 h-6 rounded-full <?php echo $current_page == 'index.php' ? 'bg-white/20' : 'bg-gray-800'; ?> flex items-center justify-center group-hover:bg-orange-600/20 transition-colors">
                            <i class="fas fa-home text-[10px]"></i>
                        </div>
                    </a>

                    <a href="products.php" class="mobile-nav-link group flex items-center justify-between p-4 rounded-xl transition-all <?php echo $current_page == 'products.php' ? 'active bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-gray-400 hover:bg-gray-900 hover:text-white'; ?>">
                        <span class="text-lg font-semibold">Products</span>
                        <div class="w-6 h-6 rounded-full <?php echo $current_page == 'products.php' ? 'bg-white/20' : 'bg-gray-800'; ?> flex items-center justify-center group-hover:bg-orange-600/20 transition-colors">
                            <i class="fas fa-boxes text-[10px]"></i>
                        </div>
                    </a>

                    <a href="about.php" class="mobile-nav-link group flex items-center justify-between p-4 rounded-xl transition-all <?php echo $current_page == 'about.php' ? 'active bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-gray-400 hover:bg-gray-900 hover:text-white'; ?>">
                        <span class="text-lg font-semibold">About</span>
                        <div class="w-6 h-6 rounded-full <?php echo $current_page == 'about.php' ? 'bg-white/20' : 'bg-gray-800'; ?> flex items-center justify-center group-hover:bg-orange-600/20 transition-colors">
                            <i class="fas fa-info-circle text-[10px]"></i>
                        </div>
                    </a>

                    <a href="gallery.php" class="mobile-nav-link group flex items-center justify-between p-4 rounded-xl transition-all <?php echo $current_page == 'gallery.php' ? 'active bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-gray-400 hover:bg-gray-900 hover:text-white'; ?>">
                        <span class="text-lg font-semibold">Gallery</span>
                        <div class="w-6 h-6 rounded-full <?php echo $current_page == 'gallery.php' ? 'bg-white/20' : 'bg-gray-800'; ?> flex items-center justify-center group-hover:bg-orange-600/20 transition-colors">
                            <i class="fas fa-images text-[10px]"></i>
                        </div>
                    </a>

                    <a href="contact.php" class="mobile-nav-link group flex items-center justify-between p-4 rounded-xl transition-all <?php echo $current_page == 'contact.php' ? 'active bg-orange-600 text-white shadow-lg shadow-orange-600/20' : 'text-gray-400 hover:bg-gray-900 hover:text-white'; ?>">
                        <span class="text-lg font-semibold">Contact</span>
                        <div class="w-6 h-6 rounded-full <?php echo $current_page == 'contact.php' ? 'bg-white/20' : 'bg-gray-800'; ?> flex items-center justify-center group-hover:bg-orange-600/20 transition-colors">
                            <i class="fas fa-paper-plane text-[10px]"></i>
                        </div>
                    </a>
                </div>

                <!-- Menu Footer: Contact -->
                <div class="p-8 bg-gray-950/50 border-t border-gray-900">
                    <div id="mobile-menu-footer" class="space-y-4 opacity-0 transform translate-y-10">
                        <div class="flex items-center space-x-3 group">
                            <div class="w-8 h-8 rounded-lg bg-orange-600/10 flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all">
                                <i class="fas fa-phone-alt text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Call Us</p>
                                <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="text-xs text-white hover:text-orange-600 transition-colors"><?php echo get_setting('contact_phone'); ?></a>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 group">
                            <div class="w-8 h-8 rounded-lg bg-orange-600/10 flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all">
                                <i class="fas fa-envelope text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Email</p>
                                <a href="mailto:<?php echo get_setting('contact_email'); ?>" class="text-xs text-white hover:text-orange-600 transition-colors"><?php echo get_setting('contact_email'); ?></a>
                            </div>
                        </div>

                        <!-- Social Icons -->
                        <div class="flex items-center space-x-4 pt-4 border-t border-gray-900/50">
                            <?php if (get_setting('facebook_url')): ?>
                            <a href="<?php echo get_setting('facebook_url'); ?>" class="w-8 h-8 rounded-full bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all">
                                <i class="fab fa-facebook-f text-xs"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (get_setting('linkedin_url')): ?>
                            <a href="<?php echo get_setting('linkedin_url'); ?>" class="w-8 h-8 rounded-full bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all">
                                <i class="fab fa-linkedin-in text-xs"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (get_setting('instagram_url')): ?>
                            <a href="<?php echo get_setting('instagram_url'); ?>" class="w-8 h-8 rounded-full bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all">
                                <i class="fab fa-instagram text-xs"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="pt-0">

    <!-- Mobile Menu Toggle Handled in custom.js -->