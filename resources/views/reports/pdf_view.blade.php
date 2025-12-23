<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .badge-success {
            color: green;
            font-weight: bold;
        }

        .badge-warning {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>

<body>

    @include('reports._header')

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">No Anggota</th>
                <th width="15%">NIK</th>
                <th width="20%">Nama Lengkap</th>
                <th width="15%">Dusun</th>
                <th width="10%">Lahan</th>
                <th width="10%">Gabung</th>
                <th width="10%">Cetak</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $index => $m)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $m->nomor_anggota }}</td>
                    <td>{{ $m->nik }}</td>
                    <td>{{ $m->nama_lengkap }}</td>
                    <td>{{ $m->dusun }}</td>
                    <td class="text-center">{{ $m->luasan_lahan }} Ha</td>
                    <td class="text-center">{{ $m->tanggal_bergabung->translatedFormat('d/m/Y') }}</td>
                    <td class="text-center">
                        {{ $m->status_cetak ? 'Sudah' : 'Belum' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @include('reports._signature', ['role' => 'Ketua KUD'])

</body>

</html>
