# Movie Placeholder

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
