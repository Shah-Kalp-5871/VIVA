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
        header('Location: ' . route('products') . ($search ? "?search=$search" : "") . ($cat_filter ? (strpos(route('products'), '?') ? "&" : "?") . "cat_id=$cat_filter" : ""));
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
        header('Location: ' . route('products') . ($search ? "?search=$search" : "") . ($cat_filter ? (strpos(route('products'), '?') ? "&" : "?") . "cat_id=$cat_filter" : ""));
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
    
    $seo_title = sanitizeInput($_POST['seo_title'] ?? '');
    $seo_description = sanitizeInput($_POST['seo_description'] ?? '');
    $meta_keywords = sanitizeInput($_POST['meta_keywords'] ?? '');
    $status = $_POST['status'] ?? 'active';
    $featured = isset($_POST['featured']) ? 1 : 0;
    $product_id = $_POST['product_id'] ?? null;

    // Media Library Integration (JSON & Paths)
    $gallery_images = $_POST['gallery_images'] ?? ''; // Accept JSON string directly
    $featured_image = $_POST['featured_image'] ?? ($_POST['current_image'] ?? null);

        if (empty($error_message)) {
            if (slugExists('products', $slug, $product_id)) {
                $error_message = "Error: Slug '$slug' already exists for a product.";
            } else {
                if ($product_id) {
                    // Update using new column names
                    $stmt = $pdo->prepare("UPDATE products SET category_id = ?, name = ?, slug = ?, tagline = ?, tag = ?, price = ?, availability = ?, lead_time = ?, description = ?, features = ?, applications = ?, benefits = ?, specifications = ?, featured_image = ?, gallery_images = ?, seo_title = ?, seo_description = ?, meta_keywords = ?, status = ?, featured = ? WHERE id = ?");
                    $params = [$category_id, $name, $slug, $tagline, $tag, $price, $availability, $lead_time, $description, $features, $applications, $benefits, $specifications, $featured_image, $gallery_images, $seo_title, $seo_description, $meta_keywords, $status, $featured, $product_id];
                    if ($stmt->execute($params)) {
                        $success_message = "Machine '$name' updated successfully!";
                        $edit_prod = null; // Clear edit mode to show list
                    }
                } else {
                    // Insert using new column names
                    $stmt = $pdo->prepare("INSERT INTO products (category_id, name, slug, tagline, tag, price, availability, lead_time, description, features, applications, benefits, specifications, featured_image, gallery_images, seo_title, seo_description, meta_keywords, status, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $params = [$category_id, $name, $slug, $tagline, $tag, $price, $availability, $lead_time, $description, $features, $applications, $benefits, $specifications, $featured_image, $gallery_images, $seo_title, $seo_description, $meta_keywords, $status, $featured];
                    if ($stmt->execute($params)) {
                        $success_message = "Machine '$name' added successfully!";
                    }
            }
        }
    }
}

// Success message from session/redirect
if(isset($_GET['success'])) $success_message = $_GET['success'];

// Get Product for Editing
$edit_prod = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_prod = $stmt->fetch();
}

// Fetch Category Tree for Dropdown
$all_categories = getCategoryTree();

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
        <a href="<?php echo route('products.add'); ?>" class="bg-orange-600/10 hover:bg-orange-600 border border-orange-600/30 text-orange-500 hover:text-white font-bold py-2 px-6 rounded-lg transition-all shadow-md active:scale-95 flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </div>

    <!-- Stats & Filters -->
    <div class="flex flex-col lg:flex-row gap-6 mb-10 p-6 bg-gray-900 border border-gray-800 rounded-2xl shadow-xl">
        <form method="GET" class="flex-1 flex flex-col md:flex-row gap-4">
            <div class="relative flex-1 group">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-orange-600 transition-colors"></i>
                <input type="text" name="search" value="<?php echo h($search); ?>" placeholder="Search machines..." 
                    class="w-full bg-black border border-gray-800 rounded-xl py-3.5 pl-12 pr-4 text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600/50 transition-all">
            </div>
            <select name="cat_id" class="md:w-64 bg-black border border-gray-800 rounded-xl py-3.5 px-6 text-white focus:outline-none focus:border-orange-600 transition-all cursor-pointer">
                <option value="">All Categories</option>
                <?php foreach ($all_categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo $cat_filter == $cat['id'] ? 'selected' : ''; ?>>
                        <?php echo h($cat['display_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3.5 rounded-xl font-bold transition-all shadow-lg shadow-orange-600/20 active:scale-95">
                <i class="fas fa-filter mr-2"></i> Apply Filter
            </button>
            <?php if ($search || $cat_filter): ?>
                <a href="<?php echo route('products'); ?>" class="flex items-center justify-center bg-gray-800 hover:bg-gray-700 text-gray-400 hover:text-white px-6 py-3.5 rounded-xl transition-all">
                    Reset
                </a>
            <?php endif; ?>
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
                <a href="<?php echo route('site.product', ['slug' => $edit_prod['slug']]); ?>" target="_blank" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all flex items-center shadow-lg shadow-blue-600/20">
                    <i class="fas fa-external-link-alt mr-2"></i> View Live
                </a>
<?php endif; ?>
                <a href="<?php echo route('products'); ?>" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-6 py-3 rounded-xl text-sm font-bold transition-all">
                    <i class="fas fa-times mr-2"></i> Close
                </a>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-12 gap-10">
            <?php if ($edit_prod): ?>
                <input type="hidden" name="product_id" value="<?php echo $edit_prod['id']; ?>">
                <input type="hidden" name="current_image" value="<?php echo $edit_prod['featured_image'] ?? ''; ?>">
            <?php endif; ?>

            <!-- Main Content Column -->
            <div class="md:col-span-8 space-y-12">
                
                <!-- Section: Identity -->
                <div class="space-y-8 bg-black/40 p-10 rounded-3xl border border-gray-800 hover:border-gray-700 transition-all shadow-inner shadow-black/50">
                    <h4 class="text-orange-500 text-xs font-black uppercase tracking-[0.3em] flex items-center">
                        <span class="w-12 h-[2px] bg-orange-600/50 mr-4"></span>
                        Machine Identity
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Proprietary Name <span class="text-orange-600">*</span></label>
                            <input type="text" name="name" value="<?php echo $edit_prod['name'] ?? ''; ?>" required placeholder="e.g. ULTRA-TECH SLITTER SERIES"
                                class="w-full bg-black border border-gray-800 rounded-2xl py-4 px-6 text-lg font-bold text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600/50 transition-all placeholder:text-gray-700">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Target Category <span class="text-orange-600">*</span></label>
                            <div class="relative group">
                                <select name="category_id" required class="w-full bg-black border border-gray-800 rounded-2xl py-4.5 px-6 text-white focus:outline-none focus:border-orange-600 transition-all appearance-none cursor-pointer">
                                    <option value="">Select Category</option>
                                    <?php foreach ($all_categories as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo (isset($edit_prod['category_id']) && $edit_prod['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                            <?php echo h($cat['display_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fas fa-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none group-focus-within:text-orange-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Professional Tagline</label>
                        <input type="text" name="tagline" value="<?php echo $edit_prod['tagline'] ?? ''; ?>" placeholder="Precision Engineering for High-Performance Production Systems"
                            class="w-full bg-black border border-gray-800 rounded-2xl py-4.5 px-6 text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600/50 transition-all font-medium placeholder:text-gray-700">
                    </div>
                </div>

                <!-- Section: Commercial -->
                <div class="space-y-8 bg-black/40 p-10 rounded-3xl border border-gray-800 hover:border-gray-700 transition-all">
                    <h4 class="text-orange-500 text-xs font-black uppercase tracking-[0.3em] flex items-center">
                        <span class="w-12 h-[2px] bg-orange-600/50 mr-4"></span>
                        Commercial Parameters
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Tag/Badge</label>
                            <input type="text" name="tag" value="<?php echo $edit_prod['tag'] ?? ''; ?>" placeholder="Heavy Duty"
                                class="w-full bg-black border border-gray-800 rounded-2xl py-4 px-5 text-white text-sm focus:border-orange-600 transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Price Control</label>
                            <div class="relative group">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-orange-600 font-black text-xs pointer-events-none transition-opacity uppercase">Contact</span>
                                <input type="text" name="price" value="<?php echo $edit_prod['price'] ?? 'Request Quote'; ?>" 
                                    class="w-full bg-black border border-gray-800 rounded-2xl py-4 pl-20 pr-5 text-white text-sm focus:border-orange-600 transition-all">
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Availability</label>
                            <div class="relative group">
                                <select name="availability" class="w-full bg-black border border-gray-800 rounded-2xl py-4 px-5 text-white text-sm focus:border-orange-600 transition-all appearance-none cursor-pointer">
                                    <option value="In Stock" <?php echo ($edit_prod['availability'] ?? '') == 'In Stock' ? 'selected' : ''; ?>>Active / Ready</option>
                                    <option value="Out of Stock" <?php echo ($edit_prod['availability'] ?? '') == 'Out of Stock' ? 'selected' : ''; ?>>On Backorder</option>
                                </select>
                                <i class="fas fa-caret-down absolute right-5 top-1/2 -translate-y-1/2 text-gray-600"></i>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Lead Time</label>
                            <input type="text" name="lead_time" value="<?php echo $edit_prod['lead_time'] ?? '2-4 Weeks'; ?>" 
                                class="w-full bg-black border border-gray-800 rounded-2xl py-4 px-5 text-white text-sm focus:border-orange-600 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Section: Content -->
                <div class="space-y-8 bg-black/60 p-10 rounded-3xl border border-gray-800 shadow-2xl relative overflow-hidden">
                    <!-- Subtle background glow -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-orange-600/5 blur-[100px] -mr-32 -mt-32"></div>

                    <h4 class="text-orange-500 text-xs font-black uppercase tracking-[0.3em] flex items-center mb-10">
                        <i class="fas fa-file-invoice mr-4 text-orange-600"></i>
                        Industrial Documentation
                    </h4>
                    
                    <div class="space-y-4">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Engineering Overview <span class="text-[9px] text-gray-600 ml-2">(HTML / Rich Text Supported)</span></label>
                        <textarea name="description" rows="8" placeholder="Detailed description of machine capabilities..."
                            class="w-full bg-black/80 border border-gray-800 rounded-2xl py-5 px-6 text-white focus:border-orange-600 transition-all leading-relaxed placeholder:text-gray-800"><?php echo $edit_prod['description'] ?? ''; ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Key Features List</label>
                                <span class="bg-orange-600/10 text-orange-500 px-3 py-1 rounded-full text-[9px] font-black tracking-tighter">ONE PER LINE</span>
                            </div>
                            <textarea name="features" rows="12" placeholder="e.g. PLC Controlled Operation&#10;Automatic Tension Control" 
                                class="w-full bg-black/80 border border-gray-800 rounded-2xl py-5 px-6 text-white font-mono text-xs focus:border-orange-600 transition-all placeholder:text-gray-800"><?php echo $edit_prod['features'] ?? ''; ?></textarea>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Technical Datasheet</label>
                                <span class="bg-blue-600/10 text-blue-500 px-3 py-1 rounded-full text-[9px] font-black tracking-tighter">KEY: VALUE</span>
                            </div>
                            <textarea name="specifications" rows="12" placeholder="Speed: 300mpm&#10;Width: 1300mm" 
                                class="w-full bg-black/80 border border-gray-800 rounded-2xl py-5 px-6 text-white font-mono text-xs focus:border-orange-600 transition-all placeholder:text-gray-800"><?php echo $edit_prod['specifications'] ?? ''; ?></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Core Applications</label>
                            <textarea name="applications" rows="6" placeholder="Flexible Packaging&#10;Label Converting..." 
                                class="w-full bg-black/80 border border-gray-800 rounded-2xl py-5 px-6 text-white text-sm focus:border-orange-600 transition-all font-mono placeholder:text-gray-800"><?php echo $edit_prod['applications'] ?? ''; ?></textarea>
                        </div>
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Machine Advantages</label>
                            <textarea name="benefits" rows="6" placeholder="Low Maintenance&#10;User-Friendly Interface..." 
                                class="w-full bg-black/80 border border-gray-800 rounded-2xl py-5 px-6 text-white text-sm focus:border-orange-600 transition-all font-mono placeholder:text-gray-800"><?php echo $edit_prod['benefits'] ?? ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Section: SEO -->
                <div class="space-y-8 bg-black/40 p-10 rounded-3xl border border-gray-800 shadow-md">
                    <h4 class="text-orange-500 text-xs font-black uppercase tracking-[0.3em] flex items-center">
                        <span class="w-12 h-[2px] bg-orange-600/50 mr-4"></span>
                        Search Optimization (SEO)
                    </h4>
                    <div class="space-y-6">
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Meta Title Tag</label>
                            <input type="text" name="seo_title" value="<?php echo $edit_prod['seo_title'] ?? ''; ?>" placeholder="Control how the product appears in search results"
                                class="w-full bg-black border border-gray-800 rounded-2xl py-4 px-6 text-white focus:outline-none focus:border-orange-600 transition-all">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Meta Description</label>
                            <textarea name="seo_description" rows="4" placeholder="Brief summary for search engines (approx 160 characters)..."
                                class="w-full bg-black border border-gray-800 rounded-2xl py-4 px-6 text-white focus:border-orange-600 transition-all leading-relaxed"><?php echo $edit_prod['seo_description'] ?? ''; ?></textarea>
                        </div>
                        <div class="space-y-3">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest pl-1">Target Keywords</label>
                            <input type="text" name="meta_keywords" value="<?php echo $edit_prod['meta_keywords'] ?? ''; ?>" placeholder="keyword1, keyword2, machine type, etc."
                                class="w-full bg-black border border-gray-800 rounded-2xl py-4 px-6 text-white focus:outline-none focus:border-orange-600 transition-all">
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-gray-800 flex flex-col md:flex-row justify-end space-y-4 md:space-y-0 md:space-x-6">
                    <button type="reset" class="px-8 py-4 rounded-2xl text-gray-500 font-bold hover:text-white hover:bg-white/5 transition-all uppercase tracking-widest text-xs">Reset Form</button>
                    <button type="submit" name="save_product" class="bg-orange-600 hover:bg-orange-700 text-white px-16 py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-2xl shadow-orange-600/30 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                        <?php echo $edit_prod ? 'Update Machine Specs' : 'Initialize New Machine'; ?>
                        <i class="fas fa-check-circle ml-3"></i>
                    </button>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="md:col-span-4 space-y-10">
                <div class="space-y-6 bg-black/40 p-8 rounded-3xl border border-gray-800 shadow-xl">
                    <h4 class="text-orange-500 text-xs font-black uppercase tracking-[0.3em] flex items-center">
                        <i class="fas fa-camera mr-3"></i>
                        Master Visual
                    </h4>
                    
                    <div class="space-y-4">
                        <input type="hidden" name="featured_image" id="product_image_path" value="<?php echo $edit_prod['featured_image'] ?? ''; ?>">
                        
                        <div id="image_preview_container" class="bg-black border-2 border-dashed border-gray-800 rounded-2xl p-6 text-center group hover:border-orange-600/50 transition-all cursor-pointer relative overflow-hidden" onclick="openProductMediaPicker()">
                            <?php if (isset($edit_prod['featured_image']) && $edit_prod['featured_image']): ?>
                                <img src="../../<?php echo $edit_prod['featured_image']; ?>" id="product_image_preview" class="w-full h-48 object-contain rounded-xl bg-gray-950 p-4 mb-4 relative z-10 transition-transform group-hover:scale-105 duration-500">
                                <p class="text-xs text-gray-500 relative z-10">Change Master Image</p>
                                <!-- Glow backdrop -->
                                <div class="absolute inset-0 bg-orange-600/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <?php else: ?>
                                <div id="no_image_placeholder" class="py-10 relative z-10">
                                    <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-700 group-hover:text-orange-600 group-hover:bg-orange-600/10 transition-all duration-500 shadow-inner">
                                        <i class="fas fa-cloud-upload-alt text-3xl"></i>
                                    </div>
                                    <p class="text-sm font-black text-gray-400 uppercase tracking-widest">No Media Set</p>
                                    <p class="text-[10px] text-gray-600 mt-2">Click to select machine visual</p>
                                </div>
                                <img src="" id="product_image_preview" class="hidden w-full h-48 object-contain rounded-xl bg-black p-4 mb-4 text-center">
                            <?php endif; ?>
                        </div>

                        <button type="button" onclick="openProductMediaPicker()" class="w-full py-4.5 bg-orange-600/10 hover:bg-orange-600 border border-orange-600/30 text-orange-500 hover:text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-lg shadow-orange-600/5 active:scale-95">
                            <i class="fas fa-layer-group mr-2"></i> Launch Media Library
                        </button>
                    </div>
                </div>

                <div class="space-y-6 bg-black/40 p-8 rounded-3xl border border-gray-800 shadow-xl">
                    <h4 class="text-orange-500 text-xs font-black uppercase tracking-[0.3em] flex items-center">
                        <i class="fas fa-images mr-3"></i>
                        Feature Gallery
                    </h4>
                    
                    <div class="space-y-6">
                        <input type="hidden" name="gallery_images" id="product_gallery_input" value="<?php echo htmlspecialchars($edit_prod['gallery_images'] ?? '[]'); ?>">
                        
                        <div id="gallery_preview_container" class="grid grid-cols-2 gap-4">
                            <!-- Thumbnails injected by JS -->
                            <?php 
                            $gallery_items = [];
                            if (!empty($edit_prod['gallery_images'])) {
                                $decoded = json_decode($edit_prod['gallery_images'], true);
                                if (is_array($decoded)) $gallery_items = $decoded;
                            }
                            foreach ($gallery_items as $idx => $g_item): 
                            ?>
                            <div class="gallery-item-wrapper relative group/gallery bg-black rounded-xl border border-gray-800 p-2 overflow-hidden" data-id="<?php echo $g_item['id']; ?>">
                                <img src="../../<?php echo h($g_item['path']); ?>" class="w-full h-24 object-cover rounded-lg group-hover/gallery:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/gallery:opacity-100 transition-opacity"></div>
                                <button type="button" onclick="removeFromGallery(<?php echo $g_item['id']; ?>, this)" 
                                    class="absolute top-2 right-2 w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover/gallery:opacity-100 transition-all shadow-xl hover:bg-red-700 active:scale-90">
                                    <i class="fas fa-trash-alt text-[10px]"></i>
                                </button>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" onclick="openGalleryPicker()" class="w-full py-4.5 bg-gray-900 hover:bg-gray-800 border border-gray-800 text-gray-500 hover:text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-md active:scale-95">
                            <i class="fas fa-plus-circle mr-2 text-orange-600"></i> Add Gallery Views
                        </button>
                        <p class="text-[9px] text-gray-600 text-center uppercase tracking-widest leading-loose">Images will be presented in a high-resolution slider on the machine profile</p>
                    </div>
                </div>

                <script>
                function openProductMediaPicker() {
                    let pName = document.querySelector('input[name="name"]').value;
                    let pKey = document.querySelector('input[name="meta_keywords"]').value;

                    openMediaManager({ multiple: false, productName: pName, keyword: pKey }, function(selection) {
                        const item = Array.isArray(selection) ? selection[0] : selection;
                        if(!item) return;

                        const path = item.path;
                        document.getElementById('product_image_path').value = path;
                        
                        const container = document.getElementById('image_preview_container');
                        container.innerHTML = `
                            <img src="../../${path}" id="product_image_preview" class="w-full h-48 object-contain rounded-xl bg-white/5 p-4 mb-4">
                            <p class="text-xs text-gray-500">Click to change machine image</p>
                        `;
                    });
                }

                function openGalleryPicker() {
                    let pName = document.querySelector('input[name="name"]').value;
                    let pKey = document.querySelector('input[name="meta_keywords"]').value;

                    openMediaManager({ multiple: true, productName: pName, keyword: pKey }, function(selection) {
                        const items = Array.isArray(selection) ? selection : [selection];
                        if(items.length === 0) return;

                        const galleryInput = document.getElementById('product_gallery_input');
                        let currentGallery = [];
                        try {
                            const parsed = JSON.parse(galleryInput.value || '[]');
                            if(Array.isArray(parsed)) currentGallery = parsed;
                        } catch(e) { }
                        
                        // Merge logic avoiding duplicates based on ID
                        items.forEach(newItem => {
                            if (!currentGallery.find(g => g.id === newItem.id)) {
                                currentGallery.push({ id: newItem.id, path: newItem.path, alt: newItem.alt });
                            }
                        });
                        
                        galleryInput.value = JSON.stringify(currentGallery);
                        renderGalleryThumbnails(currentGallery);
                    });
                }

                function removeFromGallery(id, btnElement) {
                    const galleryInput = document.getElementById('product_gallery_input');
                    let currentGallery = [];
                    try {
                        currentGallery = JSON.parse(galleryInput.value || '[]');
                    } catch(e) {}
                    
                    // Remove from JSON completely
                    currentGallery = currentGallery.filter(item => item.id !== id);
                    galleryInput.value = JSON.stringify(currentGallery);
                    
                    // Remove from DOM safely
                    btnElement.closest('.gallery-item-wrapper').remove();
                }

                function renderGalleryThumbnails(galleryArray) {
                    const container = document.getElementById('gallery_preview_container');
                    container.innerHTML = galleryArray.map(item => `
                        <div class="gallery-item-wrapper relative group/gallery bg-white/5 rounded-xl border border-gray-800 p-2 overflow-hidden" data-id="${item.id}">
                            <img src="../../${item.path}" class="w-full h-24 object-cover rounded-lg">
                            <button type="button" onclick="removeFromGallery(${item.id}, this)" 
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

    <!-- Product Table Section -->
    <div class="card overflow-hidden border border-gray-800 bg-black shadow-2xl rounded-3xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-900 shadow-sm border-b border-gray-800">
                        <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Machine Portfolio</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] text-center">Featured</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Category</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em]">Operational Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] text-right">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-900">
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-box-open text-4xl mb-4 text-gray-800"></i>
                                    <p class="uppercase tracking-[0.2em] font-black text-xs">No machine portfolio items found</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $prod): ?>
                            <tr class="hover:bg-gray-800/20 transition-all group border-b border-gray-900/50">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-6">
                                        <div class="w-16 h-16 bg-black border border-gray-800 rounded-xl overflow-hidden flex items-center justify-center p-2 group-hover:border-orange-600/30 transition-all shadow-inner shadow-black">
                                            <?php if (!empty($prod['featured_image'])): ?>
                                                <img src="../../<?php echo h($prod['featured_image']); ?>" class="w-full h-full object-contain">
                                            <?php else: ?>
                                                <i class="fas fa-industry text-gray-800 text-xl"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="font-black text-white group-hover:text-orange-600 transition-colors uppercase tracking-tight leading-none text-sm mb-1"><?php echo $prod['name']; ?></div>
                                            <div class="text-[9px] text-gray-600 font-black uppercase tracking-[0.2em]"><?php echo $prod['slug']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <a href="<?php echo route('products.toggle', ['id' => $prod['id']]); ?>" class="inline-block transition-all hover:scale-125">
                                        <?php if ($prod['featured']): ?>
                                            <i class="fas fa-star text-orange-500 text-lg drop-shadow-[0_0_10px_rgba(249,115,22,0.6)]"></i>
                                        <?php else: ?>
                                            <i class="far fa-star text-gray-800 hover:text-orange-600/50 text-lg"></i>
                                        <?php endif; ?>
                                    </a>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-block text-[10px] bg-gray-900/80 text-orange-600/80 px-4 py-2 rounded-xl border border-orange-600/10 font-black uppercase tracking-[0.15em] leading-relaxed max-w-[200px]">
                                        <?php echo str_replace(' ', '<br>', h($prod['category_name'])); ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <?php if ($prod['status'] == 'active'): ?>
                                        <div class="flex items-center space-x-2">
                                            <span class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_8px_#22c55e]"></span>
                                            <span class="text-[10px] font-black text-green-500 uppercase tracking-widest pl-1">Live Portfolio</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="flex items-center space-x-2">
                                            <span class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_8px_#ef4444]"></span>
                                            <span class="text-[10px] font-black text-red-500 uppercase tracking-widest pl-1">Maintenance</span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-end space-x-4">
                                        <a href="<?php echo route('site.product', ['slug' => $prod['slug']]); ?>" target="_blank" 
                                            class="w-10 h-10 flex items-center justify-center bg-gray-900 border border-gray-800 text-gray-500 hover:text-white rounded-xl hover:bg-orange-600 hover:border-orange-600 transition-all group/btn shadow-lg active:scale-90"
                                            title="View Publicly">
                                            <i class="fas fa-external-link-alt text-xs"></i>
                                        </a>
                                        <a href="<?php echo route('products.edit', ['id' => $prod['id']]); ?>" 
                                            class="w-10 h-10 flex items-center justify-center bg-gray-900 border border-gray-800 text-gray-500 hover:text-white rounded-xl hover:bg-blue-600 hover:border-blue-600 transition-all group/btn shadow-lg active:scale-90"
                                            title="Edit Specs">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <a href="<?php echo route('products.delete', ['id' => $prod['id']]); ?>" 
                                            onclick="return confirm('Archive this machine portfolio? Information will be permanently removed.')"
                                            class="w-10 h-10 flex items-center justify-center bg-gray-900 border border-gray-800 text-gray-500 hover:text-white rounded-xl hover:bg-red-600 hover:border-red-600 transition-all group/btn shadow-lg active:scale-90"
                                            title="Delete Permanently">
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
