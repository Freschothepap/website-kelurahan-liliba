<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/datarw/library/KoneksiDatabase.php');

$pesan = "";

// Proses Simpan Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_rt   = intval($_POST['id_rt']);
    $nama    = trim($_POST['nama_kepala']);
    $no_kk   = trim($_POST['no_kk']);
    $alamat  = trim($_POST['alamat']);
    $kec_kel = trim($_POST['kecdankelurahan']);

    if ($id_rt && $nama && $no_kk && $alamat && $kec_kel) {
        // Cek duplikasi No KK
        $cek = $koneksi->prepare("SELECT id_kepala_keluarga FROM kepala_keluarga WHERE no_kk = ?");
        $cek->bind_param("s", $no_kk);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {
            $pesan = "No KK sudah terdaftar!";
        } else {
            $stmt = $koneksi->prepare("INSERT INTO kepala_keluarga (id_rt, nama_kepala, no_kk, alamat, kecdankelurahan) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $id_rt, $nama, $no_kk, $alamat, $kec_kel);

            if ($stmt->execute()) {
                header("Location: admin.php?tampil=kepalakeluargatampil&pesan=simpan");
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

<h2 class="text-3xl font-bold text-center text-blue-700 uppercase mb-6">Tambah Kepala Keluarga</h2>

<?php if (!empty($pesan)): ?>
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded text-center"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<form method="POST" class="max-w-xl mx-auto bg-white p-6 rounded shadow border">
    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">No KK</label>
        <input type="text" name="no_kk" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" placeholder="Masukkan Nomor KK">
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">Nama Kepala Keluarga</label>
        <input type="text" name="nama_kepala" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" placeholder="Masukkan Nama Kepala Keluarga">
    </div>

    <div class="mb-4">
        <label class="block font-semibold text-gray-700 mb-1">Alamat</label>
        <textarea name="alamat" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500" placeholder="Masukkan Alamat Lengkap"></textarea>
    </div>

    <div class="mb-4">
    <label class="block font-semibold text-gray-700 mb-1">Kecamatan / Kelurahan</label>
    <select name="kecdankelurahan" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500 bg-white">
        <option value="">-- Pilih Kecamatan / Kelurahan --</option>
        <option value="Kecamatan Oebobo / Kelurahan Liliba">Kecamatan Oebobo / Kelurahan Liliba</option>
    </select>
</div>


    <div class="mb-6">
        <label class="block font-semibold text-gray-700 mb-1">Pilih RT / RW</label>
        <select name="id_rt" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            <option value="">-- Pilih RT / RW --</option>
            <?php
            $rts = $koneksi->query("SELECT rt.id_rt, rt.nomor_rt, rw.nomor_rw 
                                    FROM rt JOIN rw ON rt.id_rw = rw.id_rw 
                                    ORDER BY rw.nomor_rw, rt.nomor_rt");
            while ($rt = $rts->fetch_assoc()):
                echo "<option value='{$rt['id_rt']}'>RT {$rt['nomor_rt']} / RW {$rt['nomor_rw']}</option>";
            endwhile;
            ?>
        </select>
    </div>

    <div class="flex justify-end gap-3 mt-4">
        <a href="admin.php?tampil=kepalakeluargatampil" 
           class="inline-flex items-center bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
            <i class="fas fa-times mr-2"></i> Batal
        </a>
        <button type="submit"
                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <i class="fas fa-save mr-2"></i> Simpan
        </button>
    </div>
</form>
