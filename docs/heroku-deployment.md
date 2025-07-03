# 🚀 Procédure de déploiement Heroku

Guide complet pour déployer et maintenir le projet Tuto-PHP sur Heroku.

## 📋 Table des matières

-   [Prérequis](#prérequis)
-   [Configuration initiale](#configuration-initiale)
-   [Déploiement](#déploiement)
-   [Mise à jour](#mise-à-jour)
-   [Résolution de problèmes](#résolution-de-problèmes)
-   [Commandes utiles](#commandes-utiles)

---

## 🛠️ Prérequis

### 1. Installation Heroku CLI

```bash
# Windows (avec winget)
winget install Heroku.CLI

# Ou téléchargement direct depuis https://devcenter.heroku.com/articles/heroku-cli
```

### 2. Authentification

```bash
heroku login
```

### 3. Vérification de l'installation

```bash
heroku --version
git --version
```

---

## ⚙️ Configuration initiale

### 1. Structure des fichiers requis

**Procfile** (à la racine du projet) :

```
web: vendor/bin/heroku-php-apache2 public/
```

**composer.json** (à la racine du projet) :

```json
{
    "require": {
        "php": "^8.0"
    }
}
```

### 2. Configuration Git

```bash
# Vérifier les remotes
git remote -v

# Ajouter Heroku (si pas déjà fait)
heroku git:remote -a tuto-php
```

---

## 🚀 Déploiement

### 1. Premier déploiement

```bash
# 1. Créer l'application (si nouvelle)
heroku create tuto-php

# 2. Configurer les variables d'environnement
heroku config:set ENVIRONMENT=production

# 3. Déployer
git push heroku main
```

### 2. Vérifier le déploiement

```bash
# Ouvrir l'application
heroku open

# Voir les logs
heroku logs --tail
```

---

## 🔄 Mise à jour (Procédure courante)

### Méthode 1 : Déploiement simple

```bash
# 1. Vérifier l'état local
git status

# 2. Si tout est clean, pousser directement
git push heroku main
```

### Méthode 2 : Avec synchronisation

```bash
# 1. Récupérer les dernières modifications Heroku
git fetch heroku

# 2. Fusionner avec la version locale
git merge heroku/main

# 3. Résoudre les conflits si nécessaire
# (Voir section "Résolution de conflits")

# 4. Pousser vers Heroku
git push heroku main
```

### Méthode 3 : Force push (attention !)

```bash
# ⚠️ Utiliser seulement si sûr de sa version locale
git push heroku main --force
```

---

## 🛠️ Résolution de problèmes

### Erreur : "non-fast-forward"

```bash
# Erreur courante lors du push
To https://git.heroku.com/tuto-php.git
 ! [rejected]        main -> main (non-fast-forward)

# Solution :
git fetch heroku
git merge heroku/main
# Résoudre les conflits dans VS Code
git add .
git commit -m "Fusion: résolution conflits"
git push heroku main
```

### Résolution de conflits dans VS Code

1. **Ouvrir le fichier en conflit**
2. **Voir les marqueurs de conflit :**
    ```
    <<<<<<< HEAD
    Votre code local
    =======
    Code de Heroku
    >>>>>>> heroku/main
    ```
3. **Choisir une option :**
    - "Accepter Actuelle" (votre version)
    - "Accepter Entrant" (version Heroku)
    - "Accepter les deux"
    - Édition manuelle
4. **Finaliser :**
    ```bash
    git add .
    git commit -m "Résolution conflits"
    git push heroku main
    ```

### Problèmes de chemins CSS/JS

```bash
# Vérifier les chemins dans les templates
# Exemple : <?= BASE_URL ?>/assets/css/main.css
# Assurer qu'il y a bien un "/" après BASE_URL
```

### Erreurs de build

```bash
# Voir les logs détaillés
heroku logs --tail

# Vérifier le Procfile
cat Procfile

# Vérifier composer.json
cat composer.json
```

---

## 📝 Commandes utiles

### Gestion de l'application

```bash
# Informations sur l'app
heroku info

# Ouvrir l'application
heroku open

# Redémarrer l'application
heroku restart

# Voir les logs en temps réel
heroku logs --tail

# Voir les derniers logs
heroku logs --num 100
```

### Gestion des variables d'environnement

```bash
# Lister toutes les variables
heroku config

# Définir une variable
heroku config:set VARIABLE_NAME=value

# Supprimer une variable
heroku config:unset VARIABLE_NAME
```

### Gestion Git

```bash
# Voir les remotes
git remote -v

# Ajouter le remote Heroku
heroku git:remote -a tuto-php

# Voir l'historique des déploiements
heroku releases

# Revenir à une version précédente
heroku rollback v13
```

### Debug et monitoring

```bash
# Exécuter une commande sur Heroku
heroku run "php -v"

# Voir l'état de l'application
heroku ps

# Voir les métriques
heroku logs --ps web
```

---

## 🚦 Checklist de déploiement

### Avant chaque déploiement :

-   [ ] `git status` → Vérifier que le working tree est clean
-   [ ] Tester en local (`php -S localhost:8000 -t public`)
-   [ ] Vérifier les chemins CSS/JS
-   [ ] Commit et push sur GitHub (`git push origin main`)

### Pendant le déploiement :

-   [ ] `git fetch heroku`
-   [ ] `git merge heroku/main` (résoudre conflits si nécessaire)
-   [ ] `git push heroku main`
-   [ ] Vérifier les logs (`heroku logs --tail`)

### Après le déploiement :

-   [ ] `heroku open` → Tester l'application
-   [ ] Vérifier les fonctionnalités clés
-   [ ] Tester la responsivité
-   [ ] Vérifier la console développeur (F12)

---

## 🔗 Liens utiles

-   **Application Heroku :** https://tuto-php-19982edf3ffe.herokuapp.com/
-   **Dashboard Heroku :** https://dashboard.heroku.com/apps/tuto-php
-   **Documentation Heroku :** https://devcenter.heroku.com/
-   **Heroku PHP Support :** https://devcenter.heroku.com/articles/php-support

---

## 📞 Support et dépannage

### Erreurs courantes et solutions

| Erreur                  | Cause                       | Solution                         |
| ----------------------- | --------------------------- | -------------------------------- |
| Application error (H10) | Code PHP cassé              | Vérifier `heroku logs --tail`    |
| Not found (404)         | Mauvaise structure fichiers | Vérifier le Procfile             |
| CSS/JS non chargés      | Chemins incorrects          | Vérifier BASE_URL dans templates |
| Build failed            | composer.json invalide      | Valider le JSON                  |

### Contact en cas de problème

-   Vérifier d'abord les logs : `heroku logs --tail`
-   Consulter le dashboard Heroku
-   Tester en local d'abord

---

**Dernière mise à jour :** 3 juillet 2025  
**Version du guide :** 1.0  
**Application :** tuto-php (Heroku)
