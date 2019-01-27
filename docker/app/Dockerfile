FROM php:7.3-fpm-alpine

RUN set -x \
    && apk update \
    && apk add zlib-dev libzip-dev \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apk add mariadb-client

WORKDIR /app
