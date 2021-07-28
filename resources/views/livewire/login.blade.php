<div>
    <form wire:submit.prevent='login' class="p-8 bg-gray-50">
    	<div class="text-xl mb-10">
    		Já sou cadastrado
			<div class="border-b-2 border-actionblue w-20"></div>
    	</div>	

		<div class="space-y-6 mb-20">
			<div class="flex flex-col">
				<label for="email" class="font-bold">E-mail</label>
				<input id='email' wire:model='user.email' type="email" class="px-3 py-2" placeholder="email@email.com">
				@error( 'user.email' ) <span class='text-sm text-red-600'>{{$message}}</span> @enderror
			</div>
			<div class="flex flex-col">
				<label for="password" class="font-bold">Senha</label>
				<input id='password' wire:model='user.password' type="password" class="px-3 py-2" placeholder="********">
				@error( 'user.password' ) 
					<span class='text-sm text-red-600'>{{$message}}</span> 
				@enderror
			</div>
			<div class="text-right">
				<button wire:click='login' class="bg-actionblue px-3 py-1 rounded text-white">Logar</button>
			</div>
		</div>
	</form>
</div>
