---
id: improving-the-solidos-frontend-7
blueprint: comment
title: 'Improving the SolidOS Frontend - 7'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-06-29T09:38:00+02:00'
---

This week marks the halfway point for this task, given that I'm going on holidays in late July and I started working on this in late May. There's still the possibility that I keep working on the project after the summer, but I'm definitely going to close this task by then.

Keeping that in mind, I started thinking about tying some loose ends, and the first one was accessibility. Of course, I always have a11y in mind from the beginning. But as I mentioned [in a previous weeknote](https://noeldemartin.com/tasks/improving-the-solidos-frontend#comment-3), we had to decide whether to use 3rd party components or not. We actually reached out to [NLNet's accessibility partners](https://ngi.aimsites.nl/) for some feedback, but 3 weeks later we still haven't heard back from them :(. So, at least for now, we've decided to rely on [Web Awesome](https://webawesome.com/). I still have some doubts about accessibility for Web Components, but honestly, I'm pretty sure they are ok given that a11y is one of their selling points. Unfortunately, some components are not free, such as the [Combobox](https://webawesome.com/docs/components/combobox/), and we'll need to code them ourselves (buying is not an option, given that everything in SolidOS has to be open source).

Something else I've been looking into is code reusability between components. In particular, making form inputs with Web Components requires a lot of hand-wiring (it's not enough to simply render native `<input>` or `<select>` elements under the hood). The first reaction to this may be to think of creating a parent "FormInputComponent" class, that can be extended for individual components. But that would be a mistake. Or rather, not ideal. Instead, I have created a concept of "component traits" that hook into the component lifecycle and can be composed with other traits. TLDR, [composition over inheritance](https://en.wikipedia.org/wiki/Composition_over_inheritance) :).

Finally, we've continued talking about CI and dependency management. We haven't reached a final conclusion yet, but I did write most of my thoughts on this in [a PR comment](https://github.com/SolidOS/toolkit/pull/2#issuecomment-4797160261). We had a meeting on Friday (notes below), and it seems like we're going to configure an "ecosystem CI" that runs the entire SolidOS stack once a day to make sure everything works together. Hopefully, that will take care of some of our headaches!

This week's meeting notes:

- [Wednesday, June 24th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_06_24.md) (Regular weekly meeting)
- [Friday, June 26th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_06_26.md) (Toolkit, CI, and dependencies management)
