<div>
	@if( auth()->user()->super_admin == 1 )
		@livewire('admin.user-add')
	@endif
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
		
	    <div class="bg-white overflow-hidden px-10 py-4 sm:rounded-lg">
	        <div class="py-4">
	            <div class="">
	                <input wire:model='search' type="text" placeholder="Pesquisar" class="bg-transparent px-3 py-2">
	                @if( @$search ) <button wire:click='$set("search",null)'>Limpar</button> @endif
	            </div>
	        </div>
	        <div x-data='{modalEdit:false,removeConfirm:false}'>
	            <div class="grid grid-cols-4  px-3 py-2border-b border-gray-400 font-bold" >
	                <div>Nome</div>
	                <div>E-mail</div>
	                <div class="text-center">Tipo</div>
	                <div class="text-right">Opções</div>
	            </div>
	            @if( count($users) > 0 )
		            @foreach( $users as $key=>$user )
		                <div class="grid grid-cols-4 @if( ($key % 2) == 0 ) bg-gray-50 @endif px-3 py-2 hover:bg-gray-100">
		                    <div>
		                        {{$user->name}}
		                    </div>
		                    <div>
		                        {{$user->email}}
		                    </div>
		                    <div class="text-center">
		                        {{$user->statusName}}
		                    </div>
		                    <div @click='modalEdit = true' wire:click='edit({{$user->id}})' class="text-right">
		                    	@if( auth()->user()->super_admin == 1 )
		                        	<button>Editar</button>
		                        @endif
		                    </div>
		                </div>
		            @endforeach
		        @else
		        	<div>
		        		<div class="text-center text-gray-600 py-4 bg-gray-100"> Não encontrado com: {{$search}}</div>
		        	</div>
		        @endif

		        <div x-show='modalEdit'  class="absolute bg-black bg-opacity-50 left-0 right-0 top-0 bottom-0 p-20" style="display: none;">
	                <div x-show.transition='modalEdit' @='modalEdit = false'  class="bg-white rounded shadow-2xl w-6/12 mx-auto" >
	                    <div class="px-6 py-3 border-b border-gray-200 flex justify-end">
	                        <button @click='modalEdit = false' >Fechar</button>
	                    </div>
	                    <div class="px-10 py-4 ">
	                    	@if( $editUser )
		                        <div class="text-3xl py-4 border-b border-gray-200 mb-4">
		                            Editar usuário
		                        </div>
		                        <div class="mb-4 space-y-6" >
		                        	<div class="flex flex-col">
		                        		<label for="" class="font-bold">Nome</label>
		                        		@error('editUser.name') <span class="text-red-600 text-sm">{{$message}}</span>@enderror
		                        		<input type="text" wire:model='editUser.name'  class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue text-gray-700" placeholder="Nome">
		                        	</div>
		                        	<div class="flex flex-col">
		                        		<label for="" class="font-bold">E-mail</label>
		                        		@error('editUser.email') <span class="text-red-600 text-sm">{{$message}}</span>@enderror
		                        		<input type="text" wire:model='editUser.email'  class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue text-gray-700" placeholder="E-mail">
		                        	</div>
		                        	<div class="py-4 flex justify-between">
		                        		<div class="bg-white rounded">
									    	<div x-data='{removeConfirm:false}'>
									    		<button x-show='removeConfirm == false' @click='removeConfirm = true' class="mr-4">
									    			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
									    		</button>
									    		<div x-show='removeConfirm' @click.away='removeConfirm = false'>
									    			<button  @click='removeConfirm = false'>Epa, pera! Caaalma...</button>
									    			<button   wire:click='removeUser' class="bg-red-600 text-white px-3 py-1 rounded">Remover, mesmo!</button>
									    		</div>
									    	</div>
									    </div>
									    <div>
			                        		<span>{{$status}}</span>
			                        		<button wire:click='updateUser' class="px-3 py-1 rounded text-white bg-blue-600">
			                        			<span wire:loading wire:target='updateUser'>Salvando...</span>
			                        			<span wire:loading.remove wire:target='updateUser'>Atualizar</span>
			                        		</button>
									    </div>
		                        	</div>
		                        </div>
		                    @endif
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
