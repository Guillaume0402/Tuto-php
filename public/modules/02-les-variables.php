<?php include __DIR__ . '/../includes/header.php';

// chaine de caractères
$titre = "Les Variables en PHP";
// Concaténation de chaînes 
$description = "Découvrez comment déclarer, initialiser et manipuler différents types de variables en PHP.";

// entier
$nombre = 42;

// flottant
$prix = 19.99;

// booléen
$estActif = true;

// constante
define("PI", 3.14);

// Tableaux
$fruits = ["Pomme", "Banane", "Orange"];
$utilisateur = [
    "nom" => "Dupont",
    "prenom" => "Jean",
    "age" => 35
];


// Variable dynamique
$nomVariable = "prix";
$$nomVariable = 29.99; // $prix vaut maintenant 29.99
?>


<body class="module2">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?> </p>
    </header>

    <div class="navigation" style="margin-bottom: 20px;">
        <a href="01-script.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="03-les-conditions.php" class="nav-button">Module suivant →</a>
    </div>

    <main>
        <section class="section">
            <h2>Qu'est-ce qu'une variable en PHP ?</h2>
            <p>Une variable en PHP est un conteneur qui stocke des informations. Son contenu peut être modifié au cours de l'exécution du script. En PHP, les variables sont préfixées par un signe dollar ($) et sont sensibles à la casse.</p>

            <div class="example">
                <div class="example-header">Syntaxe de base</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$nomVariable</span> <span class="operator">=</span> <span class="keyword">valeur</span><span class="punct">;</span></code></pre>
                    <div class="result">
                        <p>Le nom d'une variable doit commencer par une lettre ou un underscore, suivi de lettres, chiffres ou underscores.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Les types de variables en PHP</h2>

            <div class="variable-types">
                <div class="variable-type">
                    <h3>Chaîne de caractères (String)</h3>
                    <pre><code class="language-php"><span class="variable">$prenom</span> <span class="operator">=</span> <span class="string">"Marie"</span><span class="punct">;</span>
<span class="variable">$nom</span> <span class="operator">=</span> <span class="string">'Dupont'</span><span class="punct">;</span>
<span class="variable">$presentation</span> <span class="operator">=</span> <span class="string">"Je m'appelle $prenom $nom"</span><span class="punct">;</span></code></pre>
                    <div class="result">
                        <p>Les guillemets doubles permettent d'interpréter les variables à l'intérieur.</p>
                        <p>Résultat : Je m'appelle Marie Dupont</p>
                    </div>
                </div>

                <div class="variable-type">
                    <h3>Nombres entiers (Integer)</h3>
                    <pre><code class="language-php"><span class="variable">$age</span> <span class="operator">=</span> <span class="number">25</span><span class="punct">;</span>
<span class="variable">$temperature</span> <span class="operator">=</span> <span class="number">-10</span><span class="punct">;</span>
<span class="variable">$code</span> <span class="operator">=</span> <span class="number">0x1A</span><span class="punct">;</span> <span class="comment">// hexadécimal</span></code></pre>
                    <div class="result">
                        <p>Résultat : <?php echo $nombre; ?></p>
                    </div>
                </div>
            </div>

            <div class="variable-types">
                <div class="variable-type">
                    <h3>Nombres à virgule flottante (Float)</h3>
                    <pre><code class="language-php"><span class="variable">$prix</span> <span class="operator">=</span> <span class="number">19.99</span><span class="punct">;</span>
<span class="variable">$proportion</span> <span class="operator">=</span> <span class="number">0.75</span><span class="punct">;</span>
<span class="variable">$scientifique</span> <span class="operator">=</span> <span class="number">2.5e3</span><span class="punct">;</span> <span class="comment">// 2500</span></code></pre>
                    <div class="result">
                        <p>Résultat : <?php echo $prix; ?></p>
                    </div>
                </div>

                <div class="variable-type">
                    <h3>Booléens (Boolean)</h3>
                    <pre><code class="language-php"><span class="variable">$estVrai</span> <span class="operator">=</span> <span class="keyword">true</span><span class="punct">;</span>
<span class="variable">$estFaux</span> <span class="operator">=</span> <span class="keyword">false</span><span class="punct">;</span>
<span class="variable">$resultat</span> <span class="operator">=</span> (<span class="variable">$age</span> <span class="operator">></span> <span class="number">18</span>); <span class="comment">// true si $age > 18</span></code></pre>
                    <div class="result">
                        <p>Résultat : <?php echo $estActif ? 'true' : 'false'; ?></p>
                    </div>
                </div>
            </div>

            <div class="variable-types">
                <div class="variable-type">
                    <h3>Tableaux (Array)</h3>
                    <pre><code class="language-php"><span class="comment">// Tableau indexé</span>
<span class="variable">$fruits</span> <span class="operator">=</span> <span class="punct">[</span><span class="string">"Pomme"</span>, <span class="string">"Banane"</span>, <span class="string">"Orange"</span><span class="punct">]</span><span class="punct">;</span>

<span class="comment">// Tableau associatif</span>
<span class="variable">$personne</span> <span class="operator">=</span> <span class="punct">[</span>
    <span class="string">"nom"</span> <span class="operator">=></span> <span class="string">"Dupont"</span>,
    <span class="string">"prenom"</span> <span class="operator">=></span> <span class="string">"Jean"</span>,
    <span class="string">"age"</span> <span class="operator">=></span> <span class="number">35</span>
<span class="punct">]</span><span class="punct">;</span></code></pre>
                    <div class="result">
                        <p>Premier fruit : <?php echo $fruits[0]; ?></p>
                        <p>Nom de la personne : <?php echo $utilisateur['nom']; ?></p>
                    </div>
                </div>

                <div class="variable-type">
                    <h3>NULL</h3>
                    <pre><code class="language-php"><span class="variable">$variable</span> <span class="operator">=</span> <span class="keyword">NULL</span><span class="punct">;</span> <span class="comment">// Variable sans valeur</span>
<span class="variable">$nonDeclare</span><span class="punct">;</span> <span class="comment">// Non initialisée = NULL</span></code></pre>
                    <div class="result">
                        <p>Une variable NULL ne contient aucune valeur.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Les constantes</h2>
            <p>Contrairement aux variables, les constantes ne peuvent pas être modifiées après leur initialisation et ne sont pas préfixées par $.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Définir une constante</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="function">define</span>(<span class="string">"PI"</span>, <span class="number">3.14</span>);
<span class="function">define</span>(<span class="string">"SITE_URL"</span>, <span class="string">"https://example.com"</span>);
<span class="function">define</span>(<span class="string">"DEBUG"</span>, <span class="keyword">true</span>);</code></pre>
                        <div class="result">
                            <p>Valeur de PI : <?php echo PI; ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Constantes prédéfinies</div>
                    <div class="example-content">
                        <pre><code>echo PHP_VERSION; // Version de PHP
echo __FILE__; // Chemin complet du fichier
echo __DIR__; // Répertoire du fichier</code></pre>
                        <div class="result">
                            <p>Version de PHP : <?php echo PHP_VERSION; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Manipulation des variables</h2>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Vérification de variables</div>
                    <div class="example-content">
                        <pre><code class="language-php">// Vérifier si une variable existe
isset($variable);

// Vérifier si une variable est vide
empty($variable);</code></pre>
                        <div class="result">
                            <p>isset($titre) : <?php echo var_export(isset($titre), true); ?></p>
                            <p>empty($titre) : <?php echo var_export(empty($titre), true); ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Affichage et débogage</div>
                    <div class="example-content">
                        <pre><code class="language-php">// Afficher le type et la valeur
var_dump($variable);

// Information sur la variable
print_r($variable);</code></pre>
                        <div class="result">
                            <p>var_dump($nombre) : <?php var_dump($nombre); ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Variables dynamiques</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$nomVariable</span> <span class="operator">=</span> <span class="string">"prix"</span><span class="punct">;</span>
$$nomVariable <span class="operator">=</span> <span class="number">29.99</span><span class="punct">;</span> 
// Crée une variable $prix avec valeur 29.99</code></pre>
                        <div class="result">
                            <p>Valeur de $prix : <?php echo $prix; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Conversion de types</h2>
            <p>PHP permet de convertir des variables d'un type à un autre.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Conversion explicite (cast)</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$texte</span> <span class="operator">=</span> <span class="string">"42"</span><span class="punct">;</span>
<span class="variable">$nombre</span> <span class="operator">=</span> <span class="keyword">(int)</span> <span class="variable">$texte</span>; // Conversion en entier

<span class="variable">$prix</span> <span class="operator">=</span> <span class="number">19.99</span><span class="punct">;</span>
<span class="variable">$prixArrondi</span> <span class="operator">=</span> <span class="keyword">(int)</span> <span class="variable">$prix</span>; // 19</code></pre>
                        <div class="result">
                            <p>Conversion "42" en nombre : <?php echo (int)"42"; ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Fonctions de conversion</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$nombre</span> <span class="operator">=</span> <span class="function">intval</span>(<span class="string">"42"</span><span class="punct">)</span><span class="punct">;</span>
<span class="variable">$decimal</span> <span class="operator">=</span> <span class="function">floatval</span>(<span class="string">"3.14"</span><span class="punct">)</span><span class="punct">;</span>
<span class="variable">$texte</span> <span class="operator">=</span> <span class="function">strval</span>(<span class="number">42</span><span class="punct">)</span><span class="punct">;</span></code></pre>
                        <div class="result">
                            <p>intval("42") : <?php echo intval("42"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <h2>Portée des variables</h2>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Variables locales</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">function</span> <span class="function">test</span>() {
    <span class="variable">$local</span> <span class="operator">=</span> <span class="number">10</span><span class="punct">;</span>
    <span class="keyword">echo</span> <span class="variable">$local</span><span class="punct">;</span> <span class="comment">// Accessible ici</span>
}
<span class="comment">// echo $local; // Erreur : pas accessible ici</span></code></pre>
                        <div class="result">
                            <p>Variables déclarées dans une fonction, accessibles uniquement à l'intérieur de celle-ci</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Variables globales</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$global</span> <span class="operator">=</span> <span class="number">20</span><span class="punct">;</span>

<span class="keyword">function</span> <span class="function">accessGlobal</span>() {
    <span class="keyword">global</span> <span class="variable">$global</span><span class="punct">;</span>
    <span class="keyword">echo</span> <span class="variable">$global</span><span class="punct">;</span> <span class="comment">// Accessible avec 'global'</span>
}</code></pre>
                        <div class="result">
                            <p>Déclarées en dehors des fonctions, accessibles partout avec le mot-clé <code>global</code></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Variables statiques</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">function</span> <span class="function">compteur</span>() {
    <span class="keyword">static</span> <span class="variable">$c</span> <span class="operator">=</span> <span class="number">0</span><span class="punct">;</span>
    <span class="keyword">return</span> <span class="operator">++</span><span class="variable">$c</span><span class="punct">;</span>
}

<span class="keyword">echo</span> <span class="function">compteur</span>()<span class="punct">;</span> <span class="comment">// 1</span>
<span class="keyword">echo</span> <span class="function">compteur</span>()<span class="punct">;</span> <span class="comment">// 2</span>
<span class="keyword">echo</span> <span class="function">compteur</span>()<span class="punct">;</span> <span class="comment">// 3</span></code></pre>
                        <div class="result">
                            <p>Conservent leur valeur entre les appels de fonction</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Paramètres de fonction</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">function</span> <span class="function">addition</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
    <span class="keyword">return</span> <span class="variable">$a</span> <span class="operator">+</span> <span class="variable">$b</span><span class="punct">;</span>
}

<span class="variable">$resultat</span> <span class="operator">=</span> <span class="function">addition</span>(<span class="number">5</span>, <span class="number">3</span>)<span class="punct">;</span> <span class="comment">// 8</span></code></pre>
                        <div class="result">
                            <p>Variables passées à une fonction comme arguments</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="navigation">
            <a href="01-script.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="03-les-conditions.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>