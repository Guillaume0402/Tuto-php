<?php include __DIR__ . '/../includes/header-pro.php';




// Récupérer les informations de la page depuis la configuration (à adapter si besoin)
$pageKey = '16-api-externes';
$pageInfo = [
    'titre' => 'PHP et les API externes',
    'description' => "Apprenez à connecter votre application PHP à des services externes : API REST, cURL, OAuth, Webhooks, gestion des erreurs, etc."
];
$titre = $pageInfo['titre'];
$description = $pageInfo['description'];
?>


<body class="module16">
    <header>
        <h1><?php echo $titre; ?></h1>
        <p class="subtitle"><?php echo $description; ?></p>
    </header>
    <div class="navigation">
        <a href="15-architecture-mvc.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="17-gestion-fichiers.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Avant de commencer : Qu'est-ce qu'une API ?</h2>
            <p>Une <strong>API</strong> (Application Programming Interface) est une interface qui permet à deux applications de communiquer entre elles. Les API REST sont les plus courantes sur le web : elles utilisent le protocole HTTP et échangent des données (souvent en JSON).</p>
            <div class="info-box">
                <strong>Schéma d'une requête API :</strong>
                <div class="api-flow">
                    <div class="flow-step"><strong>Votre code PHP</strong> → <span class="url">https://api.exemple.com/...</span></div>
                    <div class="flow-step"><strong>Serveur distant</strong> → Réponse JSON</div>
                </div>
            </div>
            <p>Pour chaque API, consultez toujours la documentation officielle : elle précise les endpoints, les paramètres, les méthodes HTTP à utiliser, les formats de réponse, etc.</p>
        </section>

        <section class="section">
            <h2>1. Consommer une API REST en PHP</h2>
            <p>La plupart des API modernes utilisent le protocole HTTP et échangent des données au format JSON. Pour consommer une API, on utilise généralement <code>file_get_contents</code> ou <code>cURL</code>.</p>
            <h3>Exemple simple avec <code>file_get_contents</code></h3>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Appel d'une API publique (ex : OpenWeatherMap)</span>
<span class="variable">$url</span> = <span class="string">'https://api.open-meteo.com/v1/forecast?latitude=48.85&longitude=2.35&current_weather=true'</span>;
<span class="variable">$json</span> = <span class="function">file_get_contents</span>(<span class="variable">$url</span>);
<span class="variable">$data</span> = <span class="function">json_decode</span>(<span class="variable">$json</span>, <span class="keyword">true</span>);
<span class="comment">// Afficher la température actuelle</span>
<span class="keyword">echo</span> <span class="string">'Température à Paris : '</span> . <span class="variable">$data</span>[<span class="string">'current_weather'</span>][<span class="string">'temperature'</span>] . <span class="string">'°C'</span>;
</code></pre>
            </div>
            <div class="tip-box">
                <strong>Astuce :</strong> <code>file_get_contents</code> fonctionne pour les API publiques sans authentification. Pour des API sécurisées ou des requêtes avancées, utilisez <strong>cURL</strong>.
            </div>
        </section>

        <section class="section">
            <h2>2. Utiliser cURL en PHP</h2>
            <p>cURL est une bibliothèque très puissante pour faire des requêtes HTTP (GET, POST, PUT, DELETE) avec gestion des headers, authentification, etc.</p>
            <h3>Exemple : Requête GET avec cURL</h3>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Initialiser cURL</span>
<span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="string">'https://api.open-meteo.com/v1/forecast?latitude=48.85&longitude=2.35&current_weather=true'</span>);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_RETURNTRANSFER</span>, <span class="keyword">true</span>);
<span class="variable">$json</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
<span class="function">curl_close</span>(<span class="variable">$ch</span>);
<span class="variable">$data</span> = <span class="function">json_decode</span>(<span class="variable">$json</span>, <span class="keyword">true</span>);
<span class="keyword">echo</span> <span class="string">'Température à Paris : '</span> . <span class="variable">$data</span>[<span class="string">'current_weather'</span>][<span class="string">'temperature'</span>] . <span class="string">'°C'</span>;
</code></pre>
            </div>
            <h3>Exemple : Requête POST avec cURL</h3>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Exemple d'envoi de données en POST (ex : API fictive)</span>
<span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="string">'https://jsonplaceholder.typicode.com/posts'</span>);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_POST</span>, <span class="keyword">true</span>);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_POSTFIELDS</span>, <span class="function">http_build_query</span>([
    <span class="string">'title'</span> => <span class="string>'Titre test'</span>,
    <span class="string">'body'</span> => <span class="string>'Contenu du post'</span>,
    <span class="string>'userId'</span> => 1
]));
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_RETURNTRANSFER</span>, <span class="keyword">true</span>);
<span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
<span class="function">curl_close</span>(<span class="variable">$ch</span>);
<span class="comment">// Afficher la réponse JSON</span>
<span class="keyword">echo</span> <span class="variable">$response</span>;
</code></pre>
            </div>
            <div class="info-box">
                <strong>À retenir :</strong> cURL permet de gérer les headers, l'authentification, les méthodes HTTP, les erreurs, etc. Consultez la <a href="https://www.php.net/manual/fr/book.curl.php" target="_blank">doc officielle</a> pour plus d'options.
            </div>
        </section>

        <section class="section">
            <h2>3. Authentification et tokens OAuth</h2>
            <p>De nombreuses API nécessitent une authentification via un token (clé API, Bearer token, OAuth2...). Voici un exemple d'appel d'API avec un token Bearer :</p>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Appel d'une API avec un token Bearer</span>
<span class="variable">$token</span> = <span class="string">'VOTRE_TOKEN_ICI'</span>;
<span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="string">'https://api.exemple.com/data'</span>);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_HTTPHEADER</span>, [<span class="string">'Authorization: Bearer ' . $token</span>]);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_RETURNTRANSFER</span>, <span class="keyword">true</span>);
<span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
<span class="function">curl_close</span>(<span class="variable">$ch</span>);
<span class="keyword">echo</span> <span class="variable">$response</span>;
</code></pre>
            </div>
            <div class="tip-box">
                <strong>OAuth2 :</strong> Pour des API comme Google, GitHub, Stripe, il faut suivre le flow OAuth2 (autorisation, récupération du token, etc.). Utilisez des librairies comme <a href="https://oauth2-client.thephpleague.com/" target="_blank">league/oauth2-client</a> pour simplifier l'intégration.
            </div>
        </section>

        <section class="section">
            <h2>4. Webhooks : recevoir des notifications d'une API</h2>
            <p>Un webhook est une URL de votre application appelée par un service externe lorsqu'un événement se produit (paiement, push GitHub, etc.).</p>
            <h3>Exemple de réception d'un webhook Stripe</h3>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Fichier : webhook.php</span>
<span class="variable">$payload</span> = <span class="function">file_get_contents</span>(<span class="string">'php://input'</span>);
<span class="variable">$event</span> = <span class="function">json_decode</span>(<span class="variable">$payload</span>, <span class="keyword">true</span>);
<span class="comment">// Vérifier le type d'événement</span>
<span class="keyword">if</span> (<span class="variable">$event</span>[<span class="string">'type'</span>] === <span class="string">'payment_intent.succeeded'</span>) {
    <span class="comment">// Traiter le paiement réussi</span>
}
<span class="comment">// Répondre à Stripe</span>
<span class="function">http_response_code</span>(200);
</code></pre>
            </div>
            <div class="info-box">
                <strong>Bonnes pratiques :</strong>
                <ul>
                    <li>Vérifiez la signature du webhook (voir doc Stripe, GitHub...)</li>
                    <li>Répondez rapidement (200 OK)</li>
                    <li>Logguez les événements reçus</li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2>5. Gérer les réponses et les erreurs d'API</h2>
            <p>Il est essentiel de vérifier le code de réponse HTTP et de gérer les erreurs lors de l'appel à une API.</p>
            <h3>Exemple : gestion des erreurs avec cURL</h3>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Exemple de gestion d'erreur avec cURL</span>
<span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="string">'https://api.exemple.com/data'</span>);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_RETURNTRANSFER</span>, <span class="keyword">true</span>);
<span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
<span class="variable">$httpCode</span> = <span class="function">curl_getinfo</span>(<span class="variable">$ch</span>, <span class="constant">CURLINFO_HTTP_CODE</span>);
<span class="keyword">if</span> (<span class="variable">$response</span> === <span class="keyword">false</span> || <span class="variable">$httpCode</span> !== 200) {
    <span class="variable">$error</span> = <span class="function">curl_error</span>(<span class="variable">$ch</span>);
    <span class="keyword">echo</span> <span class="string">"Erreur API : $error (code $httpCode)"</span>;
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="variable">$response</span>;
}
<span class="function">curl_close</span>(<span class="variable">$ch</span>);
</code></pre>
            </div>
            <div class="warning-box">
                <strong>Attention :</strong> Toujours vérifier le code HTTP et le contenu de la réponse pour éviter les bugs et sécuriser votre application.
            </div>
        </section>

        <section class="section">
            <h2>Exemple complet : Consommer une API météo et afficher le résultat</h2>
            <p>Voici un exemple complet qui récupère la météo d'une ville et affiche la température et la description du temps :</p>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Exemple avec l'API OpenWeatherMap (clé API requise)</span>
<span class="variable">$apiKey</span> = <span class="string">'VOTRE_CLE_API'</span>;
<span class="variable">$city</span> = <span class="string>'Paris'</span>;
<span class="variable">$url</span> = <span class="string">"https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric&lang=fr"</span>;
<span class="variable">$json</span> = <span class="function">file_get_contents</span>(<span class="variable">$url</span>);
<span class="variable">$data</span> = <span class="function">json_decode</span>(<span class="variable">$json</span>, <span class="keyword">true</span>);
<span class="keyword">if</span> (<span class="variable">$data</span> && isset(<span class="variable">$data</span>[<span class="string">'main'</span>])) {
    <span class="variable">$temp</span> = <span class="variable">$data</span>[<span class="string>'main'</span>][<span class="string>'temp'</span>];
    <span class="variable">$desc</span> = <span class="variable">$data</span>[<span class="string>'weather'</span>][0][<span class="string>'description'</span>];
    <span class="keyword">echo</span> <span class="string">"À $city, il fait $temp°C et le temps est : $desc"</span>;
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Impossible de récupérer la météo."</span>;
}
</code></pre>
            </div>
            <div class="tip-box">
                <strong>Conseil :</strong> Pour tester, inscrivez-vous sur <a href="https://openweathermap.org/api" target="_blank">OpenWeatherMap</a> pour obtenir une clé API gratuite.
            </div>
        </section>

        <section class="section">
            <h2>Décoder et manipuler une réponse JSON</h2>
            <p>La plupart des API REST renvoient des données au format <strong>JSON</strong>. En PHP, on utilise <code>json_decode</code> pour transformer la réponse en tableau ou objet.</p>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Exemple de réponse JSON</span>
<span class="string">'{"name":"Paris","main":{"temp":22.5},"weather":[{"description":"ciel dégagé"}]}'</span>

<span class="comment">// Décodage en tableau associatif</span>
<span class="variable">$data</span> = <span class="function">json_decode</span>(<span class="string">'{"name":"Paris","main":{"temp":22.5},"weather":[{"description":"ciel dégagé"}]}'</span>, <span class="keyword">true</span>);
<span class="keyword">echo</span> <span class="string">$data['main']['temp']</span>; <span class="comment">// 22.5</span>
<span class="keyword">echo</span> <span class="string">$data['weather'][0]['description']</span>; <span class="comment">// ciel dégagé</span>
</code></pre>
            </div>
            <div class="info-box">
                <strong>À savoir :</strong> <code>json_decode($json, true)</code> retourne un tableau associatif, <code>json_decode($json)</code> retourne un objet PHP.
            </div>
        </section>

        <section class="section">
            <h2>Aller plus loin avec cURL : headers, timeout, erreurs</h2>
            <p>cURL permet de personnaliser vos requêtes HTTP : ajouter des headers, gérer le timeout, suivre les redirections, etc.</p>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Exemple avancé avec headers et timeout</span>
<span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="string">'https://api.exemple.com/data'</span>);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_RETURNTRANSFER</span>, <span class="keyword">true</span>);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_HTTPHEADER</span>, [<span class="string">'Accept: application/json'</span>, <span class="string">'Authorization: Bearer VOTRE_TOKEN'</span>]);
<span class="function">curl_setopt</span>(<span class="variable">$ch</span>, <span class="constant">CURLOPT_TIMEOUT</span>, 5); <span class="comment">// 5 secondes max</span>
<span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
<span class="variable">$httpCode</span> = <span class="function">curl_getinfo</span>(<span class="variable">$ch</span>, <span class="constant">CURLINFO_HTTP_CODE</span>);
<span class="keyword">if</span> (<span class="variable">$httpCode</span> === 200) {
    <span class="keyword">echo</span> <span class="variable">$response</span>;
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Erreur API : code $httpCode"</span>;
}
<span class="function">curl_close</span>(<span class="variable">$ch</span>);
</code></pre>
            </div>
            <div class="tip-box">
                <strong>Conseil :</strong> Utilisez toujours un timeout pour éviter que votre script ne reste bloqué si l'API ne répond pas.
            </div>
        </section>

        <section class="section">
            <h2>Tester une API en local : outils pratiques</h2>
            <p>Pour tester vos appels API, vous pouvez utiliser des outils comme <a href="https://www.postman.com/" target="_blank">Postman</a> ou <a href="https://httpie.io/" target="_blank">HTTPie</a>. Ils permettent de simuler des requêtes, voir les réponses, tester différents headers, etc.</p>
            <div class="info-box">
                <strong>Astuce :</strong> Utilisez <code>php -S localhost:8000</code> pour lancer un serveur local et tester vos webhooks ou endpoints API.
            </div>
        </section>

        <section class="section">
            <h2>Utiliser Postman pour tester une API</h2>
            <p><a href="https://www.postman.com/" target="_blank">Postman</a> est un outil graphique gratuit qui permet de tester facilement des requêtes API sans écrire de code. Il est très utilisé par les développeurs pour explorer, documenter et automatiser les tests d'API.</p>
            <ol>
                <li><strong>Téléchargez et installez Postman</strong> depuis <a href="https://www.postman.com/downloads/" target="_blank">le site officiel</a>.</li>
                <li><strong>Créez une nouvelle requête</strong> :<br>
                    <ul>
                        <li>Cliquez sur <strong>New &gt; HTTP Request</strong>.</li>
                        <li>Choisissez la méthode (GET, POST, etc.) et saisissez l'URL de l'API (ex : <code>https://jsonplaceholder.typicode.com/posts</code>).</li>
                    </ul>
                </li>
                <li><strong>Ajoutez des paramètres ou un corps de requête</strong> :<br>
                    <ul>
                        <li>Pour une requête GET, ajoutez les paramètres dans l'onglet <strong>Params</strong>.</li>
                        <li>Pour une requête POST, allez dans l'onglet <strong>Body</strong>, sélectionnez <strong>raw</strong> et choisissez <strong>JSON</strong> puis saisissez votre payload.</li>
                    </ul>
                </li>
                <li><strong>Ajoutez des headers</strong> si besoin (ex : <code>Authorization</code>, <code>Content-Type: application/json</code>).</li>
                <li><strong>Cliquez sur <em>Send</em></strong> pour envoyer la requête et visualiser la réponse (statut HTTP, en-têtes, corps JSON, etc.).</li>
            </ol>
            <div class="example-box">
                <pre><code class="language-json">{
  "title": "Test Postman",
  "body": "Ceci est un test via Postman",
  "userId": 1
}</code></pre>
            </div>
            <div class="info-box">
                <strong>Bonnes pratiques :</strong>
                <ul>
                    <li>Utilisez l'onglet <strong>History</strong> pour rejouer des requêtes.</li>
                    <li>Enregistrez vos requêtes dans des <strong>collections</strong> pour les retrouver facilement.</li>
                    <li>Exploitez l'onglet <strong>Tests</strong> pour automatiser la vérification des réponses.</li>
                    <li>Vous pouvez générer du code PHP (ou autre) à partir d'une requête Postman via <strong>Code &gt; PHP cURL</strong>.</li>
                </ul>
            </div>
            <div class="tip-box">
                <strong>Astuce :</strong> Postman permet aussi de simuler des webhooks en lançant un serveur local ou en utilisant <a href="https://webhook.site/" target="_blank">webhook.site</a> pour recevoir des notifications d'API.
            </div>
        </section>

        <section class="section">
            <h2>Exemple pratique : API de covoiturage</h2>
            <p>Imaginons que nous développons une application de covoiturage et que nous devons intégrer une API pour rechercher des trajets disponibles entre deux villes. Voici comment nous pourrions procéder :</p>

            <h3>1. Présentation du cas d'usage</h3>
            <p>Notre API fictive <strong>CarShare API</strong> permet de :</p>
            <ul>
                <li>Rechercher des trajets entre deux villes</li>
                <li>Filtrer par date, nombre de places, prix maximum</li>
                <li>Obtenir les détails d'un trajet spécifique</li>
                <li>Réserver un siège pour un trajet</li>
            </ul>

            <div class="info-box">
                <strong>Fonctionnement général d'une API de covoiturage :</strong>
                <ol>
                    <li>L'utilisateur saisit des critères de recherche (départ, arrivée, date...)</li>
                    <li>Notre application PHP envoie ces critères à l'API</li>
                    <li>L'API renvoie une liste de trajets correspondants</li>
                    <li>Notre application affiche les résultats et permet à l'utilisateur d'interagir avec eux</li>
                </ol>
            </div>

            <h3>2. Exemple : Recherche de trajets disponibles</h3>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">/**
 * Exemple d'intégration d'une API de covoiturage
 * 
 * Cet exemple montre comment :
 * 1. Construire une requête avec plusieurs paramètres
 * 2. Gérer la pagination des résultats
 * 3. Traiter et afficher les données reçues
 */</span>

<span class="comment">// Configuration de l'API (à stocker de manière sécurisée en production)</span>
<span class="variable">$apiKey</span> = <span class="string">'votre_cle_api_carshare'</span>;
<span class="variable">$baseUrl</span> = <span class="string">'https://api.carshare-exemple.com/v1'</span>;

<span class="comment">// Paramètres de la recherche (normalement fournis par un formulaire)</span>
<span class="variable">$villeDepart</span> = <span class="string">'Paris'</span>;
<span class="variable">$villeArrivee</span> = <span class="string">'Lyon'</span>;
<span class="variable">$date</span> = <span class="string">'2025-06-25'</span>; <span class="comment">// Format YYYY-MM-DD</span>
<span class="variable">$nbPassagers</span> = 2;
<span class="variable">$prixMax</span> = 30; <span class="comment">// Prix maximum en euros</span>
<span class="variable">$page</span> = 1;  <span class="comment">// Pour la pagination des résultats</span>

<span class="comment">// Construction de l'URL avec les paramètres</span>
<span class="variable">$url</span> = <span class="string">"$baseUrl/trips/search?"</span> . <span class="function">http_build_query</span>([
    <span class="string">'departure'</span> => <span class="variable">$villeDepart</span>,
    <span class="string">'arrival'</span> => <span class="variable">$villeArrivee</span>,
    <span class="string">'date'</span> => <span class="variable">$date</span>,
    <span class="string">'passengers'</span> => <span class="variable">$nbPassagers</span>,
    <span class="string">'max_price'</span> => <span class="variable">$prixMax</span>,
    <span class="string">'page'</span> => <span class="variable">$page</span>,
    <span class="string">'per_page'</span> => 10
]);

<span class="comment">// Initialisation de cURL</span>
<span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="variable">$url</span>);

<span class="comment">// Configuration des options cURL</span>
<span class="function">curl_setopt_array</span>(<span class="variable">$ch</span>, [
    <span class="constant">CURLOPT_RETURNTRANSFER</span> => <span class="keyword">true</span>,
    <span class="constant">CURLOPT_HTTPHEADER</span> => [
        <span class="string">'Authorization: Bearer '</span> . <span class="variable">$apiKey</span>,
        <span class="string">'Accept: application/json'</span>,
        <span class="string">'User-Agent: MonAppCovoiturage/1.0'</span>
    ],
    <span class="constant">CURLOPT_TIMEOUT</span> => 10  <span class="comment">// Timeout de 10 secondes</span>
]);

<span class="comment">// Exécution de la requête</span>
<span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
<span class="variable">$httpCode</span> = <span class="function">curl_getinfo</span>(<span class="variable">$ch</span>, <span class="constant">CURLINFO_HTTP_CODE</span>);

<span class="comment">// Fermeture de la connexion cURL</span>
<span class="function">curl_close</span>(<span class="variable">$ch</span>);

<span class="comment">// Traitement de la réponse</span>
<span class="keyword">if</span> (<span class="variable">$httpCode</span> === 200) {
    <span class="variable">$data</span> = <span class="function">json_decode</span>(<span class="variable">$response</span>, <span class="keyword">true</span>);
    
    <span class="comment">// Affichage des résultats</span>
    <span class="keyword">if</span> (!<span class="keyword">empty</span>(<span class="variable">$data</span>[<span class="string">'trips'</span>])) {
        <span class="keyword">echo</span> <span class="string">"&lt;h3>Trajets disponibles de $villeDepart à $villeArrivee le $date&lt;/h3>"</span>;
        <span class="keyword">echo</span> <span class="string">"&lt;div class='trips-container'>"</span>;
        
        <span class="keyword">foreach</span> (<span class="variable">$data</span>[<span class="string">'trips'</span>] <span class="keyword">as</span> <span class="variable">$trajet</span>) {
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-card'>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-header'>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-route'>{$trajet['departure_city']} → {$trajet['arrival_city']}&lt;/div>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-price'>{$trajet['price']}€&lt;/div>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;/div>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-details'>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-time'>Départ: {$trajet['departure_time']} - Arrivée: {$trajet['arrival_time']}&lt;/div>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-seats'>Places disponibles: {$trajet['available_seats']}&lt;/div>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-driver'>Conducteur: {$trajet['driver']['name']} (Note: {$trajet['driver']['rating']}/5)&lt;/div>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;/div>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;a href='reservation.php?trip_id={$trajet['id']}' class='btn-book'>Réserver&lt;/a>"</span>;
            <span class="keyword">echo</span> <span class="string">"&lt;/div>"</span>;
        }
        
        <span class="keyword">echo</span> <span class="string">"&lt;/div>"</span>;
        
        <span class="comment">// Affichage de la pagination si nécessaire</span>
        <span class="keyword">if</span> (<span class="variable">$data</span>[<span class="string">'total_pages'</span>] > 1) {
            <span class="keyword">echo</span> <span class="string">"&lt;div class='pagination'>"</span>;
            <span class="keyword">for</span> (<span class="variable">$i</span> = 1; <span class="variable">$i</span> <= <span class="variable">$data</span>[<span class="string>'total_pages'</span>]; <span class="variable">$i</span>++) {
                <span class="variable">$activeClass</span> = (<span class="variable">$i</span> == <span class="variable">$page</span>) ? <span class="string">' active'</span> : <span class="string">''</span>;
                <span class="keyword">echo</span> <span class="string">"&lt;a href='?departure=$villeDepart&arrival=$villeArrivee&date=$date&page=$i' class='page-link$activeClass'>$i&lt;/a>"</span>;
            }
            <span class="keyword">echo</span> <span class="string">"&lt;/div>"</span>;
        }
    } <span class="keyword">else</span> {
        <span class="keyword">echo</span> <span class="string">"&lt;div class='no-results'>Aucun trajet disponible pour ces critères. Essayez de modifier votre recherche.&lt;/div>"</span>;
    }
} <span class="keyword">elseif</span> (<span class="variable">$httpCode</span> === 401) {
    <span class="keyword">echo</span> <span class="string">"&lt;div class='error'>Erreur d'authentification. Vérifiez votre clé API.&lt;/div>"</span>;
} <span class="keyword">elseif</span> (<span class="variable">$httpCode</span> === 429) {
    <span class="keyword">echo</span> <span class="string">"&lt;div class='error'>Trop de requêtes. Veuillez réessayer dans quelques instants.&lt;/div>"</span>;
} <span class="keyword">else</span> {
    <span class="variable">$error</span> = <span class="function">json_decode</span>(<span class="variable">$response</span>, <span class="keyword">true</span>);
    <span class="variable">$errorMessage</span> = <span class="keyword">isset</span>(<span class="variable">$error</span>[<span class="string">'message'</span>]) ? <span class="variable">$error</span>[<span class="string">'message'</span>] : <span class="string">"Erreur inconnue (Code: $httpCode)"</span>;
    <span class="keyword">echo</span> <span class="string">"&lt;div class='error'>Erreur API: $errorMessage&lt;/div>"</span>;
}
</code></pre>
            </div>

            <h3>3. Structure de la réponse JSON</h3>
            <p>Voici un exemple de la structure de données que pourrait renvoyer notre API de covoiturage :</p>
            <div class="example-box">
                <pre><code class="language-json">{
  "meta": {
    "total_results": 42,
    "total_pages": 5,
    "current_page": 1,
    "results_per_page": 10
  },
  "trips": [
    {
      "id": "trip_12345",
      "departure_city": "Paris",
      "departure_address": "Gare de Lyon",
      "departure_coordinates": {"lat": 48.8448, "lng": 2.3735},
      "departure_time": "2025-06-25T08:30:00+02:00",
      "arrival_city": "Lyon",
      "arrival_address": "Gare Part-Dieu",
      "arrival_coordinates": {"lat": 45.7597, "lng": 4.8592},
      "arrival_time": "2025-06-25T12:15:00+02:00",
      "price": 25.50,
      "distance": 465,
      "duration": 225,
      "available_seats": 3,
      "total_seats": 4,
      "driver": {
        "id": "user_6789",
        "name": "Thomas D.",
        "rating": 4.8,
        "trips_count": 142,
        "verified": true,
        "picture_url": "https://api.carshare-exemple.com/users/6789/picture"
      },
      "vehicle": {
        "make": "Renault",
        "model": "Zoé",
        "color": "Bleu",
        "eco_friendly": true
      },
      "amenities": ["climatisation", "prises USB", "animaux acceptés"]
    },
    // ... autres trajets ...
  ]
}</code></pre>
            </div>

            <h3>4. Récupérer les détails d'un trajet spécifique</h3>
            <p>Une fois qu'un utilisateur sélectionne un trajet, vous pouvez récupérer ses détails complets pour afficher plus d'informations :</p>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Récupération des détails d'un trajet spécifique</span>
<span class="keyword">function</span> <span class="function">getTripDetails</span>(<span class="variable">$tripId</span>, <span class="variable">$apiKey</span>, <span class="variable">$baseUrl</span>) {
    <span class="variable">$url</span> = <span class="string">"$baseUrl/trips/$tripId"</span>;
    
    <span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="variable">$url</span>);
    <span class="function">curl_setopt_array</span>(<span class="variable">$ch</span>, [
        <span class="constant">CURLOPT_RETURNTRANSFER</span> => <span class="keyword">true</span>,
        <span class="constant">CURLOPT_HTTPHEADER</span> => [
            <span class="string">'Authorization: Bearer '</span> . <span class="variable">$apiKey</span>,
            <span class="string">'Accept: application/json'</span>
        ]
    ]);
    
    <span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
    <span class="variable">$httpCode</span> = <span class="function">curl_getinfo</span>(<span class="variable">$ch</span>, <span class="constant">CURLINFO_HTTP_CODE</span>);
    <span class="function">curl_close</span>(<span class="variable">$ch</span>);
    
    <span class="keyword">if</span> (<span class="variable">$httpCode</span> === 200) {
        <span class="keyword">return</span> <span class="function">json_decode</span>(<span class="variable">$response</span>, <span class="keyword">true</span>);
    } <span class="keyword">else</span> {
        <span class="keyword">return</span> <span class="keyword">null</span>;
    }
}

<span class="comment">// Utilisation</span>
<span class="keyword">if</span> (<span class="keyword">isset</span>(<span class="variable">$_GET</span>[<span class="string">'trip_id'</span>])) {
    <span class="variable">$tripDetails</span> = <span class="function">getTripDetails</span>(<span class="variable">$_GET</span>[<span class="string">'trip_id'</span>], <span class="variable">$apiKey</span>, <span class="variable">$baseUrl</span>);
    
    <span class="keyword">if</span> (<span class="variable">$tripDetails</span>) {
        <span class="comment">// Afficher les détails complets du trajet</span>
        <span class="keyword">echo</span> <span class="string">"&lt;div class='trip-details-page'>"</span>;
        <span class="keyword">echo</span> <span class="string">"&lt;h2>Trajet de {$tripDetails['departure_city']} à {$tripDetails['arrival_city']}&lt;/h2>"</span>;
        <span class="comment">// Afficher les autres informations du trajet</span>
        <span class="keyword">echo</span> <span class="string">"&lt;/div>"</span>;
    } <span class="keyword">else</span> {
        <span class="keyword">echo</span> <span class="string">"&lt;div class='error'>Impossible de récupérer les détails du trajet.&lt;/div>"</span>;
    }
}
</code></pre>
            </div>

            <h3>5. Effectuer une réservation</h3>
            <p>Pour réserver une place sur un trajet, on utilise généralement une requête POST avec les informations du passager :</p>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// Fonction pour réserver un trajet</span>
<span class="keyword">function</span> <span class="function">bookTrip</span>(<span class="variable">$tripId</span>, <span class="variable">$userData</span>, <span class="variable">$apiKey</span>, <span class="variable">$baseUrl</span>) {
    <span class="variable">$url</span> = <span class="string">"$baseUrl/bookings"</span>;
    
    <span class="comment">// Préparation des données pour la réservation</span>
    <span class="variable">$postData</span> = [
        <span class="string>'trip_id'</span> => <span class="variable">$tripId</span>,
        <span class="string>'passengers'</span> => <span class="variable">$userData</span>[<span class="string>'passengers'</span>],
        <span class="string>'passenger_name'</span> => <span class="variable">$userData</span>[<span class="string>'name'</span>],
        <span class="string>'passenger_email'</span> => <span class="variable">$userData</span>[<span class="string>'email'</span>],
        <span class="string>'passenger_phone'</span> => <span class="variable">$userData</span>[<span class="string>'phone'</span>],
        <span class="string>'message_to_driver'</span> => <span class="variable">$userData</span>[<span class="string>'message'</span>] ?? <span class="string">''</span>
    ];
    
    <span class="variable">$ch</span> = <span class="function">curl_init</span>(<span class="variable">$url</span>);
    <span class="function">curl_setopt_array</span>(<span class="variable">$ch</span>, [
        <span class="constant">CURLOPT_RETURNTRANSFER</span> => <span class="keyword">true</span>,
        <span class="constant">CURLOPT_POST</span> => <span class="keyword">true</span>,
        <span class="constant">CURLOPT_POSTFIELDS</span> => <span class="function">json_encode</span>(<span class="variable">$postData</span>),
        <span class="constant">CURLOPT_HTTPHEADER</span> => [
            <span class="string">'Authorization: Bearer '</span> . <span class="variable">$apiKey</span>,
            <span class="string">'Content-Type: application/json'</span>,
            <span class="string">'Accept: application/json'</span>
        ]
    ]);
    
    <span class="variable">$response</span> = <span class="function">curl_exec</span>(<span class="variable">$ch</span>);
    <span class="variable">$httpCode</span> = <span class="function">curl_getinfo</span>(<span class="variable">$ch</span>, <span class="constant">CURLINFO_HTTP_CODE</span>);
    <span class="function">curl_close</span>(<span class="variable">$ch</span>);
    
    <span class="keyword">return</span> [
        <span class="string>'status'</span> => (<span class="variable">$httpCode</span> === 201), <span class="comment">// 201 Created pour une réservation réussie</span>
        <span class="string>'data'</span> => <span class="function">json_decode</span>(<span class="variable">$response</span>, <span class="keyword">true</span>)
    ];
}

<span class="comment">// Gestion du formulaire de réservation</span>
<span class="keyword">if</span> (<span class="variable">$_SERVER</span>[<span class="string>'REQUEST_METHOD'</span>] === <span class="string">'POST'</span>) {
    <span class="variable">$tripId</span> = <span class="variable">$_POST</span>[<span class="string>'trip_id'</span>];
    
    <span class="variable">$userData</span> = [
        <span class="string>'name'</span> => <span class="variable">$_POST</span>[<span class="string>'name'</span>],
        <span class="string>'email'</span> => <span class="variable">$_POST</span>[<span class="string>'email'</span>],
        <span class="string>'phone'</span> => <span class="variable">$_POST</span>[<span class="string>'phone'</span>],
        <span class="string>'passengers'</span> => (int) <span class="variable">$_POST</span>[<span class="string>'passengers'</span>],
        <span class="string>'message'</span> => <span class="variable">$_POST</span>[<span class="string>'message'</span>] ?? <span class="string">''</span>
    ];
    
    <span class="variable">$result</span> = <span class="function">bookTrip</span>(<span class="variable">$tripId</span>, <span class="variable">$userData</span>, <span class="variable">$apiKey</span>, <span class="variable">$baseUrl</span>);
    
    <span class="keyword">if</span> (<span class="variable">$result</span>[<span class="string>'status'</span>]) {
        <span class="comment">// Réservation réussie</span>
        <span class="variable">$bookingId</span> = <span class="variable">$result</span>[<span class="string>'data'</span>][<span class="string>'booking_id'</span>];
        <span class="keyword">echo</span> <span class="string">"&lt;div class='success'>
                &lt;h3>Réservation confirmée !&lt;/h3>
                &lt;p>Votre numéro de réservation : $bookingId&lt;/p>
                &lt;p>Un email de confirmation a été envoyé à {$userData['email']}.&lt;/p>
                &lt;a href='my-bookings.php' class='btn'>Voir mes réservations&lt;/a>
            &lt;/div>"</span>;
    } <span class="keyword">else</span> {
        <span class="comment">// Erreur de réservation</span>
        <span class="variable">$errorMessage</span> = <span class="variable">$result</span>[<span class="string>'data'</span>][<span class="string>'message'</span>] ?? <span class="string">"Impossible de finaliser votre réservation"</span>;
        <span class="keyword">echo</span> <span class="string">"&lt;div class='error'>$errorMessage&lt;/div>"</span>;
    }
}
</code></pre>
            </div>

            <h3>6. Bonnes pratiques pour l'intégration d'une API de covoiturage</h3>
            <div class="info-box">
                <strong>Recommandations :</strong>
                <ul>
                    <li><strong>Mise en cache</strong> : Pour réduire le nombre d'appels API et améliorer les performances, mettez en cache les résultats de recherche pour une courte durée (ex : 1-5 minutes).</li>
                    <li><strong>Temps réel</strong> : Pour les réservations, assurez-vous toujours d'avoir les données à jour (ne pas utiliser le cache).</li>
                    <li><strong>Gestion des erreurs</strong> : Prévoyez tous les cas d'erreur possibles : API indisponible, plus de places disponibles, etc.</li>
                    <li><strong>Expérience utilisateur</strong> : Affichez un indicateur de chargement pendant les appels API et proposez des actions alternatives en cas d'échec.</li>
                    <li><strong>Sécurité</strong> : Ne stockez jamais la clé API côté client et validez toujours les données envoyées par l'utilisateur.</li>
                </ul>
            </div>

            <div class="tip-box">
                <strong>Astuce</strong> : Pour simuler une API de covoiturage en phase de développement, vous pouvez créer un simple fichier JSON contenant des trajets fictifs et le servir via PHP :
                <pre><code class="language-php"><span class="comment">// fake-api.php</span>
<span class="variable">$trips</span> = [
    <span class="comment">/* Vos données de test */</span>
];
<span class="function">header</span>(<span class="string">'Content-Type: application/json'</span>);
<span class="keyword">echo</span> <span class="function">json_encode</span>([<span class="string">'trips'</span> => <span class="variable">$trips</span>, <span class="string>'meta'</span> => [...]);
</code></pre>
            </div>
        </section>

        <section class="section">
            <h2>Utilisation avancée : Webhooks pour les notifications en temps réel</h2>
            <p>Dans le contexte d'une application de covoiturage, les webhooks sont particulièrement utiles pour recevoir des notifications importantes :</p>
            <ul>
                <li>Nouvelle demande de réservation</li>
                <li>Annulation d'un trajet par le conducteur</li>
                <li>Rappels avant le départ</li>
                <li>Messages entre conducteurs et passagers</li>
            </ul>
            <div class="example-box">
                <pre><code class="language-php"><span class="comment">// webhook-handler.php - Point d'entrée pour les webhooks envoyés par l'API</span>
<span class="comment">// Vérification de la signature du webhook pour la sécurité</span>
<span class="variable">$payload</span> = <span class="function">file_get_contents</span>(<span class="string">'php://input'</span>);
<span class="variable">$signature</span> = <span class="variable">$_SERVER</span>[<span class="string">'HTTP_X_CARSHARE_SIGNATURE'</span>] ?? <span class="string">''</span>;

<span class="keyword">if</span> (!<span class="function">verifyWebhookSignature</span>(<span class="variable">$payload</span>, <span class="variable">$signature</span>, <span class="variable">$webhookSecret</span>)) {
    <span class="function">http_response_code</span>(403);
    <span class="keyword">exit</span>(<span class="string">'Signature non valide'</span>);
}

<span class="variable">$event</span> = <span class="function">json_decode</span>(<span class="variable">$payload</span>, <span class="keyword">true</span>);

<span class="comment">// Traitement selon le type d'événement</span>
<span class="keyword">switch</span> (<span class="variable">$event</span>[<span class="string">'type'</span>]) {
    <span class="keyword">case</span> <span class="string">'trip.cancelled'</span>:
        <span class="comment">// Envoi d'un email aux passagers pour les prévenir</span>
        <span class="function">notifyPassengersAboutCancellation</span>(<span class="variable">$event</span>[<span class="string">'data'</span>][<span class="string">'trip_id'</span>]);
        <span class="keyword">break</span>;
    
    <span class="keyword">case</span> <span class="string">'booking.confirmed'</span>:
        <span class="comment">// Mise à jour du statut de réservation dans votre BDD</span>
        <span class="function">updateBookingStatus</span>(<span class="variable">$event</span>[<span class="string">'data'</span>][<span class="string">'booking_id'</span>], <span class="string">'confirmed'</span>);
        <span class="keyword">break</span>;
    
    <span class="keyword">case</span> <span class="string">'message.new'</span>:
        <span class="comment">// Notification en temps réel (ex: via WebSockets)</span>
        <span class="function">pushNewMessageNotification</span>(<span class="variable">$event</span>[<span class="string">'data'</span>]);
        <span class="keyword">break</span>;
}

<span class="comment">// Réponse rapide à l'API</span>
<span class="function">http_response_code</span>(200);
<span class="keyword">echo</span> <span class="function">json_encode</span>([<span class="string">'status'</span> => <span class="string">'success'</span>]);
</code></pre>
            </div>
            <div class="warning-box">
                <strong>Important :</strong> Vérifiez toujours la signature d'un webhook pour éviter que des attaquants n'envoient de fausses données à votre application.
            </div>
        </section>

        <div class="navigation">
            <a href="15-architecture-mvc.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="17-gestion-fichiers.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

<?php include __DIR__ . '/../includes/footer.php'; ?>