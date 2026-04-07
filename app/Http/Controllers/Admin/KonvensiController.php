<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonvensiController extends Controller
{
    public function index()
    {
        // tampilkan daftar pengumumaAn
        return view('admin.konvensi.index');
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
