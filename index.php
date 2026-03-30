<?php 
include 'includes/header.php'; 

// Fetch Settings
$hero_bg = str_replace('/VIVA/', '', get_setting('hero_bg_path', 'assets/images/hero-main.jpg'));
$about_img = str_replace('/VIVA/', '', get_setting('about_image_path', 'assets/images/about-viva.jpg'));
$services_bg = str_replace('/VIVA/', '', get_setting('services_bg_path', 'assets/images/services-bg.jpg'));
?>

<!-- Hero Section - Properly fitted to screen -->
<section class="hero-section relative h-[calc(100vh-80px)] max-h-[900px] min-h-[500px] flex items-center overflow-hidden bg-black opacity-0">
    <!-- Background Video/Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo h($hero_bg); ?>" 
             alt="VIVA Engineering Machinery"
             class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10 py-6">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="lg:w-3/5">
                <div class="max-w-3xl">
                    <!-- Small Badge -->
                    <div class="hero-badge inline-flex items-center space-x-2 bg-orange-600/20 border border-orange-600/50 px-4 py-1.5 rounded-sm mb-4 md:mb-5 opacity-0 transform translate-y-10">
                        <span class="w-2 h-2 bg-orange-600 rounded-full animate-pulse"></span>
                        <span class="text-xs font-medium text-orange-600 uppercase tracking-wider">Industrial Excellence</span>
                    </div>
                    
                    <!-- Main Heading - Compact, screen-fitted -->
                    <h1 class="hero-heading text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-3 md:mb-4 leading-[1.15] transform translate-y-1">
                        <?php 
                        $headline = get_setting('hero_headline');
                        $words = explode(' ', $headline);
                        foreach($words as $index => $word) {
                            if($index == 0) echo '<span class="hero-word inline-block">' . strtoupper($word) . '</span> ';
                            elseif($index == count($words)-1) echo '<span class="text-orange-600 hero-word-3">' . strtoupper($word) . '</span>';
                            else echo '<span class="text-gray-400 hero-word-2">' . strtoupper($word) . '</span> ';
                        }
                        ?>
                    </h1>
                    
                    <!-- Description -->
                    <p class="hero-description text-base sm:text-lg md:text-xl text-gray-400 mb-6 md:mb-8 max-w-xl leading-relaxed opacity-0 transform translate-y-10">
                        <?php echo get_setting('hero_subheadline'); ?>
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="hero-cta flex flex-col sm:flex-row gap-3 mb-6 opacity-0 transform translate-y-10">
                        <a href="products.php" class="group relative px-6 py-3 bg-orange-600 text-white font-bold uppercase tracking-wider overflow-hidden transition-all duration-300 hover:bg-orange-700 hover:shadow-xl hover:shadow-orange-600/50 hover:-translate-y-1 text-center text-sm">
                            <span class="relative z-10 flex items-center justify-center sm:justify-start">
                                Explore Products 
                                <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform duration-300"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-orange-700 to-orange-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                        </a>
                        <a href="contact.php" class="group px-6 py-3 border-2 border-white text-white font-bold uppercase tracking-wider hover:bg-white hover:text-black transition-all duration-300 hover:-translate-y-1 hover:shadow-xl text-center text-sm">
                            <span class="flex items-center justify-center sm:justify-start">
                                Get a Quote 
                                <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform duration-300"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Compact Stats Counter -->
            <div class="lg:w-2/5 mt-0 lg:mt-0">
                <div class="stats-vertical bg-black/40 backdrop-blur-sm border border-gray-800/50 rounded-xl p-5 lg:p-6 opacity-0 transform translate-x-10">
                    <div class="grid grid-cols-2 gap-x-6 gap-y-5">
                        <!-- Stat 1 -->
                        <div class="stat-item">
                            <div class="flex items-baseline gap-1">
                                <div class="stat-number text-3xl lg:text-4xl font-bold text-orange-600" data-value="50">0</div>
                                <span class="text-orange-600 text-xl font-bold">+</span>
                            </div>
                            <div class="flex items-center gap-1.5 mt-1">
                                <div class="w-1.5 h-1.5 bg-orange-600 rounded-full animate-pulse"></div>
                                <p class="text-gray-300 text-xs uppercase tracking-wider">Machines Delivered</p>
                            </div>
                        </div>
                        
                        <!-- Stat 2 -->
                        <div class="stat-item">
                            <div class="flex items-baseline gap-1">
                                <div class="stat-number text-3xl lg:text-4xl font-bold text-orange-600" data-value="16">0</div>
                                <span class="text-orange-600 text-xl font-bold">+</span>
                            </div>
                            <div class="flex items-center gap-1.5 mt-1">
                                <div class="w-1.5 h-1.5 bg-orange-600 rounded-full animate-pulse" style="animation-delay: 0.3s"></div>
                                <p class="text-gray-300 text-xs uppercase tracking-wider">Years Experience</p>
                            </div>
                        </div>
                        
                        <!-- Stat 3 -->
                        <div class="stat-item">
                            <div class="flex items-baseline gap-1">
                                <div class="stat-number text-3xl lg:text-4xl font-bold text-orange-600" data-value="100">0</div>
                                <span class="text-orange-600 text-xl font-bold">%</span>
                            </div>
                            <div class="flex items-center gap-1.5 mt-1">
                                <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse" style="animation-delay: 0.6s"></div>
                                <p class="text-gray-300 text-xs uppercase tracking-wider">Quality Assured</p>
                            </div>
                        </div>
                        
                        <!-- Stat 4 -->
                        <div class="stat-item">
                            <div class="flex items-baseline gap-1">
                                <div class="flex items-baseline">
                                    <div class="stat-number text-3xl lg:text-4xl font-bold text-orange-600" data-value="24">0</div>
                                    <span class="text-orange-600 text-xl font-bold mx-0.5">/</span>
                                    <div class="stat-number text-3xl lg:text-4xl font-bold text-orange-600" data-value="7">0</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 mt-1">
                                <div class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse" style="animation-delay: 0.9s"></div>
                                <p class="text-gray-300 text-xs uppercase tracking-wider">Support Available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section with Orange Card -->
<section class="py-12 bg-black relative overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left - Image -->
            <div class="about-image relative opacity-0 transform translate-x-[-100px]">
                <div class="relative rounded-sm overflow-hidden group">
                    <img src="<?php echo h($about_img); ?>" 
                         alt="About VIVA Engineering"
                         class="w-full h-[500px] object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    
                    <!-- Hover overlay -->
                    <div class="absolute inset-0 bg-orange-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                
                <!-- Orange Stats Card -->
                <div class="about-card absolute -bottom-8 -right-8 bg-gradient-to-br from-orange-600 to-orange-700 p-8 shadow-2xl max-w-xs transform hover:scale-105 transition-all duration-300 cursor-pointer">
                    <div class="text-5xl font-bold text-white mb-2 counter-number" data-target="16">0</div>
                    <p class="text-white uppercase tracking-wider font-bold">Year of Experiences</p>
                    <p class="text-white/90 mt-4 text-sm">Powering sustainable industrial growth worldwide globally.</p>
                    
                    <!-- Animated corner decoration -->
                    <div class="absolute top-0 right-0 w-16 h-16 border-t-2 border-r-2 border-white/30"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 border-b-2 border-l-2 border-white/30"></div>
                </div>
            </div>
            
            <!-- Right - Content -->
            <div class="about-content opacity-0 transform translate-x-[100px]">
                <div class="inline-block mb-6">
                    <span class="text-orange-600 text-sm font-bold uppercase tracking-widest border-l-4 border-orange-600 pl-4 hover:pl-6 transition-all duration-300">About Company</span>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                    PROFESSIONAL 
                    <span class="text-orange-600 inline-block hover:scale-110 transition-transform duration-300">MACHINERY</span>
                    <span class="block text-gray-400">SOLUTIONS INDUSTRIES</span>
                </h2>
                
                <p class="text-gray-400 text-lg mb-6 leading-relaxed">
                    We provide comprehensive machinery and equipment solutions delivering structural strength, precision workmanship, and safety standards for industrial manufacturing.
                </p>
                
                <div class="space-y-4 mb-8">
                    <div class="feature-item flex items-start space-x-3 opacity-0 transform translate-x-10 hover:translate-x-2 transition-all duration-300">
                        <div class="w-2 h-2 bg-orange-600 rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                        <p class="text-gray-400 hover:text-white transition-colors duration-300">Ensure precision quality across all manufacturing processes</p>
                    </div>
                    <div class="feature-item flex items-start space-x-3 opacity-0 transform translate-x-10 hover:translate-x-2 transition-all duration-300">
                        <div class="w-2 h-2 bg-orange-600 rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                        <p class="text-gray-400 hover:text-white transition-colors duration-300">Support clients through timely delivery and expert guidance</p>
                    </div>
                    <div class="feature-item flex items-start space-x-3 opacity-0 transform translate-x-10 hover:translate-x-2 transition-all duration-300">
                        <div class="w-2 h-2 bg-orange-600 rounded-full mt-2 flex-shrink-0 animate-pulse"></div>
                        <p class="text-gray-400 hover:text-white transition-colors duration-300">Maintain highest standards in safety and reliability</p>
                    </div>
                </div>
                
                <a href="about.php" class="group inline-flex items-center px-8 py-4 bg-orange-600 text-white font-bold uppercase tracking-wider hover:bg-orange-700 transition-all duration-300 hover:shadow-xl hover:shadow-orange-600/50 hover:-translate-y-1 relative overflow-hidden">
                    <span class="relative z-10">
                        More About Us 
                        <i class="fas fa-arrow-right ml-3 transform group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-700 to-orange-800 transform translate-x-[-100%] group-hover:translate-x-0 transition-transform duration-500"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Section -->
<section class="py-10 bg-black border-t border-gray-800">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="trusted-title text-center mb-12 opacity-0 transform translate-y-10">
            <p class="text-gray-400 text-lg">
                Trusted By <span class="text-orange-600 font-bold counter-number" data-target="25">0</span>+ Big Companies
            </p>
        </div>
        
        <!-- Logo Slider with Animation -->
        <div class="logo-slider flex flex-wrap justify-center items-center gap-12">
            <div class="logo-item text-white text-2xl font-black tracking-tighter opacity-30 hover:opacity-100 hover:text-orange-500 hover:scale-110 transition-all duration-300 cursor-pointer">SIEMENS</div>
            <div class="logo-item text-white text-2xl font-black tracking-tighter opacity-30 hover:opacity-100 hover:text-orange-500 hover:scale-110 transition-all duration-300 cursor-pointer">MITSUBISHI</div>
            <div class="logo-item text-white text-2xl font-black tracking-tighter opacity-30 hover:opacity-100 hover:text-orange-500 hover:scale-110 transition-all duration-300 cursor-pointer">DELTA</div>
            <div class="logo-item text-white text-2xl font-black tracking-tighter opacity-30 hover:opacity-100 hover:text-orange-500 hover:scale-110 transition-all duration-300 cursor-pointer">OMRON</div>
            <div class="logo-item text-white text-2xl font-black tracking-tighter opacity-30 hover:opacity-100 hover:text-orange-500 hover:scale-110 transition-all duration-300 cursor-pointer">SCHNEIDER</div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 bg-black relative overflow-hidden">
    <!-- Static Background with Overlay -->
    <div class="absolute inset-0 z-0 opacity-10">
        <img src="<?php echo h($services_bg); ?>" alt="Services Background" class="w-full h-full object-cover">
    </div>
    <div class="container mx-auto px-4 lg:px-8">
        <div class="services-header text-center mb-16 opacity-0 transform translate-y-10">
            <div class="inline-block mb-6">
                <span class="text-orange-600 text-sm font-bold uppercase tracking-widest border-l-4 border-orange-600 pl-4 hover:pl-6 transition-all duration-300">Our Services</span>
            </div>
            
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                PROFESSIONAL MACHINERY
                <span class="block text-gray-400">SOLUTIONS INDUSTRIES</span>
            </h2>
            
            <p class="text-gray-400 text-lg max-w-3xl mx-auto leading-relaxed">
                We provide comprehensive slitting and cutting machinery services delivering structural strength, precision workmanship, and safety standards.
            </p>
        </div>
        
        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $services = [
                [
                    'icon' => '🔧',
                    'title' => 'STRUCTURAL SLITTING',
                    'desc' => 'High-precision slitting solutions for various materials with automated tension control and digital monitoring.',
                ],
                [
                    'icon' => '⚙️',
                    'title' => 'FABRICATION WORKS',
                    'desc' => 'Complete fabrication services including cutting, bending, and assembly with quality assurance.',
                ],
                [
                    'icon' => '🔨',
                    'title' => 'REPAIR WELDING',
                    'desc' => 'Expert repair and maintenance services for all types of industrial machinery and equipment.',
                ],
                [
                    'icon' => '🏗️',
                    'title' => 'STEEL FRAMEWORK',
                    'desc' => 'Robust steel frame construction for heavy-duty industrial applications and structures.',
                ],
                [
                    'icon' => '🎯',
                    'title' => 'COATING SYSTEMS',
                    'desc' => 'Advanced coating machinery for uniform application and quick-drying capabilities.',
                ],
                [
                    'icon' => '📦',
                    'title' => 'WRAPPING MACHINES',
                    'desc' => 'Automated wrapping solutions for efficient packaging and material handling.',
                ]
            ];
            
            foreach ($services as $index => $service):
            ?>
            <div class="service-card group relative bg-gray-900 p-8 border border-gray-800 overflow-hidden cursor-pointer opacity-0 transform translate-y-10 hover:border-orange-600 transition-all duration-500" 
                 data-delay="<?php echo $index * 100; ?>">
                <!-- Hover Background with gradient animation -->
                <div class="absolute inset-0 bg-gradient-to-br from-orange-600 via-orange-700 to-orange-800 transform translate-y-full group-hover:translate-y-0 transition-transform duration-700 ease-out"></div>
                
                <!-- Animated beam effect -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10">
                    <div class="text-5xl mb-6 transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                        <?php echo $service['icon']; ?>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white mb-4 uppercase tracking-wider group-hover:text-white transition-colors duration-300 transform group-hover:translate-x-2 transition-transform duration-300">
                        <?php echo $service['title']; ?>
                    </h3>
                    
                    <p class="text-gray-400 leading-relaxed mb-6 group-hover:text-white/90 transition-colors duration-300">
                        <?php echo $service['desc']; ?>
                    </p>
                    
                    <a href="#" class="inline-flex items-center text-orange-600 font-bold uppercase text-sm group-hover:text-white transition-colors duration-300">
                        Learn More 
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                </div>
                
                <!-- Corner Decoration with animation -->
                <div class="absolute top-0 right-0 w-20 h-20 border-t-2 border-r-2 border-orange-600 opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-0 group-hover:scale-100"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 border-b-2 border-l-2 border-orange-600 opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-0 group-hover:scale-100"></div>
                
                <!-- Glow effect -->
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-600 to-orange-800 opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-700"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Categories Section -->
<section class="py-20 bg-gray-900/50 relative overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-6">
            <div class="opacity-0 transform -translate-x-10 animate-on-scroll">
                <span class="text-orange-600 text-sm font-black uppercase tracking-[0.3em] mb-4 block">Machinery Categories</span>
                <h2 class="text-4xl font-bold text-white leading-tight">
                    EXPLORE OUR <br>
                    <span class="text-gray-500 italic">CORE INDUSTRIES</span>
                </h2>
            </div>
            <div class="opacity-0 transform translate-x-10 animate-on-scroll">
                <a href="products.php" class="text-orange-600 font-bold uppercase tracking-widest text-xs flex items-center group">
                    View All Categories
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $feat_cats = $pdo->query("SELECT * FROM categories WHERE featured = 1 AND status = 'active' LIMIT 4")->fetchAll();
            foreach ($feat_cats as $fc):
            ?>
            <a href="products.php?category=<?php echo h($fc['slug']); ?>" class="group relative h-80 rounded-2xl overflow-hidden border border-gray-800 hover:border-orange-600/50 transition-all duration-700 opacity-0 transform translate-y-10 animate-on-scroll">
                <img src="<?php echo h(str_replace('/VIVA/', '', $fc['image'])); ?>" alt="<?php echo h($fc['name']); ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full transform group-hover:-translate-y-2 transition-transform duration-500">
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-orange-500 transition-colors"><?php echo h($fc['name']); ?></h3>
                    <div class="w-12 h-1 bg-orange-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </div>
                <!-- Blueprint accent -->
                <div class="absolute top-4 right-4 w-10 h-10 border-t border-r border-white/10 group-hover:border-orange-600/50 transition-colors"></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-20 bg-black">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="products-header text-center mb-16 opacity-0 transform translate-y-10">
            <div class="inline-block mb-6">
                <span class="text-orange-600 text-sm font-bold uppercase tracking-widest border-l-4 border-orange-600 pl-4 hover:pl-6 transition-all duration-300">Product Range</span>
            </div>
            
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                INDUSTRIAL MACHINERY
                <span class="block text-gray-400">PRODUCT CATALOG</span>
            </h2>
            
            <p class="text-gray-400 text-lg max-w-3xl mx-auto leading-relaxed">
                Explore our premium range of precision-engineered industrial machinery designed for maximum efficiency and reliability.
            </p>
        </div>
        
        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $stmt = $pdo->query("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.featured = 1 AND p.status = 'active' LIMIT 6");
            $products_list = $stmt->fetchAll();
            
            foreach ($products_list as $index => $product):
                $product_features = parseField($product['features']);
                // Use a default badge if not set? Or just orange.
                $badge_class = ($index % 2 == 0) ? 'bg-orange-600' : 'bg-black';
            ?>
            <div class="product-card group relative overflow-hidden bg-gray-900 border border-gray-800 hover:border-orange-600 transition-all duration-700 cursor-pointer opacity-0 transform translate-y-10" 
                 data-delay="<?php echo ($index % 3) * 150; ?>">
                
                <!-- Image with Overlay -->
                <div class="relative h-72 overflow-hidden">
                    <img src="<?php echo h(str_replace('/VIVA/', '', $product['image'])); ?>" 
                         alt="<?php echo h($product['name']); ?>"
                         class="w-full h-full object-cover transform group-hover:scale-125 group-hover:rotate-2 transition-all duration-1000">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent group-hover:from-orange-900/50 transition-colors duration-700"></div>
                    
                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4 z-10 transform group-hover:scale-110 transition-transform duration-300">
                        <span class="<?php echo $badge_class; ?> text-white px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">
                            <?php echo h($product['category_name']); ?>
                        </span>
                    </div>
                    
                    <!-- Quick View Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-orange-900/90 to-black/90 opacity-0 group-hover:opacity-100 transition-all duration-700 flex items-center justify-center">
                        <div class="text-center transform translate-y-8 group-hover:translate-y-0 transition-all duration-700 delay-100">
                            <div class="w-16 h-16 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 transform group-hover:rotate-180 transition-transform duration-700 shadow-2xl shadow-orange-600/50">
                                <i class="fas fa-search-plus text-2xl text-white"></i>
                            </div>
                            <p class="text-white font-bold text-lg mb-2">View Details</p>
                            <p class="text-orange-400 text-sm">Click to explore</p>
                        </div>
                    </div>
                    
                    <!-- Animated scan line -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                        <div class="scan-line absolute inset-x-0 h-24 bg-gradient-to-b from-transparent via-orange-500/30 to-transparent"></div>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-8 bg-gray-900 group-hover:bg-black transition-colors duration-500 relative z-10">
                    <h3 class="text-xl font-bold text-white mb-4 uppercase group-hover:text-orange-400 transition-colors duration-300 transform group-hover:translate-x-2 transition-transform duration-300">
                        <?php echo $product['name']; ?>
                    </h3>
                    
                    <div class="space-y-3 mb-6">
                        <?php foreach (array_slice($product_features, 0, 3) as $idx => $feature): ?>
                        <div class="flex items-center text-gray-400 group-hover:text-gray-300 transition-all duration-300 transform translate-x-0 group-hover:translate-x-2" style="transition-delay: <?php echo $idx * 100; ?>ms">
                            <div class="w-2 h-2 bg-orange-600 rounded-full mr-3 group-hover:scale-150 transition-transform duration-300"></div>
                            <span class="text-sm"><?php echo h($feature); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <a href="product-detail.php?product=<?php echo h($product['slug']); ?>" 
                           class="group/btn inline-flex items-center text-orange-600 font-bold uppercase text-sm hover:text-orange-500 transition-colors duration-300">
                            View Details 
                            <i class="fas fa-arrow-right ml-2 transform group-hover/btn:translate-x-3 transition-transform duration-300"></i>
                        </a>
                        
                        <span class="text-white text-sm font-bold px-3 py-1.5 bg-gray-800 rounded-full transform group-hover:scale-110 group-hover:bg-orange-600 transition-all duration-300">
                            <i class="fas fa-tag mr-1"></i> <?php echo h($product['tag'] ?: 'Premium'); ?>
                        </span>
                    </div>
                </div>
                
                <!-- Hover Border Effect -->
                <div class="absolute inset-0 border-2 border-transparent group-hover:border-orange-600 transition-all duration-700 rounded-lg pointer-events-none"></div>
                
                <!-- Glow effect -->
                <div class="absolute -inset-2 bg-gradient-to-r from-orange-600 to-orange-800 opacity-0 group-hover:opacity-30 blur-2xl transition-opacity duration-700"></div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- View All Button -->
        <div class="products-cta text-center mt-16 opacity-0 transform translate-y-10">
            <a href="products.php" class="group relative inline-flex items-center px-10 py-5 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-bold uppercase tracking-wider text-lg rounded-xl overflow-hidden hover:shadow-2xl hover:shadow-orange-600/50 transition-all duration-500 hover:-translate-y-2">
                <span class="relative z-10 flex items-center">
                    View All Products 
                    <i class="fas fa-arrow-right ml-4 transform group-hover:translate-x-4 transition-transform duration-500"></i>
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-orange-700 to-orange-800 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-600 to-orange-500 opacity-0 group-hover:opacity-100 blur-2xl transition-opacity duration-700"></div>
            </a>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="pricing-header text-center mb-16 opacity-0 transform translate-y-10">
            <div class="inline-block mb-6">
                <span class="text-orange-600 text-sm font-bold uppercase tracking-widest border-l-4 border-orange-600 pl-4 hover:pl-6 transition-all duration-300">Pricing Plans</span>
            </div>
            
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                FLEXIBLE MACHINERY PRICING
                <span class="block text-gray-400">FOR PROJECTS</span>
            </h2>
        </div>
        
        <!-- Pricing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <?php
            $plans = [
                [
                    'name' => 'BASIC PLANS',
                    'price' => '$1999',
                    'desc' => 'Essential machinery solutions for small repairs and light fabrication projects.',
                    'features' => [
                        'Basic Slitting Machine',
                        'Manual Operation',
                        '6 Months Warranty',
                        'Email Support',
                        'Installation Guide'
                    ],
                    'popular' => false
                ],
                [
                    'name' => 'STANDARD PLANS',
                    'price' => '$3499',
                    'desc' => 'Comprehensive machinery package for medium-scale manufacturing operations.',
                    'features' => [
                        'Advanced Slitting System',
                        'Semi-Automatic Operation',
                        '12 Months Warranty',
                        'Phone & Email Support',
                        'Free Installation',
                        'Training Included'
                    ],
                    'popular' => true
                ],
                [
                    'name' => 'PREMIUM PLANS',
                    'price' => '$4999',
                    'desc' => 'Advanced machinery solutions for large-scale construction projects.',
                    'features' => [
                        'Full Automation System',
                        'Digital Control Panel',
                        '24 Months Warranty',
                        '24/7 Priority Support',
                        'Free Installation & Training',
                        'Lifetime Maintenance',
                        'Custom Configuration'
                    ],
                    'popular' => false
                ]
            ];
            
            foreach ($plans as $index => $plan):
            ?>
            <div class="pricing-card group relative bg-black border-2 <?php echo $plan['popular'] ? 'border-orange-600 shadow-2xl shadow-orange-600/20 scale-105' : 'border-gray-800'; ?> p-8 hover:shadow-2xl transition-all duration-700 cursor-pointer opacity-0 transform translate-y-10 hover:-translate-y-4 hover:border-orange-600" 
                 data-delay="<?php echo $index * 150; ?>">
                
                <?php if ($plan['popular']): ?>
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-orange-600 to-orange-700 text-white px-6 py-2 rounded-full text-sm font-bold uppercase shadow-lg animate-pulse">
                    Most Popular
                </div>
                <?php endif; ?>
                
                <!-- Animated background gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-orange-600/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="mb-8 relative z-10">
                    <h3 class="text-lg font-bold <?php echo $plan['popular'] ? 'text-orange-400' : 'text-gray-400'; ?> uppercase tracking-wider mb-4 group-hover:text-orange-400 transition-colors duration-300">
                        <?php echo $plan['name']; ?>
                    </h3>
                    <div class="flex items-baseline mb-4">
                        <span class="text-5xl font-bold text-white group-hover:text-orange-400 transition-colors duration-300"><?php echo $plan['price']; ?></span>
                        <span class="text-gray-400 ml-2">/ Month</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed group-hover:text-gray-300 transition-colors duration-300">
                        <?php echo $plan['desc']; ?>
                    </p>
                </div>
                
                <div class="space-y-4 mb-10 relative z-10">
                    <?php foreach ($plan['features'] as $idx => $feature): ?>
                    <div class="flex items-start opacity-0 feature-list-item" style="animation-delay: <?php echo $idx * 100; ?>ms">
                        <div class="flex-shrink-0 w-6 h-6 <?php echo $plan['popular'] ? 'bg-orange-600' : 'bg-gray-800'; ?> group-hover:bg-orange-600 rounded-full flex items-center justify-center mr-3 mt-0.5 transform group-hover:scale-125 group-hover:rotate-180 transition-all duration-500">
                            <i class="fas fa-check text-xs text-white"></i>
                        </div>
                        <span class="text-gray-300 group-hover:text-white transition-colors duration-300"><?php echo $feature; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <a href="contact.php" class="block w-full text-center py-4 <?php echo $plan['popular'] ? 'bg-gradient-to-r from-orange-600 to-orange-700 text-white hover:from-orange-700 hover:to-orange-800' : 'border-2 border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white'; ?> font-bold uppercase tracking-wider transition-all duration-500 rounded-lg relative z-10 group/btn overflow-hidden transform hover:scale-105 hover:shadow-xl hover:shadow-orange-600/50">
                    <span class="flex items-center justify-center relative z-10">
                        Choose Plan 
                        <i class="fas fa-arrow-right ml-3 transform group-hover/btn:translate-x-3 transition-transform duration-300"></i>
                    </span>
                </a>
                
                <!-- Corner decorations -->
                <div class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2 border-orange-600 opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-0 group-hover:scale-100"></div>
                <div class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2 border-orange-600 opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-0 group-hover:scale-100"></div>
                
                <!-- Glow effect -->
                <div class="absolute -inset-2 bg-gradient-to-r from-orange-600 to-orange-800 opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-700"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-black">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="testimonials-header text-center mb-16 opacity-0 transform translate-y-10">
            <div class="inline-block mb-6">
                <span class="text-orange-600 text-sm font-bold uppercase tracking-widest border-l-4 border-orange-600 pl-4 hover:pl-6 transition-all duration-300">Testimonials</span>
            </div>
            
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                WHAT OUR
                <span class="block text-gray-400">CLIENTS SAY</span>
            </h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <?php
            $testimonials = [
                [
                    'name' => 'Rajesh Kumar',
                    'company' => 'Kumar Packaging Ltd.',
                    'comment' => 'The slitting machine from VIVA ENGINEERING increased our production by 40%. Excellent after-sales service and technical support!'
                ],
                [
                    'name' => 'Priya Sharma',
                    'company' => 'Sharma Industries',
                    'comment' => 'Reliable machines with minimal maintenance requirements. Their technical support team is always available when needed.'
                ],
                [
                    'name' => 'Amit Patel',
                    'company' => 'Patel Manufacturing',
                    'comment' => 'We invested in their complete production line. Best decision for our expansion plans. Highly recommended!'
                ]
            ];
            
            foreach ($testimonials as $index => $testimonial):
            ?>
            <div class="testimonial-card bg-gray-900 border border-gray-800 p-8 hover:border-orange-600 transition-all duration-700 group cursor-pointer opacity-0 transform translate-y-10 hover:-translate-y-4 hover:shadow-2xl hover:shadow-orange-600/20" 
                 data-delay="<?php echo $index * 150; ?>">
                
                <!-- Animated background -->
                <div class="absolute inset-0 bg-gradient-to-br from-orange-600/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <!-- Quote Icon -->
                <div class="text-4xl text-orange-600 mb-6 opacity-50 group-hover:opacity-100 group-hover:scale-125 transition-all duration-500 relative z-10">
                    <i class="fas fa-quote-left"></i>
                </div>
                
                <!-- Rating -->
                <div class="flex mb-6 relative z-10">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="fas fa-star text-orange-500 mr-1 transform hover:scale-125 hover:rotate-12 transition-all duration-300"></i>
                    <?php endfor; ?>
                </div>
                
                <!-- Comment -->
                <p class="text-gray-300 italic leading-relaxed mb-8 text-lg group-hover:text-white transition-colors duration-300 relative z-10">
                    "<?php echo $testimonial['comment']; ?>"
                </p>
                
                <!-- Client Info -->
                <div class="flex items-center pt-6 border-t border-gray-800 group-hover:border-orange-600 transition-colors duration-500 relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-600 to-orange-700 rounded-full flex items-center justify-center mr-4 transform group-hover:scale-110 group-hover:rotate-180 transition-all duration-700 shadow-lg shadow-orange-600/50">
                        <i class="fas fa-user text-xl text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-white group-hover:text-orange-400 transition-colors duration-300"><?php echo $testimonial['name']; ?></h4>
                        <p class="text-gray-400 text-sm group-hover:text-gray-300 transition-colors duration-300"><?php echo $testimonial['company']; ?></p>
                    </div>
                </div>
                
                <!-- Hover Corners -->
                <div class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2 border-orange-600 opacity-0 group-hover:opacity-100 transition-all duration-700 transform scale-0 group-hover:scale-100"></div>
                <div class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2 border-orange-600 opacity-0 group-hover:opacity-100 transition-all duration-700 transform scale-0 group-hover:scale-100"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-24 bg-gradient-to-r from-black via-gray-900 to-black relative overflow-hidden opacity-0">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-grid-white/[0.02] bg-[size:20px_20px]"></div>
    </div>
    
    <!-- Animated Elements -->
    <div class="animated-blob absolute top-0 left-1/4 w-64 h-64 bg-orange-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="animated-blob-2 absolute bottom-0 right-1/4 w-64 h-64 bg-orange-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="cta-title text-4xl md:text-5xl lg:text-6xl font-bold mb-8 leading-tight opacity-0 transform translate-y-10">
                READY TO TRANSFORM YOUR
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">PRODUCTION LINE?</span>
            </h2>
            
            <p class="cta-description text-xl md:text-2xl mb-12 text-gray-300 max-w-2xl mx-auto leading-relaxed opacity-0 transform translate-y-10">
                Partner with VIVA ENGINEERING for cutting-edge industrial machinery solutions that drive efficiency and productivity.
            </p>
            
            <div class="cta-buttons flex flex-col sm:flex-row gap-6 justify-center opacity-0 transform translate-y-10">
                <a href="contact.php" class="group relative px-10 py-5 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-bold uppercase tracking-wider text-lg rounded-xl overflow-hidden hover:shadow-2xl hover:shadow-orange-600/50 transition-all duration-500 hover:-translate-y-2">
                    <span class="relative z-10 flex items-center justify-center">
                        <i class="fas fa-calendar-alt mr-4"></i>
                        Schedule Consultation
                        <i class="fas fa-arrow-right ml-4 transform group-hover:translate-x-4 transition-transform duration-500"></i>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-700 to-orange-800 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>
                </a>
                
                <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="group px-10 py-5 border-2 border-white text-white font-bold uppercase tracking-wider text-lg rounded-xl hover:bg-white hover:text-black transition-all duration-700 hover:shadow-2xl hover:-translate-y-2">
                    <span class="flex items-center justify-center">
                        <i class="fas fa-phone mr-4 transform group-hover:rotate-12 transition-transform duration-300"></i>
                        Call Now: <?php echo get_setting('contact_phone'); ?>
                    </span>
                </a>
            </div>
            
            <!-- Trust Indicators -->
            <div class="cta-indicators mt-16 pt-8 border-t border-gray-800 opacity-0 transform translate-y-10">
                <div class="flex flex-wrap justify-center gap-8 text-gray-400">
                    <div class="flex items-center transform hover:scale-110 transition-transform duration-300 cursor-pointer">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                        <span class="hover:text-white transition-colors duration-300">ISO 9001:2015 Certified</span>
                    </div>
                    <div class="flex items-center transform hover:scale-110 transition-transform duration-300 cursor-pointer">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3 animate-pulse" style="animation-delay: 0.5s"></div>
                        <span class="hover:text-white transition-colors duration-300">2 Years Warranty</span>
                    </div>
                    <div class="flex items-center transform hover:scale-110 transition-transform duration-300 cursor-pointer">
                        <div class="w-3 h-3 bg-orange-500 rounded-full mr-3 animate-pulse" style="animation-delay: 1s"></div>
                        <span class="hover:text-white transition-colors duration-300">24/7 Technical Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced CSS Animations -->
<style>
/* ============================================
   PRELOADER ANIMATIONS
   ============================================ */

/* Rotating ring loader */
.loader-ring {
    width: 100%;
    height: 100%;
    border: 3px solid transparent;
    border-top-color: #FF5722;
    border-right-color: #FF5722;
    border-radius: 50%;
    animation: spin 2s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg) scale(1);
    }
    50% {
        transform: rotate(180deg) scale(1.1);
    }
    100% {
        transform: rotate(360deg) scale(1);
    }
}

/* Pulsing circles */
.pulse-circle {
    position: absolute;
    width: 160px;
    height: 160px;
    border: 2px solid rgba(255, 87, 34, 0.3);
    border-radius: 50%;
    animation: pulse 3s ease-out infinite;
}

.pulse-circle-1 {
    animation-delay: 0s;
}

.pulse-circle-2 {
    animation-delay: 1s;
}

.pulse-circle-3 {
    animation-delay: 2s;
}

@keyframes pulse {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

/* Logo animations */
.logo-container {
    animation: logoFloat 3s ease-in-out infinite;
}

@keyframes logoFloat {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-10px) rotate(5deg);
    }
}

.logo-inner {
    animation: logoScale 2s ease-in-out infinite;
}

@keyframes logoScale {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.logo-image {
    animation: logoRotate 4s ease-in-out infinite;
}

@keyframes logoRotate {
    0%, 100% {
        transform: rotate(0deg);
    }
    25% {
        transform: rotate(-5deg);
    }
    75% {
        transform: rotate(5deg);
    }
}

/* Spinning particles */
.particle {
    position: absolute;
    width: 8px;
    height: 8px;
    background: linear-gradient(45deg, #FF5722, #FF8A65);
    border-radius: 50%;
    animation: particleSpin 4s linear infinite;
}

.particle-1 {
    top: 0;
    left: 50%;
    animation-delay: 0s;
}

.particle-2 {
    top: 50%;
    right: 0;
    animation-delay: 1s;
}

.particle-3 {
    bottom: 0;
    left: 50%;
    animation-delay: 2s;
}

.particle-4 {
    top: 50%;
    left: 0;
    animation-delay: 3s;
}

@keyframes particleSpin {
    0% {
        transform: translate(-50%, -50%) rotate(0deg) translateX(80px) rotate(0deg) scale(1);
        opacity: 1;
    }
    50% {
        opacity: 0.5;
        transform: translate(-50%, -50%) rotate(180deg) translateX(80px) rotate(-180deg) scale(1.5);
    }
    100% {
        transform: translate(-50%, -50%) rotate(360deg) translateX(80px) rotate(-360deg) scale(1);
        opacity: 1;
    }
}

/* Loading bar */
.loading-bar {
    animation: loadingProgress 2.5s ease-in-out forwards;
}

@keyframes loadingProgress {
    0% {
        width: 0%;
    }
    100% {
        width: 100%;
    }
}

/* Loading dots */
.loading-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    background: #FF5722;
    border-radius: 50%;
    animation: dotBounce 1.4s ease-in-out infinite;
}

.loading-dot:nth-child(1) {
    animation-delay: 0s;
}

.loading-dot:nth-child(2) {
    animation-delay: 0.2s;
}

.loading-dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes dotBounce {
    0%, 80%, 100% {
        transform: scale(0);
        opacity: 0.5;
    }
    40% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Loading text animation */
.loading-text-container {
    animation: textFade 2s ease-in-out infinite;
}

@keyframes textFade {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

/* Loading screen fade out */
#loading-screen.fade-out {
    animation: screenFadeOut 0.8s ease-out forwards;
}

@keyframes screenFadeOut {
    0% {
        opacity: 1;
        transform: scale(1);
    }
    100% {
        opacity: 0;
        transform: scale(1.1);
    }
}

/* ============================================
   HERO SECTION ANIMATIONS
   ============================================ */

.hero-section.active {
    animation: heroFadeIn 1s ease-out forwards;
}

@keyframes heroFadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Sequential hero animations */
.hero-badge.active {
    animation: slideInDown 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

.hero-word.active {
    animation: slideInUp 1.8s cubic-bezier(1.68, -0.55, 0.265, 1.55) 0.6s forwards;
}

.hero-word-2.active {
    animation: slideInUp 1.8s cubic-bezier(1.68, -0.55, 0.265, 1.55) 0.6s forwards;
}

.hero-word-3.active {
    animation: slideInUp 1.8s cubic-bezier(1.68, -0.55, 0.265, 1.55) 0.8s forwards;
}

.hero-description.active {
    animation: slideInUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.8s forwards;
}

.hero-cta.active {
    animation: slideInUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) 1s forwards;
}

.hero-stats.active {
    animation: slideInUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) 1.2s forwards;
}

.scroll-indicator.active {
    animation: slideInUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) 1.4s forwards;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ============================================
   SECTION SCROLL ANIMATIONS
   ============================================ */

/* About section animations */
.about-image.active {
    animation: slideInLeft 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

.about-content.active {
    animation: slideInRight 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

.about-card.active {
    animation: cardFloat 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.3s forwards;
}

.feature-item.active {
    animation: featureSlideIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

.feature-item:nth-child(1) {
    animation-delay: 0.2s;
}

.feature-item:nth-child(2) {
    animation-delay: 0.4s;
}

.feature-item:nth-child(3) {
    animation-delay: 0.6s;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes cardFloat {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes featureSlideIn {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Generic section headers */
.services-header.active,
.products-header.active,
.pricing-header.active,
.testimonials-header.active,
.trusted-title.active {
    animation: fadeInScale 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Service cards staggered animation */
.service-card.active {
    animation: cardSlideUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

@keyframes cardSlideUp {
    from {
        opacity: 0;
        transform: translateY(50px) rotateX(20deg);
    }
    to {
        opacity: 1;
        transform: translateY(0) rotateX(0);
    }
}

/* Product cards with 3D effect */
.product-card.active {
    animation: cardFlipIn 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

@keyframes cardFlipIn {
    from {
        opacity: 0;
        transform: translateY(50px) rotateY(-20deg) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) rotateY(0) scale(1);
    }
}

/* Scan line effect for products */
.scan-line {
    animation: scanEffect 3s ease-in-out infinite;
}

@keyframes scanEffect {
    0%, 100% {
        transform: translateY(-100%);
    }
    50% {
        transform: translateY(100%);
    }
}

/* Pricing cards */
.pricing-card.active {
    animation: pricingPopIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

.pricing-card .feature-list-item {
    animation: featurePopIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

@keyframes pricingPopIn {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.8);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes featurePopIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Testimonial cards */
.testimonial-card.active {
    animation: testimonialSlide 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

@keyframes testimonialSlide {
    from {
        opacity: 0;
        transform: translateY(50px) rotateZ(-5deg);
    }
    to {
        opacity: 1;
        transform: translateY(0) rotateZ(0);
    }
}

/* Logo slider animation */
.logo-item {
    animation: logoFadeIn 1s ease-out forwards;
}

.logo-item:nth-child(1) { animation-delay: 0.1s; }
.logo-item:nth-child(2) { animation-delay: 0.2s; }
.logo-item:nth-child(3) { animation-delay: 0.3s; }
.logo-item:nth-child(4) { animation-delay: 0.4s; }
.logo-item:nth-child(5) { animation-delay: 0.5s; }

@keyframes logoFadeIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 0.5;
        transform: scale(1);
    }
}

/* CTA section */
.cta-section.active {
    animation: ctaFadeIn 1s ease-out forwards;
}

.cta-title.active {
    animation: ctaTitleSlide 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.2s forwards;
}

.cta-description.active {
    animation: ctaDescSlide 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.4s forwards;
}

.cta-buttons.active {
    animation: ctaButtonsSlide 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.6s forwards;
}

.cta-indicators.active {
    animation: ctaIndicatorsSlide 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.8s forwards;
}

@keyframes ctaFadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes ctaTitleSlide {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes ctaDescSlide {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes ctaButtonsSlide {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes ctaIndicatorsSlide {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animated blobs in CTA */
.animated-blob {
    animation: blobFloat 8s ease-in-out infinite;
}

.animated-blob-2 {
    animation: blobFloat 10s ease-in-out infinite reverse;
}

@keyframes blobFloat {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -30px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

/* Products CTA button */
.products-cta.active {
    animation: buttonPopIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
}

@keyframes buttonPopIn {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* ============================================
   UTILITY ANIMATIONS
   ============================================ */

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    background: #0a0a0a;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #FF5722, #FF8A65);
    border-radius: 6px;
    border: 2px solid #0a0a0a;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #FF6B3D, #FF9E7D);
}

/* Disable animations for users who prefer reduced motion */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2.5rem;
    }
    
    .loader-ring {
        width: 120px;
        height: 120px;
    }
    
    .pulse-circle {
        width: 130px;
        height: 130px;
    }
}
</style>

<!-- GSAP Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<!-- Advanced JavaScript for Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // PRELOADER FUNCTIONALITY
    // ============================================
    
    const loadingScreen = document.getElementById('loading-screen');
    const percentageElement = document.querySelector('.loading-percentage');
    let progress = 0;
    
    // Simulate loading progress
    const progressInterval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress > 100) progress = 100;
        
        if (percentageElement) {
            percentageElement.textContent = Math.round(progress) + '%';
        }
        
        if (progress >= 100) {
            clearInterval(progressInterval);
            
            // Wait a bit then fade out
            setTimeout(() => {
                loadingScreen.classList.add('fade-out');
                
                // Remove from DOM and start hero animations
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                    initializeHeroAnimations();
                }, 800);
            }, 500);
        }
    }, 100);
    
    // ============================================
    // HERO SECTION ANIMATIONS
    // ============================================
    
    function initializeHeroAnimations() {
        const heroSection = document.querySelector('.hero-section');
        const heroBadge = document.querySelector('.hero-badge');
        const heroWords = document.querySelectorAll('.hero-word, .hero-word-2, .hero-word-3');
        const heroDescription = document.querySelector('.hero-description');
        const heroCta = document.querySelector('.hero-cta');
        const heroStats = document.querySelector('.hero-stats');
        const scrollIndicator = document.querySelector('.scroll-indicator');
        
        // Activate hero section
        if (heroSection) {
            heroSection.classList.add('active');
        }
        
        // Sequential animations
        setTimeout(() => {
            if (heroBadge) heroBadge.classList.add('active');
        }, 200);
        
        heroWords.forEach((word, index) => {
            setTimeout(() => {
                word.classList.add('active');
            }, 400 + (index * 200));
        });
        
        setTimeout(() => {
            if (heroDescription) heroDescription.classList.add('active');
        }, 1200);
        
        setTimeout(() => {
            if (heroCta) heroCta.classList.add('active');
        }, 1400);
        
        setTimeout(() => {
            if (heroStats) {
                heroStats.classList.add('active');
                animateCounters();
            }
        }, 1600);
        
        setTimeout(() => {
            if (scrollIndicator) scrollIndicator.classList.add('active');
        }, 1800);
    }
    
    // ============================================
    // VERTICAL STATS GSAP ANIMATIONS
    // ============================================
    
    // Wait for loading screen to complete
    setTimeout(() => {
        // Animate stats container
        gsap.to('.stats-vertical', {
            opacity: 1,
            x: 0,
            duration: 1,
            ease: "power2.out",
            delay: 1.5
        });
        
        // Animate number counters
        document.querySelectorAll('.stat-number').forEach((number, index) => {
            const targetValue = parseInt(number.getAttribute('data-value'));
            gsap.to(number, {
                innerHTML: targetValue,
                duration: 2,
                delay: 2 + (index * 0.3),
                ease: "power2.out",
                snap: { innerHTML: 1 },
                onUpdate: function() {
                    number.innerHTML = Math.floor(this.targets()[0].innerHTML);
                }
            });
        });
        
        // Add hover effect to stat items
        document.querySelectorAll('.stat-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                gsap.to(item, {
                    scale: 1.05,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
            
            item.addEventListener('mouseleave', () => {
                gsap.to(item, {
                    scale: 1,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        });
    }, 1000);
    
    // ============================================
    // COUNTER ANIMATIONS
    // ============================================
    
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number[data-target], .counter-number[data-target]');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
    }
    
    // ============================================
    // SCROLL TRIGGERED ANIMATIONS
    // ============================================
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const delay = element.getAttribute('data-delay') || 0;
                
                setTimeout(() => {
                    element.classList.add('active');
                    
                    // Trigger counter animation if element has counters
                    const counters = element.querySelectorAll('.counter-number[data-target]');
                    if (counters.length > 0) {
                        counters.forEach(counter => {
                            animateSingleCounter(counter);
                        });
                    }
                    
                    // Animate feature items
                    const featureItems = element.querySelectorAll('.feature-item');
                    featureItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('active');
                        }, index * 150);
                    });
                    
                    // Animate pricing features
                    const pricingFeatures = element.querySelectorAll('.feature-list-item');
                    pricingFeatures.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('active');
                        }, index * 100);
                    });
                }, delay);
                
                // Stop observing after animation
                observer.unobserve(element);
            }
        });
    }, observerOptions);
    
    // Observe all animated elements
    const animatedElements = document.querySelectorAll(`
        .about-image,
        .about-content,
        .about-card,
        .services-header,
        .service-card,
        .products-header,
        .product-card,
        .products-cta,
        .pricing-header,
        .pricing-card,
        .testimonials-header,
        .testimonial-card,
        .cta-section,
        .cta-title,
        .cta-description,
        .cta-buttons,
        .cta-indicators,
        .trusted-title
    `);
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
    
    // ============================================
    // SINGLE COUNTER ANIMATION
    // ============================================
    
    function animateSingleCounter(counter) {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    }
    
    // ============================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ============================================
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // ============================================
    // PARALLAX EFFECT ON SCROLL
    // ============================================
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        
        // Parallax for hero section
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            heroSection.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
        
        // Parallax for animated blobs
        const blobs = document.querySelectorAll('.animated-blob, .animated-blob-2');
        blobs.forEach((blob, index) => {
            const speed = index % 2 === 0 ? 0.3 : 0.4;
            blob.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
    
    // ============================================
    // PRODUCT CARD TILT EFFECT
    // ============================================
    
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-15px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });
    
    // ============================================
    // SERVICE CARD 3D EFFECT
    // ============================================
    
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 15;
            const rotateY = (centerX - x) / 15;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });
    
    // ============================================
    // BUTTON RIPPLE EFFECT
    // ============================================
    
    const buttons = document.querySelectorAll('a[class*="group"], button');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple-effect');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple CSS dynamically
    const rippleStyle = document.createElement('style');
    rippleStyle.textContent = `
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(rippleStyle);
    
    // ============================================
    // CURSOR GLOW EFFECT (OPTIONAL)
    // ============================================
    
    const cursorGlow = document.createElement('div');
    cursorGlow.style.cssText = `
        position: fixed;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 87, 34, 0.15) 0%, transparent 70%);
        pointer-events: none;
        z-index: 9998;
        transform: translate(-50%, -50%);
        transition: opacity 0.3s;
        opacity: 0;
    `;
    document.body.appendChild(cursorGlow);
    
    document.addEventListener('mousemove', (e) => {
        cursorGlow.style.left = e.clientX + 'px';
        cursorGlow.style.top = e.clientY + 'px';
        cursorGlow.style.opacity = '1';
    });
    
    document.addEventListener('mouseleave', () => {
        cursorGlow.style.opacity = '0';
    });
});
</script>

<?php include 'includes/footer.php'; ?>