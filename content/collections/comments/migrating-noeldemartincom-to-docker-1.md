---
id: migrating-noeldemartincom-to-docker-1
blueprint: comment
title: 'Migrating noeldemartin.com to Docker - 1'
task: 'entry::migrating-noeldemartincom-to-docker'
publication_date: '2019-01-24 02:12:32'
---

After looking at the existing options to serve websites from different containers running on the same host, I decided to implement a couple of bash scripts to serve them using an nginx container. I decided to do it rather than installing nginx directly on the host because it's _slightly_ more portable (I say slightly because it isn't a problem to install nginx somewhere else).

This approach is essentially the same that using [nginx-proxy](https://github.com/jwilder/nginx-proxy), but I wanted to do it manually to have more control on what's actually going on. They are simple scripts, so it isn't like this took me a lot of work, and I learned more about Docker and networks doing it.

I've published my scripts with a couple of working examples on github. I called it [nginx-agora](https://github.com/NoelDeMartin/nginx-agora) (because it creates a network where all the other containers "come together"). But as I already mention in the readme, I don't recommend anyone using this for production without understanding what's going on.
