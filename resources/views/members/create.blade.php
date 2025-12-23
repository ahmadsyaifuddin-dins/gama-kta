<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Anggota Baru') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('members._form')

        </form>
    </div>
</x-app-layout>
