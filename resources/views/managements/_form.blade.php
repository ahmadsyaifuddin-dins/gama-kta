@props(['management' => null])

<div class="grid grid-cols-1 gap-6">

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama" value="{{ old('nama', $management->nama ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
            required>
        @error('nama')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
        <select name="jabatan"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            <option value="">-- Pilih Jabatan --</option>
            @foreach (['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Pengawas', 'Anggota'] as $jbt)
                <option value="{{ $jbt }}"
                    {{ old('jabatan', $management->jabatan ?? '') == $jbt ? 'selected' : '' }}>{{ $jbt }}
                </option>
            @endforeach
        </select>
        @error('jabatan')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <x-forms.numeric-input name="no_hp" label="Nomor HP" mode="hp" placeholder="Contoh: 08123456789"
        :value="$management->no_hp ?? ''" />

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Mulai Menjabat</label>
            <input type="number" name="periode_mulai"
                value="{{ old('periode_mulai', $management->periode_mulai ?? date('Y')) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                placeholder="Tahun (2024)">
            @error('periode_mulai')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Selesai Menjabat</label>
            <input type="number" name="periode_selesai"
                value="{{ old('periode_selesai', $management->periode_selesai ?? date('Y') + 5) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                placeholder="Tahun (2029)">
            @error('periode_selesai')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-2 mt-2">
        <input type="checkbox" name="is_active" value="1" id="is_active"
            class="rounded border-gray-300 text-pink-600 shadow-sm focus:border-pink-300 focus:ring focus:ring-pink-200 focus:ring-opacity-50"
            {{ old('is_active', $management->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="text-sm text-gray-700 font-medium">Status Masih Aktif Menjabat</label>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Foto Profil (Opsional)</label>
        @if (isset($management) && $management->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $management->foto) }}"
                    class="h-20 w-20 rounded-full object-cover border">
            </div>
        @endif
        <input type="file" name="foto" class="mt-1 block w-full text-sm border border-gray-300 rounded-md p-1">
        <span class="text-xs text-gray-500">Max 2MB (JPG/PNG)</span>
        @error('foto')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t mt-4">
        <a href="{{ route('managements.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
        <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700">Simpan
            Data</button>
    </div>

</div>
