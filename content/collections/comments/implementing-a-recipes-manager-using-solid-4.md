---
id: implementing-a-recipes-manager-using-solid-4
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 4'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2021-03-21 08:10:19'
---

Today is the end of the cycle, and this is where things are at:

![Hill Chart](/img/tasks/hillchart-2020-03-21.png)

In the end, I didn't finish v0.0.1 as I'd budgeted, that's why that scope is not all the way down the hill. But I almost got there, the only thing that's missing is configuring servings. I'm happy with the results, because the part I was interested in was laying out the foundations. And now I can say that Umai exists! It's definetly not finished, definetly not production-ready, but it exists. From now on, I "only" need to improve it.

The work on Soukai Next Generation has moved a bit, but in reality it hasn't changed much since my last update. I had done a lof of refactors and improvements, but I hadn't actually used them anywhere. Now that I'm using them in Umai, I'm more confident that the scope is further downhill.

The part that's changed the most since last time is the framework. I'm writing what I'd consider framework code in [a different folder](https://github.com/NoelDeMartin/umai/tree/main/src/framework), and that's what I'll eventually extract into a package to use across applications. While doing this, I've created a couple of new patterns that I'm very happy with (and borrowed some from my favourite frameworks, like [Laravel's Facades](https://laravel.com/docs/8.x/facades#introduction)). If you look around the source code without going into the framework folder, you'll see there is almost no boilerplate. Most of the code is specific to this application. I'm enjoying a lot working on the framework, and I'm itching to document it and share it with others. But I'll resist the urge, at least until I finish Umai.

These two, Soukai Next Generation and the framework, come together during development in a big way. So far I've been able to work on the app without being bothered about any Solid specifics. Foregoing a POD was already possible using a browser engine from Soukai, and now that I've incorporated the Authenticators pattern I introduced in [Ramen](https://github.com/noeldemartin/ramen), I don't have to use an identity provider either. Soukai isn't perfect, and the framework isn't even a thing. But this is promising because I can see a day where I'll be working on apps without thinking of them as "Solid apps". And that's my end goal, Solid should just be a given.

Going back to planning though, this is where the Shape Up methodology breaks down for me. Seeing this cycle from a pure Shape Up perspective, it's a failure because the only "finished" thing I have is Umai v0.0.1. But to really consider it finished I would need to tag the v0.0.1 version in github, release new versions of all the related libraries ([soukai](https://github.com/noeldemartin/soukai), [soukai-solid](https://github.com/noeldemartin/soukai-solid), [utils](https://github.com/noeldemartin/utils), [scripts](https://github.com/noeldemartin/scripts)), and all that goes with that (like documentation). All of that should have been part of this cycle, but I'll leave it for later. That's ok, though. Nobody is forcing me to be a purist. And I'd be surprised if the guys at Basecamp followed it to a T during the development of HEY. So I'm making the most out of it, and this time I can say it's been really useful because I got something done and I've dropped the vocabs thing that could have become a rabbit-hole (may come back in the future though!).

For the upcoming weeks, I'll use the [cooldown](https://basecamp.com/shapeup/2.2-chapter-08#cool-down) to do some chores in other projects and shape the work for the next cycle. I'm still not sure if the next cycle will be the one where I release the app, but it probably won't. There are many things I still want to do that I consider essential.
