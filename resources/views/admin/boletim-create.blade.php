<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionando Boletim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded space-y-5 p-6">
                @livewire('admin.boletim-create-form')
            </div>
        </div>
    </div>
</x-app-layout>
