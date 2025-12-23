<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Anggota Baru - KUD GM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10 px-4">

    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden">
        <div class="bg-pink-700 py-6 px-8 text-center">
            <h2 class="text-2xl font-bold text-white">Formulir Pendaftaran Anggota Baru</h2>
            <p class="text-pink-100 text-sm mt-1">Silakan isi data dengan benar sesuai KTP & Sertifikat</p>
        </div>

        <x-alerts.error />

        <form action="{{ route('public.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div>
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">1. Data Pribadi</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 border p-2 @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-forms.numeric-input name="nik" label="NIK (Nomor KTP)" mode="nik" required="true"
                        placeholder="16 Digit Angka" />

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 border p-2 @error('tempat_lahir') border-red-500 @enderror">
                        @error('tempat_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 border p-2 @error('tanggal_lahir') border-red-500 @enderror">
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 border p-2 @error('jenis_kelamin') border-red-500 @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-forms.numeric-input name="no_hp" label="Nomor HP / WhatsApp" mode="hp" required="true"
                        placeholder="Contoh: 081234567890" />
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">2. Alamat & Lahan</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 border p-2 @error('alamat_lengkap') border-red-500 @enderror">{{ old('alamat_lengkap') }}</textarea>
                        @error('alamat_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dusun</label>
                            <select name="dusun"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 border p-2 @error('dusun') border-red-500 @enderror">
                                <option value="">-- Pilih Dusun --</option>
                                <option value="Dusun I" {{ old('dusun') == 'Dusun I' ? 'selected' : '' }}>Dusun I
                                </option>
                                <option value="Dusun II" {{ old('dusun') == 'Dusun II' ? 'selected' : '' }}>Dusun II
                                </option>
                                <option value="Dusun III" {{ old('dusun') == 'Dusun III' ? 'selected' : '' }}>Dusun III
                                </option>
                            </select>
                            @error('dusun')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Luas Lahan (Hektar)</label>
                            <input type="number" step="0.1" name="luasan_lahan" value="{{ old('luasan_lahan') }}"
                                placeholder="Contoh: 2.5"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 border p-2 @error('luasan_lahan') border-red-500 @enderror">
                            @error('luasan_lahan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">3. Upload Berkas (Wajib)</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pas Foto (Formal)</label>
                        <input type="file" name="foto"
                            class="mt-1 block w-full text-sm text-gray-500 border p-1 rounded @error('foto') border-red-500 @enderror">
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto KTP</label>
                        <input type="file" name="file_ktp"
                            class="mt-1 block w-full text-sm text-gray-500 border p-1 rounded @error('file_ktp') border-red-500 @enderror">
                        @error('file_ktp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto KK</label>
                        <input type="file" name="file_kk"
                            class="mt-1 block w-full text-sm text-gray-500 border p-1 rounded @error('file_kk') border-red-500 @enderror">
                        @error('file_kk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto Sertifikat Tanah</label>
                        <input type="file" name="file_sertifikat_tanah"
                            class="mt-1 block w-full text-sm text-gray-500 border p-1 rounded @error('file_sertifikat_tanah') border-red-500 @enderror">
                        @error('file_sertifikat_tanah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-between items-center">
                <a href="{{ route('landing') }}" class="text-gray-600 hover:underline">Kembali</a>
                <button type="submit"
                    class="px-6 py-3 bg-pink-700 text-white font-bold rounded-lg shadow hover:bg-pink-800 transition">
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>

</body>

</html>
