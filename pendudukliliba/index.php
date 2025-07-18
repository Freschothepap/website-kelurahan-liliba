<?php
session_start();
require_once(__DIR__ . '/../library/KoneksiDatabase.php');

$error = "";
$success = "";

$rememberedUser  = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role     = trim($_POST['role']);
    $remember = isset($_POST['remember']);
    $password_md5 = md5($password);

    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $hasil = $stmt->get_result();

    if ($hasil->num_rows === 1) {
        $user = $hasil->fetch_assoc();
        if ($password_md5 === $user['password'] && $role === $user['role']) {
            $_SESSION['id_user']      = $user['id_user'];
            $_SESSION['username']     = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role']         = $user['role'];

            if ($remember) {
                setcookie("remember_username", $username, time() + (86400 * 30), "/");
            } else {
                setcookie("remember_username", "", time() - 3600, "/");
            }

            if ($role === 'admin') {
                header("Location: /datarw/pendudukliliba/admin.php");
                exit;
            } elseif ($role === 'ketua_rt'){
                header("Location: /datarw/pendudukliliba/erte/adminrt.php");
                exit;
            } else {
                header("Location: /datarw/pendudukliliba/admin.php");
                exit;
            }
        } else {
            $error = "Password atau hak akses salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login RW 05</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        @keyframes backgroundAnimation {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 0%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        body {
            background-image: url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5ff20571-d88a-4dca-92e7-c6aeba712b38.png');
            background-size: cover;
            background-attachment: fixed;
            animation: backgroundAnimation 30s ease infinite;
        }

        @keyframes backgroundAnimation {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 0%;
    }
    100% {
        background-position: 0% 0%;
    }
}

body {
    background-image: url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5ff20571-d88a-4dca-92e7-c6aeba712b38.png');
    background-size: cover;
    background-attachment: fixed;
    animation: backgroundAnimation 30s ease infinite;
}

    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

    <div class="flex flex-col md:flex-row w-full max-w-3xl bg-white/90 rounded-2xl shadow-2xl overflow-hidden">
        
        <!-- KIRI -->
        <div class="md:w-1/2 bg-red-700 text-white flex flex-col justify-center items-center p-6">
            <img src="https://dpppanttprov.org/wp-content/uploads/2024/05/LOGO-NTT2.png" alt="Logo RW" class="mb-4">
            <h2 class="text-2xl font-bold tracking-wide">Kelurahan Liliba</h2>
            <p class="text-sm text-red-100 text-center mt-2 px-2">Sistem Informasi Penduduk Kelurahan Liliba</p>
        </div>

        <!-- KANAN -->
        <div class="md:w-1/2 p-6 bg-black text-white">
            <h2 class="text-2xl font-bold text-red-500 mb-2">Login Akun</h2>
            <p class="text-sm text-gray-400 mb-4">Masukkan akun Anda dengan benar</p>

            <?php if ($error): ?>
                <div class="bg-red-600/20 text-red-300 p-2 mb-3 rounded text-center text-sm">
                    <i class="fas fa-exclamation-circle mr-2"></i><?= $error ?>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="bg-green-600/20 text-green-300 p-2 mb-3 rounded text-center text-sm">
                    <i class="fas fa-check-circle mr-2"></i><?= $success ?>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-3 text-sm">
                <div>
                    <label class="block mb-1 font-medium text-gray-300">Username</label>
                    <div class="relative">
                        <input type="text" name="username" value="<?= htmlspecialchars($rememberedUser ) ?>" class="w-full px-4 py-2 bg-gray-900 text-white border border-gray-700 rounded-lg pl-10 focus:ring-2 focus:ring-red-600" required>
                        <i class="fas fa-user absolute left-3 top-2.5 text-gray-500"></i>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-300">Password</label>
                    <div class="relative">
                        <input type="password" id="passwordInput" name="password" class="w-full px-4 py-2 bg-gray-900 text-white border border-gray-700 rounded-lg pl-10 pr-10 focus:ring-2 focus:ring-red-600" required>
                        <i class="fas fa-lock absolute left-3 top-2.5 text-gray-500"></i>
                        <i id="togglePassword" class="fas fa-eye absolute right-3 top-2.5 text-gray-500 cursor-pointer"></i>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-300">Hak Akses</label>
                    <select name="role" class="w-full px-4 py-2 bg-gray-900 text-white border border-gray-700 rounded-lg focus:ring-2 focus:ring-red-600" required>
                        <option value="" disabled selected>Pilih Hak Akses</option>
                        <option value="admin">Admin</option>
                        <option value="ketua_rt">Ketua RT</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2" <?= $rememberedUser  ? 'checked' : '' ?>>
                    <label class="text-gray-400">Ingat saya</label>
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>

            <div class="mt-4 text-center text-sm text-gray-400">
                Belum punya akun? <a href="register.php" class="text-red-400 hover:underline">Daftar sekarang</a>
            </div>

            <div class="mt-4 text-center text-xs text-gray-500">
                &copy; <?= date("Y") ?> RW 05
            </div>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('passwordInput');
        toggle.addEventListener('click', function () {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
