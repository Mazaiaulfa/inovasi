<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PIM Innovation Fest - Finalisasi Makalah</title>

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
            <a href="{{ route('tahapanapp.registrasi') }}" class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
                <i class="fas fa-user-plus"></i>1
            </a>
            <a href="{{ route('tahapanapp.judul') }}" class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
                <i class="fas fa-file-signature"></i>2
            </a>
            <a href="{{ route('tahapanapp.proposal') }}" class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
                <i class="fas fa-file-alt"></i>3
            </a>
            <a href="{{ route('tahapanapp.finalisasi') }}" class="flex items-center gap-2 hover:text-indigo-600 transition-colors duration-300">
                <i class="fas fa-check-circle"></i>4
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
<section class="min-h-screen flex items-center justify-center px-4 py-16">
    <div class="max-w-6xl w-full grid md:grid-cols-2 gap-12">

        <!-- LEFT: Tahapan Finalisasi -->
        <div data-aos="fade-right" class="space-y-6">

            <h1 class="text-3xl font-bold text-blue-700 mb-4">
                Tahap 4: Finalisasi Makalah / Proposal
            </h1>

            <p class="text-gray-700 text-base leading-relaxed">
                Setelah makalah atau proposal direvisi dan disetujui admin, peserta wajib melakukan finalisasi dokumen.
                Proses ini memastikan dokumen akhir lengkap, resmi, dan siap untuk penilaian.
            </p>

            <h2 class="text-xl font-semibold text-blue-600 mb-2">Langkah-langkah Finalisasi:</h2>

            <ol class="list-decimal list-inside space-y-3 text-gray-800 text-base">
                <li>
                    <strong>Masuk ke Menu Finalisasi:</strong>
                    Untuk melakukan finalisasi pilih menu <em>Submit Final</em> untuk memulai proses finalisasi.
                </li>
                <li>
                    <strong>Pilih Judul Makalah:</strong>
                    Setelah masuk ke halaman finalisasi, pilih judul yang sebelumnya telah diajukan dan disetujui untuk melakukan submit final.
                </li>
                <li>
                    <strong>Upload File Final:</strong>
                    Selanjutnya unggah dokumen makalah/proposal final dalam format PDF yang lengkap, sesuai struktur, dan siap dinilai.
                </li>
                <li>
                    <strong>Periksa Kembali Dokumen:</strong>
                    Sebelum klik tumbol upload, pastikan file final lengkap, tidak ada kesalahan pengetikan, dan sudah sesuai ketentuan format.
                </li>
                <li>
                    <strong>Klik Tombol "Upload":</strong>
                    Setelah semua data diisi, klik tombol upload agar file akan dikirim ke tabel data peserta dan diteruskan ke admin untuk diverifikasi.
                </li>
                <li>
                    <strong>Menunggu Verifikasi Admin:</strong>
                    Admin akan meninjau dokumen final. Status verifikasi dapat berupa: disetujui, perlu revisi, atau ditolak. Peserta diharapkan dapat cek email secara berkala untuk notifikasi status verifikasi.
                </li>
            </ol>

            <p class="mt-4 text-gray-600 text-base">
                Setelah dokumen final diverifikasi, peserta dapat melanjutkan ke tahapan berikutnya seperti presentasi atau penilaian kompetisi.
            </p>

            <div class="mt-4 flex gap-4">
                <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition text-sm flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

        </div>

        <!-- RIGHT CARD: Panduan Finalisasi -->
        <div data-aos="fade-up" class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition duration-300">

            <div class="text-center mb-5">
                <i class="fas fa-check-circle text-3xl text-blue-600 mb-2"></i>
                <h2 class="text-base font-medium text-blue-700">Informasi Penting Saat Finalisasi</h2>
            </div>

            <p class="text-gray-600 text-sm text-center mb-5 leading-relaxed">
                Ikuti setiap langkah dengan cermat agar dokumen makalah siap dinilai dan diverifikasi oleh admin.
            </p>

            <div class="border-t border-gray-200 pt-3">
                <h3 class="font-medium text-sm mb-3 text-gray-800">Tips & Catatan:</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2 text-sm leading-relaxed">
                    <li>Pastikan judul yang dipilih sesuai dokumen final.</li>
                    <li>File final harus lengkap, jelas, dan sesuai format yang ditentukan panitia.</li>
                    <li>Periksa kembali ejaan, tata bahasa, dan struktur dokumen.</li>
                    <li>Ikuti instruksi admin jika ada permintaan revisi.</li>
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
