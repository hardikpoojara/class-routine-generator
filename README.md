<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Class Routine Generator

Class Routine Generator is a Laravel application that generates weekly class routines for students based on predefined constraints.

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/hardikpoojara/class-routine-generator.git
cd class-routine-generator
```
### 2. Copy Environment Variables
```bash
cp .env.example .env
```
### 3. Set Up Database

#### Create a new MySQL database.
#### Update the .env file with your database credentials:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

```
### 4. Install Dependencies
```bash
composer install
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Run Seeders (Optional)
```bash
php artisan db:seed
```

### 8. Start the Laravel development server:
```bash
php artisan serve
```

