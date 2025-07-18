<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";

// Proses Simpan Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_rw  = trim($_POST['nomor_rw']);
    $nama_rw   = trim($_POST['nama_rw']);
    $alamat_rw = trim($_POST['alamat_rw']);

    if ($nomor_rw && $nama_rw && $alamat_rw) {
        $stmt = $koneksi->prepare("INSERT INTO rw (nomor_rw, nama_rw, alamat_rw) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nomor_rw, $nama_rw, $alamat_rw);

        if ($stmt->execute()) {
            header("Location: adminrt.php?tampil=rwtampil&pesan=simpan");
            exit;
        } else {
            $pesan = "Gagal menyimpan data.";
        }
    } else {
        $pesan = "Semua kolom wajib diisi.";
    }
}
?>

<h2 class="text-3xl font-bold text-center text-blue-700 uppercase mb-6">Tambah RW</h2>

<?php if (!empty($pesan)): ?>
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-center"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<form method="POST" class="max-w-xl mx-auto bg-white p-6 rounded shadow border">
    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">Nomor RW</label>
        <input type="text" name="nomor_rw" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" placeholder="Masukkan Nomor RW">
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">Nama RW</label>
        <input type="text" name="nama_rw" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" placeholder="Masukkan Nama RW">
    </div>

    <div class="mb-6">
        <label class="block font-semibold text-gray-700 mb-1">Alamat RW</label>
        <textarea name="alamat_rw" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" placeholder="Masukkan Alamat Lengkap"></textarea>
    </div>

    <div class="flex justify-end gap-3 mt-4">
        <a href="adminrt.php?tampil=rwtampil" 
           class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
            <i class="fas fa-times mr-2"></i> Batal
        </a>
        <button type="submit"
                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <i class="fas fa-save mr-2"></i> Simpan
        </button>
    </div>
</form>
