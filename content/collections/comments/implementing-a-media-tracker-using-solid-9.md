---
id: implementing-a-media-tracker-using-solid-9
blueprint: comment
title: 'Implementing a Media Tracker using Solid - 9'
task: 'entry::implementing-a-media-tracker-using-solid'
publication_date: '2020-07-19 10:02:55'
---

After 6 months of starting this task, I can finally say it:

**I've released the Kraken!**

I'll make the official announcement in social networks next week, but I'm certainly closing this task now and I don't expect to change anything big.

The last couple of weeks I've been tying some loose ends and doing a review of this first release. I'm still doubtful about some implementation details in my approach to use Web Workers, but I think the design choice is correct. Something I'm not too happy about is caching and the way data is managed, but there are some limitations that I'm not sure how to overcome. I've [opened a post](https://forum.solidproject.org/t/state-of-the-art-for-querying-large-containers/3320) in the Solid forum to start a conversation about this. And I found [yet another unimplemented Solid feature](https://github.com/solid/solid-auth-client/issues/129).

I have to say that I'm becoming more disappointed by the Solid community each day. I'll continue supporting the project and making Solid apps because I still share the underlying values and vision. But the developer experience is very bad, and I struggle a lot in making things work that in other contexts would take me 5 minutes. I've been lurking in the Solid community for about two years now, and it seems like there is a lot of talking and theorizing but I still have to see a single Solid application that I really love (and yes, I include my apps in that bucket). It seems to me like one solution would be to implement my own Solid POD. But I don't really have the knowledge, time nor motivation at the moment. This is in stark contrast with the Laravel community, which continues to delight me and it's very hands-on.

Anyways, coming back to Media Kraken. I've updated the documentation and released new versions of the three projects: [soukai](https://soukai.js.org/), [soukai-solid](https://github.com/NoelDeMartin/soukai-solid/) and [media-kraken](https://github.com/NoelDeMartin/media-kraken). I also started using the `main` branch name (instead of `master`) in Media Kraken, I'll eventually do that with all my projects. And I also started looking into better ways to build npm libraries, like [rollup](https://rollupjs.org/guide/en/) and [api-extractor](https://api-extractor.com/). But I caught myself getting into another rabbithole so I decided to leave this for another day.

Now, before closing this task let's look at time dedication. In total, I've dedicated 278 hours to this task. That's about 7 weeks of full-time work. However, given that this is a side-project and I've had stops in between, it's taken me 6 months. Here's the hours breakdown (the first weeks don't have a description because they were within appetite budget):

<details>
	<summary>Time dedication hours breakdown</summary>
	<ul>
		<li>Week 1 - 11 hours</li>
		<li>Week 2 - 0 hours</li>
		<li>Week 3 - 3 hours</li>
		<li>Week 4 - 7.5 hours</li>
		<li>Week 5 - 9.5 hours</li>
		<li>Week 6 - 9 hours</li>
		<li>Week 7 - 19.5 hours (Logo & Responsive/Animations)</li>
		<li>Week 8 - 15.5 hours (Search, Login, Welcome, Modals)</li>
		<li>Week 9 - 6 hours (Final UI)</li>
		<li>Week 10 - 12.5 hours (Dynamic badges, Send to collection animation, Snackbars, Menu)</li>
		<li>Week 11 - 18 hours (Movie UI Refactor, Deploymnet & UX Tweaks)</li>
		<li>Week 12 - 9.5 hours (Modeling refactor, Import UX, Testing)</li>
		<li>Week 13 - 20 hours (Testing, Pagination, Models Caching)</li>
		<li>Week 14 - 15.5 hours (Web Workers, IndexedDB)</li>
		<li>Week 15 - 12 hours (JSON-LD models serialization)</li>
		<li>Week 16 - 7.5 hours (JSON-LD models serialization, Relationships refactor)</li>
		<li>Week 17 - 17 hours (Relationships refactor, Embedded->Documents refactor)</li>
		<li>Week 18 - 13 hours (@graph Filters & updates, RDFDocument refactor, Engine Caching)</li>
		<li>Week 19 - 10 hours (Relationships refactor, Relations Caching, Kraken Caching)</li>
		<li>Week 20 - 16 hours (Kraken Caching, Import/Export JSON-LD, Testing)</li>
		<li>Week 21 - 2.5 hours (Testing)</li>
		<li>Week 22 - 4.5 hours (Tweaks, JSON-LD url minting)</li>
		<li>Week 23 - 9 hours (Tweaks, Caching)</li>
		<li>Week 24 - 12 hours (Solid modeling, Filters/sorting)</li>
		<li>Week 25 - 5 hours (Documentation)</li>
		<li>Week 26 - 11.5 hours (Documentation, Release)</li>
	</ul>
</details>

It'd be an understatement to say that I've exceeded the initial appetite of 40 hours. It's been 7x times that. However, I have already talked about it previously. It has been mostly a conscious decision, and most of the overtime has gone to either UI tweaks (which I enjoy working on) or library development (which I believe will yield benefits in the long term). The actual core of the application was done in the 40 hours budget, but I cannot deny that I've mismanaged this. I suppose the proper way of doing this would've been closing the task at 40 hours, and open new tasks (or "bets" in shape-up language). If this pattern keeps repeating, I'll have to do something about it. In general I don't mind dedicating more time to UI, but I wouldn't like having to dedicate more time to library work given that the whole idea is to make my life easier.

And now, I can start using Media Kraken in my daily life!
