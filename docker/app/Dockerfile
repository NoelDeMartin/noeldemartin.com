FROM php:7.3-fpm-alpine

# Install PHP Dependencies
RUN set -x \
    && apk update \
    && apk add zlib-dev libzip-dev \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apk add mariadb-client \
    && apk add git

# Prepare Supervisor
RUN apk add --no-cache supervisor
COPY supervisord.conf /etc/supervisord.conf

# Configure Laravel Scheduler
RUN echo "* * * * * php /app/artisan schedule:run >> /dev/null 2>&1" | crontab -u www-data -

WORKDIR /app

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
