<?php
// Inclusion du fichier de configuration si ce n'est pas déjà fait
if (!defined('SITE_VERSION')) {
    include_once __DIR__ . '/config.php';
}
?>
</main>
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Navigation</h3>
            <nav class="footer-nav">
                <ul>
                    <li><a href="<?= SITE_ROOT ?>" class="no-module-color">Accueil</a></li>
                    <li><a href="<?= BASE_URL ?>modules/01-script.php">Premiers pas</a></li>
                    <li><a href="<?= BASE_URL ?>modules/12-bases-de-donnees.php">Bases de données</a></li>
                    <li><a href="<?= BASE_URL ?>modules/24-routeur-php.php">Routeur PHP</a></li>
                </ul>
            </nav>
        </div>

        <div class="footer-section">
            <h3>Ressources</h3>
            <ul>
                <li><a href="https://www.php.net/docs.php" target="_blank" rel="noopener noreferrer" class="no-module-color">Documentation PHP</a></li>
                <li><a href="https://www.php-fig.org/psr/" target="_blank" rel="noopener noreferrer" class="no-module-color">Standards PSR</a></li>
                <li><a href="https://github.com/topics/php-tutorials" target="_blank" rel="noopener noreferrer" class="no-module-color">Tutoriels GitHub</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Informations</h3>
            <ul>
                <li><a href="<?= BASE_URL ?>pages/mentions-legales.php" class="no-module-color">Mentions légales</a></li>
                <li><a href="<?= BASE_URL ?>pages/politique-confidentialite.php" class="no-module-color">Politique de confidentialité</a></li>
                <li><a href="<?= BASE_URL ?>pages/contact.php" class="no-module-color">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section author-credits">
            <h3>À propos</h3>
            <?php
            // Démontre l'accès aux variables depuis le fichier principal
            // Si l'auteur n'est pas défini, utilise la valeur par défaut du fichier config.php
            if (isset($auteur)) {
                echo "<p><strong>Rédigé par :</strong> " . htmlspecialchars($auteur) . "</p>";
            } else {
                echo "<p><strong>Rédigé par :</strong> " . htmlspecialchars($default_auteur) . "</p>";
            }

            // On peut aussi ajouter d'autres métadonnées
            // Date de création avec fallback sur la date du fichier courant
            if (isset($date_creation)) {
                echo "<p><strong>Créé le :</strong> " . htmlspecialchars($date_creation) . "</p>";
            } elseif (isset($_SERVER['SCRIPT_FILENAME']) && file_exists($_SERVER['SCRIPT_FILENAME'])) {
                $creation_date = date("d/m/Y", filectime($_SERVER['SCRIPT_FILENAME']));
                echo "<p><strong>Créé le :</strong> " . $creation_date . "</p>";
            }

            // Date de modification avec fallback sur la date du fichier courant
            if (isset($date_modification)) {
                echo "<p><strong>Mis à jour le :</strong> " . htmlspecialchars($date_modification) . "</p>";
            } elseif (isset($_SERVER['SCRIPT_FILENAME']) && file_exists($_SERVER['SCRIPT_FILENAME'])) {
                $modification_date = date("d/m/Y", filemtime($_SERVER['SCRIPT_FILENAME']));
                echo "<p><strong>Mis à jour le :</strong> " . $modification_date . "</p>";
            }

            // Ajout de la version du site définie dans config.php
            echo "<p><strong>Version :</strong> " . (defined('SITE_VERSION') ? SITE_VERSION : '1.0.0') . "</p>";
            ?>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="copyright">&copy; <?php echo date('Y'); ?> <?php echo defined('SITE_NAME') ? SITE_NAME : 'Tuto-PHP'; ?> - Tous droits réservés</p>
        <p class="version">
            Version <?php echo defined('SITE_VERSION') ? SITE_VERSION : '1.0.0'; ?> |
            <a href="<?php echo defined('SITE_GITHUB') ? SITE_GITHUB : 'https://github.com/votre-repo/tuto-php'; ?>" target="_blank" rel="noopener noreferrer" class="no-module-color">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="github-icon">
                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                </svg>
                GitHub
            </a>
        </p>
    </div>
</footer>

<?php
// Vérifiez si nous sommes en environnement de production
// Cette valeur est définie dans le fichier de configuration global (config.php)
$is_dev = defined('ENVIRONMENT') ? (ENVIRONMENT === 'development') : true;

if ($is_dev) {
    // Mode développement : afficher les informations de débogage
?>
    <div class="dev-info">
        <details>
            <summary>Infos développeur</summary>
            <div class="dev-details">
                <p><strong>Fichier :</strong> <?= $_SERVER['SCRIPT_FILENAME']; ?></p>
                <p><strong>PHP Version :</strong> <?= phpversion(); ?></p>
                <p><strong>Environnement :</strong> <?= defined('ENVIRONMENT') ? ENVIRONMENT : 'Non défini'; ?></p>
                <p><strong>Temps d'exécution :</strong> <?= number_format((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000, 2); ?> ms</p>
                <?php if (function_exists('memory_get_usage')): ?>
                    <p><strong>Mémoire utilisée :</strong> <?= round(memory_get_usage() / 1024 / 1024, 2); ?> MB</p>
                <?php endif; ?>
            </div>
        </details>
    </div>
    <?php } else {
    // Mode production : inclure les scripts d'analyse
    if (defined('GA_TRACKING_ID') && !empty(GA_TRACKING_ID)) {
    ?>
        <!-- Script Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= GA_TRACKING_ID; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '<?= GA_TRACKING_ID; ?>');
        </script>
<?php
    }
}
?>
</main>
</body>

</html>