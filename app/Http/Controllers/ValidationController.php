<?php

namespace App\Http\Controllers;

use App\Models\Member;

class ValidationController extends Controller
{
    public function check($id)
    {
        // Cari anggota, kalau gak ketemu tampilkan 404
        $member = Member::findOrFail($id);

        return view('validation.result', compact('member'));
    }
}
