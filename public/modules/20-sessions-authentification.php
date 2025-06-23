<?php include __DIR__ . '/../includes/header-pro.php';
$titre = "Gestion des sessions et authentification";
$description = "Apprenez à gérer les sessions PHP, créer un système d'authentification sécurisé et mettre en place une gestion des droits utilisateurs.";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="module20">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </header>
    <div class="navigation">
        <a href="19-envoi-emails.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="21-internationalisation.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Sessions PHP, cookies et sécurité</h2>
            <p>Les sessions PHP permettent de stocker des informations spécifiques à un utilisateur sur plusieurs pages. Contrairement aux cookies, les données de session sont stockées sur le serveur, ce qui améliore la sécurité.</p>

            <div class="info-box">
                <strong>Comprendre les sessions PHP</strong>
                <p>Une session crée un identifiant unique (PHPSESSID) qui est envoyé au navigateur de l'utilisateur sous forme de cookie. Cet identifiant permet au serveur de retrouver les données stockées pour cet utilisateur spécifique.</p>
                <ul>
                    <li><strong>Cycle de vie</strong> : Une session démarre avec <code>session_start()</code> et se termine quand le navigateur est fermé ou après expiration définie dans la configuration PHP.</li>
                    <li><strong>Stockage des données</strong> : Par défaut, les données sont sauvegardées dans des fichiers temporaires sur le serveur (dans le dossier défini par <code>session.save_path</code>).</li>
                    <li><strong>Alternative aux cookies</strong> : Dans les environnements où les cookies sont désactivés, les sessions peuvent utiliser l'URL pour transmettre l'identifiant de session (non recommandé pour des raisons de sécurité).</li>
                </ul>
            </div>

            <h3>Fonctionnement des sessions PHP</h3>
            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Démarrer une session</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// À placer au tout début du script, avant tout autre output</span>
<span class="function">session_start</span>();

<span class="comment">// Stocker des données dans la session</span>
<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>] = <span class="number">123</span>;
<span class="variable">$_SESSION</span>[<span class="string">'username'</span>] = <span class="string">'jean_dupont'</span>;
<span class="variable">$_SESSION</span>[<span class="string">'is_admin'</span>] = <span class="keyword">false</span>;</code></pre>
                        <div class="result">
                            <p><strong>Important :</strong> <code>session_start()</code> doit être appelé avant tout affichage HTML ou espace blanc, sinon une erreur "headers already sent" peut se produire.</p>

                            <h4>Détails techniques</h4>
                            <ul>
                                <li>La fonction <code>session_start()</code> génère ou récupère l'identifiant de session existant</li>
                                <li>PHP crée automatiquement la superglobale <code>$_SESSION</code> qui agit comme un tableau associatif</li>
                                <li>Les données stockées dans $_SESSION sont automatiquement sérialisées pour le stockage côté serveur</li>
                                <li>Vous pouvez stocker différents types de données : nombres, chaînes, booléens et même des tableaux ou objets (attention à la sérialisation des objets complexes)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Accéder aux données de session</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Récupérer une valeur de session</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'username'</span>])) {
    <span class="keyword">echo</span> <span class="string">"Bonjour, {<span class="variable">$_SESSION</span>[<span class="string>'username'</span>]} !"</span>;
}

<span class="comment">// Vérifier si l'utilisateur est connecté</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string>'user_id'</span>])) {
    <span class="comment">// Utilisateur connecté</span>
} <span class="keyword">else</span> {
    <span class="comment">// Utilisateur non connecté</span>
    <span class="function">header</span>(<span class="string">'Location: login.php'</span>);
    <span class="keyword">exit</span>;
}</code></pre>
                        <div class="result">
                            <h4>Bonnes pratiques pour accéder aux données de session</h4>
                            <ul>
                                <li><strong>Vérification préalable</strong> : Toujours utiliser <code>isset()</code> pour vérifier l'existence d'une clé avant d'y accéder</li>
                                <li><strong>Redirection sécurisée</strong> : Appeler <code>exit</code> après <code>header('Location: ...')</code> pour arrêter l'exécution du script</li>
                                <li><strong>Protection des routes</strong> : Intégrer la vérification de session dans un système de middleware pour protéger les routes qui nécessitent une connexion</li>
                                <li><strong>Utilisation des types stricts</strong> : Caster les valeurs au besoin car toutes les données de session sont sérialisées puis désérialisées</li>
                            </ul>
                            <p>Les opérateurs de coalescence null peuvent simplifier la récupération de données de session avec des valeurs par défaut : <code>$username = $_SESSION['username'] ?? 'Invité';</code></p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Destruction de session et déconnexion</h3>
            <div class="example">
                <div class="example-header">Déconnexion d'un utilisateur</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// logout.php</span>
<span class="function">session_start</span>();

<span class="comment">// Effacer toutes les variables de session</span>
<span class="variable">$_SESSION</span> = [];

<span class="comment">// Récupérer les paramètres de session</span>
<span class="variable">$params</span> = <span class="function">session_get_cookie_params</span>();

<span class="comment">// Supprimer le cookie de session</span>
<span class="function">setcookie</span>(
    <span class="function">session_name</span>(),
    <span class="string">''</span>,
    <span class="function">time</span>() - <span class="number">42000</span>,
    <span class="variable">$params</span>[<span class="string">'path'</span>],
    <span class="variable">$params</span>[<span class="string">'domain'</span>],
    <span class="variable">$params</span>[<span class="string">'secure'</span>],
    <span class="variable">$params</span>[<span class="string">'httponly'</span>]
);

<span class="comment">// Détruire la session</span>
<span class="function">session_destroy</span>();

<span class="comment">// Rediriger vers la page d'accueil</span>
<span class="function">header</span>(<span class="string">'Location: index.php'</span>);
<span class="keyword">exit</span>;</code></pre>
                    <div class="result">
                        <p>Cette méthode complète permet d'assurer une déconnexion sécurisée en :</p>
                        <ol>
                            <li>Vidant les données de session</li>
                            <li>Supprimant le cookie de session</li>
                            <li>Détruisant la session côté serveur</li>
                        </ol>

                        <h4>Pourquoi cette approche en trois étapes ?</h4>
                        <ul>
                            <li><code>$_SESSION = []</code> : Efface immédiatement les données en mémoire pour l'exécution actuelle</li>
                            <li><code>setcookie(session_name(), '', ...)</code> : Force le navigateur à supprimer le cookie PHPSESSID, empêchant sa réutilisation</li>
                            <li><code>session_destroy()</code> : Supprime le fichier de session physique sur le serveur, mais n'affecte pas la variable superglobale $_SESSION</li>
                        </ul>

                        <div class="tip-box">
                            <strong>Astuce de sécurité</strong>
                            <p>Pour renforcer encore cette déconnexion, considérez l'ajout d'un jeton de session unique dans la base de données qui est vérifié à chaque requête et invalidé lors de la déconnexion. Cela permet de déconnecter immédiatement un utilisateur sur tous ses appareils.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Configuration et sécurité des sessions</h3>
            <div class="info-box">
                <strong>Paramètres de sécurité des sessions</strong>
                <pre><code class="language-php"><span class="comment">// Configurer les sessions avant de les démarrer</span>
<span class="function">ini_set</span>(<span class="string">'session.use_only_cookies'</span>, <span class="number">1</span>); <span class="comment">// Forcer l'utilisation de cookies</span>
<span class="function">ini_set</span>(<span class="string">'session.use_strict_mode'</span>, <span class="number">1</span>); <span class="comment">// Accepter uniquement les IDs valides</span>

<span class="variable">$sessionParams</span> = [
    <span class="string">'lifetime'</span> => <span class="number">3600</span>,     <span class="comment">// Durée de vie du cookie en secondes</span>
    <span class="string">'path'</span>     => <span class="string">'/'</span>,      <span class="comment">// Chemin sur le domaine où le cookie sera disponible</span>
    <span class="string">'domain'</span>   => <span class="string">''</span>,       <span class="comment">// Domaine du cookie (vide = domaine actuel)</span>
    <span class="string">'secure'</span>   => <span class="keyword">true</span>,    <span class="comment">// Cookie uniquement via HTTPS</span>
    <span class="string">'httponly'</span> => <span class="keyword">true</span>,    <span class="comment">// Cookie inaccessible en JavaScript</span>
    <span class="string">'samesite'</span> => <span class="string">'Lax'</span>     <span class="comment">// Protection contre les attaques CSRF</span>
];

<span class="function">session_set_cookie_params</span>(<span class="variable">$sessionParams</span>);
<span class="function">session_start</span>();</code></pre>
                <div class="explanation">
                    <h4>Explication des paramètres de sécurité</h4>
                    <table class="parameter-table">
                        <tr>
                            <th>Paramètre</th>
                            <th>Description</th>
                            <th>Impact sécurité</th>
                        </tr>
                        <tr>
                            <td><code>session.use_only_cookies</code></td>
                            <td>Force l'utilisation exclusive des cookies pour l'ID de session</td>
                            <td>Empêche les attaques par injection d'ID de session dans l'URL</td>
                        </tr>
                        <tr>
                            <td><code>session.use_strict_mode</code></td>
                            <td>Accepte uniquement les IDs générés par le serveur</td>
                            <td>Empêche la fixation de session par des ID arbitraires</td>
                        </tr>
                        <tr>
                            <td><code>secure</code></td>
                            <td>Cookie envoyé uniquement via HTTPS</td>
                            <td>Prévient l'interception de l'ID sur un réseau non sécurisé</td>
                        </tr>
                        <tr>
                            <td><code>httponly</code></td>
                            <td>Cookie inaccessible via JavaScript</td>
                            <td>Protège contre les attaques XSS ciblant les cookies</td>
                        </tr>
                        <tr>
                            <td><code>samesite</code></td>
                            <td>Contrôle l'envoi du cookie lors de requêtes cross-origin</td>
                            <td>Protège contre les attaques CSRF</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="info-box warning-box">
                <strong>Menaces courantes et contre-mesures</strong>
                <ul>
                    <li><strong>Fixation de session</strong> : Régénérer l'ID de session à la connexion avec <code>session_regenerate_id(true)</code></li>
                    <li><strong>Vol de session</strong> : Utiliser les flags httpOnly, secure et SameSite pour les cookies</li>
                    <li><strong>CSRF</strong> (Cross-Site Request Forgery) : Générer et vérifier des tokens CSRF pour les formulaires</li>
                    <li><strong>Expiration</strong> : Définir une durée de vie raisonnable pour les sessions et cookies</li>
                </ul>
            </div>
            <h3>Cookies en PHP</h3>
            <div class="info-box">
                <strong>Différence entre Cookies et Sessions</strong>
                <table class="comparison-table">
                    <tr>
                        <th>Aspect</th>
                        <th>Cookies</th>
                        <th>Sessions</th>
                    </tr>
                    <tr>
                        <td>Stockage</td>
                        <td>Stockés dans le navigateur du client</td>
                        <td>Stockés sur le serveur</td>
                    </tr>
                    <tr>
                        <td>Sécurité</td>
                        <td>Moins sécurisé (accessible au client)</td>
                        <td>Plus sécurisé (seul l'ID est envoyé au client)</td>
                    </tr>
                    <tr>
                        <td>Durée de vie</td>
                        <td>Peut persister longtemps (jours, mois)</td>
                        <td>Généralement limitée à la session du navigateur</td>
                    </tr>
                    <tr>
                        <td>Taille</td>
                        <td>Limitée (~4KB par domaine)</td>
                        <td>Plus grande (limitée par la configuration serveur)</td>
                    </tr>
                    <tr>
                        <td>Cas d'usage</td>
                        <td>Préférences, suivi à long terme</td>
                        <td>Authentification, données temporaires</td>
                    </tr>
                </table>
            </div>

            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Créer un cookie</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Créer un cookie qui expire dans 30 jours</span>
<span class="function">setcookie</span>(
    <span class="string">'user_preference'</span>,       <span class="comment">// Nom du cookie</span>
    <span class="string>'dark_theme'</span>,            <span class="comment">// Valeur</span>
    [
        <span class="string">'expires'</span>  => <span class="function">time</span>() + <span class="number">30</span> * <span class="number">24</span> * <span class="number">3600</span>,  <span class="comment">// 30 jours</span>
        <span class="string">'path'</span>     => <span class="string">'/'</span>,              <span class="comment">// Disponible sur tout le site</span>
        <span class="string>'domain'</span>   => <span class="string">''</span>,               <span class="comment">// Domaine actuel</span>
        <span class="string">'secure'</span>   => <span class="keyword">true</span>,            <span class="comment">// HTTPS uniquement</span>
        <span class="string">'httponly'</span> => <span class="keyword">false</span>,           <span class="comment">// Accessible en JavaScript</span>
        <span class="string">'samesite'</span> => <span class="string>'Strict'</span>          <span class="comment">// Protection CSRF</span>
    ]
);</code></pre>
                        <div class="result">
                            <p>Cette syntaxe d'options sous forme de tableau est disponible à partir de PHP 7.3. Pour les versions antérieures, utilisez les paramètres individuels de <code>setcookie()</code>.</p>

                            <h4>Explication des paramètres du cookie</h4>
                            <ul>
                                <li><strong>expires</strong> : Date d'expiration du cookie (timestamp Unix). Si non défini ou 0, le cookie expire à la fin de la session.</li>
                                <li><strong>path</strong> : Chemin sur le serveur où le cookie sera disponible. <code>'/'</code> signifie disponible sur tout le site.</li>
                                <li><strong>domain</strong> : Domaine pour lequel le cookie est disponible. Vide signifie domaine actuel uniquement.</li>
                                <li><strong>secure</strong> : Si <code>true</code>, le cookie est envoyé uniquement sur une connexion HTTPS sécurisée.</li>
                                <li><strong>httponly</strong> : Si <code>true</code>, le cookie est inaccessible via JavaScript (protection XSS).</li>
                                <li><strong>samesite</strong> : Contrôle l'envoi du cookie lors de requêtes cross-origin :
                                    <ul>
                                        <li><code>'Strict'</code> : Cookie envoyé uniquement pour les requêtes du même site.</li>
                                        <li><code>'Lax'</code> : Cookie envoyé pour les navigations top-level et requêtes GET.</li>
                                        <li><code>'None'</code> : Cookie envoyé pour toutes les requêtes (nécessite secure=true).</li>
                                    </ul>
                                </li>
                            </ul>

                            <div class="warning-box">
                                <strong>Important</strong> : <code>setcookie()</code> doit être appelé avant tout affichage HTML, comme <code>session_start()</code>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Lire et supprimer un cookie</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Lire un cookie</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_COOKIE</span>[<span class="string">'user_preference'</span>])) {
    <span class="variable">$theme</span> = <span class="variable">$_COOKIE</span>[<span class="string">'user_preference'</span>];
    <span class="keyword">echo</span> <span class="string">"Thème choisi : {<span class="variable">$theme</span>}"</span>;
}

<span class="comment">// Supprimer un cookie (en le faisant expirer)</span>
<span class="function">setcookie</span>(
    <span class="string>'user_preference'</span>, 
    <span class="string">''</span>, 
    [
        <span class="string>'expires'</span> => <span class="function">time</span>() - <span class="number">3600</span>,  <span class="comment">// Passé</span>
        <span class="string>'path'</span>    => <span class="string">'/'</span>
    ]
);</code></pre>
                        <div class="result">
                            <h4>Points importants sur la gestion des cookies</h4>
                            <ol>
                                <li><strong>Lecture</strong> : Les cookies sont disponibles dans la superglobale <code>$_COOKIE</code> sous forme de tableau associatif.</li>
                                <li><strong>Validation</strong> : Toujours vérifier l'existence du cookie avec <code>isset()</code> avant d'y accéder.</li>
                                <li><strong>Suppression</strong> : Pour supprimer un cookie, il faut le remplacer par un cookie vide avec une date d'expiration dans le passé.</li>
                                <li><strong>Paramètres identiques</strong> : Lors de la suppression, le path et le domain doivent être identiques à ceux utilisés lors de la création.</li>
                            </ol>

                            <div class="tip-box">
                                <strong>Astuce pratique</strong>
                                <p>Pour déboguer les cookies, utilisez les outils de développement du navigateur (F12) puis allez dans l'onglet "Application" > "Cookies". Vous y verrez tous les cookies, leurs valeurs et propriétés.</p>
                            </div>

                            <div class="example-code">
                                <strong>Exemple d'utilisation sécurisée des cookies pour le consentement</strong>
                                <pre><code class="language-php"><span class="comment">// Créer un cookie de consentement sécurisé</span>
<span class="keyword">function</span> <span class="function">setConsentCookie</span>(<span class="variable">$consentements</span>) {
    <span class="comment">// Sérialiser les données dans un format sécurisé</span>
    <span class="variable">$data</span> = <span class="function">json_encode</span>(<span class="variable">$consentements</span>);
    
    <span class="comment">// Signer les données pour éviter les manipulations</span>
    <span class="variable">$signature</span> = <span class="function">hash_hmac</span>(<span class="string">'sha256'</span>, <span class="variable">$data</span>, <span class="variable">$_ENV</span>[<span class="string">'COOKIE_SECRET'</span>]);
    
    <span class="comment">// Définir le cookie avec sa signature</span>
    <span class="function">setcookie</span>(
        <span class="string>'user_consent'</span>,
        <span class="variable">$data</span> . <span class="string">'.'</span> . <span class="variable">$signature</span>,
        [
            <span class="string>'expires'</span>  => <span class="function">time</span>() + <span class="number">365</span> * <span class="number">24</span> * <span class="number">3600</span>,
            <span class="string>'path'</span>     => <span class="string>'/'</span>,
            <span class="string>'secure'</span>   => <span class="keyword">true</span>,
            <span class="string>'httponly'</span> => <span class="keyword">true</span>,
            <span class="string>'samesite'</span> => <span class="string>'Lax'</span>
        ]
    );
}</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Création d'un système de connexion/déconnexion</h2>
            <p>Un système d'authentification sécurisé est essentiel pour toute application web qui nécessite des utilisateurs identifiés. Voici les composants clés :</p>

            <h3>Structure de la base de données</h3>
            <div class="example">
                <div class="example-header">Table des utilisateurs</div>
                <div class="example-content">
                    <pre><code class="language-sql"><span class="keyword">CREATE</span> <span class="keyword">TABLE</span> users (
    id <span class="type">INT</span> <span class="keyword">AUTO_INCREMENT</span> <span class="keyword">PRIMARY KEY</span>,
    username <span class="type">VARCHAR</span>(50) <span class="keyword">NOT NULL</span> <span class="keyword">UNIQUE</span>,
    email <span class="type">VARCHAR</span>(100) <span class="keyword">NOT NULL</span> <span class="keyword">UNIQUE</span>,
    password <span class="type">VARCHAR</span>(255) <span class="keyword">NOT NULL</span>,  <span class="comment">-- Pour le hash</span>
    role <span class="type">VARCHAR</span>(20) <span class="keyword">NOT NULL</span> <span class="keyword">DEFAULT</span> <span class="string>'user'</span>,
    is_active <span class="type">BOOLEAN</span> <span class="keyword">NOT NULL</span> <span class="keyword">DEFAULT</span> <span class="constant">TRUE</span>,
    created_at <span class="type">TIMESTAMP</span> <span class="keyword">DEFAULT</span> <span class="keyword">CURRENT_TIMESTAMP</span>,
    last_login <span class="type">TIMESTAMP</span> <span class="keyword">NULL</span>,
    reset_token <span class="type">VARCHAR</span>(100) <span class="keyword">NULL</span>,
    reset_token_expires_at <span class="type">DATETIME</span> <span class="keyword">NULL</span>
);</code></pre>
                    <div class="result">
                        <p>Cette structure inclut les champs nécessaires pour :</p>
                        <ul>
                            <li>Informations d'identification (nom d'utilisateur, email, mot de passe)</li>
                            <li>Gestion des rôles (role)</li>
                            <li>Suivi de l'activité (is_active, created_at, last_login)</li>
                            <li>Réinitialisation de mot de passe (reset_token, reset_token_expires_at)</li>
                        </ul>
                    </div>
                </div>
            </div>
            <h3>Inscription d'un utilisateur</h3>
            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Formulaire d'inscription</div>
                    <div class="example-content">
                        <pre><code class="language-html"><span class="tag">&lt;form</span> <span class="attr">method</span>=<span class="string">"post"</span> <span class="attr">action</span>=<span class="string">"register.php"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"username"</span><span class="tag">&gt;</span>Nom d'utilisateur :<span class="tag">&lt;/label&gt;</span>
        <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"text"</span> <span class="attr">id</span>=<span class="string">"username"</span> <span class="attr">name</span>=<span class="string">"username"</span> <span class="attr">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"email"</span><span class="tag">&gt;</span>Email :<span class="tag">&lt;/label&gt;</span>
        <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"email"</span> <span class="attr">id</span>=<span class="string">"email"</span> <span class="attr">name</span>=<span class="string">"email"</span> <span class="attr">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"password"</span><span class="tag">&gt;</span>Mot de passe :<span class="tag">&lt;/label&gt;</span>
        <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"password"</span> <span class="attr">id</span>=<span class="string">"password"</span> <span class="attr">name</span>=<span class="string">"password"</span> <span class="attr">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"confirm_password"</span><span class="tag">&gt;</span>Confirmation :<span class="tag">&lt;/label&gt;</span>
        <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"password"</span> <span class="attr">id</span>=<span class="string">"confirm_password"</span> <span class="attr">name</span>=<span class="string">"confirm_password"</span> <span class="attr">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    
    <span class="tag">&lt;button</span> <span class="attr">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>S'inscrire<span class="tag">&lt;/button&gt;</span>
<span class="tag">&lt;/form&gt;</span></code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Traitement de l'inscription</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// register.php</span>
<span class="keyword">if</span> (<span class="variable">$_SERVER</span>[<span class="string>'REQUEST_METHOD'</span>] == <span class="string">'POST'</span>) {
    <span class="comment">// Récupérer et assainir les données</span>
    <span class="variable">$username</span> = <span class="function">filter_input</span>(INPUT_POST, <span class="string>'username'</span>, FILTER_SANITIZE_SPECIAL_CHARS);
    <span class="variable">$email</span> = <span class="function">filter_input</span>(INPUT_POST, <span class="string>'email'</span>, FILTER_SANITIZE_EMAIL);
    <span class="variable">$password</span> = <span class="variable">$_POST</span>[<span class="string>'password'</span>] ?? <span class="string">''</span>;
    <span class="variable">$confirm</span> = <span class="variable">$_POST</span>[<span class="string>'confirm_password'</span>] ?? <span class="string">''</span>;
    
    <span class="comment">// Validation</span>
    <span class="variable">$errors</span> = [];
    
    <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$username</span>) || <span class="function">strlen</span>(<span class="variable">$username</span>) < <span class="number">3</span>) {
        <span class="variable">$errors</span>[] = <span class="string">"Le nom d'utilisateur doit contenir au moins 3 caractères."</span>;
    }
    
    <span class="keyword">if</span> (!<span class="function">filter_var</span>(<span class="variable">$email</span>, FILTER_VALIDATE_EMAIL)) {
        <span class="variable">$errors</span>[] = <span class="string">"L'email n'est pas valide."</span>;
    }
    
    <span class="keyword">if</span> (<span class="function">strlen</span>(<span class="variable">$password</span>) < <span class="number">8</span>) {
        <span class="variable">$errors</span>[] = <span class="string">"Le mot de passe doit contenir au moins 8 caractères."</span>;
    }
    
    <span class="keyword">if</span> (<span class="variable">$password</span> !== <span class="variable">$confirm</span>) {
        <span class="variable">$errors</span>[] = <span class="string">"Les mots de passe ne correspondent pas."</span>;
    }
    
    <span class="comment">// Vérifier si l'utilisateur existe déjà</span>
    <span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$errors</span>) === <span class="number">0</span>) {
        <span class="variable">$pdo</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(<span class="string">'mysql:host=localhost;dbname=myapp'</span>, <span class="string">'user'</span>, <span class="string">'password'</span>);
        
        <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string>'SELECT COUNT(*) FROM users WHERE username = ? OR email = ?'</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="variable">$username</span>, <span class="variable">$email</span>]);
        
        <span class="keyword">if</span> (<span class="variable">$stmt</span>-><span class="function">fetchColumn</span>() > <span class="number">0</span>) {
            <span class="variable">$errors</span>[] = <span class="string">"Ce nom d'utilisateur ou cet email est déjà utilisé."</span>;
        }
    }
    
    <span class="comment">// Si aucune erreur, insérer l'utilisateur</span>
    <span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$errors</span>) === <span class="number">0</span>) {
        <span class="comment">// Hachage du mot de passe</span>
        <span class="variable">$passwordHash</span> = <span class="function">password_hash</span>(<span class="variable">$password</span>, PASSWORD_DEFAULT);
        
        <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">'
            INSERT INTO users (username, email, password) 
            VALUES (?, ?, ?)
        '</span>);
        
        <span class="keyword">if</span> (<span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="variable">$username</span>, <span class="variable">$email</span>, <span class="variable">$passwordHash</span>])) {
            <span class="comment">// Rediriger vers la page de connexion</span>
            <span class="function">header</span>(<span class="string">'Location: login.php?registered=1'</span>);
            <span class="keyword">exit</span>;
        } <span class="keyword">else</span> {
            <span class="variable">$errors</span>[] = <span class="string">"Une erreur est survenue lors de l'inscription."</span>;
        }
    }
    
    <span class="comment">// Afficher les erreurs s'il y en a</span>
    <span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$errors</span>) > <span class="number">0</span>) {
        <span class="keyword">foreach</span> (<span class="variable">$errors</span> <span class="keyword">as</span> <span class="variable">$error</span>) {
            <span class="keyword">echo</span> <span class="string">"&lt;div class='error'>{<span class="variable">$error</span>}&lt;/div>"</span>;
        }
    }
}</code></pre>
                        <div class="result">
                            <p><strong>Points clés de sécurité :</strong></p>
                            <ul>
                                <li>Validation et assainissement des entrées utilisateur</li>
                                <li>Vérification des doublons (username/email)</li>
                                <li>Hachage du mot de passe avec <code>password_hash()</code></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <h3>Connexion d'un utilisateur</h3>
            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Formulaire de connexion</div>
                    <div class="example-content">
                        <pre><code class="language-html"><span class="tag">&lt;form</span> <span class="attr">method</span>=<span class="string">"post"</span> <span class="attr">action</span>=<span class="string">"login.php"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"username"</span><span class="tag">&gt;</span>Identifiant (nom ou email) :<span class="tag">&lt;/label&gt;</span>
        <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"text"</span> <span class="attr">id</span>=<span class="string">"username"</span> <span class="attr">name</span>=<span class="string">"identifier"</span> <span class="attr">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"password"</span><span class="tag">&gt;</span>Mot de passe :<span class="tag">&lt;/label&gt;</span>
        <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"password"</span> <span class="attr">id</span>=<span class="string">"password"</span> <span class="attr">name</span>=<span class="string">"password"</span> <span class="attr">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;label&gt;</span>
            <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"checkbox"</span> <span class="attr">name</span>=<span class="string">"remember_me"</span><span class="tag">&gt;</span> Se souvenir de moi
        <span class="tag">&lt;/label&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
    
    <span class="tag">&lt;button</span> <span class="attr">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>Se connecter<span class="tag">&lt;/button&gt;</span>
<span class="tag">&lt;/form&gt;</span>

<span class="tag">&lt;p&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"forgot_password.php"</span><span class="tag">&gt;</span>Mot de passe oublié ?<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/p&gt;</span></code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Traitement de la connexion</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// login.php</span>
<span class="function">session_start</span>();

<span class="comment">// Rediriger si déjà connecté</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>])) {
    <span class="function">header</span>(<span class="string">'Location: dashboard.php'</span>);
    <span class="keyword">exit</span>;
}

<span class="keyword">if</span> (<span class="variable">$_SERVER</span>[<span class="string>'REQUEST_METHOD'</span>] == <span class="string">'POST'</span>) {
    <span class="comment">// Récupérer les données</span>
    <span class="variable">$identifier</span> = <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string>'identifier'</span>] ?? <span class="string">''</span>);
    <span class="variable">$password</span> = <span class="variable">$_POST</span>[<span class="string>'password'</span>] ?? <span class="string">''</span>;
    <span class="variable">$remember</span> = <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string>'remember_me'</span>]);
    
    <span class="comment">// Validation basique</span>
    <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$identifier</span>) || <span class="function">empty</span>(<span class="variable">$password</span>)) {
        <span class="variable">$error</span> = <span class="string">"Tous les champs sont obligatoires."</span>;
    } <span class="keyword">else</span> {
        <span class="comment">// Connexion à la base de données</span>
        <span class="variable">$pdo</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(<span class="string">'mysql:host=localhost;dbname=myapp'</span>, <span class="string">'user'</span>, <span class="string">'password'</span>);
        
        <span class="comment">// Chercher l'utilisateur par nom d'utilisateur ou email</span>
        <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">'
            SELECT id, username, password, role, is_active 
            FROM users 
            WHERE (username = ? OR email = ?) AND is_active = 1
        '</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="variable">$identifier</span>, <span class="variable">$identifier</span>]);
        <span class="variable">$user</span> = <span class="variable">$stmt</span>-><span class="function">fetch</span>(<span class="class-name">PDO</span>::FETCH_ASSOC);
        
        <span class="comment">// Vérifier si l'utilisateur existe et si le mot de passe est correct</span>
        <span class="keyword">if</span> (<span class="variable">$user</span> && <span class="function">password_verify</span>(<span class="variable">$password</span>, <span class="variable">$user</span>[<span class="string">'password'</span>])) {
            <span class="comment">// Régénérer l'ID de session pour prévenir la fixation de session</span>
            <span class="function">session_regenerate_id</span>(<span class="keyword">true</span>);
            
            <span class="comment">// Stocker les informations dans la session</span>
            <span class="variable">$_SESSION</span>[<span class="string>'user_id'</span>] = <span class="variable">$user</span>[<span class="string>'id'</span>];
            <span class="variable">$_SESSION</span>[<span class="string>'username'</span>] = <span class="variable">$user</span>[<span class="string>'username'</span>];
            <span class="variable">$_SESSION</span>[<span class="string>'role'</span>] = <span class="variable">$user</span>[<span class="string>'role'</span>];
            <span class="variable">$_SESSION</span>[<span class="string>'last_activity'</span>] = <span class="function">time</span>();
            
            <span class="comment">// Mettre à jour la date de dernière connexion</span>
            <span class="variable">$updateStmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">'UPDATE users SET last_login = NOW() WHERE id = ?'</span>);
            <span class="variable">$updateStmt</span>-><span class="function">execute</span>([<span class="variable">$user</span>[<span class="string>'id'</span>]]);
            
            <span class="comment">// Si "Se souvenir de moi" est coché</span>
            <span class="keyword">if</span> (<span class="variable">$remember</span>) {
                <span class="comment">// Générer un token unique</span>
                <span class="variable">$token</span> = <span class="function">bin2hex</span>(<span class="function">random_bytes</span>(<span class="number">32</span>));
                
                <span class="comment">// Stocker le token en base de données</span>
                <span class="variable">$tokenStmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">'
                    INSERT INTO auth_tokens (user_id, token, expires_at) 
                    VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 30 DAY))
                '</span>);
                <span class="variable">$tokenStmt</span>-><span class="function">execute</span>([<span class="variable">$user</span>[<span class="string>'id'</span>], <span class="function">password_hash</span>(<span class="variable">$token</span>, PASSWORD_DEFAULT)]);
                
                <span class="comment">// Définir un cookie "remember me"</span>
                <span class="function">setcookie</span>(
                    <span class="string>'remember_token'</span>, 
                    <span class="variable">$user</span>[<span class="string>'id'</span>] . <span class="string">':'</span> . <span class="variable">$token</span>,
                    [
                        <span class="string>'expires'</span> => <span class="function">time</span>() + <span class="number">30</span> * <span class="number">24</span> * <span class="number">3600</span>, <span class="comment">// 30 jours</span>
                        <span class="string>'path'</span> => <span class="string">'/'</span>,
                        <span class="string>'httponly'</span> => <span class="keyword">true</span>,
                        <span class="string>'secure'</span> => <span class="keyword">true</span>,
                        <span class="string>'samesite'</span> => <span class="string>'Lax'</span>
                    ]
                );
            }
            
            <span class="comment">// Rediriger vers le tableau de bord</span>
            <span class="function">header</span>(<span class="string">'Location: dashboard.php'</span>);
            <span class="keyword">exit</span>;
            
        } <span class="keyword">else</span> {
            <span class="comment">// Identifiants incorrects</span>
            <span class="variable">$error</span> = <span class="string">"Identifiants incorrects ou compte désactivé."</span>;
            
            <span class="comment">// Attendre un peu pour contrer les attaques par force brute</span>
            <span class="function">sleep</span>(<span class="number">1</span>);
        }
    }
}</code></pre>
                        <div class="result">
                            <p><strong>Points clés de sécurité :</strong></p>
                            <ul>
                                <li>Vérification du mot de passe avec <code>password_verify()</code></li>
                                <li>Régénération de l'ID de session pour prévenir la fixation de session</li>
                                <li>Stockage sécurisé du token "Se souvenir de moi"</li>
                                <li>Protection contre les attaques par force brute avec <code>sleep()</code></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Protection contre les attaques CSRF</h3>
            <div class="example">
                <div class="example-header">Génération et vérification de token CSRF</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// Générer un token CSRF</span>
<span class="keyword">function</span> <span class="function">generateCsrfToken</span>() {
    <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>])) {
        <span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>] = <span class="function">bin2hex</span>(<span class="function">random_bytes</span>(<span class="number">32</span>));
    }
    <span class="keyword">return</span> <span class="variable">$_SESSION</span>[<span class="string>'csrf_token'</span>];
}

<span class="comment">// Vérifier un token CSRF</span>
<span class="keyword">function</span> <span class="function">verifyCsrfToken</span>(<span class="variable">$token</span>) {
    <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string>'csrf_token'</span>]) || 
        !<span class="function">hash_equals</span>(<span class="variable">$_SESSION</span>[<span class="string>'csrf_token'</span>], <span class="variable">$token</span>)) {
        <span class="comment">// Token invalide, rejeter la requête</span>
        <span class="function">http_response_code</span>(<span class="number">403</span>);
        <span class="keyword">die</span>(<span class="string">'Action non autorisée'</span>);
    }
}

<span class="comment">// Dans un formulaire</span>
<span class="keyword">echo</span> <span class="string">'&lt;input type="hidden" name="csrf_token" value="'</span> . <span class="function">generateCsrfToken</span>() . <span class="string">'"&gt;'</span>;

<span class="comment">// Lors du traitement du formulaire</span>
<span class="function">verifyCsrfToken</span>(<span class="variable">$_POST</span>[<span class="string>'csrf_token'</span>] ?? <span class="string">''</span>);</code></pre>
                    <div class="result">
                        <p>Le token CSRF (Cross-Site Request Forgery) est une mesure de protection cruciale pour empêcher les attaques où un site malveillant pourrait forcer votre navigateur à effectuer des actions non autorisées sur un site où vous êtes authentifié.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Gestion des droits utilisateurs</h2>
            <p>La mise en place d'un système de gestion des droits (ou contrôle d'accès) permet de limiter ce que différents types d'utilisateurs peuvent faire dans votre application.</p>
            <h3>Modèle de contrôle d'accès basé sur les rôles (RBAC)</h3>
            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Structure de la base de données</div>
                    <div class="example-content">
                        <pre><code class="language-sql"><span class="comment">-- Table des rôles</span>
<span class="keyword">CREATE</span> <span class="keyword">TABLE</span> roles (
    id <span class="type">INT</span> <span class="keyword">AUTO_INCREMENT</span> <span class="keyword">PRIMARY KEY</span>,
    name <span class="type">VARCHAR</span>(50) <span class="keyword">NOT NULL</span> <span class="keyword">UNIQUE</span>,
    description <span class="type">VARCHAR</span>(255)
);

<span class="comment">-- Table des permissions</span>
<span class="keyword">CREATE</span> <span class="keyword">TABLE</span> permissions (
    id <span class="type">INT</span> <span class="keyword">AUTO_INCREMENT</span> <span class="keyword">PRIMARY KEY</span>,
    name <span class="type">VARCHAR</span>(100) <span class="keyword">NOT NULL</span> <span class="keyword">UNIQUE</span>,
    description <span class="type">VARCHAR</span>(255)
);

<span class="comment">-- Table de liaison rôles-permissions (relation many-to-many)</span>
<span class="keyword">CREATE</span> <span class="keyword">TABLE</span> role_permissions (
    role_id <span class="type">INT</span> <span class="keyword">NOT NULL</span>,
    permission_id <span class="type">INT</span> <span class="keyword">NOT NULL</span>,
    <span class="keyword">PRIMARY KEY</span> (role_id, permission_id),
    <span class="keyword">FOREIGN KEY</span> (role_id) <span class="keyword">REFERENCES</span> roles(id) <span class="keyword">ON DELETE CASCADE</span>,
    <span class="keyword">FOREIGN KEY</span> (permission_id) <span class="keyword">REFERENCES</span> permissions(id) <span class="keyword">ON DELETE CASCADE</span>
);

<span class="comment">-- Colonne role_id dans la table users</span>
<span class="keyword">ALTER TABLE</span> users <span class="keyword">ADD COLUMN</span> role_id <span class="type">INT</span>;
<span class="keyword">ALTER TABLE</span> users <span class="keyword">ADD</span> <span class="keyword">FOREIGN KEY</span> (role_id) <span class="keyword">REFERENCES</span> roles(id);</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Vérification des permissions</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">class</span> <span class="class-name">Authorization</span> {
    <span class="keyword">private</span> <span class="variable">$pdo</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="class-name">PDO</span> <span class="variable">$pdo</span>) {
        <span class="variable">$this</span>-><span class="variable">pdo</span> = <span class="variable">$pdo</span>;
    }
    
    <span class="comment">// Vérifier si un utilisateur a une permission spécifique</span>
    <span class="keyword">public function</span> <span class="function">hasPermission</span>(<span class="variable">$userId</span>, <span class="variable">$permissionName</span>) {
        <span class="variable">$stmt</span> = <span class="variable">$this</span>-><span class="variable">pdo</span>-><span class="function">prepare</span>(<span class="string">'
            SELECT COUNT(*) FROM users u
            JOIN roles r ON u.role_id = r.id
            JOIN role_permissions rp ON r.id = rp.role_id
            JOIN permissions p ON rp.permission_id = p.id
            WHERE u.id = ? AND p.name = ?
        '</span>);
        
        <span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="variable">$userId</span>, <span class="variable">$permissionName</span>]);
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchColumn</span>() > <span class="number">0</span>;
    }
    
    <span class="comment">// Récupérer toutes les permissions d'un utilisateur</span>
    <span class="keyword">public function</span> <span class="function">getUserPermissions</span>(<span class="variable">$userId</span>) {
        <span class="variable">$stmt</span> = <span class="variable">$this</span>-><span class="variable">pdo</span>-><span class="function">prepare</span>(<span class="string">'
            SELECT p.name FROM users u
            JOIN roles r ON u.role_id = r.id
            JOIN role_permissions rp ON r.id = rp.role_id
            JOIN permissions p ON rp.permission_id = p.id
            WHERE u.id = ?
        '</span>);
        
        <span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="variable">$userId</span>]);
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class-name">PDO</span>::FETCH_COLUMN);
    }
}</code></pre>
                    </div>
                </div>
            </div>
            <h3>Mise en pratique du contrôle d'accès</h3>
            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Middleware pour vérifier les permissions</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// auth_middleware.php</span>
<span class="keyword">function</span> <span class="function">requireLogin</span>() {
    <span class="function">session_start</span>();
    
    <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>])) {
        <span class="comment">// Sauvegarder l'URL demandée pour y revenir après la connexion</span>
        <span class="variable">$_SESSION</span>[<span class="string">'redirect_after_login'</span>] = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>];
        <span class="function">header</span>(<span class="string">'Location: login.php'</span>);
        <span class="keyword">exit</span>;
    }
    
    <span class="comment">// Vérifier l'inactivité (par exemple, 30 minutes)</span>
    <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string>'last_activity'</span>]) && 
        (<span class="function">time</span>() - <span class="variable">$_SESSION</span>[<span class="string>'last_activity'</span>] > <span class="number">1800</span>)) {
        <span class="comment">// Session expirée, déconnecter l'utilisateur</span>
        <span class="function">session_unset</span>();
        <span class="function">session_destroy</span>();
        <span class="function">header</span>(<span class="string">'Location: login.php?expired=1'</span>);
        <span class="keyword">exit</span>;
    }
    
    <span class="comment">// Mettre à jour l'horodatage de la dernière activité</span>
    <span class="variable">$_SESSION</span>[<span class="string>'last_activity'</span>] = <span class="function">time</span>();
}

<span class="keyword">function</span> <span class="function">requirePermission</span>(<span class="variable">$permissionName</span>) {
    <span class="function">requireLogin</span>(); <span class="comment">// S'assurer que l'utilisateur est connecté</span>
    
    <span class="variable">$userId</span> = <span class="variable">$_SESSION</span>[<span class="string>'user_id'</span>];
    <span class="variable">$pdo</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(<span class="string">'mysql:host=localhost;dbname=myapp'</span>, <span class="string">'user'</span>, <span class="string">'password'</span>);
    <span class="variable">$auth</span> = <span class="keyword">new</span> <span class="class-name">Authorization</span>(<span class="variable">$pdo</span>);
    
    <span class="keyword">if</span> (!<span class="variable">$auth</span>-><span class="function">hasPermission</span>(<span class="variable">$userId</span>, <span class="variable">$permissionName</span>)) {
        <span class="function">http_response_code</span>(<span class="number">403</span>);
        <span class="keyword">include</span>(<span class="string">'forbidden.php'</span>);
        <span class="keyword">exit</span>;
    }
}</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Utilisation dans une page d'administration</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// admin_users.php</span>
<span class="keyword">require_once</span> <span class="string">'auth_middleware.php'</span>;

<span class="comment">// Vérifier que l'utilisateur a la permission de gérer les utilisateurs</span>
<span class="function">requirePermission</span>(<span class="string>'manage_users'</span>);

<span class="comment">// Le code ci-dessous ne s'exécute que si l'utilisateur a la permission</span>
<span class="variable">$pdo</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(<span class="string">'mysql:host=localhost;dbname=myapp'</span>, <span class="string">'user'</span>, <span class="string">'password'</span>);

<span class="comment">// Récupérer tous les utilisateurs</span>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">query</span>(<span class="string">'SELECT id, username, email, role_id, is_active FROM users'</span>);
<span class="variable">$users</span> = <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class-name">PDO</span>::FETCH_ASSOC);

<span class="comment">// Afficher la liste des utilisateurs</span>
<span class="keyword">include</span> <span class="string">'header.php'</span>;
</code></pre>
                        <div class="result">
                            <p>Cette approche permet de centraliser la logique de contrôle d'accès et de l'appliquer facilement à différentes parties de votre application.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Contrôle d'accès dans les vues et l'interface</h3>
            <div class="example">
                <div class="example-header">Affichage conditionnel des éléments d'interface</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// Dans un fichier de fonctions helper</span>
<span class="keyword">function</span> <span class="function">canUserAccess</span>(<span class="variable">$permissionName</span>) {
    <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>])) {
        <span class="keyword">return</span> <span class="keyword">false</span>;
    }
    
    <span class="variable">$pdo</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(<span class="string">'mysql:host=localhost;dbname=myapp'</span>, <span class="string">'user'</span>, <span class="string">'password'</span>);
    <span class="variable">$auth</span> = <span class="keyword">new</span> <span class="class-name">Authorization</span>(<span class="variable">$pdo</span>);
    <span class="keyword">return</span> <span class="variable">$auth</span>-><span class="function">hasPermission</span>(<span class="variable">$_SESSION</span>[<span class="string>'user_id'</span>], <span class="variable">$permissionName</span>);
}

<span class="comment">// Dans une vue</span>
<span class="keyword">if</span> (<span class="function">canUserAccess</span>(<span class="string>'manage_users'</span>)) {
    <span class="keyword">echo</span> <span class="string">'&lt;a href="admin_users.php" class="admin-button"&gt;Gérer les utilisateurs&lt;/a&gt;'</span>;
}

<span class="keyword">if</span> (<span class="function">canUserAccess</span>(<span class="string>'view_reports'</span>)) {
    <span class="keyword">echo</span> <span class="string">'&lt;li&gt;&lt;a href="reports.php"&gt;Rapports&lt;/a&gt;&lt;/li&gt;'</span>;
}</code></pre>
                    <div class="result">
                        <p>En adaptant l'interface en fonction des permissions, vous créez une expérience utilisateur sur mesure et vous renforcez la sécurité de votre application.</p>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <strong>Bonnes pratiques pour la gestion des droits</strong>
                <ol>
                    <li><strong>Principe du moindre privilège</strong> : accordez uniquement les permissions minimales nécessaires</li>
                    <li><strong>Vérifications côté serveur</strong> : ne vous fiez jamais uniquement aux contrôles côté client</li>
                    <li><strong>Journalisation des accès</strong> : enregistrez les tentatives d'accès non autorisées</li>
                    <li><strong>Séparation des responsabilités</strong> : divisez les permissions pour limiter les risques</li>
                    <li><strong>Vérifications à plusieurs niveaux</strong> : validez les permissions à chaque étape critique</li>
                </ol>
            </div>
        </section>
        <div class="navigation">
            <a href="19-envoi-emails.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="21-internationalisation.php" class="nav-button">Module suivant →</a>
        </div>
    </main>
</body>

</html>