<?php include __DIR__ . '/../includes/header-pro.php'; 

// Variables de page
$titre = "Les Boucles en PHP";
$description = "Découvrez comment répéter des opérations avec les différents types de boucles PHP pour un code plus efficace";

// Exemples pour les différentes sections
// Les définitions sont conservées plus bas dans le code
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="module4">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </header>
    <div class="navigation">
        <a href="03-les-conditions.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="05-les-fonctions.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction aux boucles</h2>
            <p>Les boucles sont des structures de contrôle qui permettent d'exécuter un bloc de code plusieurs fois. Elles sont particulièrement utiles pour traiter des ensembles de données comme les tableaux et pour automatiser des tâches répétitives.</p>

            <div class="info-box">
                <strong>À quoi servent les boucles ?</strong>
                <ul>
                    <li>Répéter des opérations sur des collections de données</li>
                    <li>Automatiser des tâches répétitives</li>
                    <li>Parcourir des tableaux ou des objets</li>
                    <li>Exécuter un bloc de code jusqu'à ce qu'une condition soit remplie</li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2>La boucle while</h2>
            <p>La boucle while exécute un bloc de code tant qu'une condition spécifiée est vraie.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header while-header">Syntaxe de base</div>
                    <div class="example-content">
                        <pre><code><span class="keyword">while</span> (condition) {
    <span class="comment">// Code à exécuter</span>
    <span class="comment">// tant que la condition est vraie</span>
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header while-header">Exemple simple</div>
                    <div class="example-content">
                        <pre><code><span class="variable">$i</span> = <span class="number">1</span>;
<span class="keyword">while</span> (<span class="variable">$i</span> <= <span class="number">5</span>) {
    <span class="keyword">echo</span> <span class="string">"Itération $i&lt;br&gt;"</span>;
    <span class="variable">$i</span>++;
}</code></pre>
                        <div class="result">
                            <p>Résultat :</p>
                            <?php
                            $i = 1;
                            while ($i <= 5) {
                                echo "Itération $i<br>";
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header while-header">Cas d'utilisation</div>
                    <div class="example-content">
                        <p>La boucle while est idéale quand :</p>
                        <ul>
                            <li>Le nombre d'itérations n'est pas connu à l'avance</li>
                            <li>On dépend d'une condition externe (comme une saisie utilisateur)</li>
                            <li>On traite des données jusqu'à atteindre une condition d'arrêt</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="warning-box">
                <strong>Attention !</strong> Assurez-vous toujours que la condition de votre boucle while finira par devenir fausse, sinon vous créerez une boucle infinie qui pourrait bloquer votre script.
            </div>
            <section class="section">
                <h2>La boucle do-while</h2>
                <p>La boucle do-while exécute un bloc de code au moins une fois, puis continue tant qu'une condition est vraie.</p>

                <div class="examples-grid">
                    <div class="example">
                        <div class="example-header do-while-header">Syntaxe de base</div>
                        <div class="example-content">
                            <pre><code><span class="keyword">do</span> {
    <span class="comment">// Code à exécuter au moins une fois</span>
    <span class="comment">// et tant que la condition est vraie</span>
} <span class="keyword">while</span> (condition);</code></pre>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header do-while-header">Exemple standard</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$j</span> = <span class="number">1</span>;
<span class="keyword">do</span> {
    <span class="keyword">echo</span> <span class="string">"Itération $j&lt;br&gt;"</span>;
    <span class="variable">$j</span>++;
} <span class="keyword">while</span> (<span class="variable">$j</span> <= <span class="number">5</span>);</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $j = 1;
                                do {
                                    echo "Itération $j<br>";
                                    $j++;
                                } while ($j <= 5);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header do-while-header">Exécution assurée</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$h</span> = <span class="number">1</span>;
<span class="keyword">do</span> {
    <span class="keyword">echo</span> <span class="string">"Itération $h&lt;br&gt;"</span>;
    <span class="variable">$h</span>++;
} <span class="keyword">while</span> (<span class="variable">$h</span> <= <span class="number">0</span>);</code></pre>
                            <div class="result">
                                <p>Résultat (s'exécute une fois même si condition fausse) :</p>
                                <?php
                                $h = 1;
                                do {
                                    echo "Itération $h<br>";
                                    $h++;
                                } while ($h <= 0);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tip-box">
                    <strong>Conseil :</strong> Utilisez do-while lorsque vous voulez garantir qu'un bloc de code s'exécute au moins une fois avant de vérifier la condition.
                </div>
            </section>
            <section class="section">
                <h2>La boucle for</h2>
                <p>La boucle for est utilisée pour exécuter un bloc de code un nombre spécifique de fois. Elle est idéale quand vous connaissez à l'avance le nombre d'itérations.</p>

                <div class="examples-grid">
                    <div class="example">
                        <div class="example-header for-header">Syntaxe de base</div>
                        <div class="example-content">
                            <pre><code><span class="keyword">for</span> (initialisation; condition; incrémentation) {
    <span class="comment">// Code à exécuter à chaque itération</span>
}</code></pre>
                            <p>Où :</p>
                            <ul>
                                <li><strong>initialisation</strong> : expression exécutée avant la première itération</li>
                                <li><strong>condition</strong> : évaluée à chaque itération, la boucle continue si vraie</li>
                                <li><strong>incrémentation</strong> : exécutée après chaque itération</li>
                            </ul>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header for-header">Exemple simple</div>
                        <div class="example-content">
                            <pre><code><span class="keyword">for</span> (<span class="variable">$k</span> = <span class="number">1</span>; <span class="variable">$k</span> <= <span class="number">5</span>; <span class="variable">$k</span>++) {
    <span class="keyword">echo</span> <span class="string">"Itération $k&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                for ($k = 1; $k <= 5; $k++) {
                                    echo "Itération $k<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Contrôle du flux avec break et continue</h3>

                <div class="examples-grid">
                    <div class="example">
                        <div class="example-header for-header">Utilisation de break</div>
                        <div class="example-content">
                            <pre><code><span class="keyword">for</span> (<span class="variable">$k</span> = <span class="number">1</span>; <span class="variable">$k</span> <= <span class="number">5</span>; <span class="variable">$k</span>++) {
    <span class="keyword">echo</span> <span class="string">"Itération $k&lt;br&gt;"</span>;
    <span class="keyword">if</span> (<span class="variable">$k</span> == <span class="number">3</span>) {
        <span class="keyword">echo</span> <span class="string">"On a atteint l'itération 3, on sort de la boucle.&lt;br&gt;"</span>;
        <span class="keyword">break</span>; <span class="comment">// Sort de la boucle</span>
    }
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                for ($k = 1; $k <= 5; $k++) {
                                    echo "Itération $k<br>";
                                    if ($k == 3) {
                                        echo "On a atteint l'itération 3, on sort de la boucle.<br>";
                                        break; // Sort de la boucle si k est égal à 3
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header for-header">Utilisation de continue</div>
                        <div class="example-content">
                            <pre><code><span class="keyword">for</span> (<span class="variable">$l</span> = <span class="number">1</span>; <span class="variable">$l</span> <= <span class="number">5</span>; <span class="variable">$l</span>++) {
    <span class="keyword">if</span> (<span class="variable">$l</span> == <span class="number">3</span>) {
        <span class="keyword">echo</span> <span class="string">"On saute l'itération 3.&lt;br&gt;"</span>;
        <span class="keyword">continue</span>; <span class="comment">// Saute l'itération</span>
    }
    <span class="keyword">echo</span> <span class="string">"Itération $l&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                for ($l = 1; $l <= 5; $l++) {
                                    if ($l == 3) {
                                        echo "On saute l'itération 3.<br>";
                                        continue; // Saute l'itération si l est égal à 3
                                    }
                                    echo "Itération $l<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-box">
                    <strong>Quand utiliser la boucle for :</strong>
                    <ul>
                        <li>Quand vous connaissez à l'avance le nombre d'itérations</li>
                        <li>Pour parcourir des tableaux avec un index numérique</li>
                        <li>Pour exécuter un code un nombre précis de fois</li>
                    </ul>
                </div>
            </section>
            <section class="section">
                <h2>La boucle foreach</h2>
                <p>La boucle foreach est spécialement conçue pour itérer sur les éléments d'un tableau ou d'un objet. C'est la méthode la plus simple et la plus lisible pour parcourir des collections en PHP.</p>

                <div class="examples-grid">
                    <div class="example">
                        <div class="example-header foreach-header">Syntaxe de base (valeurs)</div>
                        <div class="example-content">
                            <pre><code><span class="keyword">foreach</span> (<span class="variable">$tableau</span> as <span class="variable">$valeur</span>) {
    <span class="comment">// Code utilisant $valeur</span>
}</code></pre>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header foreach-header">Syntaxe avec clé et valeur</div>
                        <div class="example-content">
                            <pre><code><span class="keyword">foreach</span> (<span class="variable">$tableau</span> as <span class="variable">$cle</span> => <span class="variable">$valeur</span>) {
    <span class="comment">// Code utilisant $cle et $valeur</span>
}</code></pre>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header foreach-header">Exemple simple</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$fruits</span> = <span class="string">["Pomme", "Banane", "Orange"]</span>;
<span class="keyword">foreach</span> (<span class="variable">$fruits</span> as <span class="variable">$fruit</span>) {
    <span class="keyword">echo</span> <span class="string">"Fruit: $fruit&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $fruits = ["Pomme", "Banane", "Orange"];
                                foreach ($fruits as $fruit) {
                                    echo "Fruit: $fruit<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header foreach-header">Avec tableau associatif</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$personnes</span> = [
    <span class="string">"Alice"</span> => <span class="number">25</span>,
    <span class="string">"Bob"</span> => <span class="number">30</span>,
    <span class="string">"Charlie"</span> => <span class="number">35</span>
];
<span class="keyword">foreach</span> (<span class="variable">$personnes</span> as <span class="variable">$nom</span> => <span class="variable">$age</span>) {
    <span class="keyword">echo</span> <span class="string">"$nom a $age ans.&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $personnes = [
                                    "Alice" => 25,
                                    "Bob" => 30,
                                    "Charlie" => 35
                                ];
                                foreach ($personnes as $nom => $age) {
                                    echo "$nom a $age ans.<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tip-box">
                    <strong>Conseil :</strong> La boucle foreach est généralement plus rapide et plus lisible que d'autres méthodes pour parcourir des tableaux en PHP. C'est la méthode recommandée pour la plupart des cas d'utilisation.
                </div>
            </section>

            <section class="section">
                <h2>Comparaison des boucles</h2>
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Type de boucle</th>
                            <th>Cas d'utilisation idéal</th>
                            <th>Avantages</th>
                            <th>Inconvénients</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>while</strong></td>
                            <td>Quand le nombre d'itérations n'est pas connu à l'avance</td>
                            <td>Simple, flexible</td>
                            <td>Risque de boucle infinie si mal conçue</td>
                        </tr>
                        <tr>
                            <td><strong>do-while</strong></td>
                            <td>Quand vous voulez exécuter le code au moins une fois</td>
                            <td>Garantit au moins une exécution</td>
                            <td>Moins couramment utilisée</td>
                        </tr>
                        <tr>
                            <td><strong>for</strong></td>
                            <td>Quand le nombre d'itérations est connu</td>
                            <td>Structure compacte, contrôle précis</td>
                            <td>Peut être moins lisible pour les débutants</td>
                        </tr>
                        <tr>
                            <td><strong>foreach</strong></td>
                            <td>Pour parcourir des tableaux et des objets</td>
                            <td>Très lisible, spécialement conçue pour les collections</td>
                            <td>Moins flexible pour les manipulations d'index</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="section">
                <h2>Exercices pratiques</h2>
                <p>Explorez ces exemples pratiques pour maîtriser les différentes boucles en PHP.</p>

                <div class="examples-grid">
                    <div class="example">
                        <div class="example-header exercise-header">Foreach avec tableau simple</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$nombres</span> = <span class="function">range</span>(<span class="number">1</span>, <span class="number">10</span>);
<span class="keyword">foreach</span> (<span class="variable">$nombres</span> as <span class="variable">$nombre</span>) {
    <span class="keyword">echo</span> <span class="string">"Nombre: $nombre&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $nombres = range(1, 10);
                                foreach ($nombres as $nombre) {
                                    echo "Nombre: $nombre<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header exercise-header">Foreach avec tableau associatif</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$pays_capitales</span> = [
    <span class="string">"France"</span> => <span class="string">"Paris"</span>,
    <span class="string">"Espagne"</span> => <span class="string">"Madrid"</span>,
    <span class="string">"Italie"</span> => <span class="string">"Rome"</span>
];
<span class="keyword">foreach</span> (<span class="variable">$pays_capitales</span> as <span class="variable">$pays</span> => <span class="variable">$capitale</span>) {
    <span class="keyword">echo</span> <span class="string">"La capitale de $pays est $capitale.&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $pays_capitales = [
                                    "France" => "Paris",
                                    "Espagne" => "Madrid",
                                    "Italie" => "Rome"
                                ];
                                foreach ($pays_capitales as $pays => $capitale) {
                                    echo "La capitale de $pays est $capitale.<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="examples-grid">
                    <div class="example">
                        <div class="example-header exercise-header">For avec tableau</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$fruits</span> = <span class="string">["Pomme", "Banane", "Orange", "Fraise", "Kiwi"]</span>;
<span class="keyword">for</span> (<span class="variable">$m</span> = <span class="number">0</span>; <span class="variable">$m</span> < <span class="function">count</span>(<span class="variable">$fruits</span>); <span class="variable">$m</span>++) {
    <span class="keyword">echo</span> <span class="string">"Fruit: "</span> . <span class="variable">$fruits</span>[<span class="variable">$m</span>] . <span class="string">"&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $fruits = ["Pomme", "Banane", "Orange", "Fraise", "Kiwi"];
                                for ($m = 0; $m < count($fruits); $m++) {
                                    echo "Fruit: " . $fruits[$m] . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header exercise-header">While avec filtrage</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$nombres_pairs</span> = <span class="function">range</span>(<span class="number">1</span>, <span class="number">20</span>);
<span class="variable">$index</span> = <span class="number">0</span>;
<span class="keyword">while</span> (<span class="variable">$index</span> < <span class="function">count</span>(<span class="variable">$nombres_pairs</span>)) {
    <span class="keyword">if</span> (<span class="variable">$nombres_pairs</span>[<span class="variable">$index</span>] % <span class="number">2</span> == <span class="number">0</span>) {
        <span class="keyword">echo</span> <span class="string">"Nombre pair: "</span> . <span class="variable">$nombres_pairs</span>[<span class="variable">$index</span>] . <span class="string">"&lt;br&gt;"</span>;
    }
    <span class="variable">$index</span>++;
}</code></pre>
                            <div class="result">
                                <p>Résultat (nombres pairs uniquement) :</p>
                                <?php
                                $nombres_pairs = range(1, 20);
                                $index = 0;
                                while ($index < count($nombres_pairs)) {
                                    if ($nombres_pairs[$index] % 2 == 0) {
                                        echo "Nombre pair: " . $nombres_pairs[$index] . "<br>";
                                    }
                                    $index++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="examples-grid">
                    <div class="example">
                        <div class="example-header exercise-header">Do-while avec tableau</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$prenoms</span> = <span class="string">["Alice", "Bob", "Charlie", "David"]</span>;
<span class="variable">$index</span> = <span class="number">0</span>;
<span class="keyword">do</span> {
    <span class="keyword">if</span> (<span class="variable">$index</span> < <span class="function">count</span>(<span class="variable">$prenoms</span>)) {
        <span class="keyword">echo</span> <span class="string">"Prénom: "</span> . <span class="variable">$prenoms</span>[<span class="variable">$index</span>] . <span class="string">"&lt;br&gt;"</span>;
    }
    <span class="variable">$index</span>++;
} <span class="keyword">while</span> (<span class="variable">$index</span> < <span class="function">count</span>(<span class="variable">$prenoms</span>));</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $prenoms = ["Alice", "Bob", "Charlie", "David"];
                                $index = 0;
                                do {
                                    if ($index < count($prenoms)) {
                                        echo "Prénom: " . $prenoms[$index] . "<br>";
                                    }
                                    $index++;
                                } while ($index < count($prenoms));
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="example">
                        <div class="example-header exercise-header">For avec continue</div>
                        <div class="example-content">
                            <pre><code><span class="variable">$couleurs</span> = <span class="string">["Rouge", "Vert", "Bleu", "Jaune", "Orange"]</span>;
<span class="keyword">for</span> (<span class="variable">$n</span> = <span class="number">0</span>; <span class="variable">$n</span> < <span class="function">count</span>(<span class="variable">$couleurs</span>); <span class="variable">$n</span>++) {
    <span class="keyword">if</span> (<span class="variable">$couleurs</span>[<span class="variable">$n</span>] == <span class="string">"Vert"</span>) {
        <span class="keyword">echo</span> <span class="string">"On saute la couleur Verte.&lt;br&gt;"</span>;
        <span class="keyword">continue</span>; <span class="comment">// Saute l'itération</span>
    }
    <span class="keyword">echo</span> <span class="string">"Couleur: "</span> . <span class="variable">$couleurs</span>[<span class="variable">$n</span>] . <span class="string">"&lt;br&gt;"</span>;
}</code></pre>
                            <div class="result">
                                <p>Résultat :</p>
                                <?php
                                $couleurs = ["Rouge", "Vert", "Bleu", "Jaune", "Orange"];
                                for ($n = 0; $n < count($couleurs); $n++) {
                                    if ($couleurs[$n] == "Vert") {
                                        echo "On saute la couleur Verte.<br>";
                                        continue; // Saute l'itération si la couleur est Verte
                                    }
                                    echo "Couleur: " . $couleurs[$n] . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header exercise-header">Foreach avec index</div>
                    <div class="example-content">
                        <pre><code><span class="variable">$villes</span> = <span class="string">["Paris", "Londres", "Berlin", "Madrid"]</span>;
<span class="keyword">foreach</span> (<span class="variable">$villes</span> as <span class="variable">$index</span> => <span class="variable">$ville</span>) {
    <span class="keyword">echo</span> <span class="string">"Ville $index: $ville&lt;br&gt;"</span>;
}</code></pre>
                        <div class="result">
                            <p>Résultat :</p>
                            <?php
                            $villes = ["Paris", "Londres", "Berlin", "Madrid"];
                            foreach ($villes as $index => $ville) {
                                echo "Ville $index: $ville<br>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section">
                <h2>Bonnes pratiques</h2>
                <ul>
                    <li><strong>Choisir la bonne boucle</strong> : Utilisez foreach pour les tableaux, for quand vous connaissez le nombre d'itérations, while pour les conditions dynamiques.</li>
                    <li><strong>Éviter les boucles infinies</strong> : Assurez-vous toujours d'avoir une condition de sortie qui sera atteinte.</li>
                    <li><strong>Performance</strong> : Pour les grands tableaux, évitez d'appeler count() à chaque itération dans une boucle for.</li>
                    <li><strong>Lisibilité</strong> : Préférez foreach quand c'est possible, c'est généralement plus lisible et moins sujet aux erreurs.</li>
                    <li><strong>Imbrication</strong> : Limitez l'imbrication des boucles pour garder votre code maintenable.</li>
                </ul>
            </section>

            <div class="navigation">
                <a href="03-les-conditions.php" class="nav-button">← Module précédent</a>
                <a href="../../index.php" class="nav-button">Accueil</a>
                <a href="05-les-fonctions.php" class="nav-button">Module suivant →</a>
            </div>
    </main>
</body>

</html>