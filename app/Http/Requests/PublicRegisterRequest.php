<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicRegisterRequest extends FormRequest
{
    /**
     * Izinkan semua orang mengakses request ini.
     */
    public function authorize(): bool
    {
        return true; // Ubah dari false ke true
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:members,nik', // NIK harus angka & 16 digit
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'dusun' => 'required|string',
            'luasan_lahan' => 'required|numeric|min:0.1',
            'foto' => 'required|image|max:2048', // Max 2MB
            'file_ktp' => 'required|image|max:2048',
            'file_kk' => 'required|image|max:2048',
            'file_sertifikat_tanah' => 'required|image|max:2048',
        ];
    }

    /**
     * Pesan Error Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'numeric' => ':attribute harus berupa angka.',
            'date' => ':attribute format tanggal tidak valid.',
            'image' => ':attribute harus berupa file gambar (jpg, jpeg, png).',
            'max' => 'Ukuran :attribute maksimal 2MB.',
            'unique' => ':attribute sudah terdaftar di sistem kami.',
            'digits' => ':attribute harus berjumlah :digits digit.',
            'in' => 'Pilihan :attribute tidak valid.',
            'min' => ':attribute minimal :min.',
        ];
    }

    /**
     * Ubah nama atribut biar lebih manusiawi saat muncul error.
     */
    public function attributes(): array
    {
        return [
            'nama_lengkap' => 'Nama Lengkap',
            'nik' => 'NIK',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat_lengkap' => 'Alamat',
            'no_hp' => 'Nomor HP / WhatsApp',
            'dusun' => 'Dusun',
            'luasan_lahan' => 'Luas Lahan',
            'foto' => 'Pas Foto',
            'file_ktp' => 'Foto KTP',
            'file_kk' => 'Foto KK',
            'file_sertifikat_tanah' => 'Foto Sertifikat Tanah',
        ];
    }
}
