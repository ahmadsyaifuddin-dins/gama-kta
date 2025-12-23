<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row {
            background-color: #ffffcc;
            font-weight: bold;
        }
    </style>
</head>

<body>

    @include('reports._header', [
        'title' => 'LAPORAN KEUANGAN & PEMBAYARAN',
        'subtitle' =>
            'Periode: ' .
            \Carbon\Carbon::parse($request->start_date)->translatedFormat('d F Y') .
            ' s/d ' .
            \Carbon\Carbon::parse($request->end_date)->translatedFormat('d F Y'),
    ])

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal Bayar</th>
                <th width="20%">No. Anggota</th>
                <th width="30%">Nama Anggota</th>
                <th width="15%">Metode</th>
                <th width="15%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $index => $m)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $m->tanggal_bayar->translatedFormat('d/m/Y') }}</td>
                    <td>{{ $m->nomor_anggota }}</td>
                    <td>{{ $m->nama_lengkap }}</td>
                    <td class="text-center">Tunai/TF</td>
                    <td class="text-right">Rp {{ number_format($m->biaya_pendaftaran, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right">TOTAL PEMASUKAN</td>
                <td class="text-right">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @include('reports._signature', ['role' => 'Bendahara KUD'])

</body>

</html>
