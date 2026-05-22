# Guide d'Installation - Frontend (React)

## Étape 1 : Installation des dépendances

```bash
cd frontend
npm install
```

## Étape 2 : Configuration

```bash
# Copier le fichier de configuration
cp .env.example .env
```

Modifiez le fichier `.env` avec l'URL de votre backend :

```env
REACT_APP_API_URL=http://localhost:8000/api
REACT_APP_API_TIMEOUT=10000
```

## Étape 3 : Lancement du serveur de développement

```bash
npm start
```

L'application sera accessible à : http://localhost:3000

## Structure des fichiers React

```
frontend/src/
├── components/
│   ├── Common/
│   │   ├── Sidebar.jsx
│   │   ├── Navbar.jsx
│   │   └── Footer.jsx
│   ├── Formation/
│   │   ├── FormationList.jsx
│   │   ├── FormationForm.jsx
│   │   └── FormationModal.jsx
│   ├── Inscription/
│   │   ├── InscriptionList.jsx
│   │   ├── InscriptionForm.jsx
│   │   └── InscriptionModal.jsx
│   ├── Paiement/
│   │   ├── PaiementList.jsx
│   │   ├── PaiementForm.jsx
│   │   ├── PaiementModal.jsx
│   │   └── Facture.jsx
│   └── Suivi/
│       ├── SuiviList.jsx
│       ├── SuiviDetail.jsx
│       └── StatistiquesCard.jsx
├── pages/
│   ├── Dashboard.jsx
│   ├── LoginPage.jsx
│   ├── FormationsPage.jsx
│   ├── InscriptionsPage.jsx
│   ├── PaiementsPage.jsx
│   └── SuiviPage.jsx
├── services/
│   ├── api.js
│   ├── authService.js
│   ├── formationService.js
│   ├── inscriptionService.js
│   ├── paiementService.js
│   └── suiviService.js
├── store/
│   ├── index.js
│   └── slices/
│       ├── authSlice.js
│       ├── formationSlice.js
│       ├── inscriptionSlice.js
│       ├── paiementSlice.js
│       └── suiviSlice.js
├── utils/
│   ├── formatters.js
│   ├── validators.js
│   ├── exportHelpers.js
│   └── constants.js
├── styles/
│   ├── variables.css
│   ├── global.css
│   └── animations.css
├── App.jsx
└── index.js
```

## Features Principales

### Authentification
- Page de connexion
- Gestion des tokens
- Redirection automatique

### Gestion des Formations
- Liste avec pagination
- Formulaire de création/modification
- Modal Bootstrap
- Animations fluides

### Gestion des Inscriptions
- Formulaire dynamique selon la formation
- Upload de documents
- Validation en temps réel
- Historique des modifications

### Gestion des Paiements
- Liste des paiements
- Paiements en tranches
- Facturation
- Suivi des soldes

### Export et Rapport
- Export CSV
- Export PDF
- Pagination avancée
- Filtrage

## Build pour la Production

```bash
npm run build
```

Les fichiers compilés seront dans le dossier `build/`
