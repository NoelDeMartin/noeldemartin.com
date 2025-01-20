---
id: implementing-a-task-manager-using-solid-4
blueprint: comment
title: 'Implementing a Task Manager using Solid - 4'
task: 'entry::implementing-a-task-manager-using-solid'
publication_date: '2018-11-26 01:22:17'
---

Today I've been working in something that lead me stray from the path to complete this task, but I think it was worth it to explore possibilities.

The first thing I did when I started working on this task manager is storing user data in local storage, in order to have the skeleton of the app before getting into anything Solid specific. I did it in such a way that everything was behind an interface, so I just had to reimplement the interfaces using Solid.

And what I realized today, is that it wouldn't be too difficult to maintain both implementations, and let users decide whether to use local storage or Solid (or potentially other backends in the future). This is obviously not something to take lightly, but since this is only an exploratory task, to learn Solid and alternative architectures, I thought it'd be a good idea to do it and see how it goes.
