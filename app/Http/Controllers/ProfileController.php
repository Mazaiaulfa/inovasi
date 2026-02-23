<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display profile page
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return view('admin.profile.index', compact('user'));
        }

        return view('user.profile.index', compact('user'));
    }

    /**
     * Update profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:6|confirmed'
        ]);

        $user->update([
            'name' => $request->name,
            'unit_kerja' => $request->unit_kerja,
            'email' => $request->email,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password
        ]);

        return back()->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Delete account
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
