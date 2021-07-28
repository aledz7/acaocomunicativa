<div>
	@if( $image )
		<div>
			<img src="{{$image->temporaryUrl()}}" alt="" class="w-80 h-48">
		</div>
	@else
    	<div onclick='getElementById("cover").click()' class="border-4 border-dashed border-gray-300 cursor-pointer hover:bg-gray-50 flex w-80 h-48  flex  justify-center items-center"> Capa </div>
	@endif
	<input wire:model='image' name="cover" type="file" id='cover' class="hidden">
</div>
