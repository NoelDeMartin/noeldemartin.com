---
id: improving-solid-focus-task-manager-1
blueprint: comment
title: 'Improving Solid Focus Task Manager - 1'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-02-15 12:27:37'
---

Yesterday I hammered through some UX improvements that I had wanted to do for some time.

First, I wanted to add animations when a task is added or removed from a list. I started using [Vuetify transitions](https://vuetifyjs.com/en/framework/transitions#todo-list), and they were a good starting point to see what I wanted out of this feature. But their implementation did not achieve the fluid experience I was looking for. In particular, transitions are implemented using translate CSS transformations. The problem with this is that the computed size of the element is not animated, only its visual position. This causes an undesired jump of the content at the start or at the end of the animation. In order to achieve what I was looking for, I ended up using a custom [Vue transition](https://vuejs.org/v2/guide/transitions.html#List-Transitions) where I animated the height property instead of applying a transformation. I can understand the reason for Vuetify animations to be implemented that way, because in order to have a height animation working, the elements need to have a fixed height. This is not viable for a framework that aims to provide a toolbox for multiple use-cases, but for my use-case in particular I could live with that trade-off. You can see my implementation in [this commit](https://github.com/NoelDeMartin/solid-focus/commit/0070290d2660c6c060b4d2dadffc596e02bf3980).

Another thing I worked on was increasing the size of task checkboxes. As part of the feedback I got for the first version of the app, I was told that clickable areas should be at least 32x32px on mobile, and the default size of the checkbox that comes with Vuetify is 24x24px. If you look at the repository, you'll notice that I went back and forth a couple of times with different solutions. At the end I decided to stick with a simple approach to use the default size for desktop and increase the checkbox size in a mobile layout.

I also used this opportunity to add a real implementation of a UUID generator. This made me think about how task ids are generated with the online mode of the app. I send a request to create a new document without indicating an id, so it's being generated on the server side. This could be improved generating it on the client so that I don't need to wait for a response to reflect the changes on the UI (and revert the local state in case of an error).
