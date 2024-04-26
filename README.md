# SECURE SOCIAL MEDIA WEBSITE
## INSTALLATION WITH DOCKER
### In the root directory, use the following command (Makefile is executed)
**Copy file .env.example -> .env**

```
cp .env.example .env
```

```
make install
```

Makefile is a text file containing rules to automate the compilation and building process of software.

**Next time you run it, you just need**

```
docker-compose up -d
```

**Account**

```
username: admin@gmail.com
passwd: password
```

| Container   | Port       | Link                               |
|-------------|------------|------------------------------------|
| php-fpm     | 9000(default), 8080 (custom) | http://localhost:8080 |
| nginx       | 80         | http://localhost:80             |
| mysql       | 3307       | null                               |
| phpmyadmin  | 8081       | http://localhost:8081         |

## INSTALLATION WITHOUT DOCKER
### Set the configuration file using the command 

**Copy file .env.example -> .env**

```
cp .env.example .env
```

**Update version laravel (9.52.16)**

```
composer update
```

**Install all required packages via composer**

```
composer install
```

**Run the migration and seeder**

```
php artisan migrate --seed
```

**Install all required packages via nodejs**

```
npm install
```

**Create symbolic link**

```
php artisan storage:link
```

**Generates a security key for your Laravel application**

```
php artisan key:generate 
```

**Creates dummy data using faker library**

```
php artisan db:seed --class="DummyDataSeeder"
```

**Clear Temporary Files**

```
php artisan clean:temp
```

**Start project**

```
php artisan serve
```

**Account**

```
username: admin@gmail.com
passwd: password
```
