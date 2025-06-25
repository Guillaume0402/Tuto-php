<?php
$moduleClass = 'module1';
include __DIR__ . '/../includes/header.php';
// Variables de page
$titre = "Premier Script PHP";
$description = "Découvrir la syntaxe de base et l'intégration du PHP dans une page HTML";
?>

<div class="module-header">
    <h1><?= $titre ?></h1>
    <p class="subtitle"><?= $description ?></p>
</div>
<div class="navigation">
    <a class="nav-button" style="visibility: hidden;">← Module précédent</a>
    <a href="../../index.php" class="nav-button">Accueil</a>
    <a href="02-les-variables.php" class="nav-button">Module suivant →</a>
</div>

<main>
    <section class="section">
        <h2>Affichage direct avec PHP</h2>
        <p>Le PHP peut être utilisé pour générer du contenu directement dans le navigateur sans HTML.</p>

        <div class="example">
            <div class="example-header">Exemple d'affichage direct</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="keyword">echo</span> <span class="string">"Hello World !&lt;br&gt;"</span>;
<span class="keyword">echo</span> <span class="string">"Ceci est mon premier script PHP !&lt;br&gt;"</span>;</code></pre>
                <div class="result">
                    <p>Hello World !<br>
                        Ceci est mon premier script PHP !</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Commentaires en PHP</h2>
        <p>Les commentaires permettent d'expliquer le code et ne sont pas exécutés par l'interpréteur PHP.</p>

        <div class="example">
            <div class="example-header">Commentaire sur une ligne</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="comment">// Ceci est un commentaire en PHP</span></code></pre>
                <div class="result">
                    <p>Résultat : <em>Aucune sortie (non affiché)</em></p>
                </div>
            </div>
        </div>

        <div class="example">
            <div class="example-header">Commentaire sur plusieurs lignes</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="comment">/*
Commentaire sur plusieurs lignes
Ceci est un exemple de commentaire
*/</span></code></pre>
                <div class="result">
                    <p>Résultat : <em>Aucune sortie (non affiché)</em></p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>PHP intégré dans HTML</h2>
        <p>PHP peut être intégré directement dans le code HTML pour générer du contenu dynamique.</p>

        <div class="example">
            <div class="example-header">Inclusion de PHP dans une balise HTML</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="tag">&lt;h1&gt;</span>
    <span class="keyword">&lt;?php</span> <span class="keyword">echo</span> <span class="string">"Un Deuxième script dans mon HTML !"</span> <span class="keyword">?&gt;</span>
<span class="tag">&lt;/h1&gt;</span></code></pre>
                <div class="result">
                    <h1>Un Deuxième script dans mon HTML !</h1>
                </div>
            </div>
        </div>
    </section>

</main>

<div class="navigation">
    <a class="nav-button" style="visibility: hidden;">← Module précédent</a>
    <a href="../../index.php" class="nav-button">Accueil</a>
    <a href="02-les-variables.php" class="nav-button">Module suivant →</a>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>