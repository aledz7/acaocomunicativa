@extends('layouts.website')

@section('styles')
<link rel="stylesheet" href="/css/socialshare.css">
<link rel="stylesheet" href="/font/fontello/css/fontello.css">

@endsection

@section('content')
<div class="py-8 pb-40 max-w-6xl mx-auto px-8 lg:px-0">
	<div class="md:flex">
		<div class="md:pr-10 flex-1">
			<div class="sm:mx-auto  sm:px-8 mb-8 lg:px-0">
				<div class=" max-w-6xl text-3xl font-semibold mb-2 text-left mx-auto">
					Vídeos
					<div class="w-40 h-1 bg-gradient-to-br from-actionblue to-red-700"></div>
				</div>
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
									<p class="group-hover:text-actionblue transition duration-500 ease-in-out font-bolt text-xl text-black font-bold">{{$video->title}}</p>
									<p class="group-hover:text-actionblue transition duration-500 ease-in-out text-sm text-gray-800 py-4">
										{{$video->short_text}}
									</p>
								</a>
								<div x-data='{sendMail:false}' class="text-center sm:flex sm:items-center sm:justify-between p-2 rounded sm:space-x-4">
									<div class="text-sm py-2 text-gray-700">
										<span class="text-gray-400">{{ date('d/M/y', strtotime($video->date))}}</span> - <b class="text-black">{{config('app.name')}}</b>
									</div>
									<div class="flex justify-center sm:justify-end mx-auto">
										<a 
											href="https://api.whatsapp.com/send?text={{ config('app.url')}}/{{$video->slug}}  - {{ config('app.name')}} - {{$video->title}}"
											class="text-gray-700 mx-1 hover:text-green-700 cursor-pointer transition duration-300 ease-in-out" 
											target="_blank" 
											>
											<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 128 128" width="22px" height="22px"><path d="M 64 2 C 29.8 2 2 29.8 2 64 C 2 74.5 4.5992188 84.800391 9.6992188 93.900391 L 4.4003906 113.30078 C 3.5003906 116.40078 4.3992188 119.60039 6.6992188 121.90039 C 8.9992188 124.20039 12.200781 125.10078 15.300781 124.30078 L 35.5 119 C 44.3 123.6 54.099609 126 64.099609 126 C 98.299609 126 126.09961 98.2 126.09961 64 C 126.09961 47.4 119.7 31.899219 108 20.199219 C 96.2 8.4992187 80.6 2 64 2 z M 64 8 C 79 8 93.099609 13.800391 103.59961 24.400391 C 114.19961 35.000391 120.1 49.1 120 64 C 120 94.9 94.9 120 64 120 C 54.7 120 45.399219 117.59922 37.199219 113.19922 C 36.799219 112.99922 36.300781 112.80078 35.800781 112.80078 C 35.500781 112.80078 35.3 112.80039 35 112.90039 L 13.699219 118.5 C 12.199219 118.9 11.200781 118.09922 10.800781 117.69922 C 10.400781 117.29922 9.6 116.30078 10 114.80078 L 15.599609 94.199219 C 15.799609 93.399219 15.700781 92.600391 15.300781 91.900391 C 10.500781 83.500391 8 73.8 8 64 C 8 33.1 33.1 8 64 8 z M 64 17 C 38.1 17 17 38 17 64 C 17 72.3 19.200781 80.4 23.300781 87.5 C 24.900781 90.3 25.3 93.599219 24.5 96.699219 L 21.599609 107.19922 L 32.800781 104.30078 C 33.800781 104.00078 34.800781 103.90039 35.800781 103.90039 C 37.800781 103.90039 39.8 104.40039 41.5 105.40039 C 48.4 109.00039 56.1 111 64 111 C 89.9 111 111 89.9 111 64 C 111 51.4 106.09922 39.599219 97.199219 30.699219 C 88.399219 21.899219 76.6 17 64 17 z M 43.099609 36.699219 L 45.900391 36.699219 C 47.000391 36.699219 48.099219 36.799219 49.199219 39.199219 C 50.499219 42.099219 53.399219 49.399609 53.699219 50.099609 C 54.099219 50.799609 54.300781 51.699219 53.800781 52.699219 C 53.300781 53.699219 53.100781 54.299219 52.300781 55.199219 C 51.600781 56.099219 50.699609 57.100781 50.099609 57.800781 C 49.399609 58.500781 48.6 59.300781 49.5 60.800781 C 50.4 62.300781 53.299219 67.1 57.699219 71 C 63.299219 76 68.099609 77.600781 69.599609 78.300781 C 71.099609 79.000781 71.900781 78.900391 72.800781 77.900391 C 73.700781 76.900391 76.5 73.599609 77.5 72.099609 C 78.5 70.599609 79.500781 70.900391 80.800781 71.400391 C 82.200781 71.900391 89.400391 75.499219 90.900391 76.199219 C 92.400391 76.899219 93.399219 77.300391 93.699219 77.900391 C 94.099219 78.700391 94.100391 81.599609 92.900391 85.099609 C 91.700391 88.499609 85.700391 91.899609 82.900391 92.099609 C 80.200391 92.299609 77.699219 93.300391 65.199219 88.400391 C 50.199219 82.500391 40.7 67.099609 40 66.099609 C 39.3 65.099609 34 58.100781 34 50.800781 C 34 43.500781 37.799219 40 39.199219 38.5 C 40.599219 37 42.099609 36.699219 43.099609 36.699219 z"/></svg>
										</a>
										<a rel="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Facaocomunicativa.test%2Fnoticias%2F%2Ffilantropicas-ja&amp;t=A%C3%A7%C3%A3o%20Comunicativa" 
											title="Share this page on Facebook" 
											onclick='openPopUp($(this).attr("rel"), $(this).attr("title"))'
											class="text-gray-700 mx-1 hover:text-blue-700 cursor-pointer transition duration-300 ease-in-out" 
											aria-label="Share on facebook">
											<svg class="w-5 h-5" fill='currentColor' viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<title>Facebook icon</title>
												<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
											</svg>
										</a>


										<a rel="https://www.linkedin.com/shareArticle?mini=true&url={{config('app.url')}}&title={{$video->title}}&summary=undefined&source=" 
											title="Share this page on Facebook" 
											onclick='openPopUp($(this).attr("rel"), $(this).attr("title"))'
											class="text-gray-700 mx-1 hover:text-blue-700 cursor-pointer transition duration-300 ease-in-out" 
											aria-label="Share on Instagram">
											<svg class="w-5 h-5" fill='currentColor' viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<title>LinkedIn icon</title><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
											</svg>
										</a>
										
										<a rel="https://twitter.com/home?status={{config('app.url')}}%2F{{$video->slug}}" 
											title="Share this page on Facebook" 
											onclick='openPopUp($(this).attr("rel"), $(this).attr("title"))'
											class="text-gray-700 mx-1 hover:text-blue-700 cursor-pointer transition duration-300 ease-in-out" 
											aria-label="Share on Instagram">
											<svg class="w-5 h-5" fill='currentColor' viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<title>Twitter icon</title>
												<path xmlns="http://www.w3.org/2000/svg" d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
											</svg>
										</a>
										<a 
											href="/print-{{$video->slug}}"
											class="text-gray-700 mx-1 hover:text-blue-700 cursor-pointer transition duration-300 ease-in-out" 
											target="_blank" 
											>
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
										</a>
										@livewire('send-to-mail',['id'=>$video->id,'title'=>$video->title,'short_text'=>$video->short_text])
									</div>
								</div>
							</div>
						</div>
						<hr>
					@endforeach
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

