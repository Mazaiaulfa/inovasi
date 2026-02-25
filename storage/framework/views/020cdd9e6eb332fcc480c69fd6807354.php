<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIM Inovation Fest</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" href="<?php echo e(asset('img/iconpim.png')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    <style>
        html {
            scroll-behavior: smooth;
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }


        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .step-circle:hover {
            animation: pulse 2s infinite;
        }


        @media (max-width: 768px) {
            .absolute.top-16 {
                display: none;

            }
        }

        section {
            scroll-margin-top: 80px;

        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-md fixed w-full top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600 flex items-center gap-3">
                <img src="<?php echo e(asset('img/iconLogo.png')); ?>" alt="Logo" class="w-16 h-16">
                <div class="leading-tight">
                    <div>PUPUK ISKANDAR MUDA</div>
                    <div class="text-lg">INNOVATION FEST</div>
                </div>
            </h1>
            <nav class="space-x-6 hidden md:flex absolute left-1/2 transform -translate-x-1/4">

                <a href="#hero" class="hover:text-indigo-600">
                    <i class="fas fa-home mr-1"></i>Beranda
                </a>

                <a href="#features" class="hover:text-indigo-600">
                    <i class="fas fa-gem mr-1"></i>Fitur
                </a>

                <a href="#alur" class="hover:text-indigo-600">
                    <i class="fas fa-route mr-1"></i>Tahapan
                </a>

                <a href="#statistik" class="hover:text-indigo-600">
                    <i class="fas fa-chart-bar mr-1"></i>Statistik
                </a>
            </nav>
            <a href="<?php echo e(route('login')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 hover-scale">
                <i class="fas fa-sign-in-alt mr-1"></i>Login
            </a>
        </div>
    </header>

<!-- HEADER DETAIL -->
<section class="pt-28 pb-12 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <p class="text-sm mb-2 opacity-80">10 Januari 2026 • Pengumuman Resmi</p>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Pendaftaran Inovasi PIM 2026 Dibuka
        </h1>
        <p class="text-lg opacity-90">
            Ajang kompetisi inovasi mahasiswa tingkat nasional
        </p>
    </div>
</section>


<!-- CONTENT -->
<section class="py-16 bg-gray-50">
  <div class="w-full px-12">


<!-- Timeline Jadwal Pelaksanaan -->
<section id="jadwal" class="py-20 bg-gray-100">
    <div class="w-full px-12">

        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            Jadwal Pelaksanaan Gerakan Inovasi 2026
        </h2>
        <p class="text-gray-600 mb-16">
            Berikut rangkaian proses kegiatan inovasi yang akan dilaksanakan.
        </p>

        <div class="relative">

            <!-- Garis Horizontal Tengah -->
            <div class="hidden md:block absolute top-10 left-0 w-full h-1 bg-gray-300"></div>

            <div class="grid grid-cols-1 md:grid-cols-6 gap-10 relative">

                <!-- STEP -->
                <div class="text-center relative group">
                    <div class="w-20 h-20 mx-auto bg-blue-600 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg
                                transition duration-300 group-hover:scale-110">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Registrasi Ide
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        19 Jan – 20 Feb 2026
                    </p>
                </div>

                <div class="text-center relative group">
                    <div class="w-20 h-20 mx-auto bg-blue-600 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg
                                transition duration-300 group-hover:scale-110">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Penyampaian Laporan
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        20 Jan – 31 Agu 2026
                    </p>
                </div>

                <div class="text-center relative group">
                    <div class="w-20 h-20 mx-auto bg-blue-600 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg
                                transition duration-300 group-hover:scale-110">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Executive Innovation Forum
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        1 – 2 Sep 2026
                    </p>
                </div>

                <div class="text-center relative group">
                    <div class="w-20 h-20 mx-auto bg-blue-600 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg
                                transition duration-300 group-hover:scale-110">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Konvensi Internal
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        5 – 7 Sep 2026
                    </p>
                </div>

                <div class="text-center relative group">
                    <div class="w-20 h-20 mx-auto bg-blue-600 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg
                                transition duration-300 group-hover:scale-110">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Anugerah Inovasi
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        9 Sep 2026
                    </p>
                </div>

                <div class="text-center relative group">
                    <div class="w-20 h-20 mx-auto bg-indigo-700 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg
                                ring-4 ring-indigo-200
                                transition duration-300 group-hover:scale-110">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Host PIQI 2026
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        Okt 2026
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- Timeline Jadwal Pelaksanaan -->
<section id="jadwal" class="py-20 bg-gray-100">
   <div class="w-full px-12">

        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            Jadwal Pelaksanaan Gerakan Inovasi 2026
        </h2>
        <p class="text-gray-600 mb-16">
            Berikut rangkaian proses kegiatan inovasi yang akan dilaksanakan.
        </p>

        <div class="relative">

            <!-- Garis Horizontal -->
            <div class="hidden md:block absolute top-10 left-0 w-full h-1 bg-gray-300"></div>

            <div class="grid grid-cols-1 md:grid-cols-6 gap-10 relative">

                <!-- Tahap 1 -->
                <div class="text-center relative">
                    <div class="w-20 h-20 mx-auto bg-blue-500 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Registrasi Ide
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        19 Jan – 20 Feb 2026
                    </p>
                </div>

                <!-- Tahap 2 -->
                <div class="text-center relative">
                    <div class="w-20 h-20 mx-auto bg-blue-500 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Penyampaian Laporan
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        20 Jan – 31 Agu 2026
                    </p>
                </div>

                <!-- Tahap 3 -->
                <div class="text-center relative">
                    <div class="w-20 h-20 mx-auto bg-blue-500 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Executive Innovation Forum
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        1 – 2 Sep 2026
                    </p>
                </div>

                <!-- Tahap 4 -->
                <div class="text-center relative">
                    <div class="w-20 h-20 mx-auto bg-blue-500 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Konvensi Internal
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        5 – 7 Sep 2026
                    </p>
                </div>

                <!-- Tahap 5 -->
                <div class="text-center relative">
                    <div class="w-20 h-20 mx-auto bg-blue-500 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Anugerah Inovasi
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        9 Sep 2026
                    </p>
                </div>

                <!-- Tahap 6 -->
                <div class="text-center relative">
                    <div class="w-20 h-20 mx-auto bg-blue-600 text-white rounded-full
                                flex items-center justify-center text-2xl shadow-lg ring-4 ring-blue-200">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <h4 class="mt-6 font-semibold text-gray-800">
                        Host PIQI 2026
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        Okt 2026
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>

        



<!-- Timeline Section -->
<section id="timeline" class="py-20 bg-gray-100 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold text-blue-900 mb-16">
            Timeline Gerakan Inovasi Tahun 2026
        </h2>

        <div class="relative">

            <!-- SVG Curve Line -->
            <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 1000 400" preserveAspectRatio="none">
                <path d="M50,100
                         C250,100 250,250 450,250
                         S650,100 850,200"
                      fill="none"
                      stroke="#94a3b8"
                      stroke-width="6"
                      stroke-linecap="round"/>
            </svg>

            <!-- Timeline Points -->
            <div class="relative grid grid-cols-1 md:grid-cols-5 gap-10 items-center">

                <!-- Point 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-700 text-white flex items-center justify-center
                                rounded-full shadow-lg text-xl">
                        1
                    </div>
                    <p class="mt-4 font-semibold text-blue-900">
                        Registrasi Ide Inovasi
                    </p>
                    <p class="text-sm text-gray-600">19 Jan – 20 Feb 2026</p>
                </div>

                <!-- Point 2 -->
                <div class="text-center mt-16 md:mt-32">
                    <div class="w-16 h-16 mx-auto bg-blue-700 text-white flex items-center justify-center
                                rounded-full shadow-lg text-xl">
                        2
                    </div>
                    <p class="mt-4 font-semibold text-blue-900">
                        Penyampaian Laporan
                    </p>
                    <p class="text-sm text-gray-600">20 Jan – 31 Agu 2026</p>
                </div>

                <!-- Point 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-700 text-white flex items-center justify-center
                                rounded-full shadow-lg text-xl">
                        3
                    </div>
                    <p class="mt-4 font-semibold text-blue-900">
                        Executive Innovation Forum
                    </p>
                    <p class="text-sm text-gray-600">1 – 2 Sep 2026</p>
                </div>

                <!-- Point 4 -->
                <div class="text-center mt-16 md:mt-32">
                    <div class="w-16 h-16 mx-auto bg-blue-700 text-white flex items-center justify-center
                                rounded-full shadow-lg text-xl">
                        4
                    </div>
                    <p class="mt-4 font-semibold text-blue-900">
                        Konvensi Inovasi Internal
                    </p>
                    <p class="text-sm text-gray-600">5 – 7 Sep 2026</p>
                </div>

                <!-- Point 5 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-700 text-white flex items-center justify-center
                                rounded-full shadow-lg text-xl">
                        5
                    </div>
                    <p class="mt-4 font-semibold text-blue-900">
                        Anugerah Inovasi
                    </p>
                    <p class="text-sm text-gray-600">9 Sep 2026</p>
                </div>

            </div>

        </div>
    </div>
</section>

        <!-- Tombol -->
        <div class="mt-12 text-center">
            <a href="<?php echo e(url('/')); ?>"
                class="bg-gray-800 text-white px-6 py-3 rounded-md hover:bg-black transition">
                ← Kembali ke Beranda
            </a>
        </div>

    </div>
</section>
 <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-10 border-t border-gray-700" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-6 py-6 text-center">
            <p class="text-sm text-gray-300">
                &copy; 2025 <span class="font-semibold">PIM Innovation Fest</span> • SMTI
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

</body>
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.banner-slide');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.add('hidden');
            if (i === index) {
                slide.classList.remove('hidden');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 5000);
</script>

</html>

<?php /**PATH C:\laragon\www\inovasirev\resources\views/timeline.blade.php ENDPATH**/ ?>