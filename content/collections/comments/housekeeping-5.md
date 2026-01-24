---
id: housekeeping-5
blueprint: comment
title: 'Housekeeping - 5'
task: 'entry::housekeeping'
publication_date: '2020-12-08 08:54:04'
---

I've finished working on my utils package, and it ended up being easier than expected! If anything, the reason why it took me this long (2\~3 days) is that I got entranced into doing some [advanced TypeScript stuff](https://github.com/NoelDeMartin/utils/commit/b4215f958ef5b2aa71d16cd686b461287f1d707e#diff-70456a8802c1b74bb7e222f166e4b599a222635cd9fbacc7d69a193ee017a698). But I ended up dialing it down a bit; I simplified the types by foresaking having a single source of truth for some definitions. Mostly because I was using some new TypeScript 4.1 features and I think the tooling is not ready for them. If you're interested to know what all that TypeScript wizardry is trying to achieve, you can read the documentation where I explain the [Fluent API](https://github.com/NoelDeMartin/utils#fluent-api) included in the package.

Something interesting in this task is that I did some source code diving. I am usually able to find what I need from reading documentation or blog posts, but this time something eluded me and I found the answers looking at the [Vue 3 source code](https://github.com/vuejs/vue-next). As a byproduct of that, I learned about [TypeScript type tests](https://github.com/vuejs/vue-next/tree/master/test-dts) and I also incorporated some of that in the package. If you're interested in learning advanced TypeScript, I recommend looking at this repository: [github.com/type-challenges/type-challenges](https://github.com/type-challenges/type-challenges)

As I mentioned in the previous comment though, my goal with doing this package was to learn more about authoring libraries. And I'm happy to say that learning [Rollup](https://www.rollupjs.org) has solved 90% of my problems. The documentation is great, and in contrast with Webpack I could understand what it's doing in an afternoon. So yeah, I don't think I'll use Webpack ever again if I have a choice. I also should mention that I came across a new tool called [esbuild](https://esbuild.github.io/). It is unbelievably fast, building my package was literally instantaneous. But that's the only advantage I found, so I'm sticking with Rollup for now.

Tree-shaking and sourcemaps are very easy to achieve with Rollup. To generate Typescript declarations I tried a couple of tools, and I ended up using [@microsoft/api-extractor](https://api-extractor.com/). It wasn't as smooth a sail as learning Rollup, but after reading the docs and tinkering for a bit I got it working. I had to write [a custom script](https://github.com/NoelDeMartin/utils/blob/main/scripts/build-types.js) to achieve my goals, but nothing too complicated.

Finally, I wanted to use sourcemaps in production. There were two reasons for this: [paying tribute to the web](https://m.signalvnoise.com/paying-tribute-to-the-web-with-view-source/) and <a href="#comment-4">generating readable stacktraces in the UI</a>. The first one was easy to achieve, although I didn't manage to do it with Webpack and had to use Rollup again in the application side. The second one was more tricky because sourcemaps are only downloaded when the dev tools are open, so a stacktrace displayed in the UI will still be gibberish. But I got it working with a library called [sourcemapped-stacktrace](https://github.com/novocaine/sourcemapped-stacktrace). I'm still not 100% happy with that setup, but those are application-side issues, so I can tell that the sourcemaps are being published properly.

And with this, I consider the task finished. It's been open long enough to be a "maintenance" task!
