FROM php:8.1-fpm-alpine

# Install necessary packages
RUN apk --no-cache add \
    bash \
    npm \
    && docker-php-ext-install pdo_mysql

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Set working directory
WORKDIR /var/www/html

# Expose port 8000 and start php-fpm server
EXPOSE 8000
CMD ["php-fpm"]

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin

# Give execute permission to entrypoint script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]