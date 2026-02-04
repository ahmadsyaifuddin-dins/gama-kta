<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Pengurus') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('managements.update', $management->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('managements._form', ['management' => $management])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
