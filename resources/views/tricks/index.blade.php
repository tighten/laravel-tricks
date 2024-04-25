<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tricks') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @foreach ($tricks as $trick)
            <x-trick :$trick />
            @endforeach
        </div>
    </x-container>
</x-app-layout>
