#!/bin/bash
echo "Starting build process..."
php composer.phar install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache