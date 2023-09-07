FROM composer:2 as builder

FROM php:8.2-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-install intl \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && apt-get clean -y

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

COPY --from=builder /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/project

USER 1000:1000
EXPOSE 9000
