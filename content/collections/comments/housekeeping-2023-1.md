---
id: housekeeping-2023-1
blueprint: comment
title: 'Housekeeping 2023 - 1'
task: 'entry::housekeeping-2023'
publication_date: '2023-03-12 10:31:42'
---

Ironically, the first thing on my chores list was to follow-up on [Umai](https://umai.noeldemartin.com/)'s release. As it happens, immediately after releasing I got a bunch of bug reports. Most of them were easy enough to fix, but there's been a couple with more nuance and it's taken me about a month to get it done.

First, I made sure to have [meaningful page titles](https://www.w3.org/DesignIssues/UserInterface.html#title). I've actually been pointed towards the [Design Issues](https://www.w3.org/DesignIssues) page many times, and it's always quite interesting. So I think I may read all of them at some point. Somewhat related to this, I've been thinking about how I've been declaring urls in my apps, and I opened a post in the forum to discuss it with the community: [
Should Solid Apps have pretty urls?](https://forum.solidproject.org/t/should-solid-apps-have-pretty-urls/6308)

Something else was that Umai didn't work with non-roman characters 😱️. Which is ironic, given that the app's name and logo is Japanese (but you couldn't create recipes using Japanese characters 🙈️). I was using a helper to convert recipe names into url slugs, but it was too aggressive in removing characters. What I'm very surprised about is that looking at existing helpers in popular frameworks, [they have the same problem](https://github.com/laravel/framework/issues/22592). The solution was easy enough, but the real problem was that I wasn't aware of this. I wonder how many other things I'm missing :/. It really is true that we programmers [believe a lot of falsehoods](https://github.com/kdeldycke/awesome-falsehood).

Not everything were bugs though, I also got some feature requests. And the most endearing was [printing recipes to PDF](https://github.com/NoelDeMartin/umai/issues/5). I didn't mention it in the journal, but this is actually one feature I already worked on :D. Unfortunately, it didn't make it to the first release because it fell to the [scope hammer](https://basecamp.com/shapeup/3.5-chapter-14#scope-hammering). But now that someone asked for it, I couldn't resist myself. But I was this close 🤏 to fall into a rabbit hole :/.

Initially, I thought there were some issues between browsers so I tried to print the PDF using a javascript library, rather than using CSS. But after [spending some time](https://github.com/NoelDeMartin/umai/commit/bc53abcdf2b8c63db392a1bcd957f697abb2ad3b), I realized that [it wouldn't work with non-roman characters](https://github.com/foliojs/pdfkit/issues/201). And this time I knew better. This year I pledged to favour simplicity over complexity, and stop overengineering. So I went back to using CSS, and I was going to solve it by adding a warning saying that if it doesn't work in your browser, you should try with a different one. However, when I went back to work on CSS I realized it was a problem with my CSS, not with the browser! So that means in the end, it's working quite well across most browsers.

Finally, this hasn't been reported, but I noticed that the bundle weight was growing a lot. And using a tool called [vite-bundle-visualizer](https://github.com/KusStar/vite-bundle-visualizer), I realized that [some dependencies](https://github.com/noeldemartin/faker) weren't tree-shaking properly. And I also learned that my own libraries weren't tree-shakeable 😱️. Turns out you have to declare `sideEffects: false` in your `package.json`, otherwise they are considered to be potentially modifying the global state. I'm certainly going to set that config in all my libraries now, and I'm also surprised that it took me this long to realize 🤷‍♂️️.

Anyhow, with a bunch of improvements I've released a new version of the app and I think I'll be done with it for a while.
