@extends('layouts.summernote')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 pt-4">
           <h2>Adicionando notícias</h2>
           <hr class="m-0">
        </div>
    </div>
    
    @livewire('admin.news-create-form')

    

</div>
@endsection
