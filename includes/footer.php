</main>
    
    <!-- Footer -->
    <footer class="bg-black text-white pt-16 pb-8 border-t border-gray-800">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-black-600 to-black-700 rounded-lg flex items-center justify-center transition-transform duration-700">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <!-- Using settings logo -->
                                <img src="<?php echo resolve_url(get_setting('footer_logo_path') ?: get_setting('logo_path')); ?>" alt="<?php echo get_setting('site_name'); ?> Logo" class="w-8 h-8 object-contain">
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
    
    <!-- WhatsApp Floating Button -->
    <?php 
    $wa_number = get_setting('whatsapp_number');
    if ($wa_number): 
        // Remove non-numeric characters for the link
        $wa_link = preg_replace('/[^0-9]/', '', $wa_number);
    ?>
    <a href="https://wa.me/<?php echo $wa_link; ?>" target="_blank" 
       class="fixed bottom-24 right-8 w-14 h-14 bg-[#25D366] text-white rounded-full flex items-center justify-center hover:bg-[#128C7E] transition-all duration-300 z-40 shadow-lg hover:shadow-green-500/50 group hover:-translate-y-2"
       title="Chat with us on WhatsApp">
        <i class="fab fa-whatsapp text-3xl group-hover:scale-110 transition-transform"></i>
        <!-- Ripple Effect -->
        <span class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-20 pointer-events-none"></span>
    </a>
    <?php endif; ?>

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
    
    <!-- Lead Generation Popup -->
    <?php if (get_setting('popup_enabled') === '1'): ?>
    <div id="lead-popup" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-md opacity-0 invisible transition-all duration-700">
        <div class="relative w-full max-w-lg bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-[0_0_50px_rgba(255,87,34,0.2)] transform scale-90 transition-all duration-700">

            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-orange-600/10 rounded-2xl flex items-center justify-center text-orange-600 mx-auto mb-4">
                        <i class="fas fa-paper-plane text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-heading font-black text-white mb-2">Let's Build Something <span class="text-orange-600">Great</span></h3>
                    <p class="text-gray-400 text-sm">Please provide your details below and our experts will get in touch with you shortly.</p>
                </div>

                <form id="lead-form" class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Full Name <span class="text-orange-600">*</span></label>
                        <input type="text" name="name" required placeholder="Enter your full name" 
                            class="w-full bg-black border border-gray-800 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-orange-600 transition-all">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
                            <input type="tel" name="phone" placeholder="e.g. +91 98765 43210" 
                                class="w-full bg-black border border-gray-800 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-orange-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Email ID</label>
                            <input type="email" name="email" placeholder="e.g. john@example.com" 
                                class="w-full bg-black border border-gray-800 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-orange-600 transition-all">
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500 italic">Note: Name is required. Please provide either Phone or Email.</p>

                    <button type="submit" id="lead-submit-btn" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-orange-600/20 active:scale-95 flex items-center justify-center space-x-3">
                        <span>SEND ENQUIRY</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    
                    <div id="lead-status" class="text-sm font-bold text-center hidden"></div>
                </form>
            </div>
            
            <!-- Subtle accent -->
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-orange-600 to-transparent"></div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('lead-popup');
        const delay = (parseInt('<?php echo get_setting('popup_delay', 30); ?>') || 30) * 1000;

        // Check if user has already seen or submitted in this session
        if (sessionStorage.getItem('viva_lead_popup_dismissed')) return;

        setTimeout(() => {
            popup.classList.remove('invisible', 'opacity-0');
            popup.querySelector('.relative').classList.remove('scale-90');
        }, delay);

        // Form Submission
        const form = document.getElementById('lead-form');
        const statusDiv = document.getElementById('lead-status');
        const submitBtn = document.getElementById('lead-submit-btn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const phone = formData.get('phone').trim();
            const email = formData.get('email').trim();

            if (!phone && !email) {
                showStatus('Please provide either Phone or Email.', 'text-red-500');
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>SENDING...</span>';

            fetch('<?php echo BASE_URL; ?>/api/save_lead.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showStatus(data.message, 'text-green-500');
                    sessionStorage.setItem('viva_lead_popup_dismissed', 'true');
                    setTimeout(hideLeadPopup, 3000);
                } else {
                    showStatus(data.message, 'text-red-500');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>SEND ENQUIRY</span> <i class="fas fa-arrow-right"></i>';
                }
            })
            .catch(error => {
                showStatus('An error occurred. Please try again.', 'text-red-500');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>SEND ENQUIRY</span> <i class="fas fa-arrow-right"></i>';
            });
        });

        function showStatus(msg, colorClass) {
            statusDiv.innerText = msg;
            statusDiv.className = `text-sm font-bold text-center mt-4 ${colorClass}`;
            statusDiv.classList.remove('hidden');
        }
    });

    function hideLeadPopup() {
        const popup = document.getElementById('lead-popup');
        popup.classList.add('opacity-0', 'invisible');
        popup.querySelector('.relative').classList.add('scale-90');
    }
    </script>
    <?php endif; ?>
    
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