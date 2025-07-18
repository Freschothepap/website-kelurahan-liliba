<?php
$host = "localhost";
$user = "root";
$pass = ""; // ganti jika ada password
$db   = "data_rw";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
