<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIM Innovation Fest - Tahap 1</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/iconpim.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        html { scroll-behavior: smooth; }
        section { scroll-margin-top: 96px; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 text-justify">

<!-- NAVBAR -->
<header class="bg-white shadow fixed w-full top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 grid grid-cols-3 items-center">

        <div class="flex items-center gap-3">
            <img src="{{ asset('img/iconLogo.png') }}" class="w-12 h-12">
            <div class="font-bold text-indigo-600 leading-tight">
                <div class="text-lg">PUPUK ISKANDAR MUDA</div>
                <div class="text-base font-medium">INNOVATION FEST</div>
            </div>
        </div>

        <nav class="hidden md:flex justify-center gap-6 text-lg font-semibold">
    <a href="{{ route('tahapanapp.registrasi') }}"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-user-plus"></i>1
    </a>

    <a href="{{ route('tahapanapp.judul') }}"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-file-signature"></i> 2
    </a>

    <a href="{{ route('tahapanapp.proposal') }}"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-file-alt"></i> 3
    </a>

    <a href="{{ route('tahapanapp.finalisasi') }}"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-check-circle"></i> 4
    </a>
</nav>

        <div class="flex justify-end">
            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition text-sm">
                <i class="fas fa-sign-in-alt mr-1"></i>Login
            </a>
        </div>
    </div>
</header>

<!-- CONTENT -->
<main class="pt-28">
<section id="tahap1" class="min-h-screen flex items-center justify-center px-4 py-16">
    <div class="max-w-6xl w-full grid md:grid-cols-2 gap-12">

        <!-- LEFT: Penjelasan Tahapan -->
        <div data-aos="fade-right" class="space-y-6">
            <h1 class="text-3xl font-bold text-blue-700 mb-4">
                Tahap 1: Registrasi & Login
            </h1>

            <p class="text-gray-700 text-base leading-relaxed">
                Peserta harus membuat akun untuk dapat melanjutkan ke seluruh tahapan lomba.
                Jika belum memiliki akun, klik tombol <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded">Daftar Sekarang</span> dan isi formulir registrasi.
                Pastikan data yang dimasukkan lengkap dan benar karena akan digunakan untuk login dan komunikasi resmi.
            </p>

            <h2 class="text-xl font-semibold text-blue-600 mb-2">Langkah-langkah Registrasi & Login:</h2>

            <ol class="list-decimal list-inside space-y-3 text-gray-800 text-base">
                <li>
                    <strong>Daftar Akun:</strong>
                    Klik tombol "Daftar Sekarang" pada halaman beranda untuk masuk ke halaman registrasi. Isi semua data: Nama Team, Unit Kerja, Email Team, dan Password. Pastikan email aktif untuk menerima notifikasi jika lupa password dan notifikasi verifikasi proposal.
                </li>
                <li>
                    <strong>Login:</strong>
                    Jika sudah registrasi, selanjutnya klik tombol Login untuk masuk ke dalam sistem.Masukkan Email dan Password yang telah didaftarkan. Jika berhasil, Anda diarahkan ke dashboard peserta.
                </li>
                <li>
                    <strong>Lupa Password:</strong>
                    Jika lupa password, klik tombol <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded">Lupa Password</span> pada halaman login.
                    Masukkan email terdaftar, kemudian sistem akan mengirim link reset password ke email Anda.
                </li>
                <li>
                    <strong>Reset Password:</strong>
                    Klik link pada email reset password, buat password baru yang aman. Gunakan kombinasi huruf, angka, dan simbol. Login menggunakan password baru.
                </li>
                <li>
                    <strong>Selanjutnya:</strong>
                    Setelah login berhasil, lanjut ke <strong>Tahap 2: Pengajuan Judul</strong>.
                </li>
            </ol>

            <div class="mt-6 flex gap-4">
                <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition text-sm flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- RIGHT CARD: Visual & Tips -->
            <div data-aos="fade-up"
    class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition duration-300">

    <div class="text-center mb-5">
        <i class="fas fa-user-plus text-3xl text-blue-600 mb-2"></i>
        <h2 class="text-base font-medium text-blue-700">
            Catatan Penting Saat Registrasi
        </h2>
    </div>

    <p class="text-gray-600 text-sm text-center mb-5 leading-relaxed">
        Ikuti setiap langkah dengan cermat. Pastikan data lengkap dan email aktif.
    </p>

    <div class="border-t border-gray-200 pt-3">
        <h3 class="font-medium text-sm mb-3 text-gray-800">Tips penting:</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-2 text-sm leading-relaxed">
            <li>Email aktif dan valid.</li>
            <li>Password aman dan mudah diingat.</li>
            <li>Gunakan fitur Lupa Password jika diperlukan.</li>
            <li>Simpan informasi akun dengan baik.</li>
            <li>Periksa kembali data sebelum mendaftar.</li>
        </ul>
    </div>
</div>


    </div>
</section>
</main>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 900, once: true });
</script>

</body>
</html>
