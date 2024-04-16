#!/bin/bash

# Copy environment file
cp .env.example .env

# Install composer dependencies
composer install

# Install npm packages
npm install

# Generate Laravel application key
php artisan key:generate

# Run migration and seeder
php artisan migrate --seed

# Create symbolic link
php artisan storage:link

# Seed dummy data
php artisan db:seed --class="DummyDataSeeder"

# Start the Laravel project
php artisan serve --host=localhost

# Clear temporary files
php artisan clean:temp

