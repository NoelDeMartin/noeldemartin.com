---
id: improving-the-solidos-frontend-6
blueprint: comment
title: 'Improving the SolidOS Frontend - 6'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-06-22T09:15:00+02:00'
---

This week, we finally merged the migration to Vite in `solid-ui`, so Webpack is history! At least, for that repository. We still have a few more to go 😅. And that's one of the main things I've been working on, migrating the `contacts-pane` to using Vite and the new design system.

But I'm not migrating _all_ the pane. Rather, I'm using it as an example of introducing the new components progressively. In particular, I started by rewriting the "Add Contact" form into a dialog. The change itself is not too big, and the new code is a lot simpler than the old (as it should!). But this involves a bit of work upfront, such as migrating the build system to Vite.

As I mentioned last week, I've also been working on extracting a dev sandbox for panes, and I'm doing that in [a new package called `solidos-toolkit`](https://github.com/SolidOS/toolkit/pull/2). The idea is that this package will include all the tooling that can be reused across the SolidOS stack. Mostly on panes, but I'll probably end up using it in `solid-ui` as well.

All of this work looks like [yak shaving](https://seths.blog/2005/03/dont_shave_that/), but it's aligned with of my favorite software development mantras: [Make the change easy, then make the easy change](https://x.com/KentBeck/status/250733358307500032).

Other than that, we're still working on fixing the CI and our release process. Things slowed down to a crawl this week, because we decided to do a new release including the [migration of the authentication library](https://github.com/SolidOS/solidos/issues/284). You can find more about it in this week's meeting notes, but TLDR it seems we weren't aligned on the roadmap because I thought the next release was scheduled to include all the migration to the design system. So I had to roll back some of my UI changes in preparation for the release. Hopefully next week we'll get back on track!

This week's meeting notes:

- [Wednesday, June 17th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_06_17.md) (Regular weekly meeting)
