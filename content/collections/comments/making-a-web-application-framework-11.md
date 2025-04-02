---
id: making-a-web-application-framework-11
blueprint: comment
title: 'Making a Web Application Framework - 11'
task: 'entry::making-a-web-application-framework'
publication_date: '2025-04-02 08:51:45'
---

Hi there! If you're reading this, chances are that you already know, but in case you don't... I finally heard back from NLNet, and [I didn't get the grant](https://noeldemartin.social/@noeldemartin/114116126924436827) :(. I wrote all about it in a recent blog post, make sure to read it if you want to learn more: [The Soul-Crushing Reality of Job Seeking](https://noeldemartin.com/blog/the-soul-crushing-reality-of-job-seeking).

So yeah, the title says it all, I'm back on the job hunt 😅. I've applied to more offers than ever (17 since publishing that post 😱), and indeed the market is not at its best. Still, I can't complain, because I have some opportunities in motion and it's very likely that I'm back to work in May. However, my predictions were totally on point, because none of the opportunities are Solid-related, and most of them came through networking (meaning, people who already knew who I am). Unfortunately, that means that my work in Solid will be relegated to side-projects again, and I'll probably spend even less time than before because I doubt I'll be able to get a 4-day workweek. Such is life 🤷.

On a brighter note, I did finish working on schema migrations and interoperability! Yesterday [I published a video](https://www.youtube.com/watch?v=EAFHV7dIx8c) going over it, but TLDR: Focus now works with multiple schemas, and is backwards compatible with the legacy version which I haven't touched in 5 years :D. I also released [a new version of Soukai](https://github.com/NoelDeMartin/soukai/blob/main/CHANGELOG.md#v060---2025-03-31), so you can start doing similar things in your apps.

Something else I've done is modernize the tooling for all my packages! The setup I was using before was [4 years old](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid#comment-4), which translates to decades in JavaScript land. And I'm very happy with the new approach, because I'm using Vite for everything, which removes a lot of headaches. I also dropped CommonJS, with newer versions of Node supporting ESM and most of the ecosystem moving towards [ESM-only](https://antfu.me/posts/move-on-to-esm-only). I did try to use AI to assist me in the process, but I have to say that it still isn't there :/. Now we have [Vibe-coding](https://en.wikipedia.org/wiki/Vibe_coding) and many other ways of replacing the fun parts of programming, but I'm still stuck with my dependency hell! Hopefully this new unified setup will make it better :).

But I still have some more updating to do. When it comes to Aerogel, there are still a couple of things I'd like to upgrade, such as:

- TailwindCSS v4
- Vue, Vue Router, and Vue i18n
- ESLint --> [Oxlint](https://oxc.rs/docs/guide/usage/linter.html#linter-oxlint)?
- Headless UI --> [Reka UI](https://reka-ui.com/)?
- Cypress --> [Playwright](https://playwright.dev/)?
- Histoire --> [Storybook](https://storybook.js.org/)?
- Vivant --> [Motion for Vue](https://motion.dev/blog/introducing-motion-for-vue)?
- [shadcn/vue](https://www.shadcn-vue.com/)?

That's obviously a huge list, and I'm not sure how far I'll take it. But now that I won't be working on this full-time, and it's become pretty clear that I'm not going to make a living from this, I'm in no rush any longer 😅. Today, more than ever, I'm scratching my own itch.

On that note, I have been using Focus in production for a couple of weeks, and it's very close to being done :D. I still come across some syncing issues now and then, but hopefully I'll be able to polish them without too much effort. At this point, the only things keeping me from releasing the app are the library upgrades I mentioned, doing a performance review, and doing some final polishing. Who knows, maybe by the end of the month I'll be done. Or maybe it'll take another year.
