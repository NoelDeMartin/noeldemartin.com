---
id: implementing-a-recipes-manager-using-solid-12
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 12'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2021-11-27 19:25:41'
---

The current cycle is coming to a close, and let me start by showing what the application looks like right now:

<a href="https://noeldemartin.com/videos/umai-page-transitions.mp4" target="_blank">
    <video autoplay loop>
        <source src="/videos/umai-page-transitions.mp4" type="video/mp4">
    </video>
</a>

Isn't that nice? :D. I didn't manage to get as much done as I would've liked, but I'm definitely happy with the results. From the 3 areas I mentioned last time, Panache is the one that I consider almost finished. It's not finished in the sense that I won't have to do anything else, but I've laid the foundations and adding more should be easyish from now on.

As for the other areas, this is how the hill chart looks like right now:

![Hillchart for 27th November 2021](/img/tasks/hillchart-2021-11-27.png)

Recipes & Cookbook is not something I mentioned explicitly before, but that scope basically consists in applying the improvements to all pages of the app. It's not over the hump because I haven't done any work in the edit or create pages yet. But as you could see in the video; home, cookbook, and recipe details are pretty much done.

The Design System is something I started working on at the beginning of the cycle. I started making some of the "final" components with [Storybook](https://storybook.js.org/), and I started to apply some concepts from [Atomic Design](https://atomicdesign.bradfrost.com/chapter-2/) in the process of building the pages. But I didn't take it much further, because I got into the rabbit hole of what to do about page transitions.

At the start of the cycle, I pointed to [a couple](https://pagetransitions.netlify.app/) [of examples](https://twitter.com/ryanflorence/status/1186675229621248000) that inspired me. Unfortunately, looking at existing implementations none of them worked as I expected. The closest thing I could find was a library called [v-shared-element](https://justintaddei.github.io/v-shared-element/), but the result was a little clunky because the animations cannot be customized much. So of course, I ended up developing [my own thing](https://github.com/NoelDeMartin/umai/blob/main/src/components/RecipeCard.vue#L3..L12) from scratch 😅. To be fair, for most people `v-shared-element` will be enough, and it was very easy to set up. Looking at their source code also helped me to come up with my own solution, but in the end I wanted something more flexible. It's not as seamless to work with, but gives me the control I need to make the animations I had in mind. We'll see how this evolves as I continue making more pages, maybe I'll even release it as a stand-alone library if I think it can be useful to others.

And finally, this takes me to Branding. You'll notice it's right at the bottom of the hill. I haven't struggled this much to come up with a name for while, and to be frank I'm kind of blocked at the moment. To make things worse, I've been looking at existing applications and websites related with food, and almost none of them inspire me (one of the few exceptions is [Chipotle](https://chipotle.com/), I love that one). So yeah, I don't know how this will turn out, but I still have some time until I'm done with v1, so I'll continue chipping at it.

My current ideas for names, none of which I'm completely happy with, are the following:

- Umai: This is what I'm currently using, but I feel it's more a codename than the name I'll end up using on release. I don't dislike the word per se, but it has a couple of problems. First, it's not a very common word and can easily be confused with [Umami](https://twitter.com/VincentTunru/status/1464637840214659075) (I was already suspicious before seeing that tweet though). Even though it's not a common word that people will remember, it's common enough in japanese circles that it'll be impossible to find my app just with the name. So when I tell people about it, I'll have to say "search for Umai Solid" or "search for Umai noeldemartin" or whatever. The word itself also doesn't inspire me on what the logo should be, or even the color scheme or branding for the app. Not great, and the word is not that good to begin with to go through all that trouble.

- Grateful Bite: In spirit, this is the name I like the most so far. But that's it. No logo comes to mind, no associated branding, and the people I've asked to didn't like it as much as me.

- Pepper Bell: This may be the front-runner for now, because some logo and branding come to mind. I also like the fact that it's a word play with "Bell Pepper" inverted, which may make it easy for people to remember and hopefully easy to search for. But in spirit, I don't care much about it. It doesn't give me joy, like Media Kraken does, and it's not as descriptive of what the app is for as Solid Focus. So it's not perfect either.

I also came up with some other ideas, but none good enough to even mention. So yeah, I'll continue struggling with this and we'll see how it turns out in the end. The problem is that this issue kind of blocks everything else. Without a name and a branding, I'm making the rest of the app in the dark. I didn't want the app to feel the same way as Media Kraken, but so far it's eerily similar because the branding doesn't speak for itself. But this is part of the creative process, eventually something should click 🤞.

At this point, I would normally go into a cooldown cycle for a couple of weeks and plan what to work on next. But seeing how things are going, and that new year is around the corner and I'll be on holidays, I'll extend the cooldown until and undecided date next year (probably the 2nd week of January). It won't be a traditional cooldown either, because I'll probably we working on what I didn't manage to accomplish in this cycle. So this will probably be my last update for the year.

PS: I've also been working on [a very simple Hello World for Solid](https://hello.0data.app/solid/), built using plain JavaScript and HTML, with as little dependencies as possible (no Soukai, and no frameworks!). If you've been meaning to get started with Solid yourself, but didn't know where to begin, I encourage you to take a look. As always, feel free to contact me or open an issue if you have any doubts or comments.
