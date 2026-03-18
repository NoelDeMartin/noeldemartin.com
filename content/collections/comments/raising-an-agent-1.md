---
id: raising-an-agent-1
blueprint: comment
title: 'Raising an Agent - 1'
task: 'entry::raising-an-agent'
publication_date: '2026-03-18T17:55:00+01:00'
---

Lately, it seems like AI is everything, everywhere, all at once (online). [I don't like it either](https://nolanlawson.com/2026/02/07/we-mourn-our-craft/), but after much resisting I think it's time to embrace it. However, I'll do it in my own terms!

Now, I don't know how far I'll take this, because the goal is obviously open-ended. But this time, I've decided to start the task a little differently: I already have the first version online 🤯. It's still very early, and nothing more than a prototype, but if you're keen to see how it's going, check it out: [anima.noeldemartin.com](https://anima.noeldemartin.com).

So, what is Ànima?

Right now, Ànima is just an interface to chat with different AI models, using your Solid account. It'll store the conversations in your POD, and give the models access to your entire storage. Make sure not to expose it to models you don't trust! In fact, I don't recommend using it with a real POD yet... so maybe just point it to a development POD if you're curious.

At the same time, this is what Ànima doesn't do (yet):

- Write to your POD (it is read-only).
- Communicate outside of the browser or the AI model (it can't leak your information).

All in all, it should be relatively safe to play with. Ideally, something like this would be used mostly with local models. But there's nothing stopping you from connecting it to 3rd party providers.

However, this is only the beginning :). I do intend to make it an agent eventually (meaning, it should be capable of performing long-running tasks), and communicate with the outside world. I'd also like to make it capable of creating apps (using [Aerogel](https://aerogel.js.org), of course). But other than that, I'm not sure where I'll take it.

Something cool I've been thinking about is that this could solve [the biggest problem in the Solid ecosystem](https://noeldemartin.com/blog/why-solid#lack-of-pod-providers-in-b2c) (in my opinion). The current version is a simple SPA, which means that everything is happening in the browser. But ideally, I'd like to install this on a server or a personal computer. The more I think about it, the more I'm convinced that this is the perfect use-case for a Solid POD. Imagine a Solid POD that is easy to install anywhere, and comes with an AI assistant built-in that is private by default. Yes, this sounds a lot like [Charlie](https://www.w3.org/DesignIssues/Charlie.html) :).

Now, let's talk a bit about technology choices.

Initially, I was very excited to start using Laravel again, because this was going to be primarily a server-side thing. But then the [Laravel AI SDK](https://laravel.com/docs/13.x/ai-sdk) came out, and it didn't support local models :/. They have added them since, but the support is still limited and by that point I had already moved on. Instead, I started using [Vercel's AI SDK](https://ai-sdk.dev/). And so far, it's going great. I've been able to release the app as an SPA, which hadn't even crossed my mind. I'm pretty sure some upcoming features will need to live outside of the browser, but it's very cool that this was possible!

In order to manage the server-side stuff, I also started playing with [Tauri](https://tauri.app/). Yes, when I say "server-side", I also mean a personal computer. The idea is that you should be able to install Ànima in your own computer, without knowing anything about servers or CLIs. As I was working on this, Tauri became a bit overwhelming soon, with builds that take 30 minutes and 8GB+ of disk space (in build assets, not the final artifact). After some research, I came across [Electrobun](https://blackboard.sh/electrobun/docs/), which is a very new project that looks promising. I still haven't done much of the native stuff; but I don't think I'll need to, given that this app is basically a wrapper for a node server.

Other than these two, I don't think there is anything else too different from apps I've built before. I'm back to using Vue for the frontend, I am using Aerogel and Soukai for most of the Solid stuff, and I'm playing with all of Vite's new tooling (oxlint, oxfmt, etc.). Maybe something worth mentioning is Bun and [ElysiaJS](https://elysiajs.com/). I hadn't used Bun a lot in the past, and I have to say it's pretty nice. It even helped me pinpoint a [bunch](https://github.com/inrupt/solid-client-authn-js/pull/4201) [of](https://github.com/inrupt/solid-client-authn-js/pull/4207) [bugs](https://github.com/inrupt/solid-client-authn-js/pull/4208) in Inrupt's auth library. And I was very excited about ElysiaJS at the beginning, but now that I've used it for a while I'm more lukewarm. The type safety seems very nice, but it's a bit quirky to work with. In any case, I'm only using it as a transport layer between the frontend and the backend, but most of the communication is pure Typescript (that's how I managed to deploy it as a plain SPA).

So yeah, that's it, I'm building an Agent! If you have some thoughts about this, definitely let me know.

PS: In case you're wondering, yes, I do listen to Amp's [Raising an agent](https://ampcode.com/podcast) podcast. That's where I got the idea for naming this task :).
