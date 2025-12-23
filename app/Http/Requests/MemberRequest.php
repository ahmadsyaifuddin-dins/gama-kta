<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Cek apakah ini proses update (ada ID) atau create
        $memberId = $this->route('member') ? $this->route('member')->id : null;

        return [
            'nomor_anggota' => 'required|string|unique:members,nomor_anggota,'.$memberId,
            'nik' => 'required|numeric|digits:16|unique:members,nik,'.$memberId,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'dusun' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
            'pekerjaan' => 'nullable|string',
            'luasan_lahan' => 'required|numeric|min:0.1',
            'file_sertifikat_tanah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'tanggal_bergabung' => 'required|date',
            'file_bukti_bayar' => 'nullable|image|max:2048', // Bukti harus gambar
            'tanggal_bayar' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ];
    }
}
