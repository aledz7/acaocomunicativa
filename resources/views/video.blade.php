@extends('layouts.website')

@section('content')
<div class="pt-8 max-w-6xl mx-auto px-8 lg:px-0">
	<div class="md:flex mb-40">
		<div class="md:pr-10 flex-1">
			@if( $video == null	)
				<p class="w-full p-4 text-center bg-gray-100 block">Vídeo não encontrado</p>
			@else
				<div class="text-4xl font-bold text-center">
					{{$video->title}}
					<div class="border-b-2 border-blue-600 w-20 mx-auto"></div>
				</div>
				<div class="text-sm py-6 text-gray-500 text-center">
					{{ date('d/M/y',strtotime($video->date))}} - <b class='text-black'>{{config('app.name')}}</b>
				</div>

				<div>
					<img src="/{{$video->cover}}" alt=""/>
				</div>

				<div class="my-12 text-gray-500">
					{{$video->short_text}}
				</div>

				<div class="my-12 text-gray-600 space-y-8 mb-40">
					{!! $video->text !!}
				</div>
			@endif

		</div>
		
		<div class="pt-10 w-56 md:pt-0">
			<p class="text-2xl">Categorias</p>
			<div class="divide divide-y divide-gray-200">
				@foreach( App\Models\Category::whereHas('videos')->get() as $category)
					<a href="{{ route('category', ['slug'=>$category->slug]) }}" class="py-2 px-1 hover:bg-gray-100 hover:text-blue-700 cursor-pointer w-full block">
						{{$category->name}} ({{$category->video->count()}})
					</a>
				@endforeach
			</div>
		</div>
		
	</div>
</div>
@endsection