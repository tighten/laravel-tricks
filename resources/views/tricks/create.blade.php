<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Trick') }}
        </h2>
    </x-slot>

    <x-container>
        <x-form method="POST" action="{{ route('tricks.store') }}">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-form.textarea id="description" class="block mt-1 w-full" name="description" :value="old('description')" required />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="code" :value="__('Code')" />
                <x-form.textarea id="code" class="block mt-1 w-full" name="code" :value="old('code')" required />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Create Trick') }}
                </x-primary-button>
            </div>
        </x-form>
    </x-container>
</x-app-layout>
