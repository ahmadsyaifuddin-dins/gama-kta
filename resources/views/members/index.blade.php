<x-app-layout>
    <x-slot name="header">
        {{ __('Data Anggota KUD') }}
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-700">Daftar Anggota</h2>
                <p class="text-sm text-gray-500">Kelola data anggota, verifikasi pendaftaran, dan cetak kartu.</p>
            </div>

            <a href="{{ route('members.create') }}"
                class="flex items-center px-5 py-2.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-pink-600 border border-transparent rounded-lg active:bg-pink-600 hover:bg-pink-700 focus:outline-none focus:shadow-outline-pink shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Anggota
            </a>
        </div>

        <x-alerts.success class="mb-6" />
        <x-alerts.error class="mb-6" />

        <div class="w-full overflow-hidden rounded-xl shadow-xs bg-white border border-gray-200">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-100">
                            <th class="px-4 py-4 text-center w-12">No</th>
                            <th class="px-4 py-4">Nama / NIK</th>
                            <th class="px-4 py-4">Alamat / Dusun</th>
                            <th class="px-4 py-4 text-center">Status Akun</th>
                            <th class="px-4 py-4 text-center">Pembayaran</th>
                            <th class="px-4 py-4 text-center">Status Cetak</th>
                            <th class="px-4 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($members as $index => $member)
                            <tr class="text-gray-700 hover:bg-gray-50 transition duration-150">

                                <td class="px-4 py-3 text-sm text-center">
                                    {{ $members->firstItem() + $index }}
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-10 h-10 mr-3 rounded-full md:block">
                                            <img class="object-cover w-full h-full rounded-full border border-gray-200"
                                                src="{{ $member->foto ? asset('storage/' . $member->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($member->nama_lengkap) . '&background=random' }}"
                                                alt="" loading="lazy" />
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $member->nama_lengkap }}</p>
                                            <p class="text-xs text-gray-500">{{ $member->nik }}</p>
                                            <p class="text-[10px] text-gray-400">Gabung:
                                                {{ $member->tanggal_bergabung->translatedFormat('d M Y') }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    <p class="truncate w-48 font-medium">{{ Str::limit($member->alamat_lengkap, 30) }}
                                    </p>
                                    <p class="text-xs text-gray-500 bg-gray-100 inline-block px-2 py-0.5 rounded mt-1">
                                        {{ $member->dusun }}</p>
                                </td>

                                <td class="px-4 py-3 text-xs text-center">
                                    @if ($member->status == 'pending')
                                        {{-- STATUS PENDING (VERIFIKASI) --}}
                                        <div class="flex flex-col items-center gap-2">
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full animate-pulse border border-orange-200">
                                                VERIFIKASI
                                            </span>

                                            <form action="{{ route('members.approve', $member->id) }}" method="POST"
                                                onsubmit="return confirm('Verifikasi anggota ini? Nomor anggota akan digenerate ulang.');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="flex items-center px-3 py-1.5 text-[10px] font-bold text-white bg-blue-600 rounded hover:bg-blue-700 shadow transition">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    SETUJUI
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($member->status == 'active')
                                        {{-- STATUS AKTIF --}}
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full border border-green-200">
                                            AKTIF
                                        </span>
                                    @elseif ($member->status == 'inactive')
                                        {{-- STATUS PASIF --}}
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full border border-yellow-200">
                                            PASIF
                                        </span>
                                    @elseif ($member->status == 'stopped')
                                        {{-- STATUS BERHENTI --}}
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full border border-red-200">
                                            BERHENTI
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-xs text-center">
                                    @if ($member->file_bukti_bayar)
                                        <span
                                            class="px-2 py-1 font-bold leading-tight text-green-700 bg-green-100 rounded-full">
                                            LUNAS
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-bold leading-tight text-red-700 bg-red-100 rounded-full">
                                            BELUM
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-xs text-center">
                                    @if ($member->status_cetak)
                                        <span
                                            class="inline-block px-2 py-1 font-bold text-blue-700 bg-blue-100 rounded-full whitespace-nowrap">
                                            Sudah Dicetak
                                        </span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 font-bold text-gray-600 bg-gray-200 rounded-full whitespace-nowrap">
                                            Belum Dicetak
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-sm text-center">
                                    <div class="flex items-center justify-center space-x-2">

                                        @if ($member->file_bukti_bayar)
                                            <a href="{{ route('members.print_card', $member->id) }}" target="_blank"
                                                class="p-2 text-white bg-green-500 rounded-lg hover:bg-green-600 shadow-sm transition"
                                                title="Cetak Kartu Anggota">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                            </a>

                                            <a href="{{ route('members.print_receipt', $member->id) }}" target="_blank"
                                                class="p-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 shadow-sm transition"
                                                title="Cetak Kwitansi">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        @else
                                            <button
                                                onclick="alert('Anggota ini belum melakukan pembayaran! Silakan upload bukti bayar di menu Edit.')"
                                                class="p-2 text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed"
                                                title="Belum Bayar">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </button>
                                        @endif

                                        <a href="{{ route('members.edit', $member->id) }}"
                                            class="p-2 text-white bg-purple-500 rounded-lg hover:bg-purple-600 shadow-sm transition"
                                            title="Edit Data">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-white bg-red-500 rounded-lg hover:bg-red-600 shadow-sm transition"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500 bg-gray-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-lg">Belum ada data anggota.</span>
                                        <p class="text-sm mt-1">Silakan tambah anggota baru atau tunggu pendaftaran
                                            online.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-3 border-t bg-gray-50">
                {{ $members->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
