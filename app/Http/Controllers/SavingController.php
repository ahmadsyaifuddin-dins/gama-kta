<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavingRequest;
use App\Models\Member;
use App\Models\Saving;
use Illuminate\Support\Facades\Storage;

class SavingController extends Controller
{
    public function index()
    {
        // Ambil data simpanan, urutkan dari yang terbaru
        // with('member') biar gak berat query-nya (Eager Loading)
        $savings = Saving::with('member')->latest()->paginate(10);

        return view('savings.index', compact('savings'));
    }

    public function create()
    {
        // Kita butuh daftar anggota buat dipilih di dropdown
        // Hanya ambil anggota yang AKTIF saja
        $members = Member::where('status', 'active')->orderBy('nama_lengkap')->get();

        return view('savings.create', compact('members'));
    }

    public function store(SavingRequest $request)
    {
        $data = $request->validated();

        // 1. Upload Bukti Transfer jika ada
        if ($request->hasFile('bukti_transfer')) {
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('savings-proof', 'public');
        }

        // 2. Catat User yang menginput (Admin yang login)
        $data['user_id'] = auth()->id();

        Saving::create($data);

        return redirect()->route('savings.index')->with('success', 'Transaksi simpanan berhasil dicatat!');
    }

    public function edit(Saving $saving)
    {
        $members = Member::where('status', 'active')->orderBy('nama_lengkap')->get();

        return view('savings.edit', compact('saving', 'members'));
    }

    public function update(SavingRequest $request, Saving $saving)
    {
        $data = $request->validated();

        if ($request->hasFile('bukti_transfer')) {
            // Hapus file lama
            if ($saving->bukti_transfer) {
                Storage::disk('public')->delete($saving->bukti_transfer);
            }
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('savings-proof', 'public');
        }

        $saving->update($data);

        return redirect()->route('savings.index')->with('success', 'Data simpanan berhasil diperbarui.');
    }

    public function destroy(Saving $saving)
    {
        if ($saving->bukti_transfer) {
            Storage::disk('public')->delete($saving->bukti_transfer);
        }

        $saving->delete();

        return redirect()->route('savings.index')->with('success', 'Data transaksi dihapus.');
    }
}
