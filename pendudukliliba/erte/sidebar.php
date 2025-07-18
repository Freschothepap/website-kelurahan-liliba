<?php // Penting: Tidak boleh ada spasi/enter sebelum tag ini ?>
<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-blue-600 via-indigo-500 to-purple-600 text-white shadow-2xl z-20 mt-16 overflow-y-auto transition-all duration-300">
    <!-- Logo Instansi -->
    <div class="p-4 flex flex-col items-center text-center border-b border-indigo-300">
        <div class="relative w-20 h-20 rounded-full overflow-hidden shadow-xl border-4 border-white bg-white animate-pulse">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8mjubVFOfQAL-4V5xzv2ixzctnQYZjebZ5g&s" alt="Logo RW" class="w-full h-full object-contain p-1">
        </div>
        <h3 class="mt-2 font-bold text-lg tracking-wide text-white">Dashboard RT</h3>
        <p class="text-xs text-indigo-200">Kelurahan Liliba</p>
    </div>

    <!-- Navigasi -->
    <nav class="mt-4 text-sm font-medium">
        <div class="px-5 mb-2">
            <p class="text-indigo-200 uppercase text-xs font-semibold tracking-widest">Menu Utama</p>
        </div>
        <ul class="space-y-1">
            <li>
                <a href="adminrt.php?tampil=home" class="flex items-center px-5 py-2 hover:bg-indigo-400 hover:text-white rounded-md transition duration-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/1946/1946436.png" class="w-5 h-5 mr-3 filter brightness-0 invert" alt="Dashboard">
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="adminrt.php?tampil=rwtampil" class="flex items-center px-5 py-2 hover:bg-indigo-400 hover:text-white rounded-md transition duration-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" class="w-5 h-5 mr-3" alt="RW">
                    <span>Data RW</span>
                </a>
            </li>
            <li>
                <a href="adminrt.php?tampil=rttampil" class="flex items-center px-5 py-2 hover:bg-indigo-400 hover:text-white rounded-md transition duration-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="w-5 h-5 mr-3" alt="RT">
                    <span>Data RT</span>
                </a>
            </li>
            <li>
                <a href="adminrt.php?tampil=kepalakeluargatampil" class="flex items-center px-5 py-2 hover:bg-indigo-400 hover:text-white rounded-md transition duration-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/2769/2769339.png" class="w-5 h-5 mr-3" alt="Keluarga">
                    <span>Data Keluarga</span>
                </a>
            </li>
            <li>
                <a href="adminrt.php?tampil=penduduktampil" class="flex items-center px-5 py-2 hover:bg-indigo-400 hover:text-white rounded-md transition duration-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/1256/1256650.png" class="w-5 h-5 mr-3" alt="Penduduk">
                    <span>Data Penduduk</span>
                </a>
            </li>
        </ul>

        <div class="px-5 mt-6 mb-2">
            <p class="text-indigo-200 uppercase text-xs font-semibold tracking-widest">Pengaturan</p>
        </div>
        <ul class="space-y-1 mb-4">
            <li>
                <a href="adminrt.php?tampil=pengaturan" class="flex items-center px-5 py-2 hover:bg-indigo-400 hover:text-white rounded-md transition duration-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/126/126472.png" class="w-5 h-5 mr-3" alt="Pengaturan">
                    <span>Pengaturan Sistem</span>
                </a>
            </li>
            <li>
                <a href="adminrt.php?tampil=pengguna" class="flex items-center px-5 py-2 hover:bg-indigo-400 hover:text-white rounded-md transition duration-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" class="w-5 h-5 mr-3" alt="Pengguna">
                    <span>Manajemen Pengguna</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
