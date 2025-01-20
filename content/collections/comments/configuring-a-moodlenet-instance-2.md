---
id: configuring-a-moodlenet-instance-2
blueprint: comment
title: 'Configuring a MoodleNet instance - 2'
task: 'entry::configuring-a-moodlenet-instance'
publication_date: '2020-06-19 16:05:13'
---

I've been tinkering some more and I think I have a fair grasp of the current status of the project, so that'll be it for this task.

Something I found is a built-in [GraphQL](https://graphql.org/) console that can be opened at `/api/graphql`. It's currently not working in [the official Moodle instance](https://moodle.net), so I assume it can be disabled. I don't mind leaving it open, after all authentication is required to perform any priviledged operations. And it's not like it'd be impossible to run GraphQL queries without it. As I've said before, I'm not a fan of [security through obscurity](https://en.wikipedia.org/wiki/Security_through_obscurity).

One of the things I've been testing is federation. It's not supposed to be ready yet because that's planned for [Federation testing](https://gitlab.com/moodlenet/meta/-/milestones/4), an upcoming milestone. But I was curious to see where it's at.

Some things are working, I had [a conversation with myself](https://learn.noeldemartin.social/thread/01EB0CH1YJ5BRH0AKQE729RFEY) across Mastodon and MoodleNet. For normal users that's it though. The feature I was the most interested in is Remote Follows (following Users/Communities/Collections from other MoodleNet instances). It's actually [implemented in the backend](https://gitlab.com/moodlenet/backend/-/blob/develop/lib/moodle_net_web/graphql/follows_resolver.ex#L199), but not exposed through the UI. I tried to call it from the GraphQL console, but I didn't manage to get it working. Looking at the server logs I can tell remote actors were retrieved successfully, but eventually there was an invalid function call error. I suppose there are some things to iron out (or I was doing something wrong).

Still, something came out of this. I had a chance to look at the backend and read some Elixir code. It was my first time reading Elixir and I have to say it seems easy to understand. I also realized there is more to the backend than you'd think looking at the UI. So I don't think the project is too far from having functioning federation. Of course, take anything I say with a grain of salt because I'm not qualified to know. I also didn't try [connecting with the mothership](http://bit.ly/2ZgmrYn) which is also an important piece for discoverability.
