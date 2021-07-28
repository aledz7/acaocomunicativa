@extends('layouts.website')

@section('content')
<div class="pt-8 max-w-6xl mx-auto px-8 lg:px-4">
    <div class="text-4xl text-center">
    	Acesso Restrito
		<div class="border-b-2 border-actionblue w-20 mx-auto"></div>
    </div>	
    
    <div class="mb-10">
    	<p class="w-8/12 pt-10 pb-5 mx-auto text-gray-600 text-center">
			Cadastre-se para receber nosso Boletim AC Saúde.
		</p>
    	<p class="w-8/12  pb-5 mx-auto text-gray-600 text-center">
			Toda semana um novo Boletim com as informações sobre os recursos liberados para a saúde pública.
    	</p>
    </div>

    <div>
    	<div class="grid grid-cols-2 gap-40 mb-20">
			@livewire('register')
			@livewire('login')
    	</div>
    </div>	
</div>
@endsection