---
id: improving-solid-focus-task-manager-13
blueprint: comment
title: 'Improving Solid Focus Task Manager - 13'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-08-05 19:26:56'
---

Finally, after 6 long months, I can close this task!

This has been in retrospective a huge task. It may not seem as much looking at the UI, given that only a bunch of things have been added (task scheduling, descriptions, editing, etc.). But the underlying code has changed a lot, [just look at this diff](https://github.com/NoelDeMartin/solid-focus/compare/v0.1.1...v0.2.0). I've practically rewritten from scratch most of the data layer using Soukai and I've written & documented the companion libraries. Of course, this is a side-project and I wasn't working on this fulltime, but still. You can check the current status of the app with renewed documentation here: [https://github.com/NoelDeMartin/solid-focus](https://github.com/NoelDeMartin/solid-focus)

All of this work may seem overkill, but it isn't if you keep in mind that I want to build many apps using this architecture. I also opened the forum thread I mentioned I would about working with Solid using an Active Record pattern. You can join the discussion here: [Soukai: A different way to query PODs](https://forum.solidproject.org/t/soukai-a-different-way-to-query-pods/2105)

Something I didn't quite finish is a migration script. Meaning that people (like me) who used the app in an older version, won't be able to see their data on the new version. This is not a complete disaster because using Solid the data is still accessible in the POD. But of course, for normal users this would be a problem. Stuff like this is why the app is in pre-release and I don't recommend using it for production unless you know what you're doing. The reason why I didn't complete the migration script is because of [an issue](https://github.com/solid/node-solid-server/issues/1120) I reported 5 months ago on `node-solid-server` hasn't been fixed yet (actually it was fixed for a short while but it's regressed now). Unfortunately, this also makes the app incompatible with the deployed version of PODs at solid community and inrupt. Which is why I'll probably install [node-solid-server](https://github.com/solid/node-solid-server/) on my server one of these days. I'll probably document it here, so check out my other tasks to see if I did it!
