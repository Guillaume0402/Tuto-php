<?php

/**
 * Exemple de démonstration des inclusions
 * Ce fichier montre comment inclure des en-têtes, des fonctions et des pieds de page
 */

// Fichier d'exemple pédagogique, non utilisé en production

// Inclusion des fichiers nécessaires
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

// Variables spécifiques à cette page
$titre = "Démonstration des Inclusions";
$description = "Cet exemple montre comment utiliser include et require en PHP";
$auteur = "Équipe de développement PHP";

// Inclusion de l'en-tête
include __DIR__ . '/header.php';

// Contenu spécifique à la page
?>

<div class="section">
    <h2>Démonstration des Inclusions en PHP</h2>

    <p>
        Cette page démontre l'utilisation des inclusions en PHP pour structurer le code.
        Remarquez que l'en-tête et le pied de page sont inclus séparément.
    </p>
</div>

<div class="section">
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
</div>

<div class="section">
    <h3>Avantages des inclusions</h3>
    <ul>
        <li>Code plus organisé et modulaire</li>
        <li>Possibilité de réutiliser des éléments communs</li>
        <li>Maintenance simplifiée</li>
        <li>Séparation claire des responsabilités</li>
    </ul>
</div>

<?php
// Inclusion du pied de page
include __DIR__ . '/footer.php';
?>