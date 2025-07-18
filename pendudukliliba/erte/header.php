<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-collapsed {
            width: 80px !important;
            transition: all 0.3s ease;
        }
        .sidebar-collapsed .nav-text {
            display: none !important;
        }
        .main-content-expanded {
            margin-left: 280px;
            transition: all 0.3s ease;
        }
        .main-content-collapsed {
            margin-left: 80px;
            transition: all 0.3s ease;
        }

        /* Efek shimmer untuk nama admin */
        .shimmer-text {
            background: linear-gradient(to right, #3b82f6, #9333ea);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            to {
                background-position: -200% center;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="fixed top-0 right-0 left-0 bg-gradient-to-r from-blue-600 to-purple-600 shadow-md z-10">
        <div class="flex items-center justify-between px-6 py-3">
            <div class="flex items-center">
                <button id="toggleSidebar" class="text-white hover:text-gray-200 focus:outline-none mr-4">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-semibold text-white">Dasboard RT</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="text-white hover:text-gray-200 focus:outline-none">
                        <i class="fas fa-bell text-xl"></i>
                    </button>
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </div>
                <div class="relative">
                    <button id="profileDropdown" class="flex items-center space-x-2 focus:outline-none">
                        <div class="h-8 w-8 rounded-full bg-gray-300 overflow-hidden">
                            <img src="https://dpppanttprov.org/wp-content/uploads/2024/05/LOGO-NTT2.png" alt="Foto Profil" class="w-full h-full object-cover">
                        </div>
                        <span class="font-medium shimmer-text">Admin</span>
                        <i class="fas fa-chevron-down text-xs text-white"></i>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
