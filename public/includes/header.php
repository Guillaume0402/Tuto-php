<?php require_once __DIR__ . '/config.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuto PHP</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/main.css">
</head>

<body<?= isset($moduleClass) ? ' class="' . $moduleClass . '"' : '' ?>>
    <header class="header">
        <div class="header__container">
            <a href="<?= BASE_URL ?>" class="header__logo"><span class="header__logo--blue">Tuto</span><span class="header__logo--white">PHP</span></a>
            <nav class="header__nav">
                <a href="<?= BASE_URL ?>" class="header__link">Accueil</a>
                <a href="https://www.php.net/docs.php" target="_blank" rel="noopener noreferrer" class="header__link">Documentation PHP</a>
                <a href="https://phptherightway.com/" target="_blank" rel="noopener noreferrer" class="header__link">PHP The Right Way</a>
                <a href="https://www.php.net/" target="_blank" class="header__link header__link--blue">PHP.net</a>
                <div class="header__modules-wrapper">
                    <button class="header__link header__modules-btn" aria-haspopup="true" aria-expanded="false">Modules ▼</button>
                    <div class="header__modules-menu">
                        <div class="header__modules-header">
                            <span>Modules de formation PHP</span>
                            <button class="header__close" aria-label="Fermer le menu">&times;</button>
                        </div>
                        <div class="header__modules-list">
                            <a href="<?= BASE_URL ?>/modules/01-script.php" class="header__module">01. Les bases du script</a>
                            <a href="<?= BASE_URL ?>/modules/02-les-variables.php" class="header__module">02. Les variables</a>
                            <a href="<?= BASE_URL ?>/modules/03-les-conditions.php" class="header__module">03. Les conditions</a>
                            <a href="<?= BASE_URL ?>/modules/04-les-boucles.php" class="header__module">04. Les boucles</a>
                            <a href="<?= BASE_URL ?>/modules/05-les-fonctions.php" class="header__module">05. Les fonctions</a>
                            <a href="<?= BASE_URL ?>/modules/06-les-tableaux.php" class="header__module">06. Les tableaux</a>
                            <a href="<?= BASE_URL ?>/modules/07-fonctions-natives.php" class="header__module">07. Fonctions natives</a>
                            <a href="<?= BASE_URL ?>/modules/08-inclusions.php" class="header__module">08. Inclusions</a>
                            <a href="<?= BASE_URL ?>/modules/09-les-formulaires.php" class="header__module">09. Les formulaires</a>
                            <a href="<?= BASE_URL ?>/modules/10-POO-les-classes.php" class="header__module">10. POO les classes</a>
                            <a href="<?= BASE_URL ?>/modules/11-POO-avancee.php" class="header__module">11. POO avancé</a>
                            <a href="<?= BASE_URL ?>/modules/12-bases-de-donnees.php" class="header__module">12. Bases de données</a>
                            <a href="<?= BASE_URL ?>/modules/13-php-ajax.php" class="header__module">13. PHP AJAX</a>
                            <a href="<?= BASE_URL ?>/modules/14-securite.php" class="header__module">14. Sécurité</a>
                            <a href="<?= BASE_URL ?>/modules/15-architecture-mvc.php" class="header__module">15. Architecture MVC</a>
                            <a href="<?= BASE_URL ?>/modules/16-api-externes.php" class="header__module">16. PHP et API externes</a>
                            <a href="<?= BASE_URL ?>/modules/17-gestion-fichiers.php" class="header__module">17. Gestion des fichiers et images en PHP</a>
                            <a href="<?= BASE_URL ?>/modules/18-tests-unitaires.php" class="header__module">18. Tests unitaires et qualité de code</a>
                            <a href="<?= BASE_URL ?>/modules/19-envoi-emails.php" class="header__module">19. Envoi d'e-mails en PHP</a>
                            <a href="<?= BASE_URL ?>/modules/20-sessions-authentification.php" class="header__module">20. Gestion des sessions et authentification</a>
                            <a href="<?= BASE_URL ?>/modules/21-internationalisation.php" class="header__module">21. Internationalisation (i18n) et gestion des langues</a>
                            <a href="<?= BASE_URL ?>/modules/22-deploiement-hebergement.php" class="header__module">22. Déploiement et hébergement d'une application PHP</a>
                            <a href="<?= BASE_URL ?>/modules/23-composer-autoloading.php" class="header__module">23. Utilisation de Composer et autoloading</a>
                            <a href="<?= BASE_URL ?>/modules/24-routeur-php.php" class="header__module">24. Routeur PHP</a>
                        </div>
                    </div>
                </div>
            </nav>
            <button class="header__burger" aria-label="Ouvrir le menu principal"><span></span><span></span><span></span></button>
        </div>
        <div class="header__overlay"></div>
    </header>
    <main>
        
    </main>
    <!-- Déplacement du script ici pour garantir que le DOM est prêt -->
    <script src="<?= BASE_URL ?>/assets/js/dropdown.js"></script>
    </body>

</html>