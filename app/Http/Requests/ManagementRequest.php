<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'nullable|numeric|digits_between:10,15',
            'foto' => 'nullable|image|max:2048', // Max 2MB
            'periode_mulai' => 'required|digits:4|integer|min:2000',
            'periode_selesai' => 'required|digits:4|integer|gte:periode_mulai', // Harus >= tahun mulai
            'is_active' => 'boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama Pengurus',
            'jabatan' => 'Jabatan',
            'no_hp' => 'Nomor HP',
            'foto' => 'Foto Profil',
            'periode_mulai' => 'Tahun Mulai Menjabat',
            'periode_selesai' => 'Tahun Selesai Menjabat',
            'is_active' => 'Status Aktif',
        ];
    }
}
