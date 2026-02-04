<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagementRequest;
use App\Models\Management;
use Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{
    public function index()
    {
        // Urutkan: Yang masih aktif duluan, lalu berdasarkan tahun terbaru
        $managements = Management::orderBy('is_active', 'desc')
            ->orderBy('periode_mulai', 'desc')
            ->paginate(10);

        return view('managements.index', compact('managements'));
    }

    public function create()
    {
        return view('managements.create');
    }

    public function store(ManagementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('managements-photos', 'public');
        }

        // Set default is_active ke true (1) kalau tidak dikirim form
        if (! isset($data['is_active'])) {
            $data['is_active'] = 1;
        }

        Management::create($data);

        return redirect()->route('managements.index')->with('success', 'Data pengurus berhasil ditambahkan.');
    }

    public function edit(Management $management)
    {
        return view('managements.edit', compact('management'));
    }

    public function update(ManagementRequest $request, Management $management)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($management->foto) {
                Storage::disk('public')->delete($management->foto);
            }
            $data['foto'] = $request->file('foto')->store('managements-photos', 'public');
        }

        // Checkbox handling: jika tidak dicentang, nilainya 0
        $data['is_active'] = $request->has('is_active');

        $management->update($data);

        return redirect()->route('managements.index')->with('success', 'Data pengurus diperbarui.');
    }

    public function destroy(Management $management)
    {
        if ($management->foto) {
            Storage::disk('public')->delete($management->foto);
        }

        $management->delete();

        return redirect()->route('managements.index')->with('success', 'Data pengurus dihapus.');
    }
}
