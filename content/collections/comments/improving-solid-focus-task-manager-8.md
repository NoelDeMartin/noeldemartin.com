---
id: improving-solid-focus-task-manager-8
blueprint: comment
title: 'Improving Solid Focus Task Manager - 8'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-05-30 19:24:57'
---

In the process of updating the docs, I've had a chance to think about the licensing of my open source code.

For a while, I used MIT by default without second-guessing, given that most of the frameworks and libraries I use are licensed as such. However after getting more into privacy-focused communities and learning more about licenses, I decided to use GPL for all my subsequent projects. But as things go, I recently read DHH's keynote on railsconf this year ([Open source beyond the market](https://m.signalvnoise.com/open-source-beyond-the-market/)) and it made me ponder again. He argues against GPL in the sense that doing Open Source, nobody who uses your software should owe you anything. And that should be the true spirit of Open Source: "do whatever you want with it". I won't get into the Free Software vs Open Source debate here, but suffice to say that I mostly agree with DHH. Except for apps.

If we are talking about libraries and frameworks, I agree with the "do whatever you want" spirit, because I assume the ones using my software will be other developers, and they should know what they are doing. But when it comes to apps, the ones using the software could be end-users who know nothing about programming. And at that point I'm not ok with someone changing the app to "do whatever they want with it". They could for example be adding privacy-invading features that users are not even aware of. That's why for apps, I think GPL is actually more appropiate. It's also true that using GPL for a library could be a barrier for some people, because MIT projects cannot have GPL dependencies, while GPL projects can have MIT dependencies.

Coincidentally, I looked into other software projects and it seems like the pattern could make sense. A lot of libraries I saw use MIT (Vue, React, Angular, jQuery, Laravel, Rails, Phoenix, etc.) whilst apps use GPL (Mastodon, MoodleNet, GIMP, etc.). Of course this is not always true, but I believe it's a good rule of thumb I'll follow from now on.
