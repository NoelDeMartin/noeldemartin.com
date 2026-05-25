---
id: improving-the-solidos-frontend-2
blueprint: comment
title: 'Improving the SolidOS Frontend - 2'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-05-25T10:05:00+02:00'
---

Hi again!

This week I've felt a lot more productive than the last. Even though we've also had a couple of meetings (links at the end), I've started to work on more elaborate components and learned a lot more about Web Components in general. If you're interested, you can see a summary of this week's work in this PR: [Implement reusable primitives](https://github.com/SolidOS/solid-ui/pull/761).

I started the week with the idea of creating an "Account" component. I have [a similar component in Aerogel](https://github.com/NoelDeMartin/aerogel/blob/main/packages/plugin-local-first/src/components/Account.vue), and the idea is that this component can be used to show either log in/sign up links, or the user menu. In my apps this makes a lot of sense because they are local-first, but even though SolidOS isn't, it happens to have the same pattern (because you can open pages without logging in). So that's nice :).

It seems like a simple component, but it involves a couple of things that are not so trivial, such as interacting with the authentication system, invoking business logic (login, sign up, logout), and opening overlays (the dropdown user menu). Additionally, another challenge is that I wanted this component to be part of the generic Solid Components, because this is something other apps will definitely need. But after some tinkering, I decided it would make more sense to build smaller reusable components, and the "account" component would be SolidOS-specific (still reusable, though!).

Maybe the most interesting thing I've done this week is the way I've implemented the authentication and business logic interaction. Though the truth is that I haven't 😅. Let me explain. As I mentioned last week, the idea with these generic Solid Components is that they can be used in any project, not just SolidOS, and ideally we want them to be interoperable with other Web Components in the Solid ecosystem. In order to support that, I've abstracted away all the interactions with the business logic of SolidOS behind an interface. I'm still not sure how the whole ecosystem will converge on this, given that it's still an open question, but at least whenever we do, in SolidOS we'll only need to swap up this interface with a different implementation. An additional benefit here is that I've also been able to implement a [Storybook](https://storybook.js.org/) implementation, which allows us to see these components in a nice UI sandbox :).

Something else relevant this week, although not Solid specific, was implementing the dialogs and overlays. This one is still a work in progress, but honestly, all the headaches I'm having show some of my initial concerns about using Web Components :(. It's not that difficult to implement a working dropdown with Javascript/CSS, but it is very difficult to make it conform with [ARIA specifications](https://www.w3.org/WAI/ARIA/apg/patterns/menubar/) and native APIs such as [the Popover API](https://developer.mozilla.org/en-US/docs/Web/API/Popover_API). In fact, I've been looking at [Web Awesome's Dropdown](https://webawesome.com/docs/components/dropdown/) and it doesn't 😱. I often use this browser extension called [ARIA Devtools](https://chromewebstore.google.com/detail/aria-devtools/dneemiigcbbgbdjlcdjjnianlikimpck) to check whether an app is built correctly or not, and their dropdowns don't even show up :/. So yeah, I don't know... Trying to learn about this talking with some AIs and whatnot, it seems like ARIA roles aren't really "that important" (at least for dropdowns), as long as the labels and keyboard interactions are configured properly. There's also the fact that I'm not sure we should be spending that much time building these things from scratch, so this week I'll try to discuss some alternatives to use 3rd party components. We'll see how this evolves!

And that's about it for this week! Tomorrow (at the time of this writing), we're having a meeting about [Jeff's Web Components](https://github.com/SolidOS/solid-web-components/), so feel free to join if you're interested to participate. The main idea of the meeting is that he explains how those components work, and how we'll integrate them in SolidOS or what'll happen with that repository moving forward (as I mentioned, ideally we'll use it to publish the generic Solid Components). But something I'll make sure to bring up as well is the interoperability between libraries, and the business logic layer I've been abstracting away. The meeting is happening on Tuesday 26th at 18:00 CEST, you can join in [the SolidOS Jitsi room](https://meet.jit.si/solid-operating-system).

This week's meeting notes:

- [Monday, May 18th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_05_18.md) (Discussion about mobile forms, a11y, and other tecnical topics)
- [Wednesday, May 20th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_05_20.md) (Regular weekly meeting)
