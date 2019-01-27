#!/usr/bin/env bash

set -e

if [ -f ".env" ]; then
   echo ".env file already exists"
   return;
fi

# Prepare .env file

cp .env.production .env

APP_KEY=`head /dev/urandom | tr -dc A-Za-z0-9 | head -c32 | base64`
DB_PASSWORD=`head /dev/urandom | tr -dc A-Za-z0-9 | head -c32`

sed -i "s/APP_KEY=/APP_KEY=base64:$APP_KEY/" .env
sed -i "s/DB_PASSWORD=/DB_PASSWORD=$DB_PASSWORD/" .env

# Prepare file permissions

WEB_UID=`docker-compose run app id -u www-data | sed 's/\r$//'`
DB_UID=`docker-compose run mysql id -u mysql | sed 's/\r$//'`

sudo chown -R $WEB_UID:docker .
sudo chown -R $DB_UID:docker ./docker/mysql
