<?php
require_once 'admin/includes/functions.php';
?>

<?php
$cat_slug = isset($_GET['category']) ? $_GET['category'] : null;
$level = 1; // 1: Main Categories, 2: Products
$items = [];
$page_title = "Products | VIVA ENGINEERING Solutions";
$page_heading = "Our Product Range";
$page_subheading = "Discover our comprehensive range of precision-engineered industrial machinery designed to elevate your manufacturing capabilities.";
$breadcrumb = [['name' => 'Home', 'url' => 'index.php'], ['name' => 'Products', 'url' => 'products.php']];

// Fetch Data dynamically
if ($cat_slug) {
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ? AND status = 'active'");
    $stmt->execute([$cat_slug]);
    $category = $stmt->fetch();

    if ($category) {
        $breadcrumb[] = ['name' => $category['name'], 'url' => "products.php?category=$cat_slug"];
        $page_title = !empty($category['seo_title']) ? $category['seo_title'] : $category['name'] . " | VIVA ENGINEERING";
        $meta_description = $category['seo_description'] ?? '';
        $meta_keywords = $category['meta_keywords'] ?? '';
        $page_heading = $category['name'];
        
        // Check if this category has subcategories
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE parent_id = ? AND status = 'active' ORDER BY name ASC");
        $stmt->execute([$category['id']]);
        $subcategories = $stmt->fetchAll();

        if ($subcategories) {
            $level = 1; 
            $items = $subcategories;
        } else {
            $level = 2; 
            $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? AND status = 'active' ORDER BY name ASC");
            $stmt->execute([$category['id']]);
            $items = $stmt->fetchAll();
        }
    }
} else {
    $stmt = $pdo->query("SELECT * FROM categories WHERE parent_id IS NULL AND status = 'active' ORDER BY name ASC");
    $items = $stmt->fetchAll();
    $level = 1;
}

include 'includes/header.php'; 
?>

<style>
    /* Products Page - Clean, Proper Layout */
    .products-hero {
        padding-top: 100px;
        padding-bottom: 40px;
        background: linear-gradient(to bottom, #000 0%, #0a0a0a 100%);
        position: relative;
        overflow: hidden;
    }
    .products-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255,87,34,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,87,34,0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.5;
    }

    /* Breadcrumb */
    .products-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }
    .products-breadcrumb a {
        color: #6b7280;
        text-decoration: none;
        transition: color 0.3s;
    }
    .products-breadcrumb a:hover { color: #FF5722; }
    .products-breadcrumb .separator { color: #374151; }
    .products-breadcrumb .current { color: #FF5722; font-weight: 600; }

    /* Product Card - Compact & Clean */
    .product-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: #111;
        border: 1px solid rgba(255,255,255,0.06);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    .product-card:hover {
        transform: translateY(-6px);
        border-color: rgba(255,87,34,0.4);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 20px rgba(255,87,34,0.08);
    }

    .product-card .card-img-wrap {
        position: relative;
        width: 100%;
        padding-top: 75%; /* 4:3 aspect ratio */
        overflow: hidden;
    }
    .product-card .card-img-wrap img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.19, 1, 0.22, 1), filter 0.5s;
        filter: brightness(0.85);
    }
    .product-card:hover .card-img-wrap img {
        transform: scale(1.1);
        filter: brightness(0.6);
    }
    .product-card .card-img-wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.1) 60%, transparent 100%);
        pointer-events: none;
    }

    /* Badge on image */
    .product-card .card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 5;
        padding: 4px 10px;
        background: #FF5722;
        color: white;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 4px;
    }

    /* Card body */
    .product-card .card-body {
        padding: 16px 18px 18px;
    }
    .product-card .card-title {
        font-size: 15px;
        font-weight: 700;
        color: white;
        margin-bottom: 6px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s;
    }
    .product-card:hover .card-title { color: #FF5722; }

    .product-card .card-desc {
        font-size: 12px;
        color: #6b7280;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .product-card .card-action {
        display: flex;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        color: #FF5722;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
    }
    .product-card .card-action i {
        margin-left: 6px;
        transition: transform 0.3s;
    }
    .product-card:hover .card-action i {
        transform: translateX(4px);
    }

    /* Results count */
    .results-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .results-count {
        font-size: 13px;
        color: #6b7280;
    }
    .results-count span { color: white; font-weight: 600; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #111;
        border: 1px dashed #333;
        border-radius: 16px;
    }
</style>

<!-- Hero Section -->
<section class="products-hero">
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="products-breadcrumb">
            <?php foreach ($breadcrumb as $i => $crumb): ?>
                <?php if ($i < count($breadcrumb) - 1): ?>
                    <a href="<?php echo $crumb['url']; ?>"><?php echo h($crumb['name']); ?></a>
                    <span class="separator"><i class="fas fa-chevron-right text-[10px]"></i></span>
                <?php else: ?>
                    <span class="current"><?php echo h($crumb['name']); ?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>

        <!-- Badge -->
        <div class="inline-flex items-center space-x-2 bg-orange-600/10 border border-orange-600/30 px-4 py-1.5 rounded-full mb-4">
            <span class="w-1.5 h-1.5 bg-orange-600 rounded-full animate-pulse"></span>
            <span class="text-[10px] font-bold text-orange-600 uppercase tracking-widest"><?php echo $level == 1 ? 'Product Categories' : 'Machines'; ?></span>
        </div>
        
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3 leading-tight">
            <?php if ($level == 1 && !$cat_slug): ?>
                Our Product <span class="text-orange-600">Range</span>
            <?php else: ?>
                <?php echo htmlspecialchars($page_heading); ?>
            <?php endif; ?>
        </h1>
        
        <p class="text-sm md:text-base text-gray-500 max-w-2xl leading-relaxed">
            <?php echo htmlspecialchars($page_subheading); ?>
        </p>
    </div>
</section>

<!-- Products Grid Section -->
<section id="products-grid" class="py-10 bg-black min-h-[40vh]">
    <div class="container mx-auto px-4 lg:px-8">
        
        <!-- Results bar -->
        <div class="results-bar">
            <div class="results-count">
                Showing <span><?php echo count($items); ?></span> <?php echo $level == 1 ? 'categories' : 'products'; ?>
            </div>
            <?php if ($cat_slug && isset($category) && is_array($category) && !empty($category['parent_id'])): ?>
                <?php 
                    $parent = $pdo->prepare("SELECT slug, name FROM categories WHERE id = ?");
                    $parent->execute([$category['parent_id']]);
                    $parentCat = $parent->fetch();
                ?>
                <?php if ($parentCat): ?>
                <a href="products.php?category=<?php echo h($parentCat['slug']); ?>" class="text-sm text-gray-500 hover:text-orange-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to <?php echo h($parentCat['name']); ?>
                </a>
                <?php endif; ?>
            <?php elseif ($cat_slug): ?>
                <a href="products.php" class="text-sm text-gray-500 hover:text-orange-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>All Categories
                </a>
            <?php endif; ?>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-5">
            <?php
            $index = 0;
            foreach ($items as $item):
                $is_cat = ($level == 1);
                $link = $is_cat ? "products.php?category=" . h($item['slug']) : "product-detail.php?product=" . h($item['slug']);
                $badge = $is_cat ? 'Category' : 'Machine';
                $image = !empty($item['image']) ? h($item['image']) : 'v.jpeg';
                $desc = !empty($item['description']) ? h($item['description']) : ($is_cat ? 'Explore our range of industrial solutions.' : 'Precision-engineered industrial machinery.');
            ?>
            <a href="<?php echo $link; ?>" class="product-card" data-aos="fade-up" data-aos-delay="<?php echo ($index % 6) * 50; ?>">
                <div class="card-img-wrap">
                    <img src="<?php echo $image; ?>" alt="<?php echo h($item['name']); ?>" loading="lazy">
                    <span class="card-badge"><?php echo $badge; ?></span>
                </div>
                <div class="card-body">
                    <h3 class="card-title"><?php echo h($item['name']); ?></h3>
                    <p class="card-desc"><?php echo $desc; ?></p>
                    <div class="card-action">
                        <?php echo $is_cat ? 'Explore' : 'View Details'; ?>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
            <?php 
            $index++;
            endforeach; 
            ?>
        </div>
        
        <?php if (empty($items)): ?>
        <div class="empty-state">
            <i class="fas fa-box-open text-5xl text-gray-700 mb-4"></i>
            <h3 class="text-xl font-bold text-white mb-2">No Products Found</h3>
            <p class="text-gray-400 text-sm mb-6">We couldn't find any products in this category.</p>
            <a href="products.php" class="btn-premium">View All Categories</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-orange-600 to-orange-700 relative overflow-hidden">
    <div class="absolute inset-0 flex items-center justify-center opacity-10">
        <i class="fas fa-cogs text-[300px] animate-gear-rotate"></i>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">Need a Custom Engineering Solution?</h2>
        <p class="text-white/80 text-base max-w-xl mx-auto mb-8 leading-relaxed">
            Our experts are ready to design machinery tailored to your manufacturing requirements.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="contact.php" class="px-8 py-3 bg-black text-white font-bold uppercase text-sm rounded-lg hover:bg-gray-900 transition-all shadow-xl hover:-translate-y-1">
                Request a Quote <i class="fas fa-paper-plane ml-2"></i>
            </a>
            <a href="tel:<?php echo str_replace(' ', '', get_setting('contact_phone')); ?>" class="px-8 py-3 border-2 border-white text-white font-bold uppercase text-sm rounded-lg hover:bg-white hover:text-orange-600 transition-all shadow-xl hover:-translate-y-1">
                Call Our Experts <i class="fas fa-phone ml-2"></i>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>