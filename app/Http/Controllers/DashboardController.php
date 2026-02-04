<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Saving; // Import Model Simpanan
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK UTAMA
        $totalAnggota = Member::count();
        $belumCetak = Member::where('status_cetak', false)->count();
        $totalLahan = Member::sum('luasan_lahan');

        // 2. KEUANGAN (Pendaftaran + Simpanan)
        // Hitung uang pendaftaran dari anggota yg sudah upload bukti bayar
        $uangPendaftaran = Member::whereNotNull('file_bukti_bayar')->count() * 150000;
        // Hitung total simpanan/iuran dari tabel savings
        $uangSimpanan = Saving::sum('jumlah');

        $totalUang = $uangPendaftaran + $uangSimpanan;

        // 3. STATISTIK STATUS (BARU)
        $statusCounts = [
            'active' => Member::where('status', 'active')->count(),
            'inactive' => Member::where('status', 'inactive')->count(),
            'stopped' => Member::where('status', 'stopped')->count(),
            'pending' => Member::where('status', 'pending')->count(),
        ];

        // 4. CHART DATA (Sebaran Dusun)
        $dusunStats = Member::select('dusun', DB::raw('count(*) as total'))
            ->groupBy('dusun')
            ->pluck('total', 'dusun');

        $labels = $dusunStats->keys();
        $data = $dusunStats->values();

        return view('dashboard', compact(
            'totalAnggota',
            'belumCetak',
            'totalLahan',
            'totalUang',
            'labels',
            'data',
            'statusCounts' // Kirim variable baru ini
        ));
    }
}
