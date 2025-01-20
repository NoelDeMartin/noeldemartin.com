---
id: implementing-a-media-tracker-using-solid-10
blueprint: comment
title: 'Implementing a Media Tracker using Solid - 10'
task: 'entry::implementing-a-media-tracker-using-solid'
publication_date: '2020-07-24 16:22:02'
---

Here's an afternote for this closed task.

Shortly after completing the task, I announced the release in [a post](https://forum.solidproject.org/t/media-kraken-keep-track-of-your-media-in-your-pod) in the Solid Forum. I've got some interesting feedback which I've used for a [new release](https://github.com/NoelDeMartin/media-kraken/releases/tag/v0.1.3). Nothing major, but for those interested in the evolution of the app, the conversation's continued there :).

As for me, I've already replaced my previous app to track movies with Media Kraken and so far I'm happy with this v0.1. The only real problem is the initial loading time, which I've continued discussing in [this other post](https://forum.solidproject.org/t/state-of-the-art-for-querying-large-containers). It doesn't look like I'll get any solutions for the short term, but at least the caching strategy I implemented makes it bearable.
