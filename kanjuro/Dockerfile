FROM php:8.5-fpm-alpine

WORKDIR /app

# Install PHP dependencies
RUN set -x \
    && apk update \
    && apk add vim zlib-dev libzip-dev libpng-dev libjpeg-turbo-dev freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip bcmath gd \
    && docker-php-ext-enable bcmath gd \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Install Supervisor
RUN apk add --no-cache supervisor

# Copy files
COPY kanjuro/supervisord.conf /etc/supervisord.conf
RUN rm kanjuro -rf
COPY --chown="www-data:root" . /app

# Install Composer dependencies
RUN composer install --no-dev

# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
