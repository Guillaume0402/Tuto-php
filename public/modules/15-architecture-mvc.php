<?php include __DIR__ . '/../includes/header.php'; ?>


<body class="module15">
    <header>
        <h1>Architecture MVC en PHP</h1>
        <p class="subtitle">Structurez vos applications PHP complexes grâce au pattern Model-View-Controller</p>
    </header>
    <div class="navigation">
        <a href="14-securite.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="16-api-externes.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction au pattern MVC</h2>
            <p><strong>MVC</strong> signifie <strong>Modèle-Vue-Contrôleur</strong> (Model-View-Controller). C'est un design pattern architectural qui sépare une application en trois composants principaux :</p>

            <div class="mvc-diagram">
                <div class="mvc-component model">
                    <h4>Modèle (Model)</h4>
                    <p>Gère les données et la logique métier de l'application</p>
                </div>
                <div class="mvc-component controller">
                    <h4>Contrôleur (Controller)</h4>
                    <p>Traite les requêtes utilisateur et coordonne l'application</p>
                </div>
                <div class="mvc-component view">
                    <h4>Vue (View)</h4>
                    <p>Gère l'affichage et l'interface utilisateur</p>
                </div>
            </div>

            <p>Cette séparation claire permet une meilleure organisation du code, facilite la maintenance et favorise la réutilisation. Le pattern MVC est devenu la norme pour le développement d'applications web complexes.</p>

            <div class="info-box">
                <p><strong>Histoire du MVC :</strong> Né dans les années 1970 pour le langage Smalltalk, le pattern MVC est aujourd'hui l'un des designs patterns les plus utilisés dans le développement web. Il a fait ses preuves dans de nombreux frameworks comme Laravel, Symfony, CodeIgniter, mais aussi dans d'autres environnements comme Django (Python) ou Ruby on Rails.</p>
            </div>

            <h3>Détails des trois composants</h3>

            <h4>Le Modèle (Model)</h4>
            <p>Le modèle est responsable de la gestion des données de l'application. Il encapsule la logique métier et l'accès aux données, que ce soit une base de données, une API ou un autre service. Les principales responsabilités du modèle sont :</p>
            <ul>
                <li>Accéder aux données (lire/écrire dans la base de données)</li>
                <li>Appliquer les règles métier et les validations</li>
                <li>Traiter les données avant de les envoyer au contrôleur</li>
                <li>Gérer l'état des données de l'application</li>
            </ul>
            <div class="example-box">
                <h5>Exemple d'un modèle simple</h5>
                <pre><code>
<span class="comment">// models/ArticleModel.php</span>
<span class="keyword">class</span> <span class="class">ArticleModel</span> {
    <span class="keyword">private</span> <span class="variable">$db</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$dbConnection</span>) {
        <span class="variable">$this->db</span> = <span class="variable">$dbConnection</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">getAllArticles</span>() {
        <span class="variable">$query</span> = <span class="string">"SELECT * FROM articles ORDER BY created_at DESC"</span>;
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$query</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
      <span class="keyword">public function</span> <span class="function">getArticleById</span>(<span class="variable">$id</span>) {
        <span class="variable">$query</span> = <span class="string">"SELECT * FROM articles WHERE id = :id"</span>;
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$query</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':id'</span>, <span class="variable">$id</span>, <span class="class">PDO</span>::<span class="constant">PARAM_INT</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetch</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
    
    <span class="keyword">public function</span> <span class="function">createArticle</span>(<span class="variable">$title</span>, <span class="variable">$content</span>, <span class="variable">$userId</span>) {
        <span class="variable">$query</span> = <span class="string">"INSERT INTO articles (title, content, user_id, created_at) 
                VALUES (:title, :content, :user_id, NOW())"</span>;
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$query</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':title'</span>, <span class="variable">$title</span>, <span class="class">PDO</span>::<span class="constant">PARAM_STR</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':content'</span>, <span class="variable">$content</span>, <span class="class">PDO</span>::<span class="constant">PARAM_STR</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':user_id'</span>, <span class="variable">$userId</span>, <span class="class">PDO</span>::<span class="constant">PARAM_INT</span>);
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">execute</span>();
    }
}
</code></pre>
                <p><strong>Explication :</strong> Ce modèle <code>ArticleModel</code> gère tout ce qui concerne les articles dans notre application. Il contient des méthodes pour récupérer tous les articles, obtenir un article spécifique par son ID, et créer un nouvel article. Notez que le modèle ne fait que gérer les données - il ne s'occupe pas de l'affichage ni des décisions sur ce qu'il faut afficher.</p>
            </div>

            <h4>La Vue (View)</h4>
            <p>La vue est responsable de l'affichage des données à l'utilisateur. Elle représente l'interface utilisateur de l'application. Les principales responsabilités de la vue sont :</p>
            <ul>
                <li>Présenter les données au format approprié</li>
                <li>Recevoir les données du contrôleur et les afficher</li>
                <li>Gérer la mise en page et l'apparence</li>
                <li>Ne contenir que le minimum de logique nécessaire à l'affichage</li>
            </ul>

            <div class="example-box">
                <h5>Exemple d'une vue simple</h5>
                <pre><code>
<span class="comment">&lt;!-- views/articles/index.php --&gt;</span>
<span class="tag">&lt;!DOCTYPE html&gt;</span>
<span class="tag">&lt;html&gt;</span>
<span class="tag">&lt;head&gt;</span>
    <span class="tag">&lt;title&gt;</span>Liste des articles<span class="tag">&lt;/title&gt;</span>
    <span class="tag">&lt;link</span> <span class="attr">rel</span>=<span class="string">"stylesheet"</span> <span class="attr">href</span>=<span class="string">"/css/style.css"</span><span class="tag">&gt;</span>
<span class="tag">&lt;/head&gt;</span>
<span class="tag">&lt;body&gt;</span>
    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"container"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;h1&gt;</span>Nos articles<span class="tag">&lt;/h1&gt;</span>
        
        <span class="tag">&lt;?php</span> <span class="keyword">if</span>(<span class="function">empty</span>(<span class="variable">$articles</span>)): <span class="tag">?&gt;</span>
            <span class="tag">&lt;p&gt;</span>Aucun article disponible pour le moment.<span class="tag">&lt;/p&gt;</span>
        <span class="tag">&lt;?php</span> <span class="keyword">else</span>: <span class="tag">?&gt;</span>
            <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"articles"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">foreach</span>(<span class="variable">$articles</span> <span class="keyword">as</span> <span class="variable">$article</span>): <span class="tag">?&gt;</span>
                    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"article"</span><span class="tag">&gt;</span>                        <span class="tag">&lt;h2&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/article/view/</span><span class="tag">&lt;?=</span> <span class="variable">$article</span>[<span class="string">'id'</span>] <span class="tag">?&gt;</span><span class="string">"</span><span class="tag">&gt;</span>
                            <span class="tag">&lt;?=</span> <span class="function">htmlspecialchars</span>(<span class="variable">$article</span>[<span class="string>'title'</span>]) <span class="tag">?&gt;</span>
                        <span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/h2&gt;</span>
                        <span class="tag">&lt;p</span> <span class="attr">class</span>=<span class="string">"date"</span><span class="tag">&gt;</span>Publié le <span class="tag">&lt;?=</span> <span class="function">date</span>(<span class="string">'d/m/Y'</span>, <span class="function">strtotime</span>(<span class="variable">$article</span>[<span class="string>'created_at'</span>])) <span class="tag">?&gt;</span><span class="tag">&lt;/p&gt;</span>
                        <span class="tag">&lt;p&gt;</span><span class="tag">&lt;?=</span> <span class="function">substr</span>(<span class="function">htmlspecialchars</span>(<span class="variable">$article</span>[<span class="string">'content'</span>]), 0, 200) <span class="tag">?&gt;</span>...<span class="tag">&lt;/p&gt;</span>
                        <span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/article/view/</span><span class="tag">&lt;?=</span> <span class="variable">$article</span>[<span class="string">'id'</span>] <span class="tag">?&gt;</span><span class="string">"</span> <span class="attr">class</span>=<span class="string">"read-more"</span><span class="tag">&gt;</span>Lire la suite<span class="tag">&lt;/a&gt;</span>
                    <span class="tag">&lt;/div&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">endforeach</span>; <span class="tag">?&gt;</span>
            <span class="tag">&lt;/div&gt;</span>
        <span class="tag">&lt;?php</span> <span class="keyword">endif</span>; <span class="tag">?&gt;</span>
    <span class="tag">&lt;/div&gt;</span>
<span class="tag">&lt;/body&gt;</span>
<span class="tag">&lt;/html&gt;</span>
</code></pre>
                <p><strong>Explication :</strong> Cette vue affiche une liste d'articles. Elle reçoit un tableau <code>$articles</code> du contrôleur et boucle à travers chaque article pour l'afficher. Notez l'utilisation de <code>htmlspecialchars()</code> pour échapper les données et éviter les failles XSS. La vue ne contient que la logique minimale nécessaire à l'affichage (comme la boucle foreach et la condition if).</p>
            </div>

            <h4>Le Contrôleur (Controller)</h4>
            <p>Le contrôleur sert d'intermédiaire entre le modèle et la vue. Il répond aux actions de l'utilisateur, interagit avec le modèle pour obtenir ou mettre à jour les données, puis sélectionne la vue appropriée. Les principales responsabilités du contrôleur sont :</p>
            <ul>
                <li>Recevoir et traiter les requêtes utilisateur</li>
                <li>Interagir avec le modèle pour obtenir ou manipuler les données</li>
                <li>Choisir la vue appropriée et lui transmettre les données</li>
                <li>Gérer la logique de navigation et le workflow de l'application</li>
            </ul>

            <div class="example-box">
                <h5>Exemple d'un contrôleur simple</h5>
                <pre><code>
<span class="comment">// controllers/ArticleController.php</span>
<span class="keyword">class</span> <span class="class">ArticleController</span> {
    <span class="keyword">private</span> <span class="variable">$articleModel</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$dbConnection</span>) {
        <span class="comment">// Initialiser le modèle avec la connexion à la BD</span>
        <span class="variable">$this->articleModel</span> = <span class="keyword">new</span> <span class="class">ArticleModel</span>(<span class="variable">$dbConnection</span>);
    }
    
    <span class="comment">// Afficher la liste des articles</span>
    <span class="keyword">public function</span> <span class="function">index</span>() {
        <span class="comment">// Récupérer tous les articles via le modèle</span>
        <span class="variable">$articles</span> = <span class="variable">$this->articleModel</span>-><span class="function">getAllArticles</span>();
        
        <span class="comment">// Charger la vue avec les données</span>
        <span class="keyword">require_once</span> <span class="string">'views/articles/index.php'</span>;
    }
      <span class="comment">// Afficher un article spécifique</span>
    <span class="keyword">public function</span> <span class="function">view</span>(<span class="variable">$id</span>) {
        <span class="comment">// Récupérer l'article par son ID</span>
        <span class="variable">$article</span> = <span class="variable">$this</span>-><span class="variable">articleModel</span>-><span class="function">getArticleById</span>(<span class="variable">$id</span>);
        
        <span class="keyword">if</span> (!<span class="variable">$article</span>) {
            <span class="comment">// Article non trouvé, afficher une erreur</span>
            <span class="function">header</span>(<span class="string">"HTTP/1.0 404 Not Found"</span>);
            <span class="keyword">require_once</span> <span class="string">'views/errors/404.php'</span>;
            <span class="keyword">return</span>;
        }
        
        <span class="comment">// Charger la vue de l'article avec les données</span>
        <span class="keyword">require_once</span> <span class="string">'views/articles/view.php'</span>;
    }
    
    <span class="comment">// Afficher le formulaire de création d'article</span>
    <span class="keyword">public function</span> <span class="function">create</span>() {
        <span class="comment">// Vérifier si l'utilisateur est connecté</span>
        <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>])) {
            <span class="comment">// Rediriger vers la page de connexion</span>
            <span class="function">header</span>(<span class="string">'Location: /login'</span>);
            <span class="keyword">exit</span>;
        }
        
        <span class="comment">// Charger la vue du formulaire</span>
        <span class="keyword">require_once</span> <span class="string">'views/articles/create.php'</span>;
    }
    
    <span class="comment">// Traiter la soumission du formulaire de création</span>
    <span class="keyword">public function</span> <span class="function">store</span>() {
        <span class="comment">// Vérifier si l'utilisateur est connecté</span>
        <span class="keyword">if</span> (!<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>])) {
            <span class="function">header</span>(<span class="string">'Location: /login'</span>);
            <span class="keyword">exit</span>;
        }
        
        <span class="comment">// Valider et nettoyer les données</span>
        <span class="variable">$title</span> = <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'title'</span>] ?? <span class="string">''</span>);
        <span class="variable">$content</span> = <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'content'</span>] ?? <span class="string">''</span>);
        <span class="variable">$userId</span> = <span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>];
        
        <span class="comment">// Validation basique</span>
        <span class="variable">$errors</span> = [];
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$title</span>)) {
            <span class="variable">$errors</span>[<span class="string">'title'</span>] = <span class="string">"Le titre est obligatoire."</span>;
        }
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$content</span>)) {
            <span class="variable">$errors</span>[<span class="string">'content'</span>] = <span class="string">"Le contenu est obligatoire."</span>;
        }
        
        <span class="comment">// S'il y a des erreurs, réafficher le formulaire</span>
        <span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$errors</span>)) {
            <span class="variable">$_SESSION</span>[<span class="string">'errors'</span>] = <span class="variable">$errors</span>;
            <span class="variable">$_SESSION</span>[<span class="string">'form_data'</span>] = [<span class="string">'title'</span> => <span class="variable">$title</span>, <span class="string">'content'</span> => <span class="variable">$content</span>];
            <span class="function">header</span>(<span class="string">'Location: /article/create'</span>);
            <span class="keyword">exit</span>;
        }
        
        <span class="comment">// Créer l'article via le modèle</span>
        <span class="keyword">if</span> (<span class="variable">$this</span>-><span class="variable">articleModel</span>-><span class="function">createArticle</span>(<span class="variable">$title</span>, <span class="variable">$content</span>, <span class="variable">$userId</span>)) {
            <span class="variable">$_SESSION</span>[<span class="string">'success'</span>] = <span class="string">"Article créé avec succès!"</span>;
            <span class="function">header</span>(<span class="string">'Location: /articles'</span>);
        } <span class="keyword">else</span> {
            <span class="variable">$_SESSION</span>[<span class="string">'errors'</span>] = [<span class="string">'db'</span> => <span class="string">"Erreur lors de la création de l'article."</span>];
            <span class="function">header</span>(<span class="string">'Location: /article/create'</span>);
        }
        <span class="keyword">exit</span>;
    }
}
</code></pre>
                <p><strong>Explication :</strong> Ce contrôleur gère toutes les actions liées aux articles. La méthode <code>index()</code> affiche tous les articles, <code>view()</code> affiche un article spécifique, <code>create()</code> montre le formulaire de création, et <code>store()</code> traite la soumission du formulaire. Notez que le contrôleur coordonne le flux : il récupère des données du modèle et les transmet à la vue.</p>
            </div>
        </section>
        <section class="section">
            <h2>Flux d'une requête dans l'architecture MVC</h2>
            <p>Voici comment une requête typique traverse une application MVC :</p>

            <ol class="process-steps">
                <li><strong>1. L'utilisateur interagit avec l'interface</strong> (ex: clique sur un lien "Voir l'article")</li>
                <li><strong>2. La requête arrive au point d'entrée</strong> (généralement index.php)</li>
                <li><strong>3. Le routeur analyse l'URL</strong> et détermine quel contrôleur et quelle action appeler</li>
                <li><strong>4. Le contrôleur est instancié</strong> et la méthode appropriée est appelée</li>
                <li><strong>5. Le contrôleur interagit avec le modèle</strong> pour récupérer ou manipuler des données</li>
                <li><strong>6. Le modèle effectue des opérations sur les données</strong> (requêtes SQL, validations, etc.)</li>
                <li><strong>7. Le modèle renvoie les données au contrôleur</strong></li>
                <li><strong>8. Le contrôleur prépare les données pour la vue</strong> et sélectionne la vue appropriée</li>
                <li><strong>9. La vue reçoit les données et génère le HTML</strong></li>
                <li><strong>10. Le HTML final est renvoyé au navigateur</strong> de l'utilisateur</li>
            </ol>

            <div class="diagram">
                <img src="../assets/img/mvc-flow.png" alt="Flux d'une requête MVC" onerror="this.style.display='none'">
                <p class="caption">Diagramme du flux d'une requête dans l'architecture MVC</p>
            </div>

            <h3>Pourquoi utiliser MVC ?</h3>
            <ul>
                <li><strong>Séparation des préoccupations :</strong> Chaque composant a un rôle distinct et bien défini</li>
                <li><strong>Organisation du code :</strong> Structure claire qui facilite la navigation et la compréhension du code</li>
                <li><strong>Maintenance simplifiée :</strong> Modification d'un aspect sans affecter les autres parties</li>
                <li><strong>Développement parallèle :</strong> Plusieurs développeurs peuvent travailler sur différentes parties simultanément</li>
                <li><strong>Testabilité :</strong> Les composants isolés sont plus faciles à tester</li>
                <li><strong>Réutilisabilité :</strong> Les modèles et vues peuvent être réutilisés dans différentes parties de l'application</li>
            </ul>
        </section>
        <section class="section">
            <h2>Structure d'un projet MVC en PHP</h2>
            <p>Une structure bien organisée est essentielle pour un projet MVC. Voici une structure recommandée :</p>
            <div class="file-structure">
                my-project/
                ├── app/ # Code de l'application
                │ ├── controllers/ # Contrôleurs
                │ ├── models/ # Modèles
                │ ├── views/ # Vues
                │ │ ├── layouts/ # Templates principaux
                │ │ └── partials/ # Éléments de vues réutilisables
                │ └── helpers/ # Fonctions d'assistance
                ├── config/ # Configuration (BD, environnement, etc.)
                ├── public/ # Point d'entrée et fichiers publics
                │ ├── css/ # Feuilles de style
                │ ├── js/ # JavaScript
                │ ├── images/ # Images
                │ └── index.php # Point d'entrée unique (Front Controller)
                ├── routes/ # Définition des routes
                ├── vendor/ # Bibliothèques externes (via Composer)
                └── .htaccess # Règles de réécriture d'URL
            </div>
            <p><strong>Explication :</strong> Cette structure sépare clairement les différentes parties de l'application. Le dossier <code>app</code> contient tout le code propre à l'application, tandis que <code>public</code> est le seul dossier accessible directement par le navigateur, ce qui augmente la sécurité.</p>
            <section class="section">
                <h2>Le routeur et le Front Controller</h2>
                <p>Dans une architecture MVC, le <strong>routeur</strong> est responsable de diriger les requêtes HTTP vers les contrôleurs appropriés. Le <strong>Front Controller</strong> est un point d'entrée unique qui initialise l'application et utilise le routeur pour traiter les requêtes.</p>

                <h3>Front Controller (Point d'entrée unique)</h3>
                <div class="example-box">
                    <h5>Exemple de Front Controller - public/index.php</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="comment">// Définir le chemin de base</span>
<span class="function">define</span>(<span class="string">'ROOT'</span>, <span class="function">dirname</span>(<span class="constant">__DIR__</span>));

<span class="comment">// Chargement de l'autoloader (si vous utilisez Composer)</span>
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/vendor/autoload.php'</span>;

<span class="comment">// Chargement des configurations</span>
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/config/config.php'</span>;
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/config/database.php'</span>;
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/helpers/functions.php'</span>;

<span class="comment">// Initialiser la session</span>
<span class="function">session_start</span>();

<span class="comment">// Créer la connexion à la base de données</span>
<span class="variable">$db</span> = <span class="keyword">new</span> <span class="class">PDO</span>(
    <span class="string">"mysql:host="</span> . <span class="constant">DB_HOST</span> . <span class="string">";dbname="</span> . <span class="constant">DB_NAME</span> . <span class="string">";charset=utf8"</span>,
    <span class="constant">DB_USER</span>,
    <span class="constant">DB_PASS</span>,
    [<span class="class">PDO</span>::<span class="constant">ATTR_ERRMODE</span> => <span class="class">PDO</span>::<span class="constant">ERRMODE_EXCEPTION</span>]
);

<span class="comment">// Instancier et exécuter le routeur</span>
<span class="variable">$router</span> = <span class="keyword">new</span> <span class="class">Router</span>(<span class="variable">$db</span>);
<span class="variable">$router</span>-><span class="function">dispatch</span>();
<span class="tag">?&gt;</span>
</code></pre>
                    <p><strong>Explication :</strong> Le Front Controller est le premier fichier exécuté pour chaque requête. Il initialise l'environnement de l'application (configuration, base de données, sessions), puis instancie le routeur qui va s'occuper de diriger la requête vers le bon contrôleur. C'est un point central qui simplifie la gestion des requêtes.</p>
                </div>

                <h3>Implémentation d'un routeur</h3>
                <div class="example-box">
                    <h5>Exemple d'un routeur simple - app/Router.php</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">class</span> <span class="class">Router</span> {
    <span class="keyword">private</span> <span class="variable">$routes</span> = [];
    <span class="keyword">private</span> <span class="variable">$db</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$dbConnection</span>) {
        <span class="variable">$this->db</span> = <span class="variable">$dbConnection</span>;
        
        <span class="comment">// Définir les routes (format: 'URL' => ['Contrôleur', 'méthode'])</span>
        <span class="variable">$this->routes</span> = [
            <span class="string">'/'</span> => [<span class="string">'HomeController'</span>, <span class="string">'index'</span>],
            <span class="string">'/articles'</span> => [<span class="string">'ArticleController'</span>, <span class="string">'index'</span>],
            <span class="string">'/article/view'</span> => [<span class="string">'ArticleController'</span>, <span class="string">'view'</span>],
            <span class="string">'/article/create'</span> => [<span class="string">'ArticleController'</span>, <span class="string">'create'</span>],
            <span class="string">'/article/store'</span> => [<span class="string">'ArticleController'</span>, <span class="string">'store'</span>],
            <span class="string">'/login'</span> => [<span class="string">'AuthController'</span>, <span class="string">'loginForm'</span>],            <span class="string">'/login/process'</span> => [<span class="string">'AuthController'</span>, <span class="string">'login'</span>],
            <span class="string">'/logout'</span> => [<span class="string">'AuthController'</span>, <span class="string">'logout'</span>],
            <span class="comment">// Autres routes...</span>
        ];
    }
    
    <span class="keyword">public function</span> <span class="function">dispatch</span>() {
        <span class="comment">// Récupérer l'URL demandée</span>
        <span class="variable">$uri</span> = <span class="function">parse_url</span>(<span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>], <span class="constant">PHP_URL_PATH</span>);
        
        <span class="comment">// Vérifier si la route existe</span>
        <span class="keyword">if</span> (<span class="function">array_key_exists</span>(<span class="variable">$uri</span>, <span class="variable">$this->routes</span>)) {
            <span class="variable">$controller</span> = <span class="variable">$this->routes</span>[<span class="variable">$uri</span>][0];
            <span class="variable">$method</span> = <span class="variable">$this->routes</span>[<span class="variable">$uri</span>][1];
            
            <span class="comment">// Charger le contrôleur</span>
            <span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">"/app/controllers/$controller.php"</span>;
            
            <span class="comment">// Instancier le contrôleur avec la connexion à la BD</span>
            <span class="variable">$controllerInstance</span> = <span class="keyword">new</span> <span class="variable">$controller</span>(<span class="variable">$this->db</span>);
            
            <span class="comment">// Appeler la méthode avec les paramètres éventuels</span>
            <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_GET</span>[<span class="string">'id'</span>])) {
                <span class="variable">$controllerInstance</span>-><span class="variable">$method</span>(<span class="variable">$_GET</span>[<span class="string">'id'</span>]);
            } <span class="keyword">else</span> {
                <span class="variable">$controllerInstance</span>-><span class="variable">$method</span>();
            }
        } <span class="keyword">else</span> {
            <span class="comment">// Route non trouvée (erreur 404)</span>
            <span class="function">header</span>(<span class="string">"HTTP/1.0 404 Not Found"</span>);
            <span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/views/errors/404.php'</span>;
        }
    }
}
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Ce routeur simple utilise un tableau pour définir les routes. Pour chaque route, il spécifie quel contrôleur et quelle méthode appeler. La méthode <code>dispatch()</code> analyse l'URL demandée, charge le contrôleur approprié et appelle la méthode correspondante. Si la route n'existe pas, il affiche une page d'erreur 404.</p>
                </div>

                <h3>Routeur avec paramètres dynamiques</h3>
                <p>Pour un routeur plus avancé, on peut gérer des URL dynamiques comme <code>/article/view/42</code> où "42" est l'ID de l'article :</p>

                <div class="example-box">
                    <h5>Exemple de routeur avancé</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">class</span> <span class="class">AdvancedRouter</span> {
    <span class="keyword">private</span> <span class="variable">$routes</span> = [];
    <span class="keyword">private</span> <span class="variable">$db</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$dbConnection</span>) {
        <span class="variable">$this->db</span> = <span class="variable">$dbConnection</span>;
    }
    
    <span class="comment">// Méthodes pour définir les routes</span>
    <span class="keyword">public function</span> <span class="function">get</span>(<span class="variable">$path</span>, <span class="variable">$callback</span>) {
        <span class="variable">$this->routes</span>[<span class="string">'GET'</span>][<span class="variable">$path</span>] = <span class="variable">$callback</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">post</span>(<span class="variable">$path</span>, <span class="variable">$callback</span>) {
        <span class="variable">$this->routes</span>[<span class="string">'POST'</span>][<span class="variable">$path</span>] = <span class="variable">$callback</span>;
    }
      <span class="comment">// Gestion des URL dynamiques et des paramètres</span>
    <span class="keyword">public function</span> <span class="function">dispatch</span>() {
        <span class="comment">// Obtenir la méthode HTTP (GET, POST, etc.)</span>
        <span class="variable">$method</span> = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_METHOD'</span>];
        
        <span class="comment">// Obtenir le chemin de l'URL</span>
        <span class="variable">$uri</span> = <span class="function">parse_url</span>(<span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>], <span class="constant">PHP_URL_PATH</span>);
        
        <span class="comment">// Chercher une correspondance dans nos routes</span>
        <span class="keyword">foreach</span> (<span class="variable">$this->routes</span>[<span class="variable">$method</span>] ?? [] <span class="keyword">as</span> <span class="variable">$route</span> => <span class="variable">$callback</span>) {
            <span class="comment">// Transformer les paramètres dynamiques (:id) en expression régulière</span>
            <span class="variable">$pattern</span> = <span class="function">preg_replace</span>(<span class="string">'#:[a-zA-Z0-9]+#'</span>, <span class="string">'([a-zA-Z0-9]+)'</span>, <span class="variable">$route</span>);
            <span class="variable">$pattern</span> = <span class="string">"#^$pattern$#"</span>;
            
            <span class="keyword">if</span> (<span class="function">preg_match</span>(<span class="variable">$pattern</span>, <span class="variable">$uri</span>, <span class="variable">$matches</span>)) {
                <span class="function">array_shift</span>(<span class="variable">$matches</span>); <span class="comment">// Enlever la première correspondance (l'URL complète)</span>
                
                <span class="comment">// Charger et instancier le contrôleur</span>
                <span class="keyword">if</span> (<span class="function">is_array</span>(<span class="variable">$callback</span>)) {
                    <span class="variable">$controllerName</span> = <span class="variable">$callback</span>[0];
                    <span class="variable">$methodName</span> = <span class="variable">$callback</span>[1];
                    
                    <span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">"/app/controllers/$controllerName.php"</span>;
                    <span class="variable">$controller</span> = <span class="keyword">new</span> <span class="variable">$controllerName</span>(<span class="variable">$this->db</span>);
                    
                    <span class="comment">// Appeler la méthode avec les paramètres extraits de l'URL</span>
                    <span class="function">call_user_func_array</span>([<span class="variable">$controller</span>, <span class="variable">$methodName</span>], <span class="variable">$matches</span>);
                } <span class="keyword">else</span> {
                    <span class="comment">// Si c'est une fonction anonyme</span>
                    <span class="function">call_user_func_array</span>(<span class="variable">$callback</span>, <span class="variable">$matches</span>);
                }
                
                <span class="keyword">return</span>;
            }
        }
        
        <span class="comment">// Si aucune route ne correspond, afficher une erreur 404</span>
        <span class="function">header</span>(<span class="string">"HTTP/1.0 404 Not Found"</span>);
        <span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/views/errors/404.php'</span>;
    }
}

<span class="comment">// Exemple d'utilisation:</span>
<span class="variable">$router</span> = <span class="keyword">new</span> <span class="class">AdvancedRouter</span>(<span class="variable">$db</span>);

<span class="variable">$router</span>-><span class="function">get</span>(<span class="string">'/'</span>, [<span class="string">'HomeController'</span>, <span class="string">'index'</span>]);
<span class="variable">$router</span>-><span class="function">get</span>(<span class="string">'/articles'</span>, [<span class="string">'ArticleController'</span>, <span class="string">'index'</span>]);
<span class="variable">$router</span>-><span class="function">get</span>(<span class="string">'/article/view/:id'</span>, [<span class="string">'ArticleController'</span>, <span class="string">'view'</span>]);
<span class="variable">$router</span>-><span class="function">get</span>(<span class="string">'/article/create'</span>, [<span class="string">'ArticleController'</span>, <span class="string">'create'</span>]);
<span class="variable">$router</span>-><span class="function">post</span>(<span class="string">'/article/store'</span>, [<span class="string">'ArticleController'</span>, <span class="string">'store'</span>]);
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Ce routeur plus avancé permet de définir des routes avec des paramètres dynamiques comme <code>:id</code>. Il utilise les expressions régulières pour faire correspondre les URL demandées aux modèles de routes définis. Il distingue également les méthodes HTTP (GET, POST), ce qui permet d'avoir différentes actions pour la même URL selon la méthode utilisée.</p>
                </div>

                <div class="info-box">
                    <p><strong>Pour des projets complexes :</strong> Si votre application devient plus grande, envisagez d'utiliser un routeur existant comme celui de Symfony (symfony/routing) ou FastRoute de Nikic, au lieu de réinventer la roue.</p>
                </div>
            </section>
            <section class="section">
                <h2>Base de données et modèles avancés</h2>
                <p>Dans une application plus complexe, vous aurez besoin de modèles plus sophistiqués pour gérer l'interaction avec la base de données. Voici un exemple de modèle de base avec une classe abstraite :</p>

                <div class="example-box">
                    <h5>Modèle de base abstrait - app/models/Model.php</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">abstract class</span> <span class="class">Model</span> {
    <span class="keyword">protected</span> <span class="variable">$db</span>;
    <span class="keyword">protected</span> <span class="variable">$table</span>;
    <span class="keyword">protected</span> <span class="variable">$primaryKey</span> = <span class="string">'id'</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$dbConnection</span>) {
        <span class="variable">$this->db</span> = <span class="variable">$dbConnection</span>;
    }
    
    <span class="comment">// Méthodes CRUD de base</span>
    
    <span class="comment">// Récupérer tous les enregistrements</span>
    <span class="keyword">public function</span> <span class="function">all</span>() {
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM {$this->table}"</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
      <span class="comment">// Trouver un enregistrement par son id</span>
    <span class="keyword">public function</span> <span class="function">find</span>(<span class="variable">$id</span>) {
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id"</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':id'</span>, <span class="variable">$id</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetch</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
    
    <span class="comment">// Créer un nouvel enregistrement</span>
    <span class="keyword">public function</span> <span class="function">create</span>(<span class="variable">$data</span>) {
        <span class="comment">// Construire la requête dynamiquement</span>
        <span class="variable">$fields</span> = <span class="function">array_keys</span>(<span class="variable">$data</span>);
        <span class="variable">$fieldsList</span> = <span class="function">implode</span>(<span class="string">', '</span>, <span class="variable">$fields</span>);
        <span class="variable">$placeholders</span> = <span class="string">':'</span> . <span class="function">implode</span>(<span class="string">', :'</span>, <span class="variable">$fields</span>);
        
        <span class="variable">$sql</span> = <span class="string">"INSERT INTO {$this->table} ($fieldsList) VALUES ($placeholders)"</span>;
        
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$sql</span>);
        <span class="keyword">foreach</span> (<span class="variable">$data</span> <span class="keyword">as</span> <span class="variable">$key</span> => <span class="variable">$value</span>) {
            <span class="variable">$stmt</span>-><span class="function">bindValue</span>(<span class="string">":$key"</span>, <span class="variable">$value</span>);
        }
        
        <span class="keyword">if</span> (<span class="variable">$stmt</span>-><span class="function">execute</span>()) {
            <span class="keyword">return</span> <span class="variable">$this->db</span>-><span class="function">lastInsertId</span>();
        }
        <span class="keyword">return</span> <span class="keyword">false</span>;
    }
    
    <span class="comment">// Mettre à jour un enregistrement</span>
    <span class="keyword">public function</span> <span class="function">update</span>(<span class="variable">$id</span>, <span class="variable">$data</span>) {
        <span class="comment">// Construire les parties SET de la requête</span>
        <span class="variable">$setParts</span> = [];
        <span class="keyword">foreach</span> (<span class="function">array_keys</span>(<span class="variable">$data</span>) <span class="keyword">as</span> <span class="variable">$field</span>) {
            <span class="variable">$setParts</span>[] = <span class="string">"$field = :$field"</span>;
        }
        <span class="variable">$setClause</span> = <span class="function">implode</span>(<span class="string">', '</span>, <span class="variable">$setParts</span>);
        
        <span class="variable">$sql</span> = <span class="string">"UPDATE {$this->table} SET $setClause WHERE {$this->primaryKey} = :id"</span>;
        
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$sql</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':id'</span>, <span class="variable">$id</span>);
        
        <span class="keyword">foreach</span> (<span class="variable">$data</span> <span class="keyword">as</span> <span class="variable">$key</span> => <span class="variable">$value</span>) {
            <span class="variable">$stmt</span>-><span class="function">bindValue</span>(<span class="string">":$key"</span>, <span class="variable">$value</span>);
        }
        
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">execute</span>();
    }
    
    <span class="comment">// Supprimer un enregistrement</span>
    <span class="keyword">public function</span> <span class="function">delete</span>(<span class="variable">$id</span>) {
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="string">"DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id"</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':id'</span>, <span class="variable">$id</span>);
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">execute</span>();
    }
    
    <span class="comment">// Rechercher par critères</span>
    <span class="keyword">public function</span> <span class="function">where</span>(<span class="variable">$conditions</span>) {
        <span class="variable">$whereClauses</span> = [];
        <span class="variable">$params</span> = [];
        
        <span class="keyword">foreach</span> (<span class="variable">$conditions</span> <span class="keyword">as</span> <span class="variable">$field</span> => <span class="variable">$value</span>) {
            <span class="variable">$whereClauses</span>[] = <span class="string">"$field = :$field"</span>;
            <span class="variable">$params</span>[<span class="string">":$field"</span>] = <span class="variable">$value</span>;
        }
        
        <span class="variable">$whereClause</span> = <span class="function">implode</span>(<span class="string">' AND '</span>, <span class="variable">$whereClauses</span>);
        <span class="variable">$sql</span> = <span class="string">"SELECT * FROM {$this->table} WHERE $whereClause"</span>;
        
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$sql</span>);
        <span class="keyword">foreach</span> (<span class="variable">$params</span> <span class="keyword">as</span> <span class="variable">$param</span> => <span class="variable">$value</span>) {
            <span class="variable">$stmt</span>-><span class="function">bindValue</span>(<span class="variable">$param</span>, <span class="variable">$value</span>);
        }
        
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
}
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Ce modèle abstrait fournit les opérations CRUD (Create, Read, Update, Delete) de base pour tous les modèles de votre application. Les modèles spécifiques à chaque table hériteront de cette classe et n'auront qu'à définir leur table et éventuellement des méthodes spécifiques.</p>
                </div>

                <div class="example-box">
                    <h5>Exemple de modèle spécifique - app/models/UserModel.php</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">require_once</span> <span class="string">'Model.php'</span>;

<span class="keyword">class</span> <span class="class">UserModel</span> <span class="keyword">extends</span> <span class="class">Model</span> {
    <span class="keyword">protected</span> <span class="variable">$table</span> = <span class="string">'users'</span>;
    
    <span class="comment">// Méthodes spécifiques aux utilisateurs</span>
    
    <span class="comment">// Trouver un utilisateur par son email</span>
    <span class="keyword">public function</span> <span class="function">findByEmail</span>(<span class="variable">$email</span>) {
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM {$this->table} WHERE email = :email"</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':email'</span>, <span class="variable">$email</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetch</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
    
    <span class="comment">// Vérifier les identifiants lors de la connexion</span>
    <span class="keyword">public function</span> <span class="function">authenticate</span>(<span class="variable">$email</span>, <span class="variable">$password</span>) {
        <span class="variable">$user</span> = <span class="variable">$this</span>-><span class="function">findByEmail</span>(<span class="variable">$email</span>);
          <span class="keyword">if</span> (<span class="variable">$user</span> && <span class="function">password_verify</span>(<span class="variable">$password</span>, <span class="variable">$user</span>[<span class="string">'password'</span>])) {
            <span class="keyword">return</span> <span class="variable">$user</span>;
        }
        
        <span class="keyword">return</span> <span class="keyword">false</span>;
    }
    
    <span class="comment">// Créer un nouvel utilisateur avec hachage du mot de passe</span>
    <span class="keyword">public function</span> <span class="function">register</span>(<span class="variable">$data</span>) {
        <span class="comment">// Hasher le mot de passe avant de l'enregistrer</span>
        <span class="variable">$data</span>[<span class="string">'password'</span>] = <span class="function">password_hash</span>(<span class="variable">$data</span>[<span class="string">'password'</span>], <span class="constant">PASSWORD_DEFAULT</span>);
        
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="function">create</span>(<span class="variable">$data</span>);
    }
    
    <span class="comment">// Récupérer les articles d'un utilisateur (relation)</span>
    <span class="keyword">public function</span> <span class="function">getArticles</span>(<span class="variable">$userId</span>) {
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="string">"
            SELECT * FROM articles
            WHERE user_id = :userId
            ORDER BY created_at DESC
        "</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':userId'</span>, <span class="variable">$userId</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
}
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Ce modèle spécifique aux utilisateurs hérite du modèle de base et ajoute des méthodes spécifiques comme l'authentification, l'enregistrement avec hachage de mot de passe, et une méthode pour récupérer les articles associés à un utilisateur (relation one-to-many).</p>
                </div>
            </section>
            <section class="section">
                <h2>Templates et systèmes de vues</h2>
                <p>Pour améliorer la structure et la réutilisabilité de vos vues, vous pouvez implémenter un système de templates simple ou utiliser une bibliothèque existante comme Twig.</p>

                <h3>Système de templates maison</h3>
                <div class="example-box">
                    <h5>Classe View simple - app/helpers/View.php</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">class</span> <span class="class">View</span> {
    <span class="comment">// Chemin de base pour les vues</span>
    <span class="keyword">private static</span> <span class="variable">$viewPath</span> = <span class="constant">ROOT</span> . <span class="string">'/app/views/'</span>;
    
    <span class="comment">/**
     * Affiche une vue
     * @param string $view Nom de la vue
     * @param array $data Données à passer à la vue
     */</span>
    <span class="keyword">public static function</span> <span class="function">render</span>(<span class="variable">$view</span>, <span class="variable">$data</span> = []) {
        <span class="comment">// Extraire les données pour les rendre disponibles comme variables locales</span>
        <span class="function">extract</span>(<span class="variable">$data</span>);
        
        <span class="comment">// Vérifier si la vue existe</span>
        <span class="variable">$filePath</span> = <span class="keyword">self</span>::<span class="variable">$viewPath</span> . <span class="variable">$view</span> . <span class="string">'.php'</span>;
        <span class="keyword">if</span> (!<span class="function">file_exists</span>(<span class="variable">$filePath</span>)) {
            <span class="keyword">throw new</span> <span class="class">Exception</span>(<span class="string">"Vue non trouvée: $view"</span>);
        }
          <span class="comment">// Démarrer la mise en tampon de sortie</span>
        <span class="function">ob_start</span>();
        <span class="keyword">require</span> <span class="variable">$filePath</span>;
        <span class="variable">$content</span> = <span class="function">ob_get_clean</span>();
        
        <span class="keyword">return</span> <span class="variable">$content</span>;
    }
    
    <span class="comment">/**
     * Affiche une vue avec un layout
     * @param string $view Nom de la vue
     * @param string $layout Nom du layout
     * @param array $data Données à passer à la vue et au layout
     */</span>
    <span class="keyword">public static function</span> <span class="function">renderWithLayout</span>(<span class="variable">$view</span>, <span class="variable">$layout</span> = <span class="string">'default'</span>, <span class="variable">$data</span> = []) {
        <span class="comment">// Rendre d'abord la vue</span>
        <span class="variable">$data</span>[<span class="string">'content'</span>] = <span class="keyword">self</span>::<span class="function">render</span>(<span class="variable">$view</span>, <span class="variable">$data</span>);
        
        <span class="comment">// Puis rendre le layout avec la vue à l'intérieur</span>
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="function">render</span>(<span class="string">'layouts/'</span> . <span class="variable">$layout</span>, <span class="variable">$data</span>);
    }
}
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Cette classe <code>View</code> fournit deux méthodes principales : <code>render()</code> pour afficher une vue simple, et <code>renderWithLayout()</code> pour afficher une vue à l'intérieur d'un layout. La mise en tampon de sortie (ob_start/ob_get_clean) permet de capturer la sortie HTML pour l'insérer dans le layout.</p>
                </div>

                <div class="example-box">
                    <h5>Exemple de layout - app/views/layouts/default.php</h5>
                    <pre><code>
<span class="tag">&lt;!DOCTYPE html&gt;</span>
<span class="tag">&lt;html</span> <span class="attr">lang</span>=<span class="string">"fr"</span><span class="tag">&gt;</span>
<span class="tag">&lt;head&gt;</span>
    <span class="tag">&lt;meta</span> <span class="attr">charset</span>=<span class="string">"UTF-8"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;meta</span> <span class="attr">name</span>=<span class="string">"viewport"</span> <span class="attr">content</span>=<span class="string">"width=device-width, initial-scale=1.0"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;title&gt;</span><span class="tag">&lt;?=</span> <span class="variable">$title</span> ?? <span class="string">'Mon Application MVC'</span> <span class="tag">?&gt;</span><span class="tag">&lt;/title&gt;</span>
    <span class="tag">&lt;link</span> <span class="attr">rel</span>=<span class="string">"stylesheet"</span> <span class="attr">href</span>=<span class="string">"/css/style.css"</span><span class="tag">&gt;</span>
<span class="tag">&lt;/head&gt;</span>
<span class="tag">&lt;body&gt;</span>
    <span class="tag">&lt;header&gt;</span>
        <span class="tag">&lt;nav&gt;</span>
            <span class="tag">&lt;ul&gt;</span>
                <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/"</span><span class="tag">&gt;</span>Accueil<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
                <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/articles"</span><span class="tag">&gt;</span>Articles<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>])): <span class="tag">?&gt;</span>
                    <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/article/create"</span><span class="tag">&gt;</span>Créer un article<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
                    <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/profile"</span><span class="tag">&gt;</span>Mon Profil<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
                    <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/logout"</span><span class="tag">&gt;</span>Déconnexion<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">else</span>: <span class="tag">?&gt;</span>
                    <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/login"</span><span class="tag">&gt;</span>Connexion<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>                    <span class="tag">&lt;li&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/register"</span><span class="tag">&gt;</span>Inscription<span class="tag">&lt;/a&gt;</span><span class="tag">&lt;/li&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">endif</span>; <span class="tag">?&gt;</span>
            <span class="tag">&lt;/ul&gt;</span>
        <span class="tag">&lt;/nav&gt;</span>
    <span class="tag">&lt;/header&gt;</span>
    
    <span class="tag">&lt;main&gt;</span>
        <span class="tag">&lt;?php</span> <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string>'success'</span>])): <span class="tag">?&gt;</span>
            <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"alert success"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;?=</span> <span class="variable">$_SESSION</span>[<span class="string>'success'</span>] <span class="tag">?&gt;</span>
            <span class="tag">&lt;/div&gt;</span>
            <span class="tag">&lt;?php</span> <span class="function">unset</span>(<span class="variable">$_SESSION</span>[<span class="string>'success'</span>]); <span class="tag">?&gt;</span>
        <span class="tag">&lt;?php</span> <span class="keyword">endif</span>; <span class="tag">?&gt;</span>
        
        <span class="tag">&lt;?php</span> <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_SESSION</span>[<span class="string>'error'</span>])): <span class="tag">?&gt;</span>
            <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"alert error"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;?=</span> <span class="variable">$_SESSION</span>[<span class="string>'error'</span>] <span class="tag">?&gt;</span>
            <span class="tag">&lt;/div&gt;</span>
            <span class="tag">&lt;?php</span> <span class="function">unset</span>(<span class="variable">$_SESSION</span>[<span class="string>'error'</span>]); <span class="tag">?&gt;</span>
        <span class="tag">&lt;?php</span> <span class="keyword">endif</span>; <span class="tag">?&gt;</span>
        
        <span class="tag">&lt;?=</span> <span class="variable">$content</span> <span class="tag">?&gt;</span>
    <span class="tag">&lt;/main&gt;</span>
    
    <span class="tag">&lt;footer&gt;</span>
        <span class="tag">&lt;p&gt;</span>&copy; <span class="tag">&lt;?=</span> <span class="function">date</span>(<span class="string">'Y'</span>) <span class="tag">?&gt;</span> Mon Application MVC<span class="tag">&lt;/p&gt;</span>
    <span class="tag">&lt;/footer&gt;</span>
    
    <span class="tag">&lt;script</span> <span class="attr">src</span>=<span class="string">"/js/main.js"</span><span class="tag">&gt;</span><span class="tag">&lt;/script&gt;</span>
<span class="tag">&lt;/body&gt;</span>
<span class="tag">&lt;/html&gt;</span>
</code></pre>
                    <p><strong>Explication :</strong> Ce layout contient la structure HTML commune à toutes les pages, avec des emplacements pour le titre et le contenu principal. Il inclut également la gestion des messages flash (succès/erreur) stockés en session, et affiche un menu différent selon que l'utilisateur est connecté ou non.</p>
                </div>

                <div class="example-box">
                    <h5>Utilisation dans un contrôleur</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">class</span> <span class="class">ArticleController</span> {
    <span class="comment">// ...</span>
    
    <span class="keyword">public function</span> <span class="function">index</span>() {
        <span class="variable">$articles</span> = <span class="variable">$this</span>-><span class="variable">articleModel</span>-><span class="function">all</span>();
        
        <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'articles/index'</span>, <span class="string">'default'</span>, [
            <span class="string">'title'</span> => <span class="string">'Liste des articles'</span>,
            <span class="string">'articles'</span> => <span class="variable">$articles</span>
        ]);
    }
      <span class="keyword">public function</span> <span class="function">view</span>(<span class="variable">$id</span>) {
        <span class="variable">$article</span> = <span class="variable">$this</span>-><span class="variable">articleModel</span>-><span class="function">find</span>(<span class="variable">$id</span>);
        
        <span class="keyword">if</span> (!<span class="variable">$article</span>) {
            <span class="function">header</span>(<span class="string">"HTTP/1.0 404 Not Found"</span>);
            <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'errors/404'</span>, <span class="string">'default'</span>, [
                <span class="string">'title'</span> => <span class="string">'Article non trouvé'</span>
            ]);
            <span class="keyword">return</span>;
        }
        
        <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'articles/view'</span>, <span class="string">'default'</span>, [
            <span class="string">'title'</span> => <span class="variable">$article</span>[<span class="string>'title'</span>],
            <span class="string">'article'</span> => <span class="variable">$article</span>
        ]);
    }
    <span class="comment">// ...</span>
}
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Dans le contrôleur, nous utilisons la classe <code>View</code> pour rendre les vues avec un layout. Nous passons les données nécessaires comme le titre et les articles. Cette approche permet d'avoir un code plus propre et d'éviter la duplication du code HTML de base.</p>
                </div>

                <h3>Utilisation de Twig (système de templates professionnel)</h3>
                <p>Pour les projets plus importants, vous pouvez utiliser Twig, un moteur de templates professionnel :</p>

                <div class="example-box">
                    <h5>Configuration de Twig - app/helpers/TwigView.php</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/vendor/autoload.php'</span>;

<span class="keyword">class</span> <span class="class">TwigView</span> {
    <span class="keyword">private static</span> <span class="variable">$twig</span> = <span class="keyword">null</span>;
    
    <span class="keyword">public static function</span> <span class="function">init</span>() {
        <span class="variable">$loader</span> = <span class="keyword">new</span> \<span class="class">Twig</span>\<span class="class">Loader</span>\<span class="class">FilesystemLoader</span>(<span class="constant">ROOT</span> . <span class="string">'/app/views'</span>);
        <span class="keyword">self</span>::<span class="variable">$twig</span> = <span class="keyword">new</span> \<span class="class">Twig</span>\<span class="class">Environment</span>(<span class="variable">$loader</span>, [
            <span class="string">'cache'</span> => <span class="constant">ROOT</span> . <span class="string">'/cache/twig'</span>,
            <span class="string">'debug'</span> => <span class="constant">DEBUG_MODE</span>,
            <span class="string">'auto_reload'</span> => <span class="keyword">true</span>
        ]);
        
        <span class="comment">// Ajouter des extensions ou fonctions personnalisées</span>
        <span class="keyword">if</span> (<span class="constant">DEBUG_MODE</span>) {
            <span class="keyword">self</span>::<span class="variable">$twig</span>-><span class="function">addExtension</span>(<span class="keyword">new</span> \<span class="class">Twig</span>\<span class="class">Extension</span>\<span class="class">DebugExtension</span>());
        }
        
        <span class="comment">// Ajouter des fonctions utiles</span>
        <span class="keyword">self</span>::<span class="variable">$twig</span>-><span class="function">addFunction</span>(<span class="keyword">new</span> \<span class="class">Twig</span>\<span class="class">TwigFunction</span>(<span class="string">'url'</span>, <span class="keyword">function</span>(<span class="variable">$path</span>) {            <span class="keyword">return</span> <span class="string">'/'</span> . <span class="function">ltrim</span>(<span class="variable">$path</span>, <span class="string">'/'</span>);
        }));
        
        <span class="comment">// Ajouter des filtres personnalisés</span>
        <span class="keyword">self</span>::<span class="variable">$twig</span>-><span class="function">addFilter</span>(<span class="keyword">new</span> \<span class="class">Twig</span>\<span class="class">TwigFilter</span>(<span class="string>'date_format'</span>, <span class="keyword">function</span>(<span class="variable">$date</span>, <span class="variable">$format</span> = <span class="string">'d/m/Y'</span>) {
            <span class="keyword">return</span> <span class="function">date</span>(<span class="variable">$format</span>, <span class="function">strtotime</span>(<span class="variable">$date</span>));
        }));
    }
    
    <span class="keyword">public static function</span> <span class="function">render</span>(<span class="variable">$template</span>, <span class="variable">$data</span> = []) {
        <span class="keyword">if</span> (!<span class="keyword">self</span>::<span class="variable">$twig</span>) {
            <span class="keyword">self</span>::<span class="function">init</span>();
        }
        
        <span class="comment">// Ajouter des variables globales disponibles pour tous les templates</span>
        <span class="variable">$data</span>[<span class="string">'session'</span>] = <span class="variable">$_SESSION</span>;
        <span class="variable">$data</span>[<span class="string">'current_url'</span>] = <span class="variable">$_SERVER</span>[<span class="string">'REQUEST_URI'</span>];
        
        <span class="keyword">try</span> {
            <span class="keyword">return</span> <span class="keyword">self</span>::<span class="variable">$twig</span>-><span class="function">render</span>(<span class="variable">$template</span> . <span class="string">'.twig'</span>, <span class="variable">$data</span>);
        } <span class="keyword">catch</span> (\<span class="class">Twig</span>\<span class="class">Error</span>\<span class="class">LoaderError</span> <span class="variable">$e</span>) {
            <span class="keyword">throw new</span> <span class="class">Exception</span>(<span class="string">"Template not found: $template"</span>);
        }
    }
}
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Cette classe configure Twig avec des options comme le cache et le mode debug. Elle ajoute également des fonctions et filtres personnalisés que vous pourrez utiliser dans vos templates, comme la fonction <code>url()</code> pour générer des URLs ou le filtre <code>date_format</code> pour formater des dates.</p>
                </div>

                <div class="example-box">
                    <h5>Exemple de template Twig - app/views/articles/view.twig</h5>
                    <pre><code>
<span class="keyword">{%</span> <span class="function">extends</span> <span class="string">"layouts/default.twig"</span> <span class="keyword">%}</span>

<span class="keyword">{%</span> <span class="function">block</span> <span class="string">title</span> <span class="keyword">%}</span><span class="tag">{{</span> article.title <span class="tag">}}</span><span class="keyword">{%</span> <span class="function">endblock</span> <span class="keyword">%}</span>

<span class="keyword">{%</span> <span class="function">block</span> <span class="string">content</span> <span class="keyword">%}</span>
    <span class="tag">&lt;article</span> <span class="attr">class</span>=<span class="string">"single-article"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;header&gt;</span>
            <span class="tag">&lt;h1&gt;</span><span class="tag">{{</span> article.title <span class="tag">}}</span><span class="tag">&lt;/h1&gt;</span>
            <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"article-meta"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;span</span> <span class="attr">class</span>=<span class="string">"date"</span><span class="tag">&gt;</span>Publié le <span class="tag">{{</span> article.created_at|date_format('d F Y') <span class="tag">}}</span><span class="tag">&lt;/span&gt;</span>
                <span class="tag">&lt;span</span> <span class="attr">class</span>=<span class="string">"author"</span><span class="tag">&gt;</span>par <span class="tag">{{</span> article.author_name <span class="tag">}}</span><span class="tag">&lt;/span&gt;</span>
            <span class="tag">&lt;/div&gt;</span>
        <span class="tag">&lt;/header&gt;</span>
        
        <span class="keyword">{%</span> <span class="keyword">if</span> article.image_url <span class="keyword">%}</span>            <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"article-image"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;img</span> <span class="attr">src</span>=<span class="string">"{{ article.image_url }}"</span> <span class="attr">alt</span>=<span class="string">"{{ article.title }}"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;/div&gt;</span>
        <span class="keyword">{%</span> <span class="keyword">endif</span> <span class="keyword">%}</span>
        
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"article-content"</span><span class="tag">&gt;</span>
            <span class="tag">{{</span> article.content|raw <span class="tag">}}</span>
        <span class="tag">&lt;/div&gt;</span>
        
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"article-actions"</span><span class="tag">&gt;</span>
            <span class="keyword">{%</span> <span class="keyword">if</span> session.user_id == article.user_id <span class="keyword">%}</span>
                <span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"{{ url('article/edit/' ~ article.id) }}"</span> <span class="attr">class</span>=<span class="string">"btn edit"</span><span class="tag">&gt;</span>Modifier<span class="tag">&lt;/a&gt;</span>
                <span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"{{ url('article/delete/' ~ article.id) }}"</span> <span class="attr">class</span>=<span class="string">"btn delete"</span> <span class="attr">onclick</span>=<span class="string">"return confirm('Êtes-vous sûr de vouloir supprimer cet article?')"</span><span class="tag">&gt;</span>Supprimer<span class="tag">&lt;/a&gt;</span>
            <span class="keyword">{%</span> <span class="keyword">endif</span> <span class="keyword">%}</span>
            <span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"{{ url('articles') }}"</span> <span class="attr">class</span>=<span class="string">"btn back"</span><span class="tag">&gt;</span>Retour à la liste<span class="tag">&lt;/a&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
    <span class="tag">&lt;/article&gt;</span>
    
    <span class="keyword">{%</span> <span class="keyword">if</span> comments is not empty <span class="keyword">%}</span>
        <span class="tag">&lt;section</span> <span class="attr">class</span>=<span class="string">"comments"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;h2&gt;</span><span class="tag">{{</span> comments|length <span class="tag">}}</span> Commentaire(s)<span class="tag">&lt;/h2&gt;</span>
            
            <span class="keyword">{%</span> <span class="keyword">for</span> comment in comments <span class="keyword">%}</span>
                <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"comment"</span><span class="tag">&gt;</span>
                    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"comment-header"</span><span class="tag">&gt;</span>
                        <span class="tag">&lt;strong&gt;</span><span class="tag">{{</span> comment.username <span class="tag">}}</span><span class="tag">&lt;/strong&gt;</span>
                        <span class="tag">&lt;span</span> <span class="attr">class</span>=<span class="string">"date"</span><span class="tag">&gt;</span><span class="tag">{{</span> comment.created_at|date_format <span class="tag">}}</span><span class="tag">&lt;/span&gt;</span>
                    <span class="tag">&lt;/div&gt;</span>
                    <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"comment-content"</span><span class="tag">&gt;</span>
                        <span class="tag">{{</span> comment.content <span class="tag">}}</span>
                    <span class="tag">&lt;/div&gt;</span>
                <span class="tag">&lt;/div&gt;</span>
            <span class="keyword">{%</span> <span class="keyword">endfor</span> <span class="keyword">%}</span>
        <span class="tag">&lt;/section&gt;</span>
    <span class="keyword">{%</span> <span class="keyword">endif</span> <span class="keyword">%}</span>
    
    <span class="keyword">{%</span> <span class="keyword">if</span> session.user_id <span class="keyword">%}</span>
        <span class="tag">&lt;section</span> <span class="attr">class</span>=<span class="string">"comment-form"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;h2&gt;</span>Laisser un commentaire<span class="tag">&lt;/h2&gt;</span>
            <span class="tag">&lt;form</span> <span class="attr">action</span>=<span class="string">"{{ url('comment/add') }}"</span> <span class="attr">method</span>=<span class="string">"post"</span><span class="attr">enctype</span>=<span class="string">"multipart/form-data"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"hidden"</span> <span class="attr">name</span>=<span class="string">"article_id"</span> <span class="attr">value</span>=<span class="string">"{{ article.id }}"</span><span class="tag">&gt;</span>
                <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
                    <span class="tag">&lt;textarea</span> <span class="attr">name</span>=<span class="string">"content"</span> <span class="attr">rows</span>=<span class="string">"5"</span> <span class="attr">required</span><span class="tag">&gt;</span><span class="tag">&lt;/textarea&gt;</span>
                <span class="tag">&lt;/div&gt;</span>
                <span class="tag">&lt;button</span> <span class="attr">type</span>=<span class="string">"submit"</span> <span class="attr">class</span>=<span class="string">"btn"</span><span class="tag">&gt;</span>Envoyer<span class="tag">&lt;/button&gt;</span>
            <span class="tag">&lt;/form&gt;</span>
        <span class="tag">&lt;/section&gt;</span>
    <span class="keyword">{%</span> <span class="keyword">else</span> <span class="keyword">%}</span>
        <span class="tag">&lt;p</span> <span class="attr">class</span>=<span class="string">"login-prompt"</span><span class="tag">&gt;</span><span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"{{ url('login') }}"</span><span class="tag">&gt;</span>Connectez-vous<span class="tag">&lt;/a&gt;</span> pour laisser un commentaire.<span class="tag">&lt;/p&gt;</span>
    <span class="keyword">{%</span> <span class="keyword">endif</span> <span class="keyword">%}</span>
{% endblock %}
</code></pre>
                    <p><strong>Explication :</strong> Ce template Twig étend un layout de base et définit des blocs pour le titre et le contenu. Il affiche les détails d'un article, avec des actions conditionnelles selon que l'utilisateur est l'auteur ou non. Il montre également les commentaires existants et un formulaire pour en ajouter un nouveau si l'utilisateur est connecté. Notez la syntaxe élégante de Twig pour les conditions, les boucles et les filtres.</p>
                </div>
            </section>
            <section class="section">
                <h2>Construction d'un mini-framework MVC complet</h2>
                <p>Pour conclure, voici comment créer un mini-framework MVC complet en rassemblant tous les éléments que nous avons vus :</p>

                <h3>1. Créez une structure de répertoires</h3>
                <pre><code>
my-mvc-framework/
├── app/
│   ├── controllers/
│   │   ├── ArticleController.php
│   │   ├── CommentController.php
│   │   ├── UserController.php
│   │   └── HomeController.php
│   ├── models/
│   │   ├── ArticleModel.php
│   │   ├── CommentModel.php
│   │   └── UserModel.php
│   └── views/
│       ├── articles/
│       │   ├── index.php
│       │   ├── view.php
│       │   ├── create.php
│       │   └── edit.php
│       ├── users/
│       │   ├── login.php
│       │   └── register.php
│       └── layouts/
│           └── default.php
├── config/
│   ├── config.php
│   └── database.php
├── core/
│   ├── Model.php
│   ├── Controller.php
│   ├── View.php
│   └── Router.php
└── public/
    ├── index.php
    ├── css/
    ├── js/
    └── .htaccess
</code></pre>

                <h3>2. Configuration de la redirection avec .htaccess</h3>
                <div class="example-box">
                    <h5>public/.htaccess</h5>
                    <pre><code>
<span class="comment"># Activer le moteur de réécriture</span>
<span class="keyword">RewriteEngine</span> On

<span class="comment"># Ne pas appliquer la réécriture aux fichiers existants</span>
<span class="keyword">RewriteCond</span> %{REQUEST_FILENAME} !-f
<span class="keyword">RewriteCond</span> %{REQUEST_FILENAME} !-d

<span class="comment"># Rediriger toutes les requêtes vers index.php</span>
<span class="keyword">RewriteRule</span> <span class="string">^(.*)$</span> index.php [QSA,L]

<span class="comment"># Protection contre l'accès aux fichiers .htaccess</span>
<span class="tag">&lt;Files</span> .htaccess<span class="tag">&gt;</span>
    <span class="keyword">Order</span> Allow,Deny
    <span class="keyword">Deny</span> from all
<span class="tag">&lt;/Files&gt;</span>
</code></pre>
                </div>

                <h3>3. Créez les fichiers de base du framework</h3>

                <p>Ajoutez les classes principales comme Router, Controller, Model, View, etc. que nous avons vues précédemment.</p>

                <h3>4. Ajoutez la gestion des erreurs</h3>
                <div class="example-box">
                    <h5>app/helpers/ErrorHandler.php</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="keyword">class</span> <span class="class">ErrorHandler</span> {
    <span class="keyword">public static function</span> <span class="function">register</span>() {
        <span class="comment">// Définir le gestionnaire d'exceptions</span>
        <span class="function">set_exception_handler</span>([<span class="keyword">self</span>::<span class="constant">class</span>, <span class="string">'handleException'</span>]);
        
        <span class="comment">// Définir le gestionnaire d'erreurs</span>
        <span class="function">set_error_handler</span>([<span class="keyword">self</span>::<span class="constant">class</span>, <span class="string">'handleError'</span>]);
        
        <span class="comment">// Définir le gestionnaire d'arrêt</span>
        <span class="function">register_shutdown_function</span>([<span class="keyword">self</span>::<span class="constant">class</span>, <span class="string">'handleShutdown'</span>]);
    }
    
    <span class="keyword">public static function</span> <span class="function">handleException</span>(<span class="variable">$exception</span>) {
        <span class="comment">// Journaliser l'exception</span>
        <span class="keyword">self</span>::<span class="function">logError</span>(<span class="variable">$exception</span>-><span class="function">getMessage</span>(), <span class="variable">$exception</span>-><span class="function">getFile</span>(), <span class="variable">$exception</span>-><span class="function">getLine</span>(), <span class="variable">$exception</span>-><span class="function">getTraceAsString</span>());
          <span class="comment">// Afficher une page d'erreur en fonction du type d'exception</span>
        <span class="keyword">if</span> (<span class="variable">$exception</span> <span class="keyword">instanceof</span> <span class="class">NotFoundException</span>) {
            <span class="function">header</span>(<span class="string">"HTTP/1.0 404 Not Found"</span>);
            <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'errors/404'</span>, <span class="string">'default'</span>, [
                <span class="string">'title'</span> => <span class="string">'Page non trouvée'</span>,
                <span class="string">'message'</span> => <span class="variable">$exception</span>-><span class="function">getMessage</span>()
            ]);
        } <span class="keyword">else</span> {
            <span class="function">header</span>(<span class="string">"HTTP/1.0 500 Internal Server Error"</span>);
            <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'errors/500'</span>, <span class="string">'default'</span>, [
                <span class="string">'title'</span> => <span class="string">'Erreur serveur'</span>,
                <span class="string">'message'</span> => <span class="constant">DEBUG_MODE</span> ? <span class="variable">$exception</span>-><span class="function">getMessage</span>() : <span class="string">'Une erreur interne est survenue.'</span>,
                <span class="string">'trace'</span> => <span class="constant">DEBUG_MODE</span> ? <span class="variable">$exception</span>-><span class="function">getTraceAsString</span>() : <span class="keyword">null</span>
            ]);
        }
        
        <span class="keyword">exit</span>;
    }
      <span class="keyword">public static function</span> <span class="function">handleError</span>(<span class="variable">$level</span>, <span class="variable">$message</span>, <span class="variable">$file</span>, <span class="variable">$line</span>) {
        <span class="keyword">if</span> (!(<span class="function">error_reporting</span>() & <span class="variable">$level</span>)) {
            <span class="comment">// Ce niveau d'erreur n'est pas inclus dans error_reporting</span>
            <span class="keyword">return</span>;
        }
        
        <span class="comment">// Traiter l'erreur comme une exception</span>
        <span class="keyword">throw new</span> <span class="class">ErrorException</span>(<span class="variable">$message</span>, 0, <span class="variable">$level</span>, <span class="variable">$file</span>, <span class="variable">$line</span>);
    }
    
    <span class="keyword">public static function</span> <span class="function">handleShutdown</span>() {
        <span class="variable">$error</span> = <span class="function">error_get_last</span>();
        <span class="keyword">if</span> (<span class="variable">$error</span> !== <span class="keyword">null</span> && <span class="function">in_array</span>(<span class="variable">$error</span>[<span class="string">'type'</span>], [<span class="constant">E_ERROR</span>, <span class="constant">E_PARSE</span>, <span class="constant">E_CORE_ERROR</span>, <span class="constant">E_COMPILE_ERROR</span>])) {
            <span class="keyword">self</span>::<span class="function">logError</span>(<span class="variable">$error</span>[<span class="string">'message'</span>], <span class="variable">$error</span>[<span class="string">'file'</span>], <span class="variable">$error</span>[<span class="string">'line'</span>]);
            
            <span class="keyword">if</span> (!<span class="function">headers_sent</span>()) {
                <span class="function">header</span>(<span class="string">"HTTP/1.0 500 Internal Server Error"</span>);
            }
            
            <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'errors/500'</span>, <span class="string">'default'</span>, [
                <span class="string">'title'</span> => <span class="string">'Erreur fatale'</span>,
                <span class="string">'message'</span> => <span class="constant">DEBUG_MODE</span> ? <span class="variable">$error</span>[<span class="string">'message'</span>] : <span class="string">'Une erreur fatale est survenue.'</span>,
                <span class="string">'file'</span> => <span class="constant">DEBUG_MODE</span> ? <span class="variable">$error</span>[<span class="string">'file'</span>] : <span class="keyword">null</span>,
                <span class="string">'line'</span> => <span class="constant">DEBUG_MODE</span> ? <span class="variable">$error</span>[<span class="string">'line'</span>] : <span class="keyword">null</span>
            ]);
        }
    }
    
    <span class="keyword">private static function</span> <span class="function">logError</span>(<span class="variable">$message</span>, <span class="variable">$file</span>, <span class="variable">$line</span>, <span class="variable">$trace</span> = <span class="string">''</span>) {
        <span class="variable">$logEntry</span> = <span class="function">date</span>(<span class="string">'Y-m-d H:i:s'</span>) . <span class="string">" | "</span>;
        <span class="variable">$logEntry</span> .= <span class="string">"$message in $file on line $line"</span>;
        <span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$trace</span>)) {
            <span class="variable">$logEntry</span> .= <span class="string">"\nStack Trace:\n$trace"</span>;
        }
        <span class="variable">$logEntry</span> .= <span class="string">"\n"</span> . <span class="function">str_repeat</span>(<span class="string">'-'</span>, 80) . <span class="string">"\n"</span>;
        
        <span class="function">file_put_contents</span>(
            <span class="constant">ROOT</span> . <span class="string">'/logs/error.log'</span>,
            <span class="variable">$logEntry</span>,
            <span class="constant">FILE_APPEND</span>
        );
    }
}

<span class="comment">// Exceptions personnalisées</span>
<span class="keyword">class</span> <span class="class">NotFoundException</span> <span class="keyword">extends</span> <span class="class">Exception</span> {}
<span class="keyword">class</span> <span class="class">ForbiddenException</span> <span class="keyword">extends</span> <span class="class">Exception</span> {}
<span class="keyword">class</span> <span class="class">ValidationException</span> <span class="keyword">extends</span> <span class="class">Exception</span> {}
?&gt;
</code></pre>
                    <p><strong>Explication :</strong> Cette classe gère toutes les erreurs et exceptions de l'application. Elle définit des gestionnaires pour les exceptions, les erreurs et les arrêts fatals. Elle journalise les erreurs dans un fichier et affiche des pages d'erreur adaptées selon le type d'erreur et le mode de débogage.</p>
                </div>

                <h3>5. Utilisation dans le Front Controller</h3>
                <div class="example-box">
                    <h5>public/index.php (complet)</h5>
                    <pre><code>
<span class="tag">&lt;?php</span>
<span class="comment">// Définir le chemin de base</span>
<span class="function">define</span>(<span class="string">'ROOT'</span>, <span class="function">dirname</span>(<span class="constant">__DIR__</span>));

<span class="comment">// Chargement de l'autoloader</span>
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/vendor/autoload.php'</span>;

<span class="comment">// Chargement des configurations</span>
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/config/config.php'</span>;
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/config/database.php'</span>;

<span class="comment">// Charger et configurer le gestionnaire d'erreurs</span>
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/helpers/ErrorHandler.php'</span>;
<span class="class">ErrorHandler</span>::<span class="function">register</span>();

<span class="comment">// Charger les classes nécessaires</span>
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/helpers/View.php'</span>;
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/helpers/Router.php'</span>;
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/models/Model.php'</span>;
<span class="keyword">require_once</span> <span class="constant">ROOT</span> . <span class="string">'/app/controllers/Controller.php'</span>;

<span class="comment">// Initialiser la session</span>
<span class="function">session_start</span>();

try {
    <span class="comment">// Créer la connexion à la base de données</span>
    <span class="variable">$db</span> = <span class="keyword">new</span> <span class="class">PDO</span>(
        <span class="string">"mysql:host="</span> . <span class="constant">DB_HOST</span> . <span class="string">";dbname="</span> . <span class="constant">DB_NAME</span> . <span class="string">";charset=utf8"</span>,
        <span class="constant">DB_USER</span>,
        <span class="constant">DB_PASS</span>,
        [<span class="class">PDO</span>::<span class="constant">ATTR_ERRMODE</span> => <span class="class">PDO</span>::<span class="constant">ERRMODE_EXCEPTION</span>]
    );
    
    <span class="comment">// Instancier et exécuter le routeur</span>
    <span class="variable">$router</span> = <span class="keyword">new</span> <span class="class">Router</span>(<span class="variable">$db</span>);
    <span class="variable">$router</span>-><span class="function">dispatch</span>();
} <span class="keyword">catch</span> (<span class="class">Exception</span> <span class="variable">$e</span>) {
    <span class="comment">// En cas d'erreur, le gestionnaire d'exceptions se chargera de l'affichage</span>
    <span class="keyword">throw</span> <span class="variable">$e</span>;
}
?&gt;
</code></pre>
                </div>

                <div class="info-box">
                    <p><strong>Conseil :</strong> Créer votre propre mini-framework est un excellent exercice d'apprentissage, mais pour les projets en production, envisagez d'utiliser un framework établi qui bénéficie de mises à jour régulières, d'une communauté active et d'une documentation solide.</p>

                    <h4>Frameworks MVC PHP populaires :</h4>
                    <ul>
                        <li><strong>Laravel</strong> : Le framework PHP le plus populaire, avec un écosystème riche et une syntaxe élégante.</li>
                        <li><strong>Symfony</strong> : Un framework robuste et modulaire, utilisé par de nombreuses entreprises pour des projets complexes.</li>
                        <li><strong>CodeIgniter</strong> : Un framework léger et simple à apprendre, idéal pour les débutants.</li>
                        <li><strong>Yii</strong> : Un framework performant avec une génération de code intégrée.</li>
                        <li><strong>Slim</strong> : Un micro-framework minimaliste, parfait pour les petites applications et les API.</li>
                    </ul>
                </div>
            </section>
            <section class="section">
                <h2>Exemple concret : Blog MVC</h2>
                <p>Pour illustrer l'architecture MVC, nous allons voir un exemple concret d'un système de blog simple.</p>

                <h3>Structure de notre blog MVC</h3>
                <pre><code>
blog-mvc/
├── app/
│   ├── controllers/
│   │   ├── ArticleController.php
│   │   ├── CommentController.php
│   │   ├── UserController.php
│   │   └── HomeController.php
│   ├── models/
│   │   ├── ArticleModel.php
│   │   ├── CommentModel.php
│   │   └── UserModel.php
│   └── views/
│       ├── articles/
│       │   ├── index.php
│       │   ├── view.php
│       │   ├── create.php
│       │   └── edit.php
│       ├── users/
│       │   ├── login.php
│       │   └── register.php
│       └── layouts/
│           └── default.php
├── config/
│   ├── config.php
│   └── database.php
├── core/
│   ├── Model.php
│   ├── Controller.php
│   ├── View.php
│   └── Router.php
└── public/
    ├── index.php
    ├── css/
    ├── js/
    └── .htaccess
</code></pre>

                <h3>Création d'un article - Flux complet</h3>
                <p>Analysons comment la création d'un article fonctionne dans notre architecture MVC :</p>

                <h4>1. Le routeur (public/index.php)</h4>
                <div class="example-box">
                    <pre><code>
<span class="comment">// Le Front Controller reçoit la requête /article/create</span>
<span class="variable">$router</span> = <span class="keyword">new</span> <span class="class">Router</span>(<span class="variable">$db</span>);
<span class="variable">$router</span>-><span class="function">get</span>(<span class="string">'/article/create'</span>, [<span class="string">'ArticleController'</span>, <span class="string">'create'</span>]);
<span class="variable">$router</span>-><span class="function">post</span>(<span class="string">'/article/store'</span>, [<span class="string">'ArticleController'</span>, <span class="string">'store'</span>]);
<span class="variable">$router</span>-><span class="function">dispatch</span>();
</code></pre>
                    <p><strong>Explication :</strong> Le routeur définit deux routes : une pour afficher le formulaire de création (GET) et une pour traiter la soumission du formulaire (POST).</p>
                </div>

                <h4>2. Le contrôleur (app/controllers/ArticleController.php)</h4>
                <div class="example-box">
                    <pre><code>
<span class="keyword">class</span> <span class="class">ArticleController</span> <span class="keyword">extends</span> <span class="class">Controller</span> {
    <span class="keyword">private</span> <span class="variable">$articleModel</span>;
    <span class="keyword">private</span> <span class="variable">$categoryModel</span>;
    
    <span class="keyword">public function</span> <span class="function">__construct</span>(<span class="variable">$db</span>) {
        <span class="keyword">parent</span>::<span class="function">__construct</span>(<span class="variable">$db</span>);
        <span class="variable">$this->articleModel</span> = <span class="keyword">new</span> <span class="class">ArticleModel</span>(<span class="variable">$db</span>);        <span class="variable">$this->categoryModel</span> = <span class="keyword">new</span> <span class="class">CategoryModel</span>(<span class="variable">$db</span>);
        
        <span class="comment">// Vérifier l'authentification pour certaines actions</span>
        <span class="variable">$this</span>-><span class="function">requireAuth</span>([<span class="string">'create'</span>, <span class="string">'store'</span>, <span class="string">'edit'</span>, <span class="string">'update'</span>, <span class="string">'delete'</span>]);
    }
    
    <span class="comment">// Afficher le formulaire de création</span>
    <span class="keyword">public function</span> <span class="function">create</span>() {
        <span class="variable">$categories</span> = <span class="variable">$this->categoryModel</span>-><span class="function">all</span>();
        
        <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'articles/create'</span>, <span class="string">'default'</span>, [
            <span class="string">'title'</span> => <span class="string">'Créer un article'</span>,
            <span class="string">'categories'</span> => <span class="variable">$categories</span>
        ]);
    }
    
    <span class="comment">// Traiter la soumission du formulaire</span>
    <span class="keyword">public function</span> <span class="function">store</span>() {
        <span class="comment">// Valider et nettoyer les données du formulaire</span>
        <span class="variable">$title</span> = <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'title'</span>] ?? <span class="string">''</span>);
        <span class="variable">$content</span> = <span class="function">trim</span>(<span class="variable">$_POST</span>[<span class="string">'content'</span>] ?? <span class="string">''</span>);
        <span class="variable">$categoryId</span> = <span class="variable">$_POST</span>[<span class="string">'category_id'</span>] ?? <span class="keyword">null</span>;
        <span class="variable">$userId</span> = <span class="variable">$_SESSION</span>[<span class="string">'user_id'</span>];
        
        <span class="variable">$errors</span> = [];
        
        <span class="comment">// Validation des données</span>
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$title</span>)) {
            <span class="variable">$errors</span>[<span class="string">'title'</span>] = <span class="string">"Le titre est obligatoire."</span>;
        } <span class="keyword">elseif</span> (<span class="function">strlen</span>(<span class="variable">$title</span>) > 255) {
            <span class="variable">$errors</span>[<span class="string>'title'</span>] = <span class="string">"Le titre ne doit pas dépasser 255 caractères."</span>;
        }
        
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$content</span>)) {
            <span class="variable">$errors</span>[<span class="string">'content'</span>] = <span class="string">"Le contenu est obligatoire."</span>;
        }
        
        <span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$categoryId</span>)) {
            <span class="variable">$errors</span>[<span class="string">'category_id'</span>] = <span class="string">"La catégorie est obligatoire."</span>;
        }
          <span class="comment">// S'il y a des erreurs, réafficher le formulaire</span>
        <span class="keyword">if</span> (!<span class="function">empty</span>(<span class="variable">$errors</span>)) {
            <span class="variable">$categories</span> = <span class="variable">$this->categoryModel</span>-><span class="function">all</span>();
            
            <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'articles/create'</span>, <span class="string">'default'</span>, [
                <span class="string">'title'</span> => <span class="string">'Créer un article'</span>,
                <span class="string>'categories'</span> => <span class="variable">$categories</span>,
                <span class="string">'errors'</span> => <span class="variable">$errors</span>,
                <span class="string">'article'</span> => [
                    <span class="string">'title'</span> => <span class="variable">$title</span>,
                    <span class="string">'content'</span> => <span class="variable">$content</span>,
                    <span class="string">'category_id'</span> => <span class="variable">$categoryId</span>
                ]
            ]);
            <span class="keyword">return</span>;
        }
          <span class="comment">// Création de l'article</span>
        <span class="variable">$articleData</span> = [
            <span class="string">'title'</span> => <span class="variable">$title</span>,
            <span class="string">'content'</span> => <span class="variable">$content</span>,
            <span class="string">'category_id'</span> => <span class="variable">$categoryId</span>,
            <span class="string">'user_id'</span> => <span class="variable">$userId</span>,
            <span class="string">'created_at'</span> => <span class="function">date</span>(<span class="string">'Y-m-d H:i:s'</span>)
        ];
        
        <span class="comment">// Gérer l'upload d'image si présent</span>
        <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$_FILES</span>[<span class="string">'image'</span>]) && <span class="variable">$_FILES</span>[<span class="string">'image'</span>][<span class="string">'error'</span>] === <span class="constant">UPLOAD_ERR_OK</span>) {
            <span class="variable">$uploadResult</span> = <span class="variable">$this</span>-><span class="function">uploadImage</span>(<span class="variable">$_FILES</span>[<span class="string">'image'</span>]);
            <span class="keyword">if</span> (<span class="variable">$uploadResult</span>[<span class="string">'success'</span>]) {
                <span class="variable">$articleData</span>[<span class="string">'image_path'</span>] = <span class="variable">$uploadResult</span>[<span class="string">'path'</span>];
            } <span class="keyword">else</span> {
                <span class="variable">$errors</span>[<span class="string">'image'</span>] = <span class="variable">$uploadResult</span>[<span class="string">'error'</span>];
                
                <span class="comment">// Réafficher le formulaire avec l'erreur d'image</span>
                <span class="variable">$categories</span> = <span class="variable">$this->categoryModel</span>-><span class="function">all</span>();
                <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'articles/create'</span>, <span class="string">'default'</span>, [
                    <span class="string">'title'</span> => <span class="string">'Créer un article'</span>,
                    <span class="string>'categories'</span> => <span class="variable">$categories</span>,
                    <span class="string">'errors'</span> => <span class="variable">$errors</span>,
                    <span class="string">'article'</span> => [
                        <span class="string">'title'</span> => <span class="variable">$title</span>,
                        <span class="string">'content'</span> => <span class="variable">$content</span>,
                        <span class="string>'category_id'</span> => <span class="variable">$categoryId</span>
                    ]
                ]);
                <span class="keyword">return</span>;
            }
        }
        
        <span class="comment">// Sauvegarder l'article</span>
        <span class="variable">$articleId</span> = <span class="variable">$this->articleModel</span>-><span class="function">create</span>(<span class="variable">$articleData</span>);
        
        <span class="keyword">if</span> (<span class="variable">$articleId</span>) {
            <span class="comment">// Succès : rediriger vers l'article créé</span>
            <span class="variable">$_SESSION</span>[<span class="string>'success'</span>] = <span class="string">"Article créé avec succès !"</span>;
            <span class="function">header</span>(<span class="string">"Location: /article/view/$articleId"</span>);
            <span class="keyword">exit</span>;
        } <span class="keyword">else</span> {
            <span class="comment">// Erreur : réafficher le formulaire</span>
            <span class="variable">$categories</span> = <span class="variable">$this->categoryModel</span>-><span class="function">all</span>();
            <span class="variable">$errors</span>[<span class="string">'db'</span>] = <span class="string">"Erreur lors de la création de l'article. Veuillez réessayer."</span>;
            
            <span class="keyword">echo</span> <span class="class">View</span>::<span class="function">renderWithLayout</span>(<span class="string">'articles/create'</span>, <span class="string">'default'</span>, [
                <span class="string">'title'</span> => <span class="string">'Créer un article'</span>,
                <span class="string>'categories'</span> => <span class="variable">$categories</span>,
                <span class="string">'errors'</span> => <span class="variable">$errors</span>,
                <span class="string">'article'</span> => [
                    <span class="string">'title'</span> => <span class="variable">$title</span>,
                    <span class="string">'content'</span> => <span class="variable">$content</span>,
                    <span class="string>'category_id'</span> => <span class="variable">$categoryId</span>
                ]
            ]);
        }
    }
      <span class="comment">// Méthode auxiliaire pour l'upload d'image</span>
    <span class="keyword">private function</span> <span class="function">uploadImage</span>(<span class="variable">$file</span>) {
        <span class="variable">$targetDir</span> = <span class="constant">ROOT</span> . <span class="string">'/public/uploads/articles/'</span>;
        <span class="variable">$filename</span> = <span class="function">uniqid</span>() . <span class="string">'_'</span> . <span class="function">basename</span>(<span class="variable">$file</span>[<span class="string">'name'</span>]);
        <span class="variable">$targetPath</span> = <span class="variable">$targetDir</span> . <span class="variable">$filename</span>;
        <span class="variable">$uploadPath</span> = <span class="string">'/uploads/articles/'</span> . <span class="variable">$filename</span>;
        
        <span class="comment">// Vérifier le type de fichier</span>
        <span class="variable">$allowedTypes</span> = [<span class="string">'image/jpeg'</span>, <span class="string">'image/png'</span>, <span class="string">'image/gif'</span>];
        <span class="keyword">if</span> (!<span class="function">in_array</span>(<span class="variable">$file</span>[<span class="string">'type'</span>], <span class="variable">$allowedTypes</span>)) {
            <span class="keyword">return</span> [
                <span class="string">'success'</span> => <span class="keyword">false</span>, 
                <span class="string">'error'</span> => <span class="string">"Type de fichier non autorisé. Utilisez JPG, PNG ou GIF."</span>
            ];
        }
        
        <span class="comment">// Vérifier la taille</span>
        <span class="keyword">if</span> (<span class="variable">$file</span>[<span class="string">'size'</span>] > 2000000) { <span class="comment">// 2MB</span>
            <span class="keyword">return</span> [
                <span class="string">'success'</span> => <span class="keyword">false</span>, 
                <span class="string">'error'</span> => <span class="string">"L'image ne doit pas dépasser 2MB."</span>
            ];
        }
        
        <span class="comment">// Déplacer le fichier uploadé</span>
        <span class="keyword">if</span> (<span class="function">move_uploaded_file</span>(<span class="variable">$file</span>[<span class="string">'tmp_name'</span>], <span class="variable">$targetPath</span>)) {
            <span class="keyword">return</span> [<span class="string">'success'</span> => <span class="keyword">true</span>, <span class="string">'path'</span> => <span class="variable">$uploadPath</span>];
        } <span class="keyword">else</span> {
            <span class="keyword">return</span> [
                <span class="string">'success'</span> => <span class="keyword">false</span>, 
                <span class="string">'error'</span> => <span class="string">"Erreur lors de l'upload de l'image."</span>
            ];
        }
    }
    
    // Autres méthodes (index, view, edit, update, delete...)
}
</code></pre>
                    <p><strong>Explication :</strong> Ce contrôleur montre deux méthodes principales : <code>create()</code> qui affiche le formulaire de création d'article, et <code>store()</code> qui traite la soumission du formulaire. Il gère la validation des données, l'upload d'images, et la création de l'article via le modèle. En cas d'erreur, il réaffiche le formulaire avec les messages d'erreur.</p>
                </div>

                <h4>3. Le modèle (app/models/ArticleModel.php)</h4>
                <div class="example-box">
                    <pre><code>
<span class="keyword">class</span> <span class="class">ArticleModel</span> <span class="keyword">extends</span> <span class="class">Model</span> {
    <span class="keyword">protected</span> <span class="variable">$table</span> = <span class="string">'articles'</span>;
    
    <span class="comment">// Récupérer un article avec les données associées</span>
    <span class="keyword">public function</span> <span class="function">getArticleWithDetails</span>(<span class="variable">$id</span>) {
        <span class="variable">$sql</span> = <span class="string">"
            SELECT a.*, u.username as author_name, c.name as category_name 
            FROM {$this->table} a
            JOIN users u ON a.user_id = u.id
            JOIN categories c ON a.category_id = c.id
            WHERE a.id = :id
        "</span>;
        
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$sql</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':id'</span>, <span class="variable">$id</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetch</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
      <span class="comment">// Récupérer tous les articles avec pagination</span>
    <span class="keyword">public function</span> <span class="function">getAllWithPagination</span>(<span class="variable">$page</span> = 1, <span class="variable">$perPage</span> = 10) {
        <span class="variable">$offset</span> = (<span class="variable">$page</span> - 1) * <span class="variable">$perPage</span>;
        
        <span class="variable">$sql</span> = <span class="string">"
            SELECT a.*, u.username as author_name, c.name as category_name 
            FROM {$this->table} a
            JOIN users u ON a.user_id = u.id
            JOIN categories c ON a.category_id = c.id
            ORDER BY a.created_at DESC
            LIMIT :offset, :perPage
        "</span>;
        
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$sql</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':offset'</span>, <span class="variable">$offset</span>, <span class="class">PDO</span>::<span class="constant">PARAM_INT</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':perPage'</span>, <span class="variable">$perPage</span>, <span class="class">PDO</span>::<span class="constant">PARAM_INT</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
          <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
    
    <span class="comment">// Compter le nombre total d'articles</span>
    <span class="keyword">public function</span> <span class="function">countAll</span>() {
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="string">"SELECT COUNT(*) FROM {$this->table}"</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchColumn</span>();
    }
    
    <span class="comment">// Rechercher des articles</span>
    <span class="keyword">public function</span> <span class="function">search</span>(<span class="variable">$keyword</span>) {
        <span class="variable">$keyword</span> = <span class="string">"%$keyword%"</span>;
        
        <span class="variable">$sql</span> = <span class="string">"
            SELECT a.*, u.username as author_name, c.name as category_name 
            FROM {$this->table} a
            JOIN users u ON a.user_id = u.id
            JOIN categories c ON a.category_id = c.id
            WHERE a.title LIKE :keyword OR a.content LIKE :keyword
            ORDER BY a.created_at DESC
        "</span>;
        
        <span class="variable">$stmt</span> = <span class="variable">$this->db</span>-><span class="function">prepare</span>(<span class="variable">$sql</span>);
        <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':keyword'</span>, <span class="variable">$keyword</span>);
        <span class="variable">$stmt</span>-><span class="function">execute</span>();
        
        <span class="keyword">return</span> <span class="variable">$stmt</span>-><span class="function">fetchAll</span>(<span class="class">PDO</span>::<span class="constant">FETCH_ASSOC</span>);
    }
}
</code></pre>
                    <p><strong>Explication :</strong> Ce modèle étend le modèle de base et ajoute des méthodes spécifiques aux articles. Il peut récupérer un article avec ses données associées (auteur, catégorie), récupérer une liste paginée d'articles, compter le nombre total d'articles, et effectuer des recherches. Il hérite déjà des méthodes CRUD de base (create, find, update, delete) de la classe parente.</p>
                </div>

                <h4>4. La vue (app/views/articles/create.php)</h4>
                <div class="example-box">
                    <pre><code>
<span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"container"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;h1&gt;</span><span class="tag">&lt;?=</span> <span class="variable">$title</span> <span class="tag">?&gt;</span><span class="tag">&lt;/h1&gt;</span>
    
    <span class="tag">&lt;?php</span> <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$errors</span>) && !<span class="function">empty</span>(<span class="variable">$errors</span>)): <span class="tag">?&gt;</span>
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"alert alert-danger"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;ul&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">foreach</span> (<span class="variable">$errors</span> <span class="keyword">as</span> <span class="variable">$error</span>): <span class="tag">?&gt;</span>
                    <span class="tag">&lt;li&gt;</span><span class="tag">&lt;?=</span> <span class="variable">$error</span> <span class="tag">?&gt;</span><span class="tag">&lt;/li&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">endforeach</span>; <span class="tag">?&gt;</span>
            <span class="tag">&lt;/ul&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
    <span class="tag">&lt;?php</span> <span class="keyword">endif</span>; <span class="tag">?&gt;</span>
    
    <span class="tag">&lt;form</span> <span class="attr">action</span>=<span class="string">"/article/store"</span> <span class="attr">method</span>=<span class="string">"post"</span> <span class="attr">enctype</span>=<span class="string">"multipart/form-data"</span><span class="tag">&gt;</span>
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"title"</span><span class="tag">&gt;</span>Titre<span class="tag">&lt;/label&gt;</span>
            <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"text"</span> <span class="attr">id</span>=<span class="string">"title"</span> <span class="attr">name</span>=<span class="string">"title"</span> <span class="attr">class</span>=<span class="string">"form-control"</span> 
                   <span class="attr">value</span>=<span class="string">"&lt;?= htmlspecialchars(isset($article['title']) ? $article['title'] : '') ?&gt;"</span> <span class="attr">required</span><span class="tag">&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
        
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"category"</span><span class="tag">&gt;</span>Catégorie<span class="tag">&lt;/label&gt;</span>
            <span class="tag">&lt;select</span> <span class="attr">id</span>=<span class="string">"category"</span> <span class="attr">name</span>=<span class="string">"category_id"</span> <span class="attr">class</span>=<span class="string">"form-control"</span> <span class="attr">required</span><span class="tag">&gt;</span>
                <span class="tag">&lt;option</span> <span class="attr">value</span>=<span class="string">""</span><span class="tag">&gt;</span>Choisir une catégorie<span class="tag">&lt;/option&gt;</span>
                <span class="tag">&lt;?php</span> <span class="keyword">if</span> (<span class="function">isset</span>(<span class="variable">$categories</span>) && <span class="function">is_array</span>(<span class="variable">$categories</span>)): <span class="keyword">foreach</span> (<span class="variable">$categories</span> <span class="keyword">as</span> <span class="variable">$category</span>): <span class="tag">?&gt;</span>                    <span class="tag">&lt;option</span> <span class="attr">value</span>=<span class="string">"&lt;?= $category['id'] ?? '' ?&gt;"</span> 
                        <span class="tag">&lt;?=</span> (<span class="function">isset</span>(<span class="variable">$article</span>[<span class="string">'category_id'</span>]) && <span class="function">isset</span>(<span class="variable">$category</span>[<span class="string">'id'</span>]) && <span class="variable">$article</span>[<span class="string>'category_id'</span>] == <span class="variable">$category</span>[<span class="string>'id'</span>]) ? <span class="string">'selected'</span> : <span class="string">''</span> <span class="tag">?&gt;</span><span class="tag">&gt;</span>                        <span class="tag">&lt;?=</span> <span class="function">htmlspecialchars</span>(<span class="variable">$category</span>[<span class="string>'name'</span>] ?? <span class="string">''</span>) <span class="tag">?&gt;</span>
                    <span class="tag">&lt;/option&gt;</span>
            <span class="tag">&lt;/select&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
        
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"content"</span><span class="tag">&gt;</span>Contenu<span class="tag">&lt;/label&gt;</span>
            <span class="tag">&lt;textarea</span> <span class="attr">id</span>=<span class="string">"content"</span> <span class="attr">name</span>=<span class="string">"content"</span> <span class="attr">class</span>=<span class="string">"form-control"</span> <span class="attr">rows</span>=<span class="string">"10"</span> <span class="attr">required</span><span class="tag">&gt;</span><span class="tag">&lt;?=</span> <span class="function">htmlspecialchars</span>(<span class="function">isset</span>(<span class="variable">$article</span>[<span class="string">'content'</span>]) ? <span class="variable">$article</span>[<span class="string">'content'</span>] : <span class="string">''</span>) <span class="tag">?&gt;</span><span class="tag">&lt;/textarea&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
        
        <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"form-group"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;label</span> <span class="attr">for</span>=<span class="string">"image"</span><span class="tag">&gt;</span>Image (optionnelle)<span class="tag">&lt;/label&gt;</span>
            <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"file"</span> <span class="attr">id</span>=<span class="string">"image"</span> <span class="attr">name</span>=<span class="string">"image"</span> <span class="attr">class</span>=<span class="string">"form-control-file"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;small</span> <span class="attr">class</span>=<span class="string">"form-text text-muted"</span><span class="tag">&gt;</span>Formats acceptés : JPG, PNG, GIF. Max 2MB.<span class="tag">&lt;/small&gt;</span>
        <span class="tag">&lt;/div&gt;</span>          <span class="tag">&lt;div</span> <span class="attr">class</span>=<span class="string">"navigation"</span><span class="tag">&gt;</span>
            <span class="tag">&lt;button</span> <span class="attr">type</span>=<span class="string">"submit"</span> <span class="attr">class</span>=<span class="string">"nav-button"</span><span class="tag">&gt;</span>Publier l'article<span class="tag">&lt;/button&gt;</span>
            <span class="tag">&lt;a</span> <span class="attr">href</span>=<span class="string">"/articles"</span> <span class="attr">class</span>=<span class="string">"nav-button"</span><span class="tag">&gt;</span>Annuler<span class="tag">&lt;/a&gt;</span>
        <span class="tag">&lt;/div&gt;</span>
    <span class="tag">&lt;/form&gt;</span>
<span class="tag">&lt;/div&gt;</span>

<span class="tag">&lt;script&gt;</span>
    <span class="comment">// JavaScript pour initialiser un éditeur de texte riche (optionnel)</span>
    <span class="keyword">document</span>.<span class="function">addEventListener</span>(<span class="string">'DOMContentLoaded'</span>, <span class="keyword">function</span>() {
        <span class="comment">// Si vous utilisez un éditeur comme TinyMCE ou CKEditor</span>
        <span class="comment">// tinymce.init({ selector: '#content' });</span>
    });
<span class="tag">&lt;/script&gt;</span>
</code></pre>
                    <p><strong>Explication :</strong> Cette vue affiche un formulaire de création d'article avec des champs pour le titre, la catégorie, le contenu et une image optionnelle. Elle gère l'affichage des erreurs de validation et prérempli les champs avec les valeurs précédemment soumises en cas d'erreur. Elle inclut également un espace pour initialiser un éditeur de texte riche si nécessaire.</p>
                </div>

                <h3>Avantages de cette architecture</h3>
                <ul>
                    <li><strong>Séparation des préoccupations</strong> : Chaque partie a une responsabilité claire</li>
                    <li><strong>Organisation</strong> : Code structuré et facile à naviguer</li>
                    <li><strong>Sécurité</strong> : Validation centralisée, préparation des requêtes SQL</li>
                    <li><strong>Évolutivité</strong> : Facile d'ajouter de nouvelles fonctionnalités</li>
                    <li><strong>Maintenabilité</strong> : Modification d'une partie sans affecter les autres</li>
                </ul>

                <p>Cet exemple montre comment les trois composants MVC travaillent ensemble pour créer une fonctionnalité complète. Le modèle gère les données, le contrôleur coordonne le processus, et la vue présente l'interface utilisateur.</p>
            </section>

            <section class="section">
                <h2>Conclusion</h2>
                <p>L'architecture MVC est un pilier du développement web moderne, particulièrement pour les applications PHP complexes. En séparant clairement les responsabilités entre :</p>
                <ul>
                    <li>Le <strong>Modèle</strong> qui gère les données et la logique métier</li>
                    <li>La <strong>Vue</strong> qui s'occupe de la présentation</li>
                    <li>Le <strong>Contrôleur</strong> qui coordonne l'ensemble</li>
                </ul>

                <p>Elle vous permet de développer des applications plus structurées, plus maintenables et plus évolutives. Les concepts que vous avez appris dans ce module sont utilisés dans tous les frameworks PHP populaires comme Laravel, Symfony, CodeIgniter, etc.</p>

                <p>À mesure que vous progresserez, vous pourrez explorer des concepts plus avancés comme :</p>
                <ul>
                    <li>L'injection de dépendances</li>
                    <li>Les services et repositories</li>
                    <li>L'architecture en couches</li>
                    <li>Les tests unitaires et fonctionnels</li>
                </ul>

                <p>Mais les bases solides du MVC que vous avez acquises vous serviront tout au long de votre parcours de développeur PHP.</p>

                <div class="info-box">
                    <p><strong>Pour aller plus loin :</strong> Essayez de construire votre propre petit framework MVC, ou explorez des frameworks comme Laravel ou Symfony qui implémentent l'architecture MVC de manière professionnelle et offrent de nombreuses fonctionnalités avancées.</p>
                </div>
            </section>
            <div class="navigation">
                <a href="14-securite.php" class="nav-button">← Module précédent</a>
                <a href="../../index.php" class="nav-button">Accueil</a>
                <a href="16-api-externes.php" class="nav-button">Module suivant →</a>
            </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>