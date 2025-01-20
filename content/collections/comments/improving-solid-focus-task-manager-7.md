---
id: improving-solid-focus-task-manager-7
blueprint: comment
title: 'Improving Solid Focus Task Manager - 7'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-05-15 15:41:39'
---

If you had visited the API section of the Soukai docs before today, you'd have noticed it was all empty and filled with TODOs. My first approach to documenting the interface of the library was writing it by hand, and of course I knew that would change. Well, that changed yesterday because I've started using [TypeDoc](https://typedoc.org/).

My library is written using Typescript, so there is already a good deal of information there that can be automatically extracted. I started looking for solutions and I settled on using TypeDoc. After tinkering with it for a while I found it lacking in some areas, but good enough to use for now. The features that I found lacking are already being tracked (issues [#36](https://github.com/TypeStrong/typedoc/issues/36) and [#639](https://github.com/TypeStrong/typedoc/issues/639) on github), although it doesn't seem like they'll be added anytime soon. But it's good enough and better than my previous approach.

Basically TypeDoc will read a typescript project and generate a documentation in html. Other than Typescript primitives like types and interfaces, it'll also read documentation in the style of phpdocs or javadocs. I don't have any of that the moment, but now that I'll start documenting the recent additions to the library in the guide I may add some. When it comes to documenting code I think class and method names should be expressive enough, but sometimes there is value in adding code documentation.

You can see the current deploy of the API reference here: [https://soukai.js.org/api/](https://soukai.js.org/api/)
