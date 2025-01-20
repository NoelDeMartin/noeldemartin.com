---
id: making-a-web-application-framework-9
blueprint: comment
title: 'Making a Web Application Framework - 9'
task: 'entry::making-a-web-application-framework'
publication_date: '2024-07-15 13:50:52'
---

It's only been two weeks since my last update, but I'm already done with the beta! TLDR, you can peek at the new version in [focus.noeldemartin.com](https://focus.noeldemartin.com).

Turns out it didn't need as much work as I thought, even though it required chasing a bug that involved [debugging and Android device over Wifi](https://developer.android.com/tools/adb#connect-to-a-device-over-wi-fi) and [dealing with proxies](https://github.com/NoelDeMartin/utils/commit/369ec16c5fa546a6a2e7512501add6b0e5b1a3ac) 😅. Also, it's not like I'm done with [bundling woes](https://github.com/NoelDeMartin/solid-utils/commit/30aceafb9d58f505d02a146d8e81f2e3a041b92f) (I'm not sure I'm ever getting rid of those :/). But it's ready now!

I haven't been working on this rebuild for too long, but for some reason it feels very similar to [when I pre-released Umai](https://github.com/NoelDeMartin/umai/issues/1). I guess it's just the thrill of releasing new stuff :). This time, though, I have some things up my sleeve before the final release.

Even though it's "just a rebuild", I'm very excited about this one. Not only because I feel it's better in terms of functionality (I understand Solid a lot better now!), I also redesigned the UI from scratch. In the previous version, I used [Vuetify](https://vuetifyjs.com); and I didn't think much about the design at all. But this time I have, and the result is a lot less cluttered and clean. I worry a bit that all my apps end up looking the same, but I think I've managed to give them a unique personality for the most part.

Now that the beta is out the door, the question remains when will I release the final version. You can learn more about what's left in the [Beta Feedback](https://github.com/NoelDeMartin/solid-focus/issues/15) issue (and leave some feedback!), but the short answer is that I don't know. I'm posting a life update in my blog early next month, but honestly I don't think I'll be releasing the app this year 😱. You'll learn why in the blog post, but that leaves plenty of time to live with the beta myself, and make sure that it's ready once I finally release it to the world.

Anyways, if you want to learn more about the new version, I also uploaded a new video to Youtube with some more technical details and new Aerogel features: [Rebuilding Solid Focus with Aerogel | Routing and UI](https://www.youtube.com/watch?v=pDK6oQ6igLg).
