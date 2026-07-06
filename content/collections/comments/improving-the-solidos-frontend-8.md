---
id: improving-the-solidos-frontend-8
blueprint: comment
title: 'Improving the SolidOS Frontend - 8'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-07-06T09:34:00+02:00'
---

Today I can finally say that I've completed the first task I started in SolidOS 🥳. Which is to migrate the header to the design system. Yes, that's it 😅.

When I started working on this, I definitely didn't think it would take me this long to get here... And to be honest, I can't say it's really "done" because in the process of migrating this, I _may_ have broken a couple of things in mashlib :/. The main problem is that many things in the SolidOS stack seem to be glued together, rather than architected. And so, when you make some change, it's very likely that you break something in a completely unrelated part of the codebase (maybe not even in the repository you've made the change!).

Still, I do think this is the proper way to go for the long term. I'd much rather break things now, so that we're aware and fix them, than continue kicking the can down the road... But honestly, given the current status of the project and its prospects, I'm not so sure this is be best way to go either :(. I'm not sure if I'll continue working on this after the summer, and even if the project secures a follow-up grant from NLNet, these type of architectural issues are very difficult to fix. I'm aware that I sound very much like an [architecture astronaut](https://en.wikipedia.org/wiki/Architecture_astronaut) when I say this, but as ever, this shows me that [technical debt](https://en.wikipedia.org/wiki/Technical_debt) really is more important than people think.

Anyhow, as part of migrating the header to the design system I also migrated `solid-panes` to Vite; and continued doing improvements to the tooling. For the last couple of weeks I have left, I think I'll probably focus on cleaning things up and leaving things as stable as possible.

It seems like we haven't got the meeting notes for this week yet, but we did get a new blog post about NLNet milestones:

- [NLnet Grant Milestone 1.c – Consolidate RDF Forms](https://solidos.solidcommunity.net/public/2026/NLnetGrantMilestone1c.html)
