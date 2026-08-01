FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
        gd \
        intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY backend/ .

RUN composer install --no-interaction --prefer-dist

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]