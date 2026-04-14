<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AdminJuriController extends Controller
{


public function index()
{
    $juri = User::where('role', 'juri')->get();

    return view('admin.juri.index', compact('juri'));
}

public function formAssign($id)
{

    $juri = User::where('role', 'juri')->findOrFail($id);
    $peserta = User::where('role', 'user')
    ->with('juriPenilai')
    ->whereHas('finalKarya', function ($q) {
        $q->where('status', 'disetujui')
          ->whereNotNull('file_path');
    })
    ->get();

    // ambil yang sudah dipilih sebelumnya
    $selected = $juri->pesertaYangDinilai->pluck('id')->toArray();

    return view('admin.juri.assign', compact('juri', 'peserta', 'selected'));
}

public function assign(Request $request)
{
    $request->validate([
        'juri_id' => 'required|exists:users,id',
        'peserta_id' => 'required|array',
        'peserta_id.*' => 'exists:users,id'
    ]);
    $juri = User::findOrFail($request->juri_id);

    $juri->pesertaYangDinilai()->sync($request->peserta_id);

    return back()->with('success', 'Berhasil assign peserta ke juri');
}

public function DaftarPeserta($id)
{
    $juri = User::findOrFail($id);

    $peserta = $juri->pesertaYangDinilai;

    return view('admin.juri.daftar', compact('juri', 'peserta'));
}

public function create()
{
    return view('admin.juri.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'juri'
    ]);

    return redirect()->route('admin.juri.index')
        ->with('success', 'Juri berhasil ditambahkan');
}


public function edit($id)
{
    $juri = User::findOrFail($id);
    return view('admin.juri.edit', compact('juri'));
}

public function update(Request $request, $id)
{
    $juri = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // kalau password diisi, baru diupdate
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $juri->update($data);

    return redirect()->route('admin.juri.index')
        ->with('success', 'Data berhasil diupdate');
}

public function destroy($id)
{
    $juri = User::findOrFail($id);
    $juri->delete();

    return back()->with('success', 'Data berhasil dihapus');
}
}



