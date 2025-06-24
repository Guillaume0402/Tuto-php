<?php include __DIR__ . '/../includes/header.php';
$titre = "Déploiement et hébergement d'une application PHP";
$description = "Apprenez à préparer votre application PHP pour la production, choisir le bon type d'hébergement et configurer correctement votre serveur pour une sécurité et des performances optimales.";
?>


<body class="module22">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </header>
    <div class="navigation">
        <a href="21-internationalisation.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="23-composer-autoloading.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Préparer son application PHP pour la production</h2>
            <p>Le déploiement d'une application PHP en production nécessite plusieurs étapes importantes pour assurer sa stabilité, sa sécurité et ses performances.</p>

            <h3>Checklist avant déploiement</h3>
            <div class="info-box">
                <strong>Les points essentiels à vérifier</strong>
                <ol>
                    <li><strong>Sécurité</strong> : Audit du code pour détecter les vulnérabilités</li>
                    <li><strong>Optimisation</strong> : Tests de performance et d'optimisation</li>
                    <li><strong>Configuration</strong> : Adaptation des paramètres PHP et du serveur web</li>
                    <li><strong>Dépendances</strong> : Vérification et mise à jour des bibliothèques tierces</li>
                    <li><strong>Base de données</strong> : Optimisation des requêtes et indexation</li>
                    <li><strong>Environnement</strong> : Séparation des configurations de dev et prod</li>
                    <li><strong>Surveillance</strong> : Mise en place d'outils de monitoring</li>
                    <li><strong>Sauvegarde</strong> : Stratégie de backup et de récupération</li>
                </ol>
            </div>

            <h3>Configuration PHP pour la production</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Paramètres php.ini recommandés</div>
                    <div class="example-content">
                        <pre><code class="language-ini"><span class="comment"># Désactiver l'affichage des erreurs pour les utilisateurs</span>
<span class="property">display_errors</span> = <span class="constant">Off</span>
<span class="property">display_startup_errors</span> = <span class="constant">Off</span>

<span class="comment"># Mais les enregistrer dans des logs</span>
<span class="property">error_reporting</span> = <span class="constant">E_ALL</span>
<span class="property">log_errors</span> = <span class="constant">On</span>
<span class="property">error_log</span> = <span class="string">/chemin/vers/php_errors.log</span>

<span class="comment"># Limiter l'exposition d'informations</span>
<span class="property">expose_php</span> = <span class="constant">Off</span>

<span class="comment"># Optimiser l'utilisation de la mémoire</span>
<span class="property">memory_limit</span> = <span class="string">256M</span>
<span class="property">max_execution_time</span> = <span class="number">60</span>

<span class="comment"># Cache d'opcodes pour de meilleures performances</span>
<span class="property">opcache.enable</span> = <span class="number">1</span>
<span class="property">opcache.memory_consumption</span> = <span class="number">128</span>
<span class="property">opcache.interned_strings_buffer</span> = <span class="number">8</span>
<span class="property">opcache.max_accelerated_files</span> = <span class="number">10000</span>
<span class="property">opcache.validate_timestamps</span> = <span class="number">0</span>
<span class="property">opcache.save_comments</span> = <span class="number">1</span>

<span class="comment"># Sécurité des sessions</span>
<span class="property">session.cookie_httponly</span> = <span class="number">1</span>
<span class="property">session.cookie_secure</span> = <span class="number">1</span>
<span class="property">session.use_strict_mode</span> = <span class="number">1</span>
<span class="property">session.cookie_samesite</span> = <span class="string">"Lax"</span></code></pre>
                        <div class="result">
                            <p>Cette configuration désactive l'affichage d'erreurs tout en les journalisant, limite les informations exposées et active l'OPCache pour de meilleures performances.</p>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Fichier .htaccess de base</div>
                    <div class="example-content">
                        <pre><code class="language-apacheconf"><span class="comment"># Activation du moteur de réécriture</span>
<span class="keyword">RewriteEngine</span> On

<span class="comment"># Redirection HTTPS</span>
<span class="keyword">RewriteCond</span> %{HTTPS} off
<span class="keyword">RewriteRule</span> ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

<span class="comment"># Protection des fichiers sensibles</span>
<span class="tag">&lt;FilesMatch</span> <span class="string">"(^\.env|\.gitignore|composer\.json|composer\.lock)"</span><span class="tag">&gt;</span>
    <span class="keyword">Order</span> allow,deny
    <span class="keyword">Deny</span> from all
<span class="tag">&lt;/FilesMatch&gt;</span>

<span class="comment"># Masquer la signature du serveur</span>
<span class="keyword">ServerSignature</span> Off

<span class="comment"># Désactiver le listage des répertoires</span>
<span class="keyword">Options</span> -Indexes

<span class="comment"># Compresser les fichiers statiques</span>
<span class="tag">&lt;IfModule</span> mod_deflate.c<span class="tag">&gt;</span>
    <span class="keyword">AddOutputFilterByType</span> DEFLATE text/html text/plain text/css text/javascript application/javascript application/json
<span class="tag">&lt;/IfModule&gt;</span>

<span class="comment"># Mettre en cache les fichiers statiques</span>
<span class="tag">&lt;IfModule</span> mod_expires.c<span class="tag">&gt;</span>
    <span class="keyword">ExpiresActive</span> On
    <span class="keyword">ExpiresByType</span> image/jpg <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/jpeg <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/png <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/gif <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/svg+xml <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> text/css <span class="string">"access plus 1 month"</span>
    <span class="keyword">ExpiresByType</span> text/javascript <span class="string">"access plus 1 month"</span>
    <span class="keyword">ExpiresByType</span> application/javascript <span class="string">"access plus 1 month"</span>
<span class="tag">&lt;/IfModule&gt;</span></code></pre>
                        <div class="result">
                            <p>Ce fichier .htaccess configure la redirection HTTPS, protège les fichiers sensibles, désactive l'indexation des répertoires, compresse et met en cache les fichiers statiques.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Gestion des environnements avec des fichiers .env</h3>
            <div class="example">
                <div class="example-header">Utilisation de variables d'environnement</div>
                <div class="example-content">
                    <p>Les fichiers <code>.env</code> permettent de stocker des informations sensibles et des configurations spécifiques à chaque environnement hors du code source.</p>

                    <p>Exemple de fichier <code>.env</code> :</p>
                    <pre><code class="language-dotenv"><span class="comment"># Environnement</span>
<span class="property">APP_ENV</span>=<span class="string">production</span>
<span class="property">APP_DEBUG</span>=<span class="constant">false</span>
<span class="property">APP_URL</span>=<span class="string">https://monsite.com</span>

<span class="comment"># Base de données</span>
<span class="property">DB_HOST</span>=<span class="string">localhost</span>
<span class="property">DB_NAME</span>=<span class="string">app_production</span>
<span class="property">DB_USER</span>=<span class="string">user_prod</span>
<span class="property">DB_PASS</span>=<span class="string">password_securise_production</span>

<span class="comment"># Email</span>
<span class="property">MAIL_HOST</span>=<span class="string">smtp.mondomaine.com</span>
<span class="property">MAIL_PORT</span>=<span class="number">587</span>
<span class="property">MAIL_USERNAME</span>=<span class="string">noreply@mondomaine.com</span>
<span class="property">MAIL_PASSWORD</span>=<span class="string">mot_de_passe_securise</span>
<span class="property">MAIL_ENCRYPTION</span>=<span class="string">tls</span>

<span class="comment"># API Keys</span>
<span class="property">STRIPE_KEY</span>=<span class="string">pk_live_xxxxxxxxxxxxxxxxxxxxxxxx</span>
<span class="property">STRIPE_SECRET</span>=<span class="string">sk_live_xxxxxxxxxxxxxxxxxxxxxxxx</span></code></pre>

                    <p>Exemple d'utilisation avec la bibliothèque <code>vlucas/phpdotenv</code> :</p>
                    <pre><code class="language-php"><span class="comment">// Installer via : composer require vlucas/phpdotenv</span>

<span class="keyword">require_once</span> <span class="string">'vendor/autoload.php'</span>;

<span class="comment">// Charger les variables d'environnement</span>
<span class="variable">$dotenv</span> = <span class="class-name">Dotenv\Dotenv</span>::<span class="function">createImmutable</span>(<span class="function">__DIR__</span>);
<span class="variable">$dotenv</span>-><span class="function">load</span>();

<span class="comment">// Utiliser les variables d'environnement</span>
<span class="variable">$dbConnection</span> = <span class="keyword">new</span> <span class="class-name">PDO</span>(
    <span class="string">'mysql:host='</span> . <span class="variable">$_ENV</span>[<span class="string">'DB_HOST'</span>] . <span class="string">';dbname='</span> . <span class="variable">$_ENV</span>[<span class="string">'DB_NAME'</span>],
    <span class="variable">$_ENV</span>[<span class="string">'DB_USER'</span>],
    <span class="variable">$_ENV</span>[<span class="string">'DB_PASS'</span>]
);</code></pre>
                    <div class="result">
                        <p><strong>Bonnes pratiques :</strong></p>
                        <ul>
                            <li>Ne jamais commiter le fichier <code>.env</code> dans le contrôle de version (ajouter à <code>.gitignore</code>)</li>
                            <li>Fournir un exemple de fichier <code>.env.example</code> avec la structure mais sans les informations sensibles</li>
                            <li>Utiliser des valeurs différentes pour chaque environnement (développement, test, production)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <h3>Optimisation des performances</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Mise en cache</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Utilisation de APCu pour le cache en mémoire</span>
<span class="keyword">function</span> <span class="function">getCachedData</span>(<span class="variable">$key</span>, <span class="variable">$ttl</span> = <span class="number">3600</span>) {
    <span class="keyword">if</span> (<span class="function">function_exists</span>(<span class="string">'apcu_exists'</span>) && <span class="function">apcu_exists</span>(<span class="variable">$key</span>)) {
        <span class="keyword">return</span> <span class="function">apcu_fetch</span>(<span class="variable">$key</span>);
    }
    
    <span class="variable">$data</span> = <span class="function">fetchDataFromDatabase</span>(); <span class="comment">// Fonction coûteuse</span>
    
    <span class="keyword">if</span> (<span class="function">function_exists</span>(<span class="string">'apcu_store'</span>)) {
        <span class="function">apcu_store</span>(<span class="variable">$key</span>, <span class="variable">$data</span>, <span class="variable">$ttl</span>);
    }
    
    <span class="keyword">return</span> <span class="variable">$data</span>;
}</code></pre>
                        <div class="result">
                            <p>Différentes options de cache pour PHP :</p>
                            <ul>
                                <li><strong>APCu</strong> : Cache en mémoire rapide et simple</li>
                                <li><strong>Redis</strong> : Store clé-valeur en mémoire avec persistance</li>
                                <li><strong>Memcached</strong> : Système de cache distribué</li>
                                <li><strong>Cache de fichiers</strong> : Solution simple sans dépendances</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Compression et minification</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Minification de HTML à la volée</span>
<span class="keyword">function</span> <span class="function">minifyHtml</span>(<span class="variable">$html</span>) {
    <span class="comment">// Supprimer les commentaires HTML</span>
    <span class="variable">$html</span> = <span class="function">preg_replace</span>(<span class="string">'/<!--(.|\s)*?-->/'</span>, <span class="string">''</span>, <span class="variable">$html</span>);
    
    <span class="comment">// Supprimer les espaces, tabulations et retours à la ligne superflus</span>
    <span class="variable">$search</span> = [
        <span class="string">'/\>[^\S ]+/s'</span>,  <span class="comment">// Espaces après tag fermant</span>
        <span class="string">'/[^\S ]+\</s'</span>,  <span class="comment">// Espaces avant tag ouvrant</span>
        <span class="string">'/(\s)+/s'</span>,      <span class="comment">// Espaces consécutifs</span>
        <span class="string">'/>\s+</'</span>,       <span class="comment">// Espaces entre les balises</span>
    ];
    
    <span class="variable">$replace</span> = [<span class="string">'>'</span>, <span class="string">'<'</span>, <span class="string">'\\1'</span>, <span class="string">'><'</span>];
    
    <span class="keyword">return</span> <span class="function">preg_replace</span>(<span class="variable">$search</span>, <span class="variable">$replace</span>, <span class="variable">$html</span>);
}

<span class="comment">// Utilisation avec la mise en tampon de sortie</span>
<span class="function">ob_start</span>(<span class="string">'minifyHtml'</span>);</code></pre>
                        <div class="result">
                            <p>En production, pensez également à :</p>
                            <ul>
                                <li>Minifier les fichiers CSS et JavaScript</li>
                                <li>Activer la compression GZIP/Brotli sur le serveur</li>
                                <li>Optimiser les images (WebP, compression, redimensionnement)</li>
                                <li>Regrouper les fichiers CSS/JS pour réduire les requêtes HTTP</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Hébergement mutualisé vs VPS vs Cloud</h2>
            <p>Le choix d'une solution d'hébergement dépend de nombreux facteurs : budget, compétences techniques, besoins en ressources, évolutivité et spécificités de votre application.</p>

            <h3>Comparaison des solutions d'hébergement</h3>
            <div class="example">
                <div class="example-header">Types d'hébergement PHP</div>
                <div class="example-content">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Critère</th>
                                <th>Hébergement mutualisé</th>
                                <th>VPS</th>
                                <th>Serveur dédié</th>
                                <th>Cloud (PaaS/IaaS)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Coût</strong></td>
                                <td>Très économique<br>3-10€/mois</td>
                                <td>Abordable<br>10-50€/mois</td>
                                <td>Élevé<br>50-200€/mois</td>
                                <td>Variable selon l'usage<br>Pay-as-you-go</td>
                            </tr>
                            <tr>
                                <td><strong>Contrôle</strong></td>
                                <td>Très limité</td>
                                <td>Élevé (accès root)</td>
                                <td>Total</td>
                                <td>Variable selon le service</td>
                            </tr>
                            <tr>
                                <td><strong>Gestion</strong></td>
                                <td>Facile, géré par l'hôte</td>
                                <td>Nécessite des compétences</td>
                                <td>Nécessite des compétences avancées</td>
                                <td>Variable selon le service</td>
                            </tr>
                            <tr>
                                <td><strong>Performance</strong></td>
                                <td>Limitée, ressources partagées</td>
                                <td>Bonne, ressources garanties</td>
                                <td>Excellente, matériel dédié</td>
                                <td>Excellente, facilement extensible</td>
                            </tr>
                            <tr>
                                <td><strong>Évolutivité</strong></td>
                                <td>Très limitée</td>
                                <td>Moyenne</td>
                                <td>Limitée (nécessite migration)</td>
                                <td>Excellente (auto-scaling)</td>
                            </tr>
                            <tr>
                                <td><strong>Idéal pour</strong></td>
                                <td>Sites simples, blogs, petits projets</td>
                                <td>Applications web moyennes, sites d'entreprise</td>
                                <td>Gros sites à trafic élevé, applications spécifiques</td>
                                <td>Applications évolutives, startups en croissance</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="result">
                        <p><strong>Conseil</strong> : Commencez avec une solution adaptée à vos besoins immédiats, mais avec un chemin de migration clair pour évoluer à mesure que votre application se développe.</p>
                    </div>
                </div>
            </div>

            <h3>Hébergement mutualisé</h3>
            <div class="info-box">
                <strong>Avantages :</strong>
                <ul>
                    <li>Solution la moins chère</li>
                    <li>Facile à configurer et à gérer</li>
                    <li>Interface d'administration conviviale (cPanel, Plesk)</li>
                    <li>Configuration PHP pré-installée</li>
                    <li>Support technique généralement inclus</li>
                </ul>
                <strong>Inconvénients :</strong>
                <ul>
                    <li>Ressources limitées et partagées</li>
                    <li>"Mauvais voisins" peuvent affecter les performances</li>
                    <li>Peu ou pas de contrôle sur la configuration du serveur</li>
                    <li>Extensions PHP et versions souvent limitées</li>
                    <li>Problèmes pour les applications à fort trafic</li>
                </ul>
            </div>

            <h3>Serveurs VPS (Virtual Private Server)</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Avantages des VPS pour PHP</div>
                    <div class="example-content">
                        <ul>
                            <li><strong>Ressources dédiées</strong> : CPU, RAM et stockage garantis</li>
                            <li><strong>Isolation</strong> : indépendance vis-à-vis des autres clients</li>
                            <li><strong>Contrôle total</strong> : configuration sur mesure du serveur</li>
                            <li><strong>Accès root</strong> : installation de logiciels personnalisés</li>
                            <li><strong>Flexibilité</strong> : choix de distributions Linux, version PHP</li>
                            <li><strong>Scalabilité</strong> : possibilité d'augmenter les ressources</li>
                            <li><strong>Coût raisonnable</strong> : rapport qualité-prix excellent</li>
                        </ul>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Administration d'un VPS</div>
                    <div class="example-content">
                        <p>Gérer un VPS nécessite des compétences en administration système :</p>
                        <ul>
                            <li>Installation et configuration du serveur web (Apache/Nginx)</li>
                            <li>Installation et sécurisation de MySQL/MariaDB</li>
                            <li>Configuration de PHP et des extensions nécessaires</li>
                            <li>Mise en place de SSL/TLS (Let's Encrypt)</li>
                            <li>Configuration du pare-feu et sécurité</li>
                            <li>Maintenance, mises à jour, monitoring</li>
                            <li>Sauvegardes régulières</li>
                        </ul>
                        <div class="result">
                            <p>Des panneaux de contrôle comme <strong>VestaCP</strong>, <strong>HestiaCP</strong> ou <strong>CyberPanel</strong> peuvent faciliter l'administration d'un VPS pour PHP.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Solutions cloud pour PHP</h3>
            <div class="example">
                <div class="example-header">Options cloud populaires pour PHP</div>
                <div class="example-content">
                    <ul>
                        <li><strong>Platform as a Service (PaaS)</strong>
                            <ul>
                                <li>Heroku (avec buildpack PHP)</li>
                                <li>Platform.sh (spécialisé PHP)</li>
                                <li>Google App Engine</li>
                                <li>AWS Elastic Beanstalk</li>
                                <li>Laravel Forge (spécialisé Laravel)</li>
                            </ul>
                        </li>
                        <li><strong>Infrastructure as a Service (IaaS)</strong>
                            <ul>
                                <li>AWS EC2</li>
                                <li>Google Compute Engine</li>
                                <li>Microsoft Azure Virtual Machines</li>
                                <li>DigitalOcean Droplets</li>
                                <li>Linode</li>
                                <li>OVH Cloud</li>
                            </ul>
                        </li>
                        <li><strong>Containerisation</strong>
                            <ul>
                                <li>Docker avec PHP-FPM</li>
                                <li>Kubernetes pour orchestration</li>
                                <li>AWS Fargate/ECS</li>
                            </ul>
                        </li>
                    </ul>
                    <div class="result">
                        <p>Les solutions cloud offrent une grande flexibilité et évolutivité, mais nécessitent une bonne compréhension de l'architecture cloud et peuvent engendrer des coûts plus élevés pour les applications à fort trafic.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Configuration et sécurisation des serveurs pour PHP</h2>
            <p>Une configuration appropriée du serveur web est essentielle pour les performances et la sécurité de votre application PHP.</p>

            <h3>Configuration Apache pour PHP</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Virtual Host Apache pour PHP</div>
                    <div class="example-content">
                        <pre><code class="language-apacheconf"><span class="comment"># /etc/apache2/sites-available/monsite.conf</span>
<span class="tag">&lt;VirtualHost</span> *:80<span class="tag">&gt;</span>
    <span class="keyword">ServerName</span> monsite.com
    <span class="keyword">ServerAlias</span> www.monsite.com
    <span class="keyword">ServerAdmin</span> webmaster@monsite.com
    <span class="keyword">DocumentRoot</span> /var/www/monsite/public

    <span class="comment"># Redirection vers HTTPS</span>
    <span class="keyword">RewriteEngine</span> On
    <span class="keyword">RewriteCond</span> %{HTTPS} off
    <span class="keyword">RewriteRule</span> ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
<span class="tag">&lt;/VirtualHost&gt;</span>

<span class="tag">&lt;VirtualHost</span> *:443<span class="tag">&gt;</span>
    <span class="keyword">ServerName</span> monsite.com
    <span class="keyword">ServerAlias</span> www.monsite.com
    <span class="keyword">ServerAdmin</span> webmaster@monsite.com
    <span class="keyword">DocumentRoot</span> /var/www/monsite/public

    <span class="comment"># Configuration SSL</span>
    <span class="keyword">SSLEngine</span> on
    <span class="keyword">SSLCertificateFile</span> /etc/ssl/certs/monsite.crt
    <span class="keyword">SSLCertificateKeyFile</span> /etc/ssl/private/monsite.key
    <span class="keyword">SSLCertificateChainFile</span> /etc/ssl/certs/ca-chain.crt

    <span class="comment"># Paramètres de sécurité SSL</span>
    <span class="keyword">SSLProtocol</span> all -SSLv2 -SSLv3 -TLSv1 -TLSv1.1
    <span class="keyword">SSLHonorCipherOrder</span> on
    <span class="keyword">SSLCompression</span> off
    <span class="keyword">SSLSessionTickets</span> off
    <span class="keyword">SSLCipherSuite</span> EECDH+AESGCM:EDH+AESGCM

    <span class="comment"># Configuration PHP</span>
    <span class="tag">&lt;FilesMatch</span> \.php$<span class="tag">&gt;</span>
        <span class="keyword">SetHandler</span> "proxy:unix:/var/run/php/php8.1-fpm.sock|fcgi://localhost"
    <span class="tag">&lt;/FilesMatch&gt;</span>

    <span class="comment"># Paramètres du répertoire</span>
    <span class="tag">&lt;Directory</span> /var/www/monsite/public<span class="tag">&gt;</span>
        <span class="keyword">Options</span> -Indexes +FollowSymLinks
        <span class="keyword">AllowOverride</span> All
        <span class="keyword">Require</span> all granted
        
        <span class="comment"># Règles de sécurité supplémentaires</span>
        <span class="tag">&lt;IfModule</span> mod_headers.c<span class="tag">&gt;</span>
            <span class="keyword">Header</span> set X-Content-Type-Options "nosniff"
            <span class="keyword">Header</span> set X-Frame-Options "SAMEORIGIN"
            <span class="keyword">Header</span> set X-XSS-Protection "1; mode=block"
            <span class="keyword">Header</span> set Content-Security-Policy "default-src 'self'"
        <span class="tag">&lt;/IfModule&gt;</span>
    <span class="tag">&lt;/Directory&gt;</span>

    <span class="comment"># Fichiers de log</span>
    <span class="keyword">ErrorLog</span> ${APACHE_LOG_DIR}/monsite_error.log
    <span class="keyword">CustomLog</span> ${APACHE_LOG_DIR}/monsite_access.log combined
<span class="tag">&lt;/VirtualHost&gt;</span></code></pre>
                        <div class="result">
                            <p>Cette configuration crée deux VirtualHosts : un pour HTTP qui redirige vers HTTPS, et un pour HTTPS avec une configuration sécurisée. PHP est configuré pour utiliser PHP-FPM via un socket Unix pour de meilleures performances.</p>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Optimisation des performances Apache</div>
                    <div class="example-content">
                        <pre><code class="language-apacheconf"><span class="comment"># Performance tuning pour Apache</span>
<span class="comment"># /etc/apache2/mods-available/mpm_event.conf</span>

<span class="tag">&lt;IfModule</span> mpm_event_module<span class="tag">&gt;</span>
    <span class="keyword">StartServers</span>             2
    <span class="keyword">MinSpareThreads</span>         25
    <span class="keyword">MaxSpareThreads</span>         75
    <span class="keyword">ThreadLimit</span>             64
    <span class="keyword">ThreadsPerChild</span>         25
    <span class="keyword">MaxRequestWorkers</span>      150
    <span class="keyword">MaxConnectionsPerChild</span>   0
<span class="tag">&lt;/IfModule&gt;</span>

<span class="comment"># Activation des modules Apache essentiels</span>
<span class="comment"># a2enmod rewrite headers ssl http2 expires deflate</span>

<span class="comment"># Configuration de la compression</span>
<span class="tag">&lt;IfModule</span> mod_deflate.c<span class="tag">&gt;</span>
    <span class="keyword">AddOutputFilterByType</span> DEFLATE text/plain text/html text/xml text/css text/javascript application/javascript application/json application/xml
<span class="tag">&lt;/IfModule&gt;</span>

<span class="comment"># Configuration de la mise en cache</span>
<span class="tag">&lt;IfModule</span> mod_expires.c<span class="tag">&gt;</span>
    <span class="keyword">ExpiresActive</span> On
    <span class="keyword">ExpiresByType</span> image/jpg <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/jpeg <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/gif <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/png <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> image/svg+xml <span class="string">"access plus 1 year"</span>
    <span class="keyword">ExpiresByType</span> text/css <span class="string">"access plus 1 month"</span>
    <span class="keyword">ExpiresByType</span> application/javascript <span class="string">"access plus 1 month"</span>
<span class="tag">&lt;/IfModule&gt;</span></code></pre>
                        <div class="result">
                            <p>Ces configurations optimisent Apache pour de meilleures performances avec PHP :</p>
                            <ul>
                                <li>MPM Event pour une meilleure gestion des connexions</li>
                                <li>Compression des réponses pour réduire la bande passante</li>
                                <li>En-têtes d'expiration pour le cache côté client</li>
                                <li>Modules essentiels pour les fonctionnalités modernes</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Configuration Nginx pour PHP</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Configuration Nginx de base</div>
                    <div class="example-content">
                        <pre><code class="language-nginx"><span class="comment"># /etc/nginx/sites-available/monsite.conf</span>
<span class="section">server</span> {
    <span class="property">listen</span> <span class="number">80</span>;
    <span class="property">server_name</span> monsite.com www.monsite.com;
    
    <span class="comment"># Redirection vers HTTPS</span>
    <span class="section">location</span> / {
        <span class="property">return</span> <span class="number">301</span> https://$host$request_uri;
    }
}

<span class="section">server</span> {
    <span class="property">listen</span> <span class="number">443</span> ssl http2;
    <span class="property">server_name</span> monsite.com www.monsite.com;
    <span class="property">root</span> /var/www/monsite/public;
    <span class="property">index</span> index.php index.html;
    
    <span class="comment"># Configuration SSL</span>
    <span class="property">ssl_certificate</span> /etc/ssl/certs/monsite.crt;
    <span class="property">ssl_certificate_key</span> /etc/ssl/private/monsite.key;
    <span class="property">ssl_trusted_certificate</span> /etc/ssl/certs/ca-chain.crt;
    
    <span class="comment"># Paramètres de sécurité SSL optimisés</span>
    <span class="property">ssl_protocols</span> TLSv1.2 TLSv1.3;
    <span class="property">ssl_prefer_server_ciphers</span> on;
    <span class="property">ssl_ciphers</span> ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384;
    <span class="property">ssl_session_cache</span> shared:SSL:<span class="number">10</span>m;
    <span class="property">ssl_session_timeout</span> <span class="number">10</span>m;
    <span class="property">ssl_stapling</span> on;
    <span class="property">ssl_stapling_verify</span> on;
    
    <span class="comment"># En-têtes de sécurité</span>
    <span class="property">add_header</span> X-Content-Type-Options <span class="string">"nosniff"</span> always;
    <span class="property">add_header</span> X-Frame-Options <span class="string">"SAMEORIGIN"</span> always;
    <span class="property">add_header</span> X-XSS-Protection <span class="string">"1; mode=block"</span> always;
    <span class="property">add_header</span> Content-Security-Policy <span class="string">"default-src 'self'"</span> always;
    <span class="property">add_header</span> Strict-Transport-Security <span class="string">"max-age=31536000; includeSubDomains; preload"</span> always;
    
    <span class="comment"># Traitement des fichiers PHP</span>
    <span class="section">location</span> ~ \.php$ {
        <span class="property">include</span> snippets/fastcgi-php.conf;
        <span class="property">fastcgi_pass</span> unix:/var/run/php/php8.1-fpm.sock;
        <span class="property">fastcgi_param</span> SCRIPT_FILENAME $document_root$fastcgi_script_name;
        <span class="property">include</span> fastcgi_params;
    }
    
    <span class="comment"># Accès aux fichiers statiques</span>
    <span class="section">location</span> ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        <span class="property">expires</span> max;
        <span class="property">log_not_found</span> off;
        <span class="property">access_log</span> off;
    }
    
    <span class="comment"># Interdire l'accès aux fichiers cachés</span>
    <span class="section">location</span> ~ /\. {
        <span class="property">deny</span> all;
        <span class="property">access_log</span> off;
        <span class="property">log_not_found</span> off;
    }
    
    <span class="comment"># Redirection pour les frameworks MVC (comme Laravel)</span>
    <span class="section">location</span> / {
        <span class="property">try_files</span> $uri $uri/ /index.php?$query_string;
    }
}</code></pre>
                        <div class="result">
                            <p>Nginx est souvent préféré pour PHP car il gère mieux les connexions concurrentes et consomme moins de ressources qu'Apache. Cette configuration inclut :</p>
                            <ul>
                                <li>Support HTTPS avec paramètres optimisés</li>
                                <li>En-têtes de sécurité importants</li>
                                <li>Configuration PHP-FPM</li>
                                <li>Gestion efficace des fichiers statiques</li>
                                <li>Support pour les frameworks MVC</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Optimisation de Nginx</div>
                    <div class="example-content">
                        <pre><code class="language-nginx"><span class="comment"># /etc/nginx/nginx.conf - Configuration principale</span>
<span class="property">user</span> www-data;
<span class="property">worker_processes</span> auto;
<span class="property">pid</span> /run/nginx.pid;
<span class="property">include</span> /etc/nginx/modules-enabled/*.conf;

<span class="section">events</span> {
    <span class="property">worker_connections</span> <span class="number">1024</span>;
    <span class="property">multi_accept</span> on;
    <span class="property">use</span> epoll;
}

<span class="section">http</span> {
    <span class="comment"># Paramètres de base</span>
    <span class="property">sendfile</span> on;
    <span class="property">tcp_nopush</span> on;
    <span class="property">tcp_nodelay</span> on;
    <span class="property">keepalive_timeout</span> <span class="number">65</span>;
    <span class="property">types_hash_max_size</span> <span class="number">2048</span>;
    <span class="property">server_tokens</span> off;
    
    <span class="comment"># Taille des buffers</span>
    <span class="property">client_max_body_size</span> 20M;
    <span class="property">client_body_buffer_size</span> 128k;
    <span class="property">client_header_buffer_size</span> 1k;
    <span class="property">large_client_header_buffers</span> <span class="number">4</span> 4k;
    <span class="property">output_buffers</span> <span class="number">1</span> 32k;
    <span class="property">postpone_output</span> <span class="number">1460</span>;
    
    <span class="comment"># Cache des fichiers</span>
    <span class="property">open_file_cache</span> max=<span class="number">1000</span> inactive=20s;
    <span class="property">open_file_cache_valid</span> 30s;
    <span class="property">open_file_cache_min_uses</span> <span class="number">2</span>;
    <span class="property">open_file_cache_errors</span> on;
    
    <span class="comment"># Compression gzip</span>
    <span class="property">gzip</span> on;
    <span class="property">gzip_vary</span> on;
    <span class="property">gzip_proxied</span> any;
    <span class="property">gzip_comp_level</span> <span class="number">6</span>;
    <span class="property">gzip_buffers</span> <span class="number">16</span> 8k;
    <span class="property">gzip_http_version</span> <span class="number">1.1</span>;
    <span class="property">gzip_min_length</span> <span class="number">256</span>;
    <span class="property">gzip_types</span>
        text/plain
        text/css
        text/xml
        text/javascript
        application/javascript
        application/json
        application/xml
        application/xml+rss
        application/x-javascript
        application/xhtml+xml
        application/rss+xml
        font/opentype
        image/svg+xml;
    
    <span class="comment"># Inclure les autres fichiers de configuration</span>
    <span class="property">include</span> /etc/nginx/mime.types;
    <span class="property">include</span> /etc/nginx/conf.d/*.conf;
    <span class="property">include</span> /etc/nginx/sites-enabled/*;
}</code></pre>
                        <div class="result">
                            <p>Cette configuration principale de Nginx optimise les performances :</p>
                            <ul>
                                <li>Nombre de workers automatique basé sur les CPU</li>
                                <li>Configuration optimisée des connexions</li>
                                <li>Mise en cache des fichiers ouverts</li>
                                <li>Configuration avancée de la compression</li>
                                <li>Paramètres de buffer optimisés</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Sécurisation des serveurs PHP</h3>
            <div class="info-box warning-box">
                <strong>Meilleures pratiques de sécurité</strong>
                <ol>
                    <li><strong>Utilisez PHP-FPM avec un utilisateur dédié</strong> : Isolation des processus PHP</li>
                    <li><strong>Limitez les permissions de fichiers</strong> : 644 pour fichiers, 755 pour dossiers</li>
                    <li><strong>Désactivez les fonctions dangereuses</strong> : via <code>disable_functions</code> dans php.ini</li>
                    <li><strong>Implémentez un pare-feu</strong> : UFW ou iptables pour filtrer le trafic</li>
                    <li><strong>Utilisez fail2ban</strong> : Protection contre les attaques par force brute</li>
                    <li><strong>Configuration automatique de Let's Encrypt</strong> : via Certbot</li>
                    <li><strong>Surveillez les journaux</strong> : Installation et configuration de logwatch ou logcheck</li>
                    <li><strong>Mises à jour automatiques</strong> : Au minimum pour les correctifs de sécurité</li>
                    <li><strong>Utilisez ModSecurity</strong> : WAF pour Apache/Nginx</li>
                    <li><strong>Sauvegardez régulièrement</strong> : Implémentez une stratégie de sauvegarde 3-2-1</li>
                    <li><strong>Audit de sécurité</strong> : Scans réguliers avec des outils comme Lynis</li>
                </ol>
                <p>Exemple de configuration <code>disable_functions</code> dans php.ini :</p>
                <pre><code class="language-ini"><span class="property">disable_functions</span> = <span class="string">exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source,eval</span></code></pre>
            </div>

            <h3>Monitoring et maintenance</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Outils de surveillance</div>
                    <div class="example-content">
                        <ul>
                            <li><strong>New Relic</strong> : Surveillance d'applications PHP professionnelle</li>
                            <li><strong>Datadog</strong> : Monitoring complet avec tableaux de bord personnalisables</li>
                            <li><strong>Monit</strong> : Outil léger pour surveiller les services</li>
                            <li><strong>Munin/Nagios</strong> : Solutions open source éprouvées</li>
                            <li><strong>Prometheus + Grafana</strong> : Monitoring puissant et visualisation</li>
                        </ul>
                        <p>Exemple d'installation et configuration basique de Monit pour PHP-FPM :</p>
                        <pre><code class="language-bash"><span class="comment"># Installation</span>
<span class="function">apt-get</span> install monit

<span class="comment"># Configuration pour PHP-FPM</span>
<span class="function">cat</span> > /etc/monit/conf.d/php-fpm << EOF
<span class="keyword">check process</span> php-fpm <span class="keyword">with pidfile</span> /var/run/php/php8.1-fpm.pid
    <span class="keyword">start program</span> = <span class="string">"/etc/init.d/php8.1-fpm start"</span>
    <span class="keyword">stop program</span> = <span class="string">"/etc/init.d/php8.1-fpm stop"</span>
    <span class="keyword">if failed unixsocket</span> /var/run/php/php8.1-fpm.sock <span class="keyword">then restart</span>
    <span class="keyword">if</span> 5 restarts <span class="keyword">within</span> 5 cycles <span class="keyword">then timeout</span>
EOF

<span class="comment"># Redémarrage de Monit</span>
<span class="function">systemctl</span> restart monit</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Stratégie de sauvegarde</div>
                    <div class="example-content">
                        <p><strong>La règle 3-2-1 pour les sauvegardes</strong> :</p>
                        <ul>
                            <li><strong>3</strong> copies des données au total</li>
                            <li><strong>2</strong> copies sur des supports différents</li>
                            <li><strong>1</strong> copie hors site (cloud ou autre emplacement physique)</li>
                        </ul>
                        <p>Script simple de sauvegarde pour une application PHP :</p>
                        <pre><code class="language-bash"><span class="comment">#!/bin/bash</span>
<span class="comment"># Sauvegarde d'une application PHP et de sa base de données</span>

<span class="comment"># Variables</span>
<span class="variable">TIMESTAMP</span>=<span class="function">$(</span><span class="function">date</span> +<span class="string">"%Y%m%d-%H%M%S"</span><span class="function">)</span>
<span class="variable">BACKUP_DIR</span>=<span class="string">"/var/backups/monsite"</span>
<span class="variable">APP_DIR</span>=<span class="string">"/var/www/monsite"</span>
<span class="variable">DB_NAME</span>=<span class="string">"monsite_db"</span>
<span class="variable">DB_USER</span>=<span class="string">"db_user"</span>
<span class="variable">DB_PASS</span>=<span class="string">"db_password"</span>
<span class="variable">S3_BUCKET</span>=<span class="string">"monsite-backups"</span>

<span class="comment"># Créer le répertoire de sauvegarde s'il n'existe pas</span>
<span class="function">mkdir</span> -p <span class="variable">$BACKUP_DIR</span>

<span class="comment"># Sauvegarde de la base de données</span>
<span class="function">mysqldump</span> -u <span class="variable">$DB_USER</span> -p<span class="string">"</span><span class="variable">$DB_PASS</span><span class="string">"</span> <span class="variable">$DB_NAME</span> | <span class="function">gzip</span> > <span class="string">"</span><span class="variable">$BACKUP_DIR</span><span class="string">/</span><span class="variable">$DB_NAME</span><span class="string">-</span><span class="variable">$TIMESTAMP</span><span class="string">.sql.gz"</span>

<span class="comment"># Sauvegarde des fichiers de l'application</span>
<span class="function">tar</span> -czf <span class="string">"</span><span class="variable">$BACKUP_DIR</span><span class="string">/app-</span><span class="variable">$TIMESTAMP</span><span class="string">.tar.gz"</span> -C <span class="string">"</span><span class="function">$(</span><span class="function">dirname</span> <span class="string">"</span><span class="variable">$APP_DIR</span><span class="string">"</span><span class="function">)</span><span class="string">"</span> <span class="string">"</span><span class="function">$(</span><span class="function">basename</span> <span class="string">"</span><span class="variable">$APP_DIR</span><span class="string">"</span><span class="function">)</span><span class="string">"</span>

<span class="comment"># Sauvegarde vers S3 (nécessite l'installation d'awscli)</span>
<span class="function">aws</span> s3 sync <span class="variable">$BACKUP_DIR</span> s3://<span class="variable">$S3_BUCKET</span>/

<span class="comment"># Supprimer les sauvegardes locales de plus de 7 jours</span>
<span class="function">find</span> <span class="variable">$BACKUP_DIR</span> -type f -name <span class="string">"*.gz"</span> -mtime +7 -delete

<span class="function">echo</span> <span class="string">"Sauvegarde complétée à $(date)"</span></code></pre>
                        <div class="result">
                            <p>Pour automatiser, ajoutez ce script dans <code>crontab</code> :</p>
                            <pre><code class="language-crontab"><span class="number">0 1 * * *</span> <span class="string">/chemin/vers/script_sauvegarde.sh</span> > <span class="string">/var/log/backup.log</span> <span class="number">2>&1</span></code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="navigation">
            <a href="21-internationalisation.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="23-composer-autoloading.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>