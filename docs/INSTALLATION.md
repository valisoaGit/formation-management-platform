# Guide Complet d'Installation

## 📋 Prérequis

- **PHP** 8.2 ou supérieur
- **Node.js** 18 ou supérieur
- **MySQL** 8.0 ou supérieur
- **Composer** pour PHP
- **npm** ou **yarn** pour Node.js
- **Git**

## 🚀 Installation Rapide

### 1. Cloner le repository

```bash
git clone https://github.com/valisoaGit/formation-management-platform.git
cd formation-management-platform
```

### 2. Configuration Backend (Laravel)

```bash
cd backend

# Installation des dépendances
composer install

# Configuration
cp .env.example .env
php artisan key:generate

# Créer la base de données
mysql -u root -p
CREATE DATABASE formation_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Migrations
php artisan migrate --seed

# Lancement du serveur
php artisan serve
```

Le backend sera accessible à : **http://localhost:8000**

### 3. Configuration Frontend (React)

Dans un nouveau terminal :

```bash
cd frontend

# Installation des dépendances
npm install

# Lancement du serveur
npm start
```

Le frontend sera accessible à : **http://localhost:3000**

## 📁 Structure du Projet

```
formation-management-platform/
├── backend/
│   ├── app/
│   │   ├── Models/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   ├── Requests/
│   │   │   └── Resources/
│   │   └── Traits/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── routes/
│   │   └── api.php
│   ├── .env.example
│   └── composer.json
│
├── frontend/
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── services/
│   │   ├── store/
│   │   ├── utils/
│   │   └── App.jsx
│   ├── public/
│   ├── .env.example
│   └── package.json
│
└── docs/
    ├── API.md
    ├── DATABASE.md
    └── INSTALLATION.md
```

## 🔧 Configuration Détaillée

### Backend - Fichier .env

```env
APP_NAME="Formation Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=formation_db
DB_USERNAME=root
DB_PASSWORD=
```

### Frontend - Fichier .env

```env
REACT_APP_API_URL=http://localhost:8000/api
REACT_APP_API_TIMEOUT=10000
```

## 📝 Données de Test

Après la migration, les seeders créent :

- 1 utilisateur admin : `admin@example.com` / `password`
- 1 utilisateur client : `client@example.com` / `password`
- 5 formations avec options et modules
- 10 inscriptions de test
- 20 paiements de test

## 🧪 Tester l'Application

### Vérifier que le backend fonctionne

```bash
curl http://localhost:8000/api/formations
```

### Créer un compte ou se connecter

1. Allez sur http://localhost:3000
2. Cliquez sur "Créer un compte"
3. Remplissez le formulaire
4. Vous serez redirigé vers le dashboard

## 🛠️ Commandes Utiles

### Backend (Laravel)

```bash
# Lancer les migrations
php artisan migrate

# Remplir la base avec des données
php artisan db:seed

# Créer un utilisateur
php artisan tinker
>>> User::factory()->create(['email' => 'test@example.com'])

# Effacer tout et recommencer
php artisan migrate:fresh --seed

# Générer une clé de chiffrement
php artisan key:generate
```

### Frontend (React)

```bash
# Installer une dépendance
npm install nom-du-package

# Build pour la production
npm run build

# Lancer les tests
npm test
```

## 🐳 Installation avec Docker (Optionnel)

Si vous préférez utiliser Docker :

```bash
# Dans la racine du projet
docker-compose up -d

# Migrations
docker-compose exec backend php artisan migrate --seed
```

## 📦 Production

### Backend

```bash
cd backend
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan migrate --force
```

### Frontend

```bash
cd frontend
npm run build
# Servir les fichiers dans le dossier 'build/'
```

## ✅ Checklist de Déploiement

- [ ] Variables d'environnement configurées
- [ ] Base de données créée et migrée
- [ ] Migrations exécutées
- [ ] Assets générés (frontend)
- [ ] Permissions des fichiers correctes
- [ ] SSL configuré (production)
- [ ] Sauvegardes configurées
- [ ] Logs configurés
- [ ] Emails configurés
- [ ] Uploads configurés

## 🆘 Dépannage

### Erreur de connexion à la base de données

```bash
# Vérifier les paramètres .env
# Vérifier que MySQL est en cours d'exécution
mysql -u root -p
```

### Node modules problems

```bash
cd frontend
rm -rf node_modules package-lock.json
npm install
```

### Composer issues

```bash
cd backend
composer clear-cache
composer install
```

## 📞 Support

Pour toute question ou problème, consultez la documentation ou ouvrez une issue sur GitHub.
