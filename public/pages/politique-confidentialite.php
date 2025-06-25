<?php
$titrePolitique = "Politique de confidentialité";
$description = "Politique de confidentialité et traitement des données personnelles";
include __DIR__ . '/../includes/header.php';
?>

<main>
    <section class="section legal-section">
        <h1><?= $titrePolitique ?></h1>

        <article class="legal-content">
            <h2>1. Collecte des données personnelles</h2>
            <p>
                Ce site éducatif sur PHP ne collecte généralement pas de données personnelles des visiteurs,
                à l'exception des informations suivantes :
            </p>
            <ul>
                <li>Données de connexion et de navigation à des fins statistiques et techniques</li>
                <li>Adresse e-mail si vous nous contactez via le formulaire de contact</li>
                <li>[Ajoutez d'autres données si vous en collectez]</li>
            </ul>

            <h2>2. Utilisation des données</h2>
            <p>
                Les données collectées sont utilisées uniquement pour :
            </p>
            <ul>
                <li>Améliorer le contenu et l'expérience utilisateur du site</li>
                <li>Répondre à vos demandes si vous nous contactez</li>
                <li>Établir des statistiques anonymes d'utilisation</li>
            </ul>

            <h2>3. Conservation des données</h2>
            <p>
                Les données de contact sont conservées pendant [durée] après votre dernière interaction avec nous.
                Les données de navigation sont conservées sous forme anonymisée pour une durée de [durée].
            </p>

            <h2>4. Vos droits</h2>
            <p>
                Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez des droits suivants :
            </p>
            <ul>
                <li>Droit d'accès à vos données personnelles</li>
                <li>Droit de rectification</li>
                <li>Droit à l'effacement (droit à l'oubli)</li>
                <li>Droit à la limitation du traitement</li>
                <li>Droit à la portabilité des données</li>
                <li>Droit d'opposition</li>
            </ul>
            <p>
                Pour exercer ces droits, contactez-nous à <a href="mailto:g.maignaut@gmail.com">g.maignaut@gmail.com</a>.
            </p>

            <h2>5. Cookies</h2>
            <p>
                Notre site utilise des cookies techniques nécessaires à son fonctionnement. Nous n'utilisons pas de
                cookies publicitaires ou de traçage sans votre consentement explicite.
            </p>
            <p>
                [Détaillez votre politique de cookies si nécessaire]
            </p>

            <h2>6. Sécurité des données</h2>
            <p>
                Nous mettons en œuvre des mesures de sécurité appropriées pour protéger vos données contre tout
                accès, modification, divulgation ou destruction non autorisés.
            </p>

            <h2>7. Modifications de la politique de confidentialité</h2>
            <p>
                Cette politique de confidentialité peut être mise à jour périodiquement. La date de la dernière
                modification est indiquée en bas de page. Nous vous encourageons à consulter régulièrement cette page.
            </p>

            <p class="update-date">
                Dernière mise à jour : <?= date('d/m/Y') ?>
            </p>
        </article>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>