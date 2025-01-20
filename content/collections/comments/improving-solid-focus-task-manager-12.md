---
id: improving-solid-focus-task-manager-12
blueprint: comment
title: 'Improving Solid Focus Task Manager - 12'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-07-09 19:11:09'
---

I've finally completed adding all the new features I wanted, which include: editing & deleting workspaces, lists & tasks; and tasks now include a description and a due date. By the way, in the process of implementing due dates, I was faced again with that ugly choice of using momentjs or not. For those reading who don't know it, it's a very good javascript library to work with dates, but it [weights a lot](https://bundlephobia.com/result?p=moment@2.24.0) so you should think twice before adding it to your project. Fortunately, I found a nice alternative: [dayjs](https://github.com/iamkun/dayjs). I think I'll use it in most of my projects working with dates from now on.

One thing I implemented in the 100th commit 🎉 of the repository is something I've wanted to have for a while in my task managers (and arguably all my apps): built-in support for markdown! Task names and descriptions have it, and I think markdown should be supported by default in all text fields intended for text that will be displayed. I'll try to do that with my apps from now on to see if it really is a good idea.

So then, what's left now? "Not much", but of course that's [what I thought last time](https://twitter.com/rjs/status/1148432135629357056/photo/1). Basically two things: Improving the UI of the mobile layout and improving RDF types. I got some [new comments](https://forum.solidproject.org/t/focus-a-solid-task-manager/1022/20?u=noeldemartin) in the Solid forum regarding the types, so maybe I can do something with that. But regardless of how that goes, I'll make a new release soon (for sure before going on holidays in August).

Optionally I'll also implement a script to migrate the data from the previous version, given that it's changed so much and users from the previous version will probably "lose their data" (it won't be lost since it's made with Solid, but they won't see it in the app anymore).
