<?php
$titreMention = "Mentions légales";
$description = "Mentions légales du site Tuto-PHP";
include __DIR__ . '/../includes/header.php';
?>

<main>
    <section class="section legal-section">
        <h1><?= $titreMention ?></h1>

        <article class="legal-content">
            <h2>1. Éditeur du site</h2>
            <p>
                Le site Tuto-PHP est édité par Maignaut Guillaume, travailleur indépendant.
                <br>
                Contact : g.maignaut@gmail.com / 0650428039
                <br>
                Responsable de publication : Maignaut Guillaume
            </p>

            <h2>2. Hébergement</h2>
            <p>
                Ce site est hébergé par <strong>Heroku (Salesforce.com, Inc.)</strong>, plateforme cloud américaine.<br>
                Adresse : Salesforce Tower, 415 Mission Street, 3rd Floor, San Francisco, CA 94105, États-Unis.<br>
                Plus d’informations sur <a href="https://www.heroku.com/" target="_blank" rel="noopener">www.heroku.com</a>
            </p>

            <h2>3. Propriété intellectuelle</h2>
            <p>
                L'ensemble du contenu de ce site (textes, images, vidéos, code source) est protégé par le droit d'auteur.
                Toute reproduction, même partielle, est soumise à l'autorisation préalable de l'éditeur.
            </p>
            <p>
                Le code source présenté dans les tutoriels est disponible sous licence MIT, sauf mention contraire.
            </p>

            <h2>4. Collecte des données</h2>
            <p>
                Ce site respecte la vie privée des utilisateurs et se conforme au Règlement Général sur la Protection des
                Données (RGPD). Pour plus d'informations, veuillez consulter notre page de
                <a href="<?= BASE_URL ?>/pages/politique-confidentialite.php">Politique de confidentialité</a>.
            </p>

            <h2>5. Cookies</h2>
            <p>
                Ce site utilise des cookies techniques nécessaires à son bon fonctionnement.
                [À compléter selon vos pratiques réelles]
            </p>

            <h2>6. Liens externes</h2>
            <p>
                Ce site peut contenir des liens vers des sites externes. L'éditeur n'est pas responsable du contenu
                ou des pratiques des sites vers lesquels des liens sont établis.
            </p>

            <h2>7. Droit applicable</h2>
            <p>
                Le présent site et ses mentions légales sont soumis au droit [français/de votre pays].
                Tout litige relatif à l'utilisation du site sera soumis à la compétence exclusive des
                tribunaux de [Votre Juridiction].
            </p>
        </article>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>