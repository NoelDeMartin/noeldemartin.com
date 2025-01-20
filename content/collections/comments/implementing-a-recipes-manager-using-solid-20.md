---
id: implementing-a-recipes-manager-using-solid-20
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 20'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2022-12-18 10:12:35'
---

Here we are about to finish 2022 and this task isn't finished yet. So it's official that it's going to be a side-project spanning 3 years 😱️. But that's ok, it's not like this is the only thing I've been doing. And now that I've been using the app for a couple of months, I can say I'm happy with it. But in any case, I'll leave the postmortem for the next update, which I can promise now that will be the last!

During this month, as promised, I haven't worked on any new features. But that doesn't mean I haven't been busy.

On the one hand, I worked on the app itself because I noticed it was becoming slower each time I opened it. After some digging, I found a pretty gnarly performance issue that made it duplicate CRDT operations on every refresh :/. The root problem was that Solid PODs, and RDF in general, can't have duplicated triples in a document. This alludes to the [monotonic](https://www.w3.org/TR/rdf-mt/#glossMonotonic) property of RDF that Tim mentioned.

For example, the following two documents are equivalent:

```turtle
<#my-recipe> schema:recipeIngredient "Tomatoes" .
```

```turtle
<#my-recipe> schema:recipeIngredient "Tomatoes", "Tomatoes" .
```

But in JavaScript, that's not true. So my code thought there was an ingredient missing, and tried to write it indefinitely.

These are the type of things that make me second-guess adding complexity. But it seems like most of the time I end up adding it anyways. At least when it comes to code, I think I'm much better at keeping UI and features simple. But it's also true that these are the type of things that help me learn more about RDF and harden soukai for more edge-cases. Or at least, that's what I tell myself.

Other than that, I've also been [struggling with JavaScript bundling](https://github.com/NoelDeMartin/solid-utils/tree/543632bf462e06e172f140af12430901e26621e4/external#solid-utils-externals). I'll be honest, the current status of publishing JavaScript packages is awful. Even though I've spent countless hours trying to work around bundling issues, I still haven't cracked the nut. The current solution I found is good enough, but there are still some use-cases where I know it's problematic (for example, it doesn't work with [vite-node](https://github.com/vitest-dev/vitest/tree/main/packages/vite-node)). But I don't think I'll be wasting any more time on this for the time being.

Something else I've been doing is publishing [my vocab](https://vocab.noeldemartin.com/). Which means I've been able to work with Laravel again 😍️. If I just mentioned how difficult it is to work with JavaScript libraries, I can say the complete opposite for Laravel and PHP. In the last 3 years or so, I haven't used much Laravel. But still, every time I do, it's so easy to work with. In JavaScript, it's been a struggle just finding libraries to parse and serialize RDF. But in PHP, it took me less than a minute to find one library that parses and serializes all formats! And the library is adequately called [EasyRDF](https://www.easyrdf.org/). So that was nice :).

In case you're wondering, I did mention before that I would try to contribute this vocab to the Solid spec. But 7 months after opening [the PR](https://github.com/solid/vocab/pull/69) it doesn't seem to be going anywhere, so I decided to just publish it on my own domain. One of the doubts I had about it is that I wasn't familiar with best practices for publishing vocabs. But [Angelo](https://angelo.veltens.org) shared the following document that solved most of my doubts: [Cool URIs](https://www.w3.org/TR/cooluris/).

Now that all that's done, the only thing that's missing is mostly writing documentation. That can take a long time or almost nothing, so I'll give it a couple of weeks at most. If anything, I can tell you the hard deadline for the release. And that is [February 4th](https://noeldemartin.social/@noeldemartin/109187685226808525).
