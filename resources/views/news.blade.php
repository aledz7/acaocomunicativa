@extends('layouts.website')

@section('styles')
<link rel="stylesheet" href="/css/socialshare.css">
<link rel="stylesheet" href="/font/fontello/css/fontello.css">

@endsection

@section('content')
<div class="py-8 max-w-6xl mx-auto px-8 lg:px-0">
	<div class="md:flex">
		<div class="md:pr-10 flex-1">
			<div class="text-xl font-bold mb-10 ">
				Notícias {{@$category->name}}
				<div class="border-b-2 border-actionblue w-20"></div>
			</div>
			<div class="space-y-14">
				@if( $news ) 
					@foreach($news as $key => $news )
						<div class="sm:flex ">
							<div class="w-full h-52  overflow-hidden sm:w-4/12 sm:h-48" >
								<img src="{{ $news->coverImg }}" alt="{{$news->slug}} - {{config('app.name')}}" title="{{$news->slug}} - {{config('app.name')}}" >
							</div>
							<div class="w-full pt-6 sm:pt-0 sm:w-8/12 sm:px-6 group flex flex-col justify-between">
								<a href="{{route('reading',$news->slug)}}">
									<p>
										@foreach( $news->categories as $category)
											<span class="text-actionblue font-bold text-sm">{{$category->name}}</span>
										@endforeach
									</p>
									<p class="group-hover:text-actionblue transition duration-500 ease-in-out font-bolt text-xl text-black font-bold">{{$news->title}}</p>
									<p class="group-hover:text-actionblue transition duration-500 ease-in-out text-sm text-gray-800 py-4">
										{{$news->short_text}}
									</p>
								</a>
								@include('social-share')
							</div>
						</div>
						<hr>
					@endforeach
				@else
					<p class="w-full p-4 text-center bg-gray-100 block">Sem notícias</p>
				@endif
			</div>
		</div>
		<div class="pt-10 w-56 md:pt-0">
			<p class="text-2xl">Categorias</p>
			<div class="divide divide-y divide-gray-200">
				<a href="{{ route('noticias') }}" class="py-2 px-1 hover:bg-gray-100 hover:text-blue-700 cursor-pointer w-full block">
					Todas ({{App\Models\News::count()}})
				</a>
				@foreach( App\Models\Category::whereHas('news')->get() as $category)
					<a href="{{ route('news.category', ['slug'=>$category->slug]) }}" class="py-2 px-1 hover:bg-gray-100 hover:text-actionblue cursor-pointer w-full block">
						{{$category->name}} ({{$category->news->count()}})
					</a>
				@endforeach
			</div>
			@include('block-newsletter')
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>
		function openPopUp(url, title) {
		    var w = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width,
	  		h = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height,
	      	left = (w / 2) - (400 / 2) +  10,
	      	top  = (h / 2) - (400 / 2) +  50;
		    window.open(url, title, "scrollbars=yes, width=" + 300 + ", height=" + 400 + ", top=" + top + ", left=" + left).focus();
	  	}
</script>


@endsection

