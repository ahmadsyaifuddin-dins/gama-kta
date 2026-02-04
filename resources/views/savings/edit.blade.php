<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Transaksi') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('savings.update', $saving->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('savings._form', ['saving' => $saving])
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
