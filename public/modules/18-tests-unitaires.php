<?php include __DIR__ . '/../includes/header.php';

$titre = "Tests unitaires et qualité de code";
$description = "Découvrez comment écrire des tests unitaires en PHP avec PHPUnit, améliorer la qualité de votre code et mettre en place l'intégration continue.";
?>


<body class="module18">
    <header>
        <h1><?= $titre ?></h1>
        <p class="subtitle"><?= $description ?></p>
    </header>
    <div class="navigation">
        <a href="17-gestion-fichiers.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="19-envoi-emails.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction à PHPUnit</h2>
            <p>PHPUnit est le framework de référence pour les tests unitaires en PHP. Il permet de vérifier automatiquement que chaque partie de votre code fonctionne comme prévu, sans avoir à tester manuellement après chaque modification.</p>

            <div class="info-box">
                <strong>Pourquoi écrire des tests unitaires&nbsp;?</strong>
                <ul>
                    <li>Garantir le bon fonctionnement du code lors des évolutions</li>
                    <li>Faciliter la maintenance et la refactorisation</li>
                    <li>Documenter le comportement attendu</li>
                    <li>Détecter les bugs avant la mise en production</li>
                    <li>Augmenter la confiance dans votre code</li>
                </ul>
            </div>

            <p>Imaginez que vous développez une application et que vous ajoutez régulièrement des fonctionnalités. Sans tests, comment être sûr que vos nouvelles fonctionnalités ne cassent pas des fonctionnalités existantes ? C'est là que les tests unitaires sont précieux.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Sans tests unitaires</div>
                    <div class="example-content">
                        <ol>
                            <li>Vous modifiez une fonction</li>
                            <li>Vous devez tester manuellement toutes les parties de l'application qui l'utilisent</li>
                            <li>Vous oubliez peut-être certains cas d'utilisation</li>
                            <li>Un bug se glisse en production</li>
                        </ol>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Avec tests unitaires</div>
                    <div class="example-content">
                        <ol>
                            <li>Vous modifiez une fonction</li>
                            <li>Vous lancez les tests automatiquement</li>
                            <li>Si un test échoue, vous êtes alerté immédiatement</li>
                            <li>Vous corrigez avant de mettre en production</li>
                        </ol>
                        <div class="result">
                            <p>Résultat : gain de temps, code plus fiable, développement plus serein.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <h2>Écrire ses premiers tests</h2>
            <p>Un test unitaire vérifie le comportement d'une fonction ou d'une classe de façon isolée. Commençons par un exemple simple :</p>

            <div class="info-box">
                <strong>Installation de PHPUnit</strong>
                <ul>
                    <li>Via Composer (recommandé)&nbsp;: <code>composer require --dev phpunit/phpunit</code></li>
                    <li>Ou globalement&nbsp;: <code>composer global require phpunit/phpunit</code></li>
                    <li>Pour les débutants : commencez par créer un projet avec <code>composer init</code> puis installez PHPUnit</li>
                </ul>
            </div>

            <h3>Étape 1: Créer une fonction à tester</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Fichier: Calculator.php</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Calculator.php</span>
<span class="keyword">class</span> <span class="class-name">Calculator</span> {
    <span class="keyword">public function</span> <span class="function">add</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
        <span class="keyword">return</span> <span class="variable">$a</span> + <span class="variable">$b</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">subtract</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
        <span class="keyword">return</span> <span class="variable">$a</span> - <span class="variable">$b</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">multiply</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
        <span class="keyword">return</span> <span class="variable">$a</span> * <span class="variable">$b</span>;
    }
    
    <span class="keyword">public function</span> <span class="function">divide</span>(<span class="variable">$a</span>, <span class="variable">$b</span>) {
        <span class="keyword">if</span> (<span class="variable">$b</span> == <span class="number">0</span>) {
            <span class="keyword">throw new</span> <span class="class-name">InvalidArgumentException</span>(<span class="string">'Division par zéro impossible'</span>);
        }
        <span class="keyword">return</span> <span class="variable">$a</span> / <span class="variable">$b</span>;
    }
}</code></pre>
                    </div>
                </div>
            </div>

            <h3>Étape 2: Créer une classe de test</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Fichier: CalculatorTest.php</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// tests/CalculatorTest.php</span>
<span class="keyword">use</span> PHPUnit\Framework\TestCase;

<span class="keyword">class</span> <span class="class-name">CalculatorTest</span> <span class="keyword">extends</span> <span class="class-name">TestCase</span> {
    <span class="keyword">private</span> <span class="variable">$calculator</span>;
    
    <span class="comment">// Cette méthode s'exécute avant chaque test</span>
    <span class="keyword">protected function</span> <span class="function">setUp</span>(): <span class="keyword">void</span> {
        <span class="variable">$this</span>-><span class="variable">calculator</span> = <span class="keyword">new</span> <span class="class-name">Calculator</span>();
    }
    
    <span class="comment">// Le nom des méthodes de test doit commencer par "test"</span>
    <span class="keyword">public function</span> <span class="function">testAdditionReturnsCorrectResult</span>() {
        <span class="variable">$result</span> = <span class="variable">$this</span>-><span class="variable">calculator</span>->add(<span class="number">2</span>, <span class="number">2</span>);
        <span class="variable">$this</span>->assertEquals(<span class="number">4</span>, <span class="variable">$result</span>);
    }
    
    <span class="keyword">public function</span> <span class="function">testSubtractionReturnsCorrectResult</span>() {
        <span class="variable">$result</span> = <span class="variable">$this</span>-><span class="variable">calculator</span>->subtract(<span class="number">5</span>, <span class="number">2</span>);
        <span class="variable">$this</span>->assertEquals(<span class="number">3</span>, <span class="variable">$result</span>);
    }
    
    <span class="keyword">public function</span> <span class="function">testMultiplicationReturnsCorrectResult</span>() {
        <span class="variable">$result</span> = <span class="variable">$this</span>-><span class="variable">calculator</span>->multiply(<span class="number">3</span>, <span class="number">4</span>);
        <span class="variable">$this</span>->assertEquals(<span class="number">12</span>, <span class="variable">$result</span>);
    }
    
    <span class="keyword">public function</span> <span class="function">testDivisionReturnsCorrectResult</span>() {
        <span class="variable">$result</span> = <span class="variable">$this</span>-><span class="variable">calculator</span>->divide(<span class="number">10</span>, <span class="number">2</span>);
        <span class="variable">$this</span>->assertEquals(<span class="number">5</span>, <span class="variable">$result</span>);
    }
    
    <span class="keyword">public function</span> <span class="function">testDivisionByZeroThrowsException</span>() {
        <span class="variable">$this</span>->expectException(<span class="class-name">InvalidArgumentException</span>::<span class="keyword">class</span>);
        <span class="variable">$this</span>-><span class="variable">calculator</span>->divide(<span class="number">10</span>, <span class="number">0</span>);
    }
}</code></pre>
                        <div class="result">
                            <p><strong>Explication :</strong></p>
                            <ul>
                                <li><code>setUp()</code> : Prépare l'environnement avant chaque test</li>
                                <li><code>assertEquals()</code> : Vérifie que deux valeurs sont égales</li>
                                <li><code>expectException()</code> : Vérifie qu'une exception est levée</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Étape 3: Exécuter les tests</h3>
            <div class="example">
                <div class="example-header">Dans votre terminal</div>
                <div class="example-content">
                    <pre><code class="language-bash"><span class="comment"># Exécuter tous les tests</span>
./vendor/bin/phpunit tests/

<span class="comment"># Exécuter un fichier de test spécifique</span>
./vendor/bin/phpunit tests/CalculatorTest.php

<span class="comment"># Exécuter une méthode de test spécifique</span>
./vendor/bin/phpunit --filter testAdditionReturnsCorrectResult tests/CalculatorTest.php</code></pre>
                    <div class="result">
                        <p>Résultat d'exécution :</p>
                        <pre>PHPUnit 9.5.28 by Sebastian Bergmann and contributors.

..... <span style="color: #0f0">5 / 5 (100%)</span>

Time: 00:00.003, Memory: 4.00 MB

<span style="color: #0f0">OK (5 tests, 5 assertions)</span></pre>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <strong>Bonnes pratiques pour nommer vos tests</strong>
                <ul>
                    <li>Utilisez des noms descriptifs : <code>testAdditionReturnsCorrectResult()</code></li>
                    <li>Suivez un format comme <code>test[Méthode][Scenario][Résultat]()</code></li>
                    <li>Exemple : <code>testDivisionByZeroThrowsException()</code></li>
                </ul>
            </div>
        </section>
        <section class="section">
            <h2>Assertions et techniques avancées</h2>
            <p>PHPUnit propose de nombreuses assertions pour vérifier différents types de conditions. Voici les plus courantes que vous utiliserez régulièrement :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Assertions de base</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Vérifier si une valeur est vraie ou fausse</span>
<span class="variable">$this</span>->assertTrue(<span class="variable">$valeur</span>);
<span class="variable">$this</span>->assertFalse(<span class="variable">$valeur</span>);

<span class="comment">// Vérifier une égalité</span>
<span class="variable">$this</span>->assertEquals(<span class="number">4</span>, <span class="number">2</span> + <span class="number">2</span>);
<span class="variable">$this</span>->assertSame(<span class="number">4</span>, <span class="variable">$resultat</span>); <span class="comment">// égalité stricte (===)</span>

<span class="comment">// Vérifier si une valeur est null</span>
<span class="variable">$this</span>->assertNull(<span class="variable">$valeur</span>);
<span class="variable">$this</span>->assertNotNull(<span class="variable">$valeur</span>);

<span class="comment">// Vérifier un tableau</span>
<span class="variable">$this</span>->assertCount(<span class="number">3</span>, <span class="variable">$tableau</span>);
<span class="variable">$this</span>->assertContains(<span class="string">'pomme'</span>, <span class="variable">$fruits</span>);</code></pre>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Assertions pour les chaînes</div>
                    <div class="example-content">
                        <pre><code class="language-php"><span class="comment">// Vérifier si une chaîne contient une autre</span>
<span class="variable">$this</span>->assertStringContainsString(<span class="string">'abc'</span>, <span class="variable">$texte</span>);

<span class="comment">// Vérifier si une chaîne commence par</span>
<span class="variable">$this</span>->assertStringStartsWith(<span class="string">'Bonjour'</span>, <span class="variable">$message</span>);

<span class="comment">// Vérifier si une chaîne se termine par</span>
<span class="variable">$this</span>->assertStringEndsWith(<span class="string">'.jpg'</span>, <span class="variable">$nomFichier</span>);

<span class="comment">// Vérifier avec une expression régulière</span>
<span class="variable">$this</span>->assertMatchesRegularExpression(<span class="string">'/^\d{4}-\d{2}-\d{2}$/'</span>, <span class="variable">$date</span>);</code></pre>
                        <div class="result">
                            <p>Astuce : En cas d'échec d'un test, PHPUnit affiche la différence entre la valeur attendue et la valeur obtenue.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Tests avec des mocks (simulacres)</h3>
            <p>Les mocks permettent de simuler le comportement de dépendances externes (bases de données, API, etc.) pour isoler le code que vous testez.</p>

            <div class="example">
                <div class="example-header">Exemple de mock</div>
                <div class="example-content">
                    <pre><code class="language-php"><span class="keyword">class</span> <span class="class-name">UserServiceTest</span> <span class="keyword">extends</span> <span class="class-name">TestCase</span> {
    <span class="keyword">public function</span> <span class="function">testGetFullName</span>() {
        <span class="comment">// Créer un mock du Repository</span>
        <span class="variable">$mockRepository</span> = <span class="variable">$this</span>->createMock(<span class="class-name">UserRepository</span>::<span class="keyword">class</span>);
        
        <span class="comment">// Configurer le comportement du mock</span>
        <span class="variable">$mockRepository</span>->method(<span class="string">'findById'</span>)
            ->with(<span class="number">123</span>) <span class="comment">// On s'attend à ce que le paramètre soit 123</span>
            ->willReturn([
                <span class="string">'firstname'</span> => <span class="string">'Jean'</span>,
                <span class="string">'lastname'</span> => <span class="string">'Dupont'</span>
            ]);
        
        <span class="comment">// Injecter le mock dans le service à tester</span>
        <span class="variable">$userService</span> = <span class="keyword">new</span> <span class="class-name">UserService</span>(<span class="variable">$mockRepository</span>);
        
        <span class="comment">// Tester le service</span>
        <span class="variable">$fullName</span> = <span class="variable">$userService</span>->getFullNameById(<span class="number">123</span>);
        <span class="variable">$this</span>->assertEquals(<span class="string">'Jean Dupont'</span>, <span class="variable">$fullName</span>);
    }
}</code></pre>
                    <div class="result">
                        <p><strong>Avantages des mocks :</strong></p>
                        <ul>
                            <li>Tests plus rapides (pas de vraie requête DB)</li>
                            <li>Tests plus fiables (pas de dépendance externe)</li>
                            <li>Possibilité de simuler des cas particuliers</li>
                        </ul>
                    </div>
                </div>
            </div>

            <h3>Couverture de code</h3>
            <p>La couverture de code mesure quelle proportion de votre code est exécutée par vos tests. C'est un indicateur précieux pour savoir si tous les chemins d'exécution sont testés.</p>

            <div class="info-box">
                <strong>Générer un rapport de couverture</strong>
                <pre><code class="language-bash"><span class="comment"># Vous aurez besoin de Xdebug ou PCOV installé</span>
./vendor/bin/phpunit --coverage-html coverage/ tests/</code></pre>
                <p>Cette commande générera un dossier <code>coverage/</code> avec un rapport HTML détaillé montrant :</p>
                <ul>
                    <li>Le pourcentage global de couverture</li>
                    <li>Les lignes couvertes (vert) et non couvertes (rouge)</li>
                    <li>Les chemins d'exécution manquants</li>
                </ul>
                <p>Visez une couverture > 80% pour un code de qualité, mais souvenez-vous que la qualité prime sur la quantité.</p>
            </div>
        </section>
        <section class="section">
            <h2>Intégration continue (CI)</h2>
            <p>L'intégration continue automatise l'exécution de vos tests à chaque modification du code. C'est comme avoir un assistant qui vérifie constamment la qualité de votre code.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Principe de la CI</div>
                    <div class="example-content">
                        <img src="https://www.plantuml.com/plantuml/svg/VP7FIiD04CRl-nH3JKwWmK2Mf4aAYGPHWHr5WSaCwDKR9bA7_lkTDU8UJnQbHzwxoRVVFtSEm5NXbSlDx5Z4_0KOkCU0eF8b2JkNcRM8UIp5NC0Pf1Gg_7pKcAG5BimmCU4fxLGHyHMmyAAgl0ts1jepl0URu8hDaEYXyZZnhu5O1MGTcMjaBS3CYqbS0M4c7iBNRAiHL_Zudd6RsO5IoIwiY8Yp-YfxgWqpK9Qz_WKwUx3FKTuhOfbR4UU4i95wzSeDgN0CS6-gQH61RNPOfMzZcD8cSIrTrR_FoNPnEWIDALcRE0TlwULVnagWNOjS1Z0hS3DVT_OudjfcLfcQ-chMdVSrhFBrTFm1" alt="Schéma CI" style="max-width:100%;">
                        <p>Les tests sont exécutés automatiquement à chaque commit ou pull request, avant même que le code ne soit déployé.</p>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Outils populaires</div>
                    <div class="example-content">
                        <ul>
                            <li><strong>GitHub Actions</strong> : intégré à GitHub</li>
                            <li><strong>GitLab CI/CD</strong> : intégré à GitLab</li>
                            <li><strong>Jenkins</strong> : solution auto-hébergée</li>
                            <li><strong>Travis CI</strong> : service en ligne</li>
                        </ul>
                        <div class="result">
                            <p>Pour les débutants, GitHub Actions est le plus facile à mettre en place.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Configuration avec GitHub Actions</h3>
            <p>Pour configurer GitHub Actions, créez un fichier <code>.github/workflows/tests.yml</code> à la racine de votre projet :</p>

            <div class="info-box">
                <strong>Exemple de configuration GitHub Actions</strong>
                <pre><code class="language-yaml"><span class="comment"># Nom du workflow</span>
<span class="keyword">name</span>: <span class="string">Tests PHP</span>

<span class="comment"># Déclencheurs</span>
<span class="keyword">on</span>:
  <span class="keyword">push</span>:
    <span class="keyword">branches</span>: [ <span class="string">main</span>, <span class="string">develop</span> ]
  <span class="keyword">pull_request</span>:
    <span class="keyword">branches</span>: [ <span class="string">main</span>, <span class="string">develop</span> ]

<span class="comment"># Jobs à exécuter</span>
<span class="keyword">jobs</span>:
  <span class="keyword">tests</span>:
    <span class="keyword">name</span>: <span class="string">Tests unitaires</span>
    <span class="keyword">runs-on</span>: <span class="string">ubuntu-latest</span>
    
    <span class="keyword">steps</span>:
      <span class="comment"># Récupérer le code</span>
      - <span class="keyword">uses</span>: <span class="string">actions/checkout@v3</span>
      
      <span class="comment"># Configurer PHP</span>
      - <span class="keyword">name</span>: <span class="string">Configurer PHP</span>
        <span class="keyword">uses</span>: <span class="string">shivammathur/setup-php@v2</span>
        <span class="keyword">with</span>:
          <span class="keyword">php-version</span>: <span class="string">'8.2'</span>
          <span class="keyword">extensions</span>: <span class="string">mbstring, xml, ctype, iconv, intl, pdo_sqlite, dom, filter</span>
          <span class="keyword">coverage</span>: <span class="string">xdebug</span>
      
      <span class="comment"># Installer les dépendances</span>
      - <span class="keyword">name</span>: <span class="string">Installer les dépendances</span>
        <span class="keyword">run</span>: <span class="string">composer install --prefer-dist</span>
      
      <span class="comment"># Exécuter les tests</span>
      - <span class="keyword">name</span>: <span class="string">Exécuter les tests</span>
        <span class="keyword">run</span>: <span class="string">./vendor/bin/phpunit</span>
      
      <span class="comment"># Générer un rapport de couverture</span>
      - <span class="keyword">name</span>: <span class="string">Générer la couverture de code</span>
        <span class="keyword">run</span>: <span class="string">./vendor/bin/phpunit --coverage-clover coverage.xml</span>
      
      <span class="comment"># Publier la couverture (optionnel)</span>
      - <span class="keyword">name</span>: <span class="string">Publier la couverture sur Codecov</span>
        <span class="keyword">uses</span>: <span class="string">codecov/codecov-action@v3</span>
        <span class="keyword">with</span>:
          <span class="keyword">file</span>: <span class="string">./coverage.xml</span>
</code></pre>
                <p>Ce workflow :</p>
                <ol>
                    <li>Se déclenche à chaque push sur main/develop ou lors d'une pull request</li>
                    <li>Configure PHP 8.2 avec Xdebug pour la couverture de code</li>
                    <li>Installe les dépendances via Composer</li>
                    <li>Exécute les tests PHPUnit</li>
                    <li>Génère et publie un rapport de couverture de code</li>
                </ol>
            </div>

            <div class="info-box">
                <strong>Badges de statut</strong>
                <p>Ajoutez un badge dans votre README.md pour afficher l'état de vos tests :</p>
                <pre><code class="language-markdown">[![Tests PHP](https://github.com/username/repo/actions/workflows/tests.yml/badge.svg)](https://github.com/username/repo/actions/workflows/tests.yml)
[![Couverture de code](https://codecov.io/gh/username/repo/branch/main/graph/badge.svg)](https://codecov.io/gh/username/repo)</code></pre>
                <p>Ces badges s'afficheront ainsi :</p>
                <img src="https://github.com/actions/starter-workflows/actions/workflows/dependency-review.yml/badge.svg" alt="Badge GitHub Actions">
                <img src="https://codecov.io/gh/codecov/codecov-php/branch/master/graph/badge.svg" alt="Badge couverture Codecov">
            </div>
        </section>
        <section class="section">
            <h2>Bonnes pratiques et conseils pour débutants</h2>

            <h3>Les principes FIRST pour des tests de qualité</h3>
            <div class="info-box">
                <ul>
                    <li><strong>F</strong>ast (Rapide) : Les tests doivent s'exécuter rapidement pour être utilisés souvent.</li>
                    <li><strong>I</strong>ndependent (Indépendant) : Chaque test doit pouvoir s'exécuter seul, sans dépendre d'autres tests.</li>
                    <li><strong>R</strong>epeatable (Reproductible) : Les tests doivent donner le même résultat à chaque exécution.</li>
                    <li><strong>S</strong>elf-validating (Auto-validant) : Les tests doivent déterminer eux-mêmes s'ils réussissent ou échouent.</li>
                    <li><strong>T</strong>imely (Opportun) : Idéalement, écrivez les tests avant ou en même temps que le code.</li>
                </ul>
            </div>

            <h3>Conseils pratiques pour débutants</h3>
            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Par où commencer ?</div>
                    <div class="example-content">
                        <ol>
                            <li><strong>Commencez petit</strong> : Testez d'abord des fonctions simples</li>
                            <li><strong>Testez les bugs</strong> : Chaque bug corrigé mérite un test</li>
                            <li><strong>Pratiquez le TDD</strong> : Test → Code → Refactoring</li>
                            <li><strong>Utilisez des fixtures</strong> : Pour préparer les données de test</li>
                        </ol>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Structure recommandée</div>
                    <div class="example-content">
                        <pre><code class="language-text">mon-projet/
├── src/
│   └── Calculator.php
├── tests/
│   └── CalculatorTest.php
├── composer.json
└── phpunit.xml</code></pre>
                        <div class="result">
                            <p>Configuration minimale dans <code>phpunit.xml</code> :</p>
                            <pre><code class="language-xml">&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;phpunit colors="true"&gt;
    &lt;testsuites&gt;
        &lt;testsuite name="Mon Application"&gt;
            &lt;directory&gt;tests&lt;/directory&gt;
        &lt;/testsuite&gt;
    &lt;/testsuites&gt;
&lt;/phpunit&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Éviter les pièges courants</h3>
            <div class="info-box warning-box">
                <strong>🚫 Ce qu'il faut éviter</strong>
                <ul>
                    <li><strong>Tests fragiles</strong> : Qui échouent pour des raisons externes (dates, données aléatoires)</li>
                    <li><strong>Tests lents</strong> : Comme les tests qui font des requêtes réelles à une base de données</li>
                    <li><strong>Tests interdépendants</strong> : Qui dépendent d'autres tests ou d'un état global</li>
                    <li><strong>Tests obscurs</strong> : Difficiles à comprendre ou à maintenir</li>
                </ul>
            </div>

            <h3>Ressources pour approfondir</h3>
            <div class="info-box">
                <strong>📚 Documentation et tutoriels</strong>
                <ul>
                    <li><a href="https://phpunit.de/" target="_blank">Documentation officielle PHPUnit</a></li>
                    <li><a href="https://phpunit.readthedocs.io/fr/latest/" target="_blank">Guide PHPUnit en français</a></li>
                    <li><a href="https://phptherightway.com/#testing" target="_blank">PHP The Right Way - Tests</a></li>
                    <li><a href="https://www.youtube.com/watch?v=K9jTQPb0Xso" target="_blank">Tutoriel vidéo : PHPUnit pour débutants</a></li>
                </ul>

                <strong>🛠 Outils complémentaires</strong>
                <ul>
                    <li><a href="https://github.com/marketplace/actions/setup-php-action" target="_blank">GitHub Action Setup PHP</a></li>
                    <li><a href="https://infection.github.io/" target="_blank">Infection - Tests de mutation pour PHP</a></li>
                    <li><a href="https://codeception.com/" target="_blank">Codeception - Framework de tests PHP complet</a></li>
                    <li><a href="https://pestphp.com/" target="_blank">Pest - Framework de tests élégant basé sur PHPUnit</a></li>
                </ul>
            </div>

            <div class="info-box success-box">
                <strong>💡 À retenir</strong>
                <p>Les tests unitaires sont un investissement : ils demandent du temps au début, mais vous en font gagner beaucoup plus sur le long terme en réduisant les bugs et en facilitant la maintenance.</p>
                <p>Commencez petit, soyez cohérent, et intégrez progressivement les tests à votre routine de développement !</p>
            </div>
        </section>

        <section class="section">
            <h2>Exercices pratiques</h2>
            <p>Pour vous familiariser avec PHPUnit, voici quelques exercices à réaliser :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Exercice 1 : Testez une classe Panier</div>
                    <div class="example-content">
                        <p>Créez une classe <code>ShoppingCart</code> avec les méthodes :</p>
                        <ul>
                            <li><code>addItem($item, $price, $quantity)</code></li>
                            <li><code>removeItem($item)</code></li>
                            <li><code>getTotal()</code></li>
                            <li><code>clear()</code></li>
                        </ul>
                        <p>Puis écrivez des tests unitaires pour vérifier le bon fonctionnement.</p>
                    </div>
                </div>
                <div class="example">
                    <div class="example-header">Exercice 2 : Testez un validateur</div>
                    <div class="example-content">
                        <p>Créez une classe <code>Validator</code> qui vérifie :</p>
                        <ul>
                            <li>Emails valides</li>
                            <li>Mots de passe forts (8+ caractères, mixte)</li>
                            <li>Numéros de téléphone</li>
                        </ul>
                        <p>Testez avec différentes entrées valides et invalides.</p>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <strong>💻 Code de départ pour l'exercice 1</strong>
                <pre><code class="language-php"><span class="comment">// src/ShoppingCart.php</span>
<span class="keyword">class</span> <span class="class-name">ShoppingCart</span> {
    <span class="keyword">private</span> <span class="variable">$items</span> = [];
    
    <span class="keyword">public function</span> <span class="function">addItem</span>(<span class="variable">$item</span>, <span class="variable">$price</span>, <span class="variable">$quantity</span> = <span class="number">1</span>) {
        <span class="keyword">if</span> (<span class="variable">$price</span> <= <span class="number">0</span>) {
            <span class="keyword">throw new</span> <span class="class-name">InvalidArgumentException</span>(<span class="string">"Le prix doit être positif"</span>);
        }
        
        <span class="keyword">if</span> (<span class="variable">$quantity</span> <= <span class="number">0</span>) {
            <span class="keyword">throw new</span> <span class="class-name">InvalidArgumentException</span>(<span class="string">"La quantité doit être positive"</span>);
        }
        
        <span class="variable">$this</span>-><span class="variable">items</span>[<span class="variable">$item</span>] = [
            <span class="string">'price'</span> => <span class="variable">$price</span>,
            <span class="string">'quantity'</span> => <span class="variable">$quantity</span>
        ];
    }
    
    <span class="comment">// À compléter : removeItem(), getTotal(), clear()</span>
}</code></pre>
            </div>
        </section>

        <div class="navigation">
            <a href="17-gestion-fichiers.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="19-envoi-emails.php" class="nav-button">Module suivant →</a>
        </div>

    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>