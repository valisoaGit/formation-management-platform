# 📊 Diagrammes UML - Plateforme de Gestion de Formation

## 📁 Fichiers Diagrammes

Ce dossier contient les diagrammes UML du projet en format PlantUML.

### **Fichiers Disponibles**

1. **classe_diagram.puml** - Diagramme de classes
   - Modèles et relations entre entités
   - Attributs et méthodes
   - Cardinalités des relations

2. **use_cases_diagram.puml** - Diagramme de cas d'utilisation
   - Acteurs (Admin, Commercial, Manager, Client)
   - 25+ cas d'utilisation
   - Relations et autorisations

3. **sequence_inscription.puml** - Diagramme de séquence (Inscription)
   - Processus complet d'inscription
   - Création du paiement initial
   - 31 étapes du flux

4. **sequence_paiement.puml** - Diagramme de séquence (Paiement)
   - Processus paiements en tranches
   - Gestion des factures
   - 31 étapes du flux

5. **sequence_suivi.puml** - Diagramme de séquence (Suivi)
   - Suivi de la progression
   - Attribution des notes
   - Génération attestations
   - 41 étapes du flux

## 🔄 Comment Générer les PDF

### **Option 1 : Utiliser PlantUML Online**

1. Allez sur : https://www.plantuml.com/plantuml/uml/
2. Copiez le contenu du fichier .puml
3. Collez dans l'éditeur
4. Cliquez sur "Download"
5. Sélectionnez "PNG" ou "PDF"

### **Option 2 : Installer PlantUML Localement**

```bash
# Installation Java (requis)
sudo apt-get install default-jre

# Installation PlantUML
sudo apt-get install plantuml

# Générer PDF
plantuml -Tpdf classe_diagram.puml
plantuml -Tpdf use_cases_diagram.puml
plantuml -Tpdf sequence_inscription.puml
plantuml -Tpdf sequence_paiement.puml
plantuml -Tpdf sequence_suivi.puml

# Ou générer tous les fichiers
for file in *.puml; do plantuml -Tpdf "$file"; done
```

### **Option 3 : Utiliser VS Code Extension**

1. Installez l'extension : "PlantUML"
2. Ouvrez le fichier .puml
3. Clic droit → "Export Current Diagram"
4. Choisissez format PDF

### **Option 4 : Docker**

```bash
docker run --rm -v $(pwd):/data think/plantuml -Tpdf *.puml
```

## 📋 Contenu des Diagrammes

### **Diagramme de Classes**

**Entités principales :**
- User (Admin, Commercial, Manager, Client)
- Formation
- Option
- Module (Niveau I, II, III)
- Inscription
- Paiement
- Suivi
- Facture

**Cardinalités :**
- Formation (1) -- (*) Option
- Formation (1) -- (*) Module
- Formation (1) -- (*) Inscription
- Inscription (*) -- (*) Option
- Inscription (*) -- (*) Module
- Inscription (1) -- (*) Paiement
- Inscription (1) -- (*) Suivi
- Inscription (1) -- (*) Facture

### **Diagramme de Cas d'Utilisation**

**Acteurs :**
- Admin : Accès complet
- Commercial : Vente et suivi
- Manager : Gestion inscriptions
- Client : Consultation propre compte

**Cas d'utilisation par domaine :**
- Formations : 6 UC
- Inscriptions : 6 UC
- Paiements : 5 UC
- Suivi : 4 UC
- Authentification : 3 UC
- Rapports : 2 UC

### **Diagrammes de Séquence**

#### **1. Inscription (31 étapes)**
- Consultation des formations
- Remplissage du formulaire
- Upload documents
- Création inscription
- Paiement initial
- Génération facture

#### **2. Paiement (31 étapes)**
- Visualisation du solde
- Enregistrement paiement
- Génération facture
- Mise à jour statut
- Téléchargement PDF

#### **3. Suivi (41 étapes)**
- Consultation progression
- Saisie notes
- Ajout observations
- Génération attestation
- Notification stagiaire

## 🎯 Utilisation des Diagrammes

**Pour la documentation :**
- Imprimer et joindre à la documentation technique
- Partager avec les parties prenantes

**Pour la présentation :**
- Utiliser dans les présentations PowerPoint
- Inclure dans les rapports

**Pour le développement :**
- Référence pour la structure de base de données
- Guide pour l'implémentation des contrôleurs
- Définition des interactions système

## 🔧 Modification des Diagrammes

Les fichiers .puml peuvent être édités :
- Directement dans un éditeur texte
- Via VS Code avec extension PlantUML
- Sur plantuml.com pour prévisualisation instantanée

**Syntaxe PlantUML :**
- Classes : `class NomClasse { ... }`
- Relations : `ClasseA "1" -- "*" ClasseB`
- Cas d'utilisation : `usecase "Nom" as UC_ID`
- Séquences : `Actor -> Participant : Message`

## 📞 Ressources

- **PlantUML Docs** : https://plantuml.com
- **PlantUML Online** : https://www.plantuml.com/plantuml/uml/
- **Syntaxe Classes** : https://plantuml.com/class-diagram
- **Syntaxe Cas d'Utilisation** : https://plantuml.com/use-case-diagram
- **Syntaxe Séquences** : https://plantuml.com/sequence-diagram

---

**Créé pour le projet Formation Management Platform**
