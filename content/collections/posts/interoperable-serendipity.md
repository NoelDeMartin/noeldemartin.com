---
id: interoperable-serendipity
blueprint: post
title: 'Interoperable Serendipity'
publication_date: '2021-10-12 08:00:00'
modification_date: '2021-10-14 05:03:17'
---

{{ partial:components/callout title="Check out the video!"
    content="Interoperable Serendipity @ Solid World"
    url="https://noeldemartin.com/solid-world-2025"
    image="/img/talks/interoperable-serendipity.png"
    icon="icons/play"
    target="_blank"
/}}

If you had asked my thoughts on interoperability some years ago, I wouldn't have had much to say. Nowadays, it has become one of my most revered ideals. And today, I want to take you along for a journey towards its summum: Interoperable Serendipity.

## Preface

Before we begin, let me lay down some context.

As you may know, I've been working with [Solid](https://solidproject.org/) for a while now. I started down this path 3 years ago, when I started working on what I called [Autonomous Data](https://autonomous-data.noeldemartin.com). Soon thereafter, I found about Solid and decided to switch my focus there.

Recently, I came across [Zero Data Apps](https://0data.app/), which is very much aligned with my initial idea for Autonomous Data, and it encompasses other projects beyond Solid. The main Zero Data protocols right now are Solid, [remoteStorage](https://remotestorage.io) and [Fission](https://fission.codes/).

One thing all of these have in common is that they make a great emphasis on the importance of interoperability. And this has been a common topic of discussion in the community.

In this post, I will give my take on the topic. I am going to use Solid in my examples because that's what I have experience working with, but my ideas should be universal.

## A taxonomy of interoperability

The first time I heard about interoperability being classified was listening to an episode of Seth Godin's podcast called [Adversarial Interoperability](https://play.acast.com/s/akimbo/adversarialinteroperability), which I recommend listening to.

In this episode, he introduces [Cory Doctorow](https://www.eff.org/deeplinks/2019/07/interoperability-fix-internet-not-tech-companies)'s classification; which is:

- Indifferent interoperability: I don't care if you plug your thing into my product.
- Cooperative interoperability: Please plug your thing into my product.
- Adversarial interoperability: Dang it, stop plugging your thing into my product!

What we really want for our apps is indifferent interoperability, but I think that's very difficult to achieve in practice (more on this later). What we have with Zero Data protocols is cooperative interoperability. And what's more common in the rest of the industry is adversarial interoperability.

This classification is useful to understand the overall ecosystem, but I want to drill down on what cooperative interoperability looks like in practice.

## Obfuscated interoperability

When you are writing a Solid app, you have a set of tools at your disposal to make it interoperable with other apps. But these tools can be neglected or misused.

One example is the type index, which is a way to declare where your data is stored so that other apps can find it. However, it's perfectly possible to make a Solid app that doesn't declare its data in the type index. This means that other apps have to know the exact location where the data resides, or they won't interoperate properly.

Another example is data types. In Solid, your app relies on Semantic Data, which means that each piece of data is self-describing (more on this in the next section). However, there is nothing keeping your from misusing that representation. For example, you could use a description field (which is supposed to be human readable) to store a json object.

Both of these examples are not uncommon in the wild, and there are multiple reasons for this to happen (ill intent not being a common one). To be honest, I have done a fair share of this myself, and probably still do.

When this happens, interoperability in Solid is not too far from adversarial interoperability. You have to go out of your way to make your app interoperable, and you have to rely on implementation details that are prone to change.

## Intentional interoperability

If you use all the tools properly, things are much easier.

As I mentioned before, Semantic Data is self-describing. Let's illustrate what that means with an example. Imagine that you are making a task manager. In a traditional non-Solid app, this is what a Task could look like:

```json
{
    "id": 1,
    "description": "Go shopping",
    "done": false
}
```

If you look at this data, you can probably guess what it means. But that's all you are doing; you're guessing. As the app becomes more complicated, that will be more difficult.

In Solid, this is what a Task could look like:

```json
{
    "@context": "https://vocab.example.com/",
    "@id": "https://data.example.com/tasks/1",
    "@type": "Task",
    "description": "Go shopping",
    "done": false
}
```

On the surface, you may think it doesn't look that different, but let's dig a little deeper.

The `@context` property indicates the vocabulary, and this can be used to expand on the meaning of all the other properties. For example, if you visited `https://vocab.example.com/description` you would see some documentation on what the `description` property actually means.

The `@type` property is also important, it tells you what this object is. If you visit `https://vocab.example.com/Task`, you would see what properties this object can have and what it represents.

This is a lot better, and much closer to what Cory Doctorow means when he talks about cooperative interoperability. For a developer who wants to make an app interoperable with another, seeing this type of data and reading the vocabulary definition is not unlike reading the API documentation for a traditional app.

But there is an important difference here. In Solid, each application doesn't use its own data structure. Developers are encouraged to reuse existing vocabularies that can be found in websites such as [schema.org](https://schema.org) and [lov.linkeddata.es](https://lov.linkeddata.es/). This way, apps that are working on a common set of data will be interoperable out of the box.

But this doesn't work as well in practice as it does in theory. When it comes down to making an app, it's rare to find an existing vocabulary that fits perfectly with your use-case. So you resort to either mixing vocabularies or defining your own. The end result is that applications still need to be intentional about being interoperable.

## Lens-based interoperability

With the concepts I've introduced so far, it's relatively easy (or at least possible) to make an app interoperable with another. You just have to look at the vocabulary it is using, and use the same one in your app. But soon, this can go awry if you want to be interoperable with two apps that use different vocabularies.

Up until recently, I didn't have an answer for that. But some weeks ago, looking at the notes for [a Zero Data Swap](https://chat.0data.app/t/zero-data-swap-1-schemas-interoperability-and-cambria-july-28-2021), I came across a new project called [Cambria](https://www.inkandswitch.com/cambria/).

Imagine that you want to be interoperable with two applications that generate the following data:

```json
{
    "@context": "https://vocab.example.com/",
    "@id": "https://data.example.com/tasks/1",
    "@type": "Task",
    "description": "Go shopping",
    "done": false
}
```

```json
{
    "@context": "https://vocab.acme.com/",
    "@id": "https://data.acme.com/todos/1",
    "@type": "ToDo",
    "name": "Go shopping",
    "completed": false
}
```

They use different vocabularies, so making your app compatible with both won't be easy. But looking at the data, you can tell they are actually doing the same thing. What if you could tell your app how to map from one vocabulary to another? And what if you could do it using your own vocabulary, making this translation transparent to your codebase?

That is exactly what Cambria proposes. It's not focused on Solid, but Solid has a concept of [shapes](https://ruben.verborgh.org/blog/2019/06/17/shaping-linked-data-apps/) and I think this approach would be a perfect match. They call these translations "lenses", hence my referring to this as lens-based interoperability.

But of course, this doesn't come without some caveats, such as what happens when two shapes are not perfectly translatable. To learn more about this, I'd recommend reading [their thoughts on the topic](https://www.inkandswitch.com/cambria/#open-questions-and-potential-for-further-research). But one problem I see in practice is that developers, or _someone_, still needs to define the lenses. It's still not completetly effortless — it's not indifferent interoperability.

## Interoperable serendipity

With lens-based interoperability, we can go very far. But there is still a use-case it doesn't solve. What are the chances of two indie developers, who don't know about each other, making apps that are interoperable out of the box?

Even with lenses, I'd say the chances are very low — you still have to know about the other app in order to define the translations. But that's the world I want to see. When I think about the potential of Zero Data Apps, what gets me excited the most is thinking in a world with hundreds or thousands of apps, that work with each other by pure serendipity.

I have some ideas of how this could happen, but none of them is perfect.

One possibility would be to rely on crowd-sourced repositories of translations. Even if a developer doesn't know about another app, the community could do the job of defining the translations. But this could potentially ruin the decentralized nature of Zero Data Apps.

Another solution would be to actually ask users how to translate the data. But this is a huge challenge in and of itself. Making this intuitive for non-technical users wouldn't be easy. Not to mention that this would add even more barriers to entry.

So yeah, I don't have a perfect solution. But I think it's important to strive nonetheless, and I'm looking forward to see how this evolves in the upcoming years.

## The way forward

I have mentioned many ideas here, but interoperability is still lacking in practice. Not to mention interoperability between protocols, which I haven't even tackled.

But that shouldn't be discouraging, on the contrary. The fact that this is even a topic of discussion is a silver lining. In the world of centralization and Big Tech, this isn't even a possibility. So we must keep asking these questions, and working towards an ecosystem where these ideas are a reality.

For my part, I will continue [working in the open](https://noeldemartin.com/blog/open-productivity) and sharing what I learn along the way. The Zero Data ecosystem is still in its infancy, but I am hopeful that eventually it will blossom.

Onwards!
