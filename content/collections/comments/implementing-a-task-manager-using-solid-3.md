---
id: implementing-a-task-manager-using-solid-3
blueprint: comment
title: 'Implementing a Task Manager using Solid - 3'
task: 'entry::implementing-a-task-manager-using-solid'
publication_date: '2018-11-23 01:24:04'
---

After some more digging, I found that SPARQL is not supported yet! Which makes performance a problem for applications with a lot of data (like a Task Manager). Instead, they suggest to use Globbing for the short term.

I guess this was to be expected, since Solid hasn't been declared as "production-ready", as far as I know. And this is the kind of thing I wanted to learn doing this project. So, good, let's see how this evolves and what I have when I complete this MVP.

I have been chatting with the guys working on Solid using [gitter](https://gitter.im/solid/app-development), and they are quite responsive :D. I opened an issue in the GitHub repo to keep track of this: [https://github.com/solid/node-solid-server/issues/962](https://github.com/solid/node-solid-server/issues/962)
