---
id: configuring-a-self-hosted-nextcloud-server-2
blueprint: comment
title: 'Configuring a self-hosted Nextcloud server - 2'
task: 'entry::configuring-a-self-hosted-nextcloud-server'
publication_date: '2023-05-05 16:17:19'
---

It's been 3 weeks since I started working on this, and... I don't have good news :(. In fact, if you don't care about reading any further, TLDR: I haven't installed anything yet 😅️.

Let me rewind for a bit.

Right after kicking off this task, I made the following diagram of my ideal setup:

[![My dream Nextcloud architecture](/img/tasks/nextcloud/dream-architecture.png)](/img/tasks/nextcloud/dream-architecture.png)

My idea was to set up 2 Nextcloud instances: one running in a local server at home (with a raspberry pi, or an old laptop), and another running in the cloud (with DigitalOcean, Hetzner, or whatever). I also wanted to keep Nextcloud clients in my phone and laptop with a copy of some data for offline access. And I also wanted to tackle other needs, with [jellyfin-webdav](https://github.com/iWangJiaxiang/docker-jellyfin-webdav) for media management, and [solid-nextcloud](https://github.com/pdsinterop/solid-nextcloud) for a Solid POD. All of this works great in theory, but it didn't work so well in practice.

So, Nextcloud. I've been tinkering with it, and my general impression is actually very good. Other than PHP, I found it's built with Vue, which is awesome because it's already using my preferred stack (no Laravel though :P). And I confirmed that it's possible to disable most features to use only file management. The UX is also quite straightforward, and I could manage to do mostly everything I wanted.

But there were also a couple of things I didn't enjoy so much. For example, [the codebase](https://github.com/nextcloud/server) is enourmous. There are over 67k commits, and cloning the repository meant downloading 3.07 GiB 😱️. That is definitely something I don't like, and reminds me of [Moodle](https://github.com/moodle/moodle) (in a bad way). But then, trying to set up a local instance was a lot worse. My idea was to run it with a couple of Docker containers (which [they already support](https://github.com/nextcloud/all-in-one)), and expose it in a local ip that's only accessible from my local network. But for some reason I still don't understand, that isn't possible. They are actually aware of the use-case, and they have [a very helpful document](https://github.com/nextcloud/all-in-one/blob/main/local-instance.md) explaining how to achieve it, with the recommended way requiring setting up a [pi-hole](https://pi-hole.net/) (WHAT!?). I even entertained the idea and tried to set up said pi-hole, to see how hard it really was. (Un)fortunately, I got into a dead end when I found out that my router doesn't allow configuring DNS server ips. Yes, I could buy another router or whatever, but I'll take this as a sign that I shouldn't keep going down this path. This is so far from what I had in mind — a simple infrastructure — that it wouldn't be worth the trouble.

On the flip-side, I gave [Jellyfin](https://jellyfin.org/) a try, and that one lived up to my expectations. I set it up in 5 minutes and got it playing on my phone. But then again, life isn't that perfect, and apparently if I want to have it on my TV [I have to compile the app from source](https://github.com/jellyfin/jellyfin-tizen) :/. At least I got it playing on the TV using the web browser, so that will have to do for the time being (thank god for the Web!).

Something else I've been tinkering with is the Solid integration for Nextcloud. At first, [I thought it wouldn't be as ready as I expected](https://github.com/pdsinterop/solid-nextcloud/issues/72), but after talking with the maintainers it seems the project is in pretty good shape. One drawback I noticed is that you have to be an administrator to install it, which is a bummer because I thought anyone with a Nextcloud account would be able to use it. I could make it work with [Umai](https://umai.noeldemartin.com/) though, and realized that it doesn't support PATCHing documents using `application/sparql-update`. Incidentally, [I had heard about it recently](https://matrix.to/#/!QxZtVBYQfMeMTnespj:gitter.im/$nzonYjo6VDS-bY9zy3tViZhA8WR5VkgTUaYE67LqNj4?via=gitter.im&via=matrix.org&via=attendees.fosdem.org), and it seems like that's actually conforming with the spec. The spec only requires supporting `text/n3` PATCHes. So I'll have to update my apps. Which shouldn't be difficult thanks to [Soukai](https://soukai.js.org/), but [ESS does not support `text/n3` yet](https://github.com/solid-contrib/solid-crud-tests/issues/60), and I'll have to see what to do about it 🤷‍♂️️.

Anyhow, with all that said I've decided to forego the idea of self-hosting a Nextcloud instance in my home network. But I'm still not abandoning the idea of having an instance running on the cloud, we'll see how that goes.
