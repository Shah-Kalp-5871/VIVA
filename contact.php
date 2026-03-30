<?php 
require_once 'admin/includes/functions.php';
$page_title = "Contact Us | VIVA ENGINEERING";
include 'includes/header.php'; 
?>

<!-- Contact Hero Section -->
<section class="relative pt-28 pb-10 bg-black overflow-hidden">
    <div class="absolute inset-0 parallax" data-speed="0.1">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <!-- Contact Badge -->
        <div class="inline-flex items-center space-x-2 bg-orange-600/10 border border-orange-600/30 px-6 py-2 rounded-full mb-8 animate-pulse-glow" data-aos="fade-down">
            <span class="w-2 h-2 bg-orange-600 rounded-full"></span>
            <span class="text-sm font-bold text-orange-600 uppercase tracking-widest">Connect With Experts</span>
        </div>
        
        <h1 class="text-5xl lg:text-7xl font-bold text-white mb-8 leading-tight" data-aos="fade-up">
            Let's Build Your <br> <span class="text-orange-600">Next Innovation</span>
        </h1>
        
        <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Have questions about our machinery or need a custom engineering solution? Our technical team is ready to discuss your requirements.
        </p>
    </div>
</section>

<!-- Main Contact Section -->
<section class="py-12 bg-black">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Contact Cards -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Location -->
                <div class="premium-card p-10 group" data-aos="fade-right">
                    <div class="w-16 h-16 bg-orange-600/10 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-orange-600 transition-colors">
                        <i class="fas fa-map-marker-alt text-2xl text-orange-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Our Facility</h3>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        <?php echo nl2br(get_setting('contact_address')); ?>
                    </p>
                    <a href="https://maps.google.com" target="_blank" class="inline-flex items-center text-orange-600 font-bold hover:translate-x-2 transition-transform">
                        Get Directions <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>

                <!-- Call -->
                <div class="premium-card p-10 group" data-aos="fade-right" data-aos-delay="100">
                    <div class="w-16 h-16 bg-orange-600/10 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-orange-600 transition-colors">
                        <i class="fas fa-phone-alt text-2xl text-orange-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Technical Support</h3>
                    <p class="text-gray-400 mb-6">Available Mon-Sat: 9AM - 9PM</p>
                    <div class="space-y-2">
                        <a href="tel:<?php echo str_replace(' ', '', get_setting('contact_phone')); ?>" class="block text-xl font-bold text-white hover:text-orange-600 transition-colors">
                            <?php echo get_setting('contact_phone'); ?>
                        </a>
                    </div>
                </div>

                <!-- Email -->
                <div class="premium-card p-10 group" data-aos="fade-right" data-aos-delay="200">
                    <div class="w-16 h-16 bg-orange-600/10 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-orange-600 transition-colors">
                        <i class="fas fa-envelope text-2xl text-orange-600 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Email Inquiry</h3>
                    <p class="text-gray-400 mb-6">We respond within 24 hours.</p>
                    <a href="mailto:<?php echo get_setting('contact_email'); ?>" class="block text-lg font-bold text-white hover:text-orange-600 transition-colors">
                        <?php echo get_setting('contact_email'); ?>
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="lg:col-span-2" data-aos="fade-left">
                <div class="bg-gray-950 border border-gray-900 rounded-3xl p-8 lg:p-12 shadow-2xl">
                    <div class="mb-10">
                        <h2 class="text-3xl font-bold text-white mb-4">Send a Message</h2>
                        <p class="text-gray-500">Provide your details below and an engineer will contact you shortly.</p>
                    </div>

                    <form id="contact-form" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3 group">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] pl-1 group-focus-within:text-orange-600 transition-colors">Full Name</label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-6 top-1/2 -translate-y-1/2 text-gray-700 group-focus-within:text-orange-600 transition-colors"></i>
                                    <input type="text" name="name" required class="w-full bg-black border border-gray-900 rounded-2xl pl-14 pr-6 py-5 text-white focus:border-orange-600 transition-all outline-none focus:ring-4 focus:ring-orange-600/5 placeholder:text-gray-800" placeholder="e.g. Alexander Pierce">
                                </div>
                            </div>
                            <div class="space-y-3 group">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] pl-1 group-focus-within:text-orange-600 transition-colors">Email Address</label>
                                <div class="relative">
                                    <i class="fas fa-envelope absolute left-6 top-1/2 -translate-y-1/2 text-gray-700 group-focus-within:text-orange-600 transition-colors"></i>
                                    <input type="email" name="email" required class="w-full bg-black border border-gray-900 rounded-2xl pl-14 pr-6 py-5 text-white focus:border-orange-600 transition-all outline-none focus:ring-4 focus:ring-orange-600/5 placeholder:text-gray-800" placeholder="alexander@company.com">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3 group">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] pl-1 group-focus-within:text-orange-600 transition-colors">Phone Number</label>
                                <div class="relative">
                                    <i class="fas fa-phone-alt absolute left-6 top-1/2 -translate-y-1/2 text-gray-700 group-focus-within:text-orange-600 transition-colors"></i>
                                    <input type="tel" name="phone" required class="w-full bg-black border border-gray-900 rounded-2xl pl-14 pr-6 py-5 text-white focus:border-orange-600 transition-all outline-none focus:ring-4 focus:ring-orange-600/5 placeholder:text-gray-800" placeholder="+91 98765 43210">
                                </div>
                            </div>
                            <div class="space-y-3 group">
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] pl-1 group-focus-within:text-orange-600 transition-colors">Inquiry Type</label>
                                <div class="relative">
                                    <i class="fas fa-tag absolute left-6 top-1/2 -translate-y-1/2 text-gray-700 group-focus-within:text-orange-600 transition-colors"></i>
                                    <select name="subject" required class="w-full bg-black border border-gray-900 rounded-2xl pl-14 pr-12 py-5 text-white focus:border-orange-600 transition-all outline-none focus:ring-4 focus:ring-orange-600/5 appearance-none cursor-pointer">
                                        <option value="quote">Request for Quote</option>
                                        <option value="technical">Technical Support</option>
                                        <option value="demo">Product Demo</option>
                                        <option value="general">General Inquiry</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-gray-700 pointer-events-none"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 group">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] pl-1 group-focus-within:text-orange-600 transition-colors">Project Requirements</label>
                            <div class="relative">
                                <textarea name="message" rows="5" required class="w-full bg-black border border-gray-900 rounded-2xl px-6 py-5 text-white focus:border-orange-600 transition-all outline-none focus:ring-4 focus:ring-orange-600/5 placeholder:text-gray-800 resize-none" placeholder="Provide details about your machinery needs..."></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-premium w-full py-6 text-xl tracking-[0.1em] font-black uppercase shadow-2xl shadow-orange-600/20 group overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center">
                                Dispatch Inquiry <i class="fas fa-paper-plane ml-4 group-hover:translate-x-2 group-hover:-translate-y-1 transition-transform"></i>
                            </span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-24 bg-[#050505]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-white mb-4">Common Questions</h2>
                <div class="w-24 h-1 bg-orange-600 mx-auto"></div>
            </div>

            <div class="space-y-4">
                <?php 
                $faqs = [
                    ["What is your response time?", "We respond to all technical inquiries within 24 hours."],
                    ["Do you offer product demonstrations?", "Yes, we offer both on-site and virtual demonstrations for all our machinery."],
                    ["What is your warranty policy?", "Our standard warranty is 2 years, covering all manufacturing defects."],
                    ["Can you customize machinery?", "Absolutely. We specialize in custom-built engineering solutions for unique production lines."]
                ];
                foreach ($faqs as $i => $faq):
                ?>
                <div class="premium-card overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                    <button class="faq-question w-full text-left px-8 py-6 flex justify-between items-center text-white font-bold hover:bg-white/5 transition-colors">
                        <span><?php echo $faq[0]; ?></span>
                        <i class="fas fa-chevron-down text-orange-600"></i>
                    </button>
                    <div class="faq-answer px-8 text-gray-400 bg-black/30">
                        <p class="py-6"><?php echo $faq[1]; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 bg-black/95 backdrop-blur-3xl z-[100] flex items-center justify-center p-6 hidden">
    <div class="bg-gray-950 border border-white/5 rounded-[2.5rem] max-w-lg w-full p-16 text-center shadow-[0_50px_150px_rgba(0,0,0,0.9)] relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-orange-600/[0.03] to-transparent"></div>
        
        <div class="relative z-10">
            <div class="w-28 h-28 bg-orange-600 rounded-3xl flex items-center justify-center mx-auto mb-10 shadow-3xl shadow-orange-600/40 transform -rotate-12 animate-float">
                <i class="fas fa-check text-5xl text-white"></i>
            </div>
            <h3 class="text-4xl font-black text-white mb-6 tracking-tight">Transmission <span class="text-orange-600">Complete</span></h3>
            <p class="text-gray-500 mb-12 text-lg leading-relaxed">Your technical requirements have been received. An engineer will be assigned to your case within <span class="text-white font-bold italic">24 business hours</span>.</p>
            <button id="close-success-modal" class="w-full py-5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl text-gray-300 font-bold uppercase tracking-widest text-sm transition-all">Acknowledge</button>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>