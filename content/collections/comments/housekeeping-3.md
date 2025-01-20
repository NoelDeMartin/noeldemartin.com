---
id: housekeeping-3
blueprint: comment
title: 'ousekeepin - 3'
task: 'entry::housekeeping'
publication_date: '2020-10-15 11:22:01'
---

[Oops... I did it again](https://www.youtube.com/watch?v=a6_Jf8So534).

It's been a month and a half since I updated this task. But I haven't been idle, quite the opposite. I started working on many threads that became rabbitholes, so [here we are again](https://noeldemartin.com/tasks/implementing-a-media-tracker-using-solid#comment-8). I think it's about time to write an update, even if many threads remain open. Sorry in advance, because this is going to be a long one.

Let's start with Media Kraken. As part of the housekeeping, I wanted to improve a couple of things I didn't do in [the previous task](https://noeldemartin.com/tasks/implementing-a-media-tracker-using-solid).

The first one was to improve error tracking. I thought this would be straightforward (and let's face it, it is). But I got too excited and ended up creating a new UI to display errors. I am also experimenting with how much technical details I should be showing in the UI. Non technical-users may get scared when they see the stack trace, so maybe I'll reconsider it in the future. But for a first approach I think it's good enough. Users shouldn't experience errors anyways 🤞. Besides the new UI, I've also refactored error handling on start up, and I've provided some scape hatches when things go wrong. Here's a video showing some of these things:

<a href="https://noeldemartin.com/videos/media-kraken-errors.mp4" target="_blank">
    <video autoplay loop>
        <source src="/videos/media-kraken-errors.mp4" type="video/mp4">
    </video>
</a>

The second thing related with Media Kraken was to improve how I generate movie resource ids. In the current implementation, movie resources are created with the same id as their document. For example, a movie found at `https://your-pod.com/movies/spirited-away` would use that url as id. However, this is not entirely correct because that's the id of the document, and the movie is a different entity. The correct way is to have an id like this: `https://your-pod.com/movies/spirited-away#it`, where `it` could be anything. When I started working on this I knew it wasn't going to be straightforward, because it required some modifications in Soukai. But I wanted to do it in this housekeeping task before I get into other things.

And finally, the last thing relating to Media Kraken was [the solid.community drama](https://gitlab.com/solid.community/proposals/-/issues/16). This is not directly related with Media Kraken, but it affects the Solid ecosystem and it's surfaced [some bad practices](https://github.com/NoelDeMartin/media-kraken/issues/8) I wasn't aware of. I won't get into the drama part, but the gist of the issue is that one of the most (if not THE most) popular POD providers is gone. This is a problem because having a stable POD provider is important to reduce friction for non-technical users comming into Solid. After that happened, [it was revealed](https://lists.w3.org/Archives/Public/public-solid/2020Oct/0029.html) that the person managing the domain wasn't managing the data, so everything has been migrated to [solidcommunity.net](https://solidcommunity.net). The part where it concerns me is that I'm thinking what to do for Media Kraken users. For sure, I'll fix the bad practices. But I'm pondering whether to assist non-technical users in migrating their existing data. I don't like the idea of hard-coding domains in my source code. But I guess it'll be the best for users, and it's also a good opportunity to learn about migrating data in Solid.

I also tried replacing [Sentry](https://sentry.io) with [Glitchtip](https://glitchtip.com). To be honest, I don't like Sentry, because it tracks too much information (location, behaviour, etc.). But I don't think Glitchtip is ready to replace it yet, in particular because it doesn't send emails and I'm not willing to check in periodically. At least I've implemented error reporting as opt-in, so most people won't be using it.

So, that was Media Kraken.

On another front, I've been preparing a follow up to my [Open Productivity](https://noeldemartin.com/blog/open-productivity) post. I won't give away what it's about, but one of the conclusions I got was that I need a new section in the website. It isn't anything big, but when I started working on it I also started migrating to Laravel 8 to use new features and that also became a rabbithole. I think I'll move those changes to a different branch and create the new section without new features. I've had this post written for a couple of weeks, so I'm itching to publish it.

Something else that's happening now is [Hacktoberfest](https://hacktoberfest.digitalocean.com). Last year I participated as a contributor, and this year I wanted to explore what I can do as a maintainer. I opened a couple of issues with the #hacktoberfest label, and I was surprised in how fast I got pull requests. Unfortunately, the quality of those contributions wasn't great. Which is to be expected, frankly. Most people just want a t-shirt. So I think that's were my Hacktoberfest Maintainer Adventures end. But I think I'll complete my contributor PRs, and this year I'll totally choose planting a tree instead of getting the t-shirt. I already have the one from last year, so I don't want to generate more waste.

So yeah, I started this task with a small scope and it's blown up. What I don't like is that a big chunk of this work comes from external events, instead of my own decisions. I could make the decision to ignore these things, but I think it's ok to dedicate some time to community work. What I wouldn't like is that this becomes my new normal. I'll keep an eye on that.
