FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
        libonig-dev \
        libzip-dev \
        zip \
        unzip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader
