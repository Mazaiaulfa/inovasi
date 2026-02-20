<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    // List pengumuman
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(10);
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    // Form create
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    // Simpan pengumuman baru
 public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'ringkasan' => 'nullable|string',
        'isi' => 'required|string',
        'gambar' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
    ]);

    $filePath = null;

    if ($request->hasFile('gambar')) {

        if (!file_exists(public_path('uploads/pengumuman'))) {
            mkdir(public_path('uploads/pengumuman'), 0777, true);
        }

        $file = $request->file('gambar');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/pengumuman'), $fileName);
        $filePath = 'uploads/pengumuman/'.$fileName;
    }

    Pengumuman::create([
        'judul' => $request->judul,
        'ringkasan' => $request->ringkasan,
        'isi' => $request->isi,
        'gambar' => $filePath,
        'urgent' => $request->urgent ?? 0,
        'is_active' => $request->is_active ?? 0,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
    ]);

    return redirect()->route('admin.pengumuman.index')
        ->with('success', 'Pengumuman berhasil dibuat');
}


    // Form edit
    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    // Update pengumuman
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'urgent' => 'nullable|boolean',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($pengumuman->gambar && file_exists(public_path($pengumuman->gambar))) {
                unlink(public_path($pengumuman->gambar));
            }
            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/pengumuman'), $fileName);
            $pengumuman->gambar = 'uploads/pengumuman/'.$fileName;
        }

        $pengumuman->update([
            'judul' => $request->judul,
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'urgent' => $request->urgent ? 1 : 0,
            'is_active' => $request->is_active ? 1 : 0,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diupdate');
    }

    // Hapus pengumuman
    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar && file_exists(public_path($pengumuman->gambar))) {
            unlink(public_path($pengumuman->gambar));
        }
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }

    // Optional: detail pengumuman
    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }
}

