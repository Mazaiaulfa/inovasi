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

    <style>
/* @keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
} */
.animate-fadeInUp {
    animation: fadeInUp 1s ease forwards;
}

.slider-title {
    text-shadow: 0 5px 25px rgba(0,0,0,0.8);
}

.slider-desc {
    text-shadow: 0 3px 15px rgba(0,0,0,0.7);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 1s ease forwards;
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

<!-- SLIDER MODERN -->
<!-- ================= SLIDER PREMIUM ================= -->
<section class="pt-16 relative">

<div class="relative overflow-hidden">

<div id="bannerSlider" class="relative w-full">

<?php $__empty_1 = true; $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="banner-slide <?php echo e($key == 0 ? '' : 'hidden'); ?> transition-opacity duration-700 ease-in-out">

    <div class="h-[90vh] bg-cover bg-center flex items-center justify-center relative transform transition duration-[2000ms] hover:scale-105"
         style="background-image: url('<?php echo e(asset('img/slide'.(($key%6)+1).'.png')); ?>');">

        <!-- GRADIENT OVERLAY PREMIUM -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/40"></div>

        <!-- CONTENT -->
        <div class="relative text-center text-white max-w-4xl px-8 py-10
                    bg-white/10 backdrop-blur-md rounded-3xl
                    border border-white/20 shadow-2xl
                    animate-fadeInUp">

            <?php if($item->urgent): ?>
            <div class="inline-block bg-red-500 px-4 py-1 rounded-full text-xs mb-6 tracking-wide shadow-lg">
                🔥 Pengumuman Penting
            </div>
            <?php endif; ?>

            <!-- ACCENT LINE -->
            <div class="w-24 h-1 bg-indigo-400 mx-auto mb-6 rounded-full"></div>

            <!-- TITLE -->
            <h2 class="text-5xl md:text-6xl font-bold mb-6 leading-tight slider-title">
                <?php echo e($item->judul); ?>

            </h2>

            <!-- DESCRIPTION -->
            <p class="text-gray-200 mb-8 text-lg slider-desc">
                <?php echo e($item->ringkasan); ?>

            </p>

            <!-- BUTTON -->
            <a href="<?php echo e(route('pengumuman.detail', $item->id)); ?>"
               class="inline-block px-8 py-3 text-sm font-semibold
                      bg-indigo-600 hover:bg-indigo-700
                      text-white rounded-full
                      transition duration-300 shadow-xl hover:scale-105">
                Lihat Detail →
            </a>

        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="h-[90vh] bg-cover bg-center flex items-center justify-center relative"
     style="background-image: url('<?php echo e(asset('img/slide1.png')); ?>');">

    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/40"></div>

    <div class="relative text-center text-white">
        <h2 class="text-5xl font-bold slider-title">
            Selamat Datang di PIM Innovation Fest
        </h2>
    </div>
</div>
<?php endif; ?>

</div>

<!-- NAVIGATION BUTTON -->
<button onclick="prevSlide()"
class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 backdrop-blur p-3 rounded-full text-white text-lg transition">
‹
</button>

<button onclick="nextSlide()"
class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 backdrop-blur p-3 rounded-full text-white text-lg transition">
›
</button>

</div>
</section>



    <!-- Hero Section -->
    <section id="hero" class="pt-24 pb-16 bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2" data-aos="fade-right">
                <h2 class="text-4xl font-bold mb-4">Sistem Pengelolaan Inovasii</h2>
                <p class="mb-6">Daftarkan tim Anda, unggah proposal, dan pantau status verifikasii secara real-time dalam
                    satu platform.</p>
                <a href="<?php echo e(route('register')); ?>"
                    class="bg-white text-indigo-600 px-6 py-3 rounded-md font-medium hover:bg-gray-100 hover-scale">
                    <i class="fas fa-user-plus mr-1 mt-5"></i>Daftar Sekarang
                </a>
            </div>
            <div class="md:w-1/2 mt-6 md:mt-0" data-aos="fade-left">
                <img src="<?php echo e(asset('img/landing.png')); ?>" alt="Ilustrasi Karya Tulis" class="rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-10" data-aos="fade-up"><i class="fas fa-cogs mr-2"></i>Fitur Unggulan</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md hover-scale" data-aos="zoom-in">
                    <i class="fas fa-file-upload text-indigo-600 text-4xl mb-3"></i>
                    <h4 class="text-xl font-semibold mb-3">Upload Proposal Mudah</h4>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md hover-scale" data-aos="zoom-in"
                    data-aos-delay="150">
                    <i class="fas fa-user-shield text-indigo-600 text-4xl mb-3"></i>
                    <h4 class="text-xl font-semibold mb-3">Verifikasi Admin</h4>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-md hover-scale" data-aos="zoom-in"
                    data-aos-delay="300">
                    <i class="fas fa-chart-line text-indigo-600 text-4xl mb-3"></i>
                    <h4 class="text-xl font-semibold mb-3">Laporan & Statistik</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Section -->
    <section id="alur" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6" data-aos="fade-up">
            <h3 class="text-3xl font-bold mb-12 text-center">
                <i class="fas fa-route mr-2 text-blue-600"></i>Prosedur & Tahapan
            </h3>

            <!-- Stepper -->
            <div class="relative">
                <!-- Progress Line -->
                <div class="absolute top-16 left-0 w-full h-1 bg-gray-300">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-green-500 rounded-full"></div>
                </div>

                <!-- Steps -->
                <div class="relative flex flex-col md:flex-row justify-between items-center gap-12 md:gap-6">

                    <!-- Step -->
                    <div class="flex flex-col items-center text-center max-w-xs" data-aos="zoom-in"
                        data-aos-delay="100">
                        <div
                            class="w-16 h-16 bg-blue-500 text-white rounded-full flex items-center justify-center text-xl shadow-lg hover:bg-blue-600 transition">
                            <i class="fas fa-user-plus"></i>
                        </div>
                      <div class="relative bg-white p-6 rounded-lg shadow-md mt-4 hover:shadow-xl transition">
                    <!-- overlay link -->
                    <a href="<?php echo e(route('tahapanapp.registrasi')); ?>"
                    class="absolute inset-0 z-10"
                    aria-label="Tahap 1 Registrasi">
                    </a>

                    <h4 class="font-bold text-lg text-blue-700 mb-1">Tahap 1</h4>
                    <h5 class="font-semibold mb-3">Registrasi / Login</h5>
                    <p class="text-sm text-gray-600">
                        Daftarkan akun baru atau masuk dengan akun yang sudah ada
                    </p>
                </div>

                    </div>

                    <!-- Step -->
                    <div class="flex flex-col items-center text-center max-w-xs" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div
                            class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-xl shadow-lg hover:bg-green-600 transition">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="relative bg-white p-6 rounded-lg shadow-md mt-4 hover:shadow-xl transition">
    <a href="<?php echo e(route('tahapanapp.judul')); ?>"
       class="absolute inset-0 z-10"
       aria-label="Tahap 2 Pengajuan Judul">
    </a>

    <h4 class="font-bold text-lg text-green-700 mb-1">Tahap 2</h4>
    <h5 class="font-semibold mb-3">Pengajuan Judul</h5>
    <p class="text-sm text-gray-600">
        Ajukan judul makalah Anda dan tunggu persetujuan dari tim verifikasi.
    </p>
</div>
                    </div>

                    <!-- Step -->
                    <div class="flex flex-col items-center text-center max-w-xs" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div
                            class="w-16 h-16 bg-purple-500 text-white rounded-full flex items-center justify-center text-xl shadow-lg hover:bg-purple-600 transition">
                            <i class="fas fa-file-upload"></i>
                        </div>
                       <div class="relative bg-white p-6 rounded-lg shadow-md mt-4 hover:shadow-xl transition">
    <a href="<?php echo e(route('tahapanapp.proposal')); ?>"
       class="absolute inset-0 z-10"
       aria-label="Tahap 3 Upload Proposal">
    </a>

    <h4 class="font-bold text-lg text-purple-700 mb-1">Tahap 3</h4>
    <h5 class="font-semibold mb-3">Upload Proposal</h5>
    <p class="text-sm text-gray-600">
        Unggah proposal sesuai dengan judul yang telah disetujui.
    </p>
</div>

                    </div>

                    <!-- Step -->
                    <div class="flex flex-col items-center text-center max-w-xs" data-aos="zoom-in"
                        data-aos-delay="400">
                        <div
                            class="w-16 h-16 bg-red-500 text-white rounded-full flex items-center justify-center text-xl shadow-lg hover:bg-red-600 transition">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="relative bg-white p-6 rounded-lg shadow-md mt-4
            hover:shadow-xl hover:-translate-y-1 transition cursor-pointer">

    <a href="<?php echo e(route('tahapanapp.finalisasi')); ?>"
       class="absolute inset-0 z-10 rounded-lg
              focus:outline-none focus:ring-2 focus:ring-red-500"
       aria-label="Tahap 4 Finalisasi">
    </a>

    <h4 class="font-bold text-lg text-red-700 mb-1">Tahap 4</h4>
    <h5 class="font-semibold mb-3">Finalisasi</h5>
    <p class="text-sm text-gray-600">
        Verifikasi akhir dan konfirmasi kelengkapan dokumen karya tulis Anda.
    </p>
</div>

                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Statistik Section -->
    <section id="statistik" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6" data-aos="fade-up">
            <h3 class="text-3xl font-bold mb-10 text-center">
                <i class="fas fa-chart-bar mr-2"></i>Statistik
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-users text-blue-500 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Total Gugus Terdaftar</h4>
                    <p class="text-3xl font-bold text-blue-500">
                        <?php echo e($totalUser); ?>

                    </p>
                </div>

                
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-book text-indigo-600 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Judul Diajukan</h4>
                    <p class="text-3xl font-bold text-indigo-600">
                        <?php echo e($totalJudul); ?>

                    </p>
                </div>

                
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-clock text-yellow-500 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Proposal Pending</h4>
                    <p class="text-3xl font-bold text-yellow-500">
                        <?php echo e($pendingProposal); ?>

                    </p>
                </div>

                
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-check-circle text-green-500 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Finalisasi</h4>
                    <p class="text-3xl font-bold text-green-500">
                        <?php echo e($totalFinalisasi); ?>

                    </p>
                </div>

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
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.add('hidden');
            if (i === index) {
                slide.classList.remove('hidden');
            }
        });

        dots.forEach((dot, i) => {
            dot.classList.remove('opacity-100');
            dot.classList.add('opacity-50');
            if (i === index) {
                dot.classList.remove('opacity-50');
                dot.classList.add('opacity-100');
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

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    setInterval(nextSlide, 10000);
</script>


</html>
<?php /**PATH C:\laragon\www\inovasirev\resources\views/welcome.blade.php ENDPATH**/ ?>