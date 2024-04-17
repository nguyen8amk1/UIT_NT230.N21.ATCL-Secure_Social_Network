#!/bin/bash

# Copy environment file
cp .env.example .env

# Update composer
composer update

# Install composer dependencies
composer install

# Install npm packages
npm install

# Generate Laravel application key
php artisan key:generate

# Run migration and seeder, continue to next command even if error occurs
php artisan migrate --seed

# Create symbolic link
php artisan storage:link

# Seed dummy data
php artisan db:seed --class="DummyDataSeeder"

# Clear temporary files
php artisan clean:temp
