<div x-data='{searchModel : false}' class="float-right">
    <div class="px-3 py-1 hover:text-actionblue transition ease-in-out duration-200 ease-in-out">
	    <svg @click='searchModel = true' onclick='$("#search-bar").focus()' class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
	</div>

	
	<div x-show.transition='searchModel' class="fixed z-10 top-0 left-0 bg-white mx-auto top-0 w-full" style="display: none;background: url({{asset('img/marca-dagua-pesquisa.png')}} ) no-repeat -100px -100px ; background-color: #fff;">
		<div class="max-w-6xl mx-auto h-screen flex flex-col pb-10">
			<div class="text-right px-6 pt-3">
				<button @click='searchModel = false' class="text-gray-600 font-bold text-xl px-3 active:outline-none focus:outline-none border rounded">X</button>
			</div>	
			<div>
				<div class="text-3xl  mb-8 sm:flex">
					<div class="px-4   flex-1">
						<input wire:model.debounce.500ms='search' id='search-bar' type="text" class="border-b border-gray-300 w-full focus:outline-none p-4 bg-transparent" autofocus="autofocus" placeholder="Pesquisar por...">
					</div>
				</div>
			</div>
			<div class="flex-1 overflow-scroll px-6">
				<div> 
					<div class="text-2xl font-bold mb-2">
						Notícias
						<div class="border-b-2 border-actionblue w-20"></div>
					</div>
					<div class="overflow-scroll">
						@if( $news->count() == 0  )
							<p class="w-full p-4 text-center bg-gray-100 block my-6	">Sem notícias</p>
						@else
							@foreach( $news as $new)
								 <div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
								 	<a href='{{route("reading",["slug"=>$new->slug ])}}' class="sm:flex" title="{{ $new->title }} - {{ config('app.name') }}"  alt="{{ $new->title }} - {{ config('app.name') }}"> 	
								 		<div class="sm:w-36 py-1">
								 			@if( $new->cover )
								     			<img src="{{asset('/storage/'.$new->cover)}}"  class="w-full sm:w-auto mx-auto rounded" title="{{ $new->title }} - {{ config('app.name') }}"  alt="{{ $new->title }} - {{ config('app.name') }}">
								     		@else
								     			<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAHlBMVEX09PTh4eH19fXg4ODk5OTw8PDs7Ozq6uru7u7n5+dZKxXMAAAELUlEQVR4nO2dWXKtMAwFwQMX9r/hB9RNMOARhCTyTv/kIxVQl4kHYZmuAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADgAsZ03o9eA6OfwyH360bXWz30kyd2HHvbq8LaibQdJ2V+C7Yf6RSdQsEZOxApGqWCsyJNK5qPVsEZCsHOS1tksBNFI2rsZTY8gaG0QxaCRjRj0ITS4/wvW0judguaKbjaID1f+xLEZG8/psZtV6OeKF3GbH2DHW9fbDN0WgTn/j0wvBtVYEjSM9MAwxZgKAMMW4ChDLyGxoQ/eGA0NMYPk3O9c9PH80nyGZo1A/e9l3WEiZM8DxmeZm3GH/Ib1jFNXZna0AzntTFZcigPj2E8f2M/HIoshqkEFYsih+Fu7b9XZOhvWNow4bdw85YVMBjmkqg0Kb4sHG2YaUKaFF+W5w3zefDnO5vnR/wwPxXh8YwOw1Oaz4Pbmzct8ryhLxhe+EdsivRxw/RgePW2821a/uZ5w8ILt/auZp7Ct8Qqb9g6/17XKA3BKnhK227yswirjvZtPc22yqwN912jxW6bQGW87xrx93mCuoBfNWs7JkKqIuaYeWcf04brn3ey1ITMsXrK7F9oWD1Ft+pUxPyeFXB8L1I5aJYsRnKbTcM9E5utyleQzUTVz2eSu8mKYb8km5jbLleI+xUZ4cJ+wHzgr8jqFzY85iNnfPe0vJn5uVff8mamuKMzGzrn27Xu9+3a4Bu2JddsWc3Erv4NaeWe3HTw6t9yV246Tkev3bB6V3UyfOWGDdvGU/HrNmzbFx8X0GzYvPE/asA14l+hubIhqqC4DS+UbsQc9Bpeq005S2g1vFx8c7LQani5uuikIWhohnR5wI3yqaOHnOG8ZLQpxVv1YYd1p5jhuiZOKN4sgNsrShl+F/0xxfsVfjtFoRE/yGqcfkdQwhgqyrRhmLY5tiJJjWbwvkfEcJeXOjyoNEWoVrYND4m3UJGqyla2DU+ZxUCRqoxY1DCWOv3pbsjqpCUNo4LfVqQrBBc0jAquioaylF/OMCG4KlKW8j9vmBjxk4LUSLUhm6CUIZ+gkCGjoIwhp6CIIaughCGvoIAhsyC/Ibcg+4jPLsjdhvyCzIYCgryGEoK8hoV93u83lDn+i9VQ4iGFIQwrDN2fN/z7bQhDGMIQhjCEYdnwvxrxPyKnljIadn6QgNOwMxKwGgoDwxZgKAMMW4ChDE/N2kiCoyA4eYTgPO/t/PPluyc6COrICc5kDybZ1jodhPP+u4LFg1qkofjXyR9jIgzFaaKl84Rkoen9FDci1Tmb0h5JqM6gNFo7m2R5zgVFbd8kW5nHZzJOx0MowNqhHHiL4+h2H7ARZvl4HvUHAtfD1yfpycyX6TPSfwCxE8o+JXhADwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs/ANyGFT0fw3sTAAAAABJRU5ErkJggg=="  class="mx-auto rounded"  title="{{ $new->title }} - {{ config('app.name') }}"  alt="{{ $new->title }} - {{ config('app.name') }}"> 
								     		@endif
								 		</div>
								 		<div class="sm:px-4 py-4 sm:py-0 flex-1">
								 			<h2 class="font-bold group-hover:text-actionblue transition">{{$new->title}}</h2>
								 			<h3 class="text-sm text-gray-600 font-normal">
								 				{{ $new->short_text }}
								 			</h3>
								 			<div class="text-sm py-2 text-gray-700 ">
								 				<span class="text-gray-400">{{ date('d/M/y')}}</span> - <b>{{config('app.name')}}</b>
								 			</div>
								 		</div>
								 	</a>
								 </div>
							@endforeach
						@endif
					</div>
				</div>
				<div class="mt-8">
					<div class="text-2xl font-bold mb-10">
						Vídeos
						<div class="border-b-2 border-actionblue w-20"></div>
					</div>
					@if( $videos->count() == 0  )
						<p class="w-full p-4 text-center bg-gray-100 block my-6	">Sem Vídeos</p>
					@else
						@foreach( $videos as $video)
							 <div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
							 	<a href='{{route("reading",["slug"=>$video->slug ])}}' class="sm:flex"  title="{{ $video->title }} - {{ config('app.name') }}"  alt="{{ $video->title }} - {{ config('app.name') }}"> 	
							 		<div class="sm:w-36 py-1">
							 			@if( $video->cover )
							     			<img src="{{asset('/storage/'.$video->cover)}}"  class="w-full sm:w-auto mx-auto rounded" title="{{ $video->title }} - {{ config('app.name') }}"  alt="{{ $video->title }} - {{ config('app.name') }}">
							     		@else
							     			<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAHlBMVEX09PTh4eH19fXg4ODk5OTw8PDs7Ozq6uru7u7n5+dZKxXMAAAELUlEQVR4nO2dWXKtMAwFwQMX9r/hB9RNMOARhCTyTv/kIxVQl4kHYZmuAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADgAsZ03o9eA6OfwyH360bXWz30kyd2HHvbq8LaibQdJ2V+C7Yf6RSdQsEZOxApGqWCsyJNK5qPVsEZCsHOS1tksBNFI2rsZTY8gaG0QxaCRjRj0ITS4/wvW0judguaKbjaID1f+xLEZG8/psZtV6OeKF3GbH2DHW9fbDN0WgTn/j0wvBtVYEjSM9MAwxZgKAMMW4ChDLyGxoQ/eGA0NMYPk3O9c9PH80nyGZo1A/e9l3WEiZM8DxmeZm3GH/Ib1jFNXZna0AzntTFZcigPj2E8f2M/HIoshqkEFYsih+Fu7b9XZOhvWNow4bdw85YVMBjmkqg0Kb4sHG2YaUKaFF+W5w3zefDnO5vnR/wwPxXh8YwOw1Oaz4Pbmzct8ryhLxhe+EdsivRxw/RgePW2821a/uZ5w8ILt/auZp7Ct8Qqb9g6/17XKA3BKnhK227yswirjvZtPc22yqwN912jxW6bQGW87xrx93mCuoBfNWs7JkKqIuaYeWcf04brn3ey1ITMsXrK7F9oWD1Ft+pUxPyeFXB8L1I5aJYsRnKbTcM9E5utyleQzUTVz2eSu8mKYb8km5jbLleI+xUZ4cJ+wHzgr8jqFzY85iNnfPe0vJn5uVff8mamuKMzGzrn27Xu9+3a4Bu2JddsWc3Erv4NaeWe3HTw6t9yV246Tkev3bB6V3UyfOWGDdvGU/HrNmzbFx8X0GzYvPE/asA14l+hubIhqqC4DS+UbsQc9Bpeq005S2g1vFx8c7LQani5uuikIWhohnR5wI3yqaOHnOG8ZLQpxVv1YYd1p5jhuiZOKN4sgNsrShl+F/0xxfsVfjtFoRE/yGqcfkdQwhgqyrRhmLY5tiJJjWbwvkfEcJeXOjyoNEWoVrYND4m3UJGqyla2DU+ZxUCRqoxY1DCWOv3pbsjqpCUNo4LfVqQrBBc0jAquioaylF/OMCG4KlKW8j9vmBjxk4LUSLUhm6CUIZ+gkCGjoIwhp6CIIaughCGvoIAhsyC/Ibcg+4jPLsjdhvyCzIYCgryGEoK8hoV93u83lDn+i9VQ4iGFIQwrDN2fN/z7bQhDGMIQhjCEYdnwvxrxPyKnljIadn6QgNOwMxKwGgoDwxZgKAMMW4ChDE/N2kiCoyA4eYTgPO/t/PPluyc6COrICc5kDybZ1jodhPP+u4LFg1qkofjXyR9jIgzFaaKl84Rkoen9FDci1Tmb0h5JqM6gNFo7m2R5zgVFbd8kW5nHZzJOx0MowNqhHHiL4+h2H7ARZvl4HvUHAtfD1yfpycyX6TPSfwCxE8o+JXhADwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs/ANyGFT0fw3sTAAAAABJRU5ErkJggg=="  class="mx-auto rounded"  title="{{ $video->title }} - {{ config('app.name') }}"  alt="{{ $video->title }} - {{ config('app.name') }}"> 
							     		@endif
							 		</div>
							 		<div class="sm:px-4 py-4 sm:py-0 flex-1">

							 			<h2 class="font-bold group-hover:text-actionblue transition">{{$video->title}}</h2>
							 			<h3 class="text-sm text-gray-600">
							 				{{$video->short_text}}
							 			</h3>
							 			<div class="text-sm py-2 text-gray-700 ">
							 				<span class="text-gray-400">{{ date('d/M/y')}}</span> - <b>{{config('app.name')}}</b>
							 			</div>
							 		</div>
							 	</a>
							 </div>
						@endforeach
					@endif
				</div>
				<div class="mt-8">
					<div class="text-2xl font-bold mb-10">
						#saude
						<div class="border-b-2 border-actionblue w-20"></div>
					</div>
					@if( $healths->count() == 0  )
						<p class="w-full p-4 text-center bg-gray-100 block my-6	">Sem #saude</p>
					@else
						@foreach( $healths as $health)
							 <div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
							 	<a href='{{route("reading",["slug"=>$health->slug ])}}' class="sm:flex"  title="{{ $health->title }} - {{ config('app.name') }}"  alt="{{ $health->title }} - {{ config('app.name') }}"> 	
							 		<div class="sm:w-36 py-1">
							 			@if( $health->cover )
							     			<img src="{{asset('/storage/'.$health->cover)}}"   class="w-full sm:w-auto mx-auto rounded"  title="{{ $health->title }} - {{ config('app.name') }}"  alt="{{ $health->title }} - {{ config('app.name') }}">
							     		@else
							     			<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAHlBMVEX09PTh4eH19fXg4ODk5OTw8PDs7Ozq6uru7u7n5+dZKxXMAAAELUlEQVR4nO2dWXKtMAwFwQMX9r/hB9RNMOARhCTyTv/kIxVQl4kHYZmuAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADgAsZ03o9eA6OfwyH360bXWz30kyd2HHvbq8LaibQdJ2V+C7Yf6RSdQsEZOxApGqWCsyJNK5qPVsEZCsHOS1tksBNFI2rsZTY8gaG0QxaCRjRj0ITS4/wvW0judguaKbjaID1f+xLEZG8/psZtV6OeKF3GbH2DHW9fbDN0WgTn/j0wvBtVYEjSM9MAwxZgKAMMW4ChDLyGxoQ/eGA0NMYPk3O9c9PH80nyGZo1A/e9l3WEiZM8DxmeZm3GH/Ib1jFNXZna0AzntTFZcigPj2E8f2M/HIoshqkEFYsih+Fu7b9XZOhvWNow4bdw85YVMBjmkqg0Kb4sHG2YaUKaFF+W5w3zefDnO5vnR/wwPxXh8YwOw1Oaz4Pbmzct8ryhLxhe+EdsivRxw/RgePW2821a/uZ5w8ILt/auZp7Ct8Qqb9g6/17XKA3BKnhK227yswirjvZtPc22yqwN912jxW6bQGW87xrx93mCuoBfNWs7JkKqIuaYeWcf04brn3ey1ITMsXrK7F9oWD1Ft+pUxPyeFXB8L1I5aJYsRnKbTcM9E5utyleQzUTVz2eSu8mKYb8km5jbLleI+xUZ4cJ+wHzgr8jqFzY85iNnfPe0vJn5uVff8mamuKMzGzrn27Xu9+3a4Bu2JddsWc3Erv4NaeWe3HTw6t9yV246Tkev3bB6V3UyfOWGDdvGU/HrNmzbFx8X0GzYvPE/asA14l+hubIhqqC4DS+UbsQc9Bpeq005S2g1vFx8c7LQani5uuikIWhohnR5wI3yqaOHnOG8ZLQpxVv1YYd1p5jhuiZOKN4sgNsrShl+F/0xxfsVfjtFoRE/yGqcfkdQwhgqyrRhmLY5tiJJjWbwvkfEcJeXOjyoNEWoVrYND4m3UJGqyla2DU+ZxUCRqoxY1DCWOv3pbsjqpCUNo4LfVqQrBBc0jAquioaylF/OMCG4KlKW8j9vmBjxk4LUSLUhm6CUIZ+gkCGjoIwhp6CIIaughCGvoIAhsyC/Ibcg+4jPLsjdhvyCzIYCgryGEoK8hoV93u83lDn+i9VQ4iGFIQwrDN2fN/z7bQhDGMIQhjCEYdnwvxrxPyKnljIadn6QgNOwMxKwGgoDwxZgKAMMW4ChDE/N2kiCoyA4eYTgPO/t/PPluyc6COrICc5kDybZ1jodhPP+u4LFg1qkofjXyR9jIgzFaaKl84Rkoen9FDci1Tmb0h5JqM6gNFo7m2R5zgVFbd8kW5nHZzJOx0MowNqhHHiL4+h2H7ARZvl4HvUHAtfD1yfpycyX6TPSfwCxE8o+JXhADwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs/ANyGFT0fw3sTAAAAABJRU5ErkJggg=="  class="mx-auto rounded"  title="{{ $health->title }} - {{ config('app.name') }}"  alt="{{ $health->title }} - {{ config('app.name') }}"> 
							     		@endif
							 		</div>
							 		<div class=" sm:px-4 py-4 sm:py-0 flex-1">

							 			<h2 class="font-bold group-hover:text-actionblue transition">{{$health->title}}</h2>
							 			<h3 class="text-sm text-gray-600">
							 				{{$health->short_text}}
							 			</h3>
							 			<div class="text-sm py-2 text-gray-700 ">
							 				<span class="text-gray-400">{{ date('d/M/y')}}</span> - <b>{{config('app.name')}}</b>
							 			</div>
							 		</div>
							 	</a>
							 </div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
