---
id: improving-the-solidos-frontend-5
blueprint: comment
title: 'Improving the SolidOS Frontend - 5'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-06-15T08:21:00+02:00'
---

We're still going back an forth about the [migration to Vite](https://github.com/SolidOS/solid-ui/pull/787), but _I think_ we're almost done with that. Certainly, I don't think I'll have to spend a lot more time working on it. One of the reasons for the delay is that it needed to be reviewed by multiple people. One of the main topics of discussion is how much we want this to change things. You can read the weekly meeting notes at the end, but if you want a TLDR I also added [a brief explanation in the README](https://github.com/NoelDeMartin/solid-ui/tree/9039fc85cce0192cc6229163387345bef0677234#build-config).

I am aware that this PR is very likely to break some existing dependencies. But I think that's something we have to do at some point if we want to improve the library, and now it's probably the best time to do it given that we're migrating everything to Web Components and consumers will have to rewrite their code anyways. In theory, people using the library through npm shouldn't be affected that much, because dependency versions are not updated automatically (or shouldn't). But another problem is people who's using the library through CDNs, which was documented with an unversioned url. The main problem is that the CDN used the `window.UI` legacy pattern to expose helpers, but that's often frowned upon for new applications (often called "Global Scope Pollution"). Instead, new applications should rely on ESM imports which are now [supported by most browsers](https://caniuse.com/es6-module).

This week we also had a couple of private meetings. First, we talked with [Jeff](https://jeff-zucker.solidcommunity.net/profile/card#me) about his new [component-interop](https://jeff-zucker.github.io/component-interop/) initiative, and then we talked with [Samu](https://github.com/langsamu) about [the ODI's new authentication library](https://github.com/solid-contrib/reactive-authentication). Both are taking a new approach at solving some of the problems we've had in the ecosystem for a while, we'll see how they pan out.

After these meetings, we reached a decision about SolidOS's Web Components: [We're not going to release 2 separate libraries](https://github.com/SolidOS/solid-ui/issues/790). A few weeks ago I mentioned we wanted to make a library with generic components, completely decoupled from the `solid-ui` package and design system. But it seems that wasn't the right decision, because it just caused confusion and we didn't land on a name we were happy with. So we're just going to release Web Components through `solid-ui`, some more reusable than others. Hopefully, this should still serve the same end goal because the library is now (or will soon be) able to expose individual components and helpers.

Finally, at the tail end of the week, I started working on my next task: to start applying the new components and design system to other panes. [I started with contacts-pane](https://github.com/SolidOS/contacts-pane/issues/283) because it seemed simple enough (we'll see how true that is!). I thought it could be a simple migration, and essentially it is; but I'll probably need to migrate the build system to Vite as well to support Lit's decorators and so on. I'll also take this opportunity to standardize and maybe extract some of the helpers that are duplicated in every panel repository, such as [the dev sandbox](https://github.com/SolidOS/contacts-pane/tree/925a4c82162298397d2fed64322c6303233dc012/dev). More about this next week!

This week's meeting notes:

- [Wednesday, June 10th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_06_10.md) (Regular weekly meeting)
