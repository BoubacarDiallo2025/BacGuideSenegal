# Guide de Déploiement sur Render

## Prérequis
- Compte GitHub avec le repository du projet
- Compte Render.com
- Variables d'environnement configurées

## Étapes de déploiement

### 1. Résoudre le problème Git (si nécessaire)
```bash
git config --global --add safe.directory 'G:/ABDOUL_SALAM_DIALLO/L3-Informatique/SEMESTRE 6/projet tutoré/BacGuideSenegal'
```

### 2. Pousser le code sur GitHub
```bash
git add .
git commit -m "Corrections des erreurs et ajout des fichiers Docker"
git push origin main
```

### 3. Déployer sur Render
1. Aller sur https://render.com
2. Créer un nouveau service Web
3. Connecter votre repository GitHub
4. Configuration :
   - **Name** : bacguide-senegal
   - **Runtime** : Docker
   - **Build Command** : (laisser vide)
   - **Start Command** : (laisser vide)
   - **Plan** : Free

### 4. Ajouter les variables d'environnement
Dans les settings du service Render, ajouter :
- `DB_HOST` : mysql-abdoul-salam-diallo.alwaysdata.net
- `DB_USER` : 405601_guidebach
- `DB_PASS` : (votre mot de passe - à ajouter comme secret)
- `DB_NAME` : abdoul-salam-diallo_guidebacheliers

### 5. Déployer
Cliquer sur "Deploy" et attendre que le build soit terminé.

## Dépannage

### Erreur : "Failed to open stream: No such file or directory"
- Vérifier que les chemins d'inclusion sont corrects
- S'assurer que tous les fichiers sont copiés dans le conteneur Docker

### Erreur de connexion à la base de données
- Vérifier que les variables d'environnement sont correctement configurées
- S'assurer que la base de données est accessible depuis Render

### Logs
Pour voir les logs du déploiement :
1. Aller sur le dashboard Render
2. Sélectionner le service
3. Cliquer sur "Logs"
