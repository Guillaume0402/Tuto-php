<?php
$moduleClass = 'module19';
include __DIR__ . '/../includes/header.php';
$titre = "Envoi d'e-mails en PHP";
$description = "Apprenez à envoyer des e-mails avec PHP, des options basiques aux fonctionnalités avancées comme les pièces jointes, les e-mails HTML et la sécurité.";
?>

<div class="module-header">
    <h1><?= $titre ?></h1>
    <p class="subtitle"><?= $description ?></p>
</div>
<div class="navigation">
    <a href="<?= BASE_URL ?>/modules/18-tests-unitaires.php" class="nav-button">← Module précédent</a>
    <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
    <a href="<?= BASE_URL ?>/modules/20-sessions-authentification.php" class="nav-button">Module suivant →</a>
</div>
<main>
    <section class="section">
        <h2>Utilisation de la fonction mail()</h2>
        <p>PHP dispose d'une fonction native <code>mail()</code> qui permet d'envoyer des e-mails de manière simple. Bien que limitée, elle est utile pour des envois basiques sur des environnements correctement configurés.</p>

        <div class="info-box">
            <strong>Comment fonctionne mail() en interne ?</strong>
            <p>La fonction <code>mail()</code> s'appuie sur la configuration du serveur web pour envoyer des emails :</p>
            <ul>
                <li>Sur les systèmes <strong>Linux/Unix</strong> : utilise généralement le programme <code>sendmail</code> ou compatible</li>
                <li>Sur <strong>Windows</strong> : nécessite la configuration d'un serveur SMTP dans le fichier <code>php.ini</code> via les directives <code>SMTP</code> et <code>smtp_port</code></li>
            </ul>
            <p>Cette dépendance à la configuration du serveur explique pourquoi la fonction peut fonctionner en production mais pas sur un environnement de développement local.</p>
        </div>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Syntaxe de base</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// Syntaxe de la fonction mail()</span>
<span class="keyword">bool</span> <span class="function">mail</span>(
    <span class="variable">$to</span>,      <span class="comment">// Destinataire(s)</span>
    <span class="variable">$subject</span>, <span class="comment">// Sujet</span>
    <span class="variable">$message</span>, <span class="comment">// Corps du message</span>
    <span class="variable">$headers</span>, <span class="comment">// En-têtes additionnels (optionnel)</span>
    <span class="variable">$parameters</span> <span class="comment">// Paramètres additionnels (optionnel)</span>
);</code></pre>
                    <div class="result">
                        <p><strong>Retour :</strong> La fonction retourne <code>true</code> si l'email a été <em>accepté pour envoi</em> (ce qui ne garantit pas qu'il sera délivré), ou <code>false</code> en cas d'erreur.</p>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header">Exemple simple</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$to</span> = <span class="string">"destinataire@example.com"</span>;
<span class="variable">$subject</span> = <span class="string">"Sujet de l'e-mail"</span>;
<span class="variable">$message</span> = <span class="string">"Voici le contenu de l'e-mail.\n\nCordialement,\nLe site"</span>;
<span class="variable">$headers</span> = <span class="string">"From: expediteur@example.com"</span>;

<span class="keyword">if</span>(<span class="function">mail</span>(<span class="variable">$to</span>, <span class="variable">$subject</span>, <span class="variable">$message</span>, <span class="variable">$headers</span>)) {
    <span class="keyword">echo</span> <span class="string">"E-mail envoyé avec succès"</span>;
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Échec de l'envoi de l'e-mail"</span>;
}</code></pre>
                    <div class="result">
                        <p><strong>Note :</strong> Pour que <code>mail()</code> fonctionne, un serveur de messagerie (comme Sendmail) doit être configuré sur votre serveur.</p>
                        <p><strong>Points importants :</strong></p>
                        <ul>
                            <li>Plusieurs destinataires peuvent être spécifiés en les séparant par des virgules</li>
                            <li>Le sujet devrait être encodé pour supporter les caractères spéciaux (avec <code>mb_encode_mimeheader()</code>)</li>
                            <li>Le message peut contenir des sauts de ligne (<code>\n</code>)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <h3>En-têtes additionnels</h3>
        <p>Les en-têtes permettent de personnaliser vos e-mails avec des informations supplémentaires comme l'expéditeur, les destinataires en copie, ou le format du contenu.</p>

        <div class="example">
            <div class="example-header">En-têtes courants</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="variable">$headers</span> = <span class="string">"From: Mon Site &lt;contact@monsite.com&gt;\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"Reply-To: service@monsite.com\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"Cc: copie@example.com\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"Bcc: copiecachee@example.com\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"X-Mailer: PHP/"</span> . <span class="function">phpversion</span>() . <span class="string">"\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"MIME-Version: 1.0\r\n"</span>;</code></pre>
                <div class="result">
                    <p><strong>Important :</strong> Utilisez <code>\r\n</code> comme séparateur de ligne pour respecter la spécification RFC des e-mails.</p>
                    <p><strong>Explication des en-têtes :</strong></p>
                    <ul>
                        <li><strong>From</strong> : Définit l'expéditeur (peut inclure un nom et une adresse)</li>
                        <li><strong>Reply-To</strong> : Adresse utilisée quand le destinataire répond</li>
                        <li><strong>Cc</strong> : Destinataires en copie visible</li>
                        <li><strong>Bcc</strong> : Destinataires en copie cachée (invisibles pour les autres destinataires)</li>
                        <li><strong>X-Mailer</strong> : Information sur le logiciel d'envoi (facultatif)</li>
                        <li><strong>MIME-Version</strong> : Version du format MIME utilisé</li>
                    </ul>
                </div>
            </div>
        </div>

        <h3>Envoi d'emails au format HTML</h3>
        <p>Pour envoyer un email au format HTML avec la fonction <code>mail()</code>, vous devez spécifier le type de contenu dans les en-têtes.</p>

        <div class="example">
            <div class="example-header">Email HTML simple</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="variable">$to</span> = <span class="string">"destinataire@example.com"</span>;
<span class="variable">$subject</span> = <span class="string">"Email au format HTML"</span>;

<span class="comment">// Corps du message au format HTML</span>
<span class="variable">$message</span> = <span class="string">"
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;Email HTML&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1 style='color: #4CAF50;'&gt;Bonjour!&lt;/h1&gt;
    &lt;p&gt;Ceci est un &lt;strong&gt;email HTML&lt;/strong&gt; envoyé depuis PHP.&lt;/p&gt;
    &lt;p&gt;&lt;a href='https://www.example.com'&gt;Visitez notre site&lt;/a&gt;&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;
"</span>;

<span class="comment">// En-têtes pour spécifier le format HTML</span>
<span class="variable">$headers</span> = <span class="string">"From: Mon Site &lt;contact@monsite.com&gt;\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"Reply-To: service@monsite.com\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"MIME-Version: 1.0\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"Content-Type: text/html; charset=UTF-8\r\n"</span>;

<span class="function">mail</span>(<span class="variable">$to</span>, <span class="variable">$subject</span>, <span class="variable">$message</span>, <span class="variable">$headers</span>);</code></pre>
                <div class="result">
                    <p><strong>Point clé :</strong> L'en-tête <code>Content-Type: text/html; charset=UTF-8</code> est essentiel pour que le client mail interprète correctement le contenu HTML.</p>
                </div>
            </div>
        </div>
        <h3>Envoi d'emails avec pièces jointes</h3>
        <p>La fonction <code>mail()</code> ne gère pas nativement les pièces jointes, mais il est possible d'en envoyer en utilisant le format MIME multipart. Cette approche est complexe et sujette aux erreurs, ce qui explique pourquoi des bibliothèques comme PHPMailer sont généralement préférées.</p>

        <div class="example">
            <div class="example-header">Email avec pièce jointe (méthode manuelle)</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="comment">// Destinataire et sujet</span>
<span class="variable">$to</span> = <span class="string">"destinataire@example.com"</span>;
<span class="variable">$subject</span> = <span class="string">"Email avec pièce jointe"</span>;

<span class="comment">// Générer un séparateur de sections unique</span>
<span class="variable">$boundary</span> = <span class="function">md5</span>(<span class="function">uniqid</span>(<span class="function">microtime</span>(), <span class="keyword">true</span>));

<span class="comment">// En-têtes pour l'email multipart</span>
<span class="variable">$headers</span> = <span class="string">"From: expediteur@example.com\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"MIME-Version: 1.0\r\n"</span>;
<span class="variable">$headers</span> .= <span class="string">"Content-Type: multipart/mixed; boundary=\""</span> . <span class="variable">$boundary</span> . <span class="string">"\"\r\n"</span>;

<span class="comment">// Préparer la pièce jointe</span>
<span class="variable">$fichier</span> = <span class="string">"document.pdf"</span>; <span class="comment">// Chemin vers le fichier</span>
<span class="variable">$contenuFichier</span> = <span class="function">file_get_contents</span>(<span class="variable">$fichier</span>);
<span class="variable">$contenuFichier</span> = <span class="function">chunk_split</span>(<span class="function">base64_encode</span>(<span class="variable">$contenuFichier</span>));
<span class="variable">$nomFichier</span> = <span class="function">basename</span>(<span class="variable">$fichier</span>);

<span class="comment">// Corps de l'email avec plusieurs parties</span>
<span class="variable">$message</span> = <span class="string">"--"</span> . <span class="variable">$boundary</span> . <span class="string">"\r\n"</span>;
<span class="variable">$message</span> .= <span class="string">"Content-Type: text/plain; charset=UTF-8\r\n"</span>;
<span class="variable">$message</span> .= <span class="string">"Content-Transfer-Encoding: 7bit\r\n\r\n"</span>;
<span class="variable">$message</span> .= <span class="string">"Voici votre document en pièce jointe.\r\n\r\n"</span>;

<span class="comment">// Ajouter la pièce jointe</span>
<span class="variable">$message</span> .= <span class="string">"--"</span> . <span class="variable">$boundary</span> . <span class="string">"\r\n"</span>;
<span class="variable">$message</span> .= <span class="string">"Content-Type: application/pdf; name=\""</span> . <span class="variable">$nomFichier</span> . <span class="string">"\"\r\n"</span>;
<span class="variable">$message</span> .= <span class="string">"Content-Transfer-Encoding: base64\r\n"</span>;
<span class="variable">$message</span> .= <span class="string">"Content-Disposition: attachment; filename=\""</span> . <span class="variable">$nomFichier</span> . <span class="string">"\"\r\n\r\n"</span>;
<span class="variable">$message</span> .= <span class="variable">$contenuFichier</span> . <span class="string">"\r\n\r\n"</span>;
<span class="variable">$message</span> .= <span class="string">"--"</span> . <span class="variable">$boundary</span> . <span class="string">"--"</span>;

<span class="function">mail</span>(<span class="variable">$to</span>, <span class="variable">$subject</span>, <span class="variable">$message</span>, <span class="variable">$headers</span>);</code></pre>
                <div class="result">
                    <p><strong>Explication :</strong></p>
                    <ul>
                        <li>Un <strong>boundary</strong> (séparateur) unique est généré pour délimiter les différentes parties de l'email</li>
                        <li>La pièce jointe est <strong>encodée en base64</strong> pour garantir sa transmission</li>
                        <li>Chaque section a son propre <strong>Content-Type</strong> qui définit son format</li>
                        <li>Le <strong>Content-Disposition: attachment</strong> indique qu'il s'agit d'une pièce jointe</li>
                    </ul>
                    <p><strong>Note :</strong> Cette méthode est complexe et difficile à déboguer, c'est pourquoi les bibliothèques spécialisées sont recommandées.</p>
                </div>
            </div>
        </div>

        <div class="info-box warning-box">
            <strong>Limites de la fonction mail()</strong>
            <ul>
                <li><strong>Pas de support natif pour les pièces jointes</strong> : requiert une implémentation manuelle du format MIME multipart</li>
                <li><strong>Configuration complexe</strong> pour les e-mails HTML et multipart</li>
                <li><strong>Gestion limitée des erreurs</strong> : difficile d'identifier la cause des échecs d'envoi</li>
                <li><strong>Dépendance à la configuration serveur</strong> : nécessite un serveur SMTP ou sendmail correctement configuré</li>
                <li><strong>Risque accru de classification comme spam</strong> : manque d'authentification avancée (SPF, DKIM, etc.)</li>
                <li><strong>Pas de file d'attente intégrée</strong> : les envois en masse peuvent surcharger le serveur</li>
            </ul>
            <p>Pour des fonctionnalités plus avancées et une meilleure délivrabilité, il est fortement recommandé d'utiliser des bibliothèques spécialisées comme PHPMailer ou Symfony Mailer.</p>
        </div>
    </section>
    <section class="section">
        <h2>Utilisation de PHPMailer</h2>
        <p>PHPMailer est une bibliothèque PHP populaire et robuste qui résout les limitations de la fonction native <code>mail()</code>. Elle offre des fonctionnalités avancées pour l'envoi d'e-mails, notamment le support SMTP, les pièces jointes et les e-mails HTML.</p>

        <div class="info-box">
            <strong>Pourquoi utiliser PHPMailer ?</strong>
            <p>PHPMailer est la bibliothèque d'envoi d'emails la plus utilisée dans l'écosystème PHP, et ce pour plusieurs raisons :</p>
            <ul>
                <li><strong>Compatibilité</strong> : Fonctionne avec PHP 5.5 et versions ultérieures</li>
                <li><strong>Sécurité</strong> : Support des connexions sécurisées (TLS/SSL), authentification SMTP</li>
                <li><strong>Fiabilité</strong> : Gestion des erreurs et exceptions détaillées</li>
                <li><strong>Flexibilité</strong> : Compatible avec différents serveurs SMTP (Gmail, Office365, etc.)</li>
                <li><strong>Fonctionnalités</strong> : Pièces jointes, images intégrées, emails HTML/texte, encodages internationaux</li>
                <li><strong>Communauté active</strong> : Plus de 17 000 étoiles sur GitHub et une maintenance continue</li>
            </ul>
        </div>

        <h3>Installation via Composer</h3>
        <div class="example">
            <div class="example-header">Installation de PHPMailer</div>
            <div class="example-content">
                <pre><code class="language-bash"><span class="function">composer</span> require phpmailer/phpmailer</code></pre>
                <div class="result">
                    <p>Cette commande va créer ou mettre à jour votre fichier <code>composer.json</code> et installer PHPMailer dans le dossier <code>vendor/</code>. Vous devrez ensuite inclure l'autoloader de Composer dans votre script :</p>
                    <pre><code class="language-php"><span class="keyword">require</span> <span class="string">'vendor/autoload.php'</span>;</code></pre>
                </div>
            </div>
        </div>

        <h3>Exemple d'envoi d'e-mail avec PHPMailer</h3>
        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Envoi avec SMTP</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// Importation des classes nécessaires</span>
<span class="keyword">use</span> PHPMailer\PHPMailer\PHPMailer;
<span class="keyword">use</span> PHPMailer\PHPMailer\Exception;
<span class="keyword">use</span> PHPMailer\PHPMailer\SMTP;

<span class="comment">// Chargement de l'autoloader</span>
<span class="keyword">require</span> <span class="string">'vendor/autoload.php'</span>;

<span class="comment">// Création d'une instance de PHPMailer</span>
<span class="variable">$mail</span> = <span class="keyword">new</span> <span class="class-name">PHPMailer</span>(<span class="keyword">true</span>); <span class="comment">// true active les exceptions</span>

<span class="keyword">try</span> {
    <span class="comment">// Configuration du serveur</span>
    <span class="variable">$mail</span>-><span class="variable">isSMTP</span>();
    <span class="variable">$mail</span>-><span class="variable">Host</span>       = <span class="string">'smtp.example.com'</span>;
    <span class="variable">$mail</span>-><span class="variable">SMTPAuth</span>   = <span class="keyword">true</span>;
    <span class="variable">$mail</span>-><span class="variable">Username</span>   = <span class="string">'utilisateur@example.com'</span>;
    <span class="variable">$mail</span>-><span class="variable">Password</span>   = <span class="string">'motdepasse'</span>;
    <span class="variable">$mail</span>-><span class="variable">SMTPSecure</span> = PHPMailer::ENCRYPTION_SMTPS; <span class="comment">// ou ENCRYPTION_STARTTLS</span>
    <span class="variable">$mail</span>-><span class="variable">Port</span>       = <span class="number">465</span>; <span class="comment">// ou 587 pour TLS</span>
    
    <span class="comment">// Pour le débogage (facultatif)</span>
    <span class="variable">$mail</span>-><span class="variable">SMTPDebug</span> = SMTP::DEBUG_OFF; <span class="comment">// 0 = off, 1 = messages client, 2 = messages client/serveur</span>
    
    <span class="comment">// Destinataires</span>
    <span class="variable">$mail</span>-><span class="variable">setFrom</span>(<span class="string">'expediteur@example.com'</span>, <span class="string">'Nom Expéditeur'</span>);
    <span class="variable">$mail</span>-><span class="variable">addAddress</span>(<span class="string">'destinataire@example.com'</span>, <span class="string">'Nom Destinataire'</span>);
    <span class="variable">$mail</span>-><span class="variable">addReplyTo</span>(<span class="string">'repondre@example.com'</span>, <span class="string">'Service client'</span>);
    <span class="variable">$mail</span>-><span class="variable">addCC</span>(<span class="string">'cc@example.com'</span>);
    <span class="variable">$mail</span>-><span class="variable">addBCC</span>(<span class="string">'bcc@example.com'</span>);
    
    <span class="comment">// Contenu</span>
    <span class="variable">$mail</span>-><span class="variable">isHTML</span>(<span class="keyword">true</span>);
    <span class="variable">$mail</span>-><span class="variable">Subject</span> = <span class="string">'Sujet de l\'e-mail'</span>;
    <span class="variable">$mail</span>-><span class="variable">Body</span>    = <span class="string">'Contenu de l\'e-mail en <b>HTML</b>'</span>;
    <span class="variable">$mail</span>-><span class="variable">AltBody</span> = <span class="string">'Contenu de l\'e-mail en texte brut'</span>;
    
    <span class="variable">$mail</span>-><span class="variable">send</span>();
    <span class="keyword">echo</span> <span class="string">'E-mail envoyé avec succès'</span>;
} <span class="keyword">catch</span> (Exception <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"Échec de l'envoi. Erreur: {<span class="variable">$mail</span>-><span class="variable">ErrorInfo</span>}"</span>;
}</code></pre>
                    <div class="result">
                        <p><strong>Avantages de PHPMailer par rapport à mail() :</strong></p>
                        <ul>
                            <li>Support complet du protocole SMTP</li>
                            <li>Gestion des authentifications</li>
                            <li>Meilleur débogage et gestion des erreurs</li>
                            <li>Moins susceptible d'être marqué comme spam</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header">Envoi avec pièce jointe</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// À ajouter dans le bloc try</span>

<span class="comment">// Ajouter une pièce jointe</span>
<span class="variable">$mail</span>-><span class="variable">addAttachment</span>(<span class="string">'/chemin/vers/fichier.pdf'</span>, <span class="string">'nouveau-nom.pdf'</span>);

<span class="comment">// Ajouter une image intégrée dans le HTML</span>
<span class="variable">$mail</span>-><span class="variable">addEmbeddedImage</span>(<span class="string">'logo.png'</span>, <span class="string">'logo_id'</span>);

<span class="comment">// Référencer l'image dans le HTML</span>
<span class="variable">$mail</span>-><span class="variable">Body</span> = <span class="string">'&lt;p&gt;Voici notre logo:&lt;/p&gt; 
&lt;img src="cid:logo_id" alt="Logo"&gt;
&lt;p&gt;Message suite...&lt;/p&gt;'</span>;</code></pre>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <h2>Utilisation de Symfony Mailer</h2>
        <p>Symfony Mailer est une bibliothèque moderne et puissante pour l'envoi d'e-mails, créée par l'équipe Symfony. Elle est particulièrement adaptée aux projets Symfony mais parfaitement utilisable dans tout projet PHP indépendant grâce à son architecture découplée.</p>

        <div class="info-box">
            <strong>Avantages de Symfony Mailer</strong>
            <p>Symfony Mailer se distingue par plusieurs caractéristiques qui en font une excellente alternative à PHPMailer :</p>
            <ul>
                <li><strong>Architecture moderne</strong> : Conçue selon les standards PHP modernes (namespaces, typage strict)</li>
                <li><strong>API fluide</strong> : Interface intuitive pour construire des emails</li>
                <li><strong>Transports modulaires</strong> : Supports pour divers services (SMTP, API Mailgun, SendGrid, etc.)</li>
                <li><strong>Système de templates</strong> : Intégration parfaite avec Twig pour des emails dynamiques</li>
                <li><strong>File d'attente intégrée</strong> : Fonctionne avec Symfony Messenger pour l'envoi asynchrone</li>
                <li><strong>Rapidité et performances</strong> : Optimisée pour les applications à fort trafic</li>
            </ul>
        </div>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header">PHPMailer vs Symfony Mailer</div>
                <div class="example-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Caractéristique</th>
                                <th>PHPMailer</th>
                                <th>Symfony Mailer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Courbe d'apprentissage</td>
                                <td>Plus simple pour débutants</td>
                                <td>Plus avancé, orienté objet</td>
                            </tr>
                            <tr>
                                <td>Intégration</td>
                                <td>Universelle</td>
                                <td>Idéale avec Symfony</td>
                            </tr>
                            <tr>
                                <td>Performances</td>
                                <td>Bonnes</td>
                                <td>Excellentes</td>
                            </tr>
                            <tr>
                                <td>File d'attente</td>
                                <td>Non intégrée</td>
                                <td>Via Symfony Messenger</td>
                            </tr>
                            <tr>
                                <td>Documentation</td>
                                <td>Complète, nombreux exemples</td>
                                <td>Excellente mais plus technique</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="result">
                        <p>Choisissez <strong>PHPMailer</strong> pour des projets simples ou si vous êtes débutant. Préférez <strong>Symfony Mailer</strong> pour les projets d'entreprise ou si vous utilisez déjà l'écosystème Symfony.</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Installation via Composer</h3>
        <div class="example">
            <div class="example-header">Installation de Symfony Mailer</div>
            <div class="example-content">
                <pre><code class="language-bash"><span class="function">composer</span> require symfony/mailer</code></pre>
                <p>Pour les transports spécifiques (comme Gmail), installez le package correspondant :</p>
                <pre><code class="language-bash"><span class="function">composer</span> require symfony/google-mailer  <span class="comment"># Pour Gmail</span>
<span class="function">composer</span> require symfony/amazon-mailer <span class="comment"># Pour Amazon SES</span>
<span class="function">composer</span> require symfony/mailgun-mailer <span class="comment"># Pour Mailgun</span>
<span class="function">composer</span> require symfony/sendgrid-mailer <span class="comment"># Pour SendGrid</span></code></pre>
            </div>
        </div>
        <h3>Exemple d'envoi avec Symfony Mailer</h3>
        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Envoi d'e-mail basique</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">require</span> <span class="string">'vendor/autoload.php'</span>;

<span class="keyword">use</span> Symfony\Component\Mailer\Transport;
<span class="keyword">use</span> Symfony\Component\Mailer\Mailer;
<span class="keyword">use</span> Symfony\Component\Mime\Email;

<span class="comment">// Créer le transport</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'smtp://utilisateur:motdepasse@smtp.example.com:465'</span>);

<span class="comment">// Créer le mailer avec ce transport</span>
<span class="variable">$mailer</span> = <span class="keyword">new</span> <span class="class-name">Mailer</span>(<span class="variable">$transport</span>);

<span class="comment">// Créer l'e-mail</span>
<span class="variable">$email</span> = (<span class="keyword">new</span> <span class="class-name">Email</span>())
    -><span class="variable">from</span>(<span class="string">'expediteur@example.com'</span>)
    -><span class="variable">to</span>(<span class="string">'destinataire@example.com'</span>)
    -><span class="variable">cc</span>(<span class="string">'cc@example.com'</span>)
    -><span class="variable">bcc</span>(<span class="string">'bcc@example.com'</span>)
    -><span class="variable">replyTo</span>(<span class="string">'reply@example.com'</span>)
    -><span class="variable">subject</span>(<span class="string">'Sujet de l\'e-mail'</span>)
    -><span class="variable">text</span>(<span class="string">'Contenu en texte brut'</span>)
    -><span class="variable">html</span>(<span class="string">'&lt;p&gt;Contenu en &lt;b&gt;HTML&lt;/b&gt;&lt;/p&gt;'</span>);

<span class="comment">// Envoyer l'e-mail</span>
<span class="keyword">try</span> {
    <span class="variable">$mailer</span>-><span class="variable">send</span>(<span class="variable">$email</span>);
    <span class="keyword">echo</span> <span class="string">'E-mail envoyé avec succès!'</span>;
} <span class="keyword">catch</span> (\Exception <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">'Erreur lors de l\'envoi : '</span> . <span class="variable">$e</span>-><span class="variable">getMessage</span>();
}</code></pre>
                    <div class="result">
                        <p><strong>Explication des éléments clés :</strong></p>
                        <ul>
                            <li>La <strong>chaîne DSN</strong> (Data Source Name) définit la configuration complète du transport</li>
                            <li>L'<strong>API fluide</strong> (méthode chaînée) permet de configurer l'email de manière intuitive</li>
                            <li>La méthode <code>html()</code> spécifie automatiquement le bon <strong>Content-Type</strong></li>
                            <li>La version texte et HTML sont envoyées pour assurer la <strong>compatibilité</strong> avec tous les clients mail</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header">Configuration des transports</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// SMTP standard</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'smtp://user:pass@smtp.example.com:587'</span>);

<span class="comment">// SMTP avec chiffrement explicite</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'smtp://user:pass@smtp.example.com:587?encryption=tls'</span>);

<span class="comment">// Gmail (nécessite symfony/google-mailer)</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'gmail://user:app_password@default'</span>);

<span class="comment">// Amazon SES (nécessite symfony/amazon-mailer)</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'ses://ACCESS_KEY:SECRET_KEY@default?region=eu-west-1'</span>);

<span class="comment">// Mailgun API (nécessite symfony/mailgun-mailer)</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'mailgun://KEY:DOMAIN@default'</span>);

<span class="comment">// Serveur SMTP local (pour développement)</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'smtp://localhost:1025'</span>); <span class="comment">// Ex: MailHog</span>

<span class="comment">// Email envoyé à un fichier de log (pour tests)</span>
<span class="variable">$transport</span> = Transport::fromDsn(<span class="string">'smtp://null'</span>);</code></pre>
                    <div class="result">
                        <p>La <strong>syntaxe DSN</strong> de Symfony Mailer permet de configurer facilement différents types de transport sans changer le reste de votre code d'envoi d'emails.</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Utilisation avancée avec pièces jointes</h3>
        <div class="example">
            <div class="example-header">Ajout de pièces jointes avec Symfony Mailer</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="keyword">use</span> Symfony\Component\Mime\Part\DataPart;
<span class="keyword">use</span> Symfony\Component\Mime\Part\File;

<span class="comment">// Ajouter un fichier en pièce jointe</span>
<span class="variable">$email</span>-><span class="variable">addPart</span>(
    <span class="keyword">new</span> <span class="class-name">DataPart</span>(
        <span class="keyword">new</span> <span class="class-name">File</span>(<span class="string">'/chemin/vers/document.pdf'</span>),
        <span class="string">'rapport.pdf'</span>,
        <span class="string">'application/pdf'</span>
    )
);

<span class="comment">// Ajouter une image intégrée dans le contenu HTML</span>
<span class="variable">$imagePath</span> = <span class="string">'/chemin/vers/image.jpg'</span>;
<span class="variable">$imageData</span> = <span class="function">file_get_contents</span>(<span class="variable">$imagePath</span>);
<span class="variable">$imageBase64</span> = <span class="function">base64_encode</span>(<span class="variable">$imageData</span>);
<span class="variable">$imageType</span> = <span class="function">mime_content_type</span>(<span class="variable">$imagePath</span>);

<span class="variable">$email</span>-><span class="variable">html</span>(<span class="string">'
&lt;p&gt;Bonjour,&lt;/p&gt;
&lt;p&gt;Voici l\'image intégrée :&lt;/p&gt;
&lt;img src="data:'</span> . <span class="variable">$imageType</span> . <span class="string">';base64,'</span> . <span class="variable">$imageBase64</span> . <span class="string">'" alt="Image intégrée" /&gt;
&lt;p&gt;Cordialement,&lt;/p&gt;
'</span>);</code></pre>
                <div class="result">
                    <p><strong>Note :</strong> Symfony Mailer gère automatiquement les e-mails multipart (HTML + texte), ce qui améliore la compatibilité avec tous les clients de messagerie.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <h2>Envoi d'e-mails HTML et bonnes pratiques</h2>

        <div class="info-box">
            <strong>Les défis de l'email HTML</strong>
            <p>Créer des emails HTML qui s'affichent correctement partout est l'un des plus grands défis du développement web pour plusieurs raisons :</p>
            <ul>
                <li><strong>Moteurs de rendu variés</strong> : Chaque client mail (Outlook, Gmail, iOS Mail, etc.) utilise son propre moteur de rendu</li>
                <li><strong>Support limité des CSS</strong> : De nombreuses propriétés CSS modernes sont ignorées</li>
                <li><strong>Manque de standardisation</strong> : Les emails n'ont pas évolué comme le web</li>
                <li><strong>Suppression des styles</strong> : Certains clients ignorent les balises <code>style</code> et les feuilles CSS externes</li>
                <li><strong>Filtres anti-spam</strong> : Les structures complexes peuvent être perçues comme suspectes</li>
            </ul>
        </div>

        <h3>Structure d'un e-mail HTML</h3>
        <p>La création d'e-mails HTML nécessite une approche différente du développement web traditionnel. Pour garantir une compatibilité maximale, il est recommandé de revenir aux bases avec des tableaux pour la mise en page et des styles en ligne.</p>

        <div class="example">
            <div class="example-header">Structure recommandée d'un e-mail HTML</div>
            <div class="example-content">
                <pre><code class="language-html"><span class="tag">&lt;!DOCTYPE</span> <span class="attr">html</span><span class="tag">&gt;</span>
<span class="tag">&lt;html&gt;</span>
<span class="tag">&lt;head&gt;</span>
    <span class="tag">&lt;meta</span> <span class="attr">charset</span>=<span class="string">"UTF-8"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;title&gt;</span>Titre de l'e-mail<span class="tag">&lt;/title&gt;</span>
    <span class="comment">&lt;!-- Styles en ligne uniquement, pas de fichiers CSS externes --&gt;</span>
    <span class="tag">&lt;style</span> <span class="attr">type</span>=<span class="string">"text/css"</span><span class="tag">&gt;</span>
        <span class="css-selector">body</span> {
            <span class="css-property">margin</span>: <span class="css-value">0</span>;
            <span class="css-property">padding</span>: <span class="css-value">0</span>;
            <span class="css-property">font-family</span>: <span class="css-value">Arial, sans-serif</span>;
            <span class="css-property">font-size</span>: <span class="css-value">14px</span>;
            <span class="css-property">line-height</span>: <span class="css-value">1.6</span>;
        }
        <span class="css-selector">.container</span> {
            <span class="css-property">width</span>: <span class="css-value">100%</span>;
            <span class="css-property">max-width</span>: <span class="css-value">600px</span>;
            <span class="css-property">margin</span>: <span class="css-value">0 auto</span>;
        }
        <span class="comment">/* Autres styles basiques */</span>
    <span class="tag">&lt;/style&gt;</span>
<span class="tag">&lt;/head&gt;</span>
<span class="tag">&lt;body&gt;</span>
    <span class="tag">&lt;table</span> <span class="attr">class</span>=<span class="string">"container"</span> <span class="attr">border</span>=<span class="string">"0"</span> <span class="attr">cellpadding</span>=<span class="string">"0"</span> <span class="attr">cellspacing</span>=<span class="string">"0"</span> <span class="attr">width</span>=<span class="string">"100%"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;tr&gt;</span>
            <span class="tag">&lt;td</span> <span class="attr">align</span>=<span class="string">"center"</span><span class="tag">&gt;</span>                <span class="comment">&lt;!-- En-tête de l'e-mail --&gt;</span>
                <span class="tag">&lt;table</span> <span class="attr">border</span>=<span class="string">"0"</span> <span class="attr">cellpadding</span>=<span class="string">"0"</span> <span class="attr">cellspacing</span>=<span class="string">"0"</span> <span class="attr">width</span>=<span class="string">"100%"</span><span class="tag">&gt;</span>
                    <span class="tag">&lt;tr&gt;</span>
                        <span class="tag">&lt;td</span> <span class="attr">align</span>=<span class="string">"center"</span> <span class="attr">style</span>=<span class="string">"padding: 20px;"</span><span class="tag">&gt;</span>
                            <span class="tag">&lt;img</span> <span class="attr">src</span>=<span class="string">"https://example.com/logo.png"</span> <span class="attr">alt</span>=<span class="string">"Logo"</span> <span class="attr">style</span>=<span class="string">"max-width: 200px;"</span><span class="tag">&gt;</span>                        <span class="tag">&lt;/td&gt;</span>
                    <span class="tag">&lt;/tr&gt;</span>
                <span class="tag">&lt;/table&gt;</span>
                
                <span class="comment">&lt;!-- Contenu principal --&gt;</span>
                <span class="tag">&lt;table</span> <span class="attr">border</span>=<span class="string">"0"</span> <span class="attr">cellpadding</span>=<span class="string">"0"</span> <span class="attr">cellspacing</span>=<span class="string">"0"</span> <span class="attr">width</span>=<span class="string">"100%"</span><span class="tag">&gt;</span>
                    <span class="tag">&lt;tr&gt;</span>
                        <span class="tag">&lt;td</span> <span class="attr">style</span>=<span class="string">"padding: 20px; background-color: #ffffff;"</span><span class="tag">&gt;</span>
                            <span class="tag">&lt;h1</span> <span class="attr">style</span>=<span class="string">"color: #333333;"</span><span class="tag">&gt;</span>Bonjour !<span class="tag">&lt;/h1&gt;</span>
                            <span class="tag">&lt;p&gt;</span>Contenu de votre message...<span class="tag">&lt;/p&gt;</span>
                            <span class="tag">&lt;p&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"https://example.com"</span> <span class="attr">style</span>=<span class="string">"background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;"</span><span class="tag">&gt;</span>Bouton d'action<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/p&gt;</span>                        <span class="tag">&lt;/td&gt;</span>
                    <span class="tag">&lt;/tr&gt;</span>
                <span class="tag">&lt;/table&gt;</span>
                
                <span class="comment">&lt;!-- Pied de page --&gt;</span>
                <span class="tag">&lt;table</span> <span class="attr">border</span>=<span class="string">"0"</span> <span class="attr">cellpadding</span>=<span class="string">"0"</span> <span class="attr">cellspacing</span>=<span class="string">"0"</span> <span class="attr">width</span>=<span class="string">"100%"</span><span class="tag">&gt;</span>
                    <span class="tag">&lt;tr&gt;</span>
                        <span class="tag">&lt;td</span> <span class="attr">align</span>=<span class="string">"center"</span> <span class="attr">style</span>=<span class="string">"padding: 20px; font-size: 12px; color: #666;"</span><span class="tag">&gt;</span>
                            <span class="tag">&lt;p&gt;</span>&copy; 2025 Mon Site. Tous droits réservés.<span class="tag">&lt;/p&gt;</span>
                            <span class="tag">&lt;p&gt;</span>
                                Si vous ne souhaitez plus recevoir nos e-mails, <span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"https://example.com/unsubscribe"</span><span class="tag">&gt;</span>cliquez ici pour vous désabonner<span class="tag">&lt;/a&gt;</span>.                            <span class="tag">&lt;/p&gt;</span>
                        <span class="tag">&lt;/td&gt;</span>
                    <span class="tag">&lt;/tr&gt;</span>
                <span class="tag">&lt;/table&gt;</span>
            <span class="tag">&lt;/td&gt;</span>
        <span class="tag">&lt;/tr&gt;</span>
    <span class="tag">&lt;/table&gt;</span>
<span class="tag">&lt;/body&gt;</span>
<span class="tag">&lt;/html&gt;</span></code></pre>
                <div class="result">
                    <p><strong>Conseils pour les e-mails HTML :</strong></p>
                    <ul>
                        <li>Utilisez des tableaux pour la mise en page (et non des divs/flexbox/grid)</li>
                        <li>Appliquez les styles directement aux éléments (inline CSS)</li>
                        <li>Évitez JavaScript (ignoré par la plupart des clients mail)</li>
                        <li>Limitez l'utilisation des CSS modernes</li>
                        <li>Testez sur plusieurs clients de messagerie</li>
                    </ul>
                </div>
            </div>
        </div>
        <h3>Sécurité et bonnes pratiques</h3>
        <div class="info-box warning-box">
            <strong>Risques de sécurité lors de l'envoi d'e-mails</strong>
            <ul>
                <li><strong>Injection de code</strong> : Ne jamais utiliser de données utilisateur non filtrées dans les en-têtes ou le corps de l'email</li>
                <li><strong>Usurpation d'identité</strong> : Configurer SPF, DKIM et DMARC pour authentifier vos emails</li>
                <li><strong>Exposition de données sensibles</strong> : Ne jamais inclure d'informations confidentielles dans les emails (mots de passe, données sensibles)</li>
                <li><strong>Cross-Site Request Forgery (CSRF)</strong> : Protéger les liens dans vos emails avec des tokens uniques</li>
                <li><strong>Classification comme spam</strong> : Suivre les bonnes pratiques d'envoi pour éviter les filtres anti-spam</li>
                <li><strong>Hameçonnage (phishing)</strong> : Éduquer vos utilisateurs sur la façon de reconnaître vos emails légitimes</li>
            </ul>
        </div>

        <div class="example">
            <div class="example-header">Protection contre l'injection de code</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="comment">// MAUVAIS : Données utilisateur non filtrées</span>
<span class="variable">$userInput</span> = <span class="variable">$_POST</span>[<span class="string">'message'</span>];
<span class="variable">$headers</span> = <span class="string">"From: "</span> . <span class="variable">$_POST</span>[<span class="string">'name'</span>] . <span class="string">" &lt;"</span> . <span class="variable">$_POST</span>[<span class="string">'email'</span>] . <span class="string">"&gt;\r\n"</span>;
<span class="function">mail</span>(<span class="string">"admin@example.com"</span>, <span class="string">"Contact"</span>, <span class="variable">$userInput</span>, <span class="variable">$headers</span>);

<span class="comment">// BON : Filtrage et validation des données</span>
<span class="variable">$userInput</span> = <span class="function">htmlspecialchars</span>(<span class="function">strip_tags</span>(<span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'message'</span>])));
<span class="variable">$name</span> = <span class="function">filter_var</span>(<span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'name'</span>]), <span class="constant">FILTER_SANITIZE_STRING</span>);
<span class="variable">$email</span> = <span class="function">filter_var</span>(<span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'email'</span>]), <span class="constant">FILTER_VALIDATE_EMAIL</span>);

<span class="keyword">if</span> (<span class="variable">$email</span> === <span class="keyword">false</span>) {
    <span class="keyword">die</span>(<span class="string">"Email non valide"</span>);
}

<span class="variable">$headers</span> = <span class="string">"From: "</span> . <span class="variable">$name</span> . <span class="string">" &lt;"</span> . <span class="variable">$email</span> . <span class="string">"&gt;\r\n"</span>;
<span class="function">mail</span>(<span class="string">"admin@example.com"</span>, <span class="string">"Contact"</span>, <span class="variable">$userInput</span>, <span class="variable">$headers</span>);</code></pre>
                <div class="result">
                    <p><strong>Explication :</strong> Sans filtrage, les attaquants pourraient injecter des en-têtes supplémentaires comme <code>Bcc:</code> pour envoyer des copies cachées à d'autres destinataires, ou même ajouter des pièces jointes malveillantes.</p>
                </div>
            </div>
        </div>

        <div class="info-box">
            <strong>Bonnes pratiques pour l'envoi d'e-mails</strong>
            <ol>
                <li><strong>Obtenir le consentement explicite</strong> avant d'envoyer des e-mails (conformité RGPD)</li>
                <li><strong>Offrir un moyen de se désabonner</strong> dans chaque e-mail</li>
                <li><strong>Utiliser des adresses d'expédition valides</strong> et des domaines vérifiés</li>
                <li><strong>Éviter les pièces jointes volumineuses</strong> : préférer des liens vers des téléchargements</li>
                <li><strong>Vérifier le score spam</strong> de vos e-mails (avec des outils comme mail-tester.com)</li>
                <li><strong>Configurer les enregistrements DNS</strong> appropriés :
                    <ul>
                        <li><strong>SPF</strong> (Sender Policy Framework) : authentifie les serveurs autorisés à envoyer des e-mails</li>
                        <li><strong>DKIM</strong> (DomainKeys Identified Mail) : signe cryptographiquement les e-mails</li>
                        <li><strong>DMARC</strong> (Domain-based Message Authentication) : définit la politique en cas d'échec SPF/DKIM</li>
                    </ul>
                </li>
                <li><strong>Surveiller les taux de rebond et de plaintes</strong> pour améliorer la délivrabilité</li>
            </ol>
        </div>

        <h3>Services d'envoi d'e-mails tiers</h3>
        <p>Pour les projets nécessitant des envois en masse ou une meilleure délivrabilité, envisagez d'utiliser un service d'envoi d'e-mails spécialisé :</p>
        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Services populaires</div>
                <div class="example-content">
                    <ul>
                        <li><strong>SendGrid</strong> : API robuste, bonne délivrabilité</li>
                        <li><strong>Mailjet</strong> : Populaire en Europe, conformité RGPD</li>
                        <li><strong>Amazon SES</strong> : Économique pour les grands volumes</li>
                        <li><strong>Mailgun</strong> : Excellente API pour les développeurs</li>
                        <li><strong>Brevo</strong> (ex-Sendinblue) : Solution complète avec CRM</li>
                    </ul>
                </div>
            </div>
            <div class="example">
                <div class="example-header">Exemple avec SendGrid et PHPMailer</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">use</span> PHPMailer\PHPMailer\PHPMailer;

<span class="variable">$mail</span> = <span class="keyword">new</span> <span class="class-name">PHPMailer</span>(<span class="keyword">true</span>);

<span class="variable">$mail</span>-><span class="variable">isSMTP</span>();
<span class="variable">$mail</span>-><span class="variable">Host</span>       = <span class="string">'smtp.sendgrid.net'</span>;
<span class="variable">$mail</span>-><span class="variable">SMTPAuth</span>   = <span class="keyword">true</span>;
<span class="variable">$mail</span>-><span class="variable">Username</span>   = <span class="string">'apikey'</span>;  <span class="comment">// Utilisateur spécial pour SendGrid</span>
<span class="variable">$mail</span>-><span class="variable">Password</span>   = <span class="string">'votre_cle_api_sendgrid'</span>;
<span class="variable">$mail</span>-><span class="variable">SMTPSecure</span> = PHPMailer::ENCRYPTION_STARTTLS;
<span class="variable">$mail</span>-><span class="variable">Port</span>       = <span class="number">587</span>;</code></pre>
                    <div class="result">
                        <p>Ces services offrent souvent des fonctionnalités supplémentaires comme :</p>
                        <ul>
                            <li>Suivi d'ouverture et de clics</li>
                            <li>Gestion des rebonds et désinscriptions</li>
                            <li>Templates d'e-mails</li>
                            <li>Analyses et statistiques</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Tests et débogage des emails</h2>
        <p>L'envoi d'emails est un processus complexe qui implique de nombreux acteurs (votre code, serveur SMTP, filtres anti-spam, client mail). Un bon processus de test est essentiel pour garantir la délivrabilité et l'affichage correct.</p>

        <div class="example">
            <div class="example-header">Outils de test d'emails</div>
            <div class="example-content">
                <table>
                    <thead>
                        <tr>
                            <th>Outil</th>
                            <th>Utilisation</th>
                            <th>Avantages</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>MailHog</strong></td>
                            <td>Serveur SMTP local pour développement</td>
                            <td>Capture tous les emails en environnement local sans rien envoyer réellement</td>
                        </tr>
                        <tr>
                            <td><strong>Mailtrap</strong></td>
                            <td>Boîte de réception de test en ligne</td>
                            <td>Interface web, analyse spam, rendu HTML/texte, outils d'analyse</td>
                        </tr>
                        <tr>
                            <td><strong>Litmus</strong> / <strong>Email on Acid</strong></td>
                            <td>Test de compatibilité client mail</td>
                            <td>Prévisualisations sur différents clients mail et appareils</td>
                        </tr>
                        <tr>
                            <td><strong>mail-tester.com</strong></td>
                            <td>Test de délivrabilité</td>
                            <td>Score de spam, vérification SPF/DKIM, conseils d'optimisation</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="info-box">
            <strong>Installation de MailHog pour le développement local</strong>
            <p>MailHog est un outil idéal pour tester les emails en local sans risquer d'envoyer des messages de test à de vrais destinataires.</p>
            <ol>
                <li>Installez MailHog (via Docker ou téléchargement direct)</li>
                <li>Configurez votre application pour utiliser SMTP sur <code>localhost:1025</code></li>
                <li>Accédez à l'interface web sur <code>http://localhost:8025</code></li>
                <li>Tous les emails envoyés seront interceptés et affichés dans l'interface</li>
            </ol>
            <p>Exemple de configuration PHPMailer avec MailHog :</p>
            <pre><code class="language-php"><span class="variable">$mail</span>-><span class="variable">isSMTP</span>();
<span class="variable">$mail</span>-><span class="variable">Host</span> = <span class="string">'localhost'</span>;
<span class="variable">$mail</span>-><span class="variable">Port</span> = <span class="number">1025</span>;
<span class="variable">$mail</span>-><span class="variable">SMTPAuth</span> = <span class="keyword">false</span>; <span class="comment">// Pas d'authentification nécessaire pour MailHog</span></code></pre>
        </div>

        <h3>Conseils pour une meilleure délivrabilité</h3>
        <p>L'envoi d'emails réussi ne concerne pas seulement le code, mais aussi la configuration et les bonnes pratiques.</p>
        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Configuration des enregistrements DNS</div>
                <div class="example-content">
                    <ul>
                        <li><strong>SPF (Sender Policy Framework)</strong> : Autorise certains serveurs à envoyer des emails pour votre domaine
                            <pre><code>TXT @ "v=spf1 ip4:192.0.2.0/24 include:_spf.example.com ~all"</code></pre>
                        </li>
                        <li><strong>DKIM (DomainKeys Identified Mail)</strong> : Signe numériquement les emails
                            <pre><code>TXT mail._domainkey "v=DKIM1; k=rsa; p=MIGfMA0GCSqGSIb3DQEBA..."</code></pre>
                        </li>
                        <li><strong>DMARC (Domain-based Message Authentication)</strong> : Définit la politique en cas d'échec SPF/DKIM
                            <pre><code>TXT _dmarc "v=DMARC1; p=quarantine; rua=mailto:dmarc@example.com"</code></pre>
                        </li>
                        <li><strong>MX</strong> : Configurez correctement vos enregistrements MX</li>
                    </ul>
                </div>
            </div>
            <div class="example">
                <div class="example-header">Liste de vérification délivrabilité</div>
                <div class="example-content">
                    <ul>
                        <li>✓ Authentification du domaine (SPF, DKIM, DMARC)</li>
                        <li>✓ Contenu équilibré (texte/images, pas de mots "spam")</li>
                        <li>✓ Éviter les pièces jointes volumineuses</li>
                        <li>✓ Sender reputation: envoi progressif pour nouveaux domaines</li>
                        <li>✓ Nettoyer régulièrement vos listes (hard bounces)</li>
                        <li>✓ IP dédiée pour grands volumes</li>
                        <li>✓ Tests réguliers avec des outils comme mail-tester.com</li>
                        <li>✓ Respecter les règles RGPD/CAN-SPAM (consentement, désinscription)</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="navigation">
        <a href="<?= BASE_URL ?>/modules/18-tests-unitaires.php" class="nav-button">← Module précédent</a>
        <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
        <a href="<?= BASE_URL ?>/modules/20-sessions-authentification.php" class="nav-button">Module suivant →</a>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>