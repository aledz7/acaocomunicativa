<div>
	<div class="bg-gray-100 px-3 py-2 text-right flex justify-between">
	    <a href='{{route("admin.boletims")}}'><button type='button' class="bg-white  rounded px-2 py-1">Voltar</button></a>
	    <button wire:click='save' class="bg-blue-600 text-white rounded px-2 py-1" wire:load.class='disabled'>
	    	<span wire:loading.remove wire:target='save'>Salvar</span>
	    	<span wire:loading wire:target='save'>Salvando...</span>
	    </button>
	</div>
	<div class="flex py-4 grid grid-cols-2 gap-10 mb-10">
        <div class="flex justify-center items-center cursor-pointer" onclick="getElementById('cover').click()">
            <input wire:model='cover' name="cover" type="file" id='cover' class="hidden" >
            <div>
                <span wire:loading wire:target='cover'> <img src="/img/loading.gif" alt=""> </span>
            </div>
            @if( $cover )
                <div class="text-center">
                    @error('cover') 
                    @else
                        <img wire:loading.remove wire:target='cover' src="{{$cover->temporaryUrl()}}" alt="" class="w-100">
                    @enderror
                </div>
            @else
                <div class="cursor-pointer hover:bg-gray-50 flex w-full  justify-center items-center"> 
                    <span wire:loading.remove wire:target='cover'>Seleciona a capa</span>
                </div>
            @endif
        	@error('cover') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
        </div>
		<input wire:model='cover' name="cover" type="file" id='cover' class="hidden">
	    <div class="space-y-5">
	        <div>
	            <input type="text" wire:model.defer='title'  placeholder="Titulo"  class="w-full text-base text-3xl">
	            @error('title') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
	        </div>
	        <div>
	            <input type="file" wire:model.defer='file' class="flex-1 w-full">
	            @error('file') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
	        </div>
	        <div>
	            <input type="date" wire:model.defer='date' value="{{date('Y-m-d')}}" placeholder="Chamada" class="w-full">
	            @error('date') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
	        </div>
	        <div>
	            <textarea wire:model.defer='short_text' class="w-full focus:outline-none border h-24 border-gray-300 p-2" placeholder="Chamada do Boletim"></textarea>
	            @error('short_text') <span class="text-red-600 text-sm">{{$message}}</span> @enderror
	        </div>
	    </div>
	</div>

</div>
