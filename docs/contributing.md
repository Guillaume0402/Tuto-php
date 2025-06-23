# Guide de contribution - Tutoriel PHP

Ce guide explique comment contribuer au tutoriel PHP en respectant l'architecture et les conventions établies.

## Structure du projet

Le tutoriel est organisé en modules numérotés, chacun couvrant un aspect spécifique de PHP :

-   Modules 01-17 : Contenus pédagogiques sur PHP
-   `index.php` : Page d'accueil listant tous les modules
-   Dossier `css/` : Styles centralisés et modulaires
-   Dossier `includes/` : Fichiers PHP partagés
-   Dossier `docs/` : Documentation technique

## Convention de codage

### PHP

-   Utiliser des balises PHP ouvertes longues `<?php ... ?>`
-   Indenter avec 4 espaces (pas de tabulations)
-   Commenter le code avec PHPDoc pour les fonctions
-   Utiliser des noms de variables explicites en camelCase
-   Échapper les données affichées avec `htmlspecialchars()`

### HTML

-   Utiliser HTML5 avec DOCTYPE approprié
-   Balises et attributs en minuscules
-   Structure de base commune à tous les modules
-   Utiliser les classes CSS standardisées

### CSS

-   Suivre l'architecture CSS modulaire documentée dans `css-architecture.md`
-   Ne pas ajouter de styles inline
-   Utiliser des variables CSS pour les couleurs et espacements
-   Respecter les conventions de nommage pour les classes

## Comment ajouter un nouveau module

1. **Créer le fichier PHP du module** :

    - Utiliser le modèle de base avec la structure HTML standard
    - Connecter au fichier CSS principal avec `<link rel="stylesheet" href="css/main.css">`
    - Ajouter la classe de module au body `<body class="moduleX">`

2. **Ajouter une entrée dans la page d'index** :

    - Suivre le format des cartes existantes
    - Utiliser la classe de couleur correspondante

3. **Ajouter des variables de couleur** (si nécessaire) :

    - Définir les couleurs dans `variables.css`

4. **Ajouter des styles spécifiques** (si nécessaire) :
    - Pour des styles simples, ajouter dans `main.css` avec préfixe de module
    - Pour des styles complexes, créer un fichier dédié et l'importer dans `main.css`

## Comment modifier un module existant

1. **Respecter la structure HTML standardisée**
2. **Utiliser les composants existants** (exemples, boîtes d'info, etc.)
3. **Vérifier la compatibilité mobile**
4. **Maintenir la cohérence visuelle** entre les modules

## Tests et validation

Avant de soumettre une contribution :

1. Vérifier l'affichage sur différents navigateurs (Chrome, Firefox, Safari)
2. Tester la réactivité sur différentes tailles d'écran
3. Valider la syntaxe PHP (pas d'erreurs ni d'avertissements)
4. Vérifier les liens de navigation entre modules

## Documentation

-   Mettre à jour `css-architecture.md` si de nouveaux composants sont ajoutés
-   Documenter les fonctions PHP complexes avec des commentaires
-   Ajouter des notes explicatives pour les concepts difficiles

## Ressources utiles

-   [Documentation PHP officielle](https://www.php.net/manual/fr/)
-   [The PHP Framework Interop Group Standards](https://www.php-fig.org/psr/)
-   [Web Content Accessibility Guidelines](https://www.w3.org/WAI/standards-guidelines/wcag/)
