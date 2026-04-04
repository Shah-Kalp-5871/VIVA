<?php
require_once 'includes/config.php';
check_admin_login();

$success_message = '';
$error_message = '';

// Handle AJAX Status Updates
if (isset($_POST['ajax_update_status'])) {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? 'read';
    if ($id) {
        $stmt = $pdo->prepare("UPDATE lead_submissions SET status = ? WHERE id = ?");
        if ($stmt->execute([$status, $id])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => false]);
    exit;
}

// Handle GET Actions (Delete)
if (isset($_GET['action'])) {
    $id = $_GET['id'] ?? null;
    if ($id) {
        if ($_GET['action'] == 'delete') {
            $stmt = $pdo->prepare("DELETE FROM lead_submissions WHERE id = ?");
            $stmt->execute([$id]);
            $success_message = "Lead entry deleted successfully.";
        }
    }
    header("Location: leads.php");
    exit;
}

$page_title = 'Lead Submissions';
require_once 'includes/header.php';

// Fetch Leads
$search = $_GET['search'] ?? '';
$status_filter = $_GET['status'] ?? '';

$sql = "SELECT * FROM lead_submissions";
$where = [];
$params = [];

if ($search) {
    $where[] = "(name LIKE ? OR email LIKE ? OR phone LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($status_filter) {
    $where[] = "status = ?";
    $params[] = $status_filter;
}

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$leads = $stmt->fetchAll();

// Get count of new leads for badge
$new_count_stmt = $pdo->query("SELECT COUNT(*) FROM lead_submissions WHERE status = 'new'");
$new_count = $new_count_stmt->fetchColumn();
?>

<!-- GSAP for Animations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-heading font-bold">Popup <span class="text-orange-600">Leads</span></h1>
            <p class="text-sm text-gray-400">Manage leads captured via the frontend greeting popup.</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="bg-orange-600/10 border border-orange-600/30 px-4 py-2 rounded-lg text-sm text-orange-500 font-bold">
                <i class="fas fa-bullseye mr-2"></i> <?php echo $new_count; ?> New Leads
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-col lg:flex-row gap-6 mb-8">
        <form method="GET" class="flex-1 flex gap-2">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                <input type="text" name="search" value="<?php echo h($search); ?>" placeholder="Search leads by name, email or phone..." 
                    class="w-full bg-gray-900 border border-gray-800 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-orange-600 transition-all">
            </div>
            <select name="status" class="bg-gray-900 border border-gray-800 rounded-xl py-3 px-6 text-white focus:outline-none focus:border-orange-600 transition-all">
                <option value="">All Statuses</option>
                <option value="new" <?php echo $status_filter == 'new' ? 'selected' : ''; ?>>New</option>
                <option value="read" <?php echo $status_filter == 'read' ? 'selected' : ''; ?>>Read</option>
                <option value="contacted" <?php echo $status_filter == 'contacted' ? 'selected' : ''; ?>>Contacted</option>
            </select>
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-6 rounded-xl font-bold transition-colors">Filter</button>
        </form>
    </div>

    <?php if ($success_message): ?>
    <div class="bg-green-500/10 border border-green-500/50 text-green-500 text-sm p-4 rounded-xl flex items-center animate-pulse">
        <i class="fas fa-check-circle mr-3"></i>
        <?php echo $success_message; ?>
    </div>
    <?php endif; ?>

    <!-- Leads Table -->
    <div class="card overflow-hidden border border-gray-800/50 bg-gray-900/20 backdrop-blur-xl shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-black/40 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] border-b border-gray-800/50">
                        <th class="px-8 py-6">Lead Details</th>
                        <th class="px-8 py-6">Contact Info</th>
                        <th class="px-8 py-6">Status</th>
                        <th class="px-8 py-6">Timestamp</th>
                        <th class="px-8 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/30">
                    <?php if (empty($leads)): ?>
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center text-gray-500">
                                <i class="fas fa-id-card text-4xl mb-4 block opacity-20"></i>
                                <p class="text-sm font-medium">No lead submissions found yet.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($leads as $lead): ?>
                            <tr data-id="<?php echo $lead['id']; ?>" class="hover:bg-orange-600/[0.02] transition-all group <?php echo $lead['status'] == 'new' ? 'bg-orange-600/[0.03]' : ''; ?>">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-xs font-bold text-gray-400 group-hover:bg-orange-600 group-hover:text-white transition-all">
                                            <?php echo strtoupper(substr($lead['name'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div class="font-bold text-white group-hover:text-orange-600 transition-colors"><?php echo h($lead['name']); ?></div>
                                            <div class="text-[10px] text-gray-500 mt-0.5 uppercase tracking-widest font-black">POPUP SUBMISSION</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-1">
                                        <?php if ($lead['email']): ?>
                                            <div class="flex items-center text-xs text-gray-300">
                                                <i class="fas fa-envelope w-4 text-orange-600"></i> <?php echo h($lead['email']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($lead['phone']): ?>
                                            <div class="flex items-center text-xs text-gray-300">
                                                <i class="fas fa-phone w-4 text-orange-600"></i> <?php echo h($lead['phone']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <?php 
                                        $status_classes = [
                                            'new' => 'bg-orange-600/10 text-orange-500 border-orange-600/20',
                                            'read' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                            'contacted' => 'bg-green-500/10 text-green-400 border-green-500/20'
                                        ];
                                        $class = $status_classes[$lead['status']] ?? $status_classes['read'];
                                    ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border <?php echo $class; ?>">
                                        <?php echo $lead['status']; ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-xs text-gray-500">
                                    <div class="font-bold text-gray-400"><?php echo date('d M Y', strtotime($lead['created_at'])); ?></div>
                                    <div class="text-[10px] opacity-40 mt-1 uppercase"><?php echo date('h:i A', strtotime($lead['created_at'])); ?></div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Actions -->
                                        <?php if ($lead['status'] == 'new'): ?>
                                            <button onclick="updateStatus(<?php echo $lead['id']; ?>, 'read')" class="w-8 h-8 bg-blue-600/10 flex items-center justify-center text-blue-400 rounded-lg hover:bg-blue-600 hover:text-white transition-all" title="Mark as Read">
                                                <i class="fas fa-check text-[10px]"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($lead['status'] !== 'contacted'): ?>
                                            <button onclick="updateStatus(<?php echo $lead['id']; ?>, 'contacted')" class="w-8 h-8 bg-green-600/10 flex items-center justify-center text-green-400 rounded-lg hover:bg-green-600 hover:text-white transition-all" title="Mark as Contacted">
                                                <i class="fas fa-phone-alt text-[10px]"></i>
                                            </button>
                                        <?php endif; ?>
                                        <a href="?action=delete&id=<?php echo $lead['id']; ?>" onclick="return confirm('Permanently remove this lead entry?')" class="w-8 h-8 bg-red-600/10 flex items-center justify-center text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition-all" title="Delete">
                                            <i class="fas fa-trash-alt text-[10px]"></i>
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

<script>
function updateStatus(id, newStatus) {
    const formData = new FormData();
    formData.append('ajax_update_status', '1');
    formData.append('id', id);
    formData.append('status', newStatus);

    fetch('leads.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Simple reload for status changes
        }
    });
}
</script>

<?php require_once 'includes/footer.php'; ?>
