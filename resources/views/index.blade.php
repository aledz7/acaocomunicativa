@extends('layouts.website')

@section('content')

<div class="w-full grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 py-10 owl-carousel">
	
	@if( $newsCall = \App\Models\News::where('call',1)->first())
		<div class="bg-black h-96 flex flex-col justify-between" style="background: url('{{asset('storage/'.$newsCall->cover)}}') no-repeat; background-size: cover ">
			<div></div>
			<div class="">
				<div class="bg-black bg-opacity-50 text-white py-4 borer-l border-green-500 px-6 relative">
					<div class="flex justify-between">
						<div class="font-bold truncate">{{ $newsCall->title}}</div>
						<div class="text-xs">{{ date('d/M/y',strtotime($newsCall->date))}}</div>
					</div>
					<div class="text-sm line-clamp-2 h-10">
						{{ substr( $newsCall->short_text , 0 , 100 ) }}
					</div>
					<div class="bg-blue-600 rounded-tl  px-2 py-1 text-white font-bold text-xs absolute right-0 bottom-0 ">
						Notícias
					</div>
				</div>
			</div>
		</div>
	@endif



	@if( $newsCall = \App\Models\Video::where('call',1)->first())
		<div class="bg-black h-96 flex flex-col justify-between"  style="background: url('{{asset('storage/'.$newsCall->cover)}}') no-repeat; background-size: cover ">
			<div></div>
			<div class="">
				
				<div class="bg-black bg-opacity-50 text-white py-4 borer-l border-green-500 px-6 relative">
					<div class="flex justify-between">
						<div class="font-bold truncate">{{ $newsCall->title}}</div>
						<div class="text-xs ">{{ date('d/M/y',strtotime($newsCall->date))}}</div>
					</div>
					<div class="text-sm line-clamp-2 h-10">{{ substr( $newsCall->short_text , 0 , 100 ) }}</div>
					<div class="bg-blue-600 rounded-tl  px-2 py-1 text-white font-bold text-xs absolute right-0 bottom-0 ">
						Vídeos
					</div>
				</div>
			</div>
		</div>
	@endif 
	
	@if( $newsCall = \App\Models\Boletim::where('call',1)->first())
		<div class="bg-black h-96 flex flex-col justify-between"  style="background: url('{{asset('storage/'.$newsCall->cover)}}') no-repeat; background-size: cover ">
			<div></div>
			<div class="">
				
				<div class="bg-black bg-opacity-50 text-white py-4 borer-l border-green-500 px-6 relative">
					<div class="flex justify-between">
						<div class="font-bold truncate">{{ $newsCall->title}}</div>
						<div class="text-xs">{{ date('d/M/y',strtotime($newsCall->date))}}</div>
					</div>
					<div class="text-sm line-clamp-2 h-10">{{ substr( $newsCall->short_text , 0 , 100 ) }}</div>
					<div class="bg-blue-600 rounded-tl  px-2 py-1 text-white font-bold text-xs absolute right-0 bottom-0 ">
						#saude
					</div>
				</div>
			</div>
		</div>
	@endif

	@if( $newsCall = \App\Models\Video::where('call',1)->first())
		<div class="bg-black h-96 flex flex-col justify-between"  style="background: url('{{asset('storage/'.$newsCall->cover)}}') no-repeat; background-size: cover ">
			<div></div>
			<div class="">
				
				<div class="bg-black bg-opacity-50 text-white py-4 borer-l border-green-500 px-6 relative">
					<div class="flex justify-between">
						<div class="font-bold truncate">{{ $newsCall->title}}</div>
						<div class="text-xs ">{{ date('d/M/y',strtotime($newsCall->date))}}</div>
					</div>
					<div class="text-sm line-clamp-2 h-10">{{ substr( $newsCall->short_text , 0 , 100 ) }}</div>
					<div class="bg-blue-600 rounded-tl  px-2 py-1 text-white font-bold text-xs absolute right-0 bottom-0 ">
						Vídeos
					</div>
				</div>
			</div>
		</div>
	@endif 
	

</div>

<div class="max-w-6xl mx-auto py-10 px-8 lg:px-0">
	<div class="">
		<div>
			<div class="text-2xl  font-semibold mb-10 text-center">
				Notícias
				<!-- <div class="border-b-2 border-actionblue w-20"></div> -->
			</div>
			<div class="grid lg:grid-cols-3 md:grid-cols-2 xs:grid-cols-1 gap-6">
				@foreach(\App\Models\News::orderBy('created_at','desc')->get()->take(2) as $key=>$news )
					<div class="@if( $key == 0 ) lg:col-span-2 @endif ">
						<div class="h-96 overflow-hidden" style="background: url('{{asset('/storage/'.$news->cover)}}') no-repeat; background-size: cover; background-position: center; ">
						</div>
						<div class="py-10">
							<a href="{{$news->slug}}">
								<div class="font-bold text-2xl line-clamp-2 h-16">
									{{ $news->title }}
								</div>
								<p class="text-sm text-gray-600 line-clamp-3 h-16">
									{{ $news->short_text }}
								</p>
								<span class="text-xs text-gray-400">{{ date('d/M/y',strtotime($news->date))}} - <span class="text-black font-bold">{{config('app.name')}}</span></span> 
							</a>
							</div>
					</div>
				@endforeach
			</div>
		</div>
		
		<div class="grid xs:grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
			@foreach(\App\Models\News::orderBy('created_at','desc')->get()->skip(2)->take(4) as $news )
				<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group sm:px-4">
					<a href='{{route("reading",["slug"=>$news->slug])}}'> 	
						<div class="h-40 overflow-hidden" style="background: url('{{asset('/storage/'.$news->cover)}}') no-repeat; background-size: cover ">
						</div>
						<div class="py-4">
							<p class="font-bold group-hover:text-actionblue transition line-clamp-2 h-14">
								{{$news->title}}
							</p>
							<p class="text-sm text-gray-600 line-clamp-4 h-20">
								{{$news->short_text}}
							</p>
							<div class="py-2 text-gray-700 mt-4 text-xs ">
								<span class="text-gray-400">{{ date('d/M/y',strtotime($news->date))}}</span> - <b>{{config('app.name')}}</b>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>
		<div class="text-center">
			<button class="underline mt-10 text-actionblue  text-sm">Mais Notícias</button>
			<!-- <button class="bg-actionblue px-3 py-2 rounded mt-10 text-white text-sm">Mais Notícias</button> -->
		</div>
	</div>
</div>

<div class="bg-gray-200 my-20 py-4 border-b-4 border-actionblue w-full">
	<div class=" max-w-6xl mx-auto text-center items-center hidden ">
		<div class="flex-1 text-center">
			<div class="text-3xl font-bold mb-2 text-center">
				Newsletter
				<div class="border-b-2 border-actionblue w-20 mx-auto "></div>
			</div>
			<div class="mb-6">
				Cadastre-se para receber notícias no seu e-mail toda semana.
			</div>
			<a href='{{route("newsletter")}}'><button class="bg-actionblue px-2 py-1 rounded uppercase font-bold text-white">Cadastrar-se</button></a>
		</div>
	</div>
</div>

<div class="pt-8 max-w-6xl mx-auto  px-8 lg:px-0 mb-20">

	<div class="">
		<div>
			<div class="text-2xl text-center font-bold mb-10">
				Vídeos
			</div>
			<div class="grid lg:grid-cols-3  md:grid-cols-2 xs:grid-cols-1 gap-10">
				@foreach(\App\Models\Video::orderBy('created_at','desc')->get()->take(3) as $video )
					<div>
						<a href='{{route("reading",["slug"=>$video->slug])}}'> 	
							<div class="max-h-56 overflow-hidden">
								@if( $video->cover )
					    			<img src="{{asset('/storage/'.$video->cover)}}" alt="" class="w-full hover:scale-110 transform transition duration-300 ease-in-out " > 
					    		@else
					    			<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAHlBMVEX09PTh4eH19fXg4ODk5OTw8PDs7Ozq6uru7u7n5+dZKxXMAAAELUlEQVR4nO2dWXKtMAwFwQMX9r/hB9RNMOARhCTyTv/kIxVQl4kHYZmuAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADgAsZ03o9eA6OfwyH360bXWz30kyd2HHvbq8LaibQdJ2V+C7Yf6RSdQsEZOxApGqWCsyJNK5qPVsEZCsHOS1tksBNFI2rsZTY8gaG0QxaCRjRj0ITS4/wvW0judguaKbjaID1f+xLEZG8/psZtV6OeKF3GbH2DHW9fbDN0WgTn/j0wvBtVYEjSM9MAwxZgKAMMW4ChDLyGxoQ/eGA0NMYPk3O9c9PH80nyGZo1A/e9l3WEiZM8DxmeZm3GH/Ib1jFNXZna0AzntTFZcigPj2E8f2M/HIoshqkEFYsih+Fu7b9XZOhvWNow4bdw85YVMBjmkqg0Kb4sHG2YaUKaFF+W5w3zefDnO5vnR/wwPxXh8YwOw1Oaz4Pbmzct8ryhLxhe+EdsivRxw/RgePW2821a/uZ5w8ILt/auZp7Ct8Qqb9g6/17XKA3BKnhK227yswirjvZtPc22yqwN912jxW6bQGW87xrx93mCuoBfNWs7JkKqIuaYeWcf04brn3ey1ITMsXrK7F9oWD1Ft+pUxPyeFXB8L1I5aJYsRnKbTcM9E5utyleQzUTVz2eSu8mKYb8km5jbLleI+xUZ4cJ+wHzgr8jqFzY85iNnfPe0vJn5uVff8mamuKMzGzrn27Xu9+3a4Bu2JddsWc3Erv4NaeWe3HTw6t9yV246Tkev3bB6V3UyfOWGDdvGU/HrNmzbFx8X0GzYvPE/asA14l+hubIhqqC4DS+UbsQc9Bpeq005S2g1vFx8c7LQani5uuikIWhohnR5wI3yqaOHnOG8ZLQpxVv1YYd1p5jhuiZOKN4sgNsrShl+F/0xxfsVfjtFoRE/yGqcfkdQwhgqyrRhmLY5tiJJjWbwvkfEcJeXOjyoNEWoVrYND4m3UJGqyla2DU+ZxUCRqoxY1DCWOv3pbsjqpCUNo4LfVqQrBBc0jAquioaylF/OMCG4KlKW8j9vmBjxk4LUSLUhm6CUIZ+gkCGjoIwhp6CIIaughCGvoIAhsyC/Ibcg+4jPLsjdhvyCzIYCgryGEoK8hoV93u83lDn+i9VQ4iGFIQwrDN2fN/z7bQhDGMIQhjCEYdnwvxrxPyKnljIadn6QgNOwMxKwGgoDwxZgKAMMW4ChDE/N2kiCoyA4eYTgPO/t/PPluyc6COrICc5kDybZ1jodhPP+u4LFg1qkofjXyR9jIgzFaaKl84Rkoen9FDci1Tmb0h5JqM6gNFo7m2R5zgVFbd8kW5nHZzJOx0MowNqhHHiL4+h2H7ARZvl4HvUHAtfD1yfpycyX6TPSfwCxE8o+JXhADwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs/ANyGFT0fw3sTAAAAABJRU5ErkJggg==" alt="" class="mx-auto rounded"> 
					    		@endif
							</div>
							<div class="py-10">
								<a href="{{ route('reading',$video->slug) }}">
									<p class="font-bold text-xl">{{$video->title}}</p>
									<p class="text-sm py-4 text-gray-700">
										{{$video->short_text}}
									</p>
								</a>
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
			<div class="text-xl font-bold mb-4 hidden">
				<a href='{{route("videos")}}' class="font-bold">Mais Videos</a>
				<div class="border-b-2 border-actionblue w-20"></div>
			</div>
			<div class="grid-cols-1">
				@foreach(\App\Models\Video::orderBy('created_at','desc')->get()->skip(3)->take(3) as $videos )
					<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-100 group">
						<a href='{{route("reading",["slug"=>$videos->slug])}}' class="flex"> 	
							<div class="w-0 h-0 sm:w-60 sm:h-40" style="background: url('{{asset('/storage/'.$videos->cover)}}') no-repeat; background-size: cover ">
							</div>
							<div class="sm:px-4 flex-1">
								<p class="font-bold group-hover:text-actionblue transition">{{$videos->title}}</p>
								<p class="text-sm text-gray-600">
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
			<button class="underline mt-10 text-actionblue  text-sm">Mais Vídeos</button>
			<!-- <button class="bg-actionblue px-3 py-2 rounded mt-10 text-white text-sm">Mais Vídeos</button> -->
		</div>
	</div>

</div>

<div class="bg-gray-100 my-20 h-14 shadow-inner w-full hidden"></div>

<div class="pt-8 max-w-6xl mx-auto  px-8 lg:px-0 hidden">
	<div>
		<div>
			<div class="text-2xl font-bold mb-10">
				Boletim
				<div class="border-b-2 border-actionblue w-20"></div>
			</div>
			<div class="grid lg:grid-cols-3  md:grid-cols-2 xs:grid-cols-1 gap-10">
				@foreach(\App\Models\Boletim::orderBy('created_at','desc')->get()->take(3) as $boletim )
					<div>
						<a href='/boletim-ac-saude-{{$boletim->id}}'> 	
							<div>
								@if( $boletim->cover )
					    			<img src="{{asset('/storage/'.$boletim->cover)}}" alt="" class="mx-auto"> 
					    		@else
					    			<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAHlBMVEX09PTh4eH19fXg4ODk5OTw8PDs7Ozq6uru7u7n5+dZKxXMAAAELUlEQVR4nO2dWXKtMAwFwQMX9r/hB9RNMOARhCTyTv/kIxVQl4kHYZmuAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADgAsZ03o9eA6OfwyH360bXWz30kyd2HHvbq8LaibQdJ2V+C7Yf6RSdQsEZOxApGqWCsyJNK5qPVsEZCsHOS1tksBNFI2rsZTY8gaG0QxaCRjRj0ITS4/wvW0judguaKbjaID1f+xLEZG8/psZtV6OeKF3GbH2DHW9fbDN0WgTn/j0wvBtVYEjSM9MAwxZgKAMMW4ChDLyGxoQ/eGA0NMYPk3O9c9PH80nyGZo1A/e9l3WEiZM8DxmeZm3GH/Ib1jFNXZna0AzntTFZcigPj2E8f2M/HIoshqkEFYsih+Fu7b9XZOhvWNow4bdw85YVMBjmkqg0Kb4sHG2YaUKaFF+W5w3zefDnO5vnR/wwPxXh8YwOw1Oaz4Pbmzct8ryhLxhe+EdsivRxw/RgePW2821a/uZ5w8ILt/auZp7Ct8Qqb9g6/17XKA3BKnhK227yswirjvZtPc22yqwN912jxW6bQGW87xrx93mCuoBfNWs7JkKqIuaYeWcf04brn3ey1ITMsXrK7F9oWD1Ft+pUxPyeFXB8L1I5aJYsRnKbTcM9E5utyleQzUTVz2eSu8mKYb8km5jbLleI+xUZ4cJ+wHzgr8jqFzY85iNnfPe0vJn5uVff8mamuKMzGzrn27Xu9+3a4Bu2JddsWc3Erv4NaeWe3HTw6t9yV246Tkev3bB6V3UyfOWGDdvGU/HrNmzbFx8X0GzYvPE/asA14l+hubIhqqC4DS+UbsQc9Bpeq005S2g1vFx8c7LQani5uuikIWhohnR5wI3yqaOHnOG8ZLQpxVv1YYd1p5jhuiZOKN4sgNsrShl+F/0xxfsVfjtFoRE/yGqcfkdQwhgqyrRhmLY5tiJJjWbwvkfEcJeXOjyoNEWoVrYND4m3UJGqyla2DU+ZxUCRqoxY1DCWOv3pbsjqpCUNo4LfVqQrBBc0jAquioaylF/OMCG4KlKW8j9vmBjxk4LUSLUhm6CUIZ+gkCGjoIwhp6CIIaughCGvoIAhsyC/Ibcg+4jPLsjdhvyCzIYCgryGEoK8hoV93u83lDn+i9VQ4iGFIQwrDN2fN/z7bQhDGMIQhjCEYdnwvxrxPyKnljIadn6QgNOwMxKwGgoDwxZgKAMMW4ChDE/N2kiCoyA4eYTgPO/t/PPluyc6COrICc5kDybZ1jodhPP+u4LFg1qkofjXyR9jIgzFaaKl84Rkoen9FDci1Tmb0h5JqM6gNFo7m2R5zgVFbd8kW5nHZzJOx0MowNqhHHiL4+h2H7ARZvl4HvUHAtfD1yfpycyX6TPSfwCxE8o+JXhADwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs/ANyGFT0fw3sTAAAAABJRU5ErkJggg==" alt="" class="mx-auto"> 
					    		@endif
							</div>
							<div class="px-6 py-10">
								<p>
								</p>
								<p class="font-bold text-lg ">{{$boletim->title}}</p>
								<p class="text-sm text-gray-500">
									{{$boletim->short_text}}
								</p>
								<div class="text-sm py-2 text-gray-500">
									{{ date('d/M/y',strtotime($boletim->date))}} - <b class='text-black'>{{config('app.name')}}</b>
								</div>
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>

</div>




@endsection

