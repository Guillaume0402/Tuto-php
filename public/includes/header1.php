<?php

/**
 * Fichier d'en-tête pour démonstration des inclusions
 * Ce fichier sera inclus dans les exemples
 */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre ?? "Exemple d'inclusion"; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f7;
            color: #333;
        }

        header {
            background-color: #3a0ca3;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            text-align: center;
            font-size: 0.8em;
        }
    </style>
</head>

<body>
    <header>
        <h1><?php echo $titre ?? "Exemple d'inclusion"; ?></h1>
        <?php if (isset($description)): ?>
            <p><?php echo $description; ?></p>
        <?php endif; ?>
    </header>
    <main>