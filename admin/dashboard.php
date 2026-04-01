<?php
$page_title = 'Dashboard Overview';
require_once 'includes/header.php';

// Fetch some real stats from the products data
$total_categories = count($product_categories);
$total_subproducts = 0;
$total_variants = 0;

foreach ($product_categories as $cat) {
    if (isset($cat['sub_categories'])) {
        $total_subproducts += count($cat['sub_categories']);
        foreach ($cat['sub_categories'] as $sub) {
            if (isset($sub['variants'])) {
                $total_variants += count($sub['variants']);
            }
        }
    }
}

// Fetch Inquiry Stats
$pending_inquiries_stmt = $pdo->query("SELECT COUNT(*) FROM contact_requests WHERE status = 'new'");
$pending_inquiries = $pending_inquiries_stmt->fetchColumn();

$recent_messages_stmt = $pdo->query("SELECT * FROM contact_requests ORDER BY created_at DESC LIMIT 5");
$recent_messages = $recent_messages_stmt->fetchAll();

// Visitor Statistics
$total_visitors_stmt = $pdo->query("SELECT COUNT(*) FROM visitors");
$total_unique_visitors = $total_visitors_stmt->fetchColumn();

$today_visitors_stmt = $pdo->prepare("SELECT COUNT(*) FROM visitors WHERE visit_date = :today");
$today_visitors_stmt->execute(['today' => date('Y-m-d')]);
$today_visitors = $today_visitors_stmt->fetchColumn();

$month_visitors_stmt = $pdo->prepare("SELECT COUNT(*) FROM visitors WHERE MONTH(visit_date) = MONTH(CURRENT_DATE()) AND YEAR(visit_date) = YEAR(CURRENT_DATE())");
$month_visitors_stmt->execute();
$month_visitors = $month_visitors_stmt->fetchColumn();
?>

<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-heading font-bold text-white">Welcome back, <span class="text-orange-600">Admin</span></h1>
            <p class="text-gray-400 mt-1">Here is what's happening with VIVA Engineering today.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="<?php echo route('export.pdf'); ?>" target="_blank" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 rounded-lg text-sm transition-colors border border-gray-700 inline-flex items-center">
                <i class="fas fa-download mr-2"></i> Export Report
            </a>
            <a href="<?php echo route('products.add'); ?>" class="px-4 py-2 bg-orange-600/10 hover:bg-orange-600 border border-orange-600/30 rounded-lg text-sm font-semibold text-orange-500 hover:text-white transition-all inline-flex items-center shadow-sm active:scale-95">
                <i class="fas fa-plus mr-2"></i> Add Product
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card -->
        <div class="card p-6 flex items-start justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Categories</p>
                <h3 class="text-3xl font-bold mt-2"><?php echo $total_categories; ?></h3>
                <p class="text-orange-600 text-xs mt-2 font-semibold flex items-center">
                    <i class="fas fa-caret-up mr-1"></i> Active Units
                </p>
            </div>
            <div class="w-12 h-12 bg-orange-600/10 rounded-xl flex items-center justify-center text-orange-600">
                <i class="fas fa-th-large text-xl"></i>
            </div>
        </div>

        <div class="card p-6 flex items-start justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Sub-Products</p>
                <h3 class="text-3xl font-bold mt-2"><?php echo $total_subproducts; ?></h3>
                <p class="text-green-500 text-xs mt-2 font-semibold flex items-center">
                    <i class="fas fa-check-circle mr-1"></i> Configured
                </p>
            </div>
            <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-500">
                <i class="fas fa-boxes text-xl"></i>
            </div>
        </div>

        <div class="card p-6 flex items-start justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Variants</p>
                <h3 class="text-3xl font-bold mt-2"><?php echo $total_variants; ?></h3>
                <p class="text-blue-500 text-xs mt-2 font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-1"></i> Specifications
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-500">
                <i class="fas fa-list-ul text-xl"></i>
            </div>
        </div>

        <div class="card p-6 flex items-start justify-between border-l-4 border-l-orange-600 shadow-lg shadow-orange-600/5">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Pending Inquiries</p>
                <h3 class="text-3xl font-bold mt-2"><?php echo $pending_inquiries; ?></h3>
                <p class="text-orange-600 text-xs mt-2 font-semibold flex items-center">
                    <i class="fas fa-envelope mr-1"></i> New Leads
                </p>
            </div>
            <div class="w-12 h-12 bg-orange-600/10 rounded-xl flex items-center justify-center text-orange-600">
                <i class="fas fa-inbox text-xl"></i>
            </div>
        </div>

        <!-- NEW VISITOR STATS -->
        <div class="card p-6 flex items-start justify-between bg-gradient-to-br from-gray-900 to-black border-orange-600/20">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Unique Visitors (Today)</p>
                <div class="flex items-center gap-2 mt-2">
                    <h3 class="text-3xl font-bold text-white"><?php echo $today_visitors; ?></h3>
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                </div>
                <p class="text-orange-500 text-xs mt-2 font-semibold">Live Traffic</p>
            </div>
            <div class="w-12 h-12 bg-orange-600/20 rounded-xl flex items-center justify-center text-orange-500 border border-orange-600/30">
                <i class="fas fa-users text-xl"></i>
            </div>
        </div>

        <div class="card p-6 flex items-start justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Monthly Traffic</p>
                <h3 class="text-3xl font-bold mt-2 text-white"><?php echo $month_visitors; ?></h3>
                <p class="text-gray-400 text-xs mt-2">Current Month</p>
            </div>
            <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center text-gray-400">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
        </div>

        <div class="card p-6 flex items-start justify-between">
            <div>
                <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Visitors</p>
                <h3 class="text-3xl font-bold mt-2 text-white"><?php echo $total_unique_visitors; ?></h3>
                <p class="text-gray-400 text-xs mt-2">All-Time Unique</p>
            </div>
            <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center text-gray-400">
                <i class="fas fa-globe text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Quick Management & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Products -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-heading font-bold text-white">Recent Machinery</h3>
                <a href="<?php echo route('products'); ?>" class="text-orange-600 text-sm hover:underline">View All</a>
            </div>
            <div class="card border border-gray-800/50 bg-gray-900/20 backdrop-blur-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="bg-black/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-800">
                                <th class="px-6 py-4">Product Name</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            <?php 
                            $counter = 0;
                            foreach ($product_categories as $slug => $cat): 
                                if ($counter >= 3) break; 
                                $counter++;
                            ?>
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold truncate block max-w-[200px]"><?php echo $cat['name']; ?></span>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">
                                    Machinery
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-block px-2 py-1 bg-green-500/10 text-green-500 text-[10px] font-bold rounded">LIVE</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="<?php echo route('products.edit', ['id' => $cat['id'] ?? '']); ?>" class="text-gray-500 hover:text-orange-600 transition-colors"><i class="fas fa-edit text-xs"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Inquiries Section -->
            <div class="flex items-center justify-between pt-4">
                <h3 class="text-lg font-heading font-bold text-white">Latest Inquiries</h3>
                <a href="<?php echo route('messages'); ?>" class="text-orange-600 text-sm hover:underline">View Messages</a>
            </div>
            <div class="card border border-orange-600/20 bg-orange-600/5 backdrop-blur-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <tbody class="divide-y divide-gray-800/50">
                            <?php if (empty($recent_messages)): ?>
                                <tr>
                                    <td class="px-6 py-8 text-center text-gray-500 text-sm">No recent inquiries found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($recent_messages as $msg): ?>
                                <tr class="hover:bg-white/5 transition-colors group <?php echo $msg['status'] == 'new' ? 'bg-orange-600/5' : ''; ?>">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-white"><?php echo h($msg['name']); ?></div>
                                        <div class="text-[10px] text-gray-500 line-clamp-1"><?php echo h($msg['subject']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-1 rounded text-[9px] font-bold uppercase <?php echo $msg['status'] == 'new' ? 'bg-orange-600 text-white animate-pulse' : 'bg-gray-800 text-gray-400'; ?>">
                                            <?php echo $msg['status']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="<?php echo route('messages'); ?>" class="text-gray-500 hover:text-orange-600 transition-colors"><i class="fas fa-external-link-alt text-xs"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- System Alerts -->
        <div class="space-y-4">
            <h3 class="text-lg font-heading font-bold text-white">System Logs</h3>
            <div class="card p-6 space-y-6">
                <!-- Log Item -->
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-orange-600/10 flex items-center justify-center text-orange-600 flex-shrink-0">
                        <i class="fas fa-user-edit text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Admin updated products</p>
                        <p class="text-[10px] text-gray-500 mt-1">10 minutes ago</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-blue-600/10 flex items-center justify-center text-blue-600 flex-shrink-0">
                        <i class="fas fa-sync text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Data synced successfully</p>
                        <p class="text-[10px] text-gray-500 mt-1">1 hour ago</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-lg bg-red-600/10 flex items-center justify-center text-red-600 flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Backup taking longer than usual</p>
                        <p class="text-[10px] text-gray-500 mt-1">3 hours ago</p>
                    </div>
                </div>
            </div>
            
            <div class="card p-6 gradient-orange bg-gradient-to-br from-orange-600 to-orange-800 text-white">
                <h4 class="font-bold text-sm">Need Help?</h4>
                <p class="text-xs mt-2 opacity-80 leading-relaxed">The VIVA Admin system is newly implemented. Check the documentation for managing variants.</p>
                <button class="mt-4 px-4 py-2 bg-black/20 hover:bg-black/30 rounded-lg text-xs font-bold transition-colors">Documentation</button>
            </div>
        </div>
    </div>
</div>

<?php 
require_once 'includes/footer.php';
?>
