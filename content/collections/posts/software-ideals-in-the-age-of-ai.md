---
id: software-ideals-in-the-age-of-ai
blueprint: post
title: 'Software Ideals in the Age of AI'
publication_date: '2026-02-03 18:02:00'
---

In the last few weeks, there has been a lot of talk about the end of software development. We're entering a period where software is easier to make than ever before, and many are proclaiming that soon we won't need to look at code anymore.

I'm also very excited by the idea that anyone can make their own software, but there is a problem. The design choices that come baked-in with most of these tools are not great. If you ask an LLM to vibe-code an app, it's going to inherit all the faults of the previous generation.

In the age of AI, we need better defaults.

<a href="https://unsplash.com/photos/a-man-dressed-in-armor-and-holding-a-shield-EZ0xWAcowTM" target="_blank" aria-hidden="true" title="Image by Matt Benson on Unsplash.com">
    <img src="/img/blog/SoftwareIdeals.png" alt="">
</a>

## My Software Ideals

A few months ago, I gave <a href="https://noeldemartin.com/local-first" target="_blank">a short presentation</a> talking about my side-projects, and one of the slides included a list of my software ideals. But, what are software ideals?

Basically, they are the guiding principles that shape the architecture and design of the software I build. As well as the one I'd want to use. Calling them "features" would be a disservice, because they are a lot more than that. They convey my platonic ideal for what software should be.

This concept had been simmering in my mind for years, but this was the first time I actually wrote them down. After some deliberation, I came up with the following 3.

### Universality

There are many ways to interpret this idea. Crucially, [it's one of the core tenets of the Web](https://www.w3.org/mission/accessibility/). But to me, it means that I should be able to use my software anywhere. In any device, at any location.

The first point seems easy enough. If the software is built using web technologies, it most likely can run everywhere. And yet, I routinely find vendors perverting this idea. Just last month I was told that I wouldn't be able to access my savings account [without installing an app in my phone](https://www.reddit.com/r/MyInvestorES/comments/1qdcdpf/obligaci%C3%B3n_de_usar_app/).

But the second concept is more tricky. So much of our software relies on having an internet connection, that without it we're left with a rather useless device. The pinnacle of human invention and ingenuity, the "bicycle for the mind", turns into a beautiful brick.

It is, of course, possible to work around it (if you prepare in advance). But most of the industry is moving in this direction, and the solution doesn't come for free. Software has to be designed explicitly with that goal in mind. However, it's [not as difficult as it may seem](https://www.inkandswitch.com/essay/local-first/). Software makers just need to care.

But this isn't only important when we're offline, given that it's not as common these days. Requiring an internet connection often means that we depend on someone else's computer (aka servers, or "the cloud"). And _that_, is a problem.

### Sovereignity

A while ago, I only chose software based on the user experience. And it resulted in a lot of heartbreak. Despite my technological inclinations, I'm not someone who changes software very often (I'm still using Firefox!). But during the first decade of my computer life, some of my favorite apps disappeared. Wunderlist, Sunrise Calendar, Google Reader, Evernote Food, and many more.

The funny thing is that I never wanted new features. In fact, those were often unwelcome. If these apps hadn't vanished, I'd probably still be using them today. But somehow, we've accepted that software can be taken away. Unlike [everything else in the real world](https://noeldemartin.com/blog/skeuomorphic-software).

But sovereignity is not limited to keeping software forever. It also means having real ownership of your data. There are many reasons for that. Certainly, I started this journey thinking on privacy. But there are also practical reasons. I often want to share data between apps. And, in the rare case when I do change software, migrating is always a pain (often impossible).

If you can't access [the raw data](https://www.youtube.com/watch?v=OM6XIICm_qo), it's not really yours.

### Interoperability

If you've been following my content for a while, you may be thinking that I sound like a broken record. But yes, I think <a href="https://noeldemartin.com/solid-world-2025" target="_blank">interoperability is that important</a>.

I believe that this is the software property people would value the most, if only they thought it was possible. If you could travel to a parallel dimenson where everything was interoperable, I can assure you that coming back here would be like going back to the stone age. But most people don't even question the status quo, because they think this doesn't happen for technical limitations. However, as I've written at length before, <a href="https://noeldemartin.com/blog/what-technology-wants" target="_blank">it has nothing to do with that</a>.

Actually, I did travel to a parallel dimension. In 2024, I spent a couple of weeks in China, and got to experience the WeChat ecosystem. They call it "the everything app" for a reason. I could even use it to operate a washing machine in my hotel, and get a push notification when the laundry was done. Of course, it wasn't ideal that I didn't own any of my data, and everything was run on a centralized system. But in terms of user experience, it was great.

Wouldn't it be nice if all the applications you build with AI could share the same underlying data?

## The Age of AI

I have been thinking about these ideals for a while, and now they're more important than ever. People are starting to delegate their decisions to an AI, and that's only going to become more common. Unfortunately, most of the solutions LLMs come up with are very much against these ideals. The only one that works (sometimes) is Universality, as in "run it anywhere". Everything else, is often ignored.

Sure, there will always be software makers who care. And I don't think AI can replace a developer completely (yet?). But I also share the excitement about anyone being able to make their own software. In the next few years, I hope we get a lot of [Barefoot Developers](https://maggieappleton.com/home-cooked-software/).

However, if we're going to democratize software making, shouldn't people build apps that are aligned with their ideals? I could understand vendors making selfish decisions before (even if I don't agree with them). But if people are going to make their own software, they shouldn't be shooting themselves in the foot.

### My toolbox

Since I started making my own apps in 2019, I have been seeking for an architecture that allows me to live up to these ideals. I can't say I'm 100% there, and I've certainly had to build [a lot](https://soukai.js.org) of [my own tooling](https://aerogel.js.org). But I have learned about some technologies that, combined, give you pretty much everything I've talked about out of the box:

- **PWAs (Progressive Web Apps):** I'm sure many of you are already familiar with [PWAs](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps), they are pretty widespread (although not as much as I would like). Essentially, a PWA is a web app that can be installed like a native application. There is still some debate about the merits of PWAs vs native apps. But for me, there is no contest: PWAs all the way!

- **CRDTs (Conflict-Free Replicated Datatypes):** If you want to make your application local-first, you most certainly will end up using a CRDT. It sounds complicated, and if you search online you may get overwhelmed by the technicalities. But they can also be pretty simple. If you know nothing about CRDTs, I'd recommend that you start by watching this talk: [CRDTs for Mortals](https://www.youtube.com/watch?v=DEcwa68f-jY).

- **RDF (Resource Definition Framework):** Ah, RDF. If this isn't your first time hearing about it, you either love it or hate it (most likely the latter). RDF is a data modeling framework that attempts to formalize knowledge so that machines can understand it (almost the opposite of LLMs, actually). Basically, it allows different programs to collaborate on the same data. It's been around for ages, and it's used a lot in some fields (it's the format that powers [wikidata](https://www.wikidata.org), for example). But as I said, it has a bad rap. Once again, I think it's because it's often overcomplicated. I gave a talk about this, so if you're interested to learn more, check it out: <a href="https://noeldemartin.com/solid-symposium-dx" target="_blank">Thoughts on Solid Developer Experience</a>.

- **Autonomous Data:** This one is more of an idea than an actual technology, but it is important to mention because you can use all the tools in this list and fall short of these ideals. [Autonomous Data](https://autonomous-data.noeldemartin.com) is an application architecture I described in 2018, before I knew about the [Solid Protocol](https://solidproject.org/). If you're curious, you should read the site because it's not too long. The short version is that data should be decoupled from apps, and users should have true data ownership (in practice, and not just in theory).

### Putting AI to the test

Having read thus far you may be thinking that this has an easy solution: just ask your AIs to use these technologies. Unfortunately, reality is not so simple.

First of all, most people don't even know that these exist, so they aren't going to include them in their prompts. But even if they did, do you think it would work? I was curious about this myself, so I decided to give it a try. I asked various popular vibe-coding tools to create the most simple of applications: a Todo app.

Here's the prompt I used:

> Create a Todo application that is architected as a local-first Progressive Web App. The core philosophy of this app is that it must be fully usable upon visiting, requiring no internet connection and no user account to create and manage tasks. To achieve this, the underlying state management should rely on Conflict-free Replicated Data Types (CRDTs), ensuring that all data is persisted locally in the browser first.
>
> Crucially, I want the internal data model to be structured using RDF standards. Instead of storing simple JSON objects, the application should maintain a semantic knowledge graph of the user's tasks.
>
> For the synchronization strategy, design the system so that users remain anonymous by default. However, provide a way for users to log in where they can input a URL of a self-hosted backend or sync engine. Once this URL is provided, the local CRDT state should synchronize with that server, allowing the user to back up their data and share their task graph across multiple devices.
>
> Other than this configuration, the user interface should only support two actions: adding a new task and toggling its completion status with a checkbox.

And these are the results (source code [in Github](https://github.com/noeldemartin/software-ideals)):

- [Google's AI Studio](https://noeldemartin.github.io/software-ideals/aistudio)
- [Bolt.new](https://noeldemartin.github.io/software-ideals/bolt)
- [Lovable.dev](https://noeldemartin.github.io/software-ideals/lovable)
- Vercel's v0 (Cannot be hosted on Github Pages because it uses Next.js 💀)

How do they fare?

- **Universality ✅:** Most of the apps are PWAs that work offline. The only exception is Vercel's, which uses Next.js and cannot be served with static assets. I haven't even bothered checking if it actually works as a PWA, because given the requirements, it makes no sense to make an app with server-side code. But of course, it would be very easy to host in Vercel 😉.

- **Sovereignity 🤷:** This one is arguable. Google's and Lovable's synchronize with a Yjs websocket, and Bolt's uses Supabase. Both of those are open source, and as far as I know you can self-host them. But they make the classic mistake of relying on _implementations_, rather than _protocols_. If Supabase or Yjs go bust tomorrow, I don't think you'll keep using this for long. You'll have to go through a painful migration, not unlike the classic "export your data in a zip" that many vendors provide as an illusion that you own your data. What are some examples of good data formats? Plain text (or markdown), JSON, or indeed, RDF.

- **Interoperability 💀:** Not surprisingly, this is where all of them fail miserably. It's funny because looking under the hood, they are structuring the data as RDF triples. But then, they go ahead and serialize it in different formats, which misses the entire point of using RDF. In my <a href="https://noeldemartin.com/blog/interoperable-serendipity" target="_blank">interoperability scale</a>, all these apps fall at the very bottom: Obfuscated interoperability.

So yeah, as it happens with AI, the initial result seems impressive. But as soon as you start digging into the details, you realize it's full of holes. Furthermore, this experiment has also confirmed what I already suspected: each platform has their own technology preferences, and they'll shove them down your throat even if they aren't appropriate for your use-case.

If you're curious to see a Todo app that actually follows these ideals, check out my task manager: [Focus](https://focus.noeldemartin.com).

### Skill issues

Now, I know what a lot of people reading this post are going to say: "You're doing it wrong!".

I am aware that my prompt could have been better, that it's not reasonable to expect this to work in a single shot, and that these may not be the best tools to build "real software".

But here's the thing, most people aren't going to do any of that either. As I mentioned, they won't even know that these technologies exist, or how to judge the result. So I think this was a pretty reasonable example of how things would turn out in most cases.

## Outro

If you made it here, thanks for reading!

You may agree or disagree with my ideals, and I'm sure you have your own. But AIs also have theirs, and I doubt they are aligned with you either (even if you tell them!).

Even though we can now chunk out code faster than ever, our jobs as engineers are far from being over. Software Development is dead, long live Software Engineering.
