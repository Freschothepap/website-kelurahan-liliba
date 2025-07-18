<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] === "hapus") $pesan = "Data berhasil dihapus.";
    if ($_GET['pesan'] === "update") $pesan = "Data berhasil diperbarui.";
}

// Proses Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id         = $_POST['id_penduduk'];
    $nama       = $_POST['nama_penduduk'];
    $nik        = $_POST['nik'];
    $jk         = $_POST['jenis_kelamin'];
    $tempat     = $_POST['tempat_lahir'];
    $tgl        = $_POST['tanggal_lahir'];
    $status     = $_POST['status_dalam_keluarga'];
    $pendidikan = $_POST['pendidikan_terakhir'];
    $pekerjaan  = $_POST['pekerjaan'];
    $agama      = $_POST['agama'];
    $namaibu    = $_POST['namaibu'];
    $kepala     = $_POST['id_kepala_keluarga'];

    $stmt = $koneksi->prepare("UPDATE penduduk 
        SET nama_penduduk=?, nik=?, jenis_kelamin=?, tempat_lahir=?, tanggal_lahir=?, status_dalam_keluarga=?, 
            pendidikan_terakhir=?, pekerjaan=?, agama=?, namaibu=?, id_kepala_keluarga=? 
        WHERE id_penduduk=?");
    $stmt->bind_param("ssssssssssii", $nama, $nik, $jk, $tempat, $tgl, $status, $pendidikan, $pekerjaan, $agama, $namaibu, $kepala, $id);
    if ($stmt->execute()) {
        header("Location: admin.php?tampil=penduduktampil&pesan=update");
        exit;
    }
}

// Proses Hapus
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $koneksi->query("DELETE FROM penduduk WHERE id_penduduk = $id");
    header("Location: admin.php?tampil=penduduktampil&pesan=hapus");
    exit;
}

// Ambil data
$data = $koneksi->query("SELECT p.*, k.nama_kepala FROM penduduk p 
                         LEFT JOIN kepala_keluarga k ON p.id_kepala_keluarga = k.id_kepala_keluarga 
                         ORDER BY p.nama_penduduk ASC");

$kepalaList = $koneksi->query("SELECT * FROM kepala_keluarga ORDER BY nama_kepala ASC");
$kepalaOptions = [];
while ($r = $kepalaList->fetch_assoc()) {
    $kepalaOptions[$r['id_kepala_keluarga']] = $r['nama_kepala'];
}
?>

<h2 class="text-4xl font-extrabold text-red-500 uppercase tracking-wide text-center mb-6 drop-shadow">
    Data Penduduk
</h2>

<!-- Tombol Tambah -->
<div class="mb-4 flex justify-center">
    <a href="admin.php?tampil=penduduktambah" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Penduduk
    </a>
</div>

<!-- Pencarian -->
<div class="mb-2 flex justify-start">
    <input type="text" id="cariPenduduk" placeholder="Cari penduduk..." 
        class="border border-blue-500 bg-blue-100 text-black px-4 py-2 rounded w-full max-w-xs placeholder-gray-700" />
</div>

<!-- Notifikasi -->
<?php if ($pesan): ?>
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded shadow text-center">
        <?= htmlspecialchars($pesan) ?>
    </div>
<?php endif; ?>

<!-- Tabel -->
<div class="overflow-x-auto">
    <table id="tabelPenduduk" class="min-w-full table-auto border border-gray-300 bg-white shadow-md text-sm">
        <thead class="bg-gray-800 text-white">
            <tr>
                <?php
                $headers = ['No', 'Nama', 'NIK', 'JK', 'Tempat', 'Tanggal', 'Status', 'Pendidikan', 'Pekerjaan', 'Agama', 'Nama Ibu', 'Kepala Keluarga', 'Aksi'];
                foreach ($headers as $h) {
                    echo "<th class='px-4 py-2 border whitespace-nowrap'>$h</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = $data->fetch_assoc()): ?>
            <tr class="hover:bg-gray-50 <?= (isset($_GET['edit']) && $_GET['edit'] == $row['id_penduduk']) ? 'bg-yellow-100' : '' ?>">
                <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id_penduduk']): ?>
                <!-- Form Edit -->
                <form method="POST">
                    <input type="hidden" name="id_penduduk" value="<?= $row['id_penduduk'] ?>">
                    <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
                    <td class="px-4 py-2 border"><input name="nama_penduduk" value="<?= $row['nama_penduduk'] ?>" class="w-full border px-1 rounded" /></td>
                    <td class="px-4 py-2 border"><input name="nik" value="<?= $row['nik'] ?>" class="w-full border px-1 rounded" /></td>
                    <td class="px-4 py-2 border">
                        <select name="jenis_kelamin" class="w-full border rounded">
                            <option <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </td>
                    <td class="px-4 py-2 border"><input name="tempat_lahir" value="<?= $row['tempat_lahir'] ?>" class="w-full border px-1 rounded" /></td>
                    <td class="px-4 py-2 border"><input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>" class="w-full border px-1 rounded" /></td>
                    <td class="px-4 py-2 border">
                        <select name="status_dalam_keluarga" class="w-full border rounded">
                            <?php foreach (['Kepala Keluarga', 'Istri', 'Anak', 'Lainnya'] as $s): ?>
                                <option <?= $row['status_dalam_keluarga'] == $s ? 'selected' : '' ?>><?= $s ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border">
                        <select name="pendidikan_terakhir" class="w-full border rounded">
                            <?php foreach (['Tidak Sekolah','SD','SMP','SMA','D3','S1','S2','S3'] as $p): ?>
                                <option <?= $row['pendidikan_terakhir'] == $p ? 'selected' : '' ?>><?= $p ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border">
                        <select name="pekerjaan" class="w-full border rounded">
                            <?php foreach (['Pelajar','Mahasiswa','Petani','Pedagang','Guru','PNS','IRT','Tidak Bekerja'] as $job): ?>
                                <option <?= $row['pekerjaan'] == $job ? 'selected' : '' ?>><?= $job ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border">
                        <select name="agama" class="w-full border rounded">
                            <?php foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $a): ?>
                                <option <?= $row['agama'] == $a ? 'selected' : '' ?>><?= $a ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border"><input name="namaibu" value="<?= $row['namaibu'] ?>" class="w-full border px-1 rounded" /></td>
                    <td class="px-4 py-2 border">
                        <select name="id_kepala_keluarga" class="w-full border rounded">
                            <?php foreach ($kepalaOptions as $id => $nama): ?>
                                <option value="<?= $id ?>" <?= $row['id_kepala_keluarga'] == $id ? 'selected' : '' ?>><?= $nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border text-center space-x-1">
                        <button type="submit" name="update" class="inline-block bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 transition">
                            <i class="fas fa-save"></i>
                        </button>
                        <a href="admin.php?tampil=penduduktampil" class="inline-block bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition">
                            <i class="fas fa-times"></i>
                        </a>
                    </td>
                </form>
                <?php else: ?>
                <!-- Normal Row -->
                <td class="px-4 py-2 border text-center"><?= $no++ ?></td>
                <td class="px-4 py-2 border"><?= $row['nama_penduduk'] ?></td>
                <td class="px-4 py-2 border"><?= $row['nik'] ?></td>
                <td class="px-4 py-2 border"><?= $row['jenis_kelamin'] ?></td>
                <td class="px-4 py-2 border"><?= $row['tempat_lahir'] ?></td>
                <td class="px-4 py-2 border"><?= $row['tanggal_lahir'] ?></td>
                <td class="px-4 py-2 border"><?= $row['status_dalam_keluarga'] ?></td>
                <td class="px-4 py-2 border"><?= $row['pendidikan_terakhir'] ?></td>
                <td class="px-4 py-2 border"><?= $row['pekerjaan'] ?></td>
                <td class="px-4 py-2 border"><?= $row['agama'] ?></td>
                <td class="px-4 py-2 border"><?= $row['namaibu'] ?></td>
                <td class="px-4 py-2 border"><?= $row['nama_kepala'] ?></td>
                <td class="px-4 py-2 border text-center space-x-2">
                    <a href="admin.php?tampil=penduduktampil&edit=<?= $row['id_penduduk'] ?>" 
                       class="inline-block bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500 transition">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="admin.php?tampil=penduduktampil&hapus=<?= $row['id_penduduk'] ?>" 
                       onclick="return confirm('Yakin ingin menghapus data ini?')" 
                       class="inline-block bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 transition">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Script Pencarian -->
<script>
    document.getElementById('cariPenduduk').addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tabelPenduduk tbody tr');

        rows.forEach(row => {
            const teks = row.innerText.toLowerCase();
            row.style.display = teks.includes(keyword) ? '' : 'none';
        });
    });
</script>
