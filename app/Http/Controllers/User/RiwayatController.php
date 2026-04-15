<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KaryaTulis;

class RiwayatController extends Controller
{
    /**
     * Menampilkan daftar riwayat pengajuan user
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua karya milik user
         $karyas = KaryaTulis::with('penilaian') // ⬅️ TAMBAH INI
        ->where('user_id', $user->id)
        ->latest()
        ->get();

        return view('user.riwayat.index', compact('karyas'));
    }

    /**
     * Detail 1 karya (tracking)
     */
    public function show($id)
    {
        $user = Auth::user();

         $karya = KaryaTulis::with('penilaian') // ⬅️ TAMBAH INI
        ->where('id', $id)
        ->where('user_id', $user->id)
        ->firstOrFail();

        return view('user.riwayat.show', compact('karya'));
    }
}
