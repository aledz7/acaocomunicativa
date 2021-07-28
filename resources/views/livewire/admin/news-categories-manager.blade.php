
<div>
	<div id='modal' class='modal fade' wire:ignore >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="btn btn-default" data-dismis='modal'></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						    <table class="table table-striped">
								@foreach($categoriesList as $category)
									<tr>
										<td>{{$category->name}}</td>
										<td><a href='#' wire:click='removeCategory({{$category->id}})'>Remover</td>
									</tr>
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
    
</div>
