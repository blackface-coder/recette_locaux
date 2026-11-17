# Faso Ri Nondo

Faso Ri Nondo est un site de découverte et de partage des recettes des régions du Burkina Faso. Il propose une page d’accueil, des pages consacrées aux spécialités régionales et des formulaires pour contribuer au site.

## Fonctions du site

- **Découvrir les régions** : la page d’accueil (`web_recette/projet.html`) présente les 13 régions et mène vers une page de plats pour chacune (`R1.html` à `R13.html`).
- **Consulter les recettes partagées** : `web_recette/recettes.php` affiche les contributions enregistrées, de la plus récente à la plus ancienne.
- **Partager une recette** : `web_recette/recette.php` recueille le nom, le téléphone et la recette. Le traitement (`recette_cible.php`) vérifie les champs et enregistre la contribution dans la base de données.
- **Donner une appréciation** : `web_recette/appreciation.php` recueille le nom, le téléphone et un commentaire. Le traitement (`appreciation_cible.php`) enregistre l’avis et affiche un message de confirmation.
- **Naviguer sur mobile** : les pages récentes utilisent Bootstrap pour adapter la navigation et la mise en page aux petits écrans.

## Technologies

- HTML et CSS, avec les styles du site dans `web_recette/site.css`.
- PHP pour les formulaires et l’affichage des recettes enregistrées.
- MySQL, accessible via PDO.
- Bootstrap 5.3.3 chargé depuis un CDN.

## Lancer le site en local

1. Installez un environnement PHP avec MySQL, par exemple XAMPP ou WAMP.
2. Démarrez le serveur Web et MySQL, puis placez le dossier du projet dans le répertoire servi par le serveur.
3. Dans phpMyAdmin ou un client MySQL, importez le fichier `Base de données/test.sql`. Il crée la base `test` et les tables du projet.
4. Le code PHP attend MySQL sur `localhost`, avec la base `test`, l’utilisateur `root` et un mot de passe vide. Adaptez les paramètres PDO dans les fichiers PHP si votre installation utilise d’autres identifiants.
5. Ouvrez `web_recette/projet.html` depuis le serveur local, par exemple `http://localhost/web_recette/projet.html`.

Les pages `.php` doivent être ouvertes via le serveur PHP ; ouvrir les fichiers directement depuis l’explorateur ne permettra pas d’exécuter les formulaires ni d’accéder à la base de données. Bootstrap nécessite une connexion Internet pour être chargé depuis son CDN.

## Organisation des fichiers

```text
Base de données/test.sql       Schéma et données initiales MySQL
web_recette/projet.html        Accueil et liens vers les régions et services
web_recette/R1.html … R13.html Pages des plats régionaux
web_recette/recettes.php       Liste des recettes enregistrées
web_recette/recette.php        Formulaire de partage d’une recette
web_recette/recette_cible.php  Validation et enregistrement de la recette
web_recette/appreciation.php   Formulaire d’appréciation
web_recette/appreciation_cible.php Validation et enregistrement de l’avis
web_recette/site.css           Styles communs
```
