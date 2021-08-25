@extends('layouts.website')

@section('title')
	{{ucwords($reading->title)}} -
@endsection

@section('description')
	{{ucwords($reading->short_text)}} -
@endsection

@section('content')
<div class="pt-8 max-w-6xl mx-auto px-8 lg:px-0">
	<div class="md:flex">
		
		<div class="flex-1">
			<div class="max-w-2xl mx-auto bg-gray-50 py-2 px-4 mb-10" style="background: #f4f7f6">
				<div class="text-xl font-bold text-center mb-10">
					<h1>{{$reading->title}}</h1>
					<div class="border-b-2 border-actionblue w-20 mx-auto"></div>
				</div>

				<div class=" justify-center">
					@if( $type == 'news' || $type == 'healths') 
						<img src="/storage/{{$reading->cover}}" alt="{{$reading->title}}" title="{{$reading->title}}" class="mx-auto" />
					@else
            			<iframe src="{{$reading->link}}" frameborder="0" width="100%" height="400"></iframe>
					@endif
				</div>

				<div class="my-12 text-gray-500">
					{{$reading->short_text}}
				</div>

				<div class="my-12 text-gray-600 sm:mb-40 content-new">
					{!! $reading->text !!}
				</div>
			</div>
			<div class="max-w-2xl mx-auto bg-gray-50 py-2 px-4 mb-10" style="background: #f4f7f6">
				@include('social-share',['news'=>$reading])
			</div>
		</div>
		
		<div class="pt-10  sm:w-3/12 md:pt-0 mb-40 text-center sm:text-left">
			@include('side-bar')

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

