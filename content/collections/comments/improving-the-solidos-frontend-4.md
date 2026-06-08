---
id: improving-the-solidos-frontend-4
blueprint: comment
title: 'Improving the SolidOS Frontend - 4'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-06-08T08:23:00+02:00'
---

Following up from last week, I kept improving the login form. In particular, this week I started looking at some of the things outside of [the design](https://www.figma.com/design/88xQawSSXzfQprEZPaKplZ/Solid-OS). It is very common that application designs in Figma are missing many of the edge cases, specially when the task for designers was basically to redesign the entire application (or a huge part of it). But I think they are also very important, and part of what make a great UX. Usually, I would talk it over with the designers, but given that we're working with an external agency that bills by the hour, I decided to take some initiative and just do it myself. I'm not talking about anything drastic, though, simply adding some loading states to buttons when submitting, and showing errors when something goes wrong.

However, I spent most of my week [migrating to Vite](https://github.com/SolidOS/solid-ui/pull/787)! On the one hand, that's great, because I do like Vite a lot more than I like webpack. On the other hand, it's not going as well as I thought 😅. It's not like the migration is going wrong per-say, but part of migrating the build system is to make sure that I don't break any of the existing consumers of the library. But I'm afraid that's not going to be so easy :(. Basically, the way the `solid-ui` library is being bundled and used [is](https://github.com/SolidOS/mashlib/blob/7209297e7290e011e7ca886b17eb613f6061eb93/webpack.config.mjs#L17) [not](https://github.com/jeff-zucker/sol-components/blob/bdf7cf034e9a663d41d94d076fd8c6002091a85c/web/sol-login.js#L690) [ideal](https://github.com/SolidOS/solid-ui/blob/c59efc04ca8e7a10417cc80d2a53638963739e70/README.md?plain=1#L90), and I'm not sure how much we can improve the situation without introducing breaking changes. Still, it should be "fine" to introduce breaking changes in a new major version... I'll have to discuss it in the next weekly meeting.

Finally, this week marks the first month since I joined the project. Looking back, it's been a bit different from what I expected. My intention was (and still is) to improve the UI. But so far, I've spent most of my time fighting against web components, cleaning up the architecture, and tinkering with build systems. Of course, all of that is also very important for the project and should make the UI work a lot easier. But, as I mentioned in my first note, there is a lot of accidental complication going on. Hopefully once I'm done with all of this, I can be a lot faster at working on the UI!

Here's this week's meeting notes:

- [Wednesday, June 3rd 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_06_03.md) (Regular weekly meeting)
