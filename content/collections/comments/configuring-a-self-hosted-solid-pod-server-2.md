---
id: configuring-a-self-hosted-solid-pod-server-2
blueprint: comment
title: 'Configuring a self-hosted Solid POD server - 2'
task: 'entry::configuring-a-self-hosted-solid-pod-server'
publication_date: '2019-12-13 12:56:43'
---

After deploying the server last week, I've started working on a backup solution. I could search for a nodejs solution, or something specific to Solid. But some months ago I configured backups for this website using [laravel-backup](https://github.com/spatie/laravel-backup) and it's been working great, so I wanted something similar for my data POD as well.

Actually, I reckon I'll probably need it for other things in the future. So I decided to write my own cli application. My idea is to make it language agnostic, and have different drivers for different projects. That way, whenever I have something new that I want to backup I'll just need to implement a new driver.

Some time ago I wrote a cli application to manage projects using Docker during development, I called it [metal](https://github.com/noeldemartin/metal). It's worked great for me, but some people had issues installing it. Which is annoying, because it's just a simple wrapper and Docker is doing the heavy load. But it seems like [pip](https://pypi.org/project/pip/) has some problems with dependency management (or I don't know how to declare my package properly). So this time I decided to use bash instead (I've used it for [ngnix-agora](https://github.com/noeldemartin/nginx-agora), another cli application I wrote and it's working well). But I quickly realized it was a fool's errand. It was an uphill battle to write modular code, given that I couldn't even have data structures or return values. I thought it would be nice to use a language that compiles to bash, and I found [Batsh](https://batsh.org/), but it didn't convince me either. What actually ended up convincing me was this article: [Replacing Bash Scripting with Python](https://github.com/ninjaaron/replacing-bash-scripting-with-python). So yeah, I ended up doing it with Python as well.

I'm using the [click](https://click.palletsprojects.com/en/7.x/) framework, like I did with metal. This time I hope to learn more about python's dependency management and building cli applications. I also set up CI with github actions which at least runs the tests in an environment that isn't my own. One thing I've already learned is to [avoid using json for config files](https://revelry.co/json-configuration-file-format/), and use [toml](https://github.com/toml-lang/toml) instead.

You can find this work in progress at [https://github.com/noeldemartin/rireki](https://github.com/noeldemartin/rireki). I'm calling it `rireki` because it means "personal history" or "logs" in japanese.
