#!/bin/sh

# Ensure storage directories exist
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Generate app key if not set
php artisan key:generate --force --no-interaction 2>/dev/null

# Clear old caches
php artisan config:clear
php artisan route:clear
php artisan view:clear 2>/dev/null

# Cache config, routes, and views for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link --force 2>/dev/null

# Run fresh migrations (drops and recreates all tables)
php artisan migrate:fresh --seed --force

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache
apache2-foreground