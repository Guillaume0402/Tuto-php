<?php include __DIR__ . '/../includes/header-pro.php'; 



/**
 * Tutoriel PHP - Les Formulaires
 * Ce fichier explique comment créer et traiter des formulaires en PHP
 */

// Inclusion du fichier de configuration
require_once 'includes/config.php';

// Récupérer les informations de la page depuis la configuration
$pageKey = '09-les-formulaires';
$pageInfo = getPageInfo($pageKey);
$titre = $pageInfo['titre'];
$description = $pageInfo['description'];

// Variables pour le traitement du formulaire de démonstration
$formSubmitted = false;
$formData = [];
$formErrors = [];

// Traitement du formulaire d'exemple
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_demo'])) {
    $formSubmitted = true;

    // Récupération et validation des données
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $age = isset($_POST['age']) ? (int)$_POST['age'] : 0;
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validation basique
    if (empty($nom)) {
        $formErrors['nom'] = 'Le nom est obligatoire';
    }

    if (empty($email)) {
        $formErrors['email'] = 'L\'email est obligatoire';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formErrors['email'] = 'Format d\'email invalide';
    }

    if ($age < 18) {
        $formErrors['age'] = 'Vous devez avoir au moins 18 ans';
    }

    if (empty($message)) {
        $formErrors['message'] = 'Le message est obligatoire';
    }

    // Si pas d'erreur, on stocke les données
    if (empty($formErrors)) {
        $formData = [
            'nom' => htmlspecialchars($nom),
            'email' => htmlspecialchars($email),
            'age' => $age,
            'message' => htmlspecialchars($message),
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="module9">
    <header>
        <h1><?php echo $titre; ?></h1>
        <p class="subtitle"><?php echo $description; ?></p>
    </header>
    <div class="navigation">
        <a href="08-inclusions.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="10-POO-les-classes.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction aux formulaires</h2>
            <p>Les formulaires sont essentiels pour interagir avec les utilisateurs d'un site web. Ils permettent de recueillir des données, des commentaires, d'inscrire des utilisateurs et bien plus encore.</p>
            <p>En PHP, nous avons deux étapes principales pour travailler avec les formulaires :</p>
            <ol>
                <li><strong>Création du formulaire HTML</strong> avec des balises &lt;form&gt;, &lt;input&gt;, &lt;select&gt;, etc.</li>
                <li><strong>Traitement des données</strong> envoyées par l'utilisateur à l'aide de PHP.</li>
            </ol>

            <div class="info-box">
                <p><strong>Note :</strong> La sécurité est primordiale lorsqu'on manipule des données de formulaire. Toujours valider et nettoyer les entrées des utilisateurs pour éviter des failles comme les injections SQL ou les attaques XSS.</p>
            </div>
        </section>

        <section class="section">
            <h2>Création d'un formulaire HTML</h2>
            <p>Un formulaire HTML est défini par la balise &lt;form&gt; avec des attributs importants comme <code>method</code> (GET ou POST) et <code>action</code> (où envoyer les données).</p>

            <div class="example">
                <div class="example-header">Structure de base d'un formulaire</div>
                <div class="example-content">
                    <pre><code><span class="keyword">&lt;form</span> <span class="variable">method</span>=<span class="string">"post"</span> <span class="variable">action</span>=<span class="string">"traitement.php"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;div</span> <span class="variable">class</span>=<span class="string">"form-group"</span><span class="keyword">&gt;</span>
        <span class="keyword">&lt;label</span> <span class="variable">for</span>=<span class="string">"nom"</span><span class="keyword">&gt;</span>Nom<span class="keyword">&lt;/label&gt;</span>
        <span class="keyword">&lt;input</span> <span class="variable">type</span>=<span class="string">"text"</span> <span class="variable">id</span>=<span class="string">"nom"</span> <span class="variable">name</span>=<span class="string">"nom"</span> <span class="variable">required</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;/div&gt;</span>

    <span class="keyword">&lt;div</span> <span class="variable">class</span>=<span class="string">"form-group"</span><span class="keyword">&gt;</span>
        <span class="keyword">&lt;label</span> <span class="variable">for</span>=<span class="string">"email"</span><span class="keyword">&gt;</span>Email<span class="keyword">&lt;/label&gt;</span>
        <span class="keyword">&lt;input</span> <span class="variable">type</span>=<span class="string">"email"</span> <span class="variable">id</span>=<span class="string">"email"</span> <span class="variable">name</span>=<span class="string">"email"</span> <span class="variable">required</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;/div&gt;</span>

    <span class="keyword">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span><span class="keyword">&gt;</span>Envoyer<span class="keyword">&lt;/button&gt;</span>
<span class="keyword">&lt;/form&gt;</span></code></pre>
                </div>
            </div>

            <h3>Les principaux types de champs</h3>
            <ul>
                <li><strong>Champ texte :</strong> <code>&lt;input type="text"&gt;</code></li>
                <li><strong>Email :</strong> <code>&lt;input type="email"&gt;</code></li>
                <li><strong>Mot de passe :</strong> <code>&lt;input type="password"&gt;</code></li>
                <li><strong>Nombre :</strong> <code>&lt;input type="number"&gt;</code></li>
                <li><strong>Cases à cocher :</strong> <code>&lt;input type="checkbox"&gt;</code></li>
                <li><strong>Boutons radio :</strong> <code>&lt;input type="radio"&gt;</code></li>
                <li><strong>Menu déroulant :</strong> <code>&lt;select&gt;</code> avec des <code>&lt;option&gt;</code></li>
                <li><strong>Zone de texte :</strong> <code>&lt;textarea&gt;</code></li>
                <li><strong>Bouton d'envoi :</strong> <code>&lt;input type="submit"&gt;</code> ou <code>&lt;button type="submit"&gt;</code></li>
            </ul>
        </section>

        <section class="section">
            <h2>Méthodes GET et POST</h2>
            <p>Les deux méthodes principales pour envoyer des données de formulaires sont GET et POST :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Méthode GET</div>
                    <div class="example-content">
                        <ul>
                            <li>Les données sont ajoutées à l'URL</li>
                            <li>Format : <code>page.php?param1=valeur1&param2=valeur2</code></li>
                            <li>Limité en taille (environ 2048 caractères)</li>
                            <li>Visible dans l'historique du navigateur</li>
                            <li>Utile pour les recherches et les filtres</li>
                            <li>Non recommandé pour les données sensibles</li>
                            <li>Accessible via <code>$_GET</code> en PHP</li>
                        </ul>
                        <pre><code><span class="keyword">&lt;form</span> <span class="variable">method</span>=<span class="string">"get"</span> <span class="variable">action</span>=<span class="string">"search.php"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;input</span> <span class="variable">type</span>=<span class="string">"search"</span> <span class="variable">name</span>=<span class="string">"q"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span><span class="keyword">&gt;</span>Rechercher<span class="keyword">&lt;/button&gt;</span>
<span class="keyword">&lt;/form&gt;</span></code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Méthode POST</div>
                    <div class="example-content">
                        <ul>
                            <li>Les données sont envoyées dans le corps de la requête</li>
                            <li>Pas visible dans l'URL</li>
                            <li>Pas de limite de taille pratique</li>
                            <li>Non visible dans l'historique du navigateur</li>
                            <li>Idéal pour les formulaires d'inscription/connexion</li>
                            <li>Recommandé pour les données sensibles</li>
                            <li>Accessible via <code>$_POST</code> en PHP</li>
                        </ul>
                        <pre><code><span class="keyword">&lt;form</span> <span class="variable">method</span>=<span class="string">"post"</span> <span class="variable">action</span>=<span class="string">"login.php"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;input</span> <span class="variable">type</span>=<span class="string">"text"</span> <span class="variable">name</span>=<span class="string">"username"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;input</span> <span class="variable">type</span>=<span class="string">"password"</span> <span class="variable">name</span>=<span class="string">"password"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span><span class="keyword">&gt;</span>Connexion<span class="keyword">&lt;/button&gt;</span>
<span class="keyword">&lt;/form&gt;</span></code></pre>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Récupération des données en PHP</h2>
            <p>PHP fournit plusieurs variables superglobales pour accéder aux données des formulaires :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">$_GET</div>
                    <div class="example-content">
                        <p>Pour récupérer les données envoyées via méthode GET :</p>
                        <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Vérifier si le paramètre existe</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_GET</span>[<span class="string">'q'</span>])) {
    <span class="variable">$recherche</span> = <span class="function">htmlspecialchars</span>(<span class="variable">$_GET</span>[<span class="string">'q'</span>]);
    <span class="keyword">echo</span> <span class="string">"Vous avez recherché : "</span> . <span class="variable">$recherche</span>;
}
<span class="keyword">?&gt;</span></code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">$_POST</div>
                    <div class="example-content">
                        <p>Pour récupérer les données envoyées via méthode POST :</p>
                        <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Vérifier si le formulaire a été soumis</span>
<span class="keyword">if</span> (<span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>] === <span class="string">'POST'</span>) {
    <span class="variable">$username</span> = <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'username'</span>]) ? <span class="function">htmlspecialchars</span>(<span class="variable">$_POST</span>[<span class="string">'username'</span>]) : <span class="string">''</span>;
    <span class="variable">$password</span> = <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'password'</span>]) ? <span class="variable">$_POST</span>[<span class="string">'password'</span>] : <span class="string">''</span>;
    
    <span class="comment">// Traitement du login...</span>
}
<span class="keyword">?&gt;</span></code></pre>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header">$_REQUEST</div>
                <div class="example-content">
                    <p>Contient les données de $_GET, $_POST et $_COOKIE combinées :</p>
                    <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Récupère la valeur indépendamment de la méthode utilisée</span>
<span class="variable">$valeur</span> = <span class="function">isset</span>(<span class="variable">$_REQUEST</span>[<span class="string">'param'</span>]) ? <span class="function">htmlspecialchars</span>(<span class="variable">$_REQUEST</span>[<span class="string">'param'</span>]) : <span class="string">''</span>;

<span class="comment">// Pas recommandé pour le code de production car moins explicite</span>
<span class="keyword">?&gt;</span></code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Validation et sécurisation des données</h2>
            <p>La validation des données est essentielle pour assurer la sécurité et la fiabilité de votre application.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Validation basique</div>
                    <div class="example-content">
                        <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Vérification que les champs requis sont remplis</span>
<span class="variable">$errors</span> = [];

<span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$_POST</span>[<span class="string">'email'</span>])) {
    <span class="variable">$errors</span>[] = <span class="string">"L'email est obligatoire"</span>;
} <span class="keyword">elseif</span> (!<span class="function">filter_var</span>(<span class="variable">$_POST</span>[<span class="string">'email'</span>], <span class="constant">FILTER_VALIDATE_EMAIL</span>)) {
    <span class="variable">$errors</span>[] = <span class="string">"Format d'email invalide"</span>;
}

<span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$_POST</span>[<span class="string">'password'</span>])) {
    <span class="variable">$errors</span>[] = <span class="string">"Le mot de passe est obligatoire"</span>;
} <span class="keyword">elseif</span> (<span class="function">strlen</span>(<span class="variable">$_POST</span>[<span class="string">'password'</span>]) < <span class="number">8</span>) {
    <span class="variable">$errors</span>[] = <span class="string">"Le mot de passe doit contenir au moins 8 caractères"</span>;
}

<span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$errors</span>)) {
    <span class="comment">// Affichage des erreurs</span>
    <span class="keyword">foreach</span> (<span class="variable">$errors</span> <span class="keyword">as</span> <span class="variable">$error</span>) {
        <span class="keyword">echo</span> <span class="string">"<div class=\"error-message\">$error</div>"</span>;
    }
} <span class="keyword">else</span> {
    <span class="comment">// Traitement du formulaire valide</span>
}
<span class="keyword">?&gt;</span></code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Protection contre les attaques XSS</div>
                    <div class="example-content">
                        <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Échappement des données avant affichage</span>
<span class="variable">$nom</span> = <span class="function">htmlspecialchars</span>(<span class="variable">$_POST</span>[<span class="string">'nom'</span>]);

<span class="comment">// Alternative avec filter_var</span>
<span class="variable">$commentaire</span> = <span class="function">filter_var</span>(
    <span class="variable">$_POST</span>[<span class="string">'commentaire'</span>], 
    <span class="constant">FILTER_SANITIZE_SPECIAL_CHARS</span>
);

<span class="keyword">echo</span> <span class="string">"Bonjour, "</span> . <span class="variable">$nom</span> . <span class="string">"!"</span>;
<span class="keyword">?&gt;</span></code></pre>
                    </div>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>Attention :</strong> Ne faites jamais confiance aux données des utilisateurs. Validez et nettoyez toujours les entrées avant de les utiliser dans votre application.</p>
            </div>
        </section>

        <section class="section">
            <h2>Upload de fichiers</h2>
            <p>PHP permet également de gérer les téléchargements de fichiers à l'aide de la superglobale $_FILES.</p>

            <div class="example">
                <div class="example-header">Formulaire d'upload de fichiers</div>
                <div class="example-content">
                    <pre><code><span class="keyword">&lt;form</span> <span class="variable">method</span>=<span class="string">"post"</span> <span class="variable">enctype</span>=<span class="string">"multipart/form-data"</span> <span class="variable">action</span>=<span class="string">"upload.php"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;div</span> <span class="variable">class</span>=<span class="string">"form-group"</span><span class="keyword">&gt;</span>
        <span class="keyword">&lt;label</span> <span class="variable">for</span>=<span class="string">"fichier"</span><span class="keyword">&gt;</span>Sélectionner un fichier<span class="keyword">&lt;/label&gt;</span>
        <span class="keyword">&lt;input</span> <span class="variable">type</span>=<span class="string">"file"</span> <span class="variable">id</span>=<span class="string">"fichier"</span> <span class="variable">name</span>=<span class="string">"fichier"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;/div&gt;</span>
    <span class="keyword">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span><span class="keyword">&gt;</span>Envoyer<span class="keyword">&lt;/button&gt;</span>
<span class="keyword">&lt;/form&gt;</span></code></pre>
                    <p>Traitement côté serveur :</p>
                    <pre><code><span class="keyword">&lt;?php</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_FILES</span>[<span class="string">'fichier'</span>])) {
    <span class="variable">$tmpName</span> = <span class="variable">$_FILES</span>[<span class="string">'fichier'</span>][<span class="string">'tmp_name'</span>];
    <span class="variable">$name</span> = <span class="variable">$_FILES</span>[<span class="string">'fichier'</span>][<span class="string">'name'</span>];
    <span class="variable">$size</span> = <span class="variable">$_FILES</span>[<span class="string">'fichier'</span>][<span class="string">'size'</span>];
    <span class="variable">$error</span> = <span class="variable">$_FILES</span>[<span class="string">'fichier'</span>][<span class="string">'error'</span>];
    <span class="variable">$type</span> = <span class="variable">$_FILES</span>[<span class="string">'fichier'</span>][<span class="string">'type'</span>];
    
    <span class="comment">// Vérification des erreurs</span>
    <span class="keyword">if</span> (<span class="variable">$error</span> === <span class="constant">UPLOAD_ERR_OK</span>) {
        <span class="comment">// Vérification du type de fichier</span>
        <span class="comment">// Déplacement du fichier vers un dossier de destination</span>
        <span class="variable">$destination</span> = <span class="string">'uploads/'</span> . <span class="variable">$name</span>;
        <span class="keyword">if</span> (<span class="function">move_uploaded_file</span>(<span class="variable">$tmpName</span>, <span class="variable">$destination</span>)) {
            <span class="keyword">echo</span> <span class="string">"Le fichier a été téléchargé avec succès."</span>;
        } <span class="keyword">else</span> {
            <span class="keyword">echo</span> <span class="string">"Erreur lors du déplacement du fichier."</span>;
        }
    } <span class="keyword">else</span> {
        <span class="keyword">echo</span> <span class="string">"Erreur lors du téléchargement du fichier."</span>;
    }
}
<span class="keyword">?&gt;</span></code></pre>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Conseil :</strong> Limitez la taille et les types de fichiers acceptés. Utilisez <code>mime_content_type()</code> pour vérifier le type réel du fichier.</p>
            </div>
        </section>

        <section class="section">
            <h2>Exemple complet de formulaire</h2>
            <p>Voici un exemple de formulaire de contact complet avec validation et traitement des données :</p>

            <?php if ($formSubmitted && empty($formErrors)) : ?>
                <div class="success-message">
                    <p>Le formulaire a été soumis avec succès !</p>
                </div>
                <div class="form-result">
                    <h3>Données reçues :</h3>
                    <p><strong>Nom :</strong> <?php echo $formData['nom']; ?></p>
                    <p><strong>Email :</strong> <?php echo $formData['email']; ?></p>
                    <p><strong>Âge :</strong> <?php echo $formData['age']; ?> ans</p>
                    <p><strong>Message :</strong> <?php echo nl2br($formData['message']); ?></p>
                </div>
            <?php else : ?>
                <div class="demo-form">
                    <h3>Formulaire de contact</h3>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
                            <?php if (isset($formErrors['nom'])) : ?>
                                <div class="error-message"><?php echo $formErrors['nom']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            <?php if (isset($formErrors['email'])) : ?>
                                <div class="error-message"><?php echo $formErrors['email']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="age">Âge</label>
                            <input type="number" id="age" name="age" min="1" max="120" value="<?php echo isset($_POST['age']) ? (int)$_POST['age'] : ''; ?>">
                            <?php if (isset($formErrors['age'])) : ?>
                                <div class="error-message"><?php echo $formErrors['age']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                            <?php if (isset($formErrors['message'])) : ?>
                                <div class="error-message"><?php echo $formErrors['message']; ?></div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" name="submit_demo">Envoyer</button>
                        <button type="reset" class="btn-secondary">Réinitialiser</button>
                    </form>
                </div>

                <div class="example">
                    <div class="example-header">Code du formulaire</div>
                    <div class="example-content">
                        <pre><code><span class="keyword">&lt;?php</span>
<span class="variable">$formSubmitted</span> = <span class="keyword">false</span>;
<span class="variable">$formErrors</span> = [];

<span class="keyword">if</span> (<span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>] === <span class="string">'POST'</span> && <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'submit_demo'</span>])) {
    <span class="variable">$formSubmitted</span> = <span class="keyword">true</span>;
    
    <span class="comment">// Récupération et validation</span>
    <span class="variable">$nom</span> = <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'nom'</span>]) ? <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'nom'</span>]) : <span class="string">''</span>;
    <span class="variable">$email</span> = <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'email'</span>]) ? <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'email'</span>]) : <span class="string">''</span>;
    <span class="variable">$age</span> = <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'age'</span>]) ? (<span class="keyword">int</span>)<span class="variable">$_POST</span>[<span class="string">'age'</span>] : <span class="number">0</span>;
    <span class="variable">$message</span> = <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'message'</span>]) ? <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'message'</span>]) : <span class="string">''</span>;
    
    <span class="comment">// Validation basique</span>
    <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$nom</span>)) {
        <span class="variable">$formErrors</span>[<span class="string">'nom'</span>] = <span class="string">'Le nom est obligatoire'</span>;
    }
    
    <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$email</span>)) {
        <span class="variable">$formErrors</span>[<span class="string">'email'</span>] = <span class="string">'L\'email est obligatoire'</span>;
    } <span class="keyword">elseif</span> (!<span class="function">filter_var</span>(<span class="variable">$email</span>, <span class="constant">FILTER_VALIDATE_EMAIL</span>)) {
        <span class="variable">$formErrors</span>[<span class="string">'email'</span>] = <span class="string">'Format d\'email invalide'</span>;
    }
    
    <span class="keyword">if</span> (<span class="variable">$age</span> < <span class="number">18</span>) {
        <span class="variable">$formErrors</span>[<span class="string">'age'</span>] = <span class="string">'Vous devez avoir au moins 18 ans'</span>;
    }
    
    <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$message</span>)) {
        <span class="variable">$formErrors</span>[<span class="string">'message'</span>] = <span class="string">'Le message est obligatoire'</span>;
    }
}
<span class="keyword">?&gt;</span></code></pre>
                    </div>
                </div>
            <?php endif; ?>

            <div class="tip-box">
                <p><strong>Bonnes pratiques :</strong></p>
                <ul>
                    <li>Affichez les messages d'erreur à côté des champs correspondants</li>
                    <li>Conservez les valeurs déjà saisies en cas d'erreur</li>
                    <li>Utilisez des types de champs appropriés (email, number, etc.)</li>
                    <li>Validez les données côté serveur, même si une validation côté client est en place</li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2>Bonnes pratiques de sécurité</h2>
            <ul>
                <li><strong>Validation stricte :</strong> Validez toutes les données selon le type attendu.</li>
                <li><strong>Échappement HTML :</strong> Utilisez <code>htmlspecialchars()</code> pour éviter les attaques XSS.</li>
                <li><strong>Requêtes préparées :</strong> Pour les interactions avec une base de données, utilisez toujours des requêtes préparées.</li>
                <li><strong>CSRF Protection :</strong> Utilisez des jetons CSRF pour protéger vos formulaires.</li>
                <li><strong>Limiter les uploads :</strong> Restreignez les types et les tailles de fichiers acceptés.</li>
                <li><strong>Captcha :</strong> Pour les formulaires publics, ajoutez une protection contre les robots.</li>
            </ul>

            <div class="example">
                <div class="example-header">Protection CSRF basique</div>
                <div class="example-content">
                    <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Génération d'un jeton CSRF dans la session</span>
<span class="function">session_start</span>();
<span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>])) {
    <span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>] = <span class="function">bin2hex</span>(<span class="function">random_bytes</span>(<span class="number">32</span>));
}
<span class="variable">$csrf_token</span> = <span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>];
<span class="keyword">?&gt;</span>

<span class="keyword">&lt;form</span> <span class="variable">method</span>=<span class="string">"post"</span><span class="keyword">&gt;</span>
    <span class="comment">&lt;!-- Champ caché pour le jeton CSRF --&gt;</span>
    <span class="keyword">&lt;input</span> <span class="variable">type</span>=<span class="string">"hidden"</span> <span class="variable">name</span>=<span class="string">"csrf_token"</span> <span class="variable">value</span>=<span class="string">"&lt;?php echo $csrf_token; ?&gt;"</span><span class="keyword">&gt;</span>
    <span class="comment">&lt;!-- Autres champs du formulaire --&gt;</span>
<span class="keyword">&lt;/form&gt;</span>

<span class="keyword">&lt;?php</span>
<span class="comment">// Vérification du jeton CSRF lors de la soumission</span>
<span class="keyword">if</span> (<span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>] === <span class="string">'POST'</span>) {
    <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'csrf_token'</span>])) {
        <span class="keyword">die</span>(<span class="string">'Jeton CSRF manquant!'</span>);
    }
    
    <span class="keyword">if</span> (!<span class="function">hash_equals</span>(<span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>], <span class="variable">$_POST</span>[<span class="string">'csrf_token'</span>])) {
        <span class="keyword">die</span>(<span class="string">'Validation CSRF échouée!'</span>);
    }
    
    <span class="comment">// Le jeton est valide, traiter le formulaire</span>
}
<span class="keyword">?&gt;</span></code></pre>
                </div>
            </div>
        </section>
        <div class="navigation">
            <a href="08-inclusions.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="10-POO-les-classes.php" class="nav-button">Module suivant →</a>
        </div>
    </main>
</body>

</html>
<?php include __DIR__ . '/../includes/footer.php'; ?>