@component('mail::message')
# {{ $mailData['title'] }}

Bonjour <b>{{ $mailData['name'] }} </b><br>

Nous avons une bonne nouvelle pour vous !<br>

{{ $mailData['texte'] }} <br>

Vous avez accepté de recevoir des notifications sur votre adresse email : {{ $mailData['email'] }} 


Bien à vous,<br>
{{ config('app.name') }}
@endcomponent