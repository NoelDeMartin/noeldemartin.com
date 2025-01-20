---
id: implementing-a-recipes-manager-using-solid-17
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 17'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2022-06-18 10:29:01'
---

> I'm very confident that in the next update, the app will be ready for production.

Well, here we are in the next update, and the app is not ready 😅. Confidence really is the liquor of the fools. I really thought I would manage to do it, but I realize a month has gone by and I'm not there yet. So I reckon it's time for an update and I'll have to eat my own words.

However, that doesn't mean I haven't made any strides!

For one, I've settled on most of the branding and style. A while ago I mentioned that I wasn't feeling great about the branding for this app so far. But that's changed now! I'm pretty pumped about it, and I'm really looking forward to releasing it. The basic approach is the same I had been working with, but I came across a couple of visual techniques that add some spice; and I'm starting to like it a lot. After some iterations, I've come across a whiteboard-like feeling for the app that I think is really cool. I hope everyone else likes it as well :).

Something else that happened is that I realized I wasn't really done with features :(. I hadn't implemented deleting recipes yet, but I didn't even count it as "a feature" because it seemed trivial. Alas, being an offline-first app complicates things. Instead of just deleting an item, it has to be marked for deletion (or "soft deleted") and delete it for real on synchronization. It wasn't that difficult to implement, but I also had to implement a bunch of stuff in soukai for soft deletes and leaving a trace behind (to [avoid dead links](https://www.w3.org/Provider/Style/URI.html)).

Which takes me to something else interesting that's been happening. Given that the app release is approaching, I started to think about publishing my custom vocab for CRDTs. Initially, I intended to host it myself at `vocab.noeldemartin.com`, but [Tim](https://www.w3.org/People/Berners-Lee/) suggested that I could try to add it to `w3.org`, so [I started that process](https://github.com/solid/vocab/pull/69). However, I have to say that I'm a bit lost on what's the timeline for this to get accepted, so depending how it goes I'll end up hosting it myself. But something good already came up of this.

During the review, [Tim mentioned](https://github.com/solid/vocab/pull/69#discussion_r882506258) that RDF is monotonic and so a subset of a graph cannot contradict the meaning of the complete graph. What that means is that I cannot use default values for missing properties on a resource. I had seen `schema.org` doing it, but it seems like even though it is very widely used, when it comes to RDF purity `schema.org` leaves some things to be desired. So I ended up [refactoring the operations schema for better modeling](https://github.com/NoelDeMartin/soukai-solid/commit/51e146db7a14dc7ff22caec799cc5ae0698fd707). It's always good to keep learning the proper ways of doing things with RDF, and this reminds of [something I mentioned many updates ago](https://noeldemartin.com/tasks/implementing-a-recipes-manager-using-solid#comment-9). Eventually, I did learn the proper mindset to understand that. You cannot say that it's "invalid" to do that sort of thing, it's just that it's conveying a different meaning (which can be complementary, not contradictory). If you want to learn more about that, you can check out [the conversation I had about it in gitter](https://gitter.im/solid/specification?at=60e9d11b7473bf3d781a3821) right after posting that update.

Other than this, I've been spending more time than I'd like to confess working on animations and such. It's a shame because I enjoy working on them a lot, but it's also true that they are not that important. Just over a month ago, there was a presentation at Google IO about [page transitions on the web](https://www.youtube.com/watch?v=JCJUPJ_zDQ4). Whilst they are very interesting, I think they are too limiting for the type of animations I'm doing. But I'll definitely have to reconsider my approach, because so far it's taking far too much of my time.

To finish, seeing how it's going, I've decided to set a deadline for starting to use the app myself and releasing the beta. Looking at my calendar and the month ahead, I think a good date would be August 1st. I may have it ready before that, but we all know [that ain't happening](https://en.wikipedia.org/wiki/Parkinson%27s_law).

Until next time!
