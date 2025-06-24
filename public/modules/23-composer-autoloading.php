<?php include __DIR__ . '/../includes/header.php';
$titre = "Utilisation de Composer et autoloading";
$description = "Maîtrisez la gestion des dépendances avec Composer, implémentez l'autoloading PSR-4 et apprenez à créer et distribuer vos propres packages PHP.";
?>


<body class="module23">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </header>
    <div class="navigation">
        <a href="22-deploiement-hebergement.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="24-routeur-php.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction à Composer</h2>
            <p>Composer est un gestionnaire de dépendances pour PHP qui permet d'installer et de gérer facilement les bibliothèques dont votre projet a besoin. Il est devenu un outil essentiel dans l'écosystème PHP moderne.</p>

            <div class="info-box">
                <strong>Qu'est-ce que Composer ?</strong>
                <p>Composer résout plusieurs problèmes courants en développement PHP :</p>
                <ul>
                    <li><strong>Gestion des dépendances</strong> : Téléchargement et mise à jour automatique des bibliothèques</li>
                    <li><strong>Résolution de versions</strong> : Gestion des contraintes de compatibilité entre packages</li>
                    <li><strong>Autoloading</strong> : Chargement automatique des classes sans require/include manuels</li>
                    <li><strong>Standardisation</strong> : Normalisation de la structure des projets PHP</li>
                </ul>
            </div>

            <h3>Installation de Composer</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Installation sous Windows</div>
                    <div class="example-content">
                        <ol>
                            <li>Téléchargez l'installateur depuis <a href="https://getcomposer.org/Composer-Setup.exe" target="_blank">getcomposer.org</a></li>
                            <li>Exécutez l'installateur et suivez les instructions</li>
                            <li>Vérifiez l'installation avec la commande :</li>
                        </ol>
                        <pre><code class="language-bash">composer --version</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Installation sous Linux/macOS</div>
                    <div class="example-content">
                        <p>Installation via la ligne de commande :</p>
                        <pre><code class="language-bash"><span class="comment"># Téléchargement du programme d'installation</span>
<span class="function">php</span> -r <span class="string">"copy('https://getcomposer.org/installer', 'composer-setup.php');"</span>

<span class="comment"># Vérification du hachage SHA-384 (optionnel mais recommandé)</span>
<span class="function">php</span> -r <span class="string">"if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"</span>

<span class="comment"># Installation</span>
<span class="function">php</span> composer-setup.php

<span class="comment"># Nettoyage</span>
<span class="function">php</span> -r <span class="string">"unlink('composer-setup.php');"</span>

<span class="comment"># Installation globale (optionnel)</span>
<span class="function">sudo</span> mv composer.phar /usr/local/bin/composer

<span class="comment"># Vérification</span>
<span class="function">composer</span> --version</code></pre>
                    </div>
                </div>
            </div>

            <h3>Structure de base d'un projet Composer</h3>
            <div class="example">
                <div class="example-header">Fichier composer.json</div>
                <div class="example-content">
                    <p>Le fichier <code>composer.json</code> est au cœur de chaque projet utilisant Composer. Il définit les métadonnées et les dépendances du projet.</p>
                    <pre><code class="language-json">{
    <span class="property">"name"</span>: <span class="string">"mon-vendor/mon-projet"</span>,
    <span class="property">"description"</span>: <span class="string">"Une description de mon projet"</span>,
    <span class="property">"type"</span>: <span class="string">"project"</span>,
    <span class="property">"license"</span>: <span class="string">"MIT"</span>,
    <span class="property">"authors"</span>: [
        {
            <span class="property">"name"</span>: <span class="string">"Votre Nom"</span>,
            <span class="property">"email"</span>: <span class="string">"votre.email@exemple.com"</span>
        }
    ],
    <span class="property">"minimum-stability"</span>: <span class="string">"stable"</span>,    <span class="property">"require"</span>: {
        <span class="property">"php"</span>: <span class="string">">=7.4"</span>,
        <span class="property">"monolog/monolog"</span>: <span class="string">"^2.3"</span>,
        <span class="property">"symfony/http-foundation"</span>: <span class="string">"^5.3"</span>
    },
    <span class="property">"require-dev"</span>: {
        <span class="property">"phpunit/phpunit"</span>: <span class="string">"^9.5"</span>,
        <span class="property">"friendsofphp/php-cs-fixer"</span>: <span class="string">"^3.0"</span>
    },
    <span class="property">"autoload"</span>: {
        <span class="property">"psr-4"</span>: {
            <span class="property">"MonNamespace\\"</span>: <span class="string">"src/"</span>
        }
    },
    <span class="property">"autoload-dev"</span>: {
        <span class="property">"psr-4"</span>: {
            <span class="property">"MonNamespace\\Tests\\"</span>: <span class="string">"tests/"</span>
        }
    },
    <span class="property">"scripts"</span>: {
        <span class="property">"test"</span>: <span class="string">"phpunit"</span>,
        <span class="property">"cs-fix"</span>: <span class="string">"php-cs-fixer fix"</span>
    }
}</code></pre>
                    <div class="result">
                        <p>Explications des sections principales :</p>
                        <ul>
                            <li><code>require</code> : Dépendances nécessaires pour l'environnement de production</li>
                            <li><code>require-dev</code> : Dépendances nécessaires uniquement pour le développement</li>
                            <li><code>autoload</code> : Configuration du chargement automatique des classes</li>
                            <li><code>scripts</code> : Commandes personnalisées exécutables via Composer</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Installation et gestion des packages</h2>

            <h3>Commandes de base de Composer</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Installer des dépendances</div>
                    <div class="example-content">
                        <pre><code class="language-bash"><span class="comment"># Initialiser un nouveau projet</span>
<span class="function">composer</span> init

<span class="comment"># Installer toutes les dépendances du projet</span>
<span class="function">composer</span> install

<span class="comment"># Installer avec optimisation pour la production</span>
<span class="function">composer</span> install <span class="operator">--no-dev</span> <span class="operator">--optimize-autoloader</span>

<span class="comment"># Ajouter une nouvelle dépendance</span>
<span class="function">composer</span> require monolog/monolog

<span class="comment"># Ajouter une dépendance de développement</span>
<span class="function">composer</span> require <span class="operator">--dev</span> phpunit/phpunit

<span class="comment"># Spécifier une version précise</span>
<span class="function">composer</span> require twig/twig:<span class="string">^3.0</span>

<span class="comment"># Mettre à jour toutes les dépendances</span>
<span class="function">composer</span> update

<span class="comment"># Mettre à jour une dépendance spécifique</span>
<span class="function">composer</span> update monolog/monolog

<span class="comment"># Supprimer une dépendance</span>
<span class="function">composer</span> remove symfony/yaml</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Gestion des versions</div>
                    <div class="example-content">
                        <p>Composer utilise le <a href="https://semver.org/" target="_blank">versionnement sémantique</a> (SemVer) pour les contraintes de versions.</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Contrainte</th>
                                    <th>Signification</th>
                                    <th>Exemple</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>1.2.3</code></td>
                                    <td>Version exacte</td>
                                    <td>Seule la version 1.2.3</td>
                                </tr>
                                <tr>
                                    <td><code>>=1.2.3</code></td>
                                    <td>Version minimale</td>
                                    <td>1.2.3 ou plus récent</td>
                                </tr>
                                <tr>
                                    <td><code>>1.2.3</code></td>
                                    <td>Version strictement supérieure</td>
                                    <td>1.2.4 ou plus récent</td>
                                </tr>
                                <tr>
                                    <td><code>^1.2.3</code></td>
                                    <td>Compatible avec les versions 1.x</td>
                                    <td>≥ 1.2.3 et < 2.0.0</td>
                                </tr>
                                <tr>
                                    <td><code>~1.2.3</code></td>
                                    <td>Compatible avec les versions de correctifs</td>
                                    <td>≥ 1.2.3 et < 1.3.0</td>
                                </tr>
                                <tr>
                                    <td><code>1.2.*</code></td>
                                    <td>Joker</td>
                                    <td>≥ 1.2.0 et < 1.3.0</td>
                                </tr>
                                <tr>
                                    <td><code>1.2.3 || 1.3.0</code></td>
                                    <td>OU logique</td>
                                    <td>Soit 1.2.3, soit 1.3.0</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="result">
                            <p><strong>Recommandation</strong> : Utilisez <code>^</code> pour la plupart des dépendances afin de bénéficier automatiquement des correctifs de bugs tout en évitant les changements incompatibles.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Composer.lock et stabilité du projet</h3>
            <div class="example">
                <div class="example-header">Importance du fichier composer.lock</div>
                <div class="example-content">
                    <p>Le fichier <code>composer.lock</code> est automatiquement généré lors de l'installation ou de la mise à jour des dépendances. Il enregistre les versions exactes installées de chaque package.</p>

                    <div class="info-box warning-box">
                        <strong>Important</strong>
                        <ul>
                            <li>Toujours commiter <code>composer.lock</code> dans votre dépôt Git pour les projets d'application</li>
                            <li>Ne pas commiter <code>composer.lock</code> pour les bibliothèques/packages</li>
                        </ul>
                    </div>

                    <p>Avantages du fichier lock :</p>
                    <ul>
                        <li><strong>Reproductibilité</strong> : Garantit que tous les environnements utilisent exactement les mêmes versions</li>
                        <li><strong>Stabilité</strong> : Évite les surprises lors des déploiements</li>
                        <li><strong>Performance</strong> : Installation plus rapide car les versions sont déjà déterminées</li>
                    </ul>
                    <pre><code class="language-bash"><span class="comment"># Installer à partir du composer.lock (recommandé pour les déploiements)</span>
<span class="function">composer</span> install

<span class="comment"># Mettre à jour le composer.lock avec les dernières versions compatibles</span>
<span class="function">composer</span> update</code></pre>
                </div>
            </div>

            <h3>Packages populaires et utilitaires Composer</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Packages PHP populaires</div>
                    <div class="example-content">
                        <ul>
                            <li><strong>monolog/monolog</strong> - Système de journalisation</li>
                            <li><strong>guzzlehttp/guzzle</strong> - Client HTTP</li>
                            <li><strong>symfony/http-foundation</strong> - Composants web fondamentaux</li>
                            <li><strong>twig/twig</strong> - Moteur de templates</li>
                            <li><strong>doctrine/orm</strong> - ORM pour bases de données</li>
                            <li><strong>phpunit/phpunit</strong> - Framework de test</li>
                            <li><strong>ramsey/uuid</strong> - Génération d'identifiants uniques</li>
                            <li><strong>nesbot/carbon</strong> - Manipulation des dates</li>
                            <li><strong>vlucas/phpdotenv</strong> - Chargement de variables d'environnement</li>
                            <li><strong>league/flysystem</strong> - Abstraction du système de fichiers</li>
                        </ul>
                        <div class="result">
                            <p>Explorez plus de packages sur <a href="https://packagist.org/" target="_blank">Packagist.org</a>, le dépôt principal de Composer.</p>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Utilitaires Composer utiles</div>
                    <div class="example-content">
                        <pre><code class="language-bash"><span class="comment"># Afficher les informations sur les packages installés</span>
<span class="function">composer</span> show

<span class="comment"># Afficher les détails d'un package spécifique</span>
<span class="function">composer</span> show monolog/monolog

<span class="comment"># Vérifier les mises à jour disponibles</span>
<span class="function">composer</span> outdated

<span class="comment"># Vérifier les problèmes de sécurité dans les dépendances</span>
<span class="function">composer</span> audit

<span class="comment"># Valider la configuration composer.json</span>
<span class="function">composer</span> validate

<span class="comment"># Nettoyer le cache Composer</span>
<span class="function">composer</span> clear-cache

<span class="comment"># Créer un projet à partir d'un squelette</span>
<span class="function">composer</span> create-project laravel/laravel mon-projet

<span class="comment"># Exécuter un script défini dans composer.json</span>
<span class="function">composer</span> run-script test</code></pre>
                        <div class="result">
                            <p>Utilisez <code>composer help</code> pour voir toutes les commandes disponibles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Autoloading avec Composer</h2>
            <p>L'autoloading est l'une des fonctionnalités les plus puissantes de Composer : elle permet de charger automatiquement les classes PHP sans avoir à utiliser manuellement les instructions <code>require</code> ou <code>include</code>.</p>

            <h3>Types d'autoloading</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">PSR-4 (Recommandé)</div>
                    <div class="example-content">
                        <p>PSR-4 est la norme d'autoloading moderne qui permet de faire correspondre les espaces de noms avec les répertoires.</p>

                        <p>Configuration dans <code>composer.json</code> :</p>
                        <pre><code class="language-json">{
    <span class="property">"autoload"</span>: {
        <span class="property">"psr-4"</span>: {
            <span class="property">"App\\"</span>: <span class="string">"src/"</span>
        }
    }
}</code></pre>

                        <p>Structure de répertoires :</p>
                        <pre><code class="language-tree">projet/
├── composer.json
├── src/
│   ├── Controller/
│   │   └── UserController.php
│   └── Model/
│       └── User.php</code></pre>

                        <p>Dans <code>src/Controller/UserController.php</code> :</p>
                        <pre><code class="language-php"><span class="keyword">namespace</span> App\Controller;

<span class="keyword">use</span> App\Model\User;

<span class="keyword">class</span> <span class="class-name">UserController</span>
{
    <span class="keyword">public function</span> <span class="function">show</span>($id)
    {
        $user = <span class="keyword">new</span> <span class="class-name">User</span>($id);
        <span class="keyword">return</span> $user->getData();
    }
}</code></pre>
                        <div class="result">
                            <p>Avec PSR-4, <code>App\Controller\UserController</code> est automatiquement résolu en <code>src/Controller/UserController.php</code>.</p>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Autres types d'autoloading</div>
                    <div class="example-content">
                        <p><strong>PSR-0</strong> (Déprécié)</p>
                        <pre><code class="language-json">{
    <span class="property">"autoload"</span>: {
        <span class="property">"psr-0"</span>: {
            <span class="property">"App\\"</span>: <span class="string">"src/"</span>
        }
    }
}</code></pre>
                        <p><em>Différence principale avec PSR-4 : PSR-0 convertit les underscores dans les noms de classes en séparateurs de répertoire.</em></p>

                        <p><strong>Classmap</strong></p>
                        <pre><code class="language-json">{
    <span class="property">"autoload"</span>: {
        <span class="property">"classmap"</span>: [<span class="string">"src/"</span>, <span class="string">"lib/"</span>]
    }
}</code></pre>
                        <p><em>Scanne les répertoires spécifiés et génère une correspondance statique entre chaque classe trouvée et son emplacement de fichier.</em></p>

                        <p><strong>Files</strong></p>
                        <pre><code class="language-json">{
    <span class="property">"autoload"</span>: {
        <span class="property">"files"</span>: [<span class="string">"src/helpers.php"</span>, <span class="string">"src/functions.php"</span>]
    }
}</code></pre>
                        <p><em>Inclut des fichiers spécifiques dans chaque requête, utile pour les fichiers de fonctions globales.</em></p>

                        <p>Après modification de la configuration d'autoloading :</p>
                        <pre><code class="language-bash"><span class="comment"># Régénérer les fichiers d'autoloading</span>
<span class="function">composer</span> dump-autoload

<span class="comment"># Optimiser pour la production</span>
<span class="function">composer</span> dump-autoload <span class="operator">--optimize</span></code></pre>
                    </div>
                </div>
            </div>

            <h3>PSR-4 en détail</h3>
            <div class="example">
                <div class="example-header">Convention de nommage PSR-4</div>
                <div class="example-content">
                    <p>Le standard PSR-4 définit les règles suivantes :</p>
                    <ul>
                        <li>Les noms complets des classes doivent suivre le format : <code>&lt;NamespacePrefix&gt;\&lt;SubNamespaces&gt;\&lt;ClassName&gt;</code></li>
                        <li>Chaque namespace est mappé à un répertoire</li>
                        <li>Chaque séparateur de namespace <code>\</code> correspond à un séparateur de répertoire <code>/</code></li>
                        <li>Les noms de classes doivent correspondre exactement aux noms de fichiers (sensibles à la casse)</li>
                    </ul>

                    <p>Exemple avancé de mappings multiples :</p>
                    <pre><code class="language-json">{
    <span class="property">"autoload"</span>: {
        <span class="property">"psr-4"</span>: {
            <span class="property">"App\\"</span>: <span class="string">"src/"</span>,
            <span class="property">"App\\Plugins\\"</span>: <span class="string">"plugins/"</span>,
            <span class="property">"Acme\\Tools\\"</span>: <span class="string">"vendor-local/acme/tools-package/src"</span>
        }
    }
}</code></pre>

                    <div class="info-box">
                        <strong>Bonnes pratiques</strong>
                        <ul>
                            <li>Utilisez des namespaces uniques pour éviter les conflits avec d'autres bibliothèques</li>
                            <li>Préfixez vos namespaces avec un identifiant de votre organisation/projet</li>
                            <li>Maintenez une structure de répertoires claire qui reflète la hiérarchie des namespaces</li>
                            <li>Utilisez StudlyCaps pour les noms de classes (première lettre en majuscule)</li>
                            <li>Placez une seule classe par fichier</li>
                        </ul>
                    </div>
                </div>
            </div>

            <h3>Utilisation de l'autoloader</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Inclusion de l'autoloader</div>
                    <div class="example-content">
                        <p>Pour utiliser l'autoloading dans vos scripts, incluez le fichier <code>vendor/autoload.php</code> généré par Composer :</p>
                        <pre><code class="language-php"><span class="keyword">require_once</span> <span class="string">'vendor/autoload.php'</span>;

<span class="comment">// Maintenant, vous pouvez utiliser vos classes sans require/include</span>
<span class="variable">$logger</span> = <span class="keyword">new</span> <span class="class-name">Monolog\Logger</span>(<span class="string">'app'</span>);
<span class="variable">$user</span> = <span class="keyword">new</span> <span class="class-name">App\Model\User</span>(<span class="number">1</span>);</code></pre>

                        <p>Dans un projet structuré, cela se fait généralement dans un point d'entrée unique :</p>
                        <pre><code class="language-php"><span class="comment">// public/index.php</span>
<span class="keyword">define</span>(<span class="string">'ROOT_DIR'</span>, <span class="function">dirname</span>(<span class="function">dirname</span>(<span class="variable">__FILE__</span>)));

<span class="keyword">require_once</span> <span class="variable">ROOT_DIR</span> . <span class="string">'/vendor/autoload.php'</span>;

<span class="comment">// Code de démarrage de l'application</span>
<span class="variable">$app</span> = <span class="keyword">new</span> <span class="class-name">App\Application</span>();
<span class="variable">$app</span>-><span class="function">run</span>();</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Optimisation de l'autoloading</div>
                    <div class="example-content">
                        <p>En production, optimisez l'autoloading pour de meilleures performances :</p>
                        <pre><code class="language-bash"><span class="comment"># Génère un fichier de class map qui accélère la résolution des classes</span>
<span class="function">composer</span> dump-autoload <span class="operator">--optimize</span> <span class="operator">--no-dev</span></code></pre>

                        <p>Comparaison des différentes options :</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Description</th>
                                    <th>Utilisation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>--optimize</code> ou <code>-o</code></td>
                                    <td>Convertit PSR-0/PSR-4 en classmap</td>
                                    <td>Production</td>
                                </tr>
                                <tr>
                                    <td><code>--classmap-authoritative</code> ou <code>-a</code></td>
                                    <td>Utilise uniquement le classmap (plus strict)</td>
                                    <td>Production critique</td>
                                </tr>
                                <tr>
                                    <td><code>--apcu</code></td>
                                    <td>Utilise APCu pour mettre en cache les classmap</td>
                                    <td>Production avec APCu</td>
                                </tr>
                                <tr>
                                    <td><code>--no-dev</code></td>
                                    <td>Exclut les dépendances de développement</td>
                                    <td>Production</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Créer et publier son propre package</h2>
            <p>Vous pouvez créer et publier vos propres packages PHP pour les réutiliser dans vos projets ou les partager avec la communauté.</p>

            <h3>Structure d'un package PHP</h3>
            <div class="example">
                <div class="example-header">Organisation des fichiers</div>
                <div class="example-content">
                    <pre><code class="language-tree">mon-package/
├── composer.json
├── LICENSE
├── README.md
├── .gitignore
├── phpunit.xml.dist
├── src/
│   └── ...
├── tests/
│   └── ...
└── docs/
    └── ...</code></pre>

                    <p>Exemple de <code>composer.json</code> pour un package :</p>
                    <pre><code class="language-json">{
    <span class="property">"name"</span>: <span class="string">"mon-vendor/mon-package"</span>,
    <span class="property">"description"</span>: <span class="string">"Description de mon package"</span>,
    <span class="property">"type"</span>: <span class="string">"library"</span>,
    <span class="property">"license"</span>: <span class="string">"MIT"</span>,
    <span class="property">"authors"</span>: [
        {
            <span class="property">"name"</span>: <span class="string">"Votre Nom"</span>,
            <span class="property">"email"</span>: <span class="string">"email@exemple.com"</span>
        }
    ],
    <span class="property">"require"</span>: {
        <span class="property">"php"</span>: <span class="string">">=7.4"</span>
    },
    <span class="property">"require-dev"</span>: {
        <span class="property">"phpunit/phpunit"</span>: <span class="string">"^9.5"</span>
    },
    <span class="property">"autoload"</span>: {
        <span class="property">"psr-4"</span>: {
            <span class="property">"MonVendor\\MonPackage\\"</span>: <span class="string">"src/"</span>
        }
    },
    <span class="property">"autoload-dev"</span>: {
        <span class="property">"psr-4"</span>: {
            <span class="property">"MonVendor\\MonPackage\\Tests\\"</span>: <span class="string">"tests/"</span>
        }
    },
    <span class="property">"minimum-stability"</span>: <span class="string">"stable"</span>,
    <span class="property">"prefer-stable"</span>: <span class="boolean">true</span>
}</code></pre>

                    <div class="result">
                        <p><strong>Important</strong> : Le nom du package doit suivre le format <code>vendor/name</code> où :</p>
                        <ul>
                            <li><code>vendor</code> est votre nom d'organisation ou nom d'utilisateur (sans majuscules ni caractères spéciaux)</li>
                            <li><code>name</code> est le nom du package (généralement en minuscule avec des tirets)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <h3>Développement et test de packages</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Développer votre package</div>
                    <div class="example-content">
                        <p>Exemple de classe dans <code>src/Calculator.php</code> :</p>
                        <pre><code class="language-php"><span class="keyword">namespace</span> MonVendor\MonPackage;

<span class="keyword">class</span> <span class="class-name">Calculator</span>
{
    <span class="comment">/**
     * Additionne deux nombres.
     *
     * @param float $a Premier nombre
     * @param float $b Second nombre
     * @return float La somme des deux nombres
     */</span>
    <span class="keyword">public function</span> <span class="function">add</span>(<span class="variable">$a</span>, <span class="variable">$b</span>)
    {
        <span class="keyword">return</span> <span class="variable">$a</span> + <span class="variable">$b</span>;
    }
    
    <span class="comment">/**
     * Soustrait le second nombre du premier.
     *
     * @param float $a Premier nombre
     * @param float $b Second nombre
     * @return float La différence entre les deux nombres
     */</span>
    <span class="keyword">public function</span> <span class="function">subtract</span>(<span class="variable">$a</span>, <span class="variable">$b</span>)
    {
        <span class="keyword">return</span> <span class="variable">$a</span> - <span class="variable">$b</span>;
    }
}
</code></pre>

                        <p>Test unitaire correspondant dans <code>tests/CalculatorTest.php</code> :</p>
                        <pre><code class="language-php"><span class="keyword">namespace</span> MonVendor\MonPackage\Tests;

<span class="keyword">use</span> MonVendor\MonPackage\Calculator;
<span class="keyword">use</span> PHPUnit\Framework\TestCase;

<span class="keyword">class</span> <span class="class-name">CalculatorTest</span> <span class="keyword">extends</span> <span class="class-name">TestCase</span>
{
    <span class="keyword">public function</span> <span class="function">testAdd</span>()
    {
        <span class="variable">$calculator</span> = <span class="keyword">new</span> <span class="class-name">Calculator</span>();
        <span class="variable">$result</span> = <span class="variable">$calculator</span>-><span class="function">add</span>(<span class="number">5</span>, <span class="number">3</span>);
        <span class="variable">$this</span>-><span class="function">assertEquals</span>(<span class="number">8</span>, <span class="variable">$result</span>);
    }

    <span class="keyword">public function</span> <span class="function">testSubtract</span>()
    {
        <span class="variable">$calculator</span> = <span class="keyword">new</span> <span class="class-name">Calculator</span>();
        <span class="variable">$result</span> = <span class="variable">$calculator</span>-><span class="function">subtract</span>(<span class="number">5</span>, <span class="number">3</span>);
        <span class="variable">$this</span>-><span class="function">assertEquals</span>(<span class="number">2</span>, <span class="variable">$result</span>);
    }
}</code></pre>
                        <p>Configuration PHPUnit dans <code>phpunit.xml.dist</code> :</p>
                        <pre><code class="language-xml">&lt;?xml version=<span class="string">"1.0"</span> encoding=<span class="string">"UTF-8"</span>?&gt;
&lt;<span class="tag">phpunit</span> <span class="attr">xmlns:xsi</span>=<span class="string">"http://www.w3.org/2001/XMLSchema-instance"</span>
         <span class="attr">xsi:noNamespaceSchemaLocation</span>=<span class="string">"https://schema.phpunit.de/9.5/phpunit.xsd"</span>
         <span class="attr">bootstrap</span>=<span class="string">"vendor/autoload.php"</span>
         <span class="attr">colors</span>=<span class="string">"true"</span>&gt;
    &lt;<span class="tag">testsuites</span>&gt;
        &lt;<span class="tag">testsuite</span> <span class="attr">name</span>=<span class="string">"MonPackage Test Suite"</span>&gt;
            &lt;<span class="tag">directory</span>&gt;tests&lt;/<span class="tag">directory</span>&gt;
        &lt;/<span class="tag">testsuite</span>&gt;
    &lt;/<span class="tag">testsuites</span>&gt;
    &lt;<span class="tag">coverage</span>&gt;
        &lt;<span class="tag">include</span>&gt;
            &lt;<span class="tag">directory</span> <span class="attr">suffix</span>=<span class="string">".php"</span>&gt;src&lt;/<span class="tag">directory</span>&gt;
        &lt;/<span class="tag">include</span>&gt;
    &lt;/<span class="tag">coverage</span>&gt;
&lt;/<span class="tag">phpunit</span>&gt;</code></pre>
                        <div class="result">
                            <p>Explications des éléments clés :</p>
                            <ul>
                                <li><code>bootstrap</code> : Fichier d'amorçage (généralement l'autoloader de Composer)</li>
                                <li><code>testsuites</code> : Organisation des suites de tests</li>
                                <li><code>coverage</code> : Configuration pour l'analyse de couverture de code</li>
                                <li><code>colors</code> : Affichage des résultats avec couleurs dans le terminal</li>
                            </ul>
                        </div>
                    </div>
                </div>
        </section>
        <div class="navigation">
            <a href="22-deploiement-hebergement.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="24-routeur-php.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>