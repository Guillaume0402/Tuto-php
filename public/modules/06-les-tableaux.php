<?php include __DIR__ . '/../includes/header.php';



// Tableaux pour les exemples
// Tableau indexé numériquement
$tableau = array("pomme", 12, 34, true);
$notes = [12, 15, 18, 20, 10];
$notes[] = 14; // Ajoute 14 à la fin du tableau

// Tableau associatif
$moyenne = [
    "maths" => 15,
    "français" => 12,
    "histoire" => 18
];

// Tableau à 2 dimensions
$acteurs = [
    ["Alain", "Dany", "Gérard"],
    ["DELON", "BOON", "DEPARDIEU"]
];

// Un tableau multidimensionnel
$eleves = [
    [
        "nom" => "Dupont",
        "prenom" => "Jean",
        "age" => 16
    ],
    [
        "nom" => "Martin",
        "prenom" => "Sophie",
        "age" => 17
    ],
    [
        "nom" => "Durand",
        "prenom" => "Pierre",
        "age" => 15
    ],
    [
        "nom" => "Lefebvre",
        "prenom" => "Marie",
        "age" => 18
    ],
    [
        "nom" => "Moreau",
        "prenom" => "Lucie",
        "age" => 16
    ]
];

// Exemple avancé pour la section "Opérations combinées"
$nombres = range(1, 10);

// Fonctions utilitaires pour les tableaux
function afficherTableau($tableau, $nom = "tableau")
{
    $output = "<div class='result'>";
    $output .= "<p>Contenu du $nom :</p>";
    $output .= "<pre class='array-result force-light'>" . print_r($tableau, true) . "</pre>";
    $output .= "</div>";
    return $output;
}

// Fonction pour générer un badge avec une information de complexité
function afficherComplexite($niveau, $explication)
{
    $class = '';
    switch ($niveau) {
        case 'Facile':
            $class = 'badge-success';
            break;
        case 'Intermédiaire':
            $class = 'badge-warning';
            break;
        case 'Avancé':
            $class = 'badge-danger';
            break;
    }
    return "<span class='badge $class'>$niveau</span> <span class='complexity-info'>$explication</span>";
}
?>



<body class="module6">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </header>
    <div class="navigation">
        <a href="05-les-fonctions.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="07-fonctions-natives.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction aux tableaux</h2>
            <p>Les tableaux sont des structures de données qui permettent de stocker plusieurs valeurs dans une seule variable. En PHP, les tableaux sont extrêmement flexibles et peuvent contenir différents types de données.</p>

            <div class="info-box">
                <strong>Types de tableaux en PHP :</strong>
                <ul>
                    <li><strong>Tableaux indexés numériquement</strong> : Les éléments sont accessibles par un index numérique</li>
                    <li><strong>Tableaux associatifs</strong> : Les éléments sont accessibles par des clés textuelles</li>
                    <li><strong>Tableaux multidimensionnels</strong> : Des tableaux contenant d'autres tableaux</li>
                </ul>
            </div>
        </section>

        <section class="section">
            <h2>Tableaux indexés numériquement</h2>
            <p>Les tableaux indexés numériquement utilisent des nombres comme indices pour accéder aux valeurs. Par défaut, l'indexation commence à 0.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header indexed-header">Création d'un tableau</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Ancienne syntaxe</span>
<span class="variable">$tableau</span> <span class="operator">=</span> <span class="function">array</span>(<span class="string">"pomme"</span>, <span class="number">12</span>, <span class="number">34</span>, <span class="keyword">true</span>);

<span class="comment">// Nouvelle syntaxe (PHP 5.4+)</span>
<span class="variable">$notes</span> <span class="operator">=</span> [<span class="number">12</span>, <span class="number">15</span>, <span class="number">18</span>, <span class="number">20</span>, <span class="number">10</span>];</code></pre>
                        <div class="result">
                            <p>Les tableaux indexés peuvent contenir des types de données mixtes.</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header indexed-header">Accès aux éléments</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$notes</span> <span class="operator">=</span> [<span class="number">12</span>, <span class="number">15</span>, <span class="number">18</span>, <span class="number">20</span>, <span class="number">10</span>];

<span class="comment">// Accès au premier élément</span>
<span class="keyword">echo</span> <span class="variable">$notes</span>[<span class="number">0</span>]; <span class="comment">// Affiche 12</span>

<span class="comment">// Accès au troisième élément</span>
<span class="keyword">echo</span> <span class="variable">$notes</span>[<span class="number">2</span>]; <span class="comment">// Affiche 18</span></code></pre>
                        <div class="result">
                            <p>Premier élément : <?= $notes[0] ?></p>
                            <p>Troisième élément : <?= $notes[2] ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header indexed-header">Modification et ajout</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Modification d'un élément existant</span>
$notes[1] = 16; <span class="comment">// Change 15 en 16</span>

<span class="comment">// Ajout d'un élément à la fin</span>
$notes[] = 14; <span class="comment">// Ajoute 14 à la fin</span></code></pre>
                        <div class="result">
                            <?php
                            $notesCopie = $notes;
                            $notesCopie[1] = 16;
                            echo afficherTableau($notesCopie, "tableau modifié");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Tableaux associatifs</h2>
            <p>Les tableaux associatifs utilisent des chaînes de caractères comme clés au lieu d'indices numériques, ce qui les rend plus descriptifs et lisibles.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header associative-header">Création d'un tableau associatif</div>
                    <div class="example-content">
                        <pre><code>$moyenne = [
    <span class="string">"maths"</span> => 15,
    <span class="string">"français"</span> => 12,
    <span class="string">"histoire"</span> => 18
];</code></pre>
                        <?= afficherTableau($moyenne, "tableau associatif") ?>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header associative-header">Accès aux éléments</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Accès par clé</span>
<span class="keyword">echo</span> $moyenne[<span class="string">"maths"</span>]; <span class="comment">// Affiche 15</span>
<span class="keyword">echo</span> $moyenne[<span class="string">"histoire"</span>]; <span class="comment">// Affiche 18</span></code></pre>
                        <div class="result">
                            <p>Note en maths : <?= $moyenne["maths"] ?></p>
                            <p>Note en histoire : <?= $moyenne["histoire"] ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header associative-header">Modification et ajout</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Modifier une valeur existante</span>
<span class="variable">$moyenne</span>[<span class="string">"français"</span>] <span class="operator">=</span> <span class="number">14</span>;

<span class="comment">// Ajouter une nouvelle matière</span>
<span class="variable">$moyenne</span>[<span class="string">"anglais"</span>] <span class="operator">=</span> <span class="number">16</span>;</code></pre>
                        <div class="result">
                            <?php
                            $moyenneCopie = $moyenne;
                            $moyenneCopie["français"] = 14;
                            $moyenneCopie["anglais"] = 16;
                            echo afficherTableau($moyenneCopie, "tableau modifié");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Tableaux multidimensionnels</h2>
            <p>Les tableaux multidimensionnels sont des tableaux contenant d'autres tableaux. Ils permettent de représenter des données complexes et structurées.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header multidimensional-header">Tableau à deux dimensions</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="variable">$acteurs</span> <span class="operator">=</span> [
    [<span class="string">"Alain"</span>, <span class="string">"Dany"</span>, <span class="string">"Gérard"</span>],
    [<span class="string">"DELON"</span>, <span class="string">"BOON"</span>, <span class="string">"DEPARDIEU"</span>]
];</code></pre>
                        <?= afficherTableau($acteurs, "tableau à deux dimensions") ?>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header multidimensional-header">Accès aux éléments</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Accès avec indices numériques</span>
<span class="keyword">echo</span> <span class="variable">$acteurs</span>[<span class="number">0</span>][<span class="number">1</span>]; <span class="comment">// Affiche Dany</span>
<span class="keyword">echo</span> <span class="variable">$acteurs</span>[<span class="number">1</span>][<span class="number">2</span>]; <span class="comment">// Affiche DEPARDIEU</span></code></pre>
                        <div class="result">
                            <p>Prénom du deuxième acteur : <?= $acteurs[0][1] ?></p>
                            <p>Nom du troisième acteur : <?= $acteurs[1][2] ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header multidimensional-header">Tableau associatif multidimensionnel</div>
                    <div class="example-content">
                        <pre><code>$eleves = [
    [
        <span class="string">"nom"</span> => <span class="string">"Dupont"</span>,
        <span class="string">"prenom"</span> => <span class="string">"Jean"</span>,
        <span class="string">"age"</span> => 16
    ],
    [
        <span class="string">"nom"</span> => <span class="string">"Martin"</span>,
        <span class="string">"prenom"</span> => <span class="string">"Sophie"</span>,
        <span class="string">"age"</span> => 17
    ]
];</code></pre>
                        <div class="result">
                            <p>Prénom du premier élève : <?= $eleves[0]["prenom"] ?></p>
                            <p>Âge du deuxième élève : <?= $eleves[1]["age"] ?> ans</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header multidimensional-header">Parcours d'un tableau multidimensionnel</div>
                <div class="example-content">
                    <pre><code><span class="keyword">foreach</span> ($eleves <span class="keyword">as</span> $eleve) {
    <span class="keyword">echo</span> <span class="string">"Élève "</span> . $eleve[<span class="string">"prenom"</span>] . <span class="string">" "</span> . $eleve[<span class="string">"nom"</span>] . 
         <span class="string">", Age: "</span> . $eleve[<span class="string">"age"</span>] . <span class="string">" ans."</span> . <span class="string">"&lt;br&gt;"</span>;
}</code></pre>
                    <div class="result">
                        <?php
                        foreach ($eleves as $eleve) {
                            echo "Élève " . $eleve["prenom"] . " " . $eleve["nom"] . ", Age: " . $eleve["age"] . " ans.<br>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Opérations sur les tableaux</h2>
            <p>PHP offre de nombreuses fonctions intégrées pour manipuler les tableaux efficacement.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header operation-header">Parcourir un tableau</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Avec foreach</span>
<span class="keyword">foreach</span> ($notes <span class="keyword">as</span> $note) {
    <span class="keyword">echo</span> <span class="string">"Note : $note &lt;br&gt;"</span>;
}

<span class="comment">// Avec foreach et l'index</span>
<span class="keyword">foreach</span> ($notes <span class="keyword">as</span> $index => $note) {
    <span class="keyword">echo</span> <span class="string">"Note $index : $note &lt;br&gt;"</span>;
}</code></pre>
                        <div class="result">
                            <?php
                            foreach ($notes as $index => $note) {
                                echo "Note $index : $note<br>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header operation-header">Compter les éléments</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Nombre total d'éléments</span>
$nbNotes = <span class="function">count</span>($notes);
<span class="keyword">echo</span> <span class="string">"Nombre de notes : $nbNotes"</span>;</code></pre>
                        <div class="result">
                            <p>Nombre de notes : <?= count($notes) ?></p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header operation-header">Rechercher dans un tableau</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Vérifier si une valeur existe</span>
<span class="keyword">if</span> (<span class="function">in_array</span>(15, $notes)) {
    <span class="keyword">echo</span> <span class="string">"La note 15 existe"</span>;
}

<span class="comment">// Rechercher une clé</span>
$cleHistoire = <span class="function">array_key_exists</span>(<span class="string">"histoire"</span>, $moyenne);</code></pre>
                        <div class="result">
                            <p>La note 15 existe dans le tableau : <?= in_array(15, $notes) ? 'Oui' : 'Non' ?></p>
                            <p>La clé "histoire" existe : <?= array_key_exists("histoire", $moyenne) ? 'Oui' : 'Non' ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header operation-header">Trier un tableau</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Tri croissant</span>
<span class="function">sort</span>($notes);

<span class="comment">// Tri décroissant</span>
<span class="function">rsort</span>($notes);

<span class="comment">// Tri associatif par valeur</span>
<span class="function">asort</span>($moyenne);

<span class="comment">// Tri associatif par clé</span>
<span class="function">ksort</span>($moyenne);</code></pre>
                        <div class="result">
                            <?php
                            $notesCopie = $notes;
                            sort($notesCopie);
                            echo "Notes triées (croissant) : " . implode(", ", $notesCopie) . "<br>";

                            rsort($notesCopie);
                            echo "Notes triées (décroissant) : " . implode(", ", $notesCopie) . "<br>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header operation-header">Filtrer un tableau</div>
                    <div class="example-content">
                        <pre><code>$notesFiltrees = <span class="function">array_filter</span>($notes, <span class="keyword">function</span>($note) {
    <span class="keyword">return</span> $note >= 15; <span class="comment">// Notes >= 15</span>
});</code></pre>
                        <div class="result">
                            <?php
                            $notesFiltrees = array_filter($notes, function ($note) {
                                return $note >= 15;
                            });
                            echo "Notes ≥ 15 : " . implode(", ", $notesFiltrees);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header operation-header">Transformer un tableau</div>
                    <div class="example-content">
                        <pre><code>$notesDoublees = <span class="function">array_map</span>(<span class="keyword">function</span>($note) {
    <span class="keyword">return</span> $note * 2;
}, $notes);</code></pre>
                        <div class="result">
                            <?php
                            $notesDoublees = array_map(function ($note) {
                                return $note * 2;
                            }, $notes);
                            echo "Notes doublées : " . implode(", ", $notesDoublees);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Fonctions utiles pour les tableaux</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Fonction</th>
                        <th>Description</th>
                        <th>Exemple</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>array_push()</code></td>
                        <td>Ajoute un ou plusieurs éléments à la fin d'un tableau</td>
                        <td><code>array_push($notes, 17, 19);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_pop()</code></td>
                        <td>Extrait et retourne le dernier élément d'un tableau</td>
                        <td><code>$dernierElement = array_pop($notes);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_shift()</code></td>
                        <td>Extrait et retourne le premier élément d'un tableau</td>
                        <td><code>$premierElement = array_shift($notes);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_unshift()</code></td>
                        <td>Ajoute un ou plusieurs éléments au début d'un tableau</td>
                        <td><code>array_unshift($notes, 8, 9);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_merge()</code></td>
                        <td>Fusionne plusieurs tableaux en un seul</td>
                        <td><code>$tousLesNotes = array_merge($notesA, $notesB);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_slice()</code></td>
                        <td>Extrait une portion d'un tableau</td>
                        <td><code>$portion = array_slice($notes, 2, 3);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_sum()</code></td>
                        <td>Calcule la somme des valeurs d'un tableau</td>
                        <td><code>$somme = array_sum($notes);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_keys()</code></td>
                        <td>Retourne toutes les clés d'un tableau</td>
                        <td><code>$matieres = array_keys($moyenne);</code></td>
                    </tr>
                    <tr>
                        <td><code>array_values()</code></td>
                        <td>Retourne toutes les valeurs d'un tableau</td>
                        <td><code>$valeurs = array_values($moyenne);</code></td>
                    </tr>
                    <tr>
                        <td><code>implode()</code></td>
                        <td>Joint les éléments d'un tableau en une chaîne</td>
                        <td><code>$liste = implode(", ", $notes);</code></td>
                    </tr>
                    <tr>
                        <td><code>explode()</code></td>
                        <td>Convertit une chaîne en tableau en la divisant selon un séparateur</td>
                        <td><code>$mots = explode(" ", $phrase);</code></td>
                    </tr>
                    <tr>
                        <td><code>count()</code></td>
                        <td>Compte le nombre d'éléments dans un tableau</td>
                        <td><code>$nbNotes = count($notes);</code></td>
                    </tr>
                    <tr>
                        <td><code>in_array()</code></td>
                        <td>Vérifie si une valeur existe dans un tableau</td>
                        <td><code>if (in_array(15, $notes)) { ... }</code></td>
                    </tr>
                    <tr>
                        <td><code>array_search()</code></td>
                        <td>Recherche une valeur dans un tableau et retourne sa clé</td>
                        <td><code>$index = array_search(15, $notes);</code></td>
                    </tr>
                    <tr>
                        <td><code>sort()</code></td>
                        <td>Trie un tableau par ordre croissant</td>
                        <td><code>sort($notes);</code></td>
                    </tr>
                    <tr>
                        <td><code>rsort()</code></td>
                        <td>Trie un tableau par ordre décroissant</td>
                        <td><code>rsort($notes);</code></td>
                    </tr>
                </tbody>
            </table>

            <div class="example">
                <div class="example-header primary-header">Exemple combinant plusieurs fonctions</div>
                <div class="example-content">
                    <pre><code><span class="comment">// Créer un tableau</span>
$nombres = <span class="function">range</span>(1, 10);

<span class="comment">// Filtrer les nombres pairs</span>
$pairs = <span class="function">array_filter</span>($nombres, <span class="keyword">function</span>($n) {
    <span class="keyword">return</span> $n % 2 == 0;
});

<span class="comment">// Doubler chaque nombre pair</span>
$pairsDoubles = <span class="function">array_map</span>(<span class="keyword">function</span>($n) {
    <span class="keyword">return</span> $n * 2;
}, $pairs);

<span class="comment">// Calculer la somme</span>
$somme = <span class="function">array_sum</span>($pairsDoubles);

<span class="comment">// Joindre en chaîne</span>
$resultat = <span class="function">implode</span>(<span class="string">" + "</span>, $pairsDoubles) . <span class="string">" = "</span> . $somme;</code></pre>
                    <div class="result">
                        <?php
                        $nombres = range(1, 10);
                        $pairs = array_filter($nombres, function ($n) {
                            return $n % 2 == 0;
                        });
                        $pairsDoubles = array_map(function ($n) {
                            return $n * 2;
                        }, $pairs);
                        $somme = array_sum($pairsDoubles);
                        $resultat = implode(" + ", $pairsDoubles) . " = " . $somme;
                        echo "<p>$resultat</p>";
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Bonnes pratiques</h2>
            <ul>
                <li><strong>Utiliser la nouvelle syntaxe</strong> : Préférez <code>[]</code> à <code>array()</code> pour plus de lisibilité (PHP 5.4+).</li>
                <li><strong>Nommer clairement les clés</strong> : Des noms significatifs rendent votre code plus maintenable.</li>
                <li><strong>Préférer foreach</strong> : Pour parcourir les tableaux, <code>foreach</code> est généralement plus clair et moins sujet aux erreurs.</li>
                <li><strong>Vérifier l'existence</strong> : Utilisez <code>isset()</code> ou <code>array_key_exists()</code> avant d'accéder à un élément.</li>
                <li><strong>Utiliser les fonctions intégrées</strong> : PHP dispose de nombreuses fonctions optimisées pour manipuler les tableaux.</li>
                <li><strong>Attention à la mémoire</strong> : Les tableaux volumineux peuvent consommer beaucoup de mémoire, surtout avec les fonctions comme <code>array_map</code>.</li>
                <li><strong>Documenter la structure</strong> : Pour les tableaux complexes, documentez leur structure pour faciliter la maintenance.</li>
                <li><strong>Éviter les indices numériques implicites</strong> : Soyez explicite dans la définition des indices pour éviter les erreurs silencieuses.</li>
                <li><strong>Considérer l'utilisation d'objets</strong> : Pour les structures complexes, les objets peuvent offrir une meilleure organisation et des méthodes dédiées.</li>
                <li><strong>Tester les bords de tableau</strong> : Utilisez <code>end()</code>, <code>reset()</code>, <code>current()</code> et <code>key()</code> pour manipuler les pointeurs de tableaux.</li>
            </ul>

            <div class="tip-box">
                <strong>Conseil :</strong> Pour des opérations complexes, il est souvent plus efficace d'utiliser les fonctions intégrées de PHP que d'écrire vos propres boucles. Les fonctions comme <code>array_map()</code>, <code>array_filter()</code> et <code>array_reduce()</code> vous permettent d'écrire un code plus concis et souvent plus performant.
            </div>

            <div class="info-box">
                <strong>Pour aller plus loin :</strong> La connaissance approfondie des tableaux est essentielle en PHP, car ils constituent la structure de données fondamentale utilisée dans de nombreux aspects du langage. Maîtriser les fonctions de manipulation de tableaux peut considérablement améliorer l'efficacité et la lisibilité de votre code.
            </div>

            <div class="warning-box">
                <strong>Attention :</strong> Les opérations sur les tableaux peuvent être gourmandes en ressources, surtout avec de grands volumes de données. Pour les applications nécessitant des performances optimales, envisagez d'utiliser des structures de données alternatives comme SplFixedArray pour les tableaux à taille fixe ou les générateurs pour traiter de grandes quantités de données séquentiellement.
            </div>
        </section>
        <section class="section">
            <h2>Console de démonstration interactive</h2>
            <p>Cette section montre des exemples concrets de manipulation de tableaux en PHP avec leur résultat direct. Vous pouvez observer comment chaque opération modifie les tableaux et quelles sont les valeurs retournées.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header primary-header">Types de tableaux</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Tableau indexé numériquement (simple)</span>
$tableau = <span class="function">array</span>(<span class="string">"pomme"</span>, 12, 34, <span class="keyword">true</span>);
<span class="function">print_r</span>($tableau);

<span class="comment">// Tableau indexé avec nouvelle syntaxe</span>
$notes = [12, 15, 18, 20, 10];
$notes[] = 14; <span class="comment">// Ajoute 14 à la fin</span>
<span class="keyword">echo</span> <span class="string">"Premier élément du tableau notes : "</span> . $notes[0];</code></pre>
                        <div class="result">
                            <?php
                            // Tableau indexé numériquement (simple)
                            $tableau = array("pomme", 12, 34, true);
                            echo "<h4>Tableau indexé numériquement</h4>";
                            echo "<pre>";
                            print_r($tableau);
                            echo "</pre>";

                            // Tableau indexé avec nouvelle syntaxe
                            $notes = [12, 15, 18, 20, 10];
                            $notes[] = 14; // Ajoute 14 à la fin
                            echo "Premier élément du tableau notes : " . $notes[0]; // Affiche 12
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header primary-header">Tableaux associatifs</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Tableau associatif</span>
$moyenne = [
    <span class="string">"maths"</span> => 15,
    <span class="string">"français"</span> => 12,
    <span class="string">"histoire"</span> => 18
];
<span class="keyword">echo</span> <span class="string">"Note en maths : "</span> . $moyenne[<span class="string">"maths"</span>];</code></pre>
                        <div class="result">
                            <?php
                            // Tableau associatif
                            $moyenne = [
                                "maths" => 15,
                                "français" => 12,
                                "histoire" => 18
                            ];
                            echo "<h4>Tableau associatif</h4>";
                            echo "<pre>";
                            print_r($moyenne);
                            echo "</pre>";
                            echo "Note en maths : " . $moyenne["maths"]; // Affiche 15
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header primary-header">Tableaux multidimensionnels</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Tableau à 2 dimensions</span>
$acteurs = [
    [<span class="string">"Alain"</span>, <span class="string">"Dany"</span>, <span class="string">"Gérard"</span>],
    [<span class="string">"DELON"</span>, <span class="string">"BOON"</span>, <span class="string">"DEPARDIEU"</span>]
];
<span class="keyword">echo</span> <span class="string">"Prénom du 2ème acteur : "</span> . $acteurs[0][1];
<span class="keyword">echo</span> <span class="string">"Nom du 3ème acteur : "</span> . $acteurs[1][2];</code></pre>
                        <div class="result">
                            <?php
                            // Tableau à 2 dimensions
                            $acteurs = [
                                ["Alain", "Dany", "Gérard"],
                                ["DELON", "BOON", "DEPARDIEU"]
                            ];
                            echo "<h4>Tableau à deux dimensions</h4>";
                            echo "<pre>";
                            print_r($acteurs);
                            echo "</pre>";
                            echo "Prénom du 2ème acteur : " . $acteurs[0][1] . "<br>"; // Affiche Dany
                            echo "Nom du 3ème acteur : " . $acteurs[1][2]; // Affiche DEPARDIEU
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="example">
                <div class="example-header primary-header">Parcours d'un tableau</div>
                <div class="example-content">
                    <pre><code><span class="comment">// Tableau multidimensionnel associatif</span>
$eleves = [
    [
        <span class="string">"nom"</span> => <span class="string">"Dupont"</span>,
        <span class="string">"prenom"</span> => <span class="string">"Jean"</span>,
        <span class="string">"age"</span> => 16
    ],
    [
        <span class="string">"nom"</span> => <span class="string">"Martin"</span>,
        <span class="string">"prenom"</span> => <span class="string">"Sophie"</span>,
        <span class="string">"age"</span> => 17
    ],
    <span class="comment">// ... autres élèves</span>
];

<span class="comment">// Parcours avec foreach</span>
<span class="keyword">foreach</span> ($eleves <span class="keyword">as</span> $eleve) {
    <span class="keyword">echo</span> <span class="string">"Élève "</span> . $eleve[<span class="string">"prenom"</span>] . <span class="string">" "</span> . $eleve[<span class="string">"nom"</span>] . 
         <span class="string">", Age: "</span> . $eleve[<span class="string">"age"</span>] . <span class="string">" ans."</span> . <span class="string">"&lt;br&gt;"</span>;
}

<span class="comment">// Accès à une valeur spécifique</span>
<span class="keyword">echo</span> <span class="string">"Prénom du premier élève : "</span> . $eleves[0][<span class="string">"prenom"</span>];</code></pre>
                    <div class="result">
                        <?php
                        // Tableau multidimensionnel
                        $eleves = [
                            [
                                "nom" => "Dupont",
                                "prenom" => "Jean",
                                "age" => 16
                            ],
                            [
                                "nom" => "Martin",
                                "prenom" => "Sophie",
                                "age" => 17
                            ],
                            [
                                "nom" => "Durand",
                                "prenom" => "Pierre",
                                "age" => 15
                            ],
                            [
                                "nom" => "Lefebvre",
                                "prenom" => "Marie",
                                "age" => 18
                            ],
                            [
                                "nom" => "Moreau",
                                "prenom" => "Lucie",
                                "age" => 16
                            ]
                        ];

                        // Parcours avec foreach
                        echo "<h4>Parcours d'un tableau associatif multidimensionnel</h4>";
                        foreach ($eleves as $eleve) {
                            echo "Élève " . $eleve["prenom"] . " " . $eleve["nom"] . ", Age: " . $eleve["age"] . " ans." . "<br>";
                        }
                        echo "<br>";

                        // Accès à une valeur spécifique
                        echo "Prénom du premier élève : " . $eleves[0]["prenom"]; // Affiche Jean
                        ?>
                    </div>
                </div>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header primary-header">Opérations de base</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Parcourir avec foreach</span>
<span class="keyword">foreach</span> ($notes <span class="keyword">as</span> $note) {
    <span class="keyword">echo</span> <span class="string">"Note : $note &lt;br&gt;"</span>;
}

<span class="comment">// Comptage d'éléments</span>
<span class="keyword">echo</span> <span class="string">"Nombre de notes : "</span> . <span class="function">count</span>($notes);

<span class="comment">// Recherche de valeur</span>
<span class="keyword">if</span> (<span class="function">in_array</span>(15, $notes)) {
    <span class="keyword">echo</span> <span class="string">"La note 15 existe dans le tableau."</span>;
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"La note 15 n'existe pas dans le tableau."</span>;
}</code></pre>
                        <div class="result">
                            <?php
                            // Parcourir avec foreach
                            echo "<h4>Parcours avec foreach</h4>";
                            foreach ($notes as $note) {
                                echo "Note : $note <br>";
                            }
                            echo "<br>";

                            // Comptage d'éléments
                            echo "<h4>Fonctions utiles</h4>";
                            echo "Nombre de notes : " . count($notes) . "<br><br>";

                            // Recherche de valeur
                            if (in_array(15, $notes)) {
                                echo "La note 15 existe dans le tableau.<br>";
                            } else {
                                echo "La note 15 n'existe pas dans le tableau.<br>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header primary-header">Tri et filtrage</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Tri de tableau</span>
$notesCopie = $notes;
<span class="function">sort</span>($notesCopie); <span class="comment">// Trie le tableau par ordre croissant</span>
<span class="keyword">echo</span> <span class="string">"Notes triées : "</span>;
<span class="keyword">foreach</span> ($notesCopie <span class="keyword">as</span> $note) {
    <span class="keyword">echo</span> <span class="string">"$note "</span>;
}

<span class="comment">// Filtrage de tableau</span>
$notesFiltrees = <span class="function">array_filter</span>($notes, <span class="keyword">function</span>($note) {
    <span class="keyword">return</span> $note >= 15; <span class="comment">// Garde les notes >= 15</span>
});
<span class="keyword">echo</span> <span class="string">"Notes filtrées (>= 15) : "</span>;
<span class="keyword">foreach</span> ($notesFiltrees <span class="keyword">as</span> $note) {
    <span class="keyword">echo</span> <span class="string">"$note "</span>;
}</code></pre>
                        <div class="result">
                            <?php
                            // Tri de tableau
                            echo "<h4>Tri de tableau</h4>";
                            $notesCopie = $notes;
                            sort($notesCopie); // Trie le tableau par ordre croissant
                            echo "Notes triées : ";
                            foreach ($notesCopie as $note) {
                                echo "$note ";
                            }
                            echo "<br><br>";

                            // Filtrage de tableau
                            echo "<h4>Filtrage de tableau</h4>";
                            $notesFiltrees = array_filter($notes, function ($note) {
                                return $note >= 15; // Garde les notes supérieures ou égales à 15
                            });
                            echo "Notes filtrées (>= 15) : ";
                            foreach ($notesFiltrees as $note) {
                                echo "$note ";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header primary-header">Modifications dynamiques</div>
                    <div class="example-content">
                        <pre><code><span class="comment">// Copie pour manipulation</span>
$notesManip = $notes;

<span class="comment">// Ajout d'élément</span>
<span class="keyword">echo</span> <span class="string">"Tableau original : "</span> . <span class="function">implode</span>(<span class="string">", "</span>, $notesManip);
$notesManip[] = 16; <span class="comment">// Ajoute 16 à la fin du tableau</span>
<span class="keyword">echo</span> <span class="string">"Après ajout de 16 : "</span> . <span class="function">implode</span>(<span class="string">", "</span>, $notesManip);

<span class="comment">// Suppression d'élément</span>
<span class="function">unset</span>($notesManip[0]); <span class="comment">// Supprime le premier élément</span>
<span class="function">print_r</span>($notesManip);

<span class="comment">// Réindexation</span>
$notesManip = <span class="function">array_values</span>($notesManip); <span class="comment">// Réindexe le tableau</span>
<span class="function">print_r</span>($notesManip);</code></pre>
                        <div class="result">
                            <?php
                            // 4. MODIFICATIONS DE TABLEAUX
                            echo "<h4>Modifications dynamiques</h4>";

                            // Copie pour manipulation
                            $notesManip = $notes;

                            // Ajout d'élément
                            echo "Tableau original : " . implode(", ", $notesManip) . "<br>";
                            $notesManip[] = 16; // Ajoute 16 à la fin du tableau
                            echo "Après ajout de 16 : " . implode(", ", $notesManip) . "<br><br>";

                            // Suppression d'élément
                            unset($notesManip[0]); // Supprime le premier élément du tableau
                            echo "Après suppression du premier élément : <pre>";
                            print_r($notesManip);
                            echo "</pre>";

                            // Réindexation
                            $notesManip = array_values($notesManip); // Réindexe le tableau
                            echo "Après réindexation : <pre>";
                            print_r($notesManip);
                            echo "</pre>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="navigation">
            <a href="05-les-fonctions.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="07-fonctions-natives.php" class="nav-button">Module suivant →</a>
        </div>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>