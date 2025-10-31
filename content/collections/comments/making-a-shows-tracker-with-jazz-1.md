---
id: making-a-shows-tracker-with-jazz-1
blueprint: comment
title: 'Making a Shows Tracker with Jazz - 1'
task: 'entry::making-a-shows-tracker-with-jazz'
publication_date: '2025-10-31 17:21:00'
---

So yeah, this won't be a Solid App 😅. I've already talked about [why I'm leaving Solid aside (for the time being)](https://noeldemartin.com/tasks/making-a-web-application-framework#comment-14); but TLDR I'm facing some performance issues with my current tooling, and I don't have the time nor motivation to solve them. Instead, I've decided to build this one app with a different stack. It should serve both to solve my current problem, and to see how other ecosystems are doing.

Now, when I started to think about this, there were other contenders to choose from. The first one was [NextGraph](https://nextgraph.org/), given that it has first-class support for RDF, and I've been following the project for a couple of years. However, looking at the documentation and resources, it doesn't seem to be ready yet. It would be fine if I just wanted to tinker with it, but I'm actually trying to build a "real app" here, and the point of not using Solid is to make my life easier. So I'm looking for a more mature solution.

Another project I considered was [Convex](https://www.convex.dev/), which seems promising and I've seen it recommended a couple of times. Unfortunately, it doesn't seem ideal for local-first apps, and I'm not willing to give that up. Apparently, [it can be used with Automerge](https://stack.convex.dev/automerge-and-convex), but that seems more like an idea than something anyone is working on for real.

So, Jazz it is. The main thing that caught my attention is their focus on developer experience. Honestly, it's very similar to what I'm trying to achieve with [Aerogel](https://aerogel.js.org/): help people make local-first apps without having to think about any of the technical details. They don't even mention "CRDTs" in the landing page! Also, their whole approach to defining schemas is very [Zod](https://zod.dev/)-centric, and I've had a great experience working with Zod so far.

But it's not all sunshine and roses. By using Jazz, I'll have to sacrifice [one of my most revered ideals](https://noeldemartin.com/slides/local-first-solid-and-everything-in-between?slide=19): Interoperability 😱. We'll see how it goes, but given this limitation I don't think I'll be working with Jazz a lot in the future, even if I like it. I'm also not looking forward to managing yet another service, but I'm totally going to self-host the backend (or "sync engine", as they call it). Thanks to that, I may be able to get something done with Solid... But for now, that's completely outside of the scope. The biggest bummer here is that I wanted to eventually bring this functionality to [Media Kraken](https://noeldemartin.github.io/media-kraken/), and finally make honor to its name (it's called Media Kraken, not Movie Kraken). But that will have to wait. I just want to get my Shows Tracker done, and take a break from having to developing my own tooling.

On that note, though, there is yet another impediment... They don't have Vue support 😱😱. So I'm at a crossroads now. Should I use React, and see what life is like on the main stage? (even though I've used React before, and I don't like it). Or should I give Svelte a try, which I've been wanting to do for a while? Honestly, I don't know. Maybe this will be the first part of my experimentation, to try a bit with both and see how things go.
