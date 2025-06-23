    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Cours PHP - Les inclusions</p>
        <p>
            <?php
            // Démontre l'accès aux variables depuis le fichier principal
            if (isset($auteur)) {
                echo "Rédigé par : " . $auteur;
            }
            ?>
        </p>
    </footer>
    </body>

    </html>