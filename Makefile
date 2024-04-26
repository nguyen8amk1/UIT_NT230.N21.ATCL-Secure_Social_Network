install:
	@make build
	@make up
	# Copy environment file
	docker-compose exec php cp variables.env .env || true

	# Update DB_HOST in .env
	docker-compose exec php sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mysql/g' .env || true

	# Update composer
	docker-compose exec php composer update

	# (DO NOT UNCOMMENT) docker-compose exec php composer require doctrine/dbal

	# Install composer dependencies
	docker-compose exec php composer install

	# Install npm packages
	docker-compose exec php npm install

	# Add root permition
	docker-compose exec php chown -R root:root /var/www/html/
	docker-compose exec php chmod -R u+rwx,g+rwx,o+rwx /var/www/html/

	# Install mix manifest (The Mix manifest does not exist)
	docker-compose exec php npm run dev

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


