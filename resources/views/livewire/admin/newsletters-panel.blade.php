<div>
	<div x-data='{importModal:false}' class="bg-white px-3 py-2 rounded mb-10 flex space-x-4 justify-end">
		<button class="flex items-center space-x-2 justify-between border border-gray-400 text-gray-700 px-3 py-1 rounded" wire:click='exportTable'> 
			<span>Exportar </span>
			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
		</button>
		<button class="flex items-center space-x-2 justify-between bg-blue-600 text-white px-3 py-1 rounded" @click='importModal = true'> 
			<span>Importar </span>
			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
		</button>
		<div x-show='importModal' class="fixed bg-black bg-opacity-50 z-10 left-0 right-0 top-0 bottom-0 p-20" style="display: none;">
            <div x-show.transition='importModal' @='importModal = false'  class="bg-white rounded shadow-2xl w-6/12 mx-auto" >
                <div class="px-6 py-3 border-b border-gray-200 flex justify-end">
                    <button @click='importModal = false' >Fechar</button>
                </div>
                <div class="p-10 ">
                    <div class="flex flex-col space-y-6">
                    	<label for="base" class="font-bold">Base</label>
                    	<input type="file" wire:model='importBase'>
                    	@if( $importBase ) 
                    		<div class="text-right">
                    			<button wire:click='checkBase' class="bg-blue-600 text-white px-2 py-1 rounded">Checar</button> 
                    		</div>
                		@endif
                		<div wire:loading wire:target='importBase' class="text-right">
            				<span> Subindo a base...</span>
            			</div>
                    	@if( $numbers )
                    		<div class="w-full flex">
                    			<table class="w-full">
                    				<tr>
                    					<td colspan="2" class="border-b-2 border-gray-500"> Dados da Base </td>
                    				</tr>
                    				@foreach($numbers['professions'] as $profession=>$qtdy)
                    					<tr>
                    						<td class="border-b border-gray-300 bg-gray-100 font-bold px-3 py-1">{{ $profession ?? 'Não especificado'}}</td>
                    						<td class="border-b border-gray-300 text-right px-3 py-1">{{$qtdy}}</td>
                    					</tr>
                    				@endforeach
                    			</table>
                    		</div>
                    		<div class="text-right">
                    			<button wire:click='saveBase' @click='importModal = false' class="bg-blue-600 text-white px-2 py-1 rounded">Salvar</button>
                    		</div>
                    	@endif
                    </div>
                </div>
            </div>
        </div>
	</div>
	<div class="space-y-4">
		<div class="flex justify-between">
			<div class="">
		        <input wire:model='search' type="text" placeholder="Pesquisar" class="bg-transparent px-3 py-2">
		        @if( $search ) <button wire:click='$set("search",null)'>Limpar</button> @endif
		    </div>
		    <div class="flex justify-between items-center space-x-4">
				<span> Ordenar Por:</span>
				<button wire:click='sortOf("name")' class="flex @if( $sortField == 'name') bg-gray-600 text-white @endif justify-between items-center px-3 rounded  py-1 active:outline-none focus:outline-none">
				    <span>Nome</span>
				    @if( $sortDirection == 'asc' && $sortField == 'name')
				        <svg class='w-3 h-3' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
				    @else
				        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
				    @endif
				</button>
				<button wire:click='sortOf("created_at")' class="flex @if( $sortField == 'created_at') bg-gray-600 text-white @endif justify-between items-center px-3 rounded  py-1 active:outline-none focus:outline-none">
				    <span>Criado em</span>
				    @if( $sortDirection == 'asc' && $sortField == 'created_at')
				        <svg class='w-3 h-3' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
				    @else
				        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
				    @endif
				</button>
				<button wire:click='sortOf("profession")' class="flex @if( $sortField == 'profession') bg-gray-600 text-white @endif justify-between items-center px-3 rounded  py-1 active:outline-none focus:outline-none">
				    <span>Profissão</span>
				    @if( $sortDirection == 'asc' && $sortField == 'profession')
				        <svg class='w-3 h-3' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
				    @else
				        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
				    @endif
				</button>
		    </div>
		</div>
	    @foreach( $newsletters as $newsletter )
	        <div class="bg-white px-3 py-2 flex items-center">
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$newsletter->name}}</p>
	        	</div>
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$newsletter->email}}</p>
	        	</div>
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$newsletter->whatsapp}}</p>
	        	</div>
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$newsletter->dateDisplay}}</p>
	        	</div>
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$newsletter->profession}}</p>
	        	</div>
	            <div x-data='{options:false,modal:false}' class="flex justify-between">
	                <button @cick='modal = true' class="bg-blue-600 text-white px-2 rounded text-sm">Editar</button>
	                <div x-show='modal' class="absolute bg-black bg-opacity-50 left-0 right-0 top-0 bottom-0 p-20" style="display: none;">
	                    <div x-show.transition='modal' @='modal = false'  class="bg-white rounded shadow-2xl w-6/12 mx-auto" >
	                        <div class="px-6 py-3 border-b border-gray-200 flex justify-end">
	                            <button @click='modal = false' >Fechar</button>
	                        </div>
	                        <div class="p-10 ">
	                            
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    @endforeach
	</div>
    <div class="py-4">
    	{{$newsletters->links()}}
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
</div>
