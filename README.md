# Short URL Service Project

## Overview

This project is a simple URL shortening service with QR code generation built using Yii2, MySQL/MariaDB, jQuery, and Bootstrap. It allows users to shorten long URLs, generate QR codes, and track visits.

## Features

- Validate and check availability of submitted URLs
- Generate short URL codes
- Generate QR codes for the short URLs
- AJAX-based interaction without page reloads
- Redirect from short URLs to original URLs
- Track visits count and last visitor IP address

## Requirements

- PHP 7.4 or higher
- MySQL or MariaDB
- WampServer, XAMPP, or any local server environment
- Composer

## Setup Instructions

### 1. Database Setup

- Create a new database (e.g., `url_qrcode`) via phpMyAdmin or CLI.
- Import the SQL script located at `/database/scripts.sql` to create the necessary tables.
- Update the database connection in `config/db.php`:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=url_qrcode',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

---

## Full Setup Instructions

### 1. Clone project

```php
git clone <repo-url>
cd <project-folder>
```

### 2. Install Dependencies

Run the following command in the project root to install Yii2 and required packages:

```bash
composer install
```

### 3. Create database

```bash
mysql -u root -p -e "CREATE DATABASE painter CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"

# Import structure
mysql -u root -p painter < database/structure.sql

# Import sample data (optional)
mysql -u root -p painter < database/sample_data.sql
```

### 3. Configure Static IP Address


Update the file `config/params.php` with your machine’s local IP address so that the mobile devices on the same network can access your project:

```php
return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'baseUrl' => 'http://192.168.0.68/url_qrcode/web',
    'baseIp' => '192.168.0.68',
];
```

### 4. Run the Project

If using **WampServer/XAMPP**, place the project inside the `www` (Wamp) or `htdocs` (XAMPP) folder.
Start Apache and MySQL services, then open your browser and navigate to:

http://localhost/url_qrcode/web

Or, to access it from another device on the same local network (e.g., your phone), use the static IP address you set in `config/params.php`:

http://192.168.0.68/url_qrcode/web

Make sure your firewall allows connections on port 80.

---