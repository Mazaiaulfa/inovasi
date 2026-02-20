<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tahapan;
use App\Models\Proposal;
use Yajra\DataTables\DataTables;

class TahapanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tahapan::orderBy('urutan')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-sm btn-warning edit-btn" data-id="' . $row->id . '">Edit</button> 
                            <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Hapus</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.tahapan.index');
    }

    public function show($id)
    {
        $tahapan = Tahapan::findOrFail($id);
        return response()->json([
            'data' => $tahapan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        Tahapan::create($request->all());

        return response()->json(['success' => 'Tahapan berhasil ditambahkan!']);
    }

    public function edit($id)
    {
        $data = Tahapan::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $data = Tahapan::findOrFail($id);
        $data->update($request->all());

        return response()->json(['success' => 'Tahapan berhasil diupdate!']);
    }

    public function destroy($id)
    {
        $data = Tahapan::findOrFail($id);
        $data->delete();

        return response()->json(['success' => 'Tahapan berhasil dihapus!']);
    }
}
