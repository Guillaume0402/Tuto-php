<?php
$moduleClass = 'module5';
include __DIR__ . '/../includes/header.php';

// Variables de page
$titre = "Les Fonctions en PHP";
$description = "Apprenez à créer et utiliser des fonctions pour organiser votre code et le rendre plus modulaire, réutilisable et maintenable";

/**
 * Exemple de fonction simple avec documentation
 * 
 * @param string $prenom Le prénom de la personne à saluer
 * @return string Le message de bienvenue
 */
function direBonjour($prenom)
{
    return "Bonjour $prenom et bienvenue sur mon site!";
}

function addition($a, $b)
{
    $resultat = $a + $b;
    return $resultat;
}

// Fonction avec valeur par défaut
function saluer($nom, $formule = "Bonjour")
{
    return "$formule $nom !";
}

// Fonction avec nombre variable d'arguments
function somme(...$nombres)
{
    return array_sum($nombres);
}

// Fonction avec passage par référence
function incrementer(&$valeur, $increment = 1)
{
    $valeur += $increment;
}

// Fonction anonyme
$calculerCarre = function ($nombre) {
    return $nombre * $nombre;
};

// Fonction récursive
function factorielle($n)
{
    if ($n <= 1) return 1;
    return $n * factorielle($n - 1);
}

// Fonction fléchée (PHP 7.4+)
$multiplier = fn($a, $b) => $a * $b;

?>

<div class="module-header">
    <h1><?= $titre ?></h1>
    <p class="subtitle"><?= $description ?></p>
</div>
<div class="navigation">
    <a href="<?= BASE_URL ?>/modules/04-les-boucles.php" class="nav-button">← Module précédent</a>
    <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
    <a href="<?= BASE_URL ?>/modules/06-les-tableaux.php" class="nav-button">Module suivant →</a>
</div>
<main>
    <section class="section">
        <h2>Introduction aux fonctions</h2>
        <p>Les fonctions sont des blocs de code réutilisables qui permettent d'organiser et de structurer votre code. Elles constituent un élément fondamental de la programmation modulaire et sont essentielles pour créer des applications PHP bien conçues.</p>

        <p>Une fonction en PHP peut être définie comme un ensemble d'instructions regroupées sous un nom unique, pouvant accepter des données (paramètres), traiter ces données et renvoyer un résultat.</p>

        <div class="info-box">
            <strong>Avantages des fonctions :</strong>
            <ul>
                <li><strong>Réutilisabilité du code</strong> : Écrivez une fois, utilisez partout dans votre application</li>
                <li><strong>Meilleure organisation</strong> : Structurez votre code en blocs logiques et cohérents</li>
                <li><strong>Lisibilité améliorée</strong> : Des noms de fonctions bien choisis expliquent ce que fait le code</li>
                <li><strong>Maintenance simplifiée</strong> : Modifiez le comportement d'une fonctionnalité à un seul endroit</li>
                <li><strong>Facilité de débogage</strong> : Isolez et testez des portions spécifiques de code</li>
                <li><strong>Encapsulation</strong> : Masquez la complexité du code derrière des interfaces simples</li>
                <li><strong>Réduction de la duplication</strong> : Évitez de répéter le même code à plusieurs endroits</li>
            </ul>
        </div>

        <div class="note-box">
            <strong>À retenir :</strong> En PHP, les fonctions doivent être définies avant d'être appelées, sauf si elles sont définies dans un fichier inclus ou dans une classe.
        </div>
    </section>
    <section class="section">
        <h2>Fonctions de base</h2>
        <p>Une fonction se compose généralement d'un nom, de paramètres (facultatifs) et d'un corps contenant les instructions à exécuter. En PHP, les noms de fonctions ne sont pas sensibles à la casse, mais il est recommandé de les utiliser de manière cohérente.</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header basic-header">Déclaration d'une fonction</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">nomDeLaFonction</span>($parametre1, $parametre2) {
    <span class="comment">// Instructions à exécuter</span>
    <span class="variable">$resultat</span> = <span class="comment">/* traitement des paramètres */</span>;
    <span class="keyword">return</span> <span class="variable">$resultat</span><span class="punct">;</span>
}</code></pre>
                    <p>Les éléments de base d'une fonction :</p>
                    <ul>
                        <li>Mot-clé <code>function</code> pour déclarer une fonction</li>
                        <li>Nom de la fonction (doit commencer par une lettre ou un underscore)</li>
                        <li>Paramètres entre parenthèses (séparés par des virgules)</li>
                        <li>Corps de la fonction entre accolades</li>
                        <li>Instruction de retour (facultative) avec <code>return</code></li>
                    </ul>
                </div>
            </div>
            <div class="example">
                <div class="example-header basic-header">Fonction avec retour</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">addition</span>($a, $b) {
    <span class="variable">$resultat</span> <span class="operator">=</span> $a <span class="operator">+</span> $b<span class="punct">;</span>
    <span class="keyword">return</span> <span class="variable">$resultat</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appel de la fonction :</p>
                        <code>$somme = addition(5, 10);<br>
                            echo "Le résultat est : " . $somme;</code>
                        <p>Résultat : <strong><?= addition(5, 10) ?></strong></p>
                    </div>
                    <div class="tip-box">
                        <strong>Avantage :</strong> Les fonctions avec retour permettent de traiter le résultat (le stocker dans une variable, le combiner avec d'autres valeurs, etc.) avant de l'afficher.
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header basic-header">Fonction avec plusieurs instructions</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">calculerSurfaceRectangle</span>($longueur, $largeur) {
    <span class="comment">// Vérification des valeurs</span>
    <span class="keyword">if</span> ($longueur <= 0 || $largeur <= 0) {
        <span class="keyword">return</span> <span class="string">"Dimensions invalides"</span><span class="punct">;</span>
    }
    
    <span class="comment">// Calcul de la surface</span>
    <span class="variable">$surface</span> = $longueur * $largeur<span class="punct">;</span>
    
    <span class="comment">// Retourne le résultat</span>
    <span class="keyword">return</span> <span class="variable">$surface</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appel de la fonction :</p>
                        <code>echo calculerSurfaceRectangle(5, 3);</code>
                        <p>Résultat :
                            <?php
                            function calculerSurfaceRectangle($longueur, $largeur)
                            {
                                if ($longueur <= 0 || $largeur <= 0) {
                                    return "Dimensions invalides";
                                }
                                $surface = $longueur * $largeur;
                                return $surface;
                            }
                            echo calculerSurfaceRectangle(5, 3);
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header basic-header">Fonction sans retour (affichage direct)</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">afficherMessage</span>($prenom) {
    <span class="keyword">echo</span> <span class="string">"<p>Bonjour $prenom et bienvenue sur mon site!</p>"</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appel de la fonction :</p>
                        <code>afficherMessage("Marie");</code>
                        <div class="output">
                            <?php
                            function afficherMessage($prenom)
                            {
                                echo "<p>Bonjour $prenom et bienvenue sur mon site!</p>";
                            }
                            afficherMessage("Marie");
                            ?>
                        </div>
                        <div class="note-box">
                            <strong>Remarque :</strong> Les fonctions qui utilisent <code>echo</code> directement sont utiles pour l'affichage,
                            mais moins flexibles que celles qui retournent une valeur. Il est souvent préférable de
                            retourner une valeur plutôt que de l'afficher directement.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <h2>Paramètres de fonctions</h2>
        <p>Les fonctions PHP offrent différentes façons de gérer les paramètres pour plus de flexibilité. La manière dont vous définissez et utilisez les paramètres peut grandement influencer la réutilisabilité et la robustesse de vos fonctions.</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header advanced-header">Paramètres obligatoires et optionnels</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">saluer</span>($nom, $formule <span class="operator">=</span> <span class="string">"Bonjour"</span>) {
    <span class="keyword">return</span> <span class="string">"$formule $nom !"</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appels de la fonction :</p>
                        <code>echo saluer("Jean");</code>
                        <p>Résultat : <strong><?= saluer("Jean") ?></strong></p>
                        <code>echo saluer("Marie", "Bonsoir");</code>
                        <p>Résultat : <strong><?= saluer("Marie", "Bonsoir") ?></strong></p>
                    </div>
                    <div class="info-box">
                        <strong>Points importants :</strong>
                        <ul>
                            <li>Les paramètres obligatoires viennent d'abord, suivis des paramètres optionnels</li>
                            <li>Les paramètres optionnels ont une valeur par défaut assignée</li>
                            <li>Vous pouvez définir plusieurs paramètres optionnels</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header advanced-header">Nombre variable d'arguments (PHP 5.6+)</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">somme</span>(<span class="operator">...</span><span class="variable">$nombres</span>) {
    <span class="keyword">return</span> <span class="function">array_sum</span>(<span class="variable">$nombres</span>)<span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appels de la fonction :</p>
                        <code>echo somme(1, 2, 3);</code>
                        <p>Résultat : <strong><?= somme(1, 2, 3) ?></strong></p>
                        <code>echo somme(10, 20, 30, 40);</code>
                        <p>Résultat : <strong><?= somme(10, 20, 30, 40) ?></strong></p>
                    </div>
                    <div class="info-box">
                        <strong>Comment ça marche :</strong> L'opérateur <code>...</code> (spread) collecte tous les arguments passés à la fonction dans un tableau. Vous pouvez aussi combiner des paramètres normaux avec des arguments variables :
                        <pre><code class="language-php"><span class="keyword">function</span> <span class="function">calculerTotal</span>($taxe, ...$prix) {
    <span class="variable">$somme</span> = <span class="function">array_sum</span>($prix);
    <span class="keyword">return</span> <span class="variable">$somme</span> * (1 + $taxe/100);
}</code></pre>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header reference-header">Passage par référence</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">incrementer</span>(<span class="operator">&</span><span class="variable">$valeur</span>, <span class="variable">$increment</span> <span class="operator">=</span> <span class="number">1</span>) {
    <span class="variable">$valeur</span> <span class="operator">+=</span> <span class="variable">$increment</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appel de la fonction :</p>
                        <code>$nombre = 5;
                            incrementer($nombre);
                            echo $nombre;</code>
                        <p>Résultat : <strong>
                                <?php
                                $nombre = 5;
                                incrementer($nombre);
                                echo $nombre;
                                ?>
                            </strong></p>
                    </div>
                    <p>La variable <code>$nombre</code> a été modifiée directement par la fonction, sans utiliser de valeur de retour.</p>
                </div>
            </div>

            <div class="example">
                <div class="example-header advanced-header">Typage des paramètres (PHP 7+)</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">calculerAire</span>(<span class="type">float</span> $longueur, <span class="type">float</span> $largeur): <span class="type">float</span> {
    <span class="keyword">return</span> $longueur * $largeur;
}</code></pre>
                    <div class="result">
                        <p>Appel de la fonction :</p>
                        <code>echo calculerAire(3.5, 2);</code>
                        <p>Résultat :
                            <?php
                            function calculerAire(float $longueur, float $largeur): float
                            {
                                return $longueur * $largeur;
                            }
                            echo calculerAire(3.5, 2);
                            ?>
                        </p>
                    </div>
                    <div class="info-box">
                        <strong>Types disponibles :</strong>
                        <code>int</code>, <code>float</code>, <code>string</code>, <code>bool</code>, <code>array</code>,
                        <code>object</code>, <code>callable</code>, <code>iterable</code> (PHP 7.1+),
                        <code>mixed</code> (PHP 8+), noms de classes et interfaces
                    </div>
                </div>
            </div>
        </div>

        <div class="warning-box">
            <strong>Attention au passage par référence !</strong>
            <ul>
                <li>Modifie directement la variable originale, ce qui peut causer des effets secondaires inattendus</li>
                <li>Utilisation recommandée : quand vous devez modifier plusieurs valeurs et qu'un retour multiple n'est pas pratique</li>
                <li>Documentez toujours clairement le comportement de ces fonctions</li>
                <li>En PHP moderne, préférez parfois retourner une nouvelle valeur plutôt que de modifier par référence</li>
            </ul>
        </div>
    </section>
    <section class="section">
        <h2>Types de fonctions avancés</h2>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header recursive-header">Fonctions récursives</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">factorielle</span>(<span class="variable">$n</span>) {
    <span class="comment">// Cas de base</span>
    <span class="keyword">if</span> (<span class="variable">$n</span> <= 1) <span class="keyword">return</span> <span class="number">1</span><span class="punct">;</span>
    
    <span class="comment">// Appel récursif</span>
    <span class="keyword">return</span> <span class="variable">$n</span> * <span class="function">factorielle</span>(<span class="variable">$n</span> - 1)<span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appel de la fonction :</p>
                        <code>echo "5! = " . factorielle(5);</code>
                        <p>Résultat : <strong>5! = <?= factorielle(5) ?></strong></p>
                    </div>

                    <div class="info-box">
                        <strong>Concepts clés de la récursion :</strong>
                        <ul>
                            <li><strong>Cas de base</strong> : Condition qui arrête la récursion (pour éviter une boucle infinie)</li>
                            <li><strong>Appel récursif</strong> : La fonction s'appelle elle-même avec un état modifié</li>
                            <li><strong>Décomposition du problème</strong> : Résoudre un problème en le réduisant à des sous-problèmes plus simples</li>
                        </ul>
                    </div>

                    <div class="example-subsection">
                        <h4>Exemple visuel de factorielle(5):</h4>
                        <pre class="recursion-tree">
factorielle(5)
└── 5 * factorielle(4) = 5 * 24 = 120
    └── 4 * factorielle(3) = 4 * 6 = 24
        └── 3 * factorielle(2) = 3 * 2 = 6
            └── 2 * factorielle(1) = 2 * 1 = 2
                └── factorielle(1) = 1 (cas de base)
                        </pre>
                    </div>

                    <div class="warning-box">
                        <strong>Attention à la profondeur de récursion !</strong> PHP limite le nombre d'appels de fonction imbriqués. Utilisez des approches itératives pour les calculs avec de grandes valeurs.
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header advanced-header">Fonctions anonymes</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$calculerCarre</span> <span class="operator">=</span> <span class="keyword">function</span>(<span class="variable">$nombre</span>) {
    <span class="keyword">return</span> <span class="variable">$nombre</span> <span class="operator">*</span> <span class="variable">$nombre</span><span class="punct">;</span>
}<span class="punct">;</span>

<span class="comment">// Utilisation comme fonction de tri</span>
<span class="variable">$fruits</span> = [<span class="string">'pomme'</span>, <span class="string">'banane'</span>, <span class="string>'kiwi'</span>, <span class="string">'fraise'</span>];
<span class="function">usort</span>(<span class="variable">$fruits</span>, <span class="keyword">function</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
    <span class="keyword">return</span> <span class="function">strlen</span>(<span class="variable">$a</span>) - <span class="function">strlen</span>(<span class="variable">$b</span>); <span class="comment">// Trie par longueur</span>
});</code></pre>
                    <div class="result">
                        <p>Appel de la fonction :</p>
                        <code>echo $calculerCarre(4);</code>
                        <p>Résultat : <strong><?= $calculerCarre(4) ?></strong></p>

                        <p>Exemple avec usort :</p>
                        <code>
                            $fruits = ['pomme', 'banane', 'kiwi', 'fraise'];
                            usort($fruits, function($a, $b) {
                            return strlen($a) - strlen($b);
                            });
                            print_r($fruits);</code>
                        <pre><?php
                                $fruits = ['pomme', 'banane', 'kiwi', 'fraise'];
                                usort($fruits, function ($a, $b) {
                                    return strlen($a) - strlen($b);
                                });
                                print_r($fruits);
                                ?></pre>
                    </div>

                    <div class="info-box">
                        <strong>Caractéristiques des fonctions anonymes :</strong>
                        <ul>
                            <li>Peuvent être assignées à des variables</li>
                            <li>Idéales comme callbacks pour d'autres fonctions</li>
                            <li>Peuvent "capturer" des variables externes avec le mot-clé <code>use</code></li>
                            <li>Particulièrement utiles pour le tri et le filtrage</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header advanced-header">Fonctions fléchées (PHP 7.4+)</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="comment">// Syntaxe des fonctions fléchées</span>
<span class="variable">$multiplier</span> <span class="operator">=</span> <span class="keyword">fn</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) <span class="operator">=></span> <span class="variable">$a</span> <span class="operator">*</span> <span class="variable">$b</span><span class="punct">;</span>

<span class="comment">// Les variables extérieures sont capturées automatiquement</span>
<span class="variable">$prix</span> = 100;
<span class="variable">$calculerTVA</span> = <span class="keyword">fn</span>(<span class="variable">$taux</span> = 20) <span class="operator">=></span> <span class="variable">$prix</span> * <span class="variable">$taux</span> / 100;

<span class="comment">// Dans un tableau avec array_map</span>
<span class="variable">$nombres</span> = [1, 2, 3, 4, 5];
<span class="variable">$doubles</span> = <span class="function">array_map</span>(<span class="keyword">fn</span>(<span class="variable">$n</span>) <span class="operator">=></span> <span class="variable">$n</span> * 2, <span class="variable">$nombres</span>);</code></pre>
                    <div class="result">
                        <p>Appel simple :</p>
                        <code>echo $multiplier(3, 4);</code>
                        <p>Résultat : <strong><?= $multiplier(3, 4) ?></strong></p>

                        <p>Avec capture de variable :</p>
                        <code>
                            $prix = 100;
                            $calculerTVA = fn($taux = 20) => $prix * $taux / 100;
                            echo "TVA : " . $calculerTVA() . " €";</code>
                        <p>Résultat : <strong>
                                <?php
                                $prix = 100;
                                $calculerTVA = fn($taux = 20) => $prix * $taux / 100;
                                echo "TVA : " . $calculerTVA() . " €";
                                ?>
                            </strong></p>

                        <p>Utilisation avec array_map :</p>
                        <code>
                            $nombres = [1, 2, 3, 4, 5];
                            $doubles = array_map(fn($n) => $n * 2, $nombres);
                            echo implode(", ", $doubles);</code>
                        <p>Résultat : <strong>
                                <?php
                                $nombres = [1, 2, 3, 4, 5];
                                $doubles = array_map(fn($n) => $n * 2, $nombres);
                                echo implode(", ", $doubles);
                                ?>
                            </strong></p>
                    </div>

                    <div class="info-box">
                        <strong>Avantages des fonctions fléchées :</strong>
                        <ul>
                            <li>Syntaxe concise pour les opérations simples</li>
                            <li>Capture automatique des variables extérieures</li>
                            <li>Idéales pour les callbacks courts</li>
                            <li>Un seul énoncé, retour implicite (pas besoin de <code>return</code>)</li>
                            <li>Très expressives avec les fonctions de manipulation de tableaux</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header advanced-header">Callable et Closures</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">executerOperation</span>(<span class="type">callable</span> <span class="variable">$operation</span>, <span class="variable">$a</span>, <span class="variable">$b</span>) {
    <span class="keyword">return</span> <span class="variable">$operation</span>(<span class="variable">$a</span>, <span class="variable">$b</span>);
}

<span class="comment">// Différentes façons d'appeler cette fonction</span>
<span class="keyword">function</span> <span class="function">additionner</span>(<span class="variable">$x</span>, <span class="variable">$y</span>) {
    <span class="keyword">return</span> <span class="variable">$x</span> + <span class="variable">$y</span>;
}

<span class="comment">// 1. Avec le nom d'une fonction</span>
<span class="variable">$resultat1</span> = <span class="function">executerOperation</span>(<span class="string">'additionner'</span>, 5, 3);

<span class="comment">// 2. Avec une fonction anonyme</span>
<span class="variable">$resultat2</span> = <span class="function">executerOperation</span>(<span class="keyword">function</span>(<span class="variable">$x</span>, <span class="variable">$y</span>) {
    <span class="keyword">return</span> <span class="variable">$x</span> * <span class="variable">$y</span>;
}, 5, 3);

<span class="comment">// 3. Avec une méthode d'objet</span>
<span class="variable">$calculateur</span> = <span class="keyword">new</span> <span class="class">Calculateur</span>();
<span class="variable">$resultat3</span> = <span class="function">executerOperation</span>([$calculateur, <span class="string">'soustraire'</span>], 5, 3);</code></pre>
                    <p>Le type <code>callable</code> permet d'accepter différentes formes de fonctions comme paramètre, ce qui rend votre code extrêmement flexible. C'est la base de nombreux design patterns en PHP.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <h2>Portée des variables</h2>
        <p>La portée (scope) d'une variable détermine où celle-ci est accessible dans votre code. Comprendre ce concept est essentiel pour éviter les conflits de noms et les bugs liés aux variables.</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header basic-header">Variables locales</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">maFonction</span>() {
    <span class="variable">$variableLocale</span> <span class="operator">=</span> <span class="string">"Je suis locale"</span><span class="punct">;</span>
    <span class="keyword">echo</span> <span class="variable">$variableLocale</span><span class="punct">;</span>  <span class="comment">// Fonctionne</span>
}

<span class="keyword">maFonction</span>();
<span class="keyword">echo</span> <span class="variable">$variableLocale</span><span class="punct">;</span>  <span class="comment">// Erreur ! $variableLocale n'existe pas ici</span></code></pre>
                    <div class="result">
                        <p>Explication :</p>
                        <p>La variable <code>$variableLocale</code> est créée à l'intérieur de la fonction et n'existe que pendant son exécution. Elle est détruite une fois la fonction terminée.</p>

                        <div class="info-box">
                            <strong>Point clé :</strong> Les variables locales :
                            <ul>
                                <li>Sont créées à chaque appel de fonction</li>
                                <li>Ne sont pas accessibles en dehors de la fonction</li>
                                <li>Sont détruites à la fin de l'exécution de la fonction</li>
                                <li>Permettent d'éviter les conflits de noms entre fonctions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header basic-header">Variables globales</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$variableGlobale</span> <span class="operator">=</span> <span class="string">"Je suis globale"</span><span class="punct">;</span>

<span class="keyword">function</span> <span class="function">accederGlobale</span>() {
    <span class="keyword">global</span> <span class="variable">$variableGlobale</span><span class="punct">;</span> <span class="comment">// Déclaration d'accès à la variable globale</span>
    <span class="keyword">echo</span> <span class="variable">$variableGlobale</span><span class="punct">;</span>
}

<span class="keyword">function</span> <span class="function">modifierGlobale</span>() {
    <span class="keyword">global</span> <span class="variable">$variableGlobale</span><span class="punct">;</span>
    <span class="variable">$variableGlobale</span> <span class="operator">=</span> <span class="string">"Valeur modifiée"</span><span class="punct">;</span>
}

<span class="comment">// Alternative avec le tableau $GLOBALS</span>
<span class="keyword">function</span> <span class="function">autreMethode</span>() {
    <span class="variable">$GLOBALS</span>[<span class="string">'variableGlobale'</span>] <span class="operator">=</span> <span class="string">"Nouvelle valeur"</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Exemple d'utilisation :</p>
                        <code>
                            $variableGlobale = "Valeur initiale";
                            echo "Avant : $variableGlobale<br>";
                            modifierGlobale();
                            echo "Après : $variableGlobale";
                        </code>
                        <p>Résultat :
                            <?php
                            $variableGlobale = "Valeur initiale";
                            echo "<strong>Avant : $variableGlobale<br>";
                            function modifierGlobale()
                            {
                                global $variableGlobale;
                                $variableGlobale = "Valeur modifiée";
                            }
                            modifierGlobale();
                            echo "Après : $variableGlobale</strong>";
                            ?>
                        </p>
                    </div>
                    <div class="warning-box">
                        <strong>Attention !</strong> L'utilisation excessive de variables globales est généralement considérée comme une mauvaise pratique car :
                        <ul>
                            <li>Elle rend le code difficile à suivre et à maintenir</li>
                            <li>Elle peut causer des effets secondaires imprévisibles</li>
                            <li>Elle complique les tests unitaires</li>
                            <li>Elle crée des dépendances cachées</li>
                        </ul>
                        Préférez passer des paramètres et retourner des résultats.
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header basic-header">Variables statiques</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">compteur</span>() {
    <span class="keyword">static</span> <span class="variable">$compte</span> <span class="operator">=</span> <span class="number">0</span><span class="punct">;</span> <span class="comment">// Initialisée une seule fois</span>
    <span class="variable">$compte</span><span class="operator">++</span><span class="punct">;</span> <span class="comment">// Incrémentée à chaque appel</span>
    <span class="keyword">return</span> <span class="variable">$compte</span><span class="punct">;</span>
}
wamp
<span class="comment">// Exemple de cas pratique : mise en cache</span>
<span class="keyword">function</span> <span class="function">getDatabase</span>() {
    <span class="keyword">static</span> <span class="variable">$connexion</span> = <span class="keyword">null</span><span class="punct">;</span>
    
    <span class="keyword">if</span> (<span class="variable">$connexion</span> === <span class="keyword">null</span>) {
        <span class="comment">// Connexion coûteuse, n'est faite qu'une seule fois</span>
        <span class="variable">$connexion</span> = <span class="string">"Connexion établie"</span><span class="punct">;</span> <span class="comment">// Dans la réalité: new PDO(...)</span>
        <span class="keyword">echo</span> <span class="string">"<p>Nouvelle connexion</p>"</span><span class="punct">;</span>
    } <span class="keyword">else</span> {
        <span class="keyword">echo</span> <span class="string">"<p>Réutilisation de la connexion existante</p>"</span><span class="punct">;</span>
    }
    
    <span class="keyword">return</span> <span class="variable">$connexion</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Appels successifs de compteur() :</p>
                        <code>echo compteur() . ", " . compteur() . ", " . compteur();</code>
                        <p>Résultats : <strong>
                                <?php
                                function compteurStatic()
                                {
                                    static $compte = 0;
                                    $compte++;
                                    return $compte;
                                }
                                echo compteurStatic() . ", ";
                                echo compteurStatic() . ", ";
                                echo compteurStatic();
                                ?>
                            </strong></p>
                        <p>Démonstration avec getDatabase() :</p>
                        <code>
                            $db1 = getDatabase();
                            $db2 = getDatabase();
                            $db3 = getDatabase();</code>
                        <div class="output">
                            <?php
                            function getDatabaseDemo()
                            {
                                static $connexion = null;

                                if ($connexion === null) {
                                    $connexion = "Connexion établie";
                                    echo "<p><strong>Nouvelle connexion</strong></p>";
                                } else {
                                    echo "<p><strong>Réutilisation de la connexion existante</strong></p>";
                                }

                                return $connexion;
                            }
                            $db1 = getDatabaseDemo();
                            $db2 = getDatabaseDemo();
                            $db3 = getDatabaseDemo();
                            ?>
                        </div>
                    </div>

                    <div class="info-box">
                        <strong>Utilisations courantes des variables statiques :</strong>
                        <ul>
                            <li>Compteurs et accumulateurs</li>
                            <li>Mise en cache de résultats coûteux à calculer</li>
                            <li>Implémentation du pattern Singleton</li>
                            <li>Mémorisation d'un état entre les appels de fonctions</li>
                            <li>Optimisation des performances</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <h2>Bonnes pratiques</h2>

        <div class="best-practices">
            <div class="practice-group">
                <h3>Conception des fonctions</h3>
                <ul>
                    <li><strong>Nommez clairement vos fonctions</strong> : Utilisez des noms descriptifs en format camelCase (ex: <code>calculerTotalTTC()</code>).</li>
                    <li><strong>Une fonction, une tâche</strong> : Chaque fonction devrait idéalement accomplir une seule tâche bien définie.</li>
                    <li><strong>Taille limitée</strong> : Les fonctions ne devraient pas dépasser 20-30 lignes. Si c'est le cas, envisagez de les diviser.</li>
                    <li><strong>Limitez le nombre de paramètres</strong> : Idéalement entre 0 et 4. Au-delà, utilisez des tableaux associatifs ou des objets.</li>
                </ul>
            </div>

            <div class="practice-group">
                <h3>Documentation et lisibilité</h3>
                <ul>
                    <li><strong>Documentez vos fonctions</strong> : Utilisez le format PHPDoc pour documenter vos fonctions :</li>
                </ul>
                <pre><code class="language-php">/**
 * Calcule le prix total TTC d'un produit
 *
 * @param float $prixHT Prix hors taxes
 * @param float $tauxTVA Taux de TVA (ex: 20 pour 20%)
 * @return float Prix TTC
 */
function calculerPrixTTC($prixHT, $tauxTVA = 20) {
    return $prixHT * (1 + $tauxTVA / 100);
}</code></pre>
            </div>

            <div class="practice-group">
                <h3>Gestion des erreurs</h3>
                <ul>
                    <li><strong>Validez les arguments</strong> : Vérifiez toujours les entrées pour éviter les comportements inattendus.</li>
                    <li><strong>Gérez les erreurs explicitement</strong> : Retournez des valeurs d'erreur claires ou utilisez des exceptions.</li>
                    <li><strong>Évitez les effets de bord</strong> : Ne modifiez pas les variables globales ou les paramètres sauf si c'est explicitement attendu.</li>
                </ul>
            </div>

            <div class="practice-group">
                <h3>Conception orientée retour</h3>
                <ul>
                    <li><strong>Préférez return à echo</strong> : Les fonctions devraient retourner des valeurs plutôt que les afficher.</li>
                    <li><strong>Cohérence dans les retours</strong> : Une fonction devrait retourner des valeurs de types similaires dans tous les cas.</li>
                    <li><strong>Utilisez le typage de retour</strong> : En PHP 7+, spécifiez le type de retour pour une meilleure lisibilité et fiabilité.</li>
                </ul>
            </div>

            <div class="practice-group">
                <h3>Optimisation</h3>
                <ul>
                    <li><strong>Évitez la récursion profonde</strong> : PHP a des limites strictes sur la profondeur de récursion.</li>
                    <li><strong>Utilisez des variables statiques</strong> pour mettre en cache des résultats coûteux à calculer.</li>
                    <li><strong>Préférez les bibliothèques natives</strong> : Les fonctions PHP natives sont généralement plus rapides que le code personnalisé.</li>
                </ul>
            </div>
        </div>

        <div class="example">
            <div class="example-header advanced-header">Avant vs Après : Refactorisation d'une fonction</div>
            <div class="example-content">
                <div class="split-example">
                    <div class="bad-code">
                        <h4>❌ Avant</h4>
                        <pre><code class="language-php">function f($a, $b, $c, $d) {
    if($a == "add") {
        $r = $b + $c;
        echo "Result: " . $r;
        return true;
    } else if($a == "subtract") {
        $r = $b - $c;
        echo "Result: " . $r;
        return true;
    } else if($a == "multiply") {
        $r = $b * $c;
        echo "Result: " . $r;
        return true;
    } else {
        echo "Unknown operation";
        return false;
    }
}</code></pre>
                    </div>
                    <div class="good-code">
                        <h4>✅ Après</h4>
                        <pre><code class="language-php">/**
 * Effectue une opération mathématique de base
 *
 * @param string $operation Type d'opération ('add', 'subtract', 'multiply')
 * @param float $nombre1 Premier nombre
 * @param float $nombre2 Second nombre
 * @return float|null Résultat ou null si opération invalide
 */
function calculer(string $operation, float $nombre1, float $nombre2): ?float {
    switch ($operation) {
        case 'add':
            return $nombre1 + $nombre2;
        case 'subtract':
            return $nombre1 - $nombre2;
        case 'multiply':
            return $nombre1 * $nombre2;
        default:
            return null;
    }
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <h2>Exercices pratiques</h2>

        <div class="practice-intro">
            <p>Pour maîtriser les fonctions PHP, rien de tel que la pratique ! Voici une série d'exercices de difficulté progressive pour consolider vos connaissances.</p>
        </div>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header exercise-header">Exercice 1 : Opération basique</div>
                <div class="example-content">
                    <p><strong>Créez une fonction qui calcule le produit de deux nombres</strong></p>
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">multiplier</span>(<span class="type">float</span> $a, <span class="type">float</span> $b): <span class="type">float</span> {
    <span class="keyword">return</span> $a * $b;
}

<span class="comment">// Test de la fonction</span>
<span class="keyword">echo</span> <span class="string">"4 × 5 = "</span> . multiplier(4, 5); <span class="comment">// Affiche 20</span></code></pre>
                    <div class="exercise-solution">
                        <button class="solution-toggle">Voir la réponse complète</button>
                        <div class="solution-content" style="display: none;">
                            <p>Pour une fonction plus robuste, envisagez de valider les entrées :</p>
                            <pre><code class="language-php"><span class="keyword">function</span> <span class="function">multiplier</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
    <span class="comment">// Vérifier que les paramètres sont bien numériques</span>
    <span class="keyword">if</span> (!<span class="function">is_numeric</span>(<span class="variable">$a</span>) || !<span class="function">is_numeric</span>(<span class="variable">$b</span>)) {
        <span class="keyword">return</span> <span class="string">"Erreur: les paramètres doivent être des nombres"</span>;
    }
    
    <span class="keyword">return</span> <span class="variable">$a</span> * <span class="variable">$b</span>;
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header exercise-header">Exercice 2 : Traitement d'un tableau</div>
                <div class="example-content">
                    <p><strong>Créez une fonction qui calcule la somme des éléments d'un tableau</strong></p>
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">sommeTableau</span>(<span class="type">array</span> $tableau): <span class="type">float</span> {
    <span class="variable">$somme</span> = 0;
    <span class="keyword">foreach</span> (<span class="variable">$tableau</span> <span class="keyword">as</span> <span class="variable">$valeur</span>) {
        <span class="variable">$somme</span> += <span class="variable">$valeur</span>;
    }
    <span class="keyword">return</span> <span class="variable">$somme</span>;
}</code></pre>
                    <div class="result">
                        <p>Test :</p>
                        <code>echo sommeTableau([1, 2, 3, 4, 5]);</code>
                        <p>Résultat : <strong>
                                <?php
                                function sommeTableauEx($tableau)
                                {
                                    $somme = 0;
                                    foreach ($tableau as $valeur) {
                                        $somme += $valeur;
                                    }
                                    return $somme;
                                }
                                echo sommeTableauEx([1, 2, 3, 4, 5]);
                                ?>
                            </strong></p>
                    </div>
                    <div class="tip-box">
                        <strong>Astuce :</strong> Pour cet exercice, vous pouvez également utiliser la fonction native <code>array_sum()</code> comme solution alternative.
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header exercise-header">Exercice 3 : Manipulation de chaînes</div>
                <div class="example-content">
                    <p><strong>Créez une fonction qui compte les voyelles dans une chaîne</strong></p>
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">compterVoyelles</span>(<span class="type">string</span> $chaine): <span class="type">int</span> {
    <span class="variable">$voyelles</span> = [<span class="string">'a'</span>, <span class="string">'e'</span>, <span class="string">'i'</span>, <span class="string">'o'</span>, <span class="string">'u'</span>, <span class="string">'y'</span>, 
                <span class="string">'A'</span>, <span class="string">'E'</span>, <span class="string">'I'</span>, <span class="string">'O'</span>, <span class="string">'U'</span>, <span class="string">'Y'</span>];
    <span class="variable">$compteur</span> = 0;
    
    <span class="keyword">for</span> (<span class="variable">$i</span> = 0; <span class="variable">$i</span> < <span class="function">strlen</span>(<span class="variable">$chaine</span>); <span class="variable">$i</span>++) {
        <span class="keyword">if</span> (<span class="function">in_array</span>(<span class="variable">$chaine</span>[<span class="variable">$i</span>], <span class="variable">$voyelles</span>)) {
            <span class="variable">$compteur</span>++;
        }
    }
    
    <span class="keyword">return</span> <span class="variable">$compteur</span>;
}</code></pre>
                    <div class="result">
                        <p>Test :</p>
                        <code>echo "Le mot 'Bonjour' contient " . compterVoyelles("Bonjour") . " voyelles.";</code>
                        <p>Résultat : <strong>
                                <?php
                                function compterVoyellesDemo($chaine)
                                {
                                    $voyelles = ['a', 'e', 'i', 'o', 'u', 'y', 'A', 'E', 'I', 'O', 'U', 'Y'];
                                    $compteur = 0;

                                    for ($i = 0; $i < strlen($chaine); $i++) {
                                        if (in_array($chaine[$i], $voyelles)) {
                                            $compteur++;
                                        }
                                    }

                                    return $compteur;
                                }
                                echo "Le mot 'Bonjour' contient " . compterVoyellesDemo("Bonjour") . " voyelles.";
                                ?>
                            </strong></p>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="example-header exercise-header">Exercice 4 : Fonction avancée</div>
                <div class="example-content">
                    <p><strong>Créez une fonction qui filtre les éléments d'un tableau selon un critère</strong></p>
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">filtrerTableau</span>(<span class="type">array</span> $tableau, <span class="type">callable</span> $critere): <span class="type">array</span> {
    <span class="variable">$resultat</span> = [];
    
    <span class="keyword">foreach</span> (<span class="variable">$tableau</span> <span class="keyword">as</span> <span class="variable">$cle</span> => <span class="variable">$valeur</span>) {
        <span class="keyword">if</span> (<span class="variable">$critere</span>(<span class="variable">$valeur</span>)) {
            <span class="variable">$resultat</span>[<span class="variable">$cle</span>] = <span class="variable">$valeur</span>;
        }
    }
    
    <span class="keyword">return</span> <span class="variable">$resultat</span>;
}</code></pre>
                    <div class="result">
                        <p>Test avec une fonction anonyme pour filtrer les nombres pairs :</p>
                        <code>
                            $nombres = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                            $pairs = filtrerTableau($nombres, function($n) {
                            return $n % 2 == 0;
                            });
                            echo "Nombres pairs : " . implode(", ", $pairs);</code>
                        <p>Résultat : <strong>
                                <?php
                                function filtrerTableauDemo($tableau, $critere)
                                {
                                    $resultat = [];

                                    foreach ($tableau as $cle => $valeur) {
                                        if ($critere($valeur)) {
                                            $resultat[$cle] = $valeur;
                                        }
                                    }

                                    return $resultat;
                                }

                                $nombres = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                                $pairs = filtrerTableauDemo($nombres, function ($n) {
                                    return $n % 2 == 0;
                                });
                                echo "Nombres pairs : " . implode(", ", $pairs);
                                ?>
                            </strong></p>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header exercise-header">Exercice 5 : Défi récursif</div>
                <div class="example-content">
                    <p><strong>Créez une fonction récursive qui calcule les nombres de la suite de Fibonacci</strong></p>
                    <pre><code class="language-php"><span class="keyword">function</span> <span class="function">fibonacci</span>(<span class="type">int</span> $n): <span class="type">int</span> {
    <span class="comment">// Cas de base</span>
    <span class="keyword">if</span> (<span class="variable">$n</span> <= 1) {
        <span class="keyword">return</span> <span class="variable">$n</span>;
    }
    
    <span class="comment">// Appel récursif</span>
    <span class="keyword">return</span> <span class="function">fibonacci</span>(<span class="variable">$n</span> - 1) + <span class="function">fibonacci</span>(<span class="variable">$n</span> - 2);
}</code></pre>
                    <div class="result">
                        <p>Suite de Fibonacci pour les 10 premiers termes :</p>
                        <code>
                            for ($i = 0; $i < 10; $i++) {
                                echo fibonacci($i) . " " ;
                                }</code>
                                <p>Résultat : <strong>
                                        <?php
                                        function fibonacciDemo($n)
                                        {
                                            if ($n <= 1) {
                                                return $n;
                                            }
                                            return fibonacciDemo($n - 1) + fibonacciDemo($n - 2);
                                        }

                                        for ($i = 0; $i < 10; $i++) {
                                            echo fibonacciDemo($i) . " ";
                                        }
                                        ?>
                                    </strong></p>
                    </div>
                    <div class="warning-box">
                        <strong>Optimisation :</strong> Cette implémentation récursive est simple mais inefficace pour de grandes valeurs de n. Une approche itérative serait plus performante.
                    </div>
                </div>
            </div>
        </div>

        <div class="challenge-box">
            <h3>Défi supplémentaire</h3>
            <p>Créez une fonction <code>memoize()</code> qui prend une fonction en entrée et retourne une version optimisée qui met en cache les résultats pour éviter les calculs répétitifs. Utilisez-la pour optimiser la fonction fibonacci.</p>
        </div>
    </section>

    <section class="section">
        <h2>Ressources d'apprentissage</h2>
        <div class="resources-list">
            <div class="resource-card">
                <a href="https://www.php.net/manual/fr/language.functions.php" target="_blank">Documentation officielle PHP</a>
                <p>Guide complet sur les fonctions en PHP avec des exemples détaillés</p>
                <div class="tag">Référence</div>
            </div>
            <div class="resource-card">
                <a href="https://www.w3schools.com/php/php_functions.asp" target="_blank">W3Schools - Les Fonctions PHP</a>
                <p>Tutoriels simples et pratiques pour débutants</p>
                <div class="tag">Débutant</div>
            </div>
            <div class="resource-card">
                <a href="https://openclassrooms.com/fr/courses/6174541-ecrivez-des-fonctions-en-php" target="_blank">OpenClassrooms - Fonctions PHP</a>
                <p>Cours interactif en français pour apprendre à écrire des fonctions efficaces</p>
                <div class="tag">Cours complet</div>
            </div>
            <div class="resource-card">
                <a href="https://phptherightway.com/#functions" target="_blank">PHP: The Right Way</a>
                <p>Bonnes pratiques et conseils avancés sur l'utilisation des fonctions</p>
                <div class="tag">Bonnes pratiques</div>
            </div>
            <div class="resource-card">
                <a href="https://nikic.github.io/2012/01/09/Disproving-the-Single-Quotes-Performance-Myth.html" target="_blank">Closure Performance</a>
                <p>Article détaillé sur les performances des fonctions anonymes et closures en PHP</p>
                <div class="tag">Avancé</div>
            </div>
            <div class="resource-card">
                <a href="https://www.php-fig.org/psr/psr-12/" target="_blank">PSR-12: Extended Coding Style</a>
                <p>Standards de codage recommandés pour les déclarations de fonctions en PHP</p>
                <div class="tag">Standards</div>
            </div>
        </div>

        <div class="summary-box">
            <h3>Points à retenir</h3>
            <ul>
                <li>Les fonctions permettent d'organiser le code en blocs réutilisables</li>
                <li>PHP offre plusieurs types de paramètres : obligatoires, facultatifs, variables, par référence</li>
                <li>Les fonctions récursives s'appellent elles-mêmes pour résoudre des problèmes complexes</li>
                <li>Les fonctions anonymes et fléchées sont idéales comme callbacks</li>
                <li>Pensez à la portée des variables (locale, globale, statique) lors de la conception</li>
                <li>Documentez vos fonctions avec PHPDoc pour améliorer la maintenabilité</li>
            </ul>
        </div>
    </section>
</main>

<script>
    // Script pour afficher/masquer les solutions des exercices
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.solution-toggle');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const solutionContent = this.nextElementSibling;
                if (solutionContent.style.display === 'none') {
                    solutionContent.style.display = 'block';
                    this.textContent = 'Masquer la réponse';
                } else {
                    solutionContent.style.display = 'none';
                    this.textContent = 'Voir la réponse complète';
                }
            });
        });
    });
</script>

<div class="navigation">
    <a href="<?= BASE_URL ?>/modules/04-les-boucles.php" class="nav-button">← Module précédent</a>
    <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
    <a href="<?= BASE_URL ?>/modules/06-les-tableaux.php" class="nav-button">Module suivant →</a>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>