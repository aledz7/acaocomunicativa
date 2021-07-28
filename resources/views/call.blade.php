<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Destaques') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                @livewire('call-edit',['type'=>'news'])
                @livewire('call-edit',['type'=>'video'])
                @livewire('call-edit',['type'=>'boletim'])
            </div>
        </div>
    </div>
</x-app-layout>
