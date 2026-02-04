<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pengurus Baru') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('managements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('managements._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
