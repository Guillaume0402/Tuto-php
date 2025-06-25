<?php
$titreContact = "Contact";
$description = "Contactez-nous pour toute question concernant les tutoriels PHP";
include __DIR__ . '/../includes/header.php';
?>

<main>
    <section class="section contact-section">
        <h1><?= $titreContact ?></h1>

        <div class="contact-container">
            <div class="contact-info">
                <h2>Nos informations</h2>
                <p>
                    Si vous avez des questions, des suggestions ou si vous souhaitez signaler une erreur dans
                    nos tutoriels, n'hésitez pas à nous contacter par le formulaire ci-contre ou via les
                    coordonnées suivantes :
                </p>

                <ul class="contact-details">
                    <li><strong>Email :</strong> g.maignaut@gmail.com</li>
                    <li><strong>GitHub :</strong> <a href="https://github.com/Guillaume0402" target="_blank">github.com/votre-repo/tuto-php</a></li>
                </ul>

                <div class="response-time">
                    <p>Nous nous efforçons de répondre à toutes les demandes dans un délai de 48 heures ouvrées.</p>
                </div>
            </div>

            <div class="contact-form">
                <h2>Formulaire de contact</h2>
                <?php
                // Initialisation des variables
                $success = false;
                $errors = [];
                $name = $email = $subject = $message = '';

                // Traitement du formulaire si soumis
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Récupération et nettoyage des données
                    $name = trim($_POST['name'] ?? '');
                    $email = trim($_POST['email'] ?? '');
                    $subject = trim($_POST['subject'] ?? '');
                    $message = trim($_POST['message'] ?? '');
                    $privacy = isset($_POST['privacy']);
                    $honeypot = trim($_POST['website'] ?? ''); // Champ anti-spam

                    // Validation
                    if (empty($name)) {
                        $errors[] = "Le nom est requis";
                    }
                    if (empty($email)) {
                        $errors[] = "L'email est requis";
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "L'email n'est pas valide";
                    }
                    if (empty($subject)) {
                        $errors[] = "Le sujet est requis";
                    }
                    if (empty($message)) {
                        $errors[] = "Le message est requis";
                    }
                    if (!$privacy) {
                        $errors[] = "Vous devez accepter la politique de confidentialité.";
                    }
                    if (!empty($honeypot)) {
                        $errors[] = "Erreur de validation (anti-spam).";
                    }

                    // Envoi de l'email si pas d'erreurs
                    if (empty($errors)) {
                        // Sécurisation de l'email
                        $to = 'g.maignaut@gmail.com';
                        $safe_subject = substr(str_replace(["\r", "\n"], '', $subject), 0, 100);
                        $safe_email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        $body = "Nom: $name\nEmail: $safe_email\nSujet: $safe_subject\nMessage:\n$message";
                        $headers = "From: noreply@tutophp.com\r\n";
                        $headers .= "Reply-To: $safe_email\r\n";
                        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
                        // Envoi réel (décommente la ligne suivante en production)
                        $mailSent = mail($to, "Contact du site: $safe_subject", $body, $headers);
                        if ($mailSent) {
                            $success = true;
                            $name = $email = $subject = $message = '';
                        } else {
                            $errors[] = "Erreur lors de l'envoi, réessayez plus tard.";
                        }
                    }
                }
                ?>

                <?php if ($success): ?>
                    <div class="success-message">
                        <p>Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.</p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="error-message">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="" class="form" autocomplete="off">
                    <!-- Champ honeypot anti-spam (caché pour les humains) -->
                    <div style="display:none;">
                        <label for="website">Ne pas remplir ce champ</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="name">Nom *</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Sujet *</label>
                        <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($subject) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="6" required><?= htmlspecialchars($message) ?></textarea>
                    </div>

                    <div class="form-group privacy-consent">
                        <input type="checkbox" id="privacy" name="privacy" required>
                        <label for="privacy">J'accepte le traitement de mes données conformément à la <a href="<?= BASE_URL ?>/pages/politique-confidentialite.php">politique de confidentialité</a> *</label>
                    </div>

                    <button type="submit" class="submit-btn" id="submitBtn">Envoyer le message</button>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    // Désactive le bouton submit après clic pour éviter les doubles envois
    const form = document.querySelector('.form');
    const submitBtn = document.getElementById('submitBtn');
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Envoi en cours...';
        });
    }
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>