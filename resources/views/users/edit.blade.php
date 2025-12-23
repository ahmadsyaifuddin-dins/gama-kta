<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('users._form', ['submit_text' => 'Update User'])
        </form>
    </div>
</x-app-layout>
