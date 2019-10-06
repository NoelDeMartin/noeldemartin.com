#!/usr/bin/env bash

set -e

# Update code

git pull

# Rebuild permissions

WEB_UID=`docker-compose run app id -u www-data | sed 's/\r$//'`
DB_UID=`docker-compose run mysql id -u mysql | sed 's/\r$//'`

sudo chown -R $WEB_UID:docker .
sudo chown -R $DB_UID:docker ./docker/mysql

# Rebuild assets and cache

docker-compose build
docker-compose down
docker-compose up -d
docker-compose exec app composer install --no-dev
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan routes:cache
docker run -v `pwd`:/app -w /app node bash -c "npm install && npm run production"
