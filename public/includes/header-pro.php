<?php
// Inclure la config depuis le dossier includes
require_once __DIR__ . '/config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formation PHP</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/main.css">
</head>

<div class="tuto-nav-pro">
    <div class="tuto-nav-container">
        <div class="tuto-nav-logo">
            <a href="<?= SITE_ROOT ?>" <span class="tuto-nav-logo-blue">Tuto</span><span class="tuto-nav-logo-white">PHP</span></a>
        </div>
        <nav class="tuto-nav-menu">
            <a href="<?= SITE_ROOT ?>" class="tuto-nav-link">Accueil</a>
            <a href="https://www.php.net/docs.php" target="_blank" rel="noopener noreferrer" class="tuto-nav-link">Documentation PHP</a>
            <a href="https://phptherightway.com/" target="_blank" rel="noopener noreferrer" class="tuto-nav-link">PHP The Right Way</a>
            <a href="https://www.php.net/" target="_blank" class="tuto-nav-link tuto-nav-link-blue">PHP.net</a>
            <!-- Début du menu déroulant -->
            <div class="dropdown">
                <button class="tuto-nav-link dropdown-toggle">
                    Modules
                    <span class="dropdown-icon">▼</span>
                </button>
                <div class="dropdown-menu">
                    <a href="<?= BASE_URL ?>modules/01-script.php" class="dropdown-item">01. Les bases du script</a>
                    <a href="<?= BASE_URL ?>modules/02-les-variables.php" class="dropdown-item">02. Les variables</a>
                    <a href="<?= BASE_URL ?>modules/03-les-conditions.php" class="dropdown-item">03. Les conditions</a>
                    <a href="<?= BASE_URL ?>modules/04-les-boucles.php" class="dropdown-item">04. Les boucles</a>
                    <a href="<?= BASE_URL ?>modules/05-les-fonctions.php" class="dropdown-item">05. Les fonctions</a>
                    <a href="<?= BASE_URL ?>modules/06-les-tableaux.php" class="dropdown-item">06. Les tableaux</a>
                    <a href="<?= BASE_URL ?>modules/07-fonctions-natives.php" class="dropdown-item">07. Fonctions natives</a>
                    <a href="<?= BASE_URL ?>modules/08-inclusions.php" class="dropdown-item">08. Inclusions</a>
                    <a href="<?= BASE_URL ?>modules/09-les-formulaires.php" class="dropdown-item">09. Les formulaires</a>
                    <a href="<?= BASE_URL ?>modules/10-POO-les-classes.php" class="dropdown-item">10. POO les classes</a>
                    <a href="<?= BASE_URL ?>modules/11-POO-avancee.php" class="dropdown-item">11. POO avancé</a>
                    <a href="<?= BASE_URL ?>modules/12-bases-de-donnees.php" class="dropdown-item">12. Bases de données</a>
                    <a href="<?= BASE_URL ?>modules/13-php-ajax.php" class="dropdown-item">13. PHP AJAX</a>
                    <a href="<?= BASE_URL ?>modules/14-securite.php" class="dropdown-item">14. Sécurité</a>
                    <a href="<?= BASE_URL ?>modules/15-architecture-mvc.php" class="dropdown-item">15. Architecture MVC</a>
                    <a href="<?= BASE_URL ?>modules/16-api-externes.php" class="dropdown-item">16. PHP et API externes</a>
                    <a href="<?= BASE_URL ?>modules/17-gestion-fichiers.php" class="dropdown-item">17. Gestion des fichiers et images en PHP</a>
                    <a href="<?= BASE_URL ?>modules/18-tests-unitaires.php" class="dropdown-item">18. Tests unitaires et qualité de code</a>
                    <a href="<?= BASE_URL ?>modules/19-envoi-emails.php" class="dropdown-item">19. Envoi d'e-mails en PHP</a>
                    <a href="<?= BASE_URL ?>modules/20-sessions-authentification.php" class="dropdown-item">20. Gestion des sessions et authentification</a>
                    <a href="<?= BASE_URL ?>modules/21-internationalisation.php" class="dropdown-item">21. Internationalisation (i18n) et gestion des langues</a>
                    <a href="<?= BASE_URL ?>modules/22-deploiement-hebergement.php" class="dropdown-item">22. Déploiement et hébergement d'une application PHP</a>
                    <a href="<?= BASE_URL ?>modules/23-composer-autoloading.php" class="dropdown-item">23. Utilisation de Composer et autoloading</a>
                    <a href="<?= BASE_URL ?>modules/24-routeur-php.php" class="dropdown-item">24. Routeur PHP</a>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
            <!-- Fin du menu déroulant -->
        </nav>
    </div> <!-- Overlay pour permettre de fermer en cliquant en dehors du menu -->
    <script src="<?= BASE_URL ?>assets/js/dropdown.js"></script>
</div>

