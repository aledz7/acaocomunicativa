@extends('layouts.website')

@section('styles')
<link rel="stylesheet" href="/css/socialshare.css">
<link rel="stylesheet" href="/font/fontello/css/fontello.css">
@endsection

@section('title')
	Case {{@$category->name}}
@endsection

@section('content')
<div class="py-8 max-w-6xl mx-auto px-8 lg:px-0">
	<div class="md:flex">
		<div class="md:pr-10 flex-1">
			<div class="sm:mx-auto  sm:px-8 mb-8 lg:px-0">
				<div class=" max-w-6xl text-3xl font-semibold mb-2 text-left mx-auto">
					Case
					<div class="w-40 h-1 bg-gradient-to-br from-actionblue to-red-700"></div>
				</div>
			</div>
			<div class="space-y-14">
				@if( $reports )

					<div class="grid grid-cols-3 gap-20">
						@foreach( $reports as $report )
						<a href="{{ route('report', ['slug'=>$report->slug] ) }}">
							<div class="">
								<div class="w-full min-h-80 bg-gray-100 mb-4">
									{!! $report->cover_image !!}
								</div>
								<div class="font-bold font-sm">{{$report->title}}</div>
								<div class="text-gray-400 text-sm italic">{{$report->date_display}}</div>
							</div>
						</a>
						@endforeach

					</div>
				@else
					<p class="w-full p-4 text-center bg-gray-100 block">Sem notícias</p>
				@endif
			</div>
		</div>
		<div class="pt-10 sm:w-56 md:pt-0">
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

