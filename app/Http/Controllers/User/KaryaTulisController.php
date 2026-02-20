<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KaryaTulis;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class KaryaTulisController extends Controller
{
    // =========================
    // TAMPIL DATA
    // =========================
    public function index()
    {
        if (request()->ajax()) {
            $query = KaryaTulis::where('user_id', Auth::id())->latest();

            return Datatables::of($query)
                ->addColumn('file_ajukan', function ($item) {
                    return '<a href="'.asset($item->file_ajukan).'" target="_blank" class="btn btn-info btn-sm">Lihat File</a>';
                })
                ->addColumn('catatan', function ($item) {
                    return $item->catatan_judul ?? '-';
                })
                ->addColumn('action', function ($item) {
                    return '
                    <div class="btn-group">
                        <a href="' . route('karya.edit', $item->id) . '" class="btn btn-primary btn-sm mr-2">
                            Edit
                        </a>
                        <form action="' . route('karya.destroy', $item->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action', 'file_ajukan'])
                ->make(true);
        }

        return view('user.karya.index');
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_ajukan' => 'required|mimes:pdf|max:2048',
        ]);

        $pendingJudul = KaryaTulis::where('user_id', Auth::id())
            ->where('status_judul', 'pending')
            ->exists();

        if ($pendingJudul) {
            Alert::warning('Pengajuan Gagal', 'Anda sudah memiliki judul yang sedang menunggu verifikasi.');
            return redirect()->route('karya.index');
        }

        // Tentukan folder upload
        $targetPath = public_path('uploads/file_judul');

        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0777, true);
        }

        // Upload file
        $file = $request->file('file_ajukan');
        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->move($targetPath, $filename);

        $filePath = 'uploads/file_judul/' . $filename;

        // Simpan ke database
        KaryaTulis::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'file_ajukan' => $filePath,
            'status_judul' => 'pending',
        ]);

        Alert::success('Berhasil', 'Judul berhasil diajukan.');
        return redirect()->route('karya.index');
    }

    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $karya = KaryaTulis::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($karya->status_judul === 'disetujui') {
            Alert::warning('Tidak Diizinkan', 'Judul yang sudah disetujui tidak dapat diedit.');
            return redirect()->route('karya.index');
        }

        return view('user.karya.edit', compact('karya'));
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_ajukan' => 'nullable|mimes:pdf|max:2048',
        ]);

        $karya = KaryaTulis::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($karya->status_judul !== 'pending') {
            Alert::warning('Tidak Diizinkan', 'Judul yang sudah diverifikasi tidak dapat diubah.');
            return redirect()->route('karya.index');
        }

        if ($request->hasFile('file_ajukan')) {

            // Hapus file lama
            if ($karya->file_ajukan && file_exists(public_path($karya->file_ajukan))) {
                unlink(public_path($karya->file_ajukan));
            }

            $targetPath = public_path('uploads/file_judul');

            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            $file = $request->file('file_ajukan');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move($targetPath, $filename);

            $karya->file_ajukan = 'uploads/file_judul/' . $filename;
        }

        $karya->judul = $request->judul;
        $karya->save();

        Alert::success('Diperbarui', 'Judul berhasil diperbarui.');
        return redirect()->route('karya.index');
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        $pendingJudul = KaryaTulis::where('user_id', Auth::id())
            ->where('status_judul', 'pending')
            ->exists();

        if ($pendingJudul) {
            Alert::warning('Tidak Diizinkan', 'Anda sudah memiliki judul yang sedang menunggu verifikasi.');
            return redirect()->route('karya.index');
        }

        return view('user.karya.create');
    }

    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($id)
    {
        $karya = KaryaTulis::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (in_array($karya->status_judul, ['disetujui', 'ditolak'])) {
            Alert::warning('Tidak Diizinkan', 'Judul yang sudah diverifikasi tidak dapat dihapus.');
            return redirect()->route('karya.index');
        }

        if ($karya->file_ajukan && file_exists(public_path($karya->file_ajukan))) {
            unlink(public_path($karya->file_ajukan));
        }

        $karya->delete();

        Alert::success('Dihapus', 'Judul berhasil dihapus.');
        return redirect()->route('karya.index');
    }
}
