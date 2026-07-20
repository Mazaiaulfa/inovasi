<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIM Inovation Fest</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" href="{{ asset('img/iconpim.png') }}">
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
@keyframes floatCard {
    0%,100%{
        transform:translateY(0px);
    }
    50%{
        transform:translateY(-10px);
    }
}

.float1{
    animation:floatCard 5s ease-in-out infinite;
}

.float2{
    animation:floatCard 5s ease-in-out infinite .7s;
}

.float3{
    animation:floatCard 5s ease-in-out infinite 1.4s;
}

.float4{
    animation:floatCard 5s ease-in-out infinite 2.1s;
}

.benefit-card{
    transition:all .35s ease;
}

.benefit-card:hover{
    transform:translateY(-12px) scale(1.03);
    box-shadow:0 20px 40px rgba(0,0,0,.18);
}

.benefit-card i{
    transition:.35s;
}

.benefit-card:hover i{
    transform:scale(1.2) rotate(-8deg);
}
    </style>

</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-md fixed w-full top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600 flex items-center gap-3">
                <img src="{{ asset('img/iconLogo.png') }}" alt="Logo" class="w-16 h-16">
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

    <!-- LOGIN -->
    <a href="{{ route('login') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 hover-scale">
        <i class="fas fa-sign-in-alt mr-1"></i>Login
    </a>

</div>
        </div>
    </header>

<section id="hero"
class="pt-24 min-h-screen bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-500 text-white flex items-center">
    <div class="max-w-7xl mx-auto w-full px-6">

        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">

            {{-- LEFT --}}
            <div>

               <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur text-xs font-medium">
    <span class="w-2.5 h-2.5 bg-green-400 rounded-full animate-pulse"></span>
    IFEST Innovation
</span>

              <h1 class="mt-4 text-3xl lg:text-4xl font-extrabold leading-tight">
    Kelola Inovasi dengan
    <br>
    <span class="text-yellow-300">Mudah & Terintegrasi</span>
</h1>

                <p class="mt-4 text-white/85 text-sm leading-6 max-w-md">
                    Daftarkan tim, unggah proposal, pantau proses verifikasi,
                    hingga mengikuti konvensi inovasi dalam satu platform digital.
                </p>

                <div class="mt-5">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 bg-white text-indigo-600 font-semibold px-5 py-2 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-user-plus"></i>
                        Daftar Sekarang
                    </a>
                </div>

                {{-- Benefit --}}
                <div class="grid grid-cols-2 gap-4 mt-6">

    {{-- Card 1 --}}
    <div class="benefit-card float1 bg-white rounded-2xl p-4 flex items-start gap-3 text-gray-800 shadow-lg">

        <div
            class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
            <i class="fas fa-lightbulb"></i>
        </div>

        <div>
            <h4 class="font-semibold text-sm">
                Pengajuan Mudah
            </h4>

            <p class="text-xs text-gray-500 mt-1">
                Submit inovasi secara online tanpa proses manual.
            </p>
        </div>

    </div>

    {{-- Card 2 --}}
    <div class="benefit-card float2 bg-white rounded-2xl p-4 flex items-start gap-3 text-gray-800 shadow-lg">

        <div
            class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0">
            <i class="fas fa-chart-line"></i>
        </div>

        <div>
            <h4 class="font-semibold text-sm">
                Monitoring
            </h4>

            <p class="text-xs text-gray-500 mt-1">
                Pantau progres verifikasi secara real-time.
            </p>
        </div>

    </div>

    {{-- Card 3 --}}
    <div class="benefit-card float3 bg-white rounded-2xl p-4 flex items-start gap-3 text-gray-800 shadow-lg">

        <div
            class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 shrink-0">
            <i class="fas fa-award"></i>
        </div>

        <div>
            <h4 class="font-semibold text-sm">
                Konvensi Digital
            </h4>

            <p class="text-xs text-gray-500 mt-1">
                Penilaian juri dan rekapitulasi lebih efisien.
            </p>
        </div>

    </div>

    {{-- Card 4 --}}
    <div class="benefit-card float4 bg-white rounded-2xl p-4 flex items-start gap-3 text-gray-800 shadow-lg">

        <div
            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
            <i class="fas fa-users"></i>
        </div>

        <div>
            <h4 class="font-semibold text-sm">
                Kolaborasi Tim
            </h4>

            <p class="text-xs text-gray-500 mt-1">
                Kelola anggota dan dokumen dalam satu platform.
            </p>
        </div>

    </div>

</div>
</div>          {{-- RIGHT --}}
            <div class="flex justify-center">

                <img src="{{ asset('img/landing.png') }}"
                    class="w-[80%] max-w-md animate-[float_4s_ease-in-out_infinite] drop-shadow-2xl"
                    alt="Innovation">

            </div>

        </div>

    </div>

</section>
<!-- resources/views/landing.blade.php -->
<div class="relative">
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

                @foreach($timelines as $index => $timeline)
                    <div class="text-center {{ $index % 2 != 0 ? 'mt-10 md:mt-24' : '' }}">
                        <!-- Circle Number -->
                        <div class="w-12 h-12 mx-auto bg-blue-500 text-white flex items-center justify-center
                                    rounded-full shadow-md text-sm">
                            {{ $timeline->urutan }}
                        </div>

                        <!-- Title -->
                        <p class="mt-4 font-semibold text-blue-900">
                            {{ $timeline->tahap }}
                        </p>

                        <!-- Date -->
                        <p class="text-xs text-gray-600">
                            {{ \Carbon\Carbon::parse($timeline->tanggal_mulai)->format('d M') }}
                            @if($timeline->tanggal_selesai)
                                – {{ \Carbon\Carbon::parse($timeline->tanggal_selesai)->format('d M Y') }}
                            @endif
                        </p>

                        <!-- Optional Description -->
                        @if($timeline->deskripsi)
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $timeline->deskripsi }}
                            </p>
                        @endif
                    </div>
                @endforeach

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
                    <a href="{{ route('tahapanapp.registrasi') }}"
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
    <a href="{{ route('tahapanapp.judul') }}"
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
    <a href="{{ route('tahapanapp.proposal') }}"
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

    <a href="{{ route('tahapanapp.finalisasi')}}"
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

                <!-- Card Gugus -->
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-users text-blue-500 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Total Gugus Terdaftar</h4>
                    <p class="text-3xl font-bold text-blue-500">
                        {{ $totalUser }}
                    </p>
                </div>

                {{-- Card Judul --}}
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-book text-indigo-600 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Judul Diajukan</h4>
                    <p class="text-3xl font-bold text-indigo-600">
                        {{ $totalJudul }}
                    </p>
                </div>

                {{-- Card Proposal Pending --}}
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-clock text-yellow-500 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Proposal Pending</h4>
                    <p class="text-3xl font-bold text-yellow-500">
                        {{ $pendingProposal }}
                    </p>
                </div>

                {{-- Card Finalisasi --}}
                <div
                    class="bg-white shadow-lg rounded-xl p-6 text-center border border-gray-200 hover:shadow-xl transition">
                    <i class="fas fa-check-circle text-green-500 text-4xl mb-4"></i>
                    <h4 class="text-lg font-semibold mb-2">Finalisasi</h4>
                    <p class="text-3xl font-bold text-green-500">
                        {{ $totalFinalisasi }}
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
