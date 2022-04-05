<div>
	<div class="row">
	    <div class="col-md-12 py-4">
	       <p class="py-4 bg-gray-100 px-3 d-flex justify-content-between" style="background: #efefef">
	           <a href='{{route("admin.news")}}'><button class="btn btn-default">Voltar</button></a>
	           <button class="btn btn-primary" wire:click='save'  onclick="$('.note-editable').focus();$('.note-editable').blur();">
	           		<span wire:loading.remove wire:target='save' >Salvar</span>
	           		<span wire:loading wire:target='save'>Salvando...</span>
	           </button>
	       </p>
	    </div>
	    <div class="col-md-5  mb-4 d-flex justify-content-center align-items-center cursor-pointer" style="cursor: pointer;" onclick="getElementById('cover').click()">
        	<span wire:loading wire:target='cover'> <img src="/img/loading.gif" alt=""> </span>
	    	@if( $cover )
	    		@error('cover') 
            		<span  wire:loading.remove wire:target='cover' class="text-danger font-sm pull-right">{{$message}}</span> 
            	@else
	    			<img wire:loading.remove wire:target='cover' src="{{$cover->temporaryUrl()}}" alt="" class="w-100">
	    		@enderror
	    	@elseif( $news->cover )
	    		<img wire:loading.remove wire:target='cover' src="{{asset('storage/'.$news->cover)}}" alt="" class="w-100">
	    	@else
		        <div wire:loading.remove wire:target='cover' >
		            <span> Selecione a capa</span>
		        </div>
	    	@endif
        	<input id='cover' wire:model='cover' type="file" class="hidden">
	    </div>
	    <div class="col-md-7">
	        <div class="pb-4">
	            <input type="text" wire:model='news.title' class="form-control"  placeholder="Título da Matéria" value="" required="">
	            <span class="@if( strlen($news->title) > 60 ) text-danger @endif font-sm">
	            	Recomendado 60 caracteres: {{strlen($news->title)}} 
	            	@if( strlen($news->title) > 60 )Não tem problema passar, só não é recomendado. @endif
	            </span>
	            @error('news.title') <span class="text-danger font-sm pull-right">{{$message}}</span> @enderror
	        </div>
	        <div class="pb-4">
	            <input type="text" wire:model='news.slug' class="form-control"  placeholder="link" value="" required="">
	            <span class="@if( strlen($news->slug) > 60 ) text-danger @endif font-sm">
	            	Recomendado 60 caracteres: {{strlen($news->slug)}} 
	            	@if( strlen($news->slug) > 60 )Não tem problema passar, só não é recomendado. @endif
	            </span>
	            @error('news.slug') <span class="text-danger font-sm pull-right">{{$message}}</span> @enderror
	        </div>
	        
	        <div class="pb-4">
	            <input type="date" wire:model.defer='news.date' class="form-control" value="{{date('Y-m-d')}}" required="">
	            @error('news.date') <span class="text-danger font-sm pull-right">{{$message}}</span> @enderror
	            
	        </div>
	        <div x-data='{modal:false}'class="p-4 mb-4" style="background: #efefef">
	        	<div class="d-flex justify-content-between w-100">
	        		<span class=""><b>Categorias:</b></span>
					<a href="#" wire:click='$toggle("manageCategories")'>{{ $manageCategories ? 'Fechar' : 'Gerenciar'}}</a>
	        	</div>
	            <div class="d-flex flex-wrap">
					@foreach($categoriesList as $category)
						<label for='category-{{$category->id}}' class="mx-2 d-flex badge badge-secondary" @if( in_array($category->id,$categories) ) style='background:blue' @endif>
							@if( !$manageCategories )
								<input id='category-{{$category->id}}' class="hidden" type="checkbox" wire:keyup.enter='saveCategory' wire:model="categories" value='{{$category->id}}' >
							@endif
							<span>{{$category->name}}</span>
							@if( $manageCategories )
								<svg  wire:click='removeCategory({{$category->id}})' style='color:#fff;fill:#fff;width:14px; height: 14px; cursor: pointer;' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
							@endif
						</label>
					@endforeach
					@if( !$manageCategories )
						<div class="d-flex">
							<input wire:model='newCategory' wire:keyup.enter.prevent='saveCategory' type="text" placeholder="Nova categoria +" style="background: transparent;border:none;border-bottom: 2px solid #ccc">
							@error('newCategory') {{ $message }} @enderror
						</div>
					@endif
				</div>

				
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="pb-4">
			    <input type="text" wire:model='news.short_text'  class="form-control"  placeholder="Chamada" value="" required="">
	            <span class="@if( strlen($news->short_text) > 150 ) text-danger @endif font-sm">
	            	Recomendado 150 caracteres: {{strlen($news->short_text)}} 
	            	@if( strlen($news->short_text) > 150 )Não tem problema passar, só não é recomendado. @endif
	            </span>
	            @error('news.short_text') <span class="text-danger font-sm pull-right">{{$message}}</span> @enderror
			</div>
		</div>
	</div>
	<div class="row" wire:ignore>
	    <div class="col-md-12">
	        <textarea  name='text' wire:model='news.text' id="summernote"></textarea>
	    </div>
	</div>

	<div class="row mb-10" style="margin-bottom: 20px">
		<div x-data='{removeConfirm:false}' class="col-md-12">
			<button x-show='removeConfirm == false' @click='removeConfirm = true' class="btn btn-default">
				<svg style='width:14px; height: 14px;' fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
			</button>
			<div x-show='removeConfirm' @click.away='removeConfirm = false'>
				<button  @click='removeConfirm = false' class="btn btn-default">Epa, pera! Caaalma...</button>
				<button  wire:click='remove' class="btn btn-danger">Remover, mesmo!</button>
			</div>
		</div>
	</div>

	<script>
	    $(document).ready(function() {
	        $('#summernote').summernote({
                imageTitle: {
                  specificAltField: true,
                },
                lang: 'pt-BR',
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },
	            tabsize: 2,
	            minHeight:400,
	            callbacks: {
                    onBlur: function(contents) {
                    	var textareaValue = $('#summernote').summernote('code');
                    	@this.set('news.text', textareaValue);
                    }
                },
	        });
	    });
	    $(document).ready(function() {
	      $(window).keydown(function(event){
	        if(event.keyCode == 13) {
	          event.preventDefault();
	          return false;
	        }
	      });
	    });
	</script>
</div>
