FROM php:8.1-apache
RUN apt update

RUN docker-php-ext-install mysqli pdo pdo_mysql
WORKDIR /var/www/app

COPY . /var/www/app/
RUN chown -R www-data:www-data storage
RUN chown -R www-data:www-data bootstrap/cache
RUN php artisan key:generate

ENV APACHE_DOCUMENT_ROOT /var/www/app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite