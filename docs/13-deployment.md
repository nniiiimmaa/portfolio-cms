# Portfolio CMS — Deployment Documentation

**Document Version:** 1.0
**Application:** Portfolio CMS
**Backend:** Laravel 13
**Frontend:** Vue 3 + Inertia.js
**Build Tool:** Vite
**Database:** MySQL
**UI Framework:** PrimeVue
**CSS Framework:** Tailwind CSS
**Authentication:** Laravel Breeze
**State Management:** Pinia
**Internationalization:** Vue I18n
**Routing:** Laravel + Ziggy

---

## 1. Purpose

This document describes the process required to deploy the Portfolio CMS application from a development environment to a production environment.

It covers:

* Server requirements
* Application configuration
* Environment variables
* Database configuration
* PHP and Composer dependencies
* Frontend asset compilation
* Database migrations
* Nginx configuration
* HTTPS
* Laravel optimization
* Security
* Backups
* Deployment updates
* Rollback procedures
* Deployment verification
* Troubleshooting

---

# 2. Deployment Architecture

The production environment follows a conventional Laravel deployment architecture:

```text
                         Internet
                            |
                           HTTPS
                            |
                         Nginx
                            |
                     +------+------+
                     |             |
              Static Assets     PHP-FPM
                                   |
                              Laravel 13
                                   |
                              Inertia.js
                                   |
                                Vue 3
                                   |
                                MySQL
```

### 2.1 Production Components

| Component   | Purpose                          |
| ----------- | -------------------------------- |
| Nginx       | Web server                       |
| PHP-FPM     | Executes PHP/Laravel             |
| Laravel 13  | Backend application              |
| Vue 3       | Frontend application             |
| Inertia.js  | Server/client application bridge |
| Vite        | Frontend asset compilation       |
| MySQL       | Application database             |
| Composer    | PHP dependency management        |
| Node.js/npm | Frontend dependency management   |
| Git         | Version control                  |
| HTTPS/TLS   | Secure communication             |

---

# 3. Server Requirements

The production server should provide:

* Linux operating system
* Nginx
* PHP version compatible with Laravel 13
* PHP-FPM
* Required PHP extensions
* Composer
* Node.js
* npm
* MySQL
* Git
* OpenSSL
* TLS certificate management

## 3.1 Required PHP Extensions

The exact extensions should match Laravel 13 and the project's dependencies.

Typical extensions include:

```text
ctype
curl
dom
fileinfo
filter
hash
mbstring
openssl
pcre
pdo
pdo_mysql
session
tokenizer
xml
```

Verify PHP:

```bash
php -v
```

Verify installed extensions:

```bash
php -m
```

---

# 4. Recommended Server Directory

The application should be deployed outside the public web root:

```text
/var/www/
└── portfolio-cms/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── public/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    ├── .env
    └── ...
```

Nginx must point to:

```text
/var/www/portfolio-cms/public
```

The Laravel project root must **never** be directly exposed to the Internet.

---

# 5. Server Preparation

## 5.1 Update the Server

For Ubuntu:

```bash
sudo apt update
sudo apt upgrade -y
```

Install common packages:

```bash
sudo apt install -y git curl unzip zip nginx mysql-server
```

---

## 5.2 Install PHP

Install the PHP version required by Laravel 13.

Example:

```bash
sudo apt install -y \
    php-fpm \
    php-mysql \
    php-mbstring \
    php-xml \
    php-curl \
    php-zip \
    php-bcmath \
    php-intl
```

Verify:

```bash
php -v
```

Check PHP-FPM:

```bash
sudo systemctl status php8.x-fpm
```

Replace `8.x` with the installed PHP version.

---

## 5.3 Install Composer

Install Composer using the official Composer installation procedure.

Verify:

```bash
composer --version
```

---

## 5.4 Install Node.js and npm

Install a Node.js version compatible with the project.

Verify:

```bash
node -v
npm -v
```

The Node.js version should preferably be documented or pinned for reproducible deployments.

---

# 6. Configure MySQL

Log into MySQL:

```bash
sudo mysql
```

Create the production database:

```sql
CREATE DATABASE portfolio_cms
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Create a dedicated application user:

```sql
CREATE USER 'portfolio_cms_user'@'localhost'
IDENTIFIED BY 'CHANGE_THIS_TO_A_STRONG_PASSWORD';
```

Grant access:

```sql
GRANT ALL PRIVILEGES ON portfolio_cms.*
TO 'portfolio_cms_user'@'localhost';
```

Apply privileges:

```sql
FLUSH PRIVILEGES;
```

Exit:

```sql
EXIT;
```

### Database Security

Do not use the MySQL `root` account from Laravel.

The application should use a dedicated database account with a strong password.

---

# 7. Deploy the Application

Create the application directory:

```bash
sudo mkdir -p /var/www/portfolio-cms
```

Set ownership for the deployment user:

```bash
sudo chown -R $USER:$USER /var/www/portfolio-cms
```

Clone the repository:

```bash
cd /var/www
git clone <REPOSITORY_URL> portfolio-cms
```

Enter the application:

```bash
cd /var/www/portfolio-cms
```

Checkout the production branch:

```bash
git checkout main
```

For release-based deployments, preferably checkout a version tag:

```bash
git checkout <VERSION_TAG>
```

---

# 8. Configure Environment Variables

Create the production environment file:

```bash
cp .env.example .env
```

Edit it:

```bash
nano .env
```

Example:

```dotenv
APP_NAME="Portfolio CMS"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://example.com

LOG_CHANNEL=stack
LOG_LEVEL=warning

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_cms
DB_USERNAME=portfolio_cms_user
DB_PASSWORD=CHANGE_THIS_TO_A_STRONG_PASSWORD
```

Configure any additional application-specific variables, including:

* Mail configuration
* Application settings
* Third-party service credentials
* Other production secrets

## 8.1 Production Requirements

Production must use:

```dotenv
APP_ENV=production
APP_DEBUG=false
```

Never use:

```dotenv
APP_DEBUG=true
```

in production.

The `.env` file must never be committed to Git.

---

# 9. Generate the Application Key

If the application key has not already been generated:

```bash
php artisan key:generate --force
```

Verify:

```dotenv
APP_KEY=base64:...
```

The production `APP_KEY` must be treated as a secret.

Do not regenerate the production application key during normal deployments.

---

# 10. Install Backend Dependencies

Install production PHP dependencies:

```bash
composer install --no-dev --optimize-autoloader
```

Do not run `composer update` during a normal production deployment.

Dependencies should normally be updated during development and committed through `composer.lock`.

---

# 11. Install Frontend Dependencies

Install dependencies using the lock file:

```bash
npm ci
```

If no lock file exists:

```bash
npm install
```

For reproducible production deployments, `package-lock.json` should be committed and `npm ci` should be preferred.

---

# 12. Build Frontend Assets

The Portfolio CMS uses Vite.

Build the production assets:

```bash
npm run build
```

The build should complete without errors.

Do not run the development server in production:

```bash
npm run dev
```

---

# 13. Run Database Migrations

Before running migrations, verify:

* Database exists
* Database credentials are correct
* Production `.env` is configured
* Database backup exists when updating an existing installation

Run migrations:

```bash
php artisan migrate --force
```

Verify migration status:

```bash
php artisan migrate:status
```

All expected migrations should show:

```text
Ran
```

---

# 14. Database Seeding

For a new installation, production seeders may be executed only if they are specifically designed for production:

```bash
php artisan db:seed --force
```

Development/test seeders should never be executed against production unless explicitly intended.

---

# 15. Laravel Storage

The current Portfolio CMS does not rely on Laravel's storage system for its normal application operation.

Therefore:

```bash
php artisan storage:link
```

is not required unless a future feature begins using Laravel's public storage disk.

If storage functionality is introduced later, this deployment document must be updated.

---

# 16. File Permissions

Laravel requires write access to:

```text
storage/
bootstrap/cache/
```

Set ownership:

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
```

Set permissions:

```bash
sudo chmod -R 775 storage bootstrap/cache
```

Do **not** use:

```bash
chmod -R 777
```

---

# 17. Configure Nginx

Create an Nginx configuration:

```bash
sudo nano /etc/nginx/sites-available/portfolio-cms
```

Example:

```nginx
server {
    listen 80;
    listen [::]:80;

    server_name example.com www.example.com;

    root /var/www/portfolio-cms/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.x-fpm.sock;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Replace:

```text
example.com
```

with the production domain.

Replace:

```text
php8.x-fpm.sock
```

with the PHP-FPM socket available on the server.

Test the configuration:

```bash
sudo nginx -t
```

Enable the site:

```bash
sudo ln -s /etc/nginx/sites-available/portfolio-cms \
    /etc/nginx/sites-enabled/portfolio-cms
```

Disable the default site if necessary:

```bash
sudo rm -f /etc/nginx/sites-enabled/default
```

Reload Nginx:

```bash
sudo systemctl reload nginx
```

---

# 18. Configure HTTPS

Production traffic should always use HTTPS.

A common solution is Let's Encrypt with Certbot.

Example:

```bash
sudo certbot --nginx -d example.com -d www.example.com
```

After configuration, verify:

```text
https://example.com
```

The application should redirect HTTP requests to HTTPS.

Test certificate renewal:

```bash
sudo certbot renew --dry-run
```

The following should also be verified:

* Valid TLS certificate
* HTTP → HTTPS redirect
* `APP_URL` uses HTTPS
* Secure cookies
* No mixed-content errors
* Automatic certificate renewal

---

# 19. Laravel Production Optimization

Clear existing caches:

```bash
php artisan optimize:clear
```

Build production caches:

```bash
php artisan optimize
```

This optimizes the Laravel application for production.

Whenever configuration changes:

```bash
php artisan optimize:clear
php artisan optimize
```

---

# 20. Queue Workers

If the Portfolio CMS uses Laravel queues, configure a persistent worker.

Example:

```bash
php artisan queue:work --sleep=3 --tries=3 --timeout=90
```

A production queue worker should be managed by Supervisor or systemd so it:

* Starts automatically
* Restarts after failure
* Starts after server reboot
* Does not depend on an SSH session

If queues are not used, this configuration is unnecessary.

---

# 21. Laravel Scheduler

If scheduled tasks are introduced, configure Laravel's scheduler.

Typical cron configuration:

```cron
* * * * * cd /var/www/portfolio-cms && php artisan schedule:run >> /dev/null 2>&1
```

If the application does not define scheduled commands, the scheduler is not required.

---

# 22. Mail Configuration

If the application sends email notifications, configure the production mail service.

Example:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your-production-mail-user
MAIL_PASSWORD=your-production-mail-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

After modifying mail configuration:

```bash
php artisan optimize:clear
php artisan optimize
```

Test email delivery before completing the deployment.

---

# 23. Security Configuration

## 23.1 Disable Debugging

Ensure:

```dotenv
APP_DEBUG=false
```

Never expose Laravel's detailed exception pages publicly.

---

## 23.2 Protect `.env`

The `.env` file must:

* Never be committed
* Never be publicly accessible
* Contain strong credentials
* Exist only on trusted systems

---

## 23.3 Database Security

The MySQL database should:

* Use a dedicated application user
* Use a strong password
* Restrict remote access
* Not expose port `3306` publicly unless required
* Have regular backups

---

## 23.4 Firewall

Typical public ports:

| Port | Protocol | Purpose |
| ---: | -------- | ------- |
|   22 | TCP      | SSH     |
|   80 | TCP      | HTTP    |
|  443 | TCP      | HTTPS   |

MySQL port `3306` should normally remain private.

---

## 23.5 SSH

Recommended SSH configuration:

* SSH key authentication
* Disable password authentication where practical
* Disable direct root login
* Use a non-root administrative user
* Restrict SSH through the firewall where possible

---

# 24. Production Verification

After deployment, verify the public website:

* Homepage loads
* Navigation works
* Public sections render correctly
* Images and assets load
* Language switching works
* RTL languages work correctly
* Dark/light mode works
* Contact form works
* Footer renders correctly

---

# 25. Admin Portal Verification

Verify:

* Admin login
* Authentication
* Authorization
* Dashboard
* KPI statistics
* Messages-per-month chart
* Visitors-per-month chart
* CRUD operations
* PrimeVue dialogs
* Toast notifications
* Confirmation dialogs
* Form validation
* Message management
* Content management

Unauthorized users must not be able to access administrative functionality.

---

# 26. Visitor Tracking Verification

Because the Portfolio CMS uses its own visitor tracking system, verify:

* Visitor records are created correctly
* Duplicate/invalid tracking behavior is handled correctly
* Dashboard visitor statistics are accurate
* Monthly visitor aggregation works
* Tracking does not interfere with page performance
* Tracking does not expose sensitive visitor information

---

# 27. Frontend Verification

Verify:

* Vite production assets exist
* JavaScript loads correctly
* CSS loads correctly
* Browser console has no critical errors
* Network requests return expected responses
* No development URLs remain
* No development credentials are exposed

---

# 28. Logging

Laravel logs are normally stored under:

```text
storage/logs/
```

Monitor logs with:

```bash
tail -f storage/logs/laravel.log
```

Nginx logs are commonly located under:

```text
/var/log/nginx/
```

PHP-FPM logs depend on the installed PHP version and server configuration.

Logs should be rotated and retained according to the operational requirements of the server.

---

# 29. Backup Strategy

Production data should be backed up regularly.

At minimum, backup:

* MySQL database
* Application-specific persistent files if introduced
* Critical production configuration through a secure mechanism

Do not place backups inside the public web directory.

## 29.1 Database Backup

Example:

```bash
mysqldump \
    -u portfolio_cms_user \
    -p \
    portfolio_cms > portfolio_cms_$(date +%Y-%m-%d_%H-%M-%S).sql
```

Backups should ideally be:

* Automated
* Stored separately from the application server
* Encrypted where appropriate
* Retained according to a defined policy
* Periodically restored for verification

A backup that has never been successfully restored should not be considered fully verified.

---

# 30. Updating the Production Application

A standard deployment update should follow this sequence.

## 30.1 Enable Maintenance Mode

```bash
cd /var/www/portfolio-cms

php artisan down
```

---

## 30.2 Backup the Database

```bash
mysqldump \
    -u portfolio_cms_user \
    -p \
    portfolio_cms > portfolio_cms_backup.sql
```

---

## 30.3 Update Source Code

```bash
git fetch --all
git checkout main
git pull --ff-only
```

For release-based deployment:

```bash
git checkout <VERSION_TAG>
```

---

## 30.4 Update PHP Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

---

## 30.5 Update Frontend Dependencies

```bash
npm ci
```

Build:

```bash
npm run build
```

---

## 30.6 Run Migrations

```bash
php artisan migrate --force
```

---

## 30.7 Optimize Laravel

```bash
php artisan optimize:clear
php artisan optimize
```

---

## 30.8 Restart Queue Workers

If queues are enabled:

```bash
php artisan queue:restart
```

---

## 30.9 Reload Services

```bash
sudo systemctl reload nginx
```

Restart PHP-FPM if required:

```bash
sudo systemctl restart php8.x-fpm
```

---

## 30.10 Disable Maintenance Mode

```bash
php artisan up
```

---

## 30.11 Verify

Immediately verify:

* Public website
* Admin portal
* Authentication
* Database operations
* Contact functionality
* Visitor tracking
* Dashboard statistics
* Email functionality
* Frontend assets
* Application logs

---

# 31. Deployment Script

A basic deployment script can standardize deployments:

```bash
#!/usr/bin/env bash

set -e

cd /var/www/portfolio-cms

php artisan down

git fetch --all
git checkout main
git pull --ff-only

composer install --no-dev --optimize-autoloader

npm ci
npm run build

php artisan migrate --force

php artisan optimize:clear
php artisan optimize

php artisan queue:restart

php artisan up

echo "Deployment completed successfully."
```

This script must be adapted to the actual production environment before use.

For example, remove the queue restart if queues are not used.

---

# 32. Rollback Procedure

If a deployment causes a critical failure:

1. Enable maintenance mode.
2. Restore the previous application version.
3. Restore the database if necessary.
4. Reinstall the previous dependencies.
5. Rebuild frontend assets.
6. Clear Laravel caches.
7. Restart workers.
8. Verify the application.
9. Disable maintenance mode.

Example:

```bash
php artisan down

git checkout <PREVIOUS_VERSION>

composer install --no-dev --optimize-autoloader

npm ci
npm run build

php artisan optimize:clear
php artisan optimize

php artisan queue:restart

php artisan up
```

## 32.1 Database Rollback Warning

Do not automatically execute:

```bash
php artisan migrate:rollback
```

as a generic production rollback mechanism.

Database rollbacks may cause data loss.

Production migrations should preferably be designed to be backward compatible.

---

# 33. Zero-Downtime Deployment

For a small portfolio CMS, a short maintenance window is generally acceptable.

If zero-downtime deployment becomes necessary, use a release-based structure:

```text
/var/www/portfolio-cms/
├── current -> releases/2026-08-09-001
├── releases/
│   ├── 2026-08-08-001/
│   └── 2026-08-09-001/
└── shared/
    └── .env
```

Each release can be prepared independently before switching the `current` symlink.

This provides:

* Faster deployments
* Easier rollback
* Reduced downtime
* Better release isolation

---

# 34. CI/CD

As the project grows, deployment should be automated through CI/CD.

Recommended pipeline:

```text
Git Push / Pull Request
          |
          v
Install Dependencies
          |
          v
Run Tests
          |
          v
Static Analysis
          |
          v
Build Frontend
          |
          v
Create Release
          |
          v
Deploy Production
          |
          v
Run Migrations
          |
          v
Optimize Application
          |
          v
Health Check
          |
          v
Deployment Complete
```

The pipeline should fail if:

* Dependencies cannot be installed
* Tests fail
* Frontend compilation fails
* Static analysis fails
* Deployment fails
* Health checks fail

---

# 35. Health Checks

A production deployment should verify:

```text
HTTP 200 response
Laravel application boot
Database connection
Frontend asset availability
Authentication
```

A dedicated health endpoint can be introduced later to automate post-deployment verification.

---

# 36. Monitoring

Monitor the following:

* HTTP errors
* Laravel exceptions
* PHP errors
* Database errors
* CPU usage
* Memory usage
* Disk usage
* Nginx failures
* PHP-FPM failures
* Queue failures
* SSL certificate expiration
* Application availability

The Portfolio CMS visitor tracking system is application functionality and should not be considered a replacement for infrastructure monitoring.

---

# 37. Common Problems

## 37.1 HTTP 500

Check:

```bash
tail -f storage/logs/laravel.log
```

Verify:

* `.env`
* `APP_KEY`
* Database credentials
* PHP version
* PHP extensions
* File permissions
* PHP-FPM
* Nginx configuration

---

## 37.2 Database Connection Error

Verify:

```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_cms
DB_USERNAME=portfolio_cms_user
DB_PASSWORD=...
```

Test the database connection:

```bash
mysql -u portfolio_cms_user -p portfolio_cms
```

---

## 37.3 CSS or JavaScript Not Loading

Run:

```bash
npm run build
```

Then verify:

```text
public/build/
```

Also check:

* Browser Network tab
* Browser Console
* `APP_URL`
* Nginx configuration
* Vite configuration

---

## 37.4 Permission Denied

Check:

```bash
ls -la storage
ls -la bootstrap/cache
```

Correct permissions:

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

---

## 37.5 Laravel Routes Return 404

Verify the Nginx configuration:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

Also verify:

```nginx
root /var/www/portfolio-cms/public;
```

---

## 37.6 Changes Are Not Visible

Clear Laravel caches:

```bash
php artisan optimize:clear
php artisan optimize
```

Rebuild frontend assets:

```bash
npm run build
```

Then refresh the browser.

---

# 38. Deployment Checklist

## Server

* [ ] Linux server configured
* [ ] Nginx installed
* [ ] PHP installed
* [ ] PHP-FPM running
* [ ] Composer installed
* [ ] Node.js installed
* [ ] npm installed
* [ ] MySQL installed
* [ ] Firewall configured

## Application

* [ ] Repository deployed
* [ ] Correct production branch/release selected
* [ ] `.env` configured
* [ ] `APP_ENV=production`
* [ ] `APP_DEBUG=false`
* [ ] `APP_KEY` configured
* [ ] `APP_URL` configured
* [ ] Database credentials configured
* [ ] Mail credentials configured if required

## Dependencies

* [ ] Composer dependencies installed
* [ ] npm dependencies installed
* [ ] Vite production build completed

## Database

* [ ] Production database created
* [ ] Dedicated database user created
* [ ] Migrations executed
* [ ] Production data verified
* [ ] Backup configured

## Web Server

* [ ] Nginx root points to `/public`
* [ ] Nginx configuration tested
* [ ] Nginx reloaded
* [ ] HTTPS configured
* [ ] HTTP redirects to HTTPS

## Laravel

* [ ] `storage` permissions configured
* [ ] `bootstrap/cache` permissions configured
* [ ] Laravel optimized
* [ ] Queue worker configured if required
* [ ] Scheduler configured if required

## Application Testing

* [ ] Homepage tested
* [ ] Navigation tested
* [ ] Admin login tested
* [ ] Dashboard tested
* [ ] CRUD operations tested
* [ ] Contact form tested
* [ ] Email tested
* [ ] Visitor tracking tested
* [ ] Dashboard statistics tested
* [ ] Language switching tested
* [ ] RTL layout tested
* [ ] Dark/light mode tested
* [ ] Mobile layout tested
* [ ] Browser console checked
* [ ] Laravel logs checked

---

# 39. Deployment Command Summary

For a standard production update:

```bash
cd /var/www/portfolio-cms

php artisan down

git fetch --all
git checkout main
git pull --ff-only

composer install --no-dev --optimize-autoloader

npm ci
npm run build

php artisan migrate --force

php artisan optimize:clear
php artisan optimize

php artisan queue:restart

php artisan up
```

The exact commands should be adapted according to the production environment and whether the application uses queues, scheduled tasks, or CI/CD.

---

# 40. Production Principles

The Portfolio CMS deployment should follow these principles:

1. Never expose the Laravel project root.
2. Always point Nginx to the `public` directory.
3. Never enable `APP_DEBUG` in production.
4. Never commit `.env`.
5. Use a dedicated database user.
6. Use HTTPS.
7. Keep dependency lock files under version control.
8. Use `composer install`, not `composer update`, during deployment.
9. Use `npm ci` for reproducible frontend installations.
10. Run production migrations with `--force`.
11. Back up the database before risky deployments.
12. Keep production deployments reversible.
13. Never use `777` permissions.
14. Do not run Vite's development server in production.
15. Monitor application and infrastructure errors.
16. Test database restoration periodically.
17. Keep production secrets outside source control.
18. Prefer versioned releases as the project grows.

---

# 41. Related Documentation

Deployment should be considered one part of the complete Portfolio CMS technical documentation.

Related documents include:

* Software Requirements Specification (SRS)
* System Architecture Design
* High-Level Design (HLD)
* Low-Level Design (LLD)
* Database Design
* Entity Relationship Diagram (ERD)
* Database Schema Documentation
* API Documentation
* UI/UX Flow Documentation
* Performance Documentation
* Security Documentation
* Testing Documentation
* Maintenance Documentation
* Deployment Documentation

Together, these documents describe the Portfolio CMS throughout its complete software development lifecycle.
