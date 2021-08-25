<div>
	<div class="py-6">
	<div class="flex-1 text-center bg-gray-100 py-4 px-2">
		<div class="text-xl font-bold mb-2 text-center">
			Newsletter
		</div>
		<div class="mb-6 text-sm">
			Cadastre-se para receber notícias no seu e-mail toda semana.
		</div>
		<a href='{{route("newsletter")}}'><button class="bg-actionblue px-2 py-1 rounded uppercase font-bold text-white">Cadastrar-se</button></a>
	</div>
</div>

	<div>
		<div>Últimas Notícias</div>
		<div>
			@foreach( \DB::table('news')->get()->take(3) as $newsBlock )
				<div class="hover:bg-gray-50 py-4  border-b border-dashed border-gray-300 group">
					<a href="{{$newsBlock->slug}}" class="flex"> 	
						<div>
							<img src="{{\Storage::url($newsBlock->cover)}}" alt="" class="w-14">
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
							<img src="{{\Storage::url($newsBlock->cover)}}" alt="" class="w-14">
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
							<img src="{{\Storage::url($newsBlock->cover)}}" alt="" class="w-14">
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