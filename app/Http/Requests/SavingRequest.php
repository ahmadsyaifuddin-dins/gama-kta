<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id' => 'required|exists:members,id', // Harus anggota yang terdaftar
            'jenis_simpanan' => 'required|in:pokok,wajib,sukarela',
            'jumlah' => 'required|numeric|min:1000',
            'tanggal_bayar' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'bukti_transfer' => 'nullable|image|max:2048', // Opsional, max 2MB
        ];
    }

    public function attributes(): array
    {
        return [
            'member_id' => 'Nama Anggota',
            'jenis_simpanan' => 'Jenis Simpanan',
            'jumlah' => 'Jumlah Bayar',
            'tanggal_bayar' => 'Tanggal Pembayaran',
            'bukti_transfer' => 'Bukti Transfer',
        ];
    }

    // Tambahkan messages() bahasa indonesia kalau mau (opsional, copy dari MemberRequest)
}
