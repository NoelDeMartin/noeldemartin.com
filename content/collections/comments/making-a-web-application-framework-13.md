---
id: making-a-web-application-framework-13
blueprint: comment
title: 'Making a Web Application Framework - 13'
task: 'entry::making-a-web-application-framework'
publication_date: '2025-08-10 09:08:00'
---

Hey!

Yes, I'm still alive. I can't believe it's been more than 2 months since my last update 🙈. But the truth is that I don't have much to share about this task :/. Still, I'm going on holidays next week, and I have a couple of things worth mentioning, so I thought it was time for an update.

First of all, in case you missed it, I published a video going through the making of an entire Aerogel app :D. That was fun, and I'm quite happy with how Aerogel is coming up. There isn't really anything new in that video that I haven't already mentioned before; but it's a good summary of what I've got so far. If you're interested, check it out: [Pocket is going away... Let's build a replacement with Solid!](https://www.youtube.com/watch?v=Xtxwbz7LrfU).

Other than that, I've quietly continued working on my [Shows Tracker](https://github.com/NoelDeMartin/shows-tracker?tab=readme-ov-file#-shows-tracker) app. And I have "finished" the first version, but I have some bad news :(.

Everything was going pretty well at the beginning. I was happy [Vibe Coding away](https://github.com/NoelDeMartin/shows-tracker?tab=readme-ov-file#wait-a-second-did-you-say-vibe-coding-how-much-did-the-ai-write), and it seemed like Aerogel was finally complete enough to make an app without worrying too much about the framework. But then, I loaded my actual shows collection, and everything slowed down to a crawl 😅. I was already aware of some of the limitations with my current approach, as I wrote in [my proposal to NLNet](https://noeldemartin.com/downloads/nlnet/aerogel.pdf) (check out the "Technical Challenges" section). And this use-case showed me that I was right.

So far, I haven't built any "data-intensive" Solid application. At the time of this writing, I have 2811 movies in Media Kraken, 1159 tasks in Focus, and 118 recipes in Umai. But working with shows is a whole other level... One Piece alone has more than 1000 episodes, and I have 281 shows in my collection! (mind you, many of those are "want to watch", I haven't seen that many... yet). And it's not just the amount of data, but the fact that it's also interconnected, with episodes pointing to seasons, seasons pointing to shows, individual watch actions for each episode, etc.

Now, let me recognize that, really, this isn't data-intensive either. All of this data won't take more than a couple of MB in my Pod, and I can't really say that I have a data-intensive application until I have maybe millions of documents. But the thing is, that _with my current approach_ this _is_ data-intensive. And this isn't the first time that I'm facing a similar situation. When I started working on Media Kraken, I spent a bunch of time [refactoring model serialization](https://noeldemartin.com/tasks/implementing-a-media-tracker-using-solid#comment-8), and when I worked on Umai, I [made it truly local-first](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid#comment-6). So maybe the solution to my current problems is just one big refactor away.

But things are diffrent now. I don't have a 4-day workweek anymore, which leaves me very little time for side projects. And to be honest, the whole [NLNet fiasco](https://noeldemartin.com/blog/the-soul-crushing-reality-of-job-seeking#the-nlnet-fiasco) and [subsequent developments](https://noeldemartin.social/@noeldemartin/114745305327263276) have left me very unmotivated. So now, more than ever, I'm scratching my own itch. And I'm not sure that all this complexity is paying off. After all, I've been working on this for 6 years now, and I'm still only using my own apps (and I can't say I'm excited about any other Solid apps).

So yeah, I don't know... I have some soul-searching to do. I'm still excited about Solid's vision and ideals, and I still agree with most of the things I wrote in [my reasons to use Solid](https://noeldemartin.com/blog/why-solid). But I just don't have the time or motivation to go through one of those dips again. At least, not right now.

Then, what are the next steps for this task? I still want a Shows Tracker very badly, but I'll leave that aside for now, and focus on finishing some other of my Personal Apps. Namely, my [Calories Tracker](https://github.com/NoelDeMartin/calories-tracker) and [Diogenes Reader](https://github.com/NoelDeMartin/diogenes-reader). Those should be easy enough to work with, and I'll continue exploring the woes and wonders of making apps in this AI-age.

Until next time, whenever that may be!
