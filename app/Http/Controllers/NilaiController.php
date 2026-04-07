<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NilaiController extends Controller
{
    public function create($id)
    {
        // ambil data peserta
        $peserta = User::findOrFail($id);

        return view('juri.peserta.nilai', compact('peserta'));
    }
}
