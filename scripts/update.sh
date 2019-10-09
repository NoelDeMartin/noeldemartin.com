#!/usr/bin/env bash

set -e
scripts_dir=`cd $(readlink -f $0 | xargs dirname) && pwd`

# Update code

git pull

# Rebuild permissions
$scripts_dir/prepare-permissions.sh

# Rebuild assets and cache

docker-compose build
docker-compose down
docker-compose up -d
docker-compose exec app composer install --no-dev
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan routes:cache
docker run -v `pwd`:/app -w /app node bash -c "npm install && npm run production"
