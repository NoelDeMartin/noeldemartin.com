---
id: improving-the-solidos-frontend-9
blueprint: comment
title: 'Improving the SolidOS Frontend - 9'
task: 'entry::improving-the-solidos-frontend'
publication_date: '2026-07-13T09:56:00+02:00'
---

One week to go before holidays, and I am mostly done with the two main NLNet milestones I wanted to tackle (3m and 3p). I'll write more about that soon, but this week I spent it mostly on improving what we already have.

First of all, [I adapted profile-pane to use the new comboboxes](https://github.com/SolidOS/profile-pane/pull/428). What makes these different from other comboboxes is that the list of options is dynamic, and you can't just render all of them at once. Instead, they have to be added as the user types into the input. Interestingly, this is someting that Web Awesome's combobox doesn't support, so I had to come up with a solution from scratch. And what I used as an inspiration was [JQuery's DataTables plugin](https://datatables.net/) (Yes, I started programming in the jQuery era!).

However, I did it with a twist. One of the important features of `solid-ui`, and the reason why we chose Web Components, is that we want people to be able to use them with plain HTML, no JavaScript. But the way DataTables traditionally implement async content is with a JavaScript callback. In my case, I also did that but I'm providing a higher-level API to use this feature with plain attributes.

Here's an example:

```html
<solid-ui-combobox
    label="Who is the best Disney character?"
    async-options-url="https://api.disneyapi.dev/character?name=%search%"
    async-options-results-field="data"
    async-options-label-field="name"
    async-options-value-field="_id"
></solid-ui-combobox>
```

The other thing I worked on was improving the UX of the login state. It wouldn't be a stretch to say that this is the sort of stuff I was most excited about when I started working on this project. I do like Design Systems and whatnot, but in the end I was really looking forward to improving the UX. One of the most annoying parts of SolidOS, in my opinion, is that when you are redirected back from logging in, there is a brief amount of time were the UI still shows the logged out state (maybe not so brief depending on your internet connection or device). Now, you should see a spinner indicating that the log in process is still ongoing.

This is a very small change, and the whole log in / reload experience is still a bit clunky. But hopefully this can be the start of more serious updates. It's also an example of something that an external design agency is probably not going to suggest, since they seem to be limited to creating Figma designs and may not be so familiar with Solid. But I believe these small tweaks are some of the things that can have the greatest impact in the overall UX.

Here's this week's (and last week's) meeting notes:

- [Wednesday, July 1st 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_07_01.md) (Regular weekly meeting)
- [Wednesday, July 8th 2026](https://solidos.solidcommunity.net/public/SolidOS%20team%20meetings/2026/2026_07_08.md) (Regular weekly meeting)
