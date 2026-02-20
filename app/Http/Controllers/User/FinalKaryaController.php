<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FinalKarya;
use App\Models\KaryaTulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class FinalKaryaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FinalKarya::with('karya')->whereHas('karya', function ($query) {
                $query->where('user_id', Auth::id());
            });

            return DataTables::of($data)
                ->addColumn('judul', fn($row) => $row->karya->judul)
                
                ->addColumn('file', fn($row) =>
    '<a href="' . asset($row->file_path) . '" target="_blank">Lihat File</a>'
)
                
                ->addColumn('status', function ($row) {
                    switch ($row->status) {
                        case 'pending':
                            return '<span class="badge bg-warning text-white">Pending</span>';
                        case 'disetujui':
                            return '<span class="badge bg-success text-white">Disetujui</span>';
                        case 'ditolak':
                            return '<span class="badge bg-danger text-white">Ditolak</span>';
                        default:
                            return '<span class="badge bg-secondary text-white">Tidak Diketahui</span>';
                    }
                })
                ->addColumn('aksi', function ($row) {
                    $url = route('finalkarya.destroy', $row->id);
                    return '
                            <div class="btn-group">
                                <button type="button" 
                                    class="btn btn-danger btn-sm btn-delete"
                                    data-id="' . $row->id . '"
                                    data-judul="' . e($row->karya->judul) . '"
                                    data-url="' . $url . '">
                                    Hapus
                                </button>
                            </div>
                            ';
                })
                ->rawColumns(['file', 'status', 'aksi'])
                ->make(true);
        }

        return view('user.final_karya.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'karya_id' => 'required|exists:karya_tulis,id',
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        
    // Folder tujuan
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/file_final_karya';

    if (!is_dir($targetPath)) {
        mkdir($targetPath, 0777, true);
    }

    $file = $request->file('file');
    $originalName = $file->getClientOriginalName();
    $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);

    // Hindari nama file sama
    $counter = 1;
    $finalName = $safeName;
    while (file_exists($targetPath . '/' . $finalName)) {
        $finalName = time() . "_{$counter}_" . $safeName;
        $counter++;
    }

    // Upload file
    $file->move($targetPath, $finalName);

    // Simpan path ke DB (RELATIF)
    FinalKarya::create([
        'karya_id' => $request->karya_id,
        'file_path' => 'uploads/file_final_karya/' . $finalName,
        'status' => 'pending'
    ]);

        Alert::success('Berhasil', 'File Final Karya berhasil diunggah!');
        return redirect()->back();
    }

    public function update(Request $request, FinalKarya $finalkarya)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

         $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/file_final_karya';

    if (!is_dir($targetPath)) {
        mkdir($targetPath, 0777, true);
    }

    // Hapus file lama
    if ($finalkarya->file_path) {
        $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $finalkarya->file_path;
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    $file = $request->file('file');
    $originalName = $file->getClientOriginalName();
    $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);

    $file->move($targetPath, $safeName);

    $finalkarya->update([
        'file_path' => 'uploads/file_final_karya/' . $safeName
    ]);

        Alert::success('Berhasil', 'File Final Karya berhasil diperbarui!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        // Ambil FinalKarya berdasarkan user_id dan id
        $finalkarya = FinalKarya::whereHas('karya', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        // Validasi status
        if ($finalkarya->status !== 'pending') {
            Alert::warning('Tidak Diizinkan', 'File yang sudah disetujui atau ditolak tidak dapat dihapus.');
            return redirect()->route('finalkarya.index');
        }

         if ($finalkarya->file_path) {
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $finalkarya->file_path;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
        // Hapus record dari database
        $finalkarya->delete();

        Alert::success('Berhasil', 'File Final Karya berhasil dihapus!');
        return redirect()->route('finalkarya.index')
            ->with('success', 'File berhasil dihapus.');
    }
}
