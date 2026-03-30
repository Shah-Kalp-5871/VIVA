<?php
require_once 'admin/includes/functions.php';

$product_slug = isset($_GET['product']) ? $_GET['product'] : null;
if (!$product_slug) {
    header("Location: products.php");
    exit;
}

// Fetch Product Details
$stmt = $pdo->prepare("SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p JOIN categories c ON p.category_id = c.id WHERE p.slug = ? AND p.status = 'active'");
$stmt->execute([$product_slug]);
$product = $stmt->fetch();

if (!$product) {
    die("Product not found.");
}

// SEO Metadata
$page_title = !empty($product['seo_title']) ? h($product['seo_title']) : h($product['name']) . " | VIVA ENGINEERING";
$meta_description = $product['seo_description'] ?? '';
$meta_keywords = $product['meta_keywords'] ?? '';

// Data Preparation
$features = parseField($product['features'] ?? '');
$specifications = parseSpecs($product['specifications'] ?? '');
$applications = parseField($product['applications'] ?? '');
$gallery = array_merge(
    [!empty($product['image']) ? h($product['image']) : 'v.jpeg'],
    !empty($product['gallery']) ? array_map('h', explode(',', $product['gallery'])) : []
);
$gallery = array_unique(array_filter($gallery));

$page_title = h($product['name']) . " | VIVA ENGINEERING";
include 'includes/header.php'; 
?>

<!-- Product Detail Hero -->
<section class="relative pt-32 pb-12 bg-black overflow-hidden">
    <div class="absolute inset-0 parallax" data-speed="0.1">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-xs md:text-sm text-gray-500 mb-8" data-aos="fade-right">
            <a href="index.php" class="hover:text-orange-600 transition">Home</a>
            <i class="fas fa-chevron-right text-[8px] md:text-[10px]"></i>
            <a href="products.php" class="hover:text-orange-600 transition">Products</a>
            <i class="fas fa-chevron-right text-[8px] md:text-[10px]"></i>
            <span class="text-orange-600 font-bold"><?php echo h($product['name']); ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Left: Gallery -->
            <div class="space-y-6">
                <div class="relative rounded-2xl overflow-hidden bg-white border border-gray-950 shadow-2xl group" data-aos="zoom-in">
                    <img id="main-image" src="<?php echo h($gallery[0]); ?>" 
                         alt="<?php echo h($product['name']); ?>" 
                         class="w-full h-[500px] object-contain p-10 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
                </div>
                
                <?php if (count($gallery) > 1): ?>
                <div class="grid grid-cols-4 gap-4" data-aos="fade-up">
                    <?php foreach ($gallery as $index => $img): ?>
                    <button class="thumbnail-item rounded-xl overflow-hidden border-2 <?php echo $index === 0 ? 'border-orange-600 animate-pulse-glow' : 'border-gray-900'; ?> bg-white p-2 hover:border-orange-600 transition-all duration-300"
                            data-image="<?php echo $img; ?>">
                        <img src="<?php echo $img; ?>" alt="Thumb <?php echo $index; ?>" class="w-full h-20 object-contain">
                    </button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right: Info -->
            <div class="space-y-8" data-aos="fade-left">
                <div>
                    <span class="inline-block px-4 py-2 bg-orange-600/10 text-orange-600 rounded-full text-xs font-bold uppercase tracking-widest mb-4 border border-orange-600/30">
                        <?php echo h($product['category_name']); ?>
                    </span>
                    <h1 class="text-5xl font-bold text-white mb-6"><?php echo h($product['name']); ?></h1>
                    <p class="text-xl text-gray-400 italic"><?php echo h($product['tagline'] ?? 'Engineering Excellence'); ?></p>
                </div>

                <div class="grid grid-cols-2 gap-6 pb-8 border-b border-gray-900">
                    <div>
                        <span class="block text-gray-500 text-xs uppercase font-bold mb-1">Availability</span>
                        <span class="text-green-500 font-bold flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-ping"></span>
                            In Stock
                        </span>
                    </div>
                    <div>
                        <span class="block text-gray-500 text-xs uppercase font-bold mb-1">Lead Time</span>
                        <span class="text-white font-bold"><i class="fas fa-clock text-orange-600 mr-2"></i> 4-6 Weeks</span>
                    </div>
                </div>

                <div class="prose prose-invert max-w-none">
                    <h3 class="text-2xl font-bold text-white mb-4">Description</h3>
                    <p class="text-gray-400 leading-relaxed text-lg"><?php echo nl2br(h($product['description'])); ?></p>
                </div>

                <?php if (!empty($features)): ?>
                <div>
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-microchip text-orange-600 mr-4"></i> High-End Features
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php foreach ($features as $f): ?>
                        <div class="flex items-center space-x-3 bg-white/5 p-4 rounded-xl border border-gray-900 hover:border-orange-600 transition-all group hover:-translate-y-1">
                            <i class="fas fa-check-circle text-orange-600 group-hover:scale-110 transition-transform"></i>
                            <span class="text-gray-300 font-medium"><?php echo h($f); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($benefits)): ?>
                <div class="pt-8">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-chart-line text-orange-600 mr-4"></i> Strategic Benefits
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <?php 
                        $benefits_data = parseField($product['benefits'] ?? '');
                        foreach ($benefits_data as $b): 
                        ?>
                        <div class="flex items-start space-x-4 bg-orange-600/5 p-5 rounded-xl border border-orange-600/10 hover:border-orange-600/30 transition-all">
                            <div class="mt-1 w-6 h-6 bg-orange-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-arrow-up text-[10px] text-white"></i>
                            </div>
                            <span class="text-gray-300 text-sm leading-relaxed"><?php echo h($b); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="contact.php?product=<?php echo urlencode($product['name']); ?>" class="btn-premium px-10 py-5">
                        Request Quote <i class="fas fa-paper-plane ml-3"></i>
                    </a>
                    <a href="product-pdf.php?product=<?php echo urlencode($product['slug']); ?>" target="_blank" class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-bold uppercase rounded-lg hover:bg-white hover:text-black transition-all">
                        Download PDF <i class="fas fa-download ml-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Specs Table -->
<?php if (!empty($specifications)): ?>
<section class="py-24 bg-[#050505]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-white mb-4">Technical Specifications</h2>
                <div class="w-24 h-1 bg-orange-600 mx-auto"></div>
            </div>

            <div class="bg-gray-950 rounded-2xl border border-gray-900 overflow-hidden shadow-2xl" data-aos="fade-up">
                <table class="w-full text-left">
                    <tbody>
                        <?php foreach ($specifications as $key => $val): ?>
                        <tr class="border-b border-gray-900 hover:bg-gray-900/50 transition-colors">
                            <td class="py-6 px-8 font-bold text-white w-1/3 bg-black/30"><?php echo h($key); ?></td>
                            <td class="py-6 px-8 text-gray-400"><?php echo h($val); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Related Industries -->
<?php if (!empty($applications)): ?>
<section class="py-24 bg-black">
    <div class="container mx-auto px-4 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-16" data-aos="fade-up">Ideal Applications</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <?php foreach ($applications as $app): ?>
            <div class="p-8 premium-card hover-lift group" data-aos="zoom-in">
                <div class="w-16 h-16 bg-orange-600/10 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-600 transition-colors">
                    <i class="fas fa-industry text-2xl text-orange-600 group-hover:text-white transition-colors"></i>
                </div>
                <span class="text-white font-bold"><?php echo h($app); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-image');
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newSrc = this.getAttribute('data-image');
                
                // Update main image with fade effect
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.src = newSrc;
                    mainImage.style.opacity = '1';
                }, 200);
                
                // Update active thumbnail styling
                thumbnails.forEach(t => {
                    t.classList.remove('border-orange-600', 'animate-pulse-glow');
                    t.classList.add('border-gray-900');
                });
                this.classList.add('border-orange-600', 'animate-pulse-glow');
                this.classList.remove('border-gray-900');
            });
        });

        // Hover Zoom effect
        const galleryContainer = mainImage.parentElement;
        galleryContainer.addEventListener('mousemove', function(e) {
            const rect = galleryContainer.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            mainImage.style.transformOrigin = `${x}% ${y}%`;
            mainImage.style.transform = 'scale(1.5)';
        });
        
        galleryContainer.addEventListener('mouseleave', function() {
            mainImage.style.transform = 'scale(1)';
        });
    });
</script>

<?php include 'includes/footer.php'; ?>