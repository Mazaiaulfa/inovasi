<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $anggota = Anggota::with('user')->select('anggota.*');

            return DataTables::of($anggota)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-primary edit-btn">Edit</button>
                        <button type="button" data-id="' . $row->id . '" class="btn btn-sm btn-danger delete-btn">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = User::all();
        return view('admin.anggota.index', compact('users'));
    }

    public function show($id)
    {
        $anggota = Anggota::with('user')->findOrFail($id);
        return response()->json(['status' => true, 'data' => $anggota]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'badge' => 'required|string|max:50',
            'jabatan' => 'required|in:ketua,sekretaris,fasilitator,anggota'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // Cek 1 ketua per user
        if ($request->jabatan == 'ketua') {
            $cekKetua = Anggota::where('user_id', $request->user_id)->where('jabatan', 'ketua')->exists();
            if ($cekKetua) {
                return response()->json(['status' => false, 'message' => 'Team ini sudah memiliki Ketua.'], 422);
            }
        }

        $anggota = Anggota::create($request->only('user_id', 'nama', 'jabatan','badge'));
        return response()->json(['status' => true, 'message' => 'Anggota berhasil ditambahkan', 'data' => $anggota]);
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
                     'badge' => 'required|string|max:50',
            'jabatan' => 'required|in:ketua,sekretaris,fasilitator,anggota'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        if ($request->jabatan == 'ketua' && $anggota->jabatan !== 'ketua') {
            $cekKetua = Anggota::where('user_id', $request->user_id)
                ->where('jabatan', 'ketua')
                ->where('id', '!=', $id)
                ->exists();
            if ($cekKetua) {
                return response()->json(['status' => false, 'message' => 'User ini sudah memiliki Ketua.'], 422);
            }
        }

        $anggota->update($request->only('user_id', 'nama', 'jabatan','badge'));
        return response()->json(['status' => true, 'message' => 'Anggota berhasil diupdate']);
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        return response()->json(['status' => true, 'message' => 'Anggota berhasil dihapus']);
    }
}
