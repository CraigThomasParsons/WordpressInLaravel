# WordPress in Laravel - Elasticgun.com

This is a Laravel application that integrates WordPress for content management, designed for a photographer portfolio/blog website.

## Requirements

- **PHP:** 8.1 or higher
- **Laravel:** 10.x LTS
- **Composer:** 2.x
- **Node.js:** 18.x or higher (for asset compilation)
- **WordPress:** Install in the `public/wordpress` directory

## Laravel Upgrade

This application has been upgraded from Laravel 5.2 to Laravel 10.x LTS (December 2025), providing:
- Modern PHP 8.1+ support
- Long-term support (LTS) until 2025
- Improved security and performance
- Modern tooling (Vite for asset compilation)

## Setup Instructions

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your database credentials and other configuration.

### 3. Install WordPress

Install WordPress in the `public/wordpress` directory. The folder name **must** be `wordpress` as the application expects to load WordPress from:

```php
require __DIR__ . '/wordpress/wp-blog-header.php';
```

### 4. Database Setup

Configure your database connection in `.env` and run migrations:

```bash
php artisan migrate
```

### 5. Compile Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 6. Run the Application

```bash
php artisan serve
```

Visit `http://localhost:8000` to see your application.

## Architecture

- **Frontend:** Laravel with Materialize CSS
- **Backend/Content:** WordPress (for blog posts, pages, galleries)
- **Asset Compilation:** Vite (modern replacement for Laravel Elixir/Gulp)

## WordPress Integration

The application queries WordPress database tables directly using Laravel's DB facade. WordPress provides:
- Blog posts and pages
- Media galleries
- Content management

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run `composer install --no-dev --optimize-autoloader`
3. Run `npm run build` to compile production assets
4. Configure your web server to point to the `public` directory
5. Set appropriate file permissions for `storage` and `bootstrap/cache`

## License

MIT License
