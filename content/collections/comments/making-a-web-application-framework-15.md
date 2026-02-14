---
id: making-a-web-application-framework-15
blueprint: comment
title: 'Making a Web Application Framework - 15'
task: 'entry::making-a-web-application-framework'
publication_date: '2026-02-14T13:10:22+01:00'
---

It's been a few months since I updated this task, but today I finally have something to share.

If you've been following my work, feel free to skip this paragraph, but TLDR last year wasn't my best. At the end of 2024, [I quit my job with the intention to work on Solid full-time](https://noeldemartin.com/blog/the-end-of-the-chapter#the-plan) (and that blog post was quoted in Tim's latest book, [This Is For Everyone](https://thisisforeveryone.timbl.com/)!). But 2025 wasn't great. I spent the first few months fumbling, and ultimately [I didn't secure any funding](https://noeldemartin.com/blog/the-soul-crushing-reality-of-job-seeking#the-nlnet-fiasco). What's worse, I wasted ~7 months waiting for an answer instead of being proactive making something on my own. I also failed at getting a job related to Solid or anything like it. Suffice to say, I got burned out from Solid. So I [dabbled with other technologies](https://noeldemartin.com/tasks/making-a-shows-tracker-with-jazz), and started reconsidering what to do with my side-projects.

However, at the end of 2025 I found myself looking back on the past few years, and realized that the most happy I'd been with my side-projects was when I [just followed my curiosity](https://noeldemartin.com/blog/working-in-the-open-when-no-one-is-looking#what-is-it-for). I also noticed that, after years of seeking, I hadn't find anything that came even close to Solid to realize [My Software Ideals](https://noeldemartin.com/blog/software-ideals-in-the-age-of-ai). So I made a decision for 2026. This year, I'm back on the Solid horse! But this time, I'm back to my pre-2025 attitude. I'll be working on it just to scratch my own itch, not with any aspirations of making a living.

But there is something else that happened at the end of 2025. Many people cite that period as [the inflection point for AI](https://x.com/aarondfrancis/status/2009104656627351675). I'm not 100% there, but I do agree that AI is getting better by the day, and it is already useful to me in many ways (just not enough to make me stop looking at the code 😅). With that landscape, I also wondered if it made sense to keep working on Solid or Aerogel, which prompted me to write my recent blog post on Software Ideals. And I came to the conclusion that indeed, it's still relevant (maybe more than ever), and I'll keep working on this. If anything, if I were to believe the hype, I should be able to take advantage of these new capabilities to do things I could never have done before.

And that's why, at the beginning of 2026 🥁... I started rewriting [Soukai](https://soukai.js.org/) from scratch!! Wait, what!? Let me explain.

So, I created Soukai in 2018, before I even knew that Solid existed. Since then, I have been evolving it to support many new paradigms: RDF, Solid, CRDTs, etc. And I did all of those as "optional" features. Some even in a separate package, like `soukai-solid`. But at this point, I have decided to go all-in, and it's time to remove all the unnecessary abstractions. And it's not simply a rewrite for its own sake. As I mentioned a few months ago, working on a Shows Tracker really stretched the current implementation, and I was unable to realize that vision. For this rewrite, I've been thinking about some architectural improvements that should make that a lot more manageable. My experiments with other technologies will also bear fruit, because I really enjoyed Jazz's DX and I'm going to borrow from that.

Actually, at the time of this writing, I have already rewritten most of it! Initially, I tried to rely on AI, because all that excitement at the end of the year made me believe that maybe a rewrite wouldn't be a task beyond AI models anymore. However, it hasn't been as smooth as that, so I've had to do a good amount of coding myself. But it has definitely speed me up!

If you're curious to see what this new version looks like, I have already migrated my Ramen application. You can find it in the `soukai-bis` branch, and you can see all the changes that were necessary (at the application layer) in [this commit](https://github.com/NoelDeMartin/ramen/commit/5096dbb1e4938b7b4b458451ef9027f90543ea6f).

Now, I still have to rewrite some functionality specific to CRDTs and syncing, as well as migrating all the Aerogel stuff. But so far, it's looking good, and I'm excited about Solid again!

PS: I'm also going to start a brand new project, closely related with this task and Solid, but much more AI-focused. Stay tuned ;).
