<div>
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
	    @foreach( $registereds as $registered )
	        <div class="bg-white px-3 py-2 flex items-center">
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$registered->name}}</p>
	        	</div>
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$registered->email}}</p>
	        	</div>
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$registered->dateDisplay}}</p>
	        	</div>
	        	<div class="flex-1">
        	        <p class="font-bold text-sm">{{$registered->profession}}</p>
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
    	{{$registereds->links()}}
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
