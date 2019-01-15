FROM php:7.3-fpm-alpine

ENV NODE_ENV=production

RUN set -x \
    && apk --update add --virtual build-dependencies build-base \
    && apk --update add --virtual node nodejs nodejs-npm \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /app
