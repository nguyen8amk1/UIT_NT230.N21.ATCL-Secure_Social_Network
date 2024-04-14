# SECURE SOCIAL MEDIA WEBSITE
## INSTALLATION
Set the configuration file using the command 

```
cp .env.example .env
```

Update version laravel (9.52.16)

```
composer update
```

Install all required packages via composer

```
composer install
```

Run the migration and seeder

```
php artisan migrate --seed
```

```
php artisan setup
```

Install all dependencies

```
npm install
```

Create symbolic link

```
php artisan storage:link
```

## HOW TO USE
Creates dummy data using faker library.

```
php artisan db:seed --class="DummyDataSeeder"
```

```
php artisan setup:dummy
```

Generates a security key for your Laravel application

```
php artisan key:generate 
```

Clear Temporary Files

```
php artisan clean:temp
```

**Start project**

```
php artisan serve
```