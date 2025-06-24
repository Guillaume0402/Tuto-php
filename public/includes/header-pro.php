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
            <span class="tuto-nav-logo-blue">Tuto</span><span class="tuto-nav-logo-white">PHP</span>
        </div>
        <nav class="tuto-nav-menu">
            <a href="<?= BASE_URL ?>index.php" class="tuto-nav-link">Accueil</a>            
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
                    <a href="<?= BASE_URL ?>modules/05-variables.php" class="dropdown-item">05. Variables</a>
                    <a href="<?= BASE_URL ?>modules/12-bases-de-donnees.php" class="dropdown-item">12. Bases de données</a>
                    <a href="<?= BASE_URL ?>modules/24-routeur-php.php" class="dropdown-item">24. Routeur PHP</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= BASE_URL ?>modules/" class="dropdown-item dropdown-all">Tous les modules</a>
                </div>
            </div>
            <!-- Fin du menu déroulant -->
        </nav>
    </div>
    <script src="/Tuto-php/public/assets/js/dropdown.js"></script>
</div>