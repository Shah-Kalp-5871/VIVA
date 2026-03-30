</main>
    
    <!-- Footer -->
    <footer class="bg-black text-white pt-16 pb-8 border-t border-gray-800">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-black-600 to-black-700 rounded-lg flex items-center justify-center group-hover:rotate-180 transition-transform duration-700">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <!-- Using settings logo -->
                                <img src="<?php echo get_setting('logo_path'); ?>" alt="<?php echo get_setting('site_name'); ?> Logo" class="w-8 h-8 object-contain">
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
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Engineering the future of industrial manufacturing with precision, innovation, and timeless durability.
                    </p>
                    <div class="flex space-x-4">
                        <a href="<?php echo get_setting('linkedin_url'); ?>" class="social-icon w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center hover:bg-orange-600 transition duration-300 border border-gray-800" target="_blank">
                            <i class="fab fa-linkedin-in text-gray-400 hover:text-white"></i>
                        </a>
                        <a href="<?php echo get_setting('facebook_url'); ?>" class="social-icon w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center hover:bg-orange-600 transition duration-300 border border-gray-800" target="_blank">
                            <i class="fab fa-facebook-f text-gray-400 hover:text-white"></i>
                        </a>
                        <a href="<?php echo get_setting('instagram_url'); ?>" class="social-icon w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center hover:bg-orange-600 transition duration-300 border border-gray-800" target="_blank">
                            <i class="fab fa-instagram text-gray-400 hover:text-white"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-heading font-bold mb-6 text-white">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="index.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Home</a></li>
                        <li><a href="products.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Products</a></li>
                        <li><a href="about.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> About</a></li>
                        <li><a href="gallery.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Gallery</a></li>
                        <li><a href="contact.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Contact</a></li>
                    </ul>
                </div>
                
                <!-- Products -->
                <div>
                    <h4 class="text-lg font-heading font-bold mb-6 text-white">Products</h4>
                    <ul class="space-y-3">
                        <li><a href="products.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Slitting Machines</a></li>
                        <li><a href="products.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Rewinding Machines</a></li>
                        <li><a href="products.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Coating Machines</a></li>
                        <li><a href="products.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Cutting Systems</a></li>
                        <li><a href="products.php" class="text-gray-400 hover:text-orange-600 transition duration-300 flex items-center"><i class="fas fa-chevron-right text-orange-600 mr-2 text-xs"></i> Tape Making Machines</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-heading font-bold mb-6 text-white">Contact Info</h4>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-orange-600 mt-1"></i>
                            <span class="text-gray-400"><?php echo get_setting('address'); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-orange-600"></i>
                            <a href="tel:<?php echo str_replace(' ', '', get_setting('contact_phone')); ?>" class="text-gray-400 hover:text-orange-600 transition duration-300"><?php echo get_setting('contact_phone'); ?></a>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-orange-600"></i>
                            <a href="mailto:<?php echo get_setting('contact_email'); ?>" class="text-gray-400 hover:text-orange-600 transition duration-300"><?php echo get_setting('contact_email'); ?></a>
                        </div>
                       
                    </div>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col lg:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 lg:mb-0">
                        © <?php echo date('Y'); ?> <?php echo get_setting('site_name'); ?>. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-orange-600 text-sm transition duration-300">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-orange-600 text-sm transition duration-300">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-orange-600 text-sm transition duration-300">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-14 h-14 bg-orange-600 text-white rounded-full flex items-center justify-center opacity-0 invisible hover:bg-orange-700 transition-all duration-300 group z-40 shadow-lg hover:shadow-xl hover:shadow-orange-600/50">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <!-- JavaScript Libraries -->
    <!-- GSAP Core & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/lenis@1.1.0/dist/lenis.min.js"></script>
    
    <!-- AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
    
    <script>
        // Robust loading screen removal
        function hideLoader() {
            const loader = document.getElementById('loading-screen');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }
        }

        if (document.readyState === 'complete') {
            hideLoader();
        } else {
            window.addEventListener('load', hideLoader);
        }

        // Fallback: Force hide after 5 seconds if still visible
        setTimeout(hideLoader, 5000);
    </script>
</body>
</html>