#!/bin/bash

# Copy environment file
cp .env.example .env || true

# Update composer
composer update || true

# Install composer dependencies
composer install || true

# Install npm packages
npm install || true

# Generate Laravel application key
php artisan key:generate || true

# Run migration and seeder, continue to next command even if error occurs
php artisan migrate --seed || true

# Create symbolic link
php artisan storage:link || true

# Seed dummy data
php artisan db:seed --class="DummyDataSeeder" || true

# Start the Laravel project
# php artisan serve --host=localhost
# php artisan serve

# Clear temporary files
php artisan clean:temp || true
