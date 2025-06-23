<?php include __DIR__ . '/../includes/header-pro.php'; 
$titre = "Internationalisation (i18n) et gestion des langues";
$description = "Apprenez à créer des sites multilingues en PHP en utilisant différentes techniques de traduction comme les fichiers de langue, gettext et les bibliothèques spécialisées.";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="module21">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </header>
    <div class="navigation">
        <a href="20-sessions-authentification.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="22-deploiement-hebergement.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction à l'internationalisation</h2>
            <p>L'internationalisation (abrégée en i18n car il y a 18 lettres entre le "i" et le "n") est le processus de conception et de développement d'une application qui peut être adaptée à différentes langues et cultures sans nécessiter de modifications techniques.</p>

            <div class="info-box">
                <strong>Pourquoi internationaliser votre site ?</strong>
                <ul>
                    <li><strong>Audience plus large</strong> : atteindre des utilisateurs dans leur langue maternelle</li>
                    <li><strong>Meilleure expérience utilisateur</strong> : adaptation aux préférences culturelles</li>
                    <li><strong>Conformité légale</strong> : certaines régions exigent des contenus dans la langue locale</li>
                    <li><strong>Avantage concurrentiel</strong> : se démarquer des concurrents sur des marchés spécifiques</li>
                </ul>
            </div>

            <h3>Concepts clés</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Internationalisation vs. Localisation</div>
                    <div class="example-content">
                        <ul>
                            <li><strong>Internationalisation (i18n)</strong> : Préparer votre application pour qu'elle puisse être adaptée à différentes langues sans modifier le code.</li>
                            <li><strong>Localisation (l10n)</strong> : Adapter votre application à une langue et culture spécifiques (traductions, formats de date, monnaie, etc.).</li>
                        </ul>
                        <div class="result">
                            <p><em>i18n</em> est le travail technique pour que votre code soit prêt à supporter plusieurs langues, tandis que <em>l10n</em> est le processus d'adaptation culturelle pour une langue spécifique.</p>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Éléments à considérer</div>
                    <div class="example-content">
                        <ul>
                            <li><strong>Textes et messages</strong> : Tous les textes visibles par l'utilisateur</li>
                            <li><strong>Formats de date et heure</strong> : 01/05/2025 peut signifier 1er mai ou 5 janvier selon les pays</li>
                            <li><strong>Formats numériques</strong> : Séparateurs décimaux (1,000.00 vs 1.000,00)</li>
                            <li><strong>Devises</strong> : Symboles et positions (€50 vs 50€)</li>
                            <li><strong>Pluralisation</strong> : Règles différentes selon les langues</li>
                            <li><strong>Direction d'écriture</strong> : De gauche à droite ou de droite à gauche</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Méthode simple : Utilisation de fichiers de langue</h2>
            <p>Une approche simple pour débuter consiste à stocker vos traductions dans des fichiers PHP séparés pour chaque langue. Cette méthode est facile à mettre en œuvre et convient aux petits projets.</p>

            <h3>Structure de fichiers</h3>
            <div class="example">
                <div class="example-header">Organisation des dossiers et fichiers</div>
                <div class="example-content">
                    <pre><code class="language-tree">📁 projet/
  ├── 📁 languages/
  │   ├── 📄 fr.php
  │   ├── 📄 en.php
  │   ├── 📄 es.php
  │   └── 📄 de.php
  ├── 📄 index.php
  └── 📄 page.php</code></pre>
                </div>
            </div>

            <h3>Fichiers de traduction</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">languages/fr.php</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Fichier de langue français (fr.php)</span>
<span class="keyword">return</span> [
    <span class="string">'welcome'</span> => <span class="string">'Bienvenue sur notre site'</span>,
    <span class="string">'home'</span> => <span class="string">'Accueil'</span>,
    <span class="string">'about'</span> => <span class="string">'À propos'</span>,
    <span class="string">'contact'</span> => <span class="string">'Contact'</span>,
    <span class="string">'login'</span> => <span class="string">'Connexion'</span>,
    <span class="string">'register'</span> => <span class="string">'Inscription'</span>,
    <span class="string">'email'</span> => <span class="string">'Adresse e-mail'</span>,
    <span class="string">'password'</span> => <span class="string">'Mot de passe'</span>,
    <span class="string">'form_success'</span> => <span class="string">'Formulaire envoyé avec succès !'</span>,
    <span class="string">'form_error'</span> => <span class="string">'Erreur lors de l\'envoi du formulaire.'</span>,
    <span class="string">'items_count'</span> => <span class="string">'Vous avez {count} article(s) dans votre panier.'</span>
];</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">languages/en.php</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Fichier de langue anglais (en.php)</span>
<span class="keyword">return</span> [
    <span class="string">'welcome'</span> => <span class="string">'Welcome to our website'</span>,
    <span class="string">'home'</span> => <span class="string">'Home'</span>,
    <span class="string">'about'</span> => <span class="string">'About'</span>,
    <span class="string">'contact'</span> => <span class="string">'Contact'</span>,
    <span class="string">'login'</span> => <span class="string">'Login'</span>,
    <span class="string">'register'</span> => <span class="string">'Register'</span>,
    <span class="string">'email'</span> => <span class="string">'Email address'</span>,
    <span class="string">'password'</span> => <span class="string">'Password'</span>,
    <span class="string">'form_success'</span> => <span class="string">'Form submitted successfully!'</span>,
    <span class="string">'form_error'</span> => <span class="string">'Error submitting the form.'</span>,
    <span class="string">'items_count'</span> => <span class="string">'You have {count} item(s) in your cart.'</span>
];</code></pre>
                    </div>
                </div>
            </div>

            <h3>Implémentation de la gestion des langues</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Classe pour la traduction</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Classe I18n.php</span>
<span class="keyword">class</span> <span class="class-name">I18n</span> {
    <span class="keyword">private static</span> <span class="variable">$instance</span> = <span class="keyword">null</span>;
    <span class="keyword">private</span> <span class="variable">$translations</span> = [];
    <span class="keyword">private</span> <span class="variable">$lang</span> = <span class="string">'fr'</span>; <span class="comment">// Langue par défaut</span>
    <span class="keyword">private</span> <span class="variable">$availableLangs</span> = [<span class="string">'fr'</span>, <span class="string">'en'</span>, <span class="string">'es'</span>, <span class="string">'de'</span>];
    
    <span class="keyword">private function</span> <span class="function">__construct</span>() {
        <span class="comment">// Définir la langue en fonction des préférences utilisateur</span>
        <span class="variable">$this</span>-><span class="function">setLanguage</span>();
        <span class="comment">// Charger les traductions</span>
        <span class="variable">$this</span>-><span class="function">loadTranslations</span>();
    }
    
    <span class="keyword">public static function</span> <span class="function">getInstance</span>() {
        <span class="keyword">if</span> (<span class="variable">self</span>::<span class="variable">$instance</span> === <span class="keyword">null</span>) {
            <span class="variable">self</span>::<span class="variable">$instance</span> = <span class="keyword">new</span> <span class="class-name">I18n</span>();
        }
        <span class="keyword">return</span> <span class="variable">self</span>::<span class="variable">$instance</span>;
    }
    
    <span class="keyword">private function</span> <span class="function">setLanguage</span>() {
        <span class="comment">// Priorité 1: Paramètre de l'URL</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_GET</span>[<span class="string">'lang'</span>]) && <span class="function">in_array</span>(<span class="variable">$_GET</span>[<span class="string">'lang'</span>], <span class="variable">$this</span>-><span class="variable">availableLangs</span>)) {
            <span class="variable">$this</span>-><span class="variable">lang</span> = <span class="variable">$_GET</span>[<span class="string">'lang'</span>];
            <span class="function">setcookie</span>(<span class="string">'lang'</span>, <span class="variable">$this</span>-><span class="variable">lang</span>, <span class="function">time</span>() + <span class="number">30</span> * <span class="number">24</span> * <span class="number">3600</span>, <span class="string">'/'</span>);
        }
        <span class="comment">// Priorité 2: Cookie</span>
        <span class="keyword">elseif</span> (<span class="function">isset</span>(<span class="variable">$_COOKIE</span>[<span class="string">'lang'</span>]) && <span class="function">in_array</span>(<span class="variable">$_COOKIE</span>[<span class="string">'lang'</span>], <span class="variable">$this</span>-><span class="variable">availableLangs</span>)) {
            <span class="variable">$this</span>-><span class="variable">lang</span> = <span class="variable">$_COOKIE</span>[<span class="string">'lang'</span>];
        }
        <span class="comment">// Priorité 3: En-tête Accept-Language du navigateur</span>
        <span class="keyword">elseif</span> (<span class="function">isset</span>(<span class="variable">$_SERVER</span>[<span class="string">'HTTP_ACCEPT_LANGUAGE'</span>])) {
            <span class="variable">$browserLangs</span> = <span class="function">explode</span>(<span class="string">','</span>, <span class="variable">$_SERVER</span>[<span class="string">'HTTP_ACCEPT_LANGUAGE'</span>]);
            <span class="keyword">foreach</span> (<span class="variable">$browserLangs</span> <span class="keyword">as</span> <span class="variable">$browserLang</span>) {
                <span class="variable">$code</span> = <span class="function">substr</span>(<span class="variable">$browserLang</span>, <span class="number">0</span>, <span class="number">2</span>);
                <span class="keyword">if</span> (<span class="function">in_array</span>(<span class="variable">$code</span>, <span class="variable">$this</span>-><span class="variable">availableLangs</span>)) {
                    <span class="variable">$this</span>-><span class="variable">lang</span> = <span class="variable">$code</span>;
                    <span class="keyword">break</span>;
                }
            }
        }
    }
    
    <span class="keyword">private function</span> <span class="function">loadTranslations</span>() {
        <span class="variable">$file</span> = <span class="function">dirname</span>(<span class="variable">__FILE__</span>) . <span class="string">'/languages/'</span> . <span class="variable">$this</span>-><span class="variable">lang</span> . <span class="string">'.php'</span>;
        <span class="keyword">if</span> (<span class="function">file_exists</span>(<span class="variable">$file</span>)) {
            <span class="variable">$this</span>-><span class="variable">translations</span> = <span class="function">require</span>(<span class="variable">$file</span>);
        } <span class="keyword">else</span> {
            <span class="comment">// Fallback à la langue par défaut</span>
            <span class="variable">$fallbackFile</span> = <span class="function">dirname</span>(<span class="variable">__FILE__</span>) . <span class="string">'/languages/fr.php'</span>;
            <span class="variable">$this</span>-><span class="variable">translations</span> = <span class="function">require</span>(<span class="variable">$fallbackFile</span>);
        }
    }
    
    <span class="keyword">public function</span> <span class="function">get</span>(<span class="variable">$key</span>, <span class="variable">$params</span> = []) {
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$this</span>-><span class="variable">translations</span>[<span class="variable">$key</span>])) {
            <span class="variable">$text</span> = <span class="variable">$this</span>-><span class="variable">translations</span>[<span class="variable">$key</span>];
            <span class="comment">// Remplacement des variables dans le texte</span>
            <span class="keyword">foreach</span> (<span class="variable">$params</span> <span class="keyword">as</span> <span class="variable">$param</span> => <span class="variable">$value</span>) {
                <span class="variable">$text</span> = <span class="function">str_replace</span>(<span class="string">'{'</span> . <span class="variable">$param</span> . <span class="string">'}'</span>, <span class="variable">$value</span>, <span class="variable">$text</span>);
            }
            <span class="keyword">return</span> <span class="variable">$text</span>;
        }
        <span class="keyword">return</span> <span class="variable">$key</span>; <span class="comment">// Fallback: retourne la clé elle-même</span>
    }
    
    <span class="keyword">public function</span> <span class="function">getCurrentLanguage</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">lang</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">getAvailableLanguages</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="variable">availableLangs</span>;
    }
}</code></pre>
                        <div class="result">
                            <p>Cette classe utilise le pattern Singleton pour garantir une seule instance de traduction et implémente une logique de détection de langue basée sur plusieurs sources (URL, cookie, navigateur).</p>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Utilisation dans vos pages</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Inclure la classe I18n</span>
<span class="keyword">require_once</span> <span class="string">'I18n.php'</span>;

<span class="comment">// Créer une fonction helper pour faciliter les traductions</span>
<span class="keyword">function</span> <span class="function">__</span>(<span class="variable">$key</span>, <span class="variable">$params</span> = []) {
    <span class="variable">$i18n</span> = <span class="class-name">I18n</span>::<span class="function">getInstance</span>();
    <span class="keyword">return</span> <span class="variable">$i18n</span>-><span class="function">get</span>(<span class="variable">$key</span>, <span class="variable">$params</span>);
}

<span class="comment">// Exemple d'utilisation dans une page</span>
<span class="tag">&lt;!DOCTYPE html&gt;</span>
<span class="tag">&lt;html</span> <span class="attr">lang</span>=<span class="string">"&lt;?=</span> <span class="class-name">I18n</span><span class="operator">::</span><span class="function">getInstance</span>()<span class="operator">-&gt;</span><span class="function">getCurrentLanguage</span>() <span class="string">?&gt;"</span><span class="tag">&gt;</span>
<span class="tag">&lt;head&gt;</span>
    <span class="tag">&lt;meta</span> <span class="attr">charset</span>=<span class="string">"UTF-8"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;title&gt;</span><span class="string">&lt;?=</span> <span class="function">__</span>(<span class="string">'welcome'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/title&gt;</span>
<span class="tag">&lt;/head&gt;</span>
<span class="tag">&lt;body&gt;</span>
    <span class="tag">&lt;nav&gt;</span>
        <span class="tag">&lt;ul&gt;</span>
            <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"index.php"</span><span class="tag">&gt;</span><span class="string">&lt;?=</span> <span class="function">__</span>(<span class="string">'home'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
            <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"about.php"</span><span class="tag">&gt;</span><span class="string">&lt;?=</span> <span class="function">__</span>(<span class="string">'about'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
            <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"contact.php"</span><span class="tag">&gt;</span><span class="string">&lt;?=</span> <span class="function">__</span>(<span class="string">'contact'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
        <span class="tag">&lt;/ul&gt;</span>
        
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"lang-switcher"</span><span class="tag">&gt;</span>
            <span class="php-tag">&lt;?php</span> <span class="keyword">foreach</span> (<span class="class-name">I18n</span><span class="operator">::</span><span class="function">getInstance</span>()<span class="operator">-&gt;</span><span class="function">getAvailableLanguages</span>() <span class="keyword">as</span> <span class="variable">$lang</span>) : <span class="php-tag">?&gt;</span>
                <span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"?lang=&lt;?=</span> <span class="variable">$lang</span> <span class="string">?&gt;"</span><span class="tag">&gt;</span><span class="string">&lt;?=</span> <span class="function">strtoupper</span>(<span class="variable">$lang</span>) <span class="string">?&gt;</span><span class="tag">&lt;/a&gt;</span>
            <span class="php-tag">&lt;?php</span> <span class="keyword">endforeach</span>; <span class="php-tag">?&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
    <span class="tag">&lt;/nav&gt;</span>
    
    <span class="tag">&lt;h1&gt;</span><span class="string">&lt;?=</span> <span class="function">__</span>(<span class="string">'welcome'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/h1&gt;</span>
    
    <span class="tag">&lt;p&gt;</span><span class="string">&lt;?=</span> <span class="function">__</span>(<span class="string">'items_count'</span>, [<span class="string">'count'</span> <span class="operator">=&gt;</span> <span class="number">5</span>]) <span class="string">?&gt;</span><span class="tag">&lt;/p&gt;</span>
<span class="tag">&lt;/body&gt;</span>
<span class="tag">&lt;/html&gt;</span></code></pre>
                        <div class="result">
                            <p>L'utilisation d'une fonction helper <code>__()</code> simplifie l'accès aux traductions et rend le code plus lisible. Le sélecteur de langues permet aux utilisateurs de changer facilement de langue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Utilisation de gettext</h2>
            <p>gettext est une bibliothèque standard et éprouvée pour l'internationalisation, largement utilisée dans de nombreuses applications. Elle offre des fonctionnalités avancées comme la pluralisation et est compatible avec de nombreux outils de traduction.</p>

            <div class="info-box">
                <strong>Avantages de gettext</strong>
                <ul>
                    <li>Solution robuste et mature avec des décennies d'utilisation</li>
                    <li>Support natif des formes plurielles complexes</li>
                    <li>Séparation claire du code et des traductions</li>
                    <li>Nombreux outils disponibles pour les traducteurs (comme Poedit)</li>
                    <li>Performances optimisées (fichiers MO compilés)</li>
                </ul>
            </div>

            <h3>Configuration et utilisation de gettext</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Configuration de base</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Prérequis : installer l'extension gettext PHP</span>
<span class="comment">// sudo apt-get install php-gettext (Linux)</span>
<span class="comment">// Activer l'extension dans php.ini (Windows/WAMP)</span>

<span class="comment">// Structure de dossiers</span>
<span class="comment">// locale/</span>
<span class="comment">//   ├── fr_FR/</span>
<span class="comment">//   │   └── LC_MESSAGES/</span>
<span class="comment">//   │       ├── messages.po</span>
<span class="comment">//   │       └── messages.mo</span>
<span class="comment">//   ├── en_US/</span>
<span class="comment">//   │   └── LC_MESSAGES/</span>
<span class="comment">//   │       ├── messages.po</span>
<span class="comment">//   │       └── messages.mo</span>

<span class="comment">// Fonction pour configurer gettext</span>
<span class="keyword">function</span> <span class="function">setupLocale</span>(<span class="variable">$locale</span> = <span class="string">'fr_FR'</span>) {
    <span class="comment">// Liste des locales disponibles</span>
    <span class="variable">$availableLocales</span> = [
        <span class="string">'fr'</span> => <span class="string">'fr_FR'</span>,
        <span class="string">'en'</span> => <span class="string">'en_US'</span>,
        <span class="string">'es'</span> => <span class="string">'es_ES'</span>,
        <span class="string">'de'</span> => <span class="string">'de_DE'</span>
    ];
    
    <span class="comment">// Déterminer la locale à utiliser</span>
    <span class="variable">$selectedLocale</span> = <span class="variable">$availableLocales</span>[<span class="string">'fr'</span>]; <span class="comment">// Par défaut</span>
    
    <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_GET</span>[<span class="string">'lang'</span>]) && <span class="function">isset</span>(<span class="variable">$availableLocales</span>[<span class="variable">$_GET</span>[<span class="string">'lang'</span>]])) {
        <span class="variable">$selectedLocale</span> = <span class="variable">$availableLocales</span>[<span class="variable">$_GET</span>[<span class="string">'lang'</span>]];
        <span class="function">setcookie</span>(<span class="string">'lang'</span>, <span class="variable">$_GET</span>[<span class="string">'lang'</span>], <span class="function">time</span>() + <span class="number">30</span> * <span class="number">24</span> * <span class="number">3600</span>, <span class="string">'/'</span>);
    } <span class="keyword">elseif</span> (<span class="function">isset</span>(<span class="variable">$_COOKIE</span>[<span class="string">'lang'</span>]) && <span class="function">isset</span>(<span class="variable">$availableLocales</span>[<span class="variable">$_COOKIE</span>[<span class="string">'lang'</span>]])) {
        <span class="variable">$selectedLocale</span> = <span class="variable">$availableLocales</span>[<span class="variable">$_COOKIE</span>[<span class="string">'lang'</span>]];
    }
    
    <span class="comment">// Configurer l'environnement</span>
    <span class="function">putenv</span>(<span class="string">'LANG='</span> . <span class="variable">$selectedLocale</span>);
    <span class="function">setlocale</span>(LC_ALL, <span class="variable">$selectedLocale</span> . <span class="string">'.UTF-8'</span>);
    
    <span class="comment">// Spécifier le domaine et le répertoire</span>
    <span class="function">bindtextdomain</span>(<span class="string">'messages'</span>, <span class="function">dirname</span>(<span class="variable">__FILE__</span>) . <span class="string">'/locale'</span>);
    <span class="function">bind_textdomain_codeset</span>(<span class="string">'messages'</span>, <span class="string">'UTF-8'</span>);
    <span class="function">textdomain</span>(<span class="string">'messages'</span>);
    
    <span class="keyword">return</span> <span class="function">substr</span>(<span class="variable">$selectedLocale</span>, <span class="number">0</span>, <span class="number">2</span>); <span class="comment">// Retourne le code de langue (fr, en, etc.)</span>
}</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Utilisation dans les pages</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Inclure la configuration gettext</span>
<span class="keyword">require_once</span> <span class="string">'locale_setup.php'</span>;
<span class="variable">$lang</span> = <span class="function">setupLocale</span>();

<span class="tag">&lt;!DOCTYPE html&gt;</span>
<span class="tag">&lt;html</span> <span class="attr">lang</span>=<span class="string">"&lt;?=</span> <span class="variable">$lang</span> <span class="string">?&gt;"</span><span class="tag">&gt;</span>
<span class="tag">&lt;head&gt;</span>
    <span class="tag">&lt;meta</span> <span class="attr">charset</span>=<span class="string">"UTF-8"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;title&gt;</span><span class="string">&lt;?=</span> <span class="function">gettext</span>(<span class="string">'Bienvenue sur notre site'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/title&gt;</span>
<span class="tag">&lt;/head&gt;</span>
<span class="tag">&lt;body&gt;</span>
    <span class="tag">&lt;nav&gt;</span>
        <span class="tag">&lt;ul&gt;</span>
            <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"index.php"</span><span class="tag">&gt;</span><span class="string">&lt;?=</span> <span class="function">_</span>(<span class="string">'Accueil'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
            <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"about.php"</span><span class="tag">&gt;</span><span class="string">&lt;?=</span> <span class="function">_</span>(<span class="string">'À propos'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
            <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"contact.php"</span><span class="tag">&gt;</span><span class="string">&lt;?=</span> <span class="function">_</span>(<span class="string">'Contact'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
        <span class="tag">&lt;/ul&gt;</span>
    <span class="tag">&lt;/nav&gt;</span>
    
    <span class="tag">&lt;h1&gt;</span><span class="string">&lt;?=</span> <span class="function">gettext</span>(<span class="string">'Bienvenue sur notre site'</span>) <span class="string">?&gt;</span><span class="tag">&lt;/h1&gt;</span>
    
    <span class="tag">&lt;p&gt;</span>
        <span class="php-tag">&lt;?php</span>
        <span class="variable">$count</span> = <span class="number">5</span>;
        <span class="keyword">echo</span> <span class="function">sprintf</span>(
            <span class="function">ngettext</span>(
                <span class="string">'Vous avez %d article dans votre panier.'</span>,
                <span class="string">'Vous avez %d articles dans votre panier.'</span>,
                <span class="variable">$count</span>
            ),
            <span class="variable">$count</span>
        );
        <span class="php-tag">?&gt;</span>
    <span class="tag">&lt;/p&gt;</span>
<span class="tag">&lt;/body&gt;</span>
<span class="tag">&lt;/html&gt;</span></code></pre>
                        <div class="result">
                            <p>Dans cet exemple :</p>
                            <ul>
                                <li><code>gettext()</code> et son alias <code>_()</code> sont utilisés pour les traductions simples</li>
                                <li><code>ngettext()</code> gère la pluralisation en fonction de la valeur</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Création et gestion des fichiers de traduction</h3>
            <div class="example">
                <div class="example-header">Workflow de traduction</div>
                <div class="example-content">
                    <ol>
                        <li><strong>Extraction des chaînes à traduire</strong> :
                            <pre><code class="language-bash"><span class="function">xgettext</span> <span class="operator">--from-code</span>=UTF-8 <span class="operator">-o</span> messages.pot *.php</code></pre>
                            <p>Cette commande analyse vos fichiers PHP et extrait toutes les chaînes de traduction dans un fichier template (.pot).</p>
                        </li>
                        <li><strong>Création des fichiers de traduction spécifiques à la langue</strong> :
                            <pre><code class="language-bash"><span class="function">msginit</span> <span class="operator">-i</span> messages.pot <span class="operator">-o</span> locale/fr_FR/LC_MESSAGES/messages.po <span class="operator">-l</span> fr_FR</code></pre>
                            <p>Cette commande génère un fichier .po pour la langue française à partir du template.</p>
                        </li>
                        <li><strong>Traduction des fichiers .po</strong> :
                            <p>Utilisez un éditeur comme Poedit pour traduire les chaînes dans le fichier .po.</p>
                        </li>
                        <li><strong>Compilation en fichiers binaires .mo</strong> :
                            <pre><code class="language-bash"><span class="function">msgfmt</span> locale/fr_FR/LC_MESSAGES/messages.po <span class="operator">-o</span> locale/fr_FR/LC_MESSAGES/messages.mo</code></pre>
                            <p>Cette étape transforme les fichiers .po en fichiers .mo binaires optimisés pour gettext.</p>
                        </li>
                        <li><strong>Mise à jour des traductions existantes</strong> :
                            <pre><code class="language-bash"><span class="function">msgmerge</span> <span class="operator">--update</span> locale/fr_FR/LC_MESSAGES/messages.po messages.pot</code></pre>
                            <p>Cette commande met à jour un fichier .po existant avec de nouvelles chaînes du template.</p>
                        </li>
                    </ol>
                    <div class="result">
                        <p>Vous pouvez également utiliser des outils graphiques comme <a href="https://poedit.net/" target="_blank">Poedit</a> qui simplifient considérablement ce processus pour les traducteurs non techniques.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Bibliothèques PHP pour l'internationalisation</h2>
            <p>Pour les projets plus complexes ou si vous utilisez un framework PHP, plusieurs bibliothèques spécialisées peuvent faciliter la gestion des traductions.</p>

            <h3>Symfony Translation</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Installation</div>
                    <div class="example-content">
                        <pre><code class="language-bash"><span class="function">composer</span> require symfony/translation</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Utilisation de base</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">use</span> Symfony\Component\Translation\Translator;
<span class="keyword">use</span> Symfony\Component\Translation\Loader\PhpFileLoader;

<span class="comment">// Créer le traducteur</span>
<span class="variable">$translator</span> = <span class="keyword">new</span> <span class="class-name">Translator</span>(<span class="string">'fr'</span>);
<span class="variable">$translator</span>-><span class="function">addLoader</span>(<span class="string">'php'</span>, <span class="keyword">new</span> <span class="class-name">PhpFileLoader</span>());

<span class="comment">// Ajouter une ressource de traduction</span>
<span class="variable">$translator</span>-><span class="function">addResource</span>(
    <span class="string">'php'</span>,
    <span class="string">'translations/messages.fr.php'</span>,
    <span class="string">'fr'</span>,
    <span class="string">'messages'</span>
);

<span class="comment">// Traductions pour l'anglais</span>
<span class="variable">$translator</span>-><span class="function">addResource</span>(
    <span class="string">'php'</span>,
    <span class="string">'translations/messages.en.php'</span>,
    <span class="string">'en'</span>,
    <span class="string">'messages'</span>
);

<span class="comment">// Utiliser le traducteur</span>
<span class="keyword">echo</span> <span class="variable">$translator</span>-><span class="function">trans</span>(<span class="string">'welcome'</span>, [], <span class="string">'messages'</span>);

<span class="comment">// Avec des paramètres</span>
<span class="keyword">echo</span> <span class="variable">$translator</span>-><span class="function">trans</span>(
    <span class="string">'hello_name'</span>,
    [<span class="string">'%name%'</span> => <span class="string">'John'</span>],
    <span class="string">'messages'</span>
);

<span class="comment">// Avec pluralisation</span>
<span class="keyword">echo</span> <span class="variable">$translator</span>-><span class="function">trans</span>(
    <span class="string">'items_count'</span>,
    [<span class="string">'%count%'</span> => <span class="number">5</span>],
    <span class="string">'messages'</span>
);</code></pre>
                        <div class="result">
                            <p>Le composant Translation de Symfony prend en charge plusieurs formats de fichiers (PHP, YAML, JSON, etc.) et offre des fonctionnalités avancées comme la pluralisation, les domaines et la détection automatique de la locale.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Laravel Localization</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Structure de fichiers</div>
                    <div class="example-content">
                        <pre><code class="language-tree">resources/
└── lang/
    ├── en/
    │   ├── messages.php
    │   └── validation.php
    └── fr/
        ├── messages.php
        └── validation.php</code></pre>
                        <p>Exemple de fichier de langue (resources/lang/fr/messages.php) :</p>
                        <pre><code class="language-php"><span class="keyword">return</span> [
    <span class="string">'welcome'</span> => <span class="string">'Bienvenue sur notre site'</span>,
    <span class="string">'hello_name'</span> => <span class="string">'Bonjour, :name!'</span>,
    <span class="string">'items'</span> => <span class="string">'Vous avez :count article|Vous avez :count articles'</span>,
];</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Utilisation dans Laravel</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Dans un contrôleur ou une vue</span>

<span class="comment">// Traduction simple</span>
<span class="keyword">echo</span> <span class="function">__</span>(<span class="string">'messages.welcome'</span>);

<span class="comment">// Avec remplacement de paramètres</span>
<span class="keyword">echo</span> <span class="function">__</span>(<span class="string">'messages.hello_name'</span>, [<span class="string">'name'</span> => <span class="string">'Marie'</span>]);

<span class="comment">// Avec pluralisation</span>
<span class="keyword">echo</span> <span class="function">trans_choice</span>(<span class="string">'messages.items'</span>, <span class="number">5</span>, [<span class="string">'count'</span> => <span class="number">5</span>]);</code></pre>
                        <div class="result">
                            <p>Laravel intègre nativement la gestion des traductions avec :</p>
                            <ul>
                                <li>La fonction helper <code>__()</code> pour les traductions simples</li>
                                <li>La fonction <code>trans_choice()</code> pour la pluralisation</li>
                                <li>Les middleware pour définir automatiquement la locale</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Bonnes pratiques pour l'internationalisation</h3>
            <div class="info-box">
                <strong>Conseils pour une internationalisation réussie</strong>
                <ol>
                    <li><strong>Planifiez dès le début</strong> : Il est bien plus facile d'internationaliser une application dès sa conception que de l'adapter après coup.</li>
                    <li><strong>Utilisez des clés descriptives</strong> : Préférez <code>'login.welcome_message'</code> à <code>'welcome'</code> pour éviter les collisions.</li>
                    <li><strong>Contextualisez vos traductions</strong> : Le mot "post" peut signifier "publier" ou "article" selon le contexte.</li>
                    <li><strong>Soyez attentif à la pluralisation</strong> : Ne vous limitez pas à "1" et "plusieurs", certaines langues ont des règles complexes.</li>
                    <li><strong>Externalisez tout le texte</strong> : Y compris les messages d'erreur, notifications, et textes d'interface.</li>
                    <li><strong>Localisez les formats</strong> : Dates, nombres, devises, formats d'adresse selon les conventions locales.</li>
                    <li><strong>Testez avec des traducteurs réels</strong> : Une traduction automatique ne suffit pas pour une expérience de qualité.</li>
                    <li><strong>Prenez en compte l'expansion du texte</strong> : Le texte traduit peut être jusqu'à 30% plus long dans certaines langues.</li>
                </ol>
            </div>

            <h3>Outils et ressources</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Outils de traduction</div>
                    <div class="example-content">
                        <ul>
                            <li><a href="https://poedit.net/" target="_blank">Poedit</a> - Éditeur de fichiers .po/.mo</li>
                            <li><a href="https://lokalise.com/" target="_blank">Lokalise</a> - Plateforme de gestion de traductions</li>
                            <li><a href="https://www.transifex.com/" target="_blank">Transifex</a> - Plateforme collaborative de traduction</li>
                            <li><a href="https://crowdin.com/" target="_blank">Crowdin</a> - Solution de gestion de localisation</li>
                        </ul>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Extensions et plugins utiles</div>
                    <div class="example-content">
                        <ul>
                            <li>VS Code : <a href="https://marketplace.visualstudio.com/items?itemName=mrorz.language-gettext" target="_blank">GetText</a> - Support pour les fichiers .po/.pot</li>
                            <li>Chrome : <a href="https://chrome.google.com/webstore/detail/locale-switcher/kngfjpghaokedippaapkfihdlmmlafcc" target="_blank">Locale Switcher</a> - Pour tester différentes langues</li>
                            <li>Firefox : <a href="https://addons.mozilla.org/en-US/firefox/addon/locale-switcher/" target="_blank">Quick Locale Switcher</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="navigation">
            <a href="20-sessions-authentification.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="22-deploiement-hebergement.php" class="nav-button">Module suivant →</a>
        </div>
    </main>
</body>

</html>