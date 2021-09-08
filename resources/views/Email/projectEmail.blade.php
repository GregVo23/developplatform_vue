@component('mail::message')
# {{ $mailData['title'] }}

Bonjour <b>{{ $mailData['name'] }} </b><br>

Féllicitation !<br>
Votre offre de prix a été acceptée ! Vous pouvez dès à présent entrer en contact avec l'auteur du projet en vue de la réalisation.<br>
Menez au mieux la réalisation de ce projet afin de recevoir en échange une bonne notification de l'auteur.<br><br>
<b>Voici les informations du projet : </b><br>

<b>l'auteur</b> : {{ $mailData['author'] }} <br>
<b>Le projet</b> : {{ $mailData['project'] }} <br>
<b>Le montant convenu</b> : {{ $mailData['amount'] }} <br>
<b>La deadline</b> : {{ $mailData['deadline'] }} <br>
<b>Telephone</b> : {{ $mailData['phone'] }} <br>
<b>Email</b> : {{ $mailData['email'] }} <br>

Vous avez accepté de recevoir des notifications sur votre adresse email : {{ $mailData['email'] }} 

Nous vous remercions pour votre sérieux et vous souhaitons beaucoup de succès.

Bien à vous,<br>
{{ config('app.name') }}
@endcomponent