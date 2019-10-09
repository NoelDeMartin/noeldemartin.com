#!/usr/bin/env bash

set -e
scripts_dir=`cd $(readlink -f $0 | xargs dirname) && pwd`

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
$scripts_dir/prepare-permissions.sh

