@component('mail::message')
# Olá

Você foi cadastrado como {{$user->statusName}} no Portal.

Seguem seus dados de acesso

<b>Usuário:</b> {{$user->email}}

<b>Senha:</b> {{$password}}

@component('mail::button', ['url' => config('app.url').'/admin'])
Acessar Portal
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
