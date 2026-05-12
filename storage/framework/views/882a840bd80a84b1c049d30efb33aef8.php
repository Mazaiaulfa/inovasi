<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIM Innovation Fest - Tahap 2: Pengajuan Judul</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="<?php echo e(asset('img/iconpim.png')); ?>">
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
            <img src="<?php echo e(asset('img/iconLogo.png')); ?>" class="w-12 h-12">
            <div class="font-bold text-indigo-600 leading-tight">
                <div class="text-lg">PUPUK ISKANDAR MUDA</div>
                <div class="text-base font-medium">INNOVATION FEST</div>
            </div>
        </div>

            <nav class="hidden md:flex justify-center gap-6 text-lg font-semibold">
    <a href="<?php echo e(route('tahapanapp.registrasi')); ?>"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-user-plus"></i>1
    </a>

    <a href="<?php echo e(route('tahapanapp.judul')); ?>"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-file-signature"></i> 2
    </a>

    <a href="<?php echo e(route('tahapanapp.proposal')); ?>"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-file-alt"></i> 3
    </a>

    <a href="<?php echo e(route('tahapanapp.finalisasi')); ?>"
       class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
       <i class="fas fa-check-circle"></i> 4
    </a>
</nav>

        <div class="flex justify-end">
            <a href="<?php echo e(route('login')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition text-sm">
                <i class="fas fa-sign-in-alt mr-1"></i>Login
            </a>
        </div>
    </div>
</header>

<!-- CONTENT -->
<main class="pt-28">
<section id="tahap2" class="min-h-screen flex items-center justify-center px-4 py-16">
    <div class="max-w-6xl w-full grid md:grid-cols-2 gap-12">

        <!-- LEFT: Penjelasan Tahapan -->
        <div data-aos="fade-right" class="space-y-6">
            <h1 class="text-3xl font-bold text-blue-700 mb-4">
                Tahap 2: Pengajuan Judul
            </h1>

            <p class="text-gray-700 text-base leading-relaxed">
                Setelah peserta login, Peserta masuk ke halaman Dashboard. Peserta dapat mengajukan judul inovasi melalui halaman judul yang tersedia di sidebar.
                Proses pengajuan harus dilakukan dengan teliti agar judul diterima oleh panitia.
            </p>

            <h2 class="text-xl font-semibold text-blue-600 mb-2">Langkah-langkah Pengajuan Judul:</h2>

            <ol class="list-decimal list-inside space-y-3 text-gray-800 text-base">
                <li>
                    <strong>Masuk ke Menu Judul:</strong> Peserta yang telah login akan masuk ke halaman dashboard peserta, selanjutnya pilih menu <em> Judul</em> untuk masuk ke halaman pengajuan judul.
                </li>
                <li>
                    <strong>Klik Tombol "Ajukan Judul":</strong> Setelah di klik akan muncul form pengisian judul dan file judul.
                </li>
                <li>
                    <strong>Masukkan Nama Judul:</strong> Ketik judul inovasi sesuai tema PIM Innovation Fest. Pastikan judul sudah fix dan benar.
                </li>
                <li>
                    <strong>Upload File Pengajuan:</strong> Siapkan dokumen pengajuan dalam format pdf yang memuat deskripsi inovasi, tujuan, dan rencana pelaksanaan.
                </li>
                <li>
                    <strong>Periksa Data Pengajuan:</strong> Pastikan semua informasi dan file sudah benar sebelum menekan tombol kirim.
                </li>
                <li>
                    <strong>Klik Tombol "Ajukan":</strong> Mengirimkan judul ke panitia. Tunggu konfirmasi pengiriman berhasil.
                </li>
                <li>
                    <strong>Tunggu Verifikasi Panitia:</strong> Panitia akan meninjau dan menyetujui atau menolak judul. Peserta menerima notifikasi status pengajuan melalui email team yang telah didaftarkan.
                </li>
            </ol>

            <div class="mt-6 flex gap-4">
                <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition text-sm flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- RIGHT CARD: Visual & Tips -->
        <div data-aos="fade-up" class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition duration-300">
            <div class="text-center mb-5">
                <i class="fas fa-list-check text-3xl text-blue-600 mb-2"></i>
                <h2 class="text-base font-medium text-blue-700">Informasi Penting Pengajuan Judul</h2>
            </div>

            <p class="text-gray-600 text-sm text-center mb-5 leading-relaxed">
                Ikuti setiap langkah dengan cermat agar proses pengajuan judul berjalan lancar dan sesuai aturan.
            </p>

            <div class="border-t border-gray-200 pt-3">
                <h3 class="font-medium text-sm mb-3 text-gray-800">Tips penting:</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2 text-sm leading-relaxed">
                    <li>Judul harus relevan dengan tema PIM Innovation Fest.</li>
                    <li>File pengajuan harus lengkap dan jelas.</li>
                    <li>Periksa kembali sebelum mengirim untuk menghindari kesalahan.</li>
                    <li>Ikuti notifikasi dari panitia untuk update status dan tahapan berikutnya.</li>
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
<?php /**PATH C:\laragon\www\inovasirev\resources\views/tahapanapp/judul.blade.php ENDPATH**/ ?>