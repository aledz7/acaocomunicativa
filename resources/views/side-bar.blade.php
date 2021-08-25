<div>
	@include('block-newsletter')
	<div>
		<div>Últimas Notícias</div>
		<div>
			@foreach( \DB::table('news')->get()->take(3) as $newsBlock )
				<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
					<a href="{{$newsBlock->slug}}" class="flex"> 	
						<div>
							<img src="{{$newsBlock->cover}}" alt="" class="w-14">
						</div>
						<div class="flex-1 text-sm px-2">
							<p class="font-bold group-hover:text-actionblue transition line-clamp-2">{{$newsBlock->title}}</p>
							<div class="text-xs text-right italic text-gray-700">{{ date('d/M/y', strtotime($newsBlock->date) ) }}</div>
						</div>
					</a>
				</div>
			@endforeach
			@foreach( \DB::table('videos')->get()->take(3) as $newsBlock )
				<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
					<a href="{{$newsBlock->slug}}" class="flex"> 	
						<div>
							<img src="{{$newsBlock->cover}}" alt="" class="w-14">
						</div>
						<div class="flex-1 text-sm px-2">
							<p class="font-bold group-hover:text-actionblue transition line-clamp-2">{{$newsBlock->title}}</p>
							<div class="text-xs text-right italic text-gray-700">{{ date('d/M/y', strtotime($newsBlock->date) ) }}</div>
						</div>
					</a>
				</div>
			@endforeach
			@foreach( \DB::table('healths')->get()->take(3) as $newsBlock )
				<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
					<a href="{{$newsBlock->slug}}" class="flex"> 	
						<div>
							<img src="{{$newsBlock->cover}}" alt="" class="w-14">
						</div>
						<div class="flex-1 text-sm px-2">
							<p class="font-bold group-hover:text-actionblue transition line-clamp-2">{{$newsBlock->title}}</p>
							<div class="text-xs text-right italic text-gray-700">{{ date('d/M/y', strtotime($newsBlock->date) ) }}</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>
	</div>
</div>