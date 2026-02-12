---
id: implementing-a-recipes-manager-using-solid-14
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 14'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2022-02-28 20:25:00'
---

Here we are, February 28th, a day after the end of the cycle. And the app is... not finished! Who's surprised? (not me, to be honest). All jest aside, it has become a pattern that I don't finish tasks as "estimated", and therein lies the crux of the issue, if I were following the [Shape Up](https://basecamp.com/shapeup) methodology properly I wouldn't need to follow estimations, I would cut the scope instead. The thing is, that I don't want to cut the scope any more than I have already done it, which is a lot. If you look at the app as it stands today (and Media Kraken, for that matter), you cannot say it has a huge scope when it comes to functionality. But if you start looking under the hood, you'll see there is a lot more than the eye can see.

So if it doesn't have a lot of functionality, what is taking so long? Complexity? In part yes, but if I had to reduce the reason for most delays to one word I would say "experimentation". The truth is that I rarely just implement a feature, I'm always refactoring and creating new patterns. Because I like doing it, and because I think eventually this will save me time. But to be honest, I don't care if it doesn't, I enjoy the process in and of itself. That's one of the freedoms I have since my livelihood does not depend on this.

In any case, having said that, I do want to get this done and move on to other things. So here's what I've done the past 6 weeks and what is left to consider the app production ready (which doesn't mean release, but I still haven't started using it myself either).

These weeks I've been working mostly on onboarding and login/sync. The basics were already there before, but I've been ironing out a better UX. For example, it's now possible to configure how often data is synced and if the app should reconnect automatically in every log in or not. And the coolest thing I've been doing is implementing importing recipes from the Web. Yes, you read that right, the Web. Anywhere on the Web :D. There is a lot of linked data in the wild used for Semantic SEO, and recipes are one of the most common. This is a clear example of something totally out of scope, and that I don't need personally. But I started tinkering with it and got so excited that I couldn't help myself. I still have to iron out some quirks, and I'm still pondering whether I should use a proxy or not to work around some [CORS](https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS) issues. But the core parsing is done and seems to work well enough.

I initially thought about having a Recipes Library built-in, and it's actually implemented in the app as of now. But I'm second-guessing if it makes sense or not, now that importing from the Web is supported. There are two main problems with it. The first one, is that I don't want to have so many options for creating a new recipe because that will be confusing (there are 4 at the moment: from scratch, from the Web, from the Recipes Library, and uploading a JSON-LD file). And the second one, maybe more important, is that I don't know what recipes to include. <a href="https://noeldemartin.com/recipes/aguachile" target="_blank">I have some recipes myself</a>, but I'm not sure what would be a decent minimal cookbook for most people. So I'll probably drop this one.

I've also been working on some other small things, but nothing specially interesting comes to mind. You can always look at [the commit history](https://github.com/NoelDeMartin/umai/commits/main) if you're curious of what I'm doing exactly, the commit messages should at least give you an idea.

Given the current state, I've decided to stop doing Shape Up until I have a version that is production ready. I don't know how long that will take, but I really think I'm not far off. Here's a list of the main things remaining:

- Recipes sharing
- Review overall UX/UI
- Review a11y
- Fix Mobile layout
- Smooth transitions/animations
- Smooth onboarding experience
- PWA configuration
- [http vs https schema.org handling](https://github.com/linkeddata/rdflib.js/issues/550)
- Vue ecosystem review (I started this project a while ago and Vue 3 is stable now, so I want to make sure that I'm following the latest best practices)

As you can see, there arem't really any features left to implement other than recipes sharing, just a bunch of ironing out. So once I add some form of sharing, I'm putting my Getting Things Done hat on.
