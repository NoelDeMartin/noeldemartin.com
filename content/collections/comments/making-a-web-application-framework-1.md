---
id: making-a-web-application-framework-1
blueprint: comment
title: 'Making a Web Application Framework - 1'
task: 'entry::making-a-web-application-framework'
publication_date: '2023-05-27 08:27:52'
---

I never thought I'd be creating a framework, but here we are. Though I have to say it probably sounds more grandiose than it is. I'm not trying to reinvent the wheel. Rather, I intend to encapsulate what I'm already doing in my apps in a way that's easier to use. So it'll definitely be built on top of [Vue](https://vuejs.org/), [TailwindCSS](https://tailwindcss.com/), and [Soukai](https://soukai.js.org/).

But I have to start this task with a confession. I've already been working on this for a while 🙈️. Whilst doing [the previous task](https://noeldemartin.com/tasks/configuring-a-self-hosted-nextcloud-server), it was so boring that I just started to tinker on this "on the side". You may not know this, but I work 4 days a week at [Moodle](https://moodle.com/), and I allocate 1 day a week to "side-project work"; which is what I write about in this website. In a way, you could say I have a normal 5 days workweek; it's just that I'm self-employed 1 day a week (and I don't have a salary xD). But that means that I still have free weekends and afternoons where I do "life stuff" (not related to programming). However, as things go, sometimes I end up coding anyways. That's usually the same as my side-project work, but during the last month that has felt like a chore and I didn't feel like working on it. So you could say this has been my side-side-project 😅️.

Anyhow, I'm focusing my full attention on this now!

I started making apps "seriously" about 4 years ago (I've talked about this [in a recent talk I gave at FOSDEM](https://noeldemartin.com/fosdem)). During this process, I've been mostly learning about [the Solid Protocol](https://solidproject.org) and how to make apps the best they can be (according to my tastes, of course). At the beginning, there was a lot of things that changed from one app to the next, but now I feel like I've converged on a certain architecture. The trouble is that I'd like to update my earlier apps, but I don't want to make a complete rewrite. So that's the basic idea and motivation for this task.

My ultimate goal with all of this is being able to focus on the UX of the app itself, rather than thinking about Solid or how to organize my code. I want to avoid [accidental ~~complexity~~ complication](https://www.youtube.com/watch?v=WSes_PexXcA) through [conceptual compression](https://www.youtube.com/watch?v=zKyv-IGvgGE&t=1037s). The funny thing is that I was already doing that, back in the days when I was using [Laravel](https://laravel.com/). But when I started working on Solid Apps, I lost that. I regained the data layer with Soukai, and I want to create this framework for everything else.

So today, it's official. I'm working on [Aerogel](https://github.com/NoelDeMartin/aerogel)!
