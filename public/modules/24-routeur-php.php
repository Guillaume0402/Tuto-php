<?php
$moduleClass = 'module24';
include __DIR__ . '/../includes/header.php';
$titre = "Routeur PHP";
$description = "Créez un système de routage efficace pour vos applications web PHP";
?>


<body class="module24">
    <div class="module-header">
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </div>
    <div class="navigation">
        <a href="<?= BASE_URL ?>/modules/23-composer-autoloading.php" class="nav-button">← Module précédent</a>
        <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
        <a class="nav-button" style="visibility: hidden;">Module suivant →</a>
    </div>

    <main>
        <section class="section">
            <h2>Introduction aux routeurs PHP</h2>
            <p>
                Un routeur est un composant essentiel dans le développement d'applications web modernes. Il permet de diriger les requêtes HTTP
                vers les contrôleurs et actions appropriés en fonction de l'URL demandée. Un routeur bien conçu facilite la mise en place d'une architecture MVC
                propre et l'organisation de votre code.
            </p>

            <p>
                Traditionnellement, en PHP, les URL utilisaient des paramètres GET explicites (comme <code>page.php?id=5&action=edit</code>).
                Avec un routeur, vous pouvez transformer ces URL en formats plus propres et intuitifs comme <code>/articles/5/edit</code>.
                Le routeur interprète cette URL et détermine quelle partie de votre application doit traiter cette requête.
            </p>

            <p>
                Un système de routage vous permet également de centraliser la gestion des requêtes HTTP à travers un point d'entrée unique
                (généralement <code>index.php</code>), ce qui améliore considérablement la sécurité et la maintenabilité de votre application.
            </p>

            <div class="info-box">
                <h3>Pourquoi utiliser un routeur ?</h3>
                <ul>
                    <li><strong>URLs propres et SEO-friendly</strong> : Les moteurs de recherche préfèrent les URL sans paramètres visibles</li>
                    <li><strong>Séparation des responsabilités</strong> : Division claire entre le routage, les contrôleurs et la logique métier</li>
                    <li><strong>Structure évolutive</strong> : Facilite l'ajout de nouvelles fonctionnalités sans modifier le code existant</li>
                    <li><strong>APIs RESTful</strong> : Simplification de la création d'APIs suivant les conventions REST</li>
                    <li><strong>Sécurité renforcée</strong> : Contrôle précis des points d'entrée et filtrage des requêtes</li>
                    <li><strong>Middlewares</strong> : Possibilité d'intercaler des traitements avant ou après l'exécution des routes</li>
                    <li><strong>Tests simplifiés</strong> : Architecture plus facile à tester de manière unitaire et fonctionnelle</li>
                </ul>
            </div>

            <p>
                La plupart des frameworks PHP modernes (Laravel, Symfony, Slim, etc.) intègrent des systèmes de routage sophistiqués.
                Dans ce module, nous allons comprendre le fonctionnement interne d'un routeur en créant notre propre implémentation simple mais complète.
            </p>
        </section>
        <section class="section">
            <h2>Structure de base d'un routeur</h2>

            <p>
                La mise en place d'un routeur PHP repose sur quelques principes fondamentaux :
            </p>

            <ol>
                <li><strong>Point d'entrée unique</strong> : Toutes les requêtes sont dirigées vers un seul fichier (généralement <code>index.php</code>)</li>
                <li><strong>Configuration serveur</strong> : Le serveur web (Apache, Nginx) est configuré pour rediriger toutes les requêtes vers ce point d'entrée</li>
                <li><strong>Analyse de l'URL</strong> : Le routeur extrait et analyse l'URL demandée</li>
                <li><strong>Matching de routes</strong> : Le routeur compare l'URL aux routes définies pour trouver une correspondance</li>
                <li><strong>Exécution</strong> : Si une correspondance est trouvée, le contrôleur et l'action associés sont exécutés</li>
            </ol>

            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Structure de fichiers</div>
                    <div class="example-description">
                        <p>Ce code illustre le point d'entrée unique de l'application, généralement placé dans le dossier <code>public/</code>. Ce fichier est responsable de l'initialisation du routeur, du chargement des routes définies dans un fichier séparé et du dispatching des requêtes vers les contrôleurs appropriés.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// /public/index.php</span>

<span class="comment">// Chargement de l'autoloader</span>
<span class="keyword">require_once</span> <span class="string">'../vendor/autoload.php'</span>;

<span class="comment">// Initialisation du routeur</span>
<span class="variable">$router</span> = <span class="keyword">new</span> \App\Router\Router();

<span class="comment">// Chargement des routes</span>
<span class="keyword">require_once</span> <span class="string">'../config/routes.php'</span>;

<span class="comment">// Exécution du routeur avec la requête actuelle</span>
<span class="variable">$router</span>->dispatch();</code></pre>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <h3>Configuration du serveur web</h3>
                <p>Pour que le routeur fonctionne correctement, vous devez configurer votre serveur web pour rediriger toutes les requêtes vers le point d'entrée :</p>

                <p><strong>Apache (.htaccess) :</strong></p>
                <pre><code class="language-apache"><span class="keyword">RewriteEngine</span> On
<span class="keyword">RewriteCond</span> %{REQUEST_FILENAME} !-f
<span class="keyword">RewriteCond</span> %{REQUEST_FILENAME} !-d
<span class="keyword">RewriteRule</span> ^(.*)$ index.php [QSA,L]</code></pre>

                <p><strong>Nginx :</strong></p>
                <pre><code class="language-nginx"><span class="keyword">location</span> / {
    <span class="keyword">try_files</span> <span class="variable">$uri</span> <span class="variable">$uri</span>/ /index.php?<span class="variable">$query_string</span>;
}</code></pre>

                <p>Cette configuration indique au serveur de rediriger toutes les requêtes vers <code>index.php</code>, sauf si la requête correspond à un fichier ou dossier existant.</p>
            </div>
        </section>
        <section class="section">
            <h2>Base d'un routeur simple</h2>

            <p>
                Commençons par implémenter un routeur simple qui nous permettra de comprendre les mécanismes fondamentaux du routage en PHP.
                Ce routeur de base prendra en charge :
            </p>

            <ul>
                <li>La définition de routes avec différentes méthodes HTTP (GET, POST)</li>
                <li>La correspondance des URL aux routes définies</li>
                <li>L'exécution de callbacks ou de méthodes de contrôleurs associés aux routes</li>
            </ul>

            <p>
                La classe <code>Router</code> est le cœur du système. Elle stocke toutes les routes définies dans un tableau associatif
                et fournit les méthodes nécessaires pour ajouter et dispatcher des routes.
            </p>

            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Classe Router</div>
                    <div class="example-description">
                        <p>Voici l'implémentation centrale du routeur. Cette classe gère l'enregistrement des routes pour différentes méthodes HTTP (GET, POST), le stockage des callbacks associés, et le dispatching des requêtes vers les contrôleurs appropriés. Notez la structure de données en deux dimensions qui organise les routes par méthode HTTP puis par chemin.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// /src/Router/Router.php</span>

<span class="keyword">namespace</span> App\Router;

<span class="keyword">class</span> <span class="tag">Router</span>
{
    <span class="keyword">protected</span> <span class="keyword">array</span> <span class="variable">$routes</span> = [];
    
    <span class="comment">/**
     * Ajoute une route GET
     * @param string $path - Le chemin de la route (ex: "articles", "articles/:id")
     * @param mixed $callback - La fonction/méthode à exécuter quand cette route est atteinte
     */</span>
    <span class="keyword">public function</span> <span class="function">get</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>->addRoute(<span class="string">'GET'</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    
    <span class="comment">/**
     * Ajoute une route POST
     * @param string $path - Le chemin de la route
     * @param mixed $callback - Peut être une closure ou un tableau [ControllerClass, 'method']
     */</span>
    <span class="keyword">public function</span> <span class="function">post</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>->addRoute(<span class="string">'POST'</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    <span class="comment">/**
     * Ajoute une route avec une méthode HTTP spécifique
     * 
     * Cette méthode interne est utilisée par get(), post(), etc. pour enregistrer les routes
     * dans la structure de données du routeur, organisée par méthode HTTP et chemin
     * 
     * @param string $method - Méthode HTTP (GET, POST, PUT, DELETE...)
     * @param string $path - Chemin de la route
     * @param mixed $callback - Fonction ou méthode à exécuter
     */</span>
    <span class="keyword">protected function</span> <span class="function">addRoute</span>(<span class="keyword">string</span> <span class="variable">$method</span>, <span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {        <span class="comment">// Normalisation du chemin (suppression des slashes au début/fin)</span>
        <span class="variable">$path</span> = <span class="function">trim</span>(<span class="variable">$path</span>, <span class="string">'/'</span>);
        
        <span class="comment">// Stockage de la route dans un tableau associatif à deux dimensions</span>
        <span class="comment">// Structure: $routes[MÉTHODE][CHEMIN] = CALLBACK</span>
        <span class="variable">$this</span>-><span class="property">routes</span>[<span class="variable">$method</span>][<span class="variable">$path</span>] = <span class="variable">$callback</span>;
    }
      <span class="comment">/**
     * Dispatch la requête vers la bonne route
     * 
     * Cette méthode est le cœur du routeur. Elle analyse l'URL courante,
     * trouve la route correspondante et exécute le callback associé.
     */</span>
    <span class="keyword">public function</span> <span class="function">dispatch</span>(): <span class="keyword">void</span>
    {
        <span class="comment">// 1. Récupération de la méthode HTTP (GET, POST, etc.)</span>
        <span class="variable">$method</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>];        
        <span class="comment">
        // 2. Récupération et nettoyage de l'URI demandée        
        // - Récupère l'URI depuis $_SERVER['REQUEST_URI'] </span>
        <span class="comment">// - Supprime les paramètres GET (tout ce qui suit '?')</span>
        <span class="comment">// - Supprime les slashes au début et à la fin</span>
        <span class="variable">$uri</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>] ?? <span class="string">'/'</span>;
        <span class="variable">$uri</span> = <span class="function">explode</span>(<span class="string">'?'</span>, <span class="variable">$uri</span>)[0];
        <span class="variable">$uri</span> = <span class="function">trim</span>(<span class="variable">$uri</span>, <span class="string">'/'</span>);
        
        <span class="comment">// 3. Recherche de la route correspondante dans le tableau des routes</span>
        <span class="comment">// Vérifie si une route correspond exactement à la méthode HTTP et au chemin demandé</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$this</span>-><span class="variable">routes</span>[<span class="variable">$method</span>][<span class="variable">$uri</span>])) {
            <span class="variable">$callback</span> = <span class="variable">$this</span>-><span class="variable">routes</span>[<span class="variable">$method</span>][<span class="variable">$uri</span>];
              <span class="comment">// 4. Exécution du callback associé à la route</span>
            <span class="keyword">if</span> (<span class="function">is_callable</span>(<span class="variable">$callback</span>)) {
                <span class="comment">// Si c'est une fonction anonyme ou une callable directe</span>
                <span class="keyword">echo</span> <span class="function">call_user_func</span>(<span class="variable">$callback</span>);
            } <span class="keyword">else if</span> (<span class="function">is_array</span>(<span class="variable">$callback</span>) && <span class="function">count</span>(<span class="variable">$callback</span>) === 2) {
                <span class="comment">// Si c'est un tableau au format [ControllerClass, 'method']</span>
                <span class="keyword">list</span>(<span class="variable">$controller</span>, <span class="variable">$action</span>) = <span class="variable">$callback</span>;
                
                <span class="comment">// Si le contrôleur est spécifié sous forme de nom de classe, l'instancie</span>
                <span class="keyword">if</span> (<span class="function">is_string</span>(<span class="variable">$controller</span>)) {
                    <span class="variable">$controller</span> = <span class="keyword">new</span> <span class="variable">$controller</span>();
                }
                
                <span class="comment">// Exécute la méthode du contrôleur</span>
                <span class="keyword">echo</span> <span class="variable">$controller</span>-><span class="variable">$action</span>();
            }
            
            <span class="keyword">return</span>;
        }
          <span class="comment">// 5. Si aucune route ne correspond, renvoie une erreur 404</span>
        <span class="function">http_response_code</span>(404);
        <span class="keyword">echo</span> <span class="string">'404 - Page non trouvée'</span>;
    }
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Définition des routes</div>
                    <div class="example-description">
                        <p>Cet exemple montre comment définir différentes routes dans un fichier de configuration centralisé. Chaque route est associée à un contrôleur et à une méthode spécifique qui sera exécutée lorsque l'URL correspondante est demandée. Notez les différentes méthodes HTTP (<code>get</code>, <code>post</code>) qui permettent de distinguer les actions selon le type de requête. Les routes peuvent également être gérées par des fonctions anonymes pour des cas simples comme les API.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// /config/routes.php</span>

<span class="comment">// Routes de l'application</span>
<span class="variable">$router</span>->get(<span class="string">''</span>, [App\Controllers\HomeController::<span class="keyword">class</span>, <span class="string">'index'</span>]);
<span class="variable">$router</span>->get(<span class="string">'about'</span>, [App\Controllers\HomeController::<span class="keyword">class</span>, <span class="string">'about'</span>]);
<span class="variable">$router</span>->get(<span class="string">'contact'</span>, [App\Controllers\HomeController::<span class="keyword">class</span>, <span class="string">'contact'</span>]);
<span class="variable">$router</span>->post(<span class="string">'contact'</span>, [App\Controllers\HomeController::<span class="keyword">class</span>, <span class="string">'submitContact'</span>]);

<span class="comment">// Route avec fonction anonyme</span>
<span class="variable">$router</span>->get(<span class="string">'api/status'</span>, <span class="keyword">function</span>() {
    <span class="function">header</span>(<span class="string">'Content-Type: application/json'</span>);
    <span class="keyword">return</span> <span class="function">json_encode</span>([<span class="string">'status'</span> => <span class="string">'ok'</span>, <span class="string">'version'</span> => <span class="string">'1.0.0'</span>]);
});</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Paramètres dynamiques dans les routes</h2>

            <p>
                Un routeur vraiment utile doit pouvoir gérer des <strong>paramètres dynamiques</strong> dans les URLs. Par exemple, pour une page
                d'article ayant l'URL <code>/articles/123</code>, nous devons pouvoir extraire l'ID "123" et le transmettre au contrôleur.
            </p>

            <p>
                Les paramètres dynamiques sont généralement définis avec un préfixe spécial (comme <code>:</code> ou <code>{}</code>) dans la
                définition de la route. Par exemple, <code>/articles/:id</code> où <code>:id</code> est un paramètre qui peut prendre n'importe quelle valeur.
            </p>

            <p>
                Pour implémenter cette fonctionnalité, notre routeur doit :
            </p>

            <ol>
                <li>Détecter les routes contenant des paramètres dynamiques (commençant par <code>:</code>)</li>
                <li>Convertir ces routes en expressions régulières pour permettre la correspondance</li>
                <li>Extraire les valeurs des paramètres dynamiques de l'URL demandée</li>
                <li>Passer ces valeurs en arguments au callback de la route</li>
            </ol>

            <p>
                Cette approche permet de créer des URLs expressives et bien structurées, tout en maintenant un code propre et modulaire.
            </p>

            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Routes avec paramètres</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Exemple d'utilisation avec des paramètres</span>

<span class="comment">// Route avec un paramètre ID</span>
<span class="variable">$router</span>->get(<span class="string">'users/:id'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'show'</span>]);

<span class="comment">// Route avec plusieurs paramètres</span>
<span class="variable">$router</span>->get(<span class="string">'blog/:year/:month/:slug'</span>, [BlogController::<span class="keyword">class</span>, <span class="string">'show'</span>]);</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header route-header">Gestion des paramètres dynamiques</div>
                    <div class="example-description">
                        <p>Cette partie du code montre comment améliorer notre routeur pour qu'il prenne en charge les paramètres dynamiques dans les URL. L'implémentation utilise des expressions régulières pour transformer les segments d'URL avec <code>:paramètre</code> en motifs de correspondance capables d'extraire les valeurs. Les trois fonctions clés sont <code>convertRouteToRegex</code>, <code>extractParams</code> et <code>executeRoute</code>, qui travaillent ensemble pour faire correspondre l'URL demandée à une définition de route et exécuter le code approprié avec les paramètres extraits.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Amélioration du Router pour gérer les paramètres</span>

<span class="keyword">class</span> <span class="tag">Router</span>
{
    <span class="comment">// ... Code précédent ...</span>
    
    <span class="comment">/**
     * Dispatch la requête avec support des paramètres dynamiques
     */</span>
    <span class="keyword">public function</span> <span class="function">dispatch</span>(): <span class="keyword">void</span>
    {
        <span class="variable">$method</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>];
        <span class="variable">$uri</span> = <span class="function">trim</span>(<span class="function">explode</span>(<span class="string">'?'</span>, <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>])[0], <span class="string">'/'</span>);
        
        <span class="comment">// D'abord, essayez de trouver une correspondance exacte</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$this</span>->routes[<span class="variable">$method</span>][<span class="variable">$uri</span>])) {
            <span class="variable">$this</span>->executeRoute(<span class="variable">$this</span>->routes[<span class="variable">$method</span>][<span class="variable">$uri</span>]);
            <span class="keyword">return</span>;
        }
        
        <span class="comment">// Si pas de correspondance exacte, cherchez des routes avec paramètres</span>
        <span class="keyword">foreach</span> (<span class="variable">$this</span>->routes[<span class="variable">$method"] <span class="keyword">as</span> <span class="variable">$route</span> => <span class="variable">$callback</span>) {
        <span class="keyword">foreach</span> (<span class="variable">$this</span>->routes[<span class="variable">$method</span>] <span class="keyword">as</span> <span class="variable">$route</span> => <span class="variable">$callback</span>) {
            <span class="comment">// Vérifiez si la route contient des paramètres dynamiques</span>
            <span class="keyword">if</span> (<span class="function">strpos</span>(<span class="variable">$route</span>, <span class="string">':'</span>) !== <span class="keyword">false</span>) {
                <span class="variable">$routeRegex</span> = <span class="variable">$this</span>->convertRouteToRegex(<span class="variable">$route</span>);
                
                <span class="keyword">if</span> (<span class="function">preg_match</span>(<span class="variable">$routeRegex</span>, <span class="variable">$uri</span>, <span class="variable">$matches</span>)) {
                    <span class="comment">// Extraire les valeurs des paramètres</span>
                    <span class="variable">$params</span> = <span class="variable">$this</span>->extractParams(<span class="variable">$route</span>, <span class="variable">$uri</span>);
                    
                    <span class="comment">// Exécuter la route avec les paramètres</span>
                    <span class="variable">$this</span>->executeRoute(<span class="variable">$callback</span>, <span class="variable">$params</span>);
                    <span class="keyword">return</span>;
                }
            }
        }
        
        <span class="comment">// Route non trouvée</span>
        <span class="function">http_response_code</span>(404);
        <span class="keyword">echo</span> <span class="string">'404 - Page non trouvée'</span>;
    }
    <span class="comment">
    /*     
    Convertit une route avec paramètres en expression régulière
    */</span>
    <span class="keyword">protected function</span> <span class="function">convertRouteToRegex</span>(<span class="keyword">string</span> <span class="variable">$route</span>): <span class="keyword">string</span>
    {
        <span class="comment">// Remplace :param par un groupe de capture regex</span>
        <span class="variable">$routeRegex</span> = <span class="function">preg_replace</span>(<span class="string">'/:[a-zA-Z0-9]+/'</span>, <span class="string">'([^/]+)'</span>, <span class="variable">$route</span>);
        
        <span class="comment">// Ajoute les délimiteurs et ancres</span>
        <span class="keyword">return</span> <span class="string">'@^'</span> . <span class="variable">$routeRegex</span> . <span class="string">'$@D'</span>;
    }
    <span class="comment">
    /*
    Extrait les valeurs des paramètres de l'URI
    */</span>
    <span class="keyword">protected function</span> <span class="function">extractParams</span>(<span class="keyword">string</span> <span class="variable">$route</span>, <span class="keyword">string</span> <span class="variable">$uri</span>): <span class="keyword">array</span>
    {
        <span class="variable">$params</span> = [];
        <span class="variable">$routeParts</span> = <span class="function">explode</span>(<span class="string">'/'</span>, <span class="variable">$route</span>);
        <span class="variable">$uriParts</span> = <span class="function">explode</span>(<span class="string">'/'</span>, <span class="variable">$uri</span>);
        
        <span class="keyword">foreach</span> (<span class="variable">$routeParts</span> <span class="keyword">as</span> <span class="variable">$index</span> => <span class="variable">$part</span>) {
            <span class="keyword">if</span> (<span class="function">strpos</span>(<span class="variable">$part</span>, <span class="string">':'</span>) === 0) {
                <span class="comment">// Extraction du nom du paramètre (retire le ':')</span>
                <span class="variable">$paramName</span> = <span class="function">substr</span>(<span class="variable">$part</span>, 1);
                
                <span class="comment">// Récupération de la valeur depuis l'URI</span>
                <span class="variable">$params</span>[<span class="variable">$paramName</span>] = <span class="variable">$uriParts</span>[<span class="variable">$index</span>];
            }
        }
        
        <span class="keyword">return</span> <span class="variable">$params</span>;
    }
    <span class="comment">
    /*
    Exécute une route avec ses paramètres éventuels
    */</span>
    <span class="keyword">protected function</span> <span class="function">executeRoute</span>(<span class="variable">$callback</span>, <span class="keyword">array</span> <span class="variable">$params</span> = []): <span class="keyword">void</span>
    {
        <span class="keyword">if</span> (<span class="function">is_callable</span>(<span class="variable">$callback</span>)) {
            <span class="keyword">echo</span> <span class="function">call_user_func_array</span>(<span class="variable">$callback</span>, <span class="variable">$params</span>);
        } <span class="keyword">else if</span> (<span class="function">is_array</span>(<span class="variable">$callback</span>) && <span class="function">count</span>(<span class="variable">$callback</span>) === 2) {
            <span class="keyword">list</span>(<span class="variable">$controller</span>, <span class="variable">$action</span>) = <span class="variable">$callback</span>;
            
            <span class="keyword">if</span> (<span class="function">is_string</span>(<span class="variable">$controller</span>)) {
                <span class="variable">$controller</span> = <span class="keyword">new</span> <span class="variable">$controller</span>();
            }
            
            <span class="keyword">echo</span> <span class="function">call_user_func_array</span>([<span class="variable">$controller</span>, <span class="variable">$action</span>], <span class="variable">$params</span>);
        }
    }
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="example-description">
                <p>Ce diagramme illustre le processus d'extraction des <strong>paramètres dynamiques</strong> dans un routeur PHP. Quand une URL contient des segments variables (marqués par <code>:</code> dans la définition de la route), le routeur identifie ces segments et extrait leurs valeurs. Ces valeurs sont ensuite accessibles comme paramètres dans votre contrôleur, permettant de créer des URLs flexibles et sémantiques. Cette technique est essentielle pour construire des applications RESTful où les identifiants et autres variables font partie de l'URL elle-même.</p>
            </div>

            <div class="route-diagram">
                <div class="route-path">/blog/:year/:month/:slug</div>

                <div class="route-flow">
                    <div class="flow-item">URL demandée<br>/blog/2025/06/php-router</div>
                    <div class="flow-arrow">→</div>
                    <div class="flow-item">Extraction des paramètres</div>
                    <div class="flow-arrow">→</div>
                    <div class="flow-item">
                        Paramètres:<br>
                        year = 2025<br>
                        month = 06<br>
                        slug = php-router
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Gestion des méthodes HTTP</h2>

            <p>
                Un routeur complet doit prendre en charge toutes les méthodes HTTP standard (GET, POST, PUT, DELETE, PATCH, etc.). Chaque méthode
                a une signification particulière dans le contexte des API RESTful :
            </p>

            <ul class="http-methods-list">
                <li>GET : Récupérer des données sans les modifier (lecture) - Méthode idempotente et sûre</li>
                <li>POST : Créer une nouvelle ressource (création) - Non idempotente, peut avoir des effets de bord</li>
                <li>PUT : Remplacer entièrement une ressource existante (mise à jour complète) - Idempotente</li>
                <li>PATCH : Mettre à jour partiellement une ressource (mise à jour partielle) - Non idempotente généralement</li>
                <li>DELETE : Supprimer une ressource (suppression) - Idempotente</li>
                <li>OPTIONS : Obtenir les méthodes supportées pour une ressource - Utilisé par CORS</li>
                <li>HEAD : Récupérer les en-têtes sans le corps de réponse (comme GET mais sans le contenu)</li>
            </ul>

            <p>
                Notre routeur doit permettre de définir des routes pour chacune de ces méthodes et d'exécuter le code approprié en fonction
                de la méthode utilisée pour accéder à une URL. Il est important de comprendre que <strong>l'idempotence</strong> signifie qu'exécuter
                la même requête plusieurs fois produit le même résultat.
            </p>

            <div class="info-box">
                <h3>Comprendre l'idempotence des méthodes HTTP</h3>
                <p>L'idempotence est un concept clé en développement web :</p>
                <ul>
                    <li><strong>GET, PUT, DELETE</strong> : Idempotentes - Exécuter la même requête plusieurs fois a le même effet</li>
                    <li><strong>POST, PATCH</strong> : Non idempotentes - Chaque exécution peut avoir un effet différent</li>
                </ul>
                <p>Par exemple : Supprimer un article (DELETE) peut être exécuté plusieurs fois sans problème, mais créer un nouvel article (POST) créera un nouvel article à chaque fois.</p>
            </div>

            <p>
                Il faut également gérer le cas particulier des navigateurs qui ne supportent nativement que GET et POST. Pour permettre l'utilisation
                des autres méthodes (PUT, DELETE, etc.) dans les formulaires HTML, nous pouvons utiliser une technique appelée <strong>"method override"</strong>
                qui consiste à utiliser un champ caché <code>_method</code> ou un en-tête HTTP spécial <code>X-HTTP-Method-Override</code>.
            </p>

            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Définition de routes avec différentes méthodes</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Exemple de définition de routes pour différentes méthodes HTTP</span>

<span class="comment">// Route GET pour afficher un formulaire de création</span>
<span class="variable">$router</span>->get(<span class="string">'users/create'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'create'</span>]);

<span class="comment">// Route POST pour traiter la création (non idempotente)</span>
<span class="variable">$router</span>->post(<span class="string">'users'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'store'</span>]);

<span class="comment">// Route GET pour afficher un utilisateur spécifique</span>
<span class="variable">$router</span>->get(<span class="string">'users/:id'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'show'</span>]);

<span class="comment">// Route GET pour afficher le formulaire d'édition</span>
<span class="variable">$router</span>->get(<span class="string">'users/:id/edit'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'edit'</span>]);

<span class="comment">// Route PUT pour mettre à jour complètement une ressource (idempotente)</span>
<span class="variable">$router</span>->put(<span class="string">'users/:id'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'update'</span>]);

<span class="comment">// Route PATCH pour mise à jour partielle (généralement non idempotente)</span>
<span class="variable">$router</span>-><span class="function">patch</span>(<span class="string">'users/:id'</span>, [<span class="tag">UserController</span>::<span class="keyword">class</span>, <span class="string">'partialUpdate'</span>]);

<span class="comment">// Route DELETE pour supprimer une ressource (idempotente)</span>
<span class="variable">$router</span>-><span class="function">delete</span>(<span class="string">'users/:id'</span>, [<span class="tag">UserController</span>::<span class="keyword">class</span>, <span class="string">'destroy'</span>]);

<span class="comment">// Route OPTIONS pour CORS (Cross-Origin Resource Sharing)</span>
<span class="variable">$router</span>-><span class="function">options</span>(<span class="string">'users/:id'</span>, <span class="keyword">function</span>() {
    <span class="function">header</span>(<span class="string">'Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS'</span>);
    <span class="function">header</span>(<span class="string">'Access-Control-Allow-Headers: Content-Type, Authorization'</span>);
    <span class="keyword">return</span> <span class="string">''</span>;
});

<span class="comment">// Route qui répond à plusieurs méthodes</span>
<span class="variable">$router</span>-><span class="function">match</span>([<span class="string">'GET'</span>, <span class="string">'POST'</span>], <span class="string">'users/profile'</span>, [<span class="tag">UserController</span>::<span class="keyword">class</span>, <span class="string">'profile'</span>]);</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Implémentation complète des méthodes HTTP</div>
                    <div class="example-description">
                        <p>Cette classe Router étendue implémente toutes les méthodes HTTP standard (GET, POST, PUT, DELETE, PATCH, OPTIONS, HEAD) ainsi que des méthodes utilitaires comme <code>match()</code> et <code>any()</code>. L'implémentation inclut la fonction <code>detectMethod()</code> qui gère automatiquement le "method spoofing" pour permettre l'utilisation de méthodes comme PUT ou DELETE dans les formulaires HTML qui ne supportent nativement que GET et POST. Cette approche est fondamentale pour construire des APIs RESTful complètes.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">class</span> <span class="tag">Router</span>
{
    <span class="comment">// ...existing code...</span>
    
    <span class="comment">/**
     * Ajoute une route PUT
     * PUT est utilisé pour remplacer complètement une ressource
     * @param string $path - Le chemin de la route
     * @param mixed $callback - Le callback à exécuter
     */</span>
    <span class="keyword">public function</span> <span class="function">put</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>->addRoute(<span class="string">'PUT'</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    
    <span class="comment">/**
     * Ajoute une route DELETE
     * DELETE est idempotente - supprimer la même ressource plusieurs fois a le même effet
     * @param string $path - Le chemin de la route
     * @param mixed $callback - Le callback à exécuter
     */</span>
    <span class="keyword">public function</span> <span class="function">delete</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>->addRoute(<span class="string">'DELETE'</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    
    <span class="comment">/**
     * Ajoute une route PATCH
     * PATCH est utilisé pour des mises à jour partielles
     * @param string $path - Le chemin de la route
     * @param mixed $callback - Le callback à exécuter
     */</span>
    <span class="keyword">public function</span> <span class="function">patch</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>->addRoute(<span class="string">'PATCH'</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    
    <span class="comment">/**
     * Ajoute une route OPTIONS
     * Principalement utilisé pour les requêtes CORS preflight
     * @param string $path - Le chemin de la route
     * @param mixed $callback - Le callback à exécuter
     */</span>
    <span class="keyword">public function</span> <span class="function">options</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>->addRoute(<span class="string">'OPTIONS'</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    <span class="comment">
    /**
     * Ajoute une route HEAD
     * Similaire à GET mais retourne seulement les en-têtes
     * @param string $path - Le chemin de la route     * @param mixed $callback - Le callback à exécuter
     */</span>
    <span class="keyword">public function</span> <span class="function">head</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>-><span class="function">addRoute</span>(<span class="string">'HEAD'</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    <span class="comment">
    /**     * Ajoute une route qui répond à plusieurs méthodes HTTP
     * Utile pour des routes qui doivent traiter plusieurs types de requêtes
     * @param array $methods - Tableau des méthodes HTTP acceptées
     * @param string $path - Le chemin de la route
     * @param mixed $callback - Le callback à exécuter
     */</span>
    <span class="keyword">public function</span> <span class="function">match</span>(<span class="keyword">array</span> <span class="variable">$methods</span>, <span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="keyword">foreach</span> (<span class="variable">$methods</span> <span class="keyword">as</span> <span class="variable">$method</span>) {
            <span class="variable">$this</span>-><span class="function">addRoute</span>(<span class="function">strtoupper</span>(<span class="variable">$method</span>), <span class="variable">$path</span>, <span class="variable">$callback</span>);
        }
    }
    <span class="comment">
    /**     * Ajoute une route pour toutes les méthodes HTTP
     * Attention : À utiliser avec parcimonie car cela peut créer des comportements inattendus
     * @param string $path - Le chemin de la route
     * @param mixed $callback - Le callback à exécuter
     */</span><span class="keyword">public function</span> <span class="function">any</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="variable">$methods</span> = [<span class="string">'GET'</span>, <span class="string">'POST'</span>, <span class="string">'PUT'</span>, <span class="string">'PATCH'</span>, <span class="string">'DELETE'</span>, <span class="string">'OPTIONS'</span>, <span class="string">'HEAD'</span>];
        <span class="variable">$this</span>-><span class="function">match</span>(<span class="variable">$methods</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
    }
    <span class="comment">
    /**
     * Détecte la méthode HTTP réelle (pour supporter PUT, DELETE, etc.)
     * Cette méthode gère le "method spoofing" pour les navigateurs qui ne supportent que GET et POST
     * @return string La méthode HTTP détectée     */</span>
    <span class="keyword">protected function</span> <span class="function">detectMethod</span>(): <span class="keyword">string</span>
    {
        <span class="variable">$method</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>];
        
        <span class="comment">// Détecte si une méthode HTTP est simulée via un champ _method dans POST</span>
        <span class="comment">// Utile pour les formulaires HTML qui ne supportent que GET et POST</span>
        <span class="keyword">if</span> (<span class="variable">$method</span> === <span class="string">'POST'</span> && <span class="function">isset</span>(<span class="variable">$_POST</span>[<span class="string">'_method'</span>])) {
            <span class="variable">$overrideMethod</span> = <span class="function">strtoupper</span>(<span class="variable">$_POST</span>[<span class="string">'_method'</span>]);
            
            <span class="comment">// Valide que la méthode override est supportée</span>
            <span class="keyword">if</span> (<span class="function">in_array</span>(<span class="variable">$overrideMethod</span>, [<span class="string">'PUT'</span>, <span class="string">'PATCH'</span>, <span class="string">'DELETE'</span>])) {
                <span class="keyword">return</span> <span class="variable">$overrideMethod</span>;
            }
        }
          <span class="comment">// Détecte si une méthode HTTP est spécifiée dans l'en-tête HTTP_X_HTTP_METHOD_OVERRIDE</span>
        <span class="comment">// Standard utilisé par certaines bibliothèques JavaScript</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SERVER</span>[<span class="string">'HTTP_X_HTTP_METHOD_OVERRIDE'</span>])) {
            <span class="variable">$overrideMethod</span> = <span class="function">strtoupper</span>(<span class="variable">$_SERVER</span>[<span class="string">'HTTP_X_HTTP_METHOD_OVERRIDE'</span>]);
            
            <span class="comment">// Valide la méthode</span>
            <span class="keyword">if</span> (<span class="function">in_array</span>(<span class="variable">$overrideMethod</span>, [<span class="string">'PUT'</span>, <span class="string">'PATCH'</span>, <span class="string">'DELETE'</span>, <span class="string">'OPTIONS'</span>, <span class="string">'HEAD'</span>])) {
                <span class="keyword">return</span> <span class="variable">$overrideMethod</span>;
            }
        }
        
        <span class="keyword">return</span> <span class="variable">$method</span>;
    }
    
    <span class="comment">/**
     * Met à jour la méthode dispatch pour utiliser detectMethod()
     */</span>
    <span class="keyword">public function</span> <span class="function">dispatch</span>(): <span class="keyword">void</span>
    {
        <span class="comment">// Utilise la méthode améliorée de détection</span>
        <span class="variable">$method</span> = <span class="variable">$this</span>-><span class="function">detectMethod</span>();
        
        // ...existing code...
    }
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Exemple d'utilisation avec Method Override dans un formulaire</div>
                    <div class="example-description">
                        <p>Les navigateurs web ne supportent nativement que les méthodes HTTP GET et POST pour les formulaires HTML. Pour contourner cette limitation et utiliser d'autres méthodes comme PUT, PATCH ou DELETE, on utilise la technique du "Method Override". Cet exemple illustre comment simuler une requête DELETE en utilisant un formulaire POST standard avec un champ caché <code>_method</code> qui indique la véritable méthode à utiliser. Le routeur détectera ce champ et traitera la requête comme si elle avait été envoyée avec la méthode spécifiée.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-html"><span class="comment"><!-- Formulaire HTML utilisant method override pour DELETE --></span>
<span class="tag">&lt;form</span> <span class="variable">method</span>=<span class="string">"POST"</span> <span class="variable">action</span>=<span class="string">"/users/123"</span><span class="tag">&gt;</span>
    <span class="comment"><!-- Champ caché pour indiquer la vraie méthode HTTP --></span>
    <span class="tag">&lt;input</span> <span class="variable">type</span>=<span class="string">"hidden"</span> <span class="variable">name</span>=<span class="string">"_method"</span> <span class="variable">value</span>=<span class="string">"DELETE"</span><span class="tag">&gt;</span>
    
    <span class="tag">&lt;p&gt;</span>Êtes-vous sûr de vouloir supprimer cet utilisateur ?<span class="tag">&lt;/p&gt;</span>
    <span class="tag">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>Confirmer la suppression<span class="tag">&lt;/button&gt;</span>
<span class="tag">&lt;/form&gt;</span>

<span class="comment"><!-- Exemple avec PUT pour mise à jour --></span>
<span class="tag">&lt;form</span> <span class="variable">method</span>=<span class="string">"POST"</span> <span class="variable">action</span>=<span class="string">"/users/123"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;input</span> <span class="variable">type</span>=<span class="string">"hidden"</span> <span class="variable">name</span>=<span class="string">"_method"</span> <span class="variable">value</span>=<span class="string">"PUT"</span><span class="tag">&gt;</span>
    
    <span class="tag">&lt;label&gt;</span>Nom:
        <span class="tag">&lt;input</span> <span class="variable">type</span>=<span class="string">"text"</span> <span class="variable">name</span>=<span class="string">"name"</span> <span class="variable">value</span>=<span class="string">"Jean Dupont"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/label&gt;</span>    
    <span class="tag">&lt;label&gt;</span>Email:
        <span class="tag">&lt;input</span> <span class="variable">type</span>=<span class="string">"email"</span> <span class="variable">name</span>=<span class="string">"email"</span> <span class="variable">value</span>=<span class="string">"jean@example.com"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/label&gt;</span>
    
    <span class="tag">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>Mettre à jour<span class="tag">&lt;/button&gt;</span>
</form></code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Exemple de contrôleur RESTful complet</div>
                    <div class="example-description">
                        <p>Ce contrôleur illustre parfaitement l'approche <strong>RESTful</strong> pour la gestion des ressources avec un routeur PHP moderne. Chaque méthode correspond à une action CRUD spécifique associée à une route et à une méthode HTTP précise :</p>
                        <ul>
                            <li><code>index()</code> - Récupère et affiche une collection de ressources (GET /users)</li>
                            <li><code>create()</code> - Affiche un formulaire de création (GET /users/create)</li>
                            <li><code>store()</code> - Traite la création d'une nouvelle ressource (POST /users)</li>
                            <li><code>show()</code> - Affiche une ressource spécifique (GET /users/{id})</li>
                            <li><code>edit()</code> - Affiche un formulaire d'édition (GET /users/{id}/edit)</li>
                            <li><code>update()</code> - Traite la mise à jour complète (PUT /users/{id})</li>
                            <li><code>partialUpdate()</code> - Traite la mise à jour partielle (PATCH /users/{id})</li>
                            <li><code>destroy()</code> - Supprime une ressource (DELETE /users/{id})</li>
                        </ul>
                        <p>Notez les commentaires concernant l'<strong>idempotence</strong> (une même requête produit toujours le même résultat) et la <strong>sûreté</strong> (ne modifie pas l'état du serveur) - des concepts essentiels dans la conception d'API RESTful.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">/**
 * Contrôleur User suivant les conventions RESTful
 * Chaque méthode correspond à une action CRUD standard
 */</span>
<span class="keyword">class</span> <span class="tag">UserController</span>
{
    <span class="keyword">protected</span> <span class="variable">$userRepository</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(UserRepository <span class="variable">$userRepository</span>)
    {
        <span class="variable">$this</span>->userRepository = <span class="variable">$userRepository</span>;
    }
    
    <span class="comment">/**
     * GET /users - Affiche la liste de tous les utilisateurs
     * Idempotente et sûre
     */</span>
    <span class="keyword">public function</span> <span class="function">index</span>()
    {
        <span class="variable">$users</span> = <span class="variable">$this</span>->userRepository->findAll();
        <span class="keyword">return new</span> View(<span class="string">'users/index'</span>, [<span class="string">'users'</span> => <span class="variable">$users</span>]);
    }
    
    <span class="comment">/**
     * GET /users/create - Affiche le formulaire de création
     * Idempotente et sûre
     */</span>
    <span class="keyword">public function</span> <span class="function">create</span>()
    {
        <span class="keyword">return new</span> View(<span class="string">'users/create'</span>);
    }
    
    <span class="comment">/**
     * POST /users - Traite la création d'un nouvel utilisateur
     * Non idempotente - chaque appel crée un nouvel utilisateur
     */</span>
    <span class="keyword">public function</span> <span class="function">store</span>(<span class="variable">$request</span>)
    {
        <span class="comment">// Validation des données</span>
        <span class="variable">$validator</span> = <span class="keyword">new</span> Validator(<span class="variable">$request</span>->post());
        <span class="variable">$validator</span>->required([<span class="string">'name'</span>, <span class="string">'email'</span>])
                  ->email(<span class="string">'email'</span>)
                  ->unique(<span class="string">'email'</span>, <span class="string">'users'</span>);
        
        <span class="keyword">if</span> (!<span class="variable">$validator</span>->isValid()) {
            <span class="keyword">return new</span> RedirectResponse(<span class="string">'/users/create'</span>, [<span class="string">'errors'</span> => <span class="variable">$validator</span>->getErrors()]);
        }
        
       <span class="comment">// Création de l'utilisateur</span>
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">create</span>(<span class="variable">$validator</span>-><span class="function">getData</span>());
        
        <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">"/users/{</span><span class="variable">$user</span>-><span class="property">id</span><span class="string">}"</span>, [<span class="string">'success'</span> => <span class="string">'Utilisateur créé avec succès'</span>]);
    }
    <span class="comment">
    /**
     * GET /users/:id - Affiche un utilisateur spécifique
     * Idempotente et sûre
     */
    </span>
    <span class="keyword">public function</span> <span class="function">show</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        
        <span class="keyword">return new</span> <span class="tag">View</span>(<span class="string">'users/show'</span>, [<span class="string">'user'</span> => <span class="variable">$user</span>]);
    }    <span class="comment">
    /**
     * GET /users/:id/edit - Affiche le formulaire d'édition
     * Idempotente et sûre
     */
    </span>
    <span class="keyword">public function</span> <span class="function">edit</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        
        <span class="keyword">return new</span> <span class="tag">View</span>(<span class="string">'users/edit'</span>, [<span class="string">'user'</span> => <span class="variable">$user</span>]);
    }    <span class="comment">
    /**
     * PUT /users/:id - Met à jour complètement un utilisateur
     * Idempotente - exécuter plusieurs fois avec les mêmes données produit le même résultat
     */
    </span>
    <span class="keyword">public function</span> <span class="function">update</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        
        <span class="comment">// Validation</span>
        <span class="variable">$validator</span> = <span class="keyword">new</span> <span class="tag">Validator</span>(<span class="variable">$request</span>-><span class="function">post</span>());
        <span class="variable">$validator</span>-><span class="function">required</span>([<span class="string">'name'</span>, <span class="string">'email'</span>])
                  -><span class="function">email</span>(<span class="string">'email'</span>)
                  -><span class="function">unique</span>(<span class="string">'email'</span>, <span class="string">'users'</span>, <span class="variable">$user</span>-><span class="property">id</span>);
        
        <span class="keyword">if</span> (!<span class="variable">$validator</span>-><span class="function">isValid</span>()) {
            <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">"/users/{</span><span class="variable">$user</span>-><span class="property">id</span><span class="string">}/edit"</span>, [<span class="string">'errors'</span> => <span class="variable">$validator</span>-><span class="function">getErrors</span>()]);
        }
          <span class="comment">// Mise à jour complète de l'utilisateur</span>
        <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">update</span>(<span class="variable">$user</span>-><span class="property">id</span>, <span class="variable">$validator</span>-><span class="function">getData</span>());
        
        <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">"/users/{</span><span class="variable">$user</span>-><span class="property">id</span><span class="string">}"</span>, [<span class="string">'success'</span> => <span class="string">'Utilisateur mis à jour'</span>]);
    }
    <span class="comment">    /**
     * PATCH /users/:id - Met à jour partiellement un utilisateur
     * Généralement non idempotente (dépend de l'implémentation)
     */
    </span>
    <span class="keyword">public function</span> <span class="function">partialUpdate</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        <span class="comment">        // Validation uniquement des champs présents
        </span>
        <span class="variable">$data</span> = <span class="variable">$request</span>-><span class="function">post</span>();
        <span class="variable">$allowedFields</span> = [<span class="string">'name'</span>, <span class="string">'email'</span>, <span class="string">'phone'</span>, <span class="string">'address'</span>];
        <span class="variable">$updateData</span> = <span class="function">array_intersect_key</span>(<span class="variable">$data</span>, <span class="function">array_flip</span>(<span class="variable">$allowedFields</span>));
        
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$updateData</span>)) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Aucune donnée valide fournie'</span>, <span class="number">400</span>);
        }
        <span class="comment">        // Mise à jour partielle
        </span>
        <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">partialUpdate</span>(<span class="variable">$user</span>-><span class="property">id</span>, <span class="variable">$updateData</span>);
        
        <span class="keyword">return new</span> <span class="tag">JsonResponse</span>([<span class="string">'message'</span> => <span class="string">'Utilisateur mis à jour partiellement'</span>]);
    }
    <span class="comment">    /**
     * DELETE /users/:id - Supprime un utilisateur
     * Idempotente - supprimer plusieurs fois le même utilisateur a le même effet
     */
    </span>
    <span class="keyword">public function</span> <span class="function">destroy</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="comment">// Pour DELETE, on peut considérer que supprimer un élément inexistant est "réussi"</span>
            <span class="comment">// car l'objectif (l'élément n'existe plus) est atteint</span>
            <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">'/users'</span>, [<span class="string">'info'</span> => <span class="string">'Utilisateur déjà supprimé'</span>]);
        }
        <span class="comment">        // Vérification des contraintes (ex: ne pas supprimer un admin)
        </span>
        <span class="keyword">if</span> (<span class="variable">$user</span>-><span class="property">role</span> === <span class="string">'admin'</span> && <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">countAdmins</span>() <= <span class="number">1</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Impossible de supprimer le dernier administrateur'</span>, <span class="number">403</span>);
        }
        
        <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">delete</span>(<span class="variable">$user</span>-><span class="property">id</span>);
        
        <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">'/users'</span>, [<span class="string">'success'</span> => <span class="string">'Utilisateur supprimé'</span>]);
    }
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <h3>Support des méthodes HTTP dans les navigateurs</h3>
                <p>Bien que les navigateurs ne prennent en charge nativement que GET et POST, il existe plusieurs approches courantes pour gérer PUT, PATCH et DELETE :</p>
                <ol>
                    <li><strong>Headers HTTP (AJAX)</strong> : Dans les requêtes JavaScript, vous pouvez spécifier la méthode directement via <code>fetch()</code> ou <code>XMLHttpRequest</code></li>
                    <li><strong>Paramètre _method</strong> : Pour les formulaires HTML normaux, ajoutez un champ caché <code><input type="hidden" name="_method" value="PUT"></code></li>
                    <li><strong>En-tête X-HTTP-Method-Override</strong> : Standard utilisé par certaines bibliothèques et API</li>
                </ol>
                <p>Les trois approches sont implémentées dans notre méthode <code>detectMethod()</code> ci-dessus.</p>
            </div>

            <div class="info-box">
                <h3>Conventions RESTful pour les URLs</h3>
                <p>Voici les conventions standard pour organiser vos routes RESTful :</p>
                <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
                    <thead>
                        <tr style="background-color: #f5f5f5;">
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">Méthode</th>
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">URL</th>
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">Action</th>
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">index</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Afficher tous les utilisateurs</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/create</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">create</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Formulaire de création</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">POST</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">store</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Créer un nouvel utilisateur</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">show</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Afficher un utilisateur</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id/edit</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">edit</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Formulaire d'édition</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">PUT</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">update</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Mettre à jour complètement</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">PATCH</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">partialUpdate</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Mettre à jour partiellement</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">DELETE</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">destroy</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Supprimer l'utilisateur</td>
                        </tr>
                    </tbody>
                </table>
                <p>Ces conventions rendent votre API prévisible et facilitent sa compréhension par d'autres développeurs.</p>
            </div>
        </section>

        <section class="section">
            <h2>Groupes de routes</h2>
            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Définition de groupes de routes</div>
                    <div class="example-description">
                        <p>Les groupes de routes sont une fonctionnalité puissante qui permet d'organiser logiquement les routes et d'appliquer des attributs communs (préfixes, middlewares, espaces de noms) à un ensemble de routes. Cette organisation simplifie considérablement la gestion des routes dans une application de taille importante.</p>
                        <p>Dans cet exemple, le préfixe <code>admin</code> est ajouté à toutes les routes du groupe, créant ainsi un espace d'administration isolé et cohérent. D'autres attributs courants pour les groupes incluent :</p>
                        <ul>
                            <li>Middlewares partagés (authentification, vérification de rôles)</li>
                            <li>Namespace de contrôleurs commun</li>
                            <li>Préfixes d'URL ou de nom de route</li>
                            <li>Contraintes de domaine</li>
                        </ul>
                        <p>Les groupes peuvent également être imbriqués pour créer des hiérarchies complexes de routes avec héritage des attributs.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Exemple de définition de groupes de routes</span>
<span class="variable">$router</span> = <span class="keyword">new</span> Router();

<span class="comment">// Groupe de routes avec préfixe "admin"</span>
<span class="variable">$router</span>->group([<span class="string">'prefix'</span> => <span class="string">'admin'</span>], <span class="keyword">function</span>(<span class="variable">$router</span>) {
    <span class="comment">// Ces routes seront accessibles via /admin/users et /admin/settings</span>
    <span class="variable">$router</span>->get(<span class="string">'users'</span>, [AdminController::<span class="keyword">class</span>, <span class="string">'listUsers'</span>]);
    <span class="variable">$router</span>->get(<span class="string">'settings'</span>, [AdminController::<span class="keyword">class</span>, <span class="string">'showSettings'</span>]);
});

<span class="comment">// Groupe avec préfixe et middleware</span>
<span class="variable">$router</span>->group([
    <span class="string">'prefix'</span> => <span class="string">'api'</span>,
    <span class="string">'middleware'</span> => [AuthMiddleware::<span class="keyword">class</span>, ApiRateLimitMiddleware::<span class="keyword">class</span>]
], <span class="keyword">function</span>(<span class="variable">$router</span>) {
    <span class="variable">$router</span>->get(<span class="string">'users'</span>, [ApiController::<span class="keyword">class</span>, <span class="string">'getUsers'</span>]);
    <span class="variable">$router</span>->post(<span class="string">'users'</span>, [ApiController::<span class="keyword">class</span>, <span class="string">'createUser'</span>]);
});</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Implémentation des groupes de routes</div>
                    <div class="example-description">
                        <p>Cette implémentation de la méthode <code>group()</code> permet d'organiser les routes en groupes logiques qui partagent des attributs communs comme un préfixe d'URL, des middlewares, ou un namespace de contrôleur. La méthode utilise une pile (stack) pour gérer l'imbrication des groupes. Lorsqu'un nouveau groupe est créé, ses attributs sont fusionnés avec ceux du groupe parent, puis les routes définies à l'intérieur du callback héritent automatiquement de ces attributs. Cela permet une organisation hiérarchique et modulaire des routes tout en réduisant la duplication de code.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">class</span> <span class="tag">Router</span>
{
    <span class="keyword">protected</span> <span class="variable">$groupStack</span> = [];
    <span class="keyword">protected</span> <span class="variable">$routes</span> = [];
    
    <span class="comment">// ... autres méthodes ...</span>
    
    
    <span class="comment">/**
     * Crée un groupe de routes
     */</span>
    <span class="keyword">public function</span> <span class="function">group</span>(<span class="keyword">array</span> <span class="variable">$attributes</span>, <span class="keyword">callable</span> <span class="variable">$callback</span>): <span class="keyword">void</span>
    {
        <span class="comment">// Sauvegarde l'état actuel du groupe</span>
        <span class="variable">$this</span>->updateGroupStack(<span class="variable">$attributes</span>);
        
        <span class="comment">// Exécute le callback pour définir les routes du groupe</span>
        <span class="variable">$callback</span>(<span class="variable">$this</span>);
        
        <span class="comment">// Restaure l'état précédent</span>
        <span class="function">array_pop</span>(<span class="variable">$this</span>->groupStack);
    }
    
    <span class="comment">/**
     * Mise à jour de la pile des groupes
     */</span>
    <span class="keyword">protected function</span> <span class="function">updateGroupStack</span>(<span class="keyword">array</span> <span class="variable">$attributes</span>): <span class="keyword">void</span>
    {
        <span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$this</span>->groupStack) > 0) {
            <span class="variable">$attributes</span> = <span class="variable">$this</span>->mergeWithLastGroup(<span class="variable">$attributes</span>);
        }
        
        <span class="variable">$this</span>->groupStack[] = <span class="variable">$attributes</span>;
    }
    
    <span class="comment">/**
     * Fusionne les attributs avec le groupe précédent
     */</span>
    <span class="keyword">protected function</span> <span class="function">mergeWithLastGroup</span>(<span class="keyword">array</span> <span class="variable">$new</span>): <span class="keyword">array</span>
    {        <span class="variable">$last</span> = <span class="function">end</span>(<span class="variable">$this</span>->groupStack);
          <span class="comment">// Fusion des préfixes</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$new</span>[<span class="string">'prefix'</span>]) && <span class="function">isset</span>(<span class="variable">$last</span>[<span class="string">'prefix'</span>])) {
            <span class="variable">$new</span>[<span class="string">'prefix'</span>] = <span class="variable">$last</span>[<span class="string">'prefix'</span>] . <span class="string">'/'</span> . <span class="function">trim</span>(<span class="variable">$new</span>[<span class="string">'prefix'</span>], <span class="string">'/'</span>);
        }
          <span class="comment">// Fusion des middlewares</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$last</span>[<span class="string">'middleware'</span>])) {
            <span class="variable">$middlewares</span> = <span class="function">isset</span>(<span class="variable">$new</span>[<span class="string">'middleware'</span>]) ? <span class="variable">$new</span>[<span class="string">'middleware'</span>] : [];
            <span class="variable">$new</span>[<span class="string">'middleware'</span>] = <span class="function">array_merge</span>(
                (<span class="keyword">array</span>) <span class="variable">$last</span>[<span class="string">'middleware'</span>],
                (<span class="keyword">array</span>) <span class="variable">$middlewares</span>
            );
        }
        
        <span class="keyword">return</span> <span class="function">array_merge</span>(<span class="variable">$last</span>, <span class="variable">$new</span>);
    }    <span class="comment">
    /**
     * Ajoute une route en tenant compte des groupes
     */
    </span>
    <span class="keyword">protected function</span> <span class="function">addRoute</span>(<span class="keyword">string</span> <span class="variable">$method</span>, <span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>)<span class="operator">:</span> <span class="keyword">void</span>
    {
        <span class="comment">// Applique les attributs de groupe si nécessaire        <span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$this</span>-><span class="property">groupStack</span>)) {
            <span class="variable">$group</span> = <span class="function">end</span>(<span class="variable">$this</span>-><span class="property">groupStack</span>);
            
            <span class="comment">// Applique le préfixe du groupe</span>
            <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$group</span>[<span class="string">'prefix'</span>])) {
                <span class="variable">$path</span> = <span class="function">trim</span>(<span class="variable">$group</span>[<span class="string">'prefix'</span>], <span class="string">'/'</span>) . <span class="string">'/'</span> . <span class="function">trim</span>(<span class="variable">$path</span>, <span class="string">'/'</span>);
            }
            
            <span class="comment">// Stocke les middlewares du groupe</span>
            <span class="variable">$middlewares</span> = <span class="function">isset</span>(<span class="variable">$group</span>[<span class="string">'middleware'</span>]) ? (<span class="keyword">array</span>) <span class="variable">$group</span>[<span class="string">'middleware'</span>] : [];
        } <span class="keyword">else</span> {
            <span class="variable">$middlewares</span> = [];
        }
        
        <span class="variable">$this</span>-><span class="property">routes</span>[] = [
            <span class="string">'method'</span> => <span class="function">strtoupper</span>(<span class="variable">$method</span>),
            <span class="string">'path'</span> => <span class="string">'/'</span> . <span class="function">trim</span>(<span class="variable">$path</span>, <span class="string">'/'</span>),
            <span class="string">'callback'</span> => <span class="variable">$callback</span>,
            <span class="string">'middleware'</span> => <span class="variable">$middlewares</span>        ];
    }
}

                    </div>
                </div>

            <div class="info-box">
                <h3>Avantages des groupes de routes</h3>
                <p>Les groupes de routes offrent plusieurs avantages :</p>
                <ul>
                    <li>Organisation logique des routes liées</li>
                    <li>Réduction de la duplication de code pour les préfixes communs</li>
                    <li>Application de middlewares à un ensemble de routes</li>
                    <li>Possibilité d'imbriquer des groupes pour une hiérarchie complexe</li>
                </ul>
                <p>C'est une pratique essentielle pour les applications de moyenne à grande taille.</p>
            </div>
        </section>
        <section class="section">
            <h2>Système de middlewares avancé</h2>

            <p>
                Les <strong>middlewares</strong> sont des couches de traitement qui s'exécutent avant et/ou après le traitement principal d'une requête.
                Ils permettent d'implémenter des fonctionnalités transversales comme l'authentification, la journalisation, la limitation de débit,
                la validation CSRF, la gestion CORS, etc.
            </p>

            <p>
                Un middleware suit le pattern <strong>"Pipeline"</strong> où chaque middleware peut :
            </p>

            <ul>
                <li><strong>Traitement avant</strong> : Exécuter du code avant de passer au middleware suivant</li>
                <li><strong>Délégation</strong> : Passer la requête au middleware suivant via <code>$next($request)</code></li>
                <li><strong>Traitement après</strong> : Exécuter du code après le retour du middleware suivant</li>
                <li><strong>Court-circuit</strong> : Arrêter l'exécution en ne pas appelant <code>$next</code></li>
                <li><strong>Modification</strong> : Modifier la requête ou la réponse</li>
            </ul>

            <div class="examples-list">                <div class="example">
                    <div class="example-header">Middlewares fondamentaux</div>
                    <div class="example-description">
                        <p>Voici plusieurs implémentations de middlewares essentiels pour une application web moderne et sécurisée. Le middleware <code>AuthMiddleware</code> gère l'authentification des utilisateurs en vérifiant leur session et en redirigeant les utilisateurs non authentifiés. Le <code>LogMiddleware</code> trace chaque requête avec des informations détaillées comme la durée d'exécution et le code de statut. Le <code>RoleMiddleware</code> contrôle les accès basés sur les rôles des utilisateurs. Enfin, le <code>RateLimitMiddleware</code> protège votre application contre les abus en limitant le nombre de requêtes par période de temps. Chaque middleware suit le pattern "Pipeline" où la méthode <code>handle()</code> peut traiter la requête avant et après l'exécution du reste de la chaîne.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">/**
 * Middleware d'authentification avec vérification de session
 */</span>
<span class="keyword">class</span> <span class="tag">AuthMiddleware</span>
{
    <span class="comment">/**
     * Vérifie si l'utilisateur est authentifié
     * @param Request $request La requête HTTP
     * @param Closure $next La fonction à exécuter ensuite
     * @return mixed
     */</span>
    <span class="keyword">public function</span> <span class="function">handle</span>(<span class="variable">$request</span>, Closure <span class="variable">$next</span>)
    {
        <span class="comment">// Démarre la session si pas déjà fait</span>
        <span class="keyword">if</span> (<span class="function">session_status</span>() === PHP_SESSION_NONE) {
            <span class="function">session_start</span>();
        }
        
        <span class="comment">// Vérifie si l'utilisateur est connecté</span>
        <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>]) || <span class="function">empty</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>])) {
            <span class="comment">// Stocke l'URL de destination pour redirection après connexion</span>
            <span class="variable">$_SESSION</span>[<span class="string">'intended_url'</span>] = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>];
            
            <span class="comment">// Gestion différente selon le type de requête</span>
            <span class="keyword">if</span> (<span class="variable">$request</span>->isAjax()) {
                <span class="function">http_response_code</span>(401);
                <span class="function">header</span>(<span class="string">'Content-Type: application/json'</span>);
                <span class="keyword">echo</span> <span class="function">json_encode</span>([<span class="string">'error'</span> => <span class="string">'Non authentifié'</span>, <span class="string">'redirect'</span> => <span class="string">'/login'</span>]);
                <span class="keyword">exit</span>;
            }
              <span class="comment">// Redirection classique</span>
            <span class="function">header</span>(<span class="string">'Location: /login'</span>);
            <span class="keyword">exit</span>;
        }
          <span class="comment">// Vérification de l'expiration de session</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'last_activity'</span>]) && 
            (<span class="function">time</span>() - <span class="variable">$_SESSION</span>[<span class="string">'last_activity'</span>] > 3600)) { <span class="comment">// 1 heure</span>
            <span class="function">session_destroy</span>();
            <span class="function">header</span>(<span class="string">'Location: /login?expired=1'</span>);
            <span class="keyword">exit</span>;
        }
        
        <span class="comment">// Met à jour l'activité</span>
        <span class="variable">$_SESSION</span>[<span class="string">'last_activity'</span>] = <span class="function">time</span>();
        
        <span class="comment">// Ajoute l'utilisateur à la requête pour usage ultérieur</span>
        <span class="variable">$request</span>->setUser(<span class="keyword">new</span> User(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>]));
        
        <span class="comment">// Continue l'exécution</span>
        <span class="keyword">return</span> <span class="variable">$next</span>(<span class="variable">$request</span>);
    }
}

<span class="comment">/**
 * Middleware de journalisation avancé
 */</span>
<span class="keyword">class</span> <span class="tag">LogMiddleware</span>
{
    <span class="keyword">protected</span> <span class="variable">$logger</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(Logger <span class="variable">$logger</span> = <span class="keyword">null</span>)
    {
        <span class="variable">$this</span>->logger = <span class="variable">$logger</span> ?? <span class="keyword">new</span> FileLogger(<span class="string">'/var/log/app.log'</span>);
    }
    
    <span class="keyword">public function</span> <span class="function">handle</span>(<span class="variable">$request</span>, Closure <span class="variable">$next</span>)
    {
              <span class="comment">// Données de la requête</span>
              <span class="variable">$startTime</span> = <span class="function">microtime</span>(<span class="keyword">true</span>);
              <span class="variable">$method</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>];
              <span class="variable">$uri</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>];
              <span class="variable">$ip</span> = <span class="variable">$request</span>-><span class="function">getClientIp</span>();
              <span class="variable">$userAgent</span> = <span class="variable">$_SERVER</span>[<span class="string">'HTTP_USER_AGENT'</span>] ?? <span class="string">'Unknown'</span>;
              
              <span class="comment">// Log de début de requête</span>
              <span class="variable">$this</span>-><span class="variable">logger</span>-><span class="function">info</span>(<span class="string">"[{</span><span class="variable">$method</span><span class="string">}] {</span><span class="variable">$uri</span><span class="string">} - IP: {</span><span class="variable">$ip</span><span class="string">}"</span>, [
                  <span class="string">'user_agent'</span> => <span class="variable">$userAgent</span>,
                  <span class="string">'timestamp'</span> => <span class="function">date</span>(<span class="string">'Y-m-d H:i:s'</span>)
              ]);
              
              <span class="keyword">try</span> {
                  <span class="comment">// Exécute le reste de la chaîne</span>
                  <span class="variable">$response</span> = <span class="variable">$next</span>(<span class="variable">$request</span>);
                  
                  <span class="comment">// Log de succès</span>
                  <span class="variable">$duration</span> = <span class="function">round</span>((<span class="function">microtime</span>(<span class="keyword">true</span>) - <span class="variable">$startTime</span>) * 1000, 2);
                  <span class="variable">$statusCode</span> = <span class="function">http_response_code</span>() ?: 200;
                  
                  <span class="variable">$this</span>-><span class="variable">logger</span>-><span class="function">info</span>(<span class="string">"[{</span><span class="variable">$method</span><span class="string">}] {</span><span class="variable">$uri</span><span class="string">} - {</span><span class="variable">$statusCode</span><span class="string">} - {</span><span class="variable">$duration</span><span class="string">}ms"</span>);
                  
                  <span class="keyword">return</span> <span class="variable">$response</span>;
                  
              } <span class="keyword">catch</span> (\<span class="tag">Exception</span> <span class="variable">$e</span>) {
                  <span class="comment">// Log d'erreur</span>
                  <span class="variable">$duration</span> = <span class="function">round</span>((<span class="function">microtime</span>(<span class="keyword">true</span>) - <span class="variable">$startTime</span>) * 1000, 2);
                  <span class="variable">$this</span>-><span class="variable">logger</span>-><span class="function">error</span>(<span class="string">"[{</span><span class="variable">$method</span><span class="string">}] {</span><span class="variable">$uri</span><span class="string">} - ERROR - {</span><span class="variable">$duration</span><span class="string">}ms"</span>, [
                      <span class="string">'exception'</span> => <span class="variable">$e</span>-><span class="function">getMessage</span>(),
                      <span class="string">'file'</span> => <span class="variable">$e</span>-><span class="function">getFile</span>(),
                      <span class="string">'line'</span> => <span class="variable">$e</span>-><span class="function">getLine</span>(),
                      <span class="string">'trace'</span> => <span class="variable">$e</span>-><span class="function">getTraceAsString</span>()
                  ]);
                  
                  <span class="keyword">throw</span> <span class="variable">$e</span>; <span class="comment">// Re-lance l'exception</span>
              }
          }
      }      <span class="comment">/**
       * Middleware de contrôle d'accès basé sur les rôles
       */</span>
      <span class="keyword">class</span> <span class="tag">RoleMiddleware</span>
      {
          <span class="keyword">protected</span> <span class="variable">$requiredRoles</span>;
          
          <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$roles</span> = [])
          {
              <span class="variable">$this</span>-><span class="variable">requiredRoles</span> = <span class="function">is_array</span>(<span class="variable">$roles</span>) ? <span class="variable">$roles</span> : [<span class="variable">$roles</span>];
          }
          
          <span class="keyword">public function</span> <span class="function">handle</span>(<span class="variable">$request</span>, <span class="tag">Closure</span> <span class="variable">$next</span>)
          {
              <span class="variable">$user</span> = <span class="variable">$request</span>-><span class="function">getUser</span>();
              
              <span class="keyword">if</span> (!<span class="variable">$user</span>) {
                  <span class="function">http_response_code</span>(401);
                  <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Authentification requise'</span>, 401);
              }
              
              <span class="comment">// Vérification des rôles</span>
              <span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$this</span>-><span class="variable">requiredRoles</span>)) {
                  <span class="variable">$userRoles</span> = <span class="variable">$user</span>-><span class="function">getRoles</span>();
                  <span class="variable">$hasRequiredRole</span> = <span class="keyword">false</span>;
                  
                  <span class="keyword">foreach</span> (<span class="variable">$this</span>-><span class="variable">requiredRoles</span> <span class="keyword">as</span> <span class="variable">$role</span>) {
                      <span class="keyword">if</span> (<span class="function">in_array</span>(<span class="variable">$role</span>, <span class="variable">$userRoles</span>)) {
                          <span class="variable">$hasRequiredRole</span> = <span class="keyword">true</span>;
                          <span class="keyword">break</span>;
                      }
                  }
                  
                  <span class="keyword">if</span> (!<span class="variable">$hasRequiredRole</span>) {
                      <span class="function">http_response_code</span>(403);
                      <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Accès non autorisé'</span>, 403);
                  }
              }
              
              <span class="keyword">return</span> <span class="variable">$next</span>(<span class="variable">$request</span>);
          }
      }      <span class="comment">/**
       * Middleware de limitation du taux de requêtes (Rate Limiting)
       */</span>
      <span class="keyword">class</span> <span class="tag">RateLimitMiddleware</span>
      {
          <span class="keyword">protected</span> <span class="variable">$maxRequests</span>;
          <span class="keyword">protected</span> <span class="variable">$timeWindow</span>; <span class="comment">// en secondes</span>
          <span class="keyword">protected</span> <span class="variable">$storage</span>; <span class="comment">// Redis, fichier, etc.</span>
          
          <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="keyword">int</span> <span class="variable">$maxRequests</span> = 60, <span class="keyword">int</span> <span class="variable">$timeWindow</span> = 60)
          {
              <span class="variable">$this</span>-><span class="variable">maxRequests</span> = <span class="variable">$maxRequests</span>;
              <span class="variable">$this</span>-><span class="variable">timeWindow</span> = <span class="variable">$timeWindow</span>;
              <span class="variable">$this</span>-><span class="variable">storage</span> = <span class="keyword">new</span> <span class="tag">FileStorage</span>(<span class="string">'/tmp/rate_limit'</span>); <span class="comment">// Exemple simple</span>
          }
          
          <span class="keyword">public function</span> <span class="function">handle</span>(<span class="variable">$request</span>, <span class="tag">Closure</span> <span class="variable">$next</span>)
          {
              <span class="variable">$identifier</span> = <span class="variable">$this</span>-><span class="function">getIdentifier</span>(<span class="variable">$request</span>);
              <span class="variable">$key</span> = <span class="string">'rate_limit:'</span> . <span class="variable">$identifier</span> . <span class="string">':'</span> . <span class="function">floor</span>(<span class="function">time</span>() / <span class="variable">$this</span>-><span class="variable">timeWindow</span>);
              
              <span class="comment">// Récupère le nombre de requêtes pour cette fenêtre</span>
              <span class="variable">$requests</span> = (<span class="keyword">int</span>) <span class="variable">$this</span>-><span class="variable">storage</span>-><span class="function">get</span>(<span class="variable">$key</span>, 0);
              
              <span class="keyword">if</span> (<span class="variable">$requests</span> >= <span class="variable">$this</span>-><span class="variable">maxRequests</span>) {
                  <span class="comment">// Limite dépassée</span>
                  <span class="function">http_response_code</span>(429);
                  <span class="function">header</span>(<span class="string">'Retry-After: '</span> . <span class="variable">$this</span>-><span class="variable">timeWindow</span>);
                  <span class="function">header</span>(<span class="string">'X-RateLimit-Limit: '</span> . <span class="variable">$this</span>-><span class="variable">maxRequests</span>);
                  <span class="function">header</span>(<span class="string">'X-RateLimit-Remaining: 0'</span>);
                  
                  <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Trop de requêtes'</span>, 429);
              }
              
              <span class="comment">// Incrémente le compteur</span>
              <span class="variable">$this</span>-><span class="variable">storage</span>-><span class="function">increment</span>(<span class="variable">$key</span>, <span class="variable">$this</span>-><span class="variable">timeWindow</span>);
              
              <span class="comment">// Ajoute les en-têtes de limite</span>
              <span class="function">header</span>(<span class="string">'X-RateLimit-Limit: '</span> . <span class="variable">$this</span>-><span class="variable">maxRequests</span>);
              <span class="function">header</span>(<span class="string">'X-RateLimit-Remaining: '</span> . (<span class="variable">$this</span>-><span class="variable">maxRequests</span> - <span class="variable">$requests</span> - 1));
              
              <span class="keyword">return</span> <span class="variable">$next</span>(<span class="variable">$request</span>);
          }
          
          <span class="keyword">protected function</span> <span class="function">getIdentifier</span>(<span class="variable">$request</span>): <span class="keyword">string</span>
          {
              <span class="comment">// Peut être l'IP, l'ID utilisateur, une clé API, etc.</span>
              <span class="variable">$user</span> = <span class="variable">$request</span>-><span class="function">getUser</span>();
              <span class="keyword">if</span> (<span class="variable">$user</span>) {
                  <span class="keyword">return</span> <span class="string">'user_'</span> . <span class="variable">$user</span>-><span class="function">getId</span>();
              }
              
              <span class="keyword">return</span> <span class="string">'ip_'</span> . <span class="variable">$request</span>-><span class="function">getClientIp</span>();
          }
      }</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Application des middlewares</div>
                    <div class="example-description">
                        <p>Cet exemple montre comment intégrer les middlewares dans le routeur. La méthode <code>middleware()</code> permet d'ajouter des middlewares globaux qui s'appliqueront à toutes les routes de l'application. Ces middlewares sont stockés dans un tableau et seront exécutés dans l'ordre où ils ont été ajoutés. Cette conception utilise le pattern de chaînage de méthodes (fluent interface) en retournant <code>$this</code>, ce qui permet d'enchaîner plusieurs appels de méthode pour une syntaxe plus concise et lisible lors de la configuration du routeur.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">class</span> <span class="tag">Router</span>
{
    <span class="keyword">protected</span> <span class="variable">$routes</span> = [];
    <span class="keyword">protected</span> <span class="variable">$globalMiddlewares</span> = [];
    
    <span class="comment">// ... autres méthodes ...</span>
    
    <span class="comment">/**
     * Ajoute un middleware global
     */</span>
    <span class="keyword">public function</span> <span class="function">middleware</span>(<span class="variable">$middleware</span>): <span class="keyword">self</span>
    {
        <span class="variable">$this</span>->globalMiddlewares[] = <span class="variable">$middleware</span>;
        <span class="keyword">return</span> <span class="variable">$this</span>;
    }
    
    <span class="comment">/**
     * Ajoute un middleware à une route spécifique
     */</span>
    <span class="keyword">protected function</span> <span class="function">addRouteMiddleware</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$middleware</span>): <span class="keyword">void</span>
    {
        <span class="comment">
        // Trouve la dernière route ajoutée et ajoute le middleware</span>        
        <span class="keyword">foreach</span> (<span class="variable">$this</span><span class="operator">-></span><span class="property">routes</span> <span class="keyword">as</span> <span class="operator">&</span><span class="variable">$route</span>) {
            <span class="keyword">if</span> (<span class="variable">$route</span>[<span class="string">'path'</span>] <span class="operator">===</span> <span class="variable">$path</span>) {
                <span class="keyword">if</span> (<span class="operator">!</span><span class="function">isset</span>(<span class="variable">$route</span>[<span class="string">'middleware'</span>])) {
                    <span class="variable">$route</span>[<span class="string">'middleware'</span>] <span class="operator">=</span> [];</span>                }
                <span class="variable">$route</span>[<span class="string">'middleware'</span>] = <span class="function">array_merge</span>(<span class="variable">$route</span>[<span class="string">'middleware'</span>], (<span class="keyword">array</span>) <span class="variable">$middleware</span>);
                <span class="keyword">break</span>;
            }
        }
    }
    
    <span class="comment">/**
     * Exécute les middlewares dans l'ordre
     */</span>
    <span class="keyword">protected function</span> <span class="function">runMiddlewares</span>(<span class="keyword">array</span> <span class="variable">$middlewares</span>, <span class="variable">$request</span>, <span class="tag">Closure</span> <span class="variable">$target</span>)
    {
        <span class="comment">// Si aucun middleware, exécute directement la cible</span>
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$middlewares</span>)) {
            <span class="keyword">return</span> <span class="variable">$target</span>(<span class="variable">$request</span>);
        }
        
        <span class="comment">// Crée une chaîne de middlewares (pattern pipeline)</span>
        <span class="variable">$pipeline</span> = <span class="function">array_reduce</span>(
            <span class="function">array_reverse</span>(<span class="variable">$middlewares</span>),
            <span class="keyword">function</span> (<span class="variable">$next</span>, <span class="variable">$middleware</span>) {
                <span class="keyword">return function</span> (<span class="variable">$request</span>) <span class="keyword">use</span> (<span class="variable">$middleware</span>, <span class="variable">$next</span>) {
                    <span class="comment">// Instancie le middleware si c'est un nom de classe</span>
                    <span class="keyword">if</span> (<span class="function">is_string</span>(<span class="variable">$middleware</span>)) {
                        <span class="variable">$middleware</span> = <span class="keyword">new</span> <span class="variable">$middleware</span>();
                    }
                    <span class="keyword">return</span> <span class="variable">$middleware</span>-><span class="function">handle</span>(<span class="variable">$request</span>, <span class="variable">$next</span>);
                };
            },
            <span class="variable">$target</span>
        );
        
        <span class="keyword">return</span> <span class="variable">$pipeline</span>(<span class="variable">$request</span>);
    }
    
    <span class="comment">/**
     * Traitement de la requête
     */</span>
    <span class="keyword">public function</span> <span class="function">run</span>()
    {
        <span class="variable">$method</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>];
        <span class="variable">$uri</span> = <span class="function">parse_url</span>(<span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>], PHP_URL_PATH);
        
        <span class="keyword">foreach</span> (<span class="variable">$this</span>-><span class="property">routes</span> <span class="keyword">as</span> <span class="variable">$route</span>) {
            <span class="keyword">if</span> (<span class="variable">$route</span>[<span class="string">'method'</span>] === <span class="variable">$method</span> && <span class="variable">$this</span>-><span class="function">matchRoute</span>(<span class="variable">$route</span>[<span class="string">'path'</span>], <span class="variable">$uri</span>, <span class="variable">$params</span>)) {
                <span class="variable">$request</span> = <span class="keyword">new</span> <span class="tag">Request</span>(<span class="variable">$params</span>);
                
                <span class="comment">// Combine les middlewares globaux avec ceux de la route</span>
                <span class="variable">$middlewares</span> = <span class="function">array_merge</span>(
                    <span class="variable">$this</span>-><span class="property">globalMiddlewares</span>,
                    <span class="variable">$route</span>[<span class="string">'middleware'</span>] ?? []
                );
                
                <span class="comment">// Prépare la cible finale</span>
                <span class="variable">$target</span> = <span class="keyword">function</span> (<span class="variable">$request</span>) <span class="keyword">use</span> (<span class="variable">$route</span>) {
                    <span class="comment">// Exécute le contrôleur ou la closure</span>
                    <span class="keyword">if</span> (<span class="function">is_array</span>(<span class="variable">$route</span>[<span class="string">'callback'</span>]) && <span class="function">count</span>(<span class="variable">$route</span>[<span class="string">'callback'</span>]) === 2) {
                        <span class="variable">$controller</span> = <span class="keyword">new</span> <span class="variable">$route</span>[<span class="string">'callback'</span>][0]();
                        <span class="keyword">return</span> <span class="variable">$controller</span>->{<span class="variable">$route</span>[<span class="string">'callback'</span>][1]}(<span class="variable">$request</span>);
                    }
                    <span class="keyword">return</span> <span class="function">call_user_func</span>(<span class="variable">$route</span>[<span class="string">'callback'</span>], <span class="variable">$request</span>);
                };
                
                <span class="comment">// Exécute la chaîne de middlewares</span>
                <span class="keyword">return</span> <span class="variable">$this</span>-><span class="function">runMiddlewares</span>(<span class="variable">$middlewares</span>, <span class="variable">$request</span>, <span class="variable">$target</span>);
            }
        }
        
        <span class="comment">// Aucune route trouvée</span>
        <span class="keyword">throw new</span> \<span class="tag">Exception</span>(<span class="string">'Route non trouvée'</span>, <span class="number">404</span>);
    }
    
    <span class="comment">/**
     * Gère une exception
     */</span>
    <span class="keyword">protected function</span> <span class="function">handleException</span>(<span class="tag">RouterException</span> <span class="variable">$exception</span>)
    {
        <span class="variable">$statusCode</span> = <span class="variable">$exception</span>-><span class="function">getStatusCode</span>();
        
        <span class="function">http_response_code</span>(<span class="variable">$statusCode</span>);
        
        <span class="comment">// Utilise un gestionnaire d'erreur personnalisé si défini</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$this</span>-><span class="property">errorHandlers</span>[<span class="variable">$statusCode</span>])) {
            <span class="keyword">return</span> <span class="function">call_user_func</span>(<span class="variable">$this</span>-><span class="property">errorHandlers</span>[<span class="variable">$statusCode</span>], <span class="variable">$exception</span>);
        }        <span class="comment">// Gestionnaire par défaut</span>
        <span class="keyword">if</span> (<span class="variable">$statusCode</span> === <span class="number">404</span>) {
            <span class="keyword">return</span> <span class="string">"404 - Page non trouvée"</span> . <span class="variable">$exception</span>-><span class="function">getMessage</span>()  <span class="string"></span>;
        }
        
        <span class="keyword">return</span> <span class="string">"Erreur "</span> . <span class="variable">$statusCode</span> . <span class="string"></span> . <span class="variable">$exception</span>-><span class="function">getMessage</span>() <span class="string"></span>;
    }
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Utilisation des gestionnaires d'erreurs</div>
                    <div class="example-description">
                        <p>Cet exemple montre comment définir des gestionnaires d'erreurs personnalisés pour les codes d'erreur HTTP courants comme 404 (ressource non trouvée) et 500 (erreur serveur interne). La gestion centralisée des erreurs permet une expérience utilisateur cohérente tout en facilitant la journalisation et le débogage. Notez comment les exceptions sont utilisées pour signaler différentes conditions d'erreur, avec la possibilité d'inclure des vues personnalisées pour chaque type d'erreur. Le routeur capture ces exceptions et délègue le traitement aux gestionnaires appropriés.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$router</span> = <span class="keyword">new</span> Router();

<span class="comment">// Définir des gestionnaires d'erreurs personnalisés</span>
<span class="variable">$router</span>->error(404, <span class="keyword">function</span>() {
    <span class="keyword">include</span> <span class="string">'views/404.php'</span>;
    <span class="keyword">return</span> <span class="keyword">null</span>;
});

<span class="variable">$router</span>->error(500, <span class="keyword">function</span>(RouterException <span class="variable">$e</span>) {
    <span class="function">error_log</span>(<span class="string">"Erreur critique: {</span><span class="variable">$e</span>->getMessage()<span class="string">}\n{</span><span class="variable">$e</span>->getTraceAsString()<span class="string">}"</span>);
    <span class="keyword">include</span> <span class="string">'views/500.php'</span>;
    <span class="keyword">return</span> <span class="keyword">null</span>;
});

<span class="comment">// Ajout de routes avec des contrôleurs potentiellement problématiques</span>
<span class="variable">$router</span>->get(<span class="string">'produits/:id'</span>, <span class="keyword">function</span>(<span class="variable">$request</span>) {
    <span class="keyword">if</span> (!<span class="function">is_numeric</span>(<span class="variable">$request</span>->params[<span class="string">'id'</span>])) {
        <span class="keyword">throw new</span> \InvalidArgumentException(<span class="string">'ID de produit invalide'</span>);
    }
      <span class="variable">$produit</span> = <span class="variable">$productRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
    
    <span class="keyword">if</span> (<span class="variable">$produit</span> === <span class="keyword">null</span>) {
        <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Produit non trouvé'</span>, <span class="number">404</span>);
    }
    
    <span class="keyword">return new</span> <span class="tag">ProductView</span>(<span class="variable">$produit</span>);
});</code></pre>
                    </div>
                </div>

                <div class="info-box">
                    <h3>Bonnes pratiques pour la gestion des erreurs</h3>
                    <p>Une bonne gestion des erreurs est essentielle pour une application robuste :</p>
                    <ul>
                        <li>Utilisez des codes HTTP appropriés (404 pour "non trouvé", 403 pour "interdit", etc.)</li>
                        <li>Créez des pages d'erreur personnalisées pour améliorer l'expérience utilisateur</li>
                        <li>Journalisez les erreurs graves pour pouvoir les analyser</li>
                        <li>Évitez d'exposer des informations sensibles dans les messages d'erreur en production</li>
                        <li>Différenciez les messages d'erreur entre environnements de développement et de production</li>
                    </ul>
                    <p>En production, affichez des messages d'erreur conviviaux pour l'utilisateur tout en enregistrant les détails techniques pour le débogage.</p>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Injection de dépendances</h2>
            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Contrôleur avec injection de dépendances</div>
                    <div class="example-description">
                        <p>Ce code illustre l'utilisation de l'injection de dépendances dans les contrôleurs, un principe fondamental de conception orientée objet. Au lieu de créer des dépendances à l'intérieur du contrôleur, celui-ci reçoit ses dépendances via son constructeur. Cette approche présente plusieurs avantages : le code est plus facilement testable (on peut injecter des mocks), le couplage est réduit entre les composants, et les responsabilités sont clairement séparées. Dans cet exemple, le contrôleur reçoit un repository pour l'accès aux données et un logger pour enregistrer les événements, ce qui lui permet de se concentrer uniquement sur la logique de contrôle.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">class</span> <span class="tag">UserController</span>
{
    <span class="keyword">protected</span> <span class="variable">$userRepository</span>;
    <span class="keyword">protected</span> <span class="variable">$logger</span>;
    
    <span class="comment">/**
     * Injection des dépendances via le constructeur
     */</span>
    <span class="keyword">public function</span> <span class="function">__construct</span>(UserRepository <span class="variable">$userRepository</span>, Logger <span class="variable">$logger</span>)
    {
        <span class="variable">$this</span>->userRepository = <span class="variable">$userRepository</span>;
        <span class="variable">$this</span>->logger = <span class="variable">$logger</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">index</span>()
    {
        <span class="variable">$users</span> = <span class="variable">$this</span>->userRepository->findAll();
        <span class="variable">$this</span>->logger->info(<span class="string">'Liste des utilisateurs consultée'</span>);
          <span class="keyword">return new</span> <span class="tag">View</span>(<span class="string">'users/index'</span>, [<span class="string">'users'</span> => <span class="variable">$users</span>]);
    }
    
    <span class="keyword">public function</span> <span class="function">show</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        
        <span class="variable">$this</span>-><span class="property">logger</span>-><span class="function">info</span>(<span class="string">"Utilisateur {</span><span class="variable">$user</span>-><span class="property">id</span><span class="string">} consulté"</span>);
        
        <span class="keyword">return new</span> <span class="tag">View</span>(<span class="string">'users/show'</span>, [<span class="string">'user'</span> => <span class="variable">$user</span>]);
    }
    <span class="comment">
    /**
     * GET /users/:id - Affiche un utilisateur spécifique
     * Idempotente et sûre
     */</span>    <span class="keyword">public function</span> <span class="function">show</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        
        <span class="keyword">return new</span> <span class="tag">View</span>(<span class="string">'users/show'</span>, [<span class="string">'user'</span> => <span class="variable">$user</span>]);
    }
    <span class="comment">
    /**
     * GET /users/:id/edit - Affiche le formulaire d'édition
     * Idempotente et sûre
     */</span>    <span class="keyword">public function</span> <span class="function">edit</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        
        <span class="keyword">return new</span> <span class="tag">View</span>(<span class="string">'users/edit'</span>, [<span class="string">'user'</span> => <span class="variable">$user</span>]);
    }
    <span class="comment">
    /**
     * PUT /users/:id - Met à jour complètement un utilisateur
     * Idempotente - exécuter plusieurs fois avec les mêmes données produit le même résultat
     */</span>    <span class="keyword">public function</span> <span class="function">update</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        <span class="comment">
        // Validation</span>
        <span class="variable">$validator</span> = <span class="keyword">new</span> <span class="tag">Validator</span>(<span class="variable">$request</span>-><span class="function">post</span>());
        <span class="variable">$validator</span>-><span class="function">required</span>([<span class="string">'name'</span>, <span class="string">'email'</span>])
                  -><span class="function">email</span>(<span class="string">'email'</span>)
                  -><span class="function">unique</span>(<span class="string">'email'</span>, <span class="string">'users'</span>, <span class="variable">$user</span>-><span class="property">id</span>);
        
        <span class="keyword">if</span> (!<span class="variable">$validator</span>-><span class="function">isValid</span>()) {
            <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">"/users/{</span><span class="variable">$user</span>-><span class="property">id</span><span class="string">}/edit"</span>, [<span class="string">'errors'</span> => <span class="variable">$validator</span>-><span class="function">getErrors</span>()]);
        }
        <span class="comment">
        // Mise à jour complète de l'utilisateur</span>
        <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">update</span>(<span class="variable">$user</span>-><span class="property">id</span>, <span class="variable">$validator</span>-><span class="function">getData</span>());
        
        <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">"/users/{</span><span class="variable">$user</span>-><span class="property">id</span><span class="string">}"</span>, [<span class="string">'success'</span> => <span class="string">'Utilisateur mis à jour'</span>]);
    }
    <span class="comment">
    /**
     * PATCH /users/:id - Met à jour partiellement un utilisateur
     * Généralement non idempotente (dépend de l'implémentation)
     */</span>    <span class="keyword">public function</span> <span class="function">partialUpdate</span>(<span class="variable">$request</span>)    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Utilisateur non trouvé'</span>, <span class="number">404</span>);
        }
        <span class="comment">
        // Validation uniquement des champs présents</span>
        <span class="variable">$data</span> = <span class="variable">$request</span>-><span class="function">post</span>();
        <span class="variable">$allowedFields</span> = [<span class="string">'name'</span>, <span class="string">'email'</span>, <span class="string">'phone'</span>, <span class="string">'address'</span>];
        <span class="variable">$updateData</span> = <span class="function">array_intersect_key</span>(<span class="variable">$data</span>, <span class="function">array_flip</span>(<span class="variable">$allowedFields</span>));
        
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$updateData</span>)) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Aucune donnée valide fournie'</span>, <span class="number">400</span>);
        }
        <span class="comment">
        // Mise à jour partielle</span>
        <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">partialUpdate</span>(<span class="variable">$user</span>-><span class="property">id</span>, <span class="variable">$updateData</span>);
        
        <span class="keyword">return new</span> <span class="tag">JsonResponse</span>([<span class="string">'message'</span> => <span class="string">'Utilisateur mis à jour partiellement'</span>]);
    }
    <span class="comment">
    /**
     * DELETE /users/:id - Supprime un utilisateur
     * Idempotente - supprimer plusieurs fois le même utilisateur a le même effet
     */</span>    <span class="keyword">public function</span> <span class="function">destroy</span>(<span class="variable">$request</span>)
    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="keyword">if</span> (!<span class="variable">$user</span>) {<span class="comment">            // Pour DELETE, on peut considérer que supprimer un élément inexistant est "réussi"
            // car l'objectif (l'élément n'existe plus) est atteint</span>
            <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">'/users'</span>, [<span class="string">'info'</span> => <span class="string">'Utilisateur déjà supprimé'</span>]);
        }
        <span class="comment">
        // Vérification des contraintes (ex: ne pas supprimer un admin)</span>
        <span class="keyword">if</span> (<span class="variable">$user</span>-><span class="property">role</span> === <span class="string">'admin'</span> && <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">countAdmins</span>() <= <span class="number">1</span>) {
            <span class="keyword">throw new</span> <span class="tag">RouterException</span>(<span class="string">'Impossible de supprimer le dernier administrateur'</span>, <span class="number">403</span>);
        }
        
        <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">delete</span>(<span class="variable">$user</span>-><span class="property">id</span>);
        
        <span class="keyword">return new</span> <span class="tag">RedirectResponse</span>(<span class="string">'/users'</span>, [<span class="string">'success'</span> => <span class="string">'Utilisateur supprimé'</span>]);
    }
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <h3>Support des méthodes HTTP dans les navigateurs</h3>
                <p>Bien que les navigateurs ne prennent en charge nativement que GET et POST, il existe plusieurs approches courantes pour gérer PUT, PATCH et DELETE :</p>
                <ol>
                    <li><strong>Headers HTTP (AJAX)</strong> : Dans les requêtes JavaScript, vous pouvez spécifier la méthode directement via <code>fetch()</code> ou <code>XMLHttpRequest</code></li>
                    <li><strong>Paramètre _method</strong> : Pour les formulaires HTML normaux, ajoutez un champ caché <code><input type="hidden" name="_method" value="PUT"></code></li>
                    <li><strong>En-tête X-HTTP-Method-Override</strong> : Standard utilisé par certaines bibliothèques et API</li>
                </ol>
                <p>Les trois approches sont implémentées dans notre méthode <code>detectMethod()</code> ci-dessus.</p>
            </div>

            <div class="info-box">
                <h3>Conventions RESTful pour les URLs</h3>
                <p>Voici les conventions standard pour organiser vos routes RESTful :</p>
                <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
                    <thead>
                        <tr style="background-color: #f5f5f5;">
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">Méthode</th>
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">URL</th>
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">Action</th>
                            <th style="padding: 0.5rem; border: 1px solid #ddd;">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">index</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Afficher tous les utilisateurs</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/create</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">create</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Formulaire de création</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">POST</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">store</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Créer un nouvel utilisateur</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">show</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Afficher un utilisateur</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">GET</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id/edit</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">edit</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Formulaire d'édition</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">PUT</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">update</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Mettre à jour complètement</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">PATCH</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">partialUpdate</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Mettre à jour partiellement</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">DELETE</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">/users/:id</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">destroy</td>
                            <td style="padding: 0.5rem; border: 1px solid #ddd;">Supprimer l'utilisateur</td>
                        </tr>
                    </tbody>
                </table>
                <p>Ces conventions rendent votre API prévisible et facilitent sa compréhension par d'autres développeurs.</p>
            </div>
        </section>

        <section class="section">
            <h2>Routes nommées et génération d'URLs</h2>

            <p>
                Un système de routage vraiment puissant doit permettre la <strong>génération d'URLs</strong> à partir des routes définies.
                Au lieu de coder en dur les URLs dans vos vues et contrôleurs, vous pouvez utiliser des <strong>routes nommées</strong>
                pour générer automatiquement les liens corrects.
            </p>

            <p>
                Cette approche présente plusieurs avantages majeurs :
            </p>

            <ul>
                <li><strong>Maintenabilité</strong> : Modifier l'URL d'une route ne nécessite pas de chercher tous les liens dans le code</li>
                <li><strong>Consistance</strong> : Évite les erreurs de frappe dans les URLs</li>
                <li><strong>Refactoring</strong> : Facilite la restructuration des URLs de l'application</li>
                <li><strong>Localisation</strong> : Permet d'avoir des URLs différentes selon la langue</li>
                <li><strong>Environnements</strong> : Adapte automatiquement les URLs selon l'environnement (dev, prod)</li>
                <li><strong>HTTPS/HTTP</strong> : Gère automatiquement le protocole approprié</li>
            </ul>

            <div class="examples-list">
                <div class="example">
                    <div class="example-header">Définition de routes nommées</div>
                    <div class="example-description">
                        <p>Les routes nommées permettent de référencer les chemins d'URL par un nom symbolique plutôt que par leur chemin brut. Cette approche offre une abstraction qui découple le code de la structure exacte des URLs. Dans cet exemple, chaque route est définie avec la méthode <code>name()</code> pour lui attribuer un identifiant unique. Les conventions de nommage suivent généralement une structure hiérarchique (par exemple, <code>blog.index</code>, <code>blog.show</code>) qui reflète l'organisation des ressources. Les routes nommées sont particulièrement utiles pour générer des URLs dans les vues et les redirections, car elles permettent de modifier le chemin d'une route sans avoir à mettre à jour tous les liens qui y font référence.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Définition de routes avec noms</span>

<span class="comment">// Routes principales</span>
<span class="variable">$router</span>->get(<span class="string">''</span>, [HomeController::<span class="keyword">class</span>, <span class="string">'index'</span>])->name(<span class="string">'home'</span>);
<span class="variable">$router</span>->get(<span class="string">'about'</span>, [PageController::<span class="keyword">class</span>, <span class="string">'about'</span>])->name(<span class="string">'about'</span>);
<span class="variable">$router</span>->get(<span class="string">'contact'</span>, [ContactController::<span class="keyword">class</span>, <span class="string">'show'</span>])->name(<span class="string">'contact'</span>);
<span class="variable">$router</span>->post(<span class="string">'contact'</span>, [ContactController::<span class="keyword">class</span>, <span class="string">'submit'</span>])->name(<span class="string">'contact.submit'</span>);

<span class="comment">// Routes de blog avec paramètres</span>
<span class="variable">$router</span>->get(<span class="string">'blog'</span>, [BlogController::<span class="keyword">class</span>, <span class="string">'index'</span>])->name(<span class="string">'blog.index'</span>);
<span class="variable">$router</span>->get(<span class="string">'blog/:slug'</span>, [BlogController::<span class="keyword">class</span>, <span class="string">'show'</span>])
       ->whereSlug(<span class="string">'slug'</span>)
       ->name(<span class="string">'blog.show'</span>);

<span class="comment">// Routes d'utilisateurs (CRUD complet)</span>
<span class="variable">$router</span>->get(<span class="string">'users'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'index'</span>])->name(<span class="string">'users.index'</span>);
<span class="variable">$router</span>->get(<span class="string">'users/create'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'create'</span>])->name(<span class="string">'users.create'</span>);
<span class="variable">$router</span>->post(<span class="string">'users'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'store'</span>])->name(<span class="string">'users.store'</span>);
<span class="variable">$router</span>->get(<span class="string">'users/:id'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'show'</span>])
       ->whereNumber(<span class="string">'id'</span>)
       ->name(<span class="string">'users.show'</span>);
<span class="variable">$router</span>->get(<span class="string">'users/:id/edit'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'edit'</span>])
       ->whereNumber(<span class="string">'id'</span>)
       ->name(<span class="string">'users.edit'</span>);
<span class="variable">$router</span>->put(<span class="string">'users/:id'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'update'</span>])
       ->whereNumber(<span class="string">'id'</span>)
       ->name(<span class="string">'users.update'</span>);
<span class="variable">$router</span>->delete(<span class="string">'users/:id'</span>, [UserController::<span class="keyword">class</span>, <span class="string">'destroy'</span>])
       ->whereNumber(<span class="string">'id'</span>)
       ->name(<span class="string">'users.destroy'</span>);

<span class="comment">// Routes avec paramètres multiples</span>
<span class="variable">$router</span>->get(<span class="string">'categories/:category/products/:id'</span>, [<span class="tag">ProductController</span>::<span class="keyword">class</span>, <span class="string">'show'</span>])
       -><span class="function">whereSlug</span>(<span class="string">'category'</span>)
       -><span class="function">whereNumber</span>(<span class="string">'id'</span>)
       -><span class="function">name</span>(<span class="string">'products.show'</span>);

<span class="comment">// Routes avec paramètres optionnels (via plusieurs définitions)</span>
<span class="variable">$router</span>->get(<span class="string">'search'</span>, [<span class="tag">SearchController</span>::<span class="keyword">class</span>, <span class="string">'index'</span>])-><span class="function">name</span>(<span class="string">'search'</span>);
<span class="variable">$router</span>->get(<span class="string">'search/:query'</span>, [<span class="tag">SearchController</span>::<span class="keyword">class</span>, <span class="string">'results'</span>])
       -><span class="function">where</span>(<span class="string">'query'</span>, <span class="string">'[^/]+'</span>)
       -><span class="function">name</span>(<span class="string">'search.results'</span>);</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Gestionnaire d'URLs (URL Generator)</div>
                    <div class="example-description">
                        <p>Le générateur d'URL est un composant essentiel d'un système de routage avancé qui permet de <strong>générer des liens dynamiquement</strong> à partir des routes nommées. Cette approche offre plusieurs avantages majeurs :</p>
                        <ul>
                            <li>Centralisation de la définition des URLs dans un seul endroit (les routes)</li>
                            <li>Modification facile des URLs sans avoir à mettre à jour tous les liens dans l'application</li>
                            <li>Construction automatique des paramètres dynamiques dans les URLs</li>
                            <li>Gestion des URLs absolues et relatives selon le contexte</li>
                        </ul>
                        <p>Ce générateur s'utilise typiquement via des fonctions d'aide (<code>route('nom.route', ['param' => 'valeur'])</code>) dans les vues pour créer des liens cohérents avec les routes définies.</p>
                        <p class="tip">Utiliser systématiquement le générateur d'URL plutôt que des URLs codées en dur permet de maintenir une application robuste face aux changements de structure.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">/**
 * Générateur d'URLs basé sur les routes nommées</span>
 */</span>
<span class="keyword">class</span> <span class="tag">UrlGenerator</span>
{
    <span class="keyword">protected</span> <span class="variable">$routes</span> = [];
    <span class="keyword">protected</span> <span class="variable">$baseUrl</span>;
    <span class="keyword">protected</span> <span class="variable">$scheme</span>;
      <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="keyword">array</span> <span class="variable">$routes</span> = [], <span class="keyword">string</span> <span class="variable">$baseUrl</span> = <span class="keyword">null</span>)
    {
        <span class="variable">$this</span>->routes = <span class="variable">$routes</span>;
        <span class="variable">$this</span>->baseUrl = <span class="variable">$baseUrl</span> ?? <span class="variable">$this</span>->detectBaseUrl();
        <span class="variable">$this</span>->scheme = <span class="function">isset</span>(<span class="variable">$_SERVER</span>[<span class="string">'HTTPS'</span>]) && <span class="variable">$_SERVER</span>[<span class="string">'HTTPS'</span>] === <span class="string">'on'</span> ? <span class="string">'https'</span> : <span class="string">'http'</span>;
    }
    
    <span class="comment">/**
     * Génère une URL à partir d'un nom de route
     * @param string $name - Nom de la route
     * @param array $params - Paramètres à injecter dans l'URL
     * @param array $query - Paramètres de query string (?param=value)
     * @param bool $absolute - Générer une URL absolue ou relative
     * @return string URL générée
     */</span>
    <span class="keyword">public function</span> <span class="function">route</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">array</span> <span class="variable">$params</span> = [], <span class="keyword">array</span> <span class="variable">$query</span> = [], <span class="keyword">bool</span> <span class="variable">$absolute</span> = <span class="keyword">false</span>): <span class="keyword">string</span>
    {
        <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$this</span>->routes[<span class="variable">$name</span>])) {
            <span class="keyword">throw new</span> \InvalidArgumentException(<span class="string">"Route '{</span><span class="variable">$name</span><span class="string">}' non trouvée"</span>);
        }
        
        <span class="variable">$route</span> = <span class="variable">$this</span>->routes[<span class="variable">$name</span>];
        <span class="variable">$path</span> = <span class="variable">$route</span>->getPath();
        
        <span class="comment">// Remplace les paramètres dans le chemin</span>
        <span class="variable">$url</span> = <span class="variable">$this</span>->replaceParameters(<span class="variable">$path</span>, <span class="variable">$params</span>);
        
        <span class="comment">// Ajoute les paramètres de query string</span>
        <span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$query</span>)) {
            <span class="variable">$url</span> .= <span class="string">'?'</span> . <span class="function">http_build_query</span>(<span class="variable">$query</span>);
        }        <span class="comment">
        // Retourne une URL absolue ou relative</span>
        <span class="keyword">if</span> (<span class="variable">$absolute</span>) {
            <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">scheme</span> . <span class="string">'://'</span> . <span class="variable">$this</span>-><span class="property">baseUrl</span> . <span class="string">'/'</span> . <span class="function">ltrim</span>(<span class="variable">$url</span>, <span class="string">'/'</span>);
        }
        
        <span class="keyword">return</span> <span class="string">'/'</span> . <span class="function">ltrim</span>(<span class="variable">$url</span>, <span class="string">'/'</span>);
    }
    <span class="comment">    /**
     * Génère une URL absolue
     */</span>
    <span class="keyword">public function</span> <span class="function">routeAbsolute</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">array</span> <span class="variable">$params</span> = [], <span class="keyword">array</span> <span class="variable">$query</span> = []): <span class="keyword">string</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="function">route</span>(<span class="variable">$name</span>, <span class="variable">$params</span>, <span class="variable">$query</span>, <span class="keyword">true</span>);
    }
    <span class="comment">    /**
     * Remplace les paramètres dans le chemin de la route
     */</span>
    <span class="keyword">protected function</span> <span class="function">replaceParameters</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="keyword">array</span> <span class="variable">$params</span>): <span class="keyword">string</span>
    {<span class="comment">
        // Trouve tous les paramètres :nom dans le chemin</span>
        <span class="function">preg_match_all</span>(<span class="string">'/:([\w]+)/'</span>, <span class="variable">$path</span>, <span class="variable">$matches</span>);
        
        <span class="variable">$missingParams</span> = [];
        
        <span class="keyword">foreach</span> (<span class="variable">$matches</span>[<span class="number">1</span>] <span class="keyword">as</span> <span class="variable">$paramName</span>) {
            <span class="keyword">if</span> (!<span class="function">array_key_exists</span>(<span class="variable">$paramName</span>, <span class="variable">$params</span>)) {
                <span class="variable">$missingParams</span>[] = <span class="variable">$paramName</span>;
                <span class="keyword">continue</span>;
            }            <span class="comment">
            // Remplace :paramName par la valeur</span>
            <span class="variable">$path</span> = <span class="function">str_replace</span>(<span class="string">':'</span> . <span class="variable">$paramName</span>, <span class="variable">$params</span>[<span class="variable">$paramName</span>], <span class="variable">$path</span>);
        }
        
        <span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$missingParams</span>)) {
            <span class="keyword">throw new</span> \<span class="tag">InvalidArgumentException</span>(
                <span class="string">'Paramètres manquants pour générer l\'URL : '</span> . <span class="function">implode</span>(<span class="string">', '</span>, <span class="variable">$missingParams</span>)
            );
        }
        
        <span class="keyword">return</span> <span class="variable">$path</span>;
    }
    <span class="comment">    /**
     * Détecte l'URL de base automatiquement
     */</span>
    <span class="keyword">protected function</span> <span class="function">detectBaseUrl</span>(): <span class="keyword">string</span>
    {
        <span class="variable">$host</span> = <span class="variable">$_SERVER</span>[<span class="string">'HTTP_HOST'</span>] ?? <span class="string">'localhost'</span>;
        <span class="variable">$scriptName</span> = <span class="function">dirname</span>(<span class="variable">$_SERVER</span>[<span class="string">'SCRIPT_NAME'</span>]);
        <span class="variable">$basePath</span> = <span class="function">rtrim</span>(<span class="function">str_replace</span>(<span class="string">'\\'</span>, <span class="string">'/'</span>, <span class="variable">$scriptName</span>), <span class="string">'/'</span>);
        
        <span class="keyword">return</span> <span class="variable">$host</span> . <span class="variable">$basePath</span>;
    }
    <span class="comment">    /**
     * Ajoute des routes au générateur
     */</span>
    <span class="keyword">public function</span> <span class="function">addRoute</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="tag">Route</span> <span class="variable">$route</span>): <span class="keyword">void</span>
    {
        <span class="variable">$this</span>-><span class="property">routes</span>[<span class="variable">$name</span>] = <span class="variable">$route</span>;
    }
    <span class="comment">    /**
     * Génère une URL pour un asset (CSS, JS, images)
     */</span>
    <span class="keyword">public function</span> <span class="function">asset</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="keyword">bool</span> <span class="variable">$absolute</span> = <span class="keyword">false</span>): <span class="keyword">string</span>
    {
        <span class="variable">$url</span> = <span class="string">'/assets/'</span> . <span class="function">ltrim</span>(<span class="variable">$path</span>, <span class="string">'/'</span>);
        
        <span class="keyword">if</span> (<span class="variable">$absolute</span>) {
            <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">scheme</span> . <span class="string">'://'</span> . <span class="variable">$this</span>-><span class="property">baseUrl</span> . <span class="variable">$url</span>;
        }
        
        <span class="keyword">return</span> <span class="variable">$url</span>;
    }
    <span class="comment">    /**
     * Vérifie si une route existe
     */</span>
    <span class="keyword">public function</span> <span class="function">hasRoute</span>(<span class="keyword">string</span> <span class="variable">$name</span>): <span class="keyword">bool</span>
    {
        <span class="keyword">return</span> <span class="function">isset</span>(<span class="variable">$this</span>-><span class="property">routes</span>[<span class="variable">$name</span>]);
    }
    <span class="comment">    /**
     * Récupère toutes les routes nommées
     */</span>
    <span class="keyword">public function</span> <span class="function">getAllRoutes</span>(): <span class="keyword">array</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">routes</span>;
    }
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Intégration avec le routeur</div>
                    <div class="example-description">
                        <p>Cette partie du code montre comment intégrer le mécanisme des routes nommées au cœur du routeur. La classe <code>Router</code> est étendue pour stocker les routes avec leurs noms dans un tableau associatif <code>$namedRoutes</code>. La méthode <code>addRoute()</code> est modifiée pour retourner l'instance de <code>Route</code> créée, ce qui permet le chaînage de méthodes et notamment l'appel à la méthode <code>name()</code>. Ce pattern de conception permet d'ajouter des fonctionnalités aux routes de manière fluide et expressive. C'est une démonstration pratique de l'extension d'un système existant de manière à préserver la rétrocompatibilité tout en ajoutant de nouvelles capacités.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">class</span> <span class="tag">Router</span>
{
    <span class="keyword">protected</span> <span class="variable">$routes</span> = [];    <span class="keyword">protected</span> <span class="variable">$namedRoutes</span> = [];
    <span class="keyword">protected</span> <span class="variable">$urlGenerator</span>;
    
    <span class="comment">// ...existing code...</span>
    
    <span class="comment">/**
     * Modifie addRoute pour gérer les routes nommées
     */</span>
    <span class="keyword">protected function</span> <span class="function">addRoute</span>(<span class="keyword">string</span> <span class="variable">$method</span>, <span class="keyword">string</span> <span class="variable">$path</span>, <span class="variable">$callback</span>): Route
    {
        <span class="variable">$route</span> = <span class="keyword">new</span> Route(<span class="variable">$method</span>, <span class="variable">$path</span>, <span class="variable">$callback</span>);
        <span class="variable">$this</span>->routes[] = <span class="variable">$route</span>;
          <span class="keyword">return</span> <span class="variable">$route</span>;
    }
    
    <span class="comment">/**
     * Enregistre une route nommée
     */</span>
    <span class="keyword">public function</span> <span class="function">registerNamedRoute</span>(<span class="keyword">string</span> <span class="variable">$name</span>, Route <span class="variable">$route</span>): <span class="keyword">void</span>
    {
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$this</span>->namedRoutes[<span class="variable">$name</span>])) {
            <span class="keyword">throw new</span> \InvalidArgumentException(<span class="string">"Route '{</span><span class="variable">$name</span><span class="string">}' déjà définie"</span>);
        }
        
        <span class="variable">$this</span>->namedRoutes[<span class="variable">$name</span>] = <span class="variable">$route</span>;
        
        <span class="comment">// Ajoute la route au générateur d'URLs</span>
        <span class="variable">$this</span>->getUrlGenerator()->addRoute(<span class="variable">$name</span>, <span class="variable">$route</span>);
    }
    
    <span class="comment">/**
     * Récupère le générateur d'URLs
     */</span>    <span class="keyword">public function</span> <span class="function">getUrlGenerator</span>()<span class="operator">:</span> <span class="class">UrlGenerator</span>
    {
        <span class="keyword">if</span> (<span class="variable">$this</span><span class="operator">-></span><span class="property">urlGenerator</span> <span class="operator">===</span> <span class="keyword">null</span>) {
            <span class="variable">$this</span><span class="operator">-></span><span class="property">urlGenerator</span> <span class="operator">=</span> <span class="keyword">new</span> <span class="class">UrlGenerator</span>(<span class="variable">$this</span><span class="operator">-></span><span class="property">namedRoutes</span>);
        }
        
        <span class="keyword">return</span> <span class="variable">$this</span><span class="operator">-></span><span class="property">urlGenerator</span>;
    }
    <span class="comment">
    /**
     * Génère une URL à partir d'un nom de route (méthode raccourci)
     */</span>    <span class="keyword">public function</span> <span class="function">url</span>(<span class="class">string</span> <span class="variable">$name</span>, <span class="class">array</span> <span class="variable">$params</span> <span class="operator">=</span> [], <span class="class">array</span> <span class="variable">$query</span> <span class="operator">=</span> [])<span class="operator">:</span> <span class="class">string</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span><span class="operator">-></span><span class="function">getUrlGenerator</span>()<span class="operator">-></span><span class="function">route</span>(<span class="variable">$name</span>, <span class="variable">$params</span>, <span class="variable">$query</span>);
    }
    <span class="comment">
    /**
     * Récupère une route par son nom
     */</span>    <span class="keyword">public function</span> <span class="function">getRoute</span>(<span class="class">string</span> <span class="variable">$name</span>)<span class="operator">:</span> <span class="operator">?</span><span class="class">Route</span>
    {
        <span class="keyword">return</span> <span class="variable">$this</span><span class="operator">-></span><span class="property">namedRoutes</span>[<span class="variable">$name</span>] <span class="operator">??</span> <span class="keyword">null</span>;
    }
    <span class="comment">
    /**
     * Vérifie si une route nommée existe
     */</span>    <span class="keyword">public function</span> <span class="function">hasRoute</span>(<span class="class">string</span> <span class="variable">$name</span>)<span class="operator">:</span> <span class="class">bool</span>
    {
        <span class="keyword">return</span> <span class="function">isset</span>(<span class="variable">$this</span><span class="operator">-></span><span class="property">namedRoutes</span>[<span class="variable">$name</span>]);
    }
}
<span class="comment">
/**
 * Modification de la classe Route pour gérer les noms
 */</span>
<span class="keyword">class</span> <span class="class">Route</span>
{<span class="comment">
    // ...existing code...
    
    /**
     * Définit le nom de la route et l'enregistre dans le routeur
     */</span>
    <span class="keyword">public function</span> <span class="function">name</span>(<span class="class">string</span> <span class="variable">$name</span>)<span class="operator">:</span> <span class="class">self</span>
    {
        <span class="variable">$this</span><span class="operator">-></span><span class="property">name</span> <span class="operator">=</span> <span class="variable">$name</span>;
        <span class="comment">
        // Si on a accès au routeur, enregistre la route nommée</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$this</span><span class="operator">-></span><span class="property">router</span>)) {
            <span class="variable">$this</span><span class="operator">-></span><span class="property">router</span><span class="operator">-></span><span class="function">registerNamedRoute</span>(<span class="variable">$name</span>, <span class="variable">$this</span>);
        }
        
        <span class="keyword">return</span> <span class="variable">$this</span>;
    }
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Utilisation dans les vues et contrôleurs</div>
                    <div class="example-description">
                        <p>Cet exemple démontre l'utilisation pratique du générateur d'URL dans un contrôleur. Le routeur est injecté dans le contrôleur via le constructeur, ce qui permet d'accéder facilement à toutes ses fonctionnalités. La méthode <code>url()</code> du routeur est utilisée pour générer dynamiquement l'URL vers la page de détail d'un utilisateur après sa création. Cette approche présente plusieurs avantages : elle évite de coder en dur les chemins d'URL, permet de modifier la structure des URLs sans impacter le code, et automatise la génération des URLs avec paramètres en remplaçant les segments dynamiques par les valeurs correspondantes (ici l'ID de l'utilisateur).</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Dans un contrôleur</span>
<span class="keyword">class</span> <span class="tag">UserController</span>
{    <span class="keyword">protected</span> <span class="variable">$router</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(Router <span class="variable">$router</span>)
    {
        <span class="variable">$this</span>->router = <span class="variable">$router</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">store</span>(<span class="variable">$request</span>)
    {
        <span class="comment">// Logique de création de l'utilisateur...</span>
          <span class="variable">$user</span> = <span class="variable">$this</span><span class="operator">-></span><span class="property">userRepository</span><span class="operator">-></span><span class="function">create</span>(<span class="variable">$validatedData</span>);
        <span class="comment">
        // Redirection vers la page de l'utilisateur créé</span>
        <span class="variable">$redirectUrl</span> = <span class="variable">$this</span><span class="operator">-></span><span class="property">router</span><span class="operator">-></span><span class="function">url</span>(<span class="string">'users.show'</span>, [<span class="string">'id'</span> <span class="operator">=></span> <span class="variable">$user</span><span class="operator">-></span><span class="property">id</span>]);
        
        <span class="keyword">return new</span> <span class="class">RedirectResponse</span>(<span class="variable">$redirectUrl</span>, [
            <span class="string">'success'</span> <span class="operator">=></span> <span class="string">'Utilisateur créé avec succès'</span>
        ]);
    }
      <span class="keyword">public function</span> <span class="function">edit</span>(<span class="variable">$request</span>)    {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="property">userRepository</span>-><span class="function">find</span>(<span class="variable">$request</span>-><span class="property">params</span>[<span class="string">'id'</span>]);
        
        <span class="comment">// Génération d'URLs pour la vue</span>
        <span class="variable">$urls</span> = [
            <span class="string">'update'</span> => <span class="variable">$this</span>-><span class="variable">router</span>-><span class="function">url</span>(<span class="string">'users.update'</span>, [<span class="string">'id'</span> => <span class="variable">$user</span>-><span class="variable">id</span>]),
            <span class="string">'show'</span> => <span class="variable">$this</span>-><span class="variable">router</span>-><span class="function">url</span>(<span class="string">'users.show'</span>, [<span class="string">'id'</span> => <span class="variable">$user</span>-><span class="variable">id</span>]),
            <span class="string">'index'</span> => <span class="variable">$this</span>-><span class="variable">router</span>-><span class="function">url</span>(<span class="string">'users.index'</span>)
        ];
        
        <span class="keyword">return new</span> <span class="tag">View</span>(<span class="string">'users/edit'</span>, [
            <span class="string">'user'</span> => <span class="variable">$user</span>,
            <span class="string">'urls'</span> => <span class="variable">$urls</span>
        ]);
    }
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Helper global pour les vues</div>
                    <div class="example-description">
                        <p>Pour simplifier l'accès aux fonctionnalités du routeur dans les vues, ce code met en place un système de fonctions helpers globales. Une variable globale <code>$globalRouter</code> est utilisée pour stocker l'instance du routeur, et la fonction <code>setGlobalRouter()</code> permet d'initialiser cette instance. Cette approche présente l'avantage de rendre les fonctionnalités du routeur facilement accessibles depuis n'importe quel template sans avoir à passer explicitement l'instance du routeur. Les helpers globaux comme <code>route()</code>, <code>url()</code> ou <code>is_current_route()</code> sont particulièrement utiles dans les templates où l'on cherche à garder un code concis et lisible.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Fonction helper globale (à inclure dans functions.php)</span>

<span class="comment">/**
 * Instance globale du routeur
 */</span>
<span class="variable">$globalRouter</span> = <span class="keyword">null</span>;
<span class="comment">
/**
 * Définit le routeur global */</span>
<span class="keyword">function</span> <span class="function">setGlobalRouter</span>(Router <span class="variable">$router</span>): <span class="keyword">void</span>
{
    <span class="keyword">global</span> <span class="variable">$globalRouter</span>;
    <span class="variable">$globalRouter</span> = <span class="variable">$router</span>;
}

<span class="comment">/**
 * Génère une URL à partir d'un nom de route
 */</span>
<span class="keyword">function</span> <span class="function">route</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">array</span> <span class="variable">$params</span> = [], <span class="keyword">array</span> <span class="variable">$query</span> = []): <span class="keyword">string</span>
{
    <span class="keyword">global</span> <span class="variable">$globalRouter</span>;
    
    <span class="keyword">if</span> (<span class="variable">$globalRouter</span> === <span class="keyword">null</span>) {
        <span class="keyword">throw new</span> \RuntimeException(<span class="string">'Router global non défini'</span>);
    }
    
    <span class="keyword">return</span> <span class="variable">$globalRouter</span>->url(<span class="variable">$name</span>, <span class="variable">$params</span>, <span class="variable">$query</span>);
}

<span class="comment">/**
 * Génère une URL absolue
 */</span>
<span class="keyword">function</span> <span class="function">route_absolute</span>(<span class="keyword">string</span> <span class="variable">$name</span>, <span class="keyword">array</span> <span class="variable">$params</span> = [], <span class="keyword">array</span> <span class="variable">$query</span> = []): <span class="keyword">string</span>
{
    <span class="keyword">global</span> <span class="variable">$globalRouter</span>;
    
    <span class="keyword">return</span> <span class="variable">$globalRouter</span>->getUrlGenerator()->routeAbsolute(<span class="variable">$name</span>, <span class="variable">$params</span>, <span class="variable">$query</span>);
}

<span class="comment">/**
 * Génère une URL d'asset
 */</span>
<span class="keyword">function</span> <span class="function">asset</span>(<span class="keyword">string</span> <span class="variable">$path</span>, <span class="keyword">bool</span> <span class="variable">$absolute</span> = <span class="keyword">false</span>): <span class="keyword">string</span>
{
    <span class="keyword">global</span> <span class="variable">$globalRouter</span>;
    
    <span class="keyword">return</span> <span class="variable">$globalRouter</span>->getUrlGenerator()->asset(<span class="variable">$path</span>, <span class="variable">$absolute</span>);
}

<span class="comment">/**
 * Vérifie si la route actuelle correspond au nom donné
 */</span>
<span class="keyword">function</span> <span class="function">is_current_route</span>(<span class="keyword">string</span> <span class="variable">$name</span>): <span class="keyword">bool</span>
{
    <span class="comment">// Cette fonction nécessiterait de stocker la route courante</span>
    <span class="comment">// dans une variable globale lors du dispatch</span>
    <span class="keyword">global</span> <span class="variable">$currentRoute</span>;
    
    <span class="keyword">return</span> <span class="variable">$currentRoute</span> && <span class="variable">$currentRoute</span>-><span class="function">getName</span>() === <span class="variable">$name</span>;
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Utilisation dans les templates HTML</div>
                    <div class="example-description">
                        <p>Cet exemple montre l'utilisation concrète des helpers de routage dans un template HTML. Le menu de navigation utilise <code>route()</code> pour générer dynamiquement les URLs des différentes sections du site, et <code>is_current_route()</code> pour ajouter une classe CSS "active" à l'élément correspondant à la page actuelle. Cette approche offre plusieurs avantages : le code est plus lisible et concis, les URLs sont générées dynamiquement (évitant les erreurs de frappe ou les liens cassés lors de modifications), et la navigation active est gérée automatiquement. Le même principe peut s'appliquer aux formulaires, boutons et autres liens à travers l'application, garantissant une cohérence dans la génération des URLs.</p>
                    </div>
                    <div class="example-content">
                        <pre><code class="language-html"><span class="comment"><!-- Exemple d'utilisation dans une vue HTML --></span>
<span class="tag">&lt;nav</span> <span class="variable">class</span>=<span class="string">"main-navigation"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;ul&gt;</span>
        <span class="tag">&lt;li</span> <span class="variable">class</span>=<span class="string">"&lt;?= is_current_route('home') ? 'active' : '' ?&gt;"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('home') ?&gt;"</span><span class="tag">&gt;</span>Accueil<span class="tag">&lt;/a&gt;</span>
        <span class="tag">&lt;/li&gt;</span>
        <span class="tag">&lt;li</span> <span class="variable">class</span>=<span class="string">"&lt;?= is_current_route('blog.index') ? 'active' : '' ?&gt;"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('blog.index') ?&gt;"</span><span class="tag">&gt;</span>Blog<span class="tag">&lt;/a&gt;</span>
        <span class="tag">&lt;/li&gt;</span>
        <span class="tag">&lt;li</span> <span class="variable">class</span>=<span class="string">"&lt;?= is_current_route('about') ? 'active' : '' ?&gt;"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('about') ?&gt;"</span><span class="tag">&gt;</span>À propos<span class="tag">&lt;/a&gt;</span>
        <span class="tag">&lt;/li&gt;</span>
        <span class="tag">&lt;li</span> <span class="variable">class</span>=<span class="string">"&lt;?= is_current_route('contact') ? 'active' : '' ?&gt;"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('contact') ?&gt;"</span><span class="tag">&gt;</span>Contact<span class="tag">&lt;/a&gt;</span>
        <span class="tag">&lt;/li&gt;</span>
    <span class="tag">&lt;/ul&gt;</span>
<span class="tag">&lt;/nav&gt;</span>

<span class="comment"><!-- Formulaire avec action générée --></span>
<span class="tag">&lt;form</span> <span class="variable">method</span>=<span class="string">"POST"</span> <span class="variable">action</span>=<span class="string">"&lt;?= route('contact.submit') ?&gt;"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;label&gt;</span>Nom:
        <span class="tag">&lt;input</span> <span class="variable">type</span>=<span class="string">"text"</span> <span class="variable">name</span>=<span class="string">"name"</span> <span class="variable">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/label&gt;</span>
      <span class="tag">&lt;label&gt;</span>Email:
        <span class="tag">&lt;input</span> <span class="variable">type</span>=<span class="string">"email"</span> <span class="variable">name</span>=<span class="string">"email"</span> <span class="variable">required</span><span class="tag">&gt;</span>
    <span class="tag">&lt;/label&gt;</span>
    
    <span class="tag">&lt;label&gt;</span>Message:
        <span class="tag">&lt;textarea</span> <span class="variable">name</span>=<span class="string">"message"</span> <span class="variable">required</span><span class="tag">&gt;&lt;/textarea&gt;</span>
    <span class="tag">&lt;/label&gt;</span>
    
    <span class="tag">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>Envoyer<span class="tag">&lt;/button&gt;</span>
<span class="tag">&lt;/form&gt;</span>

<span class="comment"><!-- Liste d'utilisateurs avec liens --></span>
<span class="tag">&lt;div</span> <span class="variable">class</span>=<span class="string">"user-list"</span><span class="tag">&gt;</span>    &lt;?php foreach ($users as $user): ?&gt;
        <span class="tag">&lt;div</span> <span class="variable">class</span>=<span class="string">"user-card"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;h3&gt;</span><span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('users.show', ['id' => $user->id]) ?&gt;"</span><span class="tag">&gt;</span>
                &lt;?= htmlspecialchars($user->name) ?&gt;
            <span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/h3&gt;</span>
            
            <span class="tag">&lt;p&gt;</span>&lt;?= htmlspecialchars($user->email) ?&gt;<span class="tag">&lt;/p&gt;</span>
            
            <span class="tag">&lt;div</span> <span class="variable">class</span>=<span class="string">"actions"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('users.edit', ['id' => $user->id]) ?&gt;"</span> <span class="variable">class</span>=<span class="string">"btn btn-primary"</span><span class="tag">&gt;</span>Modifier<span class="tag">&lt;/a&gt;</span>
                
                <span class="tag">&lt;form</span> <span class="variable">method</span>=<span class="string">"POST"</span> <span class="variable">action</span>=<span class="string">"&lt;?= route('users.destroy', ['id' => $user->id]) ?&gt;"</span> <span class="variable">style</span>=<span class="string">"display: inline;"</span><span class="tag">&gt;</span>
                    <span class="tag">&lt;input</span> <span class="variable">type</span>=<span class="string">"hidden"</span> <span class="variable">name</span>=<span class="string">"_method"</span> <span class="variable">value</span>=<span class="string">"DELETE"</span><span class="tag">&gt;</span>                    <span class="tag">&lt;button</span> <span class="variable">type</span>=<span class="string">"submit"</span> <span class="variable">class</span>=<span class="string">"btn btn-danger"</span> <span class="variable">onclick</span>=<span class="string">"return confirm('Êtes-vous sûr ?')"</span><span class="tag">&gt;</span>
                        Supprimer                    <span class="tag">&lt;/button&gt;</span>                <span class="tag">&lt;/form&gt;</span>
            <span class="tag">&lt;/div&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
    <span class="comment"><!-- BOUCLE: fin de la liste des utilisateurs --></span>
<span class="tag">&lt;/div&gt;</span>

<span class="comment"><!-- Pagination avec paramètres --></span>
<span class="tag">&lt;div</span> <span class="variable">class</span>=<span class="string">"pagination"</span><span class="tag">&gt;</span>
    <span class="comment"><!-- PHP: if ($currentPage > 1): --></span>
        <span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('users.index', [], ['page' => $currentPage - 1]) ?&gt;"</span><span class="tag">&gt;</span>« Précédent<span class="tag">&lt;/a&gt;</span>
    <span class="comment"><!-- PHP: endif; --></span>
    
    Page <span class="tag">&lt;?=</span> <span class="variable">$currentPage</span> <span class="tag">?&gt;</span> sur <span class="tag">&lt;?=</span> <span class="variable">$totalPages</span> <span class="tag">?&gt;</span>
    
    <span class="comment"><!-- PHP: if ($currentPage < $totalPages): --></span>
        <span class="tag">&lt;a</span> <span class="variable">href</span>=<span class="string">"&lt;?= route('users.index', [], ['page' => $currentPage + 1]) ?&gt;"</span><span class="tag">&gt;</span>Suivant »<span class="tag">&lt;/a&gt;</span>
    <span class="comment"><!-- PHP: endif; --></span>
<span class="tag">&lt;/div&gt;</span>

<span class="comment"><!-- Inclusion d'assets --></span>
<span class="tag">&lt;link</span> <span class="variable">rel</span>=<span class="string">"stylesheet"</span> <span class="variable">href</span>=<span class="string">"&lt;?= asset('css/main.css') ?&gt;"</span><span class="tag">&gt;</span>
<span class="tag">&lt;script</span> <span class="variable">src</span>=<span class="string">"&lt;?= asset('js/app.js') ?&gt;"</span><span class="tag">&gt;&lt;/script&gt;</span>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <h3>Avantages des routes nommées</h3>
                <p>Le système de routes nommées apporte de nombreux bénéfices :</p>
                <ul>
                    <li><strong>Maintenance facilitée</strong> : Modifier une URL ne nécessite que de changer la définition de route</li>
                    <li><strong>Refactoring sûr</strong> : Les IDE peuvent détecter les utilisations d'une route nommée</li>
                    <li><strong>Évite les erreurs</strong> : Plus de risque d'erreur de frappe dans les URLs</li>
                    <li><strong>Auto-complétion</strong> : Les IDE peuvent proposer l'auto-complétion des noms de routes</li>
                    <li><strong>Documentation vivante</strong> : Les noms de routes documentent l'intention</li>
                    <li><strong>URLs cohérentes</strong> : Assure la cohérence du format des URLs dans toute l'application</li>
                    <li><strong>Environnements multiples</strong> : S'adapte automatiquement selon l'environnement</li>
                </ul>
            </div>

            <div class="info-box">
                <h3>Conventions de nommage des routes</h3>
                <p>Adoptez des conventions claires pour nommer vos routes :</p>
                <ul>
                    <li><strong>Format ressource.action</strong> : <code>users.index</code>, <code>users.show</code>, <code>users.create</code></li>
                    <li><strong>Actions CRUD standard</strong> :
                        <ul>
                            <li><code>index</code> - Liste des ressources</li>
                            <li><code>show</code> - Affichage d'une ressource</li>
                            <li><code>create</code> - Formulaire de création</li>
                            <li><code>store</code> - Traitement de la création</li>
                            <li><code>edit</code> - Formulaire d'édition</li>
                            <li><code>update</code> - Traitement de la mise à jour</li>
                            <li><code>destroy</code> - Suppression</li>
                        </ul>
                    </li>
                    <li><strong>Hiérarchie</strong> : <code>admin.users.index</code> pour les routes d'administration</li>
                    <li><strong>API</strong> : <code>api.v1.users.show</code> pour les routes d'API</li>
                    <li><strong>Cohérence</strong> : Utilisez toujours le même format dans toute l'application</li>
                </ul>
            </div>
        </section>
    </main>

    <div class="navigation">
        <a href="23-composer-autoloading.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a class="nav-button" style="visibility: hidden;">Module suivant →</a>
    </div>

    <footer>
        <p>&copy; Tutoriel PHP - Tous droits réservés</p>
    </footer>


<?php include __DIR__ . '/../includes/footer.php'; ?>