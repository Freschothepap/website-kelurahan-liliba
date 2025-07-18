<?php
include_once("../library/KoneksiDatabase.php");

function ambilStatistik($koneksi, $query) {
    $hasil = $koneksi->query($query);
    $data = [];
    while ($row = $hasil->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

$dataRT         = ambilStatistik($koneksi, "SELECT rt.nama_rt, COUNT(p.id_penduduk) as jumlah FROM penduduk p JOIN kepala_keluarga kk ON p.id_kepala_keluarga = kk.id_kepala_keluarga JOIN rt ON kk.id_rt = rt.id_rt GROUP BY rt.nama_rt");
$dataPekerjaan  = ambilStatistik($koneksi, "SELECT pekerjaan, COUNT(*) as jumlah FROM penduduk GROUP BY pekerjaan");
$dataPendidikan = ambilStatistik($koneksi, "SELECT pendidikan_terakhir, COUNT(*) as jumlah FROM penduduk GROUP BY pendidikan_terakhir");
$dataAgama      = ambilStatistik($koneksi, "SELECT agama, COUNT(*) as jumlah FROM penduduk GROUP BY agama");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard RW</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .card {
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
    }
    .card:hover {
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    .compact-table {
      font-size: 0.65rem;
    }
    .compact-table th, .compact-table td {
      padding: 0.2rem 0.4rem;
    }
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.01); }
    }
    .pulse {
      animation: pulse 2s ease-in-out infinite;
    }
    .chart-container {
      height: 160px;
    }
    @media (max-width: 768px) {
      .chart-container { height: 200px; }
    }
  </style>
</head>
<body class="bg-gray-50">
  <div class="container mx-auto px-3 py-5">
    <div class="flex items-center justify-between mb-6 p-4 bg-gradient-to-r from-green-900 via-emerald-800 to-green-900 rounded-lg shadow-lg border border-green-400">
  <!-- Logo -->
  <div class="flex items-center space-x-3">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/LOGO_KOTA_KUPANG.svg/975px-LOGO_KOTA_KUPANG.svg.png" alt="Logo RW" class="w-12 h-12 rounded-full border-2 border-green-400 shadow-md" />
    <div>
      <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-green-200 tracking-wide">Dashboard Kelurahan Liliba</h1>
      <p class="text-xs sm:text-sm text-green-300">Kelurahan Liliba</p>
    </div>
  </div>

  <!-- Ikon Dashboard -->
  <div class="hidden sm:block">
    <i class="fas fa-chart-line text-3xl text-green-300 animate-pulse"></i>
  </div>
</div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <?php
      $cards = [
        ['label' => 'RT', 'data' => $dataRT, 'id' => 'chartRT', 'label_field' => 'nama_rt', 'class' => 'bg-blue-50', 'warna' => ['#3B82F6','#60A5FA','#2563EB']],
        ['label' => 'Pekerjaan', 'data' => $dataPekerjaan, 'id' => 'chartPekerjaan', 'label_field' => 'pekerjaan', 'class' => 'bg-yellow-50', 'warna' => ['#FBBF24','#F59E0B','#D97706']],
        ['label' => 'Pendidikan', 'data' => $dataPendidikan, 'id' => 'chartPendidikan', 'label_field' => 'pendidikan_terakhir', 'class' => 'bg-purple-50', 'warna' => ['#A78BFA','#8B5CF6','#7C3AED']],
        ['label' => 'Agama', 'data' => $dataAgama, 'id' => 'chartAgama', 'label_field' => 'agama', 'class' => 'bg-red-50', 'warna' => ['#F87171','#EF4444','#DC2626']],
      ];

      foreach ($cards as $card):
      ?>
      <div class="card bg-white p-4">
        <div class="flex justify-between items-center mb-2">
          <h2 class="text-sm font-bold text-gray-600 uppercase"><?= $card['label'] ?></h2>
          <span class="text-[10px] <?= $card['class'] ?> text-gray-800 px-2 py-[2px] rounded-full"><?= $card['label'] ?></span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full compact-table mb-2">
            <thead class="bg-gray-100 text-gray-600">
              <tr>
                <th class="text-left">Kategori</th>
                <th class="text-right">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($card['data'] as $item): ?>
              <tr class="border-b border-gray-100 hover:bg-gray-50">
                <td><?= htmlspecialchars($item[$card['label_field']] ?: '-') ?></td>
                <td class="text-right font-semibold"><?= $item['jumlah'] ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="chart-container mt-1 pulse">
          <canvas id="<?= $card['id'] ?>"></canvas>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    const createChart = (id, labels, data, colors) => {
      const ctx = document.getElementById(id);
      const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
      gradient.addColorStop(0, colors[0]);
      gradient.addColorStop(1, colors[1]);

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Jumlah',
            data: data,
            backgroundColor: gradient,
            borderColor: colors[2],
            borderWidth: 1,
            borderRadius: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: {
            duration: 2000,
            easing: 'easeInOutQuart'
          },
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: '#111',
              titleFont: { size: 10 },
              bodyFont: { size: 10 },
              padding: 8,
              borderWidth: 1,
              cornerRadius: 6
            }
          },
          scales: {
            x: {
              ticks: { font: { size: 10 } },
              grid: { display: false }
            },
            y: {
              ticks: { font: { size: 10 }, beginAtZero: true, stepSize: 1 },
              grid: { color: 'rgba(0,0,0,0.05)' }
            }
          }
        }
      });
    };

    document.addEventListener("DOMContentLoaded", () => {
      createChart("chartRT", <?= json_encode(array_column($dataRT, 'nama_rt')) ?>, <?= json_encode(array_column($dataRT, 'jumlah')) ?>, ['#3B82F6','#BFDBFE','#2563EB']);
      createChart("chartPekerjaan", <?= json_encode(array_column($dataPekerjaan, 'pekerjaan')) ?>, <?= json_encode(array_column($dataPekerjaan, 'jumlah')) ?>, ['#FBBF24','#FDE68A','#D97706']);
      createChart("chartPendidikan", <?= json_encode(array_column($dataPendidikan, 'pendidikan_terakhir')) ?>, <?= json_encode(array_column($dataPendidikan, 'jumlah')) ?>, ['#C4B5FD','#DDD6FE','#7C3AED']);
      createChart("chartAgama", <?= json_encode(array_column($dataAgama, 'agama')) ?>, <?= json_encode(array_column($dataAgama, 'jumlah')) ?>, ['#FCA5A5','#FCD34D','#DC2626']);
    });
  </script>
</body>
</html>
