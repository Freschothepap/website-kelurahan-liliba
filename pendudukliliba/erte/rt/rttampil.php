<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";

// Proses Hapus
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $stmt = $koneksi->prepare("DELETE FROM rt WHERE id_rt = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: adminrt.php?tampil=rttampil&pesan=hapus");
    exit;
}

// Proses Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rt'])) {
    $id = intval($_POST['id_rt']);
    $nomor_rt  = trim($_POST['nomor_rt']);
    $nama_rt   = trim($_POST['nama_rt']);
    $alamat_rt = trim($_POST['alamat_rt']);
    $id_rw     = intval($_POST['id_rw']);

    if ($nomor_rt && $nama_rt && $alamat_rt && $id_rw) {
        $stmt = $koneksi->prepare("UPDATE rt SET nomor_rt = ?, nama_rt = ?, alamat_rt = ?, id_rw = ? WHERE id_rt = ?");
        $stmt->bind_param("sssii", $nomor_rt, $nama_rt, $alamat_rt, $id_rw, $id);
        $stmt->execute();
        header("Location: adminrt.php?tampil=rttampil&pesan=update");
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

// Ambil data RT dan RW
$query = "SELECT rt.*, rw.nomor_rw FROM rt JOIN rw ON rt.id_rw = rw.id_rw ORDER BY rt.nomor_rt ASC";
$result = $koneksi->query($query);

// Ambil semua RW untuk dropdown
$data_rw = $koneksi->query("SELECT id_rw, nomor_rw FROM rw ORDER BY nomor_rw ASC");
$rw_options = [];
while ($rw = $data_rw->fetch_assoc()) {
    $rw_options[$rw['id_rw']] = $rw['nomor_rw'];
}
?>

<h2 class="text-4xl font-extrabold text-red-500 uppercase tracking-wide text-center mb-6 drop-shadow">
    Data RT 
</h2>

<!-- Tombol Tambah -->
<div class="mb-4 flex justify-center">
    <a href="adminrt.php?tampil=rttambah" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah RT
    </a>
</div>

<!-- Pencarian -->
<div class="mb-2 flex justify-start">
    <input type="text" id="cariRt" placeholder="Cari RT..." 
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
    <table id="tabelRt" class="min-w-full table-auto border border-gray-300 bg-white shadow-md text-sm">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Nomor RT</th>
                <th class="px-4 py-2 border">Nama RT</th>
                <th class="px-4 py-2 border">RW Induk</th>
                <th class="px-4 py-2 border">Alamat RT</th>
                <th class="px-4 py-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id_rt']): ?>
        <!-- Form Edit -->
        <tr class="bg-yellow-100">
            <form method="POST">
                <input type="hidden" name="id_rt" value="<?= $row['id_rt'] ?>">
                <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
                <td class="px-4 py-2 border">
                    <input type="text" name="nomor_rt" value="<?= htmlspecialchars($row['nomor_rt']) ?>" required class="w-full border px-2 py-1 rounded" />
                </td>
                <td class="px-4 py-2 border">
                    <input type="text" name="nama_rt" value="<?= htmlspecialchars($row['nama_rt']) ?>" required class="w-full border px-2 py-1 rounded" />
                </td>
                <td class="px-4 py-2 border">
                    <select name="id_rw" class="w-full border px-2 py-1 rounded" required>
                        <?php foreach ($rw_options as $id_rw => $nomor_rw): ?>
                            <option value="<?= $id_rw ?>" <?= $id_rw == $row['id_rw'] ? 'selected' : '' ?>>
                                RW <?= $nomor_rw ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="px-4 py-2 border">
                    <input type="text" name="alamat_rt" value="<?= htmlspecialchars($row['alamat_rt']) ?>" required class="w-full border px-2 py-1 rounded" />
                </td>
                <td class="px-4 py-2 border text-center">
                    <button type="submit" class="inline-flex items-center bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                    <a href="adminrt.php?tampil=rttampil" class="inline-flex items-center bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition ml-2">
                        <i class="fas fa-times mr-1"></i> Batal
                    </a>
                </td>
            </form>
        </tr>
        <?php else: ?>
        <!-- Tampil Normal -->
        <tr class="hover:bg-gray-100">
            <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
            <td class="px-4 py-2 border"><?= htmlspecialchars($row['nomor_rt']) ?></td>
            <td class="px-4 py-2 border"><?= htmlspecialchars($row['nama_rt']) ?></td>
            <td class="px-4 py-2 border">RW <?= htmlspecialchars($row['nomor_rw']) ?></td>
            <td class="px-4 py-2 border"><?= htmlspecialchars($row['alamat_rt']) ?></td>
            <td class="px-4 py-2 border text-center space-x-2">
                <a href="adminrt.php?tampil=rttampil&edit=<?= $row['id_rt'] ?>" 
                   class="inline-block bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 transition">
                   <i class="fas fa-edit"></i> Edit
                </a>
                <a href="adminrt.php?tampil=rttampil&hapus=<?= $row['id_rt'] ?>" 
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
    document.getElementById('cariRt').addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tabelRt tbody tr');

        rows.forEach(row => {
            const teks = row.innerText.toLowerCase();
            row.style.display = teks.includes(keyword) ? '' : 'none';
        });
    });
</script>
