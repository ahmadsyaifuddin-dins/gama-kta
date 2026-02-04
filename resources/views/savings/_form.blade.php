@props(['saving' => null])

<div class="grid grid-cols-1 gap-6">

    <div>
        <label class="block text-sm font-medium text-gray-700">Pilih Anggota</label>
        <select name="member_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            <option value="">-- Cari Nama Anggota --</option>
            @foreach ($members as $member)
                <option value="{{ $member->id }}"
                    {{ old('member_id', $saving->member_id ?? '') == $member->id ? 'selected' : '' }}>
                    {{ $member->nomor_anggota }} - {{ $member->nama_lengkap }}
                </option>
            @endforeach
        </select>
        @error('member_id')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis Simpanan</label>
        <div class="mt-2 flex gap-4">
            <label class="inline-flex items-center">
                <input type="radio" name="jenis_simpanan" value="pokok" class="text-pink-600 focus:ring-pink-500"
                    {{ old('jenis_simpanan', $saving->jenis_simpanan ?? '') == 'pokok' ? 'checked' : '' }}>
                <span class="ml-2">Pokok</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="jenis_simpanan" value="wajib" class="text-pink-600 focus:ring-pink-500"
                    {{ old('jenis_simpanan', $saving->jenis_simpanan ?? 'wajib') == 'wajib' ? 'checked' : '' }}>
                <span class="ml-2">Wajib</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="jenis_simpanan" value="sukarela" class="text-pink-600 focus:ring-pink-500"
                    {{ old('jenis_simpanan', $saving->jenis_simpanan ?? '') == 'sukarela' ? 'checked' : '' }}>
                <span class="ml-2">Sukarela</span>
            </label>
        </div>
        @error('jenis_simpanan')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
            <input type="number" name="jumlah" value="{{ old('jumlah', $saving->jumlah ?? '') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                placeholder="Contoh: 50000">
            @error('jumlah')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar"
                value="{{ old('tanggal_bayar', isset($saving) ? $saving->tanggal_bayar->format('Y-m-d') : date('Y-m-d')) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
            @error('tanggal_bayar')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
        <input type="text" name="keterangan" value="{{ old('keterangan', $saving->keterangan ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
            placeholder="Contoh: Iuran Bulan Januari 2025">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Bukti Transfer (Jika Ada)</label>
        @if (isset($saving) && $saving->bukti_transfer)
            <div class="mb-2">
                <a href="{{ asset('storage/' . $saving->bukti_transfer) }}" target="_blank"
                    class="text-blue-600 text-sm underline">Lihat File Saat Ini</a>
            </div>
        @endif
        <input type="file" name="bukti_transfer"
            class="mt-1 block w-full text-sm border border-gray-300 rounded-md p-1">
        @error('bukti_transfer')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t">
        <a href="{{ route('savings.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
        <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700">Simpan
            Transaksi</button>
    </div>

</div>
