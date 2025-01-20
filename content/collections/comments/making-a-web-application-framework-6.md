---
id: making-a-web-application-framework-6
blueprint: comment
title: 'Making a Web Application Framework - 6'
task: 'entry::making-a-web-application-framework'
publication_date: '2024-03-03 09:52:53'
---

This week was the end of the cycle, and TLDR this is how things stand:

![Hill Chart 3rd March 2024](/img/tasks/hillchart-2024-03-03.png)

Looking back at the evolution of the chart, it started really well because in a couple of weeks I had most things from the "Workspaces & Lists" and "Tasks CRUD" scopes done. But then came Solid! I thought it'd be easy, because I [had already done all the CRDT stuff in Umai](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid). But I didn't anticipate how much the different data structure would affect it.

Umai's data structure is quite straight-forward; there is a container with Recipes and that's it. But Solid Focus has a hierarchy of nested containers, with Tasks within. So it was a bit of a hassle to adapt, but the good news is that all of this should be a lot more robust now. In fact, I'm pretty sure it'll help Umai's interoperability as well, because it'll be able to support multiple Recipe containers.

All in all, though, I'm happy with the outcome of these 6 weeks. I don't think I have complicated things necessarily, and I still managed to create some new abstractions with elegant APIs. If you want to learn more about the current status and my development workflow, I published a new video in my Youtube channel: [Rebuilding Solid Focus with Aerogel | Basic functionality](https://youtu.be/awaaSorMYhk).

I'm really enjoying making these videos, so expect more. I'm aware the quality could be better, but I don't want to spend a lot of time on that at the moment. Although this time I think I actually did it _too quickly_, because just after publishing I realized there were a couple of cool things I hadn't mentioned 😅. Such as [Route Model bindings](https://github.com/NoelDeMartin/solid-focus/blob/dc93766770f5aecb46ecf4d55c2902d4495f81fc/src/pages/index.ts#L10), [computed Model refs](https://github.com/NoelDeMartin/solid-focus/blob/dc93766770f5aecb46ecf4d55c2902d4495f81fc/src/services/Workspaces.state.ts#L14), [global getters](https://github.com/NoelDeMartin/solid-focus/blob/dc93766770f5aecb46ecf4d55c2902d4495f81fc/src/services/index.ts#L6), etc. On the flip side, that made it a shorter video so it probably makes it more appealing to some people.

Now, having done that, I think the foundations are laid out. Although there is certainly a lot more left: UI/UX, data migration and interoperability, advanced features, etc. I'm still optimistic that it shouldn't take too long, but at the end of the month [I'll be afk for a couple of weeks](https://en.wikipedia.org/wiki/Camino_de_Santiago); so I'm refraining from starting a new cycle now. I'll use the cooldown period to clean up a couple on things, and hopefully by next month I'll be kicking off the next (and final?) cycle for the rebuild.
