---
id: implementing-a-media-tracker-using-solid-7
blueprint: comment
title: 'Implementing a Media Tracker using Solid - 7'
task: 'entry::implementing-a-media-tracker-using-solid'
publication_date: '2020-05-05 18:43:39'
---

When I was almost done with this task, I went into a couple of new rabbit holes. None of them were essential for the release, I could have pushed through and released anyways. But at this point I'm embracing the "It'll be done when it's done" craftsman mindset. I am logging how much time I'm dedicating to each part and I'll post a summary of what I've spent my time doing when the task is done.

Still, I'm am not abandoning lessons learned from [the shape up methodology](https://basecamp.com/shapeup). Something I applied recently is [the circuit breaker](https://basecamp.com/shapeup/2.2-chapter-08#the-circuit-breaker). I did not get into these rabbit holes without betting first. And the second one was one hour shy of getting cancelled.

**Rabbithole #1: Lazy Elements Loading**

The first rabbithole I went into was "paginating" the movie collection. Yeah, that's in quotes because that's what I thought I'd be doing. When I started testing the application with a dataset of 1000+ movies, I realized how slow it was. This was to be expected because I was rendering all the movies in a single page, images and all.

My first instinct was to paginate the results, and I implemented a version with that. But I was not happy with the result. I also experimented with infinite scroll, but I didn't like it either because it took ages to reach the bottom. After some more tinkering I recalled [a blog post](https://medium.com/google-design/google-photos-45b714dfbed1) on how Google Photos implemented their image browser. I am ashamed to admit that I use Google Photos, although it's in my list of things to replace with [autonomous data](https://noeldemartin.github.io/autonomous-data/) alternatives. But you can't argue against the quality of the product. Inspired by that post and Google Photo's UX, I implemented a solution where the full scroll height is rendered but elements aren't displayed until they appear on screen. This is possible thanks to the [Intersection Observer API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) and [chunking the results](https://github.com/NoelDeMartin/media-kraken/blob/master/src/components/MoviesGrid.vue#L106..L125).

**Rabbithote #2: Web Workers & IndexedDB**

The second rabbit hole came about looking at the responsiveness and speed of the initial loading. Once the app is loaded it works well, but the initial loading is excruciating. This is also a problem in [Solid Focus](https://github.com/noeldemartin/solid-focus), but it's accentuated in this application because the dataset is bigger.

There are multiple reasons for this. Two important ones are network requests and parsing semantic data. Looking into this, I reached the conclusion that it can be improved by caching more data in the browser. I was already doing something similar in offline mode, with a local storage engine. But exploring other improvements I found two browser APIs I hadn't been using: [IndexedDB](https://developer.mozilla.org/en-US/docs/Web/API/IndexedDB_API) and [Web Workers](https://developer.mozilla.org/en-US/docs/Web/API/Web_Workers_API).

Those two play very well together, so I spend some time rewriting different parts of the stack to [support web workers](https://github.com/NoelDeMartin/media-kraken/blob/master/src/workers/index.ts) and I created a new [IndexedDBEngine](https://github.com/NoelDeMartin/soukai/blob/dev/src/engines/IndexedDBEngine.ts) in Soukai. Although I'm not completely finished with this, and the reason is...

**Rabbithole #3: JsonLD serialization**

[SolidModel](https://github.com/NoelDeMartin/soukai-solid/blob/master/src/models/SolidModel.ts) currently serializes models to "friendly human-readable json". This is something that [SolidEngine](https://github.com/NoelDeMartin/soukai-solid/blob/master/src/engines/SolidEngine.ts) already knows, and it translates the attributes to a linked data format. The reason why I followed this approach is that other engines, such as `LocalStorageEngine`, don't know anything about Solid and they'll treat serialized models as normal objects.

My goal was that exported models would look understandable to humans, but in hindsight that was a mistake. JsonLD is a standard format and even though if it isn't the most human-readable thing, it's close enough. The cost of not serializing to JsonLD is that semantic data will be lost. This hinders the ability to export and import data, which has become apparent with Media Kraken because I'm implementing these capabilities from the start.

I embarqued on a crusade to rewrite SolidModel to serialize to JsonLD. And I say crusade because this involves refactoring multiple parts of the stack, and it'll definitely cause breaking changes. But I'm confident that it'll be better in the long run.

This one is so core that I don't really have a bet for it, it'll take as long as it needs to. I've already sorted out some of the core changes, and I've replaced the library I was using for interacting with semantic data with [n3](https://github.com/rdfjs/n3.js) and [jsonld-streaming-parser](https://github.com/rubensworks/jsonld-streaming-parser.js). This should also reduce the bundle size and improve performance.
