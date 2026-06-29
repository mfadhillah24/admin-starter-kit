<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show()
    {
        return view('dashboard.show', [
            'title' => 'Profile',
            'user' => Auth::user(),
        ]);
    }


    public function edit(){
        return view('dashboard.edit', [
            'title' => 'Edit User',
            'user' => Auth::user(),
        ]);
    }


    public function update(Request $request)
    {
        {

        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|same:password',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            
        ],
        [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
            
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'email.max' => 'Email tidak boleh lebih dari :max karakter.',
            
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus :min karakter.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok.',
            
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'avatar.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
            
           
        ]);

        DB::beginTransaction();

        try {
            if ($request->file('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }

            if($request->password) {
                $validated['password'] = bcrypt($request->password);
            }else{
                unset($validated['password']);
            }


             $validated['password'] = bcrypt($request->password);
             
            // Enkripsi password sebelum disimpan ke database
            $validated['password'] = Hash::make($validated['password']);

            // Simpan data user ke database
            $user->update($validated);

            DB::commit(); 

            return to_route('dashboard.show')->withSuccess('User updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return to_route('dashboard.edit')->with('error', 'Failed to update user: ' . $e->getMessage());
        }
    }
    }


    public function destroy(string $id)
    {
        //
    }
}