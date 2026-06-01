---
id: improving-the-solidos-frontend-3
blueprint: comment
title: 'Improving the SolidOS Frontend - 3'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-06-01T08:43:00+02:00'
---

This week, I finally ran the entire SolidOS stack locally!

SolidOS is made up of many packages, and in fact [the main SolidOS repository](https://github.com/SolidOS/solidos) is nothing more than a bunch of scripts to orchestrate cloning and running them. At some point, we should probably migrate to a monorepo, but even then it's likely that some package makes more sense in its own repository. This is also a problem I've faced in my own work, for example when I am working on an app and I need to change both [Soukai](https://soukai.js.org/) and [Aerogel](https://aerogel.js.org/) code. Recently, I even created [vite-plugin-multi-root-workspace](https://github.com/NoelDeMartin/vite-plugin-multi-root-workspace) to make this easier. But SolidOS is still using webpack, so I won't be able to use it here.

Anyways, the reason why I started running this locally is that I opened [my first real PR](https://github.com/SolidOS/solid-ui/pull/775)! There isn't much more to mention that I didn't say last week, other than I have been cleaning up the components and finishing the login UI. If anything, I would reiterate that working with Web Components is not being a great experience :(. Last week I mentioned the challenges with ARIA roles and element references, and this week I realized that using a native `<input>` inside a Web Component [is not enough to make it work with forms](https://web.dev/articles/more-capable-form-controls#form-associated_custom_elements) 😱. Web Components were supposed to be the "native" way to encapsulate functionality on the web, but so far it's feeling more restrictive than Vue or React. I'm being forced to reimplement a lot of the things that worked out of the box when using plain HTML 🤷.

This week, we also discussed how to tackle AI commits in the codebase. NLNet recently introduced a [policy on the use of Generative AI](https://nlnet.nl/foundation/policies/generativeAI/), and it's not completely clear what we can or cannot do in the project. Or how to even communicate it. In my own work (not SolidOS), I've been using the `Co-Authored-By` git convention in commits that have been AI-generated, and I also include an AI summary of the work. However, it seems like NLNet requires that we also include the entire prompt history, so that may be a problem. For now, though, I haven't been using a lot of AI in this project (at least, not to generate code). But once the foundations are laid out and we want to start using the Design System everywhere, this may become an important point of friction.

Finally, this week we also had a meeting with [Jeff](https://jeff-zucker.solidcommunity.net/profile/card#me) explaining his web components, which were pretty cool and also show what I think Solid should be all about (you can find the video recording of his demo here: [solid-web-components in data-kitchen](https://vimeo.com/1195872192)). We also released a new version with milestone 2k (I didn't do much work here, it was all Timea and Sharon!). You can find notes about these and the weekly meeting here:

- [Tuesday, May 26th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_05_26.md) (Jeff's web components showcase)
- [Wednesday, May 27th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_05_27.md) (Regular weekly meeting)
- [NLnet Grant Milestone 2.k](https://solidos.solidcommunity.net/public/2026/NLnet%20Grant%20Milestone2k.html)
