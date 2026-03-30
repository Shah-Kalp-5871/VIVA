<?php
require_once 'includes/config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Simple hardcoded login for demonstration
    if ($username === 'admin' && $password === 'viva123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = 'Admin';
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIVA Admin - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        black: '#000000',
                        orange: {
                            600: '#FF5722',
                            700: '#E64A19',
                        }
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .login-bg {
            background-image: 
                radial-gradient(circle at 2px 2px, #333 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-black text-white font-heading min-h-screen flex items-center justify-center login-bg p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8 italic">
            <div class="flex items-center justify-center space-x-3 mb-2">
                <img src="../v.jpeg" alt="VIVA Logo" class="w-12 h-12 rounded bg-white p-1 shadow-lg shadow-orange-600/20">
            </div>
            <h1 class="text-2xl font-extrabold tracking-tight">VIVA <span class="text-orange-600 uppercase">Engineering</span></h1>
            <p class="text-gray-500 text-xs tracking-[0.2em] uppercase mt-1">Management Controls</p>
        </div>

        <!-- Login Card -->
        <div class="bg-[#111] border border-gray-800 rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-bold mb-6">Admin Sign In</h2>
            
            <?php if ($error): ?>
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 text-sm p-3 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Username</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="username" required 
                            class="w-full bg-black border border-gray-800 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600 transition-all"
                            placeholder="Enter username">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" id="password" required 
                            class="w-full bg-black border border-gray-800 rounded-xl py-3 pl-12 pr-12 text-white focus:outline-none focus:border-orange-600 focus:ring-1 focus:ring-orange-600 transition-all font-sans"
                            placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-orange-600 transition-colors focus:outline-none">
                            <i class="fas fa-eye text-sm" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs py-2">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" class="rounded border-gray-800 bg-black text-orange-600 focus:ring-0 mr-2">
                        <span class="text-gray-500 group-hover:text-gray-300">Remember me</span>
                    </label>
                    <a href="#" class="text-gray-500 hover:text-orange-600 transition-colors">Forgot password?</a>
                </div>

                <button type="submit" 
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-orange-600/30 transform active:scale-95">
                    Access Dashboard
                </button>
            </form>
        </div>

        <div class="text-center mt-8">
            <a href="../" class="text-gray-500 text-sm hover:text-white transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Main Site
            </a>
        </div>
        
        <p class="text-center text-[10px] text-gray-600 mt-12 uppercase tracking-widest">
            © <?php echo date('Y'); ?> VIVA Engineering • Industrial Systems
        </p>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle the icon
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
