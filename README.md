# PHP Dynamic App — Contacts Manager

## Overview
A simple PHP + MySQL CRUD application (Create, Read, Update, Delete). Built using PHP (PDO) and MySQL with prepared statements.

## Files
- `dynamic_project.sql` — SQL script to create database, table, sample data
- `db.php` — database connection (update credentials)
- `index.php` — list/read contacts
- `create.php` — create form and processing
- `edit.php` — update form and processing
- `delete.php` — deletion handler
- `style.css` — simple styles

## Setup (local)
1. Install XAMPP / WAMP / LAMP and start Apache & MySQL.
2. Place the project folder into your webserver's root directory:
   - XAMPP: `C:\xampp\htdocs\php-dynamic-app` (Windows)
   - Linux: `/var/www/html/php-dynamic-app`
3. Import the database:
   - Using phpMyAdmin: go to http://localhost/phpmyadmin → Import → choose `dynamic_project.sql`
   - Or run the SQL in MySQL CLI.
4. Update `db.php` with your DB credentials (username, password).
5. Open the app: `http://localhost/php-dynamic-app/index.php`

## Security notes
- All DB queries use prepared statements to prevent SQL injection.
- Server-side validation for required fields is implemented.
- In production, never display raw DB errors — log them instead.

## GitHub Submission
- Create a repository (e.g., `php-dynamic-app`)
- Upload all files (`.php`, `.sql`, `.css`, `README.md`)
- Use clear commit messages (e.g., "Initial commit: CRUD app with SQL script")

## License
This code is provided as-is for academic use.
