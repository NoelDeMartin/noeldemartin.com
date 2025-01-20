---
id: implementing-a-media-tracker-using-solid-5
blueprint: comment
title: 'Implementing a Media Tracker using Solid - 5'
task: 'entry::implementing-a-media-tracker-using-solid'
publication_date: '2020-03-28 12:00:24'
---

Some weeks ago I said that I wasn't completely happy with the approach I had taken to interact with the TMDB API. I recently found [a forum discussion](https://www.themoviedb.org/talk/5b6b0e08925141406a1134de) where Travis, TMDB's founder, gives green light to exposing the API key in the frontend. I don't think that's a good approach, but if he says it's ok I guess it is. This is probably one of those situations where theory is one thing and practice is another. This is theoretically a security issue, but in practice nobody is exploiting it.

Other than this, the past 3 weeks I've continued to work mostly on UI. I took a detour to implement a [TailwindCSS Colors Generator](https://noeldemartin.github.io/tailwindcss-colors-generator/), but other than that I've implemented search and movies management.

Before getting into the details, here's how it looks at the moment:

<a href="https://noeldemartin.com/videos/media-kraken-collection.mp4" target="_blank">
    <video autoplay loop>
        <source src="/videos/media-kraken-collection.mp4" type="video/mp4">
    </video>
</a>

This may look deceptively simple given the amount of time it's taken me, roughly 30 hours. But there are some nuances to keep in mind.

It cannot be understated how different it is using a UI framework like Vuetify (as I did with [Solid Focus](https://noeldemartin.github.io/solid-focus/)) or using plain CSS. I am using [TailwindCSS](https://tailwindcss.com/) which isn't exactly plain CSS, but it is essentially the same. The fact is that doing it from scratch takes a lot more time. Not only because it's more difficult, you are also missing building blocks that you'd take for granted such as modals and snackbars. Any simple feature that you are developing can become cumbersome when you realize you need a modal or a snackbar.

On the other hand, it's also more rewarding and more fun. I'm also building reusable components for upcoming projects, so in a sense I may be creating my own UI framework. But the important aspect is the flexibility I have with this approach. Sure, I could have done any of the things I'll explain with other frameworks. But creating these interactions is not only a matter of implementation. They are the result of an exploration process, and using this approach allows me to explore without the constraints (and assumptions) that frameworks inherently have. What I'm doing here is not only implementing a spec, I'm constantly refactoring code and UI.

The first thing I want to highlight is the animation that takes place when a movie is marked as "watched" and is, literally, sent to your collection. You may not have noticed that, so I encourage you to look again. When a movie disappears from the grid, it shrinks and is sent towards the "My Collection" link (which is where you have to click if you want to find the movie again). I know it's a very small detail, and if most people didn't notice it's arguable how useful it is. But that's the kind of thing I appreciate, the little details. And it's also super fun to work on this kind of stuff. If you're wondering how I achieved this, it was using a combination of Vue [list transitions](https://vuejs.org/v2/guide/transitions.html#List-Transitions) and [a custom JS script](https://github.com/NoelDeMartin/media-kraken/blob/27ddeedc6ab2fd29f0b8d9065e928a586643f06b/src/components/MoviesGrid.vue#L34..L64).

Something else that was interesting to work on is the button that marks movies as watched. This cannot be appreciated in the video, but that element is actually a `button` when the movie is pending and it becomes a `div` once the movie is watched (so, after clicking it). With the magic of Vue and Tailwind combined, this is seamless and cannot be perceived visually. Which is the point. This was achieved using Vue's [dynamic component](https://vuejs.org/v2/guide/components-dynamic-async.html) and some advanced attribute bindings:

**Vue:**

```html
<component
    :is="movie.watched ? 'div' : 'button'"
    class="badge absolute top-0 right-0 -mt-1 flex h-10 w-10 items-center justify-center"
    style="margin-right:-.7rem"
    v-bind="movie.watched ? { class: 'watched' } : { type: 'button' }"
    @click="movie.pending && markWatched()"
>
    <BaseIcon name="bookmark" class="background absolute inset-0 h-10 w-10" />
    <BaseIcon
        v-if="movie.pending"
        name="time"
        class="icon-pending z-10 h-4 w-4 text-blue-600"
    />
    <BaseIcon
        name="checkmark"
        class="icon-watched z-10 h-4 w-4 text-green-600"
    />
</component>
```

**TailwindCSS:**

```scss
.badge {
    .background {
        @apply text-blue-300;
    }
    .icon-watched {
        @apply hidden;
    }

    &:hover,
    &.watched {
        .background {
            @apply text-green-300;
        }
        .icon-watched {
            @apply block;
        }
        .icon-pending {
            @apply hidden;
        }
    }
}
```

At this point, I feel like the UI is almost finished. I have gone way past the apetite budget, and I realize this happened because of my nitpicking with the graphic part. But I'm actually confortable working like this, as I explored in a blog post called [Order vs Chaos](https://noeldemartin.com/blog/order-vs-chaos).
