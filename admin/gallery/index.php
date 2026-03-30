<?php
require_once '../includes/functions.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->execute([$id]);
    $img = $stmt->fetchColumn();
    
    if ($img && $img != 'v.jpeg' && file_exists('../../' . $img)) {
        unlink('../../' . $img);
    }
    
    $pdo->prepare("DELETE FROM gallery WHERE id = ?")->execute([$id]);
    header("Location: index.php?msg=deleted");
    exit;
}

// Handle upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $title = sanitizeInput($_POST['title']);
    $category = sanitizeInput($_POST['category']);
    $desc = sanitizeInput($_POST['description']);
    
    $image = uploadImage($_FILES['image'], '../../uploads/gallery/');
    if ($image) {
        $stmt = $pdo->prepare("INSERT INTO gallery (title, category, description, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $category, $desc, 'uploads/gallery/' . $image]);
        header("Location: index.php?msg=added");
        exit;
    }
}

$gallery_items = $pdo->query("SELECT * FROM gallery ORDER BY created_at DESC")->fetchAll();

$page_title = 'Visual Gallery';
require_once '../includes/header.php';
?>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-heading font-bold">Media <span class="text-orange-600">Gallery</span></h1>
            <p class="text-sm text-gray-400">Manage machinery photos and industrial site captures.</p>
        </div>
        <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 rounded-lg text-sm font-semibold transition-colors shadow-lg shadow-orange-600/20">
            <i class="fas fa-upload mr-2"></i> Upload Photo
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <?php foreach($gallery_items as $item): ?>
        <div class="aspect-square bg-gray-900 border border-gray-800 rounded-xl overflow-hidden group relative">
            <img src="../../<?php echo h($item['image']); ?>" class="w-full h-full object-cover">
            <div class="absolute inset-x-0 bottom-0 p-2 bg-black/60 backdrop-blur-sm transform translate-y-full group-hover:translate-y-0 transition-transform">
                <p class="text-[10px] font-bold truncate text-white"><?php echo h($item['title']); ?></p>
            </div>
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <div class="flex space-x-2">
                    <a href="../../<?php echo h($item['image']); ?>" target="_blank" class="w-8 h-8 bg-orange-600 rounded-full flex items-center justify-center text-xs text-white"><i class="fas fa-eye"></i></a>
                    <a href="?delete=<?php echo $item['id']; ?>" onclick="return confirm('Delete this image?')" class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-xs text-white"><i class="fas fa-trash"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if(empty($gallery_items)): ?>
        <div class="col-span-full card p-12 flex flex-col items-center justify-center text-center space-y-4">
            <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center text-gray-700 border border-gray-800 mb-2">
                <i class="fas fa-images text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold">No images uploaded yet</h3>
            <p class="text-xs text-gray-500 max-w-xs leading-relaxed">Your machine gallery is currently empty.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-gray-900 border border-gray-800 rounded-2xl w-full max-w-md p-8 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Upload <span class="text-orange-600">Media</span></h3>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-white"><i class="fas fa-times"></i></button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Photo Title</label>
                <input type="text" name="title" required class="w-full bg-black border border-gray-800 rounded-lg px-4 py-2 text-white focus:border-orange-600 outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Category</label>
                <select name="category" class="w-full bg-black border border-gray-800 rounded-lg px-4 py-2 text-white focus:border-orange-600 outline-none transition-all">
                    <option value="machinery">Machinery</option>
                    <option value="process">Process</option>
                    <option value="projects">Projects</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Description (Optional)</label>
                <textarea name="description" rows="2" class="w-full bg-black border border-gray-800 rounded-lg px-4 py-2 text-white focus:border-orange-600 outline-none transition-all"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Select Image</label>
                <input type="file" name="image" required accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-800 file:text-orange-600 hover:file:bg-gray-700">
            </div>
            <button type="submit" class="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-orange-600/20">
                Start Upload
            </button>
        </form>
    </div>
</div>

<?php 
require_once '../includes/footer.php';
?>
