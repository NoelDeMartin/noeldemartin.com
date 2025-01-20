---
id: implementing-a-recipes-manager-using-solid-3
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 3'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2021-03-10 20:24:29'
---

It's been 4 weeks since the cycle started, and here's how the [Hill Chart](https://basecamp.com/shapeup/3.4-chapter-13#work-is-like-a-hill) looks like (yes, I even started using Basecamp!):

![Hill Chart](/img/tasks/hillchart-2020-03-10.png)

You'll notice that I've only gotten over the hill in one scope: Soukai Next Generation. It may look disappointing, but to be frank I'm happy with the results (which I'll get into in a second). I think this time I'm finally doing Shape Up right*ish*. One of the ideas I was more excited about from the book was "fixed time, variable scope". Specially given my situation; I'm only working one day a week on Solid. So time is more precious than usual.

Now, let's get into the meat of Soukai Next Generation. Like always, I'm wondering whether the work I'm doing is even worth it or I'm shaving yaks. 90% of what I've been doing these 4 weeks has been purely focused on developer experience, or said differently, "not necessary". But I'm enjoying it and I'm happy with the progress, so it's worth it in my book.

The first thing I did was migrating to Rollup and ESLint (from Webpack and TSLint). This seemed pretty useless at first, but later on it paid off when I started working in Viteland. I started doing this by hand in each project, but it became cumbersone quickly so I ended up extracting the build configurations into [their own repository](https://github.com/NoelDeMartin/scripts). Other than upgrading the tooling, I also learned a bit more about all the flavors of javascript. I identified 3 environments where my libraries can be used: Other libraries or apps (will normally use the ESModules build), scripts and tests (will normally use the CommonJS build) and plain HTML (will include the UMD build as a script tag in a page). The latter use-case is the only one that I don't use myself, but I'll still document it because I think it's interesting for getting started without a build step. During this upgrade, I also understood the polyfills I'm actually shipping with the libs and the environments I'm supporting (before this I think webpack was using babel under the hood but I'm not even sure).

Something else I did was improving TypeScript inference in models. It's still not as good as I'd like, but I've removed a couple of annoyances and improved many things. So that's been a big win. I'll document all of this more in depth when I release the next version (which I already know _will not_ happen during this cycle). [Here are some tests](https://github.com/NoelDeMartin/soukai/blob/next/src/models/Model.test.ts#L875) about the new inference in case you're curious.

As you can see in the Hill Chart, I've also advanced on using Vite and implementing the app. Thanks to the previous work, Soukai now works out of the box with both Vite and Webpack. As I suspected, Vite is a joy to work with once you don't have issues with external libraries. I've even been using a couple of plugins to do some magic stuff and it's working great. I know it won't always be like this, because some library will eventually fail to compile with Vite (I already know this happens with some of the authentication libraries I'm using). But I also have a plan for that, I'll bundle problematic libs with webpack as [I did in this issue](https://github.com/vitejs/vite/issues/1915).

The current status of the app is very basic, but I'd say the foundations are laid out and that's why it's halfway uphill. It's not usable at all, but if you're curious about [the code](https://github.com/NoelDeMartin/umai) now it's actually a great moment to take a look because there is so little.

The custom vocab thing is something I didn't even start, and I think I'll drop it for this cycle. The nice thing about Shape Up is that this doesn't mean that I'll pick it up on the next cycle, because it's important to [keep the slate clean](https://basecamp.com/shapeup/2.2-chapter-08#keep-the-slate-clean). So it'll compete against all the other things I want to do in my next betting table.
