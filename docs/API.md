# Documentation API - Formation Management Platform

Base URL: `http://localhost:8000/api`

## Authentication

L'API utilise Laravel Sanctum pour l'authentification par token.

Tous les endpoints (sauf login/register) nécessitent le header :
```
Authorization: Bearer {token}
Content-Type: application/json
```

---

## 🔐 Authentification

### Register
```http
POST /auth/register
Content-Type: application/json

{
  "nom": "Dupont",
  "prenom": "Jean",
  "email": "jean@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "telephone": "+261301234567",
  "role": "client"
}
```

**Response (201):**
```json
{
  "message": "Utilisateur créé avec succès",
  "token": "1|abcdef...",
  "user": {...}
}
```

### Login
```http
POST /auth/login
Content-Type: application/json

{
  "email": "jean@example.com",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "token": "1|abcdef...",
  "user": {...}
}
```

### Logout
```http
POST /auth/logout
Authorization: Bearer {token}
```

---

## 📚 Formations

### Lister les formations
```http
GET /formations?page=1&per_page=15&search=&niveau=
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "data": [
    {
      "id": 1,
      "titre": "Comptabilité I",
      "description": "Formation en comptabilité...",
      "prix_base": 150000,
      "duree": 40,
      "niveau_etude": "BACC",
      "statut": "active",
      "options": [...],
      "modules": [...]
    }
  ],
  "pagination": {
    "current_page": 1,
    "total": 10,
    "per_page": 15
  }
}
```

### Créer une formation
```http
POST /formations
Authorization: Bearer {token}
Content-Type: application/json

{
  "titre": "Comptabilité I",
  "description": "Formation en comptabilité...",
  "prix_base": 150000,
  "duree": 40,
  "niveau_etude": "BACC"
}
```

**Response (201):**
```json
{
  "id": 1,
  "titre": "Comptabilité I",
  ...
}
```

### Récupérer une formation
```http
GET /formations/{id}
Authorization: Bearer {token}
```

### Modifier une formation
```http
PUT /formations/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "titre": "Comptabilité I - Modifiée",
  "prix_base": 160000
}
```

### Supprimer une formation
```http
DELETE /formations/{id}
Authorization: Bearer {token}
```

---

## 📝 Inscriptions

### Lister les inscriptions
```http
GET /inscriptions?page=1&per_page=15&statut=&search=
Authorization: Bearer {token}
```

### Créer une inscription
```http
POST /inscriptions
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
  "formation_id": 1,
  "nom_complet": "Jean Dupont",
  "email": "jean@example.com",
  "telephone": "+261301234567",
  "adresse": "Antananarivo",
  "raison_sociale": "Mon Entreprise",
  "numero_commercial": "IM123456",
  "age": 25,
  "categorie": "Etudiant(e)",
  "comment_connu": "Par un ami",
  "ordinateur": "oui",
  "ecole_universite": "Université X",
  "niveau_etude": "Licence",
  "options": [1, 2],
  "modules": [1, 2],
  "cni": "file",
  "photo": "file"
}
```

### Récupérer une inscription
```http
GET /inscriptions/{id}
Authorization: Bearer {token}
```

### Modifier une inscription
```http
PUT /inscriptions/{id}
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
  "statut": "confirmee",
  "nom_complet": "Jean Dupont"
}
```

### Exporter les inscriptions en CSV
```http
GET /inscriptions/export/csv?statut=&search=
Authorization: Bearer {token}
```

---

## 💳 Paiements

### Lister les paiements
```http
GET /paiements?page=1&per_page=15&statut=
Authorization: Bearer {token}
```

### Créer un paiement
```http
POST /paiements
Authorization: Bearer {token}
Content-Type: application/json

{
  "inscription_id": 1,
  "montant": 50000,
  "date_paiement": "2024-05-22",
  "mode_paiement": "virement",
  "numero_reference": "REF123",
  "description": "Paiement tranche 1"
}
```

**Response (201):**
```json
{
  "id": 1,
  "inscription_id": 1,
  "montant": 50000,
  "date_paiement": "2024-05-22",
  "mode_paiement": "virement",
  "numero_facture": "FAC001-20240522",
  "statut": "confirmee"
}
```

### Récupérer un paiement
```http
GET /paiements/{id}
Authorization: Bearer {token}
```

### Modifier un paiement
```http
PUT /paiements/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "statut": "echec",
  "description": "Paiement rejeté"
}
```

### Exporter les paiements en CSV
```http
GET /paiements/export/csv?statut=
Authorization: Bearer {token}
```

---

## 📊 Suivi

### Lister le suivi
```http
GET /suivi?inscription_id=&statut=
Authorization: Bearer {token}
```

### Créer un suivi
```http
POST /suivi
Authorization: Bearer {token}
Content-Type: application/json

{
  "inscription_id": 1,
  "module_id": 1,
  "date_debut": "2024-06-01",
  "date_fin": "2024-06-30",
  "statut": "en_cours"
}
```

### Mettre à jour le suivi
```http
PUT /suivi/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "statut": "termine",
  "note": 16.5,
  "observation": "Excellent travail"
}
```

---

## 📋 Factures

### Lister les factures
```http
GET /factures?inscription_id=&statut=
Authorization: Bearer {token}
```

### Générer une facture
```http
POST /factures
Authorization: Bearer {token}
Content-Type: application/json

{
  "inscription_id": 1
}
```

### Récupérer une facture
```http
GET /factures/{id}
Authorization: Bearer {token}
```

### Télécharger une facture en PDF
```http
GET /factures/{id}/download
Authorization: Bearer {token}
```

---

## Statuts HTTP

- **200 OK** - Requête réussie
- **201 Created** - Ressource créée
- **204 No Content** - Succès sans contenu
- **400 Bad Request** - Erreur de validation
- **401 Unauthorized** - Authentification requise
- **403 Forbidden** - Accès refusé
- **404 Not Found** - Ressource non trouvée
- **422 Unprocessable Entity** - Erreur de validation
- **500 Internal Server Error** - Erreur serveur

## Format d'erreur

```json
{
  "message": "Description de l'erreur",
  "errors": {
    "field": ["Erreur pour ce champ"]
  }
}
```
