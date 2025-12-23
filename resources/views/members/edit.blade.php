<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Anggota') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') @include('members._form', ['submit_text' => 'Update Data'])

        </form>
    </div>
</x-app-layout>
