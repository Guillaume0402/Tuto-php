<?php
$moduleClass = 'module3';
include __DIR__ . '/../includes/header.php';

// Définition des variables pour les exemples
$titre = "Les Structures Conditionnelles en PHP";
$description = "Maîtrisez les structures conditionnelles pour contrôler le flux d'exécution de votre code PHP";

// Exemple if-else
$age = 18;
if ($age >= 64) {
    $message = "Tu es senior.";
} elseif ($age >= 18) {
    $message = "Tu es majeur.";
} else {
    $message = "Tu es mineur.";
}

// Exemple opérateur ternaire
$ages = 16;
$messages = $ages >= 18 ? "Tu es majeur." : "Tu es mineur.";

// Exemple opérateur null coalescent
$nom = null;
$nomParDefaut = $nom ?? "Utilisateur anonyme";

// Exemple switch case
$fruits = 'raisin';
switch ($fruits) {
    case 'pomme':
        $mesage = "C'est une pomme.";
        break;
    case 'banane':
        $mesage = "C'est une banane.";
        break;
    case 'orange':
        $mesage = "C'est une orange.";
        break;
    default:
        $mesage = "Je n'aime pas ce fruit.";
}

// Exemple match (PHP 8+)
$legumes = 'carotte';
$messageLegume = match ($legumes) {
    'carotte' => "C'est une carotte.",
    'tomate' => "C'est une tomate.",
    'courgette' => "C'est une courgette.",
    default => "Je n'aime pas ce légume."
};

// Exemple combinaison d'opérateurs
$utilisateur = [
    'role' => 'admin',
    'statut' => 'actif'
];

$accesAutorise = ($utilisateur['role'] === 'admin' && $utilisateur['statut'] === 'actif');
?>

<div class="module-header">
    <h1><?= $titre ?></h1>
    <p class="subtitle"><?= $description ?></p>
</div>
<div class="navigation">
    <a href="<?= BASE_URL ?>/modules/02-les-variables.php" class="nav-button">← Module précédent</a>
    <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
    <a href="<?= BASE_URL ?>/modules/04-les-boucles.php" class="nav-button">Module suivant →</a>
</div>
<main>
    <section class="section">
        <h2>Introduction aux conditions</h2>
        <p>Les structures conditionnelles sont essentielles en programmation car elles permettent à votre code de prendre des décisions et d'exécuter différentes instructions selon que certaines conditions sont remplies ou non.</p>
        <p>En PHP, il existe plusieurs façons d'écrire des conditions :</p>

        <div class="info-box">
            <strong>À quoi servent les conditions ?</strong>
            <ul>
                <li>Exécuter du code uniquement si une condition est remplie</li>
                <li>Choisir entre plusieurs blocs de code à exécuter</li>
                <li>Créer des chemins d'exécution différents selon les circonstances</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <h2>Structure if-else</h2>
        <p>La structure if-else est la plus fondamentale pour créer des conditions en PHP.</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header if-header">Syntaxe de base</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">if</span> (<span class="variable">condition</span>) {
    <span class="comment">// Code exécuté si condition est vraie</span>
} <span class="keyword">else</span> {
    <span class="comment">// Code exécuté si condition est fausse</span>
}</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header if-header">Exemple concret</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$age</span> <span class="operator">=</span> <span class="number">18</span><span class="punct">;</span>

<span class="keyword">if</span> (<span class="variable">$age</span> <span class="operator">>=</span> <span class="number">64</span>) {
    <span class="variable">$message</span> <span class="operator">=</span> <span class="string">"Tu es senior."</span><span class="punct">;</span>
} <span class="keyword">elseif</span> (<span class="variable">$age</span> <span class="operator">>=</span> <span class="number">18</span>) {
    <span class="variable">$message</span> <span class="operator">=</span> <span class="string">"Tu es majeur."</span><span class="punct">;</span>
} <span class="keyword">else</span> {
    <span class="variable">$message</span> <span class="operator">=</span> <span class="string">"Tu es mineur."</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Résultat : <?= $message ?></p>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header if-header">Conditions multiples</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$note</span> <span class="operator">=</span> <span class="number">75</span><span class="punct">;</span>

<span class="keyword">if</span> (<span class="variable">$note</span> <span class="operator">>=</span> <span class="number">90</span>) {
    <span class="keyword">echo</span> <span class="string">"Excellent"</span><span class="punct">;</span>
} <span class="keyword">elseif</span> (<span class="variable">$note</span> <span class="operator">>=</span> <span class="number">80</span>) {
    <span class="keyword">echo</span> <span class="string">"Très bien"</span><span class="punct">;</span>
} <span class="keyword">elseif</span> (<span class="variable">$note</span> <span class="operator">>=</span> <span class="number">70</span>) {
    <span class="keyword">echo</span> <span class="string">"Bien"</span><span class="punct">;</span>
} <span class="keyword">elseif</span> (<span class="variable">$note</span> <span class="operator">>=</span> <span class="number">60</span>) {
    <span class="keyword">echo</span> <span class="string">"Passable"</span><span class="punct">;</span>
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"À améliorer"</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Résultat : Bien</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Opérateurs de comparaison</h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Opérateur</th>
                    <th>Nom</th>
                    <th>Exemple</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>==</td>
                    <td>Égal</td>
                    <td>$a == $b</td>
                    <td>Vrai si $a est égal à $b après conversion de type</td>
                </tr>
                <tr>
                    <td>===</td>
                    <td>Identique</td>
                    <td>$a === $b</td>
                    <td>Vrai si $a est égal à $b et qu'ils sont du même type</td>
                </tr>
                <tr>
                    <td>!=</td>
                    <td>Différent</td>
                    <td>$a != $b</td>
                    <td>Vrai si $a n'est pas égal à $b après conversion de type</td>
                </tr>
                <tr>
                    <td>!==</td>
                    <td>Non identique</td>
                    <td>$a !== $b</td>
                    <td>Vrai si $a n'est pas égal à $b ou qu'ils ne sont pas du même type</td>
                </tr>
                <tr>
                    <td>&lt;</td>
                    <td>Inférieur à</td>
                    <td>$a < $b</td>
                    <td>Vrai si $a est strictement inférieur à $b</td>
                </tr>
                <tr>
                    <td>&gt;</td>
                    <td>Supérieur à</td>
                    <td>$a > $b</td>
                    <td>Vrai si $a est strictement supérieur à $b</td>
                </tr>
                <tr>
                    <td>&lt;=</td>
                    <td>Inférieur ou égal à</td>
                    <td>$a <= $b</td>
                    <td>Vrai si $a est inférieur ou égal à $b</td>
                </tr>
                <tr>
                    <td>&gt;=</td>
                    <td>Supérieur ou égal à</td>
                    <td>$a >= $b</td>
                    <td>Vrai si $a est supérieur ou égal à $b</td>
                </tr>
                <tr>
                    <td>
                        <=>
                    </td>
                    <td>Spaceship</td>
                    <td>$a <=> $b</td>
                    <td>Retourne -1, 0 ou 1 selon que $a < $b, $a==$b ou $a> $b</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="section">
        <h2>Opérateurs ternaires</h2>
        <p>L'opérateur ternaire est une forme condensée de la structure if-else.</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header else-header">Syntaxe de base</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$variable</span> <span class="operator">=</span> (<span class="variable">condition</span>) <span class="operator">?</span> <span class="variable">valeur_si_vrai</span> <span class="operator">:</span> <span class="variable">valeur_si_faux</span><span class="punct">;</span></code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header else-header">Exemple concret</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$ages</span> <span class="operator">=</span> <span class="number">16</span><span class="punct">;</span>
<span class="variable">$messages</span> <span class="operator">=</span> <span class="variable">$ages</span> <span class="operator">></span> <span class="number">18</span> <span class="operator">?</span> <span class="string">"Tu es majeur."</span> <span class="operator">:</span> <span class="string">"Tu es mineur."</span><span class="punct">;</span></code></pre>
                    <div class="result">
                        <p>Résultat : <?= $messages ?></p>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header else-header">Opérateur null coalescent</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$nom</span> <span class="operator">=</span> <span class="keyword">null</span><span class="punct">;</span>
<span class="variable">$nomParDefaut</span> <span class="operator">=</span> <span class="variable">$nom</span> <span class="operator">??</span> <span class="string">"Utilisateur anonyme"</span><span class="punct">;</span></code></pre>
                    <div class="result">
                        <p>Résultat : <?= $nomParDefaut ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="warning-box">
            <strong>Attention !</strong> L'opérateur ternaire est idéal pour des conditions simples, mais peut rendre le code difficile à lire s'il est imbriqué ou trop complexe.
        </div>
    </section>

    <section class="section">
        <h2>Structure switch-case</h2>
        <p>La structure switch est utilisée pour effectuer différentes actions en fonction de différentes conditions.</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header switch-header">Syntaxe de base</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">switch</span> (<span class="variable">expression</span>) {
    <span class="keyword">case</span> <span class="variable">valeur1</span><span class="punct">:</span>
        <span class="comment">// Code à exécuter si expression = valeur1</span>
        <span class="keyword">break</span><span class="punct">;</span>
    <span class="keyword">case</span> <span class="variable">valeur2</span><span class="punct">:</span>
        <span class="comment">// Code à exécuter si expression = valeur2</span>
        <span class="keyword">break</span><span class="punct">;</span>
    <span class="keyword">default</span><span class="punct">:</span>
        <span class="comment">// Code à exécuter par défaut</span>
}</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header switch-header">Exemple concret</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$fruits</span> <span class="operator">=</span> <span class="string">'raisin'</span><span class="punct">;</span>

<span class="keyword">switch</span> (<span class="variable">$fruits</span>) {
    <span class="keyword">case</span> <span class="string">'pomme'</span><span class="punct">:</span>
        <span class="variable">$message</span> <span class="operator">=</span> <span class="string">"C'est une pomme."</span><span class="punct">;</span>
        <span class="keyword">break</span><span class="punct">;</span>
    <span class="keyword">case</span> <span class="string">'banane'</span><span class="punct">:</span>
        <span class="variable">$message</span> <span class="operator">=</span> <span class="string">"C'est une banane."</span><span class="punct">;</span>
        <span class="keyword">break</span><span class="punct">;</span>
    <span class="keyword">case</span> <span class="string">'orange'</span><span class="punct">:</span>
        <span class="variable">$message</span> <span class="operator">=</span> <span class="string">"C'est une orange."</span><span class="punct">;</span>
        <span class="keyword">break</span><span class="punct">;</span>
    <span class="keyword">default</span><span class="punct">:</span>
        <span class="variable">$message</span> <span class="operator">=</span> <span class="string">"Je n'aime pas ce fruit."</span><span class="punct">;</span>
}</code></pre>
                    <div class="result">
                        <p>Résultat : <?= $mesage ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-box">
            <strong>Important :</strong> N'oubliez pas le mot-clé <code>break</code> à la fin de chaque case pour éviter que l'exécution ne se poursuive dans les cases suivantes.
        </div>

        <section class="section">
            <h2>Expression match (PHP 8+)</h2>
            <p>L'expression match est une amélioration moderne de switch, introduite dans PHP 8. Elle est plus concise et retourne une valeur.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header match-header">Syntaxe de base</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$resultat</span> <span class="operator">=</span> <span class="keyword">match</span> (<span class="variable">expression</span>) {
    <span class="variable">valeur1</span> <span class="operator">=></span> <span class="variable">resultat1</span><span class="punct">,</span>
    <span class="variable">valeur2</span> <span class="operator">=></span> <span class="variable">resultat2</span><span class="punct">,</span>
    <span class="keyword">default</span> <span class="operator">=></span> <span class="variable">resultatDefaut</span>
<span class="punct">};</span></code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header match-header">Exemple concret</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$legumes</span> <span class="operator">=</span> <span class="string">'carotte'</span><span class="punct">;</span>
<span class="variable">$messageLegume</span> <span class="operator">=</span> <span class="keyword">match</span> (<span class="variable">$legumes</span>) {
    <span class="string">'carotte'</span> <span class="operator">=></span> <span class="string">"C'est une carotte."</span><span class="punct">,</span>
    <span class="string">'tomate'</span> <span class="operator">=></span> <span class="string">"C'est une tomate."</span><span class="punct">,</span>
    <span class="string">'courgette'</span> <span class="operator">=></span> <span class="string">"C'est une courgette."</span><span class="punct">,</span>
    <span class="keyword">default</span> <span class="operator">=></span> <span class="string">"Je n'aime pas ce légume."</span>
};</code></pre>
                        <div class="result">
                            <p>Résultat : <?= $messageLegume ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header match-header">Cas multiples</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$code</span> <span class="operator">=</span> <span class="number">404</span><span class="punct">;</span>
<span class="variable">$message</span> <span class="operator">=</span> <span class="keyword">match</span> (<span class="variable">$code</span>) {
    <span class="number">200</span><span class="punct">,</span> <span class="number">201</span><span class="punct">,</span> <span class="number">202</span> <span class="operator">=></span> <span class="string">"Succès"</span><span class="punct">,</span>
    <span class="number">400</span><span class="punct">,</span> <span class="number">401</span><span class="punct">,</span> <span class="number">403</span><span class="punct">,</span> <span class="number">404</span> <span class="operator">=></span> <span class="string">"Erreur client"</span><span class="punct">,</span>
    <span class="number">500</span><span class="punct">,</span> <span class="number">501</span><span class="punct">,</span> <span class="number">502</span> <span class="operator">=></span> <span class="string">"Erreur serveur"</span><span class="punct">,</span>
    <span class="keyword">default</span> <span class="operator">=></span> <span class="string">"Code inconnu"</span>
<span class="punct">};</span></code></pre>
                        <div class="result">
                            <p>Résultat : Erreur client</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Opérateurs logiques</h2>
            <p>Les opérateurs logiques permettent de combiner plusieurs conditions.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header operators-header">ET logique (&&)</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">if</span> (<span class="variable">$age</span> <span class="operator">>=</span> <span class="number">18</span> <span class="operator">&&</span> <span class="variable">$permis</span> <span class="operator">==</span> <span class="keyword">true</span>) {
    <span class="keyword">echo</span> <span class="string">"Vous pouvez conduire"</span><span class="punct">;</span>
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Vous ne pouvez pas conduire"</span><span class="punct">;</span>
}</code></pre>
                        <div class="result">
                            <p>Les deux conditions doivent être vraies</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header operators-header">OU logique (||)</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">if</span> (<span class="variable">$membre</span> <span class="operator">==</span> <span class="keyword">true</span> <span class="operator">||</span> <span class="variable">$essaiGratuit</span> <span class="operator">==</span> <span class="keyword">true</span>) {
    <span class="keyword">echo</span> <span class="string">"Accès autorisé"</span><span class="punct">;</span>
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Accès refusé"</span><span class="punct">;</span>
}</code></pre>
                        <div class="result">
                            <p>Au moins une condition doit être vraie</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header operators-header">NON logique (!)</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">if</span> (<span class="operator">!</span><span class="variable">$estBloque</span>) {
    <span class="keyword">echo</span> <span class="string">"Bienvenue !"</span><span class="punct">;</span>
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Votre compte est bloqué"</span><span class="punct">;</span>
}</code></pre>
                        <div class="result">
                            <p>Inverse la valeur (vrai devient faux et vice versa)</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Exemple de combinaison d'opérateurs</h3>
            <div class="example">
                <div class="example-header operators-header">Combinaison d'opérateurs</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="variable">$utilisateur</span> <span class="operator">=</span> [
    <span class="string">'role'</span> => <span class="string">'admin'</span>,
    <span class="string">'statut'</span> => <span class="string">'actif'</span>
];

<span class="variable">$accesAutorise</span>  = (<span class="variable">$utilisateur</span>[<span class="string">'role'</span>] <span class="operator">===</span> <span class="string">'admin'</span> <span class="operator">&&</span> <span class="variable">$utilisateur</span>[<span class="string">'statut'</span>] <span class="operator">===</span> <span class="string">'actif'</span>);</code></pre>
                    <div class="result">
                        <p>Résultat : <?= $accesAutorise ? 'true (accès autorisé)' : 'false (accès refusé)' ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Bonnes pratiques</h2>
            <ul>
                <li><strong>Lisibilité</strong> : Utilisez une indentation cohérente et des espaces pour rendre votre code plus lisible</li>
                <li><strong>Comparaison stricte</strong> : Privilégiez les opérateurs === et !== pour éviter les conversions de type implicites</li>
                <li><strong>Parenthèses</strong> : Utilisez des parenthèses pour clarifier l'ordre d'évaluation des conditions complexes</li>
                <li><strong>Imbrication</strong> : Évitez de trop imbriquer les conditions pour garder votre code maintenable</li>
                <li><strong>Early return</strong> : Retournez tôt pour éviter les blocs conditionnels trop profonds</li>
            </ul>
        </section>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>