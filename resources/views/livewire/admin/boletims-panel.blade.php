<div>
	<div class="space-y-4">
		<div class="mb-6 bg-white rounded px-3 py-3 text-right">
	        <a href="{{route('admin.boletims.create')}}" class="bg-blue-600 px-3 py-1 rounded text-white">
	            <button>Adicionar</button>
	        </a>
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
	    @foreach( $boletims as $boletim )
	        <div class="bg-white px-3 py-2 flex items-center">
	            <div class="pr-6">
	            	@if( $boletim->cover )
	                	<img src="{{asset('/storage/'.$boletim->cover)}}" alt="" class="w-12">
	                @else
	                	<img src="{{asset('/img/no-image.png')}}" alt="" class="w-12">
	                @endif
	            </div>
	            <div class="flex-1">
	                <a href="{{route('admin.boletims.edit',$boletim)}}" class="flex flex-col">
	                    <p class="font-bold text-sm">{{$boletim->title}} </p>
	                    <p class="text-xs text-gray-600">{{ substr($boletim->short_text,0,100)}}</p>
	                </a>
	            </div>
	            <div class="flex-1 flex flex-col text-center text-sm">
	            	{{$boletim->date_display}}
	            </div>
	            <div x-data='{options:false,modal:false}' class="flex justify-between">
	            	<div class="space-x-2 flex">
	                	<a href='{{route("boletim",$boletim->id)}}' target="_blank">Ver no site </a>
		                <a href="{{route('admin.boletims.edit',$boletim)}}" ><button class="bg-blue-600 text-white px-2 rounded text-sm">Editar</button></a>
		                <div class="relative" >
		                    <button @click='options = true'  class="px-2">...</button>
		                    <div x-show='options'  class="bg-white shadow-lg rounded border border-gray-100 absolute z-10 right-0 w-40">
		                        <ul>
		                            <li @click='modal = true,options = false' class="hover:bg-gray-100 cursor-pointer p-2">Enviar Mailing</li>
		                        </ul>
		                    </div>
		                </div>
	            	</div>
	                <div x-show='modal' class="absolute bg-black bg-opacity-50 left-0 right-0 top-0 bottom-0 p-20" style="display: none;">
	                    <div x-show.transition='modal' @='modal = false'  class="bg-white rounded shadow-2xl w-6/12 mx-auto" >
	                        <div class="px-6 py-3 border-b border-gray-200 flex justify-end">
	                            <button @click='modal = false' >Fechar</button>
	                        </div>
	                        <div class="p-10 ">
	                            <div class="text-3xl py-4">
	                                Enviar e-mail para os 
	                            </div>
	                            <div class="mb-4">
	                            	Selecionando os campos abaixo, a notícia será enviada para todos que pertencem a categoria.
	                            </div>
	                            <div>
	                            	@foreach( $boletimsLetterList as $key=>$profession )
		                                <div class="py-2 px-3 @if( ($key % 2) == 0 ) bg-gray-100 @endif ">
		                                    <input type="checkbox" wire:model='send_to' value='{{$profession}}' class="mt-0">
		                                    <span class="px-4">{{$profession}}</span>
		                                </div>
	                                @endforeach
	                            </div>
	                            <div class="flex justify-between py-2 px-3 mt-4 bg-gray-100 rounded">
	                            	<span> @if( $countSendTo )  Será enviado para: {{$countSendTo}} cadastrado(s)  @endif </span>
	                            	<div>
	                                	<button wire:loading wire:target='sendTo' class="bg-gray-300 px-2 py-1 rounded  disabled" >Enviando... </button>
	                                	<button wire:loading.remove wire:target='sendTo' class="bg-blue-600 px-2 py-1 rounded text-white" wire:click='sendTo({{$boletim->id}})'>Enviar</button>
	                            	</div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    @endforeach
	</div>
    <div class="py-4">
    	{{$boletims->links()}}
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
