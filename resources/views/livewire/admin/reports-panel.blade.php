<div>
    <div class="space-y-4">
        <div class="mb-6 bg-white rounded px-3 py-3 text-right">
            <button wire:click='addReport' class="bg-blue-600 px-3 py-1 rounded text-white">Adicionar</button>
        </div>
        <div class="flex justify-between">
            <div class="">
                <input wire:model='search' type="text" placeholder="Pesquisar" class="bg-transparent px-3 py-2">
                @if( $search ) <button wire:click='$set("search",null)'>Limpar</button> @endif
            </div>
            <div class="flex justify-between items-center space-x-4">
                <span> Ordenar Por:</span>
                <button wire:click='sortOf("title")' class="flex @if( $sortField == 'title') bg-gray-600 text-white @endif justify-between items-center px-3 rounded  py-1 active:outline-none focus:outline-none">
                    <span>Título</span>
                    @if( $sortDirection == 'asc' && $sortField == 'title')
                        <svg class='w-3 h-3' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                    @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    @endif
                </button>
                <button wire:click='sortOf("date")' class="flex @if( $sortField == 'date') bg-gray-600 text-white @endif justify-between items-center px-3 rounded  py-1 active:outline-none focus:outline-none">
                    <span>Data</span>
                    @if( $sortDirection == 'asc' && $sortField == 'date')
                        <svg class='w-3 h-3' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                    @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    @endif
                </button>
            </div>
        </div>
        <div class="">
            @foreach( $reports as $report )
                <div class="bg-white px-3 py-2 flex mb-4 items-center">
                    <div class="pr-6">
                        @if( $report->cover )
                            <img src="{{asset('/storage/'.$report->cover)}}" alt="" class="w-12">
                        @else
                            <img src="{{asset('/img/no-image.png')}}" alt="" class="w-12">
                        @endif
                    </div>
                    <div class="flex-1 flex flex-col text-sm">
                        {{$report->title}}
                        <span class="text-gray-400 italic text-xs">
                            {{$report->date_display}}
                        </span>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <span class="font-bold text-sm">Categorias:</span>
                    </div>
                    <div class="flex justify-between">
                        <div class="space-x-2 flex">
                            <a href="{{ route('reports') }}" target="_blank">Ver no site </a>
                            <button wire:click="editReport({{$report->id}})" class="bg-blue-600 text-white px-2 rounded text-sm">Editar</button>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
    <div class="py-4">
        {{$reports->links()}}
    </div>
    <div class="my-10 bg-white rounded px-3 py-2">
        <div x-data='{removeConfirm:false}'>
            <button x-show='removeConfirm == false' @click='removeConfirm = true'>Remover Todas</button>
            <div x-show='removeConfirm' @click.away='removeConfirm = false'>
                <button  @click='removeConfirm = false'>Epa, pera! Caaalma...</button>
                <button  wire:click='removeAll' class="bg-red-600 text-white px-3 py-1 rounded">Remover, mesmo!</button>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model='modalAdd'>
        <x-slot name='title'>Adicionar Informativo </x-slot>
        <x-slot name='content'>
            <div class="p-2 space-y-6">
                <div>
                    <div class="font-bold italic text-xs mb-2">Título</div>
                    <input wire:model='newReportTitle' type="text" class="input w-full" placeholder="Título">
                    @error( 'newReportTitle' ) {{ $message }} @enderror
                </div>
                <div>
                    <div class="font-bold italic text-xs mb-2">Data</div>
                    <input wire:model='newReportDate' type="date" class="input w-full" placeholder="Título">
                    @error( 'newReportDate' ) {{ $message }} @enderror
                </div>
                <div>
                    <div class="font-bold italic text-xs mb-2">Arquivo</div>
                    <input wire:model='newReportFile' type="file" class="input w-full" placeholder="Título">
                    @error( 'newReportFile' ) {{ $message }} @enderror
                </div>
                <div>
                    <div class="font-bold italic text-xs mb-2">Capa</div>
                    <input wire:model='newReportCover' type="file" class="input w-full" placeholder="Título">
                    @error( 'newReportCover' ) {{ $message }} @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <span wire:loading> Carregando... </span>
            <x-jet-button wire:loading.remove wire:click='saveReport'>Adicionar</x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model='modalEdit'>
        <x-slot name='title'>Editar Informativo </x-slot>
        <x-slot name='content'>
            @if( $reportEdit )
                <div class="p-2 space-y-6">
                    <div>
                        <div class="font-bold italic text-xs mb-2">Título</div>
                        <input wire:model='reportEdit.title' type="text" class="input w-full" />
                    </div>
                    <div>
                        <div class="font-bold italic text-xs mb-2">Data</div>
                        <input wire:model='reportEdit.date' type="date" class="input w-full" />
                    </div>
                    <div>
                        <div class="font-bold italic text-xs mb-2">Arquivo</div>
                        <input wire:model='reportEdit.file' type="file" class="input w-full" />
                    </div>
                    <div>
                        <div class="font-bold italic text-xs mb-2">Capa</div>
                        <input wire:model='reportEdit.cover' type="file" class="input w-full" />
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot name='footer'>
            @if( $reportEdit )
            <div class="flex justify-between">
                <x-jet-button wire:click='removeReport'>Rmover</x-jet-button>
                <x-jet-button wire:click='updateReport'>Atualizar</x-jet-button>
            </div>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
