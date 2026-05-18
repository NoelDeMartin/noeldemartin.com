---
id: improving-the-solidos-frontend-1
blueprint: comment
title: 'Improving the SolidOS Frontend - 1'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-05-18T08:05:00+02:00'
---

I have been involved with the SolidOS team for a while, because I used to attend every meeting and I've kept in touch with most of the people. However, I hadn't contributed any actual code 😱. But this is definitely going to change, because [Timea Turdean](https://timea.solidcommunity.net/profile/card#me) has offered me to join [the NLNet grant](https://nlnet.nl/project/SolidOS/), and I'm really happy to finally be working on a Solid project fulltime :D.

Now, I'm not sure how long that's going to last, since I'm technically still open for work and it's not like what's left of the grant can support all of us (we're already 3 people working on it: Timea, [Sharon](https://sharonstratsianis.com/), and me). Nevertheless, it's really cool that I can spend some time working on one of the most impactful projects in the Solid ecosystem. And [as I mentioned recently](https://noeldemartin.com/tasks/attending-the-4th-solid-symposium#comment-3), I really like the way things are going.

I've spent the first week mostly understanding how the various repositories work, and starting to make some proposals for improvements. My main takeaway so far is that the project definitely [needs some conventions](https://github.com/SolidOS/solid-ui/pull/744#issuecomment-4421683714). The use-case the project is trying to tackle is very complex at its core, given the flexibility of Solid/RDF and its ambitious vision. But, as it often happens in these types of projects, there's also a lot of [accidental complication](https://www.youtube.com/watch?v=WSes_PexXcA) going on (watch that video if you haven't!). Hopefully, one of the things I can contribute is a way to reduce it.

On that line, one of the first things we've been talking about is how to standardize writing UI. Right now, there are different styles mixed in the codebase, such as using [Lit](https://lit.dev/) or creating DOM nodes with vanilla JS (`document.createElement('div')`, etc.). After some discussions last week, we've decided that we'll move everything towards Web Components using Lit. In particular, we're going to have 3 types of components:

- Generic Solid Components (published under the `solid-web-components` package)
- SolidOS Design System Components (published under the `solid-ui` package)
- Application Components (not published anywhere, used internally to build the frontend)

I have already opened a PR with a first draft for the second type of components, [check it out if you're curious](https://github.com/SolidOS/solid-ui/pull/748).

And that's about it for now! Given that this is going to become my main gig for a while, I may be writing these updates more often than usual. But I don't think it'll be more frequent than once a week, so hopefully this won't become too noisy for people subscribed to the feed.

In case you're interested in digging in further, the SolidOS team is also working in the open, so you can check their notes and blog posts:

- NLNet milestone updates:

    - [Milestone 1a](https://solidos.solidcommunity.net/public/2025/NLnet%20Grant%20milestone%201a/Milestone1a.html)
    - [Milestone 1b](https://solidos.solidcommunity.net/public/2025/Milestone1b.html)
    - [Milestone 2d](https://solidos.solidcommunity.net/public/2026/NlnetGrantMilestone2d-.html)
    - [Milestones 2e and 2j](https://solidos.solidcommunity.net/public/2026/NlnetGrantMilestone2eAnd2j.html)

- Meeting notes from this week:
    - [Monday, May 11th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_05_11.md) (Introduction and discussion for new contributors, [Michael](https://mpeters.dev) and me)
    - [Tuesday, May 12th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_05_12.md) (Discussion about web components and code organisation)
    - [Wednesday, May 13th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_05_13.md) (Regular weekly meeting)
