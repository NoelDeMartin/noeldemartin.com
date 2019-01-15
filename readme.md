# Noel De Martin

## Production

### First time

```sh
scripts/init.sh

docker-compose up -d

docker-compose exec app npm install --only=dev
docker-compose exec app npm run production
docker-compose exec app php artisan migrate --force
```

### Start

```sh
docker-compose up -d
```

### Stop

```
docker-compose down
```
