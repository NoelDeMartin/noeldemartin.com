---
id: why-solid
blueprint: post
title: 'Why Solid?'
publication_date: '2024-06-24 15:00:00'
modification_date: '2024-06-28 05:21:04'
---

For five years, I've dedicated most of my side-project time to making apps and tools using the [Solid Protocol](https://solidproject.org/). Many share its vision, but it's also common to hear criticisms. I'm often asked why I'm still working on Solid, or told about another project that is doing a better job at solving similar problems.

Today, I'll go through some of the criticisms, share my own concerns, and answer why after all these years I'm still choosing Solid.

<a href="https://unsplash.com/photos/assorted-fedora-hat-lot-_yVRLC75Ma8" target="_blank" aria-hidden="true" title="Image by Joshua Coleman on Unsplash.com">
    <img src="/img/blog/WhySolid.jpg" alt="">
</a>

## What is Solid trying to solve?

This may, in itself, be the first problem. Solid's vision is so broad and all-encompassing, that it doesn't have the same meaning to everyone. So I'll start by clarifying what it means to me, because that will be the lens through which I address the rest of the post.

### Privacy and Data Ownership

One of the fundamental pillars of Solid are Solid PODs, personal datastores. The idea is that everyone can have their own POD (or PODs), and thus control their data. This is not limited to individuals, though. Organizations can also have their own PODs and WebIds. The point is that each actor owns their data, and decides who they share it with and under which terms.

This is the angle that got me into Solid to begin with. I was working on a similar project, called [Autonomous Data](https://autonomous-data.noeldemartin.com/), when I discovered Solid. The vision was so similar that I decided to drop what I was doing and contribute to Solid instead.

But this is not what I'm the most excited about anymore. I still believe it is extremely important, but I'm convinced that most people don't care about privacy. Maybe most people reading this post do, but if people really cared about privacy they wouldn't be using Facebook, Google, or the cool Big Tech product of the day (I guess that's TikTok nowadays? Or is it ChatGPT?).

### Application Interoperability

Something else that Solid is trying to solve is Application Interoperability. That is the idea that you can use two applications at the same time, with the same data.

This is for example how things like podcast players and email clients work. Users can choose their favorite applications, and they will work regardless of what the podcast publisher or the person they are communicating with are using.

Unfortunately, this is a vestige of the past and that's not how most apps work anymore.

<figure>
	<img src="/img/blog/WalledGardens.jpg" alt="An image of walled gardens like facebook, myspace, etc.">
	<figcaption>Walled Gardens, by David Simonds<figcaption>
</figure>

If people don't care about privacy, talking about silos and vendor lock-in is a different story. Most non-technical people won't understand what those words mean, but once you explain it — and they learn that it's [a technical choice and not a limitation](https://noeldemartin.com/blog/what-technology-wants) — you've got their attention.

Everyone has a horror story of an application they loved that disappeared, or degraded so much that it no longer resembles what they fell in love with. I myself have a handful: [Wunderlist](https://en.wikipedia.org/wiki/Wunderlist), [Tviso](https://web.archive.org/web/20160126011426/https://www.tviso.com/), [Evernote Food](https://www.theverge.com/2015/8/27/9216863/evernote-food-shutting-down-september), [Google Reader](https://en.wikipedia.org/wiki/Google_Reader), [Sunrise Calendar](https://en.wikipedia.org/wiki/Sunrise_Calendar), etc.

Fortunately, to have real interoperability we also need true data ownership. So these two goals compliment each other pretty well.

### Untangle Network Effects

Finally, a nice consequence from this is that service providers no longer need to take care of managing servers. Since the data is now hosted by users (or whoever they choose to entrust it to), it is decoupled from apps. And software builders can focus on what they care about: Making awesome apps.

Furthermore, today's situation often results in winner-takes-all markets. Because of network effects, many applications don't even get a chance. This ends up crippling innovation and hurting both developers and end users.

With Solid, even the tiniest of independent developers can build something that makes an impact. Applications don't have to compete with each other, they can be complementary experiences that are tailored to each individual.

## Criticisms

Now that we've got that out of the way, let's dive into the most common criticisms.

### The UX sucks

If you gave Solid a try, I'm sure this is one of the first things you noticed.

The UI of the POD provider that is recommended to most people, [solidcommunity.net](https://solidcommunity.net/), is not very intuitive and certainly could use some polishing. And Solid Apps are not great either; most of the apps you will come across are experimental, unmaintained, or straight up don't work.

Although I agree with all of that, the reality is that if you don't like any of [my apps](/projects) there is only one person you can blame: myself.

Yes, there are some things in Solid that _can_ make your life more difficult, like the [login process](https://forum.solidproject.org/t/has-any-work-been-done-to-standardise-ux-patterns-for-logging-into-solid-applications/5251/) and [some limitations in the spec](#the-spec-isnt-evolving). But Solid at its core is a data exchange protocol. It doesn't enforce anything at the UI layer, and you could build any app with Solid. In fact, I strongly believe the UX ceiling for Solid Apps is a lot higher than for any traditional app, because you can create unique experiences that are not possible elsewhere.

### The DX sucks

Developer Experience, and the lack of tooling or developer documentation, is another common concern. I recently gave a talk about my [Thoughts on Solid Developer Experience](/solid-symposium-dx), make sure to check that if you want my full thoughts on the topic.

In short, I actually believe you can learn the basic concepts of Solid in less than an hour. I'd even say that most people who already know how to build websites will be able to understand Solid in [the first 10 minutes of this presentation](/fosdem) (a talk I gave at FOSDEM in 2023).

I think one of the reasons why most people trip up is RDF, the data model used in Solid applications. It can get confusing, specially when you start looking at all the edge-cases and serialization formats. But if you learn the abstract concepts of RDF, it's not that different from OOP (Object Oriented Programming). And with patterns like Active Record, you don't even need to know RDF to make Solid Apps ([much like most developers don't need to know SQL](https://m.signalvnoise.com/conceptual-compression-means-beginners-dont-need-to-know-sql-hallelujah/)).

The lack of tooling and documentation is real though, we're still a long way from other ecosystems. The good news is that [we have people working on it](https://rdfjs.dev), [myself included](https://aerogel.js.org/).

### This smells like the Semantic Web

Maybe this is a variation of the previous point, but it seems like many developers who had high hopes with the Semantic Web have been burned in the past.

I cannot talk much to this, because Solid was my first encounter with RDF and the Semantic Web. All I can say is that if you're worried about that, you're probably right 😅.

And it couldn't be any other way, because Solid is precisely that: the next step for the Semantic Web. You can see a glimpse of what Solid would become in [15 year old presentations](https://www.youtube.com/watch?v=OM6XIICm_qo). Even in his 1999 book [Weaving The Web](https://archive.org/details/isbn_9780062515872), Tim Berners-Lee talks about many things that sound like Solid.

Websites were supposed to be read-write since the beginning. And the decentralized nature of the Web empowered individuals to host their own documents from the start (remember personal blogs anyone? Oh wait, that's where you're reading this :D).

### It's not getting any traction

Of course, if you compare _anything_ with the Web, you're going to be disappointed. What happened with the Web was a miracle, and I don't know if that's going to happen ever again. Still, it is true that Solid has been around for a while now, and it doesn't seem to be going mainstream anytime soon.

There has been a lot of talk about what is going to be the "Killer App" for Solid, but in the last couple of years I've changed my mind. I no longer think there can be a single app that showcases the power of Solid, what we need is [an ecosystem of apps working together](https://www.youtube.com/watch?v=zCtoWkwSkxI).

But that leaves us with a Chicken and Egg problem. Developers are not motivated to make Solid Apps because there are no users, and users don't want to use Solid because there are no apps.

However, I also want to raise the point that this all depends on your definition of success. If your only definition of success is complete and utter dominance, then yes, maybe Solid is [doomed to fail](https://write.as/eloquence/why-mastodon-and-the-fediverse-are-doomed-to-fail). But if you believe that being useful to some people is enough, we're getting there.

### The spec isn't evolving

This is an issue I often raise myself. In 4 years, we've only had 3 versions of the [core specification](https://solidproject.org/TR/protocol); with most changes in those versions being superfluous. And we're still lacking essential features for any developer used to traditional databases like [modification timestamps](https://github.com/solid/specification/issues/227#issuecomment-773945439), pagination, or search.

If you look outside of the core specification, it doesn't get any better. Most have been a draft for years, like [Type Indexes](https://solid.github.io/type-indexes/), the [WebId profile](https://solid.github.io/webid-profile/), or [Solid Application Interoperability](https://solid.github.io/data-interoperability-panel/specification/). And the authorization story is a bit in the air with two competing standards, [WAC](https://solidproject.org/TR/wac) and [ACP](https://solid.github.io/authorization-panel/acp-specification/).

I've tried to understand why this is happening, and I even had [a short stint trying to contribute](https://github.com/solid/vocab/pull/69). Is it a case of design by committee? Is it a lack of contributors? Is it a tension between server implementers and app developers? Between organizations and individuals? Or maybe it's normal that these things take time?

Honestly, I don't know and it's probably all of the above. The only positive thing I can say about this is that [what we already have is plenty](https://ruben.verborgh.org/blog/2024/05/30/the-webs-data-triad/#solved). The nice thing about Solid is that applications are often interfacing with a single user's data, and you can get away with many things that wouldn't work querying a database for millions of users. In my case, I've also found a perfect pairing with [local-first](https://inkandswitch.com/local-first/), and the specification is no longer a limiting factor.

Some people have also asked me what I think of use-cases I haven't tackled yet, like adding social aspects to my apps. My answer is that, indeed, Solid in its current form would struggle to work at scale. But there is a very similar protocol we can look at: [ActivityPub](https://www.w3.org/TR/activitypub/).

ActivityPub is the protocol powering Mastodon and the fediverse. If I ever want to implement social features, I'll probably use ActivityPub rather than Solid. And the good news is that the protocols are very similar in spirit. Both use RDF, and both are under the W3C umbrella. In fact, there are already projects trying to bridge the gap, like [ActivityPods](https://activitypods.org/). So I can see a future where both of them converge.

### Lack of POD providers in B2C

This is, to me, the single most important issue holding Solid back.

I can control the experience in my apps, and I can work around the limitations of the spec. However, as soon as I ask people to "log in with Solid", they will find an insurmountable wall that draws them away. This problem is not unique to Solid, it also happens in the fediverse. But for most newcomers, you can recommend `mastodon.social` and get them going.

In Solid, the only viable option is to become a POD provider yourself. But that's a catch-22, because you either restrict it to your own apps (in which case what's even the point of using Solid), or you're now responsible for people's sensitive data (which is what you wanted to avoid in the first place).

In my case, I am saved again by local-first. My apps can be useful without a Solid account, and people can dip their toes before committing. Only when they want to use them across devices, or save their data in the cloud, is Solid a requirement. But that obviously removes many of the advantages, and any app that isn't local-first is out of luck.

So yeah, this is certainly a bummer. And I'd say what's going on in the B2C market for Solid is lackluster overall. Which takes us to the last criticism I wanted to tackle...

### Inrupt

[Inrupt](https://www.inrupt.com/) is the company that Tim Berners-Lee cofounded back in 2018. They were supposed to be the ones leading the charge in making Solid the next step of the Web, but it hasn't quite panned out.

At the beginning, they were a key member of the community, and released many public libraries. They are still an important part of the ecosystem, with [their authentication library](https://github.com/inrupt/solid-client-authn-js) being the only viable solution for authenticating Solid Apps. But more recently they've been [slowly moving their focus towards the B2B market](https://blog.ldodds.com/2024/03/12/baffled-by-solid/#comment-4783).

To their credit I'll mention that I'm not sure they actually said they would be focusing on B2C and empowering the community. But that's what I and many others understood, so it's been a contentious topic and it's often raised as an argument to why Solid isn't working out.

There are two things I have to say about this.

I still believe they fulfill a crucial role for the future. Bringing Solid to organizations and governments is also necessary, and that isn't going to come from independent developers like me. The only caveat I have to add is that this only holds true if they do it respecting Solid's vision and values, and not just [as an implementation detail](https://forum.solidproject.org/t/implementation-of-bbc-together-data-pod/5763/35).

But the second, more important thing, is that it shouldn't matter. Solid, like the Web, is permissionless. Regardless of what Inrupt does, a grassroots movement can emerge to push the community forward. That is what I'm more interested about, and rather than blaming Inrupt for whatever Solid is lacking nowadays, I'd rather look myself in the mirror.

## Advantages

At this point, you may still be wondering why I continue supporting Solid.

First, most of the problems I talked about can be solved and aren't inherent to Solid's vision. Second, it's not like the alternatives don't suffer from many of the same problems. But also, there are some things unique to Solid that I haven't found anywhere else. Or at least, not in combination.

### Tim Berners-Lee

Interestingly, some people have raised this as a concern. Not that they don't like Tim, the creator of the Web. But it isn't uncommon to hear things like "if it weren't for Tim, nobody would care about Solid".

I certainly agree that Tim's success with the Web has brought a lot of visibility to Solid. But if we've got to be honest, why would free publicity be bad? As I've been hammering throughout the post, Solid _is_ the Web. It doesn't make sense to think about it in a vacuum.

Even leaving its popularity aside, the Web is one of the greatest technologies ever created. Not just in technological prowess, but its unique combination of [serving the people](https://www.youtube.com/watch?v=UMNFehJIi0E) and Universality are nowhere else to be found.

The fact that Solid is built on top of the same ideals is an advantage that very few alternatives can claim.

### Interoperable Serendipity

I wrote about this in [a previous post](https://noeldemartin.com/blog/interoperable-serendipity), but TLDR I believe the real power of interoperability will be unleashed when it happens through applications that don't know about each other. And I don't mean only on a technical level, but made by developers who haven't spoken among themselves.

When you make a website, you don't have to talk with browser vendors to make sure that your website works. When you write an email client, you don't have to talk with email providers to see which formats they are using. You code against the specs, and everything works.

My dream is to live in a world where this happens with every application, and Solid is the only project that has _a slight chance_ at making this happen nowadays. And we already have [people actively working on that](https://pdsinterop.org/).

### It isn't Web3

[It is Web 3.0](https://www.youtube.com/watch?v=D5p2gt7htDM&t=2421s).

I don't think everything in Web3 is bad (though [sometimes it looks like that](https://www.web3isgoinggreat.com/)), but I do think it's good at solving some very specific problems. And it's not the kind of problems I'm working on.

Where Web3 and Solid are similar, and why people may associate them, is that both create decentralized apps. However, there is a very important distinction. In Web3, decentralized means that data is _everywhere_. Whereas in Solid, decentralized means that data is _anywhere_.

If we're talking about my private data, I'd very much prefer the second approach (with "anywhere" meaning wherever I choose). And I don't care how secure blockchains are; certainly I don't trust that whatever encryption we have today won't be trivial to breach 10 years from now.

Even when we're talking about public data, I think something like [IPFS](https://ipfs.tech/) is much more appealing. And there are already projects trying to bring those ideas to the Semantic Web, like [IPLD](https://ipld.io/).

### It really is a protocol

As you can see by looking at the variety of server implementations, there is a lot of different people working on Solid: [Node Solid Server](https://github.com/nodeSolidServer/node-solid-server) (JavaScript), [Community Solid Server](https://github.com/CommunitySolidServer/CommunitySolidServer) (TypeScript), [PHP Solid Server](https://github.com/pdsinterop/php-solid-server), [Solid Nextcloud](https://github.com/pdsinterop/solid-nextcloud), [Manas](https://github.com/manomayam/manas) (Rust), etc. And that's just including Open Source PODs!

This may be one of the most distinguishing aspects of Solid. Even though other projects look nice on the surface, after further inspection you quickly realize the only implementations out there have been created by the people defining the specs. Not to mention the lack of apps or any real piece of software that isn't just for demo purposes.

This is the same reason why I'm so excited about ActivityPub and the fediverse. It's true that Mastodon has most of the user share, but there are plenty of other apps that are already working together: Pleroma, Pixelfed, MissKey, etc. That's the kind of ecosystem I like to see.

## Conclusion

Like everything, Solid has positives and negatives. But overall, I still believe it's the best thing we have to improve our relationship with software and data.

I should mention, I also like many of the alternatives too. It's not that I dislike anything that isn't Solid, and there are many interesting projects out there. I'm happy to see that we have many people working on this. But every time I hear about an "alternative to Solid", I can't help but think of this:

<figure>
	<a href="https://xkcd.com/927/" target="_blank">
		<img src="https://imgs.xkcd.com/comics/standards.png" alt="XKCD webcomic about how standards proliferate">
	</a>
	<figcaption>Standards, by xkcd</figcaption>
</figure>

This comes up so often that it's trite at this point. But it doesn't make it any less true.

It's still early days for this space, and I hope that all the variety serves to stimulate the ecosystem and cross-polinate ideas. Eventually, we should start converging on common solutions. And if that isn't Solid, that's fine, I'm prone to [ignore Sunk Costs](https://shows.acast.com/akimbo/episodes/ignoresunkcosts) anyways.

For now, though, I'm staying with Solid.

---

What do you think, did I miss something? Let's talk about it, you can join the conversation in the [Solid Forum](https://forum.solidproject.org/t/why-solid/7612).
