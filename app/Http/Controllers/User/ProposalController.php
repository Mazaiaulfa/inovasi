<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\KaryaTulis;
use App\Models\Tahapan;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class ProposalController extends Controller
{
    public function index()
    {
        $tahapan = Tahapan::orderBy('urutan')->get();
        return view('user.proposal.index', compact('tahapan'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'karya_id' => 'required|exists:karya_tulis,id',
                'tahap_id' => 'required|exists:tahapan,id',
                'file' => 'required|mimes:pdf|max:2048'
            ]);

            $karya = KaryaTulis::find($request->karya_id);
            $tahapan = Tahapan::find($request->tahap_id);
            $user = Auth::user();

            if (!$karya || !$tahapan) {
                Alert::error('Gagal', 'Karya atau Tahapan tidak ditemukan.');
                return back()->with('error', 'Data tidak valid.');
            }

                        if ($karya->status !== 'disetujui') {
                Alert::error('Gagal', 'Makalah hanya bisa diajukan jika judul sudah disetujui.');
                return back()->withErrors([
                    'karya_id' => 'Makalah hanya bisa diajukan jika judul sudah disetujui.'
                ]);
            }

            // Cek apakah sudah ada proposal untuk tahap ini
            $existing = Proposal::where('karya_id', $karya->id)
                ->where('tahap_id', $tahapan->id)
                ->whereIn('status', ['pending', 'disetujui', 'ditolak'])
                ->exists();

            if ($existing) {
                Alert::error('Gagal', 'Proposal untuk tahapan ini sedang diproses atau sudah disetujui.');
                return back()->withErrors(['tahap_id' => 'Proposal untuk tahapan ini sedang diproses atau sudah disetujui.']);
            }

                        // Folder tujuan
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/file_makalah';

            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            // Ambil file
            $file = $request->file('file');

            // Nama asli + sanitasi
            $originalName = $file->getClientOriginalName();
            $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);

            // Pindahkan file
            $file->move($targetPath, $safeName);

            // Path yang disimpan ke DB (RELATIF DARI PUBLIC)
            $filePath = 'uploads/file_makalah/' . $safeName;

            // Simpan ke database
            Proposal::create([
                'karya_id' => $karya->id,
                'tahap_id' => $tahapan->id,
                'file_path' => $filePath,
                'status' => 'pending',
                'catatan' => null
            ]);

            Alert::success('Berhasil', 'Proposal berhasil diunggah!');
            return back()->with('success', 'Proposal berhasil diunggah.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal: ', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan proposal: ' . $e->getMessage());
            Alert::error('Error', 'Terjadi kesalahan saat mengunggah proposal.');
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getData()
    {
        $proposals = Proposal::with(['karya', 'tahapan'])
            ->whereHas('karya', function ($q) {
                $q->where('user_id', Auth::id());
            });

        return datatables()->of($proposals)
            ->addColumn('judul', function ($proposal) {
                return $proposal->karya->judul ?? '-';
            })
            ->addColumn('tahapan', function ($proposal) {
                if (!$proposal->tahapan) return '-';
                return "<strong>{$proposal->tahapan->nama}</strong><br><small>{$proposal->tahapan->deskripsi}</small>";
            })
            ->addColumn('file', function ($proposal) {
            return "<a href='" . asset($proposal->file_path) . "' target='_blank'>Lihat File</a>";
        })
            ->addColumn('waktu_upload', function ($row) {
                return $row->created_at ? $row->created_at->format('d M Y') : '-';
            })
            ->addColumn('status', function ($proposal) {
                $badgeClass = match ($proposal->status) {
                    'disetujui' => 'success',
                    'ditolak' => 'danger',
                    default => 'warning',
                };
                return "<span class='badge bg-{$badgeClass} text-white'>" . ucfirst($proposal->status) . "</span>";
            })
            ->addColumn('aksi', function ($proposal) {
                $url = route('proposal.destroy', $proposal->id);
                return '
                <button class="btn btn-danger btn-sm btn-delete"
                    data-id="' . $proposal->id . '"
                    data-judul="' . e($proposal->karya->judul) . '"
                    data-url="' . $url . '">
                    Hapus
                </button>
            ';
            })
            ->rawColumns(['file', 'status', 'tahapan', 'waktu_upload', 'aksi'])
            ->make(true);
    }

    public function destroy($id)
    {
        try {
            $proposal = Proposal::whereHas('karya', function ($query) {
                $query->where('user_id', Auth::id());
            })->findOrFail($id);

            // Validasi status proposal, hanya yang statusnya pending yang bisa dihapus
            if ($proposal->status !== 'pending') {
                return response()->json([
                    'status' => false,
                    'message' => 'Proposal dengan status ' . ucfirst($proposal->status) . ' tidak dapat dihapus.'
                ], 400);
            }

                      $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $proposal->file_path;

            if ($proposal->file_path && file_exists($fullPath)) {
                unlink($fullPath);
            }

                        // Hapus proposal dari database
            $proposal->delete();

            return response()->json([
                'status' => true,
                'message' => 'Proposal berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error saat menghapus proposal: ' . $e->getMessage());
            Alert::error('Error', 'Terjadi kesalahan saat menghapus proposal.');
            return redirect()->route('proposal.index')->with('error', 'Terjadi kesalahan saat menghapus proposal.');
        }
    }
}
