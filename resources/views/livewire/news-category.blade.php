<div>
	@if( $addCategory )
		<div>
			<input wire:model='newCategory' wire:keyup.enter.prevent='saveCategory' type="text">
			<button wire:click='saveCategory' type="button">Adicionar</button>
			@error('newCategory') {{ $message }} @enderror
		</div>
	@else
		<div class="flex items-center space-x-4">
	    	@foreach($categories as $category)
	    		<div class="flex items-center space-x-2 bg-gray-200 rounded px-2">
	    			<input type="checkbox" name="categories[]" value='{{$category->id}}' @if( $obj->categories->contains($category->id) ) checked='checked'  @endif>
	    			<span>{{$category->name}}</span>
	    		</div>
	    	@endforeach
		    <a href="#" wire:click='$toggle("addCategory")'>Nova categoria</a>
		</div>
	@endif
</div>
