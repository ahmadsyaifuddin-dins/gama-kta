<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePinjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Siapkan dan bersihkan data sebelum divalidasi.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('jumlah_pinjaman')) {
            $this->merge([
                // Membersihkan format mata uang sebelum divalidasi sebagai numerik
                'jumlah_pinjaman' => str_replace(['Rp', '.', ' '], '', $this->jumlah_pinjaman),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'member_id' => 'required|exists:members,id',
            'tanggal_pengajuan' => 'required|date',
            'jumlah_pinjaman' => 'required|numeric|min:10000',
            'lama_angsuran' => 'required|integer|min:1',
            'keperluan' => 'required|string|max:255',
            
            // Aturan 'status' dihapus karena field pada UI form bersifat disabled 
            // dan perubahannya sudah di-handle oleh UpdateStatusPinjamanRequest
        ];
    }
}