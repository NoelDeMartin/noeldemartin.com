---
id: implementing-a-media-tracker-using-solid-4
blueprint: comment
title: 'Implementing a Media Tracker using Solid - 4'
task: 'entry::implementing-a-media-tracker-using-solid'
publication_date: '2020-03-08 19:17:04'
---

Today's update is not about Solid, because this week I've been working exclusively on the UI. And the funny thing is, I've only finished the header and the logo! But it's been a fun week.

I'm always looking forward to reaching [Flow](<https://en.wikipedia.org/wiki/Flow_(psychology)>) when I'm working. This is a psychological state that is reached when you're performing a task that you enjoy and it isn't too easy nor too difficult. And that's exactly what designing the header and the logo has been like. I reckon I've spent too much time on this, and I've blown up the appetite budget at this point. This week I've also spent more time working on side-projects than usual (~20 hours, and I usually spend ~10). But in a way that's the point of Flow, that you lose track of time.

After thinking about this I've reached the same conclusion [I did a while ago](https://noeldemartin.com/tasks/improving-solid-focus-task-manager#comment-4): this is a side-project and doing the work is not my only goal, I also want to learn and explore. But it's important to balance both, that's why I find these reflections useful.

So, what have I actually learned and explored this week? First, let me show you the results:

**Mobile layout:**

![Mobile layout](/img/tasks/implementing-a-media-tracker-using-solid-mobile-layout.gif)

**Desktop layout:**

![Desktop layout](/img/tasks/implementing-a-media-tracker-using-solid-desktop-layout.gif)

What you see in these two screens is the same html, styled using CSS responsive utilities. And yes, that includes the animations too! I've done similar things in the past but not with so many interactions. This time I've decided to use [Tailwind CSS](https://tailwindcss.com/) without any component framework, and I've also been exploring [Tailwind UI](https://tailwindui.com) that was released this week.

My opinion on Tailwind UI is not great so far, and it pains me to say this because I love Tailwind. It's been really useful for inspiration and to learn some things, but it hasn't been copy & paste as "advertised" (although they admit that you may need to adapt it to your project). One of the worst things has been AlpineJS. It isn't that I don't like it, in fact I didn't know it and it seems nice. But having to adapt it to Vue hasn't been straightforward. I also started with a fairly similar approach to their sample code but I ended up redoing almost everything. I suppose this just means that Tailwind UI is not for me.

If you haven't tried Tailwind please don't be taken back by what I said, Tailwind is awesome and if you haven't used it I encourage you to do so. In the process of exploring Tailwind UI I've also upgraded to version 1.2.0, and I've started using the new transition utilities. Which got me into the rabbit hole that ended with all these animations.
