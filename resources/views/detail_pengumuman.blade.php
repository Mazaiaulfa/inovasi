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
            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 hover-scale">
                <i class="fas fa-sign-in-alt mr-1"></i>Login
            </a>
        </div>
    </header>
<body class="bg-gray-100">

@php
use Illuminate\Support\Str;
$file = $pengumuman->gambar; // karena kamu simpan di kolom gambar
@endphp






<!-- CONTENT -->
<section class="pt-28 pb-20">
    <div class="max-w-5xl mx-auto px-6">

        <div class="bg-white rounded-2xl shadow-xl p-10">

            {{-- Badge Urgent --}}
            @if($pengumuman->urgent)
            <div class="inline-block bg-red-600 text-white text-xs px-4 py-1 rounded-full mb-4">
                🔴 Pengumuman Penting
            </div>
            @endif

            {{-- Judul --}}
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 leading-tight">
                {{ $pengumuman->judul }}
            </h1>

            {{-- Tanggal --}}
            <p class="text-sm text-gray-500 mb-8">
                Dipublikasikan:
                {{ \Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d F Y') }}
            </p>

            {{-- Ringkasan --}}
            @if($pengumuman->ringkasan)
            <div class="mb-8 text-gray-600 italic border-l-4 border-indigo-500 pl-4 text-lg">
                {{ $pengumuman->ringkasan }}
            </div>
            @endif

            {{-- Isi --}}
            <div class="text-gray-700 leading-relaxed space-y-4 text-lg">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>

            {{-- ===================== --}}
            {{-- SECTION FILE / LAMPIRAN --}}
            {{-- ===================== --}}
            @if($file)
            <div class="mt-12 border-t pt-10">

                <h3 class="text-2xl font-semibold mb-6 text-gray-800">
                    📎 Lampiran Dokumen
                </h3>

                <div class="bg-gray-50 rounded-2xl shadow-inner overflow-hidden border">

                    {{-- Jika File Gambar --}}
                    @if(Str::endsWith($file, ['.jpg', '.jpeg', '.png', '.webp']))

                        <div class="p-6 bg-white">
                            <img src="{{ asset($file) }}"
                                 class="w-full max-h-[800px] object-contain mx-auto rounded-xl shadow-lg">
                        </div>

                    {{-- Jika PDF --}}
                    @elseif(Str::endsWith($file, '.pdf'))

                        <iframe src="{{ asset($file) }}"
                                class="w-full h-[850px] border-0">
                        </iframe>

                    {{-- Jika Word / Excel / File Lain --}}
                    @else

                        <div class="p-12 text-center bg-white">

                            <div class="text-6xl mb-6">
                                📄
                            </div>

                            <h4 class="text-xl font-semibold mb-3">
                                {{ basename($file) }}
                            </h4>

                            <p class="text-gray-500 mb-6">
                                Dokumen tersedia untuk diunduh.
                            </p>

                            <a href="{{ asset($file) }}"
                               download
                               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow-md transition">
                                Download File
                            </a>

                        </div>

                    @endif

                </div>

            </div>
            @endif


            {{-- Tombol Kembali --}}
            <div class="mt-14 text-center">
                <a href="{{ route('landing') }}"
                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl transition shadow-md">
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</section>

</body>
</html>
