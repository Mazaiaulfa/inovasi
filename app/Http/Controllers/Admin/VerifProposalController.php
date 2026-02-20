<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Tahapan;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\PengajuanMakalahMail;
use Illuminate\Support\Facades\Mail;

class VerifProposalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $proposal = Proposal::with('karya.user', 'tahapan')->latest();

            if ($request->has('status') && $request->status != '') {
                $proposal->where('status', $request->status);
            }

            return DataTables::of($proposal)
                ->addIndexColumn()
                ->addColumn('judul', fn($row) => $row->karya->judul ?? '-')
                ->addColumn('nama', fn($row) => $row->karya->user->name ?? '-')
                ->addColumn('tahapan', function ($row) {
                    if (!$row->tahapan) return '-';
                    return "<strong>{$row->tahapan->nama}</strong><br><small>{$row->tahapan->deskripsi}</small>";
                })
               ->addColumn('file', fn($row) =>
             '<a href="' . asset($row->file_path) . '" target="_blank">Lihat</a>'
)
               
                ->addColumn('catatan', function ($row) {
                    return $row->catatan ?: '-';
                })
                ->addColumn('waktu_upload', fn($row) => $row->created_at?->format('d M Y ') ?? '-')
                ->addColumn('aksi', function ($row) {
                    return '
                    <button class="btn btn-sm btn-info btn-preview"
                        data-id="' . $row->id . '"
                        data-nama="' . ($row->karya->user->name ?? '-') . '"
                        data-judul="' . ($row->karya->judul ?? '-') . '"
                        data-status="' . $row->status . '"
                        data-catatan="' . ($row->catatan ?? '') . '">
                       <i class="fas fa-check-circle"></i>
                       </button>

                    <button class="btn btn-sm btn-warning btn-edit"
                        data-id="' . $row->id . '"
                        data-tahap_id="' . $row->tahap_id . '"
                         data-status="' . $row->status . '"
                       data-file="' . asset($row->file_path) . '">
                       
                      <i class="fas fa-edit"></i>
                     </button>


                    <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">
                     <i class="fas fa-trash"></i></button>';
                })
                ->rawColumns(['file', 'aksi', 'tahapan', 'catatan'])
                ->make(true);
        }

        $tahapan = Tahapan::all();
        return view('admin.proposal.index', compact('tahapan'));
    }


    public function verifikasi(Request $request, Proposal $proposal)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $proposal->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);


        // 🔹 Kirim email ke user
            if ($proposal->karya && $proposal->karya->user && $proposal->karya->user->email) {
                Mail::to($proposal->karya->user->email)->send(
                    new PengajuanMakalahMail(
                        $proposal->karya->user,
                        $proposal->karya->judul,
                        $proposal->status,
                        $proposal->catatan
                    )
                );
            }

        Alert::success('Berhasil', 'Proposal berhasil diverifikasi.');
        return redirect()->back();
    }

    public function edit(Proposal $proposal)
    {
        $tahapan = Tahapan::all();
        return view('admin.proposal.index', compact('tahapan'));
    }

    public function update(Request $request, Proposal $proposal)
    {
          $request->validate([
        'file_path' => 'nullable|mimes:pdf|max:2048',
        'tahap_id' => 'nullable|exists:tahapan,id',
    ]);

    // ===== GANTI FILE JIKA ADA =====
    if ($request->hasFile('file_path')) {

        // Hapus file lama
        if ($proposal->file_path) {
            $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $proposal->file_path;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // Folder tujuan
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/file_makalah';
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0777, true);
        }

        $file = $request->file('file_path');
        $originalName = $file->getClientOriginalName();
        $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);

        // Upload file baru
        $file->move($targetPath, $safeName);

        // Simpan path baru ke DB
        $proposal->file_path = 'uploads/file_makalah/' . $safeName;
    }

    // ===== UPDATE TAHAP (JIKA ADA) =====
    if ($request->filled('tahap_id')) {
        $proposal->tahap_id = $request->tahap_id;
    }
        $proposal->save();

        Alert::success('Berhasil', 'Proposal berhasil diperbarui.');
        return redirect()->route('admin.proposal.index');
    }

    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);

    if ($proposal->file_path) {
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $proposal->file_path;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

        $proposal->delete();

        return response()->json(['message' => 'Proposal berhasil dihapus.']);
    }
}
