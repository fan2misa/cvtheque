cvtheque

CVThèque est une simple application de bibliothèque de CV. L'application permet de créer, publier,
partager et télécharger son CV.

## Utilisation de Docker

Pour le développement du projet, nous utiliserons Docker. Rendez-vous dans le dossier
`.docker` de votre projet.

Commencez par créer un nouveau fichier `.env` et copiez collez le contenu du fichier
`.env.dist`.

Dans ce fichier, pensez à modifier la variable `COMPOSE_PROJECT_NAME`en fonction du
nom de votre projet.

Enfin lancer les container à l'aide de docker-compose :

```
docker-compose up -d
```

## Configuration de votre IDE

### PHPStorm

#### Docker

Vous pouvez configurer Docker sur votre IDE en cliquant sur `Run` > `Edit Configurations...`.

Dans la nouvelle fenêtre, cliquez sur le signe `+` en haut à gauche puis
`Docker` > `Docker-compose`.

Dans le champ `Name`, mettez `Start Application`.

Dans le champ `Compose file(s)`, allez chercher le fichier `.docker\docker-compose.yml`.

Enfin, cliquez sur OK.

Pour lancer vos container Docker, Sélectionnez `Start Application` puis cliquez sur
Run (icone play verte juste à droite).

#### Grunt

Pour le développement front (JS, SCSS), nous utilisons Grunt. pour le configurer, cliquez sur
`Run` > `Edit Configurations...`.

Dans la nouvelle fenêtre, cliquez sur le signe `+` en haut à gauche puis
`Docker` > `Grunt.js`.

Dans le champ `Name`, mettez `grunt dev`.
Dans le champ `Gruntfile`, indiquez le fichier `Gruntfile.js` qui se trouve à la racine du projet.
Dans le champ `Tasks`, mettez `dev`. Cette commande permet de compiler le Javascript et le SCSS. Un `watch` est
executé ensuite pour compiler le tout à chaque modification d'un fichier.

## Installation du projet

A la racine du projet, créer un nouveau fichier `.env.local` et copiez collez le contenu du
fichier `.env`.

Pensez à modifier la variable `DATABASE_URL` en fonction de votre configuration docker
(voir le fichier `.env` du dossier `.docker`).

Installez les dépendances du projet :

```
docker-compose run --rm composer install
```

Ensuite, vous pouvez initialiser l'application avec la commande suivante :

```
docker-compose run --rm php php bin/console app:init
```

Cette commande permet de :

* Supprimer la base de données si elle existe déjà
* Créer la base de données
* Créer le schéma de la base de données

La commande peut être executer avec l'option `--test` pour installer les fixtures.

## Créer un thème

L'application est unstallé avec un seul thème nommé Standard. Mais il vous est possible de créer votre propre
thème en lancant la commande suivante :

```
docker-compose run --rm php php bin/console make:themes
```

## Développement

Comme tout projet Symfony 4, le code source (Controller, Entité, Fixtures, ...) se trouvent dans le dossier `src`.

Les templates ce trouvent dans le dossier `templates`.

Le JS et SCSS se trouvent dans le dossier `assets`. Les fichiers compilé se trouvent dans le dossier `public`.
