<?php

/**
 * Exemple de démonstration des inclusions
 * Ce fichier montre comment inclure des en-têtes, des fonctions et des pieds de page
 */

// Inclusion des fichiers nécessaires
require_once 'config.php';
require_once 'functions.php';

// Variables spécifiques à cette page
$titre = "Démonstration des Inclusions";
$description = "Cet exemple montre comment utiliser include et require en PHP";
$auteur = "Équipe de développement PHP";

// Inclusion de l'en-tête
include 'header.php';

// Contenu spécifique à la page
?>

<h2>Démonstration des Inclusions en PHP</h2>

<p>
    Cette page démontre l'utilisation des inclusions en PHP pour structurer le code.
    Remarquez que l'en-tête et le pied de page sont inclus séparément.
</p>

<h3>Utilisation des fonctions du fichier inclus</h3>

<?php
// Utilisation des fonctions du fichier functions.php
$langages = ["PHP", "HTML", "CSS", "JavaScript", "MySQL"];
echo genererListe($langages);

// Affichage de messages avec différents styles
afficherMessage("Voici un message d'information standard", "info");
afficherMessage("L'opération a réussi !", "success");
afficherMessage("Attention, cette action pourrait avoir des conséquences", "warning");
afficherMessage("Une erreur s'est produite", "error");

// Calcul et affichage d'une moyenne
$notes = [15, 17, 12, 19, 14];
echo "<p>La moyenne des notes est : " . calculerMoyenne($notes) . "</p>";

// Affichage des constantes définies dans functions.php
echo "<p>Nom de l'application : " . APP_NAME . "</p>";
echo "<p>Version : " . APP_VERSION . "</p>";
?>

<h3>Avantages des inclusions</h3>
<ul>
    <li>Code plus organisé et modulaire</li>
    <li>Possibilité de réutiliser des éléments communs</li>
    <li>Maintenance simplifiée</li>
    <li>Séparation claire des responsabilités</li>
</ul>

<style>
    /* Styles pour les messages */
    .info-message {
        background-color: #e3f2fd;
        border-left: 4px solid #2196F3;
        padding: 10px 15px;
        margin: 10px 0;
        border-radius: 0 4px 4px 0;
    }

    .success-message {
        background-color: #e8f5e9;
        border-left: 4px solid #4CAF50;
        padding: 10px 15px;
        margin: 10px 0;
        border-radius: 0 4px 4px 0;
    }

    .warning-message {
        background-color: #fff3e0;
        border-left: 4px solid #FF9800;
        padding: 10px 15px;
        margin: 10px 0;
        border-radius: 0 4px 4px 0;
    }

    .error-message {
        background-color: #ffebee;
        border-left: 4px solid #F44336;
        padding: 10px 15px;
        margin: 10px 0;
        border-radius: 0 4px 4px 0;
    }
</style>

<?php
// Inclusion du pied de page
include 'footer.php';
?>