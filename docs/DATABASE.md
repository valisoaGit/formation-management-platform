# Schéma de Base de Données

## Vue d'ensemble

Le système utilise MySQL pour stocker les données. Voici la structure des tables principales.

## Tables

### 1. users
Stocke les informations des utilisateurs (clients, commerciaux, managers)

```sql
CREATE TABLE users (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  telephone VARCHAR(20),
  adresse TEXT,
  role ENUM('client', 'commercial', 'manager', 'admin') DEFAULT 'client',
  statut ENUM('actif', 'inactif') DEFAULT 'actif',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 2. formations
Stocke les informations des formations proposées

```sql
CREATE TABLE formations (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  titre VARCHAR(255) NOT NULL,
  description TEXT,
  prix_base DECIMAL(10, 2) NOT NULL,
  duree INT, -- en heures
  niveau_etude ENUM('BACC', 'Licence', 'Master', 'Professionnel') NOT NULL,
  statut ENUM('active', 'inactive', 'archivee') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 3. options
Stocke les options de formation (Comptabilité, Fiscalité, etc.)

```sql
CREATE TABLE options (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  formation_id BIGINT NOT NULL,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  prix_additionnel DECIMAL(10, 2) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (formation_id) REFERENCES formations(id) ON DELETE CASCADE
);
```

### 4. modules
Stocke les modules de formation (Niveau I, II, III)

```sql
CREATE TABLE modules (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  formation_id BIGINT NOT NULL,
  nom VARCHAR(255) NOT NULL,
  niveau ENUM('I', 'II', 'III') NOT NULL,
  description TEXT,
  duree INT, -- en heures
  ordre INT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (formation_id) REFERENCES formations(id) ON DELETE CASCADE
);
```

### 5. inscriptions
Stocke les inscriptions des stagiaires

```sql
CREATE TABLE inscriptions (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  formation_id BIGINT NOT NULL,
  user_id BIGINT NOT NULL,
  date_inscription DATE NOT NULL,
  nom_complet VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  telephone VARCHAR(20) NOT NULL,
  adresse TEXT,
  raison_sociale VARCHAR(255),
  numero_commercial VARCHAR(50),
  age INT,
  categorie ENUM('Etudiant(e)', 'Travailleur') NOT NULL,
  comment_connu TEXT,
  ordinateur ENUM('oui', 'non') NOT NULL,
  ecole_universite VARCHAR(255),
  niveau_etude ENUM('BACC', 'Licence', 'Master', 'Professionnel') NOT NULL,
  cni_path VARCHAR(255),
  photo_path VARCHAR(255),
  statut ENUM('en_attente', 'confirmee', 'en_cours', 'terminnee', 'annulee') DEFAULT 'en_attente',
  prix_total DECIMAL(10, 2) NOT NULL,
  prix_paye DECIMAL(10, 2) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (formation_id) REFERENCES formations(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 6. inscription_options
Table de liaison pour les options sélectionnées dans une inscription

```sql
CREATE TABLE inscription_options (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  inscription_id BIGINT NOT NULL,
  option_id BIGINT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (inscription_id) REFERENCES inscriptions(id) ON DELETE CASCADE,
  FOREIGN KEY (option_id) REFERENCES options(id) ON DELETE CASCADE
);
```

### 7. inscription_modules
Table de liaison pour les modules sélectionnés

```sql
CREATE TABLE inscription_modules (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  inscription_id BIGINT NOT NULL,
  module_id BIGINT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (inscription_id) REFERENCES inscriptions(id) ON DELETE CASCADE,
  FOREIGN KEY (module_id) REFERENCES modules(id) ON DELETE CASCADE
);
```

### 8. paiements
Stocke les paiements effectués

```sql
CREATE TABLE paiements (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  inscription_id BIGINT NOT NULL,
  montant DECIMAL(10, 2) NOT NULL,
  date_paiement DATE NOT NULL,
  mode_paiement ENUM('especes', 'cheque', 'virement', 'carte') NOT NULL,
  numero_reference VARCHAR(255),
  description TEXT,
  numero_facture VARCHAR(50),
  statut ENUM('en_attente', 'confirmee', 'echec') DEFAULT 'confirmee',
  created_by BIGINT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (inscription_id) REFERENCES inscriptions(id),
  FOREIGN KEY (created_by) REFERENCES users(id)
);
```

### 9. suivi
Stocke le suivi de la progression des stagiaires

```sql
CREATE TABLE suivi (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  inscription_id BIGINT NOT NULL,
  module_id BIGINT,
  date_debut DATE,
  date_fin DATE,
  statut ENUM('non_commence', 'en_cours', 'termine', 'abandon') DEFAULT 'non_commence',
  note DECIMAL(5, 2),
  observation TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (inscription_id) REFERENCES inscriptions(id),
  FOREIGN KEY (module_id) REFERENCES modules(id)
);
```

### 10. factures
Stocke les factures générées

```sql
CREATE TABLE factures (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  inscription_id BIGINT NOT NULL,
  numero_facture VARCHAR(50) UNIQUE NOT NULL,
  date_facture DATE NOT NULL,
  montant_total DECIMAL(10, 2) NOT NULL,
  montant_paye DECIMAL(10, 2) DEFAULT 0,
  statut ENUM('brouillon', 'emise', 'payee', 'partiellement_payee', 'annulee') DEFAULT 'emise',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (inscription_id) REFERENCES inscriptions(id)
);
```

## Relations

```
users
  ├── inscriptions (1:N)
  └── paiements (1:N)

formations
  ├── options (1:N)
  ├── modules (1:N)
  └── inscriptions (1:N)

inscriptions
  ├── options (N:M via inscription_options)
  ├── modules (N:M via inscription_modules)
  ├── paiements (1:N)
  ├── suivi (1:N)
  └── factures (1:N)

modules
  └── suivi (1:N)
```

## Indexes

Pour optimiser les performances :

```sql
CREATE INDEX idx_inscriptions_formation_id ON inscriptions(formation_id);
CREATE INDEX idx_inscriptions_user_id ON inscriptions(user_id);
CREATE INDEX idx_paiements_inscription_id ON paiements(inscription_id);
CREATE INDEX idx_suivi_inscription_id ON suivi(inscription_id);
CREATE INDEX idx_factures_inscription_id ON factures(inscription_id);
```
