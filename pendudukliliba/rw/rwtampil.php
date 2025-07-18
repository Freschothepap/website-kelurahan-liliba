<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";

// Proses Hapus
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $stmt = $koneksi->prepare("DELETE FROM rw WHERE id_rw = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php?tampil=rwtampil&pesan=hapus");
    exit;
}

// Proses Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rw'])) {
    $id        = intval($_POST['id_rw']);
    $nomor_rw  = trim($_POST['nomor_rw']);
    $nama_rw   = trim($_POST['nama_rw']);
    $alamat_rw = trim($_POST['alamat_rw']);

    if ($nomor_rw && $nama_rw && $alamat_rw) {
        $stmt = $koneksi->prepare("UPDATE rw SET nomor_rw = ?, nama_rw = ?, alamat_rw = ? WHERE id_rw = ?");
        $stmt->bind_param("sssi", $nomor_rw, $nama_rw, $alamat_rw, $id);
        $stmt->execute();
        header("Location: admin.php?tampil=rwtampil&pesan=update");
        exit;
    } else {
        $pesan = "Semua kolom wajib diisi.";
    }
}

// Notifikasi
if (isset($_GET['pesan'])) {
    switch ($_GET['pesan']) {
        case 'hapus': $pesan = "Data berhasil dihapus."; break;
        case 'update': $pesan = "Data berhasil diperbarui."; break;
        case 'simpan': $pesan = "Data berhasil disimpan."; break;
    }
}
?>

<h2 class="text-4xl font-extrabold text-red-500 uppercase tracking-wide text-center mb-6 drop-shadow">
    Data RW 
</h2>

<!-- Tombol Tambah -->
<div class="mb-4 flex justify-center">
    <a href="admin.php?tampil=rwtambah" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah RW 
    </a>
</div>

<!-- Input Pencarian -->
<div class="mb-2 flex justify-start">
    <input type="text" id="cariRw" placeholder="Cari RW..." 
        class="border border-green-500 bg-green-100 text-black px-4 py-2 rounded w-full max-w-xs placeholder-gray-700" />
</div>

<!-- Notifikasi -->
<?php if ($pesan): ?>
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded shadow text-center">
        <?= htmlspecialchars($pesan) ?>
    </div>
<?php endif; ?>

<!-- Tabel -->
<div class="overflow-x-auto">
    <table id="tabelRw" class="min-w-full table-auto border border-gray-300 bg-white shadow-md text-sm">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Nomor RW</th>
                <th class="px-4 py-2 border">Nama RW</th>
                <th class="px-4 py-2 border">Alamat RW</th>
                <th class="px-4 py-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $result = $koneksi->query("SELECT * FROM rw ORDER BY nomor_rw ASC");
            while ($row = $result->fetch_assoc()):
            ?>
            <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id_rw']): ?>
            <!-- Form Edit -->
            <tr class="bg-yellow-100">
                <form method="POST">
                    <input type="hidden" name="id_rw" value="<?= $row['id_rw'] ?>">
                    <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
                    <td class="px-4 py-2 border">
                        <input type="text" name="nomor_rw" value="<?= htmlspecialchars($row['nomor_rw']) ?>" required class="w-full border px-2 py-1 rounded" />
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="text" name="nama_rw" value="<?= htmlspecialchars($row['nama_rw']) ?>" required class="w-full border px-2 py-1 rounded" />
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="text" name="alamat_rw" value="<?= htmlspecialchars($row['alamat_rw']) ?>" required class="w-full border px-2 py-1 rounded" />
                    </td>
                    <td class="px-4 py-2 border text-center">
                        <button type="submit" class="inline-flex items-center bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                        <a href="admin.php?tampil=rwtampil" class="inline-flex items-center bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition ml-2">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </td>
                </form>
            </tr>
            <?php else: ?>
            <!-- Baris Tampil -->
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($row['nomor_rw']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($row['nama_rw']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($row['alamat_rw']) ?></td>
                <td class="px-4 py-2 border text-center space-x-2">
                    <a href="admin.php?tampil=rwtampil&edit=<?= $row['id_rw'] ?>" class="inline-block bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="admin.php?tampil=rwtampil&hapus=<?= $row['id_rw'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" 
                       class="inline-block bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 transition">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <?php endif; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Script Pencarian -->
<script>
    document.getElementById('cariRw').addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tabelRw tbody tr');

        rows.forEach(row => {
            const teks = row.innerText.toLowerCase();
            row.style.display = teks.includes(keyword) ? '' : 'none';
        });
    });
</script>
