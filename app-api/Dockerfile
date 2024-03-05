# Dockerfile for Laravel backend

FROM php:8.2-fpm-alpine

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка PostgreSQL и необходимых расширений PHP
RUN apk --no-cache add postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Set working directory
WORKDIR /var/www/html

# Install Composer dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Generate autoload files
RUN composer dump-autoload --optimize

# Выполнение миграций базы данных
# RUN php artisan migrate

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
