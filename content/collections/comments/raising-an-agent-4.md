---
id: raising-an-agent-4
blueprint: comment
title: 'Raising an Agent - 4'
task: 'entry::raising-an-agent'
publication_date: '2026-09-23T19:11:00+02:00'
---

Hey hey!

It's been a while, but I finally have a couple of things to report. Today, I have some good news and bad news. So let's get the bad ones out of the door: my NLNet proposal for Ànima got rejected :(.

I hadn't mentioned it here, but a few months ago I decided to apply for yet another grant (this is my 4th attempt). This time it didn't even make the first cut 😅. Honestly, I don't have a lot more to say about NLNet that [I haven't said already](https://noeldemartin.com/blog/the-soul-crushing-reality-of-job-seeking#the-nlnet-fiasco), but TLDR [their selection process is very sketchy](https://noeldemartin.social/@noeldemartin/114745305327263276). I'm still a bit baffled that they have rejected all 4 of my proposals (specially considering that they're still supporting a bunch of projects in the Solid ecosystem), but at least this time it wasn't as much of a surprise.

Anyhow, at this point I don't know if I'm going to waste my time with NLNet anymore, but if you're curious you can read the proposal for Ànima here: <a href="/downloads/nlnet/anima.pdf" target="_blank">Ànima NLNet application</a>.

A short summary of that document is that I wanted to give Ànima the ability to "vibe code" Solid Applications, but following a more structured approach than just a chat interface; and supporting local AI models. I still want to do that, but honestly without the proper funding I'm not sure how far I'll be able to take it on my own.

But that's enough of bad news, here's the good news: Ànima now has a logo and a Desktop application! (yeah, sorry, they aren't as good as the bad are bad 😅).

I have finally been able to dedicate some time to this project, and even though I haven't done much, I laid the foundations for something that I think is very nice: allowing Ànima to serve a managed POD. Right now, I'm using the [Community Server](https://github.com/CommunitySolidServer/CommunitySolidServer), but everything is abstracted away from the users so I could potentially change the implementation (though I doubt I will). This is great, because with this it finally makes sense to distribute Ànima as a Desktop application. You install it in your computer, and once it's running you have a local POD that you can use to interact with Solid apps, as well as talking with the AI. Potentially, all of it without leaving your device. For now, this only works for SPAs (like all of my apps!), but I could come up with some way to work around this in the future (using something like [Tailscale](https://tailscale.com/)).

Also, more important (?), we've got a logo! Honestly, I don't _super_ love it; but it's pretty nice and definitely better than no logo. If you followed [my journey with Umai](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid#comment-14), you may already be aware of my struggles with logos and naming... So it's not completely impossible that this will be the "final" logo as well.

But that's enough preamble, here it is:

![Ànima logo, a couple of blobs representing the "À" letter + the rest of the letters with a pink to white gradient](/img/tasks/raising-an-agent/anima-logo.jpg)

I'm aware it doesn't look great like this, and I'll definitely want to polish it if I ever make a "real" release of this; but I like the general idea, and the app icon looks pretty decent on its own (just the "À" part). For now, I'm quite happy with it! The rest of the app's UI is pretty bad though, but I'm not sure when I'll get around to make it better 🙈.

If you want to give Ànima a try, now you can also [download the native binaries](https://github.com/NoelDeMartin/anima/releases) to install the Desktop app (still very WIP, though!).

And that's mostly all for today. I also kept experimenting with my AI development workflow, though it hasn't changed much. Here's a couple of notes on that:

- I'm still using pretty much the same workflow as I mentioned last time, which is basically talking with CLI-based LLMs to complete tasks. Though I'm multitasking ever more often (much to my chagrin), and something that dramatically improved the "Agentic Experience" was starting to use multi-repository workspaces (I also published [a Vite plugin](https://github.com/NoelDeMartin/vite-plugin-multi-root-workspace) to help me with that).

- I started publishing a series of blog posts called [Programming Patterns](/blog/programming-patterns), which comes with a brand new [skills repository](https://github.com/noeldemartin/skills) (and I'm still using the ones from the [ai repository](https://github.com/noelDeMartin/ai)).
