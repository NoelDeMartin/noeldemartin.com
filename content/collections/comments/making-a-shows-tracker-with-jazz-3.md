---
id: making-a-shows-tracker-with-jazz-3
blueprint: comment
title: 'Making a Shows Tracker with Jazz - 3'
task: 'entry::making-a-shows-tracker-with-jazz'
publication_date: '2025-12-13 10:06:00'
---

Turns out I was a bit _too quick_ in publishing my last update on Jazz, because indeed I was using it in production... but I hadn't used it enough to find some of the problems. Now that I have, Jazz is not looking so good anymore 😅. Or rather, I don't think it's looking good _for my use-case_ (I still think it's very cool!).

So, what's the main problem? Turns out, Jazz and I weren't on the same page. When I started working on this app, the architecture I had in mind was the same I've been working on in my [Aerogel framework](https://aerogel.js.org/). Which in short is "a local-first app that syncs with your Solid POD". Of course, Jazz doesn't support Solid, so I was building "a local-first app that syncs with my self-hosted sync server". But turns out, what Jazz wants me to build is "a collaborative app that syncs". It seems like a very subtle difference, so let me clarify what this means.

The way I am implementing this in Aerogel is that once you connect to a POD, all your data is downloaded to your device. Then, whenever you make changes, these are uploaded to the POD (and subsequently downloaded by any other device that is connected). In Jazz, instead, the only thing that syncs is _the data you are currently using in the app_. Turns out that a Jazz store is not a single CRDT, but a collection of connected CRDTs (or Co-values, as they call them). And so, the only data that syncs is the CRDTs you're "subcribed to". There also isn't a way to track a global "sync status", which complicates the UI I would like to build (in Aerogel, I have a status dot displaying whether you're fully synced or you have some local changes).

This makes a lot of sense for collaborative applications. But in my use-case, this isn't great. What this means in practice is that whenever I logged into a new device, I would get the list of shows in my collection (because I was listing them in the home screen). And that was available offline, so I got the impression that everything was working. But then I discovered that opening a show that I hadn't opened in that device, it would be empty! That happens because, as I've mentioned, in Jazz the only data that syncs is the one you're using, not the entire store.

I mentioned before that the Discord community had been very helpful. For this particular issue, I got confirmation that it was working as intended (my approach was refered to as "sync the world", which Jazz doesn't support). The only suggested workaround was to subscribe to all the data manually. But when I tried, I ran into the same performance issues I had seen in my own approach. And nobody seemed to have any further solutions after that 🤷.

And there is yet another problem with Jazz. I am using the [`jazz-run` cli](https://jazz.tools/docs/react/core-concepts/sync-and-storage#self-hosting-your-sync-server) for my self-hosted server, and I hadn't paid much attention to it, but you'll notice that it doesn't mention anything about authentication. That's actually a separate service, which I configured using [Better Auth](https://www.better-auth.com/). And I got the impression that it was safe because I'm configuring my app so that only signed up users can connect:

```jsx
<JazzReactProvider
    sync=@{{
        peer: `wss://${MY_SELF_HOSTED_SYNC_SERVER}`,
        when: 'signedUp',
    }}
>
    <App />
</JazzReactProvider>
```

But then, it dawned on me... What's keeping other people from creating an app using my self-hosted server for syncing, using their own authentication mechanism (or no authentication at all)? Turns out, nothing 😅. I also asked about this in the Discord community, and the solution I got was to restrict the allowed origins at a network level :/. Which of course, should work in the Web, but is very easy to work around in a mobile app or even using a proxy server.

Now, none of these two problems are impossible to solve. The syncing/performance issue can probably be worked around using Jazz in a clever way. And the sync server could be guarded implementing a hand-shake before initiating the websocket connection. But this shows me that, clearly, Jazz and I aren't on the same page. The whole point of using Jazz was to forget about the syncing mechanism, and focus on building my app. But it doesn't seem like that's going to happen. If I'm going to have to tinker with syncing and performance woes, I'd much rather go back to working on my framework (and get interoperability back)!

So I think that marks the end of this experiment. I still think Jazz is very cool, and I'd recommend it if you're building a collaborative app or you don't mind the limitations I have mentioned. The DX really is magical, and using Jazz has raised the bar for what I'd like Aerogel to become (though I'm not sure it ever will).

Though I have to wonder, maybe I'm being too idealistic? If you're reading this, I'm curious to hear what you think :). <a href="mailto:{{contact:email}}?subject=Jazz!">Shoot me an email</a> and let me know.
