<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard KUD Gajah Mada') }}
    </x-slot>

    <div class="p-6 bg-gray-50 rounded-lg">

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border-l-4 border-pink-500">
                <div class="p-3 mr-4 text-pink-500 bg-pink-100 rounded-full">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Anggota</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalAnggota }} Orang</p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border-l-4 border-green-500">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Kas Masuk</p>
                    <p class="text-lg font-semibold text-gray-700">Rp {{ number_format($totalUang, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-gray-400">Pendaftaran + Iuran</p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border-l-4 border-orange-500">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Belum Cetak KTA</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $belumCetak }} Anggota</p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border-l-4 border-blue-500">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Lahan Sawit</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalLahan }} Ha</p>
                </div>
            </div>
        </div>

        <h3 class="mb-4 text-lg font-semibold text-gray-700">Statistik Status Anggota</h3>
        <div class="grid gap-6 mb-8 md:grid-cols-4">

            <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-xs border border-green-200">
                <div class="flex items-center">
                    <div class="p-2 mr-3 text-green-600 bg-green-100 rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500">Anggota Aktif</p>
                        <p class="text-lg font-bold text-gray-700">{{ $statusCounts['active'] }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-xs border border-yellow-200">
                <div class="flex items-center">
                    <div class="p-2 mr-3 text-yellow-600 bg-yellow-100 rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500">Pasif / Cuti</p>
                        <p class="text-lg font-bold text-gray-700">{{ $statusCounts['inactive'] }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-xs border border-red-200">
                <div class="flex items-center">
                    <div class="p-2 mr-3 text-red-600 bg-red-100 rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500">Berhenti / Keluar</p>
                        <p class="text-lg font-bold text-gray-700">{{ $statusCounts['stopped'] }}</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-xs border border-orange-200">
                <div class="flex items-center">
                    <div class="p-2 mr-3 text-orange-600 bg-orange-100 rounded-full animate-pulse">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500">Menunggu Verifikasi</p>
                        <p class="text-lg font-bold text-gray-700">{{ $statusCounts['pending'] }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs border border-gray-200">
                <h4 class="mb-4 font-semibold text-gray-800">
                    Sebaran Anggota per Dusun
                </h4>
                <canvas id="dusunChart"></canvas>
            </div>

            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs border border-gray-200">
                <h4 class="mb-4 font-semibold text-gray-800">
                    Informasi Sistem
                </h4>
                <p class="text-gray-600 text-sm">
                    Selamat datang di Sistem Informasi KUD Gajah Mada.
                    <br><br>
                    <strong>Update Terkini:</strong>
                <ul class="list-disc list-inside mt-2 text-gray-500 text-sm">
                    <li>Fitur Pendaftaran Online Aktif.</li>
                    <li>Modul Iuran & Simpanan Aktif.</li>
                    <li>Data Pengurus & Manajemen Aktif.</li>
                    <li>Validasi QR Code KTA Berjalan.</li>
                </ul>
                <br>
                <div
                    class="p-3 bg-green-50 text-green-700 rounded border border-green-200 text-center font-bold text-sm">
                    Server Online & Aman
                </div>
                </p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dusunChart').getContext('2d');
        const dusunChart = new Chart(ctx, {
            type: 'doughnut', // Ganti jadi doughnut biar lebih modern dari pie biasa
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Jumlah Anggota',
                    data: {!! json_encode($data) !!},
                    backgroundColor: [
                        '#ec4899', // Pink-500
                        '#3b82f6', // Blue-500
                        '#f59e0b', // Yellow-500
                        '#10b981', // Green-500
                        '#8b5cf6', // Purple-500
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>
