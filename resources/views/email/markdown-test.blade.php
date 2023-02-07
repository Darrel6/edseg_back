
@component('mail::message')
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset("../../../public/images/logo_uac2.png") }}" alt="">
<span class="h1 fw-bold mb-0 ml-5">ED-SEG</span>
@endcomponent
@endslot
# Inscription

<p>Bonjour , {{ $data['name'] }}</p>
<p>Votre inscription a été valider avec succès. Voici Vos informations de connexion à votre compte. 
</p>
<h4>Email : {{ $data['email'] }}</h4>
<h4>Mot de Passe : {{ Crypt::decrypt($data['password']) }}</h4>



Merci,<br>
{{ config('app.name') }}
@endcomponent
