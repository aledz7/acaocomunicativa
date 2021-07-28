@extends('layouts.website')

@section('styles')
<link rel="stylesheet" href="/css/socialshare.css">
<link rel="stylesheet" href="/font/fontello/css/fontello.css">

@endsection

@section('content')
<div class="py-8 pb-40 max-w-6xl mx-auto px-8 lg:px-0">
	<div class="md:flex">
		<div class="md:pr-10 flex-1">
			<div class="text-4xl font-bold mb-10">
				Vídeos {{@$category->name}}
				<div class="border-b-2 border-actionblue w-20"></div>
			</div>
			<div class="space-y-10">
				@if( $videos ) 
					@foreach($videos as $key => $video )
						<div class="sm:flex ">
							<div class="w-full h-52  overflow-hidden sm:w-4/12 sm:h-48" >
								<img src="{{ asset('/storage/'.$video->cover) }}" alt="{{$video->slug}} - {{config('app.name')}}" title="{{$video->slug}} - {{config('app.name')}}" class="w-full">
							</div>
							<div class="w-full pt-6 sm:pt-0 sm:w-8/12 sm:px-6 group flex flex-col justify-between">
								<a href="{{route('reading',$video->slug)}}">
									<p>
										@foreach( $video->categories as $category)
											<span class="text-actionblue font-bold text-sm">{{$category->name}}</span>
										@endforeach
									</p>
									<p class="group-hover:text-actionblue transition duration-500 ease-in-out font-bolt text-xl text-black font-bold">{{$video->title}}</p>
									<p class="group-hover:text-actionblue transition duration-500 ease-in-out text-sm text-gray-800 py-4">
										{{$video->short_text}}
									</p>
								</a>
								@include('social-share',['news'=>$video])
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
				<a href="{{ route('videos') }}" class="py-2 px-1 hover:bg-gray-100 hover:text-actionblue cursor-pointer w-full block">
					Todas ({{App\Models\Video::count()}})
				</a>
				@foreach( App\Models\Category::whereHas('videos')->get() as $category)
					<a href="{{ route('videos.category', ['slug'=>$category->slug]) }}" class="py-2 px-1 hover:bg-gray-100 hover:text-actionblue cursor-pointer w-full block">
						{{$category->name}} ({{$category->videos->count()}})
					</a>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/js/socialshare.js"></script>
<script>
	jQuery(function($) {
	  var targets = ['Facebook', 'LinkedIn', 'Twitter', 'Google+'];
	  $('.popup').BEShare({
	    'class': 'popup-share',
	    //'targets': 'Facebook,Twitter|Print,Email',
	    'targets': targets,
	    'via': 'BrandExtract'
	  });

	  $('.inline-share').BEShare({
	    'type': 'inline',
	    'targets': targets.concat(['|', 'Print', 'Email']),
	    'via': 'BrandExtract',
	    'altLink': true,
	    'onShare': function(targetName) {
	      ga('send', 'event', 'Social', 'Click', 'Share', targetName);
	    }
	  });
	});
</script>


@endsection

