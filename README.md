# Bienvenue sur Developplatform !

![Developplatform](https://www.vanossel.be/images/logos.jpg)

## Introduction

Ce projet est une réalisation dans le cadre de mon travail de fin de formation à l'EPFC dans la section Web Developer.
Il a été réalisé durant la période Août - Septembre 2021.

## A propos

Developplatform est un site web d’appel d’offres pour des projets divers, mais essentiellement à caractère visuel, destinés à des graphistes, designers, développeurs ou artistes.

<b>L’internaute</b> peut consulter la page d'accueil et avoir un bref apperçu de 3 demandes, il peut également contacter l'administration du site au moyen d'un formulaire. 
<b>Le membre</b> peut souscrire à deux types d'abonnements. (en passant notamment par une plateforme de paiement en ligne comme Stripe)</br>
<b>Le membre </b> peut déposer des projets, leur attribuer un prix, donner un exemple du résultat attendu. Une communauté, enregistrée préalablement, pourra y répondre en proposant leurs tarifs, ou simplement accepter l’offre. Les notifications e-mail sont proposées et permettent de bénéficier d’avertissements par e-mail en cas d’offre ou d’acceptation.
De plus, quand un projet est mené à terme, celui-ci se verra attribué une appréciation qui déteindra sur l’auteur de la réalisation.

## Information complémentaires

Le projet est réalisé avec le framework back-end (PHP, programmation orientée objet) Laravel 8.x Breeze (starter kit pour l'authentification).</br>
Ainsi, Tailwind est le framework css utilisé.</br>
Quant au front-end, c'est le framework vue.js qui est exploité dans sa version 3.
Pour ce qui est de la partie paiement, elle est prise en charge par Stripe.

-   **[Laravel](https://laravel.com/)**
-   **[Vue js](/https://vuejs.org//)**
-   **[Tailwind css](https://tailwindcss.com/)**
-   **[Stripe](/https://stripe.com/fr-be/)**

### Ce projet requiert PHP version 7.4 < 8.
### Ce projet requiert NODE JS version 12.

![Tables relations](https://www.vanossel.be/images/db.jpg)

## Installation

Pour récupérer les fichiers depuis Github:

### `git clone https://github.com/GregVo23/developplatform_vue.git`
Renommer le fichier .env.example en .env

Pour installer les dépendances, lancer successivement depuis la racine du fichier :

### `composer install`

### `npm install`

Afin de compiler les dossiers CSS & Javascript :

### `npm run dev`

Créer une base de données et renseigner le nom de celle-ci dans le fichier .env
Afin de générer la base de données :

### `php artisan migrate`

Afin de remplir la base de données :

### `php artisan db:seed`

Afin de pouvoir uploadés des images et fichiers :

### `php artisan cache:clear`

### `php artisan storage:link`

Ajouter les clés STRIPE de votre compte STRIPE au fichier .env

+ STRIPE_KEY
+ STRIPE_SECRET

Compléter les différentes adresses e-mails du fichier .env :

+ APP_POLICE_EMAIL : email de réception pour les plaintes
+ APP_EMAIL : email de réception pour des informations

Compléter les champs de configuration d'envois e-mail du fichier .env

+ MAIL_ ...

Lancer le site en localhost

### `php artisan serve`

## Auteur
Gregory Van Ossel

## Github de l'auteur
https://github.com/GregVo23

## Licence

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Statut du projet

En cours de développement...

## Captures d'écran
![appercu1](https://www.vanossel.be/images/sc1.jpg)
![appercu1](https://www.vanossel.be/images/sc2.jpg)