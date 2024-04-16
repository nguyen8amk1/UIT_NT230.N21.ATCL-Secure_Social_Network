FROM php:8.1-fpm-alpine

FROM composer:lts

# Install necessary packages
RUN apk --no-cache add \
    bash \
    npm \
    && docker-php-ext-install pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Give execute permission to entrypoint script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
