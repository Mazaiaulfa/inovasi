<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonvensiController extends Controller
{
      public function index()
{
    $data = \App\Models\Penilaian::with('peserta')
        ->where('status', 'submitted') // hanya yg sudah disubmit juri
        ->get();

    return view('admin.konvensi.index', compact('data'));
}

    public function create()
    {
        return view('admin.konvensi.create');
    }

    public function store(Request $request)
    {
        // simpan data
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.konvensi.edit');
    }

    public function update(Request $request, $id)
    {
        // update data
    }

    public function destroy($id)
    {
        // hapus data
    }
}
