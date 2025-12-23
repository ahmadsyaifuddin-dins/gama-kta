<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard KUD Gajah Mada') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border border-gray-200">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
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

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border border-gray-200">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Pemasukan</p>
                    <p class="text-lg font-semibold text-gray-700">Rp {{ number_format($totalUang, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border border-gray-200">
                <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Belum Cetak KTA</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $belumCetak }} Anggota</p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border border-gray-200">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Lahan Sawit</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalLahan }} Hektar</p>
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
                <p class="text-gray-600">
                    Selamat datang di Sistem Informasi KUD Gajah Mada.
                    <br><br>
                    Gunakan menu di sebelah kiri untuk mengelola data anggota, mencetak kartu, dan mengunduh laporan.
                    <br><br>
                    <strong>Status Sistem:</strong> <span class="text-green-600 font-bold">Online & Aman</span>
                </p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dusunChart').getContext('2d');
        const dusunChart = new Chart(ctx, {
            type: 'pie', // Bisa diganti 'bar', 'line', dll
            data: {
                labels: {!! json_encode($labels) !!}, // Data dari Controller
                datasets: [{
                    label: 'Jumlah Anggota',
                    data: {!! json_encode($data) !!}, // Data dari Controller
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });
    </script>
</x-app-layout>
