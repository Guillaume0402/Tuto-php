<?php
$moduleClass = 'module11';
include __DIR__ . '/../includes/header.php';
// Récupérer les informations de la page depuis la configuration
$pageKey = '11-POO-avancee';
$pageInfo = getPageInfo($pageKey);
$titre = $pageInfo['titre'];
$description = $pageInfo['description'];

// Exemples de classes abstraites, interfaces et traits pour la démonstration

// Interface basique
interface Animal
{
    public function manger();
    public function seDeplacer();
    public function emettreSon();
}

// Interface plus spécifique
interface Mammifere extends Animal
{
    public function allaiter();
}

// Classe abstraite
abstract class EtreVivant
{
    protected $nom;
    protected $age;

    public function __construct($nom, $age)
    {
        $this->nom = $nom;
        $this->age = $age;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getAge()
    {
        return $this->age;
    }

    abstract public function respirer();
}

// Trait pour réutilisation de code
trait Identifiable
{
    private $id;

    public function genererIdentifiant()
    {
        $this->id = uniqid(get_class($this) . '_');
    }

    public function getId()
    {
        return $this->id;
    }
}

// Classe concrète qui implémente des interfaces et étend une classe abstraite
class Chien extends EtreVivant implements Mammifere
{
    // Utilisation d'un trait
    use Identifiable;

    private $race;

    public function __construct($nom, $age, $race)
    {
        parent::__construct($nom, $age);
        $this->race = $race;
        $this->genererIdentifiant(); // Méthode du trait
    }

    // Implémentation des méthodes abstraites de la classe parente
    public function respirer()
    {
        return "{$this->nom} respire par les poumons.";
    }

    // Implémentation des méthodes de l'interface
    public function manger()
    {
        return "{$this->nom} mange des croquettes.";
    }

    public function seDeplacer()
    {
        return "{$this->nom} court sur ses quatre pattes.";
    }

    public function emettreSon()
    {
        return "{$this->nom} aboie : Wouaf !";
    }

    public function allaiter()
    {
        return "Une chienne peut allaiter ses chiots.";
    }

    public function getRace()
    {
        return $this->race;
    }
}

// Exemple de classe avec méthodes et propriétés statiques
class Compteur
{
    private static $compteur = 0;

    public static function incrementer()
    {
        self::$compteur++;
    }

    public static function getValeur()
    {
        return self::$compteur;
    }

    public static function reinitialiser()
    {
        self::$compteur = 0;
    }
}

// Classe finale (ne peut pas être étendue)
final class Configuration
{
    private static $instance = null;
    private $parametres = [];

    // Constructeur privé (pattern Singleton)
    private function __construct()
    {
        // Initialisation des paramètres par défaut
        $this->parametres = [
            'debug' => true,
            'timezone' => 'Europe/Paris',
            'version' => '1.0'
        ];
    }

    // Méthode pour obtenir l'instance unique
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Configuration();
        }
        return self::$instance;
    }

    public function getParametre($cle)
    {
        return isset($this->parametres[$cle]) ? $this->parametres[$cle] : null;
    }

    public function setParametre($cle, $valeur)
    {
        $this->parametres[$cle] = $valeur;
    }
}

// Création d'une instance pour la démonstration
$chien = new Chien("Rex", 3, "Berger Allemand");
?>

<div class="module-header">
    <h1><?= $titre ?></h1>
    <p class="subtitle"><?= $description ?></p>
</div>
<div class="navigation">
    <a href="10-POO-les-classes.php" class="nav-button">← Module précédent</a>
    <a href="../../index.php" class="nav-button">Accueil</a>
    <a href="12-bases-de-donnees.php" class="nav-button">Module suivant →</a>
</div>

<main>
    <section class="section">
        <h2>Introduction à la POO avancée</h2>
        <p>Après avoir maîtrisé les bases de la POO avec les classes, les propriétés et les méthodes, il est temps d'explorer les concepts avancés qui font la puissance de la Programmation Orientée Objet en PHP.</p>
        <p>Dans ce module, nous allons découvrir :</p>
        <ul>
            <li><strong>Les interfaces</strong> : définir des contrats que les classes doivent respecter</li>
            <li><strong>Les classes abstraites</strong> : créer des modèles partiellement implémentés</li>
            <li><strong>Les traits</strong> : réutiliser du code dans plusieurs classes</li>
            <li><strong>Les propriétés et méthodes statiques</strong> : partager des fonctionnalités entre toutes les instances</li>
            <li><strong>Les classes et méthodes finales</strong> : empêcher l'héritage ou la redéfinition</li>
            <li><strong>Les méthodes magiques</strong> : intercepter des actions spécifiques sur les objets</li>
        </ul>

        <div class="info-box">
            <p><strong>Prérequis :</strong> Pour bien comprendre ce module, vous devez déjà maîtriser les concepts de base de la POO présentés dans le <a href="10-POO-les-classes.php">module précédent</a>.</p>
        </div>
    </section>

    <section class="section">
        <h2>Les Interfaces</h2>
        <p>Une interface définit un contrat qu'une classe doit respecter. Elle contient uniquement des déclarations de méthodes (sans implémentation) que les classes qui l'implémentent doivent définir.</p>

        <div class="example">
            <div class="example-header">Déclaration d'une Interface</div>
            <div class="example-content">
                <pre><code><span class="interface-keyword">interface</span> <span class="interface-name">Animal</span> {
    <span class="keyword">public function</span> <span class="method">manger</span>();
    <span class="keyword">public function</span> <span class="method">seDeplacer</span>();
    <span class="keyword">public function</span> <span class="method">emettreSon</span>();
}</code></pre>
            </div>
        </div>

        <h3>Caractéristiques des interfaces</h3>
        <ul>
            <li>Une interface ne peut contenir que des déclarations de méthodes (sans implémentation)</li>
            <li>Toutes les méthodes d'une interface sont implicitement <code>public</code></li>
            <li>Une interface peut étendre une ou plusieurs autres interfaces</li>
            <li>Une classe peut implémenter plusieurs interfaces</li>
            <li>Une classe doit implémenter toutes les méthodes définies dans les interfaces qu'elle implémente</li>
        </ul>

        <div class="example">
            <div class="example-header">Interface étendue et implémentation</div>
            <div class="example-content">
                <pre><code><span class="interface-keyword">interface</span> <span class="interface-name">Mammifere</span> <span class="extends-keyword">extends</span> <span class="interface-name">Animal</span> {
    <span class="keyword">public function</span> <span class="method">allaiter</span>();
}

<span class="class-keyword">class</span> <span class="class-name">Chien</span> <span class="implements-keyword">implements</span> <span class="interface-name">Mammifere</span> {
    <span class="keyword">private</span> <span class="property">$nom</span>;
    
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>) {
        <span class="variable">$this</span>-><span class="property">nom</span> = <span class="variable">$nom</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">manger</span>() {
        <span class="keyword">return</span> <span class="string">"{$this->nom} mange des croquettes."</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">seDeplacer</span>() {
        <span class="keyword">return</span> <span class="string">"{$this->nom} court sur ses quatre pattes."</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">emettreSon</span>() {
        <span class="keyword">return</span> <span class="string">"{$this->nom} aboie : Wouaf !"</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">allaiter</span>() {
        <span class="keyword">return</span> <span class="string">"Une chienne peut allaiter ses chiots."</span>;
    }
}</code></pre>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Les Classes Abstraites</h2>
        <p>Une classe abstraite est une classe qui ne peut pas être instanciée directement. Elle sert de modèle pour d'autres classes qui vont l'étendre. Elle peut contenir à la fois des méthodes concrètes (avec implémentation) et des méthodes abstraites (sans implémentation).</p>

        <div class="example">
            <div class="example-header">Déclaration d'une Classe Abstraite</div>
            <div class="example-content">
                <pre><code><span class="abstract-keyword">abstract class</span> <span class="abstract-name">EtreVivant</span> {
    <span class="keyword">protected</span> <span class="property">$nom</span>;
    <span class="keyword">protected</span> <span class="property">$age</span>;
    
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>) {
        <span class="variable">$this</span>-><span class="property">nom</span> = <span class="variable">$nom</span>;
        <span class="variable">$this</span>-><span class="property">age</span> = <span class="variable">$age</span>;
    }
    
    <span class="comment">// Méthode concrète avec implémentation</span>
    <span class="keyword">public function</span> <span class="method">getNom</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">nom</span>;
    }
    
    <span class="comment">// Méthode abstraite sans implémentation</span>
    <span class="abstract-keyword">abstract public function</span> <span class="method">respirer</span>();
}</code></pre>
            </div>
        </div>

        <h3>Caractéristiques des classes abstraites</h3>
        <ul>
            <li>Une classe abstraite ne peut pas être instanciée directement</li>
            <li>Elle peut contenir des méthodes concrètes (avec implémentation) et des méthodes abstraites (sans implémentation)</li>
            <li>Les méthodes abstraites doivent être implémentées par les classes qui étendent la classe abstraite</li>
            <li>Une classe abstraite peut implémenter des interfaces</li>
            <li>Une classe ne peut étendre qu'une seule classe abstraite (pas d'héritage multiple en PHP)</li>
        </ul>

        <div class="example">
            <div class="example-header">Extension d'une Classe Abstraite</div>
            <div class="example-content">
                <pre><code><span class="class-keyword">class</span> <span class="class-name">Chien</span> <span class="extends-keyword">extends</span> <span class="abstract-name">EtreVivant</span> {
    <span class="keyword">private</span> <span class="property">$race</span>;
    
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>, <span class="variable">$race</span>) {
        <span class="keyword">parent</span>::<span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>);
        <span class="variable">$this</span>-><span class="property">race</span> = <span class="variable">$race</span>;
    }
    
    <span class="comment">// Implémentation de la méthode abstraite</span>
    <span class="keyword">public function</span> <span class="method">respirer</span>() {
        <span class="keyword">return</span> <span class="string">"{$this->nom} respire par les poumons."</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">getRace</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">race</span>;
    }
}</code></pre>

                <div class="result">
                    <h4>Exemple avec notre classe Chien :</h4>
                    <?php
                    echo "<p><strong>Nom :</strong> " . $chien->getNom() . "</p>";
                    echo "<p><strong>Race :</strong> " . $chien->getRace() . "</p>";
                    echo "<p><strong>Action :</strong> " . $chien->respirer() . "</p>";
                    echo "<p><strong>Action :</strong> " . $chien->emettreSon() . "</p>";
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Interface vs Classe Abstraite</h2>
        <p>Les interfaces et les classes abstraites servent à des fins similaires mais ont des différences importantes :</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Interface</div>
                <div class="example-content">
                    <ul>
                        <li>Contient uniquement des déclarations de méthodes (sans implémentation)</li>
                        <li>Toutes les méthodes sont implicitement <code>public</code></li>
                        <li>Une classe peut implémenter plusieurs interfaces</li>
                        <li>Définit un "contrat" que la classe doit respecter</li>
                        <li>Utilisée quand vous voulez définir un comportement commun que différentes classes non liées doivent implémenter</li>
                        <li>Pas d'état (propriétés) ni de code réutilisable</li>
                    </ul>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Classe Abstraite</div>
                <div class="example-content">
                    <ul>
                        <li>Peut contenir des méthodes concrètes (avec implémentation) et des méthodes abstraites</li>
                        <li>Peut avoir des méthodes de tous les niveaux d'accès (public, protected, private)</li>
                        <li>Une classe ne peut étendre qu'une seule classe abstraite</li>
                        <li>Fournit un modèle partiellement implémenté</li>
                        <li>Utilisée quand vous voulez partager du code entre des classes étroitement liées</li>
                        <li>Peut avoir des propriétés et du code réutilisable</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tip-box">
            <p><strong>Conseil de choix :</strong></p>
            <ul>
                <li>Utilisez une <strong>interface</strong> lorsque différentes classes non liées doivent partager un comportement commun sans partager de code.</li>
                <li>Utilisez une <strong>classe abstraite</strong> lorsque vous avez un groupe de classes liées qui doivent partager du code commun.</li>
            </ul>
        </div>
        <pre><code>
<span style="color: #c586c0;">EtreVivant (abstract)</span>

# nom: string
# age: int
+ __construct(nom: string, age: int)
+ getNom(): string
+ getAge(): int
+ <span style="font-style: italic;">respirer(): string</span> (abstract)

↑

<span style="color: #4ec9b0;">Chien</span>

- race: string
+ __construct(nom: string, age: int, race: string)
+ respirer(): string
+ getRace(): string

↗

<span style="color: #4fc1ff;">Mammifere</span>

+ manger(): string
+ seDeplacer(): string
+ emettreSon(): string
+ allaiter(): string

<span style="font-style: italic; color: #888;">Note: Mammifere étend l'interface Animal</span>
</code></pre>
    </section>

    <section class="section">
        <h2>Les Traits</h2>
        <p>Les traits sont un mécanisme permettant la réutilisation de code dans des langages à héritage simple comme PHP. Un trait est similaire à une classe, mais son seul but est de regrouper des fonctionnalités de manière cohérente dans une ou plusieurs classes.</p>

        <div class="example">
            <div class="example-header">Déclaration d'un Trait</div>
            <div class="example-content">
                <pre><code><span class="trait-keyword">trait</span> <span class="trait-name">Identifiable</span> {
    <span class="keyword">private</span> <span class="property">$id</span>;
    
    <span class="keyword">public function</span> <span class="method">genererIdentifiant</span>() {
        <span class="variable">$this</span>-><span class="property">id</span> = <span class="function">uniqid</span>(<span class="function">get_class</span>(<span class="variable">$this</span>) . <span class="string">'_'</span>);
    }
    
    <span class="keyword">public function</span> <span class="method">getId</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">id</span>;
    }
}</code></pre>
            </div>
        </div>

        <h3>Utilisation des traits</h3>
        <p>Pour utiliser un trait dans une classe, on utilise le mot-clé <code>use</code> à l'intérieur de la déclaration de la classe :</p>

        <div class="example">
            <div class="example-header">Utilisation d'un Trait dans une Classe</div>
            <div class="example-content">
                <pre><code><span class="class-keyword">class</span> <span class="class-name">Chien</span> <span class="extends-keyword">extends</span> <span class="abstract-name">EtreVivant</span> <span class="implements-keyword">implements</span> <span class="interface-name">Mammifere</span> {
    <span class="comment">// Utilisation du trait</span>
    <span class="use-keyword">use</span> <span class="trait-name">Identifiable</span>;
    
    <span class="keyword">private</span> <span class="property">$race</span>;
    
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>, <span class="variable">$race</span>) {
        <span class="keyword">parent</span>::<span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>);
        <span class="variable">$this</span>-><span class="property">race</span> = <span class="variable">$race</span>;
        <span class="variable">$this</span>-><span class="method">genererIdentifiant</span>(); <span class="comment">// Méthode du trait</span>
    }
    
    <span class="comment">// Implémentations des méthodes...</span>
}</code></pre>

                <div class="result">
                    <h4>Exemple avec notre trait Identifiable :</h4>
                    <?php
                    echo "<p><strong>Identifiant du chien :</strong> " . $chien->getId() . "</p>";
                    ?>
                </div>
            </div>
        </div>

        <h3>Caractéristiques des traits</h3>
        <ul>
            <li>Un trait peut contenir des méthodes et des propriétés</li>
            <li>Une classe peut utiliser plusieurs traits</li>
            <li>Les méthodes d'un trait peuvent être abstraites</li>
            <li>Les traits peuvent utiliser d'autres traits</li>
            <li>En cas de conflit de noms, vous pouvez les résoudre avec l'opérateur de résolution <code>insteadof</code> ou les renommer avec <code>as</code></li>
        </ul>

        <div class="example">
            <div class="example-header">Résolution de conflits avec plusieurs traits</div>
            <div class="example-content">
                <pre><code><span class="trait-keyword">trait</span> <span class="trait-name">A</span> {
    <span class="keyword">public function</span> <span class="method">bonjour</span>() {
        <span class="keyword">return</span> <span class="string">"Bonjour de A!"</span>;
    }
}

<span class="trait-keyword">trait</span> <span class="trait-name">B</span> {
    <span class="keyword">public function</span> <span class="method">bonjour</span>() {
        <span class="keyword">return</span> <span class="string">"Bonjour de B!"</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">salut</span>() {
        <span class="keyword">return</span> <span class="string">"Salut de B!"</span>;
    }
}

<span class="class-keyword">class</span> <span class="class-name">C</span> {
    <span class="comment">// Résolution de conflits</span>
    <span class="use-keyword">use</span> <span class="trait-name">A</span>, <span class="trait-name">B</span> {
        <span class="class-name">B</span>::<span class="method">bonjour</span> <span class="keyword">insteadof</span> <span class="class-name">A</span>; <span class="comment">// Utiliser bonjour de B</span>
        <span class="class-name">A</span>::<span class="method">bonjour</span> <span class="keyword">as</span> <span class="method">bonjourA</span>; <span class="comment">// Renommer bonjour de A</span>
    }
}</code></pre>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Propriétés et Méthodes Statiques</h2>
        <p>Les propriétés et méthodes statiques appartiennent à la classe elle-même plutôt qu'à une instance spécifique. Elles sont accessibles sans avoir besoin d'instancier la classe.</p>

        <div class="example">
            <div class="example-header">Déclaration et utilisation de membres statiques</div>
            <div class="example-content">
                <pre><code><span class="class-keyword">class</span> <span class="class-name">Compteur</span> {
    <span class="keyword">private static</span> <span class="property">$compteur</span> = <span class="number">0</span>;
    
    <span class="keyword">public static function</span> <span class="method">incrementer</span>() {
        <span class="keyword">self</span>::<span class="property">$compteur</span>++;
    }
    
    <span class="keyword">public static function</span> <span class="method">getValeur</span>() {
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="property">$compteur</span>;
    }
    
    <span class="keyword">public static function</span> <span class="method">reinitialiser</span>() {
        <span class="keyword">self</span>::<span class="property">$compteur</span> = <span class="number">0</span>;
    }
}</code></pre>

                <p>Utilisation :</p>
                <pre><code><span class="keyword">echo</span> <span class="class-name">Compteur</span>::<span class="method">getValeur</span>(); <span class="comment">// Affiche 0</span>
<span class="class-name">Compteur</span>::<span class="method">incrementer</span>();
<span class="class-name">Compteur</span>::<span class="method">incrementer</span>();
<span class="keyword">echo</span> <span class="class-name">Compteur</span>::<span class="method">getValeur</span>(); <span class="comment">// Affiche 2</span>
<span class="class-name">Compteur</span>::<span class="method">reinitialiser</span>();
<span class="keyword">echo</span> <span class="class-name">Compteur</span>::<span class="method">getValeur</span>(); <span class="comment">// Affiche 0</span></code></pre>

                <div class="result">
                    <h4>Exemple avec notre classe Compteur :</h4>
                    <?php
                    echo "<p>Valeur initiale : " . Compteur::getValeur() . "</p>";
                    Compteur::incrementer();
                    echo "<p>Après un incrément : " . Compteur::getValeur() . "</p>";
                    Compteur::incrementer();
                    echo "<p>Après un autre incrément : " . Compteur::getValeur() . "</p>";
                    Compteur::reinitialiser();
                    echo "<p>Après réinitialisation : " . Compteur::getValeur() . "</p>";
                    ?>
                </div>
            </div>
        </div>

        <h3>Caractéristiques des membres statiques</h3>
        <ul>
            <li>Ils sont accessibles sans avoir besoin d'instancier la classe (avec l'opérateur de résolution de portée <code>::</code>)</li>
            <li>Ils sont partagés par toutes les instances de la classe</li>
            <li>Dans les méthodes statiques, <code>$this</code> n'est pas disponible car il n'y a pas d'instance de la classe</li>
            <li>On utilise <code>self::</code> pour accéder aux membres statiques à l'intérieur de la classe</li>
            <li>On utilise <code>static::</code> pour la liaison dynamique (résolution à l'exécution)</li>
        </ul>

        <div class="tip-box">
            <p><strong>Cas d'utilisation :</strong> Les membres statiques sont utiles pour représenter des données ou comportements qui sont liés à la classe dans son ensemble, comme des compteurs, des utilitaires, ou des instances uniques (pattern Singleton).</p>
        </div>
    </section>

    <section class="section">
        <h2>Classes et Méthodes Finales</h2>
        <p>Le mot-clé <code>final</code> empêche l'héritage des classes ou la redéfinition des méthodes dans les classes filles.</p>

        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Classe finale</div>
                <div class="example-content">
                    <pre><code><span class="final-keyword">final class</span> <span class="class-name">Configuration</span> {
    <span class="keyword">private static</span> <span class="property">$instance</span> = <span class="keyword">null</span>;
    <span class="keyword">private</span> <span class="property">$parametres</span> = [];
    
    <span class="keyword">private function</span> <span class="method">__construct</span>() {
        <span class="variable">$this</span>-><span class="property">parametres</span> = [
            <span class="string">'debug'</span> => <span class="keyword">true</span>,
            <span class="string">'timezone'</span> => <span class="string">'Europe/Paris'</span>
        ];
    }
    
    <span class="keyword">public static function</span> <span class="method">getInstance</span>() {
        <span class="keyword">if</span> (<span class="keyword">self</span>::<span class="property">$instance</span> === <span class="keyword">null</span>) {
            <span class="keyword">self</span>::<span class="property">$instance</span> = <span class="keyword">new</span> <span class="class-name">Configuration</span>();
        }
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="property">$instance</span>;
    }
    
    <span class="comment">// Méthodes pour accéder aux paramètres</span>
}</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Méthode finale</div>
                <div class="example-content">
                    <pre><code><span class="class-keyword">class</span> <span class="class-name">Base</span> {
    <span class="final-keyword">final public function</span> <span class="method">methodeCritique</span>() {
        <span class="keyword">return</span> <span class="string">"Cette méthode ne peut pas être redéfinie"</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">methodeNormale</span>() {
        <span class="keyword">return</span> <span class="string">"Cette méthode peut être redéfinie"</span>;
    }
}

<span class="class-keyword">class</span> <span class="class-name">Derivee</span> <span class="extends-keyword">extends</span> <span class="class-name">Base</span> {
    <span class="comment">// Impossible de redéfinir methodeCritique</span>
    
    <span class="keyword">public function</span> <span class="method">methodeNormale</span>() {
        <span class="keyword">return</span> <span class="string">"Méthode redéfinie"</span>;
    }
}</code></pre>
                </div>
            </div>
        </div>

        <div class="warning-box">
            <p><strong>Important :</strong> Utilisez <code>final</code> avec prudence car il limite l'extensibilité de votre code. Il est généralement utilisé pour sécuriser des parties critiques d'un système ou pour optimiser les performances en évitant les appels de méthodes virtuelles.</p>
        </div>
    </section>

    <section class="section">
        <h2>Méthodes Magiques</h2>
        <p>PHP fournit un ensemble de méthodes magiques qui sont invoquées automatiquement en réponse à certains événements ou actions sur un objet. Ces méthodes commencent par deux underscore (<code>__</code>).</p>

        <div class="example">
            <div class="example-header">Méthodes magiques courantes</div>
            <div class="example-content">
                <pre><code><span class="class-keyword">class</span> <span class="class-name">Exemple</span> {
    <span class="keyword">private</span> <span class="property">$donnees</span> = [];
    
    <span class="comment">// Appelée lors de la lecture d'une propriété non accessible</span>
    <span class="keyword">public function</span> <span class="method">__get</span>(<span class="variable">$nom</span>) {
        <span class="keyword">if</span> (<span class="function">array_key_exists</span>(<span class="variable">$nom</span>, <span class="variable">$this</span>-><span class="property">donnees</span>)) {
            <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">donnees</span>[<span class="variable">$nom</span>];
        }
        <span class="keyword">return</span> <span class="keyword">null</span>;
    }
    
    <span class="comment">// Appelée lors de l'écriture dans une propriété non accessible</span>
    <span class="keyword">public function</span> <span class="method">__set</span>(<span class="variable">$nom</span>, <span class="variable">$valeur</span>) {
        <span class="variable">$this</span>-><span class="property">donnees</span>[<span class="variable">$nom</span>] = <span class="variable">$valeur</span>;
    }
    
    <span class="comment">// Appelée lors de la vérification de l'existence d'une propriété</span>
    <span class="keyword">public function</span> <span class="method">__isset</span>(<span class="variable">$nom</span>) {
        <span class="keyword">return</span> <span class="function">isset</span>(<span class="variable">$this</span>-><span class="property">donnees</span>[<span class="variable">$nom</span>]);
    }
    
    <span class="comment">// Appelée lors de la suppression d'une propriété</span>
    <span class="keyword">public function</span> <span class="method">__unset</span>(<span class="variable">$nom</span>) {
        <span class="function">unset</span>(<span class="variable">$this</span>-><span class="property">donnees</span>[<span class="variable">$nom</span>]);
    }
    
    <span class="comment">// Appelée lors de l'appel d'une méthode non accessible</span>
    <span class="keyword">public function</span> <span class="method">__call</span>(<span class="variable">$nom</span>, <span class="variable">$arguments</span>) {
        <span class="keyword">echo</span> <span class="string">"Appel de la méthode '$nom' avec les arguments: "</span> 
             . <span class="function">implode</span>(<span class="string">", "</span>, <span class="variable">$arguments</span>);
    }
    
    <span class="comment">// Appelée lors de l'appel d'une méthode statique non accessible</span>
    <span class="keyword">public static function</span> <span class="method">__callStatic</span>(<span class="variable">$nom</span>, <span class="variable">$arguments</span>) {
        <span class="keyword">echo</span> <span class="string">"Appel de la méthode statique '$nom'"</span>;
    }
    
    <span class="comment">// Appelée lors de la conversion de l'objet en chaîne</span>
    <span class="keyword">public function</span> <span class="method">__toString</span>() {
        <span class="keyword">return</span> <span class="string">"Exemple avec "</span> . <span class="function">count</span>(<span class="variable">$this</span>-><span class="property">donnees</span>) . <span class="string">" propriétés"</span>;
    }
    
    <span class="comment">// Appelée lors du débogage avec var_dump</span>
    <span class="keyword">public function</span> <span class="method">__debugInfo</span>() {
        <span class="keyword">return</span> [
            <span class="string">'info'</span> => <span class="string">"Objet de débogage"</span>,
            <span class="string">'donnees_count'</span> => <span class="function">count</span>(<span class="variable">$this</span>-><span class="property">donnees</span>)
        ];
    }
}</code></pre>
            </div>
        </div>

        <div class="tip-box">
            <p><strong>Autres méthodes magiques :</strong></p>
            <ul>
                <li><code>__construct()</code> : Constructeur de la classe</li>
                <li><code>__destruct()</code> : Destructeur de la classe</li>
                <li><code>__clone()</code> : Appelée lors du clonage de l'objet</li>
                <li><code>__invoke()</code> : Permet d'utiliser l'objet comme une fonction</li>
                <li><code>__sleep()</code> et <code>__wakeup()</code> : Contrôlent la sérialisation</li>
                <li><code>__serialize()</code> et <code>__unserialize()</code> : Nouveaux contrôles de sérialisation (PHP 7.4+)</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <h2>Design Patterns et POO Avancée</h2>
        <p>Les design patterns (patrons de conception) sont des solutions éprouvées à des problèmes récurrents en conception de logiciel. En combinant les concepts avancés de POO, vous pouvez implémenter ces patterns en PHP.</p>

        <h3>Exemples de design patterns en PHP</h3>
        <div class="examples-grid">
            <div class="example">
                <div class="example-header">Pattern Singleton</div>
                <div class="example-content">
                    <p>Garantit qu'une classe n'a qu'une seule instance et fournit un point d'accès global à celle-ci.</p>
                    <pre><code><span class="class-keyword">class</span> <span class="class-name">Singleton</span> {
    <span class="keyword">private static</span> <span class="property">$instance</span> = <span class="keyword">null</span>;
    
    <span class="keyword">private function</span> <span class="method">__construct</span>() { } <span class="comment">// Constructeur privé</span>
    <span class="keyword">private function</span> <span class="method">__clone</span>() { } <span class="comment">// Clonage privé</span>
    
    <span class="keyword">public static function</span> <span class="method">getInstance</span>() {
        <span class="keyword">if</span> (<span class="keyword">self</span>::<span class="property">$instance</span> === <span class="keyword">null</span>) {
            <span class="keyword">self</span>::<span class="property">$instance</span> = <span class="keyword">new</span> <span class="class-name">self</span>();
        }
        <span class="keyword">return</span> <span class="keyword">self</span>::<span class="property">$instance</span>;
    }
}</code></pre>
                </div>
            </div>

            <div class="example">
                <div class="example-header">Pattern Factory</div>
                <div class="example-content">
                    <p>Crée des objets sans exposer la logique de création.</p>
                    <pre><code><span class="interface-keyword">interface</span> <span class="interface-name">Produit</span> {
    <span class="keyword">public function</span> <span class="method">operation</span>();
}

<span class="class-keyword">class</span> <span class="class-name">ProduitConcretA</span> <span class="implements-keyword">implements</span> <span class="interface-name">Produit</span> {
    <span class="keyword">public function</span> <span class="method">operation</span>() {
        <span class="keyword">return</span> <span class="string">"Résultat de ProduitConcretA"</span>;
    }
}

<span class="class-keyword">class</span> <span class="class-name">ProduitConcretB</span> <span class="implements-keyword">implements</span> <span class="interface-name">Produit</span> {
    <span class="keyword">public function</span> <span class="method">operation</span>() {
        <span class="keyword">return</span> <span class="string">"Résultat de ProduitConcretB"</span>;
    }
}

<span class="class-keyword">class</span> <span class="class-name">Fabrique</span> {
    <span class="keyword">public static function</span> <span class="method">creerProduit</span>(<span class="variable">$type</span>) {
        <span class="keyword">if</span> (<span class="variable">$type</span> === <span class="string">'A'</span>) {
            <span class="keyword">return</span> <span class="keyword">new</span> <span class="class-name">ProduitConcretA</span>();
        } <span class="keyword">else</span> <span class="keyword">if</span> (<span class="variable">$type</span> === <span class="string">'B'</span>) {
            <span class="keyword">return</span> <span class="keyword">new</span> <span class="class-name">ProduitConcretB</span>();
        }
        <span class="keyword">throw new</span> <span class="class-name">Exception</span>(<span class="string">"Type de produit inconnu"</span>);
    }
}</code></pre>
                </div>
            </div>
        </div>

        <div class="tip-box">
            <p><strong>Autres design patterns courants en PHP :</strong></p>
            <ul>
                <li><strong>Observer</strong> : Pour implémenter des systèmes d'événements</li>
                <li><strong>Strategy</strong> : Pour définir une famille d'algorithmes interchangeables</li>
                <li><strong>Dependency Injection</strong> : Pour réduire le couplage entre les classes</li>
                <li><strong>Repository</strong> : Pour abstraire l'accès aux données</li>
                <li><strong>MVC</strong> : Pour séparer les préoccupations dans les applications web</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <h2>Bonnes pratiques en POO avancée</h2>
        <ul>
            <li><strong>Principe SOLID</strong> : Un ensemble de principes de conception orientée objet
                <ul>
                    <li><strong>S</strong>ingle Responsibility : Une classe ne devrait avoir qu'une seule responsabilité</li>
                    <li><strong>O</strong>pen/Closed : Ouvert à l'extension, fermé à la modification</li>
                    <li><strong>L</strong>iskov Substitution : Les objets d'une classe dérivée devraient pouvoir remplacer des objets de la classe de base</li>
                    <li><strong>I</strong>nterface Segregation : Les interfaces spécifiques sont préférables aux interfaces génériques</li>
                    <li><strong>D</strong>ependency Inversion : Dépendez des abstractions, pas des implémentations concrètes</li>
                </ul>
            </li>
            <li><strong>Préférez la composition à l'héritage</strong> : La composition offre souvent plus de flexibilité</li>
            <li><strong>Limitez la profondeur de l'héritage</strong> : Évitez les hiérarchies d'héritage trop profondes</li>
            <li><strong>Utilisez les interfaces pour définir des contrats</strong> : Favorisez le couplage faible</li>
            <li><strong>Nommez clairement vos abstractions</strong> : Les noms devraient refléter le rôle ou le comportement</li>
            <li><strong>Documentez votre code</strong> : Utilisez PHPDoc pour expliciter les attentes et les contrats</li>
        </ul>

        <div class="info-box">
            <p><strong>Ressources supplémentaires :</strong></p>
            <ul>
                <li><a href="https://www.php.net/manual/fr/language.oop5.interfaces.php" target="_blank">Documentation officielle PHP sur les interfaces</a></li>
                <li><a href="https://www.php.net/manual/fr/language.oop5.abstract.php" target="_blank">Documentation officielle PHP sur les classes abstraites</a></li>
                <li><a href="https://www.php.net/manual/fr/language.oop5.traits.php" target="_blank">Documentation officielle PHP sur les traits</a></li>
                <li><a href="https://refactoring.guru/design-patterns/php" target="_blank">Design Patterns en PHP</a></li>
                <li><a href="https://www.php-fig.org/psr/" target="_blank">PHP Standards Recommendations (PSR)</a></li>
            </ul>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>