<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<main id="mainContent" class="pt-20 transition-all ml-64 min-h-screen p-8 bg-gray-100">
    <?php include 'konten.php'; ?>
</main>

<!-- JAVASCRIPT INTERAKSI SIDEBAR & DROPDOWN -->
<script>
    // Toggle Sidebar Slide
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn?.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full');  // Sembunyikan sidebar
        sidebar.classList.toggle('absolute');           // Lepaskan posisi tetap
        mainContent.classList.toggle('ml-64');          // Hapus margin
        mainContent.classList.toggle('ml-0');           // Full width
    });

    // Dropdown Profil
    document.getElementById('profileDropdown')?.addEventListener('click', function () {
        document.getElementById('dropdownMenu')?.classList.toggle('hidden');
    });

    // Klik di luar dropdown: tutup menu
    window.addEventListener('click', function (e) {
        if (!e.target.closest('#profileDropdown')) {
            document.getElementById('dropdownMenu')?.classList.add('hidden');
        }
    });
</script>
<?php ob_end_flush(); ?>

</body>
</html>
