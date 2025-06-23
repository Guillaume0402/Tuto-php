# Architecture CSS du Tutoriel PHP

Ce document explique l'organisation des styles CSS du tutoriel PHP et comment les utiliser efficacement.

## Structure des fichiers

Le projet est organisé avec les dossiers principaux suivants :

-   `/` : Racine contenant les fichiers PHP des modules (01-script.php, 02-les-variables.php, etc.)
-   `/css` : Contient tous les fichiers CSS du projet
-   `/includes` : Contient les fichiers PHP réutilisables
-   `/docs` : Documentation technique du projet

### Organisation des fichiers CSS

Le système CSS est organisé de façon modulaire avec une hiérarchie claire :

#### Fichiers de base :

-   `variables.css` : Définition de toutes les variables globales

    -   Couleurs des modules (--module1-color à --module24-color)
    -   Variantes (light, dark) pour chaque couleur
    -   Espacements et dimensions standard
    -   Typographie (familles de polices, tailles, graisse)
    -   Ombres, rayons de bordure et autres valeurs réutilisables

-   `base.css` : Styles de base et réinitialisation
    -   Reset des marges et padding
    -   Typographie de base (corps de texte, titres, etc.)
    -   Styles des conteneurs principaux
    -   Règles d'accessibilité de base

#### Composants et fonctionnalités spécifiques :

-   `components.css` : Composants d'interface réutilisables

    -   Styles pour les grilles d'exemples et cartes
    -   Styles des sections et titres
    -   Boîtes d'information (info, warning, danger, success)
    -   Badges et étiquettes
    -   Composants de navigation

-   `syntax-highlighting.css` : Coloration syntaxique du code

    -   Styles pour balises de code et blocs
    -   Coloration des éléments de syntaxe (mots-clés, chaînes, commentaires)
    -   Fond et couleurs pour les blocs de code
    -   Styles pour l'affichage des résultats d'exécution

-   `forms.css` : Styles pour les formulaires et validation

    -   Champs de saisie et étiquettes
    -   Boutons et contrôles de formulaire
    -   Styles de validation (succès, erreur)
    -   Présentation des messages d'erreur
    -   Affichage des résultats de formulaire

-   `poo.css` : Composants pour la Programmation Orientée Objet

    -   Diagrammes de classes et relations
    -   Styles pour les interfaces et classes abstraites
    -   Représentation des héritages et implémentations
    -   Styles pour les diagrammes UML simplifiés
    -   Design patterns et exemples de code POO

-   `index-page-new.css` : Styles de la page d'accueil

    -   Grille des cartes de modules
    -   Styles spécifiques des cartes et en-têtes colorés
    -   Effets de survol et transitions
    -   Mise en page responsive pour la page d'accueil

-   `db-diagram.css` : Styles pour les diagrammes de base de données relationnelles

    -   Représentation visuelle des tables et relations
    -   Styles pour les en-têtes de table et colonnes
    -   Flèches de relation et indicateurs de cardinalité
    -   Adaptations responsives pour les diagrammes

-   `output-results.css` : Styles pour l'affichage des résultats PHP

    -   Formatage des sorties de tableaux et objets
    -   Styles pour les blocs de résultats
    -   Styles pour améliorer la lisibilité des sorties PHP
    -   Mise en forme des tableaux HTML dans les résultats

-   `module-specific.css` : Styles spécifiques à chaque module

    -   En-têtes colorés spécifiques à chaque thématique
    -   Styles pour les modules 18 à 23
    -   Tableaux et boîtes d'alerte spécifiques aux modules

-   `responsive.css` : Styles d'adaptation aux différentes tailles d'écran

    -   Media queries pour les appareils mobiles et tablettes
    -   Adaptations responsives des diagrammes et tableaux
    -   Ajustements de mise en page pour petits écrans

-   `main.css` : Point d'entrée central
    -   Importe tous les fichiers modulaires ci-dessus
    -   Définit les variables primaires pour chaque module
    -   Point unique de mise à jour pour les importations

### Fichiers dépréciés

-   `db-relations.css` : Ce fichier est déprécié. Son contenu a été migré vers `db-diagram.css` pour centraliser tous les styles relatifs aux diagrammes de base de données.

## Optimisations récentes (juin 2025)

1. **Nettoyage des variables** : Le fichier `variables.css` a été nettoyé pour supprimer les variables inutilisées et organiser les variables par catégories logiques.

2. **Suppression des imports redondants** : Les imports de `variables.css` ont été centralisés uniquement dans `main.css` pour éviter les imports multiples et les conflits potentiels.

3. **Standardisation des variantes de couleur** : Les variantes de couleur (foncées et claires) ont été standardisées et organisées de façon cohérente.

4. **Modularisation complète** : Les styles ont été séparés en fichiers spécialisés :

    - `output-results.css` pour les styles d'affichage des résultats PHP
    - `module-specific.css` pour les styles spécifiques à chaque module
    - `responsive.css` pour les adaptations aux différentes tailles d'écran

5. **Consolidation des styles de diagrammes** : Les styles pour les diagrammes de base de données ont été consolidés dans `db-diagram.css`.

6. **Documentation améliorée** : Cette documentation a été mise à jour pour refléter la nouvelle architecture CSS modulaire.

## Bonnes pratiques

1. **Utilisation des variables** - Toujours utiliser les variables CSS définies dans `variables.css` pour maintenir la cohérence visuelle.

2. **N'importer que `main.css`** - Dans les fichiers HTML, n'importer que `main.css` qui se charge d'importer tous les autres fichiers CSS nécessaires.

3. **Utiliser les classes spécifiques aux modules** - Appliquer la classe `moduleX` (où X est le numéro du module) au `<body>` pour activer les couleurs spécifiques au module.

4. **Respecter la séparation des préoccupations** - Placer les nouveaux styles dans le fichier approprié selon sa fonction.

## Utilisation du système centralisé

### 1. Structure HTML de base

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Titre du Module</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body class="moduleX">
        <header>
            <h1>Titre du Module</h1>
            <p class="subtitle">Description du module</p>
        </header>

        <main>
            <!-- Contenu du module -->

            <div class="navigation">
                <a href="module-precedent.php" class="nav-button"
                    >← Module précédent</a
                >
                <a href="index.php" class="nav-button">Accueil</a>
                <a href="module-suivant.php" class="nav-button"
                    >Module suivant →</a
                >
            </div>
        </main>
    </body>
</html>
```

### 2. Structure d'une section

```html
<section class="section">
    <h2>Titre de la section</h2>
    <p>Description de la section</p>

    <div class="info-box">
        <strong>Titre de l'encart</strong>
        <ul>
            <li>Point important 1</li>
            <li>Point important 2</li>
        </ul>
    </div>

    <div class="examples-grid">
        <div class="example">
            <div class="example-header strings-header">Nom de l'exemple</div>
            <div class="example-content">
                <pre><code class="language-php"><span class="keyword">echo</span> <span class="string">"Hello World"</span>;</code></pre>
                <div class="result">
                    <p>Résultat : Hello World</p>
                </div>
            </div>
        </div>

        <!-- Autres exemples... -->
    </div>
</section>
```

### 3. Structure d'un formulaire

```html
<form class="form" action="traitement.php" method="post">
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input
            type="text"
            id="nom"
            name="nom"
            class="<?php echo isset($errors['nom']) ? 'is-invalid' : ''; ?>"
        />
        <?php if (isset($errors['nom'])): ?>
        <div class="error-message"><?php echo $errors['nom']; ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" />
    </div>

    <div class="form-group">
        <label>Options :</label>
        <div class="checkbox-group">
            <label class="checkbox-label">
                <input type="checkbox" name="options[]" value="option1" />
                Option 1
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="options[]" value="option2" />
                Option 2
            </label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" name="submit">Envoyer</button>
        <button type="reset" class="btn-secondary">Réinitialiser</button>
    </div>
</form>
```

### 4. Affichage des résultats de formulaire

```html
<div class="form-result">
    <h3>Données reçues</h3>
    <dl>
        <dt>Nom</dt>
        <dd><?php echo htmlspecialchars($nom); ?></dd>

        <dt>Email</dt>
        <dd><?php echo htmlspecialchars($email); ?></dd>

        <dt>Options sélectionnées</dt>
        <dd><?php echo implode(', ', $options); ?></dd>
    </dl>
</div>
```

### 5. Structure d'un diagramme de classe POO

```html
<div class="class-diagram">
    <div class="class-diagram-header">Personne</div>
    <div class="class-diagram-properties">
        <h4>Propriétés</h4>
        <ul>
            <li>public $nom</li>
            <li>public $prenom</li>
            <li>protected $age</li>
            <li>private $identifiant</li>
        </ul>
    </div>
    <div class="class-diagram-methods">
        <h4>Méthodes</h4>
        <ul>
            <li>public function __construct($nom, $prenom, $age)</li>
            <li>public function sePresenter()</li>
            <li>public function getAge()</li>
            <li>public function setAge($age)</li>
        </ul>
    </div>
</div>

<div class="class-relationship">
    <div class="relationship-line"></div>
    <div class="relationship-type">extends</div>
    <div class="relationship-line"></div>
</div>

<div class="class-diagram">
    <div class="class-diagram-header">Etudiant</div>
    <div class="class-diagram-properties">
        <h4>Propriétés</h4>
        <ul>
            <li>private $formation</li>
            <li>private $notes</li>
        </ul>
    </div>
    <div class="class-diagram-methods">
        <h4>Méthodes</h4>
        <ul>
            <li>
                public function __construct($nom, $prenom, $age, $formation)
            </li>
            <li>public function ajouterNote($matiere, $note)</li>
            <li>public function calculerMoyenne()</li>
        </ul>
    </div>
</div>
```

### 6. Diagrammes UML et Structures POO Avancées

Pour illustrer les concepts avancés de POO comme les interfaces et les classes abstraites, vous pouvez utiliser les structures suivantes:

```html
<!-- Interface -->
<div class="interface-diagram">
    <div class="interface-diagram-header">Mammifere</div>
    <div class="interface-methods">
        <h4>Méthodes</h4>
        <ul>
            <li>public function allaiter();</li>
            <li>public function seDeplacer();</li>
            <li>public function emettreSon();</li>
        </ul>
    </div>
</div>

<!-- Classe abstraite -->
<div class="abstract-diagram">
    <div class="abstract-diagram-header">EtreVivant</div>
    <div class="abstract-diagram-properties">
        <h4>Propriétés</h4>
        <ul>
            <li>protected $nom;</li>
            <li>protected $age;</li>
        </ul>
    </div>
    <div class="abstract-diagram-methods">
        <h4>Méthodes</h4>
        <ul>
            <li>public function __construct($nom, $age)</li>
            <li>public function getNom()</li>
            <li>public function getAge()</li>
            <li>abstract public function respirer();</li>
        </ul>
    </div>
</div>

<!-- Diagramme UML -->
<div class="uml-diagram">
    <div class="uml-interface">
        <div class="uml-header">Mammifere</div>
        <div class="uml-methods">
            + allaiter() : void<br />
            + seDeplacer() : void<br />
            + emettreSon() : void
        </div>
    </div>
    <div class="uml-connection">
        <div class="uml-arrow"></div>
        <div class="uml-label">implements</div>
    </div>
    <div class="uml-class">
        <div class="uml-header">Chien</div>
        <div class="uml-properties">- race : string</div>
        <div class="uml-methods">
            + __construct(nom, age, race)<br />
            + aboyer() : string<br />
            + allaiter() : void
        </div>
    </div>
</div>

<!-- Pattern -->
<div class="pattern-box">
    <h3 class="pattern-title">Pattern Singleton</h3>
    <p class="pattern-description">
        Garantit qu'une classe n'a qu'une seule instance et fournit un point
        d'accès global à cette instance.
    </p>
    <pre><code class="language-php">class Database {
    private static $instance = null;
    
    private function __construct() { /* ... */ }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}</code></pre>
</div>
```

## Classes utilitaires principales

### Sections et grilles

-   `.section` : Section de contenu
-   `.examples-grid` : Grille responsive pour afficher les exemples
-   `.example` : Carte d'exemple individuelle
-   `.example-header` : En-tête de la carte d'exemple
-   `.example-content` : Contenu de la carte d'exemple
-   `.result` : Affichage du résultat d'un exemple

### Boîtes d'information

-   `.info-box` : Information générale (fond bleu clair)
-   `.warning-box` : Avertissement (fond jaune)
-   `.danger-box` : Danger/Erreur (fond rouge)
-   `.success-box` : Succès (fond vert)

### Navigation

-   `.navigation` : Conteneur des boutons de navigation
-   `.nav-button` : Bouton de navigation

### Entêtes thématiques

Des classes pour les en-têtes spécifiques aux différents types d'exemples sont disponibles :

-   `.strings-header`, `.numeric-header`, `.arrays-header`, etc.
-   `.if-header`, `.else-header`, `.switch-header`, etc.
-   `.while-header`, `.do-while-header`, `.for-header`, etc.

### Formulaires

-   `.form-group` : Groupe d'éléments de formulaire (label + input + message)
-   `.is-invalid` : Champ avec erreur de validation
-   `.is-valid` : Champ validé avec succès
-   `.error-message` : Message d'erreur de validation
-   `.valid-feedback` : Message de validation réussie
-   `.form-result` : Affichage des résultats d'un formulaire
-   `.btn-secondary` : Bouton secondaire (gris)

### Programmation Orientée Objet

-   `.class-diagram` : Diagramme de classe pour visualisation de la POO
-   `.class-diagram-header` : En-tête du diagramme de classe
-   `.class-diagram-properties` : Section des propriétés du diagramme
-   `.class-diagram-methods` : Section des méthodes du diagramme
-   `.class-relationship` : Relation entre classes (héritage, implémentation, etc.)
-   `.inheritance-arrow` : Flèche indiquant l'héritage entre classes
-   `.poo-term` : Terme avec infobulle de définition POO

### POO Avancée

-   `.abstract-diagram` : Diagramme pour les classes abstraites
-   `.interface-diagram` : Diagramme pour les interfaces
-   `.pattern-box` : Boîte d'information pour les patterns de conception
-   `.uml-diagram` : Diagramme UML simplifié
-   `.uml-class`, `.uml-interface`, `.uml-abstract` : Éléments de diagramme UML
-   `.trait-header`, `.abstract-header`, `.interface-header` : En-têtes spécifiques

## Thèmes par module

Pour appliquer les couleurs spécifiques à chaque module, ajoutez la classe correspondante à l'élément `<body>` :

-   `module1` : Script PHP
-   `module2` : Variables
-   `module3` : Conditions
-   `module4` : Boucles
-   `module5` : Fonctions
-   `module6` : Tableaux
-   `module7` : Fonctions natives
-   `module8` : Inclusions
-   `module9` : Formulaires
-   `module10` : POO
-   `module11` : POO Avancée
-   `module12` : Bases de données
-   `module13` : PHP et AJAX
-   `module14` : Sécurité
-   `module15` : Architecture MVC
-   `module16` : API externes
-   `module17` : Gestion des fichiers

## Responsive Design

Le système CSS est entièrement responsive :

-   Grilles adaptatives qui passent à une colonne sur les petits écrans
-   Marges et paddings optimisés pour mobile
-   Tailles de texte ajustées pour différents appareils

### Structure des Media Queries

Les media queries sont organisées selon l'approche "mobile-first" :

```css
/* Styles de base pour mobile */
.example {
    width: 100%;
}

/* Tablette (768px et plus) */
@media (min-width: 768px) {
    .example {
        width: 50%;
    }
}

/* Desktop (1024px et plus) */
@media (min-width: 1024px) {
    .example {
        width: 33.33%;
    }
}

/* Grand écran (1440px et plus) */
@media (min-width: 1440px) {
    .example {
        width: 25%;
    }
}
```

### Points de rupture standard

-   **Mobile** : < 768px
-   **Tablette** : 768px - 1023px
-   **Desktop** : 1024px - 1439px
-   **Grand écran** : ≥ 1440px

### Compatibilité des navigateurs

Le projet cible les navigateurs modernes avec une compatibilité étendue :

-   Chrome (dernières versions) ✓
-   Firefox (dernières versions) ✓
-   Safari (dernières versions) ✓
-   Edge (dernières versions) ✓
-   Opera (dernières versions) ✓
-   Internet Explorer 11 (support basique)

Les fonctionnalités CSS modernes utilisées sont :

-   Variables CSS (avec fallbacks si nécessaire)
-   Flexbox et CSS Grid (avec fallbacks pour IE11)
-   Animations et transitions
-   Media queries

## Comment étendre le système

### Ajouter des styles pour un module existant

Pour ajouter des styles spécifiques à un module particulier, vous avez deux options :

1. **Option légère** : Ajouter vos styles dans `main.css` en utilisant des préfixes de module

    ```css
    /* Styles spécifiques au module 3 - Conditions */
    .module3 .special-highlight {
        background-color: var(--module3-light);
        border-left: 4px solid var(--module3-color);
        padding: 10px 15px;
    }
    ```

2. **Option complète** : Pour des modules complexes, créer un fichier séparé

    ```css
    /* fichier: module-special.css */
    @import "main.css";

    /* Styles spécifiques au module */
    .special-component {
        ...;
    }
    .custom-layout {
        ...;
    }
    ```

### Créer un nouveau module

Pour créer un tout nouveau module (ex: module18) :

1. **Déclarer les variables de couleur** dans `variables.css`

    ```css
    --module18-color: #3b82f6; /* Couleur principale */
    --module18-dark: #1d4ed8; /* Variante foncée */
    --module18-light: #dbeafe; /* Variante claire */
    ```

2. **Créer la structure HTML** avec la classe de module

    ```html
    <body class="module18">
        <!-- Contenu du module -->
    </body>
    ```

3. **Ajouter une entrée dans la page d'index** avec la même couleur thématique

4. **Documenter les nouveaux composants** spécifiques dans cette documentation

### Conseils pour l'extension du système

-   Maintenir la cohérence visuelle avec les modules existants
-   Réutiliser les composants existants autant que possible
-   Tester les modifications sur différentes tailles d'écran
-   Suivre la convention de nommage établie
-   Mettre à jour la documentation pour refléter les changements

## Méthodologie et principes

Notre architecture CSS s'inspire de plusieurs méthodologies reconnues :

### Principes BEM (Block, Element, Modifier) simplifiés

-   **Blocks** : Composants autonomes (`.example`, `.card`, `.form`)
-   **Elements** : Parties d'un block (`.example-header`, `.card-content`)
-   **Modifiers** : Variations d'un block (`.is-active`, `.card-primary`)

### Organisation inspirée de SMACSS

-   **Base** : Styles de fondation dans `base.css`
-   **Layout** : Structure globale dans `base.css` et `components.css`
-   **Module** : Composants réutilisables dans fichiers spécifiques
-   **State** : États des éléments (active, hover, etc.) dans chaque module
-   **Theme** : Variables de couleurs et thèmes dans `variables.css`

### Principes de conception

1. **Modularité** : Découpage en fichiers cohérents et indépendants
2. **Réutilisabilité** : Composants génériques et paramétrables
3. **Maintenabilité** : Organisation logique et documentation claire
4. **Scalabilité** : Architecture extensible pour ajouter de nouveaux modules
5. **Performance** : Éviter les redondances et optimiser la cascade CSS
