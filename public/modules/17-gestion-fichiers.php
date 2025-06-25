<?php
$moduleClass = 'module17';
include __DIR__ . '/../includes/header.php';


$pageKey = '17-gestion-fichiers';
$pageInfo = [
    'titre' => 'Gestion des fichiers et images en PHP',
    'description' => "Apprenez à manipuler, valider et traiter des fichiers et images en PHP : upload, miniatures, formats, erreurs, etc."
];
$titre = $pageInfo['titre'];
$description = $pageInfo['description'];
?>


<div class="module-header">
    <h1><?= $titre ?></h1>
    <p class="subtitle"><?= $description ?></p>
</div>
<div class="navigation">
    <a href="<?= BASE_URL ?>/modules/16-api-externes.php" class="nav-button">← Module précédent</a>
    <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
    <a href="<?= BASE_URL ?>/modules/18-tests-unitaires.php" class="nav-button">Module suivant →</a>
</div>
<main>
    <section class="section">
        <h2>Introduction</h2>
        <p>La gestion des fichiers est une compétence essentielle en PHP : que ce soit pour permettre à un utilisateur d'uploader une image, générer des miniatures, lire un fichier texte ou manipuler des PDF, PHP propose de nombreuses fonctions natives et bibliothèques.</p>
        <div class="info-box">
            <strong>Exemples d'usages :</strong>
            <ul>
                <li>Permettre à un utilisateur d'envoyer une photo de profil</li>
                <li>Créer des miniatures pour une galerie d'images</li>
                <li>Lire et analyser un fichier CSV</li>
                <li>Générer un PDF à partir de données</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <h2>1. Upload de fichiers en PHP</h2>
        <p>L'upload de fichiers se fait via un formulaire HTML avec l'attribut <code>enctype="multipart/form-data"</code>. PHP place les fichiers uploadés dans <code>$_FILES</code>.</p>
        <h3>Exemple de formulaire d'upload</h3>
        <div class="example-box">
            <pre><code class="language-html"><span class="tag">&lt;form</span> <span class="attr">action</span>=<span class="string">"upload.php"</span> <span class="attr">method</span>=<span class="string">"post"</span> <span class="attr">enctype</span>=<span class="string">"multipart/form-data"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;input</span> <span class="attr">type</span>=<span class="string">"file"</span> <span class="attr">name</span>=<span class="string">"mon_fichier"</span><span class="tag">&gt;</span>
    <span class="tag">&lt;button</span> <span class="attr">type</span>=<span class="string">"submit"</span><span class="tag">&gt;</span>Envoyer<span class="tag">&lt;/button&gt;</span>
<span class="tag">&lt;/form&gt;</span>
</code></pre>
        </div>
        <h3>Traitement côté PHP</h3>
        <div class="example-box">
            <pre><code class="language-php"><span class="comment">// upload.php : traitement de l'upload</span> <span class="comment">// 1. Vérifier qu'un fichier a bien été envoyé et qu'il n'y a pas d'erreur</span> <span class="keyword">if</span> (isset(<span class="variable">$_FILES</span>[<span class="string">'mon_fichier'</span>]) && <span class="variable">$_FILES</span>[<span class="string">'mon_fichier'</span>][<span class="string">'error'</span>] === 0) { <span class="comment">// 2. Récupérer le nom temporaire et le nom d'origine</span> <span class="variable">$tmpName</span> = <span class="variable">$_FILES</span>[<span class="string">'mon_fichier'</span>][<span class="string">'tmp_name'</span>]; <span class="variable">$name</span> = <span class="function">basename</span>(<span class="variable">$_FILES</span>[<span class="string">'mon_fichier'</span>][<span class="string">'name'</span>]); <span class="comment">// 3. Vérifier l'extension du fichier (sécurité)</span>
    <span class="variable">$allowed</span> = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    <span class="variable">$ext</span> = <span class="function">strtolower</span>(<span class="function">pathinfo</span>(<span class="variable">$name</span>, <span class="constant">PATHINFO_EXTENSION</span>));
    <span class="keyword">if</span> (<span class="function">in_array</span>(<span class="variable">$ext</span>, <span class="variable">$allowed</span>)) {
        <span class="comment">// 4. Déplacer le fichier dans le dossier uploads</span>
        <span class="function">move_uploaded_file</span>(<span class="variable">$tmpName</span>, <span class="string">'uploads/'</span> . <span class="variable">$name</span>);
        <span class="keyword">echo</span> <span class="string">"Fichier uploadé avec succès !"</span>;
    } <span class="keyword">else</span> {
        <span class="comment">// Extension non autorisée</span>
        <span class="keyword">echo</span> <span class="string">"Extension non autorisée."</span>;
    }
} <span class="keyword">else</span> {
    <span class="comment">// Erreur lors de l'upload (taille, pas de fichier, etc.)</span>
    <span class="keyword">echo</span> <span class="string">"Erreur lors de l'upload."</span>;
}
</code></pre>
        </div>
        <div class="info-box">
            <strong>Explications détaillées :</strong>
            <ul>
                <li><strong>1.</strong> On vérifie que le fichier a bien été envoyé et qu'il n'y a pas d'erreur (code erreur 0).</li>
                <li><strong>2.</strong> On récupère le nom temporaire (sur le serveur) et le nom d'origine (nom du fichier sur l'ordinateur de l'utilisateur).</li>
                <li><strong>3.</strong> On vérifie l'extension pour éviter les fichiers dangereux (ex : .php).</li>
                <li><strong>4.</strong> Si tout est OK, on déplace le fichier dans le dossier <code>uploads/</code>.</li>
                <li>Sinon, on affiche un message d'erreur adapté.</li>
            </ul>
        </div>
        <div class="warning-box">
            <strong>Attention :</strong> Toujours valider le type et la taille du fichier côté serveur pour éviter les failles de sécurité.
        </div>
    </section>

    <section class="section">
        <h2>2. Manipulation d'images avec GD</h2>
        <p>La librairie GD permet de redimensionner, recadrer, ajouter du texte ou des filtres sur des images. Elle est incluse par défaut avec PHP.</p>
        <h3>Créer une miniature (thumbnail)</h3>
        <div class="example-box">
            <pre><code class="language-php"><span class="comment">// Créer une miniature 150x150px à partir d'une image uploadée</span>
<span class="variable">$src</span> = <span class="string">'uploads/photo.jpg'</span>;
<span class="variable">$dst</span> = <span class="string">'uploads/miniature.jpg'</span>;
<span class="variable">$img</span> = <span class="function">imagecreatefromjpeg</span>(<span class="variable">$src</span>);
<span class="variable">$mini</span> = <span class="function">imagecreatetruecolor</span>(150, 150);
<span class="function">imagecopyresampled</span>(<span class="variable">$mini</span>, <span class="variable">$img</span>, 0, 0, 0, 0, 150, 150, <span class="function">imagesx</span>(<span class="variable">$img</span>), <span class="function">imagesy</span>(<span class="variable">$img</span>));
<span class="function">imagejpeg</span>(<span class="variable">$mini</span>, <span class="variable">$dst</span>);
<span class="function">imagedestroy</span>(<span class="variable">$img</span>);
<span class="function">imagedestroy</span>(<span class="variable">$mini</span>);
</code></pre>
        </div>
        <div class="tip-box">
            <strong>Astuce :</strong> Pour PNG utilisez <code>imagecreatefrompng</code> et <code>imagepng</code>.
        </div>
    </section>

    <section class="section">
        <h2>3. Gestion des erreurs lors des opérations sur les fichiers</h2>
        <p>Il est important de vérifier les erreurs lors de la manipulation de fichiers (droit d'écriture, fichier manquant, etc.).</p>
        <div class="example-box">
            <pre><code class="language-php"><span class="comment">// Lecture d'un fichier avec gestion d'erreur</span>
<span class="variable">$filename</span> = <span class="string">'uploads/monfichier.txt'</span>;
<span class="keyword">if</span> (<span class="function">file_exists</span>(<span class="variable">$filename</span>)) {
    <span class="variable">$contenu</span> = <span class="function">file_get_contents</span>(<span class="variable">$filename</span>);
    <span class="keyword">echo</span> <span class="variable">$contenu</span>;
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Fichier introuvable."</span>;
}
</code></pre>
        </div>
    </section>

    <section class="section">
        <h2>4. Lire et écrire différents formats de fichiers</h2>
        <p>PHP permet de lire/écrire des fichiers texte, CSV, JSON, XML, etc.</p>
        <h3>Lire un fichier CSV</h3>
        <div class="example-box">
            <pre><code class="language-php"><span class="comment">// Lecture d'un fichier CSV ligne par ligne</span>
<span class="variable">$f</span> = <span class="function">fopen</span>(<span class="string">'uploads/contacts.csv'</span>, <span class="string">'r'</span>);
<span class="keyword">while</span> ((<span class="variable">$row</span> = <span class="function">fgetcsv</span>(<span class="variable">$f</span>, 1000, <span class="string">','</span>)) !== <span class="keyword">false</span>) {
    <span class="keyword">echo</span> <span class="string">implode</span>(<span class="string">' | '</span>, <span class="variable">$row</span>) . <span class="string">"<br>"</span>;
}
<span class="function">fclose</span>(<span class="variable">$f</span>);
</code></pre>
        </div>
        <h3>Lire/écrire du JSON</h3>
        <div class="example-box">
            <pre><code class="language-php"><span class="comment">// Écrire un tableau PHP dans un fichier JSON</span>
<span class="variable">$data</span> = ["nom" => "Alice", "age" => 30];
<span class="function">file_put_contents</span>(<span class="string">'uploads/data.json'</span>, <span class="function">json_encode</span>(<span class="variable">$data</span>));

<span class="comment">// Lire un fichier JSON</span>
<span class="variable">$json</span> = <span class="function">file_get_contents</span>(<span class="string">'uploads/data.json'</span>);
<span class="variable">$data</span> = <span class="function">json_decode</span>(<span class="variable">$json</span>, <span class="keyword">true</span>);
</code></pre>
        </div>
    </section>

    <section class="section">
        <h2>5. Aller plus loin : Imagick, PDF, sécurité</h2>
        <p>Pour des traitements avancés sur les images (filtres, rotation, conversion de format, etc.), utilisez <strong>Imagick</strong> (extension PHP pour ImageMagick).</p>
        <div class="info-box">
            <strong>Pour aller plus loin :</strong>
            <ul>
                <li>Générez des PDF avec <a href="https://mpdf.github.io/" target="_blank">mPDF</a> ou <a href="https://tcpdf.org/" target="_blank">TCPDF</a></li>
                <li>Protégez vos dossiers d'upload (permissions, .htaccess, antivirus...)</li>
                <li>Vérifiez la taille, le type MIME et le contenu des fichiers uploadés</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <h2>6. Manipulation avancée d'images avec Imagick</h2>
        <p><strong>Imagick</strong> est une extension PHP puissante basée sur ImageMagick, idéale pour des traitements avancés sur les images (filtres, effets, conversion de format, etc.).</p>
        <div class="example-box">
            <pre><code class="language-php"><span class="comment">// Redimensionner et convertir une image en PNG avec Imagick</span>
<span class="variable">$img</span> = <span class="keyword">new</span> <span class="class-name">Imagick</span>(<span class="string">'uploads/photo.jpg'</span>);
<span class="variable">$img</span>-><span class="function">resizeImage</span>(200, 200, <span class="constant">Imagick::FILTER_LANCZOS</span>, 1);
<span class="variable">$img</span>-><span class="function">setImageFormat</span>(<span class="string">'png'</span>);
<span class="variable">$img</span>-><span class="function">writeImage</span>(<span class="string">'uploads/photo-mini.png'</span>);
<span class="variable">$img</span>-><span class="function">clear</span>();
<span class="variable">$img</span>-><span class="function">destroy</span>();
</code></pre>
        </div>
        <div class="tip-box">
            <strong>Astuce :</strong> Imagick permet aussi d'ajouter du texte, des filtres, de détecter le format, etc. Consultez la <a href="https://www.php.net/manual/fr/book.imagick.php" target="_blank">documentation officielle</a>.
        </div>
    </section>

    <section class="section">
        <h2>7. Générer des PDF en PHP</h2>
        <p>Pour générer des fichiers PDF dynamiquement (factures, rapports, etc.), utilisez une bibliothèque comme <strong>mPDF</strong> ou <strong>TCPDF</strong>.</p>
        <h3>Exemple avec mPDF</h3>
        <div class="example-box">
            <pre><code class="language-php"><span class="comment">// Générer un PDF simple avec mPDF (installation via Composer)</span>
<span class="keyword">require_once</span> <span class="string">'vendor/autoload.php'</span>;
<span class="variable">$mpdf</span> = <span class="keyword">new</span> <span class="class-name">\Mpdf\Mpdf</span>();
<span class="variable">$mpdf</span>-><span class="function">WriteHTML</span>(<span class="string">'<h1>Bonjour PDF</h1><p>Document généré en PHP !</p>'</span>);
<span class="variable">$mpdf</span>-><span class="function">Output</span>(<span class="string">'mon-fichier.pdf'</span>, <span class="string">'I'</span>); <span class="comment">// Affiche dans le navigateur</span>
</code></pre>
        </div>
        <div class="info-box">
            <strong>À savoir :</strong> mPDF et TCPDF permettent de styliser vos PDF avec du HTML/CSS, d'ajouter des images, des tableaux, etc.
        </div>
    </section>

    <section class="section">
        <h2>8. Sécurité avancée pour les fichiers uploadés</h2>
        <p>La sécurité des fichiers uploadés est cruciale pour éviter les failles (exécution de code malveillant, virus, etc.). Voici les bonnes pratiques à appliquer :</p>
        <ul>
            <li><strong>Limiter la taille</strong> des fichiers (ex : <code>ini_set('upload_max_filesize', '2M')</code>).</li>
            <li><strong>Vérifier le type MIME</strong> avec <code>mime_content_type()</code> ou <code>finfo_file()</code>.</li>
            <li><strong>Renommer</strong> les fichiers uploadés pour éviter l'exécution de scripts (ex : <code>uniqid().'.jpg'</code>).</li>
            <li><strong>Stocker</strong> les fichiers en dehors du dossier public si possible.</li>
            <li><strong>Protéger le dossier uploads</strong> avec un <code>.htaccess</code> :<br>
                <pre><code class="language-apache"># uploads/.htaccess
<FilesMatch "\.(php|php5|phtml)$">
    Deny from all
</FilesMatch>
</code></pre>
            </li>
            <li><strong>Scanner</strong> les fichiers avec un antivirus côté serveur si besoin.</li>
        </ul>
        <div class="warning-box">
            <strong>Attention :</strong> Ne faites jamais confiance au nom ou à l'extension du fichier envoyé par l'utilisateur !
        </div>
    </section>

    <div class="navigation">
        <a href="<?= BASE_URL ?>/modules/16-api-externes.php" class="nav-button">← Module précédent</a>
        <a href="<?= BASE_URL ?>" class="nav-button">Accueil</a>
        <a href="<?= BASE_URL ?>/modules/18-tests-unitaires.php" class="nav-button">Module suivant →</a>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>