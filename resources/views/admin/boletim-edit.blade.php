<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editando Boletim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded space-y-5 p-6">
                @livewire('admin.boletim-edit-form',['boletim'=>$boletim])
            </div>
            <div class="bg-white rounded my-8 p-6">
                <iframe src="{{ asset('/storage/'.$boletim->file) }}" frameborder="0" class="w-full h-screen"></iframe>
            </div>
            <div x-data="{removeConfirm:false}" class="bg-white rounded px-3 py-2 mt-6">
                <button x-show='removeConfirm == false' @click='removeConfirm = true'>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                <div x-show='removeConfirm' class="space-x-4" style="display: none;">
                    <span>Deseja realmente remover esse boletim? </span>
                    <button @click='removeConfirm = false'>Cancelar</button>
                    <button class="bg-red-600 text-white px-2 py-1 rounded" onclick="getElementById('formDelete').submit()">Confirmar remoção</button>
                    <form id="formDelete" action="{{route('admin.boletims.delete',$boletim)}}" method="post">@csrf</form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
