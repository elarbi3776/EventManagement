# Events

## Description
**Events** est une application de gestion d'événements développée en Laravel. Elle permet aux utilisateurs de créer, organiser, et suivre divers événements, tout en offrant une interface conviviale pour les participants et les organisateurs. L'application est conçue pour fonctionner dans un environnement local.

## Fonctionnalités
- Création d'événements avec détails et images.
- Gestion des participants et des rôles (organisateur, participant, administrateur).
- Réservation de tickets avec génération de PDF et QR code.
- Notifications en temps réel via Pusher.
- Intégration d'une carte pour la localisation des événements.
- Tableau de bord pour l'administration des événements.

## Prérequis
- PHP 8.x ou plus récent
- Composer
- MySQL
- Node.js et NPM (pour la gestion des assets)
- Laravel 10.x

## Installation

1. **Cloner le repository :**
   ```bash
   git clone https://github.com/elarbi3776/EventManagement
   cd repository
   composer install
   cp .env.example .env
Modifiez le fichier .env pour correspondre à votre configuration locale.
Créer et configurer le base de données.
    php artisan migrate
    php artisan serve
L'application sera accessible à l'adresse suivante :
http://127.0.0.1:8000


