---
id: implementing-a-recipes-manager-using-solid-7
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 7'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2021-05-30 11:06:01'
---

Today is the end of the cycle I mentioned in my previous update, and here's the current status of the project:

![Hillchart 2021/05/30](/img/tasks/hillchart-2021-05-30.png)

Yeah, I have barely advanced in a month and a half. Turns out that building the proof of concept for real was more work than I expected. But the real problem have been [yaks](https://antfu.me/posts/about-yak-shaving).

This [is not the first time that this happens](https://noeldemartin.com/tasks/implementing-a-media-tracker-using-solid#comment-8), but I intended to avoid it by following the Shape Up methodology. At the time, when I got stuck building Media Kraken, I referred to these yaks as \"rabbit holes\". The interesting point is that [this is mentioned explicitly in the Shape Up book](https://basecamp.com/shapeup/1.4-chapter-05#look-for-rabbit-holes), and I thought I was guarding against it by doing the proof of concept during the cooldown. Who could have guessed that it would take me almost 6 weeks (working 1 day a week!) to clean up something that I put together in a couple of hours :/.

But as I mentioned, the real problem here have been yaks. However, as I argued the last time, I'm in no rush and I enjoy the process so \"It'll be done when it's done\" :). To be honest, I don't think this will happen too often, because it isn't every day that I embark into a new paradigm like offline-first or CRDTs. And I still think the Shape Up methodology is useful, so I'll consider this cycle done and go into cooldown. Maybe the next cycle will come out of the leftovers from this one. But maybe not, and that's the point.

So, what did I actually do all this time? Inspired by [this tweet](https://twitter.com/antfu7/status/1396255455358328835) by Anthony Fu, here's my own Yak Map:

![Offline-first Yak Map](/img/tasks/yak-map-offline-first.png)

As you can see, there were more things going on than I anticipated. To be frank, the Cypress tests and jest/chai plugins were completely optional. But I'm sure I'll use those for a lot of my projects going forward. Something cool I've been doing here is that I'm using the [community-server](https://github.com/solid/community-server) in my CI pipeline, so the integration tests are now running against a real Solid server. This is particularly useful here given that Umai uses two engines at the same time, one local (for offline-first) and one against a Solid POD (to sync on the background). You can find the tests [here](https://github.com/NoelDeMartin/umai/blob/main/cypress/integration/cookbook.spec.ts#L45) if you want to see some code.

I found this concept of a Yak Map really interesting, and it speaks to what I have been doing for a while. Here's the Yak Map with my latest projects:

![Projects Yak Map](/img/tasks/yak-map-projects.png)

What I really want to do are apps, but I ended up developing a bunch of libraries and packages. Which is cool, it's also my own fault because I have an acute case of the [NIH syndrome](https://en.wikipedia.org/wiki/Not_invented_here).

PS: I have also been [translating Penny](https://gitlab.com/vincenttunru/penny/-/merge_requests/3) to Catalan and Spanish! Penny is a POD browser for Solid developers, so check it out and maybe you can contribute your own translations (there isn't a lot of text). It was interesting to see how to translate a Solid app, because there are some Solid terms that I had only come across in English. This has also been useful because I'll definitely localize my apps at some point. But for now, that'll remain a hairy Yak.
