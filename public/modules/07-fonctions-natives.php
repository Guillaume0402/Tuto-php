<?php
$moduleClass = 'module7';
include __DIR__ . '/../includes/header.php'; ?>

<body class="module7">
    <header>
        <h1>Les Fonctions Natives PHP</h1>
        <p class="subtitle">Les fonctions natives sont des fonctions prédéfinies dans PHP qui permettent d'effectuer des opérations courantes sans avoir à les coder soi-même.</p>
    </header>
    <div class="navigation">
        <a href="<?= BASE_URL ?>/modules/06-les-tableaux.php" class="nav-button">← Module précédent</a>
        <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>     
        <a href="<?= BASE_URL ?>/modules/08-inclusions.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2 class="strings-section">Chaînes de caractères</h2>
            <p>Les fonctions sur les chaînes de caractères en PHP permettent de manipuler et transformer facilement les textes dans vos applications.</p>

            <div class="info-box">
                <strong>Fonctions sur les chaînes :</strong>
                <ul>
                    <li><strong>strlen()</strong> : retourne la longueur d'une chaîne.</li>
                    <li><strong>str_replace()</strong> : remplace toutes les occurrences d'une sous-chaîne.</li>
                    <li><strong>strtolower()</strong> : convertit en minuscules.</li>
                    <li><strong>strtoupper()</strong> : convertit en majuscules.</li>
                    <li><strong>substr()</strong> : extrait une sous-chaîne.</li>
                    <li><strong>trim()</strong> : supprime les espaces autour d'une chaîne.</li>
                </ul>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header example-header--string">strlen()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">strlen</span>(<span class="string">"Bonjour"</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 7</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--string">str_replace()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">str_replace</span>(<span class="string">"jour"</span>, <span class="string">"soir"</span>, <span class="string">"Bonjour"</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Bonsoir</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--string">strtolower()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">strtolower</span>(<span class="string">"BONJOUR"</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : bonjour</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header example-header--string">strtoupper()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">strtoupper</span>(<span class="string">"bonjour"</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : BONJOUR</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--string">substr()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">substr</span>(<span class="string">"Bonjour"</span>, <span class="number">0</span>, <span class="number">3</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Bon</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--string">trim()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">trim</span>(<span class="string">" Bonjour "</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Bonjour</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="numeric-section">Fonctions numériques</h2>
            <p>Les fonctions numériques en PHP permettent d'effectuer des calculs et des manipulations sur des valeurs numériques, facilitant ainsi le développement d'applications nécessitant des opérations mathématiques.</p>

            <div class="info-box">
                <strong>Fonctions numériques :</strong>
                <ul>
                    <li><strong>abs()</strong> : valeur absolue.</li>
                    <li><strong>round()</strong> : arrondi.</li>
                    <li><strong>max()</strong> : valeur maximale.</li>
                    <li><strong>min()</strong> : valeur minimale.</li>
                    <li><strong>rand()</strong> : nombre aléatoire.</li>
                    <li><strong>is_numeric()</strong> : vérifie si c'est un nombre.</li>
                </ul>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header example-header--numeric">abs()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">abs</span>(<span class="number">-42</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 42</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--numeric">round()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">round</span>(<span class="number">3.14159</span>, <span class="number">2</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 3.14</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--numeric">max()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">max</span>(<span class="number">1</span>, <span class="number">5</span>, <span class="number">3</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 5</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header example-header--numeric">min()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">min</span>(<span class="number">1</span>, <span class="number">5</span>, <span class="number">3</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 1</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--numeric">rand()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">rand</span>(<span class="number">1</span>, <span class="number">10</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Un nombre entre 1 et 10</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header example-header--numeric">is_numeric()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">is_numeric</span>(<span class="string">"123"</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 1</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="arrays-section">Tableaux</h2>
            <p>Les fonctions sur les tableaux en PHP permettent de manipuler des structures de données complexes, facilitant ainsi le stockage et la gestion d'ensembles de données dans vos applications.</p>

            <div class="info-box">
                <strong>Fonctions sur les tableaux :</strong>
                <ul>
                    <li><strong>array_push()</strong> : ajoute des éléments.</li>
                    <li><strong>array_pop()</strong> : supprime le dernier élément.</li>
                    <li><strong>count()</strong> : compte les éléments.</li>
                    <li><strong>array_flip()</strong> : inverse les clés/valeurs.</li>
                    <li><strong>array_key_exists()</strong> : vérifie si une clé existe.</li>
                    <li><strong>in_array()</strong> : vérifie si une valeur existe.</li>
                    <li><strong>sort()</strong> : tri croissant.</li>
                    <li><strong>rsort()</strong> : tri décroissant.</li>
                    <li><strong>array_merge()</strong> : fusionne des tableaux.</li>
                </ul>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header arrays-header">array_push()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">2</span>];
<span class="function">array_push</span>(<span class="keyword">$arr</span>, <span class="number">3</span>);
<span class="function">print_r</span>(<span class="keyword">$arr</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [0] => 1 [1] => 2 [2] => 3 )</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header arrays-header">array_pop()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="keyword">echo</span> <span class="function">array_pop</span>(<span class="keyword">$arr</span>);
<span class="function">print_r</span>(<span class="keyword">$arr</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 3 Array ( [0] => 1 [1] => 2 )</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header arrays-header">count()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="keyword">echo</span> <span class="function">count</span>(<span class="keyword">$arr</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 3</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header arrays-header">array_flip()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="string">"a"</span> <span class="operator">=></span> <span class="number">1</span>, <span class="string">"b"</span> <span class="operator">=></span> <span class="number">2</span>];
<span class="function">print_r</span>(<span class="function">array_flip</span>(<span class="keyword">$arr</span>));</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [1] => a [2] => b )</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header arrays-header">array_key_exists()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="string">"a"</span> <span class="operator">=></span> <span class="number">1</span>, <span class="string">"b"</span> <span class="operator">=></span> <span class="number">2</span>];
<span class="keyword">echo</span> <span class="function">array_key_exists</span>(<span class="string">"a"</span>, <span class="keyword">$arr</span>) ? <span class="string">'Oui'</span> : <span class="string">'Non'</span>;</code></pre>
                        <div class="result">
                            <p>Résultat : Oui</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header arrays-header">in_array()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="keyword">echo</span> <span class="function">in_array</span>(<span class="number">2</span>, <span class="keyword">$arr</span>) ? <span class="string">'Oui'</span> : <span class="string">'Non'</span>;</code></pre>
                        <div class="result">
                            <p>Résultat : Oui</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header arrays-header">sort()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="number">3</span>, <span class="number">1</span>, <span class="number">2</span>];
<span class="function">sort</span>(<span class="keyword">$arr</span>);
<span class="function">print_r</span>(<span class="keyword">$arr</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [0] => 1 [1] => 2 [2] => 3 )</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header arrays-header">rsort()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$arr</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">3</span>, <span class="number">2</span>];
<span class="function">rsort</span>(<span class="keyword">$arr</span>);
<span class="function">print_r</span>(<span class="keyword">$arr</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [0] => 3 [1] => 2 [2] => 1 )</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header arrays-header">array_merge()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$a</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">2</span>];
<span class="keyword">$b</span> <span class="operator">=</span> [<span class="number">3</span>, <span class="number">4</span>];
<span class="function">print_r</span>(<span class="function">array_merge</span>(<span class="keyword">$a</span>, <span class="keyword">$b</span>));</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 )</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="dates-section">Dates et temps</h2>
            <p>Les fonctions sur les dates en PHP permettent de manipuler et formater des dates et heures facilement.</p>

            <div class="info-box">
                <strong>Fonctions sur les dates :</strong>
                <ul>
                    <li><strong>date()</strong> : formate une date.</li>
                    <li><strong>time()</strong> : timestamp actuel.</li>
                    <li><strong>strtotime()</strong> : chaîne → timestamp.</li>
                    <li><strong>mktime()</strong> : date → timestamp.</li>
                    <li><strong>checkdate()</strong> : valide une date.</li>
                    <li><strong>getdate()</strong> : retourne des infos de date.</li>
                </ul>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header dates-header">date()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">date</span>(<span class="string">"d/m/Y"</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 12/06/2025</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header dates-header">time()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">time</span>();</code></pre>
                        <div class="result">
                            <p>Résultat : Un nombre (timestamp actuel)</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header dates-header">strtotime()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">strtotime</span>(<span class="string">"2025-06-12"</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 1754995200</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header dates-header">mktime()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">mktime</span>(<span class="number">0</span>, <span class="number">0</span>, <span class="number">0</span>, <span class="number">6</span>, <span class="number">12</span>, <span class="number">2025</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : 1754995200</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header dates-header">checkdate()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">echo</span> <span class="function">checkdate</span>(<span class="number">2</span>, <span class="number">29</span>, <span class="number">2024</span>) ? <span class="string">'Valide'</span> : <span class="string">'Invalide'</span>;</code></pre>
                        <div class="result">
                            <p>Résultat : Valide</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header dates-header">getdate()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="function">print_r</span>(<span class="function">getdate</span>());</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [seconds] => ... [minutes] => ... [hours] => ... ... )</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="json-section">JSON</h2>
            <p>Les fonctions JSON en PHP sont utilisées pour encoder et décoder des données au format JSON.</p>

            <div class="info-box">
                <strong>Fonctions JSON :</strong>
                <ul>
                    <li><strong>json_encode()</strong> : PHP → JSON.</li>
                    <li><strong>json_last_error()</strong> : code d'erreur JSON.</li>
                    <li><strong>json_last_error_msg()</strong> : message d'erreur JSON.</li>
                    <li><strong>json_decode()</strong> : JSON → PHP.</li>
                </ul>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header json-header">json_encode()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$data</span> <span class="operator">=</span> [<span class="string">"nom"</span> <span class="operator">=></span> <span class="string">"Alice"</span>, <span class="string">"age"</span> <span class="operator">=></span> <span class="number">30</span>];
<span class="keyword">echo</span> <span class="function">json_encode</span>(<span class="keyword">$data</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : {"nom":"Alice","age":30}</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header json-header">json_decode()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$json</span> <span class="operator">=</span> <span class="string">'{"nom":"Alice","age":30}'</span>;
<span class="keyword">$php</span> <span class="operator">=</span> <span class="function">json_decode</span>(<span class="keyword">$json</span>, <span class="keyword">true</span>);
<span class="function">print_r</span>(<span class="keyword">$php</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [nom] => Alice [age] => 30 )</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header json-header">json_last_error() & json_last_error_msg()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="function">json_decode</span>(<span class="string">'{"nom": "Alice", "age": }'</span>);
<span class="keyword">echo</span> <span class="function">json_last_error</span>();
<span class="keyword">echo</span> <span class="function">json_last_error_msg</span>();</code></pre>
                        <div class="result">
                            <p>Résultat : 4 Erreur de syntaxe</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 class="variables-section">Gestion des variables</h2>
            <p>Les fonctions de gestion des variables en PHP permettent d'examiner et de manipuler les variables, offrant ainsi un contrôle précis sur les données utilisées dans vos applications.</p>

            <div class="info-box">
                <strong>Fonctions de gestion des variables :</strong>
                <ul>
                    <li><strong>isset()</strong> : variable définie ?</li>
                    <li><strong>empty()</strong> : variable vide ?</li>
                    <li><strong>unset()</strong> : supprime une variable.</li>
                    <li><strong>gettype()</strong> : type d'une variable.</li>
                    <li><strong>var_dump()</strong> : détails complets.</li>
                    <li><strong>print_r()</strong> : lecture simplifiée.</li>
                </ul>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header variables-header">isset()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$a</span> <span class="operator">=</span> <span class="number">5</span>;
<span class="keyword">echo</span> <span class="function">isset</span>(<span class="keyword">$a</span>) ? <span class="string">'Oui'</span> : <span class="string">'Non'</span>;</code></pre>
                        <div class="result">
                            <p>Résultat : Oui</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header variables-header">empty()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$b</span> <span class="operator">=</span> <span class="number">0</span>;
<span class="keyword">echo</span> <span class="function">empty</span>(<span class="keyword">$b</span>) ? <span class="string">'Oui'</span> : <span class="string">'Non'</span>;</code></pre>
                        <div class="result">
                            <p>Résultat : Oui</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header variables-header">unset()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$c</span> <span class="operator">=</span> <span class="number">10</span>;
<span class="function">unset</span>(<span class="keyword">$c</span>);
<span class="keyword">echo</span> <span class="function">isset</span>(<span class="keyword">$c</span>) ? <span class="string">'Définie'</span> : <span class="string">'Non définie'</span>;</code></pre>
                        <div class="result">
                            <p>Résultat : Non définie</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header variables-header">gettype()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$d</span> <span class="operator">=</span> <span class="string">"Hello"</span>;
<span class="keyword">echo</span> <span class="function">gettype</span>(<span class="keyword">$d</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : string</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header variables-header">var_dump()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$e</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="function">var_dump</span>(<span class="keyword">$e</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : array(3) { [0]=> int(1) [1]=> int(2) [2]=> int(3) }</p>
                        </div>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header variables-header">print_r()</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="keyword">$f</span> <span class="operator">=</span> [<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>];
<span class="function">print_r</span>(<span class="keyword">$f</span>);</code></pre>
                        <div class="result">
                            <p>Résultat : Array ( [0] => 1 [1] => 2 [2] => 3 )</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="navigation">
            <a href="06-les-tableaux.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="08-inclusions.php" class="nav-button">Module suivant →</a>
        </div>

        <?php include __DIR__ . '/../includes/footer.php'; ?>