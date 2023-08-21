FROM composer:2.2.1 AS composer

FROM php:8.2.0-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev git libzip-dev zip libpq-dev  libxml2-dev libfreetype6-dev  libjpeg62-turbo-dev libmcrypt-dev  libpng-dev libicu-dev libwebp-dev libwebp6
RUN docker-php-ext-configure zip && docker-php-ext-install pgsql  pdo_pgsql zip soap intl bcmath pcntl exif

RUN docker-php-ext-configure gd --with-jpeg --with-webp
RUN docker-php-ext-install -j$(nproc) gd

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN echo "SUPERVISOR"
RUN apt-get install supervisor -y
COPY queue_workers/* /etc/supervisor/conf.d/
