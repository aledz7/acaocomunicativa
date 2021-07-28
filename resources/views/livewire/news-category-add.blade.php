<div class="d-flex flex-wrap">
	@foreach($categories as $category)
		<span class="mx-2">
			<input type="checkbox" name="categories[]" value='{{$category->id}}' >
			<span>{{$category->name}}</span>
		</span>
	@endforeach
	<div class="d-flex">
		<input wire:model='newCategory' wire:keyup.enter.prevent='saveCategory' type="text">
		<button wire:click='saveCategory' type="button">Adicionar</button>
		@error('newCategory') {{ $message }} @enderror
	</div>
</div>
