<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RW Liliba - Gerbang Informasi Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2c7873',
                        secondary: '#6fb98f',
                        accent: '#ff9a00',
                        dark: '#2d3436',
                        light: '#f5f6fa'
                    }
                }
            }
        }
    </script>
    <style>
        .hero-image {
            height: 60vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/7d77ff84-20c8-4b21-8568-8c4193bdf9d2.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.03);
        }
        
        @media (max-width: 768px) {
            .hero-image {
                height: 40vh;
            }
        }
    </style>
</head>
<body class="bg-light text-dark font-sans">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHiAosAotxIMcTYPX9bSCap1L7h97j3L3c6A&s" alt="Logo RW Liliba bergambar pohon dan rumah dengan warna hijau" class="w-10 h-10">
                <h1 class="text-xl md:text-2xl font-bold text-primary">Kelurahan Liliba</h1>
            </div>
            <nav class="hidden md:flex space-x-6">
                <a href="#home" class="font-medium hover:text-accent transition">Beranda</a>
                <a href="#visi-misi" class="font-medium hover:text-accent transition">Visi Misi</a>
                <a href="#galeri" class="font-medium hover:text-accent transition">Galeri</a>
                <a href="#pengumuman" class="font-medium hover:text-accent transition">Pengumuman</a>
                <a href="#kontak" class="font-medium hover:text-accent transition">Kontak</a>
            </nav>
            <div>
                <a href="pendudukliliba/index.php" class="bg-accent text-white px-4 py-2 rounded hover:bg-orange-600 transition">Masuk</a>
            </div>
            <button id="mobileMenuBtn" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white shadow-lg">
            <div class="container mx-auto px-4 py-2 flex flex-col space-y-3">
                <a href="#home" class="py-2 border-b border-gray-100">Beranda</a>
                <a href="#visi-misi" class="py-2 border-b border-gray-100">Visi Misi</a>
                <a href="#galeri" class="py-2 border-b border-gray-100">Galeri</a>
                <a href="#pengumuman" class="py-2 border-b border-gray-100">Pengumuman</a>
                <a href="#" class="py-2">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero-image text-white">
        <div class="text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Kelurahan Liliba</h1>
            <p class="text-xl md:text-2xl mb-6">Membangun masyarakat yang harmonis, sejahtera, dan berbudaya</p>
            <a href="#tentang" class="bg-accent text-white px-6 py-3 rounded-md font-medium hover:bg-opacity-90 transition inline-block">Kenali Kami</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1ad4470b-5f51-4b65-aa29-207e986e0ddc.png" alt="Pemandangan wilayah RW Liliba dengan rumah-rumah dan pepohonan rindang" class="w-full rounded-lg shadow-lg hover-scale">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold text-primary mb-6">Tentang Kelurahan Liliba</h2>
                    <p class="text-gray-700 mb-4">RW Liliba merupakan bagian dari Kelurahan Liliba yang terletak di Kota Kupang, Nusa Tenggara Timur. Wilayah kami dikenal dengan keramahan warganya dan lingkungan yang asri.</p>
                    <p class="text-gray-700 mb-6">Dengan jumlah penduduk sekitar 1.200 jiwa, RW Liliba terus berupaya meningkatkan kesejahteraan masyarakat melalui berbagai program pembangunan dan pemberdayaan warga.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-light p-4 rounded-lg">
                            <h3 class="font-bold text-secondary text-xl">1200+</h3>
                            <p class="text-gray-600">Jumlah Penduduk</p>
                        </div>
                        <div class="bg-light p-4 rounded-lg">
                            <h3 class="font-bold text-secondary text-xl">15+</h3>
                            <p class="text-gray-600">Program Tahun Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section id="visi-misi" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-primary mb-12">Visi & Misi Kelurahan Liliba</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Visi -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="bg-primary text-white p-3 rounded-full mr-4">
                            <i class="fas fa-bullseye text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary">Visi</h3>
                    </div>
                    <p class="text-gray-700">"Mewujudkan RW Liliba sebagai wilayah yang aman, nyaman, dan sejahtera dengan masyarakat yang berdaya saing tinggi berbasis nilai-nilai kearifan lokal."</p>
                </div>
                
                <!-- Misi -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale">
                    <div class="flex items-center mb-4">
                        <div class="bg-secondary text-white p-3 rounded-full mr-4">
                            <i class="fas fa-tasks text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary">Misi</h3>
                    </div>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Meningkatkan partisipasi masyarakat dalam pembangunan</li>
                        <li>Mengembangkan program pemberdayaan ekonomi warga</li>
                        <li>Memperkuat keamanan dan ketertiban lingkungan</li>
                        <li>Meningkatkan pelayanan administrasi warga</li>
                        <li>Melestarikan nilai-nilai budaya lokal</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-primary mb-12">Galeri Kegiatan</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition hover-scale">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/92fd4142-fb44-43e9-bb4e-53835275e845.png" alt="Kegiatan gotong royong membersihkan lingkungan RW Liliba" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Gotong Royong</h3>
                        <p class="text-gray-600">Kegiatan bersih-bersih lingkungan bulanan</p>
                    </div>
                </div>
                
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition hover-scale">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/0eb3ea2e-4dfb-4630-bdc0-2c25f606f4c9.png" alt="Pelatihan kerajinan tangan untuk ibu-ibu PKK RW Liliba" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Pelatihan PKK</h3>
                        <p class="text-gray-600">Pelatihan kerajinan tangan dari bahan daur ulang</p>
                    </div>
                </div>
                
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition hover-scale">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/272d52d2-79cc-4d16-a373-31916abab27d.png" alt="Perayaan hari kemerdekaan dengan lomba-lomba tradisional" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">17-an</h3>
                        <p class="text-gray-600">Perayaan HUT RI ke-78 di RW Liliba</p>
                    </div>
                </div>
                
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition hover-scale">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/79e135bd-f133-48cf-84ab-f676e63641fd.png" alt="Penyuluhan kesehatan tentang pencegahan DBD dari puskesmas" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Penyuluhan Kesehatan</h3>
                        <p class="text-gray-600">Edukasi pencegahan DBD oleh puskesmas</p>
                    </div>
                </div>
                
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition hover-scale">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/e527f9d1-242a-4a11-af3f-3d33fad5bfae.png" alt="Kegiatan posyandu untuk pemeriksaan balita dan lansia" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Posyandu</h3>
                        <p class="text-gray-600">Pemeriksaan kesehatan balita dan lansia</p>
                    </div>
                </div>
                
                <div class="rounded-lg overflow-hidden shadow-md hover:shadow-lg transition hover-scale">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/bfb67629-0c1b-4121-8e72-e94bb30591ad.png" alt="Pertemuan warga membahas program kerja RW" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Musyawarah Warga</h3>
                        <p class="text-gray-600">Rapat koordinasi program kerja RW</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <button class="bg-primary text-white px-6 py-3 rounded-md font-medium hover:bg-opacity-90 transition">Lihat Semua Foto</button>
            </div>
        </div>
    </section>

    <!-- Pengumuman Section -->
    <section id="pengumuman" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-primary mb-12">Pengumuman Terkini</h2>
            
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 hover:shadow-lg transition hover-scale">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-accent text-white text-sm px-3 py-1 rounded-full">Penting</span>
                            <span class="text-gray-500 text-sm">2 Hari yang lalu</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Jadwal Vaksinasi Booster Minggu Ini</h3>
                        <p class="text-gray-700 mb-4">Diberitahukan kepada seluruh warga RW Liliba bahwa akan dilaksanakan vaksinasi booster pada hari Sabtu, 10 Juni 2023 pukul 08.00-14.00 WITA di Balai RW.</p>
                        <button class="text-primary font-medium hover:underline">Baca selengkapnya...</button>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 hover:shadow-lg transition hover-scale">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-secondary text-white text-sm px-3 py-1 rounded-full">Kegiatan</span>
                            <span class="text-gray-500 text-sm">1 Minggu yang lalu</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Gotong Royong Bulanan</h3>
                        <p class="text-gray-700 mb-4">Akan dilaksanakan gotong royong rutin bulanan pada hari Minggu, 4 Juni 2023 pukul 07.00 WITA. Seluruh warga diharapkan hadir dengan membawa peralatan kebersihan.</p>
                        <button class="text-primary font-medium hover:underline">Baca selengkapnya...</button>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition hover-scale">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-primary text-white text-sm px-3 py-1 rounded-full">Informasi</span>
                            <span class="text-gray-500 text-sm">2 Minggu yang lalu</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Perubahan Jadwal Sampah</h3>
                        <p class="text-gray-700 mb-4">Mulai 1 Juni 2023, jadwal pengambilan sampah di wilayah RW Liliba akan berubah menjadi hari Senin, Rabu, dan Jumat pagi.</p>
                        <button class="text-primary font-medium hover:underline">Baca selengkapnya...</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-bold text-primary">Masuk ke Sistem</h3>
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <form id="loginForm">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                        <input type="text" id="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Masukkan username">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" id="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Masukkan password">
                    </div>
                    <button type="submit" class="w-full bg-primary text-white py-2 rounded-md font-medium hover:bg-opacity-90 transition">Masuk</button>
                </form>
                <p class="text-center text-gray-600 mt-4">Belum punya akun? <a href="#" class="text-primary hover:underline">Daftar disini</a></p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="kontak" class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
                    <div class="space-y-2">
                        <p><i class="fas fa-map-marker-alt mr-2"></i> Jl. Liliba No. 123, Kupang</p>
                        <p><i class="fas fa-phone-alt mr-2"></i> (0380) 1234567</p>
                        <p><i class="fas fa-envelope mr-2"></i> rw.liliba@gmail.com</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Jam Layanan</h3>
                    <div class="space-y-2">
                        <p>Senin - Jumat: 08.00 - 16.00 WITA</p>
                        <p>Sabtu: 08.00 - 14.00 WITA</p>
                        <p>Minggu & Hari Besar: Tutup</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-2xl hover:text-accent transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-accent transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-2xl hover:text-accent transition"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-2xl hover:text-accent transition"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-gray-300 py-6">
        <div class="container mx-auto px-4 text-center">
            <p>© 2023 RW Liliba. Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    
</body>
</html>

