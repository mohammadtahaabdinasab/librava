# Librava - Local Development Setup Guide

This guide walks you through setting up Librava on your local machine for development.

## Prerequisites

- **PHP 8.2+** (with PDO, OpenSSL, and cURL extensions enabled)
- **MySQL 5.7+** or **MariaDB**
- **Composer** (PHP dependency manager)
- **Git**

## Step 1: Enable PHP Extensions

### Windows (XAMPP/standalone PHP)

Librava requires OpenSSL and cURL extensions for secure operations and API requests.

**For XAMPP:**
1. Open `C:\xampp\php\php.ini` in a text editor
2. Find and uncomment these lines (remove the leading `;`):
   - `extension=openssl`
   - `extension=curl`
  - `extension=pdo_mysql`  # enable PDO MySQL driver for database access
3. Save and restart Apache

**For standalone PHP:**
1. Run: `php --ini` to find your `php.ini` file
2. Open the file and uncomment `extension=openssl` and `extension=curl`
  and also enable the PDO driver for MySQL by uncommenting `extension=pdo_mysql` (or `extension=php_pdo_mysql.dll` on some Windows builds).
3. Verify: `php -m | findstr openssl` (should output `openssl`)

### Verifying PDO driver (MySQL)

Run these in PowerShell to confirm the PDO MySQL driver is available to the CLI:

```powershell
php --ini            # shows which php.ini file is loaded by the CLI
php -m | Select-String pdo  # shows pdo and pdo_mysql if enabled
php -r "print_r(PDO::getAvailableDrivers());"  # lists available PDO drivers
```

If `pdo_mysql` does not appear, enable it in the `php.ini` used by the CLI (from `php --ini`) and restart any running PHP servers.

### Linux/macOS

Extensions are typically included by default. Verify with:
```bash
php -m | grep openssl
php -m | grep curl
```

## Step 2: Create Environment Files

Copy `.env.example` to create local and production configs:

```bash
cp .env.example .env
cp .env.example .env.local
```

Edit `.env.local` with your local development settings:

```bash
APP_ENV=local
APP_DEBUG=true
DEFAULT_LANG=en

DB_HOST=127.0.0.1
DB_USER=root
DB_PASS=your_password_here
DB_NAME=librava_dev
```

⚠️ **Never commit** `.env` or `.env.local` — they contain sensitive data.

## Step 3: Set Up the Database

### Create MySQL Database

Connect to MySQL and run:

```bash
mysql -u root -p < database/librava.sql
```

Or import via phpMyAdmin:
1. Open phpMyAdmin
2. Click "Import"
3. Select `database/librava.sql`
4. Click "Go"

### Verify the Database

```bash
mysql -u root -p -e "USE librava; SHOW TABLES;"
```

You should see a `books` table.

## Step 4: Install Composer Dependencies

```bash
composer install
```

If OpenSSL is still disabled:

```bash
composer install --ignore-platform-req=ext-openssl
```

(Note: This is a temporary workaround. Enabling OpenSSL is strongly recommended.)

## Step 5: Start the Development Server

Start the PHP built-in development server:

```bash
php -S localhost:8000 -t public
```

Open your browser and visit: **http://localhost:8000/**

You should see the Librava welcome page with Bootstrap styling.

## Step 6: Test the API

Test the API endpoint (requires database to be populated):

```bash
curl -X GET http://localhost:8000/api/books
```

Expected response (when database has books):
```json
{
  "status": "success",
  "data": [
    {"id": 1, "title": "1984", "author": "George Orwell", "published_year": 1949, ...}
  ]
}
```

## Project Structure

- `app/` — Controllers, Models, Views
- `core/` — Core MVC classes (App, Router, Controller, Model)
- `config/` — Configuration files
- `routes/` — Web and API route definitions
- `resources/` — Language files, templates, messages
- `public/` — Entry point and static assets (CSS, JS, images)
- `storage/` — Logs, cache, and uploaded files
- `database/` — SQL schema files

## Troubleshooting

### "Class not found" errors
- Run: `composer dump-autoload`
- Verify: `grep App\\\\ composer.json` should show App namespace mapping

### Database connection fails
- Check: `php -r "echo env('DB_HOST'); echo env('DB_USER');"`
- Verify MySQL is running: `mysql -u root -p -e "SELECT 1;"`
- Check `.env` and `.env.local` have correct credentials

### Server won't start
- Try different port: `php -S localhost:9000 -t public`
- Check if port 8000 is in use: `netstat -ano | findstr 8000` (Windows)

### Routes return 404
- Ensure `.htaccess` is in `public/` directory
- Check route definitions in `routes/web.php`
- Verify Router::add() calls match your request paths

## Next Steps

1. **Add more routes** in `routes/web.php` and `routes/api.php`
2. **Create controllers** in `app/controllers/`
3. **Create models** in `app/models/` extending `Core\Model`
4. **Build views** in `app/views/`
5. **Populate database** with sample data
6. **Configure multilinguality** using `resources/lang/en.php` and `resources/lang/fa.php`

## Useful Commands

```bash
# Run composer autoloader
composer dump-autoload

# Start PHP server
php -S localhost:8000 -t public

# Check PHP version
php --version

# Validate PHP syntax
php -l app/controllers/HomeController.php

# Run all PHP files through linter
find . -name "*.php" -not -path "./vendor/*" -print0 | xargs -0 -n1 php -l
```

## Support

For issues or questions, see the **README.md** or check the GitHub repository at:
https://github.com/mohammadtahaabdinasab/librava

---

Happy coding! 🚀
