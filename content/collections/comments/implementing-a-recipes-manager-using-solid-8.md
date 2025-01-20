---
id: implementing-a-recipes-manager-using-solid-8
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 8'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2021-07-09 18:00:27'
---

It's been a while since my last update, and the main culprit has been a blog post I've been writing that ended up way longer than expected. So long, in fact, that I decided to implement an animated table of contents in my website to make it more palatable (which I also added to task comments!). Still, the estimated read time is 40 minutes so yeah... Sorry. [I didn't have time to write a shorter one](https://quoteinvestigator.com/2012/04/28/shorter-letter). You can look forward to reading (or ignoring) it next week.

Now, other than writing and working on my website, I've also kept hammering at some Solid stuff. In particular, I have been thinking how to model lists in Solid. That's where I left off in the last cycle, in order to add a list of ingredients to a recipe.

This is how you'd go about doing an "unordered list":

```turtle
<#ramen>
    a schema:Recipe ;
    schema:name "Ramen" ;
    schema:recipeIngredient "Broth", "Noodles" .
```

That's pretty standard, basically you'd have multiple values for a property. That's what Soukai's `FieldType.Array` does. However, the order is not guaranteed to be kept the same, specially when you add or remove values. I've been investigating, and turns out there is already a common pattern to do this, using an `rdf:List`. This is how you'd write it in turtle:

```turtle
<#ramen>
    a schema:Recipe ;
    schema:name "Ramen" ;
    schema:recipeIngredient ( "Broth" "Noodles" ) .
```

Which actually means:

```turtle
<#ramen>
    a schema:Recipe ;
    schema:name "Ramen" ;
    schema:recipeIngredient _:b0 .

_:b0
	a rdf:List ;
    rdf:first "Broth" ;
    rdf:rest _:b1 .

_:b1
	a rdf:List ;
    rdf:first "Noodles" ;
    rdf:rest rdf:nil .
```

But I have some existential doubts about doing this. If you look at the [`recipeIngredient` specification](https://schema.org/recipeIngredient), you'll notice that it only accepts `Text` values. Or, said differently, the range of the `schema:recipeIngredient` property is `Text`. In that case, isn't an `rdf:List` an invalid value for this property? There are two ways to look at it. The first one is about correctness, and I would say that's incorrect because of what I just mentioned. I think we should strive to create data that is modeled properly. The second one is interoperability, which I think is super important. If there are other applications out there working with recipes, developers should be able to make it interoperable with mine just by reading what's on the vocabulary definition. They shouldn't even aim for interoperability, it should just happen if good practices and proper modeling are followed.

But, I do have my doubts about this because it could potentially be a common pattern. Having sorted data is certainly very common, and I think forcing each developer who wants sorted data to define their own vocabulary would be detrimental for interoperability. It would be nice if every property definition had `rdf:List` implied in their range (although I'm not sure how you'd go about specifying that the items on that list should be of a given type, because the range of the `rdf:first` property is `rdfs:Resource`).

So yeah, I'm not sure about this. In any case, seeing all the complexity I found, I will probably conform with the schema.org vocab completely without doing any shenanigans. I've also played with the idea of having my own vocab to extend `schema:Recipe`, but for the time being I think I'll avoid it. I've already been working on this app long enough, so it'd be nice if it starts converging :). Don't get excited though, there are still some months to go.

Now, with that said, here's what I'll be working on for the next cycle. It is going to be a weird one, because I have some holidays in the middle, and I'm always more busy (in my personal life) in summer. These are the things I'll look into:

- **Ingredients & instructions:** I already started working on ingredients last cycle, but I wasn't finished. This time, I'll do instructions as well (which _can_ be sorted using schema.org's vocab!).

- **Offline first:** I'd say this is done for the most part, but I have to review a couple of things to see that logging in and out of the app works properly and doesn't mess up the local data.

- **Dependencies bundling:** I'm still struggling with adapting some libraries to Vite, although [there have been some recent improvements](https://github.com/inrupt/solid-client-authn-js/issues/991#issuecomment-862619525) that look very promising (I still haven't tried them though). And that is not limited to external dependencies, my own `soukai-solid` library has some issues with Stream polyfills. So I'm going to explore some alternatives (like [bundling compiled dependencies](https://github.com/vitejs/vite/blob/main/.github/contributing.md#notes-on-dependencies), crazy as that sounds).

Given the aforementioned summer schedule, this will be a shorter cycle and it should finish by August 16th.
