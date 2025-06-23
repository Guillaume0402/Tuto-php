<?php include __DIR__ . '/../includes/header-pro.php'; 



/**
 * Tutoriel PHP - Les Inclusions
 * Ce fichier explique comment utiliser include et require en PHP
 */

// Inclusion du fichier de configuration
require_once 'includes/config.php';

// Définition des variables pour cette page
$titre = $pageInfo['titre'];
$description = $pageInfo['description'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="module8">
    <header>
        <h1><?php echo $titre; ?></h1>
        <p class="subtitle"><?php echo $description; ?></p>
    </header>
    <div class="navigation">
        <a href="07-fonctions-natives.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="09-les-formulaires.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction aux Inclusions</h2>
            <p>
                Les inclusions en PHP permettent de structurer votre code en séparant la logique dans différents fichiers.
                Cela rend votre code plus organisé, modulaire et facile à maintenir.
            </p>
            <p>
                PHP propose quatre fonctions principales pour inclure des fichiers dans vos scripts :
            </p>
            <ul>
                <li><code>include</code> - Inclut et exécute le fichier spécifié</li>
                <li><code>require</code> - Inclut et exécute le fichier spécifié (erreur fatale si le fichier n'existe pas)</li>
                <li><code>include_once</code> - Inclut le fichier s'il n'a pas déjà été inclus</li>
                <li><code>require_once</code> - Inclut le fichier s'il n'a pas déjà été inclus (erreur fatale si le fichier n'existe pas)</li>
            </ul>
        </section>

        <section class="section">
            <h2>Structure de Projet avec Inclusions</h2>
            <p>
                Une bonne structure de projet utilisant les inclusions pourrait ressembler à ceci :
            </p>
            <div class="file-structure">
                <div class="folder">mon_projet/</div>
                <div class="file">index.php</div>
                <div class="folder">&nbsp;&nbsp;includes/</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;config.php</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;functions.php</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;header.php</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;footer.php</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;db.php</div>
                <div class="folder">&nbsp;&nbsp;assets/</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;style.css</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;script.js</div>
                <div class="folder">&nbsp;&nbsp;pages/</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;accueil.php</div>
                <div class="file">&nbsp;&nbsp;&nbsp;&nbsp;contact.php</div>
            </div>

            <p>
                Cette structure permet de séparer la configuration, les fonctions réutilisables,
                les éléments communs (header, footer) et les pages spécifiques.
            </p>
        </section>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header include-header">include</div>
                <div class="example-content">
                    <p>
                        La fonction <code>include</code> inclut et exécute le fichier spécifié.
                        Si le fichier n'est pas trouvé, PHP émet un avertissement et continue l'exécution.
                    </p>
                    <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Inclusion d'un fichier</span>
<span class="keyword">include</span> <span class="string">'includes/header.php'</span>;

<span class="comment">// Le code continue même si le fichier n'existe pas</span>
<span class="keyword">echo</span> <span class="string">"Cette ligne s'exécutera même si le fichier header.php n'existe pas."</span>;
<span class="keyword">?&gt;</span></code></pre>
                    <div class="info-box">
                        <strong>À savoir :</strong> Utilisez <code>include</code> pour les fichiers non critiques,
                        où le script peut continuer même si le fichier n'est pas trouvé.
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header require-header">require</div>
                <div class="example-content">
                    <p>
                        La fonction <code>require</code> fait la même chose que <code>include</code>,
                        mais provoque une erreur fatale si le fichier n'est pas trouvé, arrêtant l'exécution du script.
                    </p>
                    <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Inclusion d'un fichier critique</span>
<span class="keyword">require</span> <span class="string">'includes/config.php'</span>;

<span class="comment">// Cette ligne ne sera pas exécutée si config.php n'existe pas</span>
<span class="keyword">echo</span> <span class="string">"Configuration chargée avec succès !"</span>;
<span class="keyword">?&gt;</span></code></pre>
                    <div class="warning-box">
                        <strong>Important :</strong> Utilisez <code>require</code> pour les fichiers critiques,
                        comme les configurations ou les connexions à la base de données.
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header once-header">include_once et require_once</div>
                <div class="example-content">
                    <p>
                        Ces variantes garantissent qu'un fichier n'est inclus qu'une seule fois, même s'il est appelé plusieurs fois.
                        C'est particulièrement utile pour les fichiers contenant des fonctions ou des classes.
                    </p>
                    <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Le fichier ne sera inclus qu'une seule fois</span>
<span class="keyword">include_once</span> <span class="string">'includes/functions.php'</span>;
<span class="comment">// Une seconde inclusion n'aura aucun effet</span>
<span class="keyword">include_once</span> <span class="string">'includes/functions.php'</span>;

<span class="comment">// Pareil avec require_once</span>
<span class="keyword">require_once</span> <span class="string">'includes/db.php'</span>;
<span class="comment">// Cette ligne n'inclurait pas à nouveau le fichier</span>
<span class="keyword">require_once</span> <span class="string">'includes/db.php'</span>;
<span class="keyword">?&gt;</span></code></pre>
                    <div class="tip-box">
                        <strong>Conseil :</strong> Utilisez <code>_once</code> pour éviter les redéfinitions
                        de fonctions ou de classes qui pourraient causer des erreurs.
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header structure-header">Structure avec Inclusions</div>
                <div class="example-content">
                    <p>
                        Voici comment structurer une page complète avec des inclusions :
                    </p>
                    <pre><code><span class="keyword">&lt;?php</span>
<span class="comment">// Configuration et fonctions</span>
<span class="keyword">require_once</span> <span class="string">'includes/config.php'</span>;
<span class="keyword">require_once</span> <span class="string">'includes/functions.php'</span>;

<span class="comment">// Variables spécifiques à cette page</span>
<span class="variable">$titre</span> = <span class="string">"Ma Page"</span>;
<span class="variable">$description</span> = <span class="string">"Description de ma page"</span>;
<span class="variable">$auteur</span> = <span class="string">"Jean Dupont"</span>;

<span class="comment">// En-tête de la page</span>
<span class="keyword">include</span> <span class="string">'includes/header.php'</span>;

<span class="comment">// Contenu spécifique à la page</span>
<span class="keyword">echo</span> <span class="string">"&lt;h2&gt;Contenu de la page&lt;/h2&gt;"</span>;
<span class="keyword">echo</span> <span class="string">"&lt;p&gt;Ceci est le contenu spécifique à cette page.&lt;/p&gt;"</span>;

<span class="comment">// Utilisation d'une fonction du fichier inclus</span>
<span class="variable">$notes</span> = [<span class="number">15</span>, <span class="number">17</span>, <span class="number">14</span>, <span class="number">18</span>, <span class="number">12</span>];
<span class="keyword">echo</span> <span class="string">"La moyenne est : "</span> . <span class="function">calculerMoyenne</span>(<span class="variable">$notes</span>);

<span class="comment">// Pied de page</span>
<span class="keyword">include</span> <span class="string">'includes/footer.php'</span>;
<span class="keyword">?&gt;</span></code></pre>
                </div>
            </div>
        </div>

        <section class="section">
            <h2>Comparaison des Méthodes d'Inclusion</h2>
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Fonction</th>
                        <th>Comportement</th>
                        <th>Erreur</th>
                        <th>Utilisation recommandée</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>include</code></td>
                        <td>Inclut et exécute un fichier</td>
                        <td>Warning (continue l'exécution)</td>
                        <td>Fichiers non critiques (templates, parties UI)</td>
                    </tr>
                    <tr>
                        <td><code>require</code></td>
                        <td>Inclut et exécute un fichier</td>
                        <td>Fatal error (arrête l'exécution)</td>
                        <td>Fichiers critiques (configuration, base de données)</td>
                    </tr>
                    <tr>
                        <td><code>include_once</code></td>
                        <td>Inclut le fichier s'il n'a pas déjà été inclus</td>
                        <td>Warning (continue l'exécution)</td>
                        <td>Fichiers non critiques avec définitions (fonctions auxiliaires)</td>
                    </tr>
                    <tr>
                        <td><code>require_once</code></td>
                        <td>Inclut le fichier s'il n'a pas déjà été inclus</td>
                        <td>Fatal error (arrête l'exécution)</td>
                        <td>Fichiers critiques avec définitions (classes, fonctions principales)</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="section">
            <h2>Exemple Pratique</h2>
            <p>
                Voici un exemple pratique de l'utilisation des inclusions. Ce script:
            </p>
            <ul>
                <li>Inclut un fichier de configuration</li>
                <li>Importe des fonctions utilitaires</li>
                <li>Utilise un template d'en-tête et de pied de page</li>
            </ul>
            <div class="example">
                <div class="example-content">
                    <h3>Exemple de page principale</h3>
                    <pre><code class="language-php"><span class="keyword">&lt;?php</span>
<span class="comment">// Fichier: index.php</span>

<span class="comment">// Inclusion des fichiers nécessaires</span>
<span class="keyword">require_once</span> <span class="string">'includes/config.php'</span>;     <span class="comment">// Configuration critique</span>
<span class="keyword">require_once</span> <span class="string">'includes/functions.php'</span>;  <span class="comment">// Fonctions utilitaires</span>

<span class="comment">// Variables spécifiques à cette page</span>
<span class="variable">$titre</span> = <span class="string">"Accueil - "</span> . <span class="variable">APP_NAME</span>;
<span class="variable">$description</span> = <span class="string">"Bienvenue sur notre site de démonstration"</span>;
<span class="variable">$auteur</span> = <span class="string">"Équipe de développement"</span>;

<span class="comment">// En-tête</span>
<span class="keyword">include</span> <span class="string">'includes/header.php'</span>;

<span class="comment">// Contenu spécifique à la page</span>
<span class="variable">$items</span> = [<span class="string">"PHP"</span>, <span class="string">"HTML"</span>, <span class="string">"CSS"</span>, <span class="string">"JavaScript"</span>, <span class="string">"MySQL"</span>];
<span class="keyword">?&gt;</span>

<span class="tag">&lt;h2&gt;</span>Bienvenue sur <span class="keyword">&lt;?php</span> <span class="keyword">echo</span> <span class="variable">APP_NAME</span>; <span class="keyword">?&gt;</span> v<span class="keyword">&lt;?php</span> <span class="keyword">echo</span> <span class="variable">APP_VERSION</span>; <span class="keyword">?&gt;</span><span class="tag">&lt;/h2&gt;</span>

<span class="tag">&lt;p&gt;</span>Voici les technologies que nous utilisons:<span class="tag">&lt;/p&gt;</span>
<span class="keyword">&lt;?php</span> <span class="keyword">echo</span> <span class="function">genererListe</span>(<span class="variable">$items</span>); <span class="keyword">?&gt;</span>

<span class="keyword">&lt;?php</span>
<span class="comment">// Affichage d'un message</span>
<span class="function">afficherMessage</span>(<span class="string">"Ce site utilise des fichiers d'inclusion pour une meilleure organisation !"</span>, <span class="string">"success"</span>);

<span class="comment">// Pied de page</span>
<span class="keyword">include</span> <span class="string">'includes/footer.php'</span>;
<span class="keyword">?&gt;</span></code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Bonnes Pratiques</h2>
            <div class="info-box">
                <h3>Conseils pour l'utilisation des inclusions</h3>
                <ul>
                    <li><strong>Chemins d'accès :</strong> Utilisez des chemins relatifs à la racine ou des chemins absolus pour éviter les problèmes d'inclusion.</li>
                    <li><strong>Organisation :</strong> Groupez les fichiers similaires dans des dossiers dédiés (includes, templates, etc.).</li>
                    <li><strong>Sécurité :</strong> Ne placez pas de fichiers sensibles (configuration, accès DB) dans des dossiers publics.</li>
                    <li><strong>Variables :</strong> Les variables définies avant une inclusion sont accessibles dans le fichier inclus.</li>
                    <li><strong>Retours :</strong> Les fichiers inclus peuvent retourner des valeurs avec <code>return</code>.</li>
                    <li><strong>Alternative :</strong> Pour l'inclusion dynamique de modules, considérez l'autoloading de classes.</li>
                </ul>
            </div>
        </section>
        <div class="navigation">
            <a href="07-fonctions-natives.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="09-les-formulaires.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Tutoriel PHP</p>
    </footer>
</body>

</html>
<?php include __DIR__ . '/../includes/footer.php'; ?>