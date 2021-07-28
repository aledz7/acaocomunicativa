<div class="py-6">
	@if( $type == 'news' )
		<div class="text-lg border-b font-bold">Últimas notícias</div>
		@foreach( App\Models\News::orderBy('date','desc')->get()->take(10) as $newsBlock )
			<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
				<a href="{{$newsBlock->slug}}" class="flex"> 	
					<div>
						<img src="{{$newsBlock->coverImg}}" alt="" class="w-14">
					</div>
					<div class="flex-1 text-sm px-2">
						<p class="font-bold group-hover:text-actionblue transition">{{$newsBlock->title}}</p>
						<div class="text-xs text-right">{{ $newsBlock->dateDisplay }}</div>
					</div>
				</a>
			</div>
		@endforeach
	@endif
	@if( $type == 'videos' )
		<div class="">Últimos videos</div>
		@foreach( App\Models\Video::orderBy('date','desc')->get()->take(10) as $newsBlock )
			<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
				<a href="{{$newsBlock->slug}}" class="flex"> 	
					<div class=" text-sm">
						<p class="font-bold group-hover:text-actionblue transition">{{$newsBlock->title}}</p>
					</div>
				</a>
			</div>
		@endforeach
	@endif
</div>