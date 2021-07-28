<div>
    <div class="bg-white rounded space-y-5 p-6">
        <div class="bg-gray-100 px-3 py-2 text-right flex justify-between">
            <a href='{{route("admin.videos")}}'><button type='button' class="bg-white  rounded px-2 py-1">Voltar</button></a>
            <button wire:click='save' class="bg-blue-600 text-white rounded px-2 py-1" wire:load.class='disabled'>
                <span wire:loading.remove wire:target='save'>Salvar</span>
                <span wire:loading wire:target='save'>Salvando...</span>
            </button>
        </div>
        <div class=" py-4 grid grid-cols-3 gap-10">
            <div class="flex justify-center items-center cursor-pointer" onclick="getElementById('cover').click()">
                <input wire:model='cover' name="cover" type="file" id='cover' class="hidden" >
                <div>
                    <span wire:loading wire:target='cover'> <img src="/img/loading.gif" alt=""> </span>
                </div>
                @if( $cover )
                    <div class="text-center">
                        @error('cover') 
                            <span  wire:loading.remove wire:target='cover' class="text-red-600 text-sm float-right">{{$message}}</span> 
                        @else
                            <img wire:loading.remove wire:target='cover' src="{{$cover->temporaryUrl()}}" alt="" class="w-100">
                        @enderror
                    </div>
                @else
                    <div class="cursor-pointer hover:bg-gray-50 flex w-full  justify-center items-center"> 
                        <span wire:loading.remove wire:target='cover'>Seleciona a capa</span>
                    </div>
                @endif
            </div>
           <div class="col-span-2 space-y-5">
                <div>
                    <input type="text" wire:model='title'  placeholder="Titulo"  class="w-full text-2xl ">
                    <span class="@if( strlen($title) > 60 ) text-red-600 @endif text-xs text-gray-500">
                        Recomendado 60 caracteres: {{strlen($title)}} 
                        @if( strlen($title) > 60 )Não tem problema passar, só não é recomendado. @endif
                    </span>
                    @error('title') <span class="text-red-600 text-sm float-right">{{$message}}</span> @enderror
                </div>
                <div>
                    <input type="text" wire:model='slug'  placeholder="Link da pagina"  class="w-full text-2xl ">
                    <span class="@if( strlen($slug) > 60 ) text-red-600 @endif text-xs text-gray-500">
                        Recomendado 60 caracteres: {{strlen($slug)}} 
                        @if( strlen($slug) > 60 )Não tem problema passar, só não é recomendado. @endif
                    </span>
                    @error('slug') <span class="text-red-600 text-sm float-right">{{$message}}</span> @enderror
                </div>
                <div>
                    <input type="text" wire:model='short_text'  placeholder="Chamada"  class="w-full ">
                    <span class="@if( strlen($short_text) > 60 ) text-red-600 @endif text-xs text-gray-500">
                        Recomendado 155 caracteres: {{strlen($short_text)}} 
                        @if( strlen($short_text) > 155 )Não tem problema passar, só não é recomendado. @endif
                    </span>
                    @error('short_text') <span class="text-red-600 text-sm float-right">{{$message}}</span> @enderror
                </div>
                <div>
                    <input type="date" wire:model='date'  placeholder="Titulo"  class="w-full ">
                    @error('date') <span class="text-red-600 text-sm float-right">{{$message}}</span> @enderror
                </div>
                <div>
                    <input type="text" wire:model='link'  placeholder="link do video"  class="w-full ">
                    @error('link') <span class="text-red-600 text-sm float-right">{{$message}}</span> @enderror

                </div>
                <div class="p-4 mb-4" style="background: #efefef">
                    <div class="flex justify-between mb-4">
                        <span class=""><b>Categorias:</b></span>
                        <a href="#" wire:click='$toggle("manageCategories")'>{{ $manageCategories ? 'Fechar' : 'Gerenciar'}}</a>
                    </div>
                    <div class="flex flex-wrap">
                        @foreach($categoriesList as $category)
                            <label for='category-{{$category->id}}' class="m-2 bg-gray-600 rounded px-2 text-sm text-white flex items-center cursor-pointer" @if( in_array($category->id,$categories) ) style='background:blue' @endif>
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
    </div>
    <div class="bg-white rounded my-8 p-6">
        @if( $link )
            <iframe src="{{$link}}" frameborder="0" class="w-full h-screen"></iframe>
        @endif
    </div>
</div>
