<?php
require_once __DIR__ . '/config.php';
$current_admin_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIVA Admin - <?php echo $page_title ?? 'Dashboard'; ?></title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Roboto+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Media Library Styles -->
    <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/assets/css/media-library.css?v=<?php echo time(); ?>">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        window.VIVA_ADMIN_URL = '<?php echo ADMIN_URL; ?>';
    </script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        black: '#000000',
                        white: '#ffffff',
                        orange: {
                            600: '#FF5722',
                            700: '#E64A19',
                            800: '#D84315',
                        },
                        gray: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                        body: ['Roboto Slab', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .admin-sidebar {
            background-color: #000000;
            border-right: 1px solid #333333;
            transition: all 0.3s ease;
        }
        .nav-item {
            transition: all 0.2s ease;
            color: #d1d5db;
        }
        .nav-item:hover {
            background-color: #1a1a1a;
            color: #FF5722;
        }
        .nav-item.active {
            background-color: #FF5722;
            color: #ffffff;
            font-weight: 600;
        }
        .admin-content {
            background-color: #0c0c0c;
        }
        .card {
            background-color: #1a1a1a;
            border: 1px solid #333333;
            border-radius: 12px;
        }
        /* Hide scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="bg-black text-white font-body selection:bg-orange-600/30 selection:text-orange-600">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="admin-sidebar w-64 flex-shrink-0 flex flex-col h-full z-50">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-gray-800">
                <a href="<?php echo ADMIN_URL; ?>/dashboard.php" class="flex items-center space-x-3">
                    <img src="../v.jpeg" alt="VIVA Logo" class="w-8 h-8 rounded bg-white p-1">
                    <div>
                        <h1 class="text-sm font-heading font-bold tracking-tight text-white leading-none">VIVA<span class="text-orange-600"> ADMIN</span></h1>
                        <p class="text-[10px] text-gray-500 tracking-widest mt-1 uppercase">Machine Control</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 sidebar-scroll overflow-y-auto">
                <a href="<?php echo ADMIN_URL; ?>/dashboard.php" class="nav-item flex items-center px-4 py-3 rounded-lg <?php echo ($current_admin_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line w-6"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
                
                <div class="pt-4 pb-2 px-4">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Management</p>
                </div>
                
                <a href="<?php echo ADMIN_URL; ?>/categories/" class="nav-item flex items-center px-4 py-3 rounded-lg <?php echo (strpos($_SERVER['PHP_SELF'], '/categories/') !== false) ? 'active' : ''; ?>">
                    <i class="fas fa-th-large w-6"></i>
                    <span class="text-sm">Categories</span>
                </a>
                
                <a href="<?php echo ADMIN_URL; ?>/products/" class="nav-item flex items-center px-4 py-3 rounded-lg <?php echo (strpos($_SERVER['PHP_SELF'], '/products/') !== false) ? 'active' : ''; ?>">
                    <i class="fas fa-cogs w-6"></i>
                    <span class="text-sm">Products</span>
                </a>
                
                <?php
                // Get new messages count for badge
                $new_msgs_stmt = $pdo->query("SELECT COUNT(*) FROM contact_requests WHERE status = 'new'");
                $new_msgs_count = $new_msgs_stmt->fetchColumn();
                ?>
                <a href="<?php echo ADMIN_URL; ?>/messages.php" class="nav-item flex items-center px-4 py-3 rounded-lg <?php echo ($current_admin_page == 'messages.php') ? 'active' : ''; ?>">
                    <i class="fas fa-envelope w-6"></i>
                    <span class="text-sm flex-1 text-left">Messages</span>
                    <?php if ($new_msgs_count > 0): ?>
                        <span class="bg-orange-600 text-[10px] font-bold px-2 py-0.5 rounded-full text-white ml-2"><?php echo $new_msgs_count; ?></span>
                    <?php endif; ?>
                </a>

                <a href="<?php echo ADMIN_URL; ?>/gallery/" class="nav-item flex items-center px-4 py-3 rounded-lg <?php echo (strpos($_SERVER['PHP_SELF'], '/gallery/') !== false) ? 'active' : ''; ?>">
                    <i class="fas fa-images w-6"></i>
                    <span class="text-sm">Gallery</span>
                </a>

                <a href="<?php echo ADMIN_URL; ?>/media-library.php" class="nav-item flex items-center px-4 py-3 rounded-lg <?php echo ($current_admin_page == 'media-library.php') ? 'active' : ''; ?>">
                    <i class="fas fa-photo-video w-6"></i>
                    <span class="text-sm">Media Library</span>
                </a>

                <a href="<?php echo ADMIN_URL; ?>/settings.php" class="nav-item flex items-center px-4 py-3 rounded-lg <?php echo ($current_admin_page == 'settings.php') ? 'active' : ''; ?>">
                    <i class="fas fa-cog w-6"></i>
                    <span class="text-sm">Settings</span>
                </a>

                <div class="pt-8 pb-2 px-4">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">System</p>
                </div>

                <a href="/" target="_blank" class="nav-item flex items-center px-4 py-3 rounded-lg">
                    <i class="fas fa-external-link-alt w-6"></i>
                    <span class="text-sm">Visit Website</span>
                </a>

                <a href="<?php echo ADMIN_URL; ?>/logout.php" class="nav-item flex items-center px-4 py-3 rounded-lg text-red-500 hover:bg-red-500/10">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="text-sm">Logout</span>
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-800">
                <div class="flex items-center space-x-3 text-xs text-gray-500">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <span>System Online</span>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Header -->
            <header class="bg-black border-b border-gray-800 h-16 flex items-center justify-between px-8 z-40">
                <div class="flex items-center">
                    <h2 class="text-lg font-heading font-semibold"><?php echo $page_title ?? 'Dashboard'; ?></h2>
                </div>
                
                <div class="flex items-center space-x-4">
                    <button class="text-gray-400 hover:text-white transition-colors relative">
                        <i class="fas fa-bell"></i>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-orange-600 rounded-full"></span>
                    </button>
                    <div class="h-6 w-[1px] bg-gray-800"></div>
                    <div class="flex items-center space-x-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-semibold">Admin User</p>
                            <p class="text-[10px] text-gray-500 text-right">Superuser</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-orange-600 flex items-center justify-center font-bold text-sm">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Page Content -->
            <main class="flex-1 overflow-y-auto admin-content p-8">
                <!-- Content injected here -->
