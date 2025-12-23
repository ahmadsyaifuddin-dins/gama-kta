<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah User Baru') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('users._form')
        </form>
    </div>
</x-app-layout>
