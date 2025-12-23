<!DOCTYPE html>
<html>

<head>
    <title>Kwitansi - {{ $member->nomor_anggota }}</title>
    <style>
        /* Mengatur Margin Halaman PDF jadi 0 */
        @page {
            margin: 0;
            size: A5 landscape;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 5mm;
        }

        .receipt-container {
            border: 3px double #000;
            padding: 10px;
            width: 95%;
            height: 130mm;
            /* Tinggi fix agar tidak terpotong */
            position: relative;
            box-sizing: border-box;
        }

        /* --- HEADER --- */
        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
            display: table;
        }

        .header-left {
            display: table-cell;
            width: 15%;
            vertical-align: middle;
            text-align: left;
        }

        .header-center {
            display: table-cell;
            width: 65%;
            text-align: center;
            vertical-align: middle;
        }

        .header-center h1 {
            margin: 0;
            font-size: 24px;
            font-family: 'Times New Roman', serif;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .header-right {
            display: table-cell;
            width: 20%;
            text-align: right;
            vertical-align: bottom;
            font-weight: bold;
            font-size: 11px;
        }

        /* --- KONTEN --- */
        .content {
            margin-top: 5px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content td {
            padding: 6px 2px;
            vertical-align: top;
        }

        .label {
            width: 110px;
            font-weight: bold;
            font-style: italic;
        }

        .separator {
            width: 15px;
            text-align: center;
        }

        .input-box {
            border: 1px solid #000;
            padding: 5px 10px;
            border-radius: 5px;
            min-height: 18px;
        }

        .payment-desc-box {
            border: 1px solid #000;
            padding: 8px 10px;
            border-radius: 5px;
            height: 50px;
            vertical-align: top;
        }

        /* --- FOOTER --- */
        .footer {
            position: absolute;
            bottom: 15px;
            left: 10px;
            right: 10px;
            height: 40px;
        }

        .amount-container {
            position: absolute;
            left: 0;
            bottom: 0;
            border: 2px solid #000;
            padding: 8px 15px;
            font-weight: bold;
            font-size: 16px;
            background-color: #e5e7eb;
            border-radius: 8px;
            border-bottom-right-radius: 20px;
        }

        .signature-container {
            position: absolute;
            right: 0;
            bottom: 0;
            text-align: right;
            width: 200px;
        }

        .signature-space {
            height: 50px;
        }
    </style>
</head>

<body>
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="receipt-container">

        <div class="header">
            <div class="header-left">
                <img src="{{ public_path('logo/kud-logo.jpg') }}" style="width: 70px; height: auto;">
            </div>
            <div class="header-center">
                <h1>KWITANSI</h1>
            </div>
            <div class="header-right">
                No. {{ str_pad($member->id, 3, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <div class="content">
            <table>
                <tr>
                    <td class="label">Sudah terima dari</td>
                    <td class="separator">:</td>
                    <td>
                        <div class="input-box">
                            <b>{{ $member->nama_lengkap }}</b> - {{ $member->dusun }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">Uang Sebesar</td>
                    <td class="separator">:</td>
                    <td>
                        <div class="input-box" style="font-style: italic; font-weight: bold;">
                            Seratus Lima Puluh Ribu Rupiah
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">Untuk Pembayaran</td>
                    <td class="separator">:</td>
                    <td>
                        <div class="payment-desc-box">
                            Pembayaran Administrasi Pendaftaran Anggota Baru & Cetak Kartu Anggota (KTA) KUD Gajah Mada.
                            <br>
                            <b>Status: LUNAS</b>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">

            <div class="amount-container">
                Rp. {{ number_format($member->biaya_pendaftaran, 0, ',', '.') }},-
            </div>

            <div class="signature-container">
                <p style="margin: 0; font-size: 11px;">
                    Kotabaru,
                    {{ $member->tanggal_bayar ? $member->tanggal_bayar->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}
                </p>

                <div class="signature-space"></div>
                <p style="margin: 0; font-weight: bold; text-decoration: underline;">Bendahara KUD</p>
            </div>
        </div>

    </div>
</body>

</html>
