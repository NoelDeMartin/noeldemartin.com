---
id: implementing-a-recipes-manager-using-solid-13
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 13'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2022-01-14 11:19:04'
---

Hi there!

I'm back from Christmas break, and I was AFK for a couple of weeks so I'm eager to pick up where I left off. I recently looked at my [Last Year's Achievements](https://noeldemartin.social/@noeldemartin/105525557154075833), and even though I didn't manage to complete most of my New Year Resolutions for 2021 (like closing this task 😅), I'm very happy with everything I accomplished. But this year, for sure, I will release this app!

Before going into the next cycle, here's some updates. First of all; naming. I was still struggling with this, but ultimately I decided to stick with Umai. I'm still not 100% convinced, but I didn't make any progress and I don't see an end to the rumiation. I can always change it later if inspiration strikes, but I'm not going to waste any more time on this. [Umai it is](https://www.youtube.com/watch?v=_OJGP9DNCVk).

Once I settled on the name, I started working on the logo. At first it was going great, because I had the idea of using the "U" from Umai as a bowl, but it hasn't translated into something I'm happy with so I'm still playing with the idea. I think this may turn out like the name itself, I don't love any of the choices so far but in the end I'll have to stick with one. In case you're curious, here's some early drafts without context nor explanation:

![Umai logo drafts](/img/tasks/umai-logo-drafts.jpg)

If I have to be honest, all of this is a bummer because even though I'm no designer this part of making products was one of the most enjoyable for me. But for this app, it's been a struggle so far. I guess [that's life](https://noeldemartin.com/blog/you-cant-always-get-what-you-want) though.

But not everything has been a struggle! In my last update, I hadn't started working on forms and what I had in mind was very different to what I ended up doing. Initially, I thought forms would be separate screens/modals, but the more I worked on them, the more I realized that using the same layout was actually a decent option. The idea is that when you try to edit a recipe, you'll see the same layout but data will be editable. I could even make everything editable by default, but I don't think that's a good idea at this point. Something that worries me is that people may not realize how this works, so maybe I'll end up implementing some guided tours (although I'm generally averse to adding those).

Something funny (if you can call it that) that happened implementing these forms is that I made ingredients sortable and instructions unsortable. My idea was that you are not going to change the order on some instructions, but you may sort ingredients by quantities or something else. But later on, I realized the data was actually modeled the other way around (ingredients don't have an order whereas instructions do). Ideally, though, these are just UI affordances, but I'd like both lists to have an order. This is something [I already talked about](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid#comment-9), and I still haven't found a good solution.

Something else I realized recently is that just because I'm using `schema.org`, it doesn't mean that my apps will be [interoperable out of the box](https://noeldemartin.com/blog/interoperable-serendipity#intentional-interoperability). I have been using `https://schema.org/` as the prefix, but turns out that [some apps out there are using `http://schema.org`](https://github.com/solid/solid-namespace/issues/21). So that's a problem, even with Media Kraken. I may tackle this before I release the next version of `soukai-solid`, but since I don't know how much of a problem this really is, it won't be a priority for now (is there an app that would interoperate properly after fixing this anyways?).

Finally, the last thing I want to mention is [a11y](https://en.wikipedia.org/wiki/Computer_accessibility). Some months ago I started learning about it at work, and I've realized how bad of a job I am doing in my other apps. So I want to improve it for this one. The problem is that I don't use the web like a disabled person would. And it's very difficult for me to walk in their shoes and understand what's important and what isn't. Reading about [WAI-ARIA Authoring Practices](https://www.w3.org/TR/wai-aria-practices/) and such is helpful, but I'm still not sure of what I'm doing wrong. That's why, when I [tooted about my last update](https://noeldemartin.social/@noeldemartin/107350733886792335), I included some text only visible to screen readers asking for help. And you can imagine my surprise when [someone offered](https://dragonscave.space/@zersiax/107542905769470805) :D. That will be fun. I want to be respectful of their time, so I won't be asking for a lot of details. But just knowing if the app works or it sucks will be very useful.

Now, it's time to talk about the next cycle. I have been working on this app for a long time. Too long, in fact. So I have to start wrapping up the initial release already. However, doing a release encompasses more work than it seems. I have to write the documentation, publish the new vocab I've created for history tracking, release and document all the changes in soukai, etc. And I'm still missing some features that I consider essential for release: error reporting, onboarding, etc. In my opinion, setting the sights on release for the next cycle would be too premature. But I just said that I've been working on this app for too long. So what I decided is that in the upcoming cycle, I'll finish the app, without actually doing a release. That way, I can do a "release candidate" of sorts. I will start using the app in production myself, and ask early adopters for feedback; but there won't be any guarantees of stability. In the next cycle, I'll aim for release and use it to document and iron out the bugs that I find during testing.

That's what the next cycle will be about. I'm starting today and it should be finished by February 27th.
