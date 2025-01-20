---
id: implementing-a-task-manager-using-solid-7
blueprint: comment
title: 'Implementing a Task Manager using Solid - 7'
task: 'entry::implementing-a-task-manager-using-solid'
publication_date: '2018-12-08 01:03:28'
---

You know when sometimes you get wrapped up in something completely irrelevant to the project at hand? Well this happened today, [not that it's a problem](https://noeldemartin.com/blog/order-vs-chaos) or that it took long.

I was using an SVG loader I got from [this repository](https://samherbert.net/svg-loaders). And it worked fine, but I noticed how sometimes the animation would be stuck and I suspected that it had something to do with Javascript loading. Which is counterproductive, given the job of that loader was to show until the app was ready.

Turns out the problem was with [SVG SMIL animations](https://developer.mozilla.org/en-US/docs/Web/SVG/SVG_animation_with_SMIL). They were deprecated, then they weren't, and now I don't even know what's the status. So I decided to move the animation to CSS. It wasn't straightforward because they don't share the same syntax nor the same operations. You can see how I did it in [this commit](https://github.com/NoelDeMartin/solid-focus/commit/643d38543591977da5f9c9f55886931c22b607af).
