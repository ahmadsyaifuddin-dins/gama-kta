@props([
    'name',
    'label',
    'value' => '',
    'mode' => 'nik', // Opsi: 'nik' atau 'hp'
    'required' => false,
    'placeholder' => '',
])

@php
    // Tentukan Max Length berdasarkan mode
    $maxLength = $mode === 'nik' ? 16 : 15;

    // Tentukan Label tambahan jika HP
    $hint = $mode === 'hp' ? '(WhatsApp Aktif)' : '';
@endphp

<div class="w-full">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }} <span class="text-xs text-gray-500 font-normal">{{ $hint }}</span>
    </label>

    <input type="text" inputmode="numeric" name="{{ $name }}" id="{{ $name }}"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" maxlength="{{ $maxLength }}"
        {{ $required ? 'required' : '' }} {{-- LOGIC JS: Hanya angka & Batasi Length --}}
        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, {{ $maxLength }})"
        class="mt-1 block w-full rounded-md shadow-sm border p-2 text-sm
               focus:ring-pink-500 focus:border-pink-500 
               @error($name) border-red-500 focus:border-red-500 focus:ring-red-500 @else border-gray-300 @enderror">

    {{-- Error Message Otomatis --}}
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
