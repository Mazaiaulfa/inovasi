<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinalKarya;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Mail\FinalisasiMakalahMail;
use Illuminate\Support\Facades\Mail;

class VerifFinalController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $final = FinalKarya::with(['karya.user'])
                    ->whereHas('karya.user')
                    ->latest();

                return DataTables::of($final)
                    ->addIndexColumn()
                    ->addColumn('judul', fn($row) => $row->karya->judul ?? '-')
                    ->addColumn('nama', fn($row) => $row->karya->user->name ?? '-')
                   ->addColumn('file', function ($row) {
                    if ($row->file_path) {
                        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $row->file_path;
                
                        if (file_exists($fullPath)) {
                            return '<a href="' . asset($row->file_path) . '"
                                target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> Lihat</a>';
                        }
                    }
                
                    return '<span class="text-muted">File tidak tersedia</span>';
                })

                    ->addColumn('catatan', fn($row) => $row->notes ?? '-')
                    ->addColumn('aksi', function ($row) {
                        return '
                        <button class="btn btn-sm btn-primary btn-verif"
                            data-id="' . $row->id . '"
                            data-nama="' . e($row->karya->user->name ?? '-') . '"
                            data-judul="' . e($row->karya->judul ?? '-') . '"
                            data-file="' . e($row->file_path ?? '') . '"
                            data-status="' . e($row->status) . '"
                            data-notes="' . e($row->notes ?? '') . '">
                            <i class="fas fa-check-circle"></i>
                            Verifikasi
                            </button>

                        <button class="btn btn-sm btn-warning btn-edit"
                            data-id="' . $row->id . '"
                            data-nama="' . e($row->karya->user->name ?? '-') . '"
                            data-judul="' . e($row->karya->judul ?? '-') . '"
                            data-status="' . e($row->status) . '"
                            data-notes="' . e($row->notes ?? '') . '">
                            <i class="fas fa-edit"></i>
                             Edit
                        </button>

                        <button class="btn btn-sm btn-danger btn-delete"
                            data-id="' . $row->id . '">
                            <i class="fas fa-trash"></i> Hapus</button>';
                    })
                    ->rawColumns(['file', 'aksi'])
                    ->make(true);
            }

            return view('admin.final.index');
        } catch (\Exception $e) {
            Log::error('Error di VerifFinalController@index: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['error' => 'Gagal memuat data'], 500);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $final = FinalKarya::with(['karya.user'])->findOrFail($id);

            $validatedData = $request->validate([
                'status' => 'required|in:pending,disetujui,ditolak',
                'catatan' => 'nullable|string|max:1000'
            ]);

            $final->update([
                'status' => $validatedData['status'],
                'notes' => $validatedData['catatan'] ?? null,
            ]);

              // Kirim email ke user
    if ($final->karya && $final->karya->user && $final->karya->user->email) {
        $user   = $final->karya->user;
        $judul  = $final->karya->judul ?? '-';
        $status = $final->status;
        $catatan = $final->notes ?? null;

        Mail::to($user->email)->send(
            new FinalisasiMakalahMail($user, $judul, $status, $catatan)
        );
    }

    Log::info('Final karya diverifikasi', [
        'id' => $final->id,
        'status' => $final->status,
        'user' => auth()->user()->name ?? 'Unknown'
    ]);

            Log::info('Final karya diverifikasi', [
                'id' => $final->id,
                'status' => $final->status,
                'user' => auth()->user()->name ?? 'Unknown'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Final karya berhasil diverifikasi!'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data final karya tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Gagal verifikasi final karya', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat verifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $final = FinalKarya::with(['karya.user'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $final->id,
                    'nama' => $final->karya->user->name ?? 'N/A',
                    'judul' => $final->karya->judul ?? 'N/A',
                    'file_path' => $final->file_path,
                    'status' => $final->status,
                    'notes' => $final->notes,
                    'submitted_at' => $final->created_at->format('d/m/Y'),
                ]
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error di VerifFinalController@show: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data final karya'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $final = FinalKarya::findOrFail($id);

            if ($final->file_path) {
            $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $final->file_path;

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
            $final->delete();

            return response()->json([
                'success' => true,
                'message' => 'Final karya berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus final karya: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus final karya.'
            ], 500);
        }
    }
}
