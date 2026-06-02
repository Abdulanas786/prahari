#!/bin/sh

# Generate app key if not set
php artisan key:generate --force --no-interaction

# Clear and cache config for production
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link --force

# Run migrations
php artisan migrate --force

# Seed only if tables are empty (avoid duplicates)
php artisan db:seed --force --no-interaction 2>/dev/null || true

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache
apache2-foreground