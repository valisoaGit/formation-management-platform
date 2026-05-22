# Plateforme de Gestion de Formation

Système complet de gestion de formations pratiques avec inscription, paiement et suivi des stagiaires.

## 🎯 Fonctionnalités

### 1. Gestion des Formations
- Création et modification de formations
- Gestion des options (Comptabilité, Fiscalité, etc.)
- Définition des prix
- Modules de formation (Niveau I, II, III)
- Niveaux d'étude (BACC, Licence, Master, Professionnel)

### 2. Gestion des Inscriptions
- Formulaires dynamiques basés sur la formation sélectionnée
- Fiches d'inscription personnalisées
- Validation des champs
- Historique des modifications
- Pièces justificatives (CIN, photos)

### 3. Gestion des Paiements
- Paiements uniques ou en tranches
- Gestion des versements
- Facturation automatique
- Suivi des soldes
- Rappels de paiement

### 4. Suivi des Stagiaires
- Dashboard de progression
- Historique complet
- Statistiques et rapports
- Attestations

### 5. Fonctionnalités additionnelles
- Pagination avancée
- Export en CSV/PDF
- Authentification sécurisée
- Gestion des droits d'accès
- Interface responsive

## 💻 Stack Technologique

### Backend
- **Framework** : Laravel 11
- **Base de données** : MySQL 8.0+
- **API** : RESTful avec Laravel Sanctum
- **Validation** : Laravel Validation
- **File Storage** : Laravel Storage

### Frontend
- **Framework** : React 18+
- **Styling** : Bootstrap 5
- **État** : Redux Toolkit
- **HTTP Client** : Axios
- **Composants** : React Bootstrap
- **Export** : react-csv, jsPDF

## 📋 Prérequis

- PHP 8.2+
- Node.js 18+
- MySQL 8.0+
- Composer
- npm ou yarn

## 🚀 Installation et Démarrage

### Backend (Laravel)

```bash
cd backend

# Installation des dépendances
composer install

# Configuration
cp .env.example .env
php artisan key:generate

# Base de données
php artisan migrate
php artisan db:seed

# Serveur de développement
php artisan serve
```

### Frontend (React)

```bash
cd frontend

# Installation des dépendances
npm install

# Serveur de développement
npm start
```

L'application sera accessible à : http://localhost:3000

## 📁 Structure du Projet

```
formation-management-platform/
├── backend/                 # Application Laravel
│   ├── app/
│   │   ├── Models/         # Modèles Eloquent
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   └── Requests/
│   │   └── Traits/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── routes/
│   ├── .env.example
│   └── composer.json
│
├── frontend/                # Application React
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── services/
│   │   ├── store/
│   │   ├── utils/
│   │   └── App.js
│   ├── public/
│   ├── .env.example
│   └── package.json
│
└── docs/                    # Documentation
    ├── API.md
    ├── DATABASE.md
    └── INSTALLATION.md
```

## 🔐 Authentification

L'application utilise Laravel Sanctum pour l'authentification par token.

## 📊 Base de Données

Principal tables :
- `users` - Utilisateurs (Clients, Commerciaux, Managers)
- `formations` - Formations disponibles
- `inscriptions` - Inscriptions des stagiaires
- `paiements` - Paiements et versements
- `modules` - Modules de formation
- `options` - Options de formation

## 📝 Documentation

Voir les fichiers dans le dossier `docs/` pour :
- API Documentation
- Schéma de base de données
- Guide d'installation détaillé

## 👥 Auteur

valisoaGit

## 📄 Licence

MIT
