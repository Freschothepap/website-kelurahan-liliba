<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard RW</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto px-4 py-8">
    <!-- Judul -->
    <div class="mb-6">
      <h2 class="text-3xl font-bold flex items-center text-gray-800">
        <i class="fas fa-home text-gray-600 mr-2"></i> Dashboard Sistem RW 05
      </h2>
      <p class="text-gray-500 text-sm">Statistik dan informasi terbaru wilayah RW 05</p>
    </div>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
      <div class="bg-gradient-to-r from-gray-800 to-gray-600 text-white rounded-lg shadow p-4">
        <div class="flex items-center space-x-3">
          <i class="fas fa-users text-3xl"></i>
          <div>
            <p class="text-sm">Total KK</p>
            <p class="text-xl font-bold">4</p>
          </div>
        </div>
      </div>
      <div class="bg-gradient-to-r from-gray-800 to-gray-600 text-white rounded-lg shadow p-4">
        <div class="flex items-center space-x-3">
          <i class="fas fa-users-cog text-3xl"></i>
          <div>
            <p class="text-sm">Total Penduduk</p>
            <p class="text-xl font-bold">16</p>
          </div>
        </div>
      </div>
      <div class="bg-gradient-to-r from-gray-800 to-gray-600 text-white rounded-lg shadow p-4">
        <div class="flex items-center space-x-3">
          <i class="fas fa-home text-3xl"></i>
          <div>
            <p class="text-sm">Total Penduduk satu kelurahan</p>
            <p class="text-xl font-bold">180</p>
          </div>
        </div>
      </div>
      <div class="bg-gradient-to-r from-gray-800 to-gray-600 text-white rounded-lg shadow p-4">
        <div class="flex items-center space-x-3">
          <i class="fas fa-user-friends text-3xl"></i>
          <div>
            <p class="text-sm">Total Penduduk</p>
            <p class="text-xl font-bold">790</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Data Terbaru -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Data RW -->
      <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Data RW Terbaru</h3>
        <ul class="text-sm text-gray-700 space-y-2">
          <li>RW 01 - Budi</li>
          <li>RW 02 - Santi</li>
          <li>RW 03 - Amir</li>
          <li>RW 04 - Lestari</li>
        </ul>
      </div>

      <!-- Data RT -->
      <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Data RT Terbaru</h3>
        <ul class="text-sm text-gray-700 space-y-2">
          <li>RT 01 - Doni</li>
          <li>RT 02 - Fitri</li>
          <li>RT 03 - Indra</li>
          <li>RT 04 - Rani</li>
        </ul>
      </div>

      <!-- Kepala Keluarga -->
      <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Kepala Keluarga Terbaru</h3>
        <ul class="text-sm text-gray-700 space-y-2">
          <li>Ahmad - No KK: 123456</li>
          <li>Sri - No KK: 123457</li>
          <li>Joko - No KK: 123458</li>
          <li>Desi - No KK: 123459</li>
        </ul>
      </div>

      <!-- Penduduk -->
      <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Penduduk Terbaru</h3>
        <ul class="text-sm text-gray-700 space-y-2">
          <li>Bambang - NIK: 320101111</li>
          <li>Dina - NIK: 320101112</li>
          <li>Andi - NIK: 320101113</li>
          <li>Maya - NIK: 320101114</li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>
