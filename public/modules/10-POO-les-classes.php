<?php include __DIR__ . '/../includes/header-pro.php';



/**
 * Tutoriel PHP - POO: Les Classes
 * Ce fichier présente les concepts fondamentaux de la Programmation Orientée Objet en PHP
 */

// Inclusion du fichier de configuration
require_once 'includes/config.php';

// Récupérer les informations de la page depuis la configuration
$pageKey = '10-POO-les-classes';
$pageInfo = getPageInfo($pageKey);
$titre = $pageInfo['titre'];
$description = $pageInfo['description'];

// Exemples de classes pour la démonstration
class Personne
{
    // Propriétés
    public $nom;
    public $prenom;
    protected $age;
    private $identifiant;

    // Constructeur
    public function __construct($nom, $prenom, $age = 18)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->identifiant = uniqid('personne_');
    }

    // Méthodes
    public function sePresenter()
    {
        return "Bonjour, je m'appelle {$this->prenom} {$this->nom} et j'ai {$this->age} ans.";
    }

    public function celebrerAnniversaire()
    {
        $this->age++;
        return "C'est mon anniversaire! J'ai maintenant {$this->age} ans.";
    }

    // Getters & Setters
    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        if ($age >= 0 && $age <= 120) {
            $this->age = $age;
            return true;
        }
        return false;
    }

    public function getIdentifiant()
    {
        return $this->identifiant;
    }
}

// Classe enfant qui hérite de Personne
class Etudiant extends Personne
{
    private $formation;
    private $notes = [];

    public function __construct($nom, $prenom, $age, $formation)
    {
        parent::__construct($nom, $prenom, $age);
        $this->formation = $formation;
    }

    public function sePresenter()
    {
        return parent::sePresenter() . " Je suis étudiant en {$this->formation}.";
    }

    public function ajouterNote($matiere, $note)
    {
        $this->notes[$matiere] = $note;
    }

    public function calculerMoyenne()
    {
        if (empty($this->notes)) {
            return 0;
        }
        return array_sum($this->notes) / count($this->notes);
    }

    public function getFormation()
    {
        return $this->formation;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="module10">
    <header>
        <h1><?php echo $titre; ?></h1>
        <p class="subtitle"><?php echo $description; ?></p>
    </header>
    <div class="navigation">
        <a href="09-les-formulaires.php" class="nav-button">← Module précédent</a>
        <a href="../../index.php" class="nav-button">Accueil</a>
        <a href="11-POO-avancee.php" class="nav-button">Module suivant →</a>
    </div>
    <main>
        <section class="section">
            <h2>Introduction à la POO</h2>
            <p>La Programmation Orientée Objet (POO) est un paradigme de programmation qui utilise des "objets" pour modéliser des données et comportements. En PHP, la POO permet d'organiser votre code de manière plus structurée, modulaire et réutilisable.</p>
            <p>Les principaux concepts de la POO sont :</p>
            <ul>
                <li><strong>Classes</strong> : modèles ou plans pour créer des objets</li>
                <li><strong>Objets</strong> : instances de classes</li>
                <li><strong>Propriétés</strong> : variables appartenant à une classe</li>
                <li><strong>Méthodes</strong> : fonctions appartenant à une classe</li>
                <li><strong>Encapsulation</strong> : protection des données internes d'un objet</li>
                <li><strong>Héritage</strong> : création de nouvelles classes à partir de classes existantes</li>
                <li><strong>Polymorphisme</strong> : capacité à traiter différents types d'objets de manière uniforme</li>
                <li><strong>Abstraction</strong> : séparation de l'interface et de l'implémentation</li>
            </ul>

            <div class="info-box">
                <p><strong>Note :</strong> PHP supporte la POO depuis PHP 5, avec des améliorations significatives dans chaque version ultérieure. PHP 8 a notamment introduit de nouvelles fonctionnalités pour la POO comme les attributs et les types de retour union.</p>
            </div>
        </section>

        <section class="section">
            <h2>Créer une Classe</h2>
            <p>Une classe est une structure qui définit les propriétés et les méthodes pour un type d'objet. En PHP, on déclare une classe avec le mot-clé <code>class</code> :</p>

            <div class="example">
                <div class="example-header">Structure de base d'une classe</div>
                <div class="example-content">
                    <pre><code><span class="class-keyword">class</span> <span class="class-name">Personne</span> {
    <span class="comment">// Propriétés (attributs)</span>
    <span class="keyword">public</span> <span class="property">$nom</span>;
    <span class="keyword">public</span> <span class="property">$prenom</span>;
    <span class="keyword">protected</span> <span class="property">$age</span>;
    <span class="keyword">private</span> <span class="property">$identifiant</span>;
    
    <span class="comment">// Constructeur (méthode spéciale)</span>
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$prenom</span>, <span class="variable">$age</span> = <span class="number">18</span>) {
        <span class="variable">$this</span>-><span class="property">nom</span> = <span class="variable">$nom</span>;
        <span class="variable">$this</span>-><span class="property">prenom</span> = <span class="variable">$prenom</span>;
        <span class="variable">$this</span>-><span class="property">age</span> = <span class="variable">$age</span>;
        <span class="variable">$this</span>-><span class="property">identifiant</span> = <span class="function">uniqid</span>(<span class="string">'personne_'</span>);
    }
    
    <span class="comment">// Méthodes</span>
    <span class="keyword">public function</span> <span class="method">sePresenter</span>() {
        <span class="keyword">return</span> <span class="string">"Bonjour, je m'appelle {</span><span class="variable">$this</span>-><span class="property">prenom</span><span class="string">} {</span><span class="variable">$this</span>-><span class="property">nom</span><span class="string">} et j'ai {</span><span class="variable">$this</span>-><span class="property">age</span><span class="string">} ans."</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">celebrerAnniversaire</span>() {
        <span class="variable">$this</span>-><span class="property">age</span>++;
        <span class="keyword">return</span> <span class="string">"C'est mon anniversaire! J'ai maintenant {</span><span class="variable">$this</span>-><span class="property">age</span><span class="string">} ans."</span>;
    }
}</code></pre>
                </div>
            </div>

            <h3>Éléments d'une classe</h3>
            <ul>
                <li><strong>Propriétés</strong> : Les variables de la classe qui stockent des données</li>
                <li><strong>Constructeur</strong> : Méthode spéciale appelée lors de la création d'un objet</li>
                <li><strong>Méthodes</strong> : Les fonctions de la classe qui définissent son comportement</li>
                <li><strong>$this</strong> : Référence à l'instance actuelle de la classe</li>
            </ul>
        </section>

        <section class="section">
            <h2>Modificateurs d'accès</h2>
            <p>PHP propose trois niveaux d'accès pour les propriétés et méthodes d'une classe :</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">public</div>
                    <div class="example-content">
                        <ul>
                            <li>Accessible de partout, à l'intérieur et à l'extérieur de la classe</li>
                            <li>Offre le moins d'encapsulation</li>
                            <li>Utile pour les propriétés et méthodes qui doivent être largement accessibles</li>
                        </ul>
                        <pre><code><span class="keyword">public</span> <span class="property">$nom</span>; <span class="comment">// Propriété publique</span>
<span class="keyword">public function</span> <span class="method">sePresenter</span>() { <span class="comment">// Méthode publique</span>
    <span class="comment">// Code</span>
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">protected</div>
                    <div class="example-content">
                        <ul>
                            <li>Accessible à l'intérieur de la classe et dans les classes qui en héritent</li>
                            <li>Offre une encapsulation moyenne</li>
                            <li>Utile pour les propriétés et méthodes qui doivent être partagées avec les sous-classes</li>
                        </ul>
                        <pre><code><span class="keyword">protected</span> <span class="property">$age</span>; <span class="comment">// Propriété protégée</span>
<span class="keyword">protected function</span> <span class="method">calculerAge</span>() { <span class="comment">// Méthode protégée</span>
    <span class="comment">// Code</span>
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">private</div>
                    <div class="example-content">
                        <ul>
                            <li>Accessible uniquement à l'intérieur de la classe elle-même</li>
                            <li>Offre le plus haut niveau d'encapsulation</li>
                            <li>Utile pour les propriétés et méthodes qui ne doivent pas être exposées</li>
                        </ul>
                        <pre><code><span class="keyword">private</span> <span class="property">$identifiant</span>; <span class="comment">// Propriété privée</span>
<span class="keyword">private function</span> <span class="method">genererIdentifiant</span>() { <span class="comment">// Méthode privée</span>
    <span class="comment">// Code</span>
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Conseil :</strong> Une bonne pratique consiste à déclarer les propriétés en <code>private</code> ou <code>protected</code> et à fournir des méthodes getter et setter pour y accéder de manière contrôlée.</p>
            </div>
        </section>

        <section class="section">
            <h2>Instancier des objets</h2>
            <p>Une fois que vous avez défini une classe, vous pouvez créer (ou instancier) des objets à partir de celle-ci. On utilise pour cela l'opérateur <code>new</code> :</p>

            <div class="example">
                <div class="example-header">Création et utilisation d'objets</div>
                <div class="example-content">
                    <pre><code><span class="comment">// Création d'un nouvel objet</span>
<span class="variable">$personne1</span> = <span class="keyword">new</span> <span class="class-name">Personne</span>(<span class="string">"Dupont"</span>, <span class="string">"Jean"</span>, <span class="number">30</span>);
<span class="variable">$personne2</span> = <span class="keyword">new</span> <span class="class-name">Personne</span>(<span class="string">"Martin"</span>, <span class="string">"Sophie"</span>, <span class="number">25</span>);

<span class="comment">// Accès aux propriétés publiques</span>
<span class="keyword">echo</span> <span class="variable">$personne1</span>-><span class="property">nom</span>; <span class="comment">// Affiche "Dupont"</span>
<span class="variable">$personne1</span>-><span class="property">nom</span> = <span class="string">"Durant"</span>; <span class="comment">// Modification possible</span>

<span class="comment">// Appel des méthodes</span>
<span class="keyword">echo</span> <span class="variable">$personne1</span>-><span class="method">sePresenter</span>();
<span class="comment">// Affiche "Bonjour, je m'appelle Jean Durant et j'ai 30 ans."</span>
<span class="keyword">echo</span> <span class="variable">$personne1</span>-><span class="method">celebrerAnniversaire</span>();
<span class="comment">// Affiche "C'est mon anniversaire! J'ai maintenant 31 ans."</span></code></pre>

                    <div class="result">
                        <h4>Exemple avec un objet Personne créé en temps réel :</h4>
                        <?php
                        $personne = new Personne("Dupont", "Jean", 30);
                        echo "<p><strong>Présentation initiale :</strong> " . $personne->sePresenter() . "</p>";
                        echo "<p><strong>Après anniversaire :</strong> " . $personne->celebrerAnniversaire() . "</p>";
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Constructeurs et Destructeurs</h2>
            <p>Les constructeurs et destructeurs sont des méthodes spéciales appelées automatiquement lors de la création et de la destruction d'un objet.</p>

            <div class="examples-grid">
                <div class="example">
                    <div class="example-header">Constructeur</div>
                    <div class="example-content">
                        <p>Le constructeur <code>__construct()</code> est appelé lors de la création d'un objet :</p>
                        <pre><code><span class="class-keyword">class</span> <span class="class-name">Utilisateur</span> {
    <span class="keyword">private</span> <span class="property">$username</span>;
    <span class="keyword">private</span> <span class="property">$email</span>;
    <span class="keyword">private</span> <span class="property">$dateInscription</span>;

    <span class="comment">// Constructeur</span>
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$username</span>, <span class="variable">$email</span>) {
        <span class="variable">$this</span>-><span class="property">username</span> = <span class="variable">$username</span>;
        <span class="variable">$this</span>-><span class="property">email</span> = <span class="variable">$email</span>;
        <span class="variable">$this</span>-><span class="property">dateInscription</span> = <span class="function">date</span>(<span class="string">'Y-m-d H:i:s'</span>);
        <span class="keyword">echo</span> <span class="string">"Nouveau compte créé pour {$username}!"</span>;
    }
}</code></pre>
                    </div>
                </div>

                <div class="example">
                    <div class="example-header">Destructeur</div>
                    <div class="example-content">
                        <p>Le destructeur <code>__destruct()</code> est appelé lorsqu'un objet est détruit :</p>
                        <pre><code><span class="class-keyword">class</span> <span class="class-name">Connexion</span> {
    <span class="keyword">private</span> <span class="property">$connexionId</span>;
    <span class="keyword">private</span> <span class="property">$ressource</span>;

    <span class="keyword">public function</span> <span class="method">__construct</span>() {
        <span class="variable">$this</span>-><span class="property">connexionId</span> = <span class="function">uniqid</span>(<span class="string">'conn_'</span>);
        <span class="variable">$this</span>-><span class="property">ressource</span> = <span class="string">"Ressource ouverte"</span>;
        <span class="keyword">echo</span> <span class="string">"Connexion {$this->connexionId} établie."</span>;
    }

    <span class="keyword">public function</span> <span class="method">__destruct</span>() {
        <span class="variable">$this</span>-><span class="property">ressource</span> = <span class="keyword">null</span>;
        <span class="keyword">echo</span> <span class="string">"Connexion {$this->connexionId} fermée."</span>;
    }
}</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Getters et Setters</h2>
            <p>Les getters et setters sont des méthodes utilisées pour accéder et modifier les propriétés d'un objet. Ils permettent de contrôler l'accès aux données et d'ajouter de la validation.</p>

            <div class="example">
                <div class="example-header">Exemple de getters et setters</div>
                <div class="example-content">
                    <pre><code><span class="class-keyword">class</span> <span class="class-name">Compte</span> {
    <span class="keyword">private</span> <span class="property">$solde</span>;
    <span class="keyword">private</span> <span class="property">$titulaire</span>;
    
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$titulaire</span>, <span class="variable">$soldeInitial</span> = <span class="number">0</span>) {
        <span class="variable">$this</span>-><span class="property">titulaire</span> = <span class="variable">$titulaire</span>;
        <span class="variable">$this</span>-><span class="method">setSolde</span>(<span class="variable">$soldeInitial</span>);
    }
    
    <span class="comment">// Getter pour solde</span>
    <span class="keyword">public function</span> <span class="method">getSolde</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">solde</span>;
    }
    
    <span class="comment">// Setter pour solde avec validation</span>
    <span class="keyword">public function</span> <span class="method">setSolde</span>(<span class="variable">$solde</span>) {
        <span class="keyword">if</span> (!<span class="function">is_numeric</span>(<span class="variable">$solde</span>)) {
            <span class="keyword">throw new</span> <span class="class-name">Exception</span>(<span class="string">"Le solde doit être un nombre"</span>);
        }
        <span class="variable">$this</span>-><span class="property">solde</span> = (<span class="keyword">float</span>) <span class="variable">$solde</span>;
    }
    
    <span class="comment">// Getter pour titulaire</span>
    <span class="keyword">public function</span> <span class="method">getTitulaire</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">titulaire</span>;
    }
    
    <span class="comment">// Méthodes métier</span>
    <span class="keyword">public function</span> <span class="method">deposer</span>(<span class="variable">$montant</span>) {
        <span class="keyword">if</span> (<span class="variable">$montant</span> <= <span class="number">0</span>) {
            <span class="keyword">throw new</span> <span class="class-name">Exception</span>(<span class="string">"Le montant doit être positif"</span>);
        }
        <span class="variable">$this</span>-><span class="property">solde</span> += <span class="variable">$montant</span>;
        <span class="keyword">return</span> <span class="string">"Dépôt de {$montant}€ effectué. Nouveau solde: {$this->solde}€"</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">retirer</span>(<span class="variable">$montant</span>) {
        <span class="keyword">if</span> (<span class="variable">$montant</span> <= <span class="number">0</span>) {
            <span class="keyword">throw new</span> <span class="class-name">Exception</span>(<span class="string">"Le montant doit être positif"</span>);
        }
        <span class="keyword">if</span> (<span class="variable">$this</span>-><span class="property">solde</span> < <span class="variable">$montant</span>) {
            <span class="keyword">throw new</span> <span class="class-name">Exception</span>(<span class="string">"Solde insuffisant"</span>);
        }
        <span class="variable">$this</span>-><span class="property">solde</span> -= <span class="variable">$montant</span>;
        <span class="keyword">return</span> <span class="string">"Retrait de {$montant}€ effectué. Nouveau solde: {$this->solde}€"</span>;
    }
}</code></pre>

                    <p>Utilisation :</p>
                    <pre><code><span class="comment">// Création d'un compte</span>
<span class="variable">$monCompte</span> = <span class="keyword">new</span> <span class="class-name">Compte</span>(<span class="string">"Jean Dupont"</span>, <span class="number">1000</span>);

<span class="comment">// Utilisation des getters</span>
<span class="keyword">echo</span> <span class="string">"Titulaire: "</span> . <span class="variable">$monCompte</span>-><span class="method">getTitulaire</span>(); <span class="comment">// "Jean Dupont"</span>
<span class="keyword">echo</span> <span class="string">"Solde: "</span> . <span class="variable">$monCompte</span>-><span class="method">getSolde</span>() . <span class="string">"€"</span>; <span class="comment">// "1000€"</span>

<span class="comment">// Opérations bancaires</span>
<span class="keyword">try</span> {
    <span class="keyword">echo</span> <span class="variable">$monCompte</span>-><span class="method">deposer</span>(<span class="number">500</span>); <span class="comment">// "Dépôt de 500€ effectué. Nouveau solde: 1500€"</span>
    <span class="keyword">echo</span> <span class="variable">$monCompte</span>-><span class="method">retirer</span>(<span class="number">200</span>); <span class="comment">// "Retrait de 200€ effectué. Nouveau solde: 1300€"</span>
} <span class="keyword">catch</span> (<span class="class-name">Exception</span> <span class="variable">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"Erreur: "</span> . <span class="variable">$e</span>-><span class="method">getMessage</span>();
}</code></pre>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>Important :</strong> En PHP, contrairement à d'autres langages comme Java, les getters et setters ne sont pas obligatoires. Cependant, leur utilisation est fortement recommandée pour assurer l'encapsulation et la validation des données.</p>
            </div>
        </section>

        <section class="section">
            <h2>Héritage</h2>
            <p>L'héritage permet de créer une nouvelle classe à partir d'une classe existante. La nouvelle classe (classe enfant) hérite des propriétés et méthodes de la classe parente.</p>

            <div class="example">
                <div class="example-header">Héritage de classes</div>
                <div class="example-content">
                    <pre><code><span class="comment">// Classe parente</span>
<span class="class-keyword">class</span> <span class="class-name">Personne</span> {
    <span class="keyword">protected</span> <span class="property">$nom</span>;
    <span class="keyword">protected</span> <span class="property">$age</span>;

    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>) {
        <span class="variable">$this</span>-><span class="property">nom</span> = <span class="variable">$nom</span>;
        <span class="variable">$this</span>-><span class="property">age</span> = <span class="variable">$age</span>;
    }

    <span class="keyword">public function</span> <span class="method">sePresenter</span>() {
        <span class="keyword">return</span> <span class="string">"Je m'appelle {$this->nom} et j'ai {$this->age} ans."</span>;
    }
}

<span class="comment">// Classe enfant qui hérite de Personne</span>
<span class="class-keyword">class</span> <span class="class-name">Etudiant</span> <span class="keyword">extends</span> <span class="class-name">Personne</span> {
    <span class="keyword">private</span> <span class="property">$formation</span>;

    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>, <span class="variable">$formation</span>) {
        <span class="comment">// Appel du constructeur parent</span>
        <span class="keyword">parent</span>::<span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$age</span>);
        <span class="variable">$this</span>-><span class="property">formation</span> = <span class="variable">$formation</span>;
    }

    <span class="comment">// Redéfinition (override) de la méthode parente</span>
    <span class="keyword">public function</span> <span class="method">sePresenter</span>() {
        <span class="comment">// Appel de la méthode parente</span>
        <span class="variable">$presentation</span> = <span class="keyword">parent</span>::<span class="method">sePresenter</span>();
        <span class="keyword">return</span> <span class="variable">$presentation</span> . <span class="string">" Je suis étudiant en {$this->formation}."</span>;
    }

    <span class="keyword">public function</span> <span class="method">etudier</span>() {
        <span class="keyword">return</span> <span class="string">"J'étudie la {$this->formation}."</span>;
    }
}</code></pre>

                    <p>Utilisation :</p>
                    <pre><code><span class="variable">$personne</span> = <span class="keyword">new</span> <span class="class-name">Personne</span>(<span class="string">"Jean"</span>, <span class="number">30</span>);
<span class="keyword">echo</span> <span class="variable">$personne</span>-><span class="method">sePresenter</span>(); <span class="comment">// "Je m'appelle Jean et j'ai 30 ans."</span>

<span class="variable">$etudiant</span> = <span class="keyword">new</span> <span class="class-name">Etudiant</span>(<span class="string">"Marie"</span>, <span class="number">22</span>, <span class="string">"Informatique"</span>);
<span class="keyword">echo</span> <span class="variable">$etudiant</span>-><span class="method">sePresenter</span>(); <span class="comment">// "Je m'appelle Marie et j'ai 22 ans. Je suis étudiant en Informatique."</span>
<span class="keyword">echo</span> <span class="variable">$etudiant</span>-><span class="method">etudier</span>(); <span class="comment">// "J'étudie la Informatique."</span></code></pre>

                    <div class="result">
                        <h4>Exemple avec notre classe Etudiant :</h4>
                        <?php
                        $etudiant = new Etudiant("Martin", "Sophie", 22, "Informatique");
                        echo "<p><strong>Présentation :</strong> " . $etudiant->sePresenter() . "</p>";
                        $etudiant->ajouterNote("Mathématiques", 16);
                        $etudiant->ajouterNote("Programmation", 18);
                        $etudiant->ajouterNote("Anglais", 14);
                        echo "<p><strong>Moyenne :</strong> " . $etudiant->calculerMoyenne() . "/20</p>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="tip-box">
                <p><strong>Conseil :</strong> En PHP, une classe ne peut hériter que d'une seule classe à la fois (pas d'héritage multiple). Cependant, vous pouvez utiliser les interfaces et les traits pour obtenir un effet similaire.</p>
            </div>
        </section>

        <section class="section">
            <h2>Modélisation d'une classe</h2>
            <p>Voici une représentation visuelle de la classe Personne et de son héritage :</p>

            <div class="class-diagram">
                <div class="class-name">Personne</div>
                <div class="class-properties">
                    <span class="access-modifier public">+</span> nom: string<br>
                    <span class="access-modifier public">+</span> prenom: string<br>
                    <span class="access-modifier protected">#</span> age: int<br>
                    <span class="access-modifier private">-</span> identifiant: string
                </div>
                <div class="class-methods">
                    <span class="access-modifier public">+</span> __construct(nom: string, prenom: string, age: int = 18): void<br>
                    <span class="access-modifier public">+</span> sePresenter(): string<br>
                    <span class="access-modifier public">+</span> celebrerAnniversaire(): string<br>
                    <span class="access-modifier public">+</span> getAge(): int<br>
                    <span class="access-modifier public">+</span> setAge(age: int): bool<br>
                    <span class="access-modifier public">+</span> getIdentifiant(): string
                </div>
            </div>

            <div class="class-diagram" style="margin-top: 20px;">
                <div class="class-name">Etudiant extends Personne</div>
                <div class="class-properties">
                    <span class="access-modifier private">-</span> formation: string<br>
                    <span class="access-modifier private">-</span> notes: array
                </div>
                <div class="class-methods">
                    <span class="access-modifier public">+</span> __construct(nom: string, prenom: string, age: int, formation: string): void<br>
                    <span class="access-modifier public">+</span> sePresenter(): string<br>
                    <span class="access-modifier public">+</span> ajouterNote(matiere: string, note: float): void<br>
                    <span class="access-modifier public">+</span> calculerMoyenne(): float<br>
                    <span class="access-modifier public">+</span> getFormation(): string
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Bonnes pratiques en POO</h2>
            <ul>
                <li><strong>Encapsulation</strong> : Utilisez des modificateurs d'accès appropriés (private, protected) pour protéger vos données.</li>
                <li><strong>Principe de responsabilité unique</strong> : Une classe ne devrait avoir qu'une seule raison de changer.</li>
                <li><strong>Héritage vs Composition</strong> : Préférez la composition à l'héritage lorsque c'est possible.</li>
                <li><strong>Nommage</strong> : Utilisez des conventions de nommage claires et cohérentes.</li>
                <li><strong>Commentaires</strong> : Documentez vos classes et méthodes avec des commentaires PHPDoc.</li>
                <li><strong>Validation</strong> : Validez toujours les données dans les setters et les constructeurs.</li>
                <li><strong>SOLID</strong> : Suivez les principes SOLID pour une meilleure conception orientée objet.</li>
            </ul>

            <div class="example">
                <div class="example-header">Exemple de documentation PHPDoc</div>
                <div class="example-content">
                    <pre><code><span class="comment">/**
 * Classe représentant un produit dans une boutique en ligne
 * 
 * @author Votre Nom
 * @version 1.0
 */</span>
<span class="class-keyword">class</span> <span class="class-name">Produit</span> {
    <span class="comment">/**
     * Identifiant unique du produit
     * @var int
     */</span>
    <span class="keyword">private</span> <span class="property">$id</span>;
    
    <span class="comment">/**
     * Nom du produit
     * @var string
     */</span>
    <span class="keyword">private</span> <span class="property">$nom</span>;
    
    <span class="comment">/**
     * Prix du produit (en euros)
     * @var float
     */</span>
    <span class="keyword">private</span> <span class="property">$prix</span>;
    
    <span class="comment">/**
     * Crée une nouvelle instance de produit
     * 
     * @param string $nom  Le nom du produit
     * @param float  $prix Le prix du produit
     */</span>
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$nom</span>, <span class="variable">$prix</span>) {
        <span class="variable">$this</span>-><span class="property">id</span> = <span class="function">uniqid</span>(<span class="string">'prod_'</span>);
        <span class="variable">$this</span>-><span class="property">nom</span> = <span class="variable">$nom</span>;
        <span class="variable">$this</span>-><span class="property">prix</span> = <span class="variable">$prix</span>;
    }
    
    <span class="comment">/**
     * Calcule le prix TTC du produit
     * 
     * @param float $tauxTva Le taux de TVA à appliquer (par défaut 20%)
     * @return float Le prix TTC du produit
     */</span>
    <span class="keyword">public function</span> <span class="method">calculerPrixTTC</span>(<span class="variable">$tauxTva</span> = <span class="number">0.2</span>) {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">prix</span> * (<span class="number">1</span> + <span class="variable">$tauxTva</span>);
    }
}</code></pre>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Composition vs Héritage</h2>
            <p>Comme mentionné dans les bonnes pratiques, la <strong>composition</strong> est souvent préférable à l'héritage. Explorons ce concept fondamental de la POO.</p>

            <div class="info-box">
                <p><strong>Définition :</strong> La composition est un principe de conception où une classe contient une instance d'une autre classe comme propriété, au lieu d'hériter de celle-ci.</p>
                <p>Ces relations peuvent être résumées comme suit :</p>
                <ul>
                    <li><strong>Héritage</strong> : relation "EST UN" (un Etudiant <em>est une</em> Personne)</li>
                    <li><strong>Composition</strong> : relation "A UN" (une Voiture <em>a un</em> Moteur)</li>
                </ul>
            </div>

            <div class="example">
                <div class="example-header">Exemple de composition</div>
                <div class="example-content">
                    <pre><code><span class="comment">// Classe qui sera utilisée dans la composition</span>
<span class="class-keyword">class</span> <span class="class-name">Moteur</span> {
    <span class="keyword">private</span> <span class="property">$type</span>;
    <span class="keyword">private</span> <span class="property">$cylindree</span>;
    <span class="keyword">private</span> <span class="property">$estDemarre</span> = <span class="keyword">false</span>;
    
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$type</span>, <span class="variable">$cylindree</span>) {
        <span class="variable">$this</span>-><span class="property">type</span> = <span class="variable">$type</span>;
        <span class="variable">$this</span>-><span class="property">cylindree</span> = <span class="variable">$cylindree</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">demarrer</span>() {
        <span class="variable">$this</span>-><span class="property">estDemarre</span> = <span class="keyword">true</span>;
        <span class="keyword">return</span> <span class="string">"Vroum! Le moteur {$this->type} {$this->cylindree}cc démarre."</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">arreter</span>() {
        <span class="variable">$this</span>-><span class="property">estDemarre</span> = <span class="keyword">false</span>;
        <span class="keyword">return</span> <span class="string">"Le moteur s'arrête."</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">estEnMarche</span>() {
        <span class="keyword">return</span> <span class="variable">$this</span>-><span class="property">estDemarre</span>;
    }
}

<span class="comment">// Classe qui utilise la composition</span>
<span class="class-keyword">class</span> <span class="class-name">Voiture</span> {
    <span class="keyword">private</span> <span class="property">$marque</span>;
    <span class="keyword">private</span> <span class="property">$modele</span>;
    <span class="keyword">private</span> <span class="property">$moteur</span>; <span class="comment">// Composition: une voiture A UN moteur</span>
    
    <span class="keyword">public function</span> <span class="method">__construct</span>(<span class="variable">$marque</span>, <span class="variable">$modele</span>, <span class="class-name">Moteur</span> <span class="variable">$moteur</span>) {
        <span class="variable">$this</span>-><span class="property">marque</span> = <span class="variable">$marque</span>;
        <span class="variable">$this</span>-><span class="property">modele</span> = <span class="variable">$modele</span>;
        <span class="variable">$this</span>-><span class="property">moteur</span> = <span class="variable">$moteur</span>; <span class="comment">// Injection de dépendance</span>
    }
    
    <span class="keyword">public function</span> <span class="method">demarrer</span>() {
        <span class="keyword">return</span> <span class="string">"{$this->marque} {$this->modele} : "</span> . <span class="variable">$this</span>-><span class="property">moteur</span>-><span class="method">demarrer</span>();
    }
    
    <span class="keyword">public function</span> <span class="method">arreter</span>() {
        <span class="keyword">return</span> <span class="string">"{$this->marque} {$this->modele} : "</span> . <span class="variable">$this</span>-><span class="property">moteur</span>-><span class="method">arreter</span>();
    }
    
    <span class="keyword">public function</span> <span class="method">changerMoteur</span>(<span class="class-name">Moteur</span> <span class="variable">$nouveauMoteur</span>) {
        <span class="variable">$this</span>-><span class="property">moteur</span> = <span class="variable">$nouveauMoteur</span>;
        <span class="keyword">return</span> <span class="string">"Moteur remplacé avec succès!"</span>;
    }
    
    <span class="keyword">public function</span> <span class="method">getDescription</span>() {
        <span class="keyword">return</span> <span class="string">"{$this->marque} {$this->modele}"</span>;
    }
}</code></pre>

                    <p>Utilisation :</p>
                    <pre><code><span class="comment">// Création des objets</span>
<span class="variable">$moteurEssence</span> = <span class="keyword">new</span> <span class="class-name">Moteur</span>(<span class="string">"essence"</span>, <span class="number">1600</span>);
<span class="variable">$maVoiture</span> = <span class="keyword">new</span> <span class="class-name">Voiture</span>(<span class="string">"Renault"</span>, <span class="string">"Clio"</span>, <span class="variable">$moteurEssence</span>);

<span class="comment">// Utilisation de la voiture</span>
<span class="keyword">echo</span> <span class="variable">$maVoiture</span>-><span class="method">getDescription</span>(); <span class="comment">// "Renault Clio"</span>
<span class="keyword">echo</span> <span class="variable">$maVoiture</span>-><span class="method">demarrer</span>(); <span class="comment">// "Renault Clio : Vroum! Le moteur essence 1600cc démarre."</span>

<span class="comment">// Création d'un nouveau moteur</span>
<span class="variable">$moteurElectrique</span> = <span class="keyword">new</span> <span class="class-name">Moteur</span>(<span class="string">"électrique"</span>, <span class="number">0</span>);

<span class="comment">// Modification de la composition à l'exécution (flexibilité)</span>
<span class="keyword">echo</span> <span class="variable">$maVoiture</span>-><span class="method">changerMoteur</span>(<span class="variable">$moteurElectrique</span>); <span class="comment">// "Moteur remplacé avec succès!"</span>
<span class="keyword">echo</span> <span class="variable">$maVoiture</span>-><span class="method">demarrer</span>(); <span class="comment">// "Renault Clio : Vroum! Le moteur électrique 0cc démarre."</span></code></pre>

                    <div class="result">
                        <h4>Résultat du code de composition :</h4>
                        <?php
                        // Simulation du résultat
                        echo "<p><strong>Description :</strong> Renault Clio</p>";
                        echo "<p><strong>Démarrage initial :</strong> Renault Clio : Vroum! Le moteur essence 1600cc démarre.</p>";
                        echo "<p><strong>Changement de moteur :</strong> Moteur remplacé avec succès!</p>";
                        echo "<p><strong>Nouveau démarrage :</strong> Renault Clio : Vroum! Le moteur électrique 0cc démarre.</p>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="tip-box">
                <h3>Avantages de la composition par rapport à l'héritage</h3>
                <ul>
                    <li><strong>Flexibilité</strong> : Les objets composés peuvent être modifiés dynamiquement à l'exécution</li>
                    <li><strong>Encapsulation renforcée</strong> : Les implémentations internes peuvent changer sans affecter les utilisateurs</li>
                    <li><strong>Réutilisabilité</strong> : Les composants peuvent être réutilisés dans différentes classes</li>
                    <li><strong>Évite la complexité</strong> : Limite les problèmes liés aux hiérarchies d'héritage profondes</li>
                    <li><strong>Relations plus claires</strong> : Définit explicitement les relations "a un" plutôt que "est un"</li>
                </ul>
            </div>

            <div class="warning-box">
                <p><strong>Rappel</strong> : "Favorisez la composition sur l'héritage" est un principe de conception fondamental. L'héritage crée un couplage fort entre les classes, alors que la composition offre plus de souplesse.</p>
                <p>Toutefois, utilisez l'héritage lorsque la relation "est un" est véritablement appropriée et que vous souhaitez que la classe enfant hérite de <em>tout</em> le comportement de la classe parente.</p>
            </div>

            <div class="example">
                <div class="example-header">Quand utiliser l'héritage vs la composition ?</div>
                <div class="example-content">
                    <table style="width:100%; border-collapse: collapse;">
                        <tr style="background-color: var(--primary-color); color: white;">
                            <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Critère</th>
                            <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Héritage</th>
                            <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Composition</th>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">Relation</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">"EST UN" (is-a)</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">"A UN" (has-a)</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #ddd;">Couplage</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Fort</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Faible</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">Flexibilité</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Limitée (définie à la compilation)</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Élevée (peut changer à l'exécution)</td>
                        </tr>
                        <tr style="background-color: #f8f9fa;">
                            <td style="padding: 10px; border: 1px solid #ddd;">Idéal pour</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Spécialisation et extension de classes</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Réutilisation de fonctionnalités</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">Exemple</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Etudiant <em>est une</em> Personne</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Voiture <em>a un</em> Moteur</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Pour aller plus loin</h2>
            <p>La POO en PHP offre bien d'autres fonctionnalités avancées que nous explorerons dans les prochains modules :</p>
            <ul>
                <li>Classes abstraites et interfaces</li>
                <li>Traits</li>
                <li>Méthodes et propriétés statiques</li>
                <li>Espaces de noms (namespaces)</li>
                <li>Autoloading des classes</li>
                <li>Design patterns</li>
                <li>Polymorphisme</li>
                <li>Surcharge de méthodes</li>
            </ul>

            <div class="info-box">
                <p><strong>Ressources supplémentaires :</strong></p>
                <ul>
                    <li><a href="https://www.php.net/manual/fr/language.oop5.php" target="_blank">Documentation officielle PHP sur la POO</a></li>
                    <li><a href="https://phptherightway.com/#object-oriented-programming" target="_blank">PHP The Right Way - OOP</a></li>
                </ul>
            </div>
        </section>
        <div class="navigation">
            <a href="09-les-formulaires.php" class="nav-button">← Module précédent</a>
            <a href="../../index.php" class="nav-button">Accueil</a>
            <a href="11-POO-avancee.php" class="nav-button">Module suivant →</a>
        </div>
    </main>
</body>

</html>