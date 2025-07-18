<?php
session_start();
session_unset();    // Hapus semua variabel session
session_destroy();  // Hancurkan session

// Redirect ke halaman login
header("Location: /datarw/index.php"); // Ubah sesuai lokasi login kamu
exit;
