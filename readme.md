# Noel De Martin

## Production

### First time

Before getting started, make sure to have docker and docker-compose installed. All ssh keys should also be configured (read instructions for bitbucket [here](https://confluence.atlassian.com/bitbucket/set-up-an-ssh-key-728138079.html)).

Once the system has all the dependencies installed, execute the following commands:

```sh
cd /var/www
sudo mkdir noeldemartin
sudo chmod 775 noeldemartin
sudo chown noel:noel noeldemartin
git clone -b live --single-branch git@bitbucket.org:ndemartin/noeldemartin.git
cd noeldemartin
scripts/init.sh
```

Complete the .env file by introducing the values for `DO_SPACES_KEY` and `DO_SPACES_SECRET`.

If you want to restore a database backup, run the following commands:

```
docker cp ./mysql-noeldemartin.sql noeldemartin_mysql_1:/tmp
docker-compose exec mysql sh -l
cd /tmp
mysql --database noeldemartin --user noeldemartin --password < mysql-noeldemartin.sql
```

Otherwise, run laravel migrations with `docker-compose exec app php artisan migrate --force`.

Finish the installation by starting the containers, installing dependencies and building assets:

```
docker-compose up -d
docker-compose exec app composer install --no-dev
docker run -v `pwd`:/app -w /app node bash -c "npm install && npm run production"
```

If you are using [nginx-agora](https://github.com/noeldemartin/nginx-agora), install the website with the following command:

```sh
nginx-agora install nginx/noeldemartin.com.conf /var/www/noeldemartin/public
ln -s ../sites_available/noeldemartin.com.conf /var/www/nginx-agora/sites_enabled
nginx-agora start
```

### Fetch updates

```sh
scripts/update.sh
```

### Start

```sh
docker-compose up -d
```

### Stop

```
docker-compose down
```
