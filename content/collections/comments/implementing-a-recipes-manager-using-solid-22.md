---
id: implementing-a-recipes-manager-using-solid-22
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 22'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2023-01-20 12:21:13'
---

The day has finally arrived, I'm finally closing this task!

Like always, there was more work than I expected. But thanks to having [a real deadline](https://fosdem.org/2023/schedule/event/sovcloud_from_zero_to_hero_with_solid/), I've used the scope hammer like never before.

One of the things that fell by the wayside was documentation :(. Usually, I write some documentation for my apps in case anyone is interested in the technical details. But if I have to be honest, I'm not sure how helpful that is anyways (or if anyone's even read it). So this time, I didn't do any of that for Umai. But I've updated `soukai` and `soukai-solid` for the new versions, so it isn't like the documentation is completely out of date. In the future, I intend to consolidate all my apps into some kind of framework, so I'll probably work in better documentation at that point.

I've also been translating the app into Spanish and Catalan, which was more work than I expected. The good news is that after a first sitting, I don't think it'll take me a lot of work to maintain. I also wrote a small [translations contribution guide](https://github.com/NoelDeMartin/umai/blob/main/docs/contribute-translations.md). It's the first time I'm doing this and from personal experience, I'm not very happy with [community-contributed translations](https://lang.moodle.org/). So we'll see how that goes.

I've also been working on implementing an [Application ClientID](https://solid.github.io/solid-oidc/#clientids). I wasn't too happy about this, because I've been making the app in a way that can run in any domain (even localhost). So I don't like the idea of having to tie an application with a url. After some thought, though, I realized it isn't that different from a [Web Manifest](https://developer.mozilla.org/en-US/docs/Web/Manifest). So I implemented it similarly (by the way, I did write [my first Vite Plugin](https://github.com/NoelDeMartin/umai/tree/main/src/framework/vite-plugin-solid-clientid) for this, and I have to say it was super easy — it definetly deserves coming out on top in the recent [State of JS survey](https://2022.stateofjs.com/en-US/awards/) :D). But in the end, it wasn't as nice as I wanted. With a Web Manifest you can use relative urls, but ClientID documents require the `client_id` field to be absolute. Which means that if anyone wants to self-host Umai, they'll have to [build it themselves](https://github.com/NoelDeMartin/umai/blob/main/.env.example#L3), instead of just downloading a .zip file :(. In any case, that's done!

So, before closing this task, I wanted to do some reflections [like I did for Media Kraken](https://noeldemartin.com/tasks/implementing-a-media-tracker-using-solid#comment-10).

I haven't been tracking time spent as closely, but one rough estimation gets me to 1000 hours O.o. In contrast with the 278 I spent for Media Kraken, it's almost 4 times as much. The scope for this was a lot bigger though: Vue 3, Vite, CRDTs, Offline First, Page Transitions, Files Upload, Permissions Management, Requests Proxy, Custom Ontology, etc. But if I translate that to full-time work, it comes out to about 6 months. That's definitely a non-trivial amount of time. Does the end result justify it? Well, I'm very happy with the app, but probably not. If I have to get anything out of this, it's that I overegineer too much. Which I already knew, but I think it's time to start taking it seriously. The good news is that I don't think I'll be tackling anything more complicated than Solid CRDTs in my upcoming endeavours. But then again, I also thought I was done with complexity when I finished Media Kraken.

Something else I talked about last time was my opinion of the Solid Community. Sadly, I can't say things have improved too much. I've had a much better experience with Solid this time around, but that's because I've been using my own libraries (and I'm biased). [CSS](https://github.com/CommunitySolidServer/CommunitySolidServer) has also come out, which has been pleasant to use. But other than that, I don't see much improvement in the overall DX, and [things seem to be moving as slowly as ever](https://forum.solidproject.org/t/is-a-solid-pod-a-set-of-documents-or-is-it-a-knowledge-graph/6028/4?u=noeldemartin). I also haven't seen any new apps I'm excited for. If anything, [I've been disappointed](https://forum.solidproject.org/t/implementation-of-bbc-together-data-pod/5763/35?u=noeldemartin).

But I don't want that to sound discouraging. Even with all that, I still think Solid is the best approach we have to making apps. Or at least, the type of apps I want to make (and use). The fundamentals are there, so I don't think there's anything stopping anyone from getting into Solid; even if their introduction isn't as smooth as I'd like. So I'll continue using Solid, and I'm still excited about the future.

And that's it for now! Feel free to spread the word, [Umai](https://umai.noeldemartin.com) is out!
