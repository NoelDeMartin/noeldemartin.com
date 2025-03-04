---
id: making-a-web-application-framework-10
blueprint: comment
title: 'Making a Web Application Framework - 10'
task: 'entry::making-a-web-application-framework'
publication_date: '2025-03-04 11:45:12'
---

Well well well, I can't believe it's been almost 8 months since I updated this task 😱. However, I have been doing some related work, and I've shared a handful of personal updates. If you want to get the full recount, make sure to read through the tasks I've completed in between: [Taking a Sabbatical](https://noeldemartin.com/tasks/taking-a-sabbatical), [Housekeeping 2024/25](https://noeldemartin.com/tasks/housekeeping-202425), and [Attending FOSDEM 2025](https://noeldemartin.com/tasks/attending-fosdem-2025).

TLDR:

- I built my own Solid Server from scratch (and have been using it in production for weeks!): [LSS](https://lss.noeldemartin.com/).
- I extracted Focus animations into my own new animations library: [Vivant](https://noeldemartin.github.io/vivant/).
- I applied for [NLNet's October call](https://nlnet.nl/news/2024/20240601-call.html) (I'm STILL waiting for a decision, but at least I've been selected for the 2nd round).
- I played with [ActivityPods support](https://github.com/NoelDeMartin/ramen/blob/main/docs/activitypods.md).
- I was included in the [Solid Data Modules NLNet grant](https://nlnet.nl/project/SolidDataModules/) to work on data migration for Soukai/Aerogel.

This last point is obviously the most relevant to this task, as I've been able to work on this full-time for most of February :D. Also, I recently presented at Solid World talking about [Interoperable Serendipity](https://noeldemartin.com/solid-world-2025), you may want to catch the recording once it's available.

Initially, [I was very enthusiastic](https://noeldemartin.com/tasks/housekeeping-202425#comment-3) about working on my projects full-time. And I still am, these have been the most fun weeks I've had at work in years. But I quickly realized I wasn't going to be as productive as I dreamed. It seems I can't escape [Parkinson's Law](https://en.wikipedia.org/wiki/Parkinson%27s_law#First_meaning) either (though I'll keep striving!). Regardless, these weeks have been very productive, and that's why I decided it was time to write an update.

In a nutshell, I've been working on Cloud synchronization and data migration. That may seem small for a month's worth of work, but honestly, these tasks' complexity have reminded me a lot to [the CRDTs rabbithole from Umai](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid#comment-7). And that took me... _checks notes_ ... 7 months 😱! So I think solving most of that in 4-ish weeks is a tremendous achievement :D. What I've done, basically, is implementing CRDT resolution for containers (which I completely forgot about 😅), schema migrations and updates for Soukai Solid Models, and resumability/persistence for Aerogel Jobs.

That first point, CRDT resolution for containers, is not as simple as it may seem. Sure, I had already implemented CRDT resolution for plain documents, but turns out that containers have some particular challenges. For example, the `ldp:contains` triples are managed by the Server using the `SolidEngine`, and thus aren't tracked by CRDT operations. But they are tracked in local storage, using the `IndexedDBEngine`. All this CRDT/Cloud synchronization stuff is constantly growing in complexity, but I'm extremely grateful for my test suites, because I've been able to catch a lot of regressions and I'm confident that it's somewhat robust (I'm sure I'll find tons of bugs when people start using it in unexpected ways, though, but that's to be expected 🥁).

Schema migrations and updates have been the meat of this month's work, and what that NLNet milestone is all about. I talked about the importance of translating between schemas in [my Interoperable Serendipity presentation](https://noeldemartin.com/solid-world-2025), but TLDR I learned about this idea of "lenses" in [project Cambria](https://www.inkandswitch.com/cambria/), and I believe this is essential for Solid's success. Initially, I didn't expect to take this as far as implementing lenses. And technically I haven't, but I got a lot closer than I expected. The initial idea was to implement tools to migrate existing data in Solid PODs using Solid Focus v1 to the new schema, but I came up with an approach that ultimately allows me to support the older schema without migrating any of the data :D. I still implemented the migration script, because I don't think the older schema is any good (it's not following many best-practices, since it was the first Solid app I made). But it's super cool that I won't force any users to migrate if they don't want to :). And I'm sure this will be very useful in the future if I ever tackle real lenses.

Now, the work here is not finished. Most of the code is, but part of working on these things "for real" involves writing documentation and creating additional materials. For example, I plan on adding a new video to my [Rebuilding Solid Focus with Aerogel series](https://www.youtube.com/playlist?list=PLA3GcuMVHSbzxnR45Gzu2w7QuKs247tE5), and I'll also document how to use these new capabilities in Soukai. There's also a good amount of heavy lifting that Aerogel is doing, not just Soukai. But given that I still haven't started documenting anything in Aerogel, I'm not sure if I'll do it just for this. To be honest, though, there's not much to document (that's the point of Aerogel!). Ideally, you'll only need to call these two methods:

```ts
Cloud.registerSchemaMigration(Task, TaskSchema);

await Cloud.migrate();
```

Finally, Aerogel Jobs are something that has sort-of creeped up on me, since I didn't plan to work on them initially. But this is the sort of thing I have the luxury to spend time on now that I'm working full-time. Essentially, jobs are long-running processes that may be processed in the background. I already have a similar concept in [Media Kraken](https://noeldemartin.github.io/media-kraken/), when you import a collection of movies you can see a progress dialog and you get a summary at the end. However, that process is not resumable nor persisted. That means that if you reload the application in the middle, all the progress will be lost. Which is not much of an issue for that task, but it definitely would for schema migrations. So I used the opportunity to generalize this idea, and now it's technically possible for any job to be resumable and persistent. Although so far I only support it for migrations, I may also add it to synchronization and backups (connecting to a Solid account after having being using the app from local storage). In the future, I can also see these running on worker threads (I already tried that in Media Kraken, but [there were some limitations](https://github.com/inrupt/solid-client-authn-js/issues/1657#issuecomment-916688273)), or even in a server (for example, to fetch RSS entries, etc.).

And that's about it for this lengthy update, hopefully I'll soon be done with all the hairy stuff and the only thing left before releasing will be some final tweaks and an overall review. Personally, I'm going to start using Focus v2 in production right after I publish this update!
