# Island Art Hawaiʻi - cPanel Deployment Guide

## 📋 Pre-Deployment Checklist

### ✅ Files Prepared for Upload

- [x] **ci4/** folder - Contains all CodeIgniter 4 application files
- [x] **public/** folder - Contains all public web files
- [x] Updated **index.php** with correct path to ci4 folder
- [x] **composer.json** and **composer.lock** copied to ci4 folder
- [x] **preload.php** configured for cPanel structure

---

## 🚀 Deployment Steps

### Step 1: Upload Files to cPanel

#### **Upload 1: Public Files**

- **Source:** Everything in `public/` folder on your PC
- **Destination:** `public_html/islandartnews/` on cPanel
- **Files include:**
  - `index.php`
  - `assets/` (built CSS/JS files)
  - `uploads/` (images, media)
  - `.htaccess`
  - `favicon.ico`, `robots.txt`, `sitemap.xml`

#### **Upload 2: Application Files**

- **Source:** Everything in `ci4/` folder on your PC
- **Destination:** Non-public folder on cPanel (e.g., `/home/username/ci4/`)
- **Files include:**
  - `app/` (CodeIgniter application)
  - `vendor/` (Composer dependencies)
  - `writable/` (logs, cache, uploads)
  - `.env` (environment configuration)
  - `composer.json`, `composer.lock`
  - `preload.php`, `spark`

### Step 2: Update Environment Configuration

#### **Edit `.env` file in ci4 folder:**

```env
# ENVIRONMENT
CI_ENVIRONMENT = production

# APP
app.baseURL = 'https://islandartnews.com/'
app.indexPage = ''

# DATABASE (update with your cPanel database details)
database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_db_username
database.default.password = your_db_password
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

# ENCRYPTION (generate new key for production)
encryption.key = hex2bin:your_32_character_hex_key
```

### Step 3: Set File Permissions

#### **Set proper permissions on cPanel:**

- **writable/** folder: `755` or `777`
- **writable/cache/**: `755` or `777`
- **writable/logs/**: `755` or `777`
- **writable/uploads/**: `755` or `777`
- **writable/session/**: `755` or `777`

### Step 4: Verify Path Configurations

#### **Confirm paths in key files:**

**public_html/islandartnews/index.php:**

```php
require FCPATH . '../ci4/app/Config/Paths.php';
```

**ci4/preload.php:**

```php
// PRODUCTION - cPanel deployment structure
define('FCPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public_html' . DIRECTORY_SEPARATOR . 'islandartnews' . DIRECTORY_SEPARATOR);

// DEVELOPMENT - Local development structure (commented out)
// define('FCPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
```

---

## 🔧 Post-Deployment Tasks

### Step 5: Install Dependencies (if supported by host)

```bash
cd /path/to/ci4/
composer install --no-dev --optimize-autoloader
```

### Step 6: Generate Encryption Key

```bash
php spark key:generate
```

### Step 7: Clear Cache

```bash
php spark cache:clear
```

### Step 8: Test Website

- Visit: `https://islandartnews.com/`
- Test mobile menu functionality
- Verify all pages load correctly
- Check contact form and other features

### Step 9: Configure OPcache Preloading (Optional)

📝 **Note for cPanel:**

- Most shared hosting providers **don't allow** opcache preloading configuration
- If your host doesn't support it, the file won't cause errors but won't provide
  benefits
- VPS or dedicated servers can take full advantage of this optimization

🔧 **To Enable on Server (if supported):** Add to `php.ini`:

```ini
opcache.preload=/path/to/your/ci4/preload.php
opcache.preload_user=www-data
```

Your preload.php is now optimized for your cPanel deployment structure! 🎯

---

## 📁 Final Directory Structure on cPanel

```
/home/username/
├── ci4/                          # Non-public application files
│   ├── .env                     # Production environment config
│   ├── app/                     # CodeIgniter application
│   │   ├── Controllers/
│   │   ├── Models/
│   │   ├── Views/
│   │   └── Config/
│   ├── vendor/                  # Composer dependencies
│   ├── writable/                # Cache, logs, uploads
│   ├── composer.json
│   ├── composer.lock
│   ├── preload.php
│   └── spark
└── public_html/islandartnews/   # Public web files
    ├── index.php               # Front controller
    ├── assets/                 # Built CSS/JS
    ├── uploads/                # Public uploads
    ├── .htaccess
    ├── favicon.ico
    ├── robots.txt
    └── sitemap.xml
```

---

## 🛠️ Troubleshooting

### Common Issues:

**1. 500 Internal Server Error**

- Check file permissions on writable/ folder
- Verify .env file has correct database credentials
- Check error logs in writable/logs/

**2. CSS/JS Not Loading**

- Verify assets/ folder uploaded correctly
- Check .htaccess file is present
- Confirm base URL in .env

**3. Database Connection Issues**

- Double-check database credentials in .env
- Ensure database exists on cPanel
- Verify database user has proper permissions

**4. Mobile Menu Not Working**

- Confirm vanilla JS files uploaded in assets/
- Check browser console for JavaScript errors
- Verify Vite build completed successfully

---

## 🔒 Security Notes

### ✅ Security Best Practices Implemented:

- Application files stored outside public directory
- Environment file (.env) in non-public location
- Database credentials not in version control
- Proper file permissions set
- Index page disabled for clean URLs

### 🚨 Important Security Reminders:

- Never commit .env file with production credentials
- Regularly update CodeIgniter framework
- Monitor access logs for suspicious activity
- Keep cPanel and PHP versions updated

---

## 📞 Support

For issues specific to:

- **CodeIgniter 4:**
  [Official Documentation](https://codeigniter.com/user_guide/)
- **Island Art Hawaiʻi Features:** Contact development team
- **cPanel Issues:** Contact your hosting provider

---

## 📝 Version Information

- **Project:** Island Art Hawaiʻi v1.0.5
- **Framework:** CodeIgniter 4
- **Frontend:** Vite + Tailwind CSS v4
- **Deployment Date:** October 7, 2025
- **Domain:** islandartnews.com

---

_This deployment guide ensures secure, optimized hosting of the Island Art
Hawaiʻi website with proper separation of public and private files._
