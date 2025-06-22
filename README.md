# 🛠️ PC Troubleshooter

A lightweight procedural PHP website to help diagnose computer issues, whether hardware or software related.

## 💡 Project Goal

This tool is designed to assist users or technicians in identifying common computer problems through a simple, guided interface. It provides diagnostic tips, common symptoms, and possible solutions for both hardware and software issues.

## 🚀 Features (planned or in progress)

- 🔍 Guided troubleshooting by symptom
- 🖥️ Categorization by component (CPU, RAM, OS, etc.)
- 💾 Suggestions for solutions or tests
- 🧰 Admin dashboard to manage problem database
- 📱 Mobile-friendly layout

## ⚙️ Tech Stack

- PHP (procedural, no framework)
- HTML/CSS (vanilla, no frontend framework)
- MySQL for storing issues and categories

## 📁 Project Structure

/
├── index.php # Entry point
├── config.php # Configuration file (DB, constants, etc.)
├── core/ # Shared functions (DB connection, routing)
├── controllers/ # Page logic
├── models/ # DB access
├── views/ # HTML output


## 🧪 Requirements

- PHP ≥ 7.4
- MySQL or MariaDB
- Apache/Nginx with URL rewriting (optional for clean URLs)
- Local dev: [XAMPP](https://www.apachefriends.org/index.html) or [Laragon](https://laragon.org)

## 🛠️ Setup

1. Clone this repository
2. Create a MySQL database (e.g., `pc_troubleshooter`)
3. Configure database access in `config.php`
4. Start your local server and access `index.php`
5. Import the database structure (SQL file coming soon)

## 🤝 Contributing

This is a solo micro-project for now, but contributions, suggestions, or feedback are welcome.

## 📄 License

This project is proprietary and not open source.  
All source code, logic, and assets are the intellectual property of the author.  
No part of this project may be copied, reproduced, reused, or distributed without explicit written permission.
© 2025 – All rights reserved.
