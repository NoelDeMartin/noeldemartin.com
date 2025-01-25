---
id: configuring-a-self-hosted-nextcloud-server-1
blueprint: comment
title: 'Configuring a self-hosted Nextcloud server - 1'
task: 'entry::configuring-a-self-hosted-nextcloud-server'
publication_date: '2023-04-15 07:51:49'
---

One of the apps I've been trying to ditch for the longest time is Dropbox. Some years ago I tried to substitute it with [SpiderOAK](https://spideroak.com/), but [that didn't turn out great](/tasks/housekeeping-2023#comment-3-p-4). Now I'm taking another stab with [Nextcloud](https://nextcloud.com).

There are many things I like about Nextcloud; [their philosophy](https://archive.fosdem.org/2018/schedule/event/nextcloud/), it's built with PHP, and it has a big community. There are also some things I don't look forward to; the fact that it has [too many features](https://nextcloud.com/hub/) (I'm only interested in file syncing), and [the source code](https://github.com/nextcloud/server) doesn't seem too welcoming if I ever want to get my hands into it. But I don't know much about it beyond the first impressions, so I'm going to spend some time learning how it actually works and finding out how flexible it can be.

I care about flexibility because what I want to do is not as straightforward as it sounds. I don't actually want to have a single server, but many. I'm currently using Dropbox to host documents, but I'd like to use this opportunity to configure a [Media Server](https://en.wikipedia.org/wiki/Media_server). Even though I'm calling it "self-hosted", what I actually want to do is installing it in a Cloud provider (probably [DigitalOcean](https://digitalocean.com) or [Hetzner](https://www.hetzner.com/)). But I don't want to store _everything_ in the cloud, there are some files I'd like to keep in my local network as well. At the same time, I want to have local backups for redundancy outside of the cloud. I'd also like to sync files in my mobile phone to edit offline (I'm currently using [Obsidian](https://obsidian.md/) + [Dropsync](https://play.google.com/store/apps/details?id=com.ttxapps.dropsync)). And finally, it'd be awesome if I can use it to [host my Solid POD](https://github.com/pdsinterop/solid-nextcloud).

So yeah, that's a lot of things I want to do and I'm not sure Nextcloud can handle it without too much tinkering. Depending how easy it is to work with, I'll decide how far I take it.
