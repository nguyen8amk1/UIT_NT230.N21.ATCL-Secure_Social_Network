install:
	@make build
	@make up
	# Copy environment file
	docker-compose exec php cp variables.env .env || true

	# Update composer
	docker-compose exec php composer update

	# docker-compose exec php composer require doctrine/dbal

	# Install composer dependencies
	docker-compose exec php composer install

	# Install npm packages
	docker-compose exec php npm install

	# Clear config cache
	docker-compose exec php php artisan config:clear
	docker-compose exec php php artisan cache:clear

	# Generate Laravel application key
	docker-compose exec php php artisan key:generate

	# Run migration and seeder, continue to next command even if error occurs
	docker-compose exec php php artisan migrate --seed || true

	# Create symbolic link
	docker-compose exec php php artisan storage:link || true

	# Seed dummy data
	docker-compose exec php php artisan db:seed --class="DummyDataSeeder"

	# Clear temporary files
	docker-compose exec php php artisan clean:temp

build:
	docker-compose build

up:
	docker-compose up -d

	