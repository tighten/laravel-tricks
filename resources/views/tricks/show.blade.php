<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $trick->name }}
        </h2>
    </x-slot>

    <x-container>
        <div class="space-y-8">
            <div>{{ $trick->description }}</div>
            <div>
                <pre>{{ $trick->code }}</pre>
            </div>
        </div>
    </x-container>
</x-app-layout>
