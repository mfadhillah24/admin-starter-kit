<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', [
            'title' => 'User',
            'users' => User::latest()->get()    
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', [
            'title' => 'Create User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'role' => 'required|in:Superadmin,Admin',
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
            
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih harus Superadmin atau Admin.',
        ]);

        DB::beginTransaction();

        try {
            if ($request->file('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            // Enkripsi password sebelum disimpan ke database
            $validated['password'] = Hash::make($validated['password']);

            // Simpan data user ke database
            User::create($validated);

            DB::commit(); 

            return to_route('user.index')->withSuccess('User created successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return to_route('user.create')
                ->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}