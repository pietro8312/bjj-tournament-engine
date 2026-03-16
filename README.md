# 🥋 BJJ Tournament Engine

![PHP](https://img.shields.io/badge/PHP-Backend-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![Status](https://img.shields.io/badge/status-alpha-yellow)

A lightweight **Brazilian Jiu-Jitsu tournament management system** built with PHP.

The engine allows organizers to **create tournament brackets, control matches, and automatically progress fighters through rounds**.

---

# ✨ Features

- Tournament bracket generation
- Winner selection system
- Match scoreboard
- Automatic fighter progression
- Fight control panel
- Clean URLs using `.htaccess`

---

# 🛠 Tech Stack

| Technology | Role |
|------------|------|
| PHP | Backend logic |
| MySQL | Database |
| JavaScript | Client interaction |
| HTML / CSS | Interface |
| Apache | Web server |
| .htaccess | URL routing |

---

# 📂 Project Structure
```
proj-irene
│
├── .htaccess
├── cadastro.php
├── index.php
├── main.php
├── README.md
│
├── assets
│   ├── comp.css
│   ├── edit.css
│   ├── fight.css
│   ├── fight.js
│   ├── FighterAdd.css
│   ├── fights.css
│   ├── global.css
│   ├── header.css
│   ├── main_manager.js
│   ├── tournament-bracket.css
│   ├── tournament-bracket.js
│   │
│   └── bracket
│       ├── bracket.css
│       ├── bracket.js
│       └── tournament-create.css
│
├── config
│   ├── assets.php
│   ├── connection.php
│   └── url.php
│
├── controllers
│   ├── bracketController.php
│   ├── fighterController.php
│   └── matchController.php
│
├── images
│
├── models
│   ├── bracket.php
│   ├── fighter.php
│   └── tournamentMatch.php
│
└── views
    │
    ├── bracket
    │   ├── create.php
    │   ├── list.php
    │   ├── scoreboard.php
    │   ├── show.php
    │   └── view.php
    │
    ├── components
    │   ├── comp.php
    │   └── warning.php
    │
    ├── fighters
    │   ├── create.php
    │   └── list.php
    │
    └── Layout
        ├── footer.php
        └── header.php
```
---

# ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/bjj-tournament-engine.git

2. Move the project to your web server

Example for XAMPP:

C:/xampp/htdocs/

3. Start services

Start:

Apache

MySQL

4. Access the application
http://localhost/proj-irene

---

🚀 Usage

Create a tournament bracket

Add fighters to the bracket

Open the bracket view

Use the fight control panel to select winners

Fighters automatically progress in the bracket