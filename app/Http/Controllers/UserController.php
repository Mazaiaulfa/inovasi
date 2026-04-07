<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
   public function index()
{
    if (request()->ajax()) {

        $query = User::latest();

        // 🔥 TAMBAHAN FILTER
        if (request()->jenis && request()->jenis != 'all') {
            $query->where('jenis_peserta', request()->jenis);
        }

        return Datatables::of($query)
            ->addColumn('action', function ($item) {
                return '
                <div class="btn-group">
                    <a href="' . route('user.edit', $item->id) . '" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="' . route('user.destroy', $item->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm btn-delete">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('admin.user.index');
}
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jenis_peserta' => 'required|in:EIF,GKM,SS',
            'direktorat' => 'required',
            'kompartemen' => 'required',
            'unit_kerja' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'jenis_peserta' => $request->jenis_peserta,
            'direktorat' => $request->direktorat,
            'kompartemen' => $request->kompartemen,
            'unit_kerja' => $request->unit_kerja,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Alert::success('Berhasil!', 'User baru telah dibuat');
        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'jenis_peserta' => 'required|in:EIF,GKM,SS',
            'direktorat' => 'required',
            'kompartemen' => 'required',
            'unit_kerja' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'jenis_peserta' => $request->jenis_peserta,
            'direktorat' => $request->direktorat,
            'kompartemen' => $request->kompartemen,
            'unit_kerja' => $request->unit_kerja,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        Alert::success('Berhasil!', 'Data user telah diperbarui');
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Berhasil!', 'User telah dihapus');
        return redirect()->route('user.index');
    }
}
