---
id: making-a-web-application-framework-2
blueprint: comment
title: 'Making a Web Application Framework - 2'
task: 'entry::making-a-web-application-framework'
publication_date: '2023-07-01 08:07:48'
---

I haven't reached any important milestones yet, but it's been a month since I started working on this so I thought I'll give a short update on how things are going.

One of the new things I'm trying with this project is using a mono-repo. I have seen this in other frameworks, so I thought I'd give it a try and so far it's working great. I could have used some tools such as [Lerna](https://lerna.js.org/) or [Turborepo](https://turbo.build/repo), but I started with npm's built-in in [workspaces](https://docs.npmjs.com/cli/v7/using-npm/workspaces) and so far that's enough.

I also tried using [Vitest](https://vitest.dev/), and it's also very nice. It's been very easy to get started with since it works mostly like [Jest](https://jestjs.io/), but mocking has been far easier and everything seems faster. There are also some neat features such as [Testing Types](https://vitest.dev/guide/testing-types.html) that are missing from Jest. It also lives up to the promise of working with the same Vite config in my apps, but for library packages I'm using Rollup so the configuration isn't unified yet. Although I'm giving serious consideration to using Vite for bundling libraries as well. I'll explore that at some point.

Other than that, there isn't much else worth sharing. But if you're curious, I have set up [a playground](https://aerogel.js.org/playground/) with some of the basic features I've been working on. There is also links to the source for each page, so if you're curious that should give you an idea of what working with the framework will look like.

Funnily enough, I still haven't added any Solid-specific functionality; that will come from Soukai and extracting the [Authenticator](https://github.com/NoelDeMartin/umai/tree/main/src/framework/auth/authenticators) pattern I'm using in my apps.

Given that we're in summer now and [I'll be working less than usual](https://noeldemartin.com/tasks/working-from-japan), I don't expect to have any relevant updates for a couple of months. That's also the reason why I'm not thinking of my [appetite](https://basecamp.com/shapeup/1.2-chapter-03#setting-the-appetite) or setting any deadlines yet. But I'll probably start thinking about that in September/October.
