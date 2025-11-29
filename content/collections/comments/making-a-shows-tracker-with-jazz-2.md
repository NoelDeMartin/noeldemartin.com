---
id: making-a-shows-tracker-with-jazz-2
blueprint: comment
title: 'Making a Shows Tracker with Jazz - 2'
task: 'entry::making-a-shows-tracker-with-jazz'
publication_date: '2025-11-29 11:22:00'
---

It hasn't even been a month since my last update, and here I am writing about how I am already using my Shows Tracker made with Jazz in production. Yes, you've read that right, _in production_. So TLDR, Jazz is very cool and life really is better using React :/.

Here's the long version:

First of all, I'll have to resolve the tension I created in my last update: React or Svelte? Well, after having looked into it, I decided to go with React. First for the obvious reasons: it would be nice for once to use what the cool kids are using (sorry, even I felt the cringe writing that). But also, after reading the documentation and lurking in their Discord, it's pretty clear that React is the most well supported. I actually discovered [there was a Vue version before](https://jazz.tools/docs/react/upgrade/0-15-0#major-breaking-changes), and you can even use it with VanillaJS. So I'm pretty confident that I could use Jazz in my Vue apps if I wanted to. But for now, I'm sticking with React.

(Also, in case you missed it, I'm [taking React more seriously](https://noeldemartin.com/tasks/learning-react) given that I'll be using it in my day job as well).

The truth is that I've felt a real improvement using React and Jazz. Let alone the fact that I'm writing this update in a month (after struggling for months using Vue/Solid), the output produced by LLMs is also a lot better. I have also been playing with Cursor's [Composer model](https://cursor.com/blog/composer), and I really like it. Of course, I still can't get AI to [sort imports reliably](https://github.com/NoelDeMartin/shows-tracker-jazz/blob/main/.cursor/commands/sort-imports.md), but it _is_ getting better.

So yeah, I'm pretty happy with the way things are going. Although I'm also a bit sad that I won't be able to use my favorite tools. But if I look at it objectively, and [ignore sunk costs](https://shows.acast.com/akimbo/episodes/ignoresunkcosts), this is better.

It's not all sunshine and roses, though. My main gripe with Jazz is, of course, interoperability. I was already worried about this in my last update, but having learned more about it, I'm even more worried. If you read [their FAQs](https://jazz.tools/docs/react/reference/faq#will-jazz-be-around-long-term), you'll notice a very appealing sentence: "We're designing the protocol as an open specification". The problem with that is... that I'm not convinced it's true 😅. I haven't been able to find anything about this "open specification" outside of that sentence, and even asking in the Discord community (which has been super helpful otherwise), nobody knew anything about it.

Other than that, I had a few bumps setting up a sync server and the authentication, but in the end it turned out very simple (you can check out the source [in GitHub](https://github.com/NoelDeMartin/jazz-store)). The documentation is also a bit short, and I had to dig through source code and tinker to understand a couple of things. But as I said, the Discord community is very helpful, and I guess this is to be expected when learning a new technology (not all documentations can be as good as Laravel or Vue's!).

In summary, my initial hypotheses are proving to be true. Jazz is really cool, and the DX is great (I'd even say _magical_). Life is a lot easier if you are using React. And there is still nothing that comes close to Solid in terms of vision and values.

So, where does that leave me?

For now, I'll continue working on the app. I am using it in production, but if you [give it a try](https://noeldemartin.github.io/shows-tracker-jazz/) you'll realize that it's still very rough. The UI in particular sucks (specially in Mobile), since I've mostly vibe-coded it without paying much attention. But I'm quite happy with the data model and the architecture. After I spend some time on the project, I may even call it a "real app", not just a Personal App :). I also have some ideas to take advantage of Jazz in my Solid Apps, thus having the best of both worlds. But I still have to decide how much time I want to dedicate to Solid with the way things are going.
