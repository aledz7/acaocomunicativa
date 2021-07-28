@component('mail::message')
# Olá

{{$from['name']}} ({{$from['email']}}) viu essa matéria e lembrou de você.


<p style="background: #efefef;padding: 10px ">{{$comments}}</p>


# {{$news->title}}
{{$news->short_text}}

@component('mail::button', ['url' => config('app.url').'/'.$news->slug])
Clique aqui para ler
@endcomponent

Obrigado =)<br>
{{ config('app.name') }}
@endcomponent
