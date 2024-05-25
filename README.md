# SECURE SOCIAL MEDIA WEBSITE
## INSTALLATION WITH DOCKER
### In the root directory, use the following command (Makefile is executed)
**Copy file .env.example -> .env**

```
cp .env.example .env
```

Makefile is a text file containing rules to automate the compilation and building process of software, use `root user` to run `Makefile`.

```
make install
```

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
You must run `myssql` in `xampp`

![image](https://github.com/nguyen8amk1/UIT_NT230.N21.ATCL-Secure_Social_Network/assets/112185647/b0f8f860-98ac-4921-9739-6cdbd4d043d1)

### Set the configuration file using the command 

**Copy file .env.example -> .env**

```
cp .env.example.nodocker .env
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

```
npm run dev
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
