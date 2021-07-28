<div class="p-8">
    <form wire:submit.prevent='register'>
    	<div class="text-xl mb-4">
    		Cadastrar-se
			<div class="border-b-2 border-actionblue w-20"></div>
    	</div>	
    	<div class="mb-4">
    		Realizando seu cadastro você terá acesso a todos os Boletins AC Saúde e também receberá as novas edições, ás segundas-feiras, em seu e-mail.
    	</div>
		<div class="space-y-6 mb-20">
			<div class="flex flex-col">
				<label for="name" class="font-bold">Nome</label>
				<input id='name' wire:model='name' type="text" class="" placeholder="Nome">
				@error( 'name' ) <span class='text-sm text-red-600'>{{$message}}</span> @enderror
			</div>
			<div class="flex flex-col">
				<label for="email" class="font-bold">E-mail</label>
				<input id='email' wire:model='email' type="email" class="" placeholder="email@email.com">
				@error( 'email' ) <span class='text-sm text-red-600'>{{$message}}</span> @enderror
			</div>
			<div class="flex flex-col">
				<label for="whatsapp" class="font-bold">Whatsapp</label>
				<input id='whatsapp' wire:model='whatsapp' type="whatsapp" class="phone_with_ddd" placeholder="(xx) XXXX-XXXX">
				@error( 'whatsapp' ) <span class='text-sm text-red-600'>{{$message}}</span> @enderror
			</div>
			<div class="flex flex-col">
				<label for="" class="font-bold">Setor de atuação</label>
				<select name="profession" id="" class="w-full border border-gray-300 p-2">
					<option>Político</option>
					<option>Saúde</option>
					<option>Outros</option>
				</select>
			</div>
			<div class="flex flex-col">
				<label for="password" class="font-bold">Senha</label>
				<input id='password' wire:model='password' type="password" class="" placeholder="********">
				@error( 'password' ) 
					<span class='text-sm text-red-600'>{{$message}}</span> 
				@enderror
				<div class="flex flex-col bg-gray-50 p-1 my-2">
					<span class='@if( @$check["min"] ) text-green-700 font-bold @else text-gray-500 @endif'>Mínimo 8 caracteres</span>
					<span class='@if( @$check["uppercase"] ) text-green-700 font-bold @else text-gray-500 @endif'>Maiúscula</span>
					<span class='@if( @$check["lowercase"] ) text-green-700 font-bold @else text-gray-500 @endif'>Minúscula</span>
					<span class='@if( @$check["number"] ) text-green-700 font-bold @else text-gray-500 @endif'>Número</span>
				</div>

			</div>
			<div class="flex flex-col">
				<label for="password_confirmation" class="font-bold">Confirmação de Senha</label>
				<input id='password_confirmation' wire:model='password_confirmation' type="password" class="" placeholder="********">
				@error( 'password_confirmation' ) <span class='text-sm text-red-600'>{{$message}}</span> @enderror
			</div>
			<div class="text-right">
				<span class="text-sm text-red-600">{{$alert}}</span>
				<button wire:click='register' class="bg-actionblue px-3 py-1 rounded text-white">
					<span wire:loading.remove wire:target='register'>Cadastrar</span>
					<span wire:loading wire:target='register'>Aguarde...</span>
				</button>
			</div>
		</div>
	</form>
</div>
