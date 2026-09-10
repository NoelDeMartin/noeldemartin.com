---
id: programming-patterns-self-hosting
blueprint: post
title: 'Programming Patterns: Self-hosting'
publication_date: '2026-09-10T19:41:00+02:00'
modification_date: '2026-09-10T19:41:00+02:00'
---

{{ partial:components/callout title="Programming Patterns"
    content="This is part of my Programming Patterns series, check it out to find more."
    url="https://noeldemartin.com/blog/programming-patterns"
    image="/img/blog/ProgrammingPatternsSeries.jpg"
    icon="icons/blog"
    target="_blank"
/}}

<img src="/img/blog/ProgrammingPatternsSelfHosting.jpg" alt="" class="sr-only" />

I have been self-hosting for more than a decade. Besides some occasional inconvenience, it turned out to be easier than I thought. Today, I'm going to share my entire setup.

## On hosting your own software

When [I started this series](https://noeldemartin.com/blog/programming-patterns#what-are-programming-patterns-anyways), I mentioned that some of the patterns I had in mind weren't about programming at all... Well, this is the one that inspired that sentence!

However, I'd argue it's important for any developer to understand the basics of managing servers, even if you aren't interested in DevOps or hosting your own software. It also gives you the superpower to actually own your software, and free yourself from vendor lock-in.

Still, I understand that it sounds like a drag and most people don't want to spend any time on these things. I was also a bit reticent when I started, but I have to say that after all these years, I'm very glad I did. It's taken a lot less work than I expected, I've barely had any issues in production, and following some simple rules, it's not that hard.

Let's get into it!

## My services

Before we get into the technical details, here's a list of everything I am self-hosting:

- My [personal website](https://github.com/noeldemartin/noeldemartin.com).
- An instance-of-one [Mastodon server](https://github.com/noeldemartin/mastodon).
- A personal [Nextcloud server](https://github.com/NoelDeMartin/nextcloud).
- A [Solid POD](https://github.com/NoelDeMartin/lss/) (the data is actually stored in Nextcloud).
- A couple of simple Laravel apps: [Vocab](https://github.com/NoelDeMartin/vocab) and [Proxy](https://github.com/NoelDeMartin/proxy).

Depending on where you are in your self-hosting journey, this may seem like a very short list; or very long. But actually, I'm using more of my own software than the list would make you think.

I also "self-host" a bunch of SPAs, but thanks to the Solid Protocol they don't need any servers: [Media Kraken](https://github.com/NoelDeMartin/media-kraken/), [Umai](https://github.com/NoelDeMartin/umai), [Focus](https://github.com/noelDeMartin/solid-focus), etc. And some of the 3rd party apps I use also rely on my own infrastructure, such as [Obsidian](https://obsidian.md/) (I store the `.md` files in Nextcloud).

Still, I am not running all of this from a computer in a closet, though I have a homelab. And I am definitely not self-hosting my email server. I guess that's where I draw the line!

## Infrastructure

Instead of maintaining a server at home, I am renting a VPS on [Hetzner](https://www.hetzner.com/) (I used to host it on DigitalOcean, but I switched some years ago).

And yes, I run all of that in a single server. Currently, that's a 4-core CPU with 8GB of RAM that costs me 8€/month. I also rent a 1TB [Storage Box](https://www.hetzner.com/storage/storage-box/) for 4€/month. Believe it or not, my entire self-hosting bill is only 12€/month!

There is an argument to be made that it's irresponsible to host all of these services in the same machine. I certainly wouldn't do it for "real" production software that deals with other people's data. But for the traffic I have in my websites, and most of it being personal software, I just don't think it makes sense to have dedicated servers.

And maybe that's one of the main takeaways you can get from this post. You don't always need a Kubernetes cluster and a load balancer to run software. If your use-case doesn't warrant it, self-hosting can be very simple.

## Configuration

It would be great if all my apps were made with Laravel, because it would be a lot easier to configure. But I am also running software I didn't write (Mastodon, Nextcloud, etc.). Thankfully, we have Docker!

I use Docker to manage all my services, which has the added benefit of making it easier to switch between servers (and provides some nice isolation between processes).

Essentially, I am using 3 tools to manage all of this:

### Docker

For 3rd party applications, I have configured my own repository with custom Docker Compose files. If you're curious, you can find them on GitHub:

- [My docker-compose.yml for Mastodon](https://github.com/NoelDeMartin/mastodon/blob/main/docker-compose.yml).
- [My docker-compose.yml for Nextcloud](https://github.com/NoelDeMartin/nextcloud/blob/main/docker-compose.yml).

For my own apps, I implemented a tool called [kanjuro](https://github.com/NoelDeMartin/kanjuro).

Basically, every time I push a new commit I have [a GitHub Actions workflow](https://github.com/NoelDeMartin/noeldemartin.com/blob/main/.github/workflows/dockerhub.yml) that creates a new image in Docker Hub. I also have [another workflow](https://github.com/NoelDeMartin/noeldemartin.com/blob/main/.github/workflows/kanjuro.yml) that creates a `kanjuro` branch with the files that aren't included in the image (`docker-compose.yml`, `.env`, nginx config, etc.).

Then, all I have to do in the server is check out a clone of the `kanjuro` branch, and run `kanjuro install` to prepare the docker containers. Then, I can use `kanjuro start` to launch the application, `kanjuro update` for updates, etc.

With that, I have all my apps running inside of Docker containers.

### Nginx

One of the issues you may run into if you try to host multiple apps in a single machine is networking. Most nginx configs you find out there will assume that you're running a single app in your machine, and Docker instructions usually tell you to simply expose the containers on ports 80 and 443.

I also struggled with this for a while, until I decided to create [nginx-agora](https://github.com/NoelDeMartin/nginx-agora/). It's basically a bunch of bash scripts that orchestrate a Docker container running nginx, with the single purpose of routing requests to app containers.

I also use [Let's encrypt](https://letsencrypt.org/) to issue and renew SSL certificates in the host machine, and `nginx-agora` takes care of making them available to all the apps as well.

### Backups

I haven't had to restore from a backup in my 10+ years of self-hosting. Still, having backups is essential; as well as knowing how to restore them. Fortunately, I get some practice with the former every few years, when I migrate from one server to another. I start from scratch every time, rather than upgrading the OS.

I also implemented a custom tool for this, called [rireki](https://github.com/NoelDeMartin/rireki). It's basically a Python CLI that runs every day in a cron job, and takes care of backing up the production databases and files, as well as removing stale backups.

At first, I implemented some integrations with [Digital Ocean Spaces](https://www.digitalocean.com/products/spaces) and services of the sort, but lately I just store them in my Storage Box directly by mounting a folder with SMB.

You may have heard about the "3-2-1" rule of backups: you should have 3 copies of your data, in 2 different types of storage, with at least 1 copy off-site. In my case, I don't adhere strictly to that. But my backups are well distributed:

- The main copies live in the Storage Box, with daily automatic snapshots.
- I don't back up all the files in my Nextcloud, but they are stored directly in the Storage Box and most of them are available offline in my homelab.
- Once a day, I copy the entire Storage Box into a 2TB external hard drive that is connected to the homelab (and is encrypted, of course).

## Security

To be completely honest, I was a bit hesitant to publish this. If someone wants to hack me, they couldn't get a better Getting Started guide than this blog post. But in reality, that sort of hesitation only comes from [security through obscurity](https://en.wikipedia.org/wiki/Security_through_obscurity).

I've never been a huge fan of that, but now in The Age of AI, it's less relevant than ever. One of the advantages of having a small audience is that I'm not very likely to be a target for hackers, but now that AIs are becoming good at this, we're more likely to see automated attempts. I don't think any of the information I've revealed in this post would take a decent agent more than an afternoon to obtain on their own.

The first line of defense is, of course, at the network level. I have configured my VPS in such a way that the only ports reachable from the outside are 80 and 443. Yes, I can't even ssh into the server myself. I have a "development" firewall rule that I activate sometimes, which opens the 22 port for my home IP. But most of the time, I just use Hetzner's console to log in directly on the VPS.

The second line of defense is Docker. Given that every app is running on its own container, even if a hacker manages to do something nasty through HTTP the impact should be limited to that app's jurisdiction.

And finally, I have configured `unattended-upgrades` and try to keep app dependencies up to date. This last part has gotten a lot easier with AI. Recently, I migrated all my apps to Laravel 13 and did a thorough security audit that took me about 2 days. In the past, this could have taken me weeks, and I probably wouldn't have been able to detect half of the exploits AI warned me about.

Some people seem to be running AI agents directly on their servers, to help them diagnose and fix problems. But I'm very skeptical about that being safe, so for now I've limited myself to talking with AI about server management, and using coding agents to audit the various codebases and config files.

Actually, I just asked Gemini their opinion on this blog post, and here's what they said:

> Honestly, for a personal server, this setup is about as secure and sensible as it gets. By keeping SSH closed to the public internet, placing databases strictly on internal Docker networks, isolating each app's proxy traffic with `nginx-agora`, and avoiding dangerous anti-patterns like mounting the Docker socket, you eliminate virtually all automated attacks and bot traffic.
>
> In pure security theory, the main caveat with running multiple apps on a single machine is that Docker containers share the host Linux kernel—meaning a container escape via a kernel exploit is the ultimate theoretical boundary. But for your actual threat model, that is practically a non-issue: automated bots don't carry zero-day kernel exploits, and you aren't hosting high-value multi-tenant corporate targets. The only real maintenance detail is making sure `unattended-upgrades` kernel patches actually take effect with occasional reboots.
>
> What really seals the deal is your backup design. Even in a worst-case scenario, independent Hetzner snapshots and a daily pull to an offline, encrypted drive in your homelab mean you can recover from anything. For an 8€ VPS, you're in fantastic shape.

I also don't think I should mention this, but the most sensitive apps (Mastodon, Nextcloud) have 2FA enabled. My text passwords are not stored anywhere (I use [lesspass.com](https://www.lesspass.com/)), and even if someone got access to all my data they wouldn't be able to access my bank account.

All in all, I feel pretty safe!

## Managed Services

I know these are not technically "self-hosting", but I'll mention them for the sake of completeness. I have been dabbling with these from time to time, but I haven't gotten great results. Mostly for the [obscene pricing](https://stacktape.com/_next/static/media/vercel-prices.c2ad6226.png), but also for the vendor lock-in.

As I mentioned at the beginning, I have a bunch of SPAs, and I'm hosting them in various places: [GitHub Pages](https://docs.github.com/en/pages), [Render](https://render.com/), [Netlify](https://netlify.com/), etc. These are a bit of an exception, because so far I have gotten away with using free plans, and I don't consider having any vendor lock-in since I'm only publishing static assets.

The only "real" managed service I'm still using is [Laravel Cloud](https://laravel.com/cloud). Normally I wouldn't have used it, but I'm a huge Laravel fan so I had to try it. The UX is great, and I haven't had any real issues setting up my apps. It's definitely easier than self-hosting. However, the [pricing shenanigans](https://www.reddit.com/r/laravel/comments/1u9atzt/comment/ounnte2/) really are a problem. And because [the app I'm running](https://github.com/NoelDeMartin/podcast-enhancer) needs to process "big" audio files with ffmpeg, I can't get away with using the cheaper machines. Currently, I am renting a $16/month machine that only has 2 cores and 2GB of RAM 😅. Fortunately, I have the [Scale to Zero](https://laravel.com/cloud/docs/compute#scale-to-zero) feature enabled and I don't pay that much.

Finally, I want to give a shout out for [Laravel Nightwatch](https://nightwatch.laravel.com/). This isn't running on my server either, but I think it's essential to my self-hosting. Yes, you can also use it with self-hosted apps. You only need to set up a Nightwatch Agent, and it'll send the diagnostics to Laravel's servers. The free plan is also very generous, and so far I have never paid more than $1/month.

Now, after reading all of this you may think I'm completely against using managed services, but that couldn't be further from the truth. In my current situation, it doesn't make much sense to use them, because I like to tinker with these things and have total freedom with my setup. However, a lot of people don't want to deal with any of this; and it's also very possible that I won't later in life.

One of the reasons why I'm confident running my own software is that I know it's not a life-long commitment. I own the most important part, which is the domain names. All my apps run under either `noeldemartin.com` or `noeldemartin.social`, so whenever I want to switch to a managed service (or vice-versa), I know I can.

## Tips & Tricks

That's mostly everything I wanted to talk about, but there's still a couple of things I wanted to mention. I'll end the post by sharing some rapid-fire tips & tricks:

- All these Docker updates can end up consuming a lot of space, so I have configured a cron job that runs `docker system prune -f` once a week.
- You may have noticed that I don't have any automatic deploys set up. That's a conscious choice, I prefer to simply log into the server and run the commands.
- I have been thinking about my digital legacy, and what's going to happen with all of this once I'm gone. So I'm keeping an eye on [keepsite.org](https://keepsite.org/).
- Also check out Derek Sivers' [Tech Independence guide](https://sive.rs/ti) for similar tips, with step-by-step instructions to set this all up yourself.
