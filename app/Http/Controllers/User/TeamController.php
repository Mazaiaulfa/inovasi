<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user_id = Auth::id();

            $anggota = Anggota::where('user_id', $user_id)->get();

            return DataTables::of($anggota)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button" data-id="' . $row->id . '" class="btn btn-primary btn-sm edit-btn">Edit</button>
                        <button type="button" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-btn">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user.anggota.index');
    }

    public function create()
    {
        $jabatan = ['ketua', 'sekretaris', 'fasilitator', 'anggota'];
        return view('user.anggota.create', compact('jabatan'));
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'jabatan' => 'required|in:ketua,sekretaris,fasilitator,anggota',
        'badge' => 'required|string|max:50|unique:anggota,badge',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
        ], 422);
    }

    $user_id = Auth::id();

    // ===============================
    // BATASAN TEAM
    // ===============================

    // 1️⃣ Total maksimal 7 orang
    $totalTeam = Anggota::where('user_id', $user_id)->count();
    if ($totalTeam >= 7) {
        return response()->json([
            'status' => false,
            'message' => 'Total maksimal 7 orang dalam 1 team.'
        ], 422);
    }

    // 2️⃣ Maksimal 1 Ketua
    if ($request->jabatan === 'ketua') {
        $existingKetua = Anggota::where('user_id', $user_id)
            ->where('jabatan', 'ketua')
            ->exists();

        if ($existingKetua) {
            return response()->json([
                'status' => false,
                'message' => 'Hanya boleh 1 Ketua dalam team.'
            ], 422);
        }
    }

    // 3️⃣ Maksimal 1 Fasilitator
    if ($request->jabatan === 'fasilitator') {
        $existingFasilitator = Anggota::where('user_id', $user_id)
            ->where('jabatan', 'fasilitator')
            ->exists();

        if ($existingFasilitator) {
            return response()->json([
                'status' => false,
                'message' => 'Hanya boleh 1 Fasilitator dalam team.'
            ], 422);
        }
    }

    // 4️⃣ Maksimal 5 Anggota Biasa
    if ($request->jabatan === 'anggota') {
        $jumlahAnggota = Anggota::where('user_id', $user_id)
            ->where('jabatan', 'anggota')
            ->count();

        if ($jumlahAnggota >= 5) {
            return response()->json([
                'status' => false,
                'message' => 'Maksimal 5 anggota dalam team.'
            ], 422);
        }
    }

    // ===============================

    $anggota = Anggota::create([
        'user_id' => $user_id,
        'nama' => $request->nama,
        'badge' => $request->badge,
        'jabatan' => $request->jabatan,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Anggota berhasil ditambahkan',
        'data' => $anggota
    ]);
}

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        if ($anggota->user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak. Bukan anggota Anda.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data' => $anggota
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|in:ketua,sekretaris,fasilitator,anggota',
            'badge' => 'required|string|max:50|unique:anggota,badge,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $anggota = Anggota::findOrFail($id);

        if ($anggota->user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak. Bukan anggota Anda.'
            ], 403);
        }

        // Jika ingin mengubah menjadi ketua, pastikan belum ada ketua lain
        if ($request->jabatan === 'ketua' && $anggota->jabatan !== 'ketua') {
            $existingKetua = Anggota::where('user_id', Auth::id())
                ->where('jabatan', 'ketua')
                ->exists();

            if ($existingKetua) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sudah ada ketua. Hanya boleh satu.'
                ], 422);
            }
        }

        $anggota->update([
            'nama' => $request->nama,
            'badge' => $request->badge,
            'jabatan' => $request->jabatan

        ]);

        return response()->json([
            'status' => true,
            'message' => 'Anggota berhasil diperbarui',
            'data' => $anggota
        ]);
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);

        if ($anggota->user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak. Bukan anggota Anda.'
            ], 403);
        }

        $anggota->delete();

        return response()->json([
            'status' => true,
            'message' => 'Anggota berhasil dihapus'
        ]);
    }
}
