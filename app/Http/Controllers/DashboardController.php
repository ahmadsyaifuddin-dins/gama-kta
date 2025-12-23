<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Widget Statistik
        $totalAnggota = Member::count();

        // Hitung uang hanya dari yang sudah upload bukti bayar
        $totalUang = Member::whereNotNull('file_bukti_bayar')->sum('biaya_pendaftaran');

        // Hitung yang belum dicetak kartunya
        $belumCetak = Member::where('status_cetak', false)->count();

        // Hitung Total Luas Lahan (Opsional, buat keren-kerenan data)
        $totalLahan = Member::sum('luasan_lahan');

        // 2. Data Grafik (Group by Dusun)
        // Hasilnya: Dusun A => 10 orang, Dusun B => 5 orang
        $chartData = Member::select('dusun', DB::raw('count(*) as total'))
            ->groupBy('dusun')
            ->pluck('total', 'dusun')
            ->all();

        // Pisahkan Keys (Nama Dusun) dan Values (Jumlah) untuk ChartJS
        $labels = array_keys($chartData);
        $data = array_values($chartData);

        return view('dashboard', compact('totalAnggota', 'totalUang', 'belumCetak', 'totalLahan', 'labels', 'data'));
    }
}
