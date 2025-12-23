<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MemberExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    protected $filter;

    // Kita terima data filter dari Controller
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function collection()
    {
        $query = Member::query();

        // 1. LOGIKA KEUANGAN
        if (isset($this->filter['report_type']) && $this->filter['report_type'] == 'finance') {
            $query->whereNotNull('file_bukti_bayar');

            if (isset($this->filter['start_date']) && isset($this->filter['end_date'])) {
                $query->whereBetween('tanggal_bayar', [$this->filter['start_date'], $this->filter['end_date']]);
            }
        }
        // 2. LOGIKA UMUM
        else {
            if (isset($this->filter['start_date']) && isset($this->filter['end_date'])) {
                $query->whereBetween('tanggal_bergabung', [$this->filter['start_date'], $this->filter['end_date']]);
            }

            if (isset($this->filter['dusun']) && $this->filter['dusun'] != 'semua') {
                $query->where('dusun', $this->filter['dusun']);
            }

            if (isset($this->filter['status_cetak']) && $this->filter['status_cetak'] != 'semua') {
                $status = $this->filter['status_cetak'] == 'sudah' ? 1 : 0;
                $query->where('status_cetak', $status);
            }
        }

        return $query->get();
    }

    // Judul Kolom di Excel
    public function headings(): array
    {
        return [
            'No Anggota',
            'NIK',
            'Nama Lengkap',
            'Dusun',
            'Luas Lahan (Ha)',
            'Tanggal Gabung',
            'Status Pembayaran',
            'Status Cetak Kartu',
        ];
    }

    // Data yang dimasukkan ke baris Excel
    public function map($member): array
    {
        return [
            $member->nomor_anggota,
            "'".$member->nik, // Tanda petik biar Excel baca sebagai teks (tidak jadi ilmiah 6.3E+15)
            $member->nama_lengkap,
            $member->dusun,
            $member->luasan_lahan,
            $member->tanggal_bergabung->format('d-m-Y'),
            $member->file_bukti_bayar ? 'LUNAS' : 'BELUM BAYAR',
            $member->status_cetak ? 'Sudah Dicetak' : 'Belum',
        ];
    }
}
