<div>
	<div x-data='{modalAdd:false}' class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	    <div class="bg-white overflow-hidden px-6 py-2 sm:rounded-lg text-right">
	        <button @click='modalAdd = true' class="px-3 py-1 rounded bg-blue-600 text-white">Adicionar</button>
	    </div>
        <div x-show='modalAdd'  class="absolute bg-black bg-opacity-50 left-0 right-0 top-0 bottom-0 p-20" style="display: none;">
            <div x-show.transition='modalAdd' @='modalAdd = false'  class="bg-white rounded shadow-2xl w-6/12 mx-auto" >
                <div class="px-6 py-3 border-b border-gray-200 flex justify-end">
                    <button @click='modalAdd = false' >Fechar</button>
                </div>
                <div class="px-10 py-4 ">
                    <div class="text-3xl py-4 border-b border-gray-200 mb-4">
                        Adicionar usuário
                    </div>
                    <div class="mb-4 space-y-6" >
                    	<div class="flex flex-col">
                    		<label for="" class="font-bold">Nome</label>
                    		@error('user.name') <span class="text-red-600 text-sm">{{$message}}</span>@enderror
                    		<input type="text" wire:model='user.name'  class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue text-gray-700" placeholder="Nome">
                    	</div>
                    	<div class="flex flex-col">
                    		<label for="" class="font-bold">E-mail</label>
                    		@error('user.email') <span class="text-red-600 text-sm">{{$message}}</span>@enderror
                    		<input type="text" wire:model='user.email'  class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue text-gray-700" placeholder="E-mail">
                    	</div>
                    	<div class="py-4 flex justify-between">
                    		<span>{{$status}}</span>
                    		<button wire:click='addUser' class="px-3 py-1 rounded text-white bg-blue-600">
                    			<span wire:loading wire:target='addUser'>Salvando...</span>
                    			<span wire:loading.remove wire:target='addUser'>Salvar</span>
                    		</button>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
