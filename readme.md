# Noel De Martin

## Production

### First time

Before getting started, make sure to have docker and docker-compose installed. All ssh keys should also be configured (read instructions for bitbucket [here](https://confluence.atlassian.com/bitbucket/set-up-an-ssh-key-728138079.html)).

Once the system has all the dependencies installed, execute the following commands:

```sh
cd /var/www
sudo mkdir noeldemartin
sudo chown noel:noel noeldemartin
git clone -b live --single-branch git@bitbucket.org:ndemartin/noeldemartin.git
cd noeldemartin
scripts/init.sh
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
