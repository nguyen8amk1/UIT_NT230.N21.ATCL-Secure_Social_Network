# SECURE SOCIAL MEDIA WEBSITE
## INSTALLATION WITH DOCKER
### In the root directory, use the following command (Makefile is executed)

```
make install
```

Makefile is a text file containing rules to automate the compilation and building process of software.

Then go to the .env file and edit `DB_HOST=127.0.0.1` -> `DB_HOST=mysql` because when running outside of workspace container, the MySQL container is accessible on 127.0.0.1, but when you're in the workspace container, 127.001 is relative to the container itself, so container will try to connect to its own localhost.

![code](https://github.com/nguyen8amk1/UIT_NT230.N21.ATCL-Secure_Social_Network/assets/112185647/24c6c42d-8267-4097-8db8-ef28d53e5555)

Then type the command

**Run migration and seeder, continue to next command even if error occurs**

```
docker-compose exec php php artisan migrate --seed || true
```

**Seed dummy data**

```
docker-compose exec php php artisan db:seed --class="DummyDataSeeder"
```

**Next time you run it, you just need**

```
docker compose up -d
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
