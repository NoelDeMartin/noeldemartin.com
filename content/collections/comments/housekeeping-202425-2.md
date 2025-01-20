---
id: housekeeping-202425-2
blueprint: comment
title: 'Housekeeping 2024/25 - 2'
task: 'entry::housekeeping-202425'
publication_date: '2025-01-13 09:32:38'
---

You may be surprised to be hearing from me so soon, just a week after my last update... And I am too! But I have done _so many things_ since last week, that I had to write an update. Is this what working full time on my own stuff looks like? 🤩

Realistically, I don't it'll always be like this, because many of the things I've done weren't too big. But yes, I'm definitely more productive working on something for five days a week than one (surpise!). Actually, something [I used to do at Moodle](https://noeldemartin.com/blog/the-end-of-the-chapter#farewell-moodle-hq) was writing weeknotes. Inspired by [Doug Belshaw](https://dougbelshaw.com/blog/2025/01/12/weeknote-02-2025/), I would write an interal weeknote summarising what I worked on that week. That resulted in a 125-page PDF when I left 😱.

So yeah, I like the idea of writing weeknotes if my work pace warrants it. But don't worry, if I end up doing that, I'll probably highlight the most interesting bits to make it easier to consume. For example, here's what I worked on this week:

- **Upgraded my Mastodon server:** Last time I did this was [6 years ago](https://noeldemartin.social/@noeldemartin/100787777601675592) 🙈. This type of experience is why I like so much the idea of "finished software", and it is remarkable that I've been able to pull it off on a federated environment. I guess that's what happens when software relies on open protocols :D. But yeah, in any case, it was due for an upgrade. And it was a lot easier than I expected. Besides upgrading, I also moved the instance for Digital Ocean to Hetzner, and I hope by the end of the year I can drop the Digital Ocean droplet altogether.

    Some interesting notes about the upgrade is that my biggest issue self-hosting Mastodon seems to be related with storage capacity. You may be surprised to hear that, because how much data can an instance-of-one generate? Well, a lot, it turns out. This happens because [Mastodon caches remote assets from other accounts](https://github.com/mastodon/mastodon/issues/15195) in the server :/. That includes avatars, banners, and even emojis! (I had 1.3GB of custom emojis, for god's sake). However, thanks to the magic of Open Source and self-hosting, I've been able to just remove those with a script. [Recent versions have also improved a lot](https://ricard.dev/improving-mastodons-disk-usage/), but there are still some things you can't do out of the box.

    In any case, if you're curious to learn more about how I configured my Mastodon instance, you can check it out in the [noeldemartin/mastodon](https://github.com/noeldemartin/mastodon) repo.

- **Brushed up on Rireki:** [Rireki](https://github.com/noelDeMartin/rireki) is a little python program I wrote years ago to take care of my backups. It's been working pretty well, so I implemented a new feature to automate cleaning up old backups (which I had been doing by hand).

    I also used this opportunity to give [Cursor](https://www.cursor.com/) a try. I'm _very_ late to the party, because this is the first time I've used AI for coding. I'm still not sure whether I like it or not, but I have to say in this context it was very useful because I am quite rusty on Python. However, I am convinced that at some point AI will be an essential tool in my developer's toolkit. And I think the ecosystem is mature enough to start dipping my toes in the water.

- **Brushed up on Freedom Calculator:** [Freedom Calculator](https://freedom-calculator.noeldemartin.com/) is an app I made a while ago to calculate my economical runway and whatnot (which today is more relevant than ever for me!). This week, I added a new option to indicate how much I earn as well, thus calculating [how long until retirement](https://en.wikipedia.org/wiki/FIRE_movement). I don't 100% subscribe to the FIRE philosophy, but I think it's useful to at least be aware of your current trajectory. As you may imagine, my current trajectory is to go broke, given that I have 0 income at the moment 😅.

    This also gave me the opportunity to try yet another new tool, [Playwright](https://playwright.dev/). I've been a fan of [Cypress](https://www.cypress.io/) for a long time, but I've heard many people rave about Playwright. And the nail in the coffin was the [State of JavaScript survey results](https://2024.stateofjs.com/en-US/libraries/#tier_list), where Playwright came out in S-tier whilst Cypress fell to B-tier. My first impressions of Playwright are mixed. On the one hand, I prefer Cypress API (I don't have to await _every single command_) and experience (you can actually see the app running). On the other hand, everything worked flawlesly and I could even implement [snapshot tests](https://playwright.dev/docs/test-snapshots) in CI. I'm also doing this with Cypress, but I didn't manage to make it work [without resorting to Docker](https://github.com/NoelDeMartin/solid-focus/blob/6a7844a73bb47b8684790ebf4663cddc0eefd520/package.json#L13).

- **Started using LSS in production:** [LSS](https://github.com/noelDeMartin/lss) is still very experimental, but given that I'm trying to move away from old infrastructure, and I'm still using [an ancient POD](https://noeldemartin.com/tasks/configuring-a-self-hosted-solid-pod-server), I thought I'd give it a try. And so far, it's working great! I moved my [Media Kraken](https://noeldemartin.github.io/media-kraken/) collection to Nextcloud, and it's awesome to see that I can use the app whilst interacting with the Turtle documents using the full power of Nextcloud (editing files from disk, versioning history, etc).

    I still don't plan on opening this up for everyone any time soon. But if you're curious to try it yourself, let me know and maybe I will create an account for you :).

- **Started applying to jobs:** Yes, I know. It's sad that a week into my full time work as an independent developer I'm already applying to jobs :/. But as I mentioned recently, it doesn't seem like I'm getting the NLNet grant anytime soon (if ever), and I'm burning savings at the moment. So I started exploring the market, and I found a couple of opportunities that are pretty awesome. I don't think I'll be giving too many details about this until I settle on one opportunity, so for now just know that yes, I'm job hunting 😅.
