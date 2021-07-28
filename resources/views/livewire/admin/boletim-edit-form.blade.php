<div>
    <div class="bg-gray-100 px-3 py-2 text-right flex justify-between">
        <a href='{{route("admin.boletims")}}'><button type='button' class="bg-white  rounded px-2 py-1">Voltar</button></a>
        <button wire:click='save' class="bg-blue-600 text-white rounded px-2 py-1" wire:load.class='disabled'>
            <span wire:loading.remove wire:target='save'>Salvar</span>
            <span wire:loading wire:target='save'>Salvando...</span>
        </button>
    </div>
    <div class="flex py-4 grid grid-cols-2 gap-10 mb-10">
        <div class="flex grid grid-cols-1 text-center cursor-pointer"  onclick="getElementById('newCover').click()">
            <input wire:model='newCover' name="newCover" type="file" id='newCover' class="hidden">
            <span wire:loading wire:target='cover'> <img src="/img/loading.gif" alt=""> </span>
            @if( $newCover )
                <div class="text-center">
                    @error('newCover') 
                    @else
                        <img wire:loading.remove wire:target='cover' src="{{$newCover->temporaryUrl()}}" alt="" class="w-100">
                    @enderror
                </div>
            @elseif( $boletim->cover )
                <div class="text-center">
                    <img  wire:loading.remove wire:target='newCover' src="{{asset('/storage/'.$boletim->cover)}}" alt="" class="">
                </div>
            @else
                <div onclick='getElementById("newCover").click()' class="border-4 border-dashed border-gray-300 cursor-pointer hover:bg-gray-50 flex w-full  justify-center items-center"> 
                    <span wire:loading.remove wire:target='newCover'>Seleciona a capa</span>
                    <span wire:loading  wire:target='newCover' class="animate-bounce">Carregando</span>
                </div>
            @endif
            @error('newCover') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
        </div>
        <div class="space-y-5">
            <div>
                <input type="text" wire:model.defer='boletim.title'  placeholder="Titulo"  class="w-full text-base text-3xl">
                @error('boletim.title') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
            </div>
            <div class="flex space-x-4 ">
                <input type="file" wire:model.defer='newFile' class="flex-1">
                @if( $boletim->file)
                    <a href='{{$boletim->file}}' target='_blank'>
                        <button type="button" class="flex justify-between items-center space-x-2 border border-gray-400 px-2 rounded">
                            <span>Ver atual</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </a>
                @endif
                @error('boletim.file') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
            </div>
            <div>
                <input type="date" wire:model.defer='boletim.date' value="{{date('Y-m-d',strtotime($boletim->date))}}" placeholder="Chamada" class="w-full">
                @error('boletim.date') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
            </div>
            <div>
                <textarea wire:model.defer='boletim.short_text' class="w-full focus:outline-none border h-24 border-gray-300 p-2" placeholder="Chamada do Boletim"></textarea>
                @error('boletim.short_text') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
            </div>
        </div>
    </div>
</div>
