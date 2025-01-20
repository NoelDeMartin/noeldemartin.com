---
id: brushing-up-noeldemartincom-4
blueprint: comment
title: 'Brushing up noeldemartin.com - 4'
task: 'entry::brushing-up-noeldemartincom'
publication_date: '2019-09-24 16:25:39'
---

I wanted to write an update on my last comment. After my initial integration and writing that comment, I watched Taylor's keynote introducing Nova once again. [At the end of the keynote](https://youtu.be/pLcM3mpZSV0?t=5378) he mentions that field classes can override some methods in order to customize the behaviour. Turns out, there is already a method that I can use to customize the Markdown field, and that is `fillAttributeFromRequest`. I extended the base Markdown field class and I've overriden that method to set the rendered html attribute as well. So now I don't need to use the model events for that (even though I'm using them for other things).

So yeah, like Laravel itself, it's a good idea to look into the source code of Nova when you're trying to customize some part of the framework. That's acutally something that has taught me as much, if not more, than reading the documentation for Laravel.
