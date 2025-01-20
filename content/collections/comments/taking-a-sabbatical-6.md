---
id: taking-a-sabbatical-6
blueprint: comment
title: 'Taking a Sabbatical - 6'
task: 'entry::taking-a-sabbatical'
publication_date: '2024-12-23 09:54:42'
---

After 103 days, 34 cities, and 9 countries... I'm finally back home 🥳.

This trip has definitely been _something_, and even though [I would have ended it after the first month](https://noeldemartin.com/tasks/taking-a-sabbatical#comment-4), I'm glad I pulled through. It'll be an experience I treasure for the rest of my life.

I'm dividing this last update into 3 sections: Life Stuff, Tech Stuff, and Conclusion.

### Life Stuff

Last time, I wrote from China. And man, was it a country that surprised me. I've traveled quite a bit in my life, even before this sabbatical frenzy. But it had been years (if not decades) since I've been this surprised by a country. My impression of China can be summarized with this Willian Gibson's quote "The future has arrived — it’s just not evenly distributed yet".

Since [I spent 5 months in Taiwan in 2012](https://noeldemartin.com/blog/10-years-as-a-software-developer#2012-seizing-the-opportunity), and I've spoken with others who've visited China before, I thought I knew what I was getting myself into. But I totally wasn't. Everything is a lot more advanced than I expected: almost all vehicles are electric, everything works with mobile applications (WeChat & AliPay), there's connectivity everywhere, many buildings and malls are super modern, etc. Just to share an example, we had to use WeChat to use a washing machine... and we got a push notification when the laundry was finished!

Of course, not everywhere is like that. Shanghai was definitely more advanced than Beijing. But even in Beijing, you can pay (and order!) in most restaurants using a mobile application (which, thank god, has automated english translations). For the most part, everything worked seamlessly. And it was really cool to live in an environment where I felt like [interoperability was a reality](https://noeldemartin.com/blog/skeuomorphic-software), both in hardware and software. I felt like I was living in the future, and there are many things I'll miss about China.

And yet, there were also some things I definitely didn't enjoy... Like the surveillance :/. Having cameras everywhere is one thing, but this is the only country where I've been regularly asked to show my passport just in order to board a train, or enter a crowded street. And there were a couple of "[computer says no](https://www.youtube.com/watch?v=x0YGZPycMEU)" situations.

And don't get me started on the network restrictions... I already knew about Google & company being blocked (and to certain extent, I even like it!). But it's not just them. In fact, it seemed like a website being available was more the exception rather than the rule :/. Wikipedia, DuckDuckGo, Feedly, Telegram, BlueSky, Discord, etc. All of them blocked ([even GitHub](https://www.reddit.com/r/China/comments/v8fv0p/why_is_github_so_slow_in_china_recently/)!). Funnily enough, though, my personal website and self-hosted Nextcloud instance worked... And my self-hosted Mastodon server was the only social network I could use!

Of course, eventually I ended up using a VPN to bypass all these restrictions 😅. But it wasn't straightforward to find one that worked either. As much as I would have loved to rely on [TunnelBear](https://www.tunnelbear.com/) (because come on, how cute is that bear?), [LetsVPN](https://letsvpn.world/?hl=en) was the only one I found working reliably. But I didn't manage to get it working on my laptop, so I was limited to using [Tor with private bridges](https://bridges.torproject.org/) for a couple of weeks.

I was also surprised to see such few foreigners around. Even when visiting tourist hot spots, most people seemed to be Chinese coming from other regions. Furthermore, seeking online information didn't produce many results unless we searched in Chinese. Even some information on Google Maps is straight up wrong. For example, on our last day we wanted to store our luggage in some lockers. Searching online, it seemed like [there just weren't many lockers in China](https://www.reddit.com/r/travelchina/comments/1d65pwh/comment/l6qblxu/). But it ocurred to me to browse AliPay's mini-apps, and lo an behold, there was an app just for this purpose, called LuggaGo. We could find hundreds of lockers, most of them operated with the phone, and you could even see how many spaces were available from the app.

Finally, we concluded our trip by coming back to Europe in one of the best airline companies I've ever used, Hainan Airlines. Even their [safety instructions video](https://www.youtube.com/watch?v=GwUD0awD06E) was awesome! We actually landed in Rome, and made our way back home on land. But I've already visited Italy and France many times before, so I don't have many news to share there :).

<details>

<summary>Pictures</summary>

<figure>
<img src="/img/tasks/sabbatical/shanghai-battery-packs.jpg" alt="Mobile battery packs for rental in the middle of the street.">
<figcaption>
Yet another example of China's modernity, rental battery packs in the middle of the street. Which you rent using a QR code, of course.
</figcaption>
</figure>

<figure>
<img src="/img/tasks/sabbatical/shanghai-bike-battery-packs.jpg" alt="A motorbike carrying a portable battery pack station.">
<figcaption>
... and you can find these everywhere. Like attached to a bike anywhere in the street. 
</figcaption>
</figure>

<figure>
<img src="/img/tasks/sabbatical/beijing-great-wall-cat.jpg" alt="A cat atop the Great Wall of China.">
<figcaption>
Yep, even atop the Great Wall of China you can find cats :).
</figcaption>
</figure>

<figure>
<img src="/img/tasks/sabbatical/beijing-maliandao-tea-market.jpg" alt="Statue of a man drinking tea.">
<figcaption>
A <a href="https://en.wikipedia.org/wiki/Lu_Yu" target="_blank">Lu Yu</a> statue outside a Tea Mall in Beijing's Maliandao street. You read that right, <em>a tea mall</em>. 3 floors full of tea shops. One of my favourite places of the trip :D.
</figcaption>
</figure>

<figure>
<img src="/img/tasks/sabbatical/home-gaiwan.jpg" alt="A Gaiwan tea set in my desk.">
<figcaption>
Finally back home, I'm looking forward to using my new Gaiwan set whilst I work. If you don't know what that is, check out <a href="https://notesonwork.transistor.fm/episodes/how-to-drink-tea" target="_blank">how to drink tea</a>.
</figcaption>
</figure>

<figure>
<img src="/img/tasks/sabbatical/home-hobbit-hole.jpg" alt="A Christmas hobbit hole figurine.">
<figcaption>
This year's Christmas decorations will feature a Christmas hobbit hole from the <a href="https://www.wetaworkshop.com/" target="_blank">Wētā Workshop</a>, next to a <a href="https://en.wikipedia.org/wiki/Gr%C3%BDla" target="_blank">Grýla</a> statue from Iceland.
</figcaption>
</figure>

</details>

### Tech Stuff

Following up from my last update, I finished adding ActivityPods support to my [Ramen](https://ramen.noeldemartin.com) app. I didn't end up implementing everything, such as ActivityPub's inbox/outbox, because I think that's too far from Solid's concerns (and hopefully, it won't be a requirement in the future). But for the most part, it works.

I'll be completely honest here, I was somewhat let down :(. I had high hopes for this project, given that it was heralded as "[the most actively developed open source Solid project](https://forum.solidproject.org/t/inrupts-data-wallet/7836/10#:~:text=I%20have%20high%20hopes%20for%20activitypods%2C%20which%20is%20currently%20the%20most%20actively%20developed%20open%20source%20Solid%20project)", I'm super excited about the fediverse, and [their official compatibility report](https://activitypods.org/specs/solid) painted a very hopeful picture. However, the experience I've had working with the platform has been very different.

I found many incompatibilities that weren't listed on their documentation, such as using Turtle or creating documents with multiple subjects (things that are the bread and butter for any Solid developer). Some of these I would even say were misleading, because the [section about formats](https://activitypods.org/specs/solid) in their docs clearly says "We support both JSON-LD and Turtle format". I'm also not a big fan of the architecture. For example, they rely on [prefix.cc](https://prefix.cc/) to validate (and enforce!) vocabularies, they assume client applications have a backend component (mines don't), and working with localhost or private networks is impossible because they rely on external services such as `prefix.cc` (which was an issue in my case, given that I was often working offline or with connectivity issues).

What I can say, though, is that my interactions with the ActivityPods team have been excellent, and they have been very helpful in solving my doubts and [sharing their expertise with the community](https://forum.solidproject.org/t/integrating-activitypub-within-solid-specs/8355). I also think it's natural that this happens, because ActivityPods is definitely a fediverse-first project, and they're still working on the Solid compatibility. I don't think my current opinion of the project matters too much either, given that I probably tried it too early. They [have finantial support](https://nlnet.nl/project/ActivityPods/), and many of the issues I raised are things they are aware of. So I'm looking forward to see how it evolves, and overall I'm still excited about it :).

If you care to learn more about the specifics, you can check out my entire report: [ActivityPods Compatibility Report](https://github.com/NoelDeMartin/ramen/blob/main/docs/activitypods.md).

Since I had to deploy yet another live server for this, I also used the opportunity to continue exploring my "[headless architecture](https://noeldemartin.com/tasks/housekeeping-2023#comment-3:~:text=I%20came%20up%20with%20is%20basically%20a%20Docker%2Ddriven%20architecture%2C%20with%20something%20I%27m%20calling%20%22headless%22%20deploys%2C%20and%20served%20with%20nginx%2Dagora.)". I may write something about this in my blog at some point, but if you're curious about it, check out [the source code](https://github.com/NoelDeMartin/rem/). Basically, I have [one script that publishes a Docker image to DockerHub](https://github.com/NoelDeMartin/rem/blob/main/.github/workflows/dockerhub.yml), and [another that mirrors the docker-compose config and folders into a `headless` branch](https://github.com/NoelDeMartin/rem/blob/main/.github/workflows/headless.yml). With this, I can deploy my applications in the server by cloning the `headless` branch, and exposing it to the internet alongside other services using [nginx-agora](https://github.com/noelDeMartin/nginx-agora). Which should make switching servers in the future very easy.

Finally, as a last minute addition, I created a [Peertube channel](https://spectra.video/c/noeldemartin/) where I'll be uploading my videos (the same I've been uploading to [my Youtube channel](https://www.youtube.com/@noeldemartin)). I don't particularly enjoy the UX of Peertube, but I think it's really cool that it's part of the fediverse and it is completely interoperable :D. For example, I'm following the `#solid` tag in the fediverse, and I can see when [Angelo](https://angelo.veltens.org) releases one of his [Practical Solid videos](https://tube.tchncs.de/c/practical_solid/videos).

### Conclusion

At the beginning, I said that this would be "a simulation for my retirement". But I have to confess that I've failed miserably 😅. Or at least I hope so, I wouldn't want my retirement to look anything like this!

I like traveling, and I like having new experiences. But I don't like feeling like a tourist, and that's basically what I've done for the last 3 months :/. I also don't like traveling _too much_, and in these last 3 months we've changed city every 2.79 days on average 😱. If anything, this trip has made me realize how much I enjoy my usual routine, even when working on a 9 to 5 job.

But before I continue, there is something I have to address. You may be wondering, if I dislike this frantic lifestyle so much, why didn't we slow down? Well, they key here is in the "we". I didn't travel alone, and my girlfriend enjoyed it tremendously. At no moment did she force me to do any of this (nor is she forcing me to write this xD), and multiple times I had the chance to stay somewhere by myself to meet her later on. But I made the conscious choice to follow her pace, even if [I wasn't completely confortable with it](https://en.wikipedia.org/wiki/Comfort_zone), because I agree with her that we probably won't have the opportunity to do this again.

So yeah, nice experiment, I'm glad I did. But I hope I never have to go through that again. I'm still going to have holidays, of course. And I'm perfectly fine with doing this for shorter periods of time. But even if I had the chance to live like this fulltime, I don't think I'd want to. On the other hand, I look forward to continue experimenting with [mini-lives](https://kadavy.net/blog/posts/mini-lives/) in the future.

Also, it's not like I completely slacked off! I couldn't focus as much as I'd like, and I didn't work on any big projects. But this gave me the chance to work on small proofs of concepts and experiment. That is something I hope to continue doing in the future. Sometimes I focus so much on [years long projects](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid), that I forget to take a breath and explore other things.

Here's a summary of everything I did during the trip:

- I built a Solid Server from scratch: [LSS](https://github.com/noelDeMartin/lss).
- I submitted 3 proposals for [NLNet's October call](https://nlnet.nl/news/2024/20240601-call.html) (I'm still waiting to hear back from them, btw 😅).
- I explored new tooling and folder structure for my packages, and implemented my own animations library: [Vivant](https://noeldemartin.github.io/vivant/).
- I played with [NotebookLM](https://notebooklm.google.com/) and [RSS stylesheets](https://www.rss.style/), publishing my first (and maybe last) [podcast episode](https://noeldemartin.com/podcast/feed.xml).
- I learned more about [SAI](https://solid.github.io/data-interoperability-panel/specification/), and added [ActivityPods support](https://github.com/NoelDeMartin/ramen/blob/main/docs/activitypods.md) to [Ramen](https://ramen.noeldemartin.com).

Not bad!

What I _haven't_ done, though, is figure out what to do with my life :/. Regardless, I think that's enough of taking it easy. I'll be enjoying Christmas and New Year like normal holidays, but in January I should be back to work. Stay tuned!
