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

        @yield('styles')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
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
                <div class="shadow-md">
            		<div class="flex justify-between py-6 mx-auto max-w-6xl ">
            			<div class="px-6">
            				<img src="/logo-acao-comunicativa.png" class="w-40" alt="">
            			</div>
            			<div class="w-40 flex items-center"> 
                            <div class="rounded-full bg-black bg-opacity-70 p-2 text-center mx-3 text-white cursor-pointer hover:bg-opacity-100">
                                <a href="https://www.facebook.com/acaocomunicativasaude" target="_blank">
                				    <svg viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet" width="26" height="26" fill='white'>
                                      <path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path>
                                    </svg>
                                </a>
                            </div>
            				<div class="rounded-full bg-black bg-opacity-70 p-2 text-center mx-3 text-white cursor-pointer hover:bg-opacity-100">
                                <a href="https://www.instagram.com/acaocomunicativasaude/" target="_blank">
                                    <svg viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet" width="26" height="26" fill='white'>
                                      <path d="M256 109.3c47.8 0 53.4 0.2 72.3 1 17.4 0.8 26.9 3.7 33.2 6.2 8.4 3.2 14.3 7.1 20.6 13.4 6.3 6.3 10.1 12.2 13.4 20.6 2.5 6.3 5.4 15.8 6.2 33.2 0.9 18.9 1 24.5 1 72.3s-0.2 53.4-1 72.3c-0.8 17.4-3.7 26.9-6.2 33.2 -3.2 8.4-7.1 14.3-13.4 20.6 -6.3 6.3-12.2 10.1-20.6 13.4 -6.3 2.5-15.8 5.4-33.2 6.2 -18.9 0.9-24.5 1-72.3 1s-53.4-0.2-72.3-1c-17.4-0.8-26.9-3.7-33.2-6.2 -8.4-3.2-14.3-7.1-20.6-13.4 -6.3-6.3-10.1-12.2-13.4-20.6 -2.5-6.3-5.4-15.8-6.2-33.2 -0.9-18.9-1-24.5-1-72.3s0.2-53.4 1-72.3c0.8-17.4 3.7-26.9 6.2-33.2 3.2-8.4 7.1-14.3 13.4-20.6 6.3-6.3 12.2-10.1 20.6-13.4 6.3-2.5 15.8-5.4 33.2-6.2C202.6 109.5 208.2 109.3 256 109.3M256 77.1c-48.6 0-54.7 0.2-73.8 1.1 -19 0.9-32.1 3.9-43.4 8.3 -11.8 4.6-21.7 10.7-31.7 20.6 -9.9 9.9-16.1 19.9-20.6 31.7 -4.4 11.4-7.4 24.4-8.3 43.4 -0.9 19.1-1.1 25.2-1.1 73.8 0 48.6 0.2 54.7 1.1 73.8 0.9 19 3.9 32.1 8.3 43.4 4.6 11.8 10.7 21.7 20.6 31.7 9.9 9.9 19.9 16.1 31.7 20.6 11.4 4.4 24.4 7.4 43.4 8.3 19.1 0.9 25.2 1.1 73.8 1.1s54.7-0.2 73.8-1.1c19-0.9 32.1-3.9 43.4-8.3 11.8-4.6 21.7-10.7 31.7-20.6 9.9-9.9 16.1-19.9 20.6-31.7 4.4-11.4 7.4-24.4 8.3-43.4 0.9-19.1 1.1-25.2 1.1-73.8s-0.2-54.7-1.1-73.8c-0.9-19-3.9-32.1-8.3-43.4 -4.6-11.8-10.7-21.7-20.6-31.7 -9.9-9.9-19.9-16.1-31.7-20.6 -11.4-4.4-24.4-7.4-43.4-8.3C310.7 77.3 304.6 77.1 256 77.1L256 77.1z"></path>
                                      <path d="M256 164.1c-50.7 0-91.9 41.1-91.9 91.9s41.1 91.9 91.9 91.9 91.9-41.1 91.9-91.9S306.7 164.1 256 164.1zM256 315.6c-32.9 0-59.6-26.7-59.6-59.6s26.7-59.6 59.6-59.6 59.6 26.7 59.6 59.6S288.9 315.6 256 315.6z"></path>
                                      <circle cx="351.5" cy="160.5" r="21.5"></circle>
                                    </svg>
                                </a>
                                
                            </div>
            			</div>
            		</div>
                </div>
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
        		<nav class=" flex justify-between relative overflow-hidden w-0 h-0 xs:w-full xs:h-auto max-w-6xl mx-auto">
        			<ul class="flex flex-1 uppercase items-center font-bold border-b border-gray-200 w-full">
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
                    <ul class="flex uppercase items-center font-bold border-b border-gray-200 ">
                        @livewire('search-bar',key('desk'))
                    </ul>
        		</nav>
        	</header>
                @yield('content')
    		<footer class=" text-gray-400" style="background: #f4f7f6">
    			<div class="h-80 py-20 text-center ">
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
                    <nav class="  flex justify-center shadow-xl bg-actionblue">
                        <ul class="text-center xs:flex uppercase text-white font-bold">
                            <li class="px-3 py-2 xs:py-6 text-white">
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="px-3 py-2 xs:py-6 text-white">
                                <a href="{{route('noticias')}}">Notícias</a>
                            </li>
                            <li class="px-3 py-2 xs:py-6 text-white">
                                <a href="{{route('videos')}}">Vídeos</a>
                            </li>
                            <li class="px-3 py-2 xs:py-6 text-white">
                                <a href="{{route('boletims')}}">Boletim AC Saúde</a>
                            </li>
                            <li class="px-3 py-2 xs:py-6 text-white">
                                <a href="{{route('newsletter')}}">Newsletter</a>
                            </li>
                            <li class="px-3 py-2 xs:py-6 text-white">
                                <a href="{{route('quemSomos')}}">Quem Somos</a>
                            </li>
                        </ul>
                    </nav>
                </div>
    			<div class="border-t border-gray-200 border-opacity-10 p-5 bg-white flex justify-center text-gray-500">
    				Copyright - {{ config('app.name') }}
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
