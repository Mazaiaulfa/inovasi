<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TahapanAppController extends Controller
{
    // Halaman utama daftar tahapan (card)
    public function index()
    {
        return view('tahapan.index');
    }

    // Halaman Tahap 1 - Registrasi
    public function registrasi()
    {
        return view('tahapanapp.registrasi');
    }

    // Halaman Tahap 2 - Pengajuan Judul
    public function judul()
    {
        return view('tahapanapp.judul');
    }

    // Halaman Tahap 3 - Upload Proposal
    public function proposal()
    {
        return view('tahapanapp.proposal');
    }

    // Halaman Tahap 4 - Finalisasi
    public function finalisasi()
    {
        return view('tahapanapp.finalisasi');
    }
}
