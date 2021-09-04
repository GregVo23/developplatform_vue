@component('mail::message')
# {{ $mailData['title'] }}

<b>Message</b> : {{ $mailData['texte'] }} <br>
<b>Nom</b> : {{ $mailData['name'] }} <br>
<b>Email</b> : {{ $mailData['email'] }} 


Bien à vous,<br>
{{ config('app.name') }}
@endcomponent