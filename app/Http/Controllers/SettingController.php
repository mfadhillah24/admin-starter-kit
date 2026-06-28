<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting.index', [
            'setting' => Setting::first(),
            'title' => 'Setting',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('setting.edit', [
            'setting' => $setting,
            'title' => 'Edit Setting',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'copyright' => 'required|string|max:255',
            'login_title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
        ],
        [
            'app_name.required' => 'Nama aplikasi wajib diisi.',
            'app_name.max' => 'Nama aplikasi tidak boleh lebih dari :max karakter.',
            
            'copyright.required' => 'Copyright wajib diisi.',
            'copyright.max' => 'Copyright tidak boleh lebih dari :max karakter.',
            
            'login_title.required' => 'Judul login wajib diisi.',
            'login_title.max' => 'Judul login tidak boleh lebih dari :max karakter.',
            
            'logo.image' => 'Logo harus berupa gambar.',
            'logo.mimes' => 'Format logo harus jpeg, png, atau jpg.',
            'logo.max' => 'Ukuran logo tidak boleh lebih dari 1MB.',
        ]);

        DB::beginTransaction();

        try {
            if ($request->file('logo')) {
                // Hapus logo lama jika ada sebelum replace dengan yang baru
                if ($setting->logo) {
                    Storage::disk('public')->delete($setting->logo);
                }
                $validated['logo'] = $request->file('logo')->store('logo', 'public');
            }

            // Simpan perubahan ke database
            $setting->update($validated);

            DB::commit(); 

            return to_route('setting.index')->withSuccess('Settings updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return to_route('setting.edit', $setting)->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}