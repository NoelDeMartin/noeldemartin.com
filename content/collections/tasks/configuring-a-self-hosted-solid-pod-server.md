---
id: configuring-a-self-hosted-solid-pod-server
blueprint: task
title: 'Configuring a self-hosted Solid POD server'
publication_date: '2019-11-18 17:11:39'
completion_date: '2019-12-26 20:17:17'
---

Recently I've been [working on a Solid task manager](https://noeldemartin.com/tasks/improving-solid-focus-task-manager), but I haven't started to use it in production myself. One big reason why I is that I was using a POD from [solid.community](https://solid.community), but the software was updated without notifying its users and my application was not compatible with the server for a while. It seems to be working now, but this experience taught me how important it is to have control over my data POD.

So I've decided that I will start self-hosting my data POD using [node-solid-server](https://github.com/solid/node-solid-server). This shouldn't be too difficult because I've already been working with it locally for development. However, there are a couple of things that I don't expect to be straight-forward. Like configuring SSL certificates and scheduling backups.
