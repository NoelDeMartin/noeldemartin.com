---
id: implementing-a-recipes-manager-using-solid-5
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 5'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2021-04-10 08:35:12'
---

Since my last update, I've been thinking on what to work on next. Something that's been nagging me for a while is that the authentication workflow I have in Media Kraken is not great. I realized it when I prepared the demo for [my Solid World presentation](https://vimeo.com/508623332#t=666).

The basic idea is that a user would start using the app with browser storage, so far so good. But then, when they want to move to Solid, they have to download a json, log out, log in, and import the json. That isn't so bad, but it's definitely more cumbersome than it should (and for some people it'll be a barrier). It's also annoying that even though the app works mostly offline, opening the app takes ages in mobile, because it reads the entire movies container at launch (and I have 1671 movies in my collection at this point). This was probably solved after [NSS#1460](https://github.com/solid/node-solid-server/issues/1460) was closed, but I'm still using an old version of NSS (and my mobile phone is also quite old). But I'm in no rush to upgrade, after all that's how I notice these things.

Thinking how to improve this situation I brushed up on some ideas I had on my backlog. And now I am convinced that offline-first is the solution to these problems. In Umai, users will be using browser storage by default, and they'll be able to add synchronisation backends (for example, Solid). Reading about this topic, I came across some interesting concepts like CRDTs (and some funny encounters, like [leap seconds](https://en.wikipedia.org/wiki/Leap_second)). In particular, I enjoyed a lot an article about [Local-first software](https://www.inkandswitch.com/local-first.html).

So now it's almost certain that the next cycle will be focused on making Umai offline-first. But I don't think I'm ready to start yet, so I'll spend some indefinite ammount of time (hopefully not too much) [shaping the work](https://basecamp.com/shapeup/0.3-chapter-01#shaping-the-work). I've already started some of the shaping process, and I opened a couple of posts on the Solid forum to get feedback. If you're interested in participating, check out these posts:

- [Authenticating Offline-First Solid Apps](https://forum.solidproject.org/t/authenticating-offline-first-solid-apps/4208)
- [Request for Comments: CRDTish approach to Solid](https://forum.solidproject.org/t/request-for-comments-crdtish-approach-to-solid/4211)
