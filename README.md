# Movie Placeholder

## Présentation

Le site Movie Placeholder a pour but de pouvoir consulter différents films et d'y laisser des notes.

Ce site permet aux utilisateurs de :
- Consulter des films
- Donner une note et un commentaire sur un film
- Accéder aux profils des différents utilisateurs
- Modifier les informations de son profil

Les administrateurs peuvent :
- Bénéficier des mêmes fonctionnalités que les utilisateurs
- Bannir et dé-bannir un utilisateur
- Supprimer un commentaire
- Promouvoir un utilisateur au rang d'admin

## Installation

**Cloner le projet**
```bash
git clone git@github.com:/Junaagnah/projet-php.git
```

**Installer les dépendances** (requiert [composer](https://getcomposer.org/download/))
```bash
composer install
```

## Développement

**Lancer le projet** (dans le répertoire racine de ce dernier)
```bash
 php -S localhost:8000 -t public
```

**Créer une migration**
```bash
php artisan make:migration nomMigration
```

**Lancer les migrations**
```bash
php artisan migrate
```

## Branches

Les branches doivent commencer par un des préfixes suivants :
* feature/
* fix/
* refactor/
