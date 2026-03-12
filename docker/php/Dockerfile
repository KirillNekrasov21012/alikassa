# Базовый образ PHP-FPM
FROM php:8.3-fpm

# Настройка PHP
COPY ./conf.d/php.ini /usr/local/etc/php/conf.d/php.ini

# Установим зависимости для PHP и GD
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    libpq-dev \
    libexif-dev \
    unzip curl git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd exif zip pdo_pgsql

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www

# Копируем проект
COPY . .

# Создаём директории
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache /var/www/public/images

# Настройка FPM на TCP 9000
RUN sed -i 's/listen = .*/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf

# CMD с фиксацией прав перед запуском php-fpm
CMD chown -R 1000:1000 /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache && \
    php-fpm
