<?php include __DIR__ . '/../includes/header-pro.php'; ?>


<body class="module13">
    <header>
        <h1>PHP et AJAX</h1>
        <p class="subtitle">Créez des applications web dynamiques en combinant PHP et AJAX pour des mises à jour sans rechargement de page.</p>
    </header>
    <div class="navigation">
        <a href="12-bases-de-donnees.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="14-securite.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction à AJAX avec PHP</h2>
            <p>AJAX (Asynchronous JavaScript And XML) est une technique de développement web qui permet de créer des applications web interactives. Grâce à AJAX, les applications web peuvent envoyer et récupérer des données d'un serveur de façon asynchrone, sans interférer avec l'affichage et le comportement de la page existante.</p>

            <h3>Pourquoi utiliser AJAX avec PHP ?</h3>
            <ul>
                <li><strong>Amélioration de l'expérience utilisateur</strong> : Mise à jour des parties spécifiques de la page sans rechargement complet</li>
                <li><strong>Réduction de la charge serveur</strong> : Récupération de données ciblées plutôt que de générer des pages entières</li>
                <li><strong>Applications web plus réactives</strong> : Interface utilisateur fluide et dynamique</li>
                <li><strong>Interaction asynchrone</strong> : Exécution d'autres scripts pendant le chargement des données</li>
            </ul>

            <div class="ajax-lifecycle">
                <h4>Cycle de vie d'une requête AJAX</h4>
                <p>Comprendre le cycle de vie complet d'une requête AJAX est essentiel pour développer des applications web robustes :</p>
                <div class="ajax-lifecycle-diagram">
                    <div class="lifecycle-step">
                        <h5>1. Déclencheur</h5>
                        <p>Un événement utilisateur (clic, saisie) ou un timer déclenche une requête AJAX</p>
                    </div>
                    <div class="lifecycle-step">
                        <h5>2. Création</h5>
                        <p>Création d'un objet XMLHttpRequest ou utilisation de l'API Fetch</p>
                    </div>
                    <div class="lifecycle-step">
                        <h5>3. Envoi</h5>
                        <p>Configuration et envoi de la requête HTTP vers le serveur PHP</p>
                    </div>
                    <div class="lifecycle-step">
                        <h5>4. Traitement</h5>
                        <p>Le script PHP traite la demande et prépare une réponse</p>
                    </div>
                    <div class="lifecycle-step">
                        <h5>5. Mise à jour</h5>
                        <p>JavaScript reçoit la réponse et met à jour le DOM en conséquence</p>
                    </div>
                </div>
                <p>Cette nature asynchrone signifie que le navigateur n'attend pas la réponse du serveur - le reste de l'application continue de fonctionner normalement pendant ce temps.</p>
            </div>

            <h3>Le rôle de PHP dans les applications AJAX</h3>
            <p>Dans une architecture AJAX, PHP agit comme le <strong>backend</strong> qui :</p>
            <ul>
                <li>Reçoit les requêtes AJAX envoyées par le navigateur</li>
                <li>Traite ces requêtes (interrogation de base de données, calculs, etc.)</li>
                <li>Prépare et renvoie des données formatées (JSON, HTML, XML)</li>
                <li>Gère les sessions utilisateur et l'authentification</li>
                <li>Effectue des validations et traitements de sécurité</li>
            </ul>
            <p>Le PHP est particulièrement bien adapté pour les applications AJAX car il peut générer dynamiquement n'importe quel format de réponse nécessaire et possède des fonctions intégrées pour manipuler facilement le JSON, format le plus utilisé avec AJAX.</p>

            <div class="info-box">
                <p><strong>Prérequis :</strong> Pour ce module, vous devez avoir des connaissances de base en JavaScript, en manipulation du DOM et en PHP, notamment la compréhension des requêtes HTTP.</p>
            </div>
        </section>

        <section class="section">
            <h2>Les bases d'une requête AJAX</h2>

            <h3>1. Avec JavaScript natif (XMLHttpRequest)</h3>
            <p>L'objet XMLHttpRequest est l'approche traditionnelle pour effectuer des requêtes AJAX. Bien que plus verbeux que les méthodes modernes, il reste utile pour comprendre les mécanismes fondamentaux.</p>

            <div class="example">
                <div class="example-header">Requête AJAX simple avec XMLHttpRequest</div>
                <div class="example-content">
                    <pre><code class="language-javascript">
<span class="comment">// Code côté client (JavaScript)</span>
<span class="keyword">function</span> <span class="function">chargerDonnees</span>() {
    <span class="keyword">var</span> <span class="variable">xhr</span> = <span class="keyword">new</span> <span class="class-name">XMLHttpRequest</span>();
    
    <span class="comment">// Configuration de la requête</span>
    <span class="variable">xhr</span>.<span class="function">open</span>(<span class="string">"GET"</span>, <span class="string">"getData.php"</span>, <span class="keyword">true</span>);
      <span class="comment">// Définition de la fonction de callback</span>
    <span class="variable">xhr</span>.<span class="property">onreadystatechange</span> = <span class="keyword">function</span>() {
        <span class="keyword">if</span> (<span class="variable">xhr</span>.<span class="property">readyState</span> === <span class="number">4</span> && <span class="variable">xhr</span>.<span class="property">status</span> === <span class="number">200</span>) {
            <span class="comment">// Traitement de la réponse</span>            <span class="keyword">var</span> <span class="variable">reponse</span> = <span class="variable">xhr</span>.<span class="property">responseText</span>;
            <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">"resultat"</span>).<span class="property">innerHTML</span> = <span class="variable">reponse</span>;
        }
    };
    
    <span class="comment">// Envoi de la requête</span>
    <span class="variable">xhr</span>.<span class="function">send</span>();
}
</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Code PHP pour traiter la requête AJAX</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// getData.php - Code côté serveur</span>
<span class="keyword">header</span>(<span class="string">'Content-Type: text/html; charset=utf-8'</span>);

<span class="comment">// Traitement de la demande</span>
<span class="variable">$donnees</span> = [
    <span class="string">"message"</span> => <span class="string">"Les données ont été chargées avec succès!"</span>,
    <span class="string">"heure"</span> => <span class="function">date</span>(<span class="string">"H:i:s"</span>),
    <span class="string">"date"</span> => <span class="function">date</span>(<span class="string">"d/m/Y"</span>)
];

<span class="comment">// Renvoyer une réponse formatée</span>
<span class="keyword">echo</span> <span class="string">"Message : "</span> . <span class="variable">$donnees</span>[<span class="string">"message"</span>] . <span class="string">"&lt;br&gt;"</span>;
<span class="keyword">echo</span> <span class="string">"Heure : "</span> . <span class="variable">$donnees</span>[<span class="string">"heure"</span>] . <span class="string">"&lt;br&gt;"</span>;
<span class="keyword">echo</span> <span class="string">"Date : "</span> . <span class="variable">$donnees</span>[<span class="string">"date"</span>];
</code></pre>
                </div>
            </div>

            <h3>2. Avec Fetch API (JavaScript moderne)</h3>
            <p>L'API Fetch est une interface JavaScript moderne pour effectuer des requêtes HTTP. Elle utilise les Promises et offre une syntaxe plus élégante que XMLHttpRequest.</p>

            <div class="example">
                <div class="example-header">Requête AJAX avec l'API Fetch</div>
                <div class="example-content">
                    <pre><code class="language-javascript">
<span class="comment">// Code côté client (JavaScript)</span>
<span class="keyword">function</span> <span class="function">chargerDonneesAvecFetch</span>() {    <span class="function">fetch</span>(<span class="string">'getData.php'</span>)
        .<span class="function">then</span>(<span class="parameter">response</span> => {
            <span class="keyword">if</span> (!<span class="variable">response</span>.<span class="property">ok</span>) {
                <span class="keyword">throw</span> <span class="keyword">new</span> <span class="class-name">Error</span>(<span class="string">`Erreur HTTP: ${response.status}`</span>);
            }
            <span class="keyword">return</span> <span class="variable">response</span>.<span class="function">text</span>();
        })
        .<span class="function">then</span>(<span class="parameter">data</span> => {
            <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">'resultat'</span>).<span class="property">innerHTML</span> = <span class="variable">data</span>;
        })
        .<span class="function">catch</span>(<span class="parameter">error</span> => {
            <span class="variable">console</span>.<span class="function">error</span>(<span class="string">'Erreur lors de la récupération des données:'</span>, <span class="variable">error</span>);
        });
}
</code></pre>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Astuce :</strong> L'API Fetch est généralement préférée pour les nouveaux projets car elle est plus moderne, plus puissante et utilise les Promises, ce qui facilite la gestion des opérations asynchrones.</p>
            </div>

            <h3>3. Avec des bibliothèques JavaScript (jQuery, Axios)</h3>
            <p>De nombreuses bibliothèques JavaScript offrent des méthodes simplifiées pour effectuer des requêtes AJAX. Voici deux exemples populaires :</p>

            <div class="example">
                <div class="example-header">Requête AJAX avec jQuery</div>
                <div class="example-content">
                    <pre><code class="language-javascript">
<span class="comment">// jQuery doit être inclus dans votre page</span>
<span class="variable">$</span>(<span class="function">document</span>).<span class="function">ready</span>(<span class="keyword">function</span>() {
    <span class="variable">$</span>(<span class="string">'#boutonCharger'</span>).<span class="function">click</span>(<span class="keyword">function</span>() {
        <span class="variable">$</span>.<span class="function">ajax</span>({
            url: <span class="string">'getData.php'</span>,
            method: <span class="string">'GET'</span>,
            dataType: <span class="string">'json'</span>,
            success: <span class="keyword">function</span>(<span class="parameter">data</span>) {
                <span class="variable">$</span>(<span class="string>'#resultat'</span>).<span class="function">html</span>(<span class="string">`Message: ${data.message}<br>Date: ${data.date}`</span>);
            },
            error: <span class="keyword">function</span>(<span class="parameter">xhr</span>, <span class="parameter">status</span>, <span class="parameter">error</span>) {
                <span class="variable">console</span>.<span class="function">error</span>(<span class="string">'Erreur AJAX:'</span>, <span class="variable">error</span>);
                <span class="variable">$</span>(<span class="string>'#resultat'</span>).<span class="function">html</span>(<span class="string">'Une erreur est survenue'</span>);
            }
        });
    });
});
</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Requête AJAX avec Axios</div>
                <div class="example-content">
                    <pre><code class="language-javascript">
<span class="comment">// Axios doit être inclus dans votre page</span>
<span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">'boutonCharger'</span>).<span class="function">addEventListener</span>(<span class="string">'click'</span>, <span class="keyword">function</span>() {
    <span class="variable">axios</span>.<span class="function">get</span>(<span class="string">'getData.php'</span>)
        .<span class="function">then</span>(<span class="keyword">function</span> (<span class="parameter">response</span>) {
            <span class="keyword">const</span> <span class="variable">data</span> = <span class="variable">response</span>.<span class="property">data</span>;
            <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string>'resultat'</span>).<span class="property">innerHTML</span> = 
                <span class="string">`Message: ${data.message}<br>Date: ${data.date}`</span>;
        })
        .<span class="function">catch</span>(<span class="keyword">function</span> (<span class="parameter">error</span>) {
            <span class="variable">console</span>.<span class="function">error</span>(<span class="string">'Erreur:'</span>, <span class="variable">error</span>);
            <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string>'resultat'</span>).<span class="property">innerHTML</span> = <span class="string">'Une erreur est survenue'</span>;
        });
});
</code></pre>
                </div>
            </div>

            <h3>Tableau comparatif des méthodes AJAX</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Caractéristique</th>
                        <th>XMLHttpRequest</th>
                        <th>Fetch API</th>
                        <th>jQuery Ajax</th>
                        <th>Axios</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Natif au navigateur</td>
                        <td>Oui</td>
                        <td>Oui (moderne)</td>
                        <td>Non (bibliothèque)</td>
                        <td>Non (bibliothèque)</td>
                    </tr>
                    <tr>
                        <td>Support des Promises</td>
                        <td>Non</td>
                        <td>Oui</td>
                        <td>Via $.Deferred</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Support async/await</td>
                        <td>Non</td>
                        <td>Oui</td>
                        <td>Non (natif)</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Gestion automatique JSON</td>
                        <td>Non</td>
                        <td>Via .json()</td>
                        <td>Oui</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Gestion des erreurs</td>
                        <td>Manuelle</td>
                        <td>Via .catch()</td>
                        <td>Via error callback</td>
                        <td>Via .catch()</td>
                    </tr>
                    <tr>
                        <td>Annulation de requêtes</td>
                        <td>Oui</td>
                        <td>Via AbortController</td>
                        <td>Oui</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Verbosité du code</td>
                        <td>Élevée</td>
                        <td>Moyenne</td>
                        <td>Faible</td>
                        <td>Faible</td>
                    </tr>
                    <tr>
                        <td>Support navigateurs</td>
                        <td>Tous</td>
                        <td>Modernes</td>
                        <td>Tous (avec jQuery)</td>
                        <td>Tous (avec polyfills)</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="section">
            <h2>Envoyer des données au serveur</h2>
            <p>AJAX ne se limite pas à récupérer des données. Il permet également d'envoyer des données au serveur sans rechargement de page.</p>

            <h3>Envoi de données avec XMLHttpRequest</h3>
            <div class="example">
                <div class="example-header">Envoi de données par POST avec XMLHttpRequest</div>
                <div class="example-content">
                    <pre><code class="language-javascript">
<span class="keyword">function</span> <span class="function">envoyerFormulaire</span>() {    <span class="keyword">var</span> <span class="variable">xhr</span> = <span class="keyword">new</span> <span class="class-name">XMLHttpRequest</span>();
    <span class="variable">xhr</span>.<span class="function">open</span>(<span class="string">"POST"</span>, <span class="string">"traiter.php"</span>, <span class="keyword">true</span>);
    <span class="variable">xhr</span>.<span class="function">setRequestHeader</span>(<span class="string">"Content-Type"</span>, <span class="string">"application/x-www-form-urlencoded"</span>);
    
    <span class="variable">xhr</span>.<span class="property">onreadystatechange</span> = <span class="keyword">function</span>() {
        <span class="keyword">if</span> (<span class="variable">xhr</span>.<span class="property">readyState</span> === <span class="number">4</span> && <span class="variable">xhr</span>.<span class="property">status</span> === <span class="number">200</span>) {
            <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">"resultat"</span>).<span class="property">innerHTML</span> = <span class="variable">xhr</span>.<span class="property">responseText</span>;
        }
    };
    
    <span class="keyword">var</span> <span class="variable">nom</span> = <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">"nom"</span>).<span class="property">value</span>;
    <span class="keyword">var</span> <span class="variable">email</span> = <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">"email"</span>).<span class="property">value</span>;
    <span class="variable">xhr</span>.<span class="function">send</span>(<span class="string">"nom="</span> + <span class="function">encodeURIComponent</span>(<span class="variable">nom</span>) + <span class="string">"&email="</span> + <span class="function">encodeURIComponent</span>(<span class="variable">email</span>));
}
</code></pre>
                </div>
            </div>

            <h3>Envoi de données avec Fetch API</h3>
            <div class="example">
                <div class="example-header">Envoi de données JSON avec Fetch API</div>
                <div class="example-content">
                    <pre><code class="language-javascript">
<span class="keyword">async</span> <span class="keyword">function</span> <span class="function">envoyerDonnees</span>() {    <span class="keyword">const</span> <span class="variable">donnees</span> = {
        nom: <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">'nom'</span>).<span class="property">value</span>,
        email: <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">'email'</span>).<span class="property">value</span>,
        message: <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">'message'</span>).<span class="property">value</span>
    };

    <span class="keyword">try</span> {        <span class="keyword">const</span> <span class="variable">response</span> = <span class="keyword">await</span> <span class="function">fetch</span>(<span class="string">'traiter.php'</span>, {
            method: <span class="string">'POST'</span>,
            headers: {
                <span class="string">'Content-Type'</span>: <span class="string">'application/json'</span>
            },
            body: <span class="class-name">JSON</span>.<span class="function">stringify</span>(<span class="variable">donnees</span>)
        });

        <span class="keyword">if</span> (!<span class="variable">response</span>.<span class="property">ok</span>) {
            <span class="keyword">throw</span> <span class="keyword">new</span> <span class="class-name">Error</span>(<span class="string">`HTTP Error: ${response.status}`</span>);
        }        <span class="keyword">const</span> <span class="variable">data</span> = <span class="keyword">await</span> <span class="variable">response</span>.<span class="function">json</span>();
        <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">'resultat'</span>).<span class="property">textContent</span> = <span class="variable">data</span>.<span class="property">message</span>;
    } <span class="keyword">catch</span> (<span class="variable">error</span>) {
        <span class="variable">console</span>.<span class="function">error</span>(<span class="string">'Erreur:'</span>, <span class="variable">error</span>);
        <span class="variable">document</span>.<span class="function">getElementById</span>(<span class="string">'resultat'</span>).<span class="property">textContent</span> = <span class="string">'Une erreur est survenue.'</span>;
    }
}
</code></pre>
                </div>
            </div>

            <h3>Traitement côté serveur</h3>
            <div class="example">
                <div class="example-header">Traitement d'une requête POST JSON en PHP</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// traiter.php - Code côté serveur</span>
<span class="keyword">header</span>(<span class="string">'Content-Type: application/json; charset=utf-8'</span>);

<span class="comment">// Récupération des données JSON</span>
<span class="variable">$json</span> = <span class="function">file_get_contents</span>(<span class="string">'php://input'</span>);
<span class="variable">$donnees</span> = <span class="function">json_decode</span>(<span class="variable">$json</span>, <span class="keyword">true</span>);

<span class="comment">// Validation des données</span>
<span class="keyword">if</span> (
    !<span class="function">isset</span>(<span class="variable">$donnees</span>[<span class="string">'nom'</span>]) || 
    !<span class="function">isset</span>(<span class="variable">$donnees</span>[<span class="string>'email'</span>]) || 
    !<span class="function">isset</span>(<span class="variable">$donnees</span>[<span class="string>'message'</span>])
) {
    <span class="keyword">echo</span> <span class="function">json_encode</span>([
        <span class="string>'success'</span> => <span class="keyword">false</span>,
        <span class="string">'message'</span> => <span class="string">'Données incomplètes'</span>
    ]);
    <span class="keyword">exit</span>;
}

<span class="comment">// Traitement des données (ici simplement pour démonstration)</span>
<span class="variable">$nom</span> = <span class="function">htmlspecialchars</span>(<span class="variable">$donnees</span>[<span class="string">'nom'</span>]);
<span class="variable">$email</span> = <span class="function">filter_var</span>(<span class="variable">$donnees</span>[<span class="string>'email'</span>], <span class="constant">FILTER_SANITIZE_EMAIL</span>);

<span class="comment">// Dans un cas réel, vous pourriez faire un enregistrement en base de données ici</span>
<span class="comment">// $sql = "INSERT INTO messages (nom, email, message) VALUES (:nom, :email, :message)";</span>

<span class="comment">// Réponse</span>
<span class="keyword">echo</span> <span class="function">json_encode</span>([
    <span class="string">'success'</span> => <span class="keyword">true</span>,
    <span class="string>'message'</span> => <span class="string">"Merci {$nom} ! Votre message a été envoyé."</span>
]);
</code></pre>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Conseil de sécurité :</strong> N'oubliez jamais de valider et de nettoyer les données reçues côté serveur, même si vous avez déjà validé les données côté client.</p>
            </div>
        </section>

        <section class="section">
            <h2>Exemple pratique : Système de recherche en temps réel</h2>
            <p>Voici un exemple concret d'utilisation d'AJAX pour créer un système de recherche en temps réel qui affiche les résultats au fur et à mesure que l'utilisateur tape sa requête.</p>

            <div class="server-client-diagram">
                <div class="client">
                    <h4>Côté client (JavaScript et HTML)</h4>
                    <pre><code>
<span class="js-comment">// HTML</span>
&lt;<span class="js-keyword">div</span> <span class="js-keyword">class</span>=<span class="js-string">"search-container"</span>&gt;
    &lt;<span class="js-keyword">input</span> <span class="js-keyword">type</span>=<span class="js-string">"text"</span> <span class="js-keyword">id</span>=<span class="js-string">"searchInput"</span> <span class="js-keyword">placeholder</span>=<span class="js-string">"Rechercher..."</span>&gt;
    &lt;<span class="js-keyword">div</span> <span class="js-keyword">id</span>=<span class="js-string">"searchResults"</span>&gt;&lt;/<span class="js-keyword">div</span>&gt;
&lt;/<span class="js-keyword">div</span>&gt;

<span class="js-comment">// JavaScript</span>
<span class="js-keyword">const</span> <span class="js-variable">searchInput</span> = <span class="js-function">document</span>.<span class="js-function">getElementById</span>(<span class="js-string">'searchInput'</span>);
<span class="js-keyword">const</span> <span class="js-variable">searchResults</span> = <span class="js-function">document</span>.<span class="js-function">getElementById</span>(<span class="js-string">'searchResults'</span>);

<span class="comment">// Délai pour éviter trop de requêtes pendant la frappe</span>
<span class="keyword">let</span> <span class="variable">typingTimer</span>;
<span class="keyword">const</span> <span class="variable">doneTypingInterval</span> = <span class="number">300</span>; <span class="comment">// 300ms de délai</span>

<span class="variable">searchInput</span>.<span class="function">addEventListener</span>(<span class="string">'input'</span>, <span class="keyword">function</span>() {    <span class="keyword">const</span> <span class="variable">query</span> = <span class="variable-built-in">this</span>.<span class="property">value</span>.<span class="function">trim</span>();
    
    <span class="comment">// Effacer le minuteur précédent</span>
    <span class="function">clearTimeout</span>(<span class="variable">typingTimer</span>);
    
    <span class="comment">// Ne rien faire si la requête est vide</span>
    <span class="keyword">if</span> (<span class="variable">query</span>.<span class="property">length</span> < <span class="number">2</span>) {
        <span class="variable">searchResults</span>.<span class="property">innerHTML</span> = <span class="string">''</span>;
        <span class="keyword">return</span>;
    }
      <span class="comment">// Configurer un nouveau minuteur</span>
    <span class="variable">typingTimer</span> = <span class="function">setTimeout</span>(<span class="keyword">function</span>() {
        <span class="function">rechercherProduits</span>(<span class="variable">query</span>);
    }, <span class="variable">doneTypingInterval</span>);
});

<span class="keyword">async</span> <span class="keyword">function</span> <span class="function">rechercherProduits</span>(<span class="parameter">query</span>) {
    <span class="keyword">try</span> {
        <span class="keyword">const</span> <span class="variable">response</span> = <span class="keyword">await</span> <span class="function">fetch</span>(<span class="string">`recherche.php?q=${encodeURIComponent(query)}`</span>);        <span class="keyword">const</span> <span class="variable">data</span> = <span class="keyword">await</span> <span class="variable">response</span>.<span class="function">json</span>();
        
        <span class="comment">// Afficher les résultats</span>
        <span class="function">afficherResultats</span>(<span class="variable">data</span>);
    } <span class="keyword">catch</span> (<span class="variable">error</span>) {
        <span class="variable">console</span>.<span class="function">error</span>(<span class="string">'Erreur de recherche:'</span>, <span class="variable">error</span>);
        <span class="variable">searchResults</span>.<span class="property">innerHTML</span> = <span class="string">'Une erreur est survenue'</span>;
    }
}

<span class="keyword">function</span> <span class="function">afficherResultats</span>(<span class="parameter">resultats</span>) {    <span class="keyword">if</span> (<span class="variable">resultats</span>.<span class="property">length</span> === <span class="number">0</span>) {
        <span class="variable">searchResults</span>.<span class="property">innerHTML</span> = <span class="string">'&lt;p&gt;Aucun résultat trouvé&lt;/p&gt;'</span>;
        <span class="keyword">return</span>;
    }
    
    <span class="keyword">let</span> <span class="variable">html</span> = <span class="string">'&lt;ul class="results-list"&gt;'</span>;
    <span class="variable">resultats</span>.<span class="function">forEach</span>(<span class="parameter">item</span> => {
        <span class="variable">html</span> += <span class="string">`
            &lt;li&gt;
                &lt;div class="result-item"&gt;
                    &lt;h4&gt;${item.nom}&lt;/h4&gt;
                    &lt;p&gt;${item.description}&lt;/p&gt;
                &lt;/div&gt;
            &lt;/li&gt;
        `</span>;
    });    <span class="variable">html</span> += <span class="string">'&lt;/ul&gt;'</span>;
    
    <span class="variable">searchResults</span>.<span class="property">innerHTML</span> = <span class="variable">html</span>;
}
</code></pre>
                </div>
                <div class="server">
                    <h4>Côté serveur (PHP)</h4>
                    <pre><code class="language-php">
<span class="comment">// recherche.php</span>
<span class="keyword">header</span>(<span class="string">'Content-Type: application/json; charset=utf-8'</span>);

<span class="comment">// Récupérer la requête</span>
<span class="variable">$query</span> = <span class="function">filter_input</span>(<span class="constant">INPUT_GET</span>, <span class="string">'q'</span>, <span class="constant">FILTER_SANITIZE_STRING</span>);

<span class="keyword">if</span> (<span class="function">empty</span>(<span class="variable">$query</span>) || <span class="function">strlen</span>(<span class="variable">$query</span>) < 2) {
    <span class="keyword">echo</span> <span class="function">json_encode</span>([]);
    <span class="keyword">exit</span>;
}

<span class="comment">// Dans un cas réel, vous feriez une requête à votre base de données</span>
<span class="comment">// Par exemple :</span>
<span class="comment">// $pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'utilisateur', 'mot_de_passe');</span>
<span class="comment">// $stmt = $pdo->prepare("SELECT id, nom, description FROM produits WHERE nom LIKE :query LIMIT 10");</span>
<span class="comment">// $stmt->execute(['query' => "%$query%"]);</span>
<span class="comment">// $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);</span>

<span class="comment">// Pour cet exemple, nous utilisons un tableau statique</span>
<span class="variable">$produits</span> = [
    [<span class="string">"id"</span> => 1, <span class="string">"nom"</span> => <span class="string">"Smartphone XYZ"</span>, <span class="string">"description"</span> => <span class="string">"Un smartphone puissant avec appareil photo 48MP"</span>],
    [<span class="string">"id"</span> => 2, <span class="string">"nom"</span> => <span class="string">"Ordinateur portable ABC"</span>, <span class="string">"description"</span> => <span class="string">"Ultrabook léger avec 16GB de RAM"</span>],
    [<span class="string">"id"</span> => 3, <span class="string">"nom"</span> => <span class="string">"Tablette Pro"</span>, <span class="string">"description"</span> => <span class="string">"Tablette professionnelle avec écran 12 pouces"</span>],
    [<span class="string">"id"</span> => 4, <span class="string">"nom"</span> => <span class="string">"Montre connectée"</span>, <span class="string">"description"</span> => <span class="string">"Montre intelligente avec suivi d'activité"</span>],
    [<span class="string">"id"</span> => 5, <span class="string">"nom"</span> => <span class="string">"Casque sans fil"</span>, <span class="string">"description"</span> => <span class="string">"Casque Bluetooth avec réduction de bruit"</span>]
];

<span class="comment">// Filtrer les résultats en fonction de la requête</span>
<span class="variable">$resultats</span> = [];
<span class="keyword">foreach</span> (<span class="variable">$produits</span> <span class="keyword">as</span> <span class="variable">$produit</span>) {
    <span class="keyword">if</span> (<span class="function">stripos</span>(<span class="variable">$produit</span>[<span class="string">'nom'</span>], <span class="variable">$query</span>) !== <span class="keyword">false</span> || 
        <span class="function">stripos</span>(<span class="variable">$produit</span>[<span class="string">'description'</span>], <span class="variable">$query</span>) !== <span class="keyword">false</span>) {
        <span class="variable">$resultats</span>[] = <span class="variable">$produit</span>;
    }
}

<span class="comment">// Renvoyer les résultats en JSON</span>
<span class="keyword">echo</span> <span class="function">json_encode</span>(<span class="variable">$resultats</span>);
</code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Bonnes pratiques pour PHP et AJAX</h2>

            <h3>Principes fondamentaux</h3>
            <ul>
                <li><strong>Sécurité :</strong> Validez toujours les données reçues côté serveur, même si une validation est faite côté client.</li>
                <li><strong>Performance :</strong> Utilisez des techniques comme le "throttling" ou le "debouncing" pour limiter le nombre de requêtes AJAX.</li>
                <li><strong>Expérience utilisateur :</strong> Fournissez des indicateurs visuels pendant le chargement des données (loaders, spinners, etc.).</li>
                <li><strong>Gestion des erreurs :</strong> Traitez correctement les erreurs côté client et côté serveur, et informez l'utilisateur de façon appropriée.</li>
                <li><strong>Accessibilité :</strong> Assurez-vous que votre site reste accessible même si JavaScript est désactivé.</li>
                <li><strong>Caching :</strong> Utilisez le cache du navigateur pour réduire le nombre de requêtes pour les données statiques.</li>
                <li><strong>Structure du code :</strong> Séparez clairement la logique AJAX du reste de votre code JavaScript.</li>
            </ul>

            <h3>Organisation du code côté serveur</h3>
            <p>Une architecture bien conçue pour vos points d'entrée AJAX améliore la maintenabilité et la sécurité :</p>

            <div class="example">
                <div class="example-header">Structure de projet AJAX-PHP recommandée</div>
                <div class="example-content">
                    <pre><code class="language-text">
project/
├── api/                  # Points d'entrée AJAX
│   ├── index.php         # Routeur principal
│   ├── users.php         # Endpoints pour les utilisateurs
│   ├── products.php      # Endpoints pour les produits
│   └── auth.php          # Authentification
├── includes/             # Fichiers partagés
│   ├── config.php        # Configuration
│   ├── database.php      # Connexion à la BDD
│   ├── validation.php    # Fonctions de validation
│   └── response.php      # Formatage des réponses
├── models/               # Classes métier
├── public/               # Assets publics
│   ├── js/
│   │   ├── ajax.js       # Fonctions AJAX réutilisables
│   │   └── app.js        # Application principale
│   └── css/
└── index.php             # Point d'entrée principal
</code></pre>
                </div>
            </div>

            <h3>Classe d'utilitaire pour les réponses AJAX</h3>
            <p>Standardisez vos réponses AJAX avec une classe d'utilitaire :</p>

            <div class="example">
                <div class="example-header">Classe ApiResponse pour standardiser les réponses</div>
                <div class="example-content">
                    <pre><code class="language-php">
<span class="comment">// includes/response.php</span>
<span class="class-name">class</span> <span class="class">ApiResponse</span> {
    <span class="comment">/**
     * Envoie une réponse JSON formatée
     *
     * @param mixed $data Les données à renvoyer
     * @param bool $success Statut de la réponse
     * @param string $message Message explicatif
     * @param int $status_code Code HTTP
     * @return void
     */</span>
    <span class="function">public static function</span> <span class="function">json</span>(<span class="variable">$data</span> = <span class="keyword">null</span>, <span class="variable">$success</span> = <span class="keyword">true</span>, <span class="variable">$message</span> = <span class="string">''</span>, <span class="variable">$status_code</span> = <span class="number">200</span>) {
        <span class="keyword">header</span>(<span class="string">'Content-Type: application/json; charset=utf-8'</span>);
        <span class="keyword">http_response_code</span>(<span class="variable">$status_code</span>);
        
        <span class="variable">$response</span> = [
            <span class="string">'success'</span> => <span class="variable">$success</span>,
            <span class="string">'message'</span> => <span class="variable">$message</span>,
        ];
        
        <span class="keyword">if</span> (<span class="variable">$data</span> !== <span class="keyword">null</span>) {
            <span class="variable">$response</span>[<span class="string>'data'</span>] = <span class="variable">$data</span>;
        }
        
        <span class="keyword">echo</span> <span class="function">json_encode</span>(<span class="variable">$response</span>, <span class="constant">JSON_PRETTY_PRINT</span> | <span class="constant">JSON_UNESCAPED_UNICODE</span>);
        <span class="keyword">exit</span>;
    }
    
    <span class="comment">/**
     * Envoie une réponse réussie
     */</span>
    <span class="function">public static function</span> <span class="function">success</span>(<span class="variable">$data</span> = <span class="keyword">null</span>, <span class="variable">$message</span> = <span class="string">'Opération réussie'</span>, <span class="variable">$status_code</span> = <span class="number">200</span>) {
        <span class="function">self::json</span>(<span class="variable">$data</span>, <span class="keyword">true</span>, <span class="variable">$message</span>, <span class="variable">$status_code</span>);
    }
    
    <span class="comment">/**
     * Envoie une réponse d'erreur
     */</span>
    <span class="function">public static function</span> <span class="function">error</span>(<span class="variable">$message</span> = <span class="string">'Une erreur est survenue'</span>, <span class="variable">$status_code</span> = <span class="number">400</span>, <span class="variable">$data</span> = <span class="keyword">null</span>) {
        <span class="function">self::json</span>(<span class="variable">$data</span>, <span class="keyword">false</span>, <span class="variable">$message</span>, <span class="variable">$status_code</span>);
    }
    
    <span class="comment">/**
     * Erreur de validation
     */</span>
    <span class="function">public static function</span> <span class="function">validation</span>(<span class="variable">$errors</span>, <span class="variable">$message</span> = <span class="string">'Erreur de validation'</span>) {
        <span class="function">self::error</span>(<span class="variable">$message</span>, <span class="number">422</span>, [<span class="string>'errors'</span> => <span class="variable">$errors</span>]);
    }
}
</code></pre>
                </div>
            </div>

            <h3>Conseils avancés</h3>
            <ul>
                <li><strong>Centralisation des requêtes AJAX</strong> : Créez une classe ou un module JavaScript pour gérer toutes vos requêtes AJAX.</li>
                <li><strong>Utilisez des tokens JWT</strong> pour l'authentification des API sécurisées.</li>
                <li><strong>Compression GZIP</strong> pour réduire la taille des données transférées.</li>
                <li><strong>Assurez-vous d'inclure les en-têtes CORS</strong> pour permettre les requêtes cross-origin si nécessaire.</li>
                <li><strong>Versionnez vos API</strong> : Utilisez des préfixes comme "/api/v1/" pour pouvoir faire évoluer votre API sans casser la compatibilité.</li>
            </ul>

            <h3>Pièges à éviter</h3>
            <ol>
                <li><strong>Ne pas gérer les erreurs</strong> : Assurez-vous de toujours avoir du code pour gérer les erreurs côté client.</li>
                <li><strong>Trop de requêtes</strong> : Évitez les requêtes trop fréquentes qui surchargent le serveur.</li>
                <li><strong>Requêtes bloquantes</strong> : Évitez de bloquer l'interface utilisateur pendant les requêtes AJAX.</li>
                <li><strong>Ne pas informer l'utilisateur</strong> : Indiquez toujours à l'utilisateur qu'une action est en cours.</li>
                <li><strong>Oublier la validation côté serveur</strong> : Ne faites jamais confiance aux données envoyées par le client.</li>
            </ol>

            <div class="info-box">
                <p><strong>Ressources supplémentaires :</strong></p>
                <ul>
                    <li><a href="https://developer.mozilla.org/fr/docs/Web/API/Fetch_API" target="_blank">MDN Web Docs - API Fetch</a></li>
                    <li><a href="https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest" target="_blank">MDN Web Docs - XMLHttpRequest</a></li>
                    <li><a href="https://www.php.net/manual/fr/book.json.php" target="_blank">Documentation PHP sur JSON</a></li>
                    <li><a href="https://www.php.net/manual/fr/book.curl.php" target="_blank">Documentation PHP sur cURL</a></li>
                    <li><a href="https://www.youtube.com/watch?v=3l13qGLTgNw" target="_blank">Tutoriel vidéo : Applications web dynamiques avec AJAX et PHP</a></li>
                    <li><a href="https://github.com/axios/axios" target="_blank">Axios - Bibliothèque JavaScript pour les requêtes HTTP</a></li>
                </ul>
            </div>
        </section>
        <div class="navigation">
            <a href="12-bases-de-donnees.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="14-securite.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>