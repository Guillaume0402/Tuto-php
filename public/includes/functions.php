<?php

/**
 * Fonctions utilitaires pour démonstration des inclusions
 */

/**
 * Affiche un message formaté
 */
function afficherMessage($message, $type = "info")
{
    $classes = [
        "info" => "info-message",
        "success" => "success-message",
        "warning" => "warning-message",
        "error" => "error-message"
    ];

    $class = $classes[$type] ?? $classes["info"];

    echo '<div class="' . $class . '">' . $message . '</div>';
}

/**
 * Génère une liste HTML à partir d'un tableau
 */
function genererListe($items)
{
    if (empty($items) || !is_array($items)) {
        return "<p>Aucun élément à afficher.</p>";
    }

    $html = "<ul>";
    foreach ($items as $item) {
        $html .= "<li>" . htmlspecialchars($item) . "</li>";
    }
    $html .= "</ul>";

    return $html;
}

/**
 * Calcule la moyenne d'une série de nombres
 */
function calculerMoyenne($nombres)
{
    if (empty($nombres) || !is_array($nombres)) {
        return 0;
    }

    return array_sum($nombres) / count($nombres);
}

// Définition de quelques constantes pour l'exemple
define('APP_NAME', 'Tutoriel PHP');
define('APP_VERSION', '1.0.0');
