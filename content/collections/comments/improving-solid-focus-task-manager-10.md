---
id: improving-solid-focus-task-manager-10
blueprint: comment
title: 'Improving Solid Focus Task Manager - 10'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-06-17 19:46:24'
---

I just implemented the form to update tasks and there was a small bug with soukai-solid, but nothing dramatic.

What I spent more time on, though, was implementing the animation for the sidepanel that will contain information about the task as well as the form. I decided the best way to animate the transitions is with CSS when a task is not selected anymore. The problem is that because the task is no longer available to the Vue component, it will be blank and that's not nice UI.

In order to solve that I've created a component I'm calling "Freezable". I'm not sure if anyone else has found this use-case, but it seems to me like a good solution.

I've created a gist on github with the basic component and some examples in case you want to check it out: [https://gist.github.com/NoelDeMartin/7414586bae62f79bcf9bfb9f12b13316](https://gist.github.com/NoelDeMartin/7414586bae62f79bcf9bfb9f12b13316)
