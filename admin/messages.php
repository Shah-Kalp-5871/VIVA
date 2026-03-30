<?php
$page_title = 'Contact Messages';
require_once 'includes/header.php';

// Handle Actions (Mark as Read, Delete)
$success_message = '';
$error_message = '';

if (isset($_GET['action'])) {
    $id = $_GET['id'] ?? null;
    if ($id) {
        if ($_GET['action'] == 'mark_read') {
            $stmt = $pdo->prepare("UPDATE contact_requests SET status = 'read' WHERE id = ?");
            if ($stmt->execute([$id])) {
                $success_message = "Message marked as read.";
            }
        } elseif ($_GET['action'] == 'mark_unread') {
            $stmt = $pdo->prepare("UPDATE contact_requests SET status = 'new' WHERE id = ?");
            if ($stmt->execute([$id])) {
                $success_message = "Message marked as new/unread.";
            }
        } elseif ($_GET['action'] == 'delete') {
            $stmt = $pdo->prepare("DELETE FROM contact_requests WHERE id = ?");
            if ($stmt->execute([$id])) {
                $success_message = "Message deleted successfully.";
            }
        }
    }
}

// Fetch Messages
$search = $_GET['search'] ?? '';
$status_filter = $_GET['status'] ?? '';

$sql = "SELECT * FROM contact_requests";
$where = [];
$params = [];

if ($search) {
    $where[] = "(name LIKE ? OR email LIKE ? OR subject LIKE ?)";
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
$messages = $stmt->fetchAll();

// Get count of new messages for badge
$new_count_stmt = $pdo->query("SELECT COUNT(*) FROM contact_requests WHERE status = 'new'");
$new_count = $new_count_stmt->fetchColumn();
?>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-heading font-bold">Inquiry <span class="text-orange-600">Messages</span></h1>
            <p class="text-sm text-gray-400">View and respond to customer inquiries from the website contact form.</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="bg-orange-600/10 border border-orange-600/30 px-4 py-2 rounded-lg text-sm text-orange-500 font-bold">
                <i class="fas fa-envelope mr-2"></i> <?php echo $new_count; ?> New Messages
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-col lg:flex-row gap-6 mb-8">
        <form method="GET" class="flex-1 flex gap-2">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                <input type="text" name="search" value="<?php echo h($search); ?>" placeholder="Search messages..." 
                    class="w-full bg-gray-900 border border-gray-800 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-orange-600 transition-all">
            </div>
            <select name="status" class="bg-gray-900 border border-gray-800 rounded-xl py-3 px-6 text-white focus:outline-none focus:border-orange-600 transition-all">
                <option value="">All Statuses</option>
                <option value="new" <?php echo $status_filter == 'new' ? 'selected' : ''; ?>>New</option>
                <option value="read" <?php echo $status_filter == 'read' ? 'selected' : ''; ?>>Read</option>
                <option value="replied" <?php echo $status_filter == 'replied' ? 'selected' : ''; ?>>Replied</option>
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

    <!-- Messages Table -->
    <div class="card overflow-hidden border border-gray-800/50 bg-gray-900/20 backdrop-blur-xl shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-black/40 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] border-b border-gray-800/50">
                        <th class="px-8 py-6">Sender Details</th>
                        <th class="px-8 py-6">Inquiry Subject</th>
                        <th class="px-8 py-6">Current Status</th>
                        <th class="px-8 py-6">Timestamp</th>
                        <th class="px-8 py-6 text-right">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/30">
                    <?php if (empty($messages)): ?>
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4 block opacity-20"></i>
                                <p class="text-sm font-medium">No messages found in your inbox.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($messages as $msg): ?>
                            <tr class="hover:bg-orange-600/[0.02] transition-all group <?php echo $msg['status'] == 'new' ? 'bg-orange-600/[0.03]' : ''; ?>">
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-xs font-bold text-gray-400 group-hover:bg-orange-600 group-hover:text-white transition-all">
                                            <?php echo strtoupper(substr($msg['name'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div class="font-bold text-white group-hover:text-orange-600 transition-colors"><?php echo h($msg['name']); ?></div>
                                            <div class="text-[10px] text-gray-400 font-mono mt-0.5"><?php echo h($msg['email']); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-semibold text-gray-200"><?php echo h($msg['subject']); ?></div>
                                    <div class="text-[11px] text-gray-500 line-clamp-1 max-w-xs mt-1 italic"><?php echo h($msg['message']); ?></div>
                                </td>
                                <td class="px-8 py-6">
                                    <?php 
                                        $status_classes = [
                                            'new' => 'bg-orange-600/10 text-orange-500 border-orange-600/20 shadow-[0_0_15px_rgba(255,87,34,0.1)]',
                                            'read' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                            'replied' => 'bg-green-500/10 text-green-400 border-green-500/20'
                                        ];
                                        $class = $status_classes[$msg['status']] ?? $status_classes['read'];
                                    ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border <?php echo $class; ?>">
                                        <?php if ($msg['status'] == 'new'): ?>
                                            <span class="w-1.5 h-1.5 bg-orange-600 rounded-full mr-2 animate-pulse"></span>
                                        <?php endif; ?>
                                        <?php echo $msg['status']; ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-xs text-gray-500">
                                    <div class="font-bold text-gray-400"><?php echo date('d M Y', strtotime($msg['created_at'])); ?></div>
                                    <div class="text-[10px] opacity-40 mt-1 uppercase"><?php echo date('h:i A', strtotime($msg['created_at'])); ?></div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end space-x-2 opacity-100 transition-all">
                                        <!-- Quick Reply -->
                                        <a href="mailto:<?php echo $msg['email']; ?>?subject=RE: <?php echo urlencode($msg['subject']); ?>" class="w-9 h-9 bg-green-600/10 flex items-center justify-center text-green-500 rounded-xl hover:bg-green-600 hover:text-white transition-all transform hover:scale-110" title="Reply">
                                            <i class="fas fa-paper-plane text-[10px]"></i>
                                        </a>

                                        <!-- Status Toggle -->
                                        <?php if ($msg['status'] == 'new'): ?>
                                            <a href="?action=mark_read&id=<?php echo $msg['id']; ?>" class="w-9 h-9 bg-blue-600/10 flex items-center justify-center text-blue-400 rounded-xl hover:bg-blue-600 hover:text-white transition-all transform hover:scale-110" title="Mark as Read">
                                                <i class="fas fa-check text-[10px]"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="?action=mark_unread&id=<?php echo $msg['id']; ?>" class="w-9 h-9 bg-yellow-600/10 flex items-center justify-center text-yellow-500 rounded-xl hover:bg-yellow-600 hover:text-white transition-all transform hover:scale-110" title="Mark as New/Unread">
                                                <i class="fas fa-envelope-open text-[10px]"></i>
                                            </a>
                                        <?php endif; ?>

                                        <!-- Detailed View -->
                                        <button onclick="viewMessage(<?php echo htmlspecialchars(json_encode($msg)); ?>)" class="w-9 h-9 bg-gray-800 flex items-center justify-center text-gray-300 rounded-xl hover:bg-orange-600 hover:text-white transition-all transform hover:scale-110" title="Expand View">
                                            <i class="fas fa-expand-alt text-xs"></i>
                                        </button>

                                        <!-- Delete -->
                                        <a href="?action=delete&id=<?php echo $msg['id']; ?>" onclick="return confirm('Permanently remove this entry?')" class="w-9 h-9 bg-red-600/10 flex items-center justify-center text-red-500 rounded-xl hover:bg-red-600 hover:text-white transition-all transform hover:scale-110" title="Delete">
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

<!-- Premium Message Detail Modal -->
<div id="message-modal" class="fixed inset-0 bg-black/90 backdrop-blur-2xl z-[100] flex items-center justify-center p-4 md:p-10 hidden">
    <div class="card max-w-4xl w-full max-h-[90vh] flex flex-col p-0 shadow-[0_30px_100px_rgba(0,0,0,0.8)] border border-gray-800/50 overflow-hidden bg-gray-900/40">
        <!-- Modal Header -->
        <div class="p-6 md:p-8 border-b border-gray-800/50 flex items-center justify-between bg-white/[0.02] flex-shrink-0">
            <div class="flex items-center space-x-4 md:space-x-6">
                <div id="modal-initial" class="w-12 h-12 md:w-16 md:h-16 rounded-2xl bg-orange-600 flex items-center justify-center text-xl md:text-2xl font-black text-white shadow-lg shadow-orange-600/20"></div>
                <div>
                    <h3 class="text-xl md:text-2xl font-black text-white tracking-tight" id="modal-name"></h3>
                    <div class="flex flex-col md:flex-row md:items-center md:space-x-4 mt-1">
                        <span id="modal-email" class="text-[10px] md:text-xs text-orange-500 font-bold"></span>
                        <span class="hidden md:block w-1 h-1 bg-gray-800 rounded-full"></span>
                        <span id="modal-phone" class="text-[10px] md:text-xs text-gray-500 font-mono"></span>
                    </div>
                </div>
            </div>
            <button onclick="closeMessageModal()" class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gray-800 text-gray-500 hover:text-white hover:bg-red-600 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Modal Content (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-6 md:p-10 space-y-10 custom-scrollbar">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="md:col-span-2 space-y-8">
                    <div>
                        <p class="text-[10px] text-gray-600 uppercase font-black tracking-[0.3em] mb-3">Inquiry Subject</p>
                        <h4 id="modal-subject" class="text-2xl font-bold text-white leading-tight"></h4>
                    </div>
                    <div class="relative">
                        <p class="text-[10px] text-gray-600 uppercase font-black tracking-[0.3em] mb-4">Message Content</p>
                        <div class="bg-black/40 p-10 rounded-3xl border border-gray-800/50 relative overflow-hidden group">
                            <i class="fas fa-quote-right absolute top-8 right-8 text-6xl text-white/5 pointer-events-none"></i>
                            <p id="modal-message" class="text-gray-300 leading-relaxed text-lg whitespace-pre-wrap relative z-10 font-medium"></p>
                        </div>
                    </div>
                </div>
                <div class="space-y-8">
                    <div class="p-6 bg-white/[0.03] rounded-2xl border border-gray-800/50">
                        <p class="text-[10px] text-gray-600 uppercase font-black tracking-widest mb-4">Submission Intel</p>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] text-gray-500 uppercase font-bold text-left">Received</span>
                                <span id="modal-date" class="text-[11px] text-white font-mono text-right"></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] text-gray-500 uppercase font-bold text-left">Platform</span>
                                <span class="text-[11px] text-white text-right">Desktop Browser</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] text-gray-500 uppercase font-bold text-left">Region</span>
                                <span class="text-[11px] text-white text-right">India (Local)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 bg-orange-600/5 rounded-2xl border border-orange-600/10">
                        <p class="text-[10px] text-orange-600 uppercase font-black tracking-widest mb-4">Admin Priority</p>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-bolt text-orange-600 text-xs"></i>
                            <span class="text-xs text-gray-300 font-bold">Responded within 24h</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer (Fixed) -->
        <div class="p-6 md:p-8 bg-black/40 border-t border-gray-800/50 flex flex-col md:flex-row justify-end gap-4 flex-shrink-0">
            <button onclick="closeMessageModal()" class="px-8 py-4 rounded-xl text-gray-500 font-bold hover:text-white hover:bg-gray-800 transition-all uppercase tracking-widest text-[10px] md:text-[11px]">Dismiss</button>
            <a id="modal-reply" href="" class="px-8 md:px-10 py-4 bg-orange-600 hover:bg-orange-700 text-white rounded-xl font-black uppercase tracking-widest text-[10px] md:text-[11px] shadow-xl shadow-orange-600/20 transition-all transform hover:-translate-y-1 flex items-center justify-center">
                <i class="fas fa-paper-plane mr-3 text-sm"></i> Initiate Reply
            </a>
        </div>
    </div>
</div>

<style>
/* Premium Industrial Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255, 87, 34, 0.2);
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 87, 34, 0.5);
}
</style>

<script>
function viewMessage(msg) {
    document.getElementById('modal-name').innerText = msg.name;
    document.getElementById('modal-initial').innerText = msg.name.substring(0, 1).toUpperCase();
    document.getElementById('modal-email').innerText = msg.email;
    document.getElementById('modal-phone').innerText = msg.phone;
    document.getElementById('modal-subject').innerText = msg.subject;
    document.getElementById('modal-message').innerText = msg.message;
    document.getElementById('modal-date').innerText = new Date(msg.created_at).toLocaleDateString();
    document.getElementById('modal-reply').href = "mailto:" + msg.email + "?subject=RE: " + msg.subject;
    
    const modal = document.getElementById('message-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // GSAP entrance
    gsap.from(modal.querySelector('.card'), {
        y: 50,
        scale: 0.95,
        opacity: 0,
        duration: 0.6,
        ease: 'power4.out'
    });
    
    document.body.style.overflow = 'hidden';
}

function closeMessageModal() {
    const modal = document.getElementById('message-modal');
    gsap.to(modal.querySelector('.card'), {
        y: 30,
        scale: 0.98,
        opacity: 0,
        duration: 0.4,
        ease: 'power4.in',
        onComplete: () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    });
}
</script>

<?php require_once 'includes/footer.php'; ?>
