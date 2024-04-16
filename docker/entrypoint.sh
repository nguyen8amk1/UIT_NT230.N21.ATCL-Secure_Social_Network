#!/bin/bash

# Copy environment file
# cp .env.example .env

# Install composer dependencies
composer install

# Install npm packages
npm install

# Clear configuration
php artisan config:clear

# Run migration and seeder
php artisan migrate --seed

# Create symbolic link
php artisan storage:link

# Seed dummy data
php artisan db:seed --class="DummyDataSeeder"

# Generate Laravel application key
php artisan key:generate

# Clear temporary files
php artisan clean:temp

# Start the Laravel project
php artisan serve --host=localhost
