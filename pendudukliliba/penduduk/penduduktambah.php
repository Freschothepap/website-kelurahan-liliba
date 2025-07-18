<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";
$sukses = false;

$kepalaQuery = $koneksi->query("SELECT id_kepala_keluarga, nama_kepala FROM kepala_keluarga ORDER BY nama_kepala ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kepala     = intval($_POST['id_kepala_keluarga']);
    $nama          = trim($_POST['nama_penduduk']);
    $nik           = trim($_POST['nik']);
    $jenis_kelamin = trim($_POST['jenis_kelamin']);
    $tempat_lahir  = trim($_POST['tempat_lahir']);
    $tanggal_lahir = trim($_POST['tanggal_lahir']);
    $status_keluarga = trim($_POST['status_dalam_keluarga']);
    $pendidikan    = trim($_POST['pendidikan_terakhir']);
    $pekerjaan     = trim($_POST['pekerjaan']);
    $agama         = trim($_POST['agama']);
    $namaibu       = trim($_POST['namaibu']);

    if ($id_kepala && $nama && $nik && $jenis_kelamin && $status_keluarga && $agama && $namaibu) {
        $cek = $koneksi->prepare("SELECT id_penduduk FROM penduduk WHERE nik = ?");
        $cek->bind_param("s", $nik);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {
            $pesan = "NIK sudah terdaftar!";
        } else {
            $stmt = $koneksi->prepare("INSERT INTO penduduk 
                (id_kepala_keluarga, nama_penduduk, nik, jenis_kelamin, tempat_lahir, tanggal_lahir, status_dalam_keluarga, pendidikan_terakhir, pekerjaan, agama, namaibu) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssssssss", $id_kepala, $nama, $nik, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $status_keluarga, $pendidikan, $pekerjaan, $agama, $namaibu);

            if ($stmt->execute()) {
                header("Location: admin.php?tampil=penduduktampil&pesan=simpan");
                exit;
            } else {
                $pesan = "Gagal menyimpan data.";
            }
        }
    } else {
        $pesan = "Semua field wajib diisi.";
    }
}
?>

<h2 class="text-3xl font-bold text-center text-blue-700 uppercase mb-6">Tambah Penduduk</h2>

<?php if ($pesan): ?>
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-center"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<form method="POST" class="max-w-xl mx-auto bg-white p-6 rounded shadow border">
    <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Penduduk</label>
        <input type="text" name="nama_penduduk" required class="w-full border px-3 py-2 rounded" placeholder="Masukkan nama lengkap">
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">NIK</label>
        <input type="text" name="nik" required class="w-full border px-3 py-2 rounded" placeholder="Masukkan NIK">
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Jenis Kelamin</label>
        <select name="jenis_kelamin" required class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="w-full border px-3 py-2 rounded" placeholder="Masukkan tempat lahir">
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="w-full border px-3 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Status dalam Keluarga</label>
        <select name="status_dalam_keluarga" required class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih Status --</option>
            <option value="Kepala Keluarga">Kepala Keluarga</option>
            <option value="Istri">Istri</option>
            <option value="Anak">Anak</option>
            <option value="Lainnya">Lainnya</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Pendidikan Terakhir</label>
        <select name="pendidikan_terakhir" class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih Pendidikan --</option>
            <option value="Tidak Sekolah">Tidak Sekolah</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMA</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Pekerjaan</label>
        <select name="pekerjaan" class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih Pekerjaan --</option>
            <option value="Petani">Petani</option>
            <option value="Pedagang">Pedagang</option>
            <option value="Guru">Guru</option>
            <option value="PNS">PNS</option>
            <option value="IRT">IRT</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Tidak Bekerja">Tidak Bekerja</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Agama</label>
        <select name="agama" required class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih Agama --</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Ibu</label>
        <input type="text" name="namaibu" required class="w-full border px-3 py-2 rounded" placeholder="Masukkan nama ibu kandung">
    </div>

    <div class="mb-6">
        <label class="block font-semibold mb-1">Pilih Kepala Keluarga</label>
        <select name="id_kepala_keluarga" required class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih Kepala Keluarga --</option>
            <?php while ($row = $kepalaQuery->fetch_assoc()): ?>
                <option value="<?= $row['id_kepala_keluarga'] ?>"><?= htmlspecialchars($row['nama_kepala']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="flex justify-end gap-3 mt-4">
        <a href="admin.php?tampil=penduduktampil" class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
            <i class="fas fa-times mr-2"></i> Batal
        </a>
        <button type="submit" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <i class="fas fa-save mr-2"></i> Simpan
        </button>
    </div>
</form>
