@extends('layouts.website')

@section('content')

<div class="max-w-6xl mx-auto grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 py-10 owl-carousel">
	
	@if( $newsCall = $news->where('call',1)->first() )
		<a href="/{{$newsCall->slug}}">
		<div class="bg-black h-64 flex flex-col justify-between" style="background: url('{{asset('storage/'.$newsCall->cover)}}') no-repeat; background-size: cover ">
			<div></div>
			<div class="bg-actionblue rounded-bl  px-2 py-1 text-white font-bold absolute right-0 top-0 ">
				Notícias
			</div>
			<div class="">
				<div class="bg-black bg-opacity-50 text-white py-4 borer-l border-green-500 px-6 relative">
					<div class="flex justify-between">
						<div class="font-bold truncate">{{ $newsCall->title}}</div>
						<div class="text-xs">{{ date('d/M/y',strtotime($newsCall->date))}}</div>
					</div>
					<div class="text-sm line-clamp-2 h-10">
						{{ substr( $newsCall->short_text , 0 , 100 ) }}
					</div>
				</div>
			</div>
		</div>
		</a>
	@endif


	@if( $newsVideo = $videos->where('call',1)->first() )
		<a href="/{{$newsVideo->slug}}">
		<div class="bg-black h-64 flex flex-col justify-between"  style="background: url('{{asset('storage/'.$newsVideo->cover)}}') no-repeat; background-size: cover ">
			<div></div>
			<div class="bg-actionblue rounded-bl  px-2 py-1 text-white font-bold absolute right-0 top-0 ">
				Vídeos
			</div>
			<div class="">
				
				<div class="bg-black bg-opacity-50 text-white py-4 borer-l border-green-500 px-6 relative">
					<div class="flex justify-between">
						<div class="font-bold truncate">{{ $newsVideo->title}}</div>
						<div class="text-xs ">{{ date('d/M/y',strtotime($newsVideo->date))}}</div>
					</div>
					<div class="text-sm line-clamp-2 h-10">{{ substr( $newsVideo->short_text , 0 , 100 ) }}</div>
				</div>
			</div>
		</div>
		</a>
	@endif 
	
	@if( $newsHealth = $healths->where('call',1)->first() )
		<a href="/{{$newsHealth->slug}}">
		<div class="bg-black h-64 flex flex-col justify-between"  style="background: url('{{asset('storage/'.$newsHealth->cover)}}') no-repeat; background-size: cover ">
			<div></div>
			<div class="bg-actionblue rounded-bl  px-2 py-1 text-white font-bold absolute right-0 top-0 ">
				#saude
			</div>
			<div class="">
				
				<div class="bg-black bg-opacity-50 text-white py-4 borer-l border-green-500 px-6 relative">
					<div class="flex justify-between">
						<div class="font-bold truncate">{{ $newsHealth->title}}</div>
						<div class="text-xs">{{ date('d/M/y',strtotime($newsHealth->date))}}</div>
					</div>
					<div class="text-sm line-clamp-2 h-10">{{ substr( $newsHealth->short_text , 0 , 100 ) }}</div>
				</div>
			</div>
		</div>
		</a>
	@endif


</div>

<div class="mx-auto mt-10 px-8 lg:px-0">
	<div class=" max-w-6xl text-3xl font-semibold mb-2 text-left mx-auto">
		Notícias
		<div class="w-40 h-1 bg-gradient-to-br from-actionblue to-red-700"></div>
	</div>
</div>
<div class="max-w-6xl mx-auto p-2 pb-10 px-8 lg:px-0">
	<div class="">
		<div>
			<div class="grid lg:grid-cols-3 md:grid-cols-2 xs:grid-cols-1 gap-6">
				@foreach( $news->take(2) as $key=>$new )
					<a href="{{$new->slug}}" class="@if( $key == 0 ) lg:col-span-2 @endif group" title="{{$new->title}} - {{ config('app.name') }}" >
						<div >
							<div class="h-64 overflow-hidden" style="background: url('{{asset('/storage/'.$new->cover)}}') no-repeat; background-size: cover; background-position: center; ">
							</div>
							<div class="py-10 group-hover:text-actionblue transition duration-300">
								<div class="font-bold text-2xl line-clamp-2 h-16">
									{{ $new->title }}
								</div>
								<p class="text-sm text-gray-600 line-clamp-3 h-16">
									{{ $new->short_text }}
								</p>
								<span class="text-xs text-gray-400">{{ date('d/M/y',strtotime($new->date))}} - <span class="text-black font-bold">{{config('app.name')}}</span></span> 
							</div>
						</div>
					</a>
				@endforeach
			</div>
		</div>
		
		<div class="grid xs:grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
			@foreach( $news->skip(2)->take(4) as $new )
				<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group sm:px-4">
					<a href='{{route("reading",["slug"=>$new->slug])}}' title="{{$new->title}} - {{ config('app.name') }}"> 	
						<div class="h-40 overflow-hidden" style="background: url('{{asset('/storage/'.$new->cover)}}') no-repeat; background-size: cover ">
						</div>
						<div class="py-4">
							<p class="font-bold group-hover:text-actionblue transition line-clamp-2 h-14">
								{{$new->title}}
							</p>
							<p class="text-sm text-gray-600 line-clamp-4 h-20">
								{{$new->short_text}}
							</p>
							<div class="py-2 text-gray-700 mt-4 text-xs ">
								<span class="text-gray-400">{{ date('d/M/y',strtotime($new->date))}}</span> - <b>{{config('app.name')}}</b>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>
		<div class="text-center">
			<a href='{{ route("noticias") }}' title='Notícias da Saúde - {{ config("app.name")}}'><button class="underline mt-10 text-actionblue  text-sm">Mais Notícias</button></a>
			<!-- <button class="bg-actionblue px-3 py-2 rounded mt-10 text-white text-sm">Mais Notícias</button> -->
		</div>
	</div>
</div>

<div class="relative">
	<img src="{{ asset('img/marca-dagua.png') }}" class="opacity-5 absolute left-0 " style="top: -250px; left: -300px">
</div>

<div class="bg-gray-100 py-10">
	<div class="mx-auto mt-10 px-8 lg:px-0">
		<div class=" max-w-6xl text-3xl font-semibold mb-2 text-left mx-auto">
			Vídeos
			<div class="w-40 h-1 bg-gradient-to-br from-actionblue to-red-700"></div>
		</div>
	</div>
	<div class="pt-8 max-w-6xl mx-auto  px-8 lg:px-0 mb-20">

		<div class="">
			<div>
				<div class="grid lg:grid-cols-3  md:grid-cols-2 xs:grid-cols-1 gap-10">
					@foreach( $videos->take(3) as $video )
						<div>
							<a href='{{route("reading",["slug"=>$video->slug])}}' title="{{$video->title}} - {{ config('app.name') }}"> 	
								<div class="max-h-56 overflow-hidden">
									@if( $video->cover )
						    			<img src="{{asset('/storage/'.$video->cover)}}" alt="" class="w-full hover:scale-110 transform transition duration-300 ease-in-out " > 
						    		@else
						    			<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAHlBMVEX09PTh4eH19fXg4ODk5OTw8PDs7Ozq6uru7u7n5+dZKxXMAAAELUlEQVR4nO2dWXKtMAwFwQMX9r/hB9RNMOARhCTyTv/kIxVQl4kHYZmuAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADgAsZ03o9eA6OfwyH360bXWz30kyd2HHvbq8LaibQdJ2V+C7Yf6RSdQsEZOxApGqWCsyJNK5qPVsEZCsHOS1tksBNFI2rsZTY8gaG0QxaCRjRj0ITS4/wvW0judguaKbjaID1f+xLEZG8/psZtV6OeKF3GbH2DHW9fbDN0WgTn/j0wvBtVYEjSM9MAwxZgKAMMW4ChDLyGxoQ/eGA0NMYPk3O9c9PH80nyGZo1A/e9l3WEiZM8DxmeZm3GH/Ib1jFNXZna0AzntTFZcigPj2E8f2M/HIoshqkEFYsih+Fu7b9XZOhvWNow4bdw85YVMBjmkqg0Kb4sHG2YaUKaFF+W5w3zefDnO5vnR/wwPxXh8YwOw1Oaz4Pbmzct8ryhLxhe+EdsivRxw/RgePW2821a/uZ5w8ILt/auZp7Ct8Qqb9g6/17XKA3BKnhK227yswirjvZtPc22yqwN912jxW6bQGW87xrx93mCuoBfNWs7JkKqIuaYeWcf04brn3ey1ITMsXrK7F9oWD1Ft+pUxPyeFXB8L1I5aJYsRnKbTcM9E5utyleQzUTVz2eSu8mKYb8km5jbLleI+xUZ4cJ+wHzgr8jqFzY85iNnfPe0vJn5uVff8mamuKMzGzrn27Xu9+3a4Bu2JddsWc3Erv4NaeWe3HTw6t9yV246Tkev3bB6V3UyfOWGDdvGU/HrNmzbFx8X0GzYvPE/asA14l+hubIhqqC4DS+UbsQc9Bpeq005S2g1vFx8c7LQani5uuikIWhohnR5wI3yqaOHnOG8ZLQpxVv1YYd1p5jhuiZOKN4sgNsrShl+F/0xxfsVfjtFoRE/yGqcfkdQwhgqyrRhmLY5tiJJjWbwvkfEcJeXOjyoNEWoVrYND4m3UJGqyla2DU+ZxUCRqoxY1DCWOv3pbsjqpCUNo4LfVqQrBBc0jAquioaylF/OMCG4KlKW8j9vmBjxk4LUSLUhm6CUIZ+gkCGjoIwhp6CIIaughCGvoIAhsyC/Ibcg+4jPLsjdhvyCzIYCgryGEoK8hoV93u83lDn+i9VQ4iGFIQwrDN2fN/z7bQhDGMIQhjCEYdnwvxrxPyKnljIadn6QgNOwMxKwGgoDwxZgKAMMW4ChDE/N2kiCoyA4eYTgPO/t/PPluyc6COrICc5kDybZ1jodhPP+u4LFg1qkofjXyR9jIgzFaaKl84Rkoen9FDci1Tmb0h5JqM6gNFo7m2R5zgVFbd8kW5nHZzJOx0MowNqhHHiL4+h2H7ARZvl4HvUHAtfD1yfpycyX6TPSfwCxE8o+JXhADwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs/ANyGFT0fw3sTAAAAABJRU5ErkJggg==" alt="" class="mx-auto rounded"> 
						    		@endif
								</div>
								<div class="py-10">
										<p class="font-bold text-xl">{{$video->title}}</p>
										<p class="text-sm pt-4 text-gray-700 line-clamp-3">
											{{$video->short_text}}
										</p>
									<div class="text-sm py-2 text-gray-700 mt-4">
										<span class="text-gray-400">{{ date('d/M/y',strtotime($video->date))}}</span> - <b>{{config('app.name')}}</b>
									</div>
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
			<div class="">
				<div class="grid-cols-1">
					@foreach( $videos->skip(3)->take(3) as $videos )
						<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-100 group">
							<a href='{{route("reading",["slug"=>$videos->slug])}}' class="flex" title="{{$video->title}} - {{ config('app.name') }}"> 	
								<div class="w-0 h-0 sm:w-60 sm:h-40" style="background: url('{{asset('/storage/'.$videos->cover)}}') no-repeat; background-size: cover ">
								</div>
								<div class="sm:px-4 flex-1">
									<p class="font-bold group-hover:text-actionblue transition">{{$videos->title}}</p>
									<p class="text-sm text-gray-600 line-clamp-3">
										{{$videos->short_text}}
									</p>
									<div class="text-sm py-2 text-gray-700 ">
										<span class="text-gray-400">{{ date('d/M/y',strtotime($video->date))}}</span> - <b>{{config('app.name')}}</b>
									</div>
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
			<div class="text-center">
				<a href='{{ route("videos")}}'  title='Vídeos da Saúde - {{ config("app.name")}}'><button class="underline mt-10 text-actionblue  text-sm" >Mais Vídeos</button></a>
				<!-- <button class="bg-actionblue px-3 py-2 rounded mt-10 text-white text-sm">Mais Vídeos</button> -->
			</div>
		</div>
	</div>	
</div>






@endsection

