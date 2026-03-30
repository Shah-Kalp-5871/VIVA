<?php 
require_once 'admin/includes/functions.php';
$page_title = "Image Gallery | VIVA ENGINEERING";
include 'includes/header.php'; 

// Fetch Active Gallery Items
$imageItems = $pdo->query("SELECT * FROM gallery WHERE status = 'active' ORDER BY created_at DESC")->fetchAll();
$categories = array_unique(array_column($imageItems, 'category'));
?>

<!-- Gallery Hero -->
<section class="relative pt-28 pb-8 bg-black overflow-hidden text-center">
    <div class="absolute inset-0 parallax" data-speed="0.1">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <h1 class="text-5xl lg:text-7xl font-bold text-white mb-8" data-aos="fade-up">
            Visual <span class="text-orange-600">Excellence</span>
        </h1>
        <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            A comprehensive look at our machinery, manufacturing processes, and successful global projects.
        </p>
    </div>
</section>

<!-- Filter Section -->
<section class="py-12 bg-[#050505] border-y border-gray-900 sticky top-20 z-30 backdrop-blur-md bg-opacity-90">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
            <button class="filter-btn active" data-filter="all">All Photos</button>
            <?php foreach ($categories as $cat): ?>
            <button class="filter-btn" data-filter="<?php echo h($cat); ?>"><?php echo h(ucfirst($cat)); ?></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-12 bg-black">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="image-gallery">
            <?php foreach ($imageItems as $index => $image): ?>
            <div class="gallery-item group cursor-pointer" 
                 data-category="<?php echo h($image['category']); ?>" 
                 data-aos="fade-up" 
                 data-aos-delay="<?php echo ($index % 3) * 100; ?>">
                
                <div class="premium-card overflow-hidden">
                    <div class="relative h-72 overflow-hidden bg-white/5">
                        <img src="<?php echo h($image['image']); ?>" 
                             alt="<?php echo h($image['title']); ?>"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute bottom-6 left-6">
                                <span class="inline-block px-3 py-1 bg-orange-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-full mb-2">
                                    <?php echo h($image['category']); ?>
                                </span>
                                <h3 class="text-xl font-bold text-white"><?php echo h($image['title']); ?></h3>
                                <p class="text-gray-400 text-sm mt-1 hidden"><?php echo h($image['description']); ?></p>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center scale-0 group-hover:scale-100 transition-transform duration-500">
                                    <i class="fas fa-expand text-black"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox-modal" class="fixed inset-0 bg-black/95 z-[100] hidden items-center justify-center p-4 backdrop-blur-xl">
    <div class="relative max-w-5xl w-full">
        <button id="close-lightbox" class="absolute -top-16 right-0 text-white text-3xl hover:text-orange-600 transition-colors">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="bg-gray-950 rounded-3xl overflow-hidden border border-gray-900 shadow-3xl">
            <img id="lightbox-image" src="" alt="" class="w-full h-auto max-h-[75vh] object-contain">
            <div class="p-8 text-center bg-black/50 backdrop-blur-md">
                <h3 id="lightbox-title" class="text-2xl font-bold text-white mb-2"></h3>
                <p id="lightbox-desc" class="text-gray-400"></p>
            </div>
        </div>
    </div>
    <div id="lightbox-background" class="absolute inset-0 -z-10"></div>
</div>

<?php include 'includes/footer.php'; ?>