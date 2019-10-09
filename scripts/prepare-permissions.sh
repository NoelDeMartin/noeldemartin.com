#!/usr/bin/env bash

WEB_UID=`docker-compose run app id -u www-data | sed 's/\r$//'`
DB_UID=`docker-compose run mysql id -u mysql | sed 's/\r$//'`

sudo chown -R $WEB_UID:docker .
sudo chown -R $DB_UID:docker ./docker/mysql
