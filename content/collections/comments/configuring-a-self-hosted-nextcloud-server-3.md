---
id: configuring-a-self-hosted-nextcloud-server-3
blueprint: comment
title: 'Configuring a self-hosted Nextcloud server - 3'
task: 'entry::configuring-a-self-hosted-nextcloud-server'
publication_date: '2023-05-22 18:42:33'
---

Today's update should be more uplifting than the last, because I've done some progress! In fact, I'm done with the task :D. Let's get into it.

Before getting started, this is the architecture I ended up with:

[![My actual Nextcloud architecture](/img/tasks/nextcloud/final-architecture.png)](/img/tasks/nextcloud/final-architecture.png)

As you can see, I abandoned the idea of hosting a Nextcloud instance in my local network. But now that I've learned more about it, I think I could actually pull it off (though I don't see a point anymore). In my last update, I mentioned that a domain is required to run Nextcloud, and all the headaches I ran into with the pi-hole and whatnot. However, once I tried to install it in the server I realized this restriction is only imposed in the [All-in-One](https://github.com/nextcloud/all-in-one) out-of-the-box solution. After digging into the repository and reading some documentation, I realized I didn't want to do that anyways. Instead, I created my own set up which combines a [Manual installation](https://github.com/nextcloud/all-in-one/tree/main/manual-install) with a [Reverse Proxy](https://github.com/nextcloud/all-in-one/blob/main/reverse-proxy.md) (using [nginx-agora](https://github.com/noeldemartin/nginx-agora)).

Something else I did which was non-standard is storing the actual files in a [Hetzner Storage Box](https://www.hetzner.com/storage/storage-box). The awesome part about it is that even if I mess something up in the server or botch up some upgrades, the files are decoupled. So it'd be very easy to rebuild on a brand new server. And I'm only paying 3.81€ for 1TB of storage. Doing this wasn't completely straightforward, but thanks to my tinkering from last time, I learned about [WebDAV](https://en.wikipedia.org/wiki/WebDAV). And it turns out to be a perfect solution for this. Essentially, I am mounting Hetzner's Storage Box on the server like a normal folder, and I've configured Nextcloud to use that folder to store the files.

If you're interested in the details, you can find my configuration up in GitHub: [github.com/NoelDeMartin/nextcloud](https://github.com/NoelDeMartin/nextcloud)

So yeah, that pretty much settles all my storage needs for the time being. I've installed Nextcloud clients in all the other machines, and it seems to be working fine so far. I have to say that the user experience is not super smooth; it's a bit clunky at times, with more than a few glitches here and there. But so far I haven't run into any important bugs, so it seems good enough.

Something I've also postponed is hosting my Solid data with Nextcloud. I continued tinkering with the [solid-nextcloud](https://github.com/pdsinterop/solid-nextcloud/) extension, but I realized something that was a deal-breaker for me. [The id of the documents are very cumbersome](https://github.com/pdsinterop/solid-nextcloud/issues/123) :/. But I think there's still a possibility that I use it in the future. The UX of having Solid data in Nextcloud was great, and even though I ran into some issues I could work around most of them. But I think I'd need to dedicate a lot more time to make it good enough, so I'll leave it here for now.

About the home server, I haven't done much since the last update other than installing the Nextcloud client. I tried to come up with a solution to turn it on and off easily, but unfortunately it seems like my old laptop doesn't support [Wake-On-Lan](https://en.wikipedia.org/wiki/Wake-on-LAN) or any other viable solution. So right now I'm opening the lid, pressing the power button, and closing it again. Which doesn't seem too bad, but it's a bit annoying for a "server". In the future I'll look into hosting it on a Raspberry PI instead, and I should be able to keep it running 24/7. But for my current needs, it's ok to just turn it on sporadically.

And that's it for this task! There's definitely more things I want to look into, but I'm itching to get back into coding again so that's where I'll leave it this time.

Before closing this though, I'd like to give a shout-out to Derek Sivers for his recently created [Tech Independence](https://sive.rs/ti) guide. It's a fun coincidence that shortly after I started working on this task, [he made a reappearance in Tim's podcast](https://tim.blog/2023/04/21/derek-sivers/) talking exactly about this. I've looked at the guide, and even tried some of the tools he mentions (I didn't know about Hetzner Storage Box before!). But ultimately, I think most of them are "too simple" for my needs. Which is funny to say, because I've been talking about how I want to simplify my infrastructure and all that. The thing I've realized is that I want simplicity, but I also crave good UIs and hands-off experiences. Most of the tools he's recommending are great, but either don't have a nice UI or are too cumbersome to use regularly. In any case, I think we're super aligned when it comes to values and the idea of tech independence. If you've been reading this and found it interesting, I strongly suggest checking out Derek's guide. You may find something you like :).
