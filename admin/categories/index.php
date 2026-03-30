<?php
require_once '../includes/functions.php';

// Handle Add/Edit Category
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['save_category'])) {
        $name = sanitizeInput($_POST['name']);
        $parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;
        $slug = !empty($_POST['slug']) ? slugGenerate($_POST['slug']) : slugGenerate($name);
        $status = $_POST['status'] ?? 'active';
        $image = $_POST['image_path'] ?? ($_POST['current_image'] ?? '');
        $featured = isset($_POST['featured']) ? 1 : 0;
        $seo_title = sanitizeInput($_POST['seo_title'] ?? '');
        $seo_description = sanitizeInput($_POST['seo_description'] ?? '');
        $meta_keywords = sanitizeInput($_POST['meta_keywords'] ?? '');
        $category_id = $_POST['category_id'] ?? null;

        // Check if slug exists
        if (slugExists('categories', $slug, $category_id)) {
            $error_message = "Error: Slug '$slug' already exists. Please choose a different one or leave it blank to auto-generate.";
        } else {
            if ($category_id) {
                // Update
                $stmt = $pdo->prepare("UPDATE categories SET name = ?, parent_id = ?, slug = ?, image = ?, status = ?, featured = ?, seo_title = ?, seo_description = ?, meta_keywords = ? WHERE id = ?");
                if ($stmt->execute([$name, $parent_id, $slug, $image, $status, $featured, $seo_title, $seo_description, $meta_keywords, $category_id])) {
                    $success_message = "Category '$name' updated successfully!";
                }
            } else {
                // Insert
                $stmt = $pdo->prepare("INSERT INTO categories (name, parent_id, slug, image, status, featured, seo_title, seo_description, meta_keywords) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$name, $parent_id, $slug, $image, $status, $featured, $seo_title, $seo_description, $meta_keywords])) {
                    $success_message = "Category '$name' added successfully!";
                }
            }
        }
    }
}

// Handle Featured Toggle
if (isset($_GET['toggle_featured'])) {
    $id = $_GET['toggle_featured'];
    $stmt = $pdo->prepare("UPDATE categories SET featured = 1 - featured WHERE id = ?");
    if ($stmt->execute([$id])) {
        // Redirect to clean URL
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    if ($stmt->execute([$id])) {
        $success_message = "Category deleted successfully!";
    }
}

// Get Category for Editing
$edit_cat = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_cat = $stmt->fetch();
}

$categories_tree = getCategoryTree();

$page_title = 'Category Management';
require_once '../includes/header.php';
?>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-heading font-bold">Category <span class="text-orange-600">Management</span></h1>
            <p class="text-sm text-gray-400">Organize your industrial machinery into a hierarchical structure.</p>
        </div>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Category Form -->
        <div class="lg:col-span-1">
            <div class="card p-6 sticky top-24">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-orange-600/10 rounded-lg flex items-center justify-center text-orange-600">
                        <i class="fas fa-<?php echo $edit_cat ? 'edit' : 'plus'; ?> text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold"><?php echo $edit_cat ? 'Edit' : 'Add New'; ?> Category</h3>
                </div>

                <form method="POST" class="space-y-4">
                    <?php if ($edit_cat): ?>
                        <input type="hidden" name="category_id" value="<?php echo $edit_cat['id']; ?>">
                    <?php endif; ?>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Category Name</label>
                        <input type="text" name="name" value="<?php echo $edit_cat['name'] ?? ''; ?>" required
                            class="w-full bg-black border border-gray-800 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-orange-600 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Parent Category</label>
                        <select name="parent_id" class="w-full bg-black border border-gray-800 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-orange-600 transition-all">
                            <option value="">None (Main Category)</option>
                            <?php foreach ($categories_tree as $cat): ?>
                                <?php 
                                    // Skip self and children if editing
                                    if ($edit_cat && ($cat['id'] == $edit_cat['id'])) continue; 
                                ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo (isset($edit_cat['parent_id']) && $edit_cat['parent_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                    <?php echo $cat['display_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Custom Slug (Optional)</label>
                        <input type="text" name="slug" value="<?php echo $edit_cat['slug'] ?? ''; ?>" placeholder="auto-generated-if-blank"
                            class="w-full bg-black border border-gray-800 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-orange-600 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Category Image</label>
                        <input type="hidden" name="image_path" id="cat_image_path" value="<?php echo $edit_cat['image'] ?? ''; ?>">
                        <div id="cat_image_preview_container" class="bg-black border-2 border-dashed border-gray-800 rounded-xl p-4 text-center group hover:border-orange-600/50 transition-all cursor-pointer mb-2" onclick="openCategoryMediaPicker()">
                            <?php if (isset($edit_cat['image']) && $edit_cat['image']): ?>
                                <img src="../../<?php echo $edit_cat['image']; ?>" id="cat_image_preview" class="w-full h-32 object-contain rounded-lg bg-white/5 p-2">
                            <?php else: ?>
                                <div id="cat_no_image_placeholder" class="py-4">
                                    <i class="fas fa-image text-2xl text-gray-700 group-hover:text-orange-600 transition-colors mb-2"></i>
                                    <p class="text-[10px] text-gray-500">Click to select image</p>
                                </div>
                                <img src="" id="cat_image_preview" class="hidden w-full h-32 object-contain rounded-lg bg-white/5 p-2">
                            <?php endif; ?>
                        </div>
                    </div>

                    <script>
                    function openCategoryMediaPicker() {
                        MediaManager.open({ multiple: false }, function(item) {
                            document.getElementById('cat_image_path').value = item.file_path;
                            const preview = document.getElementById('cat_image_preview');
                            preview.src = '../../' + item.file_path;
                            preview.classList.remove('hidden');
                            const placeholder = document.getElementById('cat_no_image_placeholder');
                            if (placeholder) placeholder.classList.add('hidden');
                            
                            document.getElementById('cat_image_preview_container').innerHTML = `
                                <img src="../../${item.file_path}" id="cat_image_preview" class="w-full h-32 object-contain rounded-lg bg-white/5 p-2">
                                <p class="text-[10px] text-gray-500 mt-2">Click to change image</p>
                            `;
                        });
                    }
                    </script>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Status</label>
                        <select name="status" class="w-full bg-black border border-gray-800 rounded-xl py-3 px-4 text-white focus:outline-none focus:border-orange-600 transition-all">
                            <option value="active" <?php echo (isset($edit_cat['status']) && $edit_cat['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo (isset($edit_cat['status']) && $edit_cat['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-gray-800">
                        <p class="text-[10px] font-bold text-orange-600 uppercase tracking-widest">SEO Optimization</p>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Meta Title</label>
                            <input type="text" name="seo_title" value="<?php echo $edit_cat['seo_title'] ?? ''; ?>" 
                                class="w-full bg-black border border-gray-800 rounded-lg py-2 px-3 text-white text-xs focus:border-orange-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Meta Description</label>
                            <textarea name="seo_description" rows="2" 
                                class="w-full bg-black border border-gray-800 rounded-lg py-2 px-3 text-white text-xs focus:border-orange-600 transition-all"><?php echo $edit_cat['seo_description'] ?? ''; ?></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="<?php echo $edit_cat['meta_keywords'] ?? ''; ?>"
                                class="w-full bg-black border border-gray-800 rounded-lg py-2 px-3 text-white text-xs focus:border-orange-600 transition-all">
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="flex items-center space-x-3 cursor-pointer p-3 bg-black/40 rounded-xl border border-gray-800 hover:border-orange-600/50 transition-all">
                            <input type="checkbox" name="featured" value="1" <?php echo (isset($edit_cat['featured']) && $edit_cat['featured']) ? 'checked' : ''; ?> 
                                class="w-5 h-5 text-orange-600 bg-black border-gray-700 rounded focus:ring-orange-600">
                            <div>
                                <p class="text-[11px] font-bold text-white">Featured Category</p>
                                <p class="text-[9px] text-gray-500 font-mono">HOMEPAGE DISPLAY</p>
                            </div>
                        </label>
                    </div>

                    <div class="pt-4 flex space-x-3">
                        <button type="submit" name="save_category" class="flex-1 bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg shadow-orange-600/20 active:scale-95">
                            <?php echo $edit_cat ? 'Update Category' : 'Add Category'; ?>
                        </button>
                        <?php if ($edit_cat): ?>
                            <a href="index.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-xl transition-all">Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Category Tree List -->
        <div class="lg:col-span-2">
            <div class="card overflow-hidden">
                <div class="p-6 border-b border-gray-800 flex items-center justify-between">
                    <h3 class="text-lg font-bold">Category Tree Structure</h3>
                    <span class="text-xs bg-gray-800 text-gray-400 px-3 py-1 rounded-full"><?php echo count($categories_tree); ?> Categories</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-900/50">
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Category Name</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Featured</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Slug</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            <?php if (empty($categories_tree)): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">No categories found. Start by adding one!</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($categories_tree as $cat): ?>
                                    <tr class="hover:bg-gray-800/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-white/5 rounded-lg overflow-hidden flex items-center justify-center p-1 border border-gray-800">
                                                    <?php if ($cat['image']): ?>
                                                        <img src="../../<?php echo $cat['image']; ?>" class="w-full h-full object-contain">
                                                    <?php else: ?>
                                                        <i class="fas fa-folder text-gray-700 text-xs"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <span class="font-medium"><?php echo $cat['display_name']; ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="?toggle_featured=<?php echo $cat['id']; ?>" class="inline-block transition-all hover:scale-125">
                                                <?php if ($cat['featured']): ?>
                                                    <i class="fas fa-star text-orange-500 text-lg drop-shadow-[0_0_8px_rgba(249,115,22,0.4)]"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star text-gray-700 hover:text-orange-500/50 text-lg"></i>
                                                <?php endif; ?>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">
                                            <?php echo $cat['slug']; ?>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?php echo $cat['status'] == 'active' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'; ?>">
                                                <?php echo $cat['status']; ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-3">
                                            <a href="?edit=<?php echo $cat['id']; ?>" class="text-gray-400 hover:text-orange-600 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="?delete=<?php echo $cat['id']; ?>" onclick="return confirm('Note: Deleting a category will also delete all its subcategories and products. Proceed?')" class="text-gray-400 hover:text-red-500 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
