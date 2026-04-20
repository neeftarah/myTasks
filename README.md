# MyTasks

MyTasks est un **projet de démonstration** de type TodoList inspiré de services comme Todoist.  
Il sert de sandbox technique pour expérimenter une architecture moderne fullstack basée sur :

<p align="center">
    <img src="https://img.shields.io/badge/PHP-4F5B93?style=for-the-badge&logo=php&logoColor=white" alt="Java 21">
    <img src="https://img.shields.io/badge/Symfony-000000?style=for-the-badge&logo=symfony&logoColor=white" alt="Spring Boot 4">
    <img src="https://img.shields.io/badge/API_Platform-0099A1?style=for-the-badge&logo=apiplatform&logoColor=white" alt="PostgreSQL">
    <img src="https://img.shields.io/badge/Docker-2560FF?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
    <img src="https://img.shields.io/badge/Redis-FF4438?style=for-the-badge&logo=redis&logoColor=white" alt="Redis">
    <img src="https://img.shields.io/badge/VueJS-3FB984?style=for-the-badge&logo=vuedotjs&logoColor=white" alt="VueJS">
    <br>
    <img src="https://img.shields.io/badge/Status-In_Development-yellow" alt="Status">
    <img src="https://img.shields.io/badge/License-CC0_1.0-lightgrey.svg" alt="License">
</p>


---

## 🚀 Objectif du projet

Ce projet a pour but de :

- Mettre en place une **API REST moderne avec API Platform**
- Construire une **SPA Vue.js consommant une API**
- Expérimenter une **architecture fullstack découplée**
- Tester un setup **Docker simple et reproductible**

---

## 🧱 Stack technique

### Backend
- PHP 8+
- Symfony
- API Platform
- Doctrine ORM

### Frontend
- Vue.js
- Axios (communication API)
- UI simple type TodoList

### Infra
- Docker & Docker Compose
- Environnements séparés (API / Front / DB)

---

## 📦 Fonctionnalités

- Création de tâches
- Liste des tâches
- Mise à jour du statut (done / not done)
- Suppression de tâches
- API REST exposée via API Platform
- Consommation via frontend Vue.js

---

## 🐳 Lancer le projet avec Docker

### 1. Cloner le repo

```bash
git clone https://github.com/neeftarah/myTasks.git
cd myTasks
```

2. Lancer les containers
```bash
docker compose up -d
```

3. Accéder aux services  
 - Frontend Vue : http://localhost:8000  
 - Swagger / API Platform : http://localhost:8000/api

    > (les ports peuvent varier selon la configuration)

## 🧪 Architecture globale
```
Frontend (Vue.js)
        ↓
API REST (API Platform)
        ↓
Database (MySQL / PostgreSQL)
```

Le frontend communique uniquement avec l’API via HTTP.
```
📁 Structure du projet
myTasks/  
├── api/        # Backend Symfony + API Platform  
├── frontend/   # Application Vue.js  
├── docker/     # Config Docker  
└── docker-compose.yml  
```

## 💡 Pourquoi ce projet ?

Ce projet est un terrain de jeu technique pour :

tester API Platform en conditions réelles
construire une séparation propre frontend / backend
valider une approche Docker-first
simuler une application type SaaS (Todoist-like)

🔧 Améliorations possibles
* Authentification JWT
* Gestion multi-utilisateurs
* Drag & drop des tâches
* Tags / projets
* UI plus avancée (Vuetify / Tailwind)
* Tests backend + frontend
* CI/CD GitHub Actions


## 📄 Licence

Projet personnel de démonstration — usage libre.

## 👤 Auteur

Développé par Jérémy Moreau
