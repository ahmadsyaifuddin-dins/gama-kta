<div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
    @if ($errors->any())
        <div class="sm:col-span-2 p-4 mb-2 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <p class="font-bold mb-1">Terjadi kesalahan input:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label class="block text-sm text-gray-700">Nomor Anggota</label>
        <input type="text" name="nomor_anggota" value="{{ old('nomor_anggota', $member->nomor_anggota ?? '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
            placeholder="Contoh: KUD-GM-0001" required>
        @error('nomor_anggota')
            <span class="text-xs text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-700">NIK (16 Digit)</label>
        <input type="number" name="nik" value="{{ old('nik', $member->nik ?? '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
            required>
        @error('nik')
            <span class="text-xs text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $member->nama_lengkap ?? '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
            required>
    </div>

    <div>
        <label class="block text-sm text-gray-700">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $member->tempat_lahir ?? '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
            required>
    </div>

    <div>
        <label class="block text-sm text-gray-700">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir"
            value="{{ old('tanggal_lahir', isset($member) ? $member->tanggal_lahir->format('Y-m-d') : '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
            required>
    </div>

    <div>
        <label class="block text-sm text-gray-700">Jenis Kelamin</label>
        <select name="jenis_kelamin"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
            <option value="L" {{ old('jenis_kelamin', $member->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                Laki-laki</option>
            <option value="P" {{ old('jenis_kelamin', $member->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                Perempuan</option>
        </select>
    </div>

    <div>
        <label class="block text-sm text-gray-700">Pekerjaan</label>
        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $member->pekerjaan ?? '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
    </div>

    <div>
        <label class="block text-sm text-gray-700">Luasan Lahan Sawit (Hektar)</label>
        <div class="relative mt-1">
            <input type="number" step="0.01" name="luasan_lahan"
                value="{{ old('luasan_lahan', $member->luasan_lahan ?? '') }}"
                class="block w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple pr-10"
                placeholder="Contoh: 2.5" required>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <span class="text-gray-500 sm:text-sm">Ha</span>
            </div>
        </div>
        @error('luasan_lahan')
            <span class="text-xs text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm text-gray-700">Alamat Lengkap (Jalan/RT/RW)</label>
        <textarea name="alamat_lengkap"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
            rows="3">{{ old('alamat_lengkap', $member->alamat_lengkap ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm text-gray-700">Dusun</label>
        <input type="text" name="dusun" value="{{ old('dusun', $member->dusun ?? '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
            placeholder="Nama Dusun" required>
    </div>

    <div>
        <label class="block text-sm text-gray-700">Desa</label>
        <input type="text" name="desa" value="Telaga Sari" readonly
            class="block w-full mt-1 text-sm bg-gray-100 border-gray-300 rounded-md shadow-sm cursor-not-allowed">
    </div>

    <div>
        <label class="block text-sm text-gray-700">No HP / WA</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $member->no_hp ?? '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
    </div>

    <div>
        <label class="block text-sm text-gray-700">Tanggal Bergabung</label>
        <input type="date" name="tanggal_bergabung"
            value="{{ old('tanggal_bergabung', isset($member) ? $member->tanggal_bergabung->format('Y-m-d') : date('Y-m-d')) }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm text-gray-700">Pas Foto (Format: JPG/PNG, Max 2MB)</label>

        @if (isset($member) && $member->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $member->foto) }}" alt="Foto Lama"
                    class="w-20 h-24 object-cover rounded border">
                <span class="text-xs text-gray-500">Foto saat ini</span>
            </div>
        @endif

        <input type="file" name="foto"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
        @error('foto')
            <span class="text-xs text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div class="sm:col-span-2">
    </div>
</div>
<hr class="my-8 border-gray-300">
<h3 class="text-lg font-semibold text-gray-700 mb-4">Berkas Persyaratan (Lampiran)</h3>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-3">

    <div>
        <label class="block text-sm font-bold text-gray-700">Scan Sertifikat Tanah (Wajib)</label>
        @if (isset($member) && $member->file_sertifikat_tanah)
            <div class="mb-2 text-xs">
                <a href="{{ asset('storage/' . $member->file_sertifikat_tanah) }}" target="_blank"
                    class="text-blue-600 underline hover:text-blue-800">
                    Lihat File Saat Ini
                </a>
            </div>
        @endif
        <input type="file" name="file_sertifikat_tanah"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
        <span class="text-xs text-gray-500">PDF/JPG (Max 2MB)</span>
        @error('file_sertifikat_tanah')
            <span class="text-xs text-red-600 block">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-700">Scan KTP</label>
        @if (isset($member) && $member->file_ktp)
            <div class="mb-2 text-xs">
                <a href="{{ asset('storage/' . $member->file_ktp) }}" target="_blank"
                    class="text-blue-600 underline hover:text-blue-800">
                    Lihat File Saat Ini
                </a>
            </div>
        @endif
        <input type="file" name="file_ktp"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-700">Scan KK</label>
        @if (isset($member) && $member->file_kk)
            <div class="mb-2 text-xs">
                <a href="{{ asset('storage/' . $member->file_kk) }}" target="_blank"
                    class="text-blue-600 underline hover:text-blue-800">
                    Lihat File Saat Ini
                </a>
            </div>
        @endif
        <input type="file" name="file_kk"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-purple-400 focus:outline-none text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
    </div>

</div>

<hr class="my-8 border-gray-300">
<h3 class="text-lg font-semibold text-gray-700 mb-4">Pembayaran Administrasi (Rp 150.000)</h3>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label class="block text-sm font-bold text-gray-700">Bukti Transfer / Kwitansi Manual</label>

        @if (isset($member) && $member->file_bukti_bayar)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $member->file_bukti_bayar) }}" class="h-24 rounded border">
                <span class="text-xs text-green-600 font-bold">✔ Sudah Ada Bukti</span>
            </div>
        @endif

        <input type="file" name="file_bukti_bayar" class="block w-full mt-1 text-sm border-gray-300">
        <span class="text-xs text-gray-500">Foto Struk / Screenshot Transfer</span>
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-700">Tanggal Bayar</label>
        <input type="date" name="tanggal_bayar"
            value="{{ old('tanggal_bayar', isset($member->tanggal_bayar) ? $member->tanggal_bayar->format('Y-m-d') : '') }}"
            class="block w-full mt-1 text-sm border-gray-300 rounded-md">
    </div>
</div>

</div>

<div class="flex justify-end mt-6">
    <button type="submit"
        class="px-5 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        {{ $submit_text ?? 'Simpan Data' }}
    </button>
</div>
