# LINE Fusion API

This repository contains the backend services for the LINE-integrated commerce platform described in the system architecture document. The project is bootstrapped with Laravel 11 and structured for modular feature development across authentication, product, order, payment, notification, and admin domains.

## Requirements

- PHP 8.2+
- Composer
- MySQL 8+
- Node.js 20+

## Getting Started

1. Copy the environment file:
   ```bash
   cp .env.example .env
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Generate an application key:
   ```bash
   php artisan key:generate
   ```
4. Configure your database connection in `.env` and run migrations:
   ```bash
   php artisan migrate
   ```
5. Install frontend tooling dependencies and compile assets:
   ```bash
   npm install
   npm run dev
   ```

## Testing

Run the automated test suite with:
```bash
php artisan test
```
