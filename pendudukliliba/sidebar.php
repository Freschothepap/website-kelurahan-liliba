<?php // Penting: Tidak boleh ada spasi/enter sebelum tag ini ?>
<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-black via-red-900 to-red-700 text-white shadow-xl z-20 mt-16 overflow-y-auto transition-all duration-300">
    <!-- Logo RW -->
    <div class="p-4 flex flex-col items-center text-center border-b border-red-700">
        <div class="relative w-20 h-20 rounded-full overflow-hidden shadow-lg border-2 border-white bg-white">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/LOGO_KOTA_KUPANG.svg/975px-LOGO_KOTA_KUPANG.svg.png" alt="Logo RW" class="w-full h-full object-cover">
        </div>
        <h3 class="mt-2 font-bold text-lg tracking-wide text-white">Dasboard Kelurahan Liliba</h3>
        <p class="text-xs text-red-300">Kelurahan Liliba</p>
    </div>

    <!-- Navigasi -->
    <nav class="mt-4 text-sm font-medium">
        <div class="px-5 mb-2">
            <p class="text-red-300 uppercase text-xs font-semibold tracking-widest">Main Menu</p>
        </div>
        <ul class="space-y-1">
            <li>
                <a href="admin.php?tampil=home" class="flex items-center px-5 py-2 hover:bg-red-800 hover:text-white rounded-md transition duration-200 group">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-red-300 group-hover:text-white transition duration-300"></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin.php?tampil=rwtampil" class="flex items-center px-5 py-2 hover:bg-red-800 hover:text-white rounded-md transition duration-200 group">
                    <i class="fas fa-users mr-3 w-5 text-red-300 group-hover:text-white transition duration-300"></i><span>Data RW</span>
                </a>
            </li>
            <li>
                <a href="admin.php?tampil=rttampil" class="flex items-center px-5 py-2 hover:bg-red-800 hover:text-white rounded-md transition duration-200 group">
                    <i class="fas fa-users-cog mr-3 w-5 text-red-300 group-hover:text-white transition duration-300"></i><span>Data RT</span>
                </a>
            </li>
            <li>
                <a href="admin.php?tampil=kepalakeluargatampil" class="flex items-center px-5 py-2 hover:bg-red-800 hover:text-white rounded-md transition duration-200 group">
                    <i class="fas fa-home mr-3 w-5 text-red-300 group-hover:text-white transition duration-300"></i><span>Data Keluarga</span>
                </a>
            </li>
            <li>
                <a href="admin.php?tampil=penduduktampil" class="flex items-center px-5 py-2 hover:bg-red-800 hover:text-white rounded-md transition duration-200 group">
                    <i class="fas fa-user-friends mr-3 w-5 text-red-300 group-hover:text-white transition duration-300"></i><span>Data Penduduk</span>
                </a>
            </li>
        </ul>

        <div class="px-5 mt-6 mb-2">
            <p class="text-red-300 uppercase text-xs font-semibold tracking-widest">Pengaturan</p>
        </div>
        <ul class="space-y-1 mb-4">
            <li>
                <a href="admin.php?tampil=pengaturan" class="flex items-center px-5 py-2 hover:bg-red-800 hover:text-white rounded-md transition duration-200 group">
                    <i class="fas fa-cog mr-3 w-5 text-red-300 group-hover:text-white transition duration-300"></i><span>Pengaturan Sistem</span>
                </a>
            </li>
            <li>
                <a href="admin.php?tampil=pengguna" class="flex items-center px-5 py-2 hover:bg-red-800 hover:text-white rounded-md transition duration-200 group">
                    <i class="fas fa-user-shield mr-3 w-5 text-red-300 group-hover:text-white transition duration-300"></i><span>Manajemen Pengguna</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
