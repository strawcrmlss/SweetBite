# Base image menggunakan PHP 8.4 dengan PHP-FPM
FROM php:8.4-fpm

# Install package dan ekstensi PHP yang dibutuhkan Laravel
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

# Install Composer dari image resmi Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Menentukan direktori kerja di dalam container
WORKDIR /var/www

# Menyalin source code Laravel ke dalam container
COPY backend/ .

# Menginstal seluruh dependency Laravel
RUN composer install --no-interaction --prefer-dist

# Memberikan hak akses pada folder yang digunakan Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Membuka port PHP-FPM
EXPOSE 9000

# Menjalankan PHP-FPM saat container dijalankan
CMD ["php-fpm"]