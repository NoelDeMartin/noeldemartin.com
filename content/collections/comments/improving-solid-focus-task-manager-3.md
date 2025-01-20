---
id: improving-solid-focus-task-manager-3
blueprint: comment
title: 'Improving Solid Focus Task Manager - 3'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-03-24 10:18:05'
---

The last few weeks I've been tinkering a lot with [Soukai](https://github.com/NoelDeMartin/soukai) and its [Solid engine](https://github.com/NoelDeMartin/soukai-solid). I still haven't reached a point of closure (I need to tackle model relations, for example). But it's been a while since I wrote an entry on this journal so I figured it's about time I do it.

One thing I did was setting up the js.org domain to serve the soukai documentation. It's cool because it works nicely with github pages, so anyone can host a XXX.js.org site for free. Head to [js.org](https://js.org) to learn more about it. I pondered going all in with this and have all of my projects setup with that domain, but I'll stick to pure js packages. I'll continue to use the github.io domain for other projects.

I've also had a thought about my development process. I realize that I move slow on my side-projects, certainly slower than the progress I make on my day job. And the reason for that isn't only that I dedicate less time, it's also how I approach it. In my day job, the main goal is to get things done. And of course, I also learn new things, but I try to tone down my perfectionism to be more productive and get results. But on my side-projects, I pay more attention to detail at the cost of going slower. I do it because that's how I maximize my learning and self-improvement. I recently listened to an episode of the Hurry Slowly podcast that talks about this: [Creativity vs Efficiency](https://hurryslowly.co/208-jocelyn-k-glei/). But the thing is, I also want to make progress on my side-projects! So I've decided to try something out. For the next few weeks, I'll alternate between "getting things done" and "perfectionism" mindsets each week. I did it for the last two weeks and so far it's been good.

Part of the perfectionism week has been dealing with repository versioning. So far, I had a single master branch and the version in package.json was the version of the latest release. This was confusing, because someone may think looking at the repo that a feature is live, when in fact it'll be available for the next release at which point the package.json version will change. After reading a while and looking at what other repositories do, I've decided to have a `dev` branch following the same strategy, but the master branch will only be updated for releases.

Something else from this week has been setting up [Cypress](https://www.cypress.io/) to run integration tests for Solid Focus. It was specially important to add those before integrating with Soukai, so that I could be sure there weren't any regressions. It's been my first time using Cypress, and overall I'm very satisfied with it. There are some things I couldn't manage, like setting up Typescript, but it was relatively easy to set up. I've also learned about a new command: `npm ci`. I'd always used `npm install` to install my dependencies even in environments running Continuous Integration, but apparently this command [was added](https://blog.npmjs.org/post/171556855892/introducing-npm-ci-for-faster-more-reliable) about a year ago to ensure "getting exactly what you expect on every install". Why wouldn't this already happen with `npm install` is beyond my comprehension.

On getting things done week, I managed to finish the first version of soukai-solid, and I've already integrated it in Solid Focus (in the development branch). There haven't been any major drawbacks yet, so I'll get into defining relations between models and I think I'll have a first version fully migrated to Soukai soon.
