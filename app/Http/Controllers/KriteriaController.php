<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    // tampilkan data
    public function index()
{
    $kriterias = Kriteria::orderBy('item')
                    ->orderBy('no')
                    ->get()
                    ->groupBy('item');

    return view('admin.kriteria.index', compact('kriterias'));
}

    // form tambah
    public function create()
    {
        return view('admin.kriteria.create');
    }

    // simpan data
    public function store(Request $request)
{
    $request->validate([
        'item' => 'required',
        'no' => 'required|numeric',
        'nama' => 'required',
        'keterangan' => 'required',
        'rujukan' => 'nullable',
        'skala_1_4' => 'required',
        'skala_5_6' => 'required',
        'skala_7_8' => 'required',
        'skala_9_10' => 'required',
    ]);

    Kriteria::create([
        'item' => $request->item,
        'no' => $request->no,
        'nama' => $request->nama,
        'keterangan' => $request->keterangan,
        'rujukan' => $request->rujukan,
        'skala_1_4' => $request->skala_1_4,
        'skala_5_6' => $request->skala_5_6,
        'skala_7_8' => $request->skala_7_8,
        'skala_9_10' => $request->skala_9_10,
    ]);

    return redirect()->route('admin.kriteria.index')
        ->with('success', 'Kriteria berhasil ditambahkan');
}
    // form edit
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    // update data
    public function update(Request $request, $id)
{
    $request->validate([
        'item' => 'required',
        'no' => 'required|numeric',
        'nama' => 'required',
        'keterangan' => 'required',
        'rujukan' => 'nullable',
        'skala_1_4' => 'required',
        'skala_5_6' => 'required',
        'skala_7_8' => 'required',
        'skala_9_10' => 'required',
    ]);

    $kriteria = Kriteria::findOrFail($id);

    $kriteria->update($request->all());

    return redirect()->route('admin.kriteria.index')
        ->with('success', 'Kriteria berhasil diupdate');
}

    // hapus
    public function destroy($id)
    {
        Kriteria::findOrFail($id)->delete();

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus');
    }
}
