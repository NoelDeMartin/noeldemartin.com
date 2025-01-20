---
id: implementing-a-media-tracker-using-solid-6
blueprint: comment
title: 'Implementing a Media Tracker using Solid - 6'
task: 'entry::implementing-a-media-tracker-using-solid'
publication_date: '2020-04-13 17:45:06'
---

Today I want to write a short update on how things are going. I thought by now I'd be almost finished, but turns out I just found something important to improve and that'll probably delay the release even more. I still expect it to happen shortly though, in about 2-3 weeks.

The past two weeks I've been finishing the UI and the only thing that's missing now is the initial loading screen. I've been doing some tinkering with data fetching, and I believe I'll be able to make it _really_ fast (compared with [solid-focus](https://noeldemartin.github.io/solid-focus/) which is kind of slow at the moment). I'll have 1500 movies in my account, and that's what I've been using for testing locally.

Something else I've done is [deploying the app](https://noeldemartin.github.io/media-kraken/) using github pages (don't use it yet because there'll be breaking changes for sure!). I had some issues with routing that should be solved now. The problem was that some of the application routes, for example `/collection`, lead to a 404 github page. The reason for that is that github expects to have an html file in every route and the application is a Vue SPA using [vue-router](https://router.vuejs.org/). I'm surprised that I didn't find many resources on how to solve this, but I ended up [doing a simple script](https://github.com/NoelDeMartin/media-kraken/blob/6db3fce0fba09fdec4773d5b31ee34f5ddc6555c/src/routing/github-404.ts) to handle that.

I've also set up [a CI testing environment](https://github.com/NoelDeMartin/media-kraken/actions?query=workflow%3ATesting) using github actions. If I hadn't done this before that's because I was in exploration mode, and the app is now starting to become stable enough for a first release. I normally use a TDD*ish* approach to development, but I do 0 tests when I'm exploring or tinkering with new concepts. The same applies to documentation.

Something else interesting I've been doing is a [markdown component](https://github.com/NoelDeMartin/media-kraken/blob/6db3fce0fba09fdec4773d5b31ee34f5ddc6555c/src/components/MarkdownContent.vue) that allows me to simplify the generation of text-based app content. This may be a bit overkill, but I've enjoyed doing it and it allows me to do things like [defining modals entirely with markdown](https://github.com/NoelDeMartin/media-kraken/tree/6db3fce0fba09fdec4773d5b31ee34f5ddc6555c/src/assets/markdown) and having some nice [interactive import logs](https://github.com/NoelDeMartin/media-kraken/blob/6db3fce0fba09fdec4773d5b31ee34f5ddc6555c/src/components/modals/ImportResultModal.vue).
