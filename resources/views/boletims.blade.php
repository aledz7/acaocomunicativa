@extends('layouts.website')

@section('content')
<div class="pt-8 max-w-6xl mx-auto px-8 lg:px-4">
    <div class="text-xl">
    	Boletim AC Saúde
		<div class="border-b-2 border-actionblue w-20"></div>
    </div>		
    <div class="py-10 flex space-x-4">
        <div class="w-10/12 mx-auto">
            @if( $last )
                @guest
                    <div class="max-w-xl mx-auto">
                        <div class="text-2xl text-center">
                            {{$last->title}}
                        </div>
                        <div class="relative group">
                            <div class="w-full h-full absolute bg-black text-white flex items-center justify-center bg-opacity-0 cursor-pointer group-hover:bg-opacity-60">
                                <svg class="w-20 h-20 opacity-0 group-hover:opacity-100 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <img src="{{$last->cover}}" alt="">
                        </div>
                        
                        <div class="py-6">
                            {{$last->short_text}}
                        </div>
                        <div x-data='{modalSign:false}'>
                            <div class="text-center">
                                <button @click='modalSign = true' class="bg-actionblue px-3 py-1 rounded text-white mx-auto">Continuar lendo...</button>
                            </div>
                            <div x-show='modalSign' class="fixed overflow-scroll w-full h-screen bg-black bg-opacity-50 left-0 top-0  px-20 py-10" style="display: none;">
                                <div class="bg-white w-4/12 mx-auto rounded">
                                    <div class="py-2 px-3 border-b border-gray-200 text-right">
                                        <button @click='modalSign = false'>X</button>
                                    </div>
                                    <div>
                                        <div class="p-6">
                                            @livewire('register')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <iframe src="{{ asset('/storage/'.$last->file) }}" frameborder="0" class="w-full h-screen"></iframe>
                @endguest
            @else
                <div class="text-center text-lg">
                    Não há boletins cadastrados ainda. Mas increva-se na newsletter e seja avisado quando for cadastrado um novo boletim.
                </div>
                <div class="p-6">
                    @guest
                        @livewire('register')
                    @else
                        Olá, <b>{{auth()->user()->name}}</b>. Em breve teremos o cadastro dos Boletims.
                    @endif
                </div>
            @endif
        </div>
        @auth
            <div class="w-2/12">
                @foreach( $boletims as $boletim )
                    <div class="mb-8 border-b border-dotted border-gray-300 hover:bg-gray-50 p-2">
                        <a href="{{route('boletim',$boletim)}}">
                            <div class="font-bold">
                                {{$boletim->title}}
                            </div>
                            <div class="py-3 text-xs">
                                {{$boletim->short_text}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endauth
    </div>
</div>
@endsection