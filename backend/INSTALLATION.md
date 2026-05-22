# Guide d'Installation - Backend (Laravel)

## Étape 1 : Installation des dépendances

```bash
cd backend
composer install
```

## Étape 2 : Configuration

```bash
# Copier le fichier de configuration
cp .env.example .env

# Générer la clé de l'application
php artisan key:generate
```

## Étape 3 : Configuration de la base de données

Modifiez le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=formation_db
DB_USERNAME=root
DB_PASSWORD=
```

## Étape 4 : Migrations et Seeders

```bash
# Créer les tables
php artisan migrate

# Remplir avec des données de test
php artisan db:seed
```

## Étape 5 : Lancement du serveur

```bash
php artisan serve
```

L'API sera accessible à : http://localhost:8000

## Structure des fichiers Laravel

```
backend/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Formation.php
│   │   ├── Inscription.php
│   │   ├── Paiement.php
│   │   ├── Module.php
│   │   └── Option.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── FormationController.php
│   │   │   ├── InscriptionController.php
│   │   │   ├── PaiementController.php
│   │   │   └── SuiviController.php
│   │   └── Requests/
│   └── Traits/
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── api.php
└── storage/
```

## Points d'accès API

### Authentification
- `POST /api/auth/register` - Inscription
- `POST /api/auth/login` - Connexion
- `POST /api/auth/logout` - Déconnexion

### Formations
- `GET /api/formations` - Lister les formations
- `POST /api/formations` - Créer une formation
- `GET /api/formations/{id}` - Afficher une formation
- `PUT /api/formations/{id}` - Modifier une formation
- `DELETE /api/formations/{id}` - Supprimer une formation

### Inscriptions
- `GET /api/inscriptions` - Lister les inscriptions
- `POST /api/inscriptions` - Créer une inscription
- `GET /api/inscriptions/{id}` - Afficher une inscription
- `PUT /api/inscriptions/{id}` - Modifier une inscription

### Paiements
- `GET /api/paiements` - Lister les paiements
- `POST /api/paiements` - Créer un paiement
- `GET /api/paiements/{id}` - Afficher un paiement
- `PUT /api/paiements/{id}` - Modifier un paiement

### Export
- `GET /api/inscriptions/export/csv` - Exporter en CSV
- `GET /api/paiements/export/csv` - Exporter les paiements
