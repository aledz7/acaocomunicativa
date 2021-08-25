@extends('layouts.website')

@section('content')
<div class="pt-8 max-w-6xl mx-auto px-8 lg:px-4">
    <div class="mx-auto  px-8 mb-8 lg:px-0">
		<div class=" max-w-6xl text-3xl font-semibold mb-2 text-left mx-auto">
			Newsletter
			<div class="w-40 h-1 bg-gradient-to-br from-actionblue to-red-700"></div>
		</div>
	</div>
    <div>
    	<p class="w-8/12 pt-10 pb-5 mx-auto text-gray-600 text-center">Cadastre-se para receber, toda semana, em seu e-mail, nossas notícias sobre os destaques do setor da saúde</p>
    </div>
	@if( session('success') )
		<div class="bg-green-200 max-w-lg py-3 rounded font-bold mx-auto text-green-500 text-center "> CADASTRO EFETUADO COM SUCESSO! </div>
	@endif
	@if( session('warning') )
		<div class="bg-yellow-200 max-w-lg py-3 rounded font-bold mx-auto text-yellow-500 text-center "> Hmmm, algo deu errado... Verificou se o reCAPTCHA estava marcado? </div>
	@endif
    <div>
	    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<form action="{{ route('cadastre.store') }}" method="post" onsubmit="$('#submitButton').text('Enviando...')">
			@csrf
			<div class="w-6/12 mx-auto">
				<div class="my-6">
					<label for="" class="font-bold">Nome:</label>
					<input type="text" name="name" class="w-full" required="required" placeholder="Nome Completo">
				</div>
				<div class="my-6">
					<label for="" class="font-bold">E-mail:</label>
					<input type="text" name="email" class="w-full" required="required" placeholder="email@email.com.br">
				</div>
				<div class="my-6">
					<label for="" class="font-bold">WhatsApp:</label>
					<input type="text" name="whatsapp" class="w-full phone_with_ddd" required="required" placeholder="(00) 0000-0000">
				</div>
				<div class="my-6">
					<label for="" class="font-bold">Setor de atuação</label>
					<select name="profession" id="" class="w-full border border-gray-300 p-2">
						<option>Político</option>
						<option>Saúde</option>
						<option>Outros</option>
					</select>
				</div>
				<div class="py-4 text-center">
					<div class="g-recaptcha flex justify-around" data-callback='verified' data-sitekey="6Le8LSMcAAAAAOrkGe-VhjXBKFXIhWNn3H-L9NA_"></div>
					<script>
						function verified()
						{
							$('#submitButton').show();
						}
					</script>
					<div>
						<button id='submitButton' class="bg-blue-600 px-2 text-white rounded py-1 hidden mt-6">
							Cadastrar
						</button>
					</div>
				</div>
			</div>
		</form>
    </div>	
</div>
@endsection