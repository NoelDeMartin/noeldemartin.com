---
id: learning-css-4
blueprint: comment
title: 'Learning CSS - 4'
task: 'entry::learning-css'
publication_date: '2023-05-08 16:15:05'
---

I just completed module 4, which was all about flexbox.

If there was ever a good example of a CSS feature I've been using a lot but didn't understand, this is it 😅️. I've been building almost everything with flexbox, and I've ran into some issues here and there, but for the most part I thought I had it under control. Well, after taking this module I just realized how wrong I was. To be fair with myself though, I did know 80% of its mechanisms; and it isn't like I was using it "wrong". But this definetly took me to the next level.

One of the things that keeps blowing my mind in this course is learning the underlying mechanisms of the language I wasn't aware of. Which is funny, because I consider myself [a bottom-up learner](https://duckduckgo.com/?t=ffab&q=bottom+up+vs+top+down+learning), but for some reason when it comes to CSS I've been flying blind my whole life. In this module, I've learned about the core concepts that explain the way flexbox works: Hypothetical size, primary axis vs cross axis, justify vs align, items vs content, etc.

At the end of the module, there is a review that was very helpful to solidify all these concepts. If you're curious about them, you can check it out yourself in this blog post: [An Interactive Guide to Flexbox](https://www.joshwcomeau.com/css/interactive-guide-to-flexbox/).

In these lessons I've also realized how much attention to detail Josh puts into his UI. I'm no designer, but I enjoy working with UI and I like to think that I pay attention to detail as well. But I still learned some things I've been missing in my own designs. For example, aligning the baseline of text. This also made me realize how powerful flexbox really is, because it can do some crazy stuff with nested flex containers that are not obvious at all. Can't wait for module 9, "Little Big Details"!

Finally, in order to speed-run through all the important concepts, I took [Flexbox Froggy](https://flexboxfroggy.com/) again. I'm glad to say I completed it in a breeze, with two exceptions. In level 10, you have to use `justify-content: flex-end;`, and I'm still using `justify-content: end;` instead. Which is not completely wrong, but it can be an issue in some situations, so you're better off using the `flex-*` values. I also struggled to complete the last level, to the point that I had to look at the solution :(. But hey, the important part is that I really understood everything! I'm sure that before I would've been baffled as to why the CSS worked at all.
