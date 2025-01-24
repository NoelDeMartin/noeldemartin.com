# Noel De Martin ![CI](https://github.com/noeldemartin/noeldemartin.com/actions/workflows/ci.yml/badge.svg)

This is the source for my site at [noeldemartin.com](https://noeldemartin.com). It is built using [Statamic](https://statamic.com), [Laravel](https://laravel.com), [TailwindCSS](https://tailwindcss.com), and [AlpineJS](https://alpinejs.dev).

Feel free to dig around. Most of the content is written in Markdown, so if you see any typo in the website I'd appreciate it if you open a PR!

## Development

If you want to tinker with this locally, it's a standard Statamic/Laravel app. So whatever set up you're using for your apps, should work. This is the one I use:

```bash
git clone git@github.com:NoelDeMartin/noeldemartin.com.git noeldemartin.com
cd noeldemartin.com
cp .env.example .env
composer install
npm install
php artisan key:generate

## Only do this if you want to use the control panel
touch database/database.sqlite
php artisan migrate:fresh --seed

composer dev
```

You should now be able to open the site on [localhost:8000](http://localhost:8000), and use the control panel at [localhost:8000/cp](http://localhost:8000/cp) using the `admin@example.com` username and `secret` password.

## Production

These instructions are mostly for me, since I don't expect anyone to serve this other than myself (please don't 😅).

I'm using [kanjuro](https://github.com/NoelDeMartin/kanjuro) and [nginx-agora](https://github.com/NoelDeMartin/nginx-agora) to deploy this site with Docker.

```bash
git clone https://github.com/NoelDeMartin/noeldemartin.com.git --branch kanjuro --single-branch
cd noeldemartin.com
kanjuro install
kanjuro start
nginx-agora start
```
