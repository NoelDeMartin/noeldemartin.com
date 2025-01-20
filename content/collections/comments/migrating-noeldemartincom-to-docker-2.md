---
id: migrating-noeldemartincom-to-docker-2
blueprint: comment
title: 'Migrating noeldemartin.com to Docker - 2'
task: 'entry::migrating-noeldemartincom-to-docker'
publication_date: '2019-01-30 07:03:34'
---

I've now completed migrating the website! I also used the opportunity to improve on two things: scheduling automatic backups and setting up cron tasks with docker.

To perform backups, I started using spatie's [laravel-backup](https://github.com/spatie/laravel-backup) package. It's been one of those rare packages that works out of the box and didn't give me any problems :). I may send them a thank you postcard as they suggest. Specially enjoyable was the fact that I could use [DigitalOcean Spaces](https://www.digitalocean.com/products/spaces/) to store the files. Double simplicity, everything working smoothly!

The other thing that didn't go so smooth was configuring cron jobs within docker containers. It would have been possible to configure the cron tasks from the host and invoke the commands using docker `run` or `exec`. But I thought it'd be better to encapsulate as much as possible within the containers. The final approach I've taken is to use [supervisor](http://supervisord.org) within a php container, the one serving the app, to launch both the cron and php-fpm daemons. This will also be useful in the future if I want to launch other daemons, for example queue workers. I had to tweak a couple of things to make it work (change default command from the php image, add config files, etc.). But I am happy with the final results.

So that's it for this iteration of the website!
