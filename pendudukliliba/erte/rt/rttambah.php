<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";

// Ambil data RW untuk dropdown
$result_rw = $koneksi->query("SELECT id_rw, nomor_rw FROM rw ORDER BY nomor_rw ASC");

// Proses Simpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_rt  = trim($_POST['nomor_rt']);
    $nama_rt   = trim($_POST['nama_rt']);
    $alamat_rt = trim($_POST['alamat_rt']);
    $id_rw     = intval($_POST['id_rw']);

    if ($nomor_rt && $nama_rt && $alamat_rt && $id_rw) {
        $stmt = $koneksi->prepare("INSERT INTO rt (nomor_rt, nama_rt, alamat_rt, id_rw) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nomor_rt, $nama_rt, $alamat_rt, $id_rw);

        if ($stmt->execute()) {
            header("Location: adminrt.php?tampil=rttampil&pesan=simpan");
            exit;
        } else {
            $pesan = "Gagal menyimpan data.";
        }
    } else {
        $pesan = "Semua kolom wajib diisi.";
    }
}
?>

<h2 class="text-3xl font-bold text-center text-blue-700 uppercase mb-6">Tambah RT</h2>

<?php if (!empty($pesan)): ?>
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-center"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<form method="POST" class="max-w-xl mx-auto bg-white p-6 rounded shadow border">
    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">Nomor RT</label>
        <input type="text" name="nomor_rt" required 
               class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500"
               placeholder="Masukkan Nomor RT">
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">Nama RT</label>
        <input type="text" name="nama_rt" required 
               class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500"
               placeholder="Masukkan Nama RT">
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">Alamat RT</label>
        <textarea name="alamat_rt" required
                  class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500"
                  placeholder="Masukkan Alamat RT Lengkap"></textarea>
    </div>

    <div class="mb-6">
        <label class="block font-semibold text-gray-700 mb-1">Pilih RW Induk</label>
        <select name="id_rw" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            <option value="">-- Pilih RW --</option>
            <?php while ($rw = $result_rw->fetch_assoc()): ?>
                <option value="<?= $rw['id_rw'] ?>">RW <?= htmlspecialchars($rw['nomor_rw']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="flex justify-end gap-3 mt-4">
        <a href="adminrt.php?tampil=rttampil" 
           class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
            <i class="fas fa-times mr-2"></i> Batal
        </a>
        <button type="submit"
                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <i class="fas fa-save mr-2"></i> Simpan
        </button>
    </div>
</form>
