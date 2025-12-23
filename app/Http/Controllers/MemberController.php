<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(MemberRequest $request)
    {
        $data = $request->validated();

        // 1. Upload Foto Profil
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('members-photos', 'public');
        }

        // 2. Upload Dokumen Persyaratan
        if ($request->hasFile('file_sertifikat_tanah')) {
            $data['file_sertifikat_tanah'] = $request->file('file_sertifikat_tanah')->store('members-docs', 'public');
        }
        if ($request->hasFile('file_ktp')) {
            $data['file_ktp'] = $request->file('file_ktp')->store('members-docs', 'public');
        }
        if ($request->hasFile('file_kk')) {
            $data['file_kk'] = $request->file('file_kk')->store('members-docs', 'public');
        }

        // 3. Upload Bukti Bayar (PERBAIKAN: Harus dicek dulu ada filenya atau tidak)
        if ($request->hasFile('file_bukti_bayar')) {
            $data['file_bukti_bayar'] = $request->file('file_bukti_bayar')->store('members-payments', 'public');

            // Otomatis set tanggal bayar hari ini jika user tidak isi manual
            if (empty($data['tanggal_bayar'])) {
                $data['tanggal_bayar'] = now();
            }
        }

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Anggota dan berkas berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        $data = $request->validated();

        // Helper array untuk file-file umum (Foto & Dokumen)
        $files = ['foto', 'file_sertifikat_tanah', 'file_ktp', 'file_kk'];

        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                // Hapus file lama jika ada
                if ($member->$fileKey) {
                    Storage::disk('public')->delete($member->$fileKey);
                }
                // Tentukan folder: foto ke 'members-photos', sisanya ke 'members-docs'
                $folder = ($fileKey == 'foto') ? 'members-photos' : 'members-docs';
                $data[$fileKey] = $request->file($fileKey)->store($folder, 'public');
            }
        }

        // PERBAIKAN: Handle Bukti Bayar secara terpisah agar aman
        if ($request->hasFile('file_bukti_bayar')) {
            // Hapus bukti bayar lama jika ada (Biar server gak penuh sampah)
            if ($member->file_bukti_bayar) {
                Storage::disk('public')->delete($member->file_bukti_bayar);
            }

            $data['file_bukti_bayar'] = $request->file('file_bukti_bayar')->store('members-payments', 'public');

            // Set tanggal bayar otomatis saat update bukti
            if (empty($data['tanggal_bayar'])) {
                $data['tanggal_bayar'] = now();
            }
        }

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        // Hapus semua file yang nyangkut (termasuk bukti bayar)
        $files = [
            $member->foto,
            $member->file_sertifikat_tanah,
            $member->file_ktp,
            $member->file_kk,
            $member->file_bukti_bayar, // Jangan lupa hapus ini juga
        ];

        foreach ($files as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus.');
    }

    public function printCard(Member $member)
    {
        $member->update([
            'status_cetak' => true,
            'tanggal_cetak' => now(),
        ]);

        $validationUrl = route('members.check', $member->id);

        // --- PERBAIKAN DISINI ---
        // 1. Pakai format('svg') biar gak butuh ImageMagick
        // 2. Bungkus pakai base64_encode biar jadi string gambar yang aman buat PDF
        $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($validationUrl));

        $pdf = Pdf::loadView('members.card_pdf', compact('member', 'qrCode'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('KTA-'.$member->nomor_anggota.'.pdf');
    }

    public function printReceipt(Member $member)
    {
        // Cek dulu, sudah bayar belum?
        if (! $member->file_bukti_bayar) {
            return back()->with('error', 'Anggota ini belum melakukan pembayaran!');
        }

        $pdf = Pdf::loadView('members.receipt_pdf', compact('member'));
        $pdf->setPaper('A5', 'landscape');

        return $pdf->stream('Kwitansi-'.$member->nomor_anggota.'.pdf');
    }
}
