<?php include __DIR__ . '/../includes/header.php'; ?>

<body class="module12">
    <header>
        <h1>Bases de données avec PHP</h1>
        <p class="subtitle">Maîtrisez l'interaction avec les bases de données MySQL en PHP : connexion, requêtes SQL, et PDO.</p>
    </header>
    <div class="navigation">
        <a href="11-POO-avancee.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="13-php-ajax.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction aux bases de données en PHP</h2>
            <p>PHP offre plusieurs moyens d'interagir avec les bases de données, particulièrement avec MySQL qui reste l'une des combinaisons les plus populaires pour le développement web. Dans ce module, nous explorerons :</p>
            <ul>
                <li>Les principes fondamentaux des bases de données relationnelles</li>
                <li>La connexion à une base de données MySQL depuis PHP</li>
                <li>L'utilisation de PHP Data Objects (PDO) pour une approche moderne et sécurisée</li>
                <li>L'exécution de requêtes SQL pour manipuler les données</li>
            </ul>

            <div class="info-box">
                <p><strong>Prérequis :</strong> Pour ce module, vous devez avoir un serveur MySQL/MariaDB installé (comme celui inclus dans WAMP, XAMPP ou MAMP) et des connaissances de base en SQL.</p>
            </div>

            <h3>Pourquoi utiliser des bases de données ?</h3>
            <p>Les bases de données sont essentielles au développement web moderne pour plusieurs raisons :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Persistance des données</div>
                    <div class="example-content">
                        <p>Contrairement aux variables PHP qui disparaissent à la fin de l'exécution du script, les données stockées dans une base de données restent disponibles entre les différentes requêtes et sessions.</p>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Structuration</div>
                    <div class="example-content">
                        <p>Les bases de données relationnelles permettent d'organiser les informations selon un modèle structuré (tables, colonnes) qui facilite leur gestion et maintient leur intégrité.</p>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Performance</div>
                    <div class="example-content">
                        <p>Les SGBD (Systèmes de Gestion de Bases de Données) sont optimisés pour effectuer des opérations rapides sur de grands volumes de données, grâce notamment aux index et aux requêtes optimisées.</p>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Sécurité</div>
                    <div class="example-content">
                        <p>Les SGBD offrent des mécanismes avancés pour sécuriser les données : gestion fine des permissions, validation de l'intégrité, journalisation des modifications, etc.</p>
                    </div>
                </div>
            </div>

            <h3>Types de SGBD courants</h3>
            <p>Il existe plusieurs types de systèmes de gestion de bases de données, chacun avec ses avantages :</p>
            <ul>
                <li><strong>MySQL/MariaDB</strong> : Très populaire pour le web, open-source, facile à utiliser, parfait pour les applications de petite à moyenne taille</li>
                <li><strong>PostgreSQL</strong> : Plus avancé techniquement, supporte des fonctionnalités complexes, idéal pour les applications critiques</li>
                <li><strong>SQLite</strong> : Base de données légère stockée dans un fichier, parfaite pour les applications mobiles ou les tests</li>
                <li><strong>MongoDB</strong> : Base NoSQL orientée documents, adaptée aux données non structurées ou semi-structurées</li>
                <li><strong>Oracle/SQL Server</strong> : Solutions commerciales robustes pour les grandes entreprises</li>
            </ul>

            <div class="tip-box">
                <p><strong>Conseil :</strong> Pour la majorité des projets web PHP, la combinaison MySQL/MariaDB avec PDO offre un excellent équilibre entre simplicité, performance et fiabilité.</p>
            </div>
        </section>

        <section class="section">
            <h2>Connexion à une base de données MySQL</h2>
            <p>PHP propose trois principales approches pour se connecter à une base de données MySQL :</p>

            <h3>1. L'extension MySQL (obsolète)</h3>
            <p>Cette extension est obsolète depuis PHP 5.5.0 et a été retirée de PHP 7. Elle ne doit plus être utilisée.</p>

            <h3>2. L'extension MySQLi (MySQL amélioré)</h3>
            <p>MySQLi est une extension améliorée spécifique à MySQL avec une interface procédurale et orientée objet.</p>

            <div class="example">
                <div class="example-header">Connexion avec MySQLi (Orientée Objet)</div>
                <div class="example-content">
                    <pre><code>
<span class="comment">// Connexion à la base de données avec MySQLi (Orientée Objet)</span>
<span class="variable">$servername</span> = <span class="string">"localhost"</span>;
<span class="variable">$username</span> = <span class="string">"root"</span>;
<span class="variable">$password</span> = <span class="string">""</span>; <span class="comment">// Généralement vide sur les installations locales</span>
<span class="variable">$dbname</span> = <span class="string">"ma_base"</span>;

<span class="comment">// Création de la connexion</span>
<span class="variable">$conn</span> = <span class="keyword">new</span> <span class="function">mysqli</span>(<span class="variable">$servername</span>, <span class="variable">$username</span>, <span class="variable">$password</span>, <span class="variable">$dbname</span>);

<span class="comment">// Vérification de la connexion</span>
<span class="keyword">if</span> (<span class="variable">$conn</span>-><span class="property">connect_error</span>) {
    <span class="function">die</span>(<span class="string">"La connexion a échoué : "</span> . <span class="variable">$conn</span>-><span class="property">connect_error</span>);
}

<span class="function">echo</span> <span class="string">"Connexion réussie"</span>;

<span class="comment">// Fermeture de la connexion en fin de script</span>
<span class="variable">$conn</span>-><span class="function">close</span>();
</code></pre>
                </div>
            </div>

            <h3>3. PDO (PHP Data Objects)</h3>
            <p>PDO est une interface d'accès aux bases de données qui offre une couche d'abstraction uniforme pour interagir avec différents types de bases de données. C'est l'approche recommandée.</p>

            <div class="example">
                <div class="example-header">Connexion avec PDO</div>
                <div class="example-content">
                    <pre><code>
<span class="comment">// Connexion à la base de données avec PDO</span>
<span class="variable">$servername</span> = <span class="string">"localhost"</span>;
<span class="variable">$username</span> = <span class="string">"root"</span>;
<span class="variable">$password</span> = <span class="string">""</span>;
<span class="variable">$dbname</span> = <span class="string">"ma_base"</span>;

<span class="keyword">try</span> {
    <span class="variable">$dsn</span> = <span class="string">"mysql:host="</span> . <span class="variable">$servername</span> . <span class="string">";dbname="</span> . <span class="variable">$dbname</span> . <span class="string">";charset=utf8mb4"</span>;
    <span class="variable">$options</span> = [
        <span class="constant">PDO::ATTR_ERRMODE</span> => <span class="constant">PDO::ERRMODE_EXCEPTION</span>,
        <span class="constant">PDO::ATTR_DEFAULT_FETCH_MODE</span> => <span class="constant">PDO::FETCH_ASSOC</span>,
        <span class="constant">PDO::ATTR_EMULATE_PREPARES</span> => <span class="keyword">false</span>
    ];
    
    <span class="variable">$pdo</span> = <span class="keyword">new</span> <span class="function">PDO</span>(<span class="variable">$dsn</span>, <span class="variable">$username</span>, <span class="variable">$password</span>, <span class="variable">$options</span>);
    
    <span class="function">echo</span> <span class="string">"Connexion réussie"</span>;
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">die</span>(<span class="string">"Erreur de connexion : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>());
}
</code></pre>
                </div>
            </div>

            <h3>Explication détaillée des options PDO</h3>
            <p>Comprendre les options de configuration de PDO est crucial pour une utilisation optimale :</p>

            <div class="example">
                <div class="example-header">Options de configuration PDO</div>
                <div class="example-content">
                    <table style="width:100%; border-collapse: collapse;">
                        <tr style="background-color: var(--primary-color); color: white;">
                            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Option</th>
                            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Description</th>
                            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Valeurs possibles</th>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border: 1px solid #ddd;"><code>PDO::ATTR_ERRMODE</code></td>
                            <td style="padding: 8px; border: 1px solid #ddd;">Mode de gestion des erreurs</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                <ul>
                                    <li><code>PDO::ERRMODE_SILENT</code> (défaut) : codes d'erreur à récupérer manuellement</li>
                                    <li><code>PDO::ERRMODE_WARNING</code> : déclenche des E_WARNING</li>
                                    <li><code>PDO::ERRMODE_EXCEPTION</code> (recommandé) : lance des PDOException</li>
                                </ul>
                            </td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 8px; border: 1px solid #ddd;"><code>PDO::ATTR_DEFAULT_FETCH_MODE</code></td>
                            <td style="padding: 8px; border: 1px solid #ddd;">Format de retour par défaut des données</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                <ul>
                                    <li><code>PDO::FETCH_ASSOC</code> (recommandé) : tableau associatif</li>
                                    <li><code>PDO::FETCH_NUM</code> : tableau indexé numériquement</li>
                                    <li><code>PDO::FETCH_BOTH</code> : les deux formats</li>
                                    <li><code>PDO::FETCH_OBJ</code> : objet anonyme</li>
                                    <li><code>PDO::FETCH_CLASS</code> : instance d'une classe spécifiée</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border: 1px solid #ddd;"><code>PDO::ATTR_EMULATE_PREPARES</code></td>
                            <td style="padding: 8px; border: 1px solid #ddd;">Contrôle si PDO émule les requêtes préparées</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                <ul>
                                    <li><code>true</code> (défaut) : PDO émule les requêtes préparées</li>
                                    <li><code>false</code> (recommandé) : utilise les requêtes préparées natives du pilote</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Avantages de PDO :</strong></p>
                <ul>
                    <li>Compatible avec plusieurs systèmes de base de données (MySQL, PostgreSQL, SQLite, etc.)</li>
                    <li>Protection native contre les injections SQL via les requêtes préparées</li>
                    <li>Interface orientée objet moderne</li>
                    <li>Gestion d'erreurs efficace avec les exceptions</li>
                    <li>Possibilité de changer facilement de SGBD en modifiant seulement le DSN</li>
                    <li>Support des transactions et autres fonctionnalités avancées</li>
                </ul>
            </div>

            <div class="warning-box">
                <p><strong>DSN (Data Source Name) :</strong> La chaîne DSN varie selon le type de base de données :</p>
                <ul>
                    <li><code>mysql:host=localhost;dbname=ma_base;charset=utf8mb4</code> (pour MySQL/MariaDB)</li>
                    <li><code>pgsql:host=localhost;dbname=ma_base;user=nom;password=pass</code> (pour PostgreSQL)</li>
                    <li><code>sqlite:/chemin/vers/fichier.sqlite</code> (pour SQLite)</li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2>Exécuter des requêtes SQL avec PDO</h2>

            <h3>Création d'une table</h3>
            <div class="example">
                <div class="example-header">Création d'une table utilisateurs</div>
                <div class="example-content">
                    <pre class="sql-sample"><code>
<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">utilisateurs</span> (
    <span class="sql-column">id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">AUTO_INCREMENT</span> <span class="sql-keyword">PRIMARY KEY</span>,
    <span class="sql-column">nom</span> <span class="sql-keyword">VARCHAR</span>(100) <span class="sql-keyword">NOT NULL</span>,
    <span class="sql-column">email</span> <span class="sql-keyword">VARCHAR</span>(100) <span class="sql-keyword">UNIQUE</span> <span class="sql-keyword">NOT NULL</span>,
    <span class="sql-column">mot_de_passe</span> <span class="sql-keyword">VARCHAR</span>(255) <span class="sql-keyword">NOT NULL</span>,
    <span class="sql-column">date_inscription</span> <span class="sql-keyword">TIMESTAMP</span> <span class="sql-keyword">DEFAULT</span> <span class="sql-keyword">CURRENT_TIMESTAMP</span>
);
</code></pre>
                </div>
            </div>

            <h3>Exécuter cette requête avec PDO</h3>
            <div class="example">
                <div class="example-header">Créer une table avec PDO</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="variable">$sql</span> = <span class="string">"CREATE TABLE utilisateurs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        mot_de_passe VARCHAR(255) NOT NULL,
        date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"</span>;
    
    <span class="comment">// Utilisez exec() pour les requêtes qui ne retournent pas de résultats</span>
    <span class="variable">$pdo</span>-><span class="function">exec</span>(<span class="variable">$sql</span>);
    
    <span class="function">echo</span> <span class="string">"Table utilisateurs créée avec succès"</span>;
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur lors de la création de la table : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>

            <h3>Insertion de données</h3>
            <div class="example">
                <div class="example-header">Insérer des données avec des requêtes préparées</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="comment">// Préparation de la requête</span>
    <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)"</span>);
    
    <span class="comment">// Association des paramètres</span>
    <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':nom'</span>, <span class="variable">$nom</span>);
    <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':email'</span>, <span class="variable">$email</span>);
    <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':mot_de_passe'</span>, <span class="variable">$mot_de_passe</span>);
    
    <span class="comment">// Définition des valeurs et exécution</span>
    <span class="variable">$nom</span> = <span class="string">"Jean Dupont"</span>;
    <span class="variable">$email</span> = <span class="string">"jean@exemple.com"</span>;
    <span class="variable">$mot_de_passe</span> = <span class="function">password_hash</span>(<span class="string">"motdepasse123"</span>, <span class="constant">PASSWORD_DEFAULT</span>);
    <span class="variable">$stmt</span>-><span class="function">execute</span>();
    
    <span class="function">echo</span> <span class="string">"Nouvel utilisateur créé avec succès"</span>;
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur d'insertion : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>

            <h3>Comprendre les injections SQL</h3>
            <p>Les injections SQL sont parmi les vulnérabilités les plus courantes dans les applications web. Elles se produisent lorsque des données non fiables sont incorporées directement dans une requête SQL.</p>

            <div class="example">
                <div class="example-header">Exemple de code vulnérable</div>
                <div class="example-content">
                    <pre><code>
<span class="comment">// NE JAMAIS FAIRE CECI - Code vulnérable aux injections SQL</span>
<span class="variable">$username</span> = <span class="variable">$_POST</span>[<span class="string">'username'</span>]; <span class="comment">// Imaginons que l'utilisateur entre : "' OR '1'='1"</span>
<span class="variable">$password</span> = <span class="variable">$_POST</span>[<span class="string">'password'</span>];

<span class="variable">$sql</span> = <span class="string">"SELECT * FROM utilisateurs WHERE username = '"</span> . <span class="variable">$username</span> . <span class="string">"' AND password = '"</span> . <span class="variable">$password</span> . <span class="string">"'"</span>;
<span class="comment">// La requête devient : SELECT * FROM utilisateurs WHERE username = '' OR '1'='1' AND password = '...'</span>
<span class="comment">// Ce qui retourne tous les utilisateurs car '1'='1' est toujours vrai</span>

<span class="variable">$result</span> = <span class="variable">$mysqli</span>-><span class="function">query</span>(<span class="variable">$sql</span>); <span class="comment">// Danger !</span>
</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Code sécurisé avec requêtes préparées</div>
                <div class="example-content">
                    <pre><code>
<span class="comment">// BONNE PRATIQUE - Utilisation de requêtes préparées</span>
<span class="variable">$username</span> = <span class="variable">$_POST</span>[<span class="string">'username'</span>]; <span class="comment">// Même si l'utilisateur entre : "' OR '1'='1"</span>
<span class="variable">$password</span> = <span class="variable">$_POST</span>[<span class="string">'password'</span>];

<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM utilisateurs WHERE username = :username AND password = :password"</span>);
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':username'</span>, <span class="variable">$username</span>);
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':password'</span>, <span class="variable">$password</span>);
<span class="variable">$stmt</span>-><span class="function">execute</span>();

<span class="comment">// Les données sont traitées comme des valeurs, pas comme du code SQL</span>
</code></pre>
                </div>
            </div>

            <h3>Différentes méthodes d'utilisation des requêtes préparées</h3>
            <p>PDO offre plusieurs façons d'utiliser les requêtes préparées :</p>

            <div class="example">
                <div class="example-header">Méthode bindParam()</div>
                <div class="example-content">
                    <pre><code>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM produits WHERE categorie = :cat AND prix < :prix"</span>);

<span class="comment">// bindParam() lie une variable par référence - la valeur peut changer après</span>
<span class="variable">$categorie</span> = <span class="string">"électronique"</span>;
<span class="variable">$prix_max</span> = <span class="number">1000</span>;

<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':cat'</span>, <span class="variable">$categorie</span>);
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':prix'</span>, <span class="variable">$prix_max</span>, <span class="constant">PDO::PARAM_INT</span>); <span class="comment">// Spécification du type</span>

<span class="comment">// On peut changer les valeurs avant l'exécution</span>
<span class="variable">$categorie</span> = <span class="string">"informatique"</span>; <span class="comment">// Cette nouvelle valeur sera utilisée</span>

<span class="variable">$stmt</span>-><span class="function">execute</span>();
</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Méthode bindValue()</div>
                <div class="example-content">
                    <pre><code>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM livres WHERE auteur = :auteur AND annee > :annee"</span>);

<span class="comment">// bindValue() lie une valeur directement - pas affectée par les changements ultérieurs</span>
<span class="variable">$auteur</span> = <span class="string">"Victor Hugo"</span>;
<span class="variable">$annee_min</span> = <span class="number">1850</span>;

<span class="variable">$stmt</span>-><span class="function">bindValue</span>(<span class="string">':auteur'</span>, <span class="variable">$auteur</span>);
<span class="variable">$stmt</span>-><span class="function">bindValue</span>(<span class="string">':annee'</span>, <span class="variable">$annee_min</span>, <span class="constant">PDO::PARAM_INT</span>);

<span class="comment">// Changer les valeurs n'affecte pas la requête</span>
<span class="variable">$auteur</span> = <span class="string">"Émile Zola"</span>; <span class="comment">// Cette nouvelle valeur NE sera PAS utilisée</span>

<span class="variable">$stmt</span>-><span class="function">execute</span>();
</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Méthode execute() avec tableau</div>
                <div class="example-content">
                    <pre><code>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"INSERT INTO commandes (client_id, produit_id, quantite, prix_unitaire) 
                     VALUES (:client, :produit, :quantite, :prix)"</span>);

<span class="comment">// Méthode plus concise sans bindParam/bindValue</span>
<span class="variable">$stmt</span>-><span class="function">execute</span>([
    <span class="string">':client'</span> => <span class="number">42</span>,
    <span class="string">':produit'</span> => <span class="number">157</span>,
    <span class="string">':quantite'</span> => <span class="number">3</span>,
    <span class="string">':prix'</span> => <span class="number">29.99</span>
]);

<span class="comment">// Alternative sans les noms de paramètres (plus court)</span>
<span class="variable">$stmt</span>-><span class="function">execute</span>([<span class="number">42</span>, <span class="number">157</span>, <span class="number">3</span>, <span class="number">29.99</span>]);
</code></pre>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>Sécurité importante :</strong> Utilisez toujours des requêtes préparées avec bindParam() ou bindValue() pour vous protéger contre les injections SQL. N'incluez jamais directement des variables dans vos requêtes SQL.</p>
            </div>

            <h3>Récupération de données</h3>
            <div class="example">
                <div class="example-header">Sélectionner des données avec PDO</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="comment">// Préparation et exécution de la requête</span>
    <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">query</span>(<span class="string">"SELECT * FROM utilisateurs"</span>);
    
    <span class="comment">// Récupération de tous les résultats</span>
    <span class="variable">$utilisateurs</span> = <span class="variable">$stmt</span>-><span class="function">fetchAll</span>();
    
    <span class="comment">// Affichage des résultats</span>
    <span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$utilisateurs</span>) > 0) {
        <span class="keyword">foreach</span>(<span class="variable">$utilisateurs</span> <span class="keyword">as</span> <span class="variable">$utilisateur</span>) {
            <span class="function">echo</span> <span class="string">"ID: "</span> . <span class="variable">$utilisateur</span>[<span class="string">'id'</span>] . <span class="string">" - Nom: "</span> . <span class="variable">$utilisateur</span>[<span class="string>'nom'</span>] . <span class="string">" - Email: "</span> . <span class="variable">$utilisateur</span>[<span class="string>'email'</span>] . <span class="string">"<br>"</span>;
        }
    } <span class="keyword">else</span> {
        <span class="function">echo</span> <span class="string">"Aucun utilisateur trouvé"</span>;
    }
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur de requête : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>

            <h3>Recherche avec des critères</h3>
            <div class="example">
                <div class="example-header">Rechercher des utilisateurs par critères</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="variable">$email</span> = <span class="string">"jean@exemple.com"</span>;
    
    <span class="comment">// Préparation de la requête avec condition</span>
    <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM utilisateurs WHERE email = :email"</span>);
    <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':email'</span>, <span class="variable">$email</span>);
    <span class="variable">$stmt</span>-><span class="function">execute</span>();
    
    <span class="comment">// Récupération du résultat</span>
    <span class="variable">$utilisateur</span> = <span class="variable">$stmt</span>-><span class="function">fetch</span>();
    
    <span class="keyword">if</span> (<span class="variable">$utilisateur</span>) {
        <span class="function">echo</span> <span class="string">"Utilisateur trouvé : "</span> . <span class="variable">$utilisateur</span>[<span class="string>'nom'</span>];
    } <span class="keyword">else</span> {
        <span class="function">echo</span> <span class="string">"Aucun utilisateur trouvé avec cet email"</span>;
    }
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur de requête : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Mise à jour et suppression de données</h2>

            <h3>Mise à jour des données</h3>
            <div class="example">
                <div class="example-header">Mettre à jour un utilisateur</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="comment">// Préparation de la requête de mise à jour</span>
    <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"UPDATE utilisateurs SET nom = :nom WHERE id = :id"</span>);
    
    <span class="comment">// Association des paramètres</span>
    <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':nom'</span>, <span class="variable">$nom</span>);
    <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':id'</span>, <span class="variable">$id</span>);
    
    <span class="comment">// Définition des valeurs et exécution</span>
    <span class="variable">$nom</span> = <span class="string">"Jean Martin"</span>;
    <span class="variable">$id</span> = 1;
    <span class="variable">$stmt</span>-><span class="function">execute</span>();
    
    <span class="function">echo</span> <span class="string">"Utilisateur mis à jour avec succès. Nombre de lignes affectées : "</span> . <span class="variable">$stmt</span>-><span class="function">rowCount</span>();
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur de mise à jour : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>

            <h3>Suppression de données</h3>
            <div class="example">
                <div class="example-header">Supprimer un utilisateur</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="comment">// Préparation de la requête de suppression</span>
    <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"DELETE FROM utilisateurs WHERE id = :id"</span>);
    
    <span class="comment">// Association du paramètre</span>
    <span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':id'</span>, <span class="variable">$id</span>);
    
    <span class="comment">// Définition de la valeur et exécution</span>
    <span class="variable">$id</span> = 1;
    <span class="variable">$stmt</span>-><span class="function">execute</span>();
    
    <span class="function">echo</span> <span class="string">"Utilisateur supprimé avec succès. Nombre de lignes affectées : "</span> . <span class="variable">$stmt</span>-><span class="function">rowCount</span>();
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur de suppression : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Transactions</h2>
            <p>Les transactions permettent d'exécuter un ensemble de requêtes comme une seule unité de travail. Si une requête échoue, toutes les modifications sont annulées (rollback).</p>

            <div class="example">
                <div class="example-header">Utiliser les transactions avec PDO</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="comment">// Désactiver le mode autocommit pour gérer manuellement les transactions</span>
    <span class="variable">$pdo</span>-><span class="function">beginTransaction</span>();

    <span class="comment">// Première requête</span>
    <span class="variable">$stmt1</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"INSERT INTO comptes (utilisateur_id, solde) VALUES (:utilisateur_id, :solde)"</span>);
    <span class="variable">$stmt1</span>-><span class="function">execute</span>([
        <span class="string">':utilisateur_id'</span> => 1,
        <span class="string">':solde'</span> => 1000
    ]);

    <span class="comment">// Deuxième requête</span>
    <span class="variable">$stmt2</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"UPDATE utilisateurs SET statut = 'actif' WHERE id = :id"</span>);
    <span class="variable">$stmt2</span>-><span class="function">execute</span>([<span class="string">':id'</span> => 1]);

    <span class="comment">// Si tout s'est bien passé, on valide les modifications</span>
    <span class="variable">$pdo</span>-><span class="function">commit</span>();
    
    <span class="function">echo</span> <span class="string">"Transactions effectuées avec succès"</span>;
} <span class="keyword">catch</span> (<span class="class-name">Exception</span> <span class="variable">$e</span>) {
    <span class="comment">// En cas d'erreur, on annule toutes les modifications</span>
    <span class="variable">$pdo</span>-><span class="function">rollBack</span>();
    
    <span class="function">echo</span> <span class="string">"Erreur : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Gestion des relations entre tables</h2>
            <h3>Exemple de modèle relationnel</h3>
            <div class="section db-diagram-vertical">
                <div class="example db-table-container">
                    <div class="example-header db-table-header">UTILISATEURS</div>
                    <div class="example-content db-table-content">
                        <div class="db-column">
                            <span class="key-icon">🔑</span>
                            <span class="column-name">id</span>
                            <span class="column-type">INT</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">nom</span>
                            <span class="column-type">VARCHAR(100)</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">email</span>
                            <span class="column-type">VARCHAR(100)</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">mot_de_passe</span>
                            <span class="column-type">VARCHAR(255)</span>
                        </div>
                    </div>
                </div>
                <div class="relation-arrow-vertical"></div>
                <div class="example db-table-container">
                    <div class="example-header db-table-header">ARTICLES</div>
                    <div class="example-content db-table-content">
                        <div class="db-column">
                            <span class="key-icon">🔑</span>
                            <span class="column-name">id</span>
                            <span class="column-type">INT</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">titre</span>
                            <span class="column-type">VARCHAR(200)</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">contenu</span>
                            <span class="column-type">TEXT</span>
                        </div>
                        <div class="db-column">
                            <span class="key-icon">🔗</span>
                            <span class="column-name">utilisateur_id</span>
                            <span class="column-type">INT</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">date_creation</span>
                            <span class="column-type">TIMESTAMP</span>
                        </div>
                    </div>
                </div>
                <div class="relation-arrow-vertical"></div>
                <div class="example db-table-container">
                    <div class="example-header db-table-header">COMMENTAIRES</div>
                    <div class="example-content db-table-content">
                        <div class="db-column">
                            <span class="key-icon">🔑</span>
                            <span class="column-name">id</span>
                            <span class="column-type">INT</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">texte</span>
                            <span class="column-type">TEXT</span>
                        </div>
                        <div class="db-column">
                            <span class="key-icon">🔗</span>
                            <span class="column-name">utilisateur_id</span>
                            <span class="column-type">INT</span>
                        </div>
                        <div class="db-column">
                            <span class="key-icon">🔗</span>
                            <span class="column-name">article_id</span>
                            <span class="column-type">INT</span>
                        </div>
                        <div class="db-column">
                            <span class="column-name">date_creation</span>
                            <span class="column-type">TIMESTAMP</span>
                        </div>
                    </div>
                </div>
                <div class="info-box db-legend">
                    <div class="legend-item"><span class="key-icon">🔑</span> Clé primaire</div>
                    <div class="legend-item"><span class="key-icon">🔗</span> Clé étrangère</div>
                    <div class="legend-item">TIMESTAMP = Date de création</div>
                </div>
            </div>

            <h3>Types de relations entre tables</h3>
            <p>Les bases de données relationnelles permettent d'établir différents types de relations entre les tables :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Relation un-à-un (1:1)</div>
                    <div class="example-content">
                        <p>Chaque enregistrement d'une table est associé à un seul enregistrement d'une autre table.</p>
                        <p><strong>Exemple :</strong> Un utilisateur a un seul profil détaillé.</p>
                        <pre class="sql-sample"><code>
<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">utilisateurs</span> (
    <span class="sql-column">id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">PRIMARY KEY</span>,
    <span class="sql-column">email</span> <span class="sql-keyword">VARCHAR</span>(100)
);

<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">profils</span> (
    <span class="sql-column">id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">PRIMARY KEY</span>,
    <span class="sql-column">utilisateur_id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">UNIQUE</span>,
    <span class="sql-column">adresse</span> <span class="sql-keyword">TEXT</span>,
    <span class="sql-column">telephone</span> <span class="sql-keyword">VARCHAR</span>(20),
    <span class="sql-keyword">FOREIGN KEY</span> (<span class="sql-column">utilisateur_id</span>) <span class="sql-keyword">REFERENCES</span> <span class="sql-table">utilisateurs</span>(<span class="sql-column">id</span>)
);
</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Relation un-à-plusieurs (1:N)</div>
                    <div class="example-content">
                        <p>Un enregistrement d'une table est associé à plusieurs enregistrements d'une autre table.</p>
                        <p><strong>Exemple :</strong> Un utilisateur peut écrire plusieurs articles.</p>
                        <pre class="sql-sample"><code>
<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">utilisateurs</span> (
    <span class="sql-column">id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">PRIMARY KEY</span>
);

<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">articles</span> (
    <span class="sql-column">id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">PRIMARY KEY</span>,
    <span class="sql-column">titre</span> <span class="sql-keyword">VARCHAR</span>(200),
    <span class="sql-column">utilisateur_id</span> <span class="sql-keyword">INT</span>,
    <span class="sql-keyword">FOREIGN KEY</span> (<span class="sql-column">utilisateur_id</span>) <span class="sql-keyword">REFERENCES</span> <span class="sql-table">utilisateurs</span>(<span class="sql-column">id</span>)
);
</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Relation plusieurs-à-plusieurs (N:M)</div>
                    <div class="example-content">
                        <p>Plusieurs enregistrements d'une table sont associés à plusieurs enregistrements d'une autre table.</p>
                        <p><strong>Exemple :</strong> Des étudiants peuvent suivre plusieurs cours, et chaque cours peut être suivi par plusieurs étudiants.</p>
                        <pre class="sql-sample"><code>
<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">etudiants</span> (
    <span class="sql-column">id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">PRIMARY KEY</span>,
    <span class="sql-column">nom</span> <span class="sql-keyword">VARCHAR</span>(100)
);

<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">cours</span> (
    <span class="sql-column">id</span> <span class="sql-keyword">INT</span> <span class="sql-keyword">PRIMARY KEY</span>,
    <span class="sql-column">intitule</span> <span class="sql-keyword">VARCHAR</span>(100)
);

<span class="sql-keyword">CREATE TABLE</span> <span class="sql-table">inscriptions</span> (
    <span class="sql-column">etudiant_id</span> <span class="sql-keyword">INT</span>,
    <span class="sql-column">cours_id</span> <span class="sql-keyword">INT</span>,
    <span class="sql-column">date_inscription</span> <span class="sql-keyword">DATE</span>,
    <span class="sql-keyword">PRIMARY KEY</span> (<span class="sql-column">etudiant_id</span>, <span class="sql-column">cours_id</span>),
    <span class="sql-keyword">FOREIGN KEY</span> (<span class="sql-column">etudiant_id</span>) <span class="sql-keyword">REFERENCES</span> <span class="sql-table">etudiants</span>(<span class="sql-column">id</span>),
    <span class="sql-keyword">FOREIGN KEY</span> (<span class="sql-column">cours_id</span>) <span class="sql-keyword">REFERENCES</span> <span class="sql-table">cours</span>(<span class="sql-column">id</span>)
);
</code></pre>
                    </div>
                </div>
            </div>

            <h3>Requêtes avec jointures avancées</h3>
            <p>Les jointures sont essentielles pour exploiter efficacement les relations entre les tables. Voici différents types de jointures :</p>

            <div class="example">
                <div class="example-header">INNER JOIN</div>
                <div class="example-content">
                    <p>Retourne les enregistrements qui ont des correspondances dans les deux tables.</p>
                    <pre><code>
<span class="keyword">try</span> {
    <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">query</span>(<span class="string">"
        SELECT 
            a.titre, a.contenu, a.date_creation,
            u.nom AS auteur_nom
        FROM 
            articles a
        INNER JOIN 
            utilisateurs u ON a.utilisateur_id = u.id
    "</span>);
    
    <span class="variable">$articles</span> = <span class="variable">$stmt</span>-><span class="function">fetchAll</span>();
    
    <span class="keyword">foreach</span> (<span class="variable">$articles</span> <span class="keyword">as</span> <span class="variable">$article</span>) {
        <span class="function">echo</span> <span class="string">"Titre: {$article['titre']} - Auteur: {$article['auteur_nom']}"</span>;
    }
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                    <p><strong>Visualisation :</strong> INNER JOIN ne retourne que les correspondances existantes dans les deux tables</p>
                    <div style="text-align: center; margin: 15px 0;">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMTAwIj48Y2lyY2xlIGN4PSI3NSIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlPSIjNDM2MWVlIiBmaWxsPSIjNDM2MWVlNTAiIHN0cm9rZS13aWR0aD0iMiIvPjxjaXJjbGUgY3g9IjEyNSIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlPSIjN2IyY2JkIiBmaWxsPSIjN2IyY2JkNTAiIHN0cm9rZS13aWR0aD0iMiIvPjxwYXRoIGQ9Ik0gMTA1Ljg1LDI3LjM3IEMgMTEyLjg1LDM1LjM3IDExMi44NSw2NC42MyAxMDUuODUsNzIuNjMgQyA5OC44NSw2NC42MyA5OC44NSwzNS4zNyAxMDUuODUsMjcuMzciIGZpbGw9IiMyODRiNjMiIHN0cm9rZT0iIzAwMCIgc3Ryb2tlLXdpZHRoPSIxIi8+PHRleHQgeD0iNzUiIHk9IjUwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEycHgiPkEgKHV0aWxpc2F0ZXVycyk8L3RleHQ+PHRleHQgeD0iMTI1IiB5PSI1MCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxMnB4Ij5CIChhcnRpY2xlcyk8L3RleHQ+PC9zdmc+" alt="INNER JOIN visualization" style="max-width: 200px;">
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header">LEFT JOIN</div>
                <div class="example-content">
                    <p>Retourne tous les enregistrements de la table de gauche et les correspondances de la table de droite.</p>
                    <pre><code>
<span class="comment">// Récupérer tous les utilisateurs, même ceux qui n'ont pas écrit d'articles</span>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">query</span>(<span class="string">"
    SELECT 
        u.nom, u.email,
        a.titre, a.date_creation
    FROM 
        utilisateurs u
    LEFT JOIN 
        articles a ON u.id = a.utilisateur_id
"</span>);

<span class="variable">$resultats</span> = <span class="variable">$stmt</span>-><span class="function">fetchAll</span>();

<span class="keyword">foreach</span> (<span class="variable">$resultats</span> <span class="keyword">as</span> <span class="variable">$resultat</span>) {
    <span class="variable">$article</span> = <span class="variable">$resultat</span>[<span class="string">'titre'</span>] ? <span class="variable">$resultat</span>[<span class="string">'titre'</span>] : <span class="string">"Aucun article"</span>;
    <span class="function">echo</span> <span class="string">"Utilisateur: {$resultat['nom']} - Article: {$article}"</span>;
}
</code></pre>
                    <p><strong>Visualisation :</strong> LEFT JOIN inclut tous les enregistrements de la table de gauche</p>
                    <div style="text-align: center; margin: 15px 0;">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMTAwIj48Y2lyY2xlIGN4PSI3NSIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlPSIjNDM2MWVlIiBmaWxsPSIjNDM2MWVlNTAiIHN0cm9rZS13aWR0aD0iMiIvPjxjaXJjbGUgY3g9IjEyNSIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlPSIjN2IyY2JkIiBmaWxsPSIjN2IyY2JkNTAiIHN0cm9rZS13aWR0aD0iMiIvPjxwYXRoIGQ9Ik0gNzUsNTAgQyA3NSwyNyA3NSw3MyA3NSw1MCIgZmlsbD0iIzI4NGI2MyIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEiLz48cGF0aCBkPSJNIDE4LjQsNTAgQyAxOC40LDEwIDE4LjQsOTAgNzUsNTAiIGZpbGw9IiM0MzYxZWU1MCIgc3Ryb2tlPSIjMjg0YjYzIiBzdHJva2Utd2lkdGg9IjEiLz48cGF0aCBkPSJNIDEwNS44NSwyNy4zNyBDIDExMi44NSwzNS4zNyAxMTIuODUsNjQuNjMgMTA1Ljg1LDcyLjYzIEMgOTguODUsNjQuNjMgOTguODUsMzUuMzcgMTA1Ljg1LDI3LjM3IiBmaWxsPSIjMjg0YjYzIiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMSIvPjx0ZXh0IHg9IjUwIiB5PSI1MCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxMnB4Ij5BPC90ZXh0Pjx0ZXh0IHg9IjE0MCIgeT0iNTAiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTJweCI+QjwvdGV4dD48L3N2Zz4=" alt="LEFT JOIN visualization" style="max-width: 200px;">
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Jointures multiples</div>
                <div class="example-content">
                    <p>Récupérer des données à partir de plusieurs tables liées entre elles.</p>
                    <pre><code>
<span class="comment">// Récupérer les articles avec leurs auteurs et leurs commentaires</span>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"
    SELECT 
        a.id AS article_id, a.titre, a.date_creation,
        u.nom AS auteur_nom,
        c.id AS commentaire_id, c.texte AS commentaire_texte,
        cu.nom AS commentateur_nom
    FROM 
        articles a
    INNER JOIN 
        utilisateurs u ON a.utilisateur_id = u.id
    LEFT JOIN 
        commentaires c ON a.id = c.article_id
    LEFT JOIN 
        utilisateurs cu ON c.utilisateur_id = cu.id
    WHERE 
        a.id = :article_id
    ORDER BY 
        c.date_creation DESC
"</span>);

<span class="variable">$article_id</span> = <span class="number">5</span>; <span class="comment">// ID de l'article recherché</span>
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':article_id'</span>, <span class="variable">$article_id</span>, <span class="constant">PDO::PARAM_INT</span>);
<span class="variable">$stmt</span>-><span class="function">execute</span>();

<span class="variable">$resultats</span> = <span class="variable">$stmt</span>-><span class="function">fetchAll</span>();

<span class="comment">// Traitement des résultats</span>
<span class="keyword">if</span> (<span class="function">count</span>(<span class="variable">$resultats</span>) > 0) {
    <span class="comment">// Information sur l'article (identiques pour toutes les lignes)</span>
    <span class="function">echo</span> <span class="string">"<h2>{$resultats[0]['titre']}</h2>"</span>;
    <span class="function">echo</span> <span class="string">"<p>Auteur: {$resultats[0]['auteur_nom']}</p>"</span>;
    
    <span class="comment">// Commentaires (peuvent varier d'une ligne à l'autre)</span>
    <span class="keyword">if</span> (<span class="variable">$resultats</span>[0][<span class="string">'commentaire_id'</span>]) {
        <span class="function">echo</span> <span class="string">"<h3>Commentaires :</h3>"</span>;
        <span class="keyword">foreach</span> (<span class="variable">$resultats</span> <span class="keyword">as</span> <span class="variable">$resultat</span>) {
            <span class="function">echo</span> <span class="string">"<div class='comment'>"</span>;
            <span class="function">echo</span> <span class="string">"<p>{$resultat['commentaire_texte']}</p>"</span>;
            <span class="function">echo</span> <span class="string">"<p>Par: {$resultat['commentateur_nom']}</p>"</span>;
            <span class="function">echo</span> <span class="string">"</div>"</span>;
        }
    } <span class="keyword">else</span> {
        <span class="function">echo</span> <span class="string">"<p>Aucun commentaire pour cet article.</p>"</span>;
    }
}
</code></pre>
                </div>
            </div>

            <h3>Requête avec jointure</h3>
            <div class="example">
                <div class="example-header">Récupérer les articles avec leurs auteurs</div>
                <div class="example-content">
                    <pre><code>
<span class="keyword">try</span> {
    <span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">query</span>(<span class="string">"
        SELECT 
            a.id, a.titre, a.contenu, a.date_creation,
            u.id AS auteur_id, u.nom AS auteur_nom
        FROM 
            articles a
        INNER JOIN 
            utilisateurs u ON a.utilisateur_id = u.id
        ORDER BY 
            a.date_creation DESC
    "</span>);
    
    <span class="variable">$articles</span> = <span class="variable">$stmt</span>-><span class="function">fetchAll</span>();
    
    <span class="keyword">foreach</span> (<span class="variable">$articles</span> <span class="keyword">as</span> <span class="variable">$article</span>) {
        <span class="function">echo</span> <span class="string">"<h4>"</span> . <span class="variable">$article</span>[<span class="string>'titre'</span>] . <span class="string">"</h4>"</span>;
        <span class="function">echo</span> <span class="string">"<p>Par : "</span> . <span class="variable">$article</span>[<span class="string>'auteur_nom'</span>] . <span class="string">"</p>"</span>;
        <span class="function">echo</span> <span class="string">"<p>"</span> . <span class="variable">$article</span>[<span class="string>'contenu'</span>] . <span class="string">"</p>"</span>;
    }
} <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Erreur : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>();
}
</code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Bonnes pratiques</h2>
            <ul>
                <li><strong>Utilisez toujours des requêtes préparées</strong> pour éviter les injections SQL</li>
                <li><strong>Gérez les erreurs</strong> avec des blocs try/catch</li>
                <li><strong>Fermez les connexions</strong> après utilisation (bien que PHP le fasse automatiquement)</li>
                <li><strong>Utilisez les transactions</strong> pour les opérations impliquant plusieurs requêtes</li>
                <li><strong>Ne stockez jamais de mots de passe en clair</strong>, utilisez toujours password_hash()</li>
                <li><strong>Utilisez le typage et la validation</strong> avant d'insérer des données dans la base</li>
                <li><strong>Limitez les privilèges</strong> de l'utilisateur de la base de données</li>
                <li><strong>Paramétrez votre connexion</strong> correctement (charset, collation, etc.)</li>
            </ul>

            <h3>Sécurité des bases de données</h3>
            <p>La sécurité des bases de données va au-delà des simples requêtes préparées. Voici comment renforcer la sécurité :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Hachage des mots de passe</div>
                    <div class="example-content">
                        <pre><code>
<span class="comment">// JAMAIS comme ceci</span>
<span class="variable">$password</span> = <span class="string">"motdepasse123"</span>; <span class="comment">// Stockage en clair ❌</span>
<span class="variable">$password</span> = <span class="function">md5</span>(<span class="string">"motdepasse123"</span>); <span class="comment">// Hachage faible ❌</span>

<span class="comment">// TOUJOURS comme cela</span>
<span class="variable">$password_hash</span> = <span class="function">password_hash</span>(<span class="string">"motdepasse123"</span>, <span class="constant">PASSWORD_DEFAULT</span>); <span class="comment">// ✅</span>

<span class="comment">// Vérification</span>
<span class="keyword">if</span> (<span class="function">password_verify</span>(<span class="string">"motdepasse123"</span>, <span class="variable">$password_hash</span>)) {
    <span class="function">echo</span> <span class="string">"Mot de passe correct!"</span>;
}
</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Gestion des utilisateurs de la base de données</div>
                    <div class="example-content">
                        <p>Évitez d'utiliser l'utilisateur 'root' dans votre application.</p>
                        <pre class="sql-sample"><code>
<span class="comment">-- Créer un utilisateur spécifique pour votre application</span>
<span class="sql-keyword">CREATE USER</span> 'app_user'@'localhost' <span class="sql-keyword">IDENTIFIED BY</span> 'password';

<span class="comment">-- Accorder uniquement les privilèges nécessaires</span>
<span class="sql-keyword">GRANT SELECT, INSERT, UPDATE, DELETE</span> 
<span class="sql-keyword">ON</span> myapp.* 
<span class="sql-keyword">TO</span> 'app_user'@'localhost';

<span class="comment">-- PAS de privilèges administratifs</span>
<span class="comment">-- N'accordez pas : DROP, ALTER, CREATE, etc.</span>
</code></pre>
                    </div>
                </div>
            </div>

            <h3>Optimisation des performances</h3>
            <p>Les bases de données peuvent devenir un goulot d'étranglement pour les performances. Voici quelques techniques d'optimisation :</p>

            <div class="example">
                <div class="example-header">Création d'index adaptés</div>
                <div class="example-content">
                    <pre class="sql-sample"><code>
<span class="comment">-- Ajout d'un index sur une colonne fréquemment recherchée</span>
<span class="sql-keyword">CREATE INDEX</span> idx_utilisateurs_email <span class="sql-keyword">ON</span> utilisateurs (email);

<span class="comment">-- Index composite pour les recherches combinées</span>
<span class="sql-keyword">CREATE INDEX</span> idx_articles_date_categorie <span class="sql-keyword">ON</span> articles (date_creation, categorie_id);
</code></pre>
                    <p>Les index accélèrent considérablement les requêtes SELECT, mais ralentissent légèrement les INSERT/UPDATE. Utilisez-les judicieusement sur les colonnes :</p>
                    <ul>
                        <li>Présentes dans les clauses WHERE</li>
                        <li>Utilisées pour les jointures (clés étrangères)</li>
                        <li>Apparaissant dans les GROUP BY ou ORDER BY</li>
                    </ul>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Pagination des résultats</div>
                <div class="example-content">
                    <p>Pour les listes longues, évitez de récupérer tous les résultats d'un coup :</p>
                    <pre><code>
<span class="variable">$page</span> = <span class="function">isset</span>(<span class="variable">$_GET</span>[<span class="string">'page'</span>]) ? (<span class="keyword">int</span>) <span class="variable">$_GET</span>[<span class="string>'page'</span>] : 1;
<span class="variable">$limite</span> = 10; <span class="comment">// Nombre de résultats par page</span>
<span class="variable">$offset</span> = (<span class="variable">$page</span> - 1) * <span class="variable">$limite</span>;

<span class="comment">// Requête paginée</span>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"
    SELECT * FROM articles
    ORDER BY date_creation DESC
    LIMIT :limite OFFSET :offset
"</span>);

<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':limite'</span>, <span class="variable">$limite</span>, <span class="constant">PDO::PARAM_INT</span>);
<span class="variable">$stmt</span>-><span class="function">bindParam</span>(<span class="string">':offset'</span>, <span class="variable">$offset</span>, <span class="constant">PDO::PARAM_INT</span>);
<span class="variable">$stmt</span>-><span class="function">execute</span>();

<span class="comment">// Récupération du nombre total pour la pagination</span>
<span class="variable">$stmt_count</span> = <span class="variable">$pdo</span>-><span class="function">query</span>(<span class="string">"SELECT COUNT(*) FROM articles"</span>);
<span class="variable">$total</span> = <span class="variable">$stmt_count</span>-><span class="function">fetchColumn</span>();
<span class="variable">$pages_totales</span> = <span class="function">ceil</span>(<span class="variable">$total</span> / <span class="variable">$limite</span>);
</code></pre>
                </div>
            </div>

            <h3>Gestion des connexions</h3>
            <div class="example">
                <div class="example-header">Utilisation d'une classe de connexion</div>
                <div class="example-content">
                    <p>Pour une application bien structurée, créez une classe pour gérer vos connexions à la base de données :</p>
                    <pre><code>
<span class="class-keyword">class</span> <span class="class-name">Database</span> {
    <span class="keyword">private static</span> <span class="property">$instance</span> = <span class="keyword">null</span>;
    <span class="keyword">private</span> <span class="property">$pdo</span>;
    <span class="keyword">private</span> <span class="property">$host</span> = <span class="string">"localhost"</span>;
    <span class="keyword">private</span> <span class="property">$db</span> = <span class="string">"ma_base"</span>;
    <span class="keyword">private</span> <span class="property">$user</span> = <span class="string">"app_user"</span>;
    <span class="keyword">private</span> <span class="property">$pass</span> = <span class="string">"mot_de_passe_securise"</span>;
    
    <span class="keyword">private function</span> <span class="method">__construct</span>() {
        <span class="variable">$dsn</span> = <span class="string">"mysql:host="</span> . <span class="variable">$this</span>-><span class="property">host</span> . <span class="string">";dbname="</span> . <span class="variable">$this</span>-><span class="property">db</span> . <span class="string">";charset=utf8mb4"</span>;
        <span class="variable">$options</span> = [
            <span class="constant">PDO::ATTR_ERRMODE</span> => <span class="constant">PDO::ERRMODE_EXCEPTION</span>,
            <span class="constant">PDO::ATTR_DEFAULT_FETCH_MODE</span> => <span class="constant">PDO::FETCH_ASSOC</span>,
            <span class="constant">PDO::ATTR_EMULATE_PREPARES</span> => <span class="keyword">false</span>
        ];
        
        <span class="keyword">try</span> {
            <span class="variable">$this</span>-><span class="property">pdo</span> = <span class="keyword">new</span> <span class="function">PDO</span>(<span class="variable">$dsn</span>, <span class="variable">$this</span>-><span class="property">user</span>, <span class="variable">$this</span>-><span class="property">pass</span>, <span class="variable">$options</span>);
        } <span class="keyword">catch</span> (<span class="class-name">PDOException</span> <span class="variable">$e</span>) {
            <span class="function">die</span>(<span class="string">"Connexion échouée : "</span> . <span class="variable">$e</span>-><span class="function">getMessage</span>());
        }
    }
    
    <span class="comment">// Empêche le clonage</span>
    <span class="keyword">private function</span> <span class="method">__clone</span>() {}
    
    <span class="comment">// Pattern Singleton pour une seule connexion</span>
    <span class="keyword">public static function</span> <span class="method">getInstance</span>() {
        <span class="keyword">if</span> (<span class="keyword">self</span>::<span class="property">$instance</span> === <span class="keyword">null</span>) {
            <span class="keyword">self</span>::<span class="property">$instance</span> = <span class="keyword">new</span> <span class="function">self</span>();
        }
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="property">$instance</span>;
    }
    
    <span class="comment">// Récupérer l'objet PDO pour exécuter les requêtes</span>
    <span class="keyword">public function</span> <span class="method">getConnection</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">pdo</span>;
    }
}

<span class="comment">// Utilisation</span>
<span class="variable">$db</span> = <span class="class-name">Database</span>::<span class="method">getInstance</span>();
<span class="variable">$pdo</span> = <span class="variable">$db</span>-><span class="method">getConnection</span>();

<span class="comment">// Ensuite, utilisez $pdo comme d'habitude</span>
<span class="variable">$stmt</span> = <span class="variable">$pdo</span>-><span class="function">prepare</span>(<span class="string">"SELECT * FROM utilisateurs"</span>);
</code></pre>
                </div>
            </div>

            <div class="info-box">
                <p><strong>Ressources supplémentaires :</strong></p>
                <ul>
                    <li><a href="https://www.php.net/manual/fr/book.pdo.php" target="_blank">Documentation officielle PHP sur PDO</a></li>
                    <li><a href="https://www.php.net/manual/fr/book.mysqli.php" target="_blank">Documentation officielle PHP sur MySQLi</a></li>
                    <li><a href="https://dev.mysql.com/doc/refman/8.0/en/" target="_blank">Documentation MySQL</a></li>
                    <li><a href="https://phptherightway.com/#databases" target="_blank">PHP The Right Way - Databases</a></li>
                    <li><a href="https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet" target="_blank">OWASP - Prévention des injections SQL</a></li>
                    <li><a href="https://use-the-index-luke.com/" target="_blank">Use The Index, Luke! - Guide sur l'optimisation des index</a></li>
                </ul>
            </div>
        </section>
        <div class="navigation">
            <a href="11-POO-avancee.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="13-php-ajax.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>