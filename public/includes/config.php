<?php

/**
 * Fichier de configuration et variables communes
 * Ce fichier contient les variables partagées entre les différentes pages du tutoriel
 */

// ----- Configuration générale du site -----
define('SITE_ROOT', '/Tuto-php/');
// BASE_URL dynamique pour fonctionner en local et en prod
function getBaseUrl()
{
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    // On cherche la position de "/public" dans le chemin du script
    $publicPos = strpos($_SERVER['SCRIPT_NAME'], '/public/');
    if ($publicPos !== false) {
        $base = substr($_SERVER['SCRIPT_NAME'], 0, $publicPos + 7); // 7 = strlen('/public')
        return $protocol . '://' . $host . $base;
    }
    // fallback
    return $protocol . '://' . $host;
}
define('BASE_URL', getBaseUrl());
define('SITE_VERSION', '1.0.2');
define('SITE_NAME', 'Tuto-PHP');
define('SITE_AUTHOR', 'Guillaume Maignaut');
define('SITE_GITHUB', 'https://github.com/Guillaume0402');

// ----- Configuration de l'environnement -----
define('ENVIRONMENT', 'development'); // Options : 'development' ou 'production'

// ----- Configuration Google Analytics -----
define('GA_TRACKING_ID', 'UA-XXXXXXXX-X'); // À remplacer par votre ID de suivi Google Analytics

// ----- Métadonnées par défaut -----
$default_auteur = "Guillaume Maignaut";
$default_annee = date('Y');
$default_date_creation = date('d/m/Y');
$default_date_modification = date('d/m/Y');

// ----- Variables pour le développement -----
$is_dev = (ENVIRONMENT === 'development');

// Configuration des pages
$pages = [
    '01-script' => [
        'titre' => 'Un premier script PHP',
        'description' => 'Découvrez la syntaxe de base de PHP et comment intégrer du code PHP dans une page HTML.'
    ],
    '02-les-variables' => [
        'titre' => 'Les Variables en PHP',
        'description' => 'Apprenez à déclarer, initialiser et manipuler des variables en PHP pour stocker différents types de données.'
    ],
    '03-les-conditions' => [
        'titre' => 'Les Conditions en PHP',
        'description' => 'Maîtrisez les structures conditionnelles (if, else, switch) pour contrôler le flux d\'exécution de votre code.'
    ],
    '04-les-boucles' => [
        'titre' => 'Les Boucles en PHP',
        'description' => 'Découvrez comment répéter des opérations avec les boucles for, while et foreach pour un code plus efficace.'
    ],
    '05-les-fonctions' => [
        'titre' => 'Les Fonctions en PHP',
        'description' => 'Apprenez à créer et utiliser des fonctions pour organiser votre code et le rendre plus modulaire et réutilisable.'
    ],
    '06-les-tableaux' => [
        'titre' => 'Les Tableaux en PHP',
        'description' => 'Explorez les différents types de tableaux en PHP et comment manipuler efficacement des collections de données.'
    ],
    '07-fonctions-natives' => [
        'titre' => 'Les Fonctions Natives en PHP',
        'description' => 'Découvrez les fonctions prédéfinies de PHP pour manipuler les chaînes, tableaux, dates et autres types de données.'
    ],
    '08-inclusions' => [
        'titre' => 'Les Inclusions en PHP',
        'description' => 'Apprenez à structurer votre code avec include et require pour rendre votre code modularisé et réutilisable.'
    ],
    '09-les-formulaires' => [
        'titre' => 'Les Formulaires en PHP',
        'description' => 'Maîtrisez la création et le traitement des formulaires en PHP pour interagir avec vos utilisateurs de manière sécurisée.'
    ],
    '10-POO-les-classes' => [
        'titre' => 'POO - Les Classes en PHP',
        'description' => 'Découvrez les fondamentaux de la Programmation Orientée Objet en PHP : classes, propriétés, méthodes et instanciation.'
    ],
    '11-POO-avancee' => [
        'titre' => 'POO Avancée - Interfaces et Classes Abstraites',
        'description' => 'Approfondissez vos connaissances en POO avec les interfaces, les classes abstraites, les traits et autres concepts avancés.'
    ],
    '12-bases-de-donnees' => [
        'titre' => 'Bases de données avec PHP',
        'description' => 'Maîtrisez l\'interaction avec les bases de données MySQL en PHP : connexion, requêtes SQL, et PDO.'
    ],
    '13-php-ajax' => [
        'titre' => 'PHP et AJAX',
        'description' => 'Créez des applications web dynamiques en combinant PHP et AJAX pour des mises à jour sans rechargement de page.'
    ],
    '14-securite' => [
        'titre' => 'Sécurité en PHP',
        'description' => 'Protégez vos applications PHP contre les vulnérabilités courantes et mettez en œuvre les bonnes pratiques de sécurité.'
    ],
    '15-architecture-mvc' => [
        'titre' => 'Architecture MVC en PHP',
        'description' => 'Structurez vos applications PHP complexes grâce au pattern Model-View-Controller.'
    ]
];

// Fonction pour obtenir les informations d'une page
function getPageInfo($pageKey)
{
    global $pages;

    if (isset($pages[$pageKey])) {
        return $pages[$pageKey];
    }

    // Informations par défaut si la page n'existe pas
    return [
        'titre' => 'Tutoriel PHP',
        'description' => 'Apprenez le développement web avec PHP.'
    ];
}

// Fonction pour extraire le nom de la page courante du nom de fichier
function getCurrentPageKey()
{
    $currentFile = basename($_SERVER['PHP_SELF'], '.php');
    return $currentFile;
}

// Variables pour la page courante
$currentPageKey = getCurrentPageKey();
$pageInfo = getPageInfo($currentPageKey);
$titre = $pageInfo['titre'];
$description = $pageInfo['description'];
