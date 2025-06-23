    </main>
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Navigation</h3>
                <nav class="footer-nav">
                    <ul>
                        <li><a href="../../index.php">Accueil</a></li>
                        <li><a href="../modules/01-script.php">Premiers pas</a></li>
                        <li><a href="../modules/12-bases-de-donnees.php">Bases de données</a></li>
                        <li><a href="../modules/24-routeur-php.php">Routeur PHP</a></li>
                    </ul>
                </nav>
            </div>

            <div class="footer-section">
                <h3>Ressources</h3>
                <ul>
                    <li><a href="https://www.php.net/docs.php" target="_blank" rel="noopener noreferrer">Documentation PHP</a></li>
                    <li><a href="https://www.php-fig.org/psr/" target="_blank" rel="noopener noreferrer">Standards PSR</a></li>
                    <li><a href="https://github.com/topics/php-tutorials" target="_blank" rel="noopener noreferrer">Tutoriels GitHub</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Informations</h3>
                <ul>
                    <li><a href="../../pages/mentions-legales.php">Mentions légales</a></li>
                    <li><a href="../../pages/politique-confidentialite.php">Politique de confidentialité</a></li>
                    <li><a href="../../pages/contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section author-credits">
                <?php
                // Démontre l'accès aux variables depuis le fichier principal
                if (isset($auteur)) {
                    echo "<p><strong>Rédigé par :</strong> " . htmlspecialchars($auteur) . "</p>";
                }

                // On peut aussi ajouter d'autres métadonnées
                if (isset($date_creation)) {
                    echo "<p><strong>Créé le :</strong> " . htmlspecialchars($date_creation) . "</p>";
                }

                if (isset($date_modification)) {
                    echo "<p><strong>Mis à jour le :</strong> " . htmlspecialchars($date_modification) . "</p>";
                }
                ?>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright">&copy; <?php echo date('Y'); ?> Tuto-PHP - Tous droits réservés</p>
            <p class="version">Version 1.0.0 | <a href="https://github.com/votre-repo/tuto-php" target="_blank" rel="noopener noreferrer">GitHub</a></p>
        </div>
    </footer> <?php
                // Vérifiez si nous sommes en environnement de production
                // Vous pouvez définir ceci dans un fichier de configuration global
                $is_dev = true; // Par défaut en mode développement
                if ($is_dev) {
                    echo '<!-- Mode développement -->';
                } else {
                    // Ajoutez des scripts d'analyse ou de production ici
                    // Par exemple Google Analytics
                }
                ?>
    </body>

    </html>