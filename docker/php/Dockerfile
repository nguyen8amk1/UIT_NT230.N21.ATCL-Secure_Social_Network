# FROM php:8.1-fpm-alpine

# # Install necessary packages
# RUN apk --no-cache add \
#     bash \
#     npm \
#     && docker-php-ext-install pdo_mysql

# # Install composer
# RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
#     && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
#     && php -r "unlink('composer-setup.php');"

# # Set working directory
# WORKDIR /var/www/html

# # Expose port 8000 and start php-fpm server
# EXPOSE 8000

# # CMD ["php-fpm"]
# CMD ["sh", "-c", "echo 'Web has been successfully started.' && php-fpm"]

# # # Copy entrypoint script
# # COPY entrypoint.sh /usr/local/bin

# # # Give execute permission to entrypoint script
# # RUN chmod +x /usr/local/bin/entrypoint.sh

# # # Set entrypoint
# # ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]


FROM php:8-fpm

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# Set ownership for application files
RUN chown -R www:www /var/www/html

# Change current user to www
USER www

# Expose port 8080 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]