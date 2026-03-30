<?php
require_once '../includes/functions.php';

// Handle Featured Toggle
if (isset($_GET['toggle_featured'])) {
    $id = $_GET['toggle_featured'];
    $stmt = $pdo->prepare("UPDATE products SET featured = 1 - featured WHERE id = ?");
    if ($stmt->execute([$id])) {
        // Redirect to clean URL
        $search = $_GET['search'] ?? '';
        $cat_filter = $_GET['cat_id'] ?? '';
        header('Location: ' . $_SERVER['PHP_SELF'] . ($search ? "?search=$search" : "") . ($cat_filter ? (strpos($_SERVER['PHP_SELF'], '?') ? "&" : "?") . "cat_id=$cat_filter" : ""));
        exit;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$id])) {
        $success_message = "Product deleted successfully!";
        // Redirect to clean URL after delete
        $search = $_GET['search'] ?? '';
        $cat_filter = $_GET['cat_id'] ?? '';
        header('Location: ' . $_SERVER['PHP_SELF'] . ($search ? "?search=$search" : "") . ($cat_filter ? (strpos($_SERVER['PHP_SELF'], '?') ? "&" : "?") . "cat_id=$cat_filter" : ""));
        exit;
    }
}

$page_title = 'Product Management';
require_once '../includes/header.php';

// Handle Add/Edit Product
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_product'])) {
    $name = sanitizeInput($_POST['name'] ?? '');
    $category_id = $_POST['category_id'] ?? 0;
    $slug = !empty($_POST['slug']) ? slugGenerate($_POST['slug']) : slugGenerate($name);
    $tagline = sanitizeInput($_POST['tagline'] ?? '');
    $tag = sanitizeInput($_POST['tag'] ?? '');
    $price = sanitizeInput($_POST['price'] ?? '');
    $availability = $_POST['availability'] ?? 'In Stock';
    $lead_time = sanitizeInput($_POST['lead_time'] ?? '');
    $description = sanitizeInput($_POST['description'] ?? '');
    $features = sanitizeInput($_POST['features'] ?? '');
    $applications = sanitizeInput($_POST['applications'] ?? '');
    $benefits = sanitizeInput($_POST['benefits'] ?? '');
    $specifications = sanitizeInput($_POST['specifications'] ?? '');
    $gallery = sanitizeInput($_POST['gallery'] ?? '');
    $seo_title = sanitizeInput($_POST['seo_title'] ?? '');
    $seo_description = sanitizeInput($_POST['seo_description'] ?? '');
    $meta_keywords = sanitizeInput($_POST['meta_keywords'] ?? '');
    $status = $_POST['status'] ?? 'active';
    $featured = isset($_POST['featured']) ? 1 : 0;
    $product_id = $_POST['product_id'] ?? null;
    $image = $_POST['image_path'] ?? ($_POST['current_image'] ?? '');

    // Image Upload is now handled by Media Library AJAX

    if (empty($error_message)) {
        if (slugExists('products', $slug, $product_id)) {
            $error_message = "Error: Slug '$slug' already exists for a product.";
        } else {
            if ($product_id) {
                // Update
                $stmt = $pdo->prepare("UPDATE products SET category_id = ?, name = ?, slug = ?, tagline = ?, tag = ?, price = ?, availability = ?, lead_time = ?, description = ?, features = ?, applications = ?, benefits = ?, specifications = ?, image = ?, gallery = ?, seo_title = ?, seo_description = ?, meta_keywords = ?, status = ?, featured = ? WHERE id = ?");
                $params = [$category_id, $name, $slug, $tagline, $tag, $price, $availability, $lead_time, $description, $features, $applications, $benefits, $specifications, $image, $gallery, $seo_title, $seo_description, $meta_keywords, $status, $featured, $product_id];
                if ($stmt->execute($params)) {
                    $success_message = "Product '$name' updated successfully!";
                }
            } else {
                // Insert
                $stmt = $pdo->prepare("INSERT INTO products (category_id, name, slug, tagline, tag, price, availability, lead_time, description, features, applications, benefits, specifications, image, gallery, seo_title, seo_description, meta_keywords, status, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $params = [$category_id, $name, $slug, $tagline, $tag, $price, $availability, $lead_time, $description, $features, $applications, $benefits, $specifications, $image, $gallery, $seo_title, $seo_description, $meta_keywords, $status, $featured];
                if ($stmt->execute($params)) {
                    $success_message = "Product '$name' added successfully!";
                }
            }
        }
    }
}

// Get Product for Editing
$edit_prod = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_prod = $stmt->fetch();
}

// Fetch Leaf Categories for Dropdown
$leaf_categories = getLeafCategories();

// Fetch Products for List
$search = $_GET['search'] ?? '';
$cat_filter = $_GET['cat_id'] ?? '';

$sql = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id";
$where = [];
$params = [];

if ($search) {
    $where[] = "p.name LIKE ?";
    $params[] = "%$search%";
}
if ($cat_filter) {
    $where[] = "p.category_id = ?";
    $params[] = $cat_filter;
}

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY p.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-heading font-bold">Product <span class="text-orange-600">Management</span></h1>
            <p class="text-sm text-gray-400">Manage your industrial machines, specifications, and SEO metadata.</p>
        </div>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add" class="bg-orange-600/10 hover:bg-orange-600 border border-orange-600/30 text-orange-500 hover:text-white font-bold py-2 px-6 rounded-lg transition-all shadow-md active:scale-95 flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </div>

    <!-- Stats & Filters -->
    <div class="flex flex-col lg:flex-row gap-6 mb-8">
        <form method="GET" class="flex-1 flex gap-2">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                <input type="text" name="search" value="<?php echo h($search); ?>" placeholder="Search machines..." 
                    class="w-full bg-gray-900 border border-gray-800 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-orange-600 transition-all">
            </div>
            <select name="cat_id" class="bg-gray-900 border border-gray-800 rounded-xl py-3 px-6 text-white focus:outline-none focus:border-orange-600 transition-all">
                <option value="">All Categories</option>
                <?php foreach ($leaf_categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo $cat_filter == $cat['id'] ? 'selected' : ''; ?>>
                        <?php echo $cat['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-6 rounded-xl font-bold">Filter</button>
        </form>
    </div>

    <?php if ($success_message): ?>
    <div class="bg-green-500/10 border border-green-500/50 text-green-500 text-sm p-4 rounded-xl flex items-center animate-pulse">
        <i class="fas fa-check-circle mr-3"></i>
        <?php echo $success_message; ?>
    </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
    <div class="bg-red-500/10 border border-red-500/50 text-red-500 text-sm p-4 rounded-xl flex items-center">
        <i class="fas fa-exclamation-triangle mr-3"></i>
        <?php echo $error_message; ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['action']) || $edit_prod): ?>
    <!-- Add/Edit Form -->
    <div class="card p-8 border border-orange-600/30 shadow-2xl shadow-orange-600/10 bg-gray-900/40 backdrop-blur-xl">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-10 gap-6">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 bg-orange-600/10 rounded-2xl flex items-center justify-center text-orange-600 border border-orange-600/20">
                    <i class="fas fa-<?php echo $edit_prod ? 'edit' : 'plus-circle'; ?> text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-white"><?php echo $edit_prod ? 'Edit Machine Details' : 'Add New Machine'; ?></h3>
                    <p class="text-gray-500 text-sm">Configure your product's dynamic content and technical data</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <?php if ($edit_prod): ?>
                <a href="../../product-detail.php?product=<?php echo $edit_prod['slug']; ?>" target="_blank" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all flex items-center shadow-lg shadow-blue-600/20">
                    <i class="fas fa-external-link-alt mr-2"></i> View Live
                </a>
                <?php endif; ?>
                <a href="index.php" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-6 py-3 rounded-xl text-sm font-bold transition-all">
                    <i class="fas fa-times mr-2"></i> Close
                </a>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-12 gap-10">
            <?php if ($edit_prod): ?>
                <input type="hidden" name="product_id" value="<?php echo $edit_prod['id']; ?>">
                <input type="hidden" name="current_image" value="<?php echo $edit_prod['image']; ?>">
            <?php endif; ?>

            <!-- Main Content Column -->
            <div class="md:col-span-8 space-y-12">
                
                <!-- Section: Identity -->
                <div class="space-y-6">
                    <h4 class="text-orange-600 text-xs font-black uppercase tracking-[0.2em] flex items-center">
                        <span class="w-8 h-[2px] bg-orange-600/30 mr-3"></span>
                        Machine Identity
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Machine Name</label>
                            <input type="text" name="name" value="<?php echo $edit_prod['name'] ?? ''; ?>" required placeholder="e.g. BOPP Tape Slitter"
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600/50 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Category</label>
                            <select name="category_id" required class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white focus:outline-none focus:border-orange-600 transition-all appearance-none cursor-pointer">
                                <option value="">Select Category</option>
                                <?php foreach ($leaf_categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>" <?php echo (isset($edit_prod['category_id']) && $edit_prod['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                        <?php echo $cat['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Premium Tagline</label>
                        <input type="text" name="tagline" value="<?php echo $edit_prod['tagline'] ?? ''; ?>" placeholder="Precision Engineering for High-Performance Production"
                            class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600/50 transition-all font-medium">
                    </div>
                </div>

                <!-- Section: Commercial -->
                <div class="space-y-6">
                    <h4 class="text-orange-600 text-xs font-black uppercase tracking-[0.2em] flex items-center">
                        <span class="w-8 h-[2px] bg-orange-600/30 mr-3"></span>
                        Commercial Details
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">Tag/Label</label>
                            <input type="text" name="tag" value="<?php echo $edit_prod['tag'] ?? ''; ?>" placeholder="Cutting Systems"
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-3 px-4 text-white text-sm focus:border-orange-600 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">Price Info</label>
                            <input type="text" name="price" value="<?php echo $edit_prod['price'] ?? 'Contact for Price'; ?>" 
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-3 px-4 text-white text-sm focus:border-orange-600 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">Availability</label>
                            <select name="availability" class="w-full bg-white/5 border border-gray-800 rounded-xl py-3 px-4 text-white text-sm focus:border-orange-600 transition-all">
                                <option value="In Stock" <?php echo ($edit_prod['availability'] ?? '') == 'In Stock' ? 'selected' : ''; ?>>In Stock</option>
                                <option value="Out of Stock" <?php echo ($edit_prod['availability'] ?? '') == 'Out of Stock' ? 'selected' : ''; ?>>Out of Stock</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">Lead Time</label>
                            <input type="text" name="lead_time" value="<?php echo $edit_prod['lead_time'] ?? '4-6 Weeks'; ?>" 
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-3 px-4 text-white text-sm focus:border-orange-600 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-1">Featured</label>
                            <label class="flex items-center space-x-3 cursor-pointer p-3 bg-white/5 rounded-xl border border-gray-800 hover:border-orange-600/50 transition-all">
                                <input type="checkbox" name="featured" value="1" <?php echo (isset($edit_prod['featured']) && $edit_prod['featured']) ? 'checked' : ''; ?> 
                                    class="w-5 h-5 text-orange-600 bg-black border-gray-700 rounded focus:ring-orange-600">
                                <span class="text-xs text-gray-400">Homepage</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section: Content -->
                <div class="space-y-8 bg-black/20 p-8 rounded-2xl border border-gray-800">
                    <h4 class="text-orange-600 text-xs font-black uppercase tracking-[0.2em] flex items-center mb-8">
                        <i class="fas fa-file-alt mr-3"></i>
                        Industrial Documentation
                    </h4>
                    
                    <div class="space-y-4">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Professional Overview (HTML supported)</label>
                        <textarea name="description" rows="6" placeholder="Describe the machine's core engineering principles and production advantages..."
                            class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white focus:border-orange-600 transition-all leading-relaxed"><?php echo $edit_prod['description'] ?? ''; ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Machine Features</label>
                                <span class="bg-orange-600/10 text-orange-500 px-2 py-1 rounded text-[9px] font-mono">ONE PER LINE</span>
                            </div>
                            <textarea name="features" rows="10" placeholder="Precision Tension Control&#10;High-Speed Steel Blades&#10;Automatic Web Guiding" 
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white font-mono text-xs focus:border-orange-600 transition-all"><?php echo $edit_prod['features'] ?? ''; ?></textarea>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Technical Specifications</label>
                                <span class="bg-blue-600/10 text-blue-500 px-2 py-1 rounded text-[9px] font-mono">LABEL: VALUE</span>
                            </div>
                            <textarea name="specifications" rows="10" placeholder="Production Speed: 200 m/min&#10;Main Motor: 7.5 HP&#10;Power Supply: 415V 3-Phase" 
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white font-mono text-xs focus:border-orange-600 transition-all"><?php echo $edit_prod['specifications'] ?? ''; ?></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Ideal Applications</label>
                                <span class="text-[9px] text-gray-600 font-mono italic">Substrates/Industries</span>
                            </div>
                            <textarea name="applications" rows="5" placeholder="BOPP Packaging Tape&#10;Polyester Film Converting&#10;Flexible Packaging" 
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white text-sm focus:border-orange-600 transition-all font-mono"><?php echo $edit_prod['applications'] ?? ''; ?></textarea>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Operational Benefits</label>
                                <span class="text-[9px] text-gray-600 font-mono italic">Value Propositions</span>
                            </div>
                            <textarea name="benefits" rows="5" placeholder="Minimal Core Slippage&#10;Energy Efficient Operation&#10;Reduced Material Scrapping" 
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white text-sm focus:border-orange-600 transition-all font-mono"><?php echo $edit_prod['benefits'] ?? ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Section: SEO -->
                <div class="space-y-6 pt-8 border-t border-gray-800">
                    <h4 class="text-orange-600 text-xs font-black uppercase tracking-[0.2em] flex items-center">
                        <span class="w-8 h-[2px] bg-orange-600/30 mr-3"></span>
                        Search Engine Optimization
                    </h4>
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Meta Title</label>
                            <input type="text" name="seo_title" value="<?php echo $edit_prod['seo_title'] ?? ''; ?>" placeholder="SEO Optimized Title"
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white focus:outline-none focus:border-orange-600 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Meta Description</label>
                            <textarea name="seo_description" rows="3" placeholder="Brief description for search engines..."
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white focus:border-orange-600 transition-all"><?php echo $edit_prod['seo_description'] ?? ''; ?></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="<?php echo $edit_prod['meta_keywords'] ?? ''; ?>" placeholder="Keyword 1, Keyword 2, Keyword 3"
                                class="w-full bg-white/5 border border-gray-800 rounded-xl py-4 px-5 text-white focus:outline-none focus:border-orange-600 transition-all">
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-800 flex justify-end space-x-4">
                    <button type="reset" class="px-8 py-4 rounded-xl text-gray-400 font-bold hover:text-white transition-all">Reset Changes</button>
                    <button type="submit" name="save_product" class="bg-orange-600 hover:bg-orange-700 text-white px-12 py-4 rounded-xl font-black uppercase tracking-widest shadow-xl shadow-orange-600/20 transition-all transform hover:-translate-y-1">
                        <?php echo $edit_prod ? 'Update Machine' : 'Create Machine'; ?>
                    </button>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="md:col-span-4 space-y-8">
                <div class="space-y-6">
                    <h4 class="text-orange-600 text-xs font-black uppercase tracking-[0.2em] flex items-center">
                        <span class="w-8 h-[2px] bg-orange-600/30 mr-3"></span>
                        Visual Media
                    </h4>
                    
                    <div class="space-y-4">
                        <input type="hidden" name="image_path" id="product_image_path" value="<?php echo $edit_prod['image'] ?? ''; ?>">
                        
                        <div id="image_preview_container" class="bg-white/5 border-2 border-dashed border-gray-800 rounded-2xl p-6 text-center group hover:border-orange-600/50 transition-all cursor-pointer" onclick="openProductMediaPicker()">
                            <?php if (isset($edit_prod['image']) && $edit_prod['image']): ?>
                                <img src="../../<?php echo $edit_prod['image']; ?>" id="product_image_preview" class="w-full h-48 object-contain rounded-xl bg-white/5 p-4 mb-4">
                                <p class="text-xs text-gray-500">Click to change machine image</p>
                            <?php else: ?>
                                <div id="no_image_placeholder" class="py-10">
                                    <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-600 group-hover:text-orange-600 transition-colors">
                                        <i class="fas fa-image text-2xl"></i>
                                    </div>
                                    <p class="text-sm font-bold text-gray-400">No Image Selected</p>
                                    <p class="text-[10px] text-gray-600 mt-1">Click to browse library</p>
                                </div>
                                <img src="" id="product_image_preview" class="hidden w-full h-48 object-contain rounded-xl bg-white/5 p-4 mb-4 text-center">
                            <?php endif; ?>
                        </div>

                        <button type="button" onclick="openProductMediaPicker()" class="w-full py-4 bg-gray-800 hover:bg-gray-700 text-white rounded-xl text-xs font-bold uppercase tracking-widest transition-all">
                            <i class="fas fa-photo-video mr-2"></i> Select From Media Library
                        </button>
                    </div>
                </div>

                <div class="space-y-6 pt-8 border-t border-gray-800">
                    <h4 class="text-orange-600 text-xs font-black uppercase tracking-[0.2em] flex items-center">
                        <span class="w-8 h-[2px] bg-orange-600/30 mr-3"></span>
                        Product Gallery
                    </h4>
                    
                    <div class="space-y-4">
                        <input type="hidden" name="gallery" id="product_gallery_input" value="<?php echo $edit_prod['gallery'] ?? ''; ?>">
                        
                        <div id="gallery_preview_container" class="grid grid-cols-2 gap-4">
                            <!-- Thumbnails injected by JS -->
                            <?php 
                            $gallery_items = !empty($edit_prod['gallery']) ? explode(',', $edit_prod['gallery']) : [];
                            foreach ($gallery_items as $idx => $g_path): 
                            ?>
                            <div class="gallery-item-wrapper relative group/gallery bg-white/5 rounded-xl border border-gray-800 p-2 overflow-hidden" data-path="<?php echo h($g_path); ?>">
                                <img src="../../<?php echo h($g_path); ?>" class="w-full h-24 object-cover rounded-lg">
                                <button type="button" onclick="removeFromGallery('<?php echo h($g_path); ?>', this)" 
                                    class="absolute top-2 right-2 w-7 h-7 bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover/gallery:opacity-100 transition-all shadow-xl hover:bg-red-700">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" onclick="openGalleryPicker()" class="w-full py-4 bg-gray-900 border border-orange-600/30 hover:border-orange-600 text-gray-400 hover:text-white rounded-xl text-xs font-bold uppercase tracking-widest transition-all">
                            <i class="fas fa-images mr-2 text-orange-600"></i> Manage Gallery
                        </button>
                        <p class="text-[10px] text-gray-600 text-center uppercase tracking-widest">Selected images will appear on the machine detail page</p>
                    </div>
                </div>

                <script>
                function openProductMediaPicker() {
                    MediaManager.open({ multiple: false }, function(item) {
                        const path = item.file_path;
                        document.getElementById('product_image_path').value = path;
                        
                        const container = document.getElementById('image_preview_container');
                        container.innerHTML = `
                            <img src="../../${path}" id="product_image_preview" class="w-full h-48 object-contain rounded-xl bg-white/5 p-4 mb-4">
                            <p class="text-xs text-gray-500">Click to change machine image</p>
                        `;
                    });
                }

                function openGalleryPicker() {
                    MediaManager.open({ multiple: true }, function(items) {
                        const selection = Array.isArray(items) ? items : [items];
                        const galleryInput = document.getElementById('product_gallery_input');
                        let currentGallery = galleryInput.value ? galleryInput.value.split(',') : [];
                        
                        selection.forEach(item => {
                            if (!currentGallery.includes(item.path)) {
                                currentGallery.push(item.path);
                            }
                        });
                        
                        galleryInput.value = currentGallery.join(',');
                        renderGalleryPreview(currentGallery);
                    });
                }

                function removeFromGallery(path, el) {
                    const galleryInput = document.getElementById('product_gallery_input');
                    let currentGallery = galleryInput.value.split(',');
                    currentGallery = currentGallery.filter(p => p !== path);
                    galleryInput.value = currentGallery.join(',');
                    el.closest('.gallery-item-wrapper').remove();
                }

                function renderGalleryPreview(gallery) {
                    const container = document.getElementById('gallery_preview_container');
                    container.innerHTML = gallery.map(path => `
                        <div class="gallery-item-wrapper relative group/gallery bg-white/5 rounded-xl border border-gray-800 p-2 overflow-hidden" data-path="${path}">
                            <img src="../../${path}" class="w-full h-24 object-cover rounded-lg">
                            <button type="button" onclick="removeFromGallery('${path}', this)" 
                                class="absolute top-2 right-2 w-7 h-7 bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover/gallery:opacity-100 transition-all shadow-xl hover:bg-red-700">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    `).join('');
                }
                </script>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <!-- Product Table -->
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-900/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Machine</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Featured</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Category</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">No products found matching your criteria.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $prod): ?>
                            <tr class="hover:bg-gray-800/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-white/5 rounded-lg overflow-hidden flex items-center justify-center p-2">
                                            <?php if ($prod['image']): ?>
                                                <img src="../../<?php echo $prod['image']; ?>" class="w-full h-full object-contain">
                                            <?php else: ?>
                                                <i class="fas fa-cog text-gray-700"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="font-bold text-white group-hover:text-orange-600 transition-colors"><?php echo $prod['name']; ?></div>
                                            <div class="text-[10px] text-gray-500 font-mono"><?php echo $prod['slug']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="?toggle_featured=<?php echo $prod['id']; ?>" class="inline-block transition-all hover:scale-125">
                                        <?php if ($prod['featured']): ?>
                                            <i class="fas fa-star text-orange-500 text-lg drop-shadow-[0_0_8px_rgba(249,115,22,0.4)]"></i>
                                        <?php else: ?>
                                            <i class="far fa-star text-gray-700 hover:text-orange-500/50 text-lg"></i>
                                        <?php endif; ?>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs bg-gray-900 text-gray-400 px-3 py-1 rounded-lg border border-gray-800">
                                        <?php echo $prod['category_name']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?php echo $prod['status'] == 'active' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'; ?>">
                                        <?php echo $prod['status']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="../../product-detail.php?product=<?php echo $prod['slug']; ?>" target="_blank" 
                                            class="w-8 h-8 bg-blue-600/10 flex items-center justify-center text-blue-500 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="View on Site">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <a href="?edit=<?php echo $prod['id']; ?>" class="w-8 h-8 bg-orange-600/10 flex items-center justify-center text-orange-600 rounded-lg hover:bg-orange-600 hover:text-white transition-all">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <a href="?delete=<?php echo $prod['id']; ?>" onclick="return confirm('Archive this machine?')" class="w-8 h-8 bg-red-600/10 flex items-center justify-center text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
