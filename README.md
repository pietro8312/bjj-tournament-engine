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
proj-irene
│
├── controllers
│ └── bracketController.php
│
├── models
│ ├── bracket.php
│ ├── fighter.php
│ └── tournamentMatch.php
│
├── views
│ └── bracket
│ ├── create.php
│ └── show.php
│
├── assets
│ ├── global.css
│ └── style.css
│
├── config
│ └── url.php
│
└── .htaccess

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