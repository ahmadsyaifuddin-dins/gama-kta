<?php

namespace App\Http\Controllers;

use App\Exports\MemberExport;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $dusunList = Member::select('dusun')->distinct()->pluck('dusun');

        return view('reports.index', compact('dusunList'));
    }

    public function export(Request $request)
    {
        $filters = $this->getFilters($request);

        if ($request->action == 'excel') {
            return $this->downloadExcel($filters);
        } elseif ($request->action == 'pdf') {
            return $this->downloadPdf($request, $filters);
        }

        return back()->with('error', 'Format laporan tidak dikenali.');
    }

    private function getFilters(Request $request)
    {
        return [
            'report_type' => $request->report_type ?? 'general',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'dusun' => $request->dusun,
            'status_cetak' => $request->status_cetak,
        ];
    }

    private function getFilteredQuery(array $filters)
    {
        $query = Member::query();

        // LOGIKA KEUANGAN
        if ($filters['report_type'] == 'finance') {
            $query->whereNotNull('file_bukti_bayar');
            if ($filters['start_date'] && $filters['end_date']) {
                $query->whereBetween('tanggal_bayar', [$filters['start_date'], $filters['end_date']]);
            }
        }
        // LOGIKA UMUM (Anggota)
        else {
            if ($filters['start_date'] && $filters['end_date']) {
                $query->whereBetween('tanggal_bergabung', [$filters['start_date'], $filters['end_date']]);
            }
            if (! empty($filters['dusun']) && $filters['dusun'] != 'semua') {
                $query->where('dusun', $filters['dusun']);
            }
            if (! empty($filters['status_cetak']) && $filters['status_cetak'] != 'semua') {
                $status = $filters['status_cetak'] == 'sudah' ? 1 : 0;
                $query->where('status_cetak', $status);
            }
        }

        return $query;
    }

    private function downloadExcel(array $filters)
    {
        $prefix = ($filters['report_type'] == 'finance') ? 'Laporan-Keuangan-' : 'Laporan-Anggota-';
        $filename = $prefix.now()->format('Y-m-d').'.xlsx';

        return Excel::download(new MemberExport($filters), $filename);
    }

    /**
     * PRIVATE: Handle Download PDF dengan Judul Dinamis
     */
    private function downloadPdf(Request $request, array $filters)
    {
        $members = $this->getFilteredQuery($filters)->get();

        // A. JIKA LAPORAN KEUANGAN
        if ($filters['report_type'] == 'finance') {
            $data = [
                'members' => $members,
                'totalPemasukan' => $members->sum('biaya_pendaftaran'),
                'request' => $request,
            ];
            $pdf = Pdf::loadView('reports.finance_pdf', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->stream('Laporan-Keuangan.pdf');
        }

        // B. JIKA LAPORAN UMUM (ANGGOTA)
        else {
            // Default Judul (Untuk Kartu 1 - Laporan Seluruh Data)
            $title = 'Laporan Seluruh Anggota';
            $subtitle = 'Semua Data';

            // 1. CEK FILTER DUSUN (Prioritas)
            // Kita cek apakah ada input 'dusun' (baik itu 'semua' atau nama dusun)
            if (! empty($filters['dusun'])) {
                $title = 'Laporan Anggota Per Wilayah';

                if ($filters['dusun'] == 'semua') {
                    $subtitle = 'Semua Dusun';
                } else {
                    $subtitle = 'Dusun: '.$filters['dusun'];
                }
            }

            // 2. CEK FILTER STATUS CETAK
            elseif (! empty($filters['status_cetak'])) {
                $title = 'Laporan Status Pencetakan Kartu';

                if ($filters['status_cetak'] == 'semua') {
                    $subtitle = 'Semua Status';
                } else {
                    $status = ($filters['status_cetak'] == 'sudah') ? 'SUDAH DICETAK' : 'BELUM DICETAK';
                    $subtitle = "Status Kartu: $status";
                }
            }

            // 3. CEK FILTER PERIODE
            elseif (! empty($filters['start_date']) && ! empty($filters['end_date'])) {
                $title = 'Laporan Anggota Per Periode';
                $tglAwal = \Carbon\Carbon::parse($filters['start_date'])->translatedFormat('d F Y');
                $tglAkhir = \Carbon\Carbon::parse($filters['end_date'])->translatedFormat('d F Y');
                $subtitle = "Periode Gabung: $tglAwal s/d $tglAkhir";
            }

            // Generate PDF
            $pdf = Pdf::loadView('reports.pdf_view', compact('members', 'title', 'subtitle'));
            $pdf->setPaper('A4', 'landscape');

            return $pdf->stream('Laporan-Anggota.pdf');
        }
    }
}
