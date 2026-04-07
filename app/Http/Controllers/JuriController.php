<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class JuriController extends Controller
{

     public function peserta()
{
    $juri = auth()->user();

    $peserta = $juri->pesertaYangDinilai;

    return view('juri.peserta.index', compact('peserta'));
}


    public function penilaian($id)
    {
        // ambil data peserta berdasarkan id
        $user = User::where('role','user')->findOrFail($id);

        return view('juri.penilaian.index', compact('user'));
    }

    public function nilai()
    {

        return view('juri.penilaian.index');
    }



}
