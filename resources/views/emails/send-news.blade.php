@component('mail::message')
# Olá

@if( $type == 'news')
Publicamos mais uma nota no portal da Ação Comunicativa
@endif

@if( $type == 'video')
Publicamos mais um vídeo no portal da Ação Comunicativa
@endif

@if( $type == 'boletim')
Publicamos mais um boletim no portal da Ação Comunicativa
@endif

Mantenha-se informado sobre os destaques no setor da saúde

# {{$news->title}}
{{$news->short_text}}

@if( $type == 'boletim')
@component('mail::button', ['url' => config('app.url').'/boletim-ac-saude-'.$news->id])
Clique aqui para ler
@endcomponent
@else
@component('mail::button', ['url' => config('app.url').'/'.$news->slug])
Clique aqui para ler
@endcomponent
@endif

Obrigado =)<br>
{{ config('app.name') }}
@endcomponent
