<?php
$tampil = $_GET['tampil'] ?? 'home';

$pages = [
    'home' => 'home.php',

    // RW
    'rwtampil' => 'rw/rwtampil.php',
    'rwtambah' => 'rw/rwtambah.php',

    // RT
    'rttampil' => 'rt/rttampil.php',
    'rttambah' => 'rt/rttambah.php',

    // Penduduk
    'penduduktampil' => 'penduduk/penduduktampil.php',
    'penduduktambah' => 'penduduk/penduduktambah.php',

    // Kepala Keluarga
    'kepalakeluargatampil' => 'kepalakeluarga/kepalakeluargatampil.php',
    'kepalakeluargatambah' => 'kepalakeluarga/kepalakeluargatambah.php',

    // Pengaturan
    'pengguna' => 'pengguna.php',
    'pengaturan' => 'pengaturan.php'
];

if (array_key_exists($tampil, $pages)) {
    include __DIR__ . '/' . $pages[$tampil];
} else {
    echo "<div class='text-red-500 p-4'>Halaman <strong>$tampil</strong> tidak ditemukan.</div>";
}

