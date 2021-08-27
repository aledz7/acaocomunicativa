<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('description') - Ação Comunicativa">
        <title> @yield('title') {{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="favicon.ico" />


        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/css/sharetastic.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
        <script src="https://kit.fontawesome.com/e1c06b7241.js" crossorigin="anonymous"></script>

        @yield('styles')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans  antialiased">
        <div class="content">
        	<header class="sticky top-0 bg-white z-10">
                @if( auth()->user() )
                    <div class="bg-gray-700 text-white py-1">
                        <div class="max-w-6xl mx-auto text-center sm:text-right sm:mr-4 text-sm">
                            {{auth()->user()->name }} 
                            @if( auth()->user()->role_id == 0 ) - <a href='{{route("admin.dashboard")}}'>Painel Administrativo</a>  @endif -
                            <a href='#' onclick="$(this).next().submit()"> Sair </a>
                            <form action="{{route('logout')}}" method="POST"  class="hidden">@csrf</form>
                        </div>
                    </div>
                @endif
                <div class="bg-actionblue text-white py-3">
                    <div class="mx-auto max-w-6xl text-white text-sm flex justify-between px-4 sm:px-0">
                        <div class="sm:text-left">
                            <div class="sm:flex items-center">
                                <div>
                                    <img src="/img/verbas-da-saude-logo-horizontal.png" class="-mt-1" alt="Verbas da Saúde - Rastreamento das destinações das verbas públicas para a saúde" title="Verbas da Saúde - Rastreamento das destinações das verbas públicas para a saúde" >
                                </div>
                                <div class="hidden sm:block border-t w-4 mx-4">
                                    
                                </div>
                                <div class="hidden sm:block"> Rastreamento das destinações das verbas públicas para a saúde</div>
                            </div>
                        </div>
                        <div class="text-center sm:flex sm:space-x-3">
                            <div class="flex">
                                <i>Em breve</i>
                                <!-- <div class="px-3 border-r border-l"> Login </div>
                                <div class="px-3 border-r"> Assinar </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-b-2">
            		<div class="flex justify-between items-center py-2 mx-auto max-w-6xl ">
            			<div class="text-2xl pl-4 sm:pl-0">
                            <a href="{{ config('app.url') }}">
            				    <img src="{{ asset('img/logo-acao-comunicativa.png') }}" alt="" style="max-width: 150px">
                            </a>
            			</div>
            			<div>
                            <nav x-data="{menu:false}" class="text-right sm:hidden ">
                                <button @click='menu = true' class="px-6 py-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>  
                                <ul x-show.transition='menu' @click.away='menu = false' class="absolute text-left text-2xl right-0 bg-white  shadow-2xl w-full  divide divide-y text-sm divide-gray-200 border-b border-gray-200" style="display: none;">
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('home')}}" title='Home - {{config("app.name") }}'>Home</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('noticias')}}" title='Notícias - {{config("app.name") }}'>Notícias</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('videos')}}" title='Vídeos - {{config("app.name") }}'>Vídeos</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('saude')}}" title='#saúde - {{config("app.name") }}'>#Saude</a>
                                    </li>
                                    <!-- <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('boletims')}}" title='Verbas da Saúde - {{config("app.name") }}'>Verbas da Saúde</a>
                                    </li> -->
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('newsletter')}}" title='Newsletter - {{config("app.name") }}'>Newsletter</a>
                                    </li>
                                    <li class="py-2 px-3 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                        <a href="{{route('quemSomos')}}" title='Quem Somos - {{config("app.name") }}'>Quem Somos</a>
                                    </li>
                                </ul>
                            </nav>
                            <nav class="flex flex-col justify-end relative overflow-hidden w-0 h-0 sm:w-full sm:h-auto max-w-6xl mx-auto text-sm">
                                <ul>
                                    <div class="space-x-3 text-black mx-auto flex justify-end py-2">
                                        <a href="https://www.facebook.com/acaocomunicativasaude"><i class="fab fa-facebook-f"></i></a>
                                        <a href='https://www.instagram.com/acaocomunicativasaude/'><i class="fab fa-instagram"></i></a>
                                        <a href="https://www.youtube.com/channel/UCPYHmPHs5-Zltu7mVtlqH0A"><i class="fab fa-youtube"></i></a>
                                        <!-- <i class="fab fa-twitter"></i> -->
                                    </div>
                                </ul>
                                <ul class="flex flex-1 uppercase items-center font-bold  w-full">
                                    <li class="px-3 pt-2 pb-4 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('home')}}" title='Home - {{ config("app.name") }}'>Home</a>
                                       </li>
                                    <li class="px-3 pt-2 pb-4 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('noticias')}}" title='Notícias - {{ config("app.name") }}'>Notícias</a>
                                       </li>
                                    <li class="px-3 pt-2 pb-4 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('videos')}}" title='Vídeos - {{ config("app.name") }}'>Vídeos</a>
                                       </li>
                                       <li class="px-3 pt-2 pb-4 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('saude')}}" title='Vídeos - {{ config("app.name") }}'>#Saude</a>
                                       </li>
                                        <!-- <li class="px-3 pt-2 pb-4 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('boletims')}}" title='Verbas da Saúde - {{ config("app.name") }}'>Verbas da Saúde</a>
                                       </li> -->
                                    <li class="px-3 pt-2 pb-4 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('newsletter')}}" title='Newsletter - {{ config("app.name") }}'>Newsletter</a>
                                       </li>
                                    <li class="pl-3 pt-2 pb-4 hover:text-actionblue transition ease-in-out duration-200 ease-in-out ">
                                           <a href="{{route('quemSomos')}}" title='Quem Somos - {{ config("app.name") }}'>Quem Somos</a>
                                    </li>
                                </ul>
                            </nav>         
                        </div>
            		</div>
                </div>
        	</header>
                
            @yield('content')
            <section class="mt-32">
                <div class="max-w-6xl   mx-auto -mb-10 relative shadow-xl text-white bg-bottom sm:bg-center "  style="background: url('{{asset('/img/bg-banner-verbas-da-saude.jpg')}}') no-repeat; background-size: cover ;">
                    <div class="text-center md:flex md:text-left  p-10  items-center">
                        <div class="flex-1">
                            <div class="text-xl font-semibold">
                                <img src="/img/logo-vds.png" alt="" class="w-80">
                            </div>
                        </div>
                        <div class="m-4 text-sm">Plataforma para acompanhar as destinações das verbas públicas para a saúde</div>
                        <div class="m-4 sm:m-10 md:m-0 text-center px-6" >
                            <button class=" px-3 py-2 hover:bg-white hover:text-actionblue">
                                Em Breve!
                            </button>
                        </div>
                    </div>
                </div>
            </section>
           
            <div class="relative">
                <img src="{{ asset('img/marca-dagua.png') }}" class="opacity-5 absolute left-0 " style="top: -250px; left: -300px">
            </div>

    		<footer class=" text-gray-400 bg-actionblue -mt-10">
    			<div class=" py-20 text-center " style="background: #f4f7f6">
    				<div class="mt-16">
    					<div class="text-black font-bold mb-6 text-center">
                            AÇÃO COM VOCÊ
                            <span class="w-20 block border-b-2 border-blue-800 mx-auto mt-2"></span>
                        </div>
                        <p class="text-gray-600">+55 (61) 99132-6324</p>
                        <p class="text-gray-600">+55 (61) 3253-5422</p>
                        <p class="text-gray-600"> 
                            <a href='mailto:contato@acaocomunicativa.com.br' title='Falar com a {{ config("app.name") }}' class="text-blue-900">contato@acaocomunicativa.com.br</a>
                        </p>
                        <p class="text-gray-600 mt-4"> 
                            SHIS QI 09 Bloco A sala 107 Lago Sul – Brasília – DF CEP: 71.625-171
                        </p>
    				</div>
    			</div>
                <div>
                    <nav class="  flex justify-center bg-actionblue py-10">
                        <ul class="text-center xs:flex uppercase text-white font-bold xs:divide xs:divide-x divide-gray-300">
                            <li class="px-3  text-white">
                                <a href="{{route('home')}}" title='Home - {{ config("app.name") }}'>Home</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('noticias')}}" title='Notícias - {{ config("app.name") }}'>Notícias</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('videos')}}" title='Vídeos - {{ config("app.name") }}'>Vídeos</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('saude')}}" title='#saúde - {{ config("app.name") }}'>#saude</a>
                            </li>
                            <!-- <li class="px-3  text-white">
                                <a href="{{route('boletims')}}" title='Verbas da Saúde - {{ config("app.name") }}'>Verbas da Saúde</a>
                            </li> -->
                            <li class="px-3  text-white">
                                <a href="{{route('newsletter')}}" title='Newsletter - {{ config("app.name") }}'>Newsletter</a>
                            </li>
                            <li class="px-3  text-white">
                                <a href="{{route('quemSomos')}}" title='Quem Somos - {{ config("app.name") }}'>Quem Somos</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="space-x-3 mx-auto text-white flex justify-center pb-10">
                    <a href="https://www.facebook.com/acaocomunicativasaude"><i class="fab fa-facebook-f"></i></a>
                    <a href='https://www.instagram.com/acaocomunicativasaude/'><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UCPYHmPHs5-Zltu7mVtlqH0A"><i class="fab fa-youtube"></i></a>
                    <!-- <i class="fab fa-twitter"></i> -->
                </div>
    			<div class="text-white border-t border-gray-200 border-opacity-10 p-5  flex justify-center text-xs bg-black bg-opacity-30">
    				Copyright - {{ config('app.name') }} - {{ date('Y') }}
    			</div>
    		</footer>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
        <script src="/js/jquery.mask.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <script>
            $(document).ready(function(){
                $(".owl-carousel").owlCarousel({
                    // loop:true,
                    margin:10,
                    navigation:false,
                    // autoplay:true,
                    autoplayTimeout:3000,
                    autoplayHoverPause:true,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,
                            nav:false
                        },
                        800:{
                            items:2,
                            nav:false
                        },
                        1200:{
                            items:3,
                            nav:false
                        }
                    }
                });
            });
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
