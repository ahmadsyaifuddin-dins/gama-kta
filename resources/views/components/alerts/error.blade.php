@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm']) }}
        role="alert">
        <div class="flex">
            <div class="py-1">
                <svg class="w-6 h-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="font-bold">Terjadi Kesalahan!</p>
                <p class="text-sm">Mohon periksa kembali isian formulir di bawah ini.</p>
            </div>
        </div>
    </div>
@endif
