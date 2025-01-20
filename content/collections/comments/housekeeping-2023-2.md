---
id: housekeeping-2023-2
blueprint: comment
title: 'Housekeeping 2023 - 2'
task: 'entry::housekeeping-2023'
publication_date: '2023-03-31 17:45:11'
---

The last couple of weeks I've been doing some much needed maintenance in my infrastructure. That's what today's update is all about.

First of all, I finally upgraded my laptop to Ubuntu 22.04 (I was still running 18.04 😅️). If it were my choice, I don't think I'd ever update anything because it's always traumatic. More often than not, I don't care about new features. And I usually lose features I wanted (this time, it's been the [Workspace Matrix](https://askubuntu.com/questions/1404927/how-to-get-a-grid-of-workspaces-in-ubuntu-22-04)). I've thought about using Debian or some other "stable" OS, but I already have issues with Ubuntu and it's the most mainstream of the linux distros. So I'm not convinced it wouldn't be worse with others, and I won't be bothered to try.

Something that's giving me problems recently is my NVIDIA graphics card. Which [doesn't come as a surprise](https://www.youtube.com/watch?v=iYWzMvlj2RQ). Fortunately, I'm not much of a gamer nowadays. But I have [a gamer's laptop](https://www.asus.com/es/laptops/for-gaming/tuf-gaming/asus-tuf-gaming-fx504/), because it was the most similar [to my previous laptop](https://www.manualslib.com/products/Asus-X552c-10156895.html). I already dread the day I'll have to change it again :/. It's funny because people may think I'm into this stuff, given that I'm so passionate about programming. But when it comes to hardware and infrastructure, I really don't care. I think Docker is the best thing that's happened to that space in the last 10 years.

Anyways, something else that's broken is my [SpiderOAK](https://spideroak.com) account. In their defense, it wasn't the software itself that was broken. But they have a [Zero Knowledge](https://spideroak.com/features/zero-knowledge) policy, which means it doesn't have any password recovery features. I've used different password strategies over the years (currently using [LessPass](https://www.lesspass.com)), but I installed SpiderOak about 5 years ago and I haven't been able to find the password anywhere. So I've been locked out of my account :/. Fortunately, I backed up all my data before formatting, so I didn't lose anything. But it's a bummer. And it makes me lose hope in that type of trustless security in practice, as much as I like the idea in theory. I started using it with the intention to eventually stop using Dropbox. Ironically, I'm still using Dropbox today. But I hope to give it another try soon, probably with [NextCloud](https://nextcloud.com/).

Finally, I haven't realized this now, but a while ago [VSCode stopped working](https://github.com/microsoft/vscode/pull/166126#issuecomment-1342861959) with one of my core extensions. In particular, it's one that allows you to customize the UI of VSCode with CSS. And I mostly use it to hide stuff. And that still hasn't been fixed, so until it is I'm stuck with [VSCodium 17.3.1](https://github.com/VSCodium/vscodium/releases/tag/1.73.1.22314). But I don't care that much anyways, because I don't think I've used a new feature in VSCode for years. But it could potentially be an issue down the road.

If you're curious about my set up, I have this repository with my settings: [github.com/noeldemartin/env](https://github.com/noeldemartin/env)

And that was it for my laptop. But I've also been working on my server set up.

At the moment, all of my sites are hosted on an Ubuntu 18.04 droplet in DigitalOcean. So it's also due for an upgrade. Over the years, I've been trying to work out an architecture that allows me to deploy sites as "serverless" as possible, without actually relying on serverless technologies. I actually like the idea of serverless a lot, but I don't like how it can scale to infinity and [potentially drain your bank account](https://world.hey.com/dhh/why-we-re-leaving-the-cloud-654b47e0). But I think I'm getting very close to something perfect for my needs. What I came up with is basically a Docker-driven architecture, with something I'm calling ["headless" deploys](https://github.com/noeldemartin/vocab#production), and served with [nginx-agora](https://github.com/noeldemartin/nginx-agora).

I've also used the opportunity to try [Hetzner](https://www.hetzner.com/), and so far it's looking good. I'm also improving my security set up by using a [bastion server](https://en.wikipedia.org/wiki/Bastion_host) for ssh, rather than logging in directly to the host serving the websites. But unfortunately, I can't do the switch yet, because some of my sites like `noeldemartin.com`, [my Solid POD](https://noeldemartin.com/tasks/configuring-a-self-hosted-solid-pod-server), or [my Mastodon instance](https://noeldemartin.social) aren't using that architecture yet.

I have thought about other alternatives, like [MRSK](https://mrsk.dev/) or [Yunohost](https://yunohost.org). And the idea of [easy indie apps](https://easyindie.app/) is very enticing. But for some reason, I don't believe that it'll be as easy as they make it to be. To me, they sound like more layers of abstraction, and I'd rather do it with Docker which I'm already familiar with and is widely supported.

All this complexity is something I'd like to remove from my life. But I only have to dedicate some time every few years, so I think it's bearable for now. And the sites are still running fine, so I'm leaving it there for now and I'll migrate them some time in the nearish future.

Before you depart, I should also mention that I started using HEY World to post these updates. So if you prefer to get them in your email rather than through RSS, be sure to check it out: [world.hey.com/noeldemartin](https://world.hey.com/noeldemartin)
