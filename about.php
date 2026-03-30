<?php include 'includes/header.php'; ?>

<!-- External Libraries for About Page -->
<script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.8.0/dist/vanilla-tilt.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/splitting@1.0.6/dist/splitting.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/splitting@1.0.6/dist/splitting.css">

<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center bg-black overflow-hidden">
    <div class="absolute inset-0 parallax" data-speed="0.3">
        <img src="assets/images/categories/slitting-rewinding.jpg" 
             alt="VIVA Engineering Machinery"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/90 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-orange-600/20 border border-orange-600/50 px-4 py-2 rounded-sm mb-6 animate-pulse-glow" data-aos="fade-down">
                <span class="w-2 h-2 bg-orange-600 rounded-full animate-pulse"></span>
                <span class="text-sm font-medium text-orange-600 uppercase tracking-wider">Our Legacy</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                <span class="block text-white">ENGINEERING</span>
                <span class="block text-gray-400">EXCELLENCE</span>
                <span class="block text-orange-600">SINCE 2008</span>
            </h1>
            
            <!-- Description -->
            <p class="text-xl text-gray-300 mb-10 leading-relaxed max-w-2xl" data-aos="fade-up" data-aos-delay="100">
                Pioneering industrial machinery solutions with 16+ years of expertise, precision engineering, and innovation.
            </p>
            
            <!-- Buttons -->
            <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="200">
                <a href="#story" class="btn-premium">
                    Our Journey <i class="fas fa-arrow-down ml-3 animate-bounce"></i>
                </a>
                <a href="contact.php" class="inline-flex items-center px-8 py-4 border-2 border-orange-600 text-orange-600 font-bold uppercase hover:bg-orange-600 hover:text-white transition-all duration-300 rounded-lg">
                    Connect With Us <i class="fas fa-handshake ml-3"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Our Story -->
<section id="story" class="py-16 bg-black">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image Showcase -->
            <div class="relative" data-aos="fade-right">
                <div class="relative rounded-2xl overflow-hidden group">
                    <img src="assets/images/products/plastic-slitting-machine/plastic-slitting-machine-1.png" 
                         alt="VIVA Precision Engineering"
                         class="w-full h-[500px] object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    
                    <!-- Floating Year Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-gradient-to-br from-orange-600 to-orange-700 p-8 rounded-2xl shadow-2xl animate-float">
                        <div class="text-4xl font-bold text-white">2008</div>
                        <div class="text-sm text-white/80 uppercase tracking-widest font-bold">Founded</div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div data-aos="fade-left">
                <div class="mb-6">
                    <span class="text-orange-600 font-bold uppercase tracking-widest border-l-4 border-orange-600 pl-4">Our Story</span>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-8 leading-tight">
                    Building Industrial Excellence <span class="text-orange-600">For Over 16 Years</span>
                </h2>
                
                <p class="text-gray-400 text-lg mb-10 leading-relaxed">
                    VIVA ENGINEERING started with a vision to revolutionize industrial manufacturing. From a small workshop to a global leader, we've been delivering precision machinery solutions across 50+ countries.
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                    <?php
                    $features = [
                        ['icon' => 'fas fa-check-circle', 'text' => 'ISO 9001:2015 Certified'],
                        ['icon' => 'fas fa-globe', 'text' => '50+ Countries Served'],
                        ['icon' => 'fas fa-cogs', 'text' => 'Modern R&D Facility'],
                        ['icon' => 'fas fa-users', 'text' => 'Expert Technical Team']
                    ];
                    foreach ($features as $f):
                    ?>
                    <div class="flex items-center space-x-3 group">
                        <i class="<?php echo $f['icon']; ?> text-orange-600 group-hover:scale-125 transition-transform"></i>
                        <span class="text-gray-300 group-hover:text-white transition-colors"><?php echo $f['text']; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <a href="#values" class="btn-premium">
                    Our Values <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Grid -->
<section class="py-20 bg-[#0a0a0a] border-y border-gray-900">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $stats = [
                ['val' => '200', 'label' => 'Projects Completed', 'suffix' => '+'],
                ['val' => '16', 'label' => 'Years Experience', 'suffix' => '+'],
                ['val' => '50', 'label' => 'Countries Served', 'suffix' => '+'],
                ['val' => '100', 'label' => 'Industry Experts', 'suffix' => '%']
            ];
            foreach ($stats as $s):
            ?>
            <div class="text-center p-8 premium-card group" data-aos="zoom-in">
                <div class="text-5xl font-bold text-orange-600 mb-2 flex justify-center">
                    <span class="counter"><?php echo $s['val']; ?></span>
                    <span><?php echo $s['suffix']; ?></span>
                </div>
                <p class="text-gray-400 uppercase tracking-widest text-sm font-bold"><?php echo $s['label']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Values Section -->
<section id="values" class="py-24 bg-black">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-orange-600 font-bold uppercase tracking-widest mb-4 block">Core Values</span>
            <h2 class="text-4xl md:text-5xl font-bold text-white">The Pillars of Our Success</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $values = [
                [
                    'icon' => 'fas fa-gem',
                    'title' => 'Quality First',
                    'desc' => 'Uncompromising standards in every component we manufacture.'
                ],
                [
                    'icon' => 'fas fa-lightbulb',
                    'title' => 'Innovation',
                    'desc' => 'Constantly pushing boundaries with next-gen industrial technology.'
                ],
                [
                    'icon' => 'fas fa-handshake',
                    'title' => 'Integrity',
                    'desc' => 'Building long-term trust through transparency and ethical practices.'
                ]
            ];
            foreach ($values as $v):
            ?>
            <div class="premium-card p-10 text-center group" data-aos="fade-up">
                <div class="w-20 h-20 bg-orange-600/10 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:bg-orange-600 transition-colors duration-500">
                    <i class="<?php echo $v['icon']; ?> text-3xl text-orange-600 group-hover:text-white transition-colors duration-500"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4"><?php echo $v['title']; ?></h3>
                <p class="text-gray-400 leading-relaxed"><?php echo $v['desc']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Global Reach / Map Section -->
<section class="py-24 bg-black overflow-hidden relative">
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div data-aos="fade-right">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-8">
                    Global Impact <span class="text-orange-600">Local Support</span>
                </h2>
                <p class="text-gray-400 text-lg mb-10 leading-relaxed">
                    Our machines power industries across the globe. From major manufacturing hubs to emerging markets, VIVA ENGINEERING provides the precision needed for modern production.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-center p-6 bg-gray-950 border border-gray-900 rounded-xl hover:border-orange-600 transition-colors group">
                        <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center mr-4 group-hover:rotate-12 transition-transform">
                            <i class="fas fa-shipping-fast text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold">Fast Installation</h4>
                            <p class="text-gray-500 text-sm">Worldwide commissioning in record time.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Interactive Map Wrapper -->
            <div class="globe-container relative h-[500px]" data-aos="zoom-in">
                <div id="world-map" class="w-full h-full bg-gray-900/50 rounded-3xl border border-orange-600/30 overflow-hidden relative">
                    <!-- SVG Lines -->
                    <svg id="connection-lines" class="absolute inset-0 w-full h-full z-10"></svg>
                    <!-- Points -->
                    <div class="location-points absolute inset-0 z-20"></div>
                    
                    <!-- Map Visual Placeholder (Center) -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-20">
                        <i class="fas fa-globe-americas text-[300px] text-orange-600 animate-gear-rotate"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>