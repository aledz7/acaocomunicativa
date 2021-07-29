<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('description') - Ação Comunicativa">
        <title> @yield('title') {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/css/sharetastic.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300&display=swap" rel="stylesheet">

        @yield('styles')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans  antialiased">
        <div class="content">
        	<header class="sticky top-0 bg-white z-10">
                @if( auth()->user() )
                    <div class="bg-actionblue text-white py-1">
                        <div class="max-w-6xl mx-auto text-right text-sm">
                            {{auth()->user()->name }} 
                            @if( auth()->user()->role_id == 0 ) - <a href='{{route("admin.dashboard")}}'>Painel Administrativo</a>  @endif -
                            <a href='#' onclick="$(this).next().submit()"> Sair </a>
                            <form action="{{route('logout')}}" method="POST"  class="hidden">@csrf</form>
                        </div>
                    </div>
                @endif
                <div class="bg-actionblue text-white py-3">
                    <div class="mx-auto max-w-6xl text-white flex justify-between text-sm">
                        <div class="flex">
                            <div class="pr-4 border-r border-white font-bold">
                                Verba Saúde
                            </div>
                            <div class="pl-4">
                                Cidade de São Paulo recebeu R$ 1.453.234,00 em verbas públicas
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <div> Social Media</div>
                            <div class="flex">
                                <div class="px-3 border-r border-l"> Login </div>
                                <div class="px-3 border-r"> Assinar </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-b-2">
            		<div class="flex justify-between items-center py-2 mx-auto max-w-6xl ">
            			<div class="text-2xl">
            				Ação Comunicativa
            			</div>
            			<div>
                            <nav x-data="{menu:false}" class="text-right xs:hidden ">
                                <button @click='menu = true' class="px-6 py-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>  
                                <ul x-show.transition='menu' @click.away='menu = false' class="absolute text-left text-2xl right-0 bg-white  shadow-2xl w-full  divide divide-y text-sm divide-gray-200 border-b border-gray-200" style="display: none;">
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('noticias')}}">Notícias</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('videos')}}">Vídeos</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('boletims')}}">Boletim AC Saúde</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('newsletter')}}">Newsletter</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('quemSomos')}}">Quem Somos</a>
                                    </li>
                                </ul>
                            </nav>
                            <nav class="flex justify-between relative overflow-hidden w-0 h-0 xs:w-full xs:h-auto max-w-6xl mx-auto text-sm">
                                <ul class="flex flex-1 uppercase items-center font-bold  w-full">
                                    <li class="px-3 py-6 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('home')}}">Home</a>
                                       </li>
                                    <li class="px-3 py-6 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('noticias')}}">Notícias</a>
                                       </li>
                                    <li class="px-3 py-6 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('videos')}}">Vídeos</a>
                                       </li>
                                    <li class="px-3 py-6 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('boletims')}}">Boletim AC Saúde</a>
                                       </li>
                                    <li class="px-3 py-6 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('newsletter')}}">Newsletter</a>
                                       </li>
                                    <li class="px-3 py-6 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('quemSomos')}}">Quem Somos</a>
                                       </li>
                                </ul>
                               <ul class="flex uppercase items-center font-bold  ">
                                   @livewire('search-bar',key('desk'))
                               </ul>
                            </nav>         
                        </div>
            		</div>
                </div>
        	</header>
                
            @yield('content')

    		<footer class=" text-gray-400 bg-actionblue">
    			<div class="h-80 py-20 text-center " style="background: #f4f7f6">
    				<div>
    					<div class="text-black font-bold mb-6 text-center">
                            AÇÃO COM VOCÊ
                            <span class="w-20 block border-b-2 border-blue-800 mx-auto mt-2"></span>
                        </div>
                        <p class="text-gray-600">+55 (61) 99132-6324</p>
                        <p class="text-gray-600">+55 (61) 3253-5422</p>
                        <p class="text-gray-600"> 
                            <a href='mailto:contato@acaocomunicativa.com.br' class="text-blue-900">contato@acaocomunicativa.com.br</a>
                        </p>
                        <p class="text-gray-600 mt-4"> 
                            SHIS QI 09 Bloco A sala 107 Lago Sul – Brasília – DF CEP: 71.625-171
                        </p>
    				</div>
    			</div>
                <div>
                    <nav class="  flex justify-center bg-actionblue py-10">
                        <ul class="text-center xs:flex uppercase text-white font-bold divide divide-x divide-gray-300">
                            <li class="px-3  text-white">
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('noticias')}}">Notícias</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('videos')}}">Vídeos</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('boletims')}}">Boletim AC Saúde</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('newsletter')}}">Newsletter</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('quemSomos')}}">Quem Somos</a>
                            </li>
                        </ul>
                    </nav>
                </div>
    			<div class="text-white border-t border-gray-200 border-opacity-10 p-5  flex justify-center text-xs bg-black bg-opacity-30">
    				Copyright - {{ config('app.name') }} - {{ date('Y') }}
    			</div>
    		</footer>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
        <script src="/js/jquery.mask.js"></script>
        <script>
            var SPMaskBehavior = function (val) {
              return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
              onKeyPress: function(val, e, field, options) {
                  field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

            $('.phone_with_ddd').mask(SPMaskBehavior, spOptions);
        </script>
        @livewireScripts
        @yield('scripts')
    </body>
</html>
