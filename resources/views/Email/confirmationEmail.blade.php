@component('mail::message')
# {{ $mailData['title'] }}

Bonjour <b>{{ $mailData['name'] }} </b><br>

Vous avez accepté l'offre de prix !<br>
Vous pouvez dès à présent entrer en contact avec l'auteur de l'offre en vue de la réalisation.<br>
N'oubliez pas, une fois le projet terminé, de clôturer le projet et de donner une appréciation sur le travail effectué.<br><br>
<b>Voici les informations sur l'auteur : </b><br>

<b>l'auteur de l'offre</b> : {{ $mailData['author'] }} <br>
<b>Le projet</b> : {{ $mailData['project'] }} <br>
<b>Le montant convenu</b> : {{ $mailData['amount'] }} <br>
<b>La deadline prévue</b> : {{ $mailData['deadline'] }} <br>

Vous avez accepté de recevoir des notifications sur votre adresse email : {{ $mailData['email'] }} 

Nous vous remercions pour votre sérieux et vous souhaitons beaucoup de succès.

Bien à vous,<br>
{{ config('app.name') }}
@endcomponent