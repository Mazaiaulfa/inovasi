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


/* SLIDER */
#textSlider {
    position: relative;
    overflow: hidden;
    min-height: 260px;
    display: flex;
    align-items: center;
}

/* slide */
.text-slide {
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;

    opacity: 0;
    transform: translateX(80px);
    transition: opacity 0.6s ease, transform 0.6s ease;
    filter: blur(5px);
}

/* aktif */
.text-slide.active {
    opacity: 1;
    transform: translateX(0);
    z-index: 2;
    filter: blur(0);
}

/* keluar */
.text-slide.exit-left {
    transform: translateX(-80px);
}
.text-slide.exit-right {
    transform: translateX(80px);
}

.slider-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transition: all .3s ease;
}

.slider-dot.active {
    width: 20px; /* jadi lonjong */
    background: white;
}

/* FLOAT IMAGE */
@keyframes float {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
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
           <div class="flex items-center gap-3">

    <!-- REGISTER -->
    <a href="<?php echo e(route('register')); ?>"
       class="bg-white text-indigo-600 border border-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-50 hover-scale">
        <i class="fas fa-user-plus mr-1"></i>Register
    </a>

    <!-- LOGIN -->
    <a href="<?php echo e(route('login')); ?>"
       class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 hover-scale">
        <i class="fas fa-sign-in-alt mr-1"></i>Login
    </a>

</div>
        </div>
    </header>



    
<section id="hero" class="pt-24 pb-16 bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
<div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-10">

<!-- TEXT -->
<div class="md:w-1/2 relative">

<div id="textSlider">

<!-- DEFAULT SLIDE -->
<div class="text-slide active">
    <div class="bg-white/10 backdrop-blur-md p-5 rounded-xl shadow-md">

        <h2 class="text-2xl md:text-3xl font-semibold mb-3 leading-snug">
            Sistem Pengelolaan Inovasi
        </h2>

        <p class="mb-4 text-sm md:text-base text-white/80 leading-relaxed">
            Daftarkan tim Anda, unggah proposal, dan pantau status verifikasi secara real-time dalam satu platform.
        </p>

        <a href="<?php echo e(route('register')); ?>"
           class="bg-white text-indigo-600 px-4 py-2 rounded-md text-sm hover:bg-gray-100 transition">
           <i class="fas fa-user-plus mr-1"></i>Daftar
        </a>

    </div>
</div>
<!-- DATA SLIDE -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="text-slide <?php echo e($index == 0 ? '' : ''); ?>">
    <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-lg">

       

        <h2 class="text-2xl md:text-3xl font-semibold mb-3 leading-snug">
            <?php echo e($item->judul); ?>

        </h2>

        <p class="mb-4 text-sm md:text-base text-white/80 leading-relaxed">
            <?php echo e($item->ringkasan); ?>

        </p>

        <a href="<?php echo e(route('pengumuman.detail',$item->id)); ?>"
           class="bg-white text-indigo-600 px-4 py-2 rounded-md text-sm hover:bg-gray-100 transition">
           Detail
        </a>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>

<!-- PREV -->
<button onclick="prevTextSlide()"
class="absolute left-0 md:-left-10 top-1/2 -translate-y-1/2
       bg-white/90 hover:bg-white text-indigo-600
       p-3 rounded-full shadow-lg transition hover:scale-110">
❮
</button>

</div>

<!-- IMAGE -->
<div class="md:w-1/2 relative">

<img src="<?php echo e(asset('img/landing.png')); ?>"
     class="rounded-lg shadow-lg animate-[float_4s_ease-in-out_infinite]">

<!-- NEXT -->
<button onclick="nextTextSlide()"
class="absolute right-2 top-1/2 -translate-y-1/2
       bg-white/90 hover:bg-white text-indigo-600
       p-3 rounded-full shadow-lg transition hover:scale-110">
❯
</button>

<div id="textDots"
class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
</div>

</div>

</div>
</section>
<!-- resources/views/landing.blade.php -->


<section id="timeline" class="py-20 bg-gray-100 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold text-blue-900 mb-16">
            Timeline Gerakan Inovasi Tahun 2026
        </h2>

        <div class="relative">

            <!-- SVG Curve Line -->
            <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 1200 400" preserveAspectRatio="none">
                <path d="M50,150
                         C250,50 400,300 600,150
                         S900,50 1150,200"
                      fill="none"
                      stroke="#cbd5e1"
                      stroke-width="4"
                      stroke-linecap="round"/>
            </svg>

            <!-- Timeline Points -->
            <div class="relative grid grid-cols-1 md:grid-cols-7 gap-8 items-center">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $timelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $timeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-center <?php echo e($index % 2 != 0 ? 'mt-10 md:mt-24' : ''); ?>">
                        <!-- Circle Number -->
                        <div class="w-12 h-12 mx-auto bg-blue-500 text-white flex items-center justify-center
                                    rounded-full shadow-md text-sm">
                            <?php echo e($timeline->urutan); ?>

                        </div>

                        <!-- Title -->
                        <p class="mt-4 font-semibold text-blue-900">
                            <?php echo e($timeline->tahap); ?>

                        </p>

                        <!-- Date -->
                        <p class="text-xs text-gray-600">
                            <?php echo e(\Carbon\Carbon::parse($timeline->tanggal_mulai)->format('d M')); ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($timeline->tanggal_selesai): ?>
                                – <?php echo e(\Carbon\Carbon::parse($timeline->tanggal_selesai)->format('d M Y')); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>

                        <!-- Optional Description -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($timeline->deskripsi): ?>
                            <p class="text-xs text-gray-500 mt-1">
                                <?php echo e($timeline->deskripsi); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

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
document.addEventListener("DOMContentLoaded", function () {

    let textSlides = document.querySelectorAll(".text-slide");
    let textIndex = 0;
    let textDotsContainer = document.getElementById("textDots");
    let textDots = [];

    function showTextSlide(newIndex){
        textSlides.forEach((slide, i) => {
            slide.classList.remove("active","exit-left","exit-right");

            if(i === newIndex){
                slide.classList.add("active");
            } else if(i < newIndex){
                slide.classList.add("exit-left");
            } else {
                slide.classList.add("exit-right");
            }
        });

        textDots.forEach(d => d.classList.remove("active"));
        if(textDots[newIndex]) textDots[newIndex].classList.add("active");
    }

    window.nextTextSlide = function(){
        textIndex = (textIndex + 1) % textSlides.length;
        showTextSlide(textIndex);
    }

    window.prevTextSlide = function(){
        textIndex = (textIndex - 1 + textSlides.length) % textSlides.length;
        showTextSlide(textIndex);
    }

    function createDots(){
        textSlides.forEach((_, i)=>{
            let dot = document.createElement("div");
            dot.classList.add("slider-dot");

            dot.onclick = () => {
                textIndex = i;
                showTextSlide(textIndex);
            };

            textDotsContainer.appendChild(dot);
            textDots.push(dot);
        });
    }

    if(textSlides.length > 0){
        createDots();
        showTextSlide(0);

        setInterval(() => {
            nextTextSlide();
        }, 5000); // 5 detik
    }

});
</script>
<?php /**PATH C:\laragon\www\inovasirev\resources\views/welcome.blade.php ENDPATH**/ ?>