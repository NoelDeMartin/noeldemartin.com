---
id: housekeeping-4
blueprint: comment
title: 'ousekeepin - 4'
task: 'entry::housekeeping'
publication_date: '2020-11-27 11:06:05'
---

Today I finally released the Media Kraken improvements I've been working on for the last couple of months. I won't go into detail because I've already talked about that in previous journal entries, you can check out [the release notes](https://github.com/NoelDeMartin/media-kraken/releases/tag/v0.1.4) for a summary.

Something interesting happened with this release though. It's the first time that I think it's important to make an "announcement" that reaches all my users. In previous updates I just added improvements or fixed small bugs, but this release is very important for `solid.community` users. When the domain disappeared, Media Kraken stopped working. This release makes it usable again. But given the nature of Solid (and the way I'm publishing my app), it's not possible to reach them; I don't even know how many users I have. But after some thought, I decided to just tweet/toot about the new release.

This worry comes from the fact that I make my apps thinking about non-technical users. But the reality is that most of them are probably developers. I also know that my audience is very small (after publishing [my latest post](https://noeldemartin.com/blog/working-in-the-open-when-no-one-is-looking), only [one person reached out](https://mastodon.social/@vinnl/105084388798262265) – thanks Vincent!). So at this point, I think it's not worth it to spend any more time on this. It'd be great to have non-technical users, and maybe some day I'll work on growing that audience. But for now I'll focus on other things.

After this update, I don't think I'll be working on Media Kraken for a while. I still have some Housekeeping TODOs, and I want to start working on my 3rd Solid app by the end of the year. But I still use it every day, as well as Solid Focus. So I'll resume development for sure and add some important missing features like tracking TV Shows.

The last thing I'll do before closing this task is learn more about building node libraries. I've had Soukai published for a while, and it works. But there is a lot of room for improvement, so [I'm creating a utils package](https://github.com/noeldemartin/utils) to tinker with a couple of things on a small project. In particular, these are the things I want to look into:

- Use Rollup instead of Webpack.
- Make sure that tree-shaking is supported.
- Generate TypeScript declarations automatically.
- Include source maps in the release package.
- Generate stack traces pointing to the source code (not the minified bundle).
