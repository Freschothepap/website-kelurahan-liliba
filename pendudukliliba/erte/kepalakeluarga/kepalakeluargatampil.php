<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";

// Proses Hapus
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $stmt = $koneksi->prepare("DELETE FROM kepala_keluarga WHERE id_kepala_keluarga = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php?tampil=kepalakeluargatampil&pesan=hapus");
    exit;
}

// Proses Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_kepala_keluarga'])) {
    $id     = intval($_POST['id_kepala_keluarga']);
    $id_rt  = intval($_POST['id_rt']);
    $nama   = trim($_POST['nama_kepala']);
    $no_kk  = trim($_POST['no_kk']);
    $alamat = trim($_POST['alamat']);
    $kec_kel = trim($_POST['kecdankelurahan']);

    if ($id_rt && $nama && $no_kk && $alamat && $kec_kel) {
        $stmt = $koneksi->prepare("UPDATE kepala_keluarga SET id_rt = ?, nama_kepala = ?, no_kk = ?, alamat = ?, kecdankelurahan = ? WHERE id_kepala_keluarga = ?");
        $stmt->bind_param("issssi", $id_rt, $nama, $no_kk, $alamat, $kec_kel, $id);
        $stmt->execute();
        header("Location: admin.php?tampil=kepalakeluargatampil&pesan=update");
        exit;
    } else {
        $pesan = "Semua kolom wajib diisi.";
    }
}

// Tampilkan Pesan
if (isset($_GET['pesan'])) {
    switch ($_GET['pesan']) {
        case 'hapus': $pesan = "Data berhasil dihapus."; break;
        case 'update': $pesan = "Data berhasil diperbarui."; break;
        case 'simpan': $pesan = "Data berhasil disimpan."; break;
    }
}
?>

<h2 class="text-4xl font-extrabold text-red-500 uppercase tracking-wide text-center mb-6 drop-shadow">
    Data Kepala Keluarga
</h2>

<!-- Tombol Tambah -->
<div class="mb-4 flex justify-center">
    <a href="admin.php?tampil=kepalakeluargatambah" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Kepala Keluarga
    </a>
</div>

<!-- Input Pencarian -->
<div class="mb-2 flex justify-start">
    <input type="text" id="cariKk" placeholder="Cari Kepala Keluarga..." 
        class="border border-green-500 bg-green-100 text-black px-4 py-2 rounded w-full max-w-xs placeholder-gray-700" />
</div>

<!-- Notifikasi -->
<?php if ($pesan): ?>
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded shadow text-center"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<!-- Tabel -->
<div class="overflow-x-auto">
    <table id="tabelKk" class="min-w-full table-auto border border-gray-300 bg-white shadow-md text-sm">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">No KK</th>
                <th class="px-4 py-2 border">Nama Kepala</th>
                <th class="px-4 py-2 border">Alamat</th>
                <th class="px-4 py-2 border">Kecamatan / Kelurahan</th>
                <th class="px-4 py-2 border">RT</th>
                <th class="px-4 py-2 border">RW</th>
                <th class="px-4 py-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $result = $koneksi->query("
            SELECT kk.*, rt.nomor_rt, rw.nomor_rw 
            FROM kepala_keluarga kk 
            JOIN rt ON kk.id_rt = rt.id_rt 
            JOIN rw ON rt.id_rw = rw.id_rw 
            ORDER BY kk.no_kk ASC
        ");
        while ($row = $result->fetch_assoc()):
        ?>
        <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id_kepala_keluarga']): ?>
        <!-- Form Edit -->
        <tr class="bg-yellow-100">
            <form method="POST">
                <input type="hidden" name="id_kepala_keluarga" value="<?= $row['id_kepala_keluarga'] ?>">
                <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
                <td class="px-4 py-2 border">
                    <input type="text" name="no_kk" value="<?= htmlspecialchars($row['no_kk']) ?>" required class="w-full border px-2 py-1 rounded" />
                </td>
                <td class="px-4 py-2 border">
                    <input type="text" name="nama_kepala" value="<?= htmlspecialchars($row['nama_kepala']) ?>" required class="w-full border px-2 py-1 rounded" />
                </td>
                <td class="px-4 py-2 border">
                    <input type="text" name="alamat" value="<?= htmlspecialchars($row['alamat']) ?>" required class="w-full border px-2 py-1 rounded" />
                </td>
                <td class="px-4 py-2 border">
                        <select name="kecdankelurahan" class="w-full border rounded">
                            <?php foreach (['Kecamatan Oebobo / Kelurahan Liliba'] as $a): ?>
                                <option <?= $row['kecdankelurahan'] == $a ? 'selected' : '' ?>><?= $a ?></option>
                            <?php endforeach; ?>
                        </select>
                <td class="px-4 py-2 border">
                    <select name="id_rt" class="w-full border px-2 py-1 rounded" required>
                        <?php
                        $rts = $koneksi->query("SELECT rt.id_rt, rt.nomor_rt, rw.nomor_rw FROM rt JOIN rw ON rt.id_rw = rw.id_rw");
                        while ($rt = $rts->fetch_assoc()):
                            $selected = $rt['id_rt'] == $row['id_rt'] ? 'selected' : '';
                            echo "<option value='{$rt['id_rt']}' $selected>RT {$rt['nomor_rt']} / RW {$rt['nomor_rw']}</option>";
                        endwhile;
                        ?>
                    </select>
                </td>
                <td class="px-4 py-2 border text-center">-</td>
                <td class="px-4 py-2 border text-center">
                    <button type="submit" class="inline-flex items-center bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                    <a href="admin.php?tampil=kepalakeluargatampil" 
                       class="inline-flex items-center bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition ml-2">
                        <i class="fas fa-times mr-1"></i> Batal
                    </a>
                </td>
            </form>
        </tr>
        <?php else: ?>
        <!-- Tampil Normal -->
        <tr class="hover:bg-gray-100">
            <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
            <td class="px-4 py-2 border"><?= htmlspecialchars($row['no_kk']) ?></td>
            <td class="px-4 py-2 border"><?= htmlspecialchars($row['nama_kepala']) ?></td>
            <td class="px-4 py-2 border"><?= htmlspecialchars($row['alamat']) ?></td>
            <td class="px-4 py-2 border"><?= htmlspecialchars($row['kecdankelurahan']) ?></td>
            <td class="px-4 py-2 border text-center"><?= htmlspecialchars($row['nomor_rt']) ?></td>
            <td class="px-4 py-2 border text-center"><?= htmlspecialchars($row['nomor_rw']) ?></td>
            <td class="px-4 py-2 border text-center space-x-2">
                <a href="admin.php?tampil=kepalakeluargatampil&edit=<?= $row['id_kepala_keluarga'] ?>" 
                   class="inline-block bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 transition">
                   <i class="fas fa-edit"></i> Edit
                </a>
                <a href="admin.php?tampil=kepalakeluargatampil&hapus=<?= $row['id_kepala_keluarga'] ?>" 
                   onclick="return confirm('Yakin ingin menghapus data ini?')" 
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
document.getElementById('cariKk').addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tabelKk tbody tr');

    rows.forEach(row => {
        const teks = row.innerText.toLowerCase();
        row.style.display = teks.includes(keyword) ? '' : 'none';
    });
});
</script>
